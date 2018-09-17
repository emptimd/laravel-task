<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('success', 'HomeController@success')->name('success');
Route::get('fail', 'HomeController@fail')->name('fail');


Route::get('checkout', 'CheckoutController@show')->name('checkout');
Route::post('checkout', 'CheckoutController@checkout')->name('checkout');

Route::get('cart', 'CartController@show')->name('cart');
Route::post('cart', 'CartController@add')->name('cart');
Route::delete('cart', 'CartController@remove')->name('cart');