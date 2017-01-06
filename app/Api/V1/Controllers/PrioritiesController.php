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
use App\Misc\LibMisc;

class PrioritiesController extends BaseController{
	public function show($idTask, $idPriority)
	{
		$task = Task::find($idTask);
		$user = \Auth::user();

		if($user->admin)
		{
			$priority = Priorities::find($idPriority);
		}else{
			$priority = $user->tasks->priorities()->contains($idPriority);
		}

		return LibMisc::showMessage($priority);
	}

	public function showAll()
	{
		$user = \Auth::user();

		if($user->admin)
		{
			$priority = Priorities::all();
		}else{
			$priority = Priorities::with(['priorities.tasks' => function ($query) {
    			$query->where('user_id','=',$user->id)->orderBy('created_at', 'desc');
			}])->get();
		}

		return LibMisc::showMessage($priority);
	}

	public function store($idTask, Request $request)
	{
		$request->only(Priorities::$storeFields);
		$validator = Validator::make($request->all(), Priorities::rules());

		if ($validator->fails())
			return LibMisc::validatorFails($validator->messages());

		$task = Task::find($idTask);
		$user = \Auth::user();
		if(!empty($task) && isset($task))
		{
			$priority = new Priorities();
			$priority->name = $request->name;
			$priority->task()->associate($task);
			$priority->save();
			return LibMisc::createdMessage($priority);
		}
	}

	public function update($idTask, $idPriority, Request $request)
	{
		$request->only(Priorities::$storeFields);
		$validator = Validator::make($request->all(), Priorities::rules());
		if ($validator->fails())
			return LibMisc::validatorFails($validator->messages());
		$task = Task::find($idTask);
		if(empty($task) && !isset($task))
		{
			return LibMisc::validatorFails('Task not found');
		}

		$priority = Priorities::find($idPriority);

		if(empty($priority)  && !isset($priority))
		{
			return LibMisc::validatorFails('Priority not found');
		}

		$userAuth = \Auth::user();

		if($userAuth->admin || $priority->task->user->id == $userAuth->id)
		{
			if($priority->name =! $request->name)
				$priority->name = $request->name;
					$priority->save();
		}else{
			$priority = null;
		}
		return LibMisc::updatedMessage($priority);
	}

	public function delete($idTask, $idPriority)
	{
		$task = Task::find($idTask);

		if(empty($task)  && !isset($task))
		{
			return LibMisc::validatorFails('Task not found');
		}

		$user = \Auth::user();
		if($user->admin)
		{
			$priority = Priorities::find($idPriority);
		}else{
			$priority = $user->tasks->priorities()->contains($idPriority);
		}

		if($user->admin || $priority->task()->user()->id == $user->id)
		{
			$priority->delete();
			return LibMisc::deletedMessage($priority);
		}else{
			return LibMisc::notAdmin();
		}
	}
} 