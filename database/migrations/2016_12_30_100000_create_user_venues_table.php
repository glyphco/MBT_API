<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_venues', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->index();
            $table->unsignedInteger('venue_id')->index();
            $table->unsignedInteger('objectrole_id')->index();

            $table->timestamps();
            $table->unsignedInteger('created_by')->nullable()->default(null);
            $table->unsignedInteger('updated_by')->nullable()->default(null);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
            $table->foreign('objectrole_id')->references('id')->on('objectroles')->onDelete('cascade');

        });

        // Schema::create('atable_btables', function (Blueprint $table) {
        //     $table->unsignedInteger('atable_id')->index();
        //     $table->unsignedInteger('btable_id')->index();
        //     $table->unsignedInteger('role_id')->index();

        //     $table->foreign('atable_id')->references('id')->on('btables')->onDelete('cascade');
        //     $table->foreign('btable_id')->references('id')->on('atables')->onDelete('cascade');
        //     $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

        //     $table->timestamps();
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
