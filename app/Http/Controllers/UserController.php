<?php

namespace App\Http\Controllers;

use App\Mail\UserRegister;
use App\Profile;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{



    public function login(Request $request)
    {
        $data = request()->validate([
            'email'=>'required|email',
            'password'=>'required'
            ]);
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'usertype' => 'customer'  ])) {
            $user = Auth::user();
            $profile = Profile::where('user_id',$user->id)->first();
            $user_info = ['user' => $user,'profile' => $profile];
            return response()->json($user_info, 200);
        } else {
            return response()->json(['error' => 'invalid Username or Password'], 200);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(true, 200);
    }
    public function register(Request $request)
    {

        $user = User::where('email',$request->email )->first();

        if (isset($user->id)) {
            return response()->json(['error' => 'You have an account with already with this email '.$request->email ], 200);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->usertype = 'customer';
        $user->api_token = Str::random(150);
        $user->password = bcrypt($request->password);
        $user->save();

        $profile =  new Profile();
        $profile->name = $request->name;
        $profile->user_id = $user->id;
        $profile->user_image = 'avatar.png';
        $profile->gender = $request->gender;
        $profile->email = $request->email;

        $profile->save();

        //Mail::to($user->email)->send(new UserRegister($user,$request->password));

         Auth::login($user);
         $user_info = ['user' => $user,'profile' => $profile];
         return response()->json($user_info, 200);
    }
    public function init()
    {
        $user = Auth::User();
        $profile = Profile::where('user_id',$user->id)->first();;
        $user_info = ['user' => $user,'profile' => $profile];
        return response()->json($user_info, 200);
    }


}
