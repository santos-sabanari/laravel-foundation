<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use SantosSabanari\LaravelFoundation\Traits\DisableForeignKeys;
use SantosSabanari\LaravelFoundation\Traits\TruncateTable;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateMultiple([
            'failed_jobs',
        ]);

        $this->disableForeignKeys();

        // Reset cached roles and permissions
        Artisan::call('cache:clear');
        resolve(PermissionRegistrar::class)->forgetCachedPermissions();

        $this->truncateMultiple([
            config('permission.table_names.model_has_permissions'),
            config('permission.table_names.model_has_roles'),
            config('permission.table_names.role_has_permissions'),
            config('permission.table_names.permissions'),
            config('permission.table_names.roles'),
            'users',
            'password_resets',
        ]);


        // harus terakhir, agar asign permission bisa semua
        $this->call(UserSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(UserRoleSeeder::class);

        $this->enableForeignKeys();
    }
}
