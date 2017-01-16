<?php namespace App\Api\V1\Controllers;

use App\Api\V1\Models\User;
use App\Misc\LibMisc;

class UserController extends BaseController
{
    public function show($idItem, $optItem=null)
    {
        $user = User::find($idItem);

        if ($user != null) {
            if ($this->getUserAth()->admin || $user->id == $this->getUserAth()->id) {
                return LibMisc::showMessage($user);
            } else {
                return LibMisc::notAdmin();
            }
        } else {
            return LibMisc::showMessage($user);
        }
    }

    public function showAll()
    {
        $user = User::all();

        if ($user != null) {
            if ($this->getUserAth()->admin) {
                return LibMisc::showMessage($user);
            } else {
                return LibMisc::notAdmin();
            }
        } else {
            return LibMisc::showMessage($user);
        }
    }

    public function store($idItem=null)
    {
        $this->getRequest()->only(User::$storeFields);

        $this->validator(User::rules());

        if ($this->getUserAth()->admin) {
            $newUser = new User();
            $newUser->firstname = $this->getRequest()->firstname;
            $newUser->lastname = $this->getRequest()->lastname;
            $newUser->email = $this->getRequest()->email;
            $newUser->password = \Illuminate\Support\Facades\Hash::make($this->getRequest()->password);
            $newUser->admin = $this->getRequest()->admin ? true : false;
            $newUser->save();
            return LibMisc::createdMessage($newUser);
        } else {
            return LibMisc::notAdmin();
        }
    }

    public function update($idItem=null)
    {
        dd($idItem);
        $this->getRequest()->only(User::$updateFields);

        $user = User::find($idItem);

        if ($user != null) {
            if ($this->getUserAth()->admin || $user->id == $this->getUserAth()->admin->id) {
                if ($this->getRequest()->firstname != null) {
                    if ($user->firstname != $this->getRequest()->firstname) {
                        $user->firstname = $this->getRequest()->firstname;
                    }
                }

                if ($this->getRequest()->lastname != null) {
                    if ($user->lastname != $this->getRequest()->lastname) {
                        $user->lastname = $this->getRequest()->lastname;
                    }
                }

                if ($this->getRequest()->email != null) {
                    if ($user->email != $this->getRequest()->email) {
                        $user->email = $this->getRequest()->email;
                    }
                }

                if ($this->getRequest()->password != null) {
                    if ($user->password != $this->getRequest()->password) {
                        $user->password = \Illuminate\Support\Facades\Hash::make($this->getRequest()->password);
                    }
                }

                if ($this->getRequest()->admin != null) {
                    if ($user->admin != $this->getRequest()->admin) {
                        $user->admin = $this->getRequest()->admin ? true : false;
                    }
                }

                $user->save();

                return LibMisc::createdMessage($user);
            } else {
                return LibMisc::notAdmin();
            }
        } else {
            return LibMisc::showMessage($user);
        }
    }

    public function delete($idItem)
    {
        $user = User::find($idItem);
        if ($user != null) {
            if ($this->getUserAth()->admin || $user->id == $this->getUserAth()->id) {
                $user->delete();
                return LibMisc::deletedMessage($user);
            } else {
                return LibMisc::notAdmin();
            }
        } else {
            return LibMisc::showMessage($user);
        }
    }
}
