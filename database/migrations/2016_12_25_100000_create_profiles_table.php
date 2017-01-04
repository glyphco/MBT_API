<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		Schema::dropIfExists('profiles');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
		Schema::create('profiles', function (Blueprint $table) {
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
			$table->boolean('performer')->default(0);
			$table->boolean('production')->default(0);
			$table->boolean('hasmembers')->default(0);
			$table->boolean('canbeamember')->default(0);

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
		Schema::dropIfExists('profiles');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}
}
