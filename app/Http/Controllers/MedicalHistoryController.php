<?php

namespace App\Http\Controllers;

use App\Models\AbdominalPainHistory;
use App\Models\Allergies;
use App\Models\ChestPain;
use App\Models\ChiefComplaint;
use App\Models\Cough;
use App\Models\Headache;
use App\Models\HistoryOfInfection;
use App\Models\HistoryOfPneumonia;
use App\Models\LowerRespiratorySob;
use App\Models\LowerRespiratoryTractInfections;
use App\Models\Meningitis;
use App\Models\NutritionHistory;
use App\Models\PastMedicalConditions;
use App\Models\PersonalHistory;
use App\Models\RespiratorySystem;
use App\Models\SkinDisease;
use App\Models\Sob;
use App\Models\Socioeconomic;
use App\Models\UpperResp;
use App\Models\StudentBiodata;
use App\Models\SchoolHealthPhysician;
use App\Models\NutritionistHistoryEvaluationSection;
use App\Models\PsychologistHistoryAssessmentSection;
use App\Models\User;
use App\Models\MedicalNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Session;
use Str;
use App\Models\Forms;
use Carbon\Carbon;
use App\Models\MedicalHistoryEmail; // Assuming you will create a MedicalHistoryEmail model


use App\Models\GeneralInfo;
use App\Models\MainComplaint;
use App\Models\SecondaryComplain;
use App\Models\RecentChangesOrConcern;
use App\Models\VitalSign;
use App\Models\FeverHistory;
use App\Models\SleepRoutine;
use App\Models\previousMenstruationTreatmentOrInterventions;
use App\Models\School;

use Illuminate\Support\Facades\File;
use DataTables;
use App\Models\form_entry;

use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\CalendarEvents;
use Illuminate\Support\Facades\Mail;
use PDF;

class MedicalHistoryController extends Controller
{

    /* Psychologist*/
    public function Psychologist(Request $request)
    {

        return view('TeamPerformance.Psychologist');
    }

    /*PsychologistList*/
    public function PsychologistList(Request $request)
    {


        $data = form_entry::where('psychiatrist_id', '>', 0)
            ->get()
            ->unique('psychiatrist_id')
            ->toArray();


        return Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('UserName', function ($row) {

                $psychiatrist_id = $row['psychiatrist_id'];

                $UserName = null;
                $User = User::where('id', $psychiatrist_id)->first();

                if (!empty($User)) {
                    $UserName = $User['fullname'];
                }

                return $UserName;

            })
            ->addColumn('PsychologistFollowUp', function ($row) {

                $psychiatrist_id = $row['psychiatrist_id'];

                $PsychologistFollowUp = 0;

                $PsychologistHistoryAssessmentSection = PsychologistHistoryAssessmentSection::where(function ($query) use ($psychiatrist_id) {
                    $query->where('created_by', $psychiatrist_id)->orWhere('updated_by', $psychiatrist_id);
                })->get()
                    ->toArray();

                if (!empty($PsychologistHistoryAssessmentSection)) {
                    foreach ($PsychologistHistoryAssessmentSection as $PsychologistHistoryAssessmentSectio) {
                        $Follow_up_Required2 = $PsychologistHistoryAssessmentSectio['Follow_up_Required2'];

                        if ($Follow_up_Required2 == 'Yes') {
                            $PsychologistFollowUp += 1;

                        }


                    }
                }


                return $PsychologistFollowUp;

            })
            ->addColumn('PsychologistRefer', function ($row) {

                $psychiatrist_id = $row['psychiatrist_id'];

                $selectedValues = [];
                $PsychologistRefer = 0;

                $PsychologistHistoryAssessmentSection = PsychologistHistoryAssessmentSection::where(function ($query) use ($psychiatrist_id) {
                    $query->where('created_by', $psychiatrist_id)->orWhere('updated_by', $psychiatrist_id);
                })->get()
                    ->toArray();

                if (!empty($PsychologistHistoryAssessmentSection)) {
                    foreach ($PsychologistHistoryAssessmentSection as $PsychologistHistoryAssessmentSectio) {
                        $internal_referrals2 = $PsychologistHistoryAssessmentSectio['internal_referrals2'];

                        $selectedValues = explode('|', $PsychologistHistoryAssessmentSection['internal_referrals2'] ?? '', );

                        if (in_array('Psychologist', $selectedValues)) {
                            $PsychologistRefer = 1;
                        }

                    }
                }


                return $PsychologistRefer;

            })

            ->addColumn('Teacher', function ($row) {

                $psychiatrist_id = $row['psychiatrist_id'];

                $selectedValues = [];
                $Teacher = 0;

                $PsychologistHistoryAssessmentSection = PsychologistHistoryAssessmentSection::where(function ($query) use ($psychiatrist_id) {
                    $query->where('created_by', $psychiatrist_id)->orWhere('updated_by', $psychiatrist_id);
                })->get()
                    ->toArray();

                if (!empty($PsychologistHistoryAssessmentSection)) {
                    foreach ($PsychologistHistoryAssessmentSection as $PsychologistHistoryAssessmentSectio) {
                        $internal_referrals2 = $PsychologistHistoryAssessmentSectio['internal_referrals2'];

                        $selectedValues = explode('|', $PsychologistHistoryAssessmentSection['internal_referrals2'] ?? '', );

                        if (in_array('Teacher', $selectedValues)) {
                            $Teacher = 1;
                        }

                    }
                }


                return $Teacher;

            })
            ->addColumn('UserCount', function ($row) {

                $psychiatrist_id = $row['psychiatrist_id'];

                $form_entry = form_entry::where('psychiatrist_id', $psychiatrist_id)->count();

                return $form_entry;

            })


            ->make(true);

    }

    /* Nutritionist*/
    public function Nutritionist(Request $request)
    {

        return view('TeamPerformance.Nutritionist');
    }

    /*NutritionistList*/
    public function NutritionistList(Request $request)
    {


        $data = form_entry::where('nutritionist_id', '>', 0)
            ->get()
            ->unique('nutritionist_id')
            ->toArray();


        return Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('UserName', function ($row) {

                $nutritionist_id = $row['nutritionist_id'];

                $UserName = null;
                $User = User::where('id', $nutritionist_id)->first();

                if (!empty($User)) {
                    $UserName = $User['fullname'];
                }

                return $UserName;

            })
            ->addColumn('UserCount', function ($row) {

                $nutritionist_id = $row['nutritionist_id'];

                $form_entry = form_entry::where('nutritionist_id', $nutritionist_id)->count();

                return $form_entry;

            })

            ->addColumn('PsychologistFollowUp', function ($row) {

                $psychiatrist_id = $row['nutritionist_id'];

                $PsychologistFollowUp = 0;

                $PsychologistHistoryAssessmentSection = NutritionistHistoryEvaluationSection::where(function ($query) use ($psychiatrist_id) {
                    $query->where('created_by', $psychiatrist_id)->orWhere('updated_by', $psychiatrist_id);
                })->get()
                    ->toArray();

                if (!empty($PsychologistHistoryAssessmentSection)) {
                    foreach ($PsychologistHistoryAssessmentSection as $PsychologistHistoryAssessmentSectio) {
                        $Follow_up_Required2 = $PsychologistHistoryAssessmentSectio['Follow_up_Required1'];

                        if ($Follow_up_Required2 == 'Yes') {
                            $PsychologistFollowUp += 1;

                        }


                    }
                }


                return $PsychologistFollowUp;

            })
            ->addColumn('PsychologistRefer', function ($row) {

                $psychiatrist_id = $row['nutritionist_id'];

                $selectedValues = [];
                $PsychologistRefer = 0;

                $PsychologistHistoryAssessmentSection = NutritionistHistoryEvaluationSection::where(function ($query) use ($psychiatrist_id) {
                    $query->where('created_by', $psychiatrist_id)->orWhere('updated_by', $psychiatrist_id);
                })->get()
                    ->toArray();

                if (!empty($PsychologistHistoryAssessmentSection)) {
                    foreach ($PsychologistHistoryAssessmentSection as $PsychologistHistoryAssessmentSectio) {
                        $internal_referrals2 = $PsychologistHistoryAssessmentSectio['internal_referrals1'];

                        $selectedValues = explode('|', $PsychologistHistoryAssessmentSection['internal_referrals1'] ?? '', );

                        if (in_array('Nutritionist', $selectedValues)) {
                            $PsychologistRefer = 1;
                        }

                    }
                }


                return $PsychologistRefer;

            })

            ->addColumn('Teacher', function ($row) {

                $psychiatrist_id = $row['nutritionist_id'];

                $selectedValues = [];
                $Teacher = 0;

                $PsychologistHistoryAssessmentSection = NutritionistHistoryEvaluationSection::where(function ($query) use ($psychiatrist_id) {
                    $query->where('created_by', $psychiatrist_id)->orWhere('updated_by', $psychiatrist_id);
                })->get()
                    ->toArray();

                if (!empty($PsychologistHistoryAssessmentSection)) {
                    foreach ($PsychologistHistoryAssessmentSection as $PsychologistHistoryAssessmentSectio) {
                        $internal_referrals2 = $PsychologistHistoryAssessmentSectio['internal_referrals1'];

                        $selectedValues = explode('|', $PsychologistHistoryAssessmentSection['internal_referrals1'] ?? '', );

                        if (in_array('Teacher', $selectedValues)) {
                            $Teacher = 1;
                        }

                    }
                }


                return $Teacher;

            })


            ->make(true);

    }

    /* Physician*/
    public function Physician(Request $request)
    {

        return view('TeamPerformance.Physician');
    }

    /*PhysicianList*/
    public function PhysicianList(Request $request)
    {


        $data = form_entry::where('doc_id', '>', 0)
            ->get()
            ->unique('doc_id')
            ->toArray();


        return Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('UserName', function ($row) {

                $doc_id = $row['doc_id'];

                $UserName = null;
                $User = User::where('id', $doc_id)->first();

                if (!empty($User)) {
                    $UserName = $User['fullname'];
                }

                return $UserName;

            })
            ->addColumn('UserCount', function ($row) {

                $doc_id = $row['doc_id'];

                $form_entry = form_entry::where('doc_id', $doc_id)->count();

                return $form_entry;

            })
            ->addColumn('PsychologistFollowUp', function ($row) {

                $psychiatrist_id = $row['doc_id'];

                $PsychologistFollowUp = 0;

                $PsychologistHistoryAssessmentSection = SchoolHealthPhysician::where(function ($query) use ($psychiatrist_id) {
                    $query->where('created_by', $psychiatrist_id)->orWhere('updated_by', $psychiatrist_id);
                })->get()
                    ->toArray();

                if (!empty($PsychologistHistoryAssessmentSection)) {
                    foreach ($PsychologistHistoryAssessmentSection as $PsychologistHistoryAssessmentSectio) {
                        $Follow_up_Required2 = $PsychologistHistoryAssessmentSectio['Follow_up_Required'];

                        if ($Follow_up_Required2 == 'Yes') {
                            $PsychologistFollowUp += 1;

                        }


                    }
                }


                return $PsychologistFollowUp;

            })
            ->addColumn('PsychologistRefer', function ($row) {

                $psychiatrist_id = $row['doc_id'];

                $selectedValues = [];
                $PsychologistRefer = 0;

                $PsychologistHistoryAssessmentSection = SchoolHealthPhysician::where(function ($query) use ($psychiatrist_id) {
                    $query->where('created_by', $psychiatrist_id)->orWhere('updated_by', $psychiatrist_id);
                })->get()
                    ->toArray();

                if (!empty($PsychologistHistoryAssessmentSection)) {
                    foreach ($PsychologistHistoryAssessmentSection as $PsychologistHistoryAssessmentSectio) {
                        $internal_referrals2 = $PsychologistHistoryAssessmentSectio['internal_referrals'];

                        $selectedValues = explode('|', $PsychologistHistoryAssessmentSection['internal_referrals1'] ?? '', );

                        if (in_array('School Health Physician', $selectedValues)) {
                            $PsychologistRefer = 1;
                        }

                    }
                }


                return $PsychologistRefer;

            })

            ->addColumn('Teacher', function ($row) {

                $psychiatrist_id = $row['doc_id'];

                $selectedValues = [];
                $Teacher = 0;

                $PsychologistHistoryAssessmentSection = SchoolHealthPhysician::where(function ($query) use ($psychiatrist_id) {
                    $query->where('created_by', $psychiatrist_id)->orWhere('updated_by', $psychiatrist_id);
                })->get()
                    ->toArray();

                if (!empty($PsychologistHistoryAssessmentSection)) {
                    foreach ($PsychologistHistoryAssessmentSection as $PsychologistHistoryAssessmentSectio) {
                        $internal_referrals2 = $PsychologistHistoryAssessmentSectio['internal_referrals'];

                        $selectedValues = explode('|', $PsychologistHistoryAssessmentSection['internal_referrals'] ?? '', );

                        if (in_array('Teacher', $selectedValues)) {
                            $Teacher = 1;
                        }

                    }
                }


                return $Teacher;

            })



            ->make(true);

    }




    /* generateAndSendPdf*/
    public function generateAndSendPdf(Request $request)
    {

        $timestamp = now()->format('Ymd_His');
        $randomString = \Str::random(10); // Using Laravel's Str helper to generate a random string

        $file = $request->file('pdf');
        $path = storage_path('app/public/pdfs/');
        $filename = 'Medical-History-' . $timestamp . '-' . $randomString . '.pdf';

        if ($file->move($path, $filename)) {
            return response()->json(['message' => 'PDF saved and email sent successfully.', 'file' => $filename]);
        } else {
            return response()->json(['message' => 'Error saving PDF.'], 500);
        }


    }

    /* generatePDF1*/
    private function generatePDF1()
    {
        $pdfFile = tempnam(sys_get_temp_dir(), 'medical_history_');
        $pdf = \PDF::loadHTML('<h1>Medical History PDF</h1>'); // Replace with your actual PDF generation logic
        $pdf->save($pdfFile);
        return $pdfFile;
    }


    /* sendEmail*/
    public function sendEmail(Request $request)
    {
        // dd($request->all());
        if ($request->isMethod('post')) {


            $request->validate([
                'to' => 'required|email',
                'cc' => 'nullable|string', // Change to nullable|string to handle multiple emails
                'bcc' => 'nullable|email',
                'subject' => 'required|string',
                'message' => 'required|string',
                'pdfPath' => 'required|string',
            ]);

            $to = $request->input('to');
            $cc = $request->input('cc');
            $bcc = $request->input('bcc', 'abdurrehmanashraf.ghazitech@gmail.com');
            $subject = $request->input('subject');
           $messageBody = $request->input('message');



            $pdfPath = storage_path('app/public/pdfs/' . basename($request->pdfPath));

            $ccEmails = json_decode($cc);


            // Decode the JSON string for CC emails
            $ccEmailsArray = json_decode($cc, true);


            // Extract the email values
            $ccEmails1 = array_map(function ($email) {
                return $email['value'];
            }, $ccEmailsArray);

            // Convert the array of emails to a pipe-separated string
            $ccEmailsString = implode('|', $ccEmails1);


            $MedicalHistoryEmail = new MedicalHistoryEmail;
            $MedicalHistoryEmail->to = $to;
            $MedicalHistoryEmail->cc = $ccEmailsString;
            $MedicalHistoryEmail->bcc = $bcc;
            $MedicalHistoryEmail->subject = $subject;
            $MedicalHistoryEmail->message = $messageBody;
            $MedicalHistoryEmail->pdfPath = $request->pdfPath;
            $MedicalHistoryEmail->save();
// dd($messageBody);

            try {

                Mail::send('admin.MedicalHistory.MedicalHistoryEmail', ['subject' => $subject, 'messageBody' => $messageBody], function ($message) use ($to, $ccEmails, $bcc, $subject) {
                    $message->to($to)
                        // ->cc($cc)
                        ->subject($subject);
                        // ->attach($pdfPath, [
                        //     'as' => basename($pdfPath),
                        //     'mime' => 'application/pdf',
                        // ]);

                    if (!empty($ccEmails)) {
                        foreach ($ccEmails as $ccEmailObj) {
                            if (isset($ccEmailObj->value) && filter_var($ccEmailObj->value, FILTER_VALIDATE_EMAIL)) {
                                $message->cc($ccEmailObj->value);
                            }
                        }
                    }

                    if (!empty($bcc)) {
                        $message->bcc($bcc);
                    }

                });





                return response()->json(['success' => 'Email sent successfully!'], 200);

            } catch (\Exception $e) {
                return response()->json(['error' => 'An error occurred while sending the email: ' . $e->getMessage()], 500);
            }
        }

        return view('send_email_form');
    }






    /* Nutritionist History & Evaluation Section */

