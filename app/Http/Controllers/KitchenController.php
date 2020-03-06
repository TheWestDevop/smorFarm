<?php

namespace App\Http\Controllers;

use App\kitchen;
use App\User_Kitchen;
use Illuminate\Http\Request;

class KitchenController extends Controller
{

    public function all()
    {
        $kitchen = kitchen::latest()->paginate();
        return response()->json($kitchen, 200);
    }
    public function available()
    {
        $kitchen = kitchen::where('status',0)->latest()->paginate();
        return response()->json($kitchen, 200);
    }
    public function unavailable()
    {
        $kitchen = kitchen::where('status',1)->latest()->paginate();
        return response()->json($kitchen, 200);
    }

    public function user_kitchen($name)
    {
        $kitchen = User_Kitchen::where('user',$name)->latest()->paginate();
        return response()->json($kitchen, 200);
    }

    public function store(Request $request)
    {
        $filename = $request->file('image')->getClientOriginalName();
        $request->file("image")->storeAs('public/images/product/', $filename);

        $kitchen = new kitchen();
        $kitchen->title = $request->title;
        $kitchen->image = $filename;
        $kitchen->location = $request->location;
        $kitchen->category = $request->category;
        $kitchen->booked_user = '';
        $kitchen->ticket_cost = '';
        $kitchen->time_booked = '';
        $kitchen->time_out = '';
        $kitchen->booking_count = '';
        $kitchen->status = 0;
        $kitchen->save();
        return response()->json($kitchen, 200);
    }
    public function show($id)
    {
        $kitchen = kitchen::where('id',$id)->first();
        return response()->json($kitchen, 200);
    }

    public function book(Request $request)
    {
        $kitchen = kitchen::findorfail($request->kitchen_id);
        
         if($kitchen->status == 1){
            return response()->json(['kitchen'=>'kitchen booked already'], 200);
         }
        $kitchen->booked_user = $request->user;
        $kitchen->ticket_cost = $request->ticket_cost;
        $kitchen->time_booked = $request->time_booked;
        $kitchen->time_out = $request->time_out;
        $kitchen->ticket = $request->ticket_id;
        $kitchen->booking_count += 1;
        $kitchen->status = 1;
        $kitchen->save();

        $user_kitchen = new User_Kitchen();
        $user_kitchen->user = $request->user;
        $user_kitchen->kitchen_name = $kitchen->title;
        $user_kitchen->kitchen_location = $kitchen->location;
        $user_kitchen->ticket = $request->ticket_id;
        $user_kitchen->ticket_cost = $request->ticket_cost;
        $user_kitchen->save();


        return response()->json($kitchen, 200);

    }
    public function unbook(Request $request)
    {


        kitchen::where('time_out',$request->time_out)
                                ->update([
                                    'booked_user' => '',
                                    'time_out' =>'',
                                    'ticket' => '',
                                    'ticket_cost' => '',
                                    'time_booked' => '',
                                    'status' => 0
                                 ]);
        $kitchen = kitchen::where('status',0)->latest()->paginate();
                        
        return response()->json($kitchen, 200);
        

    }

    public function destroy($id)
    {
        $kitchen = kitchen::findorfail($id);
        $kitchen->delete();
    }
}
