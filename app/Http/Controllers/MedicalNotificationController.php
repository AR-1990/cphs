<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MedicalNotifications;
use App\Models\StudentBiodata;
use DataTables;

class MedicalNotificationController extends Controller
{

    public function MedicalNotificationClick(Request $request)
    {
        $id = $request->input('id');


        // Find the record by id
        $notification = MedicalNotifications::find($id);

        // Check if the notification exists
        if ($notification) {
            // Update the column (e.g., 'status' column)
            $notification->read_status = 0; // or whatever value you need
            $notification->save();

            // Return a JSON response
            return response()->json(['status' => 'success', 'message' => 'Notification updated successfully']);
        }

        // If notification not found
        return response()->json(['status' => 'error', 'message' => 'Notification not found'], 404);
    }

    /* ShowMedicalNotificationView*/
    public function ShowMedicalNotificationView()
    {
        return view("admin.MedicalHistory.notifications");

    }


 /* getMedicalNotifications */
    public function getMedicalNotifications(Request $request)
    {
        $user = auth()->guard('admin')->user();
        $UserIDNotification = $user->id;
        $UserRoleNotification = $user->role;
        $UserDesignationNotification = $user->designation;

        $MedicalNotifications = MedicalNotifications::where('deleted', 0);

        $MedicalNotifications = $MedicalNotifications->orderBy('id','desc');

       /* if ($UserDesignationNotification == 1) {
            $MedicalNotifications = $MedicalNotifications->where(function ($query) use ($UserIDNotification) {
                $query->where('created_by', $UserIDNotification)
                    ->orWhere('updated_by', $UserIDNotification);
            });
        }*/

         /* admin role */
         if ($UserRoleNotification == 1) {

            $MedicalNotifications = $MedicalNotifications->where('created_by', "!=", null);

        } else {
            $MedicalNotifications = $MedicalNotifications->where('created_by', $UserIDNotification);
        }


        $UserDesignationNotification = $MedicalNotifications->get()->toArray();

        return DataTables::of($MedicalNotifications)
        ->addIndexColumn()

            ->addColumn('NotificationText', function ($row) {
                
                $NotificationText = "Check your Medical History";
                $StudentBiodataNotifications = StudentBiodata::find($row['redirect_link']);

                if(!empty($StudentBiodataNotifications))
                {
                    $NotificationText = 'Check  <b>GR: ' . $StudentBiodataNotifications->GRNo . '</b>, <b>' . $StudentBiodataNotifications->name . '</b>,  Medical History';
                }

                return $NotificationText;


            })
            ->addColumn('action', function ($row) {
                $class = $row->read_status == 1 ? 'btn-success' : 'btn-primary';
                
                /* School role = 3 */
                if(auth()->guard('admin')->user()->role == 3)
                {
                    return "<a data-href-1='" . route('SchoolHealthPhysician') . "/" . $row->redirect_link . "' class='btn btn-sm $class MedicalNotificationClick' data-id='{$row->id}' data-href='#'>View</a>";

                }
                return "<a data-href-1='" . route('SchoolHealthPhysician') . "/" . $row->redirect_link . "' class='btn btn-sm $class MedicalNotificationClick' data-id='{$row->id}' data-href='" . route('SchoolHealthPhysician') . "/" . $row->redirect_link . "'>View</a>";
            })
            ->addColumn('row_class', function ($row) {
                return $row->read_status == 1 ? 'unread text-light' : '';
            })
            ->rawColumns(['action','NotificationText'])
            ->make(true);
    }

}