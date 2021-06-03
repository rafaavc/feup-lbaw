<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Member;
use App\Models\Recipe;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class RecipePolicy
{
    use HandlesAuthorization;

    public function insert(?Member $user)
    {
        if (Auth::guard('admin')->check())
            return false;
        return Auth::check();
    }

    public function select(?Member $user, Recipe $recipe)
    {
        if (Auth::guard('admin')->check())
            return true;
        if (Auth::check() && $user->id === $recipe->author->id)
            return true;
        if ($recipe->group !== null) {
            if ($recipe->group->visibility == true)
                return true;
            return $recipe->group->members->contains($user->id);
        }
        return $recipe->author->visibility;
    }

    public function update(?Member $user, Recipe $recipe)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $user->id == $recipe->author->id;
    }

    public function delete(?Member $user, Recipe $recipe)
    {
        if (Auth::guard('admin')->check())
            return true;
        if (!Auth::check())
            return false;
        if ($recipe->group != null && $recipe->group->moderators->contains($user->id))
            return true;
        return $user->id == $recipe->author->id;
    }

    public function addToFavourites(?Member $user, Recipe $recipe)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return !$recipe->membersWhoFavourited->contains($user->id);
    }

    public function removeFromFavourites(?Member $user, Recipe $recipe)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $recipe->membersWhoFavourited->contains($user->id);
    }
}
