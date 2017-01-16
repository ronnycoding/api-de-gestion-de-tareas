<?php
/**
 * Created by PhpStorm.
 * User: Ronny
 * Date: 12/31/16
 * Time: 12:25
 */

namespace App\Api\V1\Controllers;

use App\Api\V1\Models\Task;
use App\Misc\LibMisc;

class TaskController extends BaseController
{
    public function show($idItem, $optItem=null)
    {
        $task = Task::find($idItem);

	    if($task != null)
	    {
		    if ($this->getUserAth ()->admin || $this->getUserAth ()->id == $task->user->id) {
			    return LibMisc::showMessage($task);
		    } else {
			    return LibMisc::notAdmin();
		    }
	    }else{
		    return LibMisc::showMessage($task);
	    }

    }

    public function showAll()
    {
        $task = Task::all();

	    if($task != null) {
		    if ($this->getUserAth()->admin) {
			    return LibMisc::showMessage($task);
		    } else {
			    $task = Task::where('user_id', '=', $this->getUserAth()->id)->get();
			    return LibMisc::showMessage($task);
		    }
	    }else{
		    return LibMisc::showMessage($task);
	    }
    }

    public function store($idItem=null)
    {
	    $this->getRequest()->only(Task::$storeFields);

	    $this->validator(Task::rules());

        $task = new Task();
        $task->title = $this->getRequest()->title;
        $task->description = $this->getRequest()->description;
        $task->due_description = $this->getRequest()->due_description;
        $task->user()->associate($this->getUserAth());
        $task->save();

        return LibMisc::createdMessage($task);
    }

    public function update($idItem=null, $idItemOpt=null)
    {
	    $this->getRequest()->only(Task::$storeFields);

	    $this->validator(Task::rules());

        $task = Task::find($idItem);

	    if($task != null)
	    {
		    if ($this->getUserAth()->admin || $task->user->id == $this->getUserAth()->id) {

			    if ($this->getRequest()->title != null)
				    if($task->title != $this->getRequest()->title)
				        $task->title = $this->getRequest()->title;

			    if ($this->getRequest()->description != null)
			        if ($task->description != $this->getRequest()->description)
				        $task->description = $this->getRequest()->description;

			    if ($this->getRequest()->due_description != null)
			        if ($task->due_description != $this->getRequest()->due_description)
				        $task->due_description = $this->getRequest()->due_description;

			    $task->save();
			    return libMisc::updatedMessage($task);
		    } else {
			    return LibMisc::notAdmin();
		    }
	    }else{
		    return LibMisc::showMessage($task);
	    }
    }

    public function delete($idItem, $idItemOpt=null)
    {
        $task = Task::find($idItem);
	    if($task != null)
	    {
		    if ($this->getUserAth()->admin || $task->user->id == $this->getUserAth()->id) {
			    $task->delete();
			    return LibMisc::deletedMessage($task);
		    } else {
			    return LibMisc::notAdmin();
		    }
	    }else{
		    return LibMisc::showMessage($task);
	    }
    }
}
