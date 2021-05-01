<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Wishlist
 *
 * @property int $id
 * @property int $product_id
 * @property int|null $cart_id
 * @property int|null $user_id
 * @property float $price
 * @property int $quantity
 * @property float $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product $product
 * @method static Builder|Wishlist newModelQuery()
 * @method static Builder|Wishlist newQuery()
 * @method static Builder|Wishlist query()
 * @method static Builder|Wishlist whereAmount($value)
 * @method static Builder|Wishlist whereCartId($value)
 * @method static Builder|Wishlist whereCreatedAt($value)
 * @method static Builder|Wishlist whereId($value)
 * @method static Builder|Wishlist wherePrice($value)
 * @method static Builder|Wishlist whereProductId($value)
 * @method static Builder|Wishlist whereQuantity($value)
 * @method static Builder|Wishlist whereUpdatedAt($value)
 * @method static Builder|Wishlist whereUserId($value)
 * @mixin Eloquent
 */
class Wishlist extends Model
{
    protected $fillable = ['user_id', 'product_id', 'cart_id', 'price', 'amount', 'quantity'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
