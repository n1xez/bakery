<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('shops', 'ShopsController');
Route::resource('products', 'ProductsController');
Route::resource('assortments', 'AssortmentsController');
