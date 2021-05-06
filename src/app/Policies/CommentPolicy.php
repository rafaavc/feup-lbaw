<?php

namespace App\Policies;

use App\Models\Member;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function insert(?Member $member) {
        return true;
    }
}
