<?php


Route::resource('orders', 'Api\OrderController');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

