<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Contracts\Pagination\LengthAwarePaginator;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Product
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
     * @property int $is_featured
     * @property int|null $cat_id
     * @property int|null $child_cat_id
     * @property int|null $brand_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read Collection|Cart[] $carts
     * @property-read int|null $carts_count
     * @property-read Category|null $cat_info
     * @property-read Collection|Product[] $rel_prods
     * @property-read int|null $rel_prods_count
     * @property-read Category|null $sub_cat_info
     * @property-read Collection|Wishlist[] $wishlists
     * @property-read int|null $wishlists_count
     * @method static Builder|Product newModelQuery()
     * @method static Builder|Product newQuery()
     * @method static Builder|Product query()
     * @method static Builder|Product whereBrandId($value)
     * @method static Builder|Product whereCatId($value)
     * @method static Builder|Product whereChildCatId($value)
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
     */
    class Product extends Model
    {
        use HasFactory;

        protected $fillable = [
            'title', 'slug', 'summary', 'description', 'cat_id', 'child_cat_id', 'price', 'brand_id', 'discount',
            'status',
            'photo', 'size', 'stock', 'is_featured', 'condition',
        ];

        /**
         * @return HasOne
         */
        public function cat_info(): HasOne
        {
            return $this->hasOne(Category::class, 'id', 'cat_id');
        }

        /**
         * @return HasOne
         */
        public function sub_cat_info(): HasOne
        {
            return $this->hasOne(Category::class, 'id', 'child_cat_id');
        }

        /**
         * @return LengthAwarePaginator
         */
        public static function getAllProduct(): LengthAwarePaginator
        {
            return Product::with(['cat_info', 'sub_cat_info'])->orderBy('id', 'desc')->paginate(10);
        }

        /**
         * @return HasMany
         */
        public function rel_prods(): HasMany
        {
            return $this->hasMany(Product::class, 'cat_id', 'cat_id')->where('status', 'active')->orderBy('id',
                'DESC')->limit(8);
        }

        /**
         * @return HasMany
         */
        public function getReview(): HasMany
        {
            return $this->hasMany(ProductReview::class, 'product_id', 'id')->with('user_info')->where('status',
                'active')->orderBy('id', 'DESC');
        }

        /**
         * @param $slug
         * @return Builder|Model|object|null
         */
        public static function getProductBySlug($slug)
        {
            return Product::with(['cat_info', 'rel_prods', 'getReview'])->where('slug', $slug)->first();
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
         * @return HasMany
         */
        public function carts(): HasMany
        {
            return $this->hasMany(Cart::class)->whereNotNull('order_id');
        }

        /**
         * @return HasMany
         */
        public function wishlists(): HasMany
        {
            return $this->hasMany(Wishlist::class)->whereNotNull('cart_id');
        }

    }
