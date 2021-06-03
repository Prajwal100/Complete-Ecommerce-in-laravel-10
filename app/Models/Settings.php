<?php

    namespace App\Models;

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Carbon;

    /**
     * App\Models\Settings
     *
     * @property int $id
     * @property string $description
     * @property string $short_des
     * @property string $logo
     * @property string $photo
     * @property string $address
     * @property string $phone
     * @property string $email
     * @property Carbon|null $created_at
     * @property Carbon|null $updated_at
     * @method static Builder|Settings newModelQuery()
     * @method static Builder|Settings newQuery()
     * @method static Builder|Settings query()
     * @method static Builder|Settings whereAddress($value)
     * @method static Builder|Settings whereCreatedAt($value)
     * @method static Builder|Settings whereDescription($value)
     * @method static Builder|Settings whereEmail($value)
     * @method static Builder|Settings whereId($value)
     * @method static Builder|Settings whereLogo($value)
     * @method static Builder|Settings wherePhone($value)
     * @method static Builder|Settings wherePhoto($value)
     * @method static Builder|Settings whereShortDes($value)
     * @method static Builder|Settings whereUpdatedAt($value)
     * @mixin Eloquent
     */
    class Settings extends Model
    {
        use HasFactory;

        protected $fillable = ['short_des', 'description', 'photo', 'address', 'phone', 'email', 'logo'];
    }
