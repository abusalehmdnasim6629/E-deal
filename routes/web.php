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
//front route...........
Route::get('/','HomeController@index');
Route::get('/view-product/{product_id}','HomeController@view_product');
Route::get('/category-by-product/{category_id}','HomeController@view_product_by_category');
Route::get('/manufacture-by-product/{manufacture_id}','HomeController@view_product_by_manufacture');
Route::get('/contact','HomeController@contact');
Route::post('/add-comment','HomeController@add_comment');
Route::post('/search','HomeController@search');

//Cart route...........
Route::post('/add-to-cart/{product_id}','CartController@add_to_cart');
Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-cart/{id}','CartController@delete_cart');
Route::post('/update-cart/{id}','CartController@update_cart');

//Checkout route...........
Route::get('/login-check','CheckoutConteoller@login_check');
Route::post('/customer-registration','CheckoutConteoller@customer_registration');
Route::post('/customer-login','CheckoutConteoller@customer_login');
Route::get('/checkout','CheckoutConteoller@checkout');
Route::get('/customer-logout','CheckoutConteoller@customer_logout');
Route::post('/shipping','CheckoutConteoller@shipping');
Route::get('/payment','CheckoutConteoller@payment');
Route::post('/order-place','CheckoutConteoller@order_place');


//backend route........ 
Route::get('/admin','AdminController@index');
Route::get('/admin-register','AdminController@admin_register');
Route::get('/dashboard','SuperAdminController@index');
Route::get('/logout','SuperAdminController@logout');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::post('/admin-save','AdminController@admin_save');



//category route........ 
Route::get('/add-category','CategoryController@index');
Route::get('/all-category','CategoryController@all_category');
Route::get('/deactive-category/{category_id}','CategoryController@deactive_category');
Route::get('/active-category/{category_id}','CategoryController@active_category');
Route::get('/edit-category/{category_id}','CategoryController@edit_category');
Route::get('/delete-category/{category_id}','CategoryController@delete_category');
Route::post('/save-category','CategoryController@save_category');
Route::post('/update-category/{category_id}','CategoryController@update_category');


//Manufacture route........ 
Route::get('/add-brand','ManufactureController@index');
Route::post('/save-brand','ManufactureController@save_brand');
Route::get('/all-brand','ManufactureController@all_brand');
Route::get('/deactive-brand/{manufacture_id}','ManufactureController@deactive_brand');
Route::get('/active-brand/{manufacture_id}','ManufactureController@active_brand');
Route::get('/edit-brand/{manufacture_id}','ManufactureController@edit_brand');
Route::get('/delete-brand/{manufacture_id}','ManufactureController@delete_brand');
Route::post('/update-brand/{manufacture_id}','ManufactureController@update_brand');

//Product route........ 
Route::get('/add-product','ProductController@index');
Route::post('/save-product','ProductController@save_product');
Route::get('/all-product','ProductController@all_product');
Route::get('/deactive-product/{product_id}','ProductController@deactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/edit-product/{product_id}','ProductController@edit_product');

//Slider route........
Route::get('/add-slider','SliderController@index');
Route::post('/save-slider','SliderController@save_slider');
Route::get('/all-slider','SliderController@all_slider');
Route::get('/deactive-slider/{slider_id}','SliderController@deactive_slider');
Route::get('/active-slider/{slider_id}','SliderController@active_slider');
Route::get('/edit-slider/{slider_id}','SliderController@edit_slider');
Route::get('/delete-slider/{slider_id}','SliderController@delete_slider');


//Manage order route........
Route::get('/manage-order','OrderController@manage_order');
Route::get('/order-details/{order_id}','OrderController@order_details');
Route::get('/delete-order/{order_id}','OrderController@delete_order');





//delivaryman route........
Route::get('/add-delivaryman','DelivarymanController@add_delivaryman');
Route::post('/save-delivaryman','DelivarymanController@save_delivaryman');
Route::get('/all-delivaryman','DelivarymanController@all_delivaryman');
Route::get('/active-delivaryman/{delivaryman_id}','DelivarymanController@active_delivaryman');
Route::get('/deactive-delivaryman/{delivaryman_id}','DelivarymanController@deactive_delivaryman');
Route::get('/delete-delivaryman/{delivaryman_id}','DelivarymanController@delete_delivaryman');


//Customer route........
Route::get('/all-customer','CustomerController@all_customer');
Route::get('/delete-customer/{customer_id}','CustomerController@delete_customer');

//vendor
Route::get('/add-vendor','AdminController@addVendor');
Route::post('/save-vendor','AdminController@saveVendor');
Route::get('/all-vendor','AdminController@all_vendor');
Route::get('/delete-vendor/{vendor_id}','AdminController@delete_vendor');


//purchase
Route::get('/purchase','AdminController@purchase');
Route::post('/add-stock','AdminController@saveStock');
Route::get('/stock','AdminController@all_stock');

//sell
Route::get('/sell','AdminController@sell');
Route::post('/save-sell-info','AdminController@saveSell');
Route::get('/show-sell-info','AdminController@showSellInfo');
Route::post('/sell-info','AdminController@show');
Route::get('/getprice/{txt}','AdminController@getprice');

//cost
Route::get('/add-cost','AdminController@cost');
Route::post('/save-cost','AdminController@save_cost');
Route::get('/all-cost','AdminController@all_cost');

//report
Route::get('/report','AdminController@report');

//discount
Route::get('/getdiscount/{txt}','AdminController@getdiscount');
Route::post('/addpromo','AdminController@addpromo');


//add discount
Route::get('/add-discount','AdminController@add_discount');
Route::post('/save-discount','Admincontroller@save_discount');
Route::get('all-discount','AdminController@all_discount');

//link
Route::get('/add-link','AdminController@link');
Route::post('/save-link','AdminController@save_link');
Route::get('/all-link','AdminController@all_link');
Route::get('/delete-link/{link_id}','AdminController@delete_link');

//company email phone
Route::get('/add-contact','AdminController@add_email_phone');
Route::post('/save-contact','AdminController@save_contact');
Route::get('/all-contact','AdminController@all_contact');


