<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use SantosSabanari\LaravelFoundation\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
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

        // Asign Admin Role Permissions
        Role::find(1)->givePermissionTo(Permission::all());

        // Asign Admin users roles
        User::find(1)->assignRole(config('laravel-foundation.role_admin'));

        $this->enableForeignKeys();
    }
}
