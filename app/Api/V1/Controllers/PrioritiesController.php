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

class PrioritiesController extends BaseController implements Methods
{
    public function show($idItem, $optItem=null)
    {
        $task = Task::find($idItem);
	    if($task != null)
	    {
		    if ($this->getUserAth()->admin)
		    {
			    $priority = $task->priorities()->contains($optItem);
		    }else{
			    $task = $this->getUserAth()->$task->contains($idItem);
			    $priority = $task->priorities()->contains($optItem);
		    }

		    if($priority != null)
		    {
				return LibMisc::showMessage($priority);
		    }else{
			    return LibMisc::notAdmin();
		    }
	    }else{
		    return LibMisc::showMessage($task);
	    }
    }

    public function showAll()
    {
        if ($this->getUserAth()->admin) {
            $priority = Priorities::all();
        } else {
            $priority = Priorities::with(['priorities.tasks' => function ($query) {
                $query->where('user_id', '=', $this->getUserAth()->id)->orderBy('created_at', 'desc');
            }])->get();
        }

	    if($priority != null)
	    {
		    return LibMisc::showMessage($priority);
	    }else{
		    return LibMisc::notAdmin();
	    }
    }

    public function store($idItem=null)
    {
	    $this->getRequest()->only(Priorities::$storeFields);
		$this->validator(Priorities::rules());
        $task = Task::find($idItem);
	    if($task != null)
	    {
		    $priority = new Priorities();
		    $priority->name = $this->getRequest()->name;
		    $priority->task()->associate($task);
		    $priority->save();
	    }

	    return LibMisc::createdMessage($priority);
    }

    public function update($idItem=null, $idItemOpt=null)
    {
	    $this->getRequest()->only(Priorities::$storeFields);

	    $this->validator(Priorities::rules());

        $task = Task::find($idItem);

	    $priority = null;

	    if($task != null)
	    {
		    $priority = $task->priorities()->contains($idItemOpt);
		    if($priority != null)
		    {
			    if ($this->getUserAth()->admin || $priority->task->user->id == $this->getUserAth()->id)
			    {
				    if ($this->getRequest()->name != null)
				        if ($priority->name =! $this->getRequest()->name)
					        $priority->name = $this->getRequest()->name;

				    $priority->save();
			    }
		    }
	    }

	    return LibMisc::showMessage($priority);
    }

    public function delete($idItem, $idItemOpt=null)
    {
        $task = Task::find($idItem);

        if ($this->getUserAth()->admin) {
            $priority = $task->priorities()->contains($idItemOpt);
        } else {
            $priority = $this->getUserAth()->tasks->priorities()->contains($idItemOpt);
        }

	    if($priority == null) return LibMisc::createdMessage($priority);

        if ($this->getUserAth()->admin || $priority->task()->user()->id == $this->getUserAth()->id) {
            $priority->delete();
            return LibMisc::deletedMessage($priority);
        } else {
            return LibMisc::notAdmin();
        }
    }
}
