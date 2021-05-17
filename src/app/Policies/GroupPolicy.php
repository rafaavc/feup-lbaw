<?php

namespace App\Policies;

use App\Models\Group;
use App\Models\Member;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class GroupPolicy
{
    use HandlesAuthorization;

    public function create(Member $member)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return true;
    }

    public function view(?Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return true;
        if ($group->visibility === true)
            return true;
        if (!Auth::check())
            return false;
        return $group->members->where('id', '=', $member->id)->count() == 1;
    }

    public function request(Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $group->members->where('id', '=', $member->id)->count() == 0;
    }

    public function post(Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return false;
        return $group->members->where('id', '=', $member->id)->count() == 1;
    }

    public function insert(Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return true;
    }

    public function edit(?Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return false;
        return $group->moderators->where('id', '=', $member->id)->count() == 1;
    }


    public function update(?Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return false;
        return $group->moderators->where('id', '=', $member->id)->count() == 1;
    }

    public function delete(Member $member, Group $group)
    {
        if (Auth::guard('admin')->check())
            return true;
        return $group->moderators->where('id', '=', $member->id)->count() == 1;
    }
}

