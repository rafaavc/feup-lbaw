<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Recipe;

class MemberController extends Controller
{
    // ----------------------------------------------------------------
    // API
    // ----------------------------------------------------------------

    public function post(Request $request)
    {
        //
    }

    public function get(Member $user)
    {
        return $user->load('country');
    }

    public function getRecipes(Member $user)
    {
        return $user->recipes;
    }

    public function getReviews(Member $user)
    {
        $reviews = array();
        foreach ($user->comments as $comment) {
            $comment = $comment->load('fatherComments');
            // Reviews are comments that do not have a father
            if (sizeof($comment->fatherComments) == 0)
                $reviews[] = $comment;
        }
        return $reviews;
    }

    public function getFavourites(Member $user)
    {
        return $user->favourites;
    }

    public function getFollowing(Member $user)
    {
        //
    }

    public function getFollowers(Member $user)
    {
        //
    }

    public function getGroups(Member $user)
    {
        //
    }

    public function put(Request $request, Member $user)
    {
        //
    }

    public function remove(Member $user)
    {
        //
    }

    // ----------------------------------------------------------------
    // Pages
    // ----------------------------------------------------------------

    public function readRecipes(Member $user)
    {
        //
    }

    public function readFavourites(Member $user)
    {
        //
    }

    public function readReviews(Member $user)
    {
        //
    }

    public function update(Member $user)
    {
        //
    }

    public function updateAction(Member $user)
    {
        //
    }

    public function deleteAction(Member $user)
    {
        //
    }
}
