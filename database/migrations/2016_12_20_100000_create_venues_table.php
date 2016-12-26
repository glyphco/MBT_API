<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenuesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::dropIfExists('venues');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
		Schema::create('venues', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('slug', 60);
			$table->string('category');
			$table->string('street_address');
			$table->string('city');
			$table->string('state');
			$table->string('zipcode');
			$table->string('lat');
			$table->string('lng');
			$table->string('phone');
			$table->string('email');

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
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::dropIfExists('venues');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}
}