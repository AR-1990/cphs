<?php

namespace App\Http\Helpers;

use Log;
use Config;
use Session;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Request;

class CustomValidators extends Validator
{
    public function validateuseremailexist($attribute, $value, $parameters)
    {
        if ((User::where($attribute, $value)->count() > 0) || (Student::where($attribute, $value)->count() > 0)) {
            return true;
        }
        return false;
    }

    public function validatelogincredentials($attribute, $value, $parameters)
    {

        $request = Request::all();
        $credentials =  [
                            $parameters[0] => $request[$parameters[0]],
                            $parameters[1] => $request[$parameters[1]],
                        ];
        
        if ($request[$parameters[2]] == config('constants.ADMIN_GUARD') && Auth::guard('admin')->validate($credentials)) {
            return true;
        }
        if ($request[$parameters[2]] == config('constants.STUDENT_GUARD') && Auth::guard('student')->validate($credentials)) {
            return true;
        }
        
        return false;
    }
}