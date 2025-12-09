<?php

namespace App\Http\Controllers\AdminPanel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\School;
use Illuminate\Support\Facades\Validator;
use Session;
use Str;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(Request $request)

    {
        $School = School::all();
        // $user = User::orderBy('id','desc')->get();

        $user = User::whereIn('role', [1, 2])
    ->orderBy('id', 'desc')
    ->get();


        if ($request->isMethod('post')) {

            $dataArr = $request->all();



            $rules = array(
                'fullname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'address' => 'required',
                'school' => 'required',
                'age' => 'required',
                'gender' => 'required',
                'role' => 'required',
                'password' => 'required',
                'designation'=>'required',

                // 'cnic' => 'required',
                // 'pmdc' => 'required',
                // 'cnic_file' => 'required',
                // 'pmdc_file' => 'required',
                // 'cv' => 'required',

                'cnic_file' => '|file|mimes:pdf,doc,docx,jpeg,png,gif',
                'pmdc_file' => '|file|mimes:pdf,doc,docx,jpeg,png,gif',
                'cv' => '|file|mimes:pdf,doc,docx,jpeg,png,gif',

            );


            $this->validate($request, $rules);

            $fullname  = (isset($dataArr['fullname']) && !empty($dataArr['fullname'])) ? trim($dataArr['fullname']) : null ;
            $email  = (isset($dataArr['email']) && !empty($dataArr['email'])) ? trim($dataArr['email']) : null ;
            $phone  = (isset($dataArr['phone']) && !empty($dataArr['phone'])) ? trim($dataArr['phone']) : null ;
            $address  = (isset($dataArr['address']) && !empty($dataArr['address'])) ? trim($dataArr['address']) : null ;
            $school  = (isset($dataArr['school']) && !empty($dataArr['school'])) ? $dataArr['school'] : null ;
            $age  = (isset($dataArr['age']) && !empty($dataArr['age'])) ? trim($dataArr['age']) : null ;
            $gender  = (isset($dataArr['gender']) && !empty($dataArr['gender'])) ? trim($dataArr['gender']) : null ;
            $role  = (isset($dataArr['role']) && !empty($dataArr['role'])) ? trim($dataArr['role']) : null ;
            $designation  = (isset($dataArr['designation']) && !empty($dataArr['designation'])) ? trim($dataArr['designation']) : null ;

            $password  = (isset($dataArr['password']) && !empty($dataArr['password'])) ? trim($dataArr['password']) : null ;
           
            $cnic  = (isset($dataArr['cnic']) && !empty($dataArr['cnic'])) ? trim($dataArr['cnic']) : null ;
            $pmdc  = (isset($dataArr['pmdc']) && !empty($dataArr['pmdc'])) ? trim($dataArr['pmdc']) : null ;
            $cnic_file  = (isset($dataArr['cnic_file']) && !empty($cnic_file['pmdc'])) ? trim($dataArr['cnic_file']) : null ;
            $pmdc_file  = (isset($dataArr['pmdc_file']) && !empty($pmdc_file['pmdc'])) ? trim($dataArr['pmdc_file']) : null ;
            $cv  = (isset($dataArr['cv']) && !empty($pmdc_file['cv'])) ? trim($dataArr['cv']) : null ;   
            
            
            $User = new User();
            $User->fullname = $fullname;
            $User->email = $email;
            $User->phone = $phone;
            $User->address = $address;
            $User->school_id = json_encode($school);
            $User->age = $age;
            $User->gender = $gender;
            $User->role = $role;
            $User->designation = $designation;

            $User->password = bcrypt($password);

            $User->cnic = $cnic;
            $User->pmdc = $pmdc;

            $User->created_by = Auth::user()->id;

            if ($request->hasFile('cnic_file')) {
                $video_tmp = $request->file('cnic_file');
                if ($video_tmp->isValid()) {
                    $FileNameOriginal = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    $FileName = 'cnic-'.rand(111, 99999) . '.' . $extension;

                    

                    $path = public_path('uploads/cnic');
                    if (!File::isDirectory($path)) {
                        File::makeDirectory($path, 0777, true, true);
                    }


                    $destinationPath = public_path('uploads/cnic');
                    $video_tmp->move($destinationPath, $FileName);
                    $User->cnic_file = $FileName;
                }
            }
          
            if ($request->hasFile('pmdc_file')) {
                $video_tmp = $request->file('pmdc_file');
                if ($video_tmp->isValid()) {

                    $FileNameOriginal = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    
                    $FileName = 'pmdc-'.rand(111, 99999) . '.' . $extension;
                    

                    $path = public_path('uploads/pmdc');
                    if (!File::isDirectory($path)) {
                        File::makeDirectory($path, 0777, true, true);
                    }

                    $destinationPath = public_path('uploads/pmdc');
                    $video_tmp->move($destinationPath, $FileName);
                    $User->pmdc_file = $FileName;
                }
            }

            
            if ($request->hasFile('cv')) {
                $video_tmp = $request->file('cv');
                if ($video_tmp->isValid()) {

                    $FileNameOriginal = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    
                    $FileName = 'cv-'.rand(111, 99999) . '.' . $extension;
                    

                    $path = public_path('uploads/cv');
                    if (!File::isDirectory($path)) {
                        File::makeDirectory($path, 0777, true, true);
                    }

                    $destinationPath = public_path('uploads/cv');
                    $video_tmp->move($destinationPath, $FileName);
                    $User->cv = $FileName;
                }
            }


            $User->save();

            $message = "Created Successfully";
            Session::flash("success_message", $message);
            return redirect()->back();
        }

        return view('admin.user',compact('user'),compact('School'));
    }

    public function userCheckEmail(Request $request)
    {

        $data = $request->all();
        $emailCount = User::where('email', $data['email'])->count();
        if ($emailCount > 0) {
            return "false";
        } else {
            return "true";
        }

    }

    public function create(Request $request){
        // dd($request->all());
        $hashedPassword = Hash::make($request->password);
        $user = new User();
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->age = $request->age;
        $user->gender = $request->gender;
        $user->id_card_no = $request->id_card_no;
        $user->password = $hashedPassword;
        $user->role = $request->role;
        $user->designation = $request->designation;

        $user->school_id = $request->school;
        $user->status =1;
        $user->created_by = 1;
        $user->updated_by = 1;
       
       
        return $user->save();
    
         
        
        }
        public function edituser ($id)
        {
            $data['School'] = School::all();
            $data['detail'] = User::find($id);
            $data['designation'] = User::find($id);

            return view('admin.edituser',$data);
        }

        /* update */
        public function update(Request $request)
        {

            // dd($request->all());

            $auth_id = Auth::guard('admin')->user()->id;
            $role = Auth::guard('admin')->user()->role;

            $hashedPassword = Hash::make($request->password);
            $user =  User::find($request->id);            
            $user->password = $hashedPassword;            
            // $user->role = $role;            
            
            $school  = (isset($request->school) && !empty($request->school)) ? $request->school : null ;
            $user->school_id = json_encode($school);
            

            // $user->school_id = $request->school;      

            $user->designation = $request->designation;                  

            $user->save();     
            return redirect('/admin/user');
      
            
        }
        public function delete($id,$status)
        {   
            if($status == 0){               
            $user =  User::find($id);
            $user->status =1;
            $user->save();     
            }else{
                $user =  User::find($id);
                $user->status =0;
                $user->save();     
            }
            return redirect('/admin/user');
        }


}