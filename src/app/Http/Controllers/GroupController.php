<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

    }

    public function decline(Group $group, Member $user)
    {

    }

    public function addModerator(Group $group, Member $user)
    {

    }

    public function removeMember(Group $group, Member $user)
    {

    }

    public function getMembers(Group $group)
    {

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
        $user = Auth::user();
        return view('pages.group', [
            'group' => $this->get($group),
            'canEdit' => Gate::inspect('update', $group)->allowed(),
        ]);
    }
}
