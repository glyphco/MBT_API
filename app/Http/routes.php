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

$app->get('/foo', function () use ($app) {
	return 'bar';
});

$app->get('/venue/map', 'VenueController@map');

function rest($path, $controller) {
	global $app;

	$app->get($path, $controller . '@index');
	$app->get($path . '/{id}', $controller . '@show');
	$app->post($path, $controller . '@store');
	$app->put($path . '/{id}', $controller . '@update');
	$app->delete($path . '/{id}', $controller . '@destroy');
}

$app->group(['middleware' => 'auth:api'], function () use ($app) {

//superadmin only
	$app->group(['middleware' => 'can:ban-users'], function () use ($app) {
		rest('/user', 'UserController');
	});

//admin only
	$app->group(['middleware' => 'can:create-events'], function () use ($app) {
		rest('/event', 'EventController');
	});

//rest('/user', 'UserController');

//contribute only
	rest('/venue', 'VenueController');
	rest('/performer', 'PerformerController'); //connect profiles to events
	//members only

//guests

	$app->get('/test', function () use ($app) {
		var_dump(\Auth::user());
		$attributes = array_pluck(\Auth::user()->getAbilities()->toArray(), 'name');
		$attributes = array_pluck(\Auth::user()->get, 'name');
		var_dump($attributes);
	});

	$app->get('/userinfo', 'UserinfoController@userinfo');

//SPECIAL STUFF

	$app->get('/runaccess', function () use ($app) {
		//Bouncer::allow(\Auth::user())->to('ban-users');
		//Bouncer::allow('admin')->to('ban-users');
		//Bouncer::assign('admin')->to(\Auth::user());
		Bouncer::allow('superadmin')->to('ban-users');
		Bouncer::allow('superadmin')->to('create-events');
		Bouncer::allow('superadmin')->to('edit-events');
		Bouncer::allow('superadmin')->to('delete-events');
		Bouncer::allow('superadmin')->to('create-profiles');
		Bouncer::allow('superadmin')->to('edit-profiles');
		Bouncer::allow('superadmin')->to('delete-profiles');

		Bouncer::allow('admin')->to('create-events');
		Bouncer::allow('admin')->to('edit-events');
		Bouncer::allow('admin')->to('delete-events');
		Bouncer::allow('admin')->to('create-profiles');
		Bouncer::allow('admin')->to('edit-profiles');
		Bouncer::allow('admin')->to('delete-profiles');

		Bouncer::allow('mastereditor')->to('create-events');
		Bouncer::allow('mastereditor')->to('edit-events');
		Bouncer::allow('mastereditor')->to('delete-events');
		Bouncer::allow('mastereditor')->to('create-profiles');
		Bouncer::allow('mastereditor')->to('edit-profiles');
		Bouncer::allow('mastereditor')->to('delete-profiles');

		return 'roles seeded';
	});

	$app->get('/backstageaccess', function () use ($app) {
		//Bouncer::allow(\Auth::user())->to('ban-users');
		//Bouncer::allow('admin')->to('ban-users');
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
