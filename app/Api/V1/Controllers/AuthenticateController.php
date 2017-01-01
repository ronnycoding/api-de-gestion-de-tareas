<?php namespace App\Api\V1\Controllers;

use Dingo\Api\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthenticateController extends BaseController {

    protected $auth;
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }
    public function backend(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = $this->auth->attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {

            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

}
