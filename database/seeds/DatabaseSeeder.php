<?php
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard();

		// Temporarily increase memory limit to 2048M
		//ini_set('memory_limit', '2048M');

		$this->call('UserDataSeeder');

		$this->call('VenueDataSeeder');
		$this->call('ProfileDataSeeder');
		$this->call('EventDataSeeder');
	}

}

class UserDataSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();
		$datetime    = Carbon::now();
		$glypherinfo = [
			'name'        => "Shawn 'glypher' Dalton",
			'email'       => "glypher@gmail.com",
			'facebook_id' => '10109892803653991',
			'avatar'      => 'https://graph.facebook.com/v2.8/10109892803653991/picture?type=normal',
			'slug'        => 'shawn',
			'created_at'  => $datetime,
			'updated_at'  => $datetime,
		];

		$id   = DB::table('users')->insertGetId($glypherinfo);
		$user = User::find($id);
		//Logging in glypher so we can do all the seeding
		\Auth::login($user);

		$users = factory('App\Models\User', 'user', 100)->create();

	}
}

class VenueDataSeeder extends Seeder {
	public function run() {
		DB::table('venues')->delete();
		$venues = factory('App\Models\Venue', 10)->states('chicago')->create();
	}
}

class ProfileDataSeeder extends Seeder {
	public function run() {
		DB::table('profiles')->delete();
		$profiles = factory('App\Models\Profile', 10)->states('chicago')->create();
	}
}

class EventDataSeeder extends Seeder {
	public function run() {
		DB::table('events')->delete();
		$events = factory('App\Models\Event', 10)->states('chicago')->create();
	}
}