<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('roles', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('display_name')->nullable();
			$table->string('description')->nullable();
			$table->timestamps();
		});

		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		$datetime = Carbon::now();

		$data = [
			[
				'id' => '1',
				'name' => 'superadmin',
				'display_name' => 'SuperAdmin',
				'description' => 'the architect',
				'created_at' => $datetime,
				'updated_at' => $datetime,
			],
			[
				'id' => '2',
				'name' => 'admin',
				'display_name' => 'Admin',
				'description' => 'The Enforcer',
				'created_at' => $datetime,
				'updated_at' => $datetime,
			],
			[
				'id' => '3',
				'name' => 'mastereditor',
				'display_name' => 'Master Editor',
				'description' => 'the supergrunt',
				'created_at' => $datetime,
				'updated_at' => $datetime,
			],
			[
				'id' => '4',
				'name' => 'contributor',
				'display_name' => 'Contributor',
				'description' => 'the supergrunt',
				'created_at' => $datetime,
				'updated_at' => $datetime,
			],
			[
				'id' => '5',
				'name' => 'member',
				'display_name' => 'Member',
				'description' => 'the supergrunt',
				'created_at' => $datetime,
				'updated_at' => $datetime,
			],
		];

		DB::table('roles')->truncate();
		DB::table('roles')->insert($data);

		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('roles');
	}

}