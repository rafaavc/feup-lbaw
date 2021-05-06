<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\Member;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;

    public function create(Member $member)
    {
        return true;
    }

    public function view(?Member $member, Group $group)
    {
        return true;
    }

    public function request(Member $member, Group $group)
    {
        return true;
    }

    public function update(Member $member, Group $group)
    {
        return $group->moderators->where('id', '=', $member->id)->count() == 1;
    }

    public function delete(Member $member, Group $group)
    {
        return $group->moderators->where('id', '=', $member->id)->count() == 1;
    }
}

