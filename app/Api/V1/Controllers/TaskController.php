<?php
/**
 * Created by PhpStorm.
 * User: Ronny
 * Date: 12/31/16
 * Time: 12:25
 */

namespace App\Api\V1\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Api\V1\Models\Task;

class TaskController extends BaseController{

	public function show($id)
	{
		$user = \Auth::user();

		$task = Task::find($id);

		if(empty($task)){
			return $this->response->errorNotFound("Task not found");
		}


		dd($task);

		if($user->admin)
		{
			return $task;	
		}else{
			if($user->id == $task->user()->id)
			{
				return $task;
			}else{
				return $this->response->errorNotFound("Task not found");
			}
		}
		
	}

	public function showAll()
	{
		$user = \Auth::user();

		$task = Task::all();

		if(empty($task)){
			return $this->response->errorNotFound("Tasks Not Found");
		}

		if($user->admin)
		{
			return $task;
		}else{
			$task = Task::where('user_id','=',$user->id)->get();
			if($task->IsEmpty()){
				return $this->response->errorNotFound("Tasks Not Found");
			}
			return $task;
		}
	}

	public function store(Request $request)
	{
		$request->only(Task::$storeFields);

		$validator = Validator::make($request->all(), Task::rules());

		if ($validator->fails())
		{

			return $this->response->error($validator->messages(), 200);
		}

		$user = \Auth::user();

		$task = new Task();
		$task->title = $request->title;
		$task->description = $request->description;
		$task->due_description = $request->due_description;
		$task->user()->associate($user);
		$task->save();

		return $this->response->created($task->id,$task);
	}

	public function update($idTask, Request $request)
	{
		$request->only(Task::$storeFields);

		$validator = Validator::make($request->all(), Task::rules());

		if ($validator->fails())
		{
			return $this->response->error($validator->messages(), 200);
		}

		$userAuth = \Auth::user();

		$task = Task::find($idTask);

		if(empty($task)){
			return $this->response->errorNotFound("Tasks Not Found");
		}

		if($userAuth->admin){

			if($task->title != null)
					$task->title = $request->title;
				if($task->description != null)
					$task->description = $request->description;
				if($task->due_description != null)
					$task->due_description = $request->due_description;
				$task->save();
				return response()->json([$task->id,$task]);
		}else{
			if($task->user()->id == $userAuth->id)
			{
				if($task->title != null)
					$task->title = $request->title;
				if($task->description != null)
					$task->description = $request->description;
				if($task->due_description != null)
					$task->due_description = $request->due_description;
				$task->save();
				return response()->json([$task->id,$task]);
			}else{
				return $this->response->error('Tasks not found',200);
			}
		}
	}

	public function delete($id)
	{
		$userAuth = \Auth::user();
		$task = Task::find($id);

		if(empty($task)){
			return $this->response->errorNotFound("Tasks Not Found");
		}

		if($userAuth->admin)
		{
			$task->delete();
			return response()->json([$task->id,$task]);
		}else{
			if($task->user()->id == $userAuth->id)
			{
				$task->delete();
				return response()->json([$task->id,$task]);
			}else{
				return $this->response->error('Not admin privileges', 200);
			}
		}
	}
} 