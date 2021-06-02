<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Member;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        return view('pages.privateMessages');
    }

    /**
     * Get all messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchMessages()
    {
        return Message::with(['sender'])->get();
    }

    /**
     * Store a newly created message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMessage(Request $request, Member $receiver)
    {
        Message::create([
            'text' => $request->input('message'),
            'user' => Auth::user()->id
        ]);

        return response()->json(['message' => 'Succeed!']);
    }
}
