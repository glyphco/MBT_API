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

		$this->call('RolesSeeder');
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
		$events = factory('App\Models\Event', 10)->states('chicago')
			->create()
			->each(function ($u) {
				$u->participant()->save(factory(App\Models\Participant::class)->make());
				$u->participant()->save(factory(App\Models\Participant::class)->make());
				$u->participant()->save(factory(App\Models\Participant::class)->make());
				$u->participant()->save(factory(App\Models\Participant::class)->make());
			});
	}
}

class RolesSeeder extends Seeder {
	public function run() {
		Bouncer::allow('superadmin')->to('ban-users');
		Bouncer::allow('superadmin')->to('create-profiles');
		Bouncer::allow('superadmin')->to('edit-profiles');
		Bouncer::allow('superadmin')->to('delete-profiles');
		Bouncer::allow('superadmin')->to('create-venues');
		Bouncer::allow('superadmin')->to('edit-venues');
		Bouncer::allow('superadmin')->to('delete-venues');
		Bouncer::allow('superadmin')->to('create-events');
		Bouncer::allow('superadmin')->to('edit-events');
		Bouncer::allow('superadmin')->to('delete-events');

		Bouncer::allow('admin')->to('create-profiles');
		Bouncer::allow('admin')->to('edit-profiles');
		Bouncer::allow('admin')->to('delete-profiles');
		Bouncer::allow('admin')->to('create-venues');
		Bouncer::allow('admin')->to('edit-venues');
		Bouncer::allow('admin')->to('delete-venues');
		Bouncer::allow('admin')->to('create-events');
		Bouncer::allow('admin')->to('edit-events');
		Bouncer::allow('admin')->to('delete-events');

		Bouncer::allow('mastereditor')->to('create-profiles');
		Bouncer::allow('mastereditor')->to('edit-profiles');
		Bouncer::allow('mastereditor')->to('delete-profiles');
		Bouncer::allow('mastereditor')->to('create-venues');
		Bouncer::allow('mastereditor')->to('edit-venues');
		Bouncer::allow('mastereditor')->to('delete-venues');
		Bouncer::allow('mastereditor')->to('create-events');
		Bouncer::allow('mastereditor')->to('edit-events');
		Bouncer::allow('mastereditor')->to('delete-events');

	}

}