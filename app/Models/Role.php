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
 * Class Role
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|ModelHasRole[] $model_has_roles
 * @property Collection|Permission[] $permissions
 * @package App\Models
 * @property-read int|null $model_has_roles_count
 * @property-read int|null $permissions_count
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereGuardName($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @mixin Eloquent
 */
    class Role extends Model
    {
        protected $table = 'roles';

        protected $fillable = [
            'name',
            'guard_name',
        ];

        public function model_has_roles(): HasMany
        {
            return $this->hasMany(ModelHasRole::class);
        }

        public function permissions(): BelongsToMany
        {
            return $this->belongsToMany(Permission::class, 'role_has_permissions');
        }
    }
