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
Route::post('admin/login', 'AdminController@loginAdmin')->name('admin.login');
Route::view('admin/login', 'admin.pages.login')->name('login.admin');
Route::get('admin/logout', 'AdminController@logoutAdmin')->name('admin.logout');

Route::get('getProductType', 'AjaxController@getProductType');
Route::group(['prefix' => 'admin', 'middleware' => 'checkAdmin'], function() {
    Route::view('/', 'admin.pages.index');
    Route::resource('category', 'CategoryController');
    Route::resource('product_type', 'ProductTypeController');
    Route::resource('product', 'ProductController');
    Route::post('updateProduct/{id}','ProductController@update');
    Route::resource('order', 'OrderController');
});

//client
Route::get('/', function () {
    return view('client.pages.index');
});

Route::get('/', 'ClientController@index');

//login bằng facebook
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::post('register', 'UserController@register')->name('register');
Route::get('verify_email', 'UserController@verifyEmail')->name('verify_email');
Route::post('login', 'UserController@login')->name('login');
Route::get('logout', 'UserController@logout')->name('logout');

Route::post('update-password', 'UserController@updatePassword')->name('update_password');

//giỏ hàng
Route::group(['prefix' => 'cart'], function() {
    Route::resource('cart_detail', 'CartController');
    Route::get('add_cart/{id}', 'CartController@add')->name('add_cart');
    Route::get('checkout', 'CartController@checkout')->name('checkout');
    Route::post('order', 'OrderController@store')->name('order');
});