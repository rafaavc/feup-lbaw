<?php

namespace App\Http\Controllers\Auth;

use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function viewForgot() {
        return view('auth.forgot_password', [

        ]);
    }

    public function forgot(Request $request) {
        $request->validate([
              'email' => 'required|email',
              'username' => 'required|string',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email.forgot_password', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect("/login")->with(['message' => "Reset password link sent to your email."]);
    }

    public function viewReset($token) {
        return view('auth.reset_password', [
            ['token' => $token]
        ]);
    }

    public function reset(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required',
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where([
                            'email' => $request->email,
                            'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
             return redirect("/login")->withErrors(['message' => "Invalid token."]);
        }

        Member::where(['email', '=', $request->email], ['username', '=', $request->username])
                ->update(['password' => bcrypt($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect("/login")->with(['message' => "Password has been successfully changed."]);
    }

}
