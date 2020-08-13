<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class Shipping extends Model
{
    use LogsActivity;
    protected $fillable=['type','price','status'];
    protected static $logAttributes = ['type', 'price'];
}
