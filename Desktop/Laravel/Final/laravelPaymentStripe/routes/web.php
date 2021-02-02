<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrdersController;

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
    return redirect()->route('store');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/store',[StoreController::class,'store'])->name('store');
    Route::get('/products/',[ProductsController::class,'index'])->name('products.index');
    Route::get('/products/{id}',[StoreController::class,'details'])->name('products.details');
    Route::get('/cart/add/{product}',[ProductsController::class,'addToCart'])->name('cart.add');
    Route::delete('/cart/delete/{product}',[ProductsController::class,'deleteFromCart'])->name('cart.delete');
    Route::post('/cart/update/{product}',[ProductsController::class,'updateFromCart'])->name('cart.update');
    Route::get('/cart/show',[ProductsController::class,'showCart'])->name('cart.show');
    Route::get('/cart/checkout/{amount}',[ProductsController::class,'checkout'])->name('cart.checkout');
    Route::post('/cart/charge',[ProductsController::class,'charge'])->name('cart.charge');
    Route::get('/orders',[OrdersController::class,'index'])->name('order.index');

});
