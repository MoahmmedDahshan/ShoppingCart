<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $items =[];
    public $totalQty;
    public $totalPrice;

    public function __construct($cart = null)
    {
      if ($cart){
          $this->items = $cart->items;
          $this->totalQty = $cart->totalQty;
          $this->totalPrice = $cart->totalPrice;
      }else{
          $this->items = [];
          $this->totalQty = 0;
          $this->totalPrice = 0;
      }
    }

    public function add($product){
        $item = [
            'id'=>$product->id,
            'title'=>$product->title,
            'price'=>$product->price,
            'qty'=>0,
            'image'=>$product->image,
        ];

        if (!array_key_exists($product->id,$this->items)){
            $this->items[$product->id] = $item;
            $this->totalPrice+= $product->price;
            $this->totalQty+= 1;
        }else{
            $this->totalPrice+= $product->price;
            $this->totalQty+= 1;
        }
        $this->items[$product->id]['qty'] +=1;
    }

    public function remove($id){
        if(array_key_exists($id,$this->items)){
            $this->totalQty -= $this->items[$id]['qty'];
            $this->totalPrice -= $this->items[$id]['qty']*$this->items[$id]['price'];
            unset($this->items[$id]);
        }
    }

    public function updateQty($id,$qty){

        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['qty'] * $this->items[$id]['price'];

        $this->items[$id]['qty'] = $qty;

        $this->totalQty += $qty;
        $this->totalPrice += $this->items[$id]['price'] * $qty;


    }
}
