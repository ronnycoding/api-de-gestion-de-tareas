<?php namespace App\Api\V1\Models;
/**
 * Created by PhpStorm.
 * User: Ronny
 * Date: 12/29/16
 * Time: 18:35
 */

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements Authenticatable, JWTSubject{

	use \Illuminate\Auth\Authenticatable;

	protected $primarykey = 'id';

	protected $fillable = ['firstname', 'lastname', 'email', 'email', 'password','admin'];

	public static $storeFields = ['firstname', 'lastname', 'email', 'email', 'password','admin'];

	public static $updateFields = ['firstname', 'lastname', 'email', 'email', 'password','admin'];

	protected $dates = ["deleted_at"];

	public static function rules()
	{
		return [
			'firstname' => 'required',
			'lastname' => 'required',
			'email' => 'unique:users|email|required',
			'password' => 'required',
			'admin' => 'boolean',
			'token' => 'required',
		];
	}

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

	/**
	 * Eloquent relationship
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function tasks()
	{
		return $this->hasMany(Task::class);
	}
}