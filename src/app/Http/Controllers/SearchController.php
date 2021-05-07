<?php

namespace App\Http\Controllers;

use App\Models\Member;
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
    public function view()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $searchStr = preg_replace("/\s+/", " | ", $request->input('searchQuery'));

        // Recipes
        $recipes = DB::table('recipes_fts_view')
            ->selectRaw('*, search, ts_rank(search, to_tsquery(\'english\', ?)) AS rank', [$searchStr])
            ->when($searchStr, function($query, $searchStr) {
                if(Auth::guard('admin')->check()) {
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

        // Users
        $users = Member::selectRaw('*, search, ts_rank(search, to_tsquery(\'english\', ?)) AS rank', [$searchStr])
            ->when($searchStr, function($query, $searchStr) {
                return $query
                    ->whereRaw('search @@ to_tsquery(\'english\', ?) AND member_id <> ?', [$searchStr, (Auth::check()) ? Auth::id() : 0])
                    ->orderByDesc('rank');
            }, function($query) {
                return $query
                    ->inRandomOrder()
                    ->limit(20);
            })
            ->get();

        return response()->json([
            'recipes' => $recipes,
            'users' => $users
        ]);
    }
}
