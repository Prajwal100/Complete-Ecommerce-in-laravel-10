<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable=['user_id','product_id','cart_id','quantity','amount','price','status'];
    
    public function product(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }
    public static function getAllProductFromCart(){
        return Cart::with('product')->where('user_id',auth()->user()->id)->get();
    }
}
