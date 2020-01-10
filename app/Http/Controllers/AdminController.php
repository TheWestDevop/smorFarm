<?php

namespace App\Http\Controllers;

use App\Order;
use App\PreOrder;
use App\Product;
use Auth;
use App\User;
use Illuminate\Http\Request;


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
        return view('main',['admin'=>$admin]);
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
    public function products()
    {
        return view('admin.products', compact(Product::latest()->paginate(20)));
    }
    public function users()
    {
        return view('admin.products', compact(User::latest()->paginate(20)));
    }
    public function init()
    {
        $admin = Auth::User();
        return response()->json($admin, 200);
    }





}
