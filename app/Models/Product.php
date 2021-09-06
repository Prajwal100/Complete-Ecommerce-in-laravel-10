<?php

  /**
   * Created by Zoran Shefot Bogoevski.
   */

  namespace App\Models;

  use Carbon\Carbon;
  use Database\Factories\ProductFactory;
  use Eloquent;
  use Illuminate\Database\Eloquent\Builder;
  use Illuminate\Database\Eloquent\Collection;
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;
  use Illuminate\Database\Eloquent\Relations\BelongsToMany;
  use Illuminate\Database\Eloquent\Relations\HasMany;
  use Spatie\Feed\Feedable;
  use Spatie\Feed\FeedItem;

  /**
   * Class Product
   *
   * @property int $id
   * @property string $title
   * @property string $slug
   * @property string $summary
   * @property string|null $description
   * @property string $photo
   * @property int $stock
   * @property string|null $size
   * @property string $condition
   * @property string $status
   * @property float $price
   * @property float $discount
   * @property bool $is_featured
   * @property int|null $brand_id
   * @property Carbon|null $created_at
   * @property Carbon|null $updated_at
   * @property Brand|null $brand
   * @property Collection|Cart[] $carts
   * @property Collection|ProductReview[] $product_reviews
   * @property Collection|Wishlist[] $wishlists
   * @package App\Models
   * @property-read int|null $carts_count
   * @property-read int|null $product_reviews_count
   * @property-read int|null $wishlists_count
   * @method static Builder|Product newModelQuery()
   * @method static Builder|Product newQuery()
   * @method static Builder|Product query()
   * @method static Builder|Product whereBrandId($value)
   * @method static Builder|Product whereCondition($value)
   * @method static Builder|Product whereCreatedAt($value)
   * @method static Builder|Product whereDescription($value)
   * @method static Builder|Product whereDiscount($value)
   * @method static Builder|Product whereId($value)
   * @method static Builder|Product whereIsFeatured($value)
   * @method static Builder|Product wherePhoto($value)
   * @method static Builder|Product wherePrice($value)
   * @method static Builder|Product whereSize($value)
   * @method static Builder|Product whereSlug($value)
   * @method static Builder|Product whereStatus($value)
   * @method static Builder|Product whereStock($value)
   * @method static Builder|Product whereSummary($value)
   * @method static Builder|Product whereTitle($value)
   * @method static Builder|Product whereUpdatedAt($value)
   * @mixin Eloquent
   * @property-read \Kalnoy\Nestedset\Collection|Category[] $categories
   * @property-read int|null $categories_count
   * @method static ProductFactory factory(...$parameters)
   * @property-read string $image_url
   */
  class Product extends Model implements Feedable
  {
    use HasFactory;

    protected $table = 'products';

    protected $casts = [
        'stock'       => 'int',
        'price'       => 'float',
        'discount'    => 'float',
        'is_featured' => 'bool',
        'brand_id'    => 'int',
    ];

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'photo',
        'stock',
        'size',
        'condition',
        'status',
        'price',
        'discount',
        'is_featured',
        'brand_id',
    ];

    public function brand(): BelongsTo
    {
      return $this->belongsTo(Brand::class);
    }

    public function carts(): HasMany
    {
      return $this->hasMany(Cart::class);
    }

    public function product_reviews(): HasMany
    {
      return $this->hasMany(ProductReview::class);
    }

    public function wishlists(): HasMany
    {
      return $this->hasMany(Wishlist::class);
    }

    public function categories(): belongsToMany
    {
      return $this->belongsToMany(Category::class);
    }

    /**
     * @return HasMany
     */
    public function getReview(): HasMany
    {
      return $this->hasMany(ProductReview::class, 'product_id', 'id')->with('user')->where('status',
          'active')->orderBy('id', 'DESC');
    }

    /**
     * @param $slug
     * @return Builder|Model|object|null
     */
    public static function getProductBySlug($slug)
    {
      return Product::with(['getReview', 'categories'])->whereSlug($slug)->firstOrFail();
    }

    /**
     * @return int
     */
    public static function countActiveProduct(): int
    {
      $data = Product::where('status', 'active')->count();
      if ($data) {
        return $data;
      }
      return 0;
    }

    /**
     * @param $slug
     * @return mixed|string
     */
    public function incrementSlug($slug)
    {
      $original = $slug;
      $count = 2;
      while (static::whereSlug($slug)->exists()) {
        $slug = "{$original}-".$count++;
      }
      return $slug;
    }

    /**
     * @return string
     */

    public function getImageUrlAttribute(): ?string
    {
      if (!empty($this->photo)) {
        return asset($this->photo);
      }
      return asset('https://via.placeholder.com/640x480.png/003311?text=et');
    }

    /**
     * @return FeedItem
     */
    public function toFeedItem(): FeedItem
    {
      return FeedItem::create()
          ->id($this->id)
          ->title($this->title)
          ->summary($this->summary)
          ->updated($this->updated_at)
          ->link(route('product-detail', $this->slug))
          ->author('admin');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public static function getFeedItems(): \Illuminate\Support\Collection
    {
      return Product::orderBy('created_at', 'desc')
          ->limit(20)
          ->get();
    }

  }
