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

	/**
	 * Method
	 *  token
	 *  name
	 */
	$api->put('tasks/{idTask}/priorities/{idPriority}', 'App\Api\V1\Controllers\PrioritiesController@update');

	/**
	 * Method
	 *  token
	 *  name
	 */
	$api->delete('tasks/{idTask}/priorities/{idPriority}', 'App\Api\V1\Controllers\PrioritiesController@update');

	/**
	 * Method
	 *  token
	 */
	$api->get('tasks/{idTask}/priorities/{idPriority}', 'App\Api\V1\Controllers\PrioritiesController@show');

	/**
	 * Tasks
	 */
	/**
	 * Method: get
	 *  token
	 */
	$api->get('tasks/{id}', 'App\Api\V1\Controllers\TaskController@show');

	/**
	 * Method
	 *  token
	 *  name
	 */
	$api->post('tasks/{idTask}/priorities/', 'App\Api\V1\Controllers\PrioritiesController@store');

	/**
	 * Method put
	 *  token
	 *  title
	 *  description
	 *  due_description AAAA-MM-DD
	 */
	$api->put('tasks/{id}', 'App\Api\V1\Controllers\TaskController@update');

	/**
	 * Method delete
	 *  token
	 */
	$api->delete('tasks/{id}', 'App\Api\V1\Controllers\TaskController@delete');

	/**
	 * Method
	 *  token
	 *  title
	 *  description
	 *  due_description AAAA-MM-DD
	 */
	$api->post('tasks/add', 'App\Api\V1\Controllers\TaskController@store');

	/**
	 * Users
	 */
	/**
	 * Method: get
	 * Params:
	 *  token
	 */
    $api->get('users/{id}', 'App\Api\V1\Controllers\UserController@show');

	/**
	 * Method: put
	 * Param:
	 *  token
	 *  firstname
	 *  lastname
	 *  email
	 *  password
	 *  admin 1 o 0
	 */
	$api->put('users/{id}', 'App\Api\V1\Controllers\UserController@update');

	/**
	 * Method: post
	 * Params:
	 *  token
	 */
	$api->delete('users/{id}', 'App\Api\V1\Controllers\UserController@delete');

	/**
	 * Method: post
	 * Param:
	 *  token
	 *  firstname
	 *  lastname
	 *  email
	 *  password
	 *  admin 1 o 0
	 */
	$api->post('users/add', 'App\Api\V1\Controllers\UserController@store');

});


$api->version('v1', [], function ($api) {
	/**
	 * Method: post
	 * Params:
	 *  token
	 *  email
	 */
	$api->post('/authenticate', 'App\Api\V1\Controllers\AuthenticateController@backend');
});
