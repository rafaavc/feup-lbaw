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
use App\Models\Tag;
use Exception;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


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
        if (!Auth::check()) return redirect('/feed');
        try {
            $units = Unit::all();
            $categories = Category::all();
            $ingredients = Ingredient::all();
            $tags = Tag::all();

            return view('pages.upsertRecipe', [
                'units' => $units,
                'categories' => $categories,
                'totalIngredients' => $ingredients,
                'totalTags' => $tags
            ]);
        } catch (\Exception $e) {
            abort(403, 'Database Exception');
        }
    }

    /**
     * R1012: /recipe
     *
     * @return \Illuminate\Http\Response
     */
    public function createRecipe(Request $request)
    {

        if (!Auth::check()) return redirect('/feed');

        $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required|integer|exists:App\Models\Category,id',
            'description' => 'required|string',
            'difficulty' => 'required|string|in:easy,medium,hard,very hard',
            'servings' => 'required|integer|min:1',
            'tags'  => 'required|array',
            'tags.*' => 'integer|exists:App\Models\Tag,id',
            'ingredients' => 'required|array',
            'ingredients.*.quantity' => 'required|numeric|min:0',
            'ingredients.*.id_unit' => 'required|integer|exists:App\Models\Unit,id',
            'ingredients.*.id' => 'required|integer|exists:App\Models\Ingredient,id',
            'preparation_time' => 'required|integer|min:0',
            'cooking_time' => 'required|integer|min:0',
            'additional_time' => 'required|integer|min:0',
            'steps'  => 'required|array',
            'steps.*.name' => 'required|string',
        ], [
            'tags.*.*' => 'Invalid Tag.',
            'ingredients.*.quantity.*' => 'Invalid quantity.',
            'ingredients.*.id_unit.*' => 'Invalid unit.',
            'ingredients.*.id.*' => 'Invalid ingredient.',
            'steps.*.name.*' => 'Invalid Step name.'
        ]);

        try {
            $apiMessage = $this->insert($request);

            if($apiMessage->status() != 200)
                throw new Exception('Database Exception!');

            return redirect('/recipe/' . $apiMessage->getOriginalContent()['recipe_id'])->with('message', 'Recipe successfully created!'); // TODO: change to the created recipe page
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * RX: /recipe/{recipeId}/edit
     *
     * @param int $recipeId
     * @return \Illuminate\Http\Response
     */
    public function edit($recipeId)
    {
        if (!Auth::check()) return redirect('/recipe/' . $recipeId);
        $this->authorize('update', Recipe::findOrFail($recipeId));

        try {
            $recipe = Recipe::findOrFail($recipeId);
            $units = Unit::all();
            $categories = Category::all();
            $ingredients = Ingredient::all();
            $tags = Tag::all();

            return view('pages.upsertRecipe', [
                'recipe' => $recipe,
                'ingredients' => $recipe->ingredients,
                'tags' => $recipe->tags,
                'author' => $recipe->author,
                'steps' => $recipe->steps,
                'units' => $units,
                'categories' => $categories,
                'totalIngredients' => $ingredients,
                'totalTags' => $tags
            ]);
        } catch (\Exception $e) {
            abort(403, 'Database Exception');
        }
    }

    /**
     * RX: /recipe/{recipeId}/edit
     *
     * @param int $recipeId
     * @return \Illuminate\Http\Response
     */
    public function editPost(Request $request, $recipeId)
    {
        if (!Auth::check()) return redirect('/recipe/' . $recipeId);
        $this->authorize('update', Recipe::findOrFail($recipeId));

        $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required|integer|exists:App\Models\Category,id',
            'description' => 'required|string',
            'difficulty' => 'required|string|in:easy,medium,hard,very hard',
            'servings' => 'required|integer|min:1',
            'tags'  => 'required|array',
            'tags.*' => 'integer|exists:App\Models\Tag,id|distinct',
            'ingredients' => 'required|array',
            'ingredients.*.quantity' => 'required|numeric|min:0',
            'ingredients.*.id_unit' => 'required|integer|exists:App\Models\Unit,id',
            'ingredients.*.id' => 'required|integer|exists:App\Models\Ingredient,id|distinct',
            'preparation_time' => 'required|integer|min:0',
            'cooking_time' => 'required|integer|min:0',
            'additional_time' => 'required|integer|min:0',
            'steps'  => 'required|array',
            'steps.*.name' => 'required|string',
            'steps.*.photo' => 'nullable|file|image',
            'images.*' => 'nullable|file|image'
        ], [
            'tags.*.distinct' => 'Repeated tags are not allowed.',
            'tags.*.*' => 'Invalid Tag.',
            'ingredients.*.quantity.*' => 'Invalid quantity.',
            'ingredients.*.id_unit.*' => 'Invalid unit.',
            'ingredients.*.id.distinct' => 'Repeated ingredients are not allowed.',
            'ingredients.*.id.*' => 'Invalid ingredient.',
            'steps.*.name.*' => 'Invalid Step name.'
        ]);

        try {
            $apiMessage = $this->update($request, $recipeId);

            if($apiMessage->status() != 200)
                throw new Exception('Database Exception!');

            return redirect('/recipe/' . $recipeId)->with('message', 'Recipe successfully updated!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
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
        DB::beginTransaction();
        try {
            $recipe = new Recipe();

            $recipe->preparation_time = $request->input('preparation_time');
            $recipe->cooking_time = $request->input('cooking_time');
            $recipe->additional_time = $request->input('additional_time');
            $recipe->name = $request->input('name');
            $recipe->description = $request->input('description');
            $recipe->difficulty = $request->input('difficulty');
            $recipe->servings = $request->input('servings');
            $recipe->author()->associate(Auth::user()->id);

            // Handle End Product Photos

            $recipe->save();

            // Category
            $category = Category::findOrFail($request->input('category'));
            $recipe->category()->associate($category);

            // Tags
            $requestTags = $request->input('tags');
            $numUserTags = count($requestTags);

            $tagIds = array();
            for ($i = 0; $i < $numUserTags; $i++)
                array_push($tagIds, $requestTags[$i]);

            $recipe->tags()->sync($tagIds);

            // Steps
            $requestSteps = $request->input('steps');
            $numUserSteps = count($requestSteps);

            $recipe->steps()->forceDelete();

            for ($i = 0; $i < $numUserSteps; $i++) {
                $step = new Step([
                    'name' => $requestSteps[$i]["name"],
                    'description' => $requestSteps[$i]["description"],
                ]);
                $step = $recipe->steps()->save($step);

                // Save step images
                if($request->hasFile("steps." . $i))
                    $request->file('steps')[$i]['image']->storeAs('public/images/steps/', $step->id . '.jpeg');
            }

            // Ingredients
            $requestIngredients = $request->input('ingredients');
            $numUserIngredients = count($requestIngredients);

            $recipe->ingredients()->detach();

            for ($i = 0; $i < $numUserIngredients; $i++) {
                $ingredientId = $requestIngredients[$i]['id'];
                $recipe->ingredients()->attach($ingredientId, [
                    'id_unit' => $requestIngredients[$i]['id_unit'],
                    'quantity' => $requestIngredients[$i]['quantity']
                ]);
            }

            DB::commit();
            return response()->json(['message' => 'Succeed!', 'recipe_id' => $recipe->id], 200);
        } catch(\Exception $e) {

            var_dump($e->getMessage());
            exit(1);

            DB::rollback();
            return response()->json(['message' => 'Invalid Request!'], 400);
        }
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
        // Still missing token verification

        $this->validate($request, [
            'name' => 'required|string',
            'category' => 'required|integer|exists:App\Models\Category,id',
            'description' => 'required|string',
            'difficulty' => 'required|string|in:easy,medium,hard,very hard',
            'servings' => 'required|integer|min:1',
            'tags'  => 'required|array',
            'tags.*' => 'integer|exists:App\Models\Tag,id|distinct',
            'ingredients' => 'required|array',
            'ingredients.*.quantity' => 'required|numeric|min:0',
            'ingredients.*.id_unit' => 'required|integer|exists:App\Models\Unit,id',
            'ingredients.*.id' => 'required|integer|exists:App\Models\Ingredient,id|distinct',
            'preparation_time' => 'required|integer|min:0',
            'cooking_time' => 'required|integer|min:0',
            'additional_time' => 'required|integer|min:0',
            'steps'  => 'required|array',
            'steps.*.name' => 'required|string',
            'steps.*.photo' => 'nullable|file|image',
            'images.*' => 'nullable|file|image'
        ], [
            'tags.*.distinct' => 'Repeated tags are not allowed.',
            'tags.*.*' => 'Invalid Tag.',
            'ingredients.*.quantity.*' => 'Invalid quantity.',
            'ingredients.*.id_unit.*' => 'Invalid unit.',
            'ingredients.*.id.distinct' => 'Repeated ingredients are not allowed.',
            'ingredients.*.id.*' => 'Invalid ingredient.',
            'steps.*.name.*' => 'Invalid Step name.'
        ]);

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
            File::deleteDirectory(storage_path('app/public/images/recipes/' . $recipe->id));
            if($request->hasFile('images')) {
                foreach($request->file('images') as $file)
                    $file->storeAs('public/images/recipes/'. $recipe->id, date('mdYHis') . uniqid() . '.jpeg');
            }

            // Category
            $category = Category::findOrFail($request->input('category'));
            $recipe->category()->associate($category);
            // Tags
            $requestTags = $request->input('tags');
            $numUserTags = count($requestTags);

            $tagIds = array();
            for ($i = 0; $i < $numUserTags; $i++)
                array_push($tagIds, $requestTags[$i]);

            $recipe->tags()->sync($tagIds);

            // Steps
            $requestSteps = $request->input('steps');
            $numUserSteps = count($requestSteps);

            // Delete Step Images
            foreach($recipe->steps()->get() as $step)
                Storage::delete('public/images/steps/' . $step->id . '.jpeg');

            $recipe->steps()->forceDelete();

            for ($i = 0; $i < $numUserSteps; $i++) {
                $step = new Step([
                    'name' => $requestSteps[$i]["name"],
                    'description' => $requestSteps[$i]["description"],
                ]);
                $step = $recipe->steps()->save($step);

                // Save step images
                if($request->hasFile("steps." . $i))
                    $request->file('steps')[$i]['image']->storeAs('public/images/steps/', $step->id . '.jpeg');
            }

            // Ingredients
            $requestIngredients = $request->input('ingredients');
            $numUserIngredients = count($requestIngredients);

            $recipe->ingredients()->detach();

            for ($i = 0; $i < $numUserIngredients; $i++) {
                $ingredientId = $requestIngredients[$i]['id'];
                $recipe->ingredients()->attach($ingredientId, [
                    'id_unit' => $requestIngredients[$i]['id_unit'],
                    'quantity' => $requestIngredients[$i]['quantity']
                ]);
            }

            $recipe->save();

            DB::commit();
            return response()->json(['message' => 'Succeed!'], 200);
            // return json_encode(['message' => 'Succeed!'], 200);
        } catch(\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Invalid Request!'], 400);
            // return json_encode(['error' => 'Invalid Request'], 400);
        }
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
