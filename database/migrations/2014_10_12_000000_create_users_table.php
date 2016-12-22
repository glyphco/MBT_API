<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60)->nullable();
            $table->bigInteger('facebook_id')->unique()->nullable();
            $table->bigInteger('google_id')->unique()->nullable();
            $table->string('avatar')->nullable();
            $table->string('slug', 60)->nullable();
            $table->text('remember_token')->nullable();

            $table->boolean('confirmed')->default(0);
            $table->boolean('is_online')->default(false);
            $table->boolean('is_banned')->default(false);
            $table->timestamp('banned_until')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
