<?php

namespace App\Http\Controllers;

use App\Deliveries;
use App\Driver;
use App\Order;
use App\FastTrackUser;
use App\Profile;
use App\PreOrder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\OrderPlaced;
use App\Mail\OrderDelivered;
use App\Mail\OrderRevised;
use App\Order_Owner;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function executor_order($token)
    {
        $user = User::where('api_token',$token)->first();
        $order= Order::where('driver_name',$user->name)->latest()->paginate();
        return response()->json($order, 200);
    }
    public function customerstore(Request $request)
    {
        $driver = Driver::where('avaliability_status','1')->first();
        $user = User::where('api_token',$request->token)->first();

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

        $order_owner = new Order_Owner();
        $order_owner->order_id = $order->id;
        $order_owner->order_type = 'normal-order';
        $order_owner->name = $request->name;
        $order_owner->address = $request->address;
        $order_owner->apartment = $request->apartment;
        $order_owner->email = $request->email;
        $order_owner->phone = $request->phone;
        $order_owner->note = $request->note;
        $order_owner->save();

        Mail::to($user->email)->send(new OrderPlaced($order));

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

        $order_owner = new Order_Owner();
        $order_owner->order_id = $order->id;
        $order_owner->order_type = 'normal-order';
        $order_owner->name = $request->name;
        $order_owner->address = $request->address;
        $order_owner->apartment = $request->apartment;
        $order_owner->email = $request->email;
        $order_owner->phone = $request->phone;
        $order_owner->note = $request->note;
        $order_owner->save();

        Mail::to($user->email)->send(new OrderPlaced($order));

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
        $user->apartment = $request->apartment;
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

        $order_owner = new Order_Owner();
        $order_owner->order_id = $order->id;
        $order_owner->order_type = 'normal-order';
        $order_owner->name = $request->name_2;
        $order_owner->address = $request->address_2;
        $order_owner->apartment = $request->apartment_2;
        $order_owner->email = $request->email_2;
        $order_owner->phone = $request->phone_2;
        $order_owner->note = $request->note_2;
        $order_owner->save();

       Mail::to($user->email)->send(new OrderPlaced($order));
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

        $order_owner = new Order_Owner();
        $order_owner->order_id = $order->id;
        $order_owner->order_type = 'normal-order';
        $order_owner->name = $request->name_2;
        $order_owner->address = $request->address_2;
        $order_owner->apartment = $request->apartment_2;
        $order_owner->email = $request->email_2;
        $order_owner->phone = $request->phone_2;
        $order_owner->note = $request->note_2;
        $order_owner->save();

        Mail::to($user->email)->send(new OrderPlaced($order));

        

        $u_driver = Driver::where('staff_name',$order->driver_name)->first();
        $u_driver->avaliability_status = 0;
        $u_driver->save();




        return response()->json($order->ticket_id, 200);

    }
    public function show($id)
    {
        $order= Order::where('ticket_id', $id)->first();
         if ($order == null || $order == "") {
             $order = PreOrder::where('ticket_id', $id)->first();
         }
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

    public function updateDriver($id,Request $request)
    {
        $Order = Order::findorfail($id);
        $Order->status = 0;
        $Order->driver_name = $request->driver;
        $Order->save();
        $delivery = Deliveries::where('order_id',$Order->id)->first();
        if ($delivery == null && $delivery == '') {
            $delivery = new Deliveries();
            $delivery->order_id = $Order->id;
            $delivery->driver_name = $request->driver;
            $delivery->status = $Order->status;
            $delivery->save();
        }
            $delivery->order_id = $Order->id;
            $delivery->driver_name = $request->driver ;
            $delivery->status = $Order->status;
            $delivery->save();

            $u_driver = Driver::where('staff_name',$request->driver)->first();
            $u_driver->avaliability_status = 0;
            $u_driver->save();

        return response()->json(['message' => "Order Driver Updated..."], 200);
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

            $user = User::where('name',$Order->user)->first();

            if ($user == "" || $user == null) {
                $user = FastTrackUser::where('name',$Order->user)->first();
            }

            Mail::to($user->email)->send(new OrderDelivered($Order));

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

        $user = User::where('name',$Order->user)->first();

            if ($user == "" || $user == null) {
                $user = FastTrackUser::where('name',$Order->user)->first();
            }

            Mail::to($user->email)->send(new OrderRevised($Order));


        return response()->json(['message' => "Order Updated..."], 200);
    }
    public function destroy($id)
    {
        $Order = Order::findorfail($id);
        $Order->delete();

        return response()->json(['message' => "Order Deleted..."], 200);
    }
}
