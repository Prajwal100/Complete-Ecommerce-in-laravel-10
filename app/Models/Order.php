<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Order
     *
     * @property int $id
     * @property string $order_number
     * @property int|null $user_id
     * @property float $sub_total
     * @property int|null $shipping_id
     * @property float|null $coupon
     * @property float $total_amount
     * @property int $quantity
     * @property string $payment_method
     * @property string $payment_status
     * @property string $status
     * @property string $first_name
     * @property string $last_name
     * @property string $email
     * @property string $phone
     * @property string $country
     * @property string|null $post_code
     * @property string $address1
     * @property string|null $address2
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read Collection|Cart[] $cart
     * @property-read int|null $cart_count
     * @property-read Collection|Cart[] $cart_info
     * @property-read int|null $cart_info_count
     * @property-read Shipping|null $shipping
     * @property-read User|null $user
     * @method static Builder|Order newModelQuery()
     * @method static Builder|Order newQuery()
     * @method static Builder|Order query()
     * @method static Builder|Order whereAddress1($value)
     * @method static Builder|Order whereAddress2($value)
     * @method static Builder|Order whereCountry($value)
     * @method static Builder|Order whereCoupon($value)
     * @method static Builder|Order whereCreatedAt($value)
     * @method static Builder|Order whereEmail($value)
     * @method static Builder|Order whereFirstName($value)
     * @method static Builder|Order whereId($value)
     * @method static Builder|Order whereLastName($value)
     * @method static Builder|Order whereOrderNumber($value)
     * @method static Builder|Order wherePaymentMethod($value)
     * @method static Builder|Order wherePaymentStatus($value)
     * @method static Builder|Order wherePhone($value)
     * @method static Builder|Order wherePostCode($value)
     * @method static Builder|Order whereQuantity($value)
     * @method static Builder|Order whereShippingId($value)
     * @method static Builder|Order whereStatus($value)
     * @method static Builder|Order whereSubTotal($value)
     * @method static Builder|Order whereTotalAmount($value)
     * @method static Builder|Order whereUpdatedAt($value)
     * @method static Builder|Order whereUserId($value)
     * @mixin Eloquent
     */
    class Order extends Model
    {
        use HasFactory;

        protected $fillable = [
            'user_id', 'order_number', 'sub_total', 'quantity', 'delivery_charge', 'status', 'total_amount',
            'first_name',
            'last_name', 'country', 'post_code', 'address1', 'address2', 'phone', 'email', 'payment_method',
            'payment_status', 'shipping_id', 'coupon',
        ];

        /**
         * @return HasMany
         */
        public function cart_info(): HasMany
        {
            return $this->hasMany(Cart::class, 'order_id', 'id');
        }

        /**
         * @param $id
         * @return Builder|Builder[]|Collection|Model|null
         */
        public static function getAllOrder($id)
        {
            return Order::with('cart_info')->find($id);
        }

        /**
         * @return int
         */
        public static function countActiveOrder(): int
        {
            $data = Order::count();
            if ($data) {
                return $data;
            }
            return 0;
        }

        /**
         * @return HasMany
         */
        public function cart(): HasMany
        {
            return $this->hasMany(Cart::class);
        }

        public function shipping(): BelongsTo
        {
            return $this->belongsTo(Shipping::class, 'shipping_id');
        }

        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class, 'user_id');
        }

    }
