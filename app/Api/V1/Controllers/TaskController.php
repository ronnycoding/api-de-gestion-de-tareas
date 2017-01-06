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
use App\Misc\LibMisc;


class TaskController extends BaseController{

	public function show($id)
	{
		$user = \Auth::user();

		$task = Task::find($id);

		if($user->admin || $user->id == $task->user->i)
		{
			return LibMisc::showMessage($task);
		}else{
			return LibMisc::notAdmin();
		}
		
	}

	public function showAll()
	{
		$user = \Auth::user();

		$task = Task::all();

		if($user->admin)
		{
			return LibMisc::showMessage($task);
		}else{
			$task = Task::where('user_id','=',$user->id)->get();
			return LibMisc::showMessage($task);
		}
	}

	public function store(Request $request)
	{
		$request->only(Task::$storeFields);

		$validator = Validator::make($request->all(), Task::rules());

		if ($validator->fails()) {
			return LibMisc::validatorFails($validator->messages());
		}

		$user = \Auth::user();

		$task = new Task();
		$task->title = $request->title;
		$task->description = $request->description;
		$task->due_description = $request->due_description;
		$task->user()->associate($user);
		$task->save();

		return LibMisc::createdMessage($task);
	}

	public function update($idTask, Request $request)
	{
		$request->only(Task::$storeFields);

		$validator = Validator::make($request->all(), Task::rules());

		if ($validator->fails())
		{
			return LibMisc::validatorFails($validator->messages());
		}

		$userAuth = \Auth::user();

		$task = Task::find($idTask);

		if($userAuth->admin || $task->user->id == $userAuth->id){

			if(isset($task) && $task != null)
			{
				if($task->title != null)
					$task->title = $request->title;
				if($task->description != null)
					$task->description = $request->description;
				if($task->due_description != null)
					$task->due_description = $request->due_description;
				$task->save();
			}
			return libMisc::updatedMessage($task);
		}else{
			return LibMisc::notAdmin();
		}
	}

	public function delete($id)
	{
		$userAuth = \Auth::user();
		$task = Task::find($id);

		if($userAuth->admin || $task->user->id == $userAuth->id)
		{
			if(isset($task) && $task != null)
			{
				$task->delete();
			}
			return LibMisc::deletedMessage($task);
		}else{
			return LibMisc::notAdmin();
		}
	}
} 