<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Contracts\Pagination\LengthAwarePaginator;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\Relations\HasOne;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\PostComment
     *
     * @property int $id
     * @property int|null $user_id
     * @property int|null $post_id
     * @property string $comment
     * @property string $status
     * @property string|null $replied_comment
     * @property int|null $parent_id
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property-read Post|null $post
     * @property-read Collection|PostComment[] $replies
     * @property-read int|null $replies_count
     * @method static Builder|PostComment newModelQuery()
     * @method static Builder|PostComment newQuery()
     * @method static Builder|PostComment query()
     * @method static Builder|PostComment whereComment($value)
     * @method static Builder|PostComment whereCreatedAt($value)
     * @method static Builder|PostComment whereId($value)
     * @method static Builder|PostComment whereParentId($value)
     * @method static Builder|PostComment wherePostId($value)
     * @method static Builder|PostComment whereRepliedComment($value)
     * @method static Builder|PostComment whereStatus($value)
     * @method static Builder|PostComment whereUpdatedAt($value)
     * @method static Builder|PostComment whereUserId($value)
     * @mixin Eloquent
     * @property-read User|null $user_info
     */
    class PostComment extends Model
    {
        use HasFactory;

        protected $fillable = ['user_id', 'post_id', 'comment', 'replied_comment', 'parent_id', 'status'];

        /**
         * @return HasOne
         */
        public function user_info(): HasOne
        {
            return $this->hasOne(User::class, 'id', 'user_id');
        }

        /**
         * @return LengthAwarePaginator
         */
        public static function getAllComments(): LengthAwarePaginator
        {
            return PostComment::with('user_info')->paginate(10);
        }

        /**
         * @return LengthAwarePaginator
         */
        public static function getAllUserComments(): LengthAwarePaginator
        {
            return PostComment::where('user_id', auth()->user()->id)->with('user_info')->paginate(10);
        }

        /**
         * @return BelongsTo
         */
        public function post(): BelongsTo
        {
            return $this->belongsTo(Post::class);
        }

        /**
         * @return HasMany
         */
        public function replies(): HasMany
        {
            return $this->hasMany(PostComment::class, 'parent_id')->where('status', 'active');
        }
    }
