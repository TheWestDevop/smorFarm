<?php

namespace App\Http\Controllers;

use App\Deliveries;
use App\Driver;
use App\Order;
use App\FastTrackUser;
use App\Profile;
use App\Staff;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function customerstore($id,Request $request)
    {
        $driver = Driver::where('avaliability_status','1')->first();
        $user = User::where('id',$id)->first();

        if ($driver === null) {
        $order = new Order();
        $order->Orders = $request->cart;
        $order->payment_id = Str::random(10);
        $order->user = $user->name;
        $order->total = $request->total;
        $order->driver_name = 'No Driver Avaliable';
        $order->status = 0;
        $order->ticket_id = Str::random(12);
        $order->user_type = "Registered Customer";
        $order->save();

        return response()->json($order->ticket_id, 200);

        }





        $order = new Order();
        $order->Orders = $request->cart;
        $order->payment_id = Str::random(10);
        $order->user = $user->name;
        $order->total = $request->total;
        $order->driver_name = $driver->staff_name;
        $order->status = 0;
        $order->ticket_id = Str::random(12);
        $order->user_type = "Registered Customer";
        $order->save();

        $u_driver = Driver::where('staff_name',$order->driver_name)->first();
        $u_driver->avaliability_status = 0;
        $u_driver->save();

        return response()->json($order->ticket_id, 200);

    }
    public function store(Request $request)
    {
        $driver = Driver::where('avaliability_status','1')->first();

        $user = new FastTrackUser();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->alt_address = $request->alt_address;
        $user->save();

        if ($driver === null) {
        $order = new Order();
        $order->Orders = $request->cart;
        $order->payment_id = Str::random(10);
        $order->user = $user->name;
        $order->total = $request->total;
        $order->driver_name = 'No Driver Avaliable';
        $order->status = 0;
        $order->ticket_id = Str::random(12);
        $order->user_type = "Fast Track";
        $order->save();

        return response()->json($order->ticket_id, 200);
         }




        $order = new Order();
        $order->Orders = $request->cart;
        $order->payment_id = Str::random(10);
        $order->user = $user->name;
        $order->total = $request->total;
        $order->driver_name = $driver->staff_name;
        $order->status = 0;
        $order->ticket_id = Str::random(12);
        $order->user_type = "Fast Track";

        $order->save();

        $u_driver = Driver::where('staff_name',$order->driver_name)->first();
        $u_driver->avaliability_status = 0;
        $u_driver->save();




        return response()->json($order->ticket_id, 200);

    }

    public function show($id)
    {
        $order= Order::where('ticket_id', $id)->first();
        return response()->json($order, 200);
    }


    public function findOnlyOrder($id){
        $order= Order::findorfail($id);
        $user_info = FastTrackUser::where('name',$order->user)->first();

        if ($user_info==null||$user_info=='') {
            $user = User::where('name',$order->user)->first();
            $user_info = Profile::where('user_id',$user->id)->first();
        }


       $order_info = [
            'order'=> $order,
            'user'=>$user_info,
            'driver'=>$order->driver_name
       ];
        return response()->json($order_info, 200);
    }
    public function findOrderbyUser($id){
        $user = User::findorfail($id);
        $order= Order::where('user',$user->name)->Where('user_type','Registered Customer')->latest()->paginate();
        return response()->json($order, 200);
    }


    public function update($id)
    {
        $Order = Order::findorfail($id);
        $Order->status = 1;
        $Order->save();
        $delivery = Deliveries::where('order_id',$Order->id)->first();
        if ($delivery == null && $delivery == '') {
            $delivery = new Deliveries();
            $delivery->order_id = $Order->id;
            $delivery->driver_name = $Order->driver_name;
            $delivery->status = $Order->status;
            $delivery->save();
        }
            $delivery->order_id = $Order->id;
            $delivery->driver_name = $Order->driver_name;
            $delivery->status = $Order->status;
            $delivery->save();

            $u_driver = Driver::where('staff_name',$Order->driver_name)->first();
            $u_driver->avaliability_status = 1;
            $u_driver->save();

        return response()->json(['message' => "Order Updated..."], 200);
    }
    public function re_update($id)
    {
        $Order = Order::findorfail($id);
        $Order->status = 0;
        $Order->save();

        $delivery = Deliveries::where('order_id',$Order->id)->first();
        $delivery->status = 0;
        $delivery->save();


        $u_driver = Driver::where('staff_name',$Order->driver_name)->first();
        $u_driver->avaliability_status = 0;
        $u_driver->save();


        return response()->json(['message' => "Order Updated..."], 200);
    }


    public function destroy($id)
    {
        $Order = Order::findorfail($id);
        $Order->delete();

        return response()->json(['message' => "Order Deleted..."], 200);
    }
}
