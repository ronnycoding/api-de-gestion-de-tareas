<?php namespace App\Api\V1\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements Authenticatable, JWTSubject{

	use \Illuminate\Auth\Authenticatable;

	protected $fillable = ["name", "last_name", "company_name", "email", "password"];

	protected $dates = ["deleted_at"];

	public static $rules = [
		"name" => "required",
		"last_name" => "required",
		"company_name" => "required",
		"email" => "unique|email|required",
		"password" => "required",
	];

	/**
	 * Get the identifier that will be stored in the subject claim of the JWT
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}
	/**
	 * Return a key value array, containing any custom claims to be added to the JWT
	 *
	 * @return array
	 */
	public function getJWTCustomClaims()
	{
		return [];
	}
}