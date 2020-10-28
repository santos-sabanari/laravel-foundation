<?php

namespace Database\Seeders;

use App\Models\User;
use SantosSabanari\LaravelFoundation\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use function config;

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

        User::find(1)->assignRole(config('laravel-foundation.role_admin'));

        $this->enableForeignKeys();
    }
}
