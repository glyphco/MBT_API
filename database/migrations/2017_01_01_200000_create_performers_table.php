<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('performers', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('event_id')->unsigned();
			$table->string('name');
			$table->string('performer_info');
			$table->integer('profile_id')->unsigned()->nullable();
			$table->dateTime('start')->nullable()->default(null);
			$table->dateTime('end')->nullable()->default(null);
			$table->integer('order')->unsigned()->default(0);
			$table->timestamps();
			$table->unsignedInteger('created_by')->nullable()->default(null);
			$table->unsignedInteger('updated_by')->nullable()->default(null);

			$table->foreign('profile_id')->references('id')->on('venues')->onUpdate('cascade')->onDelete('set null');
			$table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('performers');
	}

}