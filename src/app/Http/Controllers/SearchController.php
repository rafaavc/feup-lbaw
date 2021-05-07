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
        try {
            $apiResponse = $this->show($request);

            if($apiResponse->status() != 200)
                    throw new Exception('Database Exception!');

            return $apiResponse->getOriginalContent()['searchResults'];
        } catch(Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            $searchStr = preg_replace("/\s+/", " | ", $request->query('searchQuery'));

            // Recipes
            $recipes = $this->getRecipes($searchStr);

            // Users
            $users = $this->getUsers($searchStr);

            // Categories
            $categories = $this->getCategories($searchStr);

            // Groups
            // $groups = $this->getGroups($searchStr);

            $numResults = $recipes->count() + $users->count() + $categories->count(); // $groups->count();

            return response()->json(['message' => 'Success!', 'searchResults' => view('pages.search', [
                'searchStr' => $searchStr,
                'numResults' => $numResults,
                'recipes' => $recipes,
                'users' => $users,
                'categories' => $categories,
                // 'groups' => $groups
            ])->render()], 200);

        } catch(Exception $e) {
            return response()->json(['error' => 'Invalid Request!'], 400);
        }
    }

    public function getRecipes($searchStr) {
        $recipes = DB::table('recipes_fts_view')
        ->selectRaw('*, search, ts_rank(search, to_tsquery(\'english\', ?)) AS rank', [$searchStr])
        ->when($searchStr, function($query, $searchStr) {
            if(true || Auth::guard('admin')->check()) {
                return $query
                    ->whereRaw('search @@ to_tsquery(\'english\', ?)', [$searchStr])
                    ->orderByDesc('rank');
            } else {
                return $query
                    ->whereRaw('search @@ to_tsquery(\'english\', ?) AND member_id <> ? AND recipe_visibility(recipe_id, ?) = TRUE', [$searchStr, (Auth::check()) ? Auth::id() : 0, Auth::id()])
                    ->orderByDesc('rank');
            }
        }, function ($query) {
            return $query
                ->inRandomOrder()
                ->limit(20);
        })
        ->get();

        return $recipes;
    }

    public function getUsers($searchStr) {
        $users = Member::selectRaw('*, search, ts_rank(search, to_tsquery(\'simple\', ?)) AS rank', [$searchStr])
            ->when($searchStr, function($query, $searchStr) {
                return $query
                    ->whereRaw('search @@ to_tsquery(\'english\', ?) AND id <> ?', [$searchStr, (Auth::check()) ? Auth::id() : 0])
                    ->orderByDesc('rank');
            }, function($query) {
                return $query
                    ->inRandomOrder()
                    ->limit(20);
            })
            ->get();

        return $users;
    }

    public function getCategories($searchStr) {
        $categories = Category::selectRaw('*, search, ts_rank(search, to_tsquery(\'english\', ?)) AS rank', [$searchStr])
            ->when($searchStr, function($query, $searchStr) {
                return $query
                    ->whereRaw('search @@ to_tsquery(\'english\', ?)', [$searchStr])
                    ->orderByDesc('rank');
            }, function($query) {
                return $query
                    ->inRandomOrder()
                    ->limit(20);
            })
            ->get();

        return $categories;
    }

    // public function getGroups($searchStr) {
    //     $groups = Group::selectRaw('*, search, ts_rank(search, to_tsquery(\'english\', ?)) AS rank', [$searchStr])
    //         ->when($searchStr, function($query, $searchStr) {
    //             return $query
    //                 ->whereRaw('search @@ to_tsquery(\'english\', ?)', [$searchStr])
    //                 ->orderByDesc('rank');
    //         }, function($query) {
    //             return $query
    //                 ->inRandomOrder()
    //                 ->limit(20);
    //         })
    //         ->get();

    //     return $groups;
    // }

}
