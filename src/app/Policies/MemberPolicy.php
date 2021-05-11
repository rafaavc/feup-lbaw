<?php

namespace App\Policies;

use App\Models\Member;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class MemberPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\Member $member
     * @return mixed
     */
    public function create(?Member $member)
    {
        return $member == null;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\Member $member
     * @param \App\Models\Member $argument
     * @return mixed
     */
    public function view(?Member $member, Member $argument)
    {
        if (Auth::guard('admin')->check())
            return true;
        if ($argument->visibility === true)
            return true;
        if (!Auth::check())
            return false;
        if ($member->id === $argument->id)
            return true;
        return $argument->followers->where('id', '=', $member->id)->count() == 1;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\Member $member
     * @param \App\Models\Member $argument
     * @return mixed
     */
    public function update(Member $member, Member $argument)
    {
        if (Auth::guard('admin')->check())
            return false;
        if (!Auth::check())
            return false;
        return $member->id === $argument->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\Member $member
     * @param \App\Models\Member $argument
     * @return mixed
     */
    public function delete(Member $member, Member $argument)
    {
        if (Auth::guard('admin')->check())
            return true;
        if (!Auth::check())
            return false;
        return $member->id === $argument->id;
    }
}
