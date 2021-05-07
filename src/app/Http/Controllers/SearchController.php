<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Category;
use App\Models\Recipe;
use Exception;
use Illuminate\Foundation\Auth\User;
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
            'searchStr' => $request->query('searchQuery')
        ]);
    }

    public function getRecipesPaginate(Request $request) {
        $searchStr = preg_replace("/\s+/", " | ", $request->query('searchQuery'));
        $page = $request->query('page');
        $numResults = 0;
        $recipes = $this->getRecipes($searchStr, $numResults, $page);

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

    public function getRecipes($searchStr, &$numResults, $page = 1, $itemsPerPage = 3) {
        $recipeQuery = DB::table('recipes_fts_view')
            ->selectRaw('*, search, ts_rank(search, to_tsquery(\'english\', ?)) AS rank', [$searchStr])
            ->when($searchStr, function($query, $searchStr) {
                if(true || Auth::guard('admin')->check()) {
                    return $query
                        ->whereRaw('search @@ to_tsquery(\'english\', ?)', [$searchStr])
                        ->orderByDesc('rank')
                        ->orderByDesc('recipe_id');
                } else {
                    return $query
                        ->whereRaw('search @@ to_tsquery(\'english\', ?) AND member_id <> ? AND recipe_visibility(recipe_id, ?) = TRUE', [$searchStr, (Auth::check()) ? Auth::id() : 0, Auth::id()])
                        ->orderByDesc('rank')
                        ->orderByDesc('recipe_id');
                }
            }, function ($query) {
                return $query
                    ->orderByDesc('recipe_id');
            });

        $numResults += $recipeQuery->count();
        $recipes = $recipeQuery->skip(($page - 1) * $itemsPerPage)->take($itemsPerPage)->get();

        return $recipes;
    }

    public function getUsers($searchStr, &$numResults, $page = 1, $itemsPerPage = 3) {
        $userQuery = Member::selectRaw('*, search, ts_rank(search, to_tsquery(\'simple\', ?)) AS rank', [$searchStr])
            ->when($searchStr, function($query, $searchStr) {
                return $query
                    ->whereRaw('search @@ to_tsquery(\'english\', ?) AND id <> ?', [$searchStr, (Auth::check()) ? Auth::id() : 0])
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
