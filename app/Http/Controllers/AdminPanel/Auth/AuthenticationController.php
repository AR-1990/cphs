<?php

namespace App\Http\Controllers\AdminPanel\Auth;

use App\Http\Controllers\Controller;
use App\Http\Helpers\GeneralHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\LogActivity as LogActivityModel;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;


class AuthenticationController extends Controller
{
    protected $data = [];
    function __construct()
    {
        $this->data['main']      = 'university';
        $this->data['_pagepath'] = "login";
        $this->data['role']      = request()->route('loginfor');
    }

    public function index(Request $request)
    {

        if(Auth::guard(config('constants.ADMIN_GUARD'))->check())
        {
            return redirect()->intended(route('admin.dashboard.index'));
        }
        else if(Auth::guard(config('constants.STUDENT_GUARD'))->check())
        {
            return redirect()->intended(route('studentDashboard'));
        }
        else{

            // echo $this->data['main'];exit;
            // echo $this->data['_pagepath'];exit;
           
            // echo "<PRE>";print_r($this->data);exit;

            
            return view(GeneralHelper::view($this->data['main'],$this->data['_pagepath']), $this->data);
        }
    }

    public function submitForm(Request $request)
    {
        $validation_fields  = [
            "email"             => "required|email|useremailexist:email,admins|logincredentials:email,password,role",
            "password"          => "required",
        ];

        $validator = Validator::make($request->all(), $validation_fields);
        if ($validator->fails()) {
            return view(GeneralHelper::view($this->data['main'],$this->data['_pagepath']), $this->data)->with("errors", $validator->messages()->toArray());
        } else {

            $credentials = [
                "email"     => $request['email'],
                "password"  => $request["password"]
            ];

            Auth::guard(config('constants.STUDENT_GUARD'))->logout();
            Auth::guard(config('constants.ADMIN_GUARD'))->logout();
            $request->session()->flush();

            $role = config('constants.ROLE.'.$request->get('role'));
            Auth::guard(config('constants.ROLE.'.$role))->attempt( $credentials, false );

            // echo "<PRE>";print_r($request->all());

            // echo " config('constants.ADMIN_GUARD') ". config('constants.ADMIN_GUARD');
            // echo "<BR>";

            // echo " config('constants.STUDENT_GUARD') ". config('constants.STUDENT_GUARD');
            // echo "<BR>";

            // echo Auth::guard(config('constants.ADMIN_GUARD'))->user()->id;echo "<BR>";

            // $role = Auth::guard(config('constants.ADMIN_GUARD'))->check() ? config('constants.ADMIN_GUARD') : config('constants.STUDENT_GUARD');

            // echo "role ".$role;
            // echo "<BR>";

            // echo "role id ".$role->user()->id;
            // echo "<BR>";

            // $defaultGuardConfig = config('auth.defaults.guard');
            // echo "<PRE>";print_r($defaultGuardConfig);exit;

             /*Login Log*/
              \LogActivity::addToLog('Logged In.');

              $user = User::find(Auth::guard(config('constants.ADMIN_GUARD'))->user()->id);
              if (empty($user)) {
                  $message = "Some error occurs try later.";
                  Session::flash("error_message", $message);
                  return redirect()->route('dashboard');
              }
              Auth::login($user);

            return redirect()->intended(route($request->get('role') == "admin"  ? 'admin.dashboard.index' : "studentDashboard"));
        }
    }

    public function logout(Request $request)
    {
         /*Login Log*/
        //  \LogActivity::addToLog('Logged out.');

        // echo "<PRE>";print_r(Session::all());exit;

         if (Session::has('log_activity_id')) {

            // echo "Session::get('log_activity_id'".Session::get('log_activity_id');
            // exit;

            $LogActivityModel = LogActivityModel::find(Session::get('log_activity_id'));
            if(!empty($LogActivityModel))
            {
                // $LogActivityModel->check_out_time = date('Y-m-d H:i:s');
                // $LogActivityModel->check_out_time = now();
                $LogActivityModel->check_out_time = Carbon::now('Asia/karachi');
                $LogActivityModel->save();
            }
			
         }

        

        $role = Auth::guard(config('constants.ADMIN_GUARD'))->check() ? config('constants.ADMIN_GUARD') : config('constants.STUDENT_GUARD');

        Auth::guard(config('constants.ADMIN_GUARD'))->logout();
        Auth::guard(config('constants.STUDENT_GUARD'))->logout();
        $request->session()->flush();
Session::flush();

        return redirect()->intended(route($role == "admin"  ? 'admin.dashboard.index' : "studentDashboard"));
    }
}