    public function NutritionistHistoryEvaluationSection(request $request, $StudentBiodataId = null)
    {
        if ($request->isMethod('post')) {

            $DataArr = $request->all();


            $rules = array(

                'height' => 'required',
                'Weight' => 'required',
                'BMI' => 'required',
                'MUAC' => 'required',
                'Ideal_Body_Weight' => 'required',
                'Physical_Activity_Level' => 'required',
                'Estimated_Energy_Requirement' => 'required',
                'Daily_Protein_Requirement' => 'required',
                'Daily_Carbohydrate_Requirement' => 'required',
                'Daily_Fat_Requirement' => 'required',
                'Daily_Fluid_Requirement' => 'required',
                'Chief_Complaints2' => 'required',
                'History_of_Presenting_Complains' => 'required',
                'Past_Medical_History' => 'required',
                'Medication_Supplements_Allergies_History' => 'required',
                'Family_History2' => 'required',
                'Personal_Social_History2' => 'required',
                'Food_Allergies_and_Intolerances' => 'required',
                'Appetite' => 'required',
                'Recent_Weight_Changes_Weight_History' => 'required',
                'Breakfast' => 'required',
                // 'breakfast_detail' => 'required',
                'Mid_day_Snack' => 'required',
                // 'MidDaySnackDetail' => 'required',
                'Lunch' => 'required',
                // 'lunchDetail' => 'required',
                'Evening_Snack' => 'required',
                // 'EveningSnackDetail' => 'required',
                'Dinner' => 'required',
                // 'DinnerDetails' => 'required',  
                'Bed_time_snack' => 'required',
                'Biochemical_Laboratory_test_Reports' => 'required',
                'Skin' => 'required',
                'Eyes' => 'required',
                'Lips' => 'required',
                'Nails' => 'required',
                'Hair' => 'required',
                'Scalp' => 'required',

                /* Diagnosis, Impression and Plan */
                /*'Problem_List1' => 'required',
                'Impression1' => 'required',
                'Provisional_Diagnosis1' => 'required',
                'General_Advice1' => 'required',*/

                'diet_breakfast' => 'required',
                'diet_snack' => 'required',
                'diet_lunch' => 'required',
                'diet_dinner' => 'required',
                'diet_bedtime' => 'required',
                'Follow_up_Required1' => 'required',
                // 'Reason_for_Follow_up1' => 'required',
                // 'Follow_up_Date1' => 'required',

                /*'internal_referrals1' => 'required',
                'external_referrals1' => 'required',
                'Reason_for_Referral1' => 'required',*/
            );


            $this->validate($request, $rules);


            DB::beginTransaction();

            $userID = Auth::guard(config('constants.ADMIN_GUARD'))->check() ? Auth::guard(config('constants.ADMIN_GUARD'))->user()->id : Auth::guard(config('constants.STUDENT_GUARD'))->user()->id;

            $NutritionistHistoryEvaluationSection = NutritionistHistoryEvaluationSection::where('deleted', 0)->where('StudentBiodataId', $StudentBiodataId)->first();

            $message = "Updated Successfully";
            Session::flash("success_message", $message);


            $Follow_up_Required1 = (isset($DataArr['Follow_up_Required1']) && !empty($DataArr['Follow_up_Required1'])) ? trim($DataArr['Follow_up_Required1']) : null;
            $Follow_up_Date1 = (isset($DataArr['Follow_up_Date1']) && !empty($DataArr['Follow_up_Date1'])) ? trim($DataArr['Follow_up_Date1']) : null;


            if (empty($NutritionistHistoryEvaluationSection)) {

                $NutritionistHistoryEvaluationSection = new NutritionistHistoryEvaluationSection();

                $message = "Created Successfully";
                Session::flash("success_message", $message);

                $NutritionistHistoryEvaluationSection->created_by = $userID;


                if ($Follow_up_Required1 == "Yes" && !empty($Follow_up_Date1)) {


                    $StudentBiodataDesignation = StudentBiodata::where('id', $StudentBiodataId)->first();
                    if (!empty($StudentBiodataDesignation)) {
                        $UsersDesignations = User::where('role', '!=', 3)->where('designation', $StudentBiodataDesignation->designation)->get()->toArray();
                        if (!empty($UsersDesignations)) {
                            foreach ($UsersDesignations as $UsersDesignation) {


                                $MedicalNotifications = new MedicalNotifications;
                                $MedicalNotifications->created_by = $UsersDesignation['id'];
                                $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                                $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                                $MedicalNotifications->redirect_link = $StudentBiodataId;
                                $MedicalNotifications->save();

                            }
                        }


                        /* School Role  = 3 */

                        $UsersRoles = User::where('role', 3)->get()->toArray();
                        if (!empty($UsersRoles)) {
                            foreach ($UsersRoles as $UsersRole) {

                                $UsersRoleSchoolID = $UsersRole['school_id'];

                                $schoolIDsArray = json_decode($UsersRoleSchoolID, true);

                                // echo "UsersRoleSchoolID ".$UsersRoleSchoolID;echo "<BR>";
                                // echo " <pre>".print_r($schoolIDsArray);echo "<BR>";


                                $schoolIDToCheck = $StudentBiodataDesignation->School_Name;

                                if (in_array($schoolIDToCheck, $schoolIDsArray)) {

                                    $MedicalNotifications = new MedicalNotifications;
                                    $MedicalNotifications->created_by = $UsersRole['id'];
                                    $MedicalNotifications->updated_by = $UsersRole['id'];

                                    $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                                    $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                                    $MedicalNotifications->redirect_link = $StudentBiodataId;
                                    $MedicalNotifications->save();


                                }

                            }
                        }


                    }


                    // $MedicalNotifications = new MedicalNotifications;
                    // $MedicalNotifications->created_by = $userID;
                    // $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                    // $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                    // $MedicalNotifications->redirect_link = $StudentBiodataId;
                    // $MedicalNotifications->save();

                }


            } else {

                /* 1=event_type */
                CalendarEvents::where('event_type', 1)->where('event_id', $StudentBiodataId)->update(['deleted' => 1]);

                $NutritionistHistoryEvaluationSection->updated_by = $userID;

                if ($Follow_up_Required1 == "Yes" && !empty($Follow_up_Date1)) {


                    $StudentBiodataDesignation = StudentBiodata::where('id', $StudentBiodataId)->first();
                    if (!empty($StudentBiodataDesignation)) {
                        $UsersDesignations = User::where('role', '!=', 3)->where('designation', $StudentBiodataDesignation->designation)->get()->toArray();
                        if (!empty($UsersDesignations)) {
                            foreach ($UsersDesignations as $UsersDesignation) {


                                $MedicalNotifications = new MedicalNotifications;
                                $MedicalNotifications->updated_by = $UsersDesignation['id'];
                                $MedicalNotifications->created_by = $UsersDesignation['id'];
                                $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                                $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                                $MedicalNotifications->redirect_link = $StudentBiodataId;
                                $MedicalNotifications->save();

                            }
                        }



                        /* School Role  = 3 */

                        $UsersRoles = User::where('role', 3)->get()->toArray();
                        if (!empty($UsersRoles)) {
                            foreach ($UsersRoles as $UsersRole) {

                                $UsersRoleSchoolID = $UsersRole['school_id'];

                                $schoolIDsArray = json_decode($UsersRoleSchoolID, true);

                                // echo "UsersRoleSchoolID ".$UsersRoleSchoolID;echo "<BR>";
                                // echo " <pre>".print_r($schoolIDsArray);echo "<BR>";


                                $schoolIDToCheck = $StudentBiodataDesignation->School_Name;

                                if (in_array($schoolIDToCheck, $schoolIDsArray)) {

                                    $MedicalNotifications = new MedicalNotifications;
                                    $MedicalNotifications->created_by = $UsersRole['id'];
                                    $MedicalNotifications->updated_by = $UsersRole['id'];

                                    $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                                    $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                                    $MedicalNotifications->redirect_link = $StudentBiodataId;
                                    $MedicalNotifications->save();


                                }

                            }
                        }





                    }


                    // $MedicalNotifications = new MedicalNotifications;
                    // $MedicalNotifications->updated_by = $userID;
                    // $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                    // $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                    // $MedicalNotifications->redirect_link = $StudentBiodataId;
                    // $MedicalNotifications->save();


                }
            }

            /*
            
            0= if Follow-up Required yes and Follow-up Date blank,
            1= if Follow-up Required yes and Follow-up Date not blank,
            2=if Follow-up Required no 

            */

            if ($Follow_up_Required1 == "Yes" && empty($Follow_up_Date1)) {

                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Date_flag' => 0));

            } else if ($Follow_up_Required1 == "Yes" && !empty($Follow_up_Date1)) {

                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Date_flag' => 1));

            } else if ($Follow_up_Required1 == "No") {
                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Date_flag' => 2));

            } else {
                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Date_flag' => 2));

            }


            $NutritionistHistoryEvaluationSection->StudentBiodataId = $StudentBiodataId;
            $NutritionistHistoryEvaluationSection->height = (isset($DataArr['height']) && !empty($DataArr['height'])) ? trim($DataArr['height']) : null;
            $NutritionistHistoryEvaluationSection->Weight = (isset($DataArr['Weight']) && !empty($DataArr['Weight'])) ? trim($DataArr['Weight']) : null;
            $NutritionistHistoryEvaluationSection->BMI = (isset($DataArr['BMI']) && !empty($DataArr['BMI'])) ? trim($DataArr['BMI']) : null;
            $NutritionistHistoryEvaluationSection->MUAC = (isset($DataArr['MUAC']) && !empty($DataArr['MUAC'])) ? trim($DataArr['MUAC']) : null;
            $NutritionistHistoryEvaluationSection->Ideal_Body_Weight = (isset($DataArr['Ideal_Body_Weight']) && !empty($DataArr['Ideal_Body_Weight'])) ? trim($DataArr['Ideal_Body_Weight']) : null;
            $NutritionistHistoryEvaluationSection->Physical_Activity_Level = (isset($DataArr['Physical_Activity_Level']) && !empty($DataArr['Physical_Activity_Level'])) ? trim($DataArr['Physical_Activity_Level']) : null;
            $NutritionistHistoryEvaluationSection->Estimated_Energy_Requirement = (isset($DataArr['Estimated_Energy_Requirement']) && !empty($DataArr['Estimated_Energy_Requirement'])) ? trim($DataArr['Estimated_Energy_Requirement']) : null;
            $NutritionistHistoryEvaluationSection->Daily_Protein_Requirement = (isset($DataArr['Daily_Protein_Requirement']) && !empty($DataArr['Daily_Protein_Requirement'])) ? trim($DataArr['Daily_Protein_Requirement']) : null;
            $NutritionistHistoryEvaluationSection->Daily_Carbohydrate_Requirement = (isset($DataArr['Daily_Carbohydrate_Requirement']) && !empty($DataArr['Daily_Carbohydrate_Requirement'])) ? trim($DataArr['Daily_Carbohydrate_Requirement']) : null;
            $NutritionistHistoryEvaluationSection->Daily_Fat_Requirement = (isset($DataArr['Daily_Fat_Requirement']) && !empty($DataArr['Daily_Fat_Requirement'])) ? trim($DataArr['Daily_Fat_Requirement']) : null;
            $NutritionistHistoryEvaluationSection->Daily_Fluid_Requirement = (isset($DataArr['Daily_Fluid_Requirement']) && !empty($DataArr['Daily_Fluid_Requirement'])) ? trim($DataArr['Daily_Fluid_Requirement']) : null;
            $NutritionistHistoryEvaluationSection->Chief_Complaints2 = (isset($DataArr['Chief_Complaints2']) && !empty($DataArr['Chief_Complaints2'])) ? trim($DataArr['Chief_Complaints2']) : null;
            $NutritionistHistoryEvaluationSection->History_of_Presenting_Complains = (isset($DataArr['History_of_Presenting_Complains']) && !empty($DataArr['History_of_Presenting_Complains'])) ? trim($DataArr['History_of_Presenting_Complains']) : null;
            $NutritionistHistoryEvaluationSection->Past_Medical_History = (isset($DataArr['Past_Medical_History']) && !empty($DataArr['Past_Medical_History'])) ? trim($DataArr['Past_Medical_History']) : null;
            $NutritionistHistoryEvaluationSection->Medication_Supplements_Allergies_History = (isset($DataArr['Medication_Supplements_Allergies_History']) && !empty($DataArr['Medication_Supplements_Allergies_History'])) ? trim($DataArr['Medication_Supplements_Allergies_History']) : null;
            $NutritionistHistoryEvaluationSection->Family_History2 = (isset($DataArr['Family_History2']) && !empty($DataArr['Family_History2'])) ? trim($DataArr['Family_History2']) : null;
            $NutritionistHistoryEvaluationSection->Personal_Social_History2 = (isset($DataArr['Personal_Social_History2']) && !empty($DataArr['Personal_Social_History2'])) ? trim($DataArr['Personal_Social_History2']) : null;
            $NutritionistHistoryEvaluationSection->Food_Allergies_and_Intolerances = (isset($DataArr['Food_Allergies_and_Intolerances']) && !empty($DataArr['Food_Allergies_and_Intolerances'])) ? trim($DataArr['Food_Allergies_and_Intolerances']) : null;
            $NutritionistHistoryEvaluationSection->Appetite = (isset($DataArr['Appetite']) && !empty($DataArr['Appetite'])) ? trim($DataArr['Appetite']) : null;
            $NutritionistHistoryEvaluationSection->Recent_Weight_Changes_Weight_History = (isset($DataArr['Recent_Weight_Changes_Weight_History']) && !empty($DataArr['Recent_Weight_Changes_Weight_History'])) ? trim($DataArr['Recent_Weight_Changes_Weight_History']) : null;
            $NutritionistHistoryEvaluationSection->Breakfast = (isset($DataArr['Breakfast']) && !empty($DataArr['Breakfast'])) ? trim($DataArr['Breakfast']) : null;
            $NutritionistHistoryEvaluationSection->breakfast_detail = (isset($DataArr['breakfast_detail']) && !empty($DataArr['breakfast_detail'])) ? trim($DataArr['breakfast_detail']) : null;
            $NutritionistHistoryEvaluationSection->Mid_day_Snack = (isset($DataArr['Mid_day_Snack']) && !empty($DataArr['Mid_day_Snack'])) ? trim($DataArr['Mid_day_Snack']) : null;
            $NutritionistHistoryEvaluationSection->MidDaySnackDetail = (isset($DataArr['MidDaySnackDetail']) && !empty($DataArr['MidDaySnackDetail'])) ? trim($DataArr['MidDaySnackDetail']) : null;
            $NutritionistHistoryEvaluationSection->Lunch = (isset($DataArr['Lunch']) && !empty($DataArr['Lunch'])) ? trim($DataArr['Lunch']) : null;
            $NutritionistHistoryEvaluationSection->lunchDetail = (isset($DataArr['lunchDetail']) && !empty($DataArr['lunchDetail'])) ? trim($DataArr['lunchDetail']) : null;
            $NutritionistHistoryEvaluationSection->Evening_Snack = (isset($DataArr['Evening_Snack']) && !empty($DataArr['Evening_Snack'])) ? trim($DataArr['Evening_Snack']) : null;
            $NutritionistHistoryEvaluationSection->EveningSnackDetail = (isset($DataArr['EveningSnackDetail']) && !empty($DataArr['EveningSnackDetail'])) ? trim($DataArr['EveningSnackDetail']) : null;
            $NutritionistHistoryEvaluationSection->Dinner = (isset($DataArr['Dinner']) && !empty($DataArr['Dinner'])) ? trim($DataArr['Dinner']) : null;
            $NutritionistHistoryEvaluationSection->DinnerDetails = (isset($DataArr['DinnerDetails']) && !empty($DataArr['DinnerDetails'])) ? trim($DataArr['DinnerDetails']) : null;

            $NutritionistHistoryEvaluationSection->Biochemical_Laboratory_test_Reports = (isset($DataArr['Biochemical_Laboratory_test_Reports']) && !empty($DataArr['Biochemical_Laboratory_test_Reports'])) ? trim($DataArr['Biochemical_Laboratory_test_Reports']) : null;


            $NutritionistHistoryEvaluationSection->Bed_time_snack = (isset($DataArr['Bed_time_snack']) && !empty($DataArr['Bed_time_snack'])) ? trim($DataArr['Bed_time_snack']) : null;
            $NutritionistHistoryEvaluationSection->Skin = (isset($DataArr['Skin']) && !empty($DataArr['Skin'])) ? trim($DataArr['Skin']) : null;
            $NutritionistHistoryEvaluationSection->Eyes = (isset($DataArr['Eyes']) && !empty($DataArr['Eyes'])) ? trim($DataArr['Eyes']) : null;
            $NutritionistHistoryEvaluationSection->Lips = (isset($DataArr['Lips']) && !empty($DataArr['Lips'])) ? trim($DataArr['Lips']) : null;
            $NutritionistHistoryEvaluationSection->Nails = (isset($DataArr['Nails']) && !empty($DataArr['Nails'])) ? trim($DataArr['Nails']) : null;
            $NutritionistHistoryEvaluationSection->Hair = (isset($DataArr['Hair']) && !empty($DataArr['Hair'])) ? trim($DataArr['Hair']) : null;
            $NutritionistHistoryEvaluationSection->Scalp = (isset($DataArr['Scalp']) && !empty($DataArr['Scalp'])) ? trim($DataArr['Scalp']) : null;
            $NutritionistHistoryEvaluationSection->Problem_List1 = (isset($DataArr['Problem_List1']) && !empty($DataArr['Problem_List1'])) ? trim($DataArr['Problem_List1']) : null;
            $NutritionistHistoryEvaluationSection->Impression1 = (isset($DataArr['Impression1']) && !empty($DataArr['Impression1'])) ? trim($DataArr['Impression1']) : null;



            $Provisional_Diagnosis1 = (isset($DataArr['Provisional_Diagnosis1']) && !empty($DataArr['Provisional_Diagnosis1'])) ? $DataArr['Provisional_Diagnosis1'] : null;
            $Provisional_Diagnosis1 = is_array($Provisional_Diagnosis1) ? $Provisional_Diagnosis1 : (is_string($Provisional_Diagnosis1) ? [$Provisional_Diagnosis1] : []);

            $NutritionistHistoryEvaluationSection->Provisional_Diagnosis1 = implode('|', $Provisional_Diagnosis1);
            $NutritionistHistoryEvaluationSection->General_Advice1 = (isset($DataArr['General_Advice1']) && !empty($DataArr['General_Advice1'])) ? trim($DataArr['General_Advice1']) : null;
            $NutritionistHistoryEvaluationSection->diet_breakfast = (isset($DataArr['diet_breakfast']) && !empty($DataArr['diet_breakfast'])) ? trim($DataArr['diet_breakfast']) : null;
            $NutritionistHistoryEvaluationSection->diet_snack = (isset($DataArr['diet_snack']) && !empty($DataArr['diet_snack'])) ? trim($DataArr['diet_snack']) : null;
            $NutritionistHistoryEvaluationSection->diet_lunch = (isset($DataArr['diet_lunch']) && !empty($DataArr['diet_lunch'])) ? trim($DataArr['diet_lunch']) : null;
            $NutritionistHistoryEvaluationSection->diet_dinner = (isset($DataArr['diet_dinner']) && !empty($DataArr['diet_dinner'])) ? trim($DataArr['diet_dinner']) : null;
            $NutritionistHistoryEvaluationSection->diet_bedtime = (isset($DataArr['diet_bedtime']) && !empty($DataArr['diet_bedtime'])) ? trim($DataArr['diet_bedtime']) : null;
            $NutritionistHistoryEvaluationSection->Reason_for_Follow_up1 = (isset($DataArr['Reason_for_Follow_up1']) && !empty($DataArr['Reason_for_Follow_up1'])) ? trim($DataArr['Reason_for_Follow_up1']) : null;

            $NutritionistHistoryEvaluationSection->Follow_up_Required1 = $Follow_up_Required1;

            $NutritionistHistoryEvaluationSection->Follow_up_Date1 = $Follow_up_Date1;

            $NutritionistHistoryEvaluationSection->HeightResult1 = (isset($DataArr['HeightResult1']) && !empty($DataArr['HeightResult1'])) ? trim($DataArr['HeightResult1']) : null;
            $NutritionistHistoryEvaluationSection->WeightResult1 = (isset($DataArr['WeightResult1']) && !empty($DataArr['WeightResult1'])) ? trim($DataArr['WeightResult1']) : null;
            $NutritionistHistoryEvaluationSection->BMIResult1 = (isset($DataArr['BMIResult1']) && !empty($DataArr['WeighBMIResult1tResult1'])) ? trim($DataArr['BMIResult1']) : null;

            $internal_referrals1 = (isset($DataArr['internal_referrals1']) && !empty($DataArr['internal_referrals1'])) ? $DataArr['internal_referrals1'] : null;
            $internal_referrals1 = is_array($internal_referrals1) ? $internal_referrals1 : (is_string($internal_referrals1) ? [$internal_referrals1] : []);

            $NutritionistHistoryEvaluationSection->internal_referrals1 = implode('|', $internal_referrals1);

            $external_referrals1 = (isset($DataArr['external_referrals1']) && !empty($DataArr['external_referrals1'])) ? $DataArr['external_referrals1'] : null;
            $external_referrals1 = is_array($external_referrals1) ? $external_referrals1 : (is_string($external_referrals1) ? [$external_referrals1] : []);

            $NutritionistHistoryEvaluationSection->external_referrals1 = implode('|', $external_referrals1);


            $NutritionistHistoryEvaluationSection->Reason_for_Referral1 = (isset($DataArr['Reason_for_Referral1']) && !empty($DataArr['Reason_for_Referral1'])) ? trim($DataArr['Reason_for_Referral1']) : null;


            $BMIResult1 = (isset($DataArr['BMIResult1']) && !empty($DataArr['BMIResult1'])) ? trim($DataArr['BMIResult1']) : null;
            $NutritionistHistoryEvaluationSection->BMIResult1 = $BMIResult1;

            $WeightResult1 = (isset($DataArr['WeightResult1']) && !empty($DataArr['WeightResult1'])) ? trim($DataArr['WeightResult1']) : null;
            $NutritionistHistoryEvaluationSection->WeightResult1 = $WeightResult1;

            $HeightResult1 = (isset($DataArr['HeightResult1']) && !empty($DataArr['HeightResult1'])) ? trim($DataArr['HeightResult1']) : null;
            $NutritionistHistoryEvaluationSection->HeightResult1 = $HeightResult1;
            $NutritionistHistoryEvaluationSection->save();

            /* 
            DB Comment
            3=PsychologistHistoryAssessmentSection,
            1=SchoolHealthPhysician,
            NutritionistHistoryEvaluationSection=2
            */
            StudentBiodata::where('id', $StudentBiodataId)->update(array('MedicalHistoryType' => 2));

            if ($DataArr['Follow_up_Required1'] == "Yes") {

                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Required' => 1));

                $MUAC = (isset($DataArr['MUAC']) && !empty($DataArr['MUAC'])) ? trim($DataArr['MUAC']) : null;


                $eventDescription = "";

                if ($BMIResult1 == 'Low') {
                    $eventDescription .= "<br> BMI Low";
                }
                if ($WeightResult1 == 'Low') {
                    $eventDescription .= "<br> Weight Low";
                }
                if ($HeightResult1 == 'Low') {
                    $eventDescription .= "<br> Height Low";
                }



                $CalendarEvents = new CalendarEvents();
                $CalendarEvents->title = 'Nutritionist History & Evaluation Section';
                $CalendarEvents->slug = Str::slug($MUAC, '-');
                $CalendarEvents->startDate = (isset($DataArr['Follow_up_Date1']) && !empty($DataArr['Follow_up_Date1'])) ? trim($DataArr['Follow_up_Date1']) : null;
                $CalendarEvents->endDate = (isset($DataArr['Follow_up_Date1']) && !empty($DataArr['Follow_up_Date1'])) ? trim($DataArr['Follow_up_Date1']) : null;
                // $CalendarEvents->color = '#1d4062';
                $CalendarEvents->color = 'green';
                $CalendarEvents->created_by = Auth::user()->id;
                $CalendarEvents->description = $eventDescription;
                $CalendarEvents->event_type = 1;
                $CalendarEvents->event_id = $StudentBiodataId;
                $CalendarEvents->redirect_link = Route('SchoolHealthPhysician') . '/' . $StudentBiodataId;

                $CalendarEvents->save();



            } else {

                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Required' => 0));

            }


            DB::commit();


            return redirect()->route('IndexMedicalHistory');



        }
    }
    public function PsychologistHistoryAssessmentSection(request $request, $StudentBiodataId = null)
    {
        if ($request->isMethod('post')) {

            $DataArr = $request->all();



            $rules = array(
                "Identifying_Personal_Information" => "required",
                "Referral_Source" => "required",
                "Chief_Complaints3" => "required",
                "History_of_Presenting_Complaints2" => "required",
                "Investigations_Laboratory_Test_Reports2" => "required",
                "Past_Medical_Psychiatric_History" => "required",
                "Medication_History_Allergies" => "required",
                "Family_History3" => "required",
                "Personal_Social_History3" => "required",
                "Appearance_Behavior" => "required",
                "Attitude_toward_the_examiner" => "required",
                "Speech" => "required",
                "Mood" => "required",
                "Affect" => "required",
                "Thought_process_content" => "required",
                "Perceptions" => "required",
                "Delusions" => "required",
                "Cognitive_Function" => "required",
                "Insight" => "required",
                "Judgement" => "required",
                "Impulsivity" => "required",
                "Reliability" => "required",

                /*Diagnosis, Impression and Plan*/
                /*"Problem_List2" => "required",
                "Impression2" => "required",
                "Provisional_Diagnosis2" => "required",
                "General_Advice2" => "required",*/
                "Follow_up_Required2" => "required",
                // "Reason_for_Follow_up2"=>"required",
                // "Follow_up_Date2"=>"required",

                /*"internal_referrals2" => "required",
                 "Reason_for_Referral2"=>"required",
                "external_referrals2" => "required",*/

            );
            $this->validate($request, $rules);


            DB::beginTransaction();

            $userID = Auth::guard(config('constants.ADMIN_GUARD'))->check() ? Auth::guard(config('constants.ADMIN_GUARD'))->user()->id : Auth::guard(config('constants.STUDENT_GUARD'))->user()->id;

            $PsychologistHistoryAssessmentSection = PsychologistHistoryAssessmentSection::where('deleted', 0)->where('StudentBiodataId', $StudentBiodataId)->first();

            $message = "Updated Successfully";
            Session::flash("success_message", $message);


            $Follow_up_Date2 = (isset($DataArr['Follow_up_Date2']) && !empty($DataArr['Follow_up_Date2'])) ? trim($DataArr['Follow_up_Date2']) : null;
            $Follow_up_Required2 = (isset($DataArr['Follow_up_Required2']) && !empty($DataArr['Follow_up_Required2'])) ? trim($DataArr['Follow_up_Required2']) : null;



            if (empty($PsychologistHistoryAssessmentSection)) {

                $PsychologistHistoryAssessmentSection = new PsychologistHistoryAssessmentSection();

                $message = "Created Successfully";
                Session::flash("success_message", $message);

                $PsychologistHistoryAssessmentSection->created_by = $userID;

                if ($Follow_up_Required2 == "Yes" && !empty($Follow_up_Date2)) {


                    $StudentBiodataDesignation = StudentBiodata::where('id', $StudentBiodataId)->first();
                    if (!empty($StudentBiodataDesignation)) {
                        $UsersDesignations = User::where('role', '!=', 3)->where('designation', $StudentBiodataDesignation->designation)->get()->toArray();
                        if (!empty($UsersDesignations)) {
                            foreach ($UsersDesignations as $UsersDesignation) {


                                $MedicalNotifications = new MedicalNotifications;
                                $MedicalNotifications->created_by = $UsersDesignation['id'];
                                $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                                $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                                $MedicalNotifications->redirect_link = $StudentBiodataId;
                                $MedicalNotifications->save();

                            }
                        }

                        /* School Role  = 3 */

                        $UsersRoles = User::where('role', 3)->get()->toArray();
                        if (!empty($UsersRoles)) {
                            foreach ($UsersRoles as $UsersRole) {

                                $UsersRoleSchoolID = $UsersRole['school_id'];

                                $schoolIDsArray = json_decode($UsersRoleSchoolID, true);

                                // echo "UsersRoleSchoolID ".$UsersRoleSchoolID;echo "<BR>";
                                // echo " <pre>".print_r($schoolIDsArray);echo "<BR>";


                                $schoolIDToCheck = $StudentBiodataDesignation->School_Name;

                                if (in_array($schoolIDToCheck, $schoolIDsArray)) {

                                    $MedicalNotifications = new MedicalNotifications;
                                    $MedicalNotifications->created_by = $UsersRole['id'];
                                    $MedicalNotifications->updated_by = $UsersRole['id'];

                                    $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                                    $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                                    $MedicalNotifications->redirect_link = $StudentBiodataId;
                                    $MedicalNotifications->save();


                                }

                            }
                        }





                    }


                    // $MedicalNotifications = new MedicalNotifications;
                    // $MedicalNotifications->created_by = $userID;
                    // $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                    // $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                    // $MedicalNotifications->redirect_link = $StudentBiodataId;
                    // $MedicalNotifications->save();


                }
            } else {


                /* 1=event_type */
                CalendarEvents::where('event_type', 1)->where('event_id', $StudentBiodataId)->update(['deleted' => 1]);

                $PsychologistHistoryAssessmentSection->updated_by = $userID;


                if ($Follow_up_Required2 == "Yes" && !empty($Follow_up_Date2)) {



                    $StudentBiodataDesignation = StudentBiodata::where('id', $StudentBiodataId)->first();

                    if (!empty($StudentBiodataDesignation)) {

                        $UsersDesignations = User::where('role', '!=', 3)->where('designation', $StudentBiodataDesignation->designation)->get()->toArray();

                        if (!empty($UsersDesignations)) {
                            foreach ($UsersDesignations as $UsersDesignation) {

                                $MedicalNotifications = new MedicalNotifications;
                                $MedicalNotifications->updated_by = $UsersDesignation['id'];
                                $MedicalNotifications->created_by = $UsersDesignation['id'];
                                $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                                $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                                $MedicalNotifications->redirect_link = $StudentBiodataId;
                                $MedicalNotifications->save();

                            }
                        }


                        /* School Role  = 3 */

                        $UsersRoles = User::where('role', 3)->get()->toArray();
                        if (!empty($UsersRoles)) {
                            foreach ($UsersRoles as $UsersRole) {

                                $UsersRoleSchoolID = $UsersRole['school_id'];

                                $schoolIDsArray = json_decode($UsersRoleSchoolID, true);

                                // echo "UsersRoleSchoolID ".$UsersRoleSchoolID;echo "<BR>";
                                // echo " <pre>".print_r($schoolIDsArray);echo "<BR>";


                                $schoolIDToCheck = $StudentBiodataDesignation->School_Name;

                                if (in_array($schoolIDToCheck, $schoolIDsArray)) {

                                    $MedicalNotifications = new MedicalNotifications;
                                    $MedicalNotifications->created_by = $UsersRole['id'];
                                    $MedicalNotifications->updated_by = $UsersRole['id'];

                                    $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                                    $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                                    $MedicalNotifications->redirect_link = $StudentBiodataId;
                                    $MedicalNotifications->save();


                                }

                            }
                        }



                    }






                    // $MedicalNotifications = new MedicalNotifications;
                    // $MedicalNotifications->updated_by = $userID;
                    // $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                    // $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                    // $MedicalNotifications->redirect_link = $StudentBiodataId;
                    // $MedicalNotifications->save();


                }
            }



            /*
            
            0= if Follow-up Required yes and Follow-up Date blank,
            1= if Follow-up Required yes and Follow-up Date not blank,
            2=if Follow-up Required no 

            */

            if ($Follow_up_Required2 == "Yes" && empty($Follow_up_Date2)) {

                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Date_flag' => 0));

            } else if ($Follow_up_Required2 == "Yes" && !empty($Follow_up_Date2)) {

                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Date_flag' => 1));

            } else if ($Follow_up_Required2 == "No") {
                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Date_flag' => 2));

            } else {
                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Date_flag' => 2));

            }




            $Identifying_Personal_Information = (isset($DataArr['Identifying_Personal_Information']) && !empty($DataArr['Identifying_Personal_Information'])) ? trim($DataArr['Identifying_Personal_Information']) : null;

            $PsychologistHistoryAssessmentSection->StudentBiodataId = $StudentBiodataId;
            $PsychologistHistoryAssessmentSection->Identifying_Personal_Information = $Identifying_Personal_Information;
            $PsychologistHistoryAssessmentSection->Referral_Source = (isset($DataArr['Referral_Source']) && !empty($DataArr['Referral_Source'])) ? trim($DataArr['Referral_Source']) : null;
            $PsychologistHistoryAssessmentSection->Chief_Complaints3 = (isset($DataArr['Chief_Complaints3']) && !empty($DataArr['Chief_Complaints3'])) ? trim($DataArr['Chief_Complaints3']) : null;
            $PsychologistHistoryAssessmentSection->History_of_Presenting_Complaints2 = (isset($DataArr['History_of_Presenting_Complaints2']) && !empty($DataArr['History_of_Presenting_Complaints2'])) ? trim($DataArr['History_of_Presenting_Complaints2']) : null;
            $PsychologistHistoryAssessmentSection->Investigations_Laboratory_Test_Reports2 = (isset($DataArr['Investigations_Laboratory_Test_Reports2']) && !empty($DataArr['Investigations_Laboratory_Test_Reports2'])) ? trim($DataArr['Investigations_Laboratory_Test_Reports2']) : null;
            $PsychologistHistoryAssessmentSection->Past_Medical_Psychiatric_History = (isset($DataArr['Past_Medical_Psychiatric_History']) && !empty($DataArr['Past_Medical_Psychiatric_History'])) ? trim($DataArr['Past_Medical_Psychiatric_History']) : null;
            $PsychologistHistoryAssessmentSection->Medication_History_Allergies = (isset($DataArr['Medication_History_Allergies']) && !empty($DataArr['Medication_History_Allergies'])) ? trim($DataArr['Medication_History_Allergies']) : null;
            $PsychologistHistoryAssessmentSection->Family_History3 = (isset($DataArr['Family_History3']) && !empty($DataArr['Family_History3'])) ? trim($DataArr['Family_History3']) : null;
            $PsychologistHistoryAssessmentSection->Personal_Social_History3 = (isset($DataArr['Personal_Social_History3']) && !empty($DataArr['Personal_Social_History3'])) ? trim($DataArr['Personal_Social_History3']) : null;
            $PsychologistHistoryAssessmentSection->Appearance_Behavior = (isset($DataArr['Appearance_Behavior']) && !empty($DataArr['Appearance_Behavior'])) ? trim($DataArr['Appearance_Behavior']) : null;
            $PsychologistHistoryAssessmentSection->Attitude_toward_the_examiner = (isset($DataArr['Attitude_toward_the_examiner']) && !empty($DataArr['Attitude_toward_the_examiner'])) ? trim($DataArr['Attitude_toward_the_examiner']) : null;
            $PsychologistHistoryAssessmentSection->Speech = (isset($DataArr['Speech']) && !empty($DataArr['Speech'])) ? trim($DataArr['Speech']) : null;
            $PsychologistHistoryAssessmentSection->Mood = (isset($DataArr['Mood']) && !empty($DataArr['Mood'])) ? trim($DataArr['Mood']) : null;
            $PsychologistHistoryAssessmentSection->Affect = (isset($DataArr['Affect']) && !empty($DataArr['Affect'])) ? trim($DataArr['Affect']) : null;
            $PsychologistHistoryAssessmentSection->Thought_process_content = (isset($DataArr['Thought_process_content']) && !empty($DataArr['Thought_process_content'])) ? trim($DataArr['Thought_process_content']) : null;
            $PsychologistHistoryAssessmentSection->Perceptions = (isset($DataArr['Perceptions']) && !empty($DataArr['Perceptions'])) ? trim($DataArr['Perceptions']) : null;
            $PsychologistHistoryAssessmentSection->Delusions = (isset($DataArr['Delusions']) && !empty($DataArr['Delusions'])) ? trim($DataArr['Delusions']) : null;
            $PsychologistHistoryAssessmentSection->Cognitive_Function = (isset($DataArr['Cognitive_Function']) && !empty($DataArr['Cognitive_Function'])) ? trim($DataArr['Cognitive_Function']) : null;
            $PsychologistHistoryAssessmentSection->Insight = (isset($DataArr['Insight']) && !empty($DataArr['Insight'])) ? trim($DataArr['Insight']) : null;
            $PsychologistHistoryAssessmentSection->Judgement = (isset($DataArr['Judgement']) && !empty($DataArr['Judgement'])) ? trim($DataArr['Judgement']) : null;
            $PsychologistHistoryAssessmentSection->Impulsivity = (isset($DataArr['Impulsivity']) && !empty($DataArr['Impulsivity'])) ? trim($DataArr['Impulsivity']) : null;
            $PsychologistHistoryAssessmentSection->Reliability = (isset($DataArr['Reliability']) && !empty($DataArr['Reliability'])) ? trim($DataArr['Reliability']) : null;
            $PsychologistHistoryAssessmentSection->Problem_List2 = (isset($DataArr['Problem_List2']) && !empty($DataArr['Problem_List2'])) ? trim($DataArr['Problem_List2']) : null;
            $PsychologistHistoryAssessmentSection->Impression2 = (isset($DataArr['Impression2']) && !empty($DataArr['Impression2'])) ? trim($DataArr['Impression2']) : null;
            // $PsychologistHistoryAssessmentSection->Provisional_Diagnosis2 =  (isset($DataArr['Provisional_Diagnosis2']) && !empty($DataArr['Provisional_Diagnosis2'])) ? trim($DataArr['Provisional_Diagnosis2']) : null;
            $PsychologistHistoryAssessmentSection->General_Advice2 = (isset($DataArr['General_Advice2']) && !empty($DataArr['General_Advice2'])) ? trim($DataArr['General_Advice2']) : null;

            $Provisional_Diagnosis2 = (isset($DataArr['Provisional_Diagnosis2']) && !empty($DataArr['Provisional_Diagnosis2'])) ? $DataArr['Provisional_Diagnosis2'] : null;
            $Provisional_Diagnosis2 = is_array($Provisional_Diagnosis2) ? $Provisional_Diagnosis2 : (is_string($Provisional_Diagnosis2) ? [$Provisional_Diagnosis2] : []);

            $PsychologistHistoryAssessmentSection->Provisional_Diagnosis2 = implode('|', $Provisional_Diagnosis2);

            $Follow_up_Date2 = (isset($DataArr['Follow_up_Date2']) && !empty($DataArr['Follow_up_Date2'])) ? trim($DataArr['Follow_up_Date2']) : null;
            $Follow_up_Required2 = (isset($DataArr['Follow_up_Required2']) && !empty($DataArr['Follow_up_Required2'])) ? trim($DataArr['Follow_up_Required2']) : null;

            $Reason_for_Follow_up2 = (isset($DataArr['Reason_for_Follow_up2']) && !empty($DataArr['Reason_for_Follow_up2'])) ? trim($DataArr['Reason_for_Follow_up2']) : null;

            $PsychologistHistoryAssessmentSection->Follow_up_Required2 = $Follow_up_Required2;
            $PsychologistHistoryAssessmentSection->Reason_for_Follow_up2 = $Reason_for_Follow_up2;
            $PsychologistHistoryAssessmentSection->Follow_up_Date2 = $Follow_up_Date2;
            // $PsychologistHistoryAssessmentSection->internal_referrals2 =  (isset($DataArr['internal_referrals2']) && !empty($DataArr['internal_referrals2'])) ? trim($DataArr['internal_referrals2']) : null;


            $internal_referrals2 = (isset($DataArr['internal_referrals2']) && !empty($DataArr['internal_referrals2'])) ? $DataArr['internal_referrals2'] : null;
            $internal_referrals2 = is_array($internal_referrals2) ? $internal_referrals2 : (is_string($internal_referrals2) ? [$internal_referrals2] : []);

            $PsychologistHistoryAssessmentSection->internal_referrals2 = implode('|', $internal_referrals2);


            $PsychologistHistoryAssessmentSection->Reason_for_Referral2 = (isset($DataArr['Reason_for_Referral2']) && !empty($DataArr['Reason_for_Referral2'])) ? trim($DataArr['Reason_for_Referral2']) : null;
            // $PsychologistHistoryAssessmentSection->external_referrals2 =  (isset($DataArr['external_referrals2']) && !empty($DataArr['external_referrals2'])) ? trim($DataArr['external_referrals2']) : null;


            //   $external_referrals2 = (isset($DataArr['external_referrals2']) &&  !empty($DataArr['external_referrals2'])) ? $DataArr['external_referrals2'] : null;

            //   $PsychologistHistoryAssessmentSection->external_referrals2 = implode('|', $external_referrals2);
            $external_referrals2 = (isset($DataArr['external_referrals2']) && is_array($DataArr['external_referrals2'])) ? $DataArr['external_referrals2'] : null;
            $external_referrals2 = is_array($external_referrals2) ? $external_referrals2 : (is_string($external_referrals2) ? [$external_referrals2] : []);

            $PsychologistHistoryAssessmentSection->external_referrals2 = $external_referrals2 = implode('|', $external_referrals2);


            $PsychologistHistoryAssessmentSection->save();


            /* 
            DB Comment
            3=PsychologistHistoryAssessmentSection,
            1=SchoolHealthPhysician,
            NutritionistHistoryEvaluationSection=2
            */

            StudentBiodata::where('id', $StudentBiodataId)->update(array('MedicalHistoryType' => 3));

            if ($DataArr['Follow_up_Required2'] == "Yes") {

                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Required' => 1));







                $CalendarEvents = new CalendarEvents();
                $CalendarEvents->title = 'Psychologist History & Assessment Section';
                $CalendarEvents->slug = Str::slug($Identifying_Personal_Information, '-');
                $CalendarEvents->startDate = $Follow_up_Date2;
                $CalendarEvents->endDate = $Follow_up_Date2;


                $CalendarEvents->color = '#FFA500';
                $CalendarEvents->created_by = Auth::user()->id;
                $CalendarEvents->description = $Reason_for_Follow_up2;
                $CalendarEvents->event_type = 1;
                $CalendarEvents->event_id = $StudentBiodataId;

                $CalendarEvents->redirect_link = Route('SchoolHealthPhysician') . '/' . $StudentBiodataId;
                $CalendarEvents->save();


            } else {

                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Required' => 0));

            }


            DB::commit();


            return redirect()->route('IndexMedicalHistory');



        }
    }

