<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['user_id','cart'];
    protected $hidden = ['created_at','created_at'];

    public function orders(){
        return $this->belongsTo('App\Models\User','id','user_id');
    }
}
