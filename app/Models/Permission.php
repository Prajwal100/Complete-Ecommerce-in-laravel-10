<?php

    /**
     * Created by Zoran Shefot Bogoevski.
     */

    namespace App\Models;

    use Carbon\Carbon;
    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    /**
 * Class Permission
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|ModelHasPermission[] $model_has_permissions
 * @property Collection|Role[] $roles
 * @package App\Models
 * @property-read int|null $model_has_permissions_count
 * @property-read int|null $roles_count
 * @method static Builder|Permission newModelQuery()
 * @method static Builder|Permission newQuery()
 * @method static Builder|Permission query()
 * @method static Builder|Permission whereCreatedAt($value)
 * @method static Builder|Permission whereGuardName($value)
 * @method static Builder|Permission whereId($value)
 * @method static Builder|Permission whereName($value)
 * @method static Builder|Permission whereUpdatedAt($value)
 * @mixin Eloquent
 */
    class Permission extends Model
    {
        protected $table = 'permissions';

        protected $fillable = [
            'name',
            'guard_name',
        ];

        public function model_has_permissions(): HasMany
        {
            return $this->hasMany(ModelHasPermission::class);
        }

        public function roles(): BelongsToMany
        {
            return $this->belongsToMany(Role::class, 'role_has_permissions');
        }
    }
