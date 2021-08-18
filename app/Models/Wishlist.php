<?php

  /**
   * Created by Zoran Shefot Bogoevski.
   */

  namespace App\Models;

  use Carbon\Carbon;
  use Eloquent;
  use Illuminate\Database\Eloquent\Builder;
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;

  /**
   * Class Wishlist
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
   * @property Cart|null $cart
   * @property Product $product
   * @property User|null $user
   * @package App\Models
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
    use HasFactory;

    protected $table = 'wishlists';

    protected $casts = [
        'product_id' => 'int',
        'cart_id'    => 'int',
        'user_id'    => 'int',
        'price'      => 'float',
        'quantity'   => 'int',
        'amount'     => 'float',
    ];

    protected $fillable = [
        'product_id',
        'cart_id',
        'user_id',
        'price',
        'quantity',
        'amount',
    ];

    public function cart(): BelongsTo
    {
      return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
      return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }
  }
