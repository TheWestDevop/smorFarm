<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

            $user = User::findorfail($id);
            $profile = Profile::where('user_id', $user->id)->get();

            return response()->json($profile, 200);

    }


    public function update(Request $request,  $id)
    {

            $data = request()->validate([
                'name' => 'required|max:255',
                'email'=>'required|email',
                'address' => 'required|max:255',
                'alt_address' => 'required|max:255',
                'gender' => 'required|max:255',
                'phone' => 'required|max:255',
                'state' => 'required|max:255',

                ]);

                $user = User::findorfail($id);
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = bcrypt($request->password);


                $profile = Profile::where('user_id', $user->id)->first();

                if ($request->file('image')==null || $request->file('image') == "" ) {


                    $profile->name = $data['name'];
                    $profile->gender = $data['gender'];
                    $profile->address = $data['address'];
                    $profile->alt_address = $data['alt_address'];
                    $profile->phone = $data['phone'];
                    $profile->email = $data['email'];
                    $profile->state = $data['state'];

                    $user->update();
                    $profile->update();

                    return response()->json(['message' => "Profile Updated..."], 200);


                }


                   $filename = $request->file('image')->getClientOriginalName();
                   $request->file("image")->storeAs('public/images/users/', $filename);


                    $profile->name = $data['name'];
                    $profile->user_image = $filename;
                    $profile->gender = $data['gender'];
                    $profile->address = $data['address'];
                    $profile->alt_address = $data['alt_gender'];
                    $profile->phone = $data['phone'];
                    $profile->email = $data['email'];
                    $profile->state = $data['state'];

                    $user->update();
                    $profile->update();

                    return response()->json(['message' => "Profile Updated..."], 200);



    }
}
