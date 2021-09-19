<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});

Route::get('/products', 'ProductController@index')->name('products.index');
Route::get('/products/{id}', 'ProductController@show')->name('products.show');
Route::delete('/products/{id}', 'ProductController@destroy')->name('products.destroy');

Route::get('/pharmacies', 'PharmacyController@index')->name('pharmacies.index');
Route::delete('/pharmacies/{id}', 'PharmacyController@destroy')->name('pharmacies.destroy');
