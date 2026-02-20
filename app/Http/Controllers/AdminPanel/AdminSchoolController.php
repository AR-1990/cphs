<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Support\Facades\DB;
use App\Models\City;
use App\Models\User;
use DataTables;
use Session;
use Illuminate\Support\Facades\File;
class AdminSchoolController extends Controller
{
    public function index()
    {
        $school = School::orderBy('id', 'desc')->get();

        return view('admin.school', compact('school'));

    }
    public function update_training(Request $request)
    {
        $updated = DB::table('trainings')
                ->where('id', $request->id)  // Where clause to find the record you want to update
                ->update([
                    'title' => $request->topic,
                    'descriptions' => $request->description,
                    'location' => $request->location,
                    'taken_by' => $request->taken_by,
                    'audiance_count' => $request->audiance_count,
                    'created_at' => $request->date,  // You may choose to update this or keep the original value
                    'updated_at' => now(),  // Use `now()` for the updated timestamp
                ]);
                if ($updated) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Training updated successfully.'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Failed to update the training. Please try again.'
                    ]);
                }
      

    }
    public function trainingsIndex()
    {$user = User::whereIn('role',[1,2])->get();
        // $user = User::where('status',1)->whereIn('role',[1,2])->get();
        $training = DB::table('trainings')->get();
        // // School::orderBy('id', 'desc')->get();
        //     dd($user );
        return view('admin.trainings', compact('training','user'));

    }
    public function add_Training(Request $request)
    {
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'topic' => 'required',
            'taken_by' => 'required',
            'attendees_count' => 'required',
            'date' => 'required',
            'description' => 'required',
        ]);

       
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422); 
        }


        DB::table('trainings')->insert([
            'title' => $request->topic,
            'descriptions' => $request->description,
            'location' => $request->locations,
            'taken_by' => $request->taken_by,
            'audiance_count' =>$request->attendees_count,
            'created_at' => $request->date,
            'updated_at' => $request->date,
        ]);
       

          
        
        return response()->json([
            'status' => 'success',
            'message' => 'School created successfully!'
        ]);
      

    }
    public function create(Request $request)
    {
        // dd($request->school_name());


        // Validate the request
        $validator = \Validator::make($request->all(), [
            'school_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'Password' => 'required|string|min:6',
            'logo' => 'nullable|mimes:png,jpg,jpeg',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422); // 422 Unprocessable Entity status code
        }



        $User = new User();
        $User->fullname = $request->school_name;
        $User->email = $request->email;
        $User->Password = bcrypt($request->Password);
        $User->role = 3;
        $User->save();


        $school = new School();
        $school->school_name = $request->school_name;
        $school->address = $request->address;
        $school->area = $request->area;
        $school->School_representative = $request->school_representative;
        $school->email = $request->email;
        // New screening fields
        $school->health_screening_conducted_by_name = $request->health_screening_conducted_by_name;
        $school->health_screening_conducted_by_qualification = $request->health_screening_conducted_by_qualification;
        $school->health_screening_conducted_by_designation = $request->health_screening_conducted_by_designation;
        $school->rechecked_by_name = $request->rechecked_by_name;
        $school->rechecked_by_qualification = $request->rechecked_by_qualification;
        $school->rechecked_by_designation = $request->rechecked_by_designation;
        $school->psychological_screening_reviewed_by_name = $request->psychological_screening_reviewed_by_name;
        $school->psychological_screening_reviewed_by_qualification = $request->psychological_screening_reviewed_by_qualification;
        $school->psychological_screening_reviewed_by_designation = $request->psychological_screening_reviewed_by_designation;
        $school->nutritional_assessment_reviewed_by_name = $request->nutritional_assessment_reviewed_by_name;
        $school->nutritional_assessment_reviewed_by_qualification = $request->nutritional_assessment_reviewed_by_qualification;
        $school->nutritional_assessment_reviewed_by_designation = $request->nutritional_assessment_reviewed_by_designation;

        // Handle logo upload if provided
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('school_logos');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $school->logo_path = 'school_logos/' . $filename;
        }

        $school->status = 1;
        $school->created_by = 1;
        $school->updated_by = 1;
        $school->save();

          // Update the User with the school ID
          $User->school_id = json_encode([$school->id]); // Store school IDs as JSON array
          $User->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'School created successfully!'
        ]);

        
    }


    // public function edit(Request $request,$id)
    // {

    //       $schools = School::find($id);
    //       $schools->update($request->all()); 
    //       return redirect()->route('add_school');
    //   }  

    public function editschool($id)
    {
        $data['detail'] = School::find($id);
        return view('admin.editschool', $data);
    }

    public function delete($id, $status)
    {
        if ($status == 0) {
            $school = School::find($id);
            $school->status = 1;
            $school->save();
        } else {
            $school = School::find($id);
            $school->status = 0;
            $school->save();
        }
        return redirect('/admin/school');
    }


    public function update(Request $request)
    {
        // Validate the request
        $validator = \Validator::make($request->all(), [
            'school_name' => 'required|string|max:255',
            'email' => 'required|email', // Email is required but should not be changed
            'Password' => 'required|string|min:6',
            'address' => 'required|string',
            'area' => 'required|string',
            'school_representative' => 'required|string',
            'logo' => 'nullable|mimes:png,jpg,jpeg',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the user by email (email should not be updated)
        $user = User::where('email', $request->email)->first();
        if ($user) {
            // Update user details excluding email
            $user->fullname = $request->school_name;
            $user->Password = bcrypt($request->Password);
            $user->role = 3;
            $user->save();
        } else {

            // Create a new user
            $user = new User();
            $user->fullname = $request->school_name;
            $user->email = $request->email;
            $user->Password = bcrypt($request->Password);
            $user->role = 3;
            $user->save();


        }

        // Update the school
        $school = School::find($request->id);
        if ($school) {
            // Update school details
            $school->school_name = $request->school_name;
            $school->address = $request->address;
            $school->area = $request->area;
            $school->school_representative = $request->school_representative;
            // New screening fields
            $school->health_screening_conducted_by_name = $request->health_screening_conducted_by_name;
            $school->health_screening_conducted_by_qualification = $request->health_screening_conducted_by_qualification;
            $school->health_screening_conducted_by_designation = $request->health_screening_conducted_by_designation;
            $school->rechecked_by_name = $request->rechecked_by_name;
            $school->rechecked_by_qualification = $request->rechecked_by_qualification;
            $school->rechecked_by_designation = $request->rechecked_by_designation;
            $school->psychological_screening_reviewed_by_name = $request->psychological_screening_reviewed_by_name;
            $school->psychological_screening_reviewed_by_qualification = $request->psychological_screening_reviewed_by_qualification;
            $school->psychological_screening_reviewed_by_designation = $request->psychological_screening_reviewed_by_designation;
            $school->nutritional_assessment_reviewed_by_name = $request->nutritional_assessment_reviewed_by_name;
            $school->nutritional_assessment_reviewed_by_qualification = $request->nutritional_assessment_reviewed_by_qualification;
            $school->nutritional_assessment_reviewed_by_designation = $request->nutritional_assessment_reviewed_by_designation;

            // Handle logo upload if provided
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('school_logos');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                $file->move($destinationPath, $filename);
                $school->logo_path = 'school_logos/' . $filename;
            }

            $school->save();
        } else {
            return redirect()->back()->with('error_message', 'School not found');
        }

          // Update the User with the school ID
          $user->school_id = json_encode([$school->id]); // Store school IDs as JSON array
          $user->save();


        // Redirect to the school list with success message
        return redirect('/admin/school')->with('success_message', 'School updated successfully');
    }



}
