<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Request $request)
    {
        return view('pages.search', [
            'searchStr' => $request->query('searchQuery'),
            'categories' => Category::all(),
            'tags' => Tag::all(),
            'ingredients' => Ingredient::all(),
            'showSortBar' => false
        ]);
    }

    public function getRecipesPaginate(Request $request) {
        $searchStr = preg_replace("/\s+/", " | ", $request->query('searchQuery'));
        $page = $request->query('page');
        $numResults = 0;
        $recipes = $this->getRecipes($request, $searchStr, $numResults, $page);

        $responseRecipes = array();
        $counter = 0;
        foreach($recipes as $recipe) {
            $responseRecipes[$counter] = view('partials.search.recipeCard', [
                'recipe' => $recipe])->render();
            $counter++;
        }
        return response()->json([
            'message' => 'Success!',
            'result' => $responseRecipes,
            'numResults' => $numResults
        ], 200);
    }

    public function getUsersPaginate(Request $request) {
        $searchStr = preg_replace("/\s+/", " | ", $request->query('searchQuery'));
        $page = $request->query('page');
        $numResults = 0;
        $users = $this->getUsers($searchStr, $numResults, $page);

        $responseUsers = array();
        $counter = 0;
        foreach($users as $user) {
            $responseUsers[$counter] = view('partials.search.userCard', [
                'user' => $user])->render();
            $counter++;
        }

        return response()->json([
            'message' => 'Success!',
            'result' => $responseUsers,
            'numResults' => $numResults
        ], 200);
    }

    public function getCategoriesPaginate(Request $request) {
        $searchStr = preg_replace("/\s+/", " | ", $request->query('searchQuery'));
        $page = $request->query('page');
        $numResults = 0;
        $categories = $this->getCategories($searchStr, $numResults, $page);

        $responseCategories = array();
        $counter = 0;
        foreach($categories as $category) {
            $responseCategories[$counter] = view('partials.search.categoryCard', [
                'category' => $category])->render();
            $counter++;
        }

        return response()->json([
            'message' => 'Success!',
            'result' => $responseCategories,
            'numResults' => $numResults
        ], 200);
    }

    // public function getGroupsPaginate(Request $request) {
    //     $searchStr = preg_replace("/\s+/", " | ", $request->query('searchQuery'));
    //     $page = $request->query('page');
    //     $numResults = 0;
    //     $groups = $this->getGroups($searchStr, $numResults, $page);

    //     $responseGroups = array();
    //     $counter = 0;
    //     foreach($groups as $group) {
    //         $responseGroups[$counter] = view('partials.search.groupCard', [
    //             'group' => $group])->render();
    //         $counter++;
    //     }

    //     return response()->json([
    //         'message' => 'Success!',
    //         'result' => $responseGroups,
    //         'numResults' => $numResults
    //     ], 200);
    // }

    public function getRecipes(Request $request, $searchStr, &$numResults, $page = 1, $itemsPerPage = 3) {
        $recipeQuery = DB::table('recipes_fts_view')
            ->selectRaw('*, search, ts_rank(search, to_tsquery(\'english\', ?)) AS rank, recipe_visibility(recipe_id, ?) as visibility', [$searchStr, Auth::id()])
            ->when($searchStr, function($query, $searchStr) {
                if (false && Auth::guard('admin')->check()) {  // TODO remove false when admin guard is defined
                    $query = $query
                        ->whereRaw('search @@ to_tsquery(\'english\', ?) ', [$searchStr]);
                } else if (Auth::check()) {
                    $query = $query
                        ->whereRaw('search @@ to_tsquery(\'english\', ?) AND member_id <> ? AND recipe_visibility(recipe_id, ?)', [$searchStr, (Auth::check()) ? Auth::id() : 0, Auth::id()]);
                } else {
                    $query = $query
                        ->whereRaw('search @@ to_tsquery(\'english\', ?) AND recipe_visibility(recipe_id, NULL)', [$searchStr]);
                }

                return $query
                    ->orderByDesc('rank')
                    ->orderByDesc('recipe_id');
            }, function ($query) {
                if (false && Auth::guard('admin')->check()) {  // TODO remove false when admin guard is defined
                    return $query;
                } else if (Auth::check()) {
                    $query = $query
                        ->whereRaw('member_id <> ? AND recipe_visibility(recipe_id, ?)', [(Auth::check()) ? Auth::id() : 0, Auth::id()]);
                } else {
                    $query = $query
                        ->whereRaw('recipe_visibility(recipe_id, NULL)');
                }

                return $query
                    ->orderByDesc('recipe_id');
            });

        $recipeQuery = FilterController::filter($request, $recipeQuery, true);

        $numResults += $recipeQuery->count();
        $recipes = $recipeQuery->skip(($page - 1) * $itemsPerPage)->take($itemsPerPage)->get();

        return $recipes;
    }

    public function getUsers($searchStr, &$numResults, $page = 1, $itemsPerPage = 3) {
        $userQuery = Member::selectRaw('*, search, ts_rank(search, to_tsquery(\'simple\', ?)) AS rank', [$searchStr])
            ->when($searchStr, function($query, $searchStr) {
                return $query
                    ->whereRaw('search @@ to_tsquery(\'simple\', ?)', [$searchStr])
                    ->orderByDesc('rank')
                    ->orderByDesc('id');
            }, function($query) {
                return $query
                    ->orderByDesc('id');
            });

        $numResults += $userQuery->count();
        $users = $userQuery->skip(($page - 1) * $itemsPerPage)->take($itemsPerPage)->get();

        return $users;
    }

    public function getCategories($searchStr, &$numResults, $page = 1, $itemsPerPage = 3) {
        $categoryQuery = Category::selectRaw('*, search, ts_rank(search, to_tsquery(\'english\', ?)) AS rank', [$searchStr])
            ->when($searchStr, function($query, $searchStr) {
                return $query
                    ->whereRaw('search @@ to_tsquery(\'english\', ?)', [$searchStr])
                    ->orderByDesc('rank')
                    ->orderByDesc('id');
            }, function($query) {
                return $query
                    ->orderByDesc('id');
            });

        $numResults += $categoryQuery->count();
        $categories = $categoryQuery->skip(($page - 1) * $itemsPerPage)->take($itemsPerPage)->get();

        return $categories;
    }

    // public function getGroups($searchStr, &$numResults, $page = 1, $itemsPerPage = 3) {
    //     $groupQuery = Group::selectRaw('*, search, ts_rank(search, to_tsquery(\'english\', ?)) AS rank', [$searchStr])
    //         ->when($searchStr, function($query, $searchStr) {
    //             return $query
    //                 ->whereRaw('search @@ to_tsquery(\'english\', ?)', [$searchStr])
    //                 ->orderByDesc('rank')
    //                 ->orderByDesc('id');
    //         }, function($query) {
    //             return $query
    //                 ->orderByDesc('id');
    //         });

    //     $numResults += $groupQuery->count();
    //     $groups = $groupQuery->skip(($page - 1) * $itemsPerPage)->take($itemsPerPage)->get();

    //     return $groups;
    // }

}
