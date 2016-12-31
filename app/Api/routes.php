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

$api->version('v1', ['middleware' => 'api.auth', 'providers' => 'jwt'], function ($api) {
    $api->get('users/{id}', 'App\Api\V1\Controllers\UserController@show');
});

$api->version('v1', [], function ($api) {
    $api->post('/authenticate', 'App\Api\V1\Controllers\AuthenticateController@backend');
});