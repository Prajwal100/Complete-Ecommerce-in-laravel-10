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
   * Class Tag
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
   * @method static Builder|Tag newModelQuery()
   * @method static Builder|Tag newQuery()
   * @method static Builder|Tag query()
   * @method static Builder|Tag whereCreatedAt($value)
   * @method static Builder|Tag whereId($value)
   * @method static Builder|Tag whereSlug($value)
   * @method static Builder|Tag whereStatus($value)
   * @method static Builder|Tag whereTitle($value)
   * @method static Builder|Tag whereUpdatedAt($value)
   * @mixin Eloquent
   * @method static \Database\Factories\TagFactory factory(...$parameters)
   */
  class Tag extends Model
  {
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'title',
        'slug',
        'status',
    ];

    public function posts(): HasMany
    {
      return $this->hasMany(Post::class);
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
