<?php

namespace App\Policies;

use App\Models\Member;
use Illuminate\Auth\Access\HandlesAuthorization;

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
    public function view(Member $member, Member $argument)
    {
        return true;
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
        return true;
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
        return true;
    }
}
