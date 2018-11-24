<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    /** @var \App\Services\Decoder $decoder */
    $decoder = app(App\Services\Decoder::class);
    $decoder->handle();

    return view('welcome');
});

Route::resource('shops', 'ShopsController');
Route::resource('products', 'ProductsController');
Route::resource('assortments', 'AssortmentsController');
