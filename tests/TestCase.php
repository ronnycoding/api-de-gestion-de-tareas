<?php

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class TestCase extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

	protected function getAuthenticatedToken()
	{

		$response = $this->post('/api/authenticate',
			[
				'email' => 'ronnyangelo.freites@gmail.com',
				'password' => 'secret',
			]);

		$response = $response->getContent();

		return $response->token;
	}
}
