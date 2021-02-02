<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    protected $fillable = ['user_id','cart'];
    protected $hidden = ['created_at','created_at'];

    public function user(){
        return $this->belongsTo('App\Models\User','id','user_id');
    }
}
