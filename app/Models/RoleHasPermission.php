<?php

    /**
     * Created by Zoran Shefot Bogoevski.
     */

    namespace App\Models;

    use Eloquent;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    /**
 * Class RoleHasPermission
 *
 * @property int $permission_id
 * @property int $role_id
 * @property Permission $permission
 * @property Role $role
 * @package App\Models
 * @method static Builder|RoleHasPermission newModelQuery()
 * @method static Builder|RoleHasPermission newQuery()
 * @method static Builder|RoleHasPermission query()
 * @method static Builder|RoleHasPermission wherePermissionId($value)
 * @method static Builder|RoleHasPermission whereRoleId($value)
 * @mixin Eloquent
 */
    class RoleHasPermission extends Model
    {
        protected $table = 'role_has_permissions';
        public $incrementing = false;
        public $timestamps = false;

        protected $casts = [
            'permission_id' => 'int',
            'role_id'       => 'int',
        ];

        public function permission(): BelongsTo
        {
            return $this->belongsTo(Permission::class);
        }

        public function role(): BelongsTo
        {
            return $this->belongsTo(Role::class);
        }
    }
