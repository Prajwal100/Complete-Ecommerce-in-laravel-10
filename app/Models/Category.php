<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Support\Carbon;
    use Kalnoy\Nestedset\NodeTrait;

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
     * @property-read Collection|Category[] $child_cat
     * @property-read int|null $child_cat_count
     * @property-read Category|null $parent_info
     * @property-read Collection|Product[] $products
     * @property-read int|null $products_count
     * @property-read Collection|Product[] $sub_products
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
        use NodeTrait;
        use HasFactory;

        protected $fillable = [
            'title',
            'slug',
            'summary',
            'photo',
            'status',
            'is_parent',
            'parent_id',
            'added_by',
        ];

        /**
         * @return string
         */
        public static function getTree()
        {
            $categories = self::get()->toTree();
            $traverse = static function ($categories, $prefix = '') use (&$traverse, &$allCats) {
                foreach ($categories as $category) {
                    $allCats[] = ["title" => $prefix.' '.$category->title, "id" => $category->id];
                    $traverse($category->children, $prefix.'-');
                }
                return $allCats;
            };
            return $traverse($categories);
        }

        /**
         * @return string
         */
        public static function getList(): string
        {
            $categories = self::get()->toTree();
            $lists = '<li class="nav-item dropdown">';
            foreach ($categories as $category) {
                $lists .= self::renderNodeHP($category);
            }
            $lists .= "</li>";
            return $lists;
        }

        /**
         * @param $node
         * @return string
         */
        public static function renderNodeHP($node): string
        {
            $list = '<li class="dropdown"><a href="/category/'.$node->slug.'" class="nav-link dropdown-toggle" id="fifth-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$node->title.'</a>';

            if ($node->children()->count() > 0) {
                $list .= '<ul class="dropdown-menu">';
                foreach ($node->children as $child) {
                    $list .= self::renderNodeHP($child);
                }
                $list .= "</ul>";
            }
            $list .= "</li>";
            return $list;
        }

        /**
         * @return mixed
         */
        public static function nested()
        {
            return Category::whereNull('parent_id')
                ->with('childrenCategories')
                ->get();
        }


        /**
         * @return BelongsTo
         */
        public function category(): BelongsTo
        {
            return $this->belongsTo(Category::class, 'parent_id');
        }

        /**
         * @return HasMany
         */
        public function categories(): HasMany
        {
            return $this->hasMany(Category::class, 'parent_id');
        }

        /**
         * @return BelongsToMany
         */
        public function products(): BelongsToMany
        {
            return $this->belongsToMany(Product::class);
        }

        /**
         * @return HasMany
         */
        public function childrenCategories(): HasMany
        {
            return $this->hasMany(Category::class, 'parent_id')->with('categories');
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
