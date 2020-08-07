<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable=['title','slug','status'];

    public static function getProductByBrand($id){
        return Product::where('brand_id',$id)->paginate(10);
    }
}
