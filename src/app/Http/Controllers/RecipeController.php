<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;
use App\Models\Step;
use App\Models\Unit;
use App\Models\Ingredient;

class RecipeController extends Controller
{
    protected $table = "tb_recipe";

    /**
     * R1011: /recipe/{recipeId}
     *
     * @return \Illuminate\Http\Response
     */
    public function view($recipeId)
    {
        $recipe = Recipe::findOrFail($recipeId);

        $commentsWithFathers = $recipe->comments()->has('fatherComments')->get();
        $commentsWithFathersIds = array();
        foreach($commentsWithFathers as $comment) {
            array_push($commentsWithFathersIds, $comment->id);
        }

        return view('pages.recipe', [
            'recipe' => $recipe,
            'ingredients' => $recipe->ingredients,
            'tags' => $recipe->tags,
            'comments' => $recipe->comments()->whereNotIn('id', $commentsWithFathersIds)->get(),
            'author' => $recipe->author,
            'steps' => $recipe->steps,
            'suggested' => []
        ]);
    }

    /**
     * R1012: /recipe
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json(['message' => 'Succeed!'], 200);
        //
    }

    /**
     * RX: /recipe/{recipeId}/edit
     *
     * @param int $recipeId
     * @return \Illuminate\Http\Response
     */
    public function edit($recipeId)
    {
        // if (!Auth::check()) return redirect('/recipe/' . $recipeId);
        // $this->autorize(...);
        try {
            $recipe = Recipe::findOrFail($recipeId);
            $units = Unit::all();
            $categories = Category::all();
            $ingredients = Ingredient::all();

            return view('pages.editRecipe', [
                'recipe' => $recipe,
                'ingredients' => $recipe->ingredients,
                'tags' => $recipe->tags,
                'author' => $recipe->author,
                'steps' => $recipe->steps,
                'units' => $units,
                'categories' => $categories,
                'totalIngredients' => $ingredients
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid Request!'], 400);
        }
    }

    /**
     * R2101: /api/recipe
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        //
    }

    /**
     * R2102: /api/recipe/{recipeId}
     *
     * @param int $recipeId
     * @return \Illuminate\Http\Response
     */
    public function select($recipeId)
    {
        //
    }

    /**
     * R2103: /api/recipe/{recipeId}
     *
     * @param \Illuminate\Http\Request $request
     * @param int $recipeId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $recipeId)
    {
        DB::beginTransaction();
        try {
            $recipe = Recipe::findOrFail($recipeId);

            $recipe->preparation_time = $request->input('preparation_time');
            $recipe->cooking_time = $request->input('cooking_time');
            $recipe->additional_time = $request->input('additional_time');
            $recipe->name = $request->input('name');
            $recipe->description = $request->input('description');
            $recipe->difficulty = $request->input('difficulty');
            $recipe->servings = $request->input('servings');

            // Handle End Product Photos

            // Category
            $category = Category::findOrFail($request->input('category')['id']);
            $recipe->category()->associate($category);

            // Tags
            $requestTags = $request->input('tags');
            $numUserTags = count($requestTags);

            $tagIds = array();
            for ($i = 0; $i < $numUserTags; $i++)
                array_push($tagIds, $requestTags[$i]['id']);

            $recipe->tags()->sync($tagIds);

            // Steps
            $requestSteps = $request->input('steps');
            $numUserSteps = count($requestSteps);

            // Delete Step Images
            $recipe->steps()->forceDelete();

            for ($i = 0; $i < $numUserSteps; $i++) {
                $step = new Step([
                    'name' => $requestSteps[$i]->name,
                    'description' => $requestSteps[$i]->description,
                ]);
                $step = $recipe->steps()->save($step);

                // Save Step images
            }

            // Ingredients
            $requestIngredients = $request->input('ingredients');
            $numUserIngredients = count($requestIngredients);

            $recipe->ingredients()->forceDelete();

            for ($i = 0; $i < $numUserIngredients; $i++) {
                $ingredientId = $requestIngredients[$i]['ingredient']['id'];
                $recipe->ingredients->attach($ingredientId, [
                    'id_unit' => $requestIngredients[$i]['unit']['id'],
                    'quantity' => $requestIngredients[$i]['quantity']
                ]);
            }

            $recipe->save();

            DB::commit();
            return response()->json(['message' => 'Succeed!'], 200);
            // return response()->json(['message' => 'Succeed!'], 200);
        } catch(\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Invalid Request!'], 400);
        }



        // $this->autorize(...);
    }

    /**
     * R2104: /api/recipe/{recipeId}
     *
     * @param int $recipeId
     * @return \Illuminate\Http\Response
     */
    public function delete($recipeId)
    {
        //
    }
}
