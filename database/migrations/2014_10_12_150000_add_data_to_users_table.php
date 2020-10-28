<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('type', [User::TYPE_ADMIN, User::TYPE_USER])
                ->default(User::TYPE_USER)
                ->after('id')
                ->nullable();

            $table->string('username')
                ->after('name')
                ->nullable();

            $table->timestamp('password_changed_at')
                ->after('password')
                ->nullable();

            $table->unsignedTinyInteger('active')
                ->after('password_changed_at')
                ->default(1);

            $table->string('timezone')
                ->after('active')
                ->nullable();

            $table->timestamp('last_login_at')
                ->after('timezone')
                ->nullable();

            $table->string('last_login_ip')
                ->after('last_login_at')
                ->nullable();

            $table->boolean('to_be_logged_out')
                ->after('last_login_ip')
                ->default(false);

            $table->string('provider')
                ->after('to_be_logged_out')
                ->nullable();

            $table->string('provider_id')
                ->after('provider')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('type', 'username', 'password_changed_at', 'active', 'timezone', 'last_login_at', 'last_login_ip', 'to_be_logged_out', 'provider', 'provider_id');
        });
    }
}
