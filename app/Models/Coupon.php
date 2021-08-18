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

  /**
   * Class Coupon
   *
   * @property int $id
   * @property string $code
   * @property string $type
   * @property float $value
   * @property string $status
   * @property Carbon|null $created_at
   * @property Carbon|null $updated_at
   * @package App\Models
   * @method static Builder|Coupon newModelQuery()
   * @method static Builder|Coupon newQuery()
   * @method static Builder|Coupon query()
   * @method static Builder|Coupon whereCode($value)
   * @method static Builder|Coupon whereCreatedAt($value)
   * @method static Builder|Coupon whereId($value)
   * @method static Builder|Coupon whereStatus($value)
   * @method static Builder|Coupon whereType($value)
   * @method static Builder|Coupon whereUpdatedAt($value)
   * @method static Builder|Coupon whereValue($value)
   * @mixin Eloquent
   * @method static \Database\Factories\CouponFactory factory(...$parameters)
   */
  class Coupon extends Model
  {
    use HasFactory;

    protected $table = 'coupons';

    protected $casts = [
        'value' => 'float',
    ];

    protected $fillable = [
        'code',
        'type',
        'value',
        'status',
    ];

    /**
     * @param $code
     * @return Coupon|Builder|Model|object|null
     */
    public static function findByCode($code)
    {
      return self::where('code', $code)->first();
    }

    /**
     * @param $total
     * @return float|int
     */
    public function discount($total)
    {
      if ($this->type == "fixed") {
        return $this->value;
      } elseif ($this->type == "percent") {
        return ($this->value / 100) * $total;
      } else {
        return 0;
      }
    }
  }
