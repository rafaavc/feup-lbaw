<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController
{
    public static function filter(Request $request, $query, $comesFromSearch=false) {
        return $query
            ->when($comesFromSearch ? false : $request->input('sort'), function($query, $sortOrder) {  // in search it is ordered by how well it matches the query
                // TODO
                return $query;
            })
            ->when($request->query('category'), function($query, $category) {
                return $query->where('id_category', '=', $category);
            })
            ->when($request->query('tags'), function($query, $tags) {
                $tagList = explode(',', $tags);
                foreach($tagList as $tag) {
                    $query = $query->whereExists(function($query) use($tag) {
                        $query->select(DB::raw(1))
                            ->from('tb_tag_recipe')
                            ->where('id_tag', '=', $tag)
                            ->whereColumn('id_recipe', 'recipe_id');
                    });
                }
                return $query;
            })
            ->when($request->query('rating'), function($query, $rating) {
                // TODO
                return $query;
            })
            ->when($request->query('ingredient'), function($query, $ingredient) {
                // TODO
                return $query;
            })
            ->when($request->query('date'), function($query, $date) {
                // TODO
                return $query;
            })
            ->when($request->query('duration'), function($query, $duration) {
                // TODO
                return $query;
            })
            ->when($request->query('difficulty'), function($query, $difficulty) {
                // TODO
                return $query;
            });
    }
}


?>
