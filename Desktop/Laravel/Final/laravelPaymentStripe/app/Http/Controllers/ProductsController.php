<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Order;

class ProductsController extends Controller
{

    public function index()
    {
        $products = Products::get();
        return view('products.index', compact('products'));
    }

    public function addToCart(Products $product)
    {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $cart->add($product);
        session()->put('cart', $cart);

//        dd($cart);
        return redirect()->route('products.index')->with('success', 'Product added to cart');
    }

    public function deleteFromCart($id){
        $cart = new Cart(session()->get('cart'));
        $cart->remove($id);
        if ($cart->totalQty <= 0){
            session()->forget('cart');
        }else{
            session()->put('cart',$cart);
        }

        return redirect()->route('cart.show')->with('success', 'Product deleted successful');

    }

    public function updateFromCart($id,Request $request){
        $request->validate([
            'qty'=>'required|numeric|min:1',
        ]);
        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($id,$request->qty);

        session()->put('cart',$cart);

        return redirect()->route('cart.show')->with('success', 'Product Qty Updated Successful');

    }

    public function showCart()
    {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }
        return view('products.cart', compact('cart'));
    }

    public function checkout($amount)
    {
        $totalPrice = $amount;

        return view('products.checkout', compact('totalPrice'));

    }

    public function charge(Request $request)
    {

        $charge = Stripe::charges()->create([
            'amount' => $request->amount,
            'currency' => 'USD',
            'description' => 'Charge Done',
            'source' => $request->stripeToken,
        ]);
        $chargeID = $charge['id'];
        if($chargeID){
            auth()->user()->orders()->create([
                'cart'=>serialize(session()->get('cart'))
            ]);
            session()->forget('cart');
            return redirect()->route('store')->with('successPayment','Payment Done Successful,Tanks..');
        }else{
            return redirect()->back();
        }
    }
}