    /*height1Response*/
    public function height1Response(request $request)
    {
        if ($request->isMethod('post')) {



            if ($request->hidden_age >= 60) {

                $result = DB::table('heightAbove5Years')->where('Month', $request->hidden_age)->where('Gander', ucfirst($request->gender));

            } else {
                $result = DB::table('heightTill5Year')->where('Months', $request->hidden_age)->where('Gander', ucfirst($request->gender));

            }

            // dd($result->toSql());

            $result = $result->first();

            if (!empty($result)) {
                return response()->json(['status' => true, "result" => $result, "request" => $request->all()]);

            } else {
                return response()->json(['status' => false, "result" => $result, "request" => $request->all()]);

            }


        }
    }
    /*Weight1Response*/

    public function Weight1Response(request $request)
    {
        if ($request->isMethod('post')) {



            $result = DB::table('Weight')->where('Months', $request->hidden_age)->where('Gender', ucfirst($request->gender));

            // dd($result->toSql());

            $result = $result->first();

            if (!empty($result)) {
                return response()->json(['status' => true, "result" => $result, "request" => $request->all()]);

            } else {
                return response()->json(['status' => false, "result" => $result, "request" => $request->all()]);

            }


        }
    }

    /* BmiRange*/
    public function BmiRange(request $request)
    {

        if ($request->isMethod('post')) {


            $result = DB::table('bmiRange')->where('Month', $request->hidden_age)->where('Gander', $request->gender);

            if ($result->exists()) {
                $result = $result->first();
                return response()->json(['status' => 1, "result" => $result, "request" => $request->all()]);
            } else {
                return response()->json(['status' => 0, "result" => '', "request" => $request->all()]);
            }

        } else {
            return response()->json(['status' => 0, "result" => '']);
        }
    }


            public function saveFollowup(Request $request){

                   $message =  DB::table('followUp')->insert([
                        'ref' => $request->ref,
                        'reason' => $request->reason,
                        'icd' => $request->IDC,
                        'comment' => $request->message,
                        'created_at' => now(), // if your table uses timestamps
                        'updated_at' => now(),
                    ]);

                    // dd($request->all()); 
                    return $message;   
            }

    /*ViewMedicalHistory1*/
    public function ViewMedicalHistory1($StudentBiodataId)
    {

      

        $StudentBiodata = StudentBiodata::where('id', $StudentBiodataId)->where('deleted', 0)->first();

//         $StudentBiodata = StudentBiodata::join('schools', 'schools.id', '=', 'student_biodata.School_Name')
//     ->where('student_biodata.id', $StudentBiodataId)
//     ->where('student_biodata.deleted', 0)
//     ->select('student_biodata.*', 'schools.email as school_email')
//     ->first();

// $schoolEmail = $StudentBiodata->school_email ?? null;
        if (empty($StudentBiodata)) {

            $message = "Record not exist";
            Session::flash("error_message", $message);

            return redirect()->route('IndexMedicalHistory');
        }

        $current = Carbon::now();
        $age = Carbon::parse($StudentBiodata->dob);
        $dob = Carbon::parse($StudentBiodata->dob);
        $yearsDifference = $dob->diffInYears($current);
        $monthsDifference = $age->diffInMonths($current);



        $SchoolHealthPhysician = SchoolHealthPhysician::where('StudentBiodataId', $StudentBiodataId)->where('deleted', 0)->first();
        $NutritionistHistoryEvaluationSection = NutritionistHistoryEvaluationSection::where('deleted', 0)->where('StudentBiodataId', $StudentBiodataId)->first();
        $PsychologistHistoryAssessmentSection = PsychologistHistoryAssessmentSection::where('deleted', 0)->where('StudentBiodataId', $StudentBiodataId)->first();


        // dd($SchoolHealthPhysician);
        $followUps =  DB::table('followUp')->where('ref',$StudentBiodataId)->get();
        // dd($followUps);
        $ICD10 = DB::table('ICD10');
        $ICD10 = $ICD10->get()->toArray();
        ;
        $ICD10 = json_decode(json_encode($ICD10), true);

        $referalId  = $StudentBiodataId;

        $ExternalReferralList = DB::table('ExternalReferralList');
        $ExternalReferralList = $ExternalReferralList->get()->toArray();
        ;
        $ExternalReferralList = json_decode(json_encode($ExternalReferralList), true);

        return view('admin.MedicalHistory.ViewMedicalHistory1')->with(get_defined_vars());



    }




    /*StudentBiodata*/
    public function StudentBiodata(request $request, $UpdateId = null)
    {

        if ($request->isMethod('post')) {

            $DataArr = $request->all();

            // dd($DataArr);


            $rules = array(

                'name' => 'required',
                'GRNo' => 'required',
                'class' => 'required',
                'dob' => 'required',
                // 'B_Form_Number' => 'required',
                'age' => 'required',
                'gender' => 'required',
                'School_Name' => 'required',
                'Contact_Number' => 'required',
                'Emergency_Contact_Number' => 'required',
                'type_of_encounter' => 'required',
                'designation' => 'required',
            );
            $year = 2024;
            $this->validate($request, $rules);

            $name = (isset($DataArr['name']) && !empty($DataArr['name'])) ? trim($DataArr['name']) : null;
            $GRNo = (isset($DataArr['GRNo']) && !empty($DataArr['GRNo'])) ? trim($DataArr['GRNo']) : null;
            $class = (isset($DataArr['class']) && !empty($DataArr['class'])) ? trim($DataArr['class']) : null;

            $dob = (isset($DataArr['dob']) && !empty($DataArr['dob'])) ? trim($DataArr['dob']) : null;
            $B_Form_Number = (isset($DataArr['B_Form_Number']) && !empty($DataArr['B_Form_Number'])) ? trim($DataArr['B_Form_Number']) : null;
            $age = (isset($DataArr['age']) && !empty($DataArr['age'])) ? trim($DataArr['age']) : null;
            $gender = (isset($DataArr['gender']) && !empty($DataArr['gender'])) ? trim($DataArr['gender']) : null;
            $School_Name = (isset($DataArr['School_Name']) && !empty($DataArr['School_Name'])) ? trim($DataArr['School_Name']) : null;
            $Emergency_Contact_Number = (isset($DataArr['Emergency_Contact_Number']) && !empty($DataArr['Emergency_Contact_Number'])) ? trim($DataArr['Emergency_Contact_Number']) : null;
            $Contact_Number = (isset($DataArr['Contact_Number']) && !empty($DataArr['Contact_Number'])) ? trim($DataArr['Contact_Number']) : null;

            $type_of_encounter = (isset($DataArr['type_of_encounter']) && !empty($DataArr['type_of_encounter'])) ? trim($DataArr['type_of_encounter']) : null;
            $designation = (isset($DataArr['designation']) && !empty($DataArr['designation'])) ? trim($DataArr['designation']) : null;

            DB::beginTransaction();

            $userID = Auth::guard(config('constants.ADMIN_GUARD'))->check() ? Auth::guard(config('constants.ADMIN_GUARD'))->user()->id : Auth::guard(config('constants.STUDENT_GUARD'))->user()->id;


            $StudentBiodata = new StudentBiodata;

            if ($UpdateId > 0) {

                $StudentBiodata = StudentBiodata::find($UpdateId);

                $StudentBiodata->updated_by = $userID;


            } else {

                $StudentBiodata->created_by = $userID;

            }


            $StudentBiodata->name = $name;
            $StudentBiodata->GRNo = $GRNo;
            $StudentBiodata->class = $class;
            $StudentBiodata->dob = $dob;
            $StudentBiodata->B_Form_Number = $B_Form_Number;
            $StudentBiodata->age = $age;
            $StudentBiodata->gender = $gender;
            $StudentBiodata->School_Name = $School_Name;
            $StudentBiodata->Emergency_Contact_Number = $Emergency_Contact_Number;
            $StudentBiodata->Contact_Number = $Contact_Number;

            $StudentBiodata->type_of_encounter = $type_of_encounter;
            $StudentBiodata->designation = $designation;
            $StudentBiodata->save();


            if ($UpdateId > 0) {

                $StudentBiodataReturnID = $StudentBiodata->id;

            } else {

                $StudentBiodataReturnID = DB::getPdo()->lastInsertId();


            }


            DB::commit();

            if ($UpdateId > 0) {

                $message = "Updated Successfully";
                Session::flash("success_message", $message);

            } else {

                if ($StudentBiodataReturnID > 0) {

                    $message = "Created Successfully";
                    Session::flash("success_message", $message);

                } else {

                    $message = "Some issue occurs try later";
                    Session::flash("error_message", $message);

                }


            }

            // return redirect()->back();

            return redirect()->Route('SchoolHealthPhysician', array($StudentBiodataReturnID));

            //  return view('admin.MedicalHistory.SchoolHealthPhysician');


        }


        $StudentBiodata = StudentBiodata::where('id', $UpdateId)->where('deleted', 0)->first();

        $school = School::all();

        $ExternalReferralList = DB::table('ExternalReferralList');
        $ExternalReferralList = $ExternalReferralList->get()->toArray();
        $ExternalReferralList = json_decode(json_encode($ExternalReferralList), true);


        return view('admin.MedicalHistory.StudentBiodata')->with(compact('StudentBiodata', 'school', 'ExternalReferralList'));

    }
    /* Gr no and dob triggered*/
    public function GetDetails(request $request)
    {

        $DataArr = $request->all();

        // dd($DataArr);

        $GetDetails = form_entry::where('grno', $DataArr['GrNo']);

        // if(!empty($DataArr['dob']))
        // {
        $GetDetails = $GetDetails->where('dob', $DataArr['dob']);

        // }

        $GetDetails = $GetDetails->first();

        if (!empty($GetDetails)) {
            $message = "Data found";
            return response()->json(
                array(
                    'status' => true,
                    'message' => $message,
                    'Data' => $GetDetails
                )
            );
        } else {
            $message = "Data not found";
            return response()->json(
                array(
                    'status' => false,
                    'message' => $message,
                )
            );
        }


    }


    public function FollowUp(request $request, $id = null)
    {

        return view('admin.MedicalHistory.FollowUp');


    }


    /* generatePdf */
    public function generatePdf(Request $request, $StudentBiodataId)
    {
        // // Fetch or generate your form data here
        // $StudentBiodata = [
        //     'GRNo' => $request->input('GRNo', ''),
        //     'dob' => $request->input('dob', ''),
        //     'name' => $request->input('name', ''),
        //     'class' => $request->input('class', ''),
        //     'B_Form_Number' => $request->input('B_Form_Number', ''),
        //     'age' => $request->input('age', ''),
        //     'gender' => $request->input('gender', ''),
        //     'School_Name' => $request->input('School_Name', ''),
        //     'Contact_Number' => $request->input('Contact_Number', ''),
        //     'Emergency_Contact_Number' => $request->input('Emergency_Contact_Number', ''),
        //     'type_of_encounter' => $request->input('type_of_encounter', ''),
        // ];

        // dd($StudentBiodataId);

        $StudentBiodata = StudentBiodata::where('id', $StudentBiodataId)->where('deleted', 0)->first();


        $current = Carbon::now();
        $age = Carbon::parse($StudentBiodata->dob);
        $dob = Carbon::parse($StudentBiodata->dob);
        $yearsDifference = $dob->diffInYears($current);
        $monthsDifference = $age->diffInMonths($current);



        $SchoolHealthPhysician = SchoolHealthPhysician::where('StudentBiodataId', $StudentBiodataId)->where('deleted', 0)->first();
        $NutritionistHistoryEvaluationSection = NutritionistHistoryEvaluationSection::where('deleted', 0)->where('StudentBiodataId', $StudentBiodataId)->first();
        $PsychologistHistoryAssessmentSection = PsychologistHistoryAssessmentSection::where('deleted', 0)->where('StudentBiodataId', $StudentBiodataId)->first();


        // dd($SchoolHealthPhysician);

        $ICD10 = DB::table('ICD10');
        $ICD10 = $ICD10->get()->toArray();
        ;
        $ICD10 = json_decode(json_encode($ICD10), true);



        $ExternalReferralList = DB::table('ExternalReferralList');
        $ExternalReferralList = $ExternalReferralList->get()->toArray();
        ;
        $ExternalReferralList = json_decode(json_encode($ExternalReferralList), true);

        return view('admin.MedicalHistory.ViewMedicalHistoryPDF')->with(get_defined_vars());

        // return view('admin.MedicalHistory.ViewMedicalHistory1')->with(get_defined_vars());


        // Load the view into a HTML string
        // $html = view('admin.MedicalHistory.ViewMedicalHistoryPDF', compact('StudentBiodata'))->render();
        $html = view('admin.MedicalHistory.ViewMedicalHistoryPDF', get_defined_vars())->render();

        // Setup Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new Dompdf($options);

        // Load HTML content
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF (important for large documents)
        $dompdf->render();

        // Output generated PDF to Browser
        return $dompdf->stream('student_biodata.pdf');
    }



