<?php

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

// Frontend site
Route::get('/', 'HomeController@index');

// show catagory use product here
Route::get('/productby_catagory/{catagory_id}', 'HomeController@showproduct_bycatagory');
Route::get('/productby_manufacture/{manufacture_id}', 'HomeController@showproduct_bymanufacture');
Route::get('/view_product/{product_id}', 'HomeController@product_view_details');


//  cart route here
Route::post('/addto_cart', 'CartController@addtocart');
Route::get('/show_cart', 'CartController@showcart');
Route::get('/deleteto_cart/{rowId}', 'CartController@deletetocart');
Route::post('/update_cart', 'CartController@updatecart');


// checkout rout here
Route::get('/login_check', 'CheckoutController@logincheck');
Route::post('/customer_registration', 'CheckoutController@coustomerregistration');
Route::get('/checkout', 'CheckoutController@checkout');
Route::post('/save_shipping_details', 'CheckoutController@saveshippingdetails');
Route::post('/coustomer_login', 'CheckoutController@coustomerlogin');
Route::get('/coustomer_logout', 'CheckoutController@coustomerlogout');

Route::get('/payment', 'CheckoutController@payment');
Route::post('/order_place', 'CheckoutController@orderplace');



// Backend site
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'SuperAdminController@index');
Route::post('/admin_dashboard', 'AdminController@dashboard');
Route::get('/admin_logout', 'SuperAdminController@logout');


// Catagory related route
Route::get('add_catagory', 'CatagoryController@index');
Route::post('save_catagory', 'CatagoryController@savecatagory');
Route::get('all_catagory', 'CatagoryController@allcatagory');
Route::get('unactive_catagory/{catagory_id}', 'CatagoryController@unactivecatagory');
Route::get('active_catagory/{catagory_id}', 'CatagoryController@activecatagory');
Route::get('edit_catagory/{catagory_id}', 'CatagoryController@editcatagory');
Route::post('update_catagory/{catagory_id}', 'CatagoryController@updatecatagory');
Route::get('delete_catagory/{catagory_id}', 'CatagoryController@deletcatagory');


// Manufacture or brand route..
Route::get('/add_manufacture', 'ManufactureController@index');
Route::post('/save_manufacture', 'ManufactureController@savemanufacture');
Route::get('/all_manufacture', 'ManufactureController@allmanufacture');
Route::get('unactive_manufacture/{manufacture_id}', 'ManufactureController@unactivemanufacture');
Route::get('active_manufacture/{manufacture_id}', 'ManufactureController@activemanufacture');
Route::get('edit_manufacture/{manufacture_id}', 'ManufactureController@editmanufacture');
Route::post('update_manufacture/{manufacture_id}', 'ManufactureController@updatemanufacture');
Route::get('delete_manufacture/{manufacture_id}', 'ManufactureController@deletemanufacture');

// products route here
Route::get('add_product', 'ProductController@index');
Route::post('save_product', 'ProductController@saveproduct');
Route::get('all_product', 'ProductController@allproduct');
Route::get('unactive_product/{product_id}', 'ProductController@unactiveproduct');
Route::get('active_product/{product_id}', 'ProductController@activeproduct');
Route::get('edit_product/{product_id}', 'ProductController@editproduct');
Route::post('update_product/{product_id}', 'ProductController@updateproduct');
Route::get('delete_product/{product_id}', 'ProductController@deleteproduct');


// slider routes here
Route::get('add_slider', 'SliderController@index');
Route::post('save_slider', 'SliderController@saveslider');
Route::get('all_slider', 'SliderController@allslider');
Route::get('unactive_slider/{slider_id}', 'SliderController@unactiveslider');
Route::get('active_slider/{slider_id}', 'SliderController@activeslider');
Route::get('delete_slider/{slider_id}', 'SliderController@deleteslider');

// manage order route here
Route::get('manage_order', 'OrderController@manageorder');
Route::get('view_order/{order_id}', 'OrderController@vieworder');
Route::get('delete_order/{order_id}', 'OrderController@deleteorder');
