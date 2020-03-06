<?php

namespace App\Http\Controllers;

use App\Mail\StaffCreated;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Mail;
class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::latest()->paginate(20);
        return response()->json($staff, 200);
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
        if ($request->file('image')==null || $request->file('image') == "" ) {
            $staff = new Staff();
            $staff->name =  $request->name;
            $staff->phone =  $request->phone;
            $staff->email =  $request->email;
            $staff->gender =  $request->gender;
            $staff->address =  $request->address;
            $staff->state =  $request->state;
            $staff->country =  $request->country;
            $staff->salary =  $request->salary;
            $staff->married_status =  $request->marriage_status;
            $staff->job_title =  $request->job_title;
            $staff->next_of_kin =  $request->next_of_kin;
            $staff->next_of_kin_address =  $request->next_of_kin_address;
            $staff->next_of_kin_phone =  $request->next_of_kin_phone;
            $staff->save();


            if ($staff->job_title == "Driver") {
                $user = new User();
                $user->name = $staff->name;
                $user->usertype = 'delivery_executor';
                $user->api_token = Str::random(150);
                $user->email = $staff->email;
                $user->password = PASSWORD_BCRYPT($staff->phone);
                $user->save();

                Mail::to($user->email)->send(new StaffCreated($user,$staff->phone));

                return response()->json(['message' => "Staff Created..."], 200);
            }
                $user = new User();
                $user->name = $staff->name;
                $user->usertype = 'staff';
                $user->api_token = Str::random(60);
                $user->email = $staff->email;
                $user->password = bcrypt($staff->phone);
                $user->save();

               Mail::to($user->email)->send(new StaffCreated($user,$staff->phone));

                return response()->json(['message' => "Staff Created..."], 200);


            }

            $filename = $request->file('image')->getClientOriginalName();
                $request->file("image")->storeAs('public/images/staff/', $filename);

            $staff = new  Staff();
            $staff->name =  $request->name;
            $staff->img =  $filename;
            $staff->phone =  $request->phone;
            $staff->email =  $request->email;
            $staff->gender =  $request->gender;
            $staff->address =  $request->address;
            $staff->state =  $request->state;
            $staff->country =  $request->country;
            $staff->salary =  $request->salary;
            $staff->married_status =  $request->marriage_status;
            $staff->job_title =  $request->job_title;
            $staff->next_of_kin =  $request->next_of_kin;
            $staff->next_of_kin_address =  $request->next_of_kin_address;
            $staff->next_of_kin_phone =  $request->next_of_kin_phone;
            $staff->save();

            return response()->json(['message' => "Staff Created..."], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::findorfail($id);
        return response()->json($staff, 200);
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
    public function update(Request $request,  $id)
    {

        if ($request->file('image')==null || $request->file('image') == "" ) {
        $staff = Staff::findorfail($id);
        $staff->name =  $request->name;
        $staff->phone =  $request->phone;
        $staff->email =  $request->email;
        $staff->gender =  $request->gender;
        $staff->address =  $request->address;
        $staff->state =  $request->state;
        $staff->country =  $request->country;
        $staff->salary =  $request->salary;
        $staff->married_status =  $request->marriage_status;
            $staff->job_title =  $request->job_title;
            $staff->next_of_kin =  $request->next_of_kin;
            $staff->next_of_kin_address =  $request->next_of_kin_address;
            $staff->next_of_kin_phone =  $request->next_of_kin_phone;
        $staff->save();

            return response()->json(['message' => "Staff Updated..."], 200);


        }

        $filename = $request->file('image')->getClientOriginalName();
            $request->file("image")->storeAs('public/images/staff/', $filename);

        $staff = Staff::findorfail($id);
        $staff->name =  $request->name;
        $staff->img =  $filename;
        $staff->phone =  $request->phone;
        $staff->email =  $request->email;
        $staff->gender =  $request->gender;
        $staff->address =  $request->address;
        $staff->state =  $request->state;
        $staff->country =  $request->country;
        $staff->salary =  $request->salary;
        $staff->married_status =  $request->marriage_status;
            $staff->job_title =  $request->job_title;
            $staff->next_of_kin =  $request->next_of_kin;
            $staff->next_of_kin_address =  $request->next_of_kin_address;
            $staff->next_of_kin_phone =  $request->next_of_kin_phone;
        $staff->save();

        return response()->json(['message' => "Staff Updated..."], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $staff = Staff::findorfail($id);
      $staff->delete();
    }
}
