<?php

Route::get('products', 'ProductAPIController@index');
Route::post('products', 'ProductAPIController@store');
Route::put('products/{products}', 'ProductAPIController@update');
Route::patch('products/{products}', 'ProductAPIController@update');
Route::delete('products/{products}', 'ProductAPIController@destroy');
Route::get('products/{products}', 'ProductAPIController@show');
