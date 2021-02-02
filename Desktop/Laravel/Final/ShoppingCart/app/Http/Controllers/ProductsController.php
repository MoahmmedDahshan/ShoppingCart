<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartStorge;
use App\Models\Products;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index()
    {
        try {
            $products = Products::get();
            return response($products->jsonSerialize(), 200);
        } catch (\Exception $ex) {
            return response(['error' => 'فشلت العملية حاول مجدداً'], 500);
        }
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

        return response(['success' => 'Add product to cart'], 200);

    }

    public function deleteFromCart($id)
    {
        $cart = new Cart(session()->get('cart'));
        $cart->remove($id);
        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        return response(['success' => 'remove product from cart'], 200);

    }

    public function updateFromCart($id, Request $request)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1',
        ]);
        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($id, $request->qty);

        session()->put('cart', $cart);

        return response(['success' => 'Update Qty Successful'], 200);

    }

    public function showCart()
    {
        try {
            if (session()->has('cart')) {
                $cart = new Cart(session()->get('cart'));
                $cart_data = [];
                $cart_data['totalQty'] = $cart->totalQty;
                $cart_data['totalPrice'] = $cart->totalPrice;
                $cart_data['items'] = $cart->items;
                return response($cart_data, 200);

            } else {
                $cart = null;
                return response($cart, 200);
            }

        } catch (\Exception $ex) {
            return response(['error' => 'فشلت العملية حاول مجدداً'], 500);
        }

    }

}