    public function CreateUpdate(request $request, $UpdateId = null)
    {


        if ($request->isMethod('post')) {

            $DataArr = $request->all();

            // echo "<PRE>";print_r($DataArr);exit;

            $rules = array(

                /* SOCIOECONOMIC */
                'water' => 'required',
                'milk' => 'required',
                'rooms' => 'required',
                'infectious_disease' => 'required',
                'father_occupation' => 'required',
                'ddx' => 'required',
                'note_to_principal' => 'required',
                'note_to_parent' => 'required',
                // 'attach_picture' => 'required',


                /* Any previous medical treatments or interventions related to menstruation */

                'any_previous_medication_menstruation' => 'required',
                // 'medication_menstruation_other' => 'required',
                'additional_concerns' => 'required',

                /* Past Medical Conditions */

                'longterm_health' => 'required',
                // 'longterm_health_other' => 'required',
                'accident_or_injuries' => 'required',
                'surgeries' => 'required',
                'any_current_medications' => 'required',


                /* Allergies */

                'alergies_medications' => 'required',
                'alergies_chemicals' => 'required',
                'alergies_pollen' => 'required',
                'alergies_food' => 'required',
                'alergies_metals' => 'required',
                'alergies_other' => 'required',
                'family_history_past' => 'required',


                /* Chief Complaint */

                'chief_complaint' => 'required',
                // 'chef_comlaint_specify' => 'required', 
                'previous_skin_conditions' => 'required',
                'skincare_products' => 'required',
                'family_skin_disease' => 'required',
                'fungal_infections_type' => 'required',
                'fungal_infections_duration' => 'required',
                'fungal_previous_treatments' => 'required',
                'fungal_infections_recurrence' => 'required',
                'dermatitis_type' => 'required',
                'dermatitis_triggers' => 'required',
                'dermatitis_symptoms' => 'required',
                'dermatitis_previous_treatments' => 'required',
                'scabies_history' => 'required',
                'scabies_symptoms' => 'required',
                'scabies_previous_treatments' => 'required',
                'herpes_type' => 'required',
                'herpes_triggers' => 'required',
                'herpes_location' => 'required',
                'herpes_pain' => 'required',
                'herpes_symptoms' => 'required',
                'herpes_previous_treatments' => 'required',
                'herpes_current_medication' => 'required',
                'current_additional_notes' => 'required',
                'age_first_menstrual' => 'required',
                'regularity_menstrual' => 'required',
                'duration_menstrual' => 'required',
                'amount_menstrual_bleeding' => 'required',
                'symptoms_menstruation' => 'required',
                'use_menstrual_products' => 'required',
                // 'menstrual_products_specify' => 'required', 
                'history_menstrual_disorder' => 'required',
                // 'dysmenorrhea_onset' => 'required', 
                // 'amenorrhea_duration' => 'required', 
                // 'menorrhagia_duration' => 'required', 
                // 'menorrhagia_severity' => 'required', 
                // 'oligomenorrhea_duration' => 'required', 
                // 'menstrual_disorder_other' => 'required', 

                /* HISTORY OF INFECTIONS */
                'infection_episodes_per_month' => 'required',
                'hospitalisation' => 'required',
                'gastrointestinal_system' => 'required',
                'endocrine_system' => 'required',
                'renal_system' => 'required',

                // 'kidney_stones_case' => 'required',
                // 'back_pain_site' => 'required',
                // 'urinary_tract' => 'required',

                'neurological_system' => 'required',
                // 'neuro_falls_number' => 'required',
                // 'Syncope' => 'required',
                'musculoskeletal_system' => 'required',
                // 'muscu_body_pain_specify' => 'required',
                'hematologic_system' => 'required',

                /* SOB */
                'on_exertion_mild' => 'required',
                'on_exertion_moderate' => 'required',
                'on_exertion_severe' => 'required',
                'wheezing' => 'required',
                'crackles' => 'required',

                /* Lower Respiratory tract infections */
                'lower_sputum_color' => 'required',
                'lower_speutum_quantitiy' => 'required',
                'lower_brasky' => 'required',
                'lower_whooping' => 'required',
                'lower_blood_in_sputum' => 'required',

                /* SKIN DISEASE */
                'rashes' => 'required',
                'onset_of_rashes' => 'required',
                'rashes_site' => 'required',
                'started_from' => 'required',
                'itching' => 'required',
                'rashes_fever' => 'required',
                'coryza' => 'required',


                /* Upper Resp */
                'sore_throat' => 'required',
                'ear_ache' => 'required',
                'ear_discharge' => 'required',
                'runny_nose' => 'required',

                /* Cough */

                'sputum_color' => 'required',
                'sputum_quantity' => 'required',
                'Brasky' => 'required',
                'whooping' => 'required',
                'blood_in_sputum' => 'required',

                /* History of Pneumonia */

                'episode_per_month' => 'required',
                'hospitalization' => 'required',

                /* Chest pain */
                'onset' => 'required',
                'duration' => 'required',
                'severity' => 'required',
                'location' => 'required',
                'palpitations' => 'required',
                'fainting_syncope' => 'required',
                'cyanosis' => 'required',

                /* SOB */

                'on_exertion' => 'required',
                'on_rest' => 'required',

                /*RESPIRATORY SYSTEM*/

                'nasal_patency' => 'required',
                'clubbing' => 'required',
                'asthma' => 'required',


                /*Nutrition History */
                'breakfast' => 'required',
                'roti_eat' => 'required',
                'lunch' => 'required',
                'skip_meal' => 'required',
                'meal_preference' => 'required',
                'food_allergies' => 'required',
                'dietary_restrictions' => 'required',


                /* Sleep Routine */
                'bed_time' => 'required',
                'sleep_duration' => 'required',
                'sleep_quality' => 'required',
                'bedtime_routine' => 'required',
                'daytime_naps' => 'required',
                'breathing_difficulties' => 'required',
                'restlessness_sleep' => 'required',
                'sleep_environment' => 'required',
                'sleep_related_behaviors' => 'required',
                'medical_conditions_affecting' => 'required',
                'medications_impacting_sleep' => 'required',
                'enuresis' => 'required',
                'immunization_history' => 'required',

                /* Abdominal Pain History */
                'location_of_pain' => 'required',
                'character_of_pain' => 'required',
                'onset_and_duration' => 'required',
                'relieving_factors' => 'required',
                'associated_symptoms' => 'required',
                'medical_history' => 'required',

                //   // 'previous_episodes' => 'required',
                //   // 'digestive_disorders' => 'required',
                //   // 'dietary_changes_times' => 'required',
                //   // 'dietary_changes_routines' => 'required',
                //   // 'travel_historys' => 'required',

                /* Personal History */
                'lifestyle_habits' => 'required',
                // 'current_medications' => 'required',
                // 'sports' => 'required',


                /* MENINGITIS */
                'onset_progression' => 'required',
                'Headache' => 'required',
                'Fever' => 'required',

                /* Headache */
                'ClusterHeadache' => 'required',
                'Migraine' => 'required',
                'TensionHeadache' => 'required',

                /* Fever History  */

                'actual_temperature' => 'required',
                'description_fever' => 'required',
                'onset_duration' => 'required',
                // 'duration_fever_episodes' => 'required',
                'pattern_fever' => 'required',
                'associated_symptoms1' => 'required',
                'recent_exposures' => 'required',


                /* VITAL SIGNS */

                'pulse' => 'required',
                'temperature' => 'required',
                'bp' => 'required',
                'RespiratoryRate' => 'required',
                'bmi_weight' => 'required',
                'bmi_height' => 'required',


                /* Recent Changes or Symptoms of Concern */

                'Description3' => 'required',
                'Onset3' => 'required',
                'Duration3' => 'required',
                'Severity3' => 'required',
                'RelievingFactor3' => 'required',
                'AssociatedSymptoms3' => 'required',


                'GrNo' => 'required',
                'name' => 'required',
                'class' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'BloodGroup' => 'required',
                'contact' => 'required',
                'email' => 'required',
                'emergency_name' => 'required',
                'emergency_relationship' => 'required',
                'emergency_contact' => 'required',


                'Description' => 'required',
                'Onset' => 'required',
                'Duration' => 'required',
                'Severity' => 'required',
                'RelievingFactor' => 'required',
                'AssociatedSymptoms' => 'required',

                'Description2' => 'required',
                'Onset2' => 'required',
                'Duration2' => 'required',
                'Severity2' => 'required',
                'RelievingFactor2' => 'required',
                'AssociatedSymptoms2' => 'required',


            );

            if ($UpdateId > 0) {

            } else {
                $rules['attach_picture'] = 'required';

            }

            $this->validate($request, $rules);

            DB::beginTransaction();

            /* GeneralInfo */

            $GrNo = (isset($DataArr['GrNo']) && !empty($DataArr['GrNo'])) ? trim($DataArr['GrNo']) : null;
            $name = (isset($DataArr['name']) && !empty($DataArr['name'])) ? trim($DataArr['name']) : null;
            $class = (isset($DataArr['class']) && !empty($DataArr['class'])) ? trim($DataArr['class']) : null;
            $dob = (isset($DataArr['dob']) && !empty($DataArr['dob'])) ? trim($DataArr['dob']) : null;
            $gender = (isset($DataArr['gender']) && !empty($DataArr['gender'])) ? trim($DataArr['gender']) : null;
            $BloodGroup = (isset($DataArr['BloodGroup']) && !empty($DataArr['BloodGroup'])) ? trim($DataArr['BloodGroup']) : null;
            $contact = (isset($DataArr['contact']) && !empty($DataArr['contact'])) ? trim($DataArr['contact']) : null;
            $email = (isset($DataArr['email']) && !empty($DataArr['email'])) ? trim($DataArr['email']) : null;
            $emergency_name = (isset($DataArr['emergency_name']) && !empty($DataArr['emergency_name'])) ? trim($DataArr['emergency_name']) : null;
            $emergency_relationship = (isset($DataArr['emergency_relationship']) && !empty($DataArr['emergency_relationship'])) ? trim($DataArr['emergency_relationship']) : null;
            $emergency_contact = (isset($DataArr['emergency_contact']) && !empty($DataArr['emergency_contact'])) ? trim($DataArr['emergency_contact']) : null;

            $GeneralInfo = new GeneralInfo;
            if ($UpdateId > 0) {

                $GeneralInfo = GeneralInfo::find($UpdateId);
            }

            $GeneralInfo->GrNo = $GrNo;
            $GeneralInfo->name = $name;
            $GeneralInfo->class = $class;
            $GeneralInfo->dob = $dob;
            $GeneralInfo->gender = $gender;
            $GeneralInfo->BloodGroup = $BloodGroup;
            $GeneralInfo->contact = $contact;
            $GeneralInfo->email = $email;
            $GeneralInfo->emergency_name = $emergency_name;
            $GeneralInfo->emergency_contact = $emergency_relationship;
            $GeneralInfo->emergency_relationship = $emergency_contact;
            $GeneralInfo->save();

            if ($UpdateId > 0) {

                $GeneralInfoReturnID = $GeneralInfo->id;
            } else {
                $GeneralInfoReturnID = DB::getPdo()->lastInsertId();


            }


            /* SOCIOECONOMIC */



            $water = (isset($DataArr['water']) && !empty($DataArr['water'])) ? trim($DataArr['water']) : null;
            $milk = (isset($DataArr['milk']) && !empty($DataArr['milk'])) ? trim($DataArr['milk']) : null;
            $rooms = (isset($DataArr['rooms']) && !empty($DataArr['rooms'])) ? trim($DataArr['rooms']) : null;
            $infectious_disease = (isset($DataArr['infectious_disease']) && !empty($DataArr['infectious_disease'])) ? trim($DataArr['infectious_disease']) : null;
            $father_occupation = (isset($DataArr['father_occupation']) && !empty($DataArr['father_occupation'])) ? trim($DataArr['father_occupation']) : null;
            $ddx = (isset($DataArr['ddx']) && !empty($DataArr['ddx'])) ? trim($DataArr['ddx']) : null;
            $note_to_principal = (isset($DataArr['note_to_principal']) && !empty($DataArr['note_to_principal'])) ? trim($DataArr['note_to_principal']) : null;
            $note_to_parent = (isset($DataArr['note_to_parent']) && !empty($DataArr['note_to_parent'])) ? trim($DataArr['note_to_parent']) : null;
            $attach_picture = (isset($DataArr['attach_picture']) && !empty($DataArr['attach_picture'])) ? trim($DataArr['attach_picture']) : null;
            $attach_picture_update = (isset($DataArr['attach_picture_update']) && !empty($DataArr['attach_picture_update'])) ? trim($DataArr['attach_picture_update']) : null;


            $Socioeconomic = new Socioeconomic;

            if ($UpdateId > 0) {

                $Socioeconomic = Socioeconomic::where('GnInfoId', $UpdateId)->first();
            }

            $Socioeconomic->Water = $water;
            $Socioeconomic->Milk = $milk;
            $Socioeconomic->Rooms = $rooms;
            $Socioeconomic->infectious_disease = $infectious_disease;
            $Socioeconomic->FatherOccupation = $father_occupation;
            $Socioeconomic->DDX = $ddx;
            $Socioeconomic->NoteToPrincipal = $note_to_principal;
            $Socioeconomic->NoteToParent = $note_to_parent;


            if ($request->hasFile('attach_picture')) {
                $video_tmp = $request->file('attach_picture');
                if ($video_tmp->isValid()) {
                    $FileNameOriginal = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    $FileName = 'patient-' . rand(111, 99999) . '.' . $extension;



                    $path = public_path('uploads/patient');
                    if (!File::isDirectory($path)) {
                        File::makeDirectory($path, 0777, true, true);
                    }


                    $destinationPath = public_path('uploads/patient');
                    $video_tmp->move($destinationPath, $FileName);
                    $Socioeconomic->Picture = $FileName;
                }
            } else {
                if ($UpdateId > 0) {
                    if ($request->hasFile('attach_picture_update')) {

                        $Socioeconomic->Picture = $attach_picture_update;

                    }

                }
            }



            $Socioeconomic->GnInfoId = $GeneralInfoReturnID;
            $Socioeconomic->save();


            if ($UpdateId > 0) {
                $SocioeconomicReturnID = $Socioeconomic->id;
                ;
            } else {
                $SocioeconomicReturnID = DB::getPdo()->lastInsertId();

            }



            /* Allergies */


            $alergies_medications = (isset($DataArr['alergies_medications']) && !empty($DataArr['alergies_medications'])) ? trim($DataArr['alergies_medications']) : null;
            $alergies_chemicals = (isset($DataArr['alergies_chemicals']) && !empty($DataArr['alergies_chemicals'])) ? trim($DataArr['alergies_chemicals']) : null;
            $alergies_pollen = (isset($DataArr['alergies_pollen']) && !empty($DataArr['alergies_pollen'])) ? trim($DataArr['alergies_pollen']) : null;
            $alergies_food = (isset($DataArr['alergies_food']) && !empty($DataArr['alergies_food'])) ? trim($DataArr['alergies_food']) : null;
            $alergies_metals = (isset($DataArr['alergies_metals']) && !empty($DataArr['alergies_metals'])) ? trim($DataArr['alergies_metals']) : null;
            $alergies_other = (isset($DataArr['alergies_other']) && !empty($DataArr['alergies_other'])) ? trim($DataArr['alergies_other']) : null;
            $family_history_past = (isset($DataArr['family_history_past']) && !empty($DataArr['family_history_past'])) ? trim($DataArr['family_history_past']) : null;


            $Allergies = new Allergies;

            if ($UpdateId > 0) {

                $Allergies = Allergies::where('GnInfoId', $UpdateId)->first();
            }


            $Allergies->Medications = $alergies_medications;
            $Allergies->Chemicals = $alergies_chemicals;
            $Allergies->PollenFurs = $alergies_pollen;
            $Allergies->Food = $alergies_food;
            $Allergies->Metals = $alergies_metals;
            $Allergies->Other = $alergies_other;
            $Allergies->FamilyHistory = $family_history_past;

            $Allergies->GnInfoId = $GeneralInfoReturnID;
            $Allergies->save();

            if ($UpdateId > 0) {
                $AllergiesReturnID = $Allergies->id;
                ;
            } else {
                $AllergiesReturnID = DB::getPdo()->lastInsertId();

            }

            /* Past Medical Conditions */

            $longterm_health = (isset($DataArr['longterm_health']) && !empty($DataArr['longterm_health'])) ? trim($DataArr['longterm_health']) : null;
            $longterm_health_other = (isset($DataArr['longterm_health_other']) && !empty($DataArr['longterm_health_other'])) ? trim($DataArr['longterm_health_other']) : null;
            $accident_or_injuries = (isset($DataArr['accident_or_injuries']) && !empty($DataArr['accident_or_injuries'])) ? trim($DataArr['accident_or_injuries']) : null;
            $surgeries = (isset($DataArr['surgeries']) && !empty($DataArr['surgeries'])) ? trim($DataArr['surgeries']) : null;
            $any_current_medications = (isset($DataArr['any_current_medications']) && !empty($DataArr['any_current_medications'])) ? trim($DataArr['any_current_medications']) : null;

            $PastMedicalConditions = new PastMedicalConditions;

            if ($UpdateId > 0) {

                $PastMedicalConditions = PastMedicalConditions::where('GnInfoId', $UpdateId)->first();
            }



            $PastMedicalConditions->LongTermHealthConditions = $longterm_health;
            $PastMedicalConditions->longterm_health_other = $longterm_health_other;
            $PastMedicalConditions->AccidentOrInjuries = $accident_or_injuries;
            $PastMedicalConditions->Surgeries = $surgeries;
            $PastMedicalConditions->AnyCurrentMdications = $any_current_medications;

            $PastMedicalConditions->GnInfoId = $GeneralInfoReturnID;
            $PastMedicalConditions->save();

            if ($UpdateId > 0) {
                $PastMedicalConditionsReturnID = $PastMedicalConditions->id;
                ;
            } else {
                $PastMedicalConditionsReturnID = DB::getPdo()->lastInsertId();

            }

            /* Any previous medical treatments or interventions related to menstruation */


            $any_previous_medication_menstruation = (isset($DataArr['any_previous_medication_menstruation']) && !empty($DataArr['any_previous_medication_menstruation'])) ? trim($DataArr['any_previous_medication_menstruation']) : null;
            $medication_menstruation_other = (isset($DataArr['medication_menstruation_other']) && !empty($DataArr['medication_menstruation_other'])) ? trim($DataArr['medication_menstruation_other']) : null;
            $additional_concerns = (isset($DataArr['additional_concerns']) && !empty($DataArr['additional_concerns'])) ? trim($DataArr['additional_concerns']) : null;


            $previousMenstruationTreatmentOrInterventions = new previousMenstruationTreatmentOrInterventions;

            if ($UpdateId > 0) {

                $previousMenstruationTreatmentOrInterventions = previousMenstruationTreatmentOrInterventions::where('GnInfoId', $UpdateId)->first();
            }

            $previousMenstruationTreatmentOrInterventions->PreviousMenstruationTreatmentOrInterventions = $any_previous_medication_menstruation;
            $previousMenstruationTreatmentOrInterventions->Specify = $medication_menstruation_other;
            $previousMenstruationTreatmentOrInterventions->comment = $additional_concerns;

            $previousMenstruationTreatmentOrInterventions->GnInfoId = $GeneralInfoReturnID;
            $previousMenstruationTreatmentOrInterventions->save();
            $previousMenstruationTreatmentOrInterventionsReturn = DB::getPdo()->lastInsertId();

            if ($UpdateId > 0) {
                $previousMenstruationTreatmentOrInterventionsReturn = $previousMenstruationTreatmentOrInterventions->id;
                ;
            } else {
                $previousMenstruationTreatmentOrInterventionsReturn = DB::getPdo()->lastInsertId();

            }

            /* Chief Complaint */



            $chief_complaint = (isset($DataArr['chief_complaint']) && !empty($DataArr['chief_complaint'])) ? trim($DataArr['chief_complaint']) : null;
            $chef_comlaint_specify = (isset($DataArr['chef_comlaint_specify']) && !empty($DataArr['chef_comlaint_specify'])) ? trim($DataArr['chef_comlaint_specify']) : null;
            $previous_skin_conditions = (isset($DataArr['previous_skin_conditions']) && !empty($DataArr['previous_skin_conditions'])) ? trim($DataArr['previous_skin_conditions']) : null;
            $skincare_products = (isset($DataArr['skincare_products']) && !empty($DataArr['skincare_products'])) ? trim($DataArr['skincare_products']) : null;
            $family_skin_disease = (isset($DataArr['family_skin_disease']) && !empty($DataArr['family_skin_disease'])) ? trim($DataArr['family_skin_disease']) : null;
            $fungal_infections_type = (isset($DataArr['fungal_infections_type']) && !empty($DataArr['fungal_infections_type'])) ? trim($DataArr['fungal_infections_type']) : null;
            $fungal_infections_duration = (isset($DataArr['fungal_infections_duration']) && !empty($DataArr['fungal_infections_duration'])) ? trim($DataArr['fungal_infections_duration']) : null;
            $fungal_previous_treatments = (isset($DataArr['fungal_previous_treatments']) && !empty($DataArr['fungal_previous_treatments'])) ? trim($DataArr['fungal_previous_treatments']) : null;
            $fungal_infections_recurrence = (isset($DataArr['fungal_infections_recurrence']) && !empty($DataArr['fungal_infections_recurrence'])) ? trim($DataArr['fungal_infections_recurrence']) : null;
            $dermatitis_type = (isset($DataArr['dermatitis_type']) && !empty($DataArr['dermatitis_type'])) ? trim($DataArr['dermatitis_type']) : null;
            $dermatitis_triggers = (isset($DataArr['dermatitis_triggers']) && !empty($DataArr['dermatitis_triggers'])) ? trim($DataArr['dermatitis_triggers']) : null;
            $dermatitis_symptoms = (isset($DataArr['dermatitis_symptoms']) && !empty($DataArr['dermatitis_symptoms'])) ? trim($DataArr['dermatitis_symptoms']) : null;
            $dermatitis_previous_treatments = (isset($DataArr['dermatitis_previous_treatments']) && !empty($DataArr['dermatitis_previous_treatments'])) ? trim($DataArr['dermatitis_previous_treatments']) : null;
            $scabies_history = (isset($DataArr['scabies_history']) && !empty($DataArr['scabies_history'])) ? trim($DataArr['scabies_history']) : null;
            $scabies_symptoms = (isset($DataArr['scabies_symptoms']) && !empty($DataArr['scabies_symptoms'])) ? trim($DataArr['scabies_symptoms']) : null;
            $scabies_previous_treatments = (isset($DataArr['scabies_previous_treatments']) && !empty($DataArr['scabies_previous_treatments'])) ? trim($DataArr['scabies_previous_treatments']) : null;
            $herpes_type = (isset($DataArr['herpes_type']) && !empty($DataArr['herpes_type'])) ? trim($DataArr['herpes_type']) : null;
            $herpes_triggers = (isset($DataArr['herpes_triggers']) && !empty($DataArr['herpes_triggers'])) ? trim($DataArr['herpes_triggers']) : null;
            $herpes_location = (isset($DataArr['herpes_location']) && !empty($DataArr['herpes_location'])) ? trim($DataArr['herpes_location']) : null;
            $herpes_pain = (isset($DataArr['herpes_pain']) && !empty($DataArr['herpes_pain'])) ? trim($DataArr['herpes_pain']) : null;
            $herpes_symptoms = (isset($DataArr['herpes_symptoms']) && !empty($DataArr['herpes_symptoms'])) ? trim($DataArr['herpes_symptoms']) : null;
            $herpes_previous_treatments = (isset($DataArr['herpes_previous_treatments']) && !empty($DataArr['herpes_previous_treatments'])) ? trim($DataArr['herpes_previous_treatments']) : null;
            $herpes_current_medication = (isset($DataArr['herpes_current_medication']) && !empty($DataArr['herpes_current_medication'])) ? trim($DataArr['herpes_current_medication']) : null;
            $current_additional_notes = (isset($DataArr['current_additional_notes']) && !empty($DataArr['current_additional_notes'])) ? trim($DataArr['current_additional_notes']) : null;
            $age_first_menstrual = (isset($DataArr['age_first_menstrual']) && !empty($DataArr['age_first_menstrual'])) ? trim($DataArr['age_first_menstrual']) : null;
            $regularity_menstrual = (isset($DataArr['regularity_menstrual']) && !empty($DataArr['regularity_menstrual'])) ? trim($DataArr['regularity_menstrual']) : null;
            $duration_menstrual = (isset($DataArr['duration_menstrual']) && !empty($DataArr['duration_menstrual'])) ? trim($DataArr['duration_menstrual']) : null;
            $amount_menstrual_bleeding = (isset($DataArr['amount_menstrual_bleeding']) && !empty($DataArr['amount_menstrual_bleeding'])) ? trim($DataArr['amount_menstrual_bleeding']) : null;
            $symptoms_menstruation = (isset($DataArr['symptoms_menstruation']) && !empty($DataArr['symptoms_menstruation'])) ? trim($DataArr['symptoms_menstruation']) : null;
            $use_menstrual_products = (isset($DataArr['use_menstrual_products']) && !empty($DataArr['use_menstrual_products'])) ? trim($DataArr['use_menstrual_products']) : null;
            $menstrual_products_specify = (isset($DataArr['menstrual_products_specify']) && !empty($DataArr['menstrual_products_specify'])) ? trim($DataArr['menstrual_products_specify']) : null;
            $history_menstrual_disorder = (isset($DataArr['history_menstrual_disorder']) && !empty($DataArr['history_menstrual_disorder'])) ? trim($DataArr['history_menstrual_disorder']) : null;
            $dysmenorrhea_onset = (isset($DataArr['dysmenorrhea_onset']) && !empty($DataArr['dysmenorrhea_onset'])) ? trim($DataArr['dysmenorrhea_onset']) : null;
            $amenorrhea_duration = (isset($DataArr['amenorrhea_duration']) && !empty($DataArr['amenorrhea_duration'])) ? trim($DataArr['amenorrhea_duration']) : null;
            $menorrhagia_duration = (isset($DataArr['menorrhagia_duration']) && !empty($DataArr['menorrhagia_duration'])) ? trim($DataArr['menorrhagia_duration']) : null;
            $menorrhagia_severity = (isset($DataArr['menorrhagia_severity']) && !empty($DataArr['menorrhagia_severity'])) ? trim($DataArr['menorrhagia_severity']) : null;
            $oligomenorrhea_duration = (isset($DataArr['oligomenorrhea_duration']) && !empty($DataArr['oligomenorrhea_duration'])) ? trim($DataArr['oligomenorrhea_duration']) : null;
            $menstrual_disorder_other = (isset($DataArr['menstrual_disorder_other']) && !empty($DataArr['menstrual_disorder_other'])) ? trim($DataArr['menstrual_disorder_other']) : null;


            $ChiefComplaint = new ChiefComplaint;

            if ($UpdateId > 0) {

                $ChiefComplaint = ChiefComplaint::where('GnInfoId', $UpdateId)->first();
            }

            $ChiefComplaint->chief_complaint = $chief_complaint;
            $ChiefComplaint->chef_comlaint_specify = $chef_comlaint_specify;
            $ChiefComplaint->previous_skin_conditions = $previous_skin_conditions;
            $ChiefComplaint->skincare_products = $skincare_products;
            $ChiefComplaint->family_skin_disease = $family_skin_disease;
            $ChiefComplaint->fungal_infections_type = $fungal_infections_type;
            $ChiefComplaint->fungal_infections_duration = $fungal_infections_duration;
            $ChiefComplaint->fungal_previous_treatments = $fungal_previous_treatments;
            $ChiefComplaint->fungal_infections_recurrence = $fungal_infections_recurrence;
            $ChiefComplaint->dermatitis_type = $dermatitis_type;
            $ChiefComplaint->dermatitis_triggers = $dermatitis_triggers;
            $ChiefComplaint->dermatitis_symptoms = $dermatitis_symptoms;
            $ChiefComplaint->dermatitis_previous_treatments = $dermatitis_previous_treatments;
            $ChiefComplaint->scabies_history = $scabies_history;
            $ChiefComplaint->scabies_symptoms = $scabies_symptoms;
            $ChiefComplaint->scabies_previous_treatments = $scabies_previous_treatments;
            $ChiefComplaint->herpes_type = $herpes_type;
            $ChiefComplaint->herpes_triggers = $herpes_triggers;
            $ChiefComplaint->herpes_location = $herpes_location;
            $ChiefComplaint->herpes_pain = $herpes_pain;
            $ChiefComplaint->herpes_symptoms = $herpes_symptoms;
            $ChiefComplaint->herpes_previous_treatments = $herpes_previous_treatments;
            $ChiefComplaint->herpes_current_medication = $herpes_current_medication;
            $ChiefComplaint->current_additional_notes = $current_additional_notes;
            $ChiefComplaint->age_first_menstrual = $age_first_menstrual;
            $ChiefComplaint->regularity_menstrual = $regularity_menstrual;
            $ChiefComplaint->duration_menstrual = $duration_menstrual;
            $ChiefComplaint->amount_menstrual_bleeding = $amount_menstrual_bleeding;
            $ChiefComplaint->symptoms_menstruation = $symptoms_menstruation;
            $ChiefComplaint->use_menstrual_products = $use_menstrual_products;
            $ChiefComplaint->menstrual_products_specify = $menstrual_products_specify;
            $ChiefComplaint->history_menstrual_disorder = $history_menstrual_disorder;
            $ChiefComplaint->dysmenorrhea_onset = $dysmenorrhea_onset;
            $ChiefComplaint->amenorrhea_duration = $amenorrhea_duration;
            $ChiefComplaint->menorrhagia_duration = $menorrhagia_duration;
            $ChiefComplaint->menorrhagia_severity = $menorrhagia_severity;
            $ChiefComplaint->oligomenorrhea_duration = $oligomenorrhea_duration;
            $ChiefComplaint->menstrual_disorder_other = $menstrual_disorder_other;



            $ChiefComplaint->GnInfoId = $GeneralInfoReturnID;
            $ChiefComplaint->save();


            if ($UpdateId > 0) {
                $ChiefComplaintReturnID = $ChiefComplaint->id;
                ;
            } else {
                $ChiefComplaintReturnID = DB::getPdo()->lastInsertId();

            }

            /* HISTORY OF INFECTIONS */


            $infection_episodes_per_month = (isset($DataArr['infection_episodes_per_month']) && !empty($DataArr['infection_episodes_per_month'])) ? trim($DataArr['infection_episodes_per_month']) : null;
            $hospitalisation = (isset($DataArr['hospitalisation']) && !empty($DataArr['hospitalisation'])) ? trim($DataArr['hospitalisation']) : null;
            $gastrointestinal_system = (isset($DataArr['gastrointestinal_system']) && !empty($DataArr['gastrointestinal_system'])) ? trim($DataArr['gastrointestinal_system']) : null;
            $endocrine_system = (isset($DataArr['endocrine_system']) && !empty($DataArr['endocrine_system'])) ? trim($DataArr['endocrine_system']) : null;
            $renal_system = (isset($DataArr['renal_system']) && !empty($DataArr['renal_system'])) ? trim($DataArr['renal_system']) : null;
            $kidney_stones_case = (isset($DataArr['kidney_stones_case']) && !empty($DataArr['kidney_stones_case'])) ? trim($DataArr['kidney_stones_case']) : null;
            $back_pain_site = (isset($DataArr['back_pain_site']) && !empty($DataArr['back_pain_site'])) ? trim($DataArr['back_pain_site']) : null;
            $urinary_tract = (isset($DataArr['urinary_tract']) && !empty($DataArr['urinary_tract'])) ? trim($DataArr['urinary_tract']) : null;
            $neurological_system = (isset($DataArr['neurological_system']) && !empty($DataArr['neurological_system'])) ? trim($DataArr['neurological_system']) : null;
            $neuro_falls_number = (isset($DataArr['neuro_falls_number']) && !empty($DataArr['neuro_falls_number'])) ? trim($DataArr['neuro_falls_number']) : null;
            $Syncope = (isset($DataArr['Syncope']) && !empty($DataArr['Syncope'])) ? trim($DataArr['Syncope']) : null;
            $musculoskeletal_system = (isset($DataArr['musculoskeletal_system']) && !empty($DataArr['musculoskeletal_system'])) ? trim($DataArr['musculoskeletal_system']) : null;
            $muscu_body_pain_specify = (isset($DataArr['muscu_body_pain_specify']) && !empty($DataArr['muscu_body_pain_specify'])) ? trim($DataArr['muscu_body_pain_specify']) : null;
            $hematologic_system = (isset($DataArr['hematologic_system']) && !empty($DataArr['hematologic_system'])) ? trim($DataArr['hematologic_system']) : null;


            $HistoryOfInfection = new HistoryOfInfection;

            if ($UpdateId > 0) {

                $HistoryOfInfection = HistoryOfInfection::where('GnInfoId', $UpdateId)->first();
            }

            $HistoryOfInfection->EpisodesPerMonth = $infection_episodes_per_month;
            $HistoryOfInfection->Hospitalisation = $hospitalisation;
            $HistoryOfInfection->GastrointestinalSystem = $gastrointestinal_system;
            $HistoryOfInfection->EndocrineSystem = $endocrine_system;
            $HistoryOfInfection->RenalSystem = $renal_system;
            $HistoryOfInfection->KidneyStones = $kidney_stones_case;
            $HistoryOfInfection->BackPain = $back_pain_site;
            $HistoryOfInfection->UrinaryTractInfections = $urinary_tract;
            $HistoryOfInfection->NeurologicalSystem = $neurological_system;
            $HistoryOfInfection->Falls = $neuro_falls_number;
            $HistoryOfInfection->Syncope = $Syncope;
            $HistoryOfInfection->MusculoskeletalSystem = $musculoskeletal_system;
            $HistoryOfInfection->BonePainSpecify = $muscu_body_pain_specify;
            $HistoryOfInfection->HematologicSystem = $hematologic_system;

            $HistoryOfInfection->GnInfoId = $GeneralInfoReturnID;
            $HistoryOfInfection->save();


            if ($UpdateId > 0) {
                $HistoryOfInfectionReturnID = $HistoryOfInfection->id;
                ;
            } else {
                $HistoryOfInfectionReturnID = DB::getPdo()->lastInsertId();

            }



            /* LowerRespiratorySob */


            $on_exertion_mild = (isset($DataArr['on_exertion_mild']) && !empty($DataArr['on_exertion_mild'])) ? trim($DataArr['on_exertion_mild']) : null;
            $on_exertion_moderate = (isset($DataArr['on_exertion_moderate']) && !empty($DataArr['on_exertion_moderate'])) ? trim($DataArr['on_exertion_moderate']) : null;
            $on_exertion_severe = (isset($DataArr['on_exertion_severe']) && !empty($DataArr['on_exertion_severe'])) ? trim($DataArr['on_exertion_severe']) : null;
            $wheezing = (isset($DataArr['wheezing']) && !empty($DataArr['wheezing'])) ? trim($DataArr['wheezing']) : null;
            $crackles = (isset($DataArr['crackles']) && !empty($DataArr['crackles'])) ? trim($DataArr['crackles']) : null;

            $LowerRespiratorySob = new LowerRespiratorySob;

            if ($UpdateId > 0) {

                $LowerRespiratorySob = LowerRespiratorySob::where('GnInfoId', $UpdateId)->first();
            }


            $LowerRespiratorySob->OnExertionMild = $on_exertion_mild;
            $LowerRespiratorySob->OnExertionModerate = $on_exertion_moderate;
            $LowerRespiratorySob->OnExertionSevere = $on_exertion_severe;
            $LowerRespiratorySob->Wheezing = $wheezing;
            $LowerRespiratorySob->Crackles = $crackles;


            $LowerRespiratorySob->GnInfoId = $GeneralInfoReturnID;
            $LowerRespiratorySob->save();
            $LowerRespiratorySobReturnID = DB::getPdo()->lastInsertId();

            /* Lower Respiratory tract infections */


            $lower_sputum_color = (isset($DataArr['lower_sputum_color']) && !empty($DataArr['lower_sputum_color'])) ? trim($DataArr['lower_sputum_color']) : null;
            $lower_speutum_quantitiy = (isset($DataArr['lower_speutum_quantitiy']) && !empty($DataArr['lower_speutum_quantitiy'])) ? trim($DataArr['lower_speutum_quantitiy']) : null;
            $lower_brasky = (isset($DataArr['lower_brasky']) && !empty($DataArr['lower_brasky'])) ? trim($DataArr['lower_brasky']) : null;
            $lower_whooping = (isset($DataArr['lower_whooping']) && !empty($DataArr['lower_whooping'])) ? trim($DataArr['lower_whooping']) : null;
            $lower_blood_in_sputum = (isset($DataArr['lower_blood_in_sputum']) && !empty($DataArr['lower_blood_in_sputum'])) ? trim($DataArr['lower_blood_in_sputum']) : null;

            $LowerRespiratoryTractInfections = new LowerRespiratoryTractInfections;



            if ($UpdateId > 0) {

                $LowerRespiratLowerRespiratoryTractInfectionsorySob = LowerRespiratoryTractInfections::where('GnInfoId', $UpdateId)->first();
            }

            $LowerRespiratoryTractInfections->SputumColor = $lower_sputum_color;
            $LowerRespiratoryTractInfections->SputumQuantity = $lower_speutum_quantitiy;
            $LowerRespiratoryTractInfections->Brasky = $lower_brasky;
            $LowerRespiratoryTractInfections->Whooping = $lower_whooping;
            $LowerRespiratoryTractInfections->BloodInSputum = $lower_blood_in_sputum;

            $LowerRespiratoryTractInfections->GnInfoId = $GeneralInfoReturnID;
            $LowerRespiratoryTractInfections->save();



            if ($UpdateId > 0) {
                $LowerRespiratoryTractInfectionsReturnID = $LowerRespiratoryTractInfections->id;
                ;
            } else {
                $LowerRespiratoryTractInfectionsReturnID = DB::getPdo()->lastInsertId();

            }



            /* SKIN DISEASE */

            $rashes = (isset($DataArr['rashes']) && !empty($DataArr['rashes'])) ? trim($DataArr['rashes']) : null;
            $onset_of_rashes = (isset($DataArr['onset_of_rashes']) && !empty($DataArr['onset_of_rashes'])) ? trim($DataArr['onset_of_rashes']) : null;
            $rashes_site = (isset($DataArr['rashes_site']) && !empty($DataArr['rashes_site'])) ? trim($DataArr['rashes_site']) : null;
            $started_from = (isset($DataArr['started_from']) && !empty($DataArr['started_from'])) ? trim($DataArr['started_from']) : null;
            $itching = (isset($DataArr['itching']) && !empty($DataArr['itching'])) ? trim($DataArr['itching']) : null;
            $rashes_fever = (isset($DataArr['rashes_fever']) && !empty($DataArr['rashes_fever'])) ? trim($DataArr['rashes_fever']) : null;
            $coryza = (isset($DataArr['coryza']) && !empty($DataArr['coryza'])) ? trim($DataArr['coryza']) : null;

            $SkinDisease = new SkinDisease;

            if ($UpdateId > 0) {

                $SkinDisease = SkinDisease::where('GnInfoId', $UpdateId)->first();
            }

            $SkinDisease->Rashes = $rashes;
            $SkinDisease->OnsetOfRashes = $onset_of_rashes;
            $SkinDisease->Site = $rashes_site;
            $SkinDisease->StartedFrom = $started_from;
            $SkinDisease->Itching = $itching;
            $SkinDisease->Fever = $rashes_fever;
            $SkinDisease->Coryza = $coryza;

            $SkinDisease->GnInfoId = $GeneralInfoReturnID;
            $SkinDisease->save();




            if ($UpdateId > 0) {
                $SkinDiseaseReturnID = $SkinDisease->id;
                ;
            } else {
                $SkinDiseaseReturnID = DB::getPdo()->lastInsertId();

            }

            /* Upper Resp */

            $sore_throat = (isset($DataArr['sore_throat']) && !empty($DataArr['sore_throat'])) ? trim($DataArr['sore_throat']) : null;
            $ear_ache = (isset($DataArr['ear_ache']) && !empty($DataArr['ear_ache'])) ? trim($DataArr['ear_ache']) : null;
            $ear_discharge = (isset($DataArr['ear_discharge']) && !empty($DataArr['ear_discharge'])) ? trim($DataArr['ear_discharge']) : null;
            $runny_nose = (isset($DataArr['runny_nose']) && !empty($DataArr['runny_nose'])) ? trim($DataArr['runny_nose']) : null;

            $UpperResp = new UpperResp;

            if ($UpdateId > 0) {

                $UpperResp = UpperResp::where('GnInfoId', $UpdateId)->first();
            }

            $UpperResp->SoreThroat = $sore_throat;
            $UpperResp->EarAche = $ear_ache;
            $UpperResp->EarDischarge = $ear_discharge;
            $UpperResp->RunnyNse = $runny_nose;

            $UpperResp->GnInfoId = $GeneralInfoReturnID;
            $UpperResp->save();



            if ($UpdateId > 0) {
                $UpperRespReturnID = $UpperResp->id;
                ;
            } else {
                $UpperRespReturnID = DB::getPdo()->lastInsertId();

            }

            /* Cough */

            $sputum_color = (isset($DataArr['sputum_color']) && !empty($DataArr['sputum_color'])) ? trim($DataArr['sputum_color']) : null;
            $sputum_quantity = (isset($DataArr['sputum_quantity']) && !empty($DataArr['sputum_quantity'])) ? trim($DataArr['sputum_quantity']) : null;
            $Brasky = (isset($DataArr['Brasky']) && !empty($DataArr['Brasky'])) ? trim($DataArr['Brasky']) : null;
            $whooping = (isset($DataArr['whooping']) && !empty($DataArr['whooping'])) ? trim($DataArr['whooping']) : null;
            $blood_in_sputum = (isset($DataArr['blood_in_sputum']) && !empty($DataArr['blood_in_sputum'])) ? trim($DataArr['blood_in_sputum']) : null;

            $Cough = new Cough;
            if ($UpdateId > 0) {

                $Cough = Cough::where('GnInfoId', $UpdateId)->first();
            }


            $Cough->SputumColor = $sputum_color;
            $Cough->SputumQuantity = $sputum_quantity;
            $Cough->Brasky = $Brasky;
            $Cough->Whooping = $whooping;
            $Cough->BloodInSputum = $blood_in_sputum;

            $Cough->GnInfoId = $GeneralInfoReturnID;
            $Cough->save();



            if ($UpdateId > 0) {
                $CoughReturnID = $Cough->id;
                ;
            } else {
                $CoughReturnID = DB::getPdo()->lastInsertId();

            }



            /* History of Pneumonia */

            $episode_per_month = (isset($DataArr['episode_per_month']) && !empty($DataArr['episode_per_month'])) ? trim($DataArr['episode_per_month']) : null;
            $hospitalization = (isset($DataArr['hospitalization']) && !empty($DataArr['hospitalization'])) ? trim($DataArr['hospitalization']) : null;

            $HistoryOfPneumonia = new HistoryOfPneumonia;

            if ($UpdateId > 0) {

                $HistoryOfPneumonia = HistoryOfPneumonia::where('GnInfoId', $UpdateId)->first();
            }


            $HistoryOfPneumonia->EpisodesPerMonth = $episode_per_month;
            $HistoryOfPneumonia->Hospitalization = $hospitalization;

            $HistoryOfPneumonia->GnInfoId = $GeneralInfoReturnID;
            $HistoryOfPneumonia->save();



            if ($UpdateId > 0) {
                $HistoryOfPneumoniaReturnID = $HistoryOfPneumonia->id;
                ;
            } else {
                $HistoryOfPneumoniaReturnID = DB::getPdo()->lastInsertId();

            }



            /* Chest pain */


            $onset = (isset($DataArr['onset']) && !empty($DataArr['onset'])) ? trim($DataArr['onset']) : null;
            $duration = (isset($DataArr['duration']) && !empty($DataArr['duration'])) ? trim($DataArr['duration']) : null;
            $severity = (isset($DataArr['severity']) && !empty($DataArr['severity'])) ? trim($DataArr['severity']) : null;
            $location = (isset($DataArr['location']) && !empty($DataArr['location'])) ? trim($DataArr['location']) : null;
            $palpitations = (isset($DataArr['palpitations']) && !empty($DataArr['palpitations'])) ? trim($DataArr['palpitations']) : null;
            $fainting_syncope = (isset($DataArr['fainting_syncope']) && !empty($DataArr['fainting_syncope'])) ? trim($DataArr['fainting_syncope']) : null;
            $cyanosis = (isset($DataArr['cyanosis']) && !empty($DataArr['cyanosis'])) ? trim($DataArr['cyanosis']) : null;

            $ChestPain = new ChestPain;

            if ($UpdateId > 0) {

                $ChestPain = ChestPain::where('GnInfoId', $UpdateId)->first();
            }

            $ChestPain->Onset = $onset;
            $ChestPain->Duration = $duration;
            $ChestPain->Severity = $severity;
            $ChestPain->Location = $location;
            $ChestPain->Palpitations = $palpitations;
            $ChestPain->FaintingSyncope = $fainting_syncope;
            $ChestPain->Cyanosis = $cyanosis;

            $ChestPain->GnInfoId = $GeneralInfoReturnID;
            $ChestPain->save();



            if ($UpdateId > 0) {
                $ChestPainReturnID = $ChestPain->id;
                ;
            } else {
                $ChestPainReturnID = DB::getPdo()->lastInsertId();

            }



            /* SOB */


            $on_exertion = (isset($DataArr['on_exertion']) && !empty($DataArr['on_exertion'])) ? trim($DataArr['on_exertion']) : null;
            $on_rest = (isset($DataArr['on_rest']) && !empty($DataArr['on_rest'])) ? trim($DataArr['on_rest']) : null;

            $Sob = new Sob;

            if ($UpdateId > 0) {

                $Sob = Sob::where('GnInfoId', $UpdateId)->first();
            }

            $Sob->OnExertion = $on_exertion;
            $Sob->OnRst = $on_rest;


            $Sob->GnInfoId = $GeneralInfoReturnID;
            $Sob->save();


            if ($UpdateId > 0) {
                $SobReturnID = $Sob->id;
                ;
            } else {
                $SobReturnID = DB::getPdo()->lastInsertId();

            }

            /*RESPIRATORY SYSTEM*/


            $nasal_patency = (isset($DataArr['nasal_patency']) && !empty($DataArr['nasal_patency'])) ? trim($DataArr['nasal_patency']) : null;
            $clubbing = (isset($DataArr['clubbing']) && !empty($DataArr['clubbing'])) ? trim($DataArr['clubbing']) : null;
            $asthma = (isset($DataArr['asthma']) && !empty($DataArr['asthma'])) ? trim($DataArr['asthma']) : null;

            $RespiratorySystem = new RespiratorySystem;

            if ($UpdateId > 0) {

                $RespiratorySystem = RespiratorySystem::where('GnInfoId', $UpdateId)->first();
            }

            $RespiratorySystem->NasalPatency = $nasal_patency;
            $RespiratorySystem->Clubbing = $clubbing;
            $RespiratorySystem->Asthma = $asthma;


            $RespiratorySystem->GnInfoId = $GeneralInfoReturnID;
            $RespiratorySystem->save();



            if ($UpdateId > 0) {
                $RespiratorySystemReturnID = $RespiratorySystem->id;
                ;
            } else {
                $RespiratorySystemReturnID = DB::getPdo()->lastInsertId();

            }


            /*Nutrition History */


            $breakfast = (isset($DataArr['breakfast']) && !empty($DataArr['breakfast'])) ? trim($DataArr['breakfast']) : null;
            $roti_eat = (isset($DataArr['roti_eat']) && !empty($DataArr['roti_eat'])) ? trim($DataArr['roti_eat']) : null;
            $lunch = (isset($DataArr['lunch']) && !empty($DataArr['lunch'])) ? trim($DataArr['lunch']) : null;
            $skip_meal = (isset($DataArr['skip_meal']) && !empty($DataArr['skip_meal'])) ? trim($DataArr['skip_meal']) : null;
            $meal_preference = (isset($DataArr['meal_preference']) && !empty($DataArr['meal_preference'])) ? trim($DataArr['meal_preference']) : null;
            $food_allergies = (isset($DataArr['food_allergies']) && !empty($DataArr['food_allergies'])) ? trim($DataArr['food_allergies']) : null;
            $dietary_restrictions = (isset($DataArr['dietary_restrictions']) && !empty($DataArr['dietary_restrictions'])) ? trim($DataArr['dietary_restrictions']) : null;

            $NutritionHistory = new NutritionHistory;

            if ($UpdateId > 0) {

                $NutritionHistory = NutritionHistory::where('GnInfoId', $UpdateId)->first();
            }

            $NutritionHistory->BreakfastIfYes = $breakfast;
            $NutritionHistory->RotiTheyEat = $roti_eat;
            $NutritionHistory->Lunch = $lunch;
            $NutritionHistory->SkipMeals = $skip_meal;
            $NutritionHistory->MealPreferences = $meal_preference;
            $NutritionHistory->FoodAllergies = $food_allergies;
            $NutritionHistory->DietaryRestrictions = $dietary_restrictions;

            $NutritionHistory->GnInfoId = $GeneralInfoReturnID;
            $NutritionHistory->save();




            if ($UpdateId > 0) {
                $NutritionHistoryReturnID = $NutritionHistory->id;
                ;
            } else {
                $NutritionHistoryReturnID = DB::getPdo()->lastInsertId();

            }



            /* Sleep Routine */

            $bed_time = (isset($DataArr['bed_time']) && !empty($DataArr['bed_time'])) ? trim($DataArr['bed_time']) : null;
            $sleep_duration = (isset($DataArr['sleep_duration']) && !empty($DataArr['sleep_duration'])) ? trim($DataArr['sleep_duration']) : null;
            $sleep_quality = (isset($DataArr['sleep_quality']) && !empty($DataArr['sleep_quality'])) ? trim($DataArr['sleep_quality']) : null;
            $bedtime_routine = (isset($DataArr['bedtime_routine']) && !empty($DataArr['bedtime_routine'])) ? trim($DataArr['bedtime_routine']) : null;
            $daytime_naps = (isset($DataArr['daytime_naps']) && !empty($DataArr['daytime_naps'])) ? trim($DataArr['daytime_naps']) : null;
            $breathing_difficulties = (isset($DataArr['breathing_difficulties']) && !empty($DataArr['breathing_difficulties'])) ? trim($DataArr['breathing_difficulties']) : null;
            $restlessness_sleep = (isset($DataArr['restlessness_sleep']) && !empty($DataArr['restlessness_sleep'])) ? trim($DataArr['restlessness_sleep']) : null;
            $sleep_environment = (isset($DataArr['sleep_environment']) && !empty($DataArr['sleep_environment'])) ? trim($DataArr['sleep_environment']) : null;
            $sleep_related_behaviors = (isset($DataArr['sleep_related_behaviors']) && !empty($DataArr['sleep_related_behaviors'])) ? trim($DataArr['sleep_related_behaviors']) : null;
            $medical_conditions_affecting = (isset($DataArr['medical_conditions_affecting']) && !empty($DataArr['medical_conditions_affecting'])) ? trim($DataArr['medical_conditions_affecting']) : null;
            $medications_impacting_sleep = (isset($DataArr['medications_impacting_sleep']) && !empty($DataArr['medications_impacting_sleep'])) ? trim($DataArr['medications_impacting_sleep']) : null;
            $enuresis = (isset($DataArr['enuresis']) && !empty($DataArr['enuresis'])) ? trim($DataArr['enuresis']) : null;
            $immunization_history = (isset($DataArr['immunization_history']) && !empty($DataArr['immunization_history'])) ? trim($DataArr['immunization_history']) : null;


            $SleepRoutine = new SleepRoutine;

            if ($UpdateId > 0) {

                $SleepRoutine = SleepRoutine::where('GnInfoId', $UpdateId)->first();
            }

            $SleepRoutine->BedTime = $bed_time;
            $SleepRoutine->SleepDuration = $sleep_duration;
            $SleepRoutine->SleepQuality = $sleep_quality;
            $SleepRoutine->BedtimeRoutine = $bedtime_routine;
            $SleepRoutine->DaytimeNaps = $daytime_naps;
            $SleepRoutine->SnoringOrBreathing = $breathing_difficulties;
            $SleepRoutine->RestlessnessDuringSleep = $restlessness_sleep;
            $SleepRoutine->SleepEnvironment = $sleep_environment;
            $SleepRoutine->SleepRelatedBehaviors = $sleep_related_behaviors;
            $SleepRoutine->AffectingSleep = $medical_conditions_affecting;
            $SleepRoutine->ImpactingSleep = $medications_impacting_sleep;
            $SleepRoutine->Enuresis = $enuresis;
            $SleepRoutine->ImmunizationHistory = $immunization_history;


            $SleepRoutine->GnInfoId = $GeneralInfoReturnID;
            $SleepRoutine->save();




            if ($UpdateId > 0) {
                $SleepRoutineReturnID = $SleepRoutine->id;
                ;
            } else {
                $SleepRoutineReturnID = DB::getPdo()->lastInsertId();

            }


            /* Personal History */


            $lifestyle_habits = (isset($DataArr['lifestyle_habits']) && !empty($DataArr['lifestyle_habits'])) ? trim($DataArr['lifestyle_habits']) : null;
            $current_medications = (isset($DataArr['current_medications']) && !empty($DataArr['current_medications'])) ? trim($DataArr['current_medications']) : null;
            $sports = (isset($DataArr['sports']) && !empty($DataArr['sports'])) ? trim($DataArr['sports']) : null;

            $PersonalHistory = new PersonalHistory;


            if ($UpdateId > 0) {

                $PersonalHistory = PersonalHistory::where('GnInfoId', $UpdateId)->first();
            }


            $PersonalHistory->GnInfoId = $GeneralInfoReturnID;
            $PersonalHistory->LifestyleHabits = $lifestyle_habits;
            $PersonalHistory->CurrentMedications = $current_medications;
            $PersonalHistory->sports = $sports;

            $PersonalHistory->save();




            if ($UpdateId > 0) {
                $PersonalHistoryReturnID = $PersonalHistory->id;
                ;
            } else {
                $PersonalHistoryReturnID = DB::getPdo()->lastInsertId();

            }


            /* Abdominal Pain History */

            $location_of_pain = (isset($DataArr['location_of_pain']) && !empty($DataArr['location_of_pain'])) ? trim($DataArr['location_of_pain']) : null;
            $character_of_pain = (isset($DataArr['character_of_pain']) && !empty($DataArr['character_of_pain'])) ? trim($DataArr['character_of_pain']) : null;
            $onset_and_duration = (isset($DataArr['onset_and_duration']) && !empty($DataArr['onset_and_duration'])) ? trim($DataArr['onset_and_duration']) : null;
            $relieving_factors = (isset($DataArr['relieving_factors']) && !empty($DataArr['relieving_factors'])) ? trim($DataArr['relieving_factors']) : null;
            $associated_symptoms = (isset($DataArr['associated_symptoms']) && !empty($DataArr['associated_symptoms'])) ? trim($DataArr['associated_symptoms']) : null;
            $medical_history = (isset($DataArr['medical_history']) && !empty($DataArr['medical_history'])) ? trim($DataArr['medical_history']) : null;
            $previous_episodes = (isset($DataArr['previous_episodes']) && !empty($DataArr['previous_episodes'])) ? trim($DataArr['previous_episodes']) : null;
            $digestive_disorders = (isset($DataArr['digestive_disorders']) && !empty($DataArr['digestive_disorders'])) ? trim($DataArr['digestive_disorders']) : null;
            $dietary_changes_times = (isset($DataArr['dietary_changes_times']) && !empty($DataArr['dietary_changes_times'])) ? trim($DataArr['dietary_changes_times']) : null;
            $dietary_changes_routines = (isset($DataArr['dietary_changes_routines']) && !empty($DataArr['dietary_changes_routines'])) ? trim($DataArr['dietary_changes_routines']) : null;
            $travel_historys = (isset($DataArr['travel_historys']) && !empty($DataArr['travel_historys'])) ? trim($DataArr['travel_historys']) : null;

            $AbdominalPainHistory = new AbdominalPainHistory;

            if ($UpdateId > 0) {

                $AbdominalPainHistory = AbdominalPainHistory::where('GnInfoId', $UpdateId)->first();
            }


            $AbdominalPainHistory->GnInfoId = $GeneralInfoReturnID;

            $AbdominalPainHistory->LocationOfPain = $location_of_pain;
            $AbdominalPainHistory->CharacterOfPain = $character_of_pain;
            $AbdominalPainHistory->OnsetAndDuration = $onset_and_duration;
            $AbdominalPainHistory->AggravatingOrRelieving = $relieving_factors;
            $AbdominalPainHistory->AssociatedSymptoms = $associated_symptoms;
            $AbdominalPainHistory->MedicalHistory = $medical_history;
            $AbdominalPainHistory->previous_episodes = $previous_episodes;
            $AbdominalPainHistory->digestive_disorders = $digestive_disorders;
            $AbdominalPainHistory->dietary_changes_times = $dietary_changes_times;
            $AbdominalPainHistory->dietary_changes_routines = $dietary_changes_routines;
            $AbdominalPainHistory->travel_historys = $travel_historys;


            $AbdominalPainHistory->save();


            if ($UpdateId > 0) {
                $AbdominalPainHistoryReturnID = $AbdominalPainHistory->id;
                ;
            } else {
                $AbdominalPainHistoryReturnID = DB::getPdo()->lastInsertId();

            }

            /* MENINGITIS */


            $onset_progression = (isset($DataArr['onset_progression']) && !empty($DataArr['onset_progression'])) ? trim($DataArr['onset_progression']) : null;
            $Headache = (isset($DataArr['Headache']) && !empty($DataArr['Headache'])) ? trim($DataArr['Headache']) : null;
            $Fever = (isset($DataArr['Fever']) && !empty($DataArr['Fever'])) ? trim($DataArr['Fever']) : null;

            $Meningitis = new Meningitis;

            if ($UpdateId > 0) {

                $Meningitis = Meningitis::where('GnInfoId', $UpdateId)->first();
            }


            $Meningitis->GnInfoId = $GeneralInfoReturnID;
            $Meningitis->OnsetAndProgression = $onset_progression;
            $Meningitis->Headache = $Headache;
            $Meningitis->Fever = $Fever;

            $Meningitis->save();

            if ($UpdateId > 0) {
                $MeningitisReturnID = $Meningitis->id;
            } else {
                $MeningitisReturnID = DB::getPdo()->lastInsertId();

            }


            /* Headache */

            $ClusterHeadache = (isset($DataArr['ClusterHeadache']) && !empty($DataArr['ClusterHeadache'])) ? trim($DataArr['ClusterHeadache']) : null;
            $Migraine = (isset($DataArr['Migraine']) && !empty($DataArr['Migraine'])) ? trim($DataArr['Migraine']) : null;
            $TensionHeadache = (isset($DataArr['TensionHeadache']) && !empty($DataArr['TensionHeadache'])) ? trim($DataArr['TensionHeadache']) : null;

            $Headache = new Headache;

            if ($UpdateId > 0) {

                $Headache = Headache::where('GnInfoId', $UpdateId)->first();
            }

            $Headache->GnInfoId = $GeneralInfoReturnID;
            $Headache->ClusterHeadache = $ClusterHeadache;
            $Headache->Migraine = $Migraine;
            $Headache->TensionHeadache = $TensionHeadache;

            $Headache->save();



            if ($UpdateId > 0) {
                $HeadacheReturnID = $Headache->id;
                ;
            } else {
                $HeadacheReturnID = DB::getPdo()->lastInsertId();

            }

            /* Fever History  */

            $actual_temperature = (isset($DataArr['actual_temperature']) && !empty($DataArr['actual_temperature'])) ? trim($DataArr['actual_temperature']) : null;
            $description_fever = (isset($DataArr['description_fever']) && !empty($DataArr['description_fever'])) ? trim($DataArr['description_fever']) : null;
            $onset_duration = (isset($DataArr['onset_duration']) && !empty($DataArr['onset_duration'])) ? trim($DataArr['onset_duration']) : null;
            $duration_fever_episodes = (isset($DataArr['duration_fever_episodes']) && !empty($DataArr['duration_fever_episodes'])) ? trim($DataArr['duration_fever_episodes']) : null;
            $pattern_fever = (isset($DataArr['pattern_fever']) && !empty($DataArr['pattern_fever'])) ? trim($DataArr['pattern_fever']) : null;
            $associated_symptoms1 = (isset($DataArr['associated_symptoms1']) && !empty($DataArr['associated_symptoms1'])) ? trim($DataArr['associated_symptoms1']) : null;
            $recent_exposures = (isset($DataArr['recent_exposures']) && !empty($DataArr['recent_exposures'])) ? trim($DataArr['recent_exposures']) : null;

            $FeverHistory = new FeverHistory;


            if ($UpdateId > 0) {

                $FeverHistory = FeverHistory::where('GnInfoId', $UpdateId)->first();
            }

            $FeverHistory->temperature = $actual_temperature;
            $FeverHistory->Description_of_fever = $description_fever;
            $FeverHistory->Onset_Duration = $onset_duration;
            $FeverHistory->Duration = $duration_fever_episodes;
            $FeverHistory->PatternOfFever = $pattern_fever;
            $FeverHistory->AssociatedSymptoms = $associated_symptoms1;
            $FeverHistory->RecentExposuresOrTravel = $recent_exposures;

            $FeverHistory->GnInfoId = $GeneralInfoReturnID;

            $FeverHistory->save();




            if ($UpdateId > 0) {
                $FeverHistoryReturnID = $FeverHistory->id;
                ;
            } else {
                $FeverHistoryReturnID = DB::getPdo()->lastInsertId();

            }



            /* VITAL SIGNS */


            $pulse = (isset($DataArr['pulse']) && !empty($DataArr['pulse'])) ? trim($DataArr['pulse']) : null;
            $temperature = (isset($DataArr['temperature']) && !empty($DataArr['temperature'])) ? trim($DataArr['temperature']) : null;
            $bp = (isset($DataArr['bp']) && !empty($DataArr['bp'])) ? trim($DataArr['bp']) : null;
            $RespiratoryRate = (isset($DataArr['RespiratoryRate']) && !empty($DataArr['RespiratoryRate'])) ? trim($DataArr['RespiratoryRate']) : null;
            $bmi_weight = (isset($DataArr['bmi_weight']) && !empty($DataArr['bmi_weight'])) ? trim($DataArr['bmi_weight']) : null;
            $bmi_height = (isset($DataArr['bmi_height']) && !empty($DataArr['bmi_height'])) ? trim($DataArr['bmi_height']) : null;

            $VitalSign = new VitalSign;

            if ($UpdateId > 0) {

                $VitalSign = VitalSign::where('GnInfoId', $UpdateId)->first();
            }


            $VitalSign->pulse = $pulse;
            $VitalSign->temperature = $temperature;
            $VitalSign->bp = $bp;
            $VitalSign->RespiratoryRate = $RespiratoryRate;
            $VitalSign->bmi_weight = $bmi_weight;
            $VitalSign->bmi_height = $bmi_height;

            $VitalSign->GnInfoId = $GeneralInfoReturnID;

            $VitalSign->save();





            if ($UpdateId > 0) {
                $VitalSignReturnID = $VitalSign->id;
                ;
            } else {
                $VitalSignReturnID = DB::getPdo()->lastInsertId();

            }

            /* Recent Changes or Symptoms of Concern */

            $Description3 = (isset($DataArr['Description3']) && !empty($DataArr['Description3'])) ? trim($DataArr['Description3']) : null;
            $Onset3 = (isset($DataArr['Onset3']) && !empty($DataArr['Onset3'])) ? trim($DataArr['Onset3']) : null;
            $Duration3 = (isset($DataArr['Duration3']) && !empty($DataArr['Duration3'])) ? trim($DataArr['Duration3']) : null;
            $Severity3 = (isset($DataArr['Severity3']) && !empty($DataArr['Severity3'])) ? trim($DataArr['Severity3']) : null;
            $RelievingFactor3 = (isset($DataArr['RelievingFactor3']) && !empty($DataArr['RelievingFactor3'])) ? trim($DataArr['RelievingFactor3']) : null;
            $AssociatedSymptoms3 = (isset($DataArr['AssociatedSymptoms3']) && !empty($DataArr['AssociatedSymptoms3'])) ? trim($DataArr['AssociatedSymptoms3']) : null;

            $RecentChangesOrConcern = new RecentChangesOrConcern;

            if ($UpdateId > 0) {

                $RecentChangesOrConcern = RecentChangesOrConcern::where('GnInfoId', $UpdateId)->first();
            }


            $RecentChangesOrConcern->GnInfoId = $GeneralInfoReturnID;
            $RecentChangesOrConcern->Description = $Description3;
            $RecentChangesOrConcern->Onset = $Onset3;
            $RecentChangesOrConcern->Duration = $Duration3;
            $RecentChangesOrConcern->Severity = $Severity3;
            $RecentChangesOrConcern->RelievingFactor = $RelievingFactor3;
            $RecentChangesOrConcern->AssociatedSymptoms = $AssociatedSymptoms3;

            $RecentChangesOrConcern->save();


            if ($UpdateId > 0) {
                $RecentChangesOrConcernReturnID = $RecentChangesOrConcern->id;
                ;
            } else {
                $RecentChangesOrConcernReturnID = DB::getPdo()->lastInsertId();

            }


            /* Secondary Complaints (if any) */

            $Description2 = (isset($DataArr['Description2']) && !empty($DataArr['Description2'])) ? trim($DataArr['Description2']) : null;
            $Onset2 = (isset($DataArr['Onset2']) && !empty($DataArr['Onset2'])) ? trim($DataArr['Onset2']) : null;
            $Duration2 = (isset($DataArr['Duration2']) && !empty($DataArr['Duration2'])) ? trim($DataArr['Duration2']) : null;
            $Severity2 = (isset($DataArr['Severity2']) && !empty($DataArr['Severity2'])) ? trim($DataArr['Severity2']) : null;
            $RelievingFactor2 = (isset($DataArr['RelievingFactor2']) && !empty($DataArr['RelievingFactor2'])) ? trim($DataArr['RelievingFactor2']) : null;
            $AssociatedSymptoms2 = (isset($DataArr['AssociatedSymptoms2']) && !empty($DataArr['AssociatedSymptoms2'])) ? trim($DataArr['AssociatedSymptoms2']) : null;


            $SecondaryComplain = new SecondaryComplain;

            if ($UpdateId > 0) {

                $SecondaryComplain = SecondaryComplain::where('GnInfoId', $UpdateId)->first();
            }



            $SecondaryComplain->GnInfoId = $GeneralInfoReturnID;
            $SecondaryComplain->Description = $Description2;
            $SecondaryComplain->Onset = $Onset2;
            $SecondaryComplain->Duration = $Duration2;
            $SecondaryComplain->Severity = $Severity2;
            $SecondaryComplain->RelievingFactor = $RelievingFactor2;
            $SecondaryComplain->AssociatedSymptoms = $AssociatedSymptoms2;

            $SecondaryComplain->save();





            if ($UpdateId > 0) {
                $SecondaryComplainReturnID = $SecondaryComplain->id;
                ;
            } else {
                $SecondaryComplainReturnID = DB::getPdo()->lastInsertId();

            }




            /* MainComplaint */

            $Description = (isset($DataArr['Description']) && !empty($DataArr['Description'])) ? trim($DataArr['Description']) : null;
            $Onset = (isset($DataArr['Onset']) && !empty($DataArr['Onset'])) ? trim($DataArr['Onset']) : null;
            $Duration = (isset($DataArr['Duration']) && !empty($DataArr['Duration'])) ? trim($DataArr['Duration']) : null;
            $Severity = (isset($DataArr['Severity']) && !empty($DataArr['Severity'])) ? trim($DataArr['Severity']) : null;
            $RelievingFactor = (isset($DataArr['RelievingFactor']) && !empty($DataArr['RelievingFactor'])) ? trim($DataArr['RelievingFactor']) : null;
            $AssociatedSymptoms = (isset($DataArr['AssociatedSymptoms']) && !empty($DataArr['AssociatedSymptoms'])) ? trim($DataArr['AssociatedSymptoms']) : null;


            $MainComplaint = new MainComplaint;

            if ($UpdateId > 0) {

                $MainComplaint = MainComplaint::where('GnInfoId', $UpdateId)->first();
            }


            $MainComplaint->GnInfoId = $GeneralInfoReturnID;
            $MainComplaint->Description = $Description;
            $MainComplaint->Onset = $Onset;
            $MainComplaint->Duration = $Duration;
            $MainComplaint->Severity = $Severity;
            $MainComplaint->AssociatedSymptoms = $AssociatedSymptoms;
            $MainComplaint->RelievingFactor = $RelievingFactor;
            $MainComplaint->save();


            if ($UpdateId > 0) {
                $MainComplaintReturnID = $MainComplaint->id;
                ;
            } else {
                $MainComplaintReturnID = DB::getPdo()->lastInsertId();

            }


            DB::commit();

            // echo "<PRE>";print_r($DataArr);exit;


            if ($UpdateId > 0) {
                $message = "Updated Successfully";
            } else {
                $message = "Created Successfully";

            }



            Session::flash("success_message", $message);
            // return redirect()->back();
            return redirect()->Route('IndexMedicalHistory');


        }

        $MainComplaint = array();
        $GeneralInfo = array();
        $SecondaryComplain = array();
        $RecentChangesOrConcern = array();
        $VitalSign = array();
        $FeverHistory = array();
        $Headache = array();
        $Meningitis = array();
        $AbdominalPainHistory = array();
        $PersonalHistory = array();
        $NutritionHistory = array();
        $ChestPain = array();
        $RespiratorySystem = array();
        $UpperResp = array();
        $Cough = array();
        $Sob = array();
        $HistoryOfPneumonia = array();
        $LowerRespiratoryTractInfections = array();
        $LowerRespiratorySob = array();
        $HistoryOfInfection = array();
        $SkinDisease = array();
        $ChiefComplaint = array();
        $previousMenstruationTreatmentOrInterventions = array();
        $PastMedicalConditions = array();
        $Allergies = array();
        $Socioeconomic = array();
        if ($UpdateId > 0) {
            $GeneralInfo = GeneralInfo::find($UpdateId);
            $MainComplaint = MainComplaint::where('GnInfoId', $UpdateId)->first();
            $SecondaryComplain = SecondaryComplain::where('GnInfoId', $UpdateId)->first();
            $RecentChangesOrConcern = RecentChangesOrConcern::where('GnInfoId', $UpdateId)->first();
            $VitalSign = VitalSign::where('GnInfoId', $UpdateId)->first();
            $FeverHistory = FeverHistory::where('GnInfoId', $UpdateId)->first();
            $Meningitis = Meningitis::where('GnInfoId', $UpdateId)->first();
            $AbdominalPainHistory = AbdominalPainHistory::where('GnInfoId', $UpdateId)->first();
            $PersonalHistory = PersonalHistory::where('GnInfoId', $UpdateId)->first();
            $SleepRoutine = SleepRoutine::where('GnInfoId', $UpdateId)->first();
            $NutritionHistory = NutritionHistory::where('GnInfoId', $UpdateId)->first();
            $ChestPain = ChestPain::where('GnInfoId', $UpdateId)->first();
            $RespiratorySystem = RespiratorySystem::where('GnInfoId', $UpdateId)->first();
            $Sob = Sob::where('GnInfoId', $UpdateId)->first();
            $UpperResp = UpperResp::where('GnInfoId', $UpdateId)->first();
            $Cough = Cough::where('GnInfoId', $UpdateId)->first();
            $HistoryOfPneumonia = HistoryOfPneumonia::where('GnInfoId', $UpdateId)->first();
            $LowerRespiratoryTractInfections = LowerRespiratoryTractInfections::where('GnInfoId', $UpdateId)->first();
            $LowerRespiratorySob = LowerRespiratorySob::where('GnInfoId', $UpdateId)->first();
            $HistoryOfInfection = HistoryOfInfection::where('GnInfoId', $UpdateId)->first();
            $Headache = Headache::where('GnInfoId', $UpdateId)->first();
            $SkinDisease = SkinDisease::where('GnInfoId', $UpdateId)->first();
            $ChiefComplaint = ChiefComplaint::where('GnInfoId', $UpdateId)->first();
            $previousMenstruationTreatmentOrInterventions = previousMenstruationTreatmentOrInterventions::where('GnInfoId', $UpdateId)->first();
            $PastMedicalConditions = PastMedicalConditions::where('GnInfoId', $UpdateId)->first();
            $Allergies = Allergies::where('GnInfoId', $UpdateId)->first();
            $Socioeconomic = Socioeconomic::where('GnInfoId', $UpdateId)->first();

        }
        // return view('admin.medical_history')->with(compact('GeneralInfo'));
        return view('admin.MedicalHistory.CreateUpdate')->with(get_defined_vars());
    }
    public function MedicalHistroyView(request $request, $StudentBiodata)
    {
        $StudentBiodata = StudentBiodata::where('id', $StudentBiodata)->get();
        $SchoolHealthPhysician = SchoolHealthPhysician::where('id', $StudentBiodata)->get();
        $NutritionistHistoryEvaluationSection = NutritionistHistoryEvaluationSection::where('id', $StudentBiodata)->get();
        $PsychologistHistoryAssessmentSection = PsychologistHistoryAssessmentSection::where('id', $StudentBiodata)->get();
        return view("admin.MedicalHistory.medicalhistoryview", compact("StudentBiodata", "SchoolHealthPhysician", "NutritionistHistoryEvaluationSection", "PsychologistHistoryAssessmentSection"));


    }



