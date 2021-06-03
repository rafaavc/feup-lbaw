<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Step;
use App\Models\Tag;
use App\Models\Unit;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    protected $table = "tb_recipe";

    private static $validation = [
        'name' => 'required|string',
        'category' => 'required|integer|exists:App\Models\Category,id',
        'description' => 'required|string',
        'difficulty' => 'required|string|in:easy,medium,hard,very hard',
        'servings' => 'required|integer|min:1',
        'tags' => 'required|array',
        'tags.*' => 'integer|exists:App\Models\Tag,id|distinct',
        'ingredients' => 'required|array',
        'ingredients.*.quantity' => 'required|numeric|min:0',
        'ingredients.*.id_unit' => 'required|integer|exists:App\Models\Unit,id',
        'ingredients.*.id' => 'required|integer|exists:App\Models\Ingredient,id|distinct',
        'preparation_time' => 'required|integer|min:0',
        'cooking_time' => 'required|integer|min:0',
        'additional_time' => 'required|integer|min:0',
        'steps' => 'required|array',
        'steps.*.name' => 'required|string',
        'steps.*.image' => 'nullable|file|image',
        'images.*' => 'nullable|file|image'
    ];

    private static $errorMessages = [
        'tags.*.distinct' => 'Repeated tags are not allowed.',
        'tags.*.*' => 'Invalid Tag.',
        'ingredients.*.quantity.*' => 'Invalid quantity.',
        'ingredients.*.id_unit.*' => 'Invalid unit.',
        'ingredients.*.id.distinct' => 'Repeated ingredients are not allowed.',
        'ingredients.*.id.*' => 'Invalid ingredient.',
        'steps.*.name.*' => 'Invalid Step name.'
    ];

    /**
     * Gets a given recipe's images (urls)
     *
     * @return string[]
     */
    public function getRecipeImages($recipeId)
    {
        $paths = File::files(storage_path('app/public/images/recipes/' . $recipeId . '/'));
        $images = array();
        foreach ($paths as $idx => $path) {
            array_push($images, asset('storage/images/recipes/' . $recipeId . '/' . $path->getBasename()));
        }
        return $images;
    }

    public function getStepImage($stepId, $allStepImages = null)
    {
        if ($allStepImages == null) $allStepImages = Storage::files('public/images/steps/');
        $matchingFiles = preg_grep("/\/" . $stepId . "\./", $allStepImages);

        foreach ($matchingFiles as $file) return $file;
        return null;
    }

    public function deleteRecipeStepsImages($steps)
    {
        $allStepImages = Storage::files('public/images/steps');
        foreach ($steps as $step) {
            $imgPath = $this->getStepImage($step->id, $allStepImages);
            var_dump($imgPath);

            if ($imgPath != null) File::delete(storage_path('app/' . $imgPath));
        }
    }

    /**
     * Gets a given step's image (url)
     *
     * @return string
     */
    public function getStepImageForClient($stepId)
    {
        $path = str_replace("public/", "storage/", $this->getStepImage($stepId));
        if ($path != null) return asset($path);
        return null;
    }


    /**
     * R1011: /recipe/{recipeId}
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Recipe $recipe)
    {
        $commentsWithFathers = $recipe->comments()->has('fatherComments')->get();
        $commentsWithFathersIds = array();
        foreach ($commentsWithFathers as $comment) {
            array_push($commentsWithFathersIds, $comment->id);
        }

        $images = $this->getRecipeImages($recipe->id);

        $suggested = Recipe::inRandomOrder()->where('id', '!=', $recipe->id)->limit(4)->get();
        foreach ($suggested as $recipeCard) {
            $recipeCard->image = $this->getRecipeImages($recipeCard->id)[0];
            $recipeCard->owner = $recipeCard->author->name;
        }



        $steps = $recipe->steps;
        foreach ($steps as $step) {
            $image = $this->getStepImageForClient($step->id);
            if ($image != null) $step->image = $image;
        }

        $isFavourited = false;
        $hasMadeReview = false;
        if (Auth::check()) {
            $membersWhoFavourited = $recipe->membersWhoFavourited()->where('id_member', '=', Auth::user()->id)->get();
            if (sizeof($membersWhoFavourited) != 0) $isFavourited = true;
            $hasMadeReview = sizeof(Auth::user()->comments()->where('id_recipe', '=', $recipe->id)->whereNotNull('rating')->get()) != 0;
        }

        return view('pages.recipe', [
            'recipe' => $recipe,
            'ingredients' => $recipe->ingredients,
            'tags' => $recipe->tags,
            'comments' => $recipe->comments()->whereNotIn('id', $commentsWithFathersIds)->get(),
            'author' => $recipe->author,
            'steps' => $recipe->steps,
            'category' => $recipe->category,
            'images' => $images,
            'suggested' => $suggested,
            'hasMadeReview' => $hasMadeReview,
            'isFavourited' => $isFavourited
        ]);
    }

    /**
     * Action for deleting recipe
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteAction(Recipe $recipe)
    {
        $recipeName = $recipe->name;
        $this->delete($recipe);
        return redirect('/feed')->with('message', 'Recipe "' . $recipeName . '" successfully deleted!');
    }

    /**
     * R1012: /recipe
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group)
    {
        try {
            if ($group != null)
                return view('pages.upsertRecipe', ['groupId' => $group->id]);
            else
                return view('pages.upsertRecipe');
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
        $this->validate($request, RecipeController::$validation, RecipeController::$errorMessages);

        try {
            $apiMessage = $this->insert($request);

            if ($apiMessage->status() != 200)
                throw new Exception('Database Exception!');

            return redirect('/recipe/' . $apiMessage->getOriginalContent()['recipe_id'])->with('message', 'Recipe successfully created!');
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
    public function edit(Recipe $recipe)
    {
        try {
            $units = Unit::all();

            return view('pages.upsertRecipe', [
                'recipe' => $recipe,
                'ingredients' => $recipe->ingredients,
                'tags' => $recipe->tags,
                'author' => $recipe->author,
                'steps' => $recipe->steps,
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
    public function editPost(Request $request, Recipe $recipe)
    {
        $this->validate($request, RecipeController::$validation, RecipeController::$errorMessages);

        try {
            $apiMessage = $this->update($request, $recipe);

            if ($apiMessage->status() != 200)
                throw new Exception('Database Exception!');

            return redirect('/recipe/' . $recipe->id)->with('message', 'Recipe successfully updated!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * R2101: /api/recipe
     *
     * @param \Illuminate\Http\Request $request
     * @return Recipe
     */
    public function insert(Request $request)
    {
        $this->validate($request, RecipeController::$validation, RecipeController::$errorMessages);

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

            // Category
            $category = Category::findOrFail($request->input('category'));
            $recipe->category()->associate($category);

            // Group
            if ($request->input('group') != '') {
                $group = Group::findOrFail($request->input('group'));
                $recipe->group()->associate($group);
            }

            $recipe->save();

            // Tags
            $requestTags = $request->input('tags');
            $numUserTags = count($requestTags);

            $tagIds = array();
            for ($i = 0; $i < $numUserTags; $i++)
                array_push($tagIds, $requestTags[$i]);

            $recipe->tags()->sync($tagIds);

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
                if ($request->hasFile("steps." . $i)) {
                    $stepImageFile = $request->file('steps')[$i]['image'];
                    $stepImageFile->storeAs('public/images/steps/', $step->id . '.' . $stepImageFile->extension());
                }
            }

            // Handle End Product Photos
            $path = storage_path('app/public/images/recipes/' . $recipe->id);
            File::ensureDirectoryExists($path);
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file)
                    $file->storeAs('public/images/recipes/' . $recipe->id, date('mdYHis') . uniqid() . '.' . $file->extension());
            }

            DB::commit();
            return response()->json(['message' => 'Succeed!', 'recipe_id' => $recipe->id], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Invalid Request!'], 400);
        }
    }

    /**
     * R2102: /api/recipe/{recipeId}
     *
     * @param int $recipeId
     * @return Recipe
     */
    public function select(Recipe $recipe)
    {
        return $recipe;
    }

    /**
     * R2103: /api/recipe/{recipeId}
     *
     * @param \Illuminate\Http\Request $request
     * @param int $recipeId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        // Still missing token verification
        $this->validate($request, RecipeController::$validation, RecipeController::$errorMessages);

        DB::beginTransaction();
        try {
            $recipe->preparation_time = $request->input('preparation_time');
            $recipe->cooking_time = $request->input('cooking_time');
            $recipe->additional_time = $request->input('additional_time');
            $recipe->name = $request->input('name');
            $recipe->description = $request->input('description');
            $recipe->difficulty = $request->input('difficulty');
            $recipe->servings = $request->input('servings');

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

            // Steps
            $requestSteps = $request->input('steps');
            $numUserSteps = count($requestSteps);


            // Delete Step Images
            $this->deleteRecipeStepsImages($recipe->steps);

            $recipe->steps()->forceDelete();

            for ($i = 0; $i < $numUserSteps; $i++) {
                $step = new Step([
                    'name' => $requestSteps[$i]["name"],
                    'description' => $requestSteps[$i]["description"],
                ]);
                $step = $recipe->steps()->save($step);

                // Save step images
                if ($request->hasFile("steps." . $i)) {
                    $stepImageFile = $request->file('steps')[$i]['image'];
                    $stepImageFile->storeAs('public/images/steps/', $step->id . '.' . $stepImageFile->extension());
                }
            }

            // Handle End Product Photos
            File::cleanDirectory(storage_path('app/public/images/recipes/' . $recipe->id));
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file)
                    $file->storeAs('public/images/recipes/' . $recipe->id, date('mdYHis') . uniqid() . '.' . $file->extension());
            }
            $recipe->save();

            DB::commit();
            return response()->json(['message' => 'Succeed!'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Invalid Request!'], 400);
        }
    }

    /**
     * R2104: /api/recipe/{recipeId}
     *
     * @param int $recipeId
     * @return Recipe
     */
    public function delete(Recipe $recipe)
    {
        $this->deleteRecipeStepsImages($recipe->steps);

        File::deleteDirectory(storage_path('app/public/images/recipes/' . $recipe->id));

        if(Auth::guard('admin')->check()) {
            DB::table('tb_delete_notification')->insert([
                'id_receiver' => $recipe->id_member,
                'name_recipe' => $recipe->name
            ]);
        }

        $recipe->delete();

        return $recipe;
    }


    /**
     * R2105: POST /api/recipe/{recipeId}/favourite
     *
     * @param int $recipeId
     * @return void
     */
    public function addToFavourites(Recipe $recipe)
    {
        $recipe->membersWhoFavourited()->attach(Auth::user()->id);
        return response()->json(['message' => 'Success'], 200);
    }


    /**
     * R2106: DELETE /api/recipe/{recipeId}/favourite
     *
     * @param int $recipeId
     * @return void
     */
    public function removeFromFavourites(Recipe $recipe)
    {
        $recipe->membersWhoFavourited()->detach(Auth::user()->id);
        return response()->json(['message' => 'Success'], 200);
    }
}
