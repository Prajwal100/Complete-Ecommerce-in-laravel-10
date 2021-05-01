<?php

namespace App\Models;

use Eloquent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\ProductReview
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $product_id
 * @property int $rate
 * @property string|null $review
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ProductReview newModelQuery()
 * @method static Builder|ProductReview newQuery()
 * @method static Builder|ProductReview query()
 * @method static Builder|ProductReview whereCreatedAt($value)
 * @method static Builder|ProductReview whereId($value)
 * @method static Builder|ProductReview whereProductId($value)
 * @method static Builder|ProductReview whereRate($value)
 * @method static Builder|ProductReview whereReview($value)
 * @method static Builder|ProductReview whereStatus($value)
 * @method static Builder|ProductReview whereUpdatedAt($value)
 * @method static Builder|ProductReview whereUserId($value)
 * @mixin Eloquent
 * @property-read \App\Models\User|null $user_info
 */
class ProductReview extends Model
{
    protected $fillable = ['user_id', 'product_id', 'rate', 'review', 'status'];

    /**
     * @return HasOne
     */
    public function user_info(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return LengthAwarePaginator
     */
    public static function getAllReview(): LengthAwarePaginator
    {
        return ProductReview::with('user_info')->paginate(10);
    }

    /**
     * @return LengthAwarePaginator
     */
    public static function getAllUserReview(): LengthAwarePaginator
    {
        return ProductReview::where('user_id', auth()->user()->id)->with('user_info')->paginate(10);
    }

}
