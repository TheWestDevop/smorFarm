<?php

namespace App\Http\Controllers;

use App\notification;
use App\Order;
use App\Profile;
use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $notification = notification::where('user_id',$id)->latest()->take(5)->get();
        return response()->json($notification, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->user_id == null || $request->user_id == "") {
            $profile = Profile::where('name',$request->user)->first();
            $notification = new notification();
            $notification->read = 0;
            $notification->message = $request->message;
            $notification->user_id = $profile->user_id;
            $notification->save();
            return response()->json($notification, 200);
           }
       $notification = new notification();
       $notification->read = 0;
       $notification->message = $request->message;
       $notification->user_id = $request->user_id;
       $notification->save();

       return response()->json($notification, 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function notifyOrder()
    {
        $notification = Order::where('status',0)->latest()->get(['total','user_type','created_at','ticket_id']);

        $count = Order::where('status',0)->count();
        $notify = ['notification' => $notification, 'count' => $count ];
        return response()->json($notify, 200);
    }
    public function notifyExecutorOrder($token)
    {
        $staff = User::where('api_token',$token)->first();
        $notification = Order::where('status',0)
                               ->where('driver_name',$staff->name)
                               ->latest()
                               ->get(['user','created_at']);
        $count = Order::where('status',0)
                        ->where('driver_name',$staff->name)
                        ->count();
        $notify = ['notification' => $notification, 'count' => $count ];
        return response()->json($notify, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = notification::where('user_id',$id)->where('read',0)->get();
        return response()->json($notification, 200);
    }




    public function update($id)
    {
        $notification = notification::where('user_id',$id)
                                      ->where('read',0)->update(['read' => 1 ]);
        return response()->json($notification, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = notification::findorfail($id);
        $notification->delete();
    }
}
