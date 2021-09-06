<?php

    /**
     * Created by Zoran Shefot Bogoevski.
     */

    namespace App\Models;

    use Carbon\Carbon;
    use Database\Factories\SettingFactory;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    /**
 * Class Setting
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
 * @package App\Models
 * @method static Builder|Setting newModelQuery()
 * @method static Builder|Setting newQuery()
 * @method static Builder|Setting query()
 * @method static Builder|Setting whereAddress($value)
 * @method static Builder|Setting whereCreatedAt($value)
 * @method static Builder|Setting whereDescription($value)
 * @method static Builder|Setting whereEmail($value)
 * @method static Builder|Setting whereId($value)
 * @method static Builder|Setting whereLogo($value)
 * @method static Builder|Setting wherePhone($value)
 * @method static Builder|Setting wherePhoto($value)
 * @method static Builder|Setting whereShortDes($value)
 * @method static Builder|Setting whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static SettingFactory factory(...$parameters)
 */
    class Setting extends Model
    {
        use HasFactory;

        protected $table = 'settings';

        protected $fillable = [
            'description',
            'short_des',
            'logo',
            'photo',
            'address',
            'phone',
            'email',
        ];
    }
