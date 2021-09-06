<?php

  /**
   * Created by Zoran Shefot Bogoevski.
   */

  namespace App\Models;

  use Carbon\Carbon;
  use Eloquent;
  use Illuminate\Database\Eloquent\Builder;
  use Illuminate\Database\Eloquent\Collection;
  use Illuminate\Database\Eloquent\Factories\HasFactory;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Relations\HasMany;

  /**
   * Class PostCategory
   *
   * @property int $id
   * @property string $title
   * @property string $slug
   * @property string $status
   * @property Carbon|null $created_at
   * @property Carbon|null $updated_at
   * @property Collection|Post[] $posts
   * @package App\Models
   * @property-read int|null $posts_count
   * @method static Builder|PostCategory newModelQuery()
   * @method static Builder|PostCategory newQuery()
   * @method static Builder|PostCategory query()
   * @method static Builder|PostCategory whereCreatedAt($value)
   * @method static Builder|PostCategory whereId($value)
   * @method static Builder|PostCategory whereSlug($value)
   * @method static Builder|PostCategory whereStatus($value)
   * @method static Builder|PostCategory whereTitle($value)
   * @method static Builder|PostCategory whereUpdatedAt($value)
   * @mixin Eloquent
   * @method static \Database\Factories\PostCategoryFactory factory(...$parameters)
   */
  class PostCategory extends Model
  {
    use HasFactory;

    protected $table = 'post_categories';

    protected $fillable = [
        'title',
        'slug',
        'status',
    ];

    public function posts(): HasMany
    {
      return $this->hasMany(Post::class, 'post_cat_id');
    }

    /**
     * @param $slug
     * @return Builder|Model|object|null
     */
    public static function getBlogByCategory($slug)
    {
      return PostCategory::with('post')->where('slug', $slug)->first();
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
  }
