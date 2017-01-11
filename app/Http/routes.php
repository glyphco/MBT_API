<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
 */

$app->get('/', function () use ($app) {
	return $app->version();
});

$app->get('/refresh-token', function (Request $request) use ($app) {
	return $request;
});

$app->get('/venue/map', 'VenueController@map');

$app->get('/event', 'EventController@index');
$app->get('/event/{id}', 'EventController@show');

$app->get('/venue', 'VenueController@index');
$app->get('/venue/{id}', 'VenueController@show');

$app->get('/profile', 'ProfileController@index');
$app->get('/profile/{id}', 'ProfileController@show');

$app->get('/participant', 'ParticipantController@index');
$app->get('/participant/{id}', 'ParticipantController@show');

//ONLY Tokened Visitors beyond this point!
$app->group(['middleware' => 'auth:api'], function () use ($app) {

//superadmin only
	$app->group(['middleware' => 'can:view-users'], function () use ($app) {
		$app->get('/user', 'UserController@index');
		$app->get('/user/{id}', 'UserController@show');
	});

//admin only
	$app->group(['middleware' => 'can:create-events'], function () use ($app) {

	});

//contribute only
	//connect profiles to events
	//members only

//guests

	$app->get('/test', function () use ($app) {
		var_dump(\Auth::user());
		$attributes = array_pluck(\Auth::user()->getAbilities()->toArray(), 'name');
		$attributes = array_pluck(\Auth::user()->get, 'name');
		var_dump($attributes);
	});

	$app->get('/userinfo', 'UserinfoController@userinfo');
	$app->get('/me', 'UserinfoController@userinfo');
//SPECIAL STUFF

	$app->get('/runaccess', function () use ($app) {
		//Artisan::call('db:Seed --class=RolesSeeder');
		Bouncer::allow('superadmin')->to('view-users');
		Bouncer::allow('superadmin')->to('edit-users');
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

		Bouncer::allow('admin')->to('view-users');
		Bouncer::allow('admin')->to('edit-users');
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
		return 'roles seeded';
	});

	$app->get('/backstage', function () use ($app) {
		Bouncer::assign('mastereditor')->to(\Auth::user());
		return \Auth::user()->getAbilities()->toArray();
	});

	$app->get('/giveglypheradmin', function () use ($app) {
		if (\Auth::user()->facebook_id == env('glyph_facebook', 0)) {
			Bouncer::assign('superadmin')->to(\Auth::user());
			return \Auth::user()->getAbilities()->toArray();
		} else {
			return 'nice try dickwad.';
		}
	});

});

// $app->group([
//     'prefix'     => 'restricted',
//     'middleware' => 'auth:api',
// ], function use $app () {

//     // Authentication Routes...
//     $app->get('logout', 'Auth\LoginController@logout');

//     $app->
//     });
// });

// function rest($path, $controller) {
// 	global $app;

// 	$app->get($path, $controller . '@index');
// 	$app->get($path . '/{id}', $controller . '@show');
// 	$app->post($path, $controller . '@store');
// 	$app->put($path . '/{id}', $controller . '@update');
// 	$app->delete($path . '/{id}', $controller . '@destroy');
// }