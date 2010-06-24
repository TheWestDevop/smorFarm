<?php

namespace App\Http\Controllers;

use App\Profile;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class UserController extends Controller
{



    public function login(Request $request)
    {
        $data = request()->validate([
            'email'=>'required|email',
            'password'=>'required'
            ]);
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'] ])) {
            return response()->json(Auth::user(), 200);
        } else {
            return response()->json(['error' => 401], 200);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(true, 200);
    }
    public function register(Request $request)
    {
        $data = request()->validate([
            'name' => 'required|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|between:7,25',
            'gender' => 'required|max:255',
            ]);
        $user = User::where('email',$data['email'] )->first();

        if (isset($user->id)) {
            return response()->json(['error' => 'email_taken'], 200);
        }

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->usertype = 'customer';
        $user->api_token = Str::random(60);
        $user->password = bcrypt($data['password']);
        $user->save();

        $profile =  new Profile();
        $profile->name = $data['name'];
        $profile->user_id = $user->id;
        $profile->user_image = 'avatar.png';
        $profile->gender = $data['gender'];
        $profile->email = $data['email'];

        $profile->save();

         Auth::login($user);
        return response()->json($user, 200);
    }
    public function init()
    {
        $user = Auth::User();
        return response()->json($user, 200);
    }


}
