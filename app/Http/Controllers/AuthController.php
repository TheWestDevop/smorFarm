<?php

namespace App\Http\Controllers;

use App\Staff;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $data = request()->validate([
            'email'=>'required|email',
            'password'=>'required'
            ]);
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'usertype' => 'Admin' ])) {
            $admin = Auth::user();
            return redirect('/admin/home')->with('admin',$admin);
        } else {
            $error='Invalid username or password.';
            $request->session()->flash('error',$error);
            return redirect('/admin/login');
        }
    }
    public function executor_login(Request $request)
    {
        $data = request()->validate([
            'email'=>'required|email',
            'password'=>'required'
            ]);
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'usertype' => 'delivery_executor'  ])) {
            $user = Auth::user();
            return redirect('/executor/home')->with('executor',$user);
        } else {
            $error='Invalid username or password.';
            $request->session()->flash('error',$error);
            return redirect('/executor/login');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/admin/login');
    }
    public function executor_logout(Request $request)
    {
        Auth::logout();
        return redirect('/executor/login');
    }
    public function register(Request $request)
    {
        $admin = new User();
        $admin->name = "Oyeniyi Adedayo";
        $admin->email = 'ceo@smorfarm.com';
        $admin->usertype = 'Admin';
        $admin->api_token = Str::random(150);
        $admin->password = bcrypt('smorfarm2019');
        $admin->save();
        return redirect('/admin/home')->with('admin',$admin);
    }













}
