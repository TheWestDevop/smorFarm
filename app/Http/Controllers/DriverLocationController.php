<?php

namespace App\Http\Controllers;

use App\User;
use App\DriverLocation;
use Illuminate\Http\Request;

class DriverLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $location = DriverLocation::latest()->get();
       return response()->json($location, 200);
    }

    public function update(Request $request,$id)
    {   
        $driver = User::findorfail($id);
        $location =  DriverLocation::where('driver_name',$driver->name)->first();
        $location->lat = $request->lat;
        $location->lng = $request->lng;
        $location->save();
        return response()->json(['message'=>'location update'], 200);
    }


    public function destroy(DriverLocation $driverLocation)
    {
        //
    }
}
