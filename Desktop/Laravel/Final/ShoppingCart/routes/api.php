<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});



Route::get('/products/','ProductsController@index');

Route::get('/cart/add/{product}','ProductsController@addToCart');
Route::get('/cart/show/','ProductsController@showCart');
Route::post('/cart/delete/{product}','ProductsController@deleteFromCart');
Route::post('/cart/update/{product}','ProductsController@updateFromCart');






