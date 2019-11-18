<?php

namespace App\Http\Controllers;

use App\Deliveries;
use App\Order;
use App\User;
use App\FastTrackUser;
use App\Profile;
use Illuminate\Http\Request;

class DeliveriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->paginate(20);
        return response()->json($orders, 200);
    }


    public function findCustomerAddress($id)
    {
        $order= Order::findorfail($id);
        $user_info = FastTrackUser::where('name',$order->user)->first();

        if ($user_info==null||$user_info=='') {
            $user = User::where('name',$order->user)->first();
            $user_info = Profile::where('id',$user->id)->first();
        }

        return response()->json($user_info, 200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deliveries  $deliveries
     * @return \Illuminate\Http\Response
     */
    public function show(Deliveries $deliveries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deliveries  $deliveries
     * @return \Illuminate\Http\Response
     */
    public function edit(Deliveries $deliveries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deliveries  $deliveries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deliveries $deliveries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deliveries  $deliveries
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deliveries $deliveries)
    {
        //
    }
}
