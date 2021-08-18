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
   * Class CategoryProduct
   *
   * @property int $id
   * @property int $product_id
   * @property int $category_id
   * @property Carbon|null $created_at
   * @property Carbon|null $updated_at
   * @property Category $category
   * @property Product $product
   * @package App\Models
   * @method static Builder|CategoryProduct newModelQuery()
   * @method static Builder|CategoryProduct newQuery()
   * @method static Builder|CategoryProduct query()
   * @method static Builder|CategoryProduct whereCategoryId($value)
   * @method static Builder|CategoryProduct whereCreatedAt($value)
   * @method static Builder|CategoryProduct whereId($value)
   * @method static Builder|CategoryProduct whereProductId($value)
   * @method static Builder|CategoryProduct whereUpdatedAt($value)
   * @mixin Eloquent
   */
  class CategoryProduct extends Model
  {
    use HasFactory;

    protected $table = 'category_product';

    protected $casts = [
        'product_id'  => 'int',
        'category_id' => 'int',
    ];

    protected $fillable = [
        'product_id',
        'category_id',
    ];

    public function category(): BelongsTo
    {
      return $this->belongsTo(Category::class);
    }

    public function product(): BelongsTo
    {
      return $this->belongsTo(Product::class);
    }
  }
