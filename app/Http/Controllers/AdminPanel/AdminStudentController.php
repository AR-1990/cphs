<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\School;

class AdminStudentController extends Controller
{
    public function index()
    {
        $data['details']=Student::get();        
        return view('admin.students',$data);
    }

    public function create(Request $request){
    
    $student = new Student();
    $student->first_name = $request->fname;
    $student->last_name = $request->lname;
    $student->email = $request->email;
    $student->password = $request->password;
    $student->phone = $request->phone;
    $student->gender = $request->gender;
    $student->age = $request->age;
    $student->blood_group = $request->bloodgroup;
    $student->height = $request->height;
    $student->weight = $request->weight;
    $student->grade = $request->grade;
    $student->school_id = 0;
    $student->guardian_name = $request->guardian_name;
    $student->guardian_email = $request->guardian_email;
    $student->guardian_phone = $request->guardian_phone;
    $student->guardian_relation = $request->guardian_relation;
   
    return $student->save();

     
   
  

    }
   
  
    }

