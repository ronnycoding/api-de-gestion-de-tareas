<?php
/**
 * Created by PhpStorm.
 * User: Ronny
 * Date: 1/5/17
 * Time: 19:55
 */
namespace App\Misc;

class LibMisc {

	const NOT_FOUND = 'Not found';

	const NOT_ADMIN = 'Need admin\'s permission';

	const CREATED = 'Has been created';

	const UPDATE = 'Has been updated';

	const DELETED = 'Has been deleted';

	const OK = 'ok';

	const NOK = 'nok';

	public static function getOK()
	{
		return self::OK;
	}

	public static function getNOK()
	{
		return self::NOK;
	}

	public static function getNotFound()
	{
		return self::NOT_FOUND;
	}

	public static function getNotAdmin()
	{
		return self::NOT_ADMIN;
	}

	public static function getCreated()
	{
		return self::CREATED;
	}

	public static function getUpdated()
	{
		return self::UPDATE;
	}

	public static function getDeleted()
	{
		return self::DELETED;
	}

	public static function showMessage($obj)
	{
		if($obj == null)
		{
			return response()->json(
				[
					'result'=> self::getNOK(),
					'message'=> self::NOT_FOUND,
					'data'=> '[]'
				]
			);
		}else {
			return response()->json(
				[
					'result'=> self::getOK(),
					'data'=> $obj
				]
			);
		}
	}

	public static function notAdmin()
	{
		return response()->json(
			[
				'result'=> self::getOK(),
				'message'=> self::notAdmin(),
				'data'=> '[]'
			]
		);
	}

	public static function validatorFails($message)
	{
		return response()->json(
			[
				'result'=> self::getNOK(),
				'message'=> $message,
				'data'=> '[]'
			]
		);
	}

	public static function createdMessage($obj)
	{
		return response()->json(
			[
				'result'=> self::getOK(),
				'message'=>self::getCreated(),
				'data'=> $obj
			]
		);
	}

	public static function updatedMessage($obj)
	{
		if($obj == null)
		{
			return response()->json(
				[
					'result'=> self::getNOK(),
					'message'=> self::getNotFound(),
					'data'=> '[]'
				]
			);
		}else{
			return response()->json(
				[
					'result'=> self::getOK(),
					'message'=>self::getUpdated(),
					'data'=> $obj
				]
			);
		}
	}

	public static function deletedMessage($obj)
	{
		if($obj == null)
		{
			return response()->json(
				[
					'result'=> self::getNOK(),
					'message'=> self::getNotFound(),
					'data'=> '[]'
				]
			);
		}else{
			return response()->json(
				[
					'result'=> self::getOK(),
					'message'=>self::getDeleted(),
					'data'=> $obj
				]
			);
		}
	}
} 