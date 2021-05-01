<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\PostCategory
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Post[] $post
 * @property-read int|null $post_count
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
 */
class PostCategory extends Model
{
    protected $fillable = ['title', 'slug', 'status'];

    /**
     * @return HasMany
     */
    public function post(): HasMany
    {
        return $this->hasMany(Post::class, 'post_cat_id', 'id')->where('status', 'active');
    }

    /**
     * @param $slug
     * @return Builder|Model|object|null
     */
    public static function getBlogByCategory($slug)
    {
        return PostCategory::with('post')->where('slug', $slug)->first();
    }
}
