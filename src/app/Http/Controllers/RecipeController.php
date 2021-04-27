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
     * @return \Illuminate\Http\Response
     */
    public function delete($recipeId)
    {
        //
    }
}