    public function index(request $request, $id = null)
    {


        return view('admin.MedicalHistory.index');


    }

    /*List*/
    public function List(Request $request)
    {


        $UserID = auth()->guard('admin')->user()->id;
        $UserRole = auth()->guard('admin')->user()->role;


        /*  $data = StudentBiodata::select(
              'student_biodata.id as student_bio_data_id',
              'student_biodata.*'
          )
          ->leftJoin('school_health_physicians', function ($join) {
              $join->on('student_biodata.id', '=', 'school_health_physicians.StudentBiodataId')
                  ->where('school_health_physicians.deleted', 0);
          })
          ->leftJoin('nutritionist_history_evaluation_sections', function ($join) {
              $join->on('student_biodata.id', '=', 'nutritionist_history_evaluation_sections.StudentBiodataId')
                  ->where('nutritionist_history_evaluation_sections.deleted', 0);
          })
          ->leftJoin('psychologist_history_assessment_sections', function ($join) {
              $join->on('student_biodata.id', '=', 'psychologist_history_assessment_sections.StudentBiodataId')
                  ->where('psychologist_history_assessment_sections.deleted', 0);
          })
      ->where('student_biodata.deleted', 0);*/


        $data = StudentBiodata::orderBy('student_biodata.id', 'desc')
            ->join('users', 'users.id', '=', 'student_biodata.created_by')
            ->select('student_biodata.*', 'users.fullname')
            ->with([
                'school_health_physicians' => function ($query) {
                    $query->where('deleted', 0); // Include only related school_health_physicians that are not deleted
                }
            ])
            ->with([
                'nutritionist_history_evaluation_sections' => function ($query) {
                    $query->where('deleted', 0); // Include only related school_health_physicians that are not deleted
                }
            ])
            ->with([
                'psychologist_history_assessment_sections' => function ($query) {
                    $query->where('deleted', 0); // Include only related school_health_physicians that are not deleted
                }
            ])

            ->where('student_biodata.deleted', 0);
  $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        if (!empty($fromDate) && !empty($toDate)) {
            $data = $data->whereDate('student_biodata.created_at', '>=', $fromDate)
                         ->whereDate('student_biodata.created_at', '<=', $toDate);
        }
        /*$data = StudentBiodata::select(
            'student_biodata.id as student_bio_data_id',
            'student_biodata.*',
            'school_health_physicians.*',
            'psychologist_history_assessment_sections.*',
            'nutritionist_history_evaluation_sections.*'
        )
        ->leftJoin('school_health_physicians', function ($join) {
            $join->on('student_biodata.id', '=', 'school_health_physicians.StudentBiodataId')
                 ->where('school_health_physicians.deleted', 0);
        })
        ->leftJoin('nutritionist_history_evaluation_sections', function ($join) {
            $join->on('student_biodata.id', '=', 'nutritionist_history_evaluation_sections.StudentBiodataId')
                 ->where('nutritionist_history_evaluation_sections.deleted', 0);
        })
        ->leftJoin('psychologist_history_assessment_sections', function ($join) {
            $join->on('student_biodata.id', '=', 'psychologist_history_assessment_sections.StudentBiodataId')
                 ->where('psychologist_history_assessment_sections.deleted', 0);
        })
        ->where('student_biodata.deleted', 0);*/


        //  check this code ------------------------------------
        // if ($UserRole == 2) {

        //     $data = $data->where(function ($query) use ($UserID) {
        //         $query->where('created_by', $UserID)->orWhere('updated_by', $UserID);
        //     });


        // }


        if ($request->has('schoolId')) {

            $schoolId = $request->input('schoolId');
            $data = $data->where('School_Name', $schoolId); // Adjust this to match your actual field name
        }

        if ($request->has('Follow_up_Date_flag')) {

            $Follow_up_Date_flag = $request->input('Follow_up_Date_flag');
            $data = $data->where('Follow_up_Date_flag', $Follow_up_Date_flag); // Adjust this to match your actual field name
        }

        if ($request->has('MedicalHistoryType')) {

            $MedicalHistoryType = $request->input('MedicalHistoryType');
            $data = $data->where('MedicalHistoryType', $MedicalHistoryType); // Adjust this to match your actual field name

        }

        if ($request->has('Blood_pressure_result')) {

            $Blood_pressure_result = $request->input('Blood_pressure_result');


            $data = $data->join('school_health_physicians', function ($join) {
                $join->on('student_biodata.id', '=', 'school_health_physicians.StudentBiodataId')
                    ->where('school_health_physicians.deleted', 0);
            })->where('school_health_physicians.Blood_pressure_result', $Blood_pressure_result);
        }

        if ($request->has('BloodPressureDiastolicResult')) {
            $BloodPressureDiastolicResult = $request->input('BloodPressureDiastolicResult');

            $data = $data->join('school_health_physicians', function ($join) {
                $join->on('student_biodata.id', '=', 'school_health_physicians.StudentBiodataId')
                    ->where('school_health_physicians.deleted', 0);
            })->where('school_health_physicians.BloodPressureDiastolicResult', $BloodPressureDiastolicResult);
        }

        if ($request->has('TemperatureResult')) {
            $TemperatureResult = $request->input('TemperatureResult');

            $data = $data->join('school_health_physicians', function ($join) {
                $join->on('student_biodata.id', '=', 'school_health_physicians.StudentBiodataId')
                    ->where('school_health_physicians.deleted', 0);
            })->where('school_health_physicians.TemperatureResult', $TemperatureResult);
        }

        if ($request->has('PulseResult')) {
            $PulseResult = $request->input('PulseResult');

            $data = $data->join('school_health_physicians', function ($join) {
                $join->on('student_biodata.id', '=', 'school_health_physicians.StudentBiodataId')
                    ->where('school_health_physicians.deleted', 0);
            })->where('school_health_physicians.PulseResult', $PulseResult);
        }

        if ($request->has('RespiratoryRateResult')) {
            $RespiratoryRateResult = $request->input('RespiratoryRateResult');

            $data = $data->join('school_health_physicians', function ($join) {
                $join->on('student_biodata.id', '=', 'school_health_physicians.StudentBiodataId')
                    ->where('school_health_physicians.deleted', 0);
            })->where('school_health_physicians.RespiratoryRateResult', $RespiratoryRateResult);
        }

        if ($request->has('WeightResult')) {
            $WeightResult = $request->input('WeightResult');

            $data = $data->join('school_health_physicians', function ($join) {
                $join->on('student_biodata.id', '=', 'school_health_physicians.StudentBiodataId')
                    ->where('school_health_physicians.deleted', 0);
            })->where('school_health_physicians.WeightResult', $WeightResult);
        }

        if ($request->has('HeightResult')) {
            $HeightResult = $request->input('HeightResult');

            $data = $data->join('school_health_physicians', function ($join) {
                $join->on('student_biodata.id', '=', 'school_health_physicians.StudentBiodataId')
                    ->where('school_health_physicians.deleted', 0);
            })->where('school_health_physicians.HeightResult', $HeightResult);
        }

        if ($request->has('BMIResult')) {
            $BMIResult = $request->input('BMIResult');

            $data = $data->join('school_health_physicians', function ($join) {
                $join->on('student_biodata.id', '=', 'school_health_physicians.StudentBiodataId')
                    ->where('school_health_physicians.deleted', 0);
            })->where('school_health_physicians.BMIResult', $BMIResult);
        }


        // $sql = $data->toSql();

        // Get the bound values
        // $bindings = $data->getBindings();

        // Combine SQL and bound values for debugging
        // foreach ($bindings as $binding) {
        //     $sql = preg_replace('/\?/', $binding, $sql, 1);
        // }

        // dd($sql);

        $data = $data->get()->toArray();

        // dd($data);

        return Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('created_at', function ($row) {
                // Format the created_at date using Carbon
                return Carbon::parse($row['created_at'])->format('d/m/Y');
            })

            /* ->addColumn('Follow_up_Date_flag', function ($row) {


                 $Follow_up_Date_flag = $row['Follow_up_Date_flag'];

                 if($Follow_up_Date_flag == 0)
                 {
                     $Follow_up_Date_flag = "Un Schedule";

                 }
                 else if($Follow_up_Date_flag == 1)
                 {
                     $Follow_up_Date_flag = "Schedule";

                 }
                 else
                 {
                     $Follow_up_Date_flag = "N/A";

                 }

                 return $Follow_up_Date_flag;
             }) */



            ->addColumn('Follow_up_Date_flag', function ($row) {

                /*
            
                0= if Follow-up Required yes and Follow-up Date blank,
                1= if Follow-up Required yes and Follow-up Date not blank,
                2=if Follow-up Required no 

                */


                $Follow_up_Date_flag = $row['Follow_up_Date_flag'];
                $label = ""; // Initialize the variable to store the final HTML output
    
                if ($Follow_up_Date_flag === 0) {

                    $label = "<span style='background-color: red; color: white; padding: 5px; border-radius: 3px;'>Un Schedule</span>";
                } elseif ($Follow_up_Date_flag == 1) {

                    $label = "<span style='background-color: green; color: white; padding: 5px; border-radius: 3px;'>Schedule</span>";
                } elseif ($Follow_up_Date_flag == 2) {

                    $label = "<span style='background-color: green; color: white; padding: 5px; border-radius: 3px;'>No</span>";
                } else {
                    $label = "<span style='background-color: gray; color: white; padding: 5px; border-radius: 3px;'>N/A</span>";
                }

                return $label;
            })

            ->addColumn('School_Name', function ($row) {

                $School_ID = $row['School_Name'];

                $School_Name = "N/A";

                $school = School::get();
                if (!empty($school)) {
                    foreach ($school as $item) {
                        if ($School_ID == $item->id) {
                            $School_Name = $item->school_name;

                        }

                    }
                }




                return $School_Name;

            })

            ->addColumn('action', function ($row) {

                // dd($row);
                $btn = "";


                // $btn .= ' &nbsp; <a href="' . Route('ViewMedicalHistory') . '/' . $row['id'] . '" title="Edit"><i class="fa fa-eye iic text-light"></i></a>';
                $btn .= ' &nbsp; <a href="' . Route('ViewMedicalHistory1') . '/' . $row['id'] . '" title="View"><i class="fa fa-eye iic"></i></a>';
                // $btn .= ' &nbsp; <a href="' . Route('ViewMedicalHistory1') . '/' . $row['student_bio_data_id'] . '" title="View"><i class="fa fa-eye iic"></i></a>';
                // $btn .= ' &nbsp; <a href="' . Route('UpdateMedicalHistory') . '/' . $row['id'] . '" title="Edit"><i class="fa fa-edit iic text-light"></i></a>';
                $btn .= ' &nbsp; <a href="' . Route('StudentBiodata') . '/' . $row['id'] . '" title="Edit"><i class="fa fa-edit iic"></i></a>';
                // $btn .= ' &nbsp; <a href="' . Route('StudentBiodata') . '/' . $row['student_bio_data_id'] . '" title="Edit"><i class="fa fa-edit iic"></i></a>';
                // $btn .= ' &nbsp; <a href="' . Route('medicalhistorydata') . '/' . $row['id'] . '" title="Edit"><i class="fa fa-edit iic text-light"></i></a>';
    
                $btn .= ' &nbsp;<a title="Delete" href="javascript:void(0)" class="confirmDeleteIt"  data-id="' . $row['id'] . '" data-url="' . Route('DeleteMedicalHistory') . '"> <i class="fa fa-close iic"></i></a>';

                return $btn;
            })
            ->rawColumns(['action', 'Follow_up_Date_flag'])
            ->make(true);

    }

