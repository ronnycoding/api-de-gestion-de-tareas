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

$app->get('/', function() {
	return phpinfo();
});

$api->version('v1', ['middleware' => 'api.auth', 'providers' => 'jwt'], function ($api) {

	$api->get('tasks/{idTask}', 'App\Api\V1\Controllers\TaskController@show');

	$api->get('tasks', 'App\Api\V1\Controllers\TaskController@showAll');

	$api->get('tasks/{idTask}/priorities', 'App\Api\V1\Controllers\PrioritiesController@showAll');

	$api->delete('tasks/{idTask}/priorities/{idPriority}', 'App\Api\V1\Controllers\PrioritiesController@delete');

	$api->put('tasks/{idTask}/priorities/{idPriority}', 'App\Api\V1\Controllers\PrioritiesController@update');

	$api->get('tasks/{idTask}/priorities/{idPriority}', 'App\Api\V1\Controllers\PrioritiesController@show');

	$api->put('tasks/{idTask}', 'App\Api\V1\Controllers\TaskController@update');

	$api->post('tasks/{idTask}/priorities/add', 'App\Api\V1\Controllers\PrioritiesController@store');

	$api->delete('tasks/{id}', 'App\Api\V1\Controllers\TaskController@delete');

	$api->post('tasks/add', 'App\Api\V1\Controllers\TaskController@store');

	$api->put('users/{id}', 'App\Api\V1\Controllers\UserController@update');

    $api->get('users/{id}', 'App\Api\V1\Controllers\UserController@show');

    $api->get('users', 'App\Api\V1\Controllers\UserController@showAll');

	$api->delete('users/{id}', 'App\Api\V1\Controllers\UserController@delete');

	$api->post('users/add', 'App\Api\V1\Controllers\UserController@store');

});


$api->version('v1', [], function ($api) {

	$api->post('/authenticate', 'App\Api\V1\Controllers\AuthenticateController@backend');
});