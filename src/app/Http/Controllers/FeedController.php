<?php

namespace App\Http\Controllers;

use App\Models\Recipe;

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

        return view('pages.feed', [
            'recipes' => $recipes
        ]);
    }

    public function getMoreRecipes(Request $request) {
        try {

            $html = $request->input('html');
            $recipes = Recipe::inRandomOrder()
                ->whereRaw('recipe_visibility(id, NULL)')
                ->limit(5)
                ->get();

            if ($html) {
                return response()->json([
                    'html' => view('partials.preview.recipe', [
                            'recipe' => $recipes[0],
                        ])->render(),
                ], 200);
            } else return $recipes;

            return response()->json(['recipes' => $recipes], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid Request!'], 400);
        }

    }
}
