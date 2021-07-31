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
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Spatie\Permission\Traits\HasRoles;

    /**
     * Class User
     *
     * @property int $id
     * @property string $name
     * @property string|null $email
     * @property Carbon|null $email_verified_at
     * @property string|null $password
     * @property string|null $photo
     * @property string|null $provider
     * @property string|null $provider_id
     * @property string $status
     * @property string|null $remember_token
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @property Collection|Cart[] $carts
     * @property Collection|Order[] $orders
     * @property Collection|PostComment[] $post_comments
     * @property Collection|Post[] $posts
     * @property Collection|ProductReview[] $product_reviews
     * @property Collection|Wishlist[] $wishlists
     * @package App\Models
     * @property-read int|null $carts_count
     * @property-read int|null $orders_count
     * @property-read int|null $post_comments_count
     * @property-read int|null $posts_count
     * @property-read int|null $product_reviews_count
     * @property-read int|null $wishlists_count
     * @method static Builder|User newModelQuery()
     * @method static Builder|User newQuery()
     * @method static Builder|User query()
     * @method static Builder|User whereCreatedAt($value)
     * @method static Builder|User whereEmail($value)
     * @method static Builder|User whereEmailVerifiedAt($value)
     * @method static Builder|User whereId($value)
     * @method static Builder|User whereName($value)
     * @method static Builder|User wherePassword($value)
     * @method static Builder|User wherePhoto($value)
     * @method static Builder|User whereProvider($value)
     * @method static Builder|User whereProviderId($value)
     * @method static Builder|User whereRememberToken($value)
     * @method static Builder|User whereStatus($value)
     * @method static Builder|User whereUpdatedAt($value)
     * @mixin Eloquent
     * @property-read Collection|\Spatie\Permission\Models\Permission[] $permissions
     * @property-read int|null $permissions_count
     * @property-read Collection|\Spatie\Permission\Models\Role[] $roles
     * @property-read int|null $roles_count
     * @method static \Database\Factories\UserFactory factory(...$parameters)
     * @method static Builder|User permission($permissions)
     * @method static Builder|User role($roles, $guard = null)
     */
    class User extends Authenticatable
    {
        use HasFactory;
        use HasRoles;

        protected $table = 'users';

        protected $dates = [
            'email_verified_at',
        ];

        protected $hidden = [
            'password',
            'remember_token',
        ];

        protected $fillable = [
            'name',
            'email',
            'email_verified_at',
            'password',
            'photo',
            'provider',
            'provider_id',
            'status',
            'remember_token',
        ];

        public function carts(): HasMany
        {
            return $this->hasMany(Cart::class);
        }

        public function orders(): HasMany
        {
            return $this->hasMany(Order::class);
        }

        public function post_comments(): HasMany
        {
            return $this->hasMany(PostComment::class);
        }

        public function posts(): HasMany
        {
            return $this->hasMany(Post::class, 'added_by');
        }

        public function product_reviews(): HasMany
        {
            return $this->hasMany(ProductReview::class);
        }

        public function wishlists(): HasMany
        {
            return $this->hasMany(Wishlist::class);
        }
    }
