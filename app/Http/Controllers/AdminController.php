<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogActivity as LogActivityModel;
use App\Models\User;
use DataTables;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function LogActivity()
    {
        return view('admin.LogActivity');
    }

    public function LogActivityList(Request $request)
    {

        // $data = LogActivityModel::with('users')->orderBy('id', 'desc')->where('deleted',0);
        $data = LogActivityModel::orderBy('id', 'desc')->where('deleted',0);

        if ($request->has('startDate')) {
            if (!empty($request->startDate)) {

                    // echo "<PRE>";
                    // print_r($request->all());
                    // exit;

                    // $data  = $data->where('check_in_time',  $request->startDate))

                  $search = $request->startDate;

                    $data = $data->where(function ($query) use ($search) {
                        $query->whereDate('check_in_time', $search)
                        ->whereDate('check_in_time', $search);
                    });


                // $dateRange = explode('-', $request->startDate);
                // $from = date('Y-m-d', strtotime($dateRange[0]));
                // $to = date('Y-m-d', strtotime($dateRange[1]));
                // $data = $data->whereBetween('created_at', [$from, $to]);
            }
        }


        $data = $data->get()->toArray();

        // echo "<PRE>";print_r($data);exit;

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('user', function ($row) {

                // $fullname = $row['users']['fullname'];
                $fullname = "N/A";

                $User = User::where('id',$row['user_id'])->first();
                if(!empty($User))
                {
                    $fullname  =  $User['fullname'];;
                }
                return $fullname;
            })
            ->addColumn('action', function ($row) {
                $btn = "";

                // $btn .= ' &nbsp;<a title="Delete" href="javascript:void(0)" class="confirmDeleteIt"  data-id="' . $row['id'] . '" data-url="' . Route('LogActivityDelete') . '"> <i class="fa fa-check iic text-light"></i></a>';
                $btn .= ' &nbsp;<a title="Delete" href="javascript:void(0)" class="confirmDeleteIt"  data-id="' . $row['id'] . '" data-url="' . Route('LogActivityDelete') . '"> <i class="fa fa-close iic text-light"></i></a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }


    /* LogActivityDelete*/

    public function LogActivityDelete(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $dataArr = $request->all();

//            echo "<PRE>";
//            print_r($dataArr);
//            exit;

 $userID = Auth::guard(config('constants.ADMIN_GUARD'))->check() ? Auth::guard(config('constants.ADMIN_GUARD'))->user()->id : Auth::guard(config('constants.STUDENT_GUARD'))->user()->id;

            $returnAffected = LogActivityModel::where('id', $dataArr['deleteId'])->update(array('deleted' => 1, 'updated_by' => $userID));
            // $returnAffected = LogActivityModel::where('id', $dataArr['deleteId'])->delete();

            if ($returnAffected === 0) {
                $message = "Some Issue Occurs try later";
                return response()->json(array(
                    'status' => false,
                    'message' => $message,
                ));
            }

            $message = "Deleted successfully";

            return response()->json(array(
                'status' => true,
                'message' => $message,
                'returnAffected' => $returnAffected,
            ));

        } else {
            $message = "Some Issue Occurs try later";
            return response()->json(array(
                'status' => false,
                'message' => $message,
            ));
        }


    }
}
