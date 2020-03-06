<?php

namespace App\Http\Controllers;

use App\Order;
use App\PreOrder;
use App\Staff;
use Auth;
use App\User;
use Illuminate\Http\Request;
use App\Profile;


class AdminController extends Controller
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
    public function index()
    {
        $admin = Auth::user();
        return view('admin.main',['admin'=>$admin]);
    }
    public function executor_home()
    {
        $executor = Auth::user();
        return view('executor.main',['executor'=>$executor]);
    }
    public function orders()
    {

        $orders = Order::latest()->paginate(20);
        return response()->json($orders, 200);
    }
    public function preorders()
    {

        $orders = PreOrder::latest()->paginate(20);
        return response()->json($orders, 200);
    }

    public function init()
    {
        $user = Auth::User();
        $profile = Profile::findorfail($user->id)->first();
        $user_info = ['user' => $user,'profile' => $profile];
        return response()->json($user_info, 200);
    }
   public function executor_init()
    {
        $user = Auth::User();
        $profile = Staff::where('email',$user->email)->first();
        $user_info = ['user' => $user,'profile' => $profile];
        return response()->json($user_info, 200);
    }





}
