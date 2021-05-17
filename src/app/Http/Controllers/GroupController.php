<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Group;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

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

    // ----------------------------------------------------------------
    // API
    // ----------------------------------------------------------------

    public function insert(Request $request)
    {
        //$this->validate($request, GroupController::$validation);

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
                //dd($file);
                //$file->storeAs("public/images/groups/profile/", "$group->id.jpg");

                //$file->storeAs('public/images/groups/profile/' . $group->id, date('mdYHis') . uniqid() . '.' . $file->extension());
            }

            //dd("step3");

            if ($request->hasFile('coverImage')) {
                $file = $request->file('coverImage');
                //$file->storeAs("public/images/groups/cover/", "$group->id.jpeg");
            }



            DB::commit();
            return response()->json(['message' => 'Succeed!', 'group_id' => $group->id], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Invalid Request!'], 400);
        }
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
        //$this->validate($request, GroupController::$validation);

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
        ]);
    }
}
