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

// AUTH only for now (might change)
// $app->get('/refresh-token', function (Request $request) use ($app) {
//     return $request;
// });

//$app->get('/venue/map', 'VenueController@map');

//ONLY Tokened Visitors beyond this point!
$app->group(['middleware' => 'auth:api'], function () use ($app) {

    $app->get('/event', 'EventController@index');
    $app->get('/event/{id}', 'EventController@show');

    $app->get('/venue', 'VenueController@index');
    $app->get('/venue/{id}', 'VenueController@show');
    $app->group(['middleware' => 'can:create-venues'], function () use ($app) {
        $app->post('/venue', 'VenueController@store');
    });
    $app->group(['middleware' => 'can:confirm-venues'], function () use ($app) {
        $app->get('/venue/{id}/confirm', 'VenueController@confirm');
        $app->get('/venue/{id}/unconfirm', 'VenueController@unconfirm');
    });
    $app->group(['middleware' => 'can:edit-venues'], function () use ($app) {
        $app->put('/venue/{id}', 'VenueController@update');
        // checks made in controller:
        $app->get('/venue/{id}/giveedit/{userid}', 'VenueController@giveedit');
        $app->get('/venue/{id}/revokeedit/{userid}', 'VenueController@revokeedit');
        $app->get('/venue/{id}/giveadmin/{userid}', 'VenueController@giveadmin');
        $app->get('/venue/{id}/revokeadmin/{userid}', 'VenueController@revokeadmin');
        $app->get('/venue/{id}/editors', 'VenueController@geteditors');
        $app->get('/venue/{id}/admins', 'VenueController@getadmins');
    });
    $app->group(['middleware' => 'can:delete-venues'], function () use ($app) {
        $app->delete('/venue/{id}', 'VenueController@update');
    });

    $app->get('/profile', 'ProfileController@index');
    $app->get('/profile/{id}', 'ProfileController@show');

    $app->get('/participant', 'ParticipantController@index');
    $app->get('/participant/{id}', 'ParticipantController@show');

//superadmin only
    $app->group(['middleware' => 'can:view-users'], function () use ($app) {
        $app->get('/user', 'UserController@index');
        $app->get('/user/{id}', 'UserController@show');
    });

//admin only

//admin only
    $app->group(['middleware' => 'can:delete-venues'], function () use ($app) {
        $app->delete('/venue/{id}', 'VenueController@destroy');
    });

    $app->group(['middleware' => 'can:edit-events'], function () use ($app) {
        $app->get('/maintenance/unlinkedvenues', 'MaintenanceController@unlinkedVenues');
        $app->get('/maintenance/unlinkedparticipants', 'MaintenanceController@unlinkedParticipants');
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
        Bouncer::allow('superadmin')->to('view-users'); // sa only
        Bouncer::allow('superadmin')->to('edit-users'); // sa only
        Bouncer::allow('superadmin')->to('ban-users'); // sa only
        Bouncer::allow('superadmin')->to('admin-profiles'); // sa/a only
        Bouncer::allow('superadmin')->to('confirm-profiles');
        Bouncer::allow('superadmin')->to('create-profiles');
        Bouncer::allow('superadmin')->to('edit-profiles');
        Bouncer::allow('superadmin')->to('delete-profiles');
        Bouncer::allow('superadmin')->to('admin-venues');
        Bouncer::allow('superadmin')->to('confirm-venues');
        Bouncer::allow('superadmin')->to('create-venues');
        Bouncer::allow('superadmin')->to('edit-venues');
        Bouncer::allow('superadmin')->to('delete-venues');
        Bouncer::allow('superadmin')->to('create-events');
        Bouncer::allow('superadmin')->to('edit-events');
        Bouncer::allow('superadmin')->to('delete-events');

        Bouncer::allow('admin')->to('admin-profiles'); // sa/a only
        Bouncer::allow('admin')->to('confirm-profiles');
        Bouncer::allow('admin')->to('view-users');
        Bouncer::allow('admin')->to('edit-users');
        Bouncer::allow('admin')->to('create-profiles');
        Bouncer::allow('admin')->to('edit-profiles');
        Bouncer::allow('admin')->to('delete-profiles');
        Bouncer::allow('admin')->to('admin-venues');
        Bouncer::allow('admin')->to('confirm-venues');
        Bouncer::allow('admin')->to('create-venues');
        Bouncer::allow('admin')->to('edit-venues');
        Bouncer::allow('admin')->to('delete-venues');
        Bouncer::allow('admin')->to('create-events');
        Bouncer::allow('admin')->to('edit-events');
        Bouncer::allow('admin')->to('delete-events');

        Bouncer::allow('mastereditor')->to('confirm-profiles');
        Bouncer::allow('mastereditor')->to('create-profiles');
        Bouncer::allow('mastereditor')->to('edit-profiles');
        Bouncer::allow('mastereditor')->to('delete-profiles');
        Bouncer::allow('mastereditor')->to('admin-venues');
        Bouncer::allow('mastereditor')->to('confirm-venues');
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
//     global $app;

//     $app->get($path, $controller . '@index');
//     $app->get($path . '/{id}', $controller . '@show');
//     $app->post($path, $controller . '@store');
//     $app->put($path . '/{id}', $controller . '@update');
//     $app->delete($path . '/{id}', $controller . '@destroy');
// }
