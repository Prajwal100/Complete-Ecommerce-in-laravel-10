<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Shipping
 *
 * @property int $id
 * @property string $type
 * @property string $price
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Shipping newModelQuery()
 * @method static Builder|Shipping newQuery()
 * @method static Builder|Shipping query()
 * @method static Builder|Shipping whereCreatedAt($value)
 * @method static Builder|Shipping whereId($value)
 * @method static Builder|Shipping wherePrice($value)
 * @method static Builder|Shipping whereStatus($value)
 * @method static Builder|Shipping whereType($value)
 * @method static Builder|Shipping whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Shipping extends Model
{
    protected $fillable = ['type', 'price', 'status'];
}
