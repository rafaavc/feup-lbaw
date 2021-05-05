<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    protected $table = 'tb_comment';

    private static $validation = [
        'recipeId' => 'required|integer|exists:App\Models\Recipe,id',
        'content' => 'required|string|max:512',
        'rating' => 'nullable|integer|min:1|max:5'
    ];

    private static $errorMessages = [
        'recipeId.exists' => 'The recipe doesn\'t exist.',
        'content' => 'Invalid content.',
        'rating' => 'Invalid rating.'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), CommentController::$validation, CommentController::$errorMessages);
        if ($validator->fails()) {
            $message = "";
            foreach($validator->messages()->getMessages() as $msgArr) {
                foreach($msgArr as $msg) $message .= $msg." ";
            }
            return response()->json(['message' => $message], 400);
        }
        $this->validate($request, CommentController::$validation, CommentController::$errorMessages);

        DB::beginTransaction();

        try {
            $comment = new Comment();

            $comment->text = $request->input('content');
            if (null != $request->input('rating')) {
                $comment->rating = $request->input('rating');
            }
            $comment->recipe()->associate($request->input('recipeId'));
            $comment->owner()->associate(Auth::user()->id);
            $comment->save();

            DB::commit();
            return response()->json(['message' => 'Success!', 'comment_id' => $comment->id], 200);
        } catch(\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Invalid Request!'], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
