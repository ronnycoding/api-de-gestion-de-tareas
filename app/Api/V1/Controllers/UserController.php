<?php namespace App\Api\V1\Controllers;

use App\Api\V1\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Misc\LibMisc;

class UserController extends BaseController {

	public function show($id)
	{
		$userAuth = \Auth::user();
		$user = User::find($id);

		if($userAuth->admin || $user->id == $userAuth->id)
		{
			return LibMisc::showMessage($user, new User());
		}else{
			return LibMisc::notAdmin();
		}
	}

	public function showAll()
	{
		$userAuth = \Auth::user();
		$user = User::all();

		if($userAuth->admin)
		{
			return $user;
		}else{
			return LibMisc::notAdmin();
		}
	}

	public function store(Request $request)
	{
		$request->only(User::$storeFields);
		$validator = Validator::make($request->all(), User::rules());
		if ($validator->fails())
		{
			return LibMisc::validatorFails($validator->messages());
		}
		$user = \Auth::user();
		if($user->admin){
			$newUser = new User();
			$newUser->firstname = $request->firstname;
			$newUser->lastname = $request->lastname;
			$newUser->email = $request->email;
			$newUser->password = \Illuminate\Support\Facades\Hash::make($request->password);
			$newUser->admin = $request->admin ? true : false;
			$newUser->save();
			return LibMisc::createdMessage($newUser);
		}else{
			return LibMisc::notAdmin();
		}
	}

	public function update($id, Request $request)
	{
		$request->only(User::$updateFields);
		$validator = Validator::make($request->all(), User::rules());
		if ($validator->fails())
		{
			return LibMisc::validatorFails($validator->messages());
		}
		$userAuth = \Auth::user();
		$user = User::find($id);
		if($userAuth->admin || $user->id == $userAuth->id){
			if(!empty($user) && isset($user))
			{
				if($request->firstname != null)
					if($user->firstname != $request->firstname)
						$user->firstname = $request->firstname;
				if($request->lastname != null)
					if($user->lastname != $request->lastname)
						$user->lastname = $request->lastname;
				if($request->email != null)
					if($user->email != $request->email)
						$user->email = $request->email;
				if($user->password != null)
					if($user->password != $request->password)
						$user->password = \Illuminate\Support\Facades\Hash::make($request->password);
				if($user->admin != null)
					if($user->admin != $request->admin)
						$user->admin = $request->admin ? true : false;
				$user->save();
			}
			return LibMisc::createdMessage($user);
		}else{
			return LibMisc::notAdmin();
		}
	}

	public function delete($id)
	{
		$userAuth = \Auth::user();
		$user = User::find($id);
		if($userAuth->admin || $user->id == $userAuth->id)
		{
			if(isset($user) && $user != null)
			{
				$user->delete();
			}
			return LibMisc::deletedMessage($user);
		}else{
			return LibMisc::notAdmin();
		}
	}
}
