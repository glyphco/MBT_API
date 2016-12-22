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

// function rest($path, $controller)
// {
//     global $app;

//     $app->get($path, $controller . '@index');
//     $app->get($path . '/{id}', $controller . '@show');
//     $app->post($path, $controller . '@store');
//     $app->put($path . '/{id}', $controller . '@update');
//     $app->delete($path . '/{id}', $controller . '@destroy');
// }

$app->group(['middleware' => 'auth:api'], function () use ($app) {
    //rest('/user', 'UserController');
    //rest('/venue', 'VenueController');
    $app->get('/test', function () {
        return 'authenticated';
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
