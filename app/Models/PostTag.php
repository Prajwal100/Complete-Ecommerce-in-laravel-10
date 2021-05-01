<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\PostTag
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PostTag newModelQuery()
 * @method static Builder|PostTag newQuery()
 * @method static Builder|PostTag query()
 * @method static Builder|PostTag whereCreatedAt($value)
 * @method static Builder|PostTag whereId($value)
 * @method static Builder|PostTag whereSlug($value)
 * @method static Builder|PostTag whereStatus($value)
 * @method static Builder|PostTag whereTitle($value)
 * @method static Builder|PostTag whereUpdatedAt($value)
 * @mixin Eloquent
 */
class PostTag extends Model
{
    protected $fillable = ['title', 'slug', 'status'];
}
