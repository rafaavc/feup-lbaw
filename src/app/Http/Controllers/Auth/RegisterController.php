<?php

namespace App\Http\Controllers\Auth;

use App\Models\Member;
use App\Http\Controllers\Controller;
use http\Env\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/recipe/1'; // TODO: change to feed

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|unique:tb_member',
            'email' => 'required|string|email|unique:tb_member',
            'password' => 'required|string',
            'name' => 'required|string',
            'countryId' => 'required|integer|exists:App\Models\Country,id',
            'city' => 'nullable|string',
            'profileImage' => 'required|file|image|mimes:jpeg'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $request
     * @return \App\Models\Member
     */
    protected function create(array $request)
    {
        $this->validator($request);

        $member = new Member();
        $member->username = $request['username'];
        $member->email = $request['email'];
        $member->password = bcrypt($request['password']);
        $member->name = $request['name'];
        $member->city = $request['city'];
        $member->country()->associate($request['countryId']);

        $member->save();

        $file = $request['profileImage'];
        $file->storeAs('public/images/people/', $member->id . ".jpeg");

        return $member;
    }
}
