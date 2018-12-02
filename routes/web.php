<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    return view('welcome');
});

Route::resource('shops', 'ShopsController');
Route::resource('products', 'ProductsController');
Route::resource('assortments', 'AssortmentsController');

Route::get('report', 'ActivityController@index')->name('report');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
