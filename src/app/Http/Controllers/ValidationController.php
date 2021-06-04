<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Admin;

class ValidationController extends Controller
{
    /**
     * Check non-repeated username.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkRepeatedUsername(Request $request)
    {
        $username = $request->input('username');
        if(Member::where('username', $username)->count() > 0 || Admin::where('username', $username)->count() > 0)
            return response()->json(['message' => 'The selected username already exists!'], 404);
        else
            return response()->json(['message' => 'Succeed!']);
    }

    /**
     * Check non-repeated email.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkRepeatedEmail(Request $request)
    {
        $email = $request->input('email');
        if(Member::where('email', $email)->count() > 0 || Admin::where('email', $email)->count() > 0)
            return response()->json(['message' => 'The selected email already exists!'], 404);
        else
            return response()->json(['message' => 'Succeed!']);
    }
}
