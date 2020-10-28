<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use SantosSabanari\LaravelFoundation\Traits\DisableForeignKeys;

class PermissionRoleSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        $administratorRole = Role::create([
            'id' => 1,
            'type' => User::TYPE_ADMIN,
            'name' => 'Administrator',
        ]);

        // Non Grouped Permissions
        //

        // Grouped permissions
        // Users category
        $users = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'backend.system.user',
            'description' => 'All User Permissions',
        ]);

        $users->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'backend.system.user.list',
                'description' => 'View Users',
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'backend.system.user.clear-session',
                'description' => 'Clear User Sessions',
                'sort' => 2,
            ]),
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'backend.system.user.change-password',
                'description' => 'Change User Passwords',
                'sort' => 3,
            ]),
        ]);

        $roles = Permission::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'backend.system.role',
            'description' => 'All Role Permissions',
        ]);

        $roles->children()->saveMany([
            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'backend.system.role.list',
                'description' => 'View Roles',
            ]),

            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'backend.system.role.edit',
                'description' => 'Edit Roles',
                'sort' => 2,
            ]),

            new Permission([
                'type' => User::TYPE_ADMIN,
                'name' => 'backend.system.role.delete',
                'description' => 'Delete Roles',
                'sort' => 3,
            ]),
        ]);

        // Assign Permissions to other Roles
        $administratorRole->givePermissionTo(Permission::all());

        $this->enableForeignKeys();
    }
}
