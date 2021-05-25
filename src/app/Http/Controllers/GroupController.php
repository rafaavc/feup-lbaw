<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Group;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class GroupController extends Controller
{
    protected $table = "tb_group";

    private static $validation = [
        'name' => 'required|string',
        'description' => 'required|string',
        'visibility' => 'required|boolean',
        'profile_photo' => 'nullable|file|image',
        'cover_photo' => 'nullable|file|image'
    ];

    public function deleteGroupProfileImage($group) {
        $groupProfileImagePath = "public/images/groups/profile/" . "$group->id.jpg";
        $hasProfileImage = File::delete(storage_path("app/public/images/groups/profile/" . "$group->id.jpg"));
        if (!$hasProfileImage)
            $groupProfileImagePath = null;
        if ($groupProfileImagePath != null)
            File::delete(storage_path($groupProfileImagePath));
    }

    public function deleteGroupCoverImage($group) {
        $groupCoverImagePath = "public/images/groups/cover/" . "$group->id.jpg";
        $hasCoverImage = File::delete(storage_path("app/public/images/groups/cover/" . "$group->id.jpg"));
        if (!$hasCoverImage)
            $groupCoverImagePath = null;
        if ($groupCoverImagePath != null)
            File::delete(storage_path($groupCoverImagePath));
    }

    public function deleteGroupImages($group)
    {
        $this->deleteGroupProfileImage($group);
        $this->deleteGroupCoverImage($group);
    }

    // ----------------------------------------------------------------
    // API
    // ----------------------------------------------------------------

    public function insert(Request $request)
    {
        $this->validate($request, GroupController::$validation);

        DB::beginTransaction();
        try {
            $group = new Group();

            $group->name = $request->input('name');
            $group->description = $request->input('description');
            $group->visibility = $request->input('visibility');

            $group->save();

            $group->moderators()->sync(Auth::user()->id);
            $group->members()->sync(Auth::user()->id);

            // Handle Group Photos

            if ($request->hasFile('profileImage')) {
                $file = $request->file('profileImage');
                $file->storeAs("public/images/groups/profile/","$group->id.jpg");
            }

            if ($request->hasFile('coverImage')) {
                $file = $request->file('coverImage');
                $file->storeAs("public/images/groups/cover/", "$group->id.jpg");
            }

            DB::commit();
            return response()->json(['message' => 'Succeed!', 'group_id' => $group->id], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Invalid Request!'], 400);
        }
    }

    public function edit(Request $request, Group $group)
    {
        $this->validate($request, GroupController::$validation);

        DB::beginTransaction();
        try {
            $group->name = $request->input('name');
            $group->description = $request->input('description');
            $group->visibility = $request->input('visibility');

            $group->save();

            // Handle Group Photos

            if ($request->hasFile('profileImage')) {
                $file = $request->file('profileImage');
                $file->storeAs("public/images/groups/profile/","$group->id.jpg");
            }

            if ($request->hasFile('coverImage')) {
                $file = $request->file('coverImage');
                $file->storeAs("public/images/groups/cover/", "$group->id.jpg");
            }

            DB::commit();
            return response()->json(['message' => 'Succeed!', 'group_id' => $group->id], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Invalid Request!'], 400);
        }
    }

    public function delete(Group $group) {
        $this->deleteGroupImages($group);

        $group->delete();

        return $group;
    }

    public function post(Request $request, Group $group)
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
        try {
            return view('pages.upsertGroup');
        } catch (\Exception $e) {
            abort(403, 'Database Exception');
        }
    }

    public function createAction(Request $request)
    {
        $this->validate($request, GroupController::$validation);

        try {
            $apiMessage = $this->insert($request);

            if ($apiMessage->status() != 200)
                throw new Exception('Database Exception!');

            return redirect('/group/' . $apiMessage->getOriginalContent()['group_id'])->with('message', 'Group successfully created!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function update(Group $group)
    {
        try {
            return view('pages.upsertGroup', [
                'group' => $this->get($group),
            ]);
        } catch (\Exception $e) {
            abort(403, 'Database Exception');
        }
    }

    public function updateAction(Request $request, Group $group)
    {
        $this->validate($request, GroupController::$validation);

        try {
            $apiMessage = $this->edit($request, $group);

            if ($apiMessage->status() != 200)
                throw new Exception('Database Exception!');

            return redirect('/group/' . $apiMessage->getOriginalContent()['group_id'])->with('message', 'Group successfully updated!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function deleteAction(Group $group)
    {
        $groupName = $group->name;
        $this->delete($group);
        $memberUsername = Auth::user()->username;
        return redirect('/user/' . $memberUsername)->with('message', 'Group "' . $groupName . '" successfully deleted!');
    }

    public function view(Group $group)
    {
        return view('pages.group', [
            'group' => $this->get($group),
            'requests' => $group->requests()->where('state', '=', 'pending')->get()
        ]);
    }
}
