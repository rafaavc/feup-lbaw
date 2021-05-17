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
        try {
            $user = Auth::user();
            $group->requests()->attach($user);
            $newState = $group->requests()->where('id_member', $user->id)->first()->pivot->state;
            return response()->json(['message' => 'Success!', 'newState' => $newState], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function cancelRequest(Group $group)
    {
        try {
            $user = Auth::user();
            $group->requests()->detach($user);
            return response()->json(['message' => 'Success!', 'newState' => 'join'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
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

        return response()->json(['message' => 'The member was accepted into the group.', 'html' => view('partials.profile.peopleBoxEntry', [ 'person' => $user, 'group' => $group ])->render()], 200);
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

    public function removeMember(Request $request, Group $group, Member $user)
    {
        $banned = $request->input('banned');

        DB::beginTransaction();

        if ($banned) {
            $group->requests()->updateExistingPivot($user->id, ['state' => 'rejected']);
        } else {
            $group->requests()->detach($user->id);
        }

        $group->members()->detach($user->id);

        DB::commit();

        return response()->json(['message' => 'The member was removed from the group.'], 200);
    }

    public function getMembers(Request $request, Group $group)
    {
        $offset = $request->input('offset');
        $amount = $request->input('amount');
        $html = $request->input('html');
        if ($offset && $amount) {
            $members = $group->members()->skip($offset)->take($amount)->get();
            $count = $group->members()->count() - $offset;
            if ($html) {
                return response()->json([
                    'html' => view('partials.profile.groupMembersListContent', [
                            'groupMembers' => $members,
                            'group' => $group
                        ])->render(),
                    'end' => $count <= $amount
                ], 200);
            } else return $members;
        }
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
