<?php
/**
 * Created by PhpStorm.
 * User: Ronny
 * Date: 1/17/17
 * Time: 6:40 AM
 */

class TestUsersController extends TestCase
{
	public function store()
	{

		$response = $this->post('/users/add',
			[
				'token' => $this->getAuthenticatedToken(),
				'firstname' => 'firstnameTest',
				'lastname' => 'lastnameTest',
				'email' => 'email@test.com',
				'password' => \Illuminate\Support\Facades\Hash::make('secret'),
				'admin'=> 1
			]);


		/*
         * check and test json response
         */
//		$this->assertTrue(isset($json->result));
//		$this->assertTrue(isset($json->data));
//		$this->assertEquals('ok', $json->result);
//		$this->assertTrue(!empty($json->data));
//
//		/*
//		 * check and test database data
//		 */
//		$user = \App\Api\V1\Models\User::where('email', 'email@test.com')->first();
//		$this->assertTrue(!empty($user));
//		$this->assertTrue(isset($user->email));
//		$this->assertEquals('email@test.com', $user->email);
	}
} 