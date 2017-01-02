<?php namespace App\Api\V1\Controllers;

use App\Api\V1\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController {

	public function show($id)
	{
		$userAuth = \Auth::user();
		$user = User::find($id);

		if(empty($user)){
			return $this->response->errorNotFound("User Not Found");
		}

		if($userAuth->admin)
		{
			return $user;
		}else{
			if($user->id == $userAuth->id)
			{
				return $user;
			}else{
				$this->response->error('Not admin privileges', 200);
			}
		}
	}

	public function showAll()
	{
		$userAuth = \Auth::user();
		$user = User::all();

		if($user->IsEmpty()){
			return $this->response->errorNotFound("Users Not Found");
		}

		if($userAuth->admin)
		{
			return $user;
		}else{
			$this->response->error('Not admin privileges', 200);
			
		}
	}

	public function store(Request $request)
	{
		$request->only(User::$storeFields);

		$validator = Validator::make($request->all(), User::rules());

		if ($validator->fails())
		{
			$this->response->error($validator->messages(), 200);
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

			return $this->response->created($newUser->id,$newUser);
		}else{
			return $this->response->error('Without admin privileges', 200);
		}
	}

	public function update($id, Request $request)
	{
		$request->only(User::$updateFields);

		$validator = Validator::make($request->all(), User::rules());

		if ($validator->fails())
		{
			$this->response->error($validator->messages(), 200);
		}

		$userAuth = \Auth::user();

		$user = User::find($id);

		if(empty($user)){
			return $this->response->errorNotFound("User Not Found");
		}

		if($userAuth->admin){
			if(!empty($user))
			{
				if($request->firstname != null)
					$user->firstname = $request->firstname;
				if($request->lastname != null)
					$user->lastname = $request->lastname;
				if($request->email != null)
				{
					$user->email = $request->email;
				}
				if($user->password != null)
					$user->password = \Illuminate\Support\Facades\Hash::make($request->password);
				if($user->admin != null)
					$user->admin = $request->admin ? true : false;
				$user->save();
				return response()->json([$user->id,$user]);
			}else{
				return $this->response->error('User not found',200);
			}
		}else{
			if($user->id == $userAuth->id)
			{
				if($user->firstname != null)
					$user->firstname = $request->firstname;
				if($user->lastname != null)
					$user->lastname = $request->lastname;
				if($user->email != null)
				{
					$checkEmail = User::where('email','=',$request->email)->first();
					if(!empty($checkEmail))
					{
						if($checkEmail->email != $request->email)
						{
							$user->email = $request->email;
						}
					}
				}
				if($user->password != null)
					$user->password = \Illuminate\Support\Facades\Hash::make($request->password);
				if($user->admin != null)
					$user->admin = $request->admin ? true : false;
				$user->save();
				return response()->json([$user->id,$user]);
			}else{
				return $this->response->error('Not admin privileges', 200);
			}
		}
	}

	public function delete($id)
	{
		$userAuth = \Auth::user();
		$user = User::find($id);

		if(empty($user)){
			return $this->response->errorNotFound("User Not Found");
		}

		if($userAuth->admin)
		{
			$user->delete();
			return response()->json([$user->id,$user]);
		}else{
			if($user->id == $userAuth->id)
			{
				$user->delete();
				return response()->json([$user->id,$user]);
			}else{
				$this->response->error('Not admin privileges', 200);
			}
		}
	}
}
