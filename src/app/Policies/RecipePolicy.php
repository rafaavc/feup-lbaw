<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\Recipe;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class RecipePolicy
{
    use HandlesAuthorization;

    public function insert(Member $user)
    {
        // Any user can create a new recipe
        return Auth::check();
    }

    public function select(?Member $user, Recipe $recipe)
    {
        // TODO: verify if the recipe was posted in a group and the user is part of it or it is an administrator
        return true;
    }

    public function update(Member $user, Recipe $recipe)
    {
        // Only a recipe owner can update it
        return $user->id == $recipe->author->id;
    }

    public function delete(Member $user, Recipe $recipe)
    {
        // Only recipe card owner and an administrator can delete it
        return $user->id == $recipe->author->id;
    }

    public function addToFavourites(Member $user, Recipe $recipe)
    {
        return !$recipe->membersWhoFavourited->contains($user->id);
    }

    public function removeFromFavourites(Member $user, Recipe $recipe)
    {
        return $recipe->membersWhoFavourited->contains($user->id);
    }
}
