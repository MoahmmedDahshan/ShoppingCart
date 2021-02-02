<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function store()
    {
        if (session()->has('successPayment')){
            toast(session()->get('successPayment'),'success');

        }
        $latestProducts = Products::latest()->take(3)->get();
        return view('store',compact('latestProducts'));
    }

    public function details($id = null){
        $product = Products::where('id',$id)->first();
        return view('details',compact('product'));
    }
}
