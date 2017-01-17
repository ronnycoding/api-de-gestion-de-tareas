<?php namespace App\Api\V1\Controllers;

use App\Misc\LibMisc;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use Helpers;

    protected $userAuth;

    protected $request;

    public function __construct(Request $request)
    {
        $this->userAuth = \Auth::user();
        $this->request = $request;
    }

    public function getUserAth()
    {
        return $this->userAuth;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function validator($rules)
    {
        $validator = Validator::make($this->getRequest()->all(), $rules);

        if ($validator->fails()) {
            die(LibMisc::validatorFails($validator->messages()));
        }
    }
}
