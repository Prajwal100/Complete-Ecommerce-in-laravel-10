<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Shipping extends Model
{
    protected $fillable=['type','price','status'];
}
