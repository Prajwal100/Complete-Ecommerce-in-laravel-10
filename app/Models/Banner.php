<?php

    /**
     * Created by Zoran Shefot Bogoevski.
     */

    namespace App\Models;

    use Carbon\Carbon;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    /**
     * Class Banner
     *
     * @property int $id
     * @property string $title
     * @property string $slug
     * @property string|null $photo
     * @property string|null $description
     * @property string $status
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @package App\Models
     * @method static Builder|Banner newModelQuery()
     * @method static Builder|Banner newQuery()
     * @method static Builder|Banner query()
     * @method static Builder|Banner whereCreatedAt($value)
     * @method static Builder|Banner whereDescription($value)
     * @method static Builder|Banner whereId($value)
     * @method static Builder|Banner wherePhoto($value)
     * @method static Builder|Banner whereSlug($value)
     * @method static Builder|Banner whereStatus($value)
     * @method static Builder|Banner whereTitle($value)
     * @method static Builder|Banner whereUpdatedAt($value)
     * @mixin Eloquent
     * @method static \Database\Factories\BannerFactory factory(...$parameters)
     */
    class Banner extends Model
    {
        use HasFactory;

        protected $table = 'banners';

        protected $fillable = [
            'title',
            'slug',
            'photo',
            'description',
            'status',
        ];

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
