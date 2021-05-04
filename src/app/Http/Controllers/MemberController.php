<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

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
        return $user;
    }

    public function getRecipes(Member $user)
    {
        //
    }

    public function getReviews(Member $user)
    {
        //
    }

    public function getFavourites(Member $user)
    {
        //
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
