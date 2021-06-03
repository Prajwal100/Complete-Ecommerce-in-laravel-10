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
     * App\Models\Post
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
     * @property-read Collection|PostComment[] $allComments
     * @property-read int|null $all_comments_count
     * @property-read User|null $author_info
     * @property-read PostCategory|null $cat_info
     * @property-read Collection|PostComment[] $comments
     * @property-read int|null $comments_count
     * @property-read PostTag|null $tag_info
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
     */
    class Post extends Model
    {
        use HasFactory;

        protected $fillable = [
            'title', 'tags', 'summary', 'slug', 'description', 'photo', 'quote', 'post_cat_id', 'post_tag_id',
            'added_by',
            'status',
        ];

        /**
         * @return HasOne
         */
        public function cat_info(): HasOne
        {
            return $this->hasOne(PostCategory::class, 'id', 'post_cat_id');
        }

        /**
         * @return HasOne
         */
        public function tag_info(): HasOne
        {
            return $this->hasOne(PostTag::class, 'id', 'post_tag_id');
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
            return Post::with(['cat_info', 'author_info'])->orderBy('id', 'DESC')->paginate(10);
        }

        /**
         * @param $slug
         * @return Builder|Model|object|null
         */
        public static function getPostBySlug($slug)
        {
            return Post::with(['tag_info', 'author_info'])->where('slug', $slug)->where('status', 'active')->first();
        }

        /**
         * @return HasMany
         */
        public function comments(): HasMany
        {
            return $this->hasMany(PostComment::class)->whereNull('parent_id')->where('status',
                'active')->with('user_info')->orderBy('id', 'DESC');
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
    }
