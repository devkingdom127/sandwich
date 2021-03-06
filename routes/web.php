<?php

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Auth::routes();

Route::get('/delete_order', 'HomeController@delete_order')->name('delete_order');
Route::post('/export_order', 'HomeController@export_order')->name('export_order');
Route::post('/accept_order', 'HomeController@accept_order')->name('accept_order');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout/user', 'HomeController@logout')->name('log_out');

Route::get('/', 'HomepageController@index')->name('index');
Route::post('/login/ajax', 'HomepageController@login_ajax')->name('login_ajax');

Route::get('/register/restaurant', 'HomepageController@restaurant')->name('restaurant');
Route::post('/register/restaurant/post/save', 'HomepageController@restaurant_post')->name('restaurant_post');

Route::get('/register/rider', 'HomepageController@rider')->name('rider');
Route::post('/register/rider/post/save', 'HomepageController@rider_post')->name('rider_post');

Route::get('/post/details/{id?}/{name?}', 'HomepageController@post')->name('post');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/balance_request', 'HomepageController@balance_request')->name('balance_request');
});
