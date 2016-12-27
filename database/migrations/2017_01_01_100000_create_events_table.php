<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('events', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('location');
			$table->string('description')->nullable()->default(null);
			$table->dateTime('start');
			$table->dateTime('end')->nullable()->default(null);
			$table->boolean('public')->default(0);
			$table->boolean('confirmed')->default(0);
			$table->boolean('is_online')->default(false);
			$table->boolean('is_banned')->default(false);
			$table->timestamps();
			$table->unsignedInteger('created_by')->nullable()->default(null);
			$table->unsignedInteger('updated_by')->nullable()->default(null);
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('events');
	}

}