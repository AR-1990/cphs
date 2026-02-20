<?php


namespace App\Helpers;

use Request;
use App\Models\LogActivity as LogActivityModel;

use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogActivity
{


	public static function addToLog($subject)
	{
		$log = [];
		$log['subject'] = $subject;
		$log['url'] = Request::fullUrl();
		$log['method'] = Request::method();
		$log['ip'] = Request::ip();
		$log['agent'] = Request::header('user-agent');
		// $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
		$log['user_id'] = Auth::guard(config('constants.ADMIN_GUARD'))->check() ? Auth::guard(config('constants.ADMIN_GUARD'))->user()->id : Auth::guard(config('constants.STUDENT_GUARD'))->user()->id;


		//        $requestAll = Request::all();
		//        echo "<PRE>";print_r($requestAll);exit;

		$ip = Request::ip(); /*Dynamic IP address*/

		$currentUserInfo = Location::get($ip);
		$currentUserInfo = json_decode(json_encode($currentUserInfo), true);

		//        echo json_encode($currentUserInfo);
		//        echo "<BR>";

		$log['location_details'] = json_encode($currentUserInfo);




		// Store the ID in the session
		

		// Check if the ID already exists in the session
		if (!Session::has('log_activity_id')) {
			// Store the ID in the session if it doesn't exist
			//        echo "<PRE>";print_r($log);exit;

			$newLog = LogActivityModel::create($log);

			// Access the ID of the created record
			$newLogId = $newLog->id;

			Session::put('log_activity_id', $newLogId);
		} else {

			
		}

	}


	public static function logActivityLists()
	{
		return LogActivityModel::latest()->get();
	}


}