<?php
/**
 * Created by PhpStorm.
 * User: Ronny
 * Date: 12/31/16
 * Time: 17:44
 */

namespace App\Api\V1\Controllers;
use App\Api\V1\Models\Priorities;
use App\Api\V1\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrioritiesController extends BaseController{
	public function show($idTask, $idPriority)
	{
		$task = Task::find($idTask);
		if(empty($task))
		{
			return $this->response->error('Task not found', 200);
		}

		$user = \Auth::user();

		if($user->admin)
		{
			$priority = Priorities::find($idPriority);
		}else{
			$priority = $user->tasks->priorities()->contains($idPriority);
		}

		if(empty($priority)){
			return $this->response->errorNotFound("Priority not found");
		}

		return $task;
	}

	public function store($idTask, Request $request)
	{
		$request->only(Priorities::$storeFields);

		$validator = Validator::make($request->all(), Priorities::rules());

		if ($validator->fails())
		{
			return $this->response->error($validator->messages(), 200);
		}

		$task = Task::find($idTask);

		if(empty($task))
		{
			return $this->response->error('Not admin privileges', 200);
		}

		$user = \Auth::user();

		$priority = new Priorities();
		$priority->name = $request->name;
		$priority->task()->associate($task);
		$priority->save();

		return $this->response->created($priority->id,$priority);
	}

	public function update($idTask, $idPriority, Request $request)
	{
		$request->only(Priorities::$storeFields);

		$validator = Validator::make($request->all(), Priorities::rules());

		if ($validator->fails())
		{
			return $this->response->error($validator->messages(), 200);
		}

		$task = Task::find($idTask);
		if(empty($task))
		{
			return $this->response->error('Task not found', 200);
		}

		$user = \Auth::user();

		if($user->admin)
		{
			$priority = Priorities::find($idPriority);
		}else{
			$priority = $user->tasks->priorities()->contains($idPriority);
		}

		if(empty($priority)){
			return $this->response->errorNotFound("Priority not found");
		}

		$userAuth = \Auth::user();

		if($userAuth->admin){
			if($priority->name != null)
			{
				$priority->name = $request->name;
				$priority->save();
				return response()->json([$priority->id,$priority]);
			}
		}else{
			if($priority->task()->user()->id == $userAuth->id)
			{
				if($priority->name != null)
				{
					$priority->name = $request->name;
					$priority->save();
				}
				return response()->json([$priority->id,$priority]);
			}else{
				return $this->response->error('Priority not found',200);
			}
		}
	}

	public function delete($idTask, $idPriority)
	{
		$task = Task::find($idTask);
		if(empty($task))
		{
			return $this->response->error('Task not found', 200);
		}

		$user = \Auth::user();

		if($user->admin)
		{
			$priority = Priorities::find($idPriority);
		}else{
			$priority = $user->tasks->priorities()->contains($idPriority);
		}

		$user = \Auth::user();

		if($user->admin)
		{
			$priority->delete();
			return response()->json([$priority->id,$priority]);
		}else{
			if($priority->task()->user()->id == $user->id)
			{
				$priority->delete();
				return response()->json([$priority->id,$priority]);
			}else{
				$this->response->error('Not admin privileges', 200);
			}
		}
	}
} 