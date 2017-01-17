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
use App\Misc\LibMisc;

class PrioritiesController extends BaseController
{
    public function show($idItem, $idItemOpt)
    {
		$priority = null;
        if ($idItem != null && $idItemOpt != null)
        {
	        if ($this->getUserAth()->admin) {
		        $priority = Task::find($idItem)->priorities()->where('task_id', $idItemOpt)->first();
	        } else {
		        $task = Task::where('user_id', $this->getRequest ()->id)->get ();
		        if ($task != null) {
			        $priority = $task->priorities()->where('task_id', $idItemOpt)->first();
		        }
	        }
        }
		    return LibMisc::showMessage($priority);
    }

    public function showAll()
    {
        if ($this->getUserAth()->admin)
        {
            $priority = Priorities::all();
        } else {
            $priority = Priorities::with(['priorities.tasks' => function ($query) {
                $query->where('user_id', '=', $this->getUserAth()->id)->orderBy('created_at', 'desc');
            }])->get();
        }

            return LibMisc::showMessage($priority);
    }

    public function store($idItem)
    {
        $this->getRequest()->only(Priorities::$storeFields);
        $this->validator(Priorities::rules());
        $task = Task::find($idItem);
        if ($task != null) {
            $priority = new Priorities();
            $priority->name = $this->getRequest()->name;
            $priority->task()->associate($task);
            $priority->save();
        }

        return LibMisc::createdMessage($priority);
    }

    public function update($idItem, $idItemOpt)
    {
        $this->getRequest()->only(Priorities::$storeFields);

        $this->validator(Priorities::rules());

        $priority = null;

        if ($idItem != null && $idItemOpt != null)
        {
	        $priority = Task::find($idItem)->priorities()->where('task_id', $idItemOpt)->first();
            if ($priority != null) {
                if ($this->getUserAth()->admin || $priority->task->user->id == $this->getUserAth()->id)
                {
	                if ($this->getRequest()->name != null)
                            $priority->name = $this->getRequest()->name;

                    $priority->save();
                }
            }
        }

        return LibMisc::updatedMessage($priority);
    }

    public function delete($idItem, $idItemOpt)
    {

	    if($idItem != null && $idItemOpt != null)
	    {

		    if ($this->getUserAth()->admin)
		    {
			    $priority = Priorities::find($idItemOpt)->where('task_id', $idItem)->first();
		    } else {
			    $task = Task::where('user_id', '=', $this->getUserAth()->id)->where('id', $idItem)->first();
			    $priority = Priorities::find($idItemOpt)->where('task_id', $task->id)->first();
		    }

		    if ($priority != null) {
			    $priority->delete();
			    return LibMisc::deletedMessage($priority);
		    }else{
			    return LibMisc::showMessage($priority);
		    }
	    }
    }
}
