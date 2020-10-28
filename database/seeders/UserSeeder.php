<?php

namespace Database\Seeders;

use App\Models\User;
use SantosSabanari\LaravelFoundation\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;
use function app;
use function now;

class UserSeeder extends Seeder
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

        // Add the master administrator, user id of 1
        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Santos Sabanari',
            'username' => 'santos',
            'email' => 'sabanari.santos@gmail.com',
            'password' => 'sabanari123',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        User::create([
            'type' => User::TYPE_ADMIN,
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'admin123',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        User::create([
            'type' => User::TYPE_USER,
            'name' => 'Test User',
            'username' => 'user',
            'email' => 'user@user.com',
            'password' => 'user123',
            'email_verified_at' => now(),
            'active' => true,
        ]);

        $this->enableForeignKeys();
    }
}
