<?php

namespace App\Http\Controllers;

use App\Product;
use App\Staff;
use App\User;
use Illuminate\Http\Request;



class ProductController extends Controller
{

    public function index()
    {
        $products =  Product::orderBy('created_at','ASC')->paginate(10);
        return response()->json($products, 200);
    }

    public function latestProduct()
    {
        $products =  Product::latest()->paginate(6);
        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $filename = $request->file('image')->getClientOriginalName();
        $request->file("image")->storeAs('public/images/product/', $filename);



        $product =  new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->product_image = $filename;
        $product->price = $request->price;
        $product->price_per_unit = $request->price_per_unit;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->made_in_nigeria = $request->made_in_nigeria;
        $product->discount = $request->discount;
        $product->ordered_quantities = '0';

        $product->save();

        return response()->json(['message' => 'product was successfully saved'], 200);
    }

    public function findByCategory($category)
    {
        $product = Product::where('category_id', $category)->latest()->paginate();
        return response()->json($product, 200);
    }


     public function findByLowDiscount()
     {
        $product = Product::where('discount','>',9)
                            ->latest()->paginate(6);
        return response()->json($product, 200);
     }



     public function trending()
    {
        $product_nigeria = Product::where('ordered_quantities','>',10)
                                     ->where('made_in_nigeria',1)
                                     ->latest()->take(6)->get();
        $product_imported = Product::where('ordered_quantities','>',10)
                                     ->where('made_in_nigeria',0)
                                     ->latest()->take(6)->get();
        return response()->json([
            'nigeria'=>$product_nigeria,
            'imported' => $product_imported
         ], 200);

    }


    public function show($word)
    {
        $stament = '%'.$word.'%';

        $product = Product::where('title','like',$stament)
                           ->orWhere('description','like',$stament)->paginate(10);
        return response()->json($product, 200);
    }

    public function getProduct($id)
    {
        $product = Product::findorfail($id);
        return response()->json($product, 200);
    }


    public function update(Request $request, $id)
    {


        if ($request->file('image')==null || $request->file('image') == "" ) {
            $product =  Product::findorfail($id);
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->price_per_unit = $request->price_per_unit;
            $product->category_id = $request->category_id;
            $product->quantity = $request->quantity;
            $product->made_in_nigeria = $request->made_in_nigeria;
            $product->discount = $request->discount;
            $product->ordered_quantities = '0';

            $product->save();

            return response()->json(['message' => "Product Updated..."], 200);


        }

            $filename = $request->file('image')->getClientOriginalName();
            $request->file("image")->storeAs('public/images/product/', $filename);

            $product =  Product::findorfail($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->product_image = $filename;
        $product->price = $request->price;
        $product->price_per_unit = $request->price_per_unit;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->made_in_nigeria = $request->made_in_nigeria;
        $product->discount = $request->discount;
        $product->ordered_quantities = '0';

        $product->save();

        return response()->json(['message' => "Product Updated..."], 200);

    }

    public function countAll()
    {
        $product = Product::all()->count();
        $user = User::where('usertype','customer')->count();
        $staff = Staff::all()->count();

        return response()->json([
            'products'=>$product,
            'users'=>$user,
            'staffs'=>$staff,

        ], 200);
    }



    public function destroy($id)
    {
        $product = Product::findorfail($id);
        $product->delete();

        return response()->json(['message' => "Product Deleted..."], 200);
    }
}
