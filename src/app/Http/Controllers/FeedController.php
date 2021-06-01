<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Recipe;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FeedController extends Controller
{
    public function view() {

        /* if(!Auth::check() || Auth::guard('admin')->check())
            $recipes = [];
        else
            $recipes = Auth::user()->recipes; */

        $recipes = Recipe::inRandomOrder()->limit(5)->get();

        return view('pages.feed', [
            'recipes' => $recipes
        ]);
    }
}
