<?php

namespace App\Http\Controllers;


use App\Deliveries;
use App\Driver;
use App\FastTrackUser;
use App\Profile;
use App\User;
use App\PreOrder;
use App\Order_Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Mail\PreOrderPlaced;
use App\Mail\PreOrderDelivered;
use App\Mail\PreOrderRevised;
use Illuminate\Support\Facades\Mail;

class PreOrderController extends Controller
{
    public function customerstore(Request $request)
    {

        $user = User::where('api_token',$request->token)->first();


        $order = new PreOrder();
        $order->Orders = $request->cart;
        $order->payment_id = Str::random(10);
        $order->user = $user->name;
        $order->total = $request->total;
        $order->driver_name = 'No Driver Avaliable';
        $order->date_to_deliver = $request->delivery_date;
        $order->time_to_deliver = $request->delivery_time;
        $order->status = 0;
        $order->ticket_id = Str::random(12);
        $order->user_type = "Registered Customer";
        $order->save();

        $order_owner = new Order_Owner();
        $order_owner->order_id = $order->id;
        $order_owner->order_type = 'pre-order';
        $order_owner->name = $request->name;
        $order_owner->address = $request->address;
        $order_owner->apartment = $request->apartment;
        $order_owner->email = $request->email;
        $order_owner->phone = $request->phone;
        $order_owner->note = $request->note;
        $order_owner->save();

        Mail::to($user->email)->send(new PreOrderPlaced($order));
        return response()->json($order->ticket_id, 200);



    }
    public function store(Request $request)
    {


        $user = new FastTrackUser();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->alt_address = $request->alt_address;
        $user->save();


        $order = new PreOrder();
        $order->Orders = $request->cart;
        $order->payment_id = Str::random(10);
        $order->user = $user->name;
        $order->total = $request->total;
        $order->driver_name = 'No Driver Avaliable';
        $order->date_to_deliver = $request->deliver_date;
        $order->time_to_deliver = $request->deliver_time;
        $order->status = 0;
        $order->ticket_id = Str::random(12);
        $order->user_type = "Fast Track";
        $order->save();

        $order_owner = new Order_Owner();
        $order_owner->order_id = $order->id;
        $order_owner->order_type = 'pre-order';
        $order_owner->name = $request->name;
        $order_owner->address = $request->address;
        $order_owner->apartment = $request->apartment;
        $order_owner->email = $request->email;
        $order_owner->phone = $request->phone;
        $order_owner->note = $request->note;
        $order_owner->save();

        Mail::to($user->email)->send(new PreOrderPlaced($order));

        return response()->json($order->ticket_id, 200);


    }

    public function show($id)
    {
        $order= PreOrder::where('ticket_id', $id)->first();
        return response()->json($order, 200);
    }


    public function findOnlyOrder($id){
        $order= PreOrder::findorfail($id);
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
        $order= PreOrder::where('user',$user->name)->Where('user_type','Registered Customer')->latest()->paginate();
        return response()->json($order, 200);
    }

    public function updateDriver($id,Request $request)
    {
        $Order = PreOrder::findorfail($id);
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

        return response()->json(['message' => "Pre Order Delivery Man Updated"], 200);
    }

    public function updateOrderDelivered($id)
    {
        $Order = PreOrder::findorfail($id);
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

           // Mail::to($user->email)->send(new PreOrderDelivered($Order));

        return response()->json(['message' => "Pre Order Delivered"], 200);
    }
    public function re_updateOrderDelivered($id)
    {
        $Order = PreOrder::findorfail($id);
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

           // Mail::to($user->email)->send(new PreOrderRevised($Order));


        return response()->json(['message' => "Pre Order Revised"], 200);
    }


    public function destroy($id)
    {
        $Order = PreOrder::findorfail($id);
        $Order->delete();

        return response()->json(['message' => "Pre Order Deleted"], 200);
    }
}
