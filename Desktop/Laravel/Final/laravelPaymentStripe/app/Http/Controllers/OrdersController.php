<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(){
        $orders = auth()->user()->orders;
        $carts = $orders->transform(function ($cart,$key){
            return unserialize($cart->cart);
        });
        return view('orders.index',compact('carts'));
    }
}
