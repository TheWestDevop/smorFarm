<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Logistics;
use App\Staff;
use Illuminate\Http\Request;

class LogisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ride =  Logistics::paginate(10);
        return response()->json($ride, 200);
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
        
        $logistics =  new Logistics();
        $logistics->title = $request->title;
        $logistics->plate_number = $request->plate_number;
        $logistics->driver_name = $request->staff;
        $logistics->save();

        return response()->json(['message'=>'Saved!!!'], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logistics = Logistics::findorfail($id);
        return response()->json($logistics, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function edit(Bike $bike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
        $logistics =  Logistics::findorfail($id);
        $logistics->title = $request->title;
        $logistics->plate_number = $request->plate_number;
        $logistics->driver_name = $request->staff;
        $logistics->save();

        return response()->json(['message'=>'Updated!!!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bike  $bike
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logistics = Logistics::findorfail($id);
        $logistics->delete();
    }
}
