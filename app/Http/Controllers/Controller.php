<?php

namespace App\Http\Controllers;

use App\Utils\PermissionHelper;
use Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, PermissionHelper;

    public function customValidate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
            $validator = Validator::make($request->all(), $rules, $messages , $customAttributes);

            if ($validator->fails()) {
                foreach ( $validator->messages()->get('*') as $title =>$message){
                    // toastr()->error($message[0], $title);
                    toastr($message[0], 'error', '',
                     ['positionClass'=>'toast-top-right',"closeButton"=> true,"timeOut"=> 15000]);

                }
                $this->validate($request , $rules , $messages , $customAttributes);
            }
    }
}
