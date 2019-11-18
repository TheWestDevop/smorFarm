<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $categories = Categories::all();
       return response()->json($categories,200);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Categories();

        $category->title = $request->title;
        $category->description = $request->description;

        $category->save();

        $categories = Categories::paginate(5);
        return response()->json($categories,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $category = Categories::findorfail($id);

         return response()->json($category,200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Categories::findorfail($id);
        $category->title = $request->title;
        $category->description  = $request->description;
        $category->save();

        $categories = Categories::paginate(5);
        return response()->json($categories,200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::findorfail($id);
        $category->delete();

        $categories = Categories::paginate(5);
        return response()->json($categories,200);
    }
}
