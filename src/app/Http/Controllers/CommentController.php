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

        DB::beginTransaction();

        try {
            $hasRating = null != $request->input('rating') || $request->input('rating') == '0';

            if ($hasRating && sizeof(Auth::user()->comments()->where('id_recipe', '=', $request->input('recipeId'))->whereNotNull('rating')->get()) != 0) {
                throw new \Exception("The user has already made a review for the given recipe.");
            }

            $comment = new Comment();

            $comment->text = $request->input('content');
            if ($hasRating) {
                $comment->rating = $request->input('rating');
            }
            $comment->recipe()->associate($request->input('recipeId'));
            $comment->owner()->associate(Auth::user()->id);
            $comment->save();

            if (null != $request->input('parentCommentId'))
                $comment->fatherComments()->sync($request->input('parentCommentId'));

            DB::commit();

            $depth = $request->input('depth');
            if ($depth == null)
                $depth = 0;

            return response()->json(['message' => 'Success!', 'comment' => view('partials.recipe.comment', ['comment' => $comment, 'depth' => $depth])->render(), 'comment_id' => $comment->id], 200);
        } catch(\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage()], 400);
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
