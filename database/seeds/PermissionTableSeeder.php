<?php


namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;


class PermissionTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'room-list',
            'room-create',
            'room-edit',
            'room-delete',
            'attraction-list',
            'attraction-create',
            'attraction-edit',
            'attraction-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'event-list',
            'event-create',
            'event-edit',
            'event-delete',
            'booking-list',
            'booking-create',
            'booking-edit',
            'booking-delete',
            'client-list',
            'client-create',
            'client-edit',
            'client-delete',
            'discount-list',
            'discount-create',
            'discount-edit',
            'discount-delete',
            'price-list',
            'price-create',
            'price-edit',
            'price-delete',
            'testimonials-list',
            'testimonials-create',
            'testimonials-edit',
            'testimonials-delete',
            'casys-update'


        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'writer']);
        $role1->givePermissionTo([
            'event-list',
            'event-create',
            'event-edit',
            'event-delete',
        ]);

        $role2 = Role::create(['name' => 'client']);
        $role2->givePermissionTo([
            'client-list',
            'client-create',
            'client-edit',
            'client-delete',
        ]);

        $role3 = Role::create(['name' => 'super-admin']);
        $role3->givePermissionTo(Permission::all());

        // create demo users
        $user = Factory(User::class)->create([
            'name' => 'Example User',
            'email' => 'writer@mail.com',
        ]);
        $user->assignRole($role1);

        $user = Factory(User::class)->create([
            'name' => 'Example client User',
            'email' => 'client@mail.com',
        ]);
        $user->assignRole($role2);

        $user = Factory(User::class)->create([
            'name' => 'Example Super-Admin User',
            'email' => 'superadmin@mail.com',
        ]);
        $user->assignRole($role3);
    }
}
