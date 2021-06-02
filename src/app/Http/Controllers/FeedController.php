<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FeedController extends Controller
{
    public function view() {

        if(!Auth::check() || Auth::guard('admin')->check()) {
            $recipes = Recipe::inRandomOrder()
                ->whereRaw('recipe_visibility(id, NULL)')
                ->limit(5)
                ->get();
        }
        else {
            // TODO: pass the authenticated user ID in the recipe_visibility call
            $recipes = Recipe::inRandomOrder()
                ->whereRaw('recipe_visibility(id, NULL)')
                ->limit(5)
                ->get();
        }

        $tags = Tag::inRandomOrder()
            ->limit(7)
            ->get();

        $trendingRecipes = Recipe::inRandomOrder()
                ->whereRaw('recipe_visibility(id, NULL)')
                ->limit(6)
                ->get();

        return view('pages.feed', [
            'recipes' => $recipes,
            'tags' => $tags,
            'trendingRecipes' => $trendingRecipes
        ]);
    }

    public function getMoreRecipes() {
        try {

            $recipes = Recipe::inRandomOrder()
                ->whereRaw('recipe_visibility(id, NULL)')
                ->limit(5)
                ->get();

            return response()->json([
                'html' => view('partials.preview.recipe', [
                        'recipe' => $recipes[0],
                    ])->render(),
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid Request!'], 400);
        }

    }
}
