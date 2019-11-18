<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\FastTrackUser;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fast_track = FastTrackUser::latest()->paginate(20);
        $user_profile = Profile::latest()->paginate(20);

        $user = [
            'fast_track' => $fast_track,
            'r_customer' => $user_profile
        ];
        return response()->json($user, 200);
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
    public function store(Request $request)
    {
        $user = new Profile;
       $user->name = $request->name;
       $user->user_id = $request->user_id;
       $user->address = $request->address;
       $user->alt_address = $request->alt_address;
       $user->gender = $request->gender;
       $user->email = $request->email;
       $user->phone = $request->phone;
       $user->state = $request->state;
       $user->save();
     return response()->json(['message'=>'Customer Updated'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Profile::findorfail($id);
        return response()->json($user, 200);
    }
    public function showName($id)
    {
        $user = User::findorfail($id);
        return response()->json($user, 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $user = Profile::findorfail($id);
       $user->name = $request->name;
       $user->address = $request->address;
       $user->alt_address = $request->alt_address;
       $user->gender = $request->gender;
       $user->email = $request->email;
       $user->phone = $request->phone;
       $user->state = $request->state;
       $user->save();
     return response()->json(['message'=>'Customer Updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorfail($id);
        Profile::where('user_id',$user->id)->delete();
        $user->delete();
    }
    public function deleteFastUser($id)
    {
        $user = FastTrackUser::findorfail($id);
        $user->delete();
    }
}
