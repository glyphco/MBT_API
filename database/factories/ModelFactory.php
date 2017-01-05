<?php
//use DB;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
 */

$factory->defineAs('App\Models\User', 'user', function ($faker) {
	static $password;
	static $avatar;

	return [
		'name'           => $faker->name,
		'email'          => $faker->unique()->safeEmail,
		'avatar'         => $faker->imageUrl(100, 100, 'people'),
		//'password'       => $password ?: $password = bcrypt('secret'),
		'confirmed'      => 1,
		'is_banned'      => 0,
		'is_online'      => 0,
		'remember_token' => str_random(10),
	];

});

$factory->define(App\Models\Venue::class, function (Faker\Generator $faker) {
	static $password;

	//	$lat = $faker->latitude($min = -90, $max = 90);
	//	$lng = $faker->longitude($min = -180, $max = 180);

//Chicago
	$lat = $faker->latitude($min = 41, $max = 42);
	$lng = $faker->longitude($min = -87.77, $max = -87.6);

	return [
		'name'           => $faker->company,
		'email'          => $faker->unique()->safeEmail,
		'slug'           => $faker->unique()->optional()->slug,
		'category'       => $faker->jobTitle,
		'street_address' => $faker->streetAddress,
		'city'           => $faker->city,
		'state'          => $faker->state,
		'zipcode'        => $faker->postcode,
		'lat'            => $lat,
		'lng'            => $lng,
		'phone'          => $faker->phoneNumber,
		'location'       => DB::raw($lat . ', ' . $lng),
		'public'         => 1,
		'confirmed'      => 1,

	];

});