<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

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
        foreach ($commentsWithFathers as $comment) {
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
        //
    }

    /**
     * R2101: /api/recipe
     *
     * @param \Illuminate\Http\Request $request
     * @return Recipe
     */
    public function insert(Request $request)
    {
        $recipe = new Recipe();
        // See if the user has authorization for this
        $this->authorize('insert', $recipe);

        // Validate request
        $request = $request->validate([
            'name' => 'required|string',
            'difficulty' => 'required|string',
            'description' => 'required|string',
            'servings' => 'required|integer',
            'preparation_time' => 'required|integer',
            'cooking_time' => 'required|integer',
            'id_category' => 'required|exists:App\Models\Category,id',
            'id_group' => 'required|nullable|exists:App\Models\Group,id',
            'ingredients.*.id_unity' => 'required|exists:App\Models\Unit,id',
            'ingredients.*.quantity' => 'required|integer',
            'tags.*.id' => 'required|exists:App\Models\Tag,id',
            'steps.*.name' => 'required|string',
            'steps.*.description' => 'required|string',
            'steps.*.photo' => 'required|nullable|file|image',
            'photos.*' => 'required|file|image',
        ]);

        // Add the attributes of the recipe
        $recipe->name = $request->input('name');
        $recipe->difficulty = $request->input('difficulty');
        $recipe->description = $request->input('description');
        $recipe->servings = $request->input('servings');
        $recipe->preparation_time = $request->input('preparation_time');
        $recipe->cooking_time = $request->input('cooking_time');
        $recipe->additional_time = $request->input('additional_time');
        // The creator of the recipe is the logged user
        $recipe->author()->attach(Auth::user()->id);
        // Attach simple foreign keys
        $recipe->category()->attach($request->input('id_category'));
        $recipe->group()->attach($request->input('id_group'));

        // Get the ingredients and attach to the recipe
        $ingredients = array();
        $request->input('ingredients', $ingredients);
        foreach ($ingredients as $ingredient) {
            $recipe->ingredients()->attach($ingredient['id'], [
                'id_unity' => $ingredient['id_unity'],
                'quantity' => $ingredient['quantity']
            ]);
        }

        // Get the tags and attach to the recipe
        $tags = array();
        $request->input('tags', $tags);
        foreach ($tags as $tag) {
            $recipe->tags()->attach($tag['id']);
        }

        // Save the recipe to the database
        $recipe->save();

        // Get the steps and create each one of them
        $steps = array();
        $request->input('steps', $steps);
        foreach ($steps as $step) {
            $step_instance = new Step();
            $this->authorize('insert', $step_instance);
            $step_instance->name = $step['name'];
            $step_instance->description = $step['description'];
            $step_instance->id_recipe = $recipe->id;
            $step_instance->save();
        }

        // TODO: add images to file system

        return $recipe;
    }

    /**
     * R2102: /api/recipe/{recipeId}
     *
     * @param int $recipeId
     * @return Recipe
     */
    public function select($recipeId)
    {
        $recipe = Item::find($recipeId);
        $this->authorize('select', $recipe);
        return $recipe;
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
        //
    }

    /**
     * R2104: /api/recipe/{recipeId}
     *
     * @param int $recipeId
     * @return Recipe
     */
    public function delete($recipeId)
    {
        $recipe = Recipe::find($recipeId);
        $this->authorize('delete', $recipe);
        $recipe->delete();
        return $recipe;
    }
}
