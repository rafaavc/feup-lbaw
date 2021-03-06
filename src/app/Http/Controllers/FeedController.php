<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Tag;

use Illuminate\Support\Facades\Auth;


class FeedController extends Controller
{
    public function view() {

        if (Auth::guard('admin')->check()) {
            $recipes = Recipe::inRandomOrder()
                ->limit(5)
                ->get();

            $trendingRecipes = Recipe::inRandomOrder()
                ->limit(6)
                ->get();
        }else if(!Auth::check()) {
            $recipes = Recipe::inRandomOrder()
                ->whereRaw('recipe_visibility(id, NULL)')
                ->limit(5)
                ->get();

            $trendingRecipes = Recipe::inRandomOrder()
                ->whereRaw('recipe_visibility(id, NULL)')
                ->limit(6)
                ->get();
        }
        else {
            $recipes = Recipe::inRandomOrder()
                ->whereRaw('recipe_visibility(id, :user_id)', ['user_id' => Auth::user()->id])
                ->limit(5)
                ->get();

            $trendingRecipes = Recipe::inRandomOrder()
                ->whereRaw('recipe_visibility(id, :user_id)', ['user_id' => Auth::user()->id])
                ->limit(6)
                ->get();
        }

        $tags = Tag::inRandomOrder()
            ->limit(7)
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
