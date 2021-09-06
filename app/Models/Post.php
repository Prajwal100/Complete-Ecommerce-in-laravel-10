<?php


  /**
   * Created by Zoran Shefot Bogoevski.
   */

  namespace App\Models;

  use Carbon\Carbon;
  use Eloquent;
  use Illuminate\Contracts\Pagination\LengthAwarePaginator;
  use Illuminate\Database\Eloquent\Builder;
  use Illuminate\Database\Eloquent\Collection;
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\BelongsTo;
  use Illuminate\Database\Eloquent\Relations\BelongsToMany;
  use Illuminate\Database\Eloquent\Relations\HasMany;
  use Illuminate\Database\Eloquent\Relations\HasOne;

  /**
   * Class Post
   *
   * @property int $id
   * @property string $title
   * @property string $slug
   * @property string $summary
   * @property string|null $description
   * @property string|null $quote
   * @property string|null $photo
   * @property string|null $tags
   * @property int|null $post_cat_id
   * @property int|null $post_tag_id
   * @property int|null $added_by
   * @property string $status
   * @property Carbon|null $created_at
   * @property Carbon|null $updated_at
   * @property User|null $user
   * @property PostCategory|null $post_category
   * @property Tag|null $post_tag
   * @property Collection|PostComment[] $post_comments
   * @package App\Models
   * @property-read Collection|PostComment[] $allComments
   * @property-read int|null $all_comments_count
   * @property-read User|null $author_info
   * @property-read Collection|PostComment[] $fpost_comments
   * @property-read int|null $fpost_comments_count
   * @method static Builder|Post newModelQuery()
   * @method static Builder|Post newQuery()
   * @method static Builder|Post query()
   * @method static Builder|Post whereAddedBy($value)
   * @method static Builder|Post whereCreatedAt($value)
   * @method static Builder|Post whereDescription($value)
   * @method static Builder|Post whereId($value)
   * @method static Builder|Post wherePhoto($value)
   * @method static Builder|Post wherePostCatId($value)
   * @method static Builder|Post wherePostTagId($value)
   * @method static Builder|Post whereQuote($value)
   * @method static Builder|Post whereSlug($value)
   * @method static Builder|Post whereStatus($value)
   * @method static Builder|Post whereSummary($value)
   * @method static Builder|Post whereTags($value)
   * @method static Builder|Post whereTitle($value)
   * @method static Builder|Post whereUpdatedAt($value)
   * @mixin Eloquent
   * @property-read int|null $post_comments_count
   * @method static \Database\Factories\PostFactory factory(...$parameters)
   * @property-read \Kalnoy\Nestedset\Collection|\App\Models\Category[] $categories
   * @property-read int|null $categories_count
   * @property-read Collection|\App\Models\PostComment[] $comments
   * @property-read int|null $comments_count
   * @property-read string $image_url
   */
  class Post extends Model
  {
    use HasFactory;

    protected $table = 'posts';

    protected $casts = [
        'post_cat_id' => 'int',
        'post_tag_id' => 'int',
        'added_by'    => 'int',
    ];

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'quote',
        'photo',
        'tags',
        'post_cat_id',
        'post_tag_id',
        'added_by',
        'status',
    ];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
      return $this->belongsToMany(Category::class);
    }

    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class, 'added_by');
    }

    public function post_category(): BelongsTo
    {
      return $this->belongsTo(PostCategory::class, 'post_cat_id');
    }

    public function post_tag(): BelongsTo
    {
      return $this->belongsTo(Tag::class);
    }

    public function post_comments(): HasMany
    {
      return $this->hasMany(PostComment::class);
    }

    /**
     * @return HasMany
     */
    public function allComments(): HasMany
    {
      return $this->hasMany(PostComment::class)->where('status', 'active');
    }

    /**
     * @param $slug
     * @return LengthAwarePaginator
     */
    public static function getBlogByTag($slug): LengthAwarePaginator
    {
      return Post::where('tags', $slug)->paginate(8);
    }

    /**
     * @return HasMany
     */
    public function comments(): HasMany
    {
      return $this->hasMany(PostComment::class)->whereNull('parent_id')->orderBy('id', 'DESC');
    }

    /**
     * @param $slug
     * @return Builder|Model
     */
    public static function getPostBySlug($slug)
    {
      return Post::whereSlug($slug)->with('comments')->firstOrFail();
    }

    /**
     * @return int
     */
    public static function countActivePost(): int
    {
      $data = Post::where('status', 'active')->count();
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
    public function author_info(): HasOne
    {
      return $this->hasOne(User::class, 'id', 'added_by');
    }

    /**
     * @return LengthAwarePaginator
     */
    public static function getAllPost(): LengthAwarePaginator
    {
      return Post::with(['author_info', 'categories'])->orderBy('id', 'DESC')->paginate(10);
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

  }
