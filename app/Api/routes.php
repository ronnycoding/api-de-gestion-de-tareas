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
	 * Method: get
	 *  token
	 *  postman: http://localhost:8000/api/tasks?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ4MzMyMDcyMiwibmJmIjoxNDgzMzIwNzIyLCJqdGkiOiIxMDVmMzYxNDU2Mjk2MDVlMjBhYmQ2YjY0M2Q4NDgwOSIsInN1YiI6MX0.HIXi9uE2etSQvIzzo5F7Pt3yBGXbTtKvADHS8sY3hfY
	 */
	$api->get('tasks', 'App\Api\V1\Controllers\TaskController@showAll');

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
	$api->get('tasks/{idTask}', 'App\Api\V1\Controllers\TaskController@show');

	/**
	 * Method put
	 *  token
	 *  title
	 *  description
	 *  due_description AAAA-MM-DD
	 */
	$api->put('tasks/{idTask}', 'App\Api\V1\Controllers\TaskController@update');

	/**
	 * Method
	 *  token
	 *  name
	 */
	$api->post('tasks/{idTask}/priorities/', 'App\Api\V1\Controllers\PrioritiesController@store');

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
	 *  postman: http://localhost:8000/api/tasks/add?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ4MzMyMzE4MSwibmJmIjoxNDgzMzIzMTgxLCJqdGkiOiI0ODc1ODVkODE4OWNiN2FlNDMwMWEzZGFiYzcwOWRjMiIsInN1YiI6NX0.b9k30NhnMXYlC1rlo1XClfEtZyEdPOBfEMpQfEPq5CA&title=la tarea&description=tareita&due_description=2017-09-13
	 */
	$api->post('tasks/add', 'App\Api\V1\Controllers\TaskController@store');

	/**
	 * Users
	 */
	
	/**
	 * Method: get
	 * Params:
	 *  token
	 *  postman: http://localhost:8000/api/users/5?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ4MzMyMDcyMiwibmJmIjoxNDgzMzIwNzIyLCJqdGkiOiIxMDVmMzYxNDU2Mjk2MDVlMjBhYmQ2YjY0M2Q4NDgwOSIsInN1YiI6MX0.HIXi9uE2etSQvIzzo5F7Pt3yBGXbTtKvADHS8sY3hfY
	 */
    $api->get('users/{id}', 'App\Api\V1\Controllers\UserController@show');

    /**
	 * Method: get
	 * Params:
	 *  token
	 *  postman: http://localhost:8000/api/users/?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ4MzMyMDcyMiwibmJmIjoxNDgzMzIwNzIyLCJqdGkiOiIxMDVmMzYxNDU2Mjk2MDVlMjBhYmQ2YjY0M2Q4NDgwOSIsInN1YiI6MX0.HIXi9uE2etSQvIzzo5F7Pt3yBGXbTtKvADHS8sY3hfY
	 */
    $api->get('users', 'App\Api\V1\Controllers\UserController@showAll');

	/**
	 * Method: put
	 * Param:
	 *  token
	 *  firstname
	 *  lastname
	 *  email
	 *  password
	 *  admin 1 o 0
	 *  postman: http://localhost:8000/api/users/add?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ4MzMyMDcyMiwibmJmIjoxNDgzMzIwNzIyLCJqdGkiOiIxMDVmMzYxNDU2Mjk2MDVlMjBhYmQ2YjY0M2Q4NDgwOSIsInN1YiI6MX0.HIXi9uE2etSQvIzzo5F7Pt3yBGXbTtKvADHS8sY3hfY&firstname=juan&lastname=freites&email=admin@gmail.com&password=secret&admin=1
	 */
	$api->put('users/{id}', 'App\Api\V1\Controllers\UserController@update');

	/**
	 * Method: post
	 * Params:
	 *  token
	 *  postman http://localhost:8000/api/users/4?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ4MzMyMDcyMiwibmJmIjoxNDgzMzIwNzIyLCJqdGkiOiIxMDVmMzYxNDU2Mjk2MDVlMjBhYmQ2YjY0M2Q4NDgwOSIsInN1YiI6MX0.HIXi9uE2etSQvIzzo5F7Pt3yBGXbTtKvADHS8sY3hfY 
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
	 *  postman: http://localhost:8000/api/users/add?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGhlbnRpY2F0ZSIsImlhdCI6MTQ4MzMyMDcyMiwibmJmIjoxNDgzMzIwNzIyLCJqdGkiOiIxMDVmMzYxNDU2Mjk2MDVlMjBhYmQ2YjY0M2Q4NDgwOSIsInN1YiI6MX0.HIXi9uE2etSQvIzzo5F7Pt3yBGXbTtKvADHS8sY3hfY&firstname=Pepe&lastname=Mujica&email=admin@gmail.com&password=secret&admin=0
	 */
	$api->post('users/add', 'App\Api\V1\Controllers\UserController@store');

});


$api->version('v1', [], function ($api) {
	/**
	 * Method: post
	 * Params:
	 *  password
	 *  email
	 *  postman: http://localhost:8000/api/authenticate?email=ronnyangelo.freites@gmail.com&password=nextdots
	 */
	$api->post('/authenticate', 'App\Api\V1\Controllers\AuthenticateController@backend');
});
