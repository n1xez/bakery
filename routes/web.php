<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome');
});

Auth::routes();

Route::resource('shops', 'ShopsController');
Route::resource('products', 'ProductsController');
Route::resource('assortments', 'AssortmentsController');
Route::resource('users', 'UsersController');

Route::get('report', 'ActivityController@index')->name('report');

