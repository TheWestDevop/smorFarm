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

//home page
Route::get('/', function(){return view('welcome')->render();} )->name('home');

//UserController
Route::get('/api/auth/logout','UserController@logout');
Route::post('/api/auth/login','UserController@login');
Route::post('/api/auth/register','UserController@register');

//AdminController
Route::get('/admin/login', function(){return view('admin.login')->render();} )->name('admin-login');
Route::get('/admin/logout','AuthController@logout');
Route::post('/auth/admin/login','AuthController@login');
Route::get('/auth/admin/register','AuthController@register');

//DeliveryController
Route::get('/executor', function(){return view('executor.login')->render();} );
Route::get('/executor/logout','AuthController@executor_logout');
Route::post('/auth/executor/login','AuthController@executor_login');





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

//PreOrderController
Route::post('/api/pre/order/','PreOrderController@store');

//kitchenController

Route::get('/api/kitchen/available','KitchenController@available');
Route::get('/api/kitchen/unavailable','KitchenController@unavailable');
Route::get('/api/kitchen/timeout','KitchenController@unbook');




Auth::routes();


//UserController

Route::middleware('auth')->get('/admin/home','AdminController@index');
Route::middleware('auth')->get('/api/auth/admin/init','AdminController@init');
Route::middleware('auth')->get('/api/auth/init/','UserController@init');




//ProductController
Route::middleware('auth')->get('/admin/products','AdminController@products');
Route::middleware('auth')->post('/api/new/product','ProductController@store');
Route::middleware('auth')->post('/api/update/product/{id}','ProductController@update');
Route::middleware('auth')->get('/api/delete/product/{id}','ProductController@destroy');



//OrderController
Route::middleware('auth')->get('/api/admin/orders','AdminController@orders');
Route::middleware('auth')->get('/api/order/{id}','OrderController@findOnlyOrder');
Route::middleware('auth')->get('/api/user/{id}/order','OrderController@findOrderbyUser');
Route::middleware('auth')->post('/api/user/order/','OrderController@customerstore');
Route::middleware('auth')->post('/api/order/{id}/driver','OrderController@updateDriver');
Route::middleware('auth')->get('/api/order/{id}/delivered','OrderController@update');
Route::middleware('auth')->get('/api/order/{id}/delivered/revised','OrderController@re_update');
Route::middleware('auth')->get('/api/delete/order/{id}','OrderController@destroy');

//PreOrderController
Route::middleware('auth')->get('/api/admin/pre/orders','AdminController@preorders');
Route::middleware('auth')->get('/api/pre/order/{id}','PreOrderController@findOnlyOrder');
Route::middleware('auth')->post('/api/pre/order/{id}/driver','PreOrderController@updateDriver');
Route::middleware('auth')->get('/api/user/{id}/pre/order','PreOrderController@findOrderbyUser');
Route::middleware('auth')->post('/api/user/pre/order/','PreOrderController@customerstore');
Route::middleware('auth')->get('/api/pre/order/{id}/delivered','PreOrderController@updateOrderDelivered');
Route::middleware('auth')->get('/api/pre/order/{id}/delivered/revised','PreOrderController@re_updateOrderDelivered');
Route::middleware('auth')->get('/api/delete/pre/order/{id}','PreOrderController@destroy');

//KitchenController
Route::middleware('auth')->get('/api/admin/kitchens','KitchenController@all');
Route::middleware('auth')->get('/api/kitchen/{id}','KitchenController@show');
Route::middleware('auth')->get('/api/user/kitchen/{name}','KitchenController@user_kitchen');
Route::middleware('auth')->post('/api/add/kitchen','KitchenController@store');
Route::middleware('auth')->post('/api/book/kitchen/','KitchenController@book');
Route::middleware('auth')->post('/api/kitchen/timeout','KitchenController@unbook');
Route::middleware('auth')->get('/api/delete/kitchen/{id}','KitchenController@destroy');

//DeliveriesController
Route::middleware('auth')->get('/api/deliveries/','DeliveriesController@index');
Route::middleware('auth')->get('/api/deliveries/address/{id}','DeliveriesController@findCustomerAddress');

//DriverController
Route::middleware('auth')->get('/api/driver/','DriverController@index');
Route::middleware('auth')->get('/api/driver/avaliable','DriverController@getAvaliable');
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



//NotificationController
Route::middleware('auth')->get('/api/new/order/notification/','NotificationController@notifyOrder');
Route::middleware('auth')->get('/api/user/notification/{id}','NotificationController@index');
Route::middleware('auth')->post('/api/create/notification/','NotificationController@create');
Route::middleware('auth')->get('/api/delete/notification/{id}','NotificationController@destroy');
Route::middleware('auth')->get('/api/update/notification/{id}','NotificationController@update');
Route::middleware('auth')->get('/api/user/{id}/notification','NotificationController@show');

//LocationController
Route::middleware('auth')->get('/api/driver/location/','DriverLocationController@index');
Route::middleware('auth')->post('/api/driver/location/{id}','DriverLocationController@update');

//DeliveryExecutorController
Route::middleware('auth')->get('/executor/home','AdminController@executor_home');
Route::middleware('auth')->get('/api/executor/{token}/new/order/notification/','NotificationController@notifyExecutorOrder');
Route::middleware('auth')->get('/api/auth/executor/init/','AdminController@executor_init');
Route::middleware('auth')->get('/api/executor/{token}/orders','OrderController@executor_order');

