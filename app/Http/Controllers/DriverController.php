<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Logistics;
use App\Staff;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driver =  Driver::paginate(10);
        return response()->json($driver, 200);
    }


    public function getAvaliable()
    {
        $driver = Driver::where('avaliability_status',1)->get();
        return response()->json($driver, 200);
    }


    public function store(Request $request)
    {


        $driver =  new Driver();
        $driver->staff_name = $request->staff_id;
        $driver->logistics_id = $request->logistics_id;
        $driver->avaliability_status = 1;
        $driver->save();


        $location =  new DriverLocation();
        $location->driver_name = $driver->staff_name;
        $location->lat = '6.538810011243441';
        $location->lng = '3.4081426833243245';
        $location->save();

        return response()->json($driver, 200);

    }


    public function show($id)
    {
        $driver = Driver::findorfail($id);
        $staff = Staff::where('name',$driver->staff_name)->first();
        $ride = Logistics::where('title',$driver->logistics_id)->first();
        $driver_info = [
           'staff' => $staff,
           'driver' => $driver,
           'ride' => $ride
        ];
        return response()->json($driver_info, 200);
    }


    public function getDriver($id)
    {

        $driver = Driver::where('id',$id)->first();

        $driver_info = [
          'staff' => $driver->staff_name,
          'ride' => $driver->logistics_id
        ];
        return response()->json($driver_info, 200);
    }


    public function update(Request $request, $id)
    {


        $driver = Driver::findorfail($id);
        $driver->logistics_id = $request->logistics_id;
        $driver->avaliability_status = 1;
        $driver->save();

        return response()->json($driver, 200);
    }


    public function destroy($id)
    {
        $driver = Driver::findorfail($id);
        $driver->avaliability_status = 3;
        $driver->logistics_id = '';
        $driver->save();
    }
}
