<?php

namespace App\Http\Controllers;

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
        // Recipes
        $searchStr = preg_replace("/\s+/", " | ", $request->input('searchQuery'));

        $recipes = DB::table('recipes_fts_view')
            ->selectRaw('*, search, ts_rank(search, to_tsquery(\'english\', ?)) AS rank', [$searchStr])
            ->when($searchStr, function($query, $searchStr) {
                return $query
                    ->whereRaw('search @@ to_tsquery(\'english\', ?) AND member_id <> ? AND recipe_visibility(recipe_id, ?) = TRUE', [$searchStr, (Auth::check()) ? Auth::id() : 0, Auth::id()])
                    ->orderByDesc('rank');
            }, function ($query) {
                return $query
                    ->inRandomOrder()
                    ->limit(20);
            })
            ->get();
        return $recipes;
        // return response()->json(['message' => $request->query()]);
    }
}
