<?php

namespace App\Http\Controllers\Auth;

use App\Models\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Exception;

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

        try {
            $user = DB::table('tb_member')
                ->where('username', '=', $request->username)
                ->first();
            if ($user->email !== $request->email) {
                return redirect("/forgot_password")->withErrors(['message' => "The email does not correspond to the username."]);
            }
            } catch (Exception $e) {
                return redirect("/forgot_password")->withErrors(['message' => "There is no user with username " . $request->username . "."]);
            }

        try {

            $token = Str::random(64);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            Mail::send('email.forgot_password', ['token' => $token], function($message) use($request){
                $message->from('tastebudslbaw@gmail.com', 'TasteBuds');
                $message->to($request->email);
                $message->subject('Reset Password');
            });

            return redirect("/login")->with("message", "Reset password link sent to your email.");
        } catch (Exception $e) {
            return redirect("/forgot_password")->withErrors(['message' => $e->getMessage()]);
        }
    }

    public function viewReset($token) {
        return view('auth.reset_password', [
            ['token' => $token]
        ]);
    }

    public function reset(Request $request) {
        $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        try {
            $user = DB::table('tb_member')
                ->where('username', '=', $request->username)
                ->first();
            if ($user->email !== $request->email) {
                return redirect("/login")->withErrors(['message' => "The email does not correspond to the username."]);
            }
        } catch (Exception $e) {
            return redirect("/login")->withErrors(['message' => "There is no user with username " . $request->username . "."]);
        }

        try {

            $updatePassword = DB::table('password_resets')
                                ->where([
                                'email' => $request->email,
                                'token' => $request->token
                                ])
                                ->first();

            if(!$updatePassword){
                return redirect("/login")->withErrors(['message' => "Invalid token."]);
            }

            Member::where('email', '=', $request->email)
            ->where('username', '=', $request->username)
            ->update(['password' => bcrypt($request->password)]);

            DB::table('password_resets')->where(['email'=> $request->email])->delete();

            return redirect("/login")->with("message", "Password has been successfully changed.");
        } catch (Exception $e) {
            return redirect("/login")->withErrors(['message' => $e->getMessage()]);
        }
    }

}
