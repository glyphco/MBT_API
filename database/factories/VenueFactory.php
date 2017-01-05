<?php

$factory->define('App\Models\Venue', function (Faker\Generator $faker) {
	static $password;

	//	$lat = $faker->latitude($min = -90, $max = 90);
	//	$lng = $faker->longitude($min = -180, $max = 180);

//Chicago
	$lat = $faker->latitude($min = 41, $max = 42);
	$lng = $faker->longitude($min = -87.77, $max = -87.6);

	return [
		'name' => $faker->company,
		'email' => $faker->unique()->safeEmail,
		'slug' => $faker->unique()->optional()->slug,
		'category' => $faker->jobTitle,
		'street_address' => $faker->streetAddress,
		'city' => $faker->city,
		'state' => $faker->state,
		'zipcode' => $faker->postcode,
		'lat' => $lat,
		'lng' => $lng,
		'phone' => $faker->phoneNumber,
		'location' => DB::raw($lat . ', ' . $lng),
		'public' => 1,
		'confirmed' => 1,

	];

});
$factory->state('App\Models\Venue', 'chicago', function ($faker) {
//Chicago
	$lat = $faker->latitude($min = 41, $max = 42);
	$lng = $faker->longitude($min = -87.77, $max = -87.6);

	return [
		'lat' => $lat,
		'lng' => $lng,
		'location' => DB::raw($lat . ', ' . $lng),
	];
});