    /*SchoolHealthPhysician*/
    public function SchoolHealthPhysician(request $request, $StudentBiodataId = null)
    {


        if ($request->isMethod('post')) {

            $DataArr = $request->all();


            $rules = array(

                'Chief_Complaints1' => 'required',
                'History_of_Presenting_Complaints1' => 'required',
                'Review_of_Systems' => 'required',
                'General' => 'required',
                'Eyes' => 'required',
                'Ears_Nose_and_Throat' => 'required',
                'Teeth' => 'required',
                'Cardiorespiratory' => 'required',
                'Gastrointestinal' => 'required',
                'Genitourinary' => 'required',
                'Neuromuscular' => 'required',
                'Endocrine' => 'required',
                'Hematologic' => 'required',
                'Rheumatologic' => 'required',
                'Skin' => 'required',
                'Investigations_Laboratory_Test_Reports1' => 'required',
                'Medication_History' => 'required',
                'Allergies' => 'required',
                'Past_Medical_History' => 'required',
                'Past_Surgical_History' => 'required',
                'Birth_History' => 'required',
                'Immunizatio_History' => 'required',
                'Growth_Development_Puberty_changes' => 'required',
                'Nutrition_History' => 'required',
                'Family_History1' => 'required',
                'Personal_Social_History1' => 'required',
                'Blood_pressure' => 'required',
                // 'BloodPressureSystolic' => 'required',
                'BloodPressureDiastolic' => 'required',
                'Temperature' => 'required',
                'Pulse_rate' => 'required',
                'Respiratory_Rate' => 'required',
                'Weight' => 'required',
                'Height' => 'required',
                'BMI' => 'required',
                'General_Appearance' => 'required',
                'Lymph_Nodes' => 'required',
                'Head' => 'required',
                'ENT' => 'required',
                'Chest' => 'required',
                'Heart' => 'required',
                'Abdomen' => 'required',
                'Extremities' => 'required',
                'Neurologic_Examination' => 'required',

                /* Diagnosis, Impression and Plan */

                /*'Problem_List' => 'required',
                'Impression' => 'required',
                'Investigations_Recommended' => 'required',
                'Provisional_Diagnosis' => 'required',
                'General_Advice' => 'required',
                'First_Aid_Given' => 'required',
                
                */

                'Follow_up_Required' => 'required',
                /*'Reason_for_Follow_up' => 'required',
                'Follow_up_Date' => 'required',*/



                /*
                
                'internal_referrals' => 'required',
                'external_referrals' => 'required',
                'Reason_for_Referral' => 'required',
                
                */



            );

            $this->validate($request, $rules);


            $Chief_Complaints1 = (isset($DataArr['Chief_Complaints1']) && !empty($DataArr['Chief_Complaints1'])) ? trim($DataArr['Chief_Complaints1']) : null;
            $History_of_Presenting_Complaints1 = (isset($DataArr['History_of_Presenting_Complaints1']) && !empty($DataArr['History_of_Presenting_Complaints1'])) ? trim($DataArr['History_of_Presenting_Complaints1']) : null;
            $Review_of_Systems = (isset($DataArr['Review_of_Systems']) && !empty($DataArr['Review_of_Systems'])) ? trim($DataArr['Review_of_Systems']) : null;
            $General = (isset($DataArr['General']) && !empty($DataArr['General'])) ? trim($DataArr['General']) : null;
            $Eyes = (isset($DataArr['Eyes']) && !empty($DataArr['Eyes'])) ? trim($DataArr['Eyes']) : null;
            $Ears_Nose_and_Throat = (isset($DataArr['Ears_Nose_and_Throat']) && !empty($DataArr['Ears_Nose_and_Throat'])) ? trim($DataArr['Ears_Nose_and_Throat']) : null;
            $Teeth = (isset($DataArr['Teeth']) && !empty($DataArr['Teeth'])) ? trim($DataArr['Teeth']) : null;
            $Cardiorespiratory = (isset($DataArr['Cardiorespiratory']) && !empty($DataArr['Cardiorespiratory'])) ? trim($DataArr['Cardiorespiratory']) : null;
            $Gastrointestinal = (isset($DataArr['Gastrointestinal']) && !empty($DataArr['Gastrointestinal'])) ? trim($DataArr['Gastrointestinal']) : null;
            $Genitourinary = (isset($DataArr['Genitourinary']) && !empty($DataArr['Genitourinary'])) ? trim($DataArr['Genitourinary']) : null;
            $Neuromuscular = (isset($DataArr['Neuromuscular']) && !empty($DataArr['Neuromuscular'])) ? trim($DataArr['Neuromuscular']) : null;
            $Endocrine = (isset($DataArr['Endocrine']) && !empty($DataArr['Endocrine'])) ? trim($DataArr['Endocrine']) : null;
            $Hematologic = (isset($DataArr['Hematologic']) && !empty($DataArr['Hematologic'])) ? trim($DataArr['Hematologic']) : null;
            $Rheumatologic = (isset($DataArr['Rheumatologic']) && !empty($DataArr['Rheumatologic'])) ? trim($DataArr['Rheumatologic']) : null;
            $Skin = (isset($DataArr['Skin']) && !empty($DataArr['Skin'])) ? trim($DataArr['Skin']) : null;
            $Investigations_Laboratory_Test_Reports1 = (isset($DataArr['Investigations_Laboratory_Test_Reports1']) && !empty($DataArr['Investigations_Laboratory_Test_Reports1'])) ? trim($DataArr['Investigations_Laboratory_Test_Reports1']) : null;
            $Medication_History = (isset($DataArr['Medication_History']) && !empty($DataArr['Medication_History'])) ? trim($DataArr['Medication_History']) : null;
            $Allergies = (isset($DataArr['Allergies']) && !empty($DataArr['Allergies'])) ? trim($DataArr['Allergies']) : null;
            $Past_Medical_History = (isset($DataArr['Past_Medical_History']) && !empty($DataArr['Past_Medical_History'])) ? trim($DataArr['Past_Medical_History']) : null;
            $Past_Surgical_History = (isset($DataArr['Past_Surgical_History']) && !empty($DataArr['Past_Surgical_History'])) ? trim($DataArr['Past_Surgical_History']) : null;
            $Birth_History = (isset($DataArr['Birth_History']) && !empty($DataArr['Birth_History'])) ? trim($DataArr['Birth_History']) : null;
            $Immunizatio_History = (isset($DataArr['Immunizatio_History']) && !empty($DataArr['Immunizatio_History'])) ? trim($DataArr['Immunizatio_History']) : null;
            $Growth_Development_Puberty_changes = (isset($DataArr['Growth_Development_Puberty_changes']) && !empty($DataArr['Growth_Development_Puberty_changes'])) ? trim($DataArr['Growth_Development_Puberty_changes']) : null;
            $Nutrition_History = (isset($DataArr['Nutrition_History']) && !empty($DataArr['Nutrition_History'])) ? trim($DataArr['Nutrition_History']) : null;
            $Family_History1 = (isset($DataArr['Family_History1']) && !empty($DataArr['Family_History1'])) ? trim($DataArr['Family_History1']) : null;
            $Personal_Social_History1 = (isset($DataArr['Personal_Social_History1']) && !empty($DataArr['Personal_Social_History1'])) ? trim($DataArr['Personal_Social_History1']) : null;
            $Blood_pressure = (isset($DataArr['Blood_pressure']) && !empty($DataArr['Blood_pressure'])) ? trim($DataArr['Blood_pressure']) : null;
            // $BloodPressureSystolic = (isset($DataArr['BloodPressureSystolic']) && !empty($DataArr['BloodPressureSystolic'])) ? trim($DataArr['BloodPressureSystolic']) : null;
            $BloodPressureDiastolic = (isset($DataArr['BloodPressureDiastolic']) && !empty($DataArr['BloodPressureDiastolic'])) ? trim($DataArr['BloodPressureDiastolic']) : null;
            $Temperature = (isset($DataArr['Temperature']) && !empty($DataArr['Temperature'])) ? trim($DataArr['Temperature']) : null;
            $Pulse_rate = (isset($DataArr['Pulse_rate']) && !empty($DataArr['Pulse_rate'])) ? trim($DataArr['Pulse_rate']) : null;
            $Respiratory_Rate = (isset($DataArr['Respiratory_Rate']) && !empty($DataArr['Respiratory_Rate'])) ? trim($DataArr['Respiratory_Rate']) : null;
            $Weight = (isset($DataArr['Weight']) && !empty($DataArr['Weight'])) ? trim($DataArr['Weight']) : null;
            $Height = (isset($DataArr['Height']) && !empty($DataArr['Height'])) ? trim($DataArr['Height']) : null;
            $BMI = (isset($DataArr['BMI']) && !empty($DataArr['BMI'])) ? trim($DataArr['BMI']) : null;
            $General_Appearance = (isset($DataArr['General_Appearance']) && !empty($DataArr['General_Appearance'])) ? trim($DataArr['General_Appearance']) : null;
            $Lymph_Nodes = (isset($DataArr['Lymph_Nodes']) && !empty($DataArr['Lymph_Nodes'])) ? trim($DataArr['Lymph_Nodes']) : null;
            $Head = (isset($DataArr['Head']) && !empty($DataArr['Head'])) ? trim($DataArr['Head']) : null;
            $ENT = (isset($DataArr['ENT']) && !empty($DataArr['ENT'])) ? trim($DataArr['ENT']) : null;
            $Chest = (isset($DataArr['Chest']) && !empty($DataArr['Chest'])) ? trim($DataArr['Chest']) : null;
            $Heart = (isset($DataArr['Heart']) && !empty($DataArr['Heart'])) ? trim($DataArr['Heart']) : null;
            $Abdomen = (isset($DataArr['Abdomen']) && !empty($DataArr['Abdomen'])) ? trim($DataArr['Abdomen']) : null;
            $Extremities = (isset($DataArr['Extremities']) && !empty($DataArr['Extremities'])) ? trim($DataArr['Extremities']) : null;
            $Neurologic_Examination = (isset($DataArr['Neurologic_Examination']) && !empty($DataArr['Neurologic_Examination'])) ? trim($DataArr['Neurologic_Examination']) : null;
            $Problem_List = (isset($DataArr['Problem_List']) && !empty($DataArr['Problem_List'])) ? trim($DataArr['Problem_List']) : null;
            $Impression = (isset($DataArr['Impression']) && !empty($DataArr['Impression'])) ? trim($DataArr['Impression']) : null;

            $Provisional_Diagnosis = (isset($DataArr['Provisional_Diagnosis']) && !empty($DataArr['Provisional_Diagnosis'])) ? $DataArr['Provisional_Diagnosis'] : null;
            $Provisional_Diagnosis = is_array($Provisional_Diagnosis) ? $Provisional_Diagnosis : (is_string($Provisional_Diagnosis) ? [$Provisional_Diagnosis] : []);

            $Investigations_Recommended = (isset($DataArr['Investigations_Recommended']) && !empty($DataArr['Investigations_Recommended'])) ? trim($DataArr['Investigations_Recommended']) : null;

            $General_Advice = (isset($DataArr['General_Advice']) && !empty($DataArr['General_Advice'])) ? trim($DataArr['General_Advice']) : null;
            $First_Aid_Given = (isset($DataArr['First_Aid_Given']) && !empty($DataArr['First_Aid_Given'])) ? trim($DataArr['First_Aid_Given']) : null;
            $Follow_up_Required = (isset($DataArr['Follow_up_Required']) && !empty($DataArr['Follow_up_Required'])) ? trim($DataArr['Follow_up_Required']) : null;

            $internal_referrals = (isset($DataArr['internal_referrals']) && !empty($DataArr['internal_referrals'])) ? $DataArr['internal_referrals'] : null;
            $external_referrals = (isset($DataArr['external_referrals']) && !empty($DataArr['external_referrals'])) ? $DataArr['external_referrals'] : null;

            $internal_referrals = is_array($internal_referrals) ? $internal_referrals : (is_string($internal_referrals) ? [$internal_referrals] : []);
            $external_referrals = is_array($external_referrals) ? $external_referrals : (is_string($external_referrals) ? [$external_referrals] : []);


            $Reason_for_Follow_up = (isset($DataArr['Reason_for_Follow_up']) && !empty($DataArr['Reason_for_Follow_up'])) ? trim($DataArr['Reason_for_Follow_up']) : null;
            $Follow_up_Date = (isset($DataArr['Follow_up_Date']) && !empty($DataArr['Follow_up_Date'])) ? trim($DataArr['Follow_up_Date']) : null;
            $Reason_for_Referral = (isset($DataArr['Reason_for_Referral']) && !empty($DataArr['Reason_for_Referral'])) ? trim($DataArr['Reason_for_Referral']) : null;



            DB::beginTransaction();


            $userID = Auth::guard(config('constants.ADMIN_GUARD'))->check() ? Auth::guard(config('constants.ADMIN_GUARD'))->user()->id : Auth::guard(config('constants.STUDENT_GUARD'))->user()->id;


            $SchoolHealthPhysician = SchoolHealthPhysician::where('deleted', 0)->where('StudentBiodataId', $StudentBiodataId)->first();


            $message = "Updated Successfully";
            Session::flash("success_message", $message);

            if (empty($SchoolHealthPhysician)) {

                $SchoolHealthPhysician = new SchoolHealthPhysician();

                $message = "Created Successfully";
                Session::flash("success_message", $message);

                $SchoolHealthPhysician->created_by = $userID;


                if ($Follow_up_Required == "Yes" && !empty($Follow_up_Date)) {

                    $StudentBiodataDesignation = StudentBiodata::where('id', $StudentBiodataId)->first();
                    if (!empty($StudentBiodataDesignation)) {

                        $UsersDesignations = User::where('role', '!=', 3)->where('designation', $StudentBiodataDesignation->designation)->get()->toArray();
                        if (!empty($UsersDesignations)) {
                            foreach ($UsersDesignations as $UsersDesignation) {


                                $MedicalNotifications = new MedicalNotifications;

                                $MedicalNotifications->created_by = $UsersDesignation['id'];
                                $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                                $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                                $MedicalNotifications->redirect_link = $StudentBiodataId;
                                $MedicalNotifications->save();

                            }
                        }


                        /* School Role  = 3 */
                        $UsersRoles = User::where('role', 3)->get()->toArray();
                        if (!empty($UsersRoles)) {
                            foreach ($UsersRoles as $UsersRole) {

                                $UsersRoleSchoolID = $UsersRole['school_id'];

                                $schoolIDsArray = json_decode($UsersRoleSchoolID, true);

                                // echo "UsersRoleSchoolID ".$UsersRoleSchoolID;echo "<BR>";
                                // echo " <pre>".print_r($schoolIDsArray);echo "<BR>";


                                $schoolIDToCheck = $StudentBiodataDesignation->School_Name;

                                if (in_array($schoolIDToCheck, $schoolIDsArray)) {

                                    $MedicalNotifications = new MedicalNotifications;
                                    $MedicalNotifications->created_by = $UsersRole['id'];
                                    $MedicalNotifications->updated_by = $UsersRole['id'];

                                    $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                                    $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                                    $MedicalNotifications->redirect_link = $StudentBiodataId;
                                    $MedicalNotifications->save();


                                }

                            }
                        }






                    }



                    // $MedicalNotifications = new MedicalNotifications;
                    // $MedicalNotifications->created_by = $userID;
                    // $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                    // $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                    // $MedicalNotifications->redirect_link = $StudentBiodataId;
                    // $MedicalNotifications->save();


                }





            } else {

                /* 1=event_type */
                CalendarEvents::where('event_type', 1)->where('event_id', $StudentBiodataId)->update(['deleted' => 1]);

                $SchoolHealthPhysician->updated_by = $userID;

                if ($Follow_up_Required == "Yes" && !empty($Follow_up_Date)) {


                    $StudentBiodataDesignation = StudentBiodata::where('id', $StudentBiodataId)->first();
                    if (!empty($StudentBiodataDesignation)) {
                        $UsersDesignations = User::where('role', '!=', 3)->where('designation', $StudentBiodataDesignation->designation)->get()->toArray();
                        if (!empty($UsersDesignations)) {
                            foreach ($UsersDesignations as $UsersDesignation) {


                                $MedicalNotifications = new MedicalNotifications;
                                $MedicalNotifications->created_by = $UsersDesignation['id'];
                                $MedicalNotifications->updated_by = $UsersDesignation['id'];

                                $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                                $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                                $MedicalNotifications->redirect_link = $StudentBiodataId;
                                $MedicalNotifications->save();

                            }
                        }


                        /* School Role  = 3 */

                        $UsersRoles = User::where('role', 3)->get()->toArray();
                        if (!empty($UsersRoles)) {
                            foreach ($UsersRoles as $UsersRole) {

                                $UsersRoleSchoolID = $UsersRole['school_id'];

                                $schoolIDsArray = json_decode($UsersRoleSchoolID, true);

                                // echo "UsersRoleSchoolID ".$UsersRoleSchoolID;echo "<BR>";
                                // echo " <pre>".print_r($schoolIDsArray);echo "<BR>";


                                $schoolIDToCheck = $StudentBiodataDesignation->School_Name;

                                if (in_array($schoolIDToCheck, $schoolIDsArray)) {

                                    $MedicalNotifications = new MedicalNotifications;
                                    $MedicalNotifications->created_by = $UsersRole['id'];
                                    $MedicalNotifications->updated_by = $UsersRole['id'];

                                    $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                                    $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                                    $MedicalNotifications->redirect_link = $StudentBiodataId;
                                    $MedicalNotifications->save();


                                }

                            }
                        }


                    }



                    // $MedicalNotifications = new MedicalNotifications;
                    // $MedicalNotifications->updated_by = $userID;
                    // $MedicalNotifications->read_status = 1; /* 0=Read, 1=UnRead*/
                    // $MedicalNotifications->notification_type = 0; /* 0=Medical History Notifications */
                    // $MedicalNotifications->redirect_link = $StudentBiodataId;
                    // $MedicalNotifications->save();



                }



            }



            /*
            
            0= if Follow-up Required yes and Follow-up Date blank,
            1= if Follow-up Required yes and Follow-up Date not blank,
            2=if Follow-up Required no 

            */


            if ($Follow_up_Required == "Yes" && empty($Follow_up_Date)) {

                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Date_flag' => 0));

            } else if ($Follow_up_Required == "Yes" && !empty($Follow_up_Date)) {

                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Date_flag' => 1));

            } else if ($Follow_up_Required == "No") {
                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Date_flag' => 2));

            } else {
                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Date_flag' => 2));

            }






            $SchoolHealthPhysician->StudentBiodataId = $StudentBiodataId;
            $SchoolHealthPhysician->Chief_Complaints1 = $Chief_Complaints1;
            $SchoolHealthPhysician->History_of_Presenting_Complaints1 = $History_of_Presenting_Complaints1;
            $SchoolHealthPhysician->Review_of_Systems = $Review_of_Systems;
            $SchoolHealthPhysician->General = $General;
            $SchoolHealthPhysician->Eyes = $Eyes;
            $SchoolHealthPhysician->Ears_Nose_and_Throat = $Ears_Nose_and_Throat;
            $SchoolHealthPhysician->Teeth = $Teeth;
            $SchoolHealthPhysician->Cardiorespiratory = $Cardiorespiratory;
            $SchoolHealthPhysician->Gastrointestinal = $Gastrointestinal;
            $SchoolHealthPhysician->Genitourinary = $Genitourinary;
            $SchoolHealthPhysician->Neuromuscular = $Neuromuscular;
            $SchoolHealthPhysician->Endocrine = $Endocrine;
            $SchoolHealthPhysician->Hematologic = $Hematologic;
            $SchoolHealthPhysician->Rheumatologic = $Rheumatologic;
            $SchoolHealthPhysician->Skin = $Skin;
            $SchoolHealthPhysician->Investigations_Laboratory_Test_Reports1 = $Investigations_Laboratory_Test_Reports1;
            $SchoolHealthPhysician->Medication_History = $Medication_History;
            $SchoolHealthPhysician->Allergies = $Allergies;
            $SchoolHealthPhysician->Past_Medical_History = $Past_Medical_History;
            $SchoolHealthPhysician->Past_Surgical_History = $Past_Surgical_History;
            $SchoolHealthPhysician->Birth_History = $Birth_History;
            $SchoolHealthPhysician->Immunizatio_History = $Immunizatio_History;
            $SchoolHealthPhysician->Growth_Development_Puberty_changes = $Growth_Development_Puberty_changes;
            $SchoolHealthPhysician->Nutrition_History = $Nutrition_History;
            $SchoolHealthPhysician->Family_History1 = $Family_History1;
            $SchoolHealthPhysician->Personal_Social_History1 = $Personal_Social_History1;
            $SchoolHealthPhysician->Blood_pressure = $Blood_pressure;

            $Blood_pressure_result = (isset($DataArr['Blood_pressure_result']) && !empty($DataArr['Blood_pressure_result'])) ? trim($DataArr['Blood_pressure_result']) : null;
            $SchoolHealthPhysician->Blood_pressure_result = $Blood_pressure_result;

            $BMIResult = (isset($DataArr['BMIResult']) && !empty($DataArr['BMIResult'])) ? trim($DataArr['BMIResult']) : null;
            $SchoolHealthPhysician->BMIResult = $BMIResult;

            $WeightResult = (isset($DataArr['WeightResult']) && !empty($DataArr['WeightResult'])) ? trim($DataArr['WeightResult']) : null;
            $SchoolHealthPhysician->WeightResult = $WeightResult;

            $HeightResult = (isset($DataArr['HeightResult']) && !empty($DataArr['HeightResult'])) ? trim($DataArr['HeightResult']) : null;
            $SchoolHealthPhysician->HeightResult = $HeightResult;

            $BloodPressureDiastolicResult = (isset($DataArr['BloodPressureDiastolicResult']) && !empty($DataArr['BloodPressureDiastolicResult'])) ? trim($DataArr['BloodPressureDiastolicResult']) : null;
            $SchoolHealthPhysician->BloodPressureDiastolicResult = $BloodPressureDiastolicResult;

            $SchoolHealthPhysician->WeightResult = (isset($DataArr['WeightResult']) && !empty($DataArr['WeightResult'])) ? trim($DataArr['WeightResult']) : null;
            $SchoolHealthPhysician->HeightResult = (isset($DataArr['HeightResult']) && !empty($DataArr['HeightResult'])) ? trim($DataArr['HeightResult']) : null;
            $SchoolHealthPhysician->BMIResult = (isset($DataArr['BMIResult']) && !empty($DataArr['BMIResult'])) ? trim($DataArr['BMIResult']) : null;

            $TemperatureResult = (isset($DataArr['TemperatureResult']) && !empty($DataArr['TemperatureResult'])) ? trim($DataArr['TemperatureResult']) : null;
            $SchoolHealthPhysician->TemperatureResult = $TemperatureResult;
            $SchoolHealthPhysician->PulseResult = (isset($DataArr['PulseResult']) && !empty($DataArr['PulseResult'])) ? trim($DataArr['PulseResult']) : null;
            $SchoolHealthPhysician->RespiratoryRateResult = (isset($DataArr['RespiratoryRateResult']) && !empty($DataArr['RespiratoryRateResult'])) ? trim($DataArr['RespiratoryRateResult']) : null;



            // $SchoolHealthPhysician->BloodPressureSystolic = $BloodPressureSystolic;
            $SchoolHealthPhysician->BloodPressureDiastolic = $BloodPressureDiastolic;
            $SchoolHealthPhysician->Temperature = $Temperature;
            $SchoolHealthPhysician->Pulse_rate = $Pulse_rate;
            $SchoolHealthPhysician->Respiratory_Rate = $Respiratory_Rate;
            $SchoolHealthPhysician->Weight = $Weight;
            $SchoolHealthPhysician->Height = $Height;
            $SchoolHealthPhysician->BMI = $BMI;
            $SchoolHealthPhysician->General_Appearance = $General_Appearance;
            $SchoolHealthPhysician->Lymph_Nodes = $Lymph_Nodes;
            $SchoolHealthPhysician->Head = $Head;
            $SchoolHealthPhysician->ENT = $ENT;
            $SchoolHealthPhysician->Chest = $Chest;
            $SchoolHealthPhysician->Heart = $Heart;
            $SchoolHealthPhysician->Abdomen = $Abdomen;
            $SchoolHealthPhysician->Extremities = $Extremities;
            $SchoolHealthPhysician->Neurologic_Examination = $Neurologic_Examination;
            $SchoolHealthPhysician->Problem_List = $Problem_List;
            $SchoolHealthPhysician->Impression = $Impression;
            $SchoolHealthPhysician->Investigations_Recommended = $Investigations_Recommended;
            $SchoolHealthPhysician->Provisional_Diagnosis = implode('|', $Provisional_Diagnosis);


            $SchoolHealthPhysician->General_Advice = $General_Advice;
            $SchoolHealthPhysician->First_Aid_Given = $First_Aid_Given;
            $SchoolHealthPhysician->Follow_up_Required = $Follow_up_Required;
            $SchoolHealthPhysician->Reason_for_Follow_up = $Reason_for_Follow_up;
            $SchoolHealthPhysician->Follow_up_Date = $Follow_up_Date;

            $SchoolHealthPhysician->internal_referrals = implode('|', $internal_referrals);
            $SchoolHealthPhysician->external_referrals = implode('|', $external_referrals);


            $SchoolHealthPhysician->Reason_for_Referral = $Reason_for_Referral;



            $SchoolHealthPhysician->save();


            /* 
            DB Comment
            3=PsychologistHistoryAssessmentSection,
            1=SchoolHealthPhysician,
            NutritionistHistoryEvaluationSection=2
            */
            StudentBiodata::where('id', $StudentBiodataId)->update(array('MedicalHistoryType' => 1));

            if ($Follow_up_Required == "Yes") {

                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Required' => 1));



                $eventDescription = "";
                if ($Blood_pressure_result == 'Low') {
                    $eventDescription = "Blood Pressure (Systolic) Low";
                }
                if ($BloodPressureDiastolicResult == 'Low') {
                    $eventDescription .= "<br> Blood Pressure (Diastolic) Low";
                }
                if ($TemperatureResult == 'Low') {
                    $eventDescription .= "<br> Temperature Low";
                }
                if ($BMIResult == 'Low') {
                    $eventDescription .= "<br> BMI Low";
                }
                if ($WeightResult == 'Low') {
                    $eventDescription .= "<br> Weight Low";
                }
                if ($HeightResult == 'Low') {
                    $eventDescription .= "<br> Height Low";
                }

                $CalendarEvents = new CalendarEvents();
                $CalendarEvents->title = 'School Health Physician';
                $CalendarEvents->slug = Str::slug($Chief_Complaints1, '-');
                $CalendarEvents->startDate = $Follow_up_Date;
                $CalendarEvents->endDate = $Follow_up_Date;
                $CalendarEvents->color = 'blue';
                $CalendarEvents->created_by = Auth::user()->id;

                $CalendarEvents->description = $eventDescription;

                $CalendarEvents->event_id = $StudentBiodataId;
                $CalendarEvents->event_type = 1;
                $CalendarEvents->redirect_link = Route('SchoolHealthPhysician') . '/' . trim($StudentBiodataId);
                $CalendarEvents->save();



            } else {

                StudentBiodata::where('id', $StudentBiodataId)->update(array('Follow_up_Required' => 0));

            }

            DB::commit();


            return redirect()->route('IndexMedicalHistory');



        }


        $StudentBiodata = StudentBiodata::where('id', $StudentBiodataId)->where('deleted', 0)->first();
        if (empty($StudentBiodata)) {

            $message = "Record not exist";
            Session::flash("error_message", $message);

            return redirect()->route('IndexMedicalHistory');
        }


        $SchoolHealthPhysician = SchoolHealthPhysician::where('deleted', 0)->where('StudentBiodataId', $StudentBiodataId)->first();
        $NutritionistHistoryEvaluationSection = NutritionistHistoryEvaluationSection::where('deleted', 0)->where('StudentBiodataId', $StudentBiodataId)->first();
        $PsychologistHistoryAssessmentSection = PsychologistHistoryAssessmentSection::where('deleted', 0)->where('StudentBiodataId', $StudentBiodataId)->first();


        $current = Carbon::now();
        $age = Carbon::parse($StudentBiodata->dob);

        $dob = Carbon::parse($StudentBiodata->dob);

        $yearsDifference = $dob->diffInYears($current);

        $monthsDifference = $age->diffInMonths($current);


        $ICD10 = DB::table('ICD10');
        $ICD10 = $ICD10->get()->toArray();
        $ICD10 = json_decode(json_encode($ICD10), true);


        $ExternalReferralList = DB::table('ExternalReferralList');
        $ExternalReferralList = $ExternalReferralList->get()->toArray();

        $ExternalReferralList = json_decode(json_encode($ExternalReferralList), true);


        return view('admin.MedicalHistory.SchoolHealthPhysician')->with(compact('ExternalReferralList', 'ICD10', 'monthsDifference', 'NutritionistHistoryEvaluationSection', 'StudentBiodataId', 'SchoolHealthPhysician', 'PsychologistHistoryAssessmentSection', 'StudentBiodata'));

    }


