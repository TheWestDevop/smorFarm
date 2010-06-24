<?php


if (App::environment('production')) {
    URL::forceScheme('https');
}

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function(){
    return view('welcome')->render();
} )->name('home');





Route::get('/api/auth/logout','UserController@logout');
Route::post('/api/auth/login','UserController@login');
Route::post('/api/auth/register','UserController@register');


//CategoriesController
Route::get('/api/all/categories','CategoriesController@index');


//ProductController
Route::get('/api/all/products','ProductController@index');
Route::get('/api/product/{id}','ProductController@getProduct');
Route::get('/api/latest/products','ProductController@latestProduct');
Route::get('/api/product/search/{word}','ProductController@show');
Route::get('/api/all/products/category/{category}','ProductController@findByCategory');
Route::get('/api/all/products/low/discount','ProductController@findByLowDiscount');
Route::get('/api/all/trending/products','ProductController@trending');
Route::get('/api/count','ProductController@countAll');
//OrderController
Route::get('/api/order/verify/{id}','OrderController@show');

Route::post('/api/order/','OrderController@store');


//AdminController
Route::get('/admin/logout','AuthController@logout');
Route::post('/api/auth/admin/login','AuthController@login');
Route::get('/api/auth/admin/register','AuthController@register');

Auth::routes();

//AdminController
Route::middleware('auth')->get('/admin/home','AdminController@index');
Route::middleware('auth')->get('/api/auth/admin/init','AdminController@init');

//UserController
Route::middleware('auth')->get('/api/auth/init','UserController@init');


//ProductController
Route::middleware('auth')->get('/admin/products','AdminController@products');
Route::middleware('auth')->post('/api/new/product','ProductController@store');
Route::middleware('auth')->post('/api/update/product/{id}','ProductController@update');
Route::middleware('auth')->get('/api/delete/product/{id}','ProductController@destroy');



//OrderController
Route::middleware('auth')->get('/api/admin/orders','AdminController@orders');
Route::middleware('auth')->get('/api/order/{id}','OrderController@findOnlyOrder');
Route::middleware('auth')->get('/api/user/{id}/order','OrderController@findOrderbyUser');
Route::middleware('auth')->post('/api/user/{id}/order/','OrderController@customerstore');
Route::middleware('auth')->get('/api/order/{id}/delivered','OrderController@update');
Route::middleware('auth')->get('/api/order/{id}/delivered/revised','OrderController@re_update');
Route::middleware('auth')->get('/api/delete/order/{id}','OrderController@destroy');

//DeliveriesController
Route::middleware('auth')->get('/api/deliveries/','DeliveriesController@index');
Route::middleware('auth')->get('/api/deliveries/address/{id}','DeliveriesController@findCustomerAddress');

//DriverController
Route::middleware('auth')->get('/api/driver/','DriverController@index');
Route::middleware('auth')->post('/api/driver/new','DriverController@store');
Route::middleware('auth')->get('/api/driver/{id}','DriverController@show');
Route::middleware('auth')->get('/api/driver/{id}/info','DriverController@getDriver');
Route::middleware('auth')->post('/api/driver/{id}/update','DriverController@update');
Route::middleware('auth')->post('/api/driver/{id}/delete','DriverController@destroy');



//LogisticsController
Route::middleware('auth')->get('/api/all/logistics/','LogisticsController@index');
Route::middleware('auth')->post('/api/logistics/new','LogisticsController@store');
Route::middleware('auth')->get('/api/logistics/{id}/info','LogisticsController@show');
Route::middleware('auth')->post('/api/logistics/{id}/update','LogisticsController@update');
Route::middleware('auth')->post('/api/logistics/{id}/delete','LogisticsController@destroy');

//StaffController
Route::middleware('auth')->get('/api/all/staff/','StaffController@index');
Route::middleware('auth')->post('/api/staff/new','StaffController@store');
Route::middleware('auth')->get('/api/staff/{id}','StaffController@show');
Route::middleware('auth')->post('/api/staff/{id}/update','StaffController@update');
Route::middleware('auth')->post('/api/staff/{id}/delete','StaffController@destroy');

//UserInfo
Route::middleware('auth')->get('/api/user/{id}','ProfileController@index');
Route::middleware('auth')->post('/api/user/update/{id}','ProfileController@update');

//CustomerController
Route::middleware('auth')->get('/api/all/customer/','CustomerController@index');
Route::middleware('auth')->post('/api/customer/new','CustomerController@store');
Route::middleware('auth')->get('/api/customer/{id}','CustomerController@show');
Route::middleware('auth')->get('/api/customerName/{id}','CustomerController@showName');
Route::middleware('auth')->post('/api/update/customer/{id}/','CustomerController@update');
Route::middleware('auth')->post('/api/customer/{id}/delete','CustomerController@destroy');

Route::middleware('auth')->get('/api/all/fast/user','CustomerController@allFastUser');
Route::middleware('auth')->post('/api/fast/user/{id}/delete','CustomerController@deleteFastUser');

//CategoriesController
Route::middleware('auth')->get('/api/categories','CategoriesController@getAll');
Route::middleware('auth')->post('/api/add/category/','CategoriesController@store');
Route::middleware('auth')->get('/api/delete/category/{id}','CategoriesController@destroy');
Route::middleware('auth')->post('/api/update/category/{id}','CategoriesController@update');
Route::middleware('auth')->get('/api/category/{id}','CategoriesController@show');



