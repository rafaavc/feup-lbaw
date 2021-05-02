<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use File;

class RecipeController extends Controller
{
    protected $table = "tb_recipe";

    /**
     * Gets a given recipe's images (urls)
     *
     * @return string[]
     */
    public function getRecipeImages($recipeId) {
        $paths = File::files(storage_path('app/public/images/recipes/'.$recipeId.'/'));
        $images = array();
        foreach($paths as $idx => $path) {
            array_push($images, asset('storage/images/recipes/'.$recipeId.'/'.$path->getBasename()));
        }
        return $images;
    }

    /**
     * Gets a given step's image (url)
     *
     * @return string
     */
    public function getStepImage($stepId) {
        if (File::exists(storage_path('app/public/images/steps/'.$stepId.'.jpeg'))) {
            return asset('storage/images/steps/'.$stepId.'.jpeg');  // TODO change for any extension
        }
        return null;
    }


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

        $images = $this->getRecipeImages($recipe->id);

        $suggested = Recipe::inRandomOrder()->where('id', '!=', $recipe->id)->limit(4)->get();
        foreach ($suggested as $recipeCard) {
            $recipeCard->image = $this->getRecipeImages($recipeCard->id)[0];
            $recipeCard->owner = $recipeCard->author->name;
        }

        $canEdit = false; // TODO $this->inspect('')
        $canDelete = false; // TODO $this->inspect('')

        $steps = $recipe->steps;
        foreach($steps as $idx => $step) {
            $image = $this->getStepImage($step->id);
            if ($image != null) $step->image = $image;
        }

        return view('pages.recipe', [
            'recipe' => $recipe,
            'ingredients' => $recipe->ingredients,
            'tags' => $recipe->tags,
            'comments' => $recipe->comments()->whereNotIn('id', $commentsWithFathersIds)->get(),
            'author' => $recipe->author,
            'steps' => $recipe->steps,
            'images' => $images,
            'suggested' => $suggested,
            'canEdit' => $canEdit,
            'canDelete' => $canDelete
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
