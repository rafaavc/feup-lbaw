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

    public function view(?Member $member)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\Member $member
     * @param \App\Models\Member $argument
     * @return mixed
     */
    public function viewInfo(?Member $member, Member $argument)
    {
        if (Auth::guard('admin')->check())
            return true;
        if ($argument->visibility === true)
            return true;
        if (!Auth::check())
            return false;
        if ($member->id === $argument->id)
            return true;
        return $argument->followers->where('id', $member->id)->where('state', 'accepted')->count() == 1;
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

    /**
     * Determine whether the user can follow another.
     *
     * @param \App\Models\Member $member
     * @param \App\Models\Member $argument
     * @return mixed
     */
    public function follow(Member $member, Member $argument)
    {
        $followRequest = $member->following()->where('id_followed', $argument->id)->orderByDesc('timestamp')->first();
        $state = null;
        if($followRequest != null)
            $state = $followRequest->pivot->state;
        return !$member->following->contains($argument->id) ||
            ($state == 'rejected');
    }

    /**
     * Determine whether the user can follow another.
     *
     * @param \App\Models\Member $member
     * @param \App\Models\Member $argument
     * @return mixed
     */
    public function deleteFollow(Member $member, Member $argument)
    {
        $followRequest = $member->following()->where('id_followed', $argument->id)->orderByDesc('timestamp')->first();
        $state = null;
        if($followRequest != null)
            $state = $followRequest->pivot->state;
        return $member->following->contains($argument->id) &&
            ($state == 'accepted');
    }
}