    public function List1(Request $request)
    {
        $UserID = auth()->guard('admin')->user()->id;
        $UserRole = auth()->guard('admin')->user()->role;

        $data = StudentBiodata::select(
            'student_biodata.id as student_bio_data_id',
            'student_biodata.*'
        )
            ->leftJoin('school_health_physicians as shp', function ($join) {
                $join->on('student_biodata.id', '=', 'shp.StudentBiodataId')
                    ->where('shp.deleted', 0);
            })
            ->leftJoin('nutritionist_history_evaluation_sections as nhes', function ($join) {
                $join->on('student_biodata.id', '=', 'nhes.StudentBiodataId')
                    ->where('nhes.deleted', 0);
            })
            ->leftJoin('psychologist_history_assessment_sections as phas', function ($join) {
                $join->on('student_biodata.id', '=', 'phas.StudentBiodataId')
                    ->where('phas.deleted', 0);
            })
            ->where('student_biodata.deleted', 0);

        if ($UserRole == 2) {
            $data = $data->where(function ($query) use ($UserID) {
                $query->where('created_by', $UserID)->orWhere('updated_by', $UserID);
            });
        }

        if ($request->has('schoolId')) {
            $schoolId = $request->input('schoolId');
            $data = $data->where('student_biodata.School_Name', $schoolId); // Adjust this to match your actual field name
        }

        if ($request->has('MedicalHistoryType')) {
            $MedicalHistoryType = $request->input('MedicalHistoryType');
            $data = $data->where('student_biodata.MedicalHistoryType', $MedicalHistoryType); // Adjust this to match your actual field name
        }

        if ($request->has('Blood_pressure_result')) {
            $Blood_pressure_result = $request->input('Blood_pressure_result');
            $data = $data->where('shp.Blood_pressure_result', $Blood_pressure_result);
        }

        if ($request->has('BloodPressureDiastolicResult')) {
            $BloodPressureDiastolicResult = $request->input('BloodPressureDiastolicResult');
            $data = $data->where('shp.BloodPressureDiastolicResult', $BloodPressureDiastolicResult);
        }

        if ($request->has('TemperatureResult')) {
            $TemperatureResult = $request->input('TemperatureResult');
            $data = $data->where('shp.TemperatureResult', $TemperatureResult);
        }

        $data = $data->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d/m/Y');
            })
            ->addColumn('School_Name', function ($row) {
                $School_ID = $row->School_Name;
                $School_Name = "N/A";
                $school = School::find($School_ID);
                if ($school) {
                    $School_Name = $school->school_name;
                }
                return $School_Name;
            })
            ->addColumn('action', function ($row) {
                $btn = ' &nbsp; <a href="' . route('ViewMedicalHistory1', $row->student_bio_data_id) . '" title="View"><i class="fa fa-eye iic"></i></a>';
                $btn .= ' &nbsp; <a href="' . route('StudentBiodata', $row->student_bio_data_id) . '" title="Edit"><i class="fa fa-edit iic"></i></a>';
                $btn .= ' &nbsp; <a title="Delete" href="javascript:void(0)" class="confirmDeleteIt" data-id="' . $row->id . '" data-url="' . route('DeleteMedicalHistory') . '"> <i class="fa fa-close iic"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    /*FollowUpList*/
    public function FollowUpList(Request $request)
    {


        $data = StudentBiodata::orderBy('id', 'desc')->where('deleted', 0);

        $data = $data->where('Follow_up_Required', 1);
        $data = $data->get()->toArray();

        return Datatables::of($data)
            ->addIndexColumn()

            ->addColumn('created_at', function ($row) {

                $createed_at = date('M-d-Y', strtotime($row['created_at']));

                return $createed_at;
            })
            ->addColumn('action', function ($row) {
                $btn = "";

                // $btn .= ' &nbsp; <a href="' . Route('ViewMedicalHistory') . '/' . $row['id'] . '" title="Edit"><i class="fa fa-eye iic text-light"></i></a>';
                $btn .= ' &nbsp; <a href="' . Route('ViewMedicalHistory1') . '/' . $row['id'] . '" title="View"><i class="fa fa-eye iic text-light"></i></a>';
                // $btn .= ' &nbsp; <a href="' . Route('UpdateMedicalHistory') . '/' . $row['id'] . '" title="Edit"><i class="fa fa-edit iic text-light"></i></a>';
                $btn .= ' &nbsp; <a href="' . Route('StudentBiodata') . '/' . $row['id'] . '" title="Edit"><i class="fa fa-edit iic text-light"></i></a>';
                // $btn .= ' &nbsp; <a href="' . Route('medicalhistorydata') . '/' . $row['id'] . '" title="Edit"><i class="fa fa-edit iic text-light"></i></a>';
    
                $btn .= ' &nbsp;<a title="Delete" href="javascript:void(0)" class="confirmDeleteIt"  data-id="' . $row['id'] . '" data-url="' . Route('DeleteMedicalHistory') . '"> <i class="fa fa-close iic text-light"></i></a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }


    public function ViewMedicalHistory(Request $request, $UpdateId = null)
    {

        $MainComplaint = array();
        $GeneralInfo = array();
        $SecondaryComplain = array();
        $RecentChangesOrConcern = array();
        $VitalSign = array();
        $FeverHistory = array();
        $Headache = array();
        $SkinDisease = array();
        $Meningitis = array();
        $AbdominalPainHistory = array();
        $PersonalHistory = array();
        $NutritionHistory = array();
        $ChestPain = array();
        $RespiratorySystem = array();
        $UpperResp = array();
        $Cough = array();
        $Sob = array();
        $HistoryOfPneumonia = array();
        $LowerRespiratoryTractInfections = array();
        $LowerRespiratorySob = array();
        $HistoryOfInfection = array();
        $ChiefComplaint = array();
        $previousMenstruationTreatmentOrInterventions = array();
        $PastMedicalConditions = array();
        $Allergies = array();

        $GeneralInfo = GeneralInfo::find($UpdateId);
        $MainComplaint = MainComplaint::where('GnInfoId', $UpdateId)->first();
        $SecondaryComplain = SecondaryComplain::where('GnInfoId', $UpdateId)->first();
        $RecentChangesOrConcern = RecentChangesOrConcern::where('GnInfoId', $UpdateId)->first();
        $VitalSign = VitalSign::where('GnInfoId', $UpdateId)->first();
        $FeverHistory = FeverHistory::where('GnInfoId', $UpdateId)->first();
        $Meningitis = Meningitis::where('GnInfoId', $UpdateId)->first();
        $AbdominalPainHistory = AbdominalPainHistory::where('GnInfoId', $UpdateId)->first();
        $PersonalHistory = PersonalHistory::where('GnInfoId', $UpdateId)->first();
        $SleepRoutine = SleepRoutine::where('GnInfoId', $UpdateId)->first();
        $NutritionHistory = NutritionHistory::where('GnInfoId', $UpdateId)->first();
        $ChestPain = ChestPain::where('GnInfoId', $UpdateId)->first();
        $RespiratorySystem = RespiratorySystem::where('GnInfoId', $UpdateId)->first();
        $Sob = Sob::where('GnInfoId', $UpdateId)->first();
        $UpperResp = UpperResp::where('GnInfoId', $UpdateId)->first();
        $Cough = Cough::where('GnInfoId', $UpdateId)->first();
        $HistoryOfPneumonia = HistoryOfPneumonia::where('GnInfoId', $UpdateId)->first();
        $LowerRespiratoryTractInfections = LowerRespiratoryTractInfections::where('GnInfoId', $UpdateId)->first();
        $LowerRespiratorySob = LowerRespiratorySob::where('GnInfoId', $UpdateId)->first();
        $HistoryOfInfection = HistoryOfInfection::where('GnInfoId', $UpdateId)->first();
        $Headache = Headache::where('GnInfoId', $UpdateId)->first();
        $SkinDisease = SkinDisease::where('GnInfoId', $UpdateId)->first();
        $ChiefComplaint = ChiefComplaint::where('GnInfoId', $UpdateId)->first();
        $previousMenstruationTreatmentOrInterventions = previousMenstruationTreatmentOrInterventions::where('GnInfoId', $UpdateId)->first();
        $PastMedicalConditions = PastMedicalConditions::where('GnInfoId', $UpdateId)->first();
        $Allergies = Allergies::where('GnInfoId', $UpdateId)->first();
        $Socioeconomic = Socioeconomic::where('GnInfoId', $UpdateId)->first();

        // return view('admin.medical_history')->with(compact('GeneralInfo'));
        return view('admin.MedicalHistory.View')->with(get_defined_vars());


    }

    public function Delete(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {

            $dataArr = $request->all();



            $userID = Auth::guard(config('constants.ADMIN_GUARD'))->check() ? Auth::guard(config('constants.ADMIN_GUARD'))->user()->id : Auth::guard(config('constants.STUDENT_GUARD'))->user()->id;

            $UpdateId = $dataArr['deleteId'];

            // $returnAffected = LogActivityModel::where('id', $dataArr['deleteId'])->update(array('deleted' => 1, 'updated_by' => $userID));
            /* $returnAffected = GeneralInfo::where('id', $dataArr['deleteId'])->delete();

             $MainComplaint = MainComplaint::where('GnInfoId', $UpdateId)->delete();
             $SecondaryComplain = SecondaryComplain::where('GnInfoId', $UpdateId)->delete();
             $RecentChangesOrConcern = RecentChangesOrConcern::where('GnInfoId', $UpdateId)->delete();
             $VitalSign = VitalSign::where('GnInfoId', $UpdateId)->delete();
             $FeverHistory = FeverHistory::where('GnInfoId', $UpdateId)->delete();
             $Meningitis = Meningitis::where('GnInfoId', $UpdateId)->delete();
             $AbdominalPainHistory = AbdominalPainHistory::where('GnInfoId', $UpdateId)->delete();
             $PersonalHistory = PersonalHistory::where('GnInfoId', $UpdateId)->delete();
             $SleepRoutine = SleepRoutine::where('GnInfoId', $UpdateId)->delete();
             $NutritionHistory = NutritionHistory::where('GnInfoId', $UpdateId)->delete();
             $ChestPain = ChestPain::where('GnInfoId', $UpdateId)->delete();
             $RespiratorySystem = RespiratorySystem::where('GnInfoId', $UpdateId)->delete();
             $Sob = Sob::where('GnInfoId', $UpdateId)->delete();
             $UpperResp = UpperResp::where('GnInfoId', $UpdateId)->delete();
             $Cough = Cough::where('GnInfoId', $UpdateId)->delete();
             $HistoryOfPneumonia = HistoryOfPneumonia::where('GnInfoId', $UpdateId)->delete();
             $LowerRespiratoryTractInfections = LowerRespiratoryTractInfections::where('GnInfoId', $UpdateId)->delete();
             $LowerRespiratorySob = LowerRespiratorySob::where('GnInfoId', $UpdateId)->delete();
             $HistoryOfInfection = HistoryOfInfection::where('GnInfoId', $UpdateId)->delete();
             $Headache = Headache::where('GnInfoId', $UpdateId)->delete();
             $SkinDisease = SkinDisease::where('GnInfoId', $UpdateId)->delete();
             $ChiefComplaint = ChiefComplaint::where('GnInfoId', $UpdateId)->delete();
             $previousMenstruationTreatmentOrInterventions = previousMenstruationTreatmentOrInterventions::where('GnInfoId', $UpdateId)->delete();
             $PastMedicalConditions = PastMedicalConditions::where('GnInfoId', $UpdateId)->delete();
             $Allergies = Allergies::where('GnInfoId', $UpdateId)->delete();
             $Socioeconomic = Socioeconomic::where('GnInfoId', $UpdateId)->delete();*/

            // $returnAffected = StudentBiodata::where('GRNo', $UpdateId)->update(array('deleted'=>1));

            $returnAffected = StudentBiodata::where('id', $UpdateId)->update(['deleted' => 1]);

            if ($returnAffected === 0) {
                $message = "Some Issue Occurs try later";
                return response()->json(
                    array(
                        'status' => false,
                        'message' => $message,
                        'deleteId' => $UpdateId,
                    )
                );
            }



            /* 1=event_type */
            CalendarEvents::where('event_type', 1)->where('event_id', $UpdateId)->update(['deleted' => 1]);



            /* 0=Medical History Notifications */
            MedicalNotifications::where('notification_type', 0)->where('redirect_link', $UpdateId)->update(['deleted' => 1]);


            $message = "Deleted successfully";

            return response()->json(
                array(
                    'status' => true,
                    'message' => $message,
                    'returnAffected' => $returnAffected,
                )
            );

        } else {
            $message = "Some Issue Occurs try later";
            return response()->json(
                array(
                    'status' => false,
                    'message' => $message,
                )
            );
        }



    }

}
