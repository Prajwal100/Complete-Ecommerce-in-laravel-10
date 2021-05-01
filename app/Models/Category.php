<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $summary
 * @property string|null $photo
 * @property int $is_parent
 * @property int|null $parent_id
 * @property int|null $added_by
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Category[] $child_cat
 * @property-read int|null $child_cat_count
 * @property-read Category|null $parent_info
 * @property-read \Illuminate\Database\Eloquent\Collection|Product[] $products
 * @property-read int|null $products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Product[] $sub_products
 * @property-read int|null $sub_products_count
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereAddedBy($value)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereIsParent($value)
 * @method static Builder|Category whereParentId($value)
 * @method static Builder|Category wherePhoto($value)
 * @method static Builder|Category whereSlug($value)
 * @method static Builder|Category whereStatus($value)
 * @method static Builder|Category whereSummary($value)
 * @method static Builder|Category whereTitle($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Category extends Model
{
    protected $fillable = ['title', 'slug', 'summary', 'photo', 'status', 'is_parent', 'parent_id', 'added_by'];

    /**
     * @return HasOne
     */
    public function parent_info(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    /**
     * @return mixed
     */
    public static function getAllCategory()
    {
        return Category::orderBy('id', 'DESC')->with('parent_info')->paginate(10);
    }

    /**
     * @param $cat_id
     * @return int
     */
    public static function shiftChild($cat_id): int
    {
        return Category::whereIn('id', $cat_id)->update(['is_parent' => 1]);
    }

    /**
     * @param $id
     * @return Collection
     */
    public static function getChildByParentID($id): Collection
    {
        return Category::where('parent_id', $id)->orderBy('id', 'ASC')->pluck('title', 'id');
    }

    /**
     * @return HasMany
     */
    public function child_cat(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->where('status', 'active');
    }

    /**
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function getAllParentWithChild()
    {
        return Category::with('child_cat')->where('is_parent', 1)->where('status', 'active')->orderBy('title',
            'ASC')->get();
    }

    /**
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'cat_id', 'id')->where('status', 'active');
    }

    /**
     * @return HasMany
     */
    public function sub_products(): HasMany
    {
        return $this->hasMany(Product::class, 'child_cat_id', 'id')->where('status', 'active');
    }

    /**
     * @param $slug
     * @return Builder|Model|object|null
     */
    public static function getProductByCat($slug)
    {
        return Category::with('products')->where('slug', $slug)->first();
    }

    /**
     * @param $slug
     * @return Builder|Model|object|null
     */
    public static function getProductBySubCat($slug)
    {
        return Category::with('sub_products')->where('slug', $slug)->first();
    }

    /**
     * @return int
     */
    public static function countActiveCategory(): int
    {
        $data = Category::where('status', 'active')->count();
        if ($data) {
            return $data;
        }
        return 0;
    }
}
