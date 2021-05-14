<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\Member;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    // ----------------------------------------------------------------
    // API
    // ----------------------------------------------------------------

    public function post(Request $request)
    {

    }

    public function put(Request $request, Group $group)
    {

    }

    public function remove(Group $group)
    {

    }

    public function get(Group $group)
    {
        return $group;
    }

    public function request(Group $group)
    {

    }

    public function accept(Group $group, Member $user)
    {
        if (sizeof($group->requests()->where('id_member', '=', $user->id)->get()) == 0) {
            return response()->json(['message' => 'The member has not made a request to join the group.'], 400);
        }
        DB::beginTransaction();

        $group->requests()->updateExistingPivot($user->id, ['state' => 'accepted']);
        $group->members()->attach($user->id);

        DB::commit();

        return response()->json(['message' => 'The member was accepted into the group.'], 200);
    }

    public function decline(Group $group, Member $user)
    {
        if (sizeof($group->requests()->where('id_member', '=', $user->id)->get()) == 0) {
            return response()->json(['message' => 'The member has not made a request to join the group.'], 400);
        }
        $group->requests()->updateExistingPivot($user->id, ['state' => 'rejected']);

        return response()->json(['message' => 'The join request was rejected.'], 200);
    }

    public function addModerator(Group $group, Member $user)
    {

    }

    public function removeMember(Group $group, Member $user)
    {

    }

    public function getMembers(Group $group)
    {
        return $group->members;
    }

    // ----------------------------------------------------------------
    // Pages
    // ----------------------------------------------------------------

    public function create()
    {

    }

    public function createAction(Request $request)
    {

    }

    public function update(Group $group)
    {

    }

    public function updateAction(Request $request, Group $group)
    {

    }

    public function deleteAction(Group $group)
    {

    }

    public function view(Group $group)
    {
        return view('pages.group', [
            'group' => $this->get($group),
            'requests' => $group->requests()->where('state', '=', 'pending')->get()
        ]);
    }
}
