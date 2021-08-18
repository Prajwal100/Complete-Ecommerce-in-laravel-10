<?php

  /**
   * Created by Zoran Shefot Bogoevski.
   */

  namespace App\Models;

  use Carbon\Carbon;
  use Database\Factories\CategoryFactory;
  use Eloquent;
  use Illuminate\Database\Eloquent\Builder;
  use Illuminate\Database\Eloquent\Collection;
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;
  use Illuminate\Database\Eloquent\Relations\BelongsToMany;
  use Illuminate\Database\Eloquent\Relations\HasMany;
  use Illuminate\Database\Eloquent\Relations\HasOne;
  use Kalnoy\Nestedset\NodeTrait;
  use Kalnoy\Nestedset\QueryBuilder;

  /**
   * Class Category
   *
   * @property int $id
   * @property string $title
   * @property string $slug
   * @property int|null $status
   * @property int|null $parent_id
   * @property int|null $_lft
   * @property int|null $_rgt
   * @property Carbon|null $created_at
   * @property Carbon|null $updated_at
   * @property Category|null $category
   * @property Collection|Category[] $categories
   * @package App\Models
   * @property-read int|null $categories_count
   * @property-read Collection|Product[] $products
   * @property-read int|null $products_count
   * @method static Builder|Category newModelQuery()
   * @method static Builder|Category newQuery()
   * @method static Builder|Category query()
   * @method static Builder|Category whereCreatedAt($value)
   * @method static Builder|Category whereId($value)
   * @method static Builder|Category whereLft($value)
   * @method static Builder|Category whereParentId($value)
   * @method static Builder|Category whereRgt($value)
   * @method static Builder|Category whereSlug($value)
   * @method static Builder|Category whereStatus($value)
   * @method static Builder|Category whereTitle($value)
   * @method static Builder|Category whereUpdatedAt($value)
   * @mixin Eloquent
   * @property-read \Kalnoy\Nestedset\Collection|Category[] $children
   * @property-read int|null $children_count
   * @property-read Category|null $parent
   * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
   * @method static QueryBuilder|Category ancestorsAndSelf($id, array $columns = [])
   * @method static QueryBuilder|Category ancestorsOf($id, array $columns = [])
   * @method static QueryBuilder|Category applyNestedSetScope(?string $table = null)
   * @method static QueryBuilder|Category countErrors()
   * @method static QueryBuilder|Category d()
   * @method static QueryBuilder|Category defaultOrder(string $dir = 'asc')
   * @method static QueryBuilder|Category descendantsAndSelf($id, array $columns = [])
   * @method static QueryBuilder|Category descendantsOf($id, array $columns = [], $andSelf = false)
   * @method static CategoryFactory factory(...$parameters)
   * @method static QueryBuilder|Category fixSubtree($root)
   * @method static QueryBuilder|Category fixTree($root = null)
   * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
   * @method static QueryBuilder|Category getNodeData($id, $required = false)
   * @method static QueryBuilder|Category getPlainNodeData($id, $required = false)
   * @method static QueryBuilder|Category getTotalErrors()
   * @method static QueryBuilder|Category hasChildren()
   * @method static QueryBuilder|Category hasParent()
   * @method static QueryBuilder|Category isBroken()
   * @method static QueryBuilder|Category leaves(array $columns = [])
   * @method static QueryBuilder|Category makeGap(int $cut, int $height)
   * @method static QueryBuilder|Category moveNode($key, $position)
   * @method static QueryBuilder|Category orWhereAncestorOf(bool $id, bool $andSelf = false)
   * @method static QueryBuilder|Category orWhereDescendantOf($id)
   * @method static QueryBuilder|Category orWhereNodeBetween($values)
   * @method static QueryBuilder|Category orWhereNotDescendantOf($id)
   * @method static QueryBuilder|Category rebuildSubtree($root, array $data, $delete = false)
   * @method static QueryBuilder|Category rebuildTree(array $data, $delete = false, $root = null)
   * @method static QueryBuilder|Category reversed()
   * @method static QueryBuilder|Category root(array $columns = [])
   * @method static QueryBuilder|Category whereAncestorOf($id, $andSelf = false, $boolean = 'and')
   * @method static QueryBuilder|Category whereAncestorOrSelf($id)
   * @method static QueryBuilder|Category whereDescendantOf($id, $boolean = 'and', $not = false, $andSelf = false)
   * @method static QueryBuilder|Category whereDescendantOrSelf(string $id, string $boolean = 'and', string $not = false)
   * @method static QueryBuilder|Category whereIsAfter($id, $boolean = 'and')
   * @method static QueryBuilder|Category whereIsBefore($id, $boolean = 'and')
   * @method static QueryBuilder|Category whereIsLeaf()
   * @method static QueryBuilder|Category whereIsRoot()
   * @method static QueryBuilder|Category whereNodeBetween($values, $boolean = 'and', $not = false)
   * @method static QueryBuilder|Category whereNotDescendantOf($id)
   * @method static QueryBuilder|Category withDepth(string $as = 'depth')
   * @method static QueryBuilder|Category withoutRoot()
   * @property-read \Kalnoy\Nestedset\Collection|Category[] $child_cat
   * @property-read int|null $child_cat_count
   * @property-read \Kalnoy\Nestedset\Collection|Category[] $childrenCategories
   * @property-read int|null $children_categories_count
   * @property-read Category|null $parent_info
   */
  class Category extends Model
  {
    use HasFactory;
    use NodeTrait;

    protected $table = 'categories';

    protected $casts = [
        'status'    => 'int',
        'parent_id' => 'int',
        '_lft'      => 'int',
        '_rgt'      => 'int',
    ];

    protected $fillable = [
        'title',
        'slug',
        'status',
        'parent_id',
        '_lft',
        '_rgt',
    ];

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
     * @return HasMany
     */
    public function childrenCategories(): HasMany
    {
      return $this->hasMany(Category::class, 'parent_id')->with('categories');
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
      return $this->belongsToMany(Product::class);
    }

    /**
     * @return string
     */
    public static function getTree()
    {
      $categories = self::get()->toTree();
      $traverse = function ($categories, $prefix = '') use (&$traverse, &$allCats) {
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
      $lists = '<li class="list-unstyled">';
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
      $list = '<li class="dropdown-item"><a class="nav-link" href="/categories/'.$node->slug.'">'.$node->title.'</a>';
      if ($node->children()->count() > 0) {
        $list .= '<ul class="dropdown border-0 shadow">';
        foreach ($node->children as $child) {
          $list .= self::renderNodeHP($child);
        }
        $list .= "</ul>";
      }
      $list .= "</li>";
      return $list;
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
     * @return HasOne
     */
    public function parent_info(): HasOne
    {
      return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    /**]
     * @return mixed
     */
    public static function getAllCategory()
    {
      return Category::orderBy('id', 'DESC')->with('parent_info')->paginate(10);
    }

    public function child_cat(): HasMany
    {
      return $this->hasMany(Category::class, 'parent_id', 'id')->where('status', 'active');
    }

    public static function getAllParentWithChild()
    {
      return Category::with('child_cat')->where('parent_id', 1)->where('status', 'active')->orderBy('title',
          'ASC')->get();
    }


  }
