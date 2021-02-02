<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartStorge extends Model
{

    protected $table = 'cart_storges';
    protected $fillable = ['user_id','cart'];
    protected $hidden = ['created_at','created_at'];

}
