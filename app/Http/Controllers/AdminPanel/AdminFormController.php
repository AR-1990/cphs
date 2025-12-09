<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Forms;
use App\Models\User;
use App\Models\School;
use App\Models\Area;
use App\Models\City;
use App\Models\medicalComplain;
use Illuminate\Support\Facades\Auth;

use App\Models\form_entry;
use App\Models\FormData;
use Illuminate\Http\Request;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use Illuminate\Support\Facades\Validator;
use Session;

use App\Models\StudentBiodata;
use App\Models\SchoolHealthPhysician;
use App\Models\CalendarEvents;
use App\Models\NutritionistHistoryEvaluationSection;
use App\Models\PsychologistHistoryAssessmentSection;
use App\Models\HeightForAge;
use App\Models\Prescription;
use App\Models\Aids;
use App\Models\Labs;
use DataTables;
use Illuminate\Support\Facades\Storage; // Make sure this line is present
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;

use Str;


class AdminFormController extends Controller
{


    // YourController.php
    public function checkGrNumber(Request $request)
    {
        $grNumber = $request->input('gr_number');
        $school = $request->input('school');
        $name = $request->input('name');

        // dd( $request->all());

        // Perform the check in your database
        $exists = DB::table('form_entries')
            ->where('grno', $grNumber)
            ->where('school', $school)
            ->where('name', $name)
            ->exists();

        return response()->json(['exists' => $exists]);
    }



    /* Labs*/
    public function Labs(Request $request)
    {
        // Validate the request
        $request->validate([
            'form_entry_id' => 'required',
            'title' => 'required|string|max:255',

            'files.*' => 'mimes:xlsx,csv,doc,docx,txt,pdf,jpg,png|max:20480', // Adjust file types and size as needed
        ]);

        // Handle file uploads
        $filePaths = [];
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                // Generate a unique filename
                $extension = $file->getClientOriginalExtension();
                $fileName = 'lab-report-' . time() . '-' . rand(111, 99999) . '.' . $extension;

                // Define the path for the files
                $path = public_path('uploads/labs/reports');

                // Create the directory if it does not exist
                if (!File::isDirectory($path)) {
                    File::makeDirectory($path, 0777, true, true);
                }

                // Move the file to the destination path
                $destinationPath = public_path('uploads/labs/reports');
                $file->move($destinationPath, $fileName);

                // Store the file path
                // $filePaths[] = 'uploads/labs/reports/' . $fileName;
                $filePaths[] = $fileName;
            }
        }

        // Concatenate file names with | as separator
        $fileNamesString = implode('|', $filePaths);


        // Create a new lab record
        $lab = new Labs();
        $lab->form_entry_id = $request->input('form_entry_id');
        $lab->title = $request->input('title'); // Store title

        $lab->document_names = $fileNamesString; // Store file names as a pipe-separated string
        $lab->status = 1; // Default status
        $lab->created_by = auth()->id(); // Assuming you have user authentication
        $lab->updated_by = auth()->id();
        $lab->deleted = 0; // Default value
        $lab->save();

        return redirect()->back()->with('success_message', 'Files uploaded successfully.');
    }



    /* Prescription*/
    public function Prescription(Request $request)
    {

        // dd($request->all());

        // Validate the request data
        $request->validate([
            'DoctorID' => 'required|string',
            'Reason' => 'required|string',
            'Prescription' => 'required|string',
        ]);



        // Create a new record
        $record = Prescription::create([
            'DoctorID' => $request->input('DoctorID'),
            'Reason' => $request->input('Reason'),
            'Prescription' => $request->input('Prescription'),
            'form_entry_id' => $request->input('form_entry_id'),
            'status' => 1, // Set default status or any logic you have
            'created_by' => auth()->id(), // Set created_by to the authenticated user ID
            'updated_by' => auth()->id(), // Set updated_by to the authenticated user ID
            'deleted' => 0, // Default value for deleted field
        ]);


        // Redirect or return a response
        return redirect()->back()->with('success_message', 'Form submitted successfully!');
    }


    /* Aids*/
    public function Aids(Request $request)
    {

        // dd($request->all());

        // Validate the request data
        $request->validate([
            'DoctorID' => 'required|string',
            'Reason' => 'required|string',
            'Aids' => 'required|string',
        ]);




        // Create a new record
        $record = Aids::create([
            'DoctorID' => $request->input('DoctorID'),
            'Reason' => $request->input('Reason'),
            'Aids' => $request->input('Aids'),
            'form_entry_id' => $request->input('form_entry_id'),
            'status' => 1, // Set default status or any logic you have
            'created_by' => auth()->id(), // Set created_by to the authenticated user ID
            'updated_by' => auth()->id(), // Set updated_by to the authenticated user ID
            'deleted' => 0, // Default value for deleted field
        ]);


        // Redirect or return a response
        return redirect()->back()->with('success_message', 'Form submitted successfully!');
    }


    /* GeneralInfo */
    public function GeneralInfo(Request $request, $id = null)
    {


        if ($request->ajax()) {

            $DataArr = $request->all();

            $UserID = auth()->guard('admin')->user()->id;
            $UserRole = auth()->guard('admin')->user()->role;

            $dataDetails = form_entry::where('id', $DataArr['id'])->first();
            if (!empty($DataArr)) {
                $scan_count = $dataDetails['scan_count'];

                $scan_count = $scan_count + 1;

                $dataDetails->scan_count = $scan_count;
                $dataDetails->save();

            }


            return response()->json([
                'status' => 'success',
                'data' => $DataArr,
            ]);
        }


        $data = DB::table('form_data')
            ->where('entry_id', $id)
            ->pluck('value', 'key')
            ->all();

        if (empty($data)) {
            $message = "This record not exist";
            Session::flash("error_message", $message);
            return redirect()->route('admin.form_entry.index');
        }


        $columns = [];
        foreach ($data as $key => $value) {
            $columns[$key] = $value;
        }
        $resultArray = [$columns];

        $profile_image = "default.png";
        $profile_image_arr = form_entry::where('id', $id)->first();
        if (!empty($profile_image_arr)) {
            $profile_image = $profile_image_arr['profile_image'];
            $DoctorID = $profile_image_arr['DoctorID'];
            $Reason = $profile_image_arr['Reason'];
            // $Prescription = $profile_image_arr['Prescription'];

        }

        $data['details'] = [
            "id" => $id,
            "name" => $resultArray[0]['name'] ?? null,
            "DoctorID" => $DoctorID ?? null,
            "Reason" => $Reason ?? null,
            // "Prescription" => $Prescription ?? null,
            "profile_image" => $profile_image,
            "guardianname" => $resultArray[0]['guardianname'] ?? null,
            "gender" => $resultArray[0]['gender'] ?? null,
            "school" => $resultArray[0]['school'] ?? null,
            "city" => $resultArray[0]['city'] ?? null,
            "class" => $resultArray[0]['class'] ?? null,
            "area" => $resultArray[0]['area'] ?? null,
            "dob" => $resultArray[0]['dob'] ?? null,
            "age" => $resultArray[0]['read_oly_age'] ?? null,
            "emergency_contact_number" => $resultArray[0]['Emergency_Contact_Number'] ?? null,
            "gr_number" => $resultArray[0]['Gr_Number'] ?? null,
            "any_known_medical_condition" => $resultArray[0]['Any_Known_Medical_Condition'] ?? null,
            "address" => $resultArray[0]['Address'] ?? $resultArray[0]['address'] ?? '-',
            "blood_group" => $resultArray[0]['Blood_group'] ?? '-',
            "bio_data_comment" => $resultArray[0]['bio_data_comment'] ?? null,
            "question_no_1_height" => $resultArray[0]['Question_No_1_Height'] ?? null,
            "question_no_2_weight" => $resultArray[0]['Question_No_2_Weight'] ?? null,
            "question_no_3_bmi" => $resultArray[0]['Question_No_3_BMI'] ?? null,
            "question_no_4_body_temperature" => $resultArray[0]['Question_No_4_Body_Temperature'] ?? null,
            "bodytempunit" => $resultArray[0]['Bodytempunit'] ?? 'f',
            "question_no_5_blood_pressure_systolic" => $resultArray[0]['Question_No_5_Blood_Pressure_Systolic'] ?? $resultArray[0]['Question_No_6_Blood_Pressure_Systolic'] ?? $resultArray[0]['Question_No_6_Blood_Pressure'] ?? null,
            "question_no_6_blood_pressure_diastolic" => $resultArray[0]['Question_No_6_Blood_Pressure_Diastolic'] ?? $resultArray[0]['Question_No_7_Blood_Pressure_Diacystolic'] ?? null,
            "question_no_7_pulse" => $resultArray[0]['Question_No_7_Pulse'] ?? $resultArray[0]['Question_No_5_Pulse'] ?? null,
            "vitals_bmi_comment" => $resultArray[0]['vitals_bmi_comment'] ?? null,
            "question_no_8_normal_posture_gait" => $resultArray[0]['Question_No_8_Normal_Posture/Gait'] ?? $resultArray[0]['Question_No_7_Normal_Posture/Gait'] ?? null,
            "question_no_9_mental_status" => $resultArray[0]['Question_No_9_Mental_Status'] ?? $resultArray[0]['Question_No_8_Mental_Status'] ?? null,
            "question_no_10_look_for_jaundice" => $resultArray[0]['Question_No_10_Look_For_jaundice'] ?? $resultArray[0]['Question_No_9_Look_For_jaundice'] ?? null,
            "question_no_11_look_for_anemia" => $resultArray[0]['Question_No_11_Look_For_anemia'] ?? $resultArray[0]['Question_No_10_Look_For_anemia'] ?? null,
            "question_no_12_look_for_clubbing" => $resultArray[0]['Question_No_12_Look_For_Clubbing'] ?? $resultArray[0]['Question_No_11_Look_For_Clubbing'] ?? null,
            "question_no_13_look_for_cyanosis" => $resultArray[0]['Question_No_13_Look_for_Cyanosis'] ?? $resultArray[0]['Question_No_12_Look_for_Cyanosis'] ?? null,
            "question_no_14_skin" => $resultArray[0]['Question_No_14_Skin'] ?? $resultArray[0]['Question_No_13_Skin'] ?? null,
            "question_no_15_breath" => $resultArray[0]['Question_No_15_Breath'] ?? $resultArray[0]['Question_No_14_Breath'] ?? null,
            "general_apperance_comment" => $resultArray[0]['general_apperance_comment'] ?? null,
            "question_no_16_nails" => $resultArray[0]['Question_No_16_Nails'] ?? $resultArray[0]['Question_No_15_Nails'] ?? null,
            "question_no_18_lice_nits" => $resultArray[0]['Question_No_18_Lice/nits'] ?? $resultArray[0]['Question_No_17_Lice/nits'] ?? null,
            "inspect_hygiene_comment" => $resultArray[0]['inspect_hygiene_comment'] ?? null,
            "question_no_20_hair_and_scalp" => $resultArray[0]['Question_No_20_Hair_and_Scalp'] ?? $resultArray[0]['Question_No_19_Hair_and_Scalp'] ?? null,
            "question_no_21_any_hair_problem" => $resultArray[0]['Question_No_21_Any_Hair_Problem'] ?? null,
            "question_no_22_sclap" => $resultArray[0]['Question_No_22_Sclap'] ?? null,
            "question_no_23_hair_distribution" => $resultArray[0]['Question_No_23_Hair_distribution'] ?? $resultArray[0]['Question_No_20_Hair_distribution'] ?? null,
            "head_and_neck_examination_comment" => $resultArray[0]['head_and_neck_examination_comment'] ?? null,
            // "question_no_24_visual_acuity_using_snellens_chart" => $resultArray[0]['Question_No_24_Visual_acuity_using_Snellen’s_chart'] ?? $resultArray[0]['Question_No_21_Visual_acuity_using_Snellen’s_chart'] ?? null,
            "question_no_25_normal_ocular_alignment" => $resultArray[0]['Question_No_25_Normal_ocular_alignment'] ?? $resultArray[0]['Question_No_22_Normal_ocular_alignment'] ?? null,
            "question_no_26_normal_eye_inspection" => $resultArray[0]['Question_No_26_Normal_eye_inspection'] ?? $resultArray[0]['Question_No_23_Normal_eye_inspection'] ?? null,
            // "question_no_27_normal_color_vision" => $resultArray[0]['Question_No_27_Normal_Color_vision'] ?? $resultArray[0]['Question_No_24_Normal_Color_vision'] ?? null,
            "question_no_28_nystagmus" => $resultArray[0]['Question_No_28_Nystagmus'] ?? $resultArray[0]['Question_No_25_Nystagmus'] ?? null,
            "eye_comment" => $resultArray[0]['eye_comment'] ?? null,
            "question_no_29_normal_ears_shape_and_position" => $resultArray[0]['Question_No_29_Normal_ears_shape_and_position'] ?? $resultArray[0]['Question_No_26_Normal_ears_shape_and_position'] ?? null,
            "question_no_30_ear_examination" => $resultArray[0]['Question_No_30_Ear_examination'] ?? $resultArray[0]['Question_No_27_Ear_examination'] ?? null,
            "question_no_31_conclusion_of_hearing_test_with_rinner_and_weber" => $resultArray[0]['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] ?? $resultArray[0]['Question_No_28_Conclusion_of_hearing_test_with_Rinner_and_Weber'] ?? null,
            "ears_comment" => $resultArray[0]['ears_comment'] ?? null,
            "question_no_32_external_nasal_examinaton" => $resultArray[0]['Question_No_32_External_nasal_examinaton'] ?? $resultArray[0]['Question_No_29_External_inasal_examinaton'] ?? null,
            "question_no_33_perform_a_nasal_patency" => $resultArray[0]["Question_No_33_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patient's_ability_to_breathe_through_each_nostril"] ?? $resultArray[0]["Question_No_30_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patient's_ability_to_breathe_through_each_nostril"] ?? null,
            "nose_comment" => $resultArray[0]['nose_comment'] ?? null,
            "question_no_34_assess_gingiva" => $resultArray[0]['Question_No_34_Assess_gingiva'] ?? $resultArray[0]['Question_No_31_Assess_gingiva'] ?? null,
            "question_no_35_are_there_dental_caries" => $resultArray[0]['Question_No_35_Are_there_dental_caries'] ?? $resultArray[0]['Question_No_32_Are_there_dental_caries'] ?? null,
            "oral_comment" => $resultArray[0]['oral_comment'] ?? null,
            "question_no_36_examine_tonsils" => $resultArray[0]['Question_No_36_Examine_tonsils'] ?? $resultArray[0]['Question_No_34_Examine_tonsils'] ?? null,
            "question_no_37_normal_speech_development" => $resultArray[0]['Question_No_37_Normal_Speech_development'] ?? $resultArray[0]['Question_No_35_Normal_Speech_development'] ?? null,
            "question_no_38_any_neck_swelling" => $resultArray[0]['Question_No_38_Any_Neck_swelling'] ?? $resultArray[0]['Question_No_36_Any_Neck_swelling'] ?? null,
            "question_no_39_examine_lymph_node" => $resultArray[0]['Question_No_39_Examine_lymph_node'] ?? $resultArray[0]['Question_No_37_Examine_lymph_node'] ?? null,
            "specify_lymph_node" => $resultArray[0]['Specify_lymph_node'] ?? null,
            "specify_any_neck_swelling" => $resultArray[0]['Specify_Any_Neck_swelling'] ?? null,
            "throat_comment" => $resultArray[0]['throat_comment'] ?? null,
            "question_no_40_any_visible_chest_deformity" => $resultArray[0]['Question_No_40_Any_visible_chest_deformity'] ?? $resultArray[0]['Question_No_38_Any_visible_chest_deformity'] ?? null,
            "question_no_41_lung_auscultation" => $resultArray[0]['Question_No_41_Lung_Auscultation'] ?? $resultArray[0]['Question_No_39_Lung_Auscultation'] ?? null,
            "question_no_42_cardiac_auscultation" => $resultArray[0]['Question_No_42_Cardiac_Auscultation'] ?? $resultArray[0]['Question_No_40_Cardiac_Auscultation'] ?? null,
            "chest_comment" => $resultArray[0]['chest_comment'] ?? null,
            "question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen" => $resultArray[0]["Question_No_43_Did_you_observe_any_distension,_scars,_or_masses_on_the_child's_abdomen?"] ?? $resultArray[0]["Question_No_41_Did_you_observe_any_distension,_scars,_or_masses_on_the_child's_abdomen?"] ?? null,
            "question_no_44_any_history_of_abdominal_pain" => $resultArray[0]['Question_No_44_Any_history_of_abdominal_Pain'] ?? $resultArray[0]['Question_No_42_Any_history_of_abdominal_Pain'] ?? null,
            "any_history_of_abdominal_pain_specify" => $resultArray[0]['any_history_of_abdominal_pain_specify'] ?? null,
            "abdomen_comment" => $resultArray[0]['abdomen_comment'] ?? null,
           
            "question_no_45_did_you_observe_any_limitations_in_the_childs_range_of_joint_motion_during_your_examination" => $resultArray[0]["Question_No_45_Did_you_observe_any_limitations_in_the_child's_range_of_joint_motion_during_your_examination?"] ?? $resultArray[0]["Question_No_43_Did_you_observe_any_limitations_in_the_child's_range_of_joint_motion_during_your_examination?"] ?? null,
            "specify_limitations_in_the_childs_range_of_joint_motion_during_your_examination" => $resultArray[0]["Specify_limitations_in_the_child's_range_of_joint_motion_during_your_examination?"] ?? null,
            "question_no_48_adams_forward_bend_test" => $resultArray[0]['Question_No_48_Adams_forward_bend_test'] ?? $resultArray[0]['Question_No_46_Adams_forward_bend_test'] ?? null,
            "question_no_49_any_foot_or_toe_abnormalities" => $resultArray[0]['Question_No_49_Any_foot_or_toe_abnormalities'] ?? $resultArray[0]['Question_No_47_Any_foot_or_toe_abnormalities'] ?? null,
            "musculoskeletal_comment" => $resultArray[0]['musculoskeletal_comment'] ?? null,
            "question_no_50_have_epi_immunization_card" => $resultArray[0]["Question_No_50_Have_EPI_immunization_card?"] ?? $resultArray[0]['Question_No_48_Have_EPI_immunization_card?'] ?? null,
            "BCG_1_dose" => $resultArray[0]["BCG_1_dose"] ?? null,
            "OPV_4_dose" => $resultArray[0]["OPV_4_dose"] ?? null,
            "Pentavalent_vaccine_DTP" => $resultArray[0]["Pentavalent_vaccine_(DTP+Hep B + Hib)_3_dose"] ?? null,
            "rota" => $resultArray[0]["rota"] ?? null,
            "measles" => $resultArray[0]["measles"] ?? null,
            "never_had_any_vaccination" => $resultArray[0]['never_had_any_vaccination'] ?? null,
            "reason_of_not_being_vaccinated" => $resultArray[0]['Reason_of_not_being_vaccinated'] ?? null,
            "vaccination_comment" => $resultArray[0]['vaccination_comment'] ?? null,
            "question_51_do_you_frequently_put_things_in_hisher_mouth_such_as_toys_jewelry_or_keys" => $resultArray[0]["Question_51_Do_you_Frequently_put_things_in_his/her_mouth_such_as_toys,_jewelry,_or_keys?"] ?? $resultArray[0]['Question_50_Do_you_Frequently_put_things_in_his/her_mouth_such_as_toys,_jewelry,_or_keys?'] ?? null,
            "question_52_does_your_child_eat_non_food_items_pica" => $resultArray[0]["Question_52_Does_your_child_eat_non_food_items_(pica)?"] ?? $resultArray[0]['Question_51_Does_your_child_eat_non_food_items_(pica)?'] ?? null,
            "question_53_do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead" => $resultArray[0]["Question_53_Do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead?"] ?? $resultArray[0]['Question_52_Do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead?'] ?? null,
            "question_54_do_you_frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead" => $resultArray[0]["Question_54_Do_you_frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead?"] ?? $resultArray[0]['Question_53_Do_you_frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead?'] ?? null,
            "lead_exposure_comment" => $resultArray[0]['lead_exposure_comment'] ?? null,
            "question_no_55_do_you_have_any_allergies" => $resultArray[0]["Question_No_55_Do_you_have_any_Allergies"] ?? $resultArray[0]['Question_No_54_Do_you_have_any_Allergies'] ?? null,
            "do_you_have_any_allergies_specify" => $resultArray[0]['Do_you_have_any_allergies_specify'] ?? $resultArray[0]['do_you_have_any_allergies_specify'] ?? null,
            "question_no_56_girls_above_8_years_old_ask" => $resultArray[0]['Question_No_56_Girls_above_8_years_old_ask:'] ?? $resultArray[0]['Question_No_55_Girls_above_8_years_old_ask:'] ?? null,
            "question_no_57_inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination" => $resultArray[0]["Question_No_57_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination"] ?? $resultArray[0]['Question_No_56_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination'] ?? null,
            "questionno_58_any_menstrual_abnormality" => $resultArray[0]['QuestionNo_58_Any_menstrual_abnormality'] ?? $resultArray[0]['QuestionNo_57_Any_menstrual_abnormality'] ?? null,
            "any_menstrual_abnormality_specify" => $resultArray[0]['Any_menstrual_abnormality_specify'] ?? null,
            "miscellaneous_comment" => $resultArray[0]['miscellaneous_comment'] ?? null,
            "question_no_59_how_often_do_you_experience_negative_or_intrusive_thoughts" => $resultArray[0]['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts?'] ?? $resultArray[0]['Question_No_58_How_often_do_you_experience_negative_or_intrusive_thoughts?'] ?? null,
            "question_no_60_how_would_you_rate_your_overall_self_esteem_and_self_confidence" => $resultArray[0]['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence?'] ?? $resultArray[0]['Question_No_59_How_would_you_rate_your_overall_self_esteem_and_self_confidence?'] ?? null,
            "question_no_61_how_would_you_describe_your_energy_levels_throughout_a_typical_day" => $resultArray[0]['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day?'] ?? $resultArray[0]['Question_No_60_How_would_you_describe_your_energy_levels_throughout_a_typical_day?'] ?? null,
            "question_no_62_when_faced_with_challenges_what_are_your_typical_coping_mechanisms" => $resultArray[0]["Question_No_62_When_faced_with_challenges,_what_are_your_typical_coping_mechanisms?"] ?? $resultArray[0]['Question_No_61_When_faced_with_challenges,_what_are_your_typical_coping_mechanisms?'] ?? null,
            "question_no_63_how_would_you_rate_the_quality_of_your_sleep_on_average" => $resultArray[0]['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average?'] ?? $resultArray[0]['Question_No_62_How_would_you_rate_the_quality_of_your_sleep_on_average?'] ?? null,
            "question_no_64_how_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks" => $resultArray[0]['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks?'] ?? $resultArray[0]['Question_No_63_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks?'] ?? null,
            "question_no_65_how_would_you_describe_your_overall_mood_during_the_day" => $resultArray[0]['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day?'] ?? $resultArray[0]['Question_No_64_How_would_you_describe_your_overall_mood_during_the_day?'] ?? null,
            "question_no_66_how_would_you_describe_the_quality_of_your_relationships_with_family_members" => $resultArray[0]['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members?'] ?? $resultArray[0]['Question_No_65_How_would_you_describe_the_quality_of_your_relationships_with_family_members?'] ?? null,
            "question_no_67_how_well_does_you_handle_challenges_and_solve_problems" => $resultArray[0]['Question_No_67_How_well_does_you_handle_challenges_and_solve_problems?'] ?? $resultArray[0]['Question_No_66_How_well_does_you_handle_challenges_and_solve_problems?'] ?? null,
            "question_no_68_how_many_hours_of_sleep_does_you_typically_get_on_a_school_night" => $resultArray[0]['Question_No_68_How_many_hours_of_sleep_does_you_typically_get_on_a_school_night?'] ?? $resultArray[0]['Question_No_67_How_many_hours_of_sleep_does_you_typically_get_on_a_school_night?'] ?? null,
            "followup_required" => $resultArray[0]['followup_required'] ?? null,
            "referred_by" => $resultArray[0]['referred_by'] ?? null,
            "referred_to" => $resultArray[0]['referred_to'] ?? null,
            "psychological_comment" => $resultArray[0]['psychological_comment'] ?? null,

            "Psychologist_Findings" => $resultArray[0]['Psychologist_Findings'] ?? null,
        ];

        $data['area'] = Area::get();
        $data['school'] = School::get();
        $data['city'] = City::get();
        $data['form_id'] = $id;

        $data['medicalComplain'] = medicalComplain::where('stdId', $id)->get()->toArray();


        $dataDetails = DB::table('form_entries')->where('id', $id)->first();

        if (!empty($dataDetails->grno)) {


            $data['StudentBiodata'] = StudentBiodata::where('deleted', 0)
                ->where('GRNo', $dataDetails->grno)
                ->orderBy('id', 'desc')
                ->get();
            $data['medical_history_id'] = StudentBiodata::where('deleted', 0)
                ->where('GRNo', $dataDetails->grno)
                ->orderBy('id', 'desc')
                ->pluck('id');

            // dd($data['medical_history_id']);
            $data['Prescription'] = Prescription::where('deleted', 0)
                ->where('form_entry_id', $id)
                ->orderBy('id', 'desc')
                ->get();

            $data['Aids'] = Aids::where('deleted', 0)
                ->where('form_entry_id', $id)
                ->orderBy('id', 'desc')
                ->get();

            $data['Labs'] = Labs::where('deleted', 0)
                ->where('form_entry_id', $id)
                ->orderBy('id', 'desc')
                ->get();


        }



        return view('admin.GeneralInfo', $data);
    }


    /* edit_student*/


    /*Uploding CSV for creation data*/

    public function uploadCSV(Request $request)
    {
        $auth_id = Auth::guard('admin')->user()->id;
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:10240', // Adjust max file size as needed
        ]);

        $path = $request->file('csv_file')->getRealPath();

        // Use the explicit CSV reader
        $data = Excel::toCollection(null, $path, null, \Maatwebsite\Excel\Excel::CSV)->first();

        // Extract the column names (keys) from the first row
        $columns = $data->shift()->toArray();

        $SchoolNameErrors[] = '';

        foreach ($data as $row) {

            $recordData = [];
            foreach ($row as $index => $value) {

                // $recordData[trim($columns[$index])] = trim($value);

                // Convert column names to suitable format
                $columnName = str_replace(' ', '_', trim($columns[$index]));

                // Assign the trimmed value to the new formatted column name
                $recordData[$columnName] = trim($value);

            }

            // dd($recordData);

            $Name = isset($recordData['Name']) ? $recordData['Name'] : null;

            $SchoolName = isset($recordData['School']) ? $recordData['School'] : null;

            if ($SchoolName) {

                $School = School::where('school_name', $SchoolName)->first();

                if (!$School) {

                    // return back()->with([
                    //     'error' => 'The specified school does not exist.',
                    // ]);

                    // $EditLink[] = Route('edit_student',$storedRecordId);
                    $SchoolNameErrors[] = $Name . ' ' . $SchoolName . ' not exist ';

                    $insertRecord = false;

                } else {

                    $SchoolName = $School['id'];
                    $insertRecord = true;

                }
            } else {
                $insertRecord = false;

            }

            $form = new form_entry();
            $form->grno = isset($recordData['GR']) ? $recordData['GR'] : null;
            $form->name = isset($recordData['Name']) ? $recordData['Name'] : null;
            $form->lname = isset($recordData['Guardian']) ? $recordData['Guardian'] : null;
            $form->gender = isset($recordData['Gender']) ? $recordData['Gender'] : null;
            $form->school = $SchoolName;
            $form->blood_group = isset($recordData['Blood_Group']) ? $recordData['Blood_Group'] : 'Unknown';
            // $form->Emergency_Contact_Number = isset($recordData['Emergency_Contact_Number']) ? $recordData['Emergency_Contact_Number'] : 'Unknown';

            // Retrieve city name from $recordData
            $cityName = isset($recordData['City']) ? $recordData['City'] : null;

            // Check if the city exists in the database
            if ($cityName) {
                $city = City::where('name', $cityName)->first();
                $cityId = $city ? $city->id : '1'; // Default to '1' if not set
            } else {
                $cityId = '1'; // Default to '1' if not set
            }

            $form->city = $cityId;

            // Retrieve area name from $recordData
            $areaName = isset($recordData['Area']) ? $recordData['Area'] : null;

            // Check if the area exists in the database
            if ($areaName) {
                $area = Area::where('name', $areaName)->first();
                $areaId = $area ? $area->id : null; // Default to null if not set
            } else {
                $areaId = null; // Default to null if not set
            }

            $form->area = $areaId;

            // $dateString = isset($recordData['DOB']) ? $recordData['DOB'] : null;
            // $form->dob = $dateString ? date('Y-m-d', strtotime($dateString)) : null;


            // /*Assuming $recordData contains the date of birth in 'Y-m-d' format*/
            // if ($dateString != null) {
            //     $dob = new \DateTime($dateString);
            //     $now = new \DateTime();
            //     $age = $now->diff($dob)->y;
            //     $form->age = $age;
            // }
            $dateString = isset($recordData['DOB']) ? $recordData['DOB'] : null;

            // Convert the date format from 'd/m/Y' to 'Y-m-d'
            $form->dob = $dateString ? \DateTime::createFromFormat('d/m/Y', $dateString)->format('Y-m-d') : null;

            /* Assuming $recordData contains the date of birth in 'd/m/Y' format */
            if ($dateString != null) {
                $dob = \DateTime::createFromFormat('d/m/Y', $dateString); // Parse 'd/m/Y' format
                $now = new \DateTime();
                $age = $now->diff($dob)->y;
                $form->age = $age;
            }

            $form->address = isset($recordData['Address']) ? $recordData['Address'] : null;

            $form->enterby = $auth_id;
            $form->save();

            if ($insertRecord) {

                $storedRecordId = $form->id;


                $data['details'] = [
                    "name" => isset($recordData['Name']) ? $recordData['Name'] : null,
                    "guardianname" => isset($recordData['Guardian']) ? $recordData['Guardian'] : null,
                    "gender" => isset($recordData['Gender']) ? $recordData['Gender'] : null,
                    "school" => $SchoolName,
                    "city" => $cityId,
                    "dob" => $dateString ? \DateTime::createFromFormat('d/m/Y', $dateString)->format('Y-m-d') : null,
                    "age" => isset($age) ? $age : null,
                    "Gr_Number" => isset($recordData['GR']) ? $recordData['GR'] : null,
                    "address" => isset($recordData['Address']) ? $recordData['Address'] : null,
                    "area" => $areaId,
                    "Blood_group" => isset($recordData['Blood_Group']) ? $recordData['Blood_Group'] : 'Unknown',
                    "emergency_contact_number" => isset($recordData['Emergency_Contact_Number']) ? $recordData['Emergency_Contact_Number'] : null,
                    "Question_No_1_Height" => null,
                ];

                // dd($data['details']);

                foreach ($data['details'] as $key => $value) {

                    $formDataModel = new FormData();
                    $formDataModel->entry_id = $storedRecordId;
                    $formDataModel->key = $key;
                    $formDataModel->value = $value;
                    $formDataModel->save();
                }


                // $EditLink[] = Route('edit_student',$storedRecordId);
                $EditLink[] = array(
                    'url' => Route('edit_student', $storedRecordId),
                    'name' => isset($recordData['Name']) ? $recordData['Name'] : null,
                );

            }



        }


        return back()->with([
            'success' => 'CSV file uploaded and data saved successfully.',
            'EditLink' => $EditLink,
            'SchoolNameErrors' => $SchoolNameErrors
        ]);




    }



    /* uploadProfileImage*/
    public function uploadProfileImage(Request $request)
    {
        // Validate the request
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max size as needed
        ]);

        // Handle the file upload
        if ($request->hasFile('profile_image')) {

            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            // $filePath = 'profile_images/' . $filename;
            $extension = $file->getClientOriginalExtension();

            $FileName = 'student-' . rand(111, 99999) . '.' . $extension;

            $path = public_path('uploads/student/profile_images');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }


            $destinationPath = public_path('uploads/student/profile_images');
            $file->move($destinationPath, $FileName);

            // dd($FileName);


            // Update the profile image in the database
            form_entry::where('id', $request->post('updateID'))
                ->update(['profile_image' => $FileName]);


            return back()->with([
                'success_message' => 'Image uploaded successfully.',
                'filePath' => $FileName
            ]);

        }


        return back()->with([
            'error_message' => 'Image upload failed. Please try again..',
        ]);

    }


    public function HeightForAge(Request $request)
    {

        $DataArr = $request->all();
        // echo "<PRE>";print_r($DataArr);exit;


        $HeightForAge = HeightForAge::where('age_month', $DataArr['age_month'])->where('height_for_age_type', 0)->where('3rd', $DataArr['height'])->count();
        if ($HeightForAge > 0) {

            $message = "Valid";
            return response()->json(
                array(
                    'status' => true,
                    'message' => $message,
                )
            );

        } else {
            $message = "Not valid";
            return response()->json(
                array(
                    'status' => false,
                    'message' => $message,
                )
            );
        }

    }

    public function index($id = null)
    {
        if ($id > 0) {

            // Fetch all the records where entry_id matches
            $records = DB::table('form_data')
                ->where('entry_id', $id)
                ->get(); // Use get() to fetch all records

            // Initialize an array to hold the result
            $columns = [];

            // Iterate through each record and collect 'refer_to' values
            foreach ($records as $record) {
                if ($record->key === 'refer_to') {
                    // If 'refer_to' key exists, add it to the array
                    // Convert the value into an array (if it's a string with commas)
                    $values = is_string($record->value) ? explode(',', $record->value) : (array) $record->value;

                    // Merge the values with the existing ones (avoiding duplicates)
                    if (!isset($columns['refer_to'])) {
                        $columns['refer_to'] = [];
                    }
                    $columns['refer_to'] = array_merge($columns['refer_to'], $values);
                } else {
                    // Store other values normally
                    $columns[$record->key] = $record->value;
                }
            }

            // Ensure unique values in 'refer_to' (optional)
            if (isset($columns['refer_to'])) {
                $columns['refer_to'] = array_unique($columns['refer_to']);
            }

            // Now, $columns contains all refer_to values
            // dd($columns);
            $resultArray = [$columns];


            $data['details'] = [

                /* Bio Data */

                "id" => $id,
                "name" => $resultArray[0]['name'] ?? null,
                "guardianname" => $resultArray[0]['guardianname'] ?? null,
                "gender" => $resultArray[0]['gender'] ?? null,
                "class" => $resultArray[0]['class'] ?? null,
                "school" => $resultArray[0]['school'] ?? null,
                "city" => $resultArray[0]['city'] ?? null,
                "area" => $resultArray[0]['area'] ?? null,
                "dob" => $resultArray[0]['dob'] ?? null,
                "age" => $resultArray[0]['age'] ?? null,
                "emergency_contact_number" => $resultArray[0]['Emergency_Contact_Number']
                    ?? $resultArray[0]['emergency_contact_number']
                    ?? null,
    
                "gr_number" => $resultArray[0]['Gr_Number'],
                "any_known_medical_condition" => $resultArray[0]['Any_Known_Medical_Condition'] ?? null,
                "address" => $resultArray[0]['Address'] ?? '-',

                "blood_group" => $resultArray[0]['Blood_group'] ?? '-',
                "bio_data_comment" => $resultArray[0]['bio_data_comment'] ?? null,

                /* Vitals/BMI*/

                "Question_No_1_Height" => $resultArray[0]['Question_No_1_Height'] ?? null,
                "Question_No_2_Weight" => $resultArray[0]['Question_No_2_Weight'] ?? null,
                "Question_No_3_BMI" => $resultArray[0]['Question_No_3_BMI'] ?? null,
                "Question_No_4_Body_Temperature" => $resultArray[0]['Question_No_4_Body_Temperature'] ?? null,
                "bodytempunit" => $resultArray[0]['Bodytempunit'] ?? 'f',
                "Question_No_5_Blood_Pressure_Systolic" => $resultArray[0]['Question_No_5_Blood_Pressure_Systolic'] ?? $resultArray[0]['Question_No_6_Blood_Pressure_Systolic'] ?? null,
                "systolicresult" => $resultArray[0]['systolicresult'] ?? $resultArray[0]['systolicresult'] ?? null,
                "Question_No_6_Blood_Pressure_Diastolic" => $resultArray[0]['Question_No_6_Blood_Pressure_Diastolic'] ?? $resultArray[0]['Question_No_6_Blood_Pressure_Diastolic'] ?? null,
                "diastolicresult" => $resultArray[0]['diastolicresult'] ?? $resultArray[0]['diastolicresult'] ?? null,
                "Question_No_7_Pulse" => $resultArray[0]['Question_No_7_Pulse'] ?? $resultArray[0]['Question_No_7_Pulse'] ?? null,
                "vitals_bmi_comment" => $resultArray[0]['vitals_bmi_comment'] ?? $resultArray[0]['vitals_bmi_comment'] ?? null,
                
                
    
                /* General Apperance */
                "Question_No_8_Normal_Posture_Gait" => $resultArray[0]['Question_No_8_Normal_Posture_Gait'] ?? $resultArray[0]['Question_No_8_Normal_Posture_Gait'] ?? null,
                "Question_No_9_Mental_Status" => $resultArray[0]['Question_No_9_Mental_Status'] ?? $resultArray[0]['Question_No_9_Mental_Status'] ?? null,
                "Question_No_10_Look_For_jaundice" => $resultArray[0]['Question_No_10_Look_For_jaundice'] ?? $resultArray[0]['Question_No_10_Look_For_jaundice'] ?? null,
                "Question_No_11_Look_For_anemia" => $resultArray[0]['Question_No_11_Look_For_anemia'] ?? $resultArray[0]['Question_No_11_Look_For_anemia'] ?? null,
                "Question_No_12_Look_For_Clubbing" => $resultArray[0]['Question_No_12_Look_For_Clubbing'] ?? $resultArray[0]['Question_No_12_Look_For_Clubbing'] ?? null,
                "Question_No_13_Look_for_Cyanosis" => $resultArray[0]['Question_No_13_Look_for_Cyanosis'] ?? $resultArray[0]['Question_No_13_Look_for_Cyanosis'] ?? null,
                "Question_No_14_Skin" => $resultArray[0]['Question_No_14_Skin'] ?? $resultArray[0]['Question_No_14_Skin'] ?? null,
                "Question_No_15_Breath" => $resultArray[0]['Question_No_15_Breath'] ?? $resultArray[0]['Question_No_15_Breath'] ?? null,
                "general_apperance_comment" => $resultArray[0]['general_apperance_comment'] ?? $resultArray[0]['general_apperance_comment'] ?? null,

                /* Inspect Hygiene */
                "Question_No_16_Nails" => $resultArray[0]['Question_No_16_Nails'] ?? $resultArray[0]['Question_No_16_Nails'] ?? null,
                "Question_No_17_Uniform_or_shoes" => $resultArray[0]['Question_No_17_Uniform_or_shoes'] ?? $resultArray[0]['Question_No_17_Uniform_or_shoes'] ?? null,
                "Question_No_18_Lice_nits" => $resultArray[0]['Question_No_18_Lice_nits'] ?? $resultArray[0]['Question_No_18_Lice_nits'] ?? null,
                "Question_No_19_Discuss_hygiene_routines_and_practices" => $resultArray[0]['Question_No_19_Discuss_hygiene_routines_and_practices'] ?? $resultArray[0]['Question_No_19_Discuss_hygiene_routines_and_practices'] ?? null,
                "inspect_hygiene_comment" => $resultArray[0]['inspect_hygiene_comment'] ?? $resultArray[0]['inspect_hygiene_comment'] ?? null,


                /* Head and Neck Examination */
                "Question_No_20_Hair_and_Scalp" => $resultArray[0]['Question_No_20_Hair_and_Scalp'] ?? null,
                "Question_No_21_Any_Hair_Problem" => $resultArray[0]['Question_No_21_Any_Hair_Problem'] ?? null,
                "Question_No_22_Scalp" => $resultArray[0]['Question_No_22_Scalp'] ?? null,
                "Question_No_23_Hair_Distribution" => $resultArray[0]['Question_No_23_Hair_Distribution'] ?? null,
                "head_and_neck_examination_comment" => $resultArray[0]['head_and_neck_examination_comment'] ?? null,


                /* Eye Examination */
                
                "Question_No_24_Visual_acuity_using_Snellens_chart" => $resultArray[0]['Question_No_24_Visual_acuity_using_Snellens_chart'] ?? null,
                "Question_No_25_Normal_ocular_alignment" => $resultArray[0]['Question_No_25_Normal_ocular_alignment'] ?? null,
                "Question_No_26_Normal_eye_inspection" => $resultArray[0]['Question_No_26_Normal_eye_inspection'] ?? null,
                "Question_No_27_Normal_Color_vision" => $resultArray[0]['Question_No_27_Normal_Color_vision'] ?? null,
                "Question_No_28_Nystagmus" => $resultArray[0]['Question_No_28_Nystagmus'] ?? null,
                "eye_comment" => $resultArray[0]['eye_comment'] ?? null,

                /* Ears */
                "Question_No_29_Normal_ears_shape_and_position" => $resultArray[0]['Question_No_29_Normal_ears_shape_and_position'] ?? null,
                "Question_No_30_Ear_examination" => $resultArray[0]['Question_No_30_Ear_examination'] ?? null,
                "Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber" => $resultArray[0]['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] ?? null,
                "ears_comment" => $resultArray[0]['ears_comment'] ?? null,

                /* Nose */
                "Question_No_32_External_nasal_examinaton" => $resultArray[0]['Question_No_32_External_nasal_examinaton'] ?? null,
                "Question_No_33_perform_a_nasal_patency_test" => $resultArray[0]["Question_No_33_perform_a_nasal_patency_test"] ?? null,
                "nose_comment" => $resultArray[0]['nose_comment'] ?? null,


                /* Oral */
                "Question_No_34_Assess_gingiva" => $resultArray[0]['Question_No_34_Assess_gingiva'] ?? null,
                "Question_No_35_Are_there_dental_caries" => $resultArray[0]['Question_No_35_Are_there_dental_caries'] ?? null,
                "oral_comment" => $resultArray[0]['oral_comment'] ?? null,


                /* Throat */
                "Question_No_36_Examine_tonsils" => $resultArray[0]['Question_No_36_Examine_tonsils'] ?? null,
                "Question_No_37_Normal_Speech_development" => $resultArray[0]['Question_No_37_Normal_Speech_development'] ?? null,
                "Question_No_38_Any_Neck_swelling" => $resultArray[0]['Question_No_38_Any_Neck_swelling'] ?? null,
                "Question_No_39_Examine_lymph_node" => $resultArray[0]['Question_No_39_Examine_lymph_node'] ?? null,
                "Specify_lymph_node" => $resultArray[0]['Specify_lymph_node'] ?? null,
                "Specify_Any_Neck_swelling" => $resultArray[0]['Specify_Any_Neck_swelling'] ?? null,
                "throat_comment" => $resultArray[0]['throat_comment'] ?? null,

                /* Chest */

                "Question_No_40_Any_visible_chest_deformity" => $resultArray[0]['Question_No_40_Any_visible_chest_deformity'] ?? null,
                "Question_No_41_Lung_Auscultation" => $resultArray[0]['Question_No_41_Lung_Auscultation'] ?? null,
                "Question_No_42_Cardiac_Auscultation" => $resultArray[0]['Question_No_42_Cardiac_Auscultation'] ?? null,
                "chest_comment" => $resultArray[0]['chest_comment'] ?? null,

                /* Abdomen */
                "Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen" => $resultArray[0]["Question_No_43_Did_you_observe_any_distension,_scars,_or_masses_on_the_child's_abdomen?"] ?? null,
                "Question_No_44_Any_history_of_abdominal_Pain" => $resultArray[0]['Question_No_44_Any_history_of_abdominal_Pain'] ?? null,
                "any_history_of_abdominal_pain_specify" => $resultArray[0]['any_history_of_abdominal_pain_specify'] ?? null,
                "abdomen_comment" => $resultArray[0]['abdomen_comment'] ?? null,
            

            ];

            
        }

        $role = Auth::guard('admin')->user()->role;
        if ($role == 1) {

            $data['area'] = Area::get();
            $data['school'] = School::get();
            $data['city'] = City::get();
            return view('admin.form', $data);

        } else {

            $auth_id = Auth::guard('admin')->user()->id;
            $data['area'] = Area::get();

            $school_id = User::where('id', $auth_id)->value('school_id');

            $school_ids = json_decode($school_id, true);

            if (!is_array($school_ids)) {
                $school_ids = [$school_ids];
            }

            $data['school_count'] = count($school_ids);

            $data['school'] = School::whereIn('id', $school_ids)->get();
            $data['city'] = City::get();
            return view('admin.form', $data);
        }

    }


    /* ScreeningFormCreateUpdate */
    public function ScreeningFormCreateUpdate(Request $request)
    {
        // dd($request->all());

        $formData = $request->input('formData');
        $updateID = $request->input('updateID');
        $screeningFormId = $request->input('screeningFormId');
        $currentStepNumber = $request->input('currentStepNumber');
        $name = null;
        $guardianName = null;
        $gender = null;
        $school = null;
        $city = null;
        $area = null;
        $dob = null;
        $age = null;
        $phone = null;
        $medicalCondition = null;
        $gr = null;
        $address = null;
        $blood_group = null;
        $enter_by = Auth::guard('admin')->user()->id;
        $duration = null;
        $bmiresult = null;
        $systolicresult = null;
        $diastolic = null;

        // Iterate through the formData array to extract values
        foreach ($formData as $field) {
            if ($field['name'] === 'name') {
                $name = $field['value'];
            } elseif ($field['name'] === 'guardianname') {
                $guardianName = $field['value'];
            } elseif ($field['name'] === 'gender') {
                $gender = $field['value'];
            } elseif ($field['name'] === 'school') {
                $school = $field['value'];
            } elseif ($field['name'] === 'city') {
                $city = $field['value'];
            } elseif ($field['name'] === 'area') {
                $area = $field['value'];
            } elseif ($field['name'] === 'dob') {
                $dob = $field['value'];
            } elseif ($field['name'] === 'age') {
                $age = $field['value'];
            } elseif ($field['name'] === 'Emergency_Contact_Number') {
                $phone = $field['value'];
            } elseif ($field['name'] === 'Gr_Number') {


                $gr = $field['value'];


                // Check if 'Gr_Number' is present and numeric
                if ($gr === null) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Gr Number is required.'
                    ]);
                }

                if (!is_numeric($gr)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Gr Number must be numeric.'
                    ]);
                }



            } elseif ($field['name'] === 'Any_Known_Medical_Condition') {
                $medicalCondition = $field['value'];
            } elseif ($field['name'] === 'address') {
                $address = $field['value'];
            } elseif ($field['name'] === 'blood_group') {
                $blood_group = $field['value'];
            } elseif ($field['name'] === 'duration') {
                $duration = $field['value'];
            } elseif ($field['name'] === 'bmiresult') {
                $bmiresult = $field['value'];
            } elseif ($field['name'] === 'systolicresult') {
                $systolicresult = $field['value'];
            } elseif ($field['name'] === 'diastolicresult') {
                $diastolic = $field['value'];
            }

            // elseif (isset($field['name']) && $field['name'] === 'Follow_up_Required') {
            //     $Follow_up_Required = $field['value'];
            // }
            elseif ($field['name'] === 'Follow_up_Date') {
                $Follow_up_Date = $field['value'];
            }
            // elseif ($field['name'] === 'updateID') {
            //     $updateID = $field['value'];
            // }

        }


        // echo "refer_tos ". $refer_tos;exit;


        if ($currentStepNumber == 1) {

            if ($updateID > 0) {

                $form = form_entry::where("id", $updateID)->first();

                $message = 'Enrollment has been updated successfully';

            } else {
                // $exists = form_entry::where('grno', $gr)
                // ->where('school', $school)
                // ->where('name', $name)
                // ->exists();

                $form = new form_entry();
                $message = 'Enrollment has been submitted successfully';

            }


            // if (!$exists) {

            // $form = new form_entry();

            $form->name = $name;
            $form->lname = $guardianName;
            $form->gender = $gender;
            $form->school = $school;
            $form->city = $city;
            $form->area = $area;
            $form->dob = $dob;
            $form->age = $age;
            $form->phone = $phone;
            $form->medical_condition = $medicalCondition;
            $form->grno = $gr;
            $form->address = $address;
            $form->blood_group = $blood_group;
            $form->enterby = $enter_by;
            $form->bmiresult = $bmiresult;
            $form->systolicresult = $systolicresult;
            $form->diastolic = $diastolic;
            $form->screeningFormId = $screeningFormId;
            $form->duration = gmdate('i:s', $duration);




            /*
            
            0= if Follow-up Required yes and Follow-up Date blank,
            1= if Follow-up Required yes and Follow-up Date not blank,
            2=if Follow-up Required no 

            */


            /*if ($Follow_up_Required == "Yes" && empty($Follow_up_Date)) {

                $form->Follow_up_Date_flag = 0;

            }
            else if ($Follow_up_Required == "Yes" && !empty($Follow_up_Date)) {

                $form->Follow_up_Date_flag = 1;

            }
             else if ($Follow_up_Required == "No")
             {
                $form->Follow_up_Date_flag = 2;

             }
             else {
                $form->Follow_up_Date_flag = 2;

            }*/


            $form->save();
            $storedRecordId = $form->id;

            foreach ($formData as $field) {

                if ($field['name'] !== '_token') {

                    $formDataModel = FormData::where("entry_id", $storedRecordId)
                        ->where("key", $field['name'])
                        ->first();
                    if (empty($formDataModel)) {
                        $formDataModel = new FormData();

                    }

                    $formDataModel->entry_id = $storedRecordId;
                    $formDataModel->key = trim($field['name']);
                    $formDataModel->value = trim($field['value']) ?? null;

                    $formDataModel->save();



                    // Create Calendar Event if Follow_up_Required is Yes
                    if ($field['name'] == "Follow_up_Required" && $field['value'] == "Yes" || $field['name'] == "refer_to") {
                        // Extract additional fields
                        $grNumber = null;
                        $followUpDate = null;
                        $reasonForFollowUp = null;


                        foreach ($formData as $item) {
                            switch ($item['name']) {
                                case 'Gr_Number':
                                    $grNumber = $item['value'];
                                    break;
                                case 'Follow_up_Date':
                                    $followUpDate = $item['value'];
                                    break;
                                case 'Reason_for_Follow_up':
                                    $reasonForFollowUp = $item['value'];
                                    break;
                                /*case 'refer_to':
                                    $refer_to = $item['value'];
                                    break;*/
                            }
                        }

                        // Create and save Calendar Event


                        if ($field['name'] == "refer_to") {

                            $refer_to = $field['value'];

                            $CalendarEvents = new CalendarEvents();
                            $CalendarEvents->startDate = $followUpDate;
                            $CalendarEvents->endDate = $followUpDate;

                            $referrals = [
                                1 => ['color' => 'blue', 'description' => 'Psychologist', 'title' => 'Psychologist'],
                                2 => ['color' => 'green', 'description' => 'Nutritionist', 'title' => 'Nutritionist'],
                                3 => ['color' => 'red', 'description' => 'Physician', 'title' => 'Physician'],
                                4 => ['color' => 'red', 'description' => 'External Specialists', 'title' => 'External Specialists'],
                                5 => ['color' => 'red', 'description' => 'General Physician (school health physician )', 'title' => 'General Physician (school health physician )']
                            ];

                            if (isset($referrals[$refer_to])) {

                                $CalendarEvents->color = $referrals[$refer_to]['color'];
                                $CalendarEvents->description = $referrals[$refer_to]['description'];
                                $CalendarEvents->title = $referrals[$refer_to]['title'];
                                $CalendarEvents->slug = Str::slug($referrals[$refer_to]['title'] . '-' . $grNumber);

                            } else {
                                $CalendarEvents->color = 'gray';
                                $CalendarEvents->description = $reasonForFollowUp;
                            }


                            $CalendarEvents->created_by = Auth::user()->id;
                            $CalendarEvents->event_type = 2;
                            $CalendarEvents->event_id = $storedRecordId;
                            $CalendarEvents->redirect_link = Route('Medical_Detail') . '/' . trim($storedRecordId);
                            $CalendarEvents->save();


                        }



                    }

                }
            }


        } else {

            $storedRecordId = $updateID;
            foreach ($formData as $field) {

                if ($field['name'] !== '_token') {

                    $formDataModel = FormData::where("entry_id", $storedRecordId)
                        ->where("key", $field['name'])
                        ->first();

                    $message = 'Enrollment has been updated successfully';

                    if (empty($formDataModel)) {
                        $formDataModel = new FormData();
                        $message = 'Enrollment has been submitted successfully';

                    }

                    $formDataModel->entry_id = $storedRecordId;
                    $formDataModel->key = trim($field['name']);
                    $formDataModel->value = trim($field['value']) ?? null;;

                    $formDataModel->save();



                    // Create Calendar Event if Follow_up_Required is Yes
                    if ($field['name'] == "Follow_up_Required" && $field['value'] == "Yes" || $field['name'] == "refer_to") {
                        // Extract additional fields
                        $grNumber = null;
                        $followUpDate = null;
                        $reasonForFollowUp = null;


                        foreach ($formData as $item) {
                            switch ($item['name']) {
                                case 'Gr_Number':
                                    $grNumber = $item['value'];
                                    break;
                                case 'Follow_up_Date':
                                    $followUpDate = $item['value'];
                                    break;
                                case 'Reason_for_Follow_up':
                                    $reasonForFollowUp = $item['value'];
                                    break;
                                /*case 'refer_to':
                                    $refer_to = $item['value'];
                                    break;*/
                            }
                        }

                        // Create and save Calendar Event


                        if ($field['name'] == "refer_to") {

                            $refer_to = $field['value'];

                            $CalendarEvents = new CalendarEvents();
                            $CalendarEvents->startDate = $followUpDate;
                            $CalendarEvents->endDate = $followUpDate;

                            $referrals = [
                                1 => ['color' => 'blue', 'description' => 'Psychologist', 'title' => 'Psychologist'],
                                2 => ['color' => 'green', 'description' => 'Nutritionist', 'title' => 'Nutritionist'],
                                3 => ['color' => 'red', 'description' => 'Physician', 'title' => 'Physician'],
                                4 => ['color' => 'red', 'description' => 'External Specialists', 'title' => 'External Specialists'],
                                5 => ['color' => 'red', 'description' => 'General Physician (school health physician )', 'title' => 'General Physician (school health physician )']
                            ];

                            if (isset($referrals[$refer_to])) {

                                $CalendarEvents->color = $referrals[$refer_to]['color'];
                                $CalendarEvents->description = $referrals[$refer_to]['description'];
                                $CalendarEvents->title = $referrals[$refer_to]['title'];
                                $CalendarEvents->slug = Str::slug($referrals[$refer_to]['title'] . '-' . $grNumber);

                            } else {
                                $CalendarEvents->color = 'gray';
                                $CalendarEvents->description = $reasonForFollowUp;
                            }


                            $CalendarEvents->created_by = Auth::user()->id;
                            $CalendarEvents->event_type = 2;
                            $CalendarEvents->event_id = $storedRecordId;
                            $CalendarEvents->redirect_link = Route('Medical_Detail') . '/' . trim($storedRecordId);
                            $CalendarEvents->save();


                        }



                    }

                }
            }

        }






        return response()->json([
            'status' => true,
            'message' => $message,
            'storedRecordId' => $storedRecordId
        ]);

        // }
        // else {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Enrollment already exists!'
        //     ]);
        // }
    }


    public function edit_student($id)
    {

        // Fetch all the records where entry_id matches
        $records = DB::table('form_data')
            ->where('entry_id', $id)
            ->get(); // Use get() to fetch all records

        // Initialize an array to hold the result
        $columns = [];

        // Iterate through each record and collect 'refer_to' values
        foreach ($records as $record) {
            if ($record->key === 'refer_to') {
                // If 'refer_to' key exists, add it to the array
                // Convert the value into an array (if it's a string with commas)
                $values = is_string($record->value) ? explode(',', $record->value) : (array) $record->value;

                // Merge the values with the existing ones (avoiding duplicates)
                if (!isset($columns['refer_to'])) {
                    $columns['refer_to'] = [];
                }
                $columns['refer_to'] = array_merge($columns['refer_to'], $values);
            } else {
                // Store other values normally
                $columns[$record->key] = $record->value;
            }
        }

        // Ensure unique values in 'refer_to' (optional)
        if (isset($columns['refer_to'])) {
            $columns['refer_to'] = array_unique($columns['refer_to']);
        }

        // Now, $columns contains all refer_to values
        // dd($columns);
        $resultArray = [$columns];

        $data['details'] = [

            "id" => $id,
            "name" => $resultArray[0]['name'] ?? null,
            "guardianname" => $resultArray[0]['guardianname'] ?? null,
            "gender" => $resultArray[0]['gender'] ?? null,
            "school" => $resultArray[0]['school'] ?? null,
            "city" => $resultArray[0]['city'] ?? null,
            "area" => $resultArray[0]['area'] ?? null,
            "dob" => $resultArray[0]['dob'] ?? null,
            "age" => $resultArray[0]['age'] ?? null,
            // "emergency_contact_number" => $resultArray[0]['Emergency_Contact_Number'] ?? null,
            "emergency_contact_number" => $resultArray[0]['Emergency_Contact_Number']
                ?? $resultArray[0]['emergency_contact_number']
                ?? null,

            "gr_number" => $resultArray[0]['Gr_Number'],
            "any_known_medical_condition" => $resultArray[0]['Any_Known_Medical_Condition'] ?? null,
            "address" => $resultArray[0]['address'] ?? '-',
            "blood_group" => $resultArray[0]['Blood_group'] ?? '-',
            "bio_data_comment" => $resultArray[0]['bio_data_comment'] ?? null,
            "question_no_1_height" => $resultArray[0]['Question_No_1_Height'] ?? null,
            "question_no_2_weight" => $resultArray[0]['Question_No_2_Weight'] ?? null,
            "question_no_3_bmi" => $resultArray[0]['Question_No_3_BMI'] ?? null,
            "question_no_4_body_temperature" => $resultArray[0]['Question_No_4_Body_Temperature'] ?? null,
            "bodytempunit" => $resultArray[0]['Bodytempunit'] ?? 'f',
            "question_no_5_blood_pressure_systolic" => $resultArray[0]['Question_No_5_Blood_Pressure_Systolic'] ?? $resultArray[0]['Question_No_6_Blood_Pressure_Systolic'] ?? null,
            "question_no_6_blood_pressure_diastolic" => $resultArray[0]['Question_No_6_Blood_Pressure_Diastolic'] ?? $resultArray[0]['Question_No_7_Blood_Pressure_Diacystolic'] ?? null,
            "question_no_7_pulse" => $resultArray[0]['Question_No_7_Pulse'] ?? $resultArray[0]['Question_No_5_Pulse'] ?? null,
            "vitals_bmi_comment" => $resultArray[0]['vitals_bmi_comment'] ?? null,
            "question_no_8_normal_posture_gait" => $resultArray[0]['Question_No_8_Normal_Posture/Gait'] ?? null,
            "question_no_9_mental_status" => $resultArray[0]['Question_No_9_Mental_Status'] ?? null,
            "question_no_10_look_for_jaundice" => $resultArray[0]['Question_No_10_Look_For_jaundice'] ?? null,
            "question_no_11_look_for_anemia" => $resultArray[0]['Question_No_11_Look_For_anemia'] ?? null,
            "question_no_12_look_for_clubbing" => $resultArray[0]['Question_No_12_Look_For_Clubbing'] ?? null,
            "question_no_13_look_for_cyanosis" => $resultArray[0]['Question_No_13_Look_for_Cyanosis'] ?? null,
            "question_no_14_skin" => $resultArray[0]['Question_No_14_Skin'] ?? null,
            "question_no_15_breath" => $resultArray[0]['Question_No_15_Breath'] ?? null,
            "general_apperance_comment" => $resultArray[0]['general_apperance_comment'] ?? null,
            "question_no_16_nails" => $resultArray[0]['Question_No_16_Nails'] ?? null,
            "question_no_17_uniform_or_shoes" => $resultArray[0]['Question_No_17_Uniform_or_shoes'] ?? null,
            "question_no_18_lice_nits" => $resultArray[0]['Question_No_18_Lice/nits'] ?? null,
            "question_no_19_discuss_hygiene_routines_and_practices" => $resultArray[0]['Question_No_19_Discuss_hygiene_routines_and_practices'] ?? null,
            "inspect_hygiene_comment" => $resultArray[0]['inspect_hygiene_comment'] ?? null,
            "question_no_20_hair_and_scalp" => $resultArray[0]['Question_No_20_Hair_and_Scalp'] ?? null,
            "question_no_21_any_hair_problem" => $resultArray[0]['Question_No_21_Any_Hair_Problem'] ?? null,
            "question_no_22_sclap" => $resultArray[0]['Question_No_22_Sclap'] ?? null,
            "question_no_23_hair_distribution" => $resultArray[0]['Question_No_23_Hair_distribution'] ?? null,
            "head_and_neck_examination_comment" => $resultArray[0]['head_and_neck_examination_comment'] ?? null,
            "question_no_24_visual_acuity_using_snellens_chart" => $resultArray[0]['Question_No_24_Visual_acuity_using_Snellen’s_chart'] ?? null,
            "question_no_25_normal_ocular_alignment" => $resultArray[0]['Question_No_25_Normal_ocular_alignment'] ?? null,
            "question_no_26_normal_eye_inspection" => $resultArray[0]['Question_No_26_Normal_eye_inspection'] ?? null,
            "question_no_27_normal_color_vision" => $resultArray[0]['Question_No_27_Normal_Color_vision'] ?? null,
            "question_no_28_nystagmus" => $resultArray[0]['Question_No_28_Nystagmus'] ?? null,
            "eye_comment" => $resultArray[0]['eye_comment'] ?? null,
            "question_no_29_normal_ears_shape_and_position" => $resultArray[0]['Question_No_29_Normal_ears_shape_and_position'] ?? null,
            "question_no_30_ear_examination" => $resultArray[0]['Question_No_30_Ear_examination'] ?? null,
            "question_no_31_conclusion_of_hearing_test_with_rinner_and_weber" => $resultArray[0]['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] ?? null,
            "ears_comment" => $resultArray[0]['ears_comment'] ?? null,
            "question_no_32_external_nasal_examinaton" => $resultArray[0]['Question_No_32_External_nasal_examinaton'] ?? null,
            "question_no_33_perform_a_nasal_patency" => $resultArray[0]["Question_No_33_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patient's_ability_to_breathe_through_each_nostril"] ?? null,
            "nose_comment" => $resultArray[0]['nose_comment'] ?? null,
            "question_no_34_assess_gingiva" => $resultArray[0]['Question_No_34_Assess_gingiva'] ?? null,
            "question_no_35_are_there_dental_caries" => $resultArray[0]['Question_No_35_Are_there_dental_caries'] ?? null,
            "oral_comment" => $resultArray[0]['oral_comment'] ?? null,
           
            "question_no_36_examine_tonsils" => $resultArray[0]['Question_No_36_Examine_tonsils'] ?? null,
            "question_no_37_normal_speech_development" => $resultArray[0]['Question_No_37_Normal_Speech_development'] ?? null,
            "question_no_38_any_neck_swelling" => $resultArray[0]['Question_No_38_Any_Neck_swelling'] ?? null,
            "question_no_39_examine_lymph_node" => $resultArray[0]['Question_No_39_Examine_lymph_node'] ?? null,
            "specify_lymph_node" => $resultArray[0]['Specify_lymph_node'] ?? null,
            "specify_any_neck_swelling" => $resultArray[0]['Specify_Any_Neck_swelling'] ?? null,
            "throat_comment" => $resultArray[0]['throat_comment'] ?? null,

            "question_no_40_any_visible_chest_deformity" => $resultArray[0]['Question_No_40_Any_visible_chest_deformity'] ?? null,
            "question_no_41_lung_auscultation" => $resultArray[0]['Question_No_41_Lung_Auscultation'] ?? null,
            "question_no_42_cardiac_auscultation" => $resultArray[0]['Question_No_42_Cardiac_Auscultation'] ?? null,
            "chest_comment" => $resultArray[0]['chest_comment'] ?? null,
            
            "question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen" => $resultArray[0]["Question_No_43_Did_you_observe_any_distension,_scars,_or_masses_on_the_child's_abdomen?"] ?? null,
            "question_no_44_any_history_of_abdominal_pain" => $resultArray[0]['Question_No_44_Any_history_of_abdominal_Pain'] ?? null,
            "any_history_of_abdominal_pain_specify" => $resultArray[0]['any_history_of_abdominal_pain_specify'] ?? null,
            "abdomen_comment" => $resultArray[0]['abdomen_comment'] ?? null,
            

            "question_no_45_did_you_observe_any_limitations_in_the_childs_range_of_joint_motion_during_your_examination" => $resultArray[0]["Question_No_45_Did_you_observe_any_limitations_in_the_child's_range_of_joint_motion_during_your_examination?"] ?? null,
            "specify_limitations_in_the_childs_range_of_joint_motion_during_your_examination" => $resultArray[0]["Specify_limitations_in_the_child's_range_of_joint_motion_during_your_examination?"] ?? null,
            "question_no_46_spinal_curvature_assessment_tick_positive_finding" => $resultArray[0]["Question_No_46_Spinal_curvature_assessment_(tick_positive_finding)"] ?? null,
            "question_no_47_side-to-side_curvature_in_the_spine_resembling" => $resultArray[0]["Question_No_47_side-to-side_curvature_in_the_spine_resembling"] ?? null,
            "question_no_48_adams_forward_bend_test" => $resultArray[0]['Question_No_48_Adams_forward_bend_test'] ?? null,
            "question_no_49_any_foot_or_toe_abnormalities" => $resultArray[0]['Question_No_49_Any_foot_or_toe_abnormalities'] ?? null,
            "musculoskeletal_comment" => $resultArray[0]['musculoskeletal_comment'] ?? null,
            
            "question_no_50_have_epi_immunization_card" => $resultArray[0]["Question_No_50_Have_EPI_immunization_card?"] ?? null,
            "BCG_1_dose" => $resultArray[0]["BCG_1_dose"] ?? null,
            "OPV_4_dose" => $resultArray[0]["OPV_4_dose"] ?? null,
            "Pentavalent_vaccine_DTP" => $resultArray[0]["Pentavalent_vaccine_(DTP+Hep B + Hib)_3_dose"] ?? null,
            "rota" => $resultArray[0]["rota"] ?? null,
            "measles" => $resultArray[0]["measles"] ?? null,
            "never_had_any_vaccination" => $resultArray[0]['never_had_any_vaccination'] ?? null,
            "reason_of_not_being_vaccinated" => $resultArray[0]['Reason_of_not_being_vaccinated'] ?? null,
            "vaccination_comment" => $resultArray[0]['vaccination_comment'] ?? null,
            "question_51_do_you_frequently_put_things_in_hisher_mouth_such_as_toys_jewelry_or_keys" => $resultArray[0]["Question_51_Do_you_Frequently_put_things_in_his/her_mouth_such_as_toys,_jewelry,_or_keys?"] ?? null,
            "question_52_does_your_child_eat_non_food_items_pica" => $resultArray[0]["Question_52_Does_your_child_eat_non_food_items_(pica)?"] ?? null,
            "question_53_do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead" => $resultArray[0]["Question_53_Do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead?"] ?? null,
            "question_54_do_you_frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead" => $resultArray[0]["Question_54_Do_you_frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead?"] ?? null,
            "lead_exposure_comment" => $resultArray[0]['lead_exposure_comment'] ?? null,
            "question_no_55_do_you_have_any_allergies" => $resultArray[0]["Question_No_55_Do_you_have_any_Allergies"] ?? null,
            "do_you_have_any_allergies_specify" => $resultArray[0]['Do_you_have_any_allergies_specify'] ?? null,
            "question_no_56_girls_above_8_years_old_ask" => $resultArray[0]['Question_No_56_Girls_above_8_years_old_ask:'] ?? null,
            "question_no_57_inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination" => $resultArray[0]["Question_No_57_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination"] ?? null,
            "questionno_58_any_menstrual_abnormality" => $resultArray[0]['QuestionNo_58_Any_menstrual_abnormality'] ?? null,
            "any_menstrual_abnormality_specify" => $resultArray[0]['Any_menstrual_abnormality_specify'] ?? null,
            "miscellaneous_comment" => $resultArray[0]['miscellaneous_comment'] ?? null,
            "question_no_59_how_often_do_you_experience_negative_or_intrusive_thoughts" => $resultArray[0]['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts?'] ?? null,
            "question_no_60_how_would_you_rate_your_overall_self_esteem_and_self_confidence" => $resultArray[0]['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence?'] ?? null,
            "question_no_61_how_would_you_describe_your_energy_levels_throughout_a_typical_day" => $resultArray[0]['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day?'] ?? null,
            "question_no_62_when_faced_with_challenges_what_are_your_typical_coping_mechanisms" => $resultArray[0]["Question_No_62_When_faced_with_challenges,_what_are_your_typical_coping_mechanisms?"] ?? null,
            "question_no_63_how_would_you_rate_the_quality_of_your_sleep_on_average" => $resultArray[0]['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average?'] ?? null,
            "question_no_64_how_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks" => $resultArray[0]['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks?'] ?? null,
            "question_no_65_how_would_you_describe_your_overall_mood_during_the_day" => $resultArray[0]['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day?'] ?? null,
            "question_no_66_how_would_you_describe_the_quality_of_your_relationships_with_family_members" => $resultArray[0]['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members?'] ?? null,
            "question_no_67_how_well_does_you_handle_challenges_and_solve_problems" => $resultArray[0]['Question_No_67_How_well_does_you_handle_challenges_and_solve_problems?'] ?? null,
            "question_no_68_how_many_hours_of_sleep_does_you_typically_get_on_a_school_night" => $resultArray[0]['Question_No_68_How_many_hours_of_sleep_does_you_typically_get_on_a_school_night?'] ?? null,
            "followup_required" => $resultArray[0]['followup_required'] ?? null,
            "referred_by" => $resultArray[0]['referred_by'] ?? null,
            "referred_to" => $resultArray[0]['referred_to'] ?? null,
            "PsychologistRefferedTo" => $resultArray[0]['PsychologistRefferedTo'] ?? null,
            "psychological_comment" => $resultArray[0]['psychological_comment'] ?? null,

            /****************************** Nutritionist ***********************************/

            "Question_No_60_How_would_you_describe_your_lifestyle" => $resultArray[0]['Question_No_60_How_would_you_describe_your_lifestyle'] ?? null,
            "bmi61" => $resultArray[0]['bmi61'] ?? null,
            "muac" => $resultArray[0]['muac'] ?? null,
            "Daily_Protien_requirement" => $resultArray[0]['Daily_Protien_requirement'] ?? null,
            "Daily_energy_requirement" => $resultArray[0]['Daily_energy_requirement'] ?? null,
            "Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day" => $resultArray[0]['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'] ?? null,
            "Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to" => $resultArray[0]['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'] ?? null,
            "addiction" => $resultArray[0]['addiction'] ?? null,
            "other_addiction" => $resultArray[0]['other_addiction'] ?? null,
            "food_allergies" => $resultArray[0]['food_allergies'] ?? null,
            "lifestyle" => $resultArray[0]['lifestyle'] ?? null,
            "meals" => $resultArray[0]['meals'] ?? null,
            "food_items" => $resultArray[0]['food_items'] ?? null,
            "fast_food" => $resultArray[0]['fast_food'] ?? null,
            "NutritionistComment" => $resultArray[0]['NutritionistComment'] ?? null,
            "DietaryAdviceComment" => $resultArray[0]['DietaryAdviceComment'] ?? null,
            "Follow_up_Required" => $resultArray[0]['Follow_up_Required'] ?? null,
            "Reason_for_Follow_up" => $resultArray[0]['Reason_for_Follow_up'] ?? null,
            // "followup_required" => $resultArray[0]['followup_required'] ?? null,
            "Follow_up_Date" => $resultArray[0]['Follow_up_Date'] ?? null,

            "refer_to" => $resultArray[0]['refer_to'] ?? null,

            "observation1" => $resultArray[0]['observation1'] ?? null,
            "observation2" => $resultArray[0]['observation2'] ?? null,
            "observation3" => $resultArray[0]['observation3'] ?? null,
            "observation4" => $resultArray[0]['observation4'] ?? null,
            "observation5" => $resultArray[0]['observation5'] ?? null,
            "observation6" => $resultArray[0]['observation6'] ?? null,
            "observation7" => $resultArray[0]['observation7'] ?? null,
            "observation8" => $resultArray[0]['observation8'] ?? null,
            "observation9" => $resultArray[0]['observation9'] ?? null,
            "observation10" => $resultArray[0]['observation10'] ?? null,
            "wasting_birth_to_5_girl" => $resultArray[0]['wasting_birth_to_5_girl'] ?? null,
            "wasting_birth_to_5_boy" => $resultArray[0]['wasting_birth_to_5_boy'] ?? null,
            "wasting_5_to_19_girl" => $resultArray[0]['wasting_5_to_19_girl'] ?? null,
            "wasting_5_to_19_boy" => $resultArray[0]['wasting_5_to_19_boy'] ?? null,
            "stunting_birth_to_2_girl" => $resultArray[0]['stunting_birth_to_2_girl'] ?? null,
            "stunting_birth_to_2_boy" => $resultArray[0]['stunting_birth_to_2_boy'] ?? null,
            "stunting_2_5_girl" => $resultArray[0]['stunting_2_5_girl'] ?? null,
            "stunting_2_5_boy" => $resultArray[0]['stunting_2_5_boy'] ?? null,
            "stunting_5_19_girl" => $resultArray[0]['stunting_5_19_girl'] ?? null,
            "stunting_5_19_boy" => $resultArray[0]['stunting_5_19_boy'] ?? null,
            "class" => $resultArray[0]['class'] ?? null,




        ];

        // dd($data['details']);

        // dd($resultArray[0]['followup_required']);
        $data['area'] = Area::get();
        $data['school'] = School::get();
        $data['city'] = City::get();


        return view('admin.ediform', $data);

    }


    public function create(Request $request)
    {
        $forms = new Forms();
        $forms->name = $request->name;
        $forms->guardianname = $request->guardianname;
        $forms->gender = $request->gender;
        $forms->age = $request->age;
        $forms->dob = $request->dob;
        $forms->phone = $request->phone;
        $forms->medical_condition = $request->medical_condition;
        $forms->blood_group = $request->blood_group;
        $forms->height = $request->height;
        $forms->weight = $request->weight;
        $forms->bmi = $request->bmi;
        $forms->bodytemp = $request->bodytemp;
        $forms->bodytempunit = $request->bodytempunit;
        $forms->pulse = $request->pulse;
        $forms->bloodpressure = $request->bloodpressure;
        $forms->noramal_posture_gait = $request->noramal_posture_gait;
        $forms->mentalstatus = $request->mentalstatus;
        $forms->jaundice = $request->jaundice;
        $forms->anemia = $request->anemia;
        $forms->clubbing = $request->clubbing;
        $forms->cyanosis = $request->cyanosis;
        $forms->skin = $request->skin;
        $forms->breath = $request->breath;
        $forms->feel = $request->feel;
        $forms->friends = $request->friends;
        $forms->Safe_and_Supported = $request->Safe_and_Supported;
        $forms->lonely = $request->lonely;
        $forms->talk_about = $request->talk_about;
        $forms->clean = $request->clean;
        $forms->Uniform_or_shoe = $request->Uniform_or_shoe;
        $forms->Lice_nits = $request->Lice_nits;
        $forms->hygiene_routines_practices = $request->hygiene_routines_practices;
        $forms->hair_and_scalp = $request->hair_and_scalp;
        $forms->hair_distribution = $request->hair_distribution;
        $forms->Snellens_chart = $request->Snellens_chart;
        $forms->ocular_alignment = $request->ocular_alignment;
        $forms->normal_eye_inspection = $request->normal_eye_inspection;
        $forms->normal_color_vision = $request->normal_color_vision;
        $forms->nystagmus = $request->nystagmus;
        $forms->ears_shape_and_position = $request->ears_shape_and_position;
        $forms->ear_examination = $request->ear_examination;
        $forms->hearing_test = $request->hearing_test;
        $forms->inasal_examinaton = $request->inasal_examinaton;
        $forms->patients_ability = $request->patients_ability;
        $forms->assess_gingiva = $request->assess_gingiva;
        $forms->are_there_dental_caries = $request->are_there_dental_caries;
        $forms->Check_gag_reflex = $request->Check_gag_reflex;
        $forms->tonsils = $request->tonsils;
        $forms->normal_speech_development = $request->normal_speech_development;
        $forms->any_neck_swelling = $request->any_neck_swelling;
        $forms->lymph_node = $request->lymph_node;
        $forms->lymph_node_specify = $request->lymph_node_specify;
        $forms->any_neck_swelling_specify = $request->any_neck_swelling_specify;
        $forms->any_visible_chest_deformity = $request->any_visible_chest_deformity;
        $forms->lung_auscultation = $request->lung_auscultation;
        $forms->cardiac_auscultation = $request->cardiac_auscultation;
        $forms->distention_scar_mass = $request->distention_scar_mass;
        $forms->any_history_of_abdominal_pain = $request->any_history_of_abdominal_pain;
        $forms->any_history_of_abdominal_pain_specify = $request->any_history_of_abdominal_pain_specify;
        $forms->limitations_range_motion = $request->limitations_range_motion;
        $forms->limitations_range_motion_specify = $request->limitations_range_motion_specify;
        $forms->spinal_curvature_assessment = $request->spinal_curvature_assessment;
        $forms->curvature_spine_resembling = $request->curvature_spine_resembling;
        $forms->adams_forward_bend_test = $request->adams_forward_bend_test;
        $forms->foot_or_toe_abnormalities = $request->foot_or_toe_abnormalities;
        $forms->immunization_card = $request->immunization_card;
        $forms->being_vaccinated = $request->being_vaccinated;
        $forms->BCG_1_dose = $request->BCG_1_dose;
        $forms->OPV_4_dose = $request->OPV_4_dose;
        $forms->Pentavalent = $request->Pentavalent;
        $forms->rota = $request->rota;
        $forms->measles = $request->measles;
        $forms->never_had_any_vaccination = $request->never_had_any_vaccination;
        $forms->toys_jewelry_or_keys = $request->toys_jewelry_or_keys;
        $forms->eat_non_food_items = $request->eat_non_food_items;
        $forms->job_involves = $request->job_involves;
        $forms->hobby_involves = $request->hobby_involves;
        $forms->do_you_have_any_allergies = $request->do_you_have_any_allergies;
        $forms->do_you_have_any_allergies_specify = $request->do_you_have_any_allergies_specify;
        $forms->menarche_age = $request->menarche_age;
        $forms->discomfort_during_urination = $request->discomfort_during_urination;
        $forms->any_menstrual_abnormality = $request->any_menstrual_abnormality;
        $forms->any_menstrual_abnormality_specify = $request->any_menstrual_abnormality_specify;

        return $forms->save();
    }





    public function PostData(Request $request)
    {
        // dd($request->all());
        $formData = $request->input('formData');
        $name = null;
        $guardianName = null;
        $gender = null;
        $school = null;
        $city = null;
        $area = null;
        $dob = null;
        $age = null;
        $phone = null;
        $medicalCondition = null;
        $gr = null;
        $address = null;
        $blood_group = null;
        $enter_by = Auth::guard('admin')->user()->id;
        $duration = null;
        $bmiresult = null;
        $systolicresult = null;
        $diastolic = null;

        // Iterate through the formData array to extract values
        foreach ($formData as $field) {
            if ($field['name'] === 'name') {
                $name = $field['value'];
            } elseif ($field['name'] === 'guardianname') {
                $guardianName = $field['value'];
            } elseif ($field['name'] === 'gender') {
                $gender = $field['value'];
            } elseif ($field['name'] === 'school') {
                $school = $field['value'];
            } elseif ($field['name'] === 'city') {
                $city = $field['value'];
            } elseif ($field['name'] === 'area') {
                $area = $field['value'];
            } elseif ($field['name'] === 'dob') {
                $dob = $field['value'];
            } elseif ($field['name'] === 'age') {
                $age = $field['value'];
            } elseif ($field['name'] === 'Emergency_Contact_Number') {
                $phone = $field['value'];
            } elseif ($field['name'] === 'Gr_Number') {


                $gr = $field['value'];


                // Check if 'Gr_Number' is present and numeric
                if ($gr === null) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Gr Number is required.'
                    ]);
                }

                if (!is_numeric($gr)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Gr Number must be numeric.'
                    ]);
                }



            } elseif ($field['name'] === 'Any_Known_Medical_Condition') {
                $medicalCondition = $field['value'];
            } elseif ($field['name'] === 'address') {
                $address = $field['value'];
            } elseif ($field['name'] === 'blood_group') {
                $blood_group = $field['value'];
            } elseif ($field['name'] === 'duration') {
                $duration = $field['value'];
            } elseif ($field['name'] === 'bmiresult') {
                $bmiresult = $field['value'];
            } elseif ($field['name'] === 'systolicresult') {
                $systolicresult = $field['value'];
            } elseif ($field['name'] === 'diastolicresult') {
                $diastolic = $field['value'];
            } elseif ($field['name'] === 'Follow_up_Required') {
                $Follow_up_Required = $field['value'];
            } elseif ($field['name'] === 'Follow_up_Date') {
                $Follow_up_Date = $field['value'];
            }

        }


        // echo "refer_tos ". $refer_tos;exit;


        $exists = form_entry::where('grno', $gr)
            ->where('school', $school)
            ->where('name', $name)
            ->exists();

        if (!$exists) {

            $form = new form_entry();
            $form->name = $name;
            $form->lname = $guardianName;
            $form->gender = $gender;
            $form->school = $school;
            $form->city = $city;
            $form->area = $area;
            $form->dob = $dob;
            $form->age = $age;
            $form->phone = $phone;
            $form->medical_condition = $medicalCondition;
            $form->grno = $gr;
            $form->address = $address;
            $form->blood_group = $blood_group;
            $form->enterby = $enter_by;
            $form->bmiresult = $bmiresult;
            $form->systolicresult = $systolicresult;
            $form->diastolic = $diastolic;
            $form->duration = gmdate('i:s', $duration);




            /*
            
            0= if Follow-up Required yes and Follow-up Date blank,
            1= if Follow-up Required yes and Follow-up Date not blank,
            2=if Follow-up Required no 

            */


            if ($Follow_up_Required == "Yes" && empty($Follow_up_Date)) {

                $form->Follow_up_Date_flag = 0;

            } else if ($Follow_up_Required == "Yes" && !empty($Follow_up_Date)) {

                $form->Follow_up_Date_flag = 1;

            } else if ($Follow_up_Required == "No") {
                $form->Follow_up_Date_flag = 2;

            } else {
                $form->Follow_up_Date_flag = 2;

            }



            $form->save();
            $storedRecordId = $form->id;

            // Save FormData models
            foreach ($formData as $field) {
                if ($field['name'] !== '_token') {

                    $formDataModel = new FormData();
                    $formDataModel->entry_id = $storedRecordId;
                    $formDataModel->key = $field['name'];
                    $formDataModel->value = $field['value'] ?? null;

                    $formDataModel->save();



                    // Create Calendar Event if Follow_up_Required is Yes
                    if ($field['name'] == "Follow_up_Required" && $field['value'] == "Yes" || $field['name'] == "refer_to") {
                        // Extract additional fields
                        $grNumber = null;
                        $followUpDate = null;
                        $reasonForFollowUp = null;


                        foreach ($formData as $item) {
                            switch ($item['name']) {
                                case 'Gr_Number':
                                    $grNumber = $item['value'];
                                    break;
                                case 'Follow_up_Date':
                                    $followUpDate = $item['value'];
                                    break;
                                case 'Reason_for_Follow_up':
                                    $reasonForFollowUp = $item['value'];
                                    break;
                                /*case 'refer_to':
                                    $refer_to = $item['value'];
                                    break;*/
                            }
                        }

                        // Create and save Calendar Event


                        if ($field['name'] == "refer_to") {

                            $refer_to = $field['value'];

                            $CalendarEvents = new CalendarEvents();
                            $CalendarEvents->startDate = $followUpDate;
                            $CalendarEvents->endDate = $followUpDate;

                            $referrals = [
                                1 => ['color' => 'blue', 'description' => 'Psychologist', 'title' => 'Psychologist'],
                                2 => ['color' => 'green', 'description' => 'Nutritionist', 'title' => 'Nutritionist'],
                                3 => ['color' => 'red', 'description' => 'Physician', 'title' => 'Physician'],
                                4 => ['color' => 'red', 'description' => 'External Specialists', 'title' => 'External Specialists'],
                                5 => ['color' => 'red', 'description' => 'General Physician (school health physician )', 'title' => 'General Physician (school health physician )']
                            ];

                            if (isset($referrals[$refer_to])) {

                                $CalendarEvents->color = $referrals[$refer_to]['color'];
                                $CalendarEvents->description = $referrals[$refer_to]['description'];
                                $CalendarEvents->title = $referrals[$refer_to]['title'];
                                $CalendarEvents->slug = Str::slug($referrals[$refer_to]['title'] . '-' . $grNumber);

                            } else {
                                $CalendarEvents->color = 'gray';
                                $CalendarEvents->description = $reasonForFollowUp;
                            }


                            $CalendarEvents->created_by = Auth::user()->id;
                            $CalendarEvents->event_type = 2;
                            $CalendarEvents->event_id = $storedRecordId;
                            $CalendarEvents->redirect_link = Route('Medical_Detail') . '/' . trim($storedRecordId);
                            $CalendarEvents->save();


                        }


                        // Set color based on the refer_to value
                        /*switch ($refer_to) {
                            case 1: // Psychologist
                                $CalendarEvents->color = 'blue';
                                $CalendarEvents->description = "Psychologist";

                                $CalendarEvents->title = 'Psychologist';
                                $CalendarEvents->slug = Str::slug('Psychologist' . '-' . $grNumber);

                                break;
                            case 2: // Nutritionist
                                $CalendarEvents->color = 'green';
                                $CalendarEvents->description = "Nutritionist";

                                $CalendarEvents->title = 'Nutritionist';
                                $CalendarEvents->slug = Str::slug('Nutritionist' . '-' . $grNumber);
                                break;
                            case 3: // Physician
                                $CalendarEvents->color = 'red';
                                $CalendarEvents->description = "Physician";

                                $CalendarEvents->title = 'Physician';
                                $CalendarEvents->slug = Str::slug('Physician' . '-' . $grNumber);

                                break;
                            default:
                                $CalendarEvents->color = 'gray'; // Default color for other or unknown refer_to values
                                $CalendarEvents->description = $reasonForFollowUp;

                                break;
                        }*/




                    }

                }
            }

            return response()->json([
                'status' => true,
                'message' => 'Enrollment has been submitted successfully!'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Enrollment already exists!'
            ]);
        }
    }

    


    public function EditPostData(Request $request)
    {
        // dd($request->all());
        $formData = $request->input('formData');
        // dd($request->all());
        $id = null;
        $name = null;
        $guardianName = null;
        $gender = null;
        $school = null;
        $city = null;
        $area = null;
        $dob = null;
        $age = null;
        $phone = null;
        $medicalCondition = null;
        $gr = null;
        $address = null;
        $blood_group = null;
        $enter_by = Auth::guard('admin')->user()->id;
        $duration = null;
        $bmiresult = null;
        $systolicresult = null;
        $diastolic = null;


        // Iterate through the formData array to extract values
        foreach ($formData as $field) {

            if ($field['name'] === 'id') {
                $id = $field['value'];
            } elseif ($field['name'] === 'name') {
                $name = $field['value'];
            } elseif ($field['name'] === 'guardianname') {
                $guardianName = $field['value'];
            } elseif ($field['name'] === 'gender') {
                $gender = $field['value'];
            } elseif ($field['name'] === 'school') {
                $school = $field['value'];
            } elseif ($field['name'] === 'city') {
                $city = $field['value'];
            } elseif ($field['name'] === 'area') {
                $area = $field['value'];
            } elseif ($field['name'] === 'dob') {
                $dob = $field['value'];
            } elseif ($field['name'] === 'age') {
                $age = $field['value'];
            } elseif ($field['name'] === 'Emergency_Contact_Number') {
                $phone = $field['value'];
            } elseif ($field['name'] === 'Gr_Number') {
                $gr = $field['value'];

                // Check if 'Gr_Number' is present and numeric
                if ($gr === null) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Gr Number is required.'
                    ]);
                }

                if (!is_numeric($gr)) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Gr Number must be numeric.'
                    ]);
                }


            } elseif ($field['name'] === 'Any_Known_Medical_Condition') {
                $medicalCondition = $field['value'];
            } elseif ($field['name'] === 'address') {
                $address = $field['value'];
            } elseif ($field['name'] === 'blood_group') {
                $blood_group = $field['value'];
            } elseif ($field['name'] === 'duration') {
                $duration = $field['value'];
            } elseif ($field['name'] === 'bmiresult') {
                $bmiresult = $field['value'];
            } elseif ($field['name'] === 'Follow_up_Required') {
                $Follow_up_Required = $field['value'];
            } elseif ($field['name'] === 'Follow_up_Date') {
                $Follow_up_Date = $field['value'];
            }

        }

        $res = form_entry::where('grno', $gr)
            ->where('school', $school)
            ->exists();

        $form = form_entry::find($id);
        $form->name = $name;
        $form->lname = $guardianName;
        $form->gender = $gender;
        $form->school = $school;
        $form->city = $city;
        $form->area = $area;
        $form->dob = $dob;
        $form->age = $age;
        $form->phone = $phone;
        $form->medical_condition = $medicalCondition;
        $form->grno = $gr;
        $form->address = $address;
        $form->blood_group = $blood_group;
        $form->enterby = $enter_by;
        $form->duration = gmdate('i:s', $duration);
        $form->bmiresult = $bmiresult;


        /*
            
            0= if Follow-up Required yes and Follow-up Date blank,
            1= if Follow-up Required yes and Follow-up Date not blank,
            2=if Follow-up Required no 

            */


        if ($Follow_up_Required == "Yes" && empty($Follow_up_Date)) {

            $form->Follow_up_Date_flag = 0;

        } else if ($Follow_up_Required == "Yes" && !empty($Follow_up_Date)) {

            $form->Follow_up_Date_flag = 1;

        } else if ($Follow_up_Required == "No") {
            $form->Follow_up_Date_flag = 2;

        } else {
            $form->Follow_up_Date_flag = 2;

        }


        $form->save();
        $storedRecordId = $form->id;



        // FormData::where('entry_id', $storedRecordId)->where('key', 'refer_to')->update(array(
        //     'value'=> null
        // ));

        FormData::where('entry_id', $storedRecordId)->where('key', 'refer_to')->delete();


        CalendarEvents::where('event_id', $storedRecordId)->where('event_type', 2)->update(array(
            'deleted' => 1
        ));

        foreach ($formData as $field) {
            if ($field['name'] !== '_token' && $field['name'] !== 'id') {


                if ($field['name'] != "refer_to") {
                    FormData::updateOrInsert(['entry_id' => $id, 'key' => $field['name']], ['value' => $field['value'] ?? null]);

                }



                // Create Calendar Event if Follow_up_Required is Yes
                if (($field['name'] == "Follow_up_Required" && $field['value'] == "Yes") || $field['name'] == "refer_to") {

                    // Extract additional fields
                    $grNumber = null;
                    $followUpDate = null;
                    $reasonForFollowUp = null;
                    // $refer_to = null;

                    foreach ($formData as $item) {
                        switch ($item['name']) {
                            case 'Gr_Number':
                                $grNumber = $item['value'];
                                break;
                            case 'Follow_up_Date':
                                $followUpDate = $item['value'];
                                break;
                            case 'Reason_for_Follow_up':
                                $reasonForFollowUp = $item['value'];
                                break;
                            // case 'refer_to':
                            //     $refer_to = $item['value'];
                            //     break;
                        }
                    }


                    if ($field['name'] == "refer_to") {

                        $formDataModel = new FormData();
                        $formDataModel->entry_id = $storedRecordId;
                        $formDataModel->key = $field['name'];
                        $formDataModel->value = $field['value'] ?? null;
                        $formDataModel->save();


                        $refer_to = $field['value'];


                        // $CalendarEvents = CalendarEvents::where('event_id', $storedRecordId)->where('event_type', 2)->where('deleted', 0)->first();
                        // if (empty($CalendarEvents)) {
                        $CalendarEvents = new CalendarEvents();

                        // }
                        $CalendarEvents->startDate = $followUpDate;
                        $CalendarEvents->endDate = $followUpDate;



                        $referrals = [
                            1 => ['color' => 'blue', 'description' => 'Psychologist', 'title' => 'Psychologist'],
                            2 => ['color' => 'green', 'description' => 'Nutritionist', 'title' => 'Nutritionist'],
                            3 => ['color' => 'red', 'description' => 'Physician', 'title' => 'Physician'],
                            4 => ['color' => 'red', 'description' => 'External Specialists', 'title' => 'External Specialists'],
                            5 => ['color' => 'red', 'description' => 'General Physician (school health physician )', 'title' => 'General Physician (school health physician )']
                        ];


                        if (isset($referrals[$refer_to])) {

                            $CalendarEvents->color = $referrals[$refer_to]['color'];
                            $CalendarEvents->description = $referrals[$refer_to]['description'];
                            $CalendarEvents->title = $referrals[$refer_to]['title'];
                            $CalendarEvents->slug = Str::slug($referrals[$refer_to]['title'] . '-' . $grNumber);

                        } else {
                            $CalendarEvents->color = 'gray';
                            $CalendarEvents->description = $reasonForFollowUp;
                        }



                        $CalendarEvents->created_by = Auth::user()->id;
                        $CalendarEvents->event_type = 2;
                        $CalendarEvents->event_id = $storedRecordId;
                        $CalendarEvents->redirect_link = Route('Medical_Detail') . '/' . trim($storedRecordId);
                        $CalendarEvents->save();


                    }


                    /*
                    // Create and save Calendar Event
                    $CalendarEvents = CalendarEvents::where('event_id', $storedRecordId)->where('event_type', 2)->first();
                    if (empty($CalendarEvents)) {
                        $CalendarEvents = new CalendarEvents();

                    }
                    $CalendarEvents->title = 'Presenting Complain';
                    $CalendarEvents->slug = Str::slug('Presenting Complain' . '-' . $grNumber);
                    $CalendarEvents->startDate = $followUpDate;
                    $CalendarEvents->endDate = $followUpDate;

                    // Set color based on the refer_to value
                    switch ($refer_to) {
                        case 1: // Psychologist
                            $CalendarEvents->color = 'blue';
                            $CalendarEvents->description = "Psychologist";

                            break;
                        case 2: // Nutritionist
                            $CalendarEvents->color = 'green';
                            $CalendarEvents->description = "Nutritionist";

                            break;
                        case 3: // Physician
                            $CalendarEvents->color = 'red';
                            $CalendarEvents->description = "Physician";

                            break;
                        default:
                            $CalendarEvents->color = 'gray'; // Default color for other or unknown refer_to values
                            $CalendarEvents->description = $reasonForFollowUp;

                            break;
                    }


                    $CalendarEvents->created_by = Auth::user()->id;
                    $CalendarEvents->event_type = 2;
                    $CalendarEvents->event_id = $storedRecordId;

                    $CalendarEvents->redirect_link = Route('Medical_Detail') . '/' . trim($storedRecordId);
                    $CalendarEvents->save();*/
                }

            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Enrollment has been submitted successfully!'
        ]);

    }






    /* FROM ENTRY DATA */

    public function getformData()
    {
        // Retrieve the schoolId from the request
        $schoolId = request()->query('schoolId');

        // return view('admin.form_entry');
        $User = User::get();

        $query = DB::table('form_entries')
            ->select(
                'form_entries.id',
                'form_entries.name',
                'form_entries.lname',
                'form_entries.psychiatrist_id',
                'form_entries.nutritionist_id',
                'form_entries.doc_id',
                'form_entries.gender',
                'schools.school_name as school',
                'cities.name as city',
                'form_entries.age',
                'form_entries.phone',
                'form_entries.grno',
                'users.fullname as enterby',
                'form_entries.duration',
                'form_entries.created_at'
            )
            ->join('schools', 'form_entries.school', '=', 'schools.id')
            ->join('cities', 'cities.id', '=', 'form_entries.city')
            ->join('users', 'users.id', '=', 'form_entries.enterby')
            // ->join('areas', 'areas.id', '=', 'form_entries.area')
        ;


        if (!empty($schoolId)) {
            $query->where('schools.id', '=', $schoolId);
        }


        $form = $query->orderBy('form_entries.id', 'desc')->get();




        return view('admin.getData', compact('form', 'User'));
    }

    /* getformData1 */
    public function getformData1()
    {
        return view('admin.getData1');
    }

    /* getformData1 */



    public function storeFollowUpDate(Request $request)
    {
        $request->validate([
            'follow_up_date' => 'required',
            'entry_id' => 'required', // Ensure entry_id is provided
        ]);

        $followUpDate = $request->input('follow_up_date');
        $entryId = $request->input('entry_id');
        $gr_number = $request->input('gr_number');
        $Reason_for_Follow_up = $request->input('Reason_for_Follow_up');

        if($entryId > 5540){
            CalendarEvents::where('event_id', $entryId)->where('event_type', 2)->update(array(
                'deleted' => 1
            ));
            
            
            $FormData = FormData::where('entry_id', $entryId)->where('key', 'refer_to[]')->get()->toArray();
            // dd($FormData);
                        if (!empty($FormData)) {
                                $CalendarEvents = new CalendarEvents();
                                $CalendarEvents->startDate = $followUpDate;
                                $CalendarEvents->endDate = $followUpDate;
                                    $CalendarEvents->color = 'green';
                                    $CalendarEvents->description = 'Nutritionist';
                                    $CalendarEvents->title = 'Nutritionist';
                                    $CalendarEvents->slug = Str::slug('Nutritionist' . '-' . $gr_number);
                                $CalendarEvents->created_by = Auth::user()->id;
                                $CalendarEvents->event_type = 2;
                                $CalendarEvents->event_id = $entryId;
                                $CalendarEvents->redirect_link = Route('Medical_Detail') . '/' . trim($entryId);
                                $CalendarEvents->save();
                            FormData::updateOrInsert(['entry_id' => $entryId, 'key' => 'Follow_up_Date'], ['value' => $followUpDate ?? null]);
                            return response()->json(['message' => 'Follow-up date and calendar event updated successfully.']);
                        } else {
                            return response()->json(['message' => 'No calendar event found for this entry.'], 404);
                        }
                        }else{
                        CalendarEvents::where('event_id', $entryId)->where('event_type', 2)->update(array(
                            'deleted' => 1
                        ));
                        $FormData = FormData::where('entry_id', $entryId)->where('key', 'refer_to')->get()->toArray();
                        if (!empty($FormData)) {
                            foreach ($FormData as $key => $value) {
                                $CalendarEvents = new CalendarEvents();
                                $CalendarEvents->startDate = $followUpDate;
                                $CalendarEvents->endDate = $followUpDate;
                                $refer_to = $value['value'];
                                $referrals = [
                                    1 => ['color' => 'blue', 'description' => 'Psychologist', 'title' => 'Psychologist'],
                                    2 => ['color' => 'green', 'description' => 'Nutritionist', 'title' => 'Nutritionist'],
                                    3 => ['color' => 'red', 'description' => 'Physician', 'title' => 'Physician'],
                                    4 => ['color' => 'red', 'description' => 'External Specialists', 'title' => 'External Specialists'],
                                    5 => ['color' => 'red', 'description' => 'General Physician (school health physician )', 'title' => 'General Physician (school health physician )']
                                ];
                                if (isset($referrals[$refer_to])) {
                                    $CalendarEvents->color = $referrals[$refer_to]['color'];
                                    $CalendarEvents->description = $referrals[$refer_to]['description'];
                                    $CalendarEvents->title = $referrals[$refer_to]['title'];
                                    $CalendarEvents->slug = Str::slug($referrals[$refer_to]['title'] . '-' . $gr_number);
                                } else {
                                    $CalendarEvents->color = 'gray';
                                    $CalendarEvents->description = $Reason_for_Follow_up;
                                }
                                $CalendarEvents->created_by = Auth::user()->id;
                                $CalendarEvents->event_type = 2;
                                $CalendarEvents->event_id = $entryId;
                                $CalendarEvents->redirect_link = Route('Medical_Detail') . '/' . trim($entryId);
                                $CalendarEvents->save();
                            }
                            FormData::updateOrInsert(['entry_id' => $entryId, 'key' => 'Follow_up_Date'], ['value' => $followUpDate ?? null]);
                            return response()->json(['message' => 'Follow-up date and calendar event updated successfully.']);
                        } else {
                            return response()->json(['message' => 'No calendar event found for this entry.'], 404);
                        }
       }

    }

                public function phycologist (Request $request){
                    $followUpDate = $request->input('follow_up_date');
                    $entryId = $request->input('entry_id');
                    $gr_number = $request->input('gr_number');
                    $Reason_for_Follow_up = $request->input('Reason_for_Follow_up');
                    if($entryId > 5540){
                        CalendarEvents::where('event_id', $entryId)->where('event_type', 2)->update(array(
                            'deleted' => 1
                        )); 
                        $FormData = FormData::where('entry_id', $entryId)->where('key', 'refer_to[]')->get()->toArray();
                                    if (!empty($FormData)) {
                                            $CalendarEvents = new CalendarEvents();
                                            $CalendarEvents->startDate = $followUpDate;
                                            $CalendarEvents->endDate = $followUpDate;
                                                $CalendarEvents->color = 'blue';
                                                $CalendarEvents->description = 'Psychologist';
                                                $CalendarEvents->title = 'Psychologist';
                                                $CalendarEvents->slug = Str::slug('Psychologist' . '-' . $gr_number);
                                            $CalendarEvents->created_by = Auth::user()->id;
                                            $CalendarEvents->event_type = 2;
                                            $CalendarEvents->event_id = $entryId;
                                            $CalendarEvents->redirect_link = Route('Medical_Detail') . '/' . trim($entryId);
                                            $CalendarEvents->save();
                                        FormData::updateOrInsert(['entry_id' => $entryId, 'key' => 'Physician_Follow_up_Date'], ['value' => $followUpDate ?? null]);
                                        return response()->json(['message' => 'Follow-up date and calendar event updated successfully.']);
                                    } else {
                                        return response()->json(['message' => 'No calendar event found for this entry.'], 404);
                                    }
                }
            }
            public function External (Request $request){
                // dd($request->all());
                $followUpDate = $request->input('follow_up_date');
                $entryId = $request->input('entry_id');
                $gr_number = $request->input('gr_number');
                $Reason_for_Follow_up = $request->input('Reason_for_Follow_up');
                if($entryId > 5540){
                    CalendarEvents::where('event_id', $entryId)->where('event_type', 2)->update(array(
                        'deleted' => 1
                    )); 
                    $FormData = FormData::where('entry_id', $entryId)->where('key', 'refer_to[]')->get()->toArray();
                                if (!empty($FormData)) {
                                        $CalendarEvents = new CalendarEvents();
                                        $CalendarEvents->startDate = $followUpDate;
                                        $CalendarEvents->endDate = $followUpDate;
                                            $CalendarEvents->color = 'red';
                                            $CalendarEvents->description = 'External Specialists';
                                            $CalendarEvents->title = 'External Specialists';
                                            $CalendarEvents->slug = Str::slug('External Specialists' . '-' . $gr_number);
                                        $CalendarEvents->created_by = Auth::user()->id;
                                        $CalendarEvents->event_type = 2;
                                        $CalendarEvents->event_id = $entryId;
                                        $CalendarEvents->redirect_link = Route('Medical_Detail') . '/' . trim($entryId);
                                        $CalendarEvents->save();
                                    FormData::updateOrInsert(['entry_id' => $entryId, 'key' => 'externalspecialist_Follow_up_Date'], ['value' => $followUpDate ?? null]);
                                    return response()->json(['message' => 'Follow-up date and calendar event updated successfully.']);
                                } else {
                                    return response()->json(['message' => 'No calendar event found for this entry.'], 404);
                                }
            }
        }
        public function generalphysician (Request $request){
            // dd($request->all());
            $followUpDate = $request->input('follow_up_date');
            $entryId = $request->input('entry_id');
            $gr_number = $request->input('gr_number');
            $Reason_for_Follow_up = $request->input('Reason_for_Follow_up');
            if($entryId > 5540){
                CalendarEvents::where('event_id', $entryId)->where('event_type', 2)->update(array(
                    'deleted' => 1
                )); 
                $FormData = FormData::where('entry_id', $entryId)->where('key', 'refer_to[]')->get()->toArray();
                            if (!empty($FormData)) {
                                    $CalendarEvents = new CalendarEvents();
                                    $CalendarEvents->startDate = $followUpDate;
                                    $CalendarEvents->endDate = $followUpDate;
                                        $CalendarEvents->color = 'red';
                                        $CalendarEvents->description = 'General Physician (school health physician )';
                                        $CalendarEvents->title = 'General Physician (school health physician )';
                                        $CalendarEvents->slug = Str::slug('General Physician (school health physician )' . '-' . $gr_number);
                                    $CalendarEvents->created_by = Auth::user()->id;
                                    $CalendarEvents->event_type = 2;
                                    $CalendarEvents->event_id = $entryId;
                                    $CalendarEvents->redirect_link = Route('Medical_Detail') . '/' . trim($entryId);
                                    $CalendarEvents->save();
                                FormData::updateOrInsert(['entry_id' => $entryId, 'key' => 'generalphysician_Follow_up_Date'], ['value' => $followUpDate ?? null]);
                                return response()->json(['message' => 'Follow-up date and calendar event updated successfully.']);
                            } else {
                                return response()->json(['message' => 'No calendar event found for this entry.'], 404);
                            }
        }
    }
    public function getformData1List(Request $request)
    {

        // dd($request->all());


         $UserID = auth()->guard('admin')->user()->id;
      $UserRole = auth()->guard('admin')->user()->role;
      $UserSchoolIds = json_decode(auth()->guard('admin')->user()->school_id, true) ?? []; // Default to empty array if null

      $query = DB::table('form_entries')
         ->select(
            'form_entries.id',
            'form_entries.name',
            'form_entries.lname',
            'form_entries.psychiatrist_id',
            'form_entries.nutritionist_id',
            'form_entries.doc_id',
            'form_entries.gender',
            'schools.school_name as school',
            'cities.name as city',
            'form_entries.age',
            'form_entries.phone',
            'form_entries.grno',
            'users.fullname as enterby',
            'form_entries.duration',
            'form_entries.created_at',
            // 'form_entries.Follow_up_Date_flag',

            DB::raw('COALESCE(docs.fullname, "N/A") as doctor_name'),
            DB::raw('COALESCE(psychologists.fullname, "N/A") as psychologist_name'),
            DB::raw('COALESCE(nutritionists.fullname, "N/A") as nutritionist_name'),
            DB::raw('CONCAT(schools.school_name, IF(users.fullname IS NOT NULL AND users.fullname != "", CONCAT(" - ", users.fullname), "")) as school_enterby')
         )
         ->join('schools', 'form_entries.school', '=', 'schools.id')
         ->join('cities', 'cities.id', '=', 'form_entries.city')
         ->join('users', 'users.id', '=', 'form_entries.enterby')
         ->leftJoin('users as docs', 'form_entries.doc_id', '=', 'docs.id')
         ->leftJoin('users as psychologists', 'form_entries.psychiatrist_id', '=', 'psychologists.id')
         ->leftJoin('users as nutritionists', 'form_entries.nutritionist_id', '=', 'nutritionists.id');


      // Apply filtering based on schoolId
      if ($request->has('schoolId') && !empty($request->input('schoolId'))) {
         $query->where('schools.id', '=', $request->input('schoolId'));
      }
          $columns = $request->input('columns', []);
    foreach ($columns as $col) {
        if ($col['data'] === 'mrr' && !empty($col['search']['value'])) {
            // Remove 'BICP-' prefix if user searches with it
            $searchValue = str_replace('BICP-', '', $col['search']['value']);
            $query->where('form_entries.id', 'like', '%' . $searchValue . '%');
        }
        // You can add similar logic for other columns if needed
    }
      // Apply filtering based on user role and school_id
      if ($UserRole === 3) {
         $query->whereIn('form_entries.school', $UserSchoolIds);
      }
      if ($UserRole === 2) {
        $query->whereIn('form_entries.school', $UserSchoolIds);
      }

    

      // $query->where('form_entries.screeningFormId', 0);


      // Apply ordering by 'id' in descending order
      $query->orderBy('form_entries.id', 'desc');

    
      // dd($query->toSql());
      // dd($query->toSql(), $query->getBindings());

          return DataTables::of($query)
         ->editColumn('created_at', function ($row) {
            return $row->created_at ? Carbon::parse($row->created_at)->format('Y-m-d H:i:s') : 'N/A';
         })
         ->addColumn('name', function ($row) {
            // return '<a class="link" href="' . route('GeneralInfo', $row->id) . '">' . $row->name . '</a>';
            return '<a class="link" href="' . route('Medical_Detail', $row->id) . '">' . $row->name . '</a>';
         })
         ->addColumn('mrr', function ($row) {
                     // return '<a class="link" href="' . route('GeneralInfo', $row->id) . '">' . $row->name . '</a>';
                     return 'BICP-' . $row->id;
                  })
         /*->addColumn('Follow_up_Date_flag', function ($row) {

             $Follow_up_Date_flag = $row->Follow_up_Date_flag;

             if ($Follow_up_Date_flag == 0) {
                 $Follow_up_Date_flag = "Un Follow";

             } else if ($Follow_up_Date_flag == 1) {
                 $Follow_up_Date_flag = "Follow";

             } else {
                 $Follow_up_Date_flag = "N/A";

             }

             return $Follow_up_Date_flag;
         })*/

         // ->addColumn('Follow_up_Date_flag', function ($row) {

         //    /*
        
         //    0= if Follow-up Required yes and Follow-up Date blank,
         //    1= if Follow-up Required yes and Follow-up Date not blank,
         //    2=if Follow-up Required no 

         //    */


         //    $Follow_up_Date_flag = $row->Follow_up_Date_flag;
         //    $label = ""; // Initialize the variable to store the final HTML output
   
         //    if ($Follow_up_Date_flag === 0) {
         //       $label = "<span style='background-color: red; color: white; padding: 5px; border-radius: 3px;'>Un Schedule</span>";

         //    } elseif ($Follow_up_Date_flag == 1) {
         //       $label = "<span style='background-color: green; color: white; padding: 5px; border-radius: 3px;'>Schedule</span>";

         //    } elseif ($Follow_up_Date_flag == 2) {
         //       $label = "<span style='background-color: green; color: white; padding: 5px; border-radius: 3px;'>No</span>";

         //    } elseif ($Follow_up_Date_flag == 3) {
         //       $label = "<span style='background-color: green; color: white; padding: 5px; border-radius: 3px;'>Here</span>";

         //    } elseif ($Follow_up_Date_flag == null) {
         //       $label = "<span style='background-color: gray; color: white; padding: 5px; border-radius: 3px;'>N/A</span>";

         //    } else {
         //       $label = "<span style='background-color: gray; color: white; padding: 5px; border-radius: 3px;'>N/A</span>";
         //       // $label = $Follow_up_Date_flag;
         //    }

         //    return $label;

         // })



         ->addColumn('action', function ($row) {
            $user = auth()->guard('admin')->user();
            $html = '';


            if ($row->id >= 14 && $user->role == '1') {

               // $html .= '<a  href-deleteRecord="' . route('DeleteRecord') . '/' . $row->id . '" href="' . route('edit_student', ['id' => $row->id]) . '"><i class="fa fa-edit iic"></i></a>';
               $html .= '<a  href-deleteRecord="' . route('DeleteRecord') . '/' . $row->id . '" href="' . route('UpdateScreening', ['id' => $row->id]) . '"><i class="fa fa-edit iic"></i></a>';

            } elseif ($row->id >= 14 && $user->role == '2' && $user->id == auth()->id()) {

               // $html .= '<a href-deleteRecord="' . route(name: 'DeleteRecord') . '/' . $row->id . '" href="' . route('edit_student', ['id' => $row->id]) . '"><i class="fa fa-edit iic"></i></a>';
               $html .= '<a href-deleteRecord="' . route(name: 'DeleteRecord') . '/' . $row->id . '" href="' . route('UpdateScreening', ['id' => $row->id]) . '"><i class="fa fa-edit iic"></i></a>';

            } else {
               $html .= '<i class="fa fa-ban iic" aria-hidden="true"></i>';
            }

            // $html .= '&nbsp;&nbsp;<a  href-deleteRecord="' . route('DeleteRecord') . '/' . $row->id . '" href="' . route('DeleteRecord', ['id' => $row->id]) . '"><i class="fa fa-trash iic"></i></a>';
            // $html .= '&nbsp;&nbsp;<a href="' . route('DeleteRecord', ['id' => $row->id]) . '" onclick="return confirm(\'Are you sure you want to delete this record?\');"><i class="fa fa-trash iic"></i></a>';


            return $html;
         })
         ->rawColumns(['name', 'action', 'Follow_up_Date_flag'])
         ->make(true);
    }

    public function deleteRecord($id)
    {



        $form_entry_exist = form_entry::where('id', $id)->first();



        if (!$form_entry_exist) {
            $message = "Record not exist";
            Session::flash("error_message", $message);
            return redirect()->back();
        }

        if ($id != NULL && $id > 0) {
            form_entry::where('id', $id)->delete();
            FormData::where('entry_id', $id)->delete();

            CalendarEvents::where('event_id', $id)->where('event_type', 2)->update(array(
                'deleted' => 1
            ));

            $message = "Record Deleted";
            Session::flash("success_message", $message);
            return redirect()->back();
        } else {



            $message = "Some issue occurs try later";
            Session::flash("error_message", $message);
            return redirect()->back();
        }


    }


    public function use_getformData()
    {
        return view('admin.getData1');


        $enter_by = Auth::guard('admin')->user()->school_id;
        $enter_by = is_string($enter_by) && $this->isJson($enter_by) ? json_decode($enter_by, true) : $enter_by;

        $User = User::get();

        $form = DB::table('form_entries')
            ->select('form_entries.Follow_up_Date_flag', 'form_entries.id', 'form_entries.name', 'form_entries.lname', 'form_entries.psychiatrist_id', 'form_entries.nutritionist_id', 'form_entries.doc_id', 'form_entries.gender', 'schools.school_name as school', 'form_entries.age', 'form_entries.grno', 'users.fullname as enterby', 'form_entries.duration', 'form_entries.created_at')
            ->join('schools', 'form_entries.school', '=', 'schools.id')
            ->join('cities', 'cities.id', '=', 'form_entries.city')
            ->join('users', 'users.id', '=', 'form_entries.enterby')
            ->join('areas', 'areas.id', '=', 'form_entries.area')
            ->whereIn('form_entries.school', $enter_by);
        // Conditional where clause based on $enter_by type
        if (is_array($enter_by)) {
            $form->whereIn('form_entries.school', $enter_by);
        } else {
            $form->where('form_entries.school', $enter_by);
        }

        $form->orderBy('form_entries.id', 'desc');
        $form = $form->get();
        // dd($form);
        return view('admin.getData', compact('form', 'User'));
    }

    // Helper function to check if a string is a valid JSON
    private function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function exportData()
    {
        // Clear Laravel caches
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:clear');

        return Excel::download(new ExcelExport, 'Data.xlsx');
    }
    public function Medical_Detail($id)
    {
        /*$data = DB::table('form_data')
            ->where('entry_id', $id)
            ->pluck('value', 'key')
            ->all();
     


        $columns = [];
        foreach ($data as $key => $value) {
            $columns[$key] = $value;
        }
        $resultArray = [$columns];
        // $id =$resultArray[0]['id'];
        // print_r($resultArray);*/


        $date = DB::table('form_entries')->where('id', $id)->first();
        $year = \Carbon\Carbon::parse($date->created_at)->year;


        // Fetch all the records where entry_id matches
        $records = DB::table('form_data')
            ->where('entry_id', $id)
            ->get(); // Use get() to fetch all records

        // Initialize an array to hold the result
        $columns = [];

        // Iterate through each record and collect 'refer_to' values
        foreach ($records as $record) {
            if ($record->key === 'refer_to') {
                // If 'refer_to' key exists, add it to the array
                // Convert the value into an array (if it's a string with commas)
                $values = is_string($record->value) ? explode(',', $record->value) : (array) $record->value;

                // Merge the values with the existing ones (avoiding duplicates)
                if (!isset($columns['refer_to'])) {
                    $columns['refer_to'] = [];
                }
                $columns['refer_to'] = array_merge($columns['refer_to'], $values);
            } else {
                // Store other values normally
                $columns[$record->key] = $record->value;
            }
        }

        // Ensure unique values in 'refer_to' (optional)
        if (isset($columns['refer_to'])) {
            $columns['refer_to'] = array_unique($columns['refer_to']);
        }

        // Now, $columns contains all refer_to values
        // dd($columns);
        $resultArray = [$columns];

        
        $email = DB::table('form_entries')
        ->join('schools', 'form_entries.school', '=', 'schools.id')
        ->select('schools.email')
        ->where('form_entries.id', $id) // optional
        ->first();
        // dd($email);
        $data['details'] = [
            "id" => $id,
            "name" => $resultArray[0]['name'] ?? null,
            "guardianname" => $resultArray[0]['guardianname'] ?? null,
            "school_email" =>  $email ?? null,
            "gender" => $resultArray[0]['gender'] ?? null,
            "school" => $resultArray[0]['school'] ?? null,
            "city" => $resultArray[0]['city'] ?? null,
            "area" => $resultArray[0]['area'] ?? null,
            "dob" => $resultArray[0]['dob'] ?? null,
            "age" => $resultArray[0]['age'] ?? null,
            "emergency_contact_number" => $resultArray[0]['Emergency_Contact_Number'] ?? null,
            "gr_number" => $resultArray[0]['Gr_Number'] ?? null,
            "any_known_medical_condition" => $resultArray[0]['Any_Known_Medical_Condition'] ?? null,
            "address" => $resultArray[0]['Address'] ?? '-',
            "blood_group" => $resultArray[0]['Blood_group'] ?? '-',
            "bio_data_comment" => $resultArray[0]['bio_data_comment'] ?? null,
            "question_no_1_height" => $resultArray[0]['Question_No_1_Height'] ?? null,
            "question_no_2_weight" => $resultArray[0]['Question_No_2_Weight'] ?? null,
            "question_no_3_bmi" => $resultArray[0]['Question_No_3_BMI'] ?? null,
            "question_no_4_body_temperature" => $resultArray[0]['Question_No_4_Body_Temperature'] ?? null,
            "bodytempunit" => $resultArray[0]['Bodytempunit'] ?? 'f',
            "question_no_5_blood_pressure_systolic" => $resultArray[0]['Question_No_5_Blood_Pressure_Systolic'] ?? $resultArray[0]['Question_No_6_Blood_Pressure_Systolic'] ?? $resultArray[0]['Question_No_6_Blood_Pressure'] ?? null,
            "question_no_6_blood_pressure_diastolic" => $resultArray[0]['Question_No_6_Blood_Pressure_Diastolic'] ?? $resultArray[0]['Question_No_7_Blood_Pressure_Diacystolic'] ?? $resultArray[0]['Question_No_6_Blood_Pressure_Diacystolic'] ?? null,
            "question_no_7_pulse" => $resultArray[0]['Question_No_7_Pulse'] ?? $resultArray[0]['Question_No_5_Pulse'] ?? null,
            "vitals_bmi_comment" => $resultArray[0]['vitals_bmi_comment'] ?? null,
            "question_no_8_normal_posture_gait" => $resultArray[0]['Question_No_8_Normal_Posture_Gait'] ?? $resultArray[0]['Question_No_7_Normal_Posture/Gait'] ?? null,
            "question_no_9_mental_status" => $resultArray[0]['Question_No_9_Mental_Status'] ?? $resultArray[0]['Question_No_8_Mental_Status'] ?? null,
            "question_no_10_look_for_jaundice" => $resultArray[0]['Question_No_10_Look_For_jaundice'] ?? $resultArray[0]['Question_No_9_Look_For_jaundice'] ?? null,
            "question_no_11_look_for_anemia" => $resultArray[0]['Question_No_11_Look_For_anemia'] ?? $resultArray[0]['Question_No_10_Look_For_anemia'] ?? null,
            "question_no_12_look_for_clubbing" => $resultArray[0]['Question_No_12_Look_For_Clubbing'] ?? $resultArray[0]['Question_No_11_Look_For_Clubbing'] ?? null,
            "question_no_13_look_for_cyanosis" => $resultArray[0]['Question_No_13_Look_for_Cyanosis'] ?? $resultArray[0]['Question_No_12_Look_for_Cyanosis'] ?? null,
            "question_no_14_skin" => $resultArray[0]['Question_No_14_Skin'] ?? $resultArray[0]['Question_No_13_Skin'] ?? null,
            "question_no_15_breath" => $resultArray[0]['Question_No_15_Breath'] ?? $resultArray[0]['Question_No_14_Breath'] ?? null,
            "general_apperance_comment" => $resultArray[0]['general_apperance_comment'] ?? null,
            "question_no_16_nails" => $resultArray[0]['Question_No_16_Nails'] ?? $resultArray[0]['Question_No_15_Nails'] ?? null,
            "question_no_17_uniform_or_shoes" => $resultArray[0]['Question_No_17_Uniform_or_shoes'] ?? $resultArray[0]['Question_No_16_Uniform_or_shoes'] ?? null,
            "question_no_18_lice_nits" => $resultArray[0]['Question_No_18_Lice_nits'] ?? $resultArray[0]['Question_No_17_Lice/nits'] ?? null,
            "question_no_19_discuss_hygiene_routines_and_practices" => $resultArray[0]['Question_No_19_Discuss_hygiene_routines_and_practices'] ?? $resultArray[0]['Question_No_18_Discuss_hygiene_routines_and_practices'] ?? null,
            "inspect_hygiene_comment" => $resultArray[0]['inspect_hygiene_comment'] ?? null,
            "question_no_20_hair_and_scalp" => $resultArray[0]['Question_No_20_Hair_and_Scalp'] ?? $resultArray[0]['Question_No_19_Hair_and_Scalp'] ?? null,
            "question_no_21_any_hair_problem" => $resultArray[0]['Question_No_21_Any_Hair_Problem'] ?? $resultArray[0]['Question_No_20_Any_Hair_Problem'] ?? null,
            "question_no_22_sclap" => $resultArray[0]['Question_No_22_Scalp'] ?? $resultArray[0]['Question_No_21_Sclap'] ?? null,
            "question_no_23_hair_distribution" => $resultArray[0]['Question_No_23_Hair_Distribution'] ?? $resultArray[0]['Question_No_20_Hair_distribution'] ?? $resultArray[0]['Question_No_22_Hair_distribution'] ?? null,
            "head_and_neck_examination_comment" => $resultArray[0]['head_and_neck_examination_comment'] ?? null,
            "question_no_24_visual_acuity_using_snellens_chart" => $resultArray[0]['Question_No_24_Visual_acuity_using_Snellens_chart'] ?? $resultArray[0]['Question_No_21_Visual_acuity_using_Snellen’s_chart'] ?? null,
            "question_no_25_normal_ocular_alignment" => $resultArray[0]['Question_No_25_Normal_ocular_alignment'] ?? $resultArray[0]['Question_No_22_Normal_ocular_alignment'] ?? $resultArray[0]['Question_No_24_Normal_ocular_alignment'] ?? null,
            "question_no_26_normal_eye_inspection" => $resultArray[0]['Question_No_26_Normal_eye_inspection'] ?? $resultArray[0]['Question_No_23_Normal_eye_inspection'] ?? $resultArray[0]['Question_No_25_Normal_eye_inspection'] ?? null,
            "question_no_27_normal_color_vision" => $resultArray[0]['Question_No_27_Normal_Color_vision'] ?? $resultArray[0]['Question_No_24_Normal_Color_vision'] ?? $resultArray[0]['Question_No_26_Normal_Color_vision'] ?? null,
            "question_no_28_nystagmus" => $resultArray[0]['Question_No_28_Nystagmus'] ?? $resultArray[0]['Question_No_25_Nystagmus'] ?? $resultArray[0]['Question_No_27_Nystagmus'] ?? null,
            "eye_comment" => $resultArray[0]['eye_comment'] ?? null,
            "question_no_29_normal_ears_shape_and_position" => $resultArray[0]['Question_No_29_Normal_ears_shape_and_position'] ?? $resultArray[0]['Question_No_26_Normal_ears_shape_and_position'] ?? $resultArray[0]['Question_No_28_Normal_ears_shape_and_position'] ?? null,
            "question_no_30_ear_examination" => $resultArray[0]['Question_No_30_Ear_examination'] ?? $resultArray[0]['Question_No_27_Ear_examination'] ?? $resultArray[0]['Question_No_29_Ear_examination'] ?? null,
            "question_no_31_conclusion_of_hearing_test_with_rinner_and_weber" => $resultArray[0]['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] ?? $resultArray[0]['Question_No_28_Conclusion_of_hearing_test_with_Rinner_and_Weber'] ?? $resultArray[0]['Question_No_30_Conclusion_of_hearing_test_with_Rinner_and_Weber'] ?? null,
            "ears_comment" => $resultArray[0]['ears_comment'] ?? null,
            "question_no_32_external_nasal_examinaton" => $resultArray[0]['Question_No_32_External_nasal_examinaton'] ?? $resultArray[0]['Question_No_29_External_inasal_examinaton'] ?? $resultArray[0]['Question_No_31_External_inasal_examinaton'] ?? null,
            "question_no_33_perform_a_nasal_patency" => $resultArray[0]["Question_No_33_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patient's_ability_to_breathe_through_each_nostril"] ?? $resultArray[0]["Question_No_30_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patient's_ability_to_breathe_through_each_nostril"] ?? $resultArray[0]['Question_No_33_perform_a_nasal_patency_test'] ?? 'None',
            "nose_comment" => $resultArray[0]['nose_comment'] ?? null,
            "question_no_34_assess_gingiva" => $resultArray[0]['Question_No_34_Assess_gingiva'] ?? $resultArray[0]['Question_No_31_Assess_gingiva'] ?? $resultArray[0]['Question_No_33_Assess_gingiva'] ?? null,
            "question_no_35_are_there_dental_caries" => $resultArray[0]['Question_No_35_Are_there_dental_caries'] ?? $resultArray[0]['Question_No_32_Are_there_dental_caries'] ?? $resultArray[0]['Question_No_34_Are_there_dental_caries'] ?? null,
            "oral_comment" => $resultArray[0]['oral_comment'] ?? null,
            "question_no_36_examine_tonsils" => $resultArray[0]['Question_No_36_Examine_tonsils'] ?? $resultArray[0]['Question_No_34_Examine_tonsils'] ?? $resultArray[0]['Question_No_35_Examine_tonsils'] ?? null,
            "question_no_37_normal_speech_development" => $resultArray[0]['Question_No_37_Normal_Speech_development'] ?? $resultArray[0]['Question_No_35_Normal_Speech_development'] ?? $resultArray[0]['Question_No_36_Normal_Speech_development'] ?? null,
            "question_no_38_any_neck_swelling" => $resultArray[0]['Question_No_38_Any_Neck_swelling'] ?? $resultArray[0]['Question_No_36_Any_Neck_swelling'] ?? $resultArray[0]['Question_No_37_Any_Neck_swelling'] ?? null,
            "question_no_39_examine_lymph_node" => $resultArray[0]['Question_No_39_Examine_lymph_node'] ?? $resultArray[0]['Question_No_37_Examine_lymph_node'] ?? $resultArray[0]['Question_No_38_Examine_lymph_node'] ?? null,
            "specify_lymph_node" => $resultArray[0]['Specify_lymph_node'] ?? null,
            "specify_any_neck_swelling" => $resultArray[0]['Specify_Any_Neck_swelling'] ?? null,
            "throat_comment" => $resultArray[0]['throat_comment'] ?? null,
            "question_no_40_any_visible_chest_deformity" => $resultArray[0]['Question_No_40_Any_visible_chest_deformity'] ?? $resultArray[0]['Question_No_38_Any_visible_chest_deformity'] ?? $resultArray[0]['Question_No_39_Any_visible_chest_deformity'] ?? null,
            "question_no_41_lung_auscultation" => $resultArray[0]['Question_No_41_Lung_Auscultation'] ?? $resultArray[0]['Question_No_39_Lung_Auscultation'] ?? $resultArray[0]['Question_No_40_Lung_Auscultation'] ?? null,
            "question_no_42_cardiac_auscultation" => $resultArray[0]['Question_No_42_Cardiac_Auscultation'] ?? $resultArray[0]['Question_No_40_Cardiac_Auscultation'] ?? $resultArray[0]['Question_No_41_Cardiac_Auscultation'] ?? null,
            "chest_comment" => $resultArray[0]['chest_comment'] ?? null,
            "question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen" => $resultArray[0]["Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen"] ?? $resultArray[0]["Question_No_41_Did_you_observe_any_distension,_scars,_or_masses_on_the_child's_abdomen?"] ?? $resultArray[0]["Question_No_42_Did_you_observe_any_distension,_scars,_or_masses_on_the_child's_abdomen?"] ?? null,
            "question_no_44_any_history_of_abdominal_pain" => $resultArray[0]['Question_No_44_Any_history_of_abdominal_Pain'] ?? $resultArray[0]['Question_No_42_Any_history_of_abdominal_Pain'] ?? null,
            "any_history_of_abdominal_pain_specify" => $resultArray[0]['any_history_of_abdominal_pain_specify'] ?? null,
            "abdomen_comment" => $resultArray[0]['abdomen_comment'] ?? null,
            "question_no_45_did_you_observe_any_limitations_in_the_childs_range_of_joint_motion_during_your_examination" => $resultArray[0]["Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination"] ?? $resultArray[0]["Question_No_43_Did_you_observe_any_limitations_in_the_child's_range_of_joint_motion_during_your_examination?"] ?? null,
            "specify_limitations_in_the_childs_range_of_joint_motion_during_your_examination" => $resultArray[0]["Specify_limitations_in_the_child's_range_of_joint_motion_during_your_examination?"] ?? null,
            "question_no_46_spinal_curvature_assessment_tick_positive_finding" => $resultArray[0]["Question_No_46_Spinal_curvature_assessment_tick_positive_finding"] ?? $resultArray[0]['Question_No_44_Spinal_curvature_assessment_(tick_positive_finding)'] ?? null,
            "question_no_47_side-to-side_curvature_in_the_spine_resembling" => $resultArray[0]["Question_No_47_side_to_side_curvature_in_the_spine_resembling"] ?? $resultArray[0]['Question_No_46_side-to-side_curvature_in_the_spine_resembling'] ?? null,
            "question_no_48_adams_forward_bend_test" => $resultArray[0]['Question_No_48_Adams_forward_bend_test'] ?? $resultArray[0]['Question_No_46_Adams_forward_bend_test'] ?? $resultArray[0]['Question_No_46_side-to-Question_No_47_Adams_forward_bend_test'] ?? $resultArray[0]['Question_No_47_Adams_forward_bend_test'] ?? null,
            "question_no_49_any_foot_or_toe_abnormalities" => $resultArray[0]['Question_No_49_Any_foot_or_toe_abnormalities'] ?? $resultArray[0]['Question_No_47_Any_foot_or_toe_abnormalities'] ?? $resultArray[0]['Question_No_48_Any_foot_or_toe_abnormalities'] ?? null,
            "musculoskeletal_comment" => $resultArray[0]['musculoskeletal_comment'] ?? null,
            "question_no_50_have_epi_immunization_card" => $resultArray[0]["Question_No_50_Have_EPI_immunization_card"] ?? $resultArray[0]['Question_No_48_Have_EPI_immunization_card?'] ?? $resultArray[0]['Question_No_49_Have_EPI_immunization_card?'] ?? null,
            "BCG_1_dose" => $resultArray[0]["BCG_1_dose"] ?? null,
            "OPV_4_dose" => $resultArray[0]["OPV_4_dose"] ?? null,
            "Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye" => $resultArray[0]["Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye"] ?? null,
            "Pentavalent_vaccine_DTP" => $resultArray[0]["Pentavalent_vaccine_DTP"] ?? null,
            "rota" => $resultArray[0]["rota"] ?? null,
            "measles" => $resultArray[0]["measles"] ?? null,
            "never_had_any_vaccination" => $resultArray[0]['never_had_any_vaccination'] ?? null,
            "reason_of_not_being_vaccinated" => $resultArray[0]['Reason_of_not_being_vaccinated'] ?? null,
            "vaccination_comment" => $resultArray[0]['vaccination_comment'] ?? null,
            "question_51_do_you_frequently_put_things_in_hisher_mouth_such_as_toys_jewelry_or_keys" => $resultArray[0]["Question_51_Do_you_Frequently_put_things_in_his/her_mouth_such_as_toys,_jewelry,_or_keys?"] ?? $resultArray[0]['Question_50_Do_you_Frequently_put_things_in_his/her_mouth_such_as_toys,_jewelry,_or_keys?'] ?? null,
            "question_52_does_your_child_eat_non_food_items_pica" => $resultArray[0]["Question_52_Does_your_child_eat_non_food_items_(pica)?"] ?? $resultArray[0]['Question_51_Does_your_child_eat_non_food_items_(pica)?'] ?? null,
            "question_53_do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead" => $resultArray[0]["Question_53_Do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead?"] ?? $resultArray[0]['Question_52_Do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead?'] ?? null,
            "question_54_do_you_frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead" => $resultArray[0]["Question_54_Do_you_frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead?"] ?? $resultArray[0]['Question_53_Do_you_frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead?'] ?? null,
            "lead_exposure_comment" => $resultArray[0]['lead_exposure_comment'] ?? null,
            "question_no_55_do_you_have_any_allergies" => $resultArray[0]["Question_No_55_Do_you_have_any_Allergies"] ?? $resultArray[0]['Question_No_54_Do_you_have_any_Allergies'] ?? null,
            "do_you_have_any_allergies_specify" => $resultArray[0]['Do_you_have_any_allergies_specify'] ?? $resultArray[0]['do_you_have_any_allergies_specify'] ?? null,
            "question_no_56_girls_above_8_years_old_ask" => $resultArray[0]['Question_No_56_Girls_above_8_years_old_ask:'] ?? $resultArray[0]['Question_No_55_Girls_above_8_years_old_ask:'] ?? null,
            "question_no_57_inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination" => $resultArray[0]["Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination"] ?? $resultArray[0]['Question_No_56_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination'] ?? null,
            "questionno_58_any_menstrual_abnormality" => $resultArray[0]['QuestionNo_58_Any_menstrual_abnormality'] ?? $resultArray[0]['QuestionNo_57_Any_menstrual_abnormality'] ?? null,
            "any_menstrual_abnormality_specify" => $resultArray[0]['Any_menstrual_abnormality_specify'] ?? null,
            "miscellaneous_comment" => $resultArray[0]['miscellaneous_comment'] ?? null,
            "question_no_59_how_often_do_you_experience_negative_or_intrusive_thoughts" => $resultArray[0]['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'] ?? $resultArray[0]['Question_No_58_How_often_do_you_experience_negative_or_intrusive_thoughts?'] ?? null,
            "question_no_60_how_would_you_rate_your_overall_self_esteem_and_self_confidence" => $resultArray[0]['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence'] ?? $resultArray[0]['Question_No_59_How_would_you_rate_your_overall_self_esteem_and_self_confidence?'] ?? null,
            "question_no_61_how_would_you_describe_your_energy_levels_throughout_a_typical_day" => $resultArray[0]['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day'] ?? $resultArray[0]['Question_No_60_How_would_you_describe_your_energy_levels_throughout_a_typical_day?'] ?? null,
            "question_no_62_when_faced_with_challenges_what_are_your_typical_coping_mechanisms" => $resultArray[0]["Question_No_62_When_faced_with_challenges_what_are_your_typical_coping_mechanisms"] ?? $resultArray[0]['Question_No_61_When_faced_with_challenges,_what_are_your_typical_coping_mechanisms?'] ?? null,
            "question_no_63_how_would_you_rate_the_quality_of_your_sleep_on_average" => $resultArray[0]['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average'] ?? $resultArray[0]['Question_No_62_How_would_you_rate_the_quality_of_your_sleep_on_average?'] ?? null,
            "question_no_64_how_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks" => $resultArray[0]['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks'] ?? $resultArray[0]['Question_No_63_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks?'] ?? null,
            "question_no_65_how_would_you_describe_your_overall_mood_during_the_day" => $resultArray[0]['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day'] ?? $resultArray[0]['Question_No_64_How_would_you_describe_your_overall_mood_during_the_day?'] ?? null,
            "question_no_66_how_would_you_describe_the_quality_of_your_relationships_with_family_members" => $resultArray[0]['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members'] ?? $resultArray[0]['Question_No_65_How_would_you_describe_the_quality_of_your_relationships_with_family_members?'] ?? null,
            "question_no_67_how_well_does_you_handle_challenges_and_solve_problems" => $resultArray[0]['Question_No_67_How_well_do_you_handle_challenges_and_solve_problems'] ?? $resultArray[0]['Question_No_66_How_well_does_you_handle_challenges_and_solve_problems?'] ?? null,
            "question_no_68_how_many_hours_of_sleep_does_you_typically_get_on_a_school_night" => $resultArray[0]['Question_No_68_How_many_hours_of_sleep_do_you_typically_get_on_a_school_night'] ?? $resultArray[0]['Question_No_67_How_many_hours_of_sleep_does_you_typically_get_on_a_school_night?'] ?? null,
            "followup_required" => $resultArray[0]['followup_required'] ?? null,
            "referred_by" => $resultArray[0]['referred_by'] ?? null,
            "referred_to" => $resultArray[0]['referred_to']?? $resultArray[0]['referred_to[]'] ?? null,
            "psychological_comment" => $resultArray[0]['psychological_comment'] ?? null,
            "PsychologistRefferedTo" => $resultArray[0]['PsychologistRefferedTo'] ?? null,
            "Psychologist_Findings" => $resultArray[0]['Psychologist_Findings'] ?? null,
            // "DietaryAdviceComment" => $resultArray[0]['DietaryAdviceComment'] ?? null,
            "mrr" => "{$year}{$id}",


            /****************************** Nutritionist ***********************************/

            "Question_No_60_How_would_you_describe_your_lifestyle" => $resultArray[0]['Question_No_60_How_would_you_describe_your_lifestyle'] ?? null,
            "bmi61" => $resultArray[0]['bmi61'] ?? null,
            "muac" => $resultArray[0]['muac'] ?? null,
            "Daily_Protien_requirement" => $resultArray[0]['Daily_Protien_requirement'] ?? null,
            "Daily_energy_requirement" => $resultArray[0]['Daily_energy_requirement'] ?? null,
            "Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day" => $resultArray[0]['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'] ?? null,
            "Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to" => $resultArray[0]['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'] ?? null,
            "addiction" => $resultArray[0]['addiction'] ?? null,
            "other_addiction" => $resultArray[0]['other_addiction'] ?? null,
            "food_allergies" => $resultArray[0]['food_allergies'] ?? null,
            "other_food_allergies" => $resultArray[0]['other_food_allergies'] ?? null,
            "lifestyle" => $resultArray[0]['lifestyle'] ?? null,
            "meals" => $resultArray[0]['meals'] ?? null,
            "food_items" => $resultArray[0]['food_items'] ?? null,
            "fast_food" => $resultArray[0]['fast_food'] ?? null,
            // "NutritionistComment" => $resultArray[0]['NutritionistComment'] ?? null,
            "Follow_up_Required" => $resultArray[0]['Follow_up_Required'] ?? null,
            "Reason_for_Follow_up" => $resultArray[0]['Reason_for_Follow_up'] ?? null,
            "Follow_up_Date" => $resultArray[0]['Follow_up_Date'] ?? null,
            "Physician_Follow_up_Date" => $resultArray[0]['Physician_Follow_up_Date'] ?? null,
            "externalspecialist_Follow_up_Date" => $resultArray[0]['externalspecialist_Follow_up_Date'] ?? null,
            "generalphysician_Follow_up_Date" => $resultArray[0]['generalphysician_Follow_up_Date'] ?? null,

            "refer_to" => $resultArray[0]['refer_to'] ?? $resultArray[0]['refer_to[]'] ??null,

            "class" => $resultArray[0]['class'] ?? null,
            "observation1" => $resultArray[0]['observation1'] ?? null,
            "observation2" => $resultArray[0]['observation2'] ?? null,
            "observation3" => $resultArray[0]['observation3'] ?? null,
            "observation4" => $resultArray[0]['observation4'] ?? null,
            "observation5" => $resultArray[0]['observation5'] ?? null,
            "observation6" => $resultArray[0]['observation6'] ?? null,
            "observation7" => $resultArray[0]['observation7'] ?? null,
            "observation8" => $resultArray[0]['observation8'] ?? null,
            "observation9" => $resultArray[0]['observation9'] ?? null,
            "observation10" => $resultArray[0]['observation10'] ?? null,
            // "wasting_birth_to_5_girl" => $resultArray[0]['wasting_birth_to_5_girl'] ?? null,
            // "wasting_birth_to_5_boy" => $resultArray[0]['wasting_birth_to_5_boy'] ?? null,
            // "wasting_5_to_19_girl" => $resultArray[0]['wasting_5_to_19_girl'] ?? null,
            // "wasting_5_to_19_boy" => $resultArray[0]['wasting_5_to_19_boy'] ?? null,
            // "stunting_birth_to_2_girl" => $resultArray[0]['stunting_birth_to_2_girl'] ?? null,
            // "stunting_birth_to_2_boy" => $resultArray[0]['stunting_birth_to_2_boy'] ?? null,
            // "stunting_2_5_girl" => $resultArray[0]['stunting_2_5_girl'] ?? null,
            // "stunting_2_5_boy" => $resultArray[0]['stunting_2_5_boy'] ?? null,
            // "stunting_5_19_girl" => $resultArray[0]['stunting_5_19_girl'] ?? null,
            // "stunting_5_19_boy" => $resultArray[0]['stunting_5_19_boy'] ?? null,
            "doctor_comment" => $resultArray[0]['doctor_comment'] ?? $resultArray[0]['doctor_comment '] ?? null,
// lead expouser
  // lead exposure
            "Question_No_48_Frequently_put_things_in_mouth" => $resultArray[0]["Question_No_48_Frequently_put_things_in_mouth"] ?? $resultArray[0]['Question_No_48_Frequently_put_things_in_mouth'] ?? null,
            "Question_No_49_Child_eat_non_food_items_pica" => $resultArray[0]['Question_No_49_Child_eat_non_food_items_pica'] ?? null,
            "Question_No_50_Contact_adult_job_lead_exposure" => $resultArray[0]['Question_No_50_Contact_adult_job_lead_exposure'] ?? null,
            "Question_No_51_Contact_adult_hobby_lead_exposure" => $resultArray[0]['Question_No_51_Contact_adult_hobby_lead_exposure'] ?? null,
            "lead_exposure_comment" => $resultArray[0]['lead_exposure_comment'] ?? null,

            
           // step 17 
            /* Step Seventeen - Psychological */
            "nursery_cognitive_total_score"=>$resultArray[0]['nursery_cognitive_total_score'] ?? null,
            "nursery_motor_total_score"=>$resultArray[0]['nursery_motor_total_score'] ?? null,
            "nursery_language_total_score"=>$resultArray[0]['nursery_language_total_score'] ?? null,
            "nursery_social_emotional_total_score" => $resultArray[0]['nursery_social_emotional_total_score'] ?? null,
            "nursery_adaptive_total_score" => $resultArray[0]['nursery_adaptive_total_score'] ?? null,
            "playground_cognitive_total_score" => $resultArray[0]['playground_cognitive_total_score'] ?? null,
            "playground_motor_total_score" => $resultArray[0]['playground_motor_total_score'] ?? null,
            "playground_language_total_score" => $resultArray[0]['playground_language_total_score'] ?? null,
            "playground_social_emotional_total_score" => $resultArray[0]['playground_social_emotional_total_score'] ?? null,
            "playground_adaptive_total_score" => $resultArray[0]['playground_adaptive_total_score'] ?? null,
            "kindergarten_cognitive_total_score" => $resultArray[0]['kindergarten_cognitive_total_score'] ?? null,
            "kindergarten_motor_total_score" => $resultArray[0]['kindergarten_motor_total_score'] ?? null,
            "kindergarten_language_total_score" => $resultArray[0]['kindergarten_language_total_score'] ?? null,
            "kindergarten_social_emotional_total_score" => $resultArray[0]['kindergarten_social_emotional_total_score'] ?? null,
            "kindergarten_adaptive_total_score" => $resultArray[0]['kindergarten_adaptive_total_score'] ?? null,
            "social_emotional_Attention_result" => $resultArray[0]['social_emotional_Attention_result'] ?? null,
            "externalizing_socialtotal_emotional_score" => $resultArray[0]['externalizing_socialtotal_emotional_score'] ?? null,
            "social_emotional_attention_total_score" => $resultArray[0]['social_emotional_attention_total_score'] ?? null,
            "social_emotional_total_score" => $resultArray[0]['social_emotional_total_score'] ?? null,
            "autism_spectrum_total_score" => $resultArray[0]['autism_spectrum_total_score'] ?? null,
            "psychological_internalization_total_score" => $resultArray[0]['psychological_internalization_total_score'] ?? null,
            "psychological_externalization_total_score" => $resultArray[0]['psychological_externalization_total_score'] ?? null,
            "psychological_attention_total_score" => $resultArray[0]['psychological_attention_total_score'] ?? null,

            "QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box" => $resultArray[0]['QuestionNo_59_Does_your_child_try_to_solve_problems_like_figuring_out_how_to_get_a_toy_from_a_box'] ?? null,
            "QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone" => $resultArray[0]['QuestionNo_60_Does_your_child_imitate_household_tasks_like_sweeping_talking_on_phone'] ?? null,
            "QuestionNo_61_Can_your_child_walk_without_help" => $resultArray[0]['QuestionNo_61_Can_your_child_walk_without_help'] ?? null,
            "QuestionNo_62_Can_your_child_stack_two_or_more_blocks" => $resultArray[0]['QuestionNo_62_Can_your_child_stack_two_or_more_blocks'] ?? null,
            "QuestionNo_63_Does_your_child_point_to_objects_when_named" => $resultArray[0]['QuestionNo_63_Does_your_child_point_to_objects_when_named'] ?? null,
            "QuestionNo_64_Can_your_child_say_at_least_5_10_words" => $resultArray[0]['QuestionNo_64_Can_your_child_say_at_least_5_10_words'] ?? null,
            "QuestionNo_65_Does_your_child_show_affection_to_familiar_people" => $resultArray[0]['QuestionNo_65_Does_your_child_show_affection_to_familiar_people'] ?? null,
            "QuestionNo_66_Does_your_child_get_upset_when_separated_from_you" => $resultArray[0]['QuestionNo_66_Does_your_child_get_upset_when_separated_from_you'] ?? null,
            "QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon" => $resultArray[0]['QuestionNo_67_Can_your_child_feed_themself_with_fingers_or_a_spoon'] ?? null,
            "QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help" => $resultArray[0]['QuestionNo_68_Does_your_child_try_to_brush_teeth_or_wash_hands_with_help'] ?? null,
            "QuestionNo_69_Can_your_child_complete_a_simple_puzzle" => $resultArray[0]['QuestionNo_69_Can_your_child_complete_a_simple_puzzle'] ?? null,
            "QuestionNo_70_Does_your_child_match_similar_objects" => $resultArray[0]['QuestionNo_70_Does_your_child_match_similar_objects'] ?? null,
            "QuestionNo_71_Can_your_child_jump_with_both_feet" => $resultArray[0]['QuestionNo_71_Can_your_child_jump_with_both_feet'] ?? null,
            "QuestionNo_72_Can_your_child_draw_a_line_or_circle" => $resultArray[0]['QuestionNo_72_Can_your_child_draw_a_line_or_circle'] ?? null,
            "QuestionNo_73_Can_your_child_form_2_to_3_word_phrases" => $resultArray[0]['QuestionNo_73_Can_your_child_form_2_to_3_word_phrases'] ?? null,
            "QuestionNo_74_Does_your_child_ask_simple_questions" => $resultArray[0]['QuestionNo_74_Does_your_child_ask_simple_questions'] ?? null,
            "QuestionNo_75_Does_your_child_play_pretend" => $resultArray[0]['QuestionNo_75_Does_your_child_play_pretend'] ?? null,
            "QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings" => $resultArray[0]['QuestionNo_76_Does_your_child_show_awareness_of_other_people_s_feelings'] ?? null,
            "QuestionNo_77_Can_your_child_take_off_some_clothes_without_help" => $resultArray[0]['QuestionNo_77_Can_your_child_take_off_some_clothes_without_help'] ?? null,
            "QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training" => $resultArray[0]['QuestionNo_78_Is_your_child_starting_to_show_interest_in_potty_training'] ?? null,
            "QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time" => $resultArray[0]['QuestionNo_84_Are_you_able_to_understand_what_your_child_is_saying_most_of_the_time'] ?? null,
            // Social Emotional Behavioral Screening
            "aches_pains" => $resultArray[0]['aches_pains'] ?? null,
            "sad_unhappy" => $resultArray[0]['sad_unhappy'] ?? null,
            "irritable_angry" => $resultArray[0]['irritable_angry'] ?? null,
            "trouble_sitting" => $resultArray[0]['trouble_sitting'] ?? null,
            "easily_distracted" => $resultArray[0]['easily_distracted'] ?? null,
            "doesnt_listen" => $resultArray[0]['doesnt_listen'] ?? null,
            "fidgets" => $resultArray[0]['fidgets'] ?? null,
            "driven_motor" => $resultArray[0]['driven_motor'] ?? null,
            "argues_talks_back" => $resultArray[0]['argues_talks_back'] ?? null,
            "difficulty_waiting" => $resultArray[0]['difficulty_waiting'] ?? null,
            "blames_others" => $resultArray[0]['blames_others'] ?? null,
            "hits_kicks_bites" => $resultArray[0]['hits_kicks_bites'] ?? null,
            "anxious_worries" => $resultArray[0]['anxious_worries'] ?? null,
            "afraid_new_things" => $resultArray[0]['afraid_new_things'] ?? null,
            "refuses_separate" => $resultArray[0]['refuses_separate'] ?? null,
            "nightmares_sleeping" => $resultArray[0]['nightmares_sleeping'] ?? null,
            "loses_temper" => $resultArray[0]['loses_temper'] ?? null,
            "social_emotional_result" => $resultArray[0]['social_emotional_result'] ?? null,
            "externalizing_social_emotional_score" => $resultArray[0]['externalizing_social_emotional_score'] ?? null,
            "social_emotional_behavior" => $resultArray[0]['social_emotional_behavior'] ?? null,
            
            // Autism Spectrum Disorder Screening
            "eye_contact" => $resultArray[0]['eye_contact'] ?? null,
            "show_feelings" => $resultArray[0]['show_feelings'] ?? null,
            "use_gestures" => $resultArray[0]['use_gestures'] ?? null,
            "react_to_changes" => $resultArray[0]['react_to_changes'] ?? null,
            "respond_to_name" => $resultArray[0]['respond_to_name'] ?? null,
            "use_words" => $resultArray[0]['use_words'] ?? null,
            "use_facial_expressions" => $resultArray[0]['use_facial_expressions'] ?? null,
            "appropriate_activity_level" => $resultArray[0]['appropriate_activity_level'] ?? null,
            "follow_directions" => $resultArray[0]['follow_directions'] ?? null,
            "play_with_others" => $resultArray[0]['play_with_others'] ?? null,
            "autism_spectrum_result" => $resultArray[0]['autism_spectrum_result'] ?? null,
            "autism_spectrum_Comment" => $resultArray[0]['autism_spectrum_Comment'] ?? null,
            
            // Primary/Secondary Psychological Screening
            "feel_sad" => $resultArray[0]['feel_sad'] ?? null,
            "easily_distracted_primary" => $resultArray[0]['easily_distracted_primary'] ?? null,
            "feel_nervous" => $resultArray[0]['feel_nervous'] ?? null,
            "trouble_sleeping" => $resultArray[0]['trouble_sleeping'] ?? null,
            "feel_lonely" => $resultArray[0]['feel_lonely'] ?? null,
            "argue_talk_back" => $resultArray[0]['argue_talk_back'] ?? null,
            "take_things_refuse_share" => $resultArray[0]['take_things_refuse_share'] ?? null,
            "fight_angry_quickly" => $resultArray[0]['fight_angry_quickly'] ?? null,
            "dont_enjoy_things" => $resultArray[0]['dont_enjoy_things'] ?? null,
            "clingy_need_adults" => $resultArray[0]['clingy_need_adults'] ?? null,
            "trouble_sitting_still" => $resultArray[0]['trouble_sitting_still'] ?? null,
            "dont_listen_rules" => $resultArray[0]['dont_listen_rules'] ?? null,
            "emotional_behavior_result" => $resultArray[0]['emotional_behavior_result'] ?? null,
            "behavioral_issues_result" => $resultArray[0]['behavioral_issues_result'] ?? null,
            "attention_issues_result" => $resultArray[0]['attention_issues_result'] ?? null,
            
            "psychological_comment" => $resultArray[0]['psychological_comment'] ?? null,

            // Hidden Score Fields for Psychological Screening
            "play_ground_Cognitive_Result" => $resultArray[0]['play_ground_Cognitive_Result'] ?? null,
            "play_ground_Motor_Result" => $resultArray[0]['play_ground_Motor_Result'] ?? null,
            "play_ground_Language_Result" => $resultArray[0]['play_ground_Language_Result'] ?? null,
            "play_ground_SocialEmotional_Result" => $resultArray[0]['play_ground_SocialEmotional_Result'] ?? null,
            "play_ground_Adaptive_Result" => $resultArray[0]['play_ground_Adaptive_Result'] ?? null,
            
            // Nursery Result Fields
            "nursery_Cognitive_Result" => $resultArray[0]['nursery_Cognitive_Result'] ?? null,
            "nursery_Motor_Result" => $resultArray[0]['nursery_Motor_Result'] ?? null,
            "nursery_Language_Result" => $resultArray[0]['nursery_Language_Result'] ?? null,
            "nursery_SocialEmotional_Result" => $resultArray[0]['nursery_SocialEmotional_Result'] ?? null,
            "nursery_Adaptive_Result" => $resultArray[0]['nursery_Adaptive_Result'] ?? null,
            
            // Hidden Score Fields for Psychological Screening
            "nursery_Cognitive" => $resultArray[0]['nursery_Cognitive'] ?? null,
            "nursery_Motor" => $resultArray[0]['nursery_Motor'] ?? null,
            "nursery_Adaptive" => $resultArray[0]['nursery_Adaptive'] ?? null,
            
            // Kindergarten Development Screening Questions
            "QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors" => $resultArray[0]['QuestionNo_79_Can_your_child_count_to_5_or_recognize_some_colors'] ?? null,
            "QuestionNo_80_Can_your_child_follow_two_step_directions" => $resultArray[0]['QuestionNo_80_Can_your_child_follow_two_step_directions'] ?? null,
            "QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball" => $resultArray[0]['QuestionNo_81_Can_your_child_hop_on_one_foot_or_catch_a_large_ball'] ?? null,
            "QuestionNo_82_Can_your_child_use_scissors_to_cut_paper" => $resultArray[0]['QuestionNo_82_Can_your_child_use_scissors_to_cut_paper'] ?? null,
            "QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object" => $resultArray[0]['QuestionNo_83_Can_your_child_tell_a_short_story_or_describe_an_object'] ?? null,
            "QuestionNo_84_Can_your_child_use_complete_sentences_and_understand_what_your_child_is_saying_most_of_the_time" => $resultArray[0]['QuestionNo_84_Can_your_child_use_complete_sentences_and_understand_what_your_child_is_saying_most_of_the_time'] ?? null,
            "QuestionNo_85_Does_your_child_play_cooperatively_with_other_children" => $resultArray[0]['QuestionNo_85_Does_your_child_play_cooperatively_with_other_children'] ?? null,
            "QuestionNo_86_Does_your_child_express_emotions_appropriately" => $resultArray[0]['QuestionNo_86_Does_your_child_express_emotions_appropriately'] ?? null,
            "QuestionNo_87_Can_your_child_dress_and_undress_without_help" => $resultArray[0]['QuestionNo_87_Can_your_child_dress_and_undress_without_help'] ?? null,
            "QuestionNo_88_Can_your_child_use_the_toilet_independently" => $resultArray[0]['QuestionNo_88_Can_your_child_use_the_toilet_independently'] ?? null,
            
            // Kindergarten Result Fields
            
            "kindergarten_Cognitive_Result" => $resultArray[0]['kindergarten_Cognitive_Result'] ?? null,
            "kindergarten_Motor_Result" => $resultArray[0]['kindergarten_Motor_Result'] ?? null,
            "kindergarten_Language_Result" => $resultArray[0]['kindergarten_Language_Result'] ?? null,
            "kindergarten_SocialEmotional_Result" => $resultArray[0]['kindergarten_SocialEmotional_Result'] ?? null,
            "kindergarten_Adaptive_Result" => $resultArray[0]['kindergarten_Adaptive_Result'] ?? null,

        ];
        // dd($data['details'] );
        $data['area'] = Area::get();
        $data['school'] = School::get();
        $data['city'] = City::get();
        $data['form_id'] = $id;



        $dataDetails = DB::table('form_entries')->where('id', $id)->first();

        if (!empty($dataDetails->grno)) {


            $data['StudentBiodata'] = StudentBiodata::where('deleted', 0)
                ->where('GRNo', $dataDetails->grno)
                ->orderBy('id', 'desc')
                ->get();

            $data['Prescription'] = Prescription::where('deleted', 0)
                ->where('form_entry_id', $id)
                ->orderBy('id', 'desc')
                ->get();

            $data['Aids'] = Aids::where('deleted', 0)
                ->where('form_entry_id', $id)
                ->orderBy('id', 'desc')
                ->get();

            $data['Labs'] = Labs::where('deleted', 0)
                ->where('form_entry_id', $id)
                ->orderBy('id', 'desc')
                ->get();


        }



        $keysInit = [
            'wasting_birth_to_5_girl','wasting_birth_to_5_boy','wasting_5_to_19_girl','wasting_5_to_19_boy',
            'stunting_birth_to_2_girl','stunting_birth_to_2_boy','stunting_2_5_girl','stunting_2_5_boy',
            'stunting_5_19_girl','stunting_5_19_boy','NutritionistComment','DietaryAdviceComment','doctor_comment'
        ];
        foreach ($keysInit as $k) { if (!array_key_exists($k, $data['details'])) { $data['details'][$k] = null; } }

        $gender = strtolower((string)($data['details']['gender'] ?? ''));
        $dobStr = (string)($data['details']['dob'] ?? '');
        $heightVal = is_numeric($data['details']['question_no_1_height'] ?? null) ? (float)$data['details']['question_no_1_height'] : null;
        $bmiVal = null;
        if (is_numeric($data['details']['bmi61'] ?? null)) { $bmiVal = (float)$data['details']['bmi61']; }
        elseif (is_numeric($data['details']['question_no_3_bmi'] ?? null)) { $bmiVal = (float)$data['details']['question_no_3_bmi']; }
        $ageYears = null; $totalMonths = null;
        if (!empty($dobStr)) {
            try {
                $dob = Carbon::parse($dobStr);
                $now = Carbon::now();
                $diff = $dob->diff($now);
                $ageYears = (int)$diff->y;
                $totalMonths = ($diff->y * 12) + (int)$diff->m;
            } catch (\Exception $e) { }
        }

        if (in_array($gender, ['male','female']) && $totalMonths !== null) {
            if ($bmiVal !== null) {
                if ($ageYears !== null && $ageYears <= 5) {
                    $wRow = DB::table('wasting')->where('Sex', $gender)->where('Months', $totalMonths)->first();
                    if ($wRow) {
                        $neg3 = (float)$wRow->Neg3SD; $neg2 = (float)$wRow->Neg2SD; $neg1 = (float)$wRow->Neg1SD; $pos1 = (float)$wRow->Pos1SD; $pos2 = (float)$wRow->Pos2SD; $pos3 = (float)$wRow->Pos3SD;
                        $cls = '';
                        if ($bmiVal < $neg3) { $cls = 'Severe Thinness'; }
                        elseif ($bmiVal >= $neg3 && $bmiVal < $neg2) { $cls = 'Moderate Thinness'; }
                        elseif ($bmiVal >= $neg2 && $bmiVal < $neg1) { $cls = 'Mild Thinness'; }
                        elseif ($bmiVal >= $neg1 && $bmiVal <= $pos1) { $cls = 'Normal Weight'; }
                        elseif ($bmiVal > $pos1 && $bmiVal <= $pos2) { $cls = 'Mild Overweight'; }
                        elseif ($bmiVal > $pos2 && $bmiVal <= $pos3) { $cls = 'Overweight'; }
                        elseif ($bmiVal > $pos3) { $cls = 'Obesity'; }
                        if ($gender === 'female') { $data['details']['wasting_birth_to_5_girl'] = $cls; }
                        else { $data['details']['wasting_birth_to_5_boy'] = $cls; }
                    }
                } elseif ($ageYears !== null && $ageYears > 5 && $ageYears <= 19) {
                    $bRow = DB::table('bmiForAge')->where('Sex', ucfirst($gender))->where('Months', $totalMonths)->first();
                    if ($bRow) {
                        $neg3 = (float)$bRow->Neg3SD; $neg2 = (float)$bRow->Neg2SD; $neg1 = (float)$bRow->Neg1SD; $pos1 = (float)$bRow->Pos1SD; $pos2 = (float)$bRow->Pos2SD; $pos3 = (float)$bRow->Pos3SD;
                        $cls = '';
                        if ($bmiVal < $neg3) { $cls = 'Severe Thinness'; }
                        elseif ($bmiVal >= $neg3 && $bmiVal < $neg2) { $cls = 'Moderate Thinness'; }
                        elseif ($bmiVal >= $neg2 && $bmiVal < $neg1) { $cls = 'Mild Thinness'; }
                        elseif ($bmiVal >= $neg1 && $bmiVal <= $pos1) { $cls = 'Normal Weight'; }
                        elseif ($bmiVal > $pos1 && $bmiVal <= $pos2) { $cls = 'Mild Overweight'; }
                        elseif ($bmiVal > $pos2 && $bmiVal <= $pos3) { $cls = 'Overweight'; }
                        elseif ($bmiVal > $pos3) { $cls = 'Obesity'; }
                        if ($gender === 'female') { $data['details']['wasting_5_to_19_girl'] = $cls; }
                        else { $data['details']['wasting_5_to_19_boy'] = $cls; }
                    }
                }
            }

            if ($heightVal !== null) {
                $zRow = DB::table('ZScores')->where('Gender', ucfirst($gender))->where('Month', $totalMonths)->first();
                if ($zRow) {
                    $sd3n = (float)$zRow->SD3neg; $sd2n = (float)$zRow->SD2neg; $sd2p = (float)$zRow->SD2;
                    $cls = '';
                    if ($ageYears !== null && $ageYears >= 5 && $ageYears <= 19) {
                        if ($heightVal <= $sd3n) { $cls = 'Severe Stunting'; }
                        elseif ($heightVal > $sd3n && $heightVal <= $sd2n) { $cls = 'Stunting'; }
                        elseif ($heightVal > $sd2n && $heightVal <= $sd2p) { $cls = 'Normal'; }
                        elseif ($heightVal >= $sd2p) { $cls = 'Tall'; }
                        if ($gender === 'female') { $data['details']['stunting_5_19_girl'] = $cls; }
                        else { $data['details']['stunting_5_19_boy'] = $cls; }
                    } elseif ($ageYears !== null && $ageYears < 2) {
                        if ($heightVal <= $sd3n) { $cls = 'Severe Stunting (LAZ < -3)'; }
                        elseif ($heightVal > $sd3n && $heightVal <= $sd2n) { $cls = 'Stunting (LAZ between -3 and -2)'; }
                        elseif ($heightVal > $sd2n && $heightVal <= $sd2p) { $cls = 'Normal (LAZ between -2 and +2)'; }
                        elseif ($heightVal > $sd2p) { $cls = 'Tall (LAZ > +2)'; }
                        if ($gender === 'female') { $data['details']['stunting_birth_to_2_girl'] = $cls; }
                        else { $data['details']['stunting_birth_to_2_boy'] = $cls; }
                    } elseif ($ageYears !== null && $ageYears >= 2 && $ageYears <= 5) {
                        if ($heightVal <= $sd3n) { $cls = 'Severe Stunting (LAZ/HAZ < -3)'; }
                        elseif ($heightVal > $sd3n && $heightVal <= $sd2n) { $cls = 'Stunting (LAZ/HAZ between -3 and -2)'; }
                        elseif ($heightVal > $sd2n && $heightVal <= $sd2p) { $cls = 'Normal (LAZ/HAZ between -2 and +2)'; }
                        elseif ($heightVal > $sd2p) { $cls = 'Tall (LAZ/HAZ > +2)'; }
                        if ($gender === 'female') { $data['details']['stunting_2_5_girl'] = $cls; }
                        else { $data['details']['stunting_2_5_boy'] = $cls; }
                    }
                }
            }

            $wCls = null; $sCls = null; $map = [];
            $map['wasting_birth_to_5_girl'] = [
                'Severe Thinness' => [
                    'n' => 'The child is severely malnourished, the z score indicates severe wasting which needs to be addressed immediately. It can also indicate any underlying medical condition causing this severe malnutrition. Ensure regular follow-ups with the health care provider',
                    'd' => 'Increase calorie-dense foods: whole milk, nuts, seeds, cheese, peanut butter. Include protein-rich foods like eggs, chicken, fish, and lentils. Fortify meals with healthy fats. Use full fat dairy products Provide frequent small meals with snacks in between. Consult a pediatric dietitian for a tailored plan.'
                ],
                'Moderate Thinness' => [
                    'n' => 'The child is underweight and at risk of health issues. The Z score indicates moderate wasting. Nutritional support and monitoring every 6 months are recommended.',
                    'd' => 'Add nutrient-dense foods like whole grains, dairy, and lean proteins. Increase intake of fruits and vegetables. Focus on healthy fats and oils for cooking. Encourage consistent meal patterns with 3 main meals and 2 snacks.'
                ],
                'Mild Thinness' => [
                    'n' => 'The child is approaching underweight. Regular monitoring and preventive nutritional measures are advised.',
                    'd' => 'Incorporate balanced meals with complex carbohydrates like whole grains, oats rice and whole grain pasta. Add moderate amounts of healthy fats and proteins which includes all meats beans and lentils. Introduce fortified cereals and dairy products. - Encourage healthy snacking between meals, like yogurt or fruit.'
                ],
                'Normal Weight' => [
                    'n' => 'The child has a healthy weight for age and height. Encourage balanced nutrition and regular physical activity to maintain health.',
                    'd' => 'Maintain a balanced diet with all food groups: carbohydrates, proteins, fats, fruits, and vegetables. - Limit sugary snacks and processed foods.- Encourage regular hydration with water.- Promote at least 60 minutes of daily physical activity.'
                ],
                'Mild Overweight' => [
                    'n' => 'The child is approaching overweight. Promote healthy eating habits and active play to prevent further weight gain.',
                    'd' => 'Replace sugary beverages with water or milk. Limit processed and high-fat snacks; choose fresh fruits and whole foods. Reduce portion sizes without skipping meals. Encourage regular physical activity, such as outdoor play or sports.'
                ],
                'Overweight' => [
                    'n' => 'The child is overweight, increasing the risk of obesity-related health issues. Monitoring of calorie consumption and physical activity is needed  Early intervention with dietary and activity changes is needed',
                    'd' => '- Focus on portion control and regular meal timings. Prioritize high-fiber foods like whole grains, fruits, and vegetables. Avoid fried and sugary foods; use baking or steaming methods. Introduce fun physical activities to reduce sedentary habits.'
                ],
                'Obesity' => [
                    'n' => 'The child has significant excess weight, posing a high risk of severe health problems. Comprehensive intervention is required, potentially involving healthcare professionals.',
                    'd' => 'Consult a pediatric dietitian for a tailored plan. Gradually reduce calorie intake while ensuring nutrient density. Eliminate sugary drinks and high-fat junk foods. Increase daily physical activity, aiming for structured sports or fitness routines. Involve the family in adopting healthier eating and lifestyle habits'
                ],
            ];
            $map['wasting_birth_to_5_boy'] = $map['wasting_birth_to_5_girl'];
            $map['wasting_5_to_19_girl'] = $map['wasting_birth_to_5_girl'];
            $map['wasting_5_to_19_boy'] = $map['wasting_birth_to_5_girl'];
            $map['stunting_5_19_girl'] = [
                'Severe Stunting' => [
                    'n' => 'Severe stunting related to prolonged inadequate nutrient intake and possible health complications as evidenced by height-for-age Z-score below -3.',
                    'd' => 'Prioritize calorie-dense, nutrient-rich foods like lean proteins, whole grains, dairy, and regular healthy snacks to support catch-up growth.'
                ],
                'Stunting' => [
                    'n' => 'Stunting related to insufficient nutrient variety and caloric intake as evidenced by height-for-age Z-score between -3 and -2.',
                    'd' => 'Incorporate protein-rich foods (e.g., meat, beans) and micronutrients (e.g., iron, calcium) to encourage healthy growth.'
                ],
                'Normal' => [
                    'n' => 'Normal growth supported by adequate nutrition as evidenced by height-for-age Z-score between -2 and +2.',
                    // 'd' => 'Maintain a balanced diet with a variety of fruits, vegetables, whole grains, lean proteins, and dairy to support overall health.'
                    'd' => ' '
                ],
                'Tall' => [
                    'n' => 'Above-average height likely due to genetic factors and sufficient nutrient intake, as evidenced by height-for-age Z-score greater than +2.',
                    'd' => 'Continue with a balanced diet, adjusting portions to support growth and daily activity levels.'
                ],
            ];
            $map['stunting_5_19_boy'] = $map['stunting_5_19_girl'];
            $map['stunting_2_5_girl'] = [
                'Severe Stunting (LAZ/HAZ < -3)' => [
                    'n' => 'Severe stunting related to chronic malnutrition and possible recurrent infections, as evidenced by height-for-age Z-score below -3.',
                    'd' => 'Emphasize nutrient-dense, high-protein foods like eggs, dairy, meats, fortified cereals, and calorie-dense snacks to support growth recovery.'
                ],
                'Stunting (LAZ/HAZ between -3 and -2)' => [
                    'n' => 'Stunting related to suboptimal dietary intake and lack of dietary diversity, as evidenced by height-for-age Z-score between -3 and -2.',
                    'd' => 'Increase protein and iron-rich foods, such as beans, lean meats, leafy greens, and fortified cereals, to boost growth and development.'
                ],
                'Normal (LAZ/HAZ between -2 and +2)' => [
                    'n' => 'Normal growth supported by adequate nutrient intake, as evidenced by height-for-age Z-score between -2 and +2.',
                    // 'd' => 'Maintain a balanced diet with a variety of fruits, vegetables, whole grains, lean proteins, and dairy to sustain healthy growth.'
                     'd' => ' '
                ],
                'Tall (LAZ/HAZ > +2)' => [
                    'n' => 'Above-average height potentially related to genetic factors and adequate nutrition, as evidenced by height-for-age Z-score greater than +2.',
                    'd' => 'Ensure continued balanced nutrition with appropriate portions to support proportionate growth and energy needs.'
                ],
            ];
            $map['stunting_2_5_boy'] = $map['stunting_2_5_girl'];
            $map['stunting_birth_to_2_girl'] = [
                'Severe Stunting (LAZ < -3)' => [
                    'n' => 'Severe stunting related to chronic inadequate nutrient intake and frequent infections, as evidenced by length-for-age Z-score below -3.',
                    'd' => 'Prioritize high-calorie, nutrient-dense foods, including fortified cereals, protein-rich sources, and essential fats, and consult with a pediatric nutritionist.'
                ],
                'Stunting (LAZ between -3 and -2)' => [
                    'n' => 'Stunting related to inadequate dietary diversity and insufficient caloric intake, as evidenced by length-for-age Z-score between -3 and -2.',
                    'd' => 'Incorporate iron- and protein-rich foods, including meats, legumes, and leafy greens, to support growth and immunity.'
                ],
                'Normal (LAZ between -2 and +2)' => [
                    'n' => 'Normal growth supported by balanced nutrient intake as evidenced by length-for-age Z-score between -2 and +2.',
                    'd' => 'Maintain a balanced diet that includes a variety of fruits, vegetables, grains, and proteins to support continued healthy growth.'
                ],
                'Tall (LAZ > +2)' => [
                    'n' => 'Height above average likely supported by adequate nutrient intake and genetics, as evidenced by length-for-age Z-score greater than +2.',
                    'd' => 'Continue with a well-balanced diet, ensuring nutrients are proportionate to height and activity levels to maintain balanced growth.'
                ],
            ];
            $map['stunting_birth_to_2_boy'] = $map['stunting_birth_to_2_girl'];

            $wKey = null; $sKey = null;
            if ($ageYears !== null && $ageYears <= 5) { $wKey = $gender === 'female' ? 'wasting_birth_to_5_girl' : 'wasting_birth_to_5_boy'; }
            elseif ($ageYears !== null && $ageYears > 5 && $ageYears <= 19) { $wKey = $gender === 'female' ? 'wasting_5_to_19_girl' : 'wasting_5_to_19_boy'; }
            if ($ageYears !== null && $ageYears < 2) { $sKey = $gender === 'female' ? 'stunting_birth_to_2_girl' : 'stunting_birth_to_2_boy'; }
            elseif ($ageYears !== null && $ageYears >= 2 && $ageYears <= 5) { $sKey = $gender === 'female' ? 'stunting_2_5_girl' : 'stunting_2_5_boy'; }
            elseif ($ageYears !== null && $ageYears >= 5 && $ageYears <= 19) { $sKey = $gender === 'female' ? 'stunting_5_19_girl' : 'stunting_5_19_boy'; }

            $diagParts = []; $dietParts = [];
            if ($wKey && isset($data['details'][$wKey]) && $data['details'][$wKey] !== '' && isset($map[$wKey][$data['details'][$wKey]])) {
                $diagParts[] = $map[$wKey][$data['details'][$wKey]]['n'];
                $dietParts[] = $map[$wKey][$data['details'][$wKey]]['d'];
            }
            if ($sKey && isset($data['details'][$sKey]) && $data['details'][$sKey] !== '' && isset($map[$sKey][$data['details'][$sKey]])) {
                $diagParts[] = $map[$sKey][$data['details'][$sKey]]['n'];
                $dietParts[] = $map[$sKey][$data['details'][$sKey]]['d'];
            }
            $computedNutrition = trim(implode(' ', $diagParts));
            $computedDiet = trim(implode("\n", $dietParts));
            if (empty($data['details']['NutritionistComment'])) { $data['details']['NutritionistComment'] = $computedNutrition; }
            if (empty($data['details']['DietaryAdviceComment'])) { $data['details']['DietaryAdviceComment'] = $computedDiet; }

        return view('admin.details_new', $data);
    }
    }
    /* followUpList */
    public function followUpList(Request $request)
    {

        return view('admin.followUpList');

    }

    /* followUpListDatatable */
    public function followUpListDatatable(Request $request)
    {

        $UserID = auth()->guard('admin')->user()->id;
        $UserRole = auth()->guard('admin')->user()->role;

        // $data = GeneralInfo::orderBy('id', 'desc');

        $data = StudentBiodata::orderBy('id', 'desc')
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

            ->where('deleted', 0);

        if ($UserRole == 2) {

            $data = $data->where(function ($query) use ($UserID) {
                $query->where('created_by', $UserID)->orWhere('updated_by', $UserID);
            });



        }

        if ($request->has('MedicalHistoryType')) {
            dd($request->all());
        }


        // Check for schoolId parameter and apply filter if present

        if ($request->has('schoolId')) {
            $schoolId = $request->input('schoolId');
            $data = $data->where('School_Name', $schoolId); // Adjust this to match your actual field name
        }


        $data = $data->where('Follow_up_Required', 1);
        $data = $data->get()->toArray();

        return Datatables::of($data)
            ->addIndexColumn()

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
                $btn = "";

                // $btn .= ' &nbsp; <a href="' . Route('ViewMedicalHistory') . '/' . $row['id'] . '" title="Edit"><i class="fa fa-eye iic text-light"></i></a>';
                $btn .= ' &nbsp; <a href="' . Route('ViewMedicalHistory1') . '/' . $row['id'] . '" title="View"><i class="fa fa-eye iic"></i></a>';
                // $btn .= ' &nbsp; <a href="' . Route('UpdateMedicalHistory') . '/' . $row['id'] . '" title="Edit"><i class="fa fa-edit iic text-light"></i></a>';
                $btn .= ' &nbsp; <a href="' . Route('StudentBiodata') . '/' . $row['id'] . '" title="Edit"><i class="fa fa-edit iic"></i></a>';
                // $btn .= ' &nbsp; <a href="' . Route('medicalhistorydata') . '/' . $row['id'] . '" title="Edit"><i class="fa fa-edit iic text-light"></i></a>';
    
                $btn .= ' &nbsp;<a title="Delete" href="javascript:void(0)" class="confirmDeleteIt"  data-id="' . $row['id'] . '" data-url="' . Route('DeleteMedicalHistory') . '"> <i class="fa fa-close iic"></i></a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);

    }


    /* followUpList1 */
    public function followUpList1()
    {

        $User = User::get();

        $form = DB::table('form_entries')
            ->select(
                'medical_complains.id as medical_complains_id',
                'form_entries.id',
                'form_entries.name',
                'form_entries.lname',
                'form_entries.psychiatrist_id',
                'form_entries.doc_id',
                'form_entries.gender',
                'schools.school_name as school',
                'cities.name as city',
                'areas.name as area',
                'form_entries.age',
                'form_entries.phone',
                'form_entries.grno',
                'users.fullname as enterby',
                'form_entries.duration',
                'form_entries.created_at'
            )
            ->join('schools', 'form_entries.school', '=', 'schools.id')
            ->join('cities', 'cities.id', '=', 'form_entries.city')
            ->join('users', 'users.id', '=', 'form_entries.enterby')
            ->join('areas', 'areas.id', '=', 'form_entries.area')
            // ->join('medical_complains', 'medical_complains.stdId', '=', 'form_entries.id')
            ->join('medical_complains', function ($join) {
                $join->on('medical_complains.stdId', '=', 'form_entries.id')

                    ->whereRaw('medical_complains.id = (select max(id) from medical_complains where stdId = form_entries.id)');
            })
            ->leftJoin('medical_complains as mc2', function ($join) {
                $join->on('mc2.stdId', '=', 'form_entries.id')
                    ->whereRaw('mc2.id > medical_complains.id');
            })
            ->whereNull('mc2.id') // Ensures only the last record for each stdId is selected
            ->where('medical_complains.followupRequired', 'yes')
            ->orderBy('medical_complains.id', 'desc')
            ->where('medical_complains.followupRequired', 'yes')
            // ->groupBy('medical_complains.stdId') 
            // ->latest('medical_complains.id')
            ->get();





        //  $form = json_decode(json_encode($form),true);
        //  echo "<PRE>";
        // print_r($form);
        // exit;


        return view('admin.followUpList', compact('form', 'User'));



    }
    /* follow-up */
    public function followUpView(request $request, $id, $followId = null)
    {

        if ($request->isMethod('post')) {

            $dataArr = $request->all();

            // echo "<PRE>";
            // print_r($dataArr);
            // exit;

            $rules = array(

                'stdId' => 'required',
                'diagnose' => 'required',
                'followupRequired' => 'required',
                'issue' => 'required',
                // 'dateOfFolloup' => 'required',

            );

            $this->validate($request, $rules);

            $stdId = (isset($dataArr['stdId']) && !empty($dataArr['stdId'])) ? trim($dataArr['stdId']) : null;
            $diagnose = (isset($dataArr['diagnose']) && !empty($dataArr['diagnose'])) ? trim($dataArr['diagnose']) : null;
            $followupRequired = (isset($dataArr['followupRequired']) && !empty($dataArr['followupRequired'])) ? trim($dataArr['followupRequired']) : null;
            $issue = (isset($dataArr['issue']) && !empty($dataArr['issue'])) ? trim($dataArr['issue']) : null;
            $dateOfFolloup = (isset($dataArr['dateOfFolloup']) && !empty($dataArr['dateOfFolloup'])) ? trim($dataArr['dateOfFolloup']) : null;

            $medicalComplain = new medicalComplain();

            $medicalComplain->stdId = $stdId;
            $medicalComplain->diagnose = $diagnose;
            $medicalComplain->followupRequired = $followupRequired;
            $medicalComplain->issue = $issue;
            $medicalComplain->dateOfFolloup = $dateOfFolloup;
            $medicalComplain->save();

            $message = "Created Successfully";
            Session::flash("success_message", $message);
            // return redirect()->back();
            return redirect()->route('GeneralInfo', $stdId);
        }

        $medicalComplain = array();
        if ($followId > 0) {

            $medicalComplain = medicalComplain::where('id', $followId)->first();
            // $medicalComplain = json_decode(json_encode($medicalComplain),true);
        }

        // echo "followId ".$followId;echo "<BR>";exit;

        // $medicalComplain = json_decode(json_encode($medicalComplain),true);
        // echo "<PRE>";
        // print_r($medicalComplain);
        // exit;


        $form = DB::table('form_entries')->where('id', $id)->first(); // Retrieve the specific entry based on ID

        return view('admin.follow-up', ['id' => $id, 'details' => $form, 'medicalComplain' => $medicalComplain]);

    }


    public function detail($id)
    {
        $data['details'] = FormData::where('entry_id', $id)->get();
        $data['area'] = Area::get();
        $data['city'] = City::get();
        $data['school'] = School::get();
        $data['form_id'] = $id;
        return view('admin.detail', $data);
    }
    public function PsychologistFindings(Request $request)
    {
        // dd($request->al());
        $enter_by = Auth::guard('admin')->user()->id;
        $id = $request->id;
        $Psychologist_Findings = FormData::where('entry_id', $id)->where('key', 'Psychologist_Findings')->first();
        $PsychologistRefferedTo = FormData::where('entry_id', $id)->where('key', 'PsychologistRefferedTo')->first();

        if ($Psychologist_Findings) {
            // If the record exists, update its values
            $Psychologist_Findings->value = $request->comment;
            $Psychologist_Findings->if = $enter_by;
            $Psychologist_Findings->save();
        } else {
            // If the record doesn't exist, create a new one
            $newForm = new FormData();
            $newForm->entry_id = $id;
            $newForm->key = 'Psychologist_Findings';
            $newForm->value = $request->comment;
            $newForm->if = $enter_by;
            $newForm->save();
        }

        if ($PsychologistRefferedTo) {
            // If the record exists, update its values
            $PsychologistRefferedTo->value = $request->PsychologistRefferedTo;
            $PsychologistRefferedTo->if = $enter_by;
            $PsychologistRefferedTo->save();
        } else {
            $newForm = new FormData();
            $newForm->entry_id = $id;
            $newForm->key = 'PsychologistRefferedTo';
            $newForm->value = $request->PsychologistRefferedTo;
            $newForm->if = $enter_by;
            $newForm->save();
        }


        return 1;
    }
    public function ViewByphy(Request $request)
    {
        $enter_by = Auth::guard('admin')->user()->id;
        $id = $request->id;
        $form = form_entry::find($id);
        $form->psychiatrist_id = $enter_by;
        $form->save();
        return 1;
    }
    public function ViewByDoc(Request $request)
    {
        // dd($request->all());
        $enter_by = Auth::guard('admin')->user()->id;
        $id = $request->id;
        $form = form_entry::find($id);
        $form->doc_id = $enter_by;
        $form->save();
        return 1;
        
    }
    public function DoctorComment(Request $request){
        // $newForm = new FormData();
        // $newForm->entry_id = $id;
        // $newForm->key = 'doctor_comment';
        // $newForm->value = $request->doctor_comment;
        // $newForm->if = $enter_by;
        // $newForm->save();
        // return 1;
        $enter_by = Auth::guard('admin')->user()->id;
        $id = $request->id;
        $newForm = FormData::where('entry_id', $id)
            ->where('key', 'doctor_comment')
            ->first();

            if ($newForm) {
                // Update the existing record
                $newForm->value = $request->doctor_comment;
                $newForm->if = $enter_by;
                $newForm->save();
            } else {
                // Insert a new record
                $newForm = new FormData();
                $newForm->entry_id = $id;
                $newForm->key = 'doctor_comment';
                $newForm->value = $request->doctor_comment;
                $newForm->if = $enter_by;
                $newForm->save();
            }

            return 1;

    }
    public function ViewBynutritionist(Request $request)
    {
        $enter_by = Auth::guard('admin')->user()->id;
        $id = $request->id;

        $form = form_entry::find($id);
        $form->nutritionist_id = $enter_by;
        $form->save();
        return $id;
    }

    public function doc_performance(Request $request)
    {


        $data = DB::table('form_entries')
            ->select('users.id as UserID', 'users.designation as designation', 'users.fullname', 'form_entries.scan_count', DB::raw('COUNT(*) as count'))
            ->join('users', 'form_entries.enterby', '=', 'users.id')
            ->groupBy('form_entries.enterby', 'users.fullname')
            ->get();

        //   dd($data);

        return view('admin.doctorperformance', compact('data'));
    }

    public function Filter_doc_performance(Request $request)
    {

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $data = DB::table('form_entries')
            ->select('users.fullname', DB::raw('COUNT(*) as count'))
            ->join('users', 'form_entries.enterby', '=', 'users.id')
            ->whereBetween(
                DB::raw('DATE_ADD(form_entries.created_at, INTERVAL 5 HOUR)'),
                [$startDate . ' 00:00:00', $endDate . ' 23:59:59']
            )
            ->groupBy('form_entries.enterby', 'users.fullname')
            ->get();
        // dd($data);
        return view('admin.doctorperformance', compact('data'));
    }
     public function caseIdentified()
        {
            return view('admin.case-identified');
        }
        
   public function caseIdentifiedData(Request $request)
{
    $from = $request->input('from');
    $to = $request->input('to');
    $types = [
        'physician' => [
            'table' => 'school_health_physicians',
            'join_key' => 'StudentBiodataId',
        ],
        'nutritionist' => [
            'table' => 'nutritionist_history_evaluation_sections',
            'join_key' => 'StudentBiodataId',
        ],
        'psychologist' => [
            'table' => 'psychologist_history_assessment_sections',
            'join_key' => 'StudentBiodataId',
        ],
    ];
    $categories = [
        'Case identified through Screening' => 'Screening',
        'Student Identified Through Teachers Training Session' => 'Teacher Training',
        'New Case' => 'New Case',
    ];
    $subcategories = [
        'New Case',
        'Student Identified Through Teachers Training Session',
        'Case identified through Screening',
    ];
    $schools = DB::table('schools')->select('id', 'school_name')->get();
    $result = [];
    foreach ($schools as $school) {
        $schoolData = [
            'school_id' => $school->id,
            'school_name' => $school->school_name,
        ];
        foreach ($types as $typeKey => $typeInfo) {
            $studentQuery = DB::table('student_biodata')
                ->where('School_Name', $school->id)
                ->where('deleted', 0);
            if ($from && $to) {
                $studentQuery = $studentQuery->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
            }
            $students = $studentQuery->pluck('id');
            $cases = DB::table($typeInfo['table'])
                ->whereIn($typeInfo['join_key'], $students)
                ->where('deleted', 0)
                ->get();
            $typeData = [
                'total' => $cases->count(),
                'categories' => [],
            ];
            foreach ($categories as $catKey => $catLabel) {
                // Always include the category, even if count is zero
                $catStudentQuery = DB::table('student_biodata')
                    ->where('School_Name', $school->id)
                    ->where('type_of_encounter', $catKey)
                    ->where('deleted', 0);
                if ($from && $to) {
                    $catStudentQuery = $catStudentQuery->whereBetween('created_at', [$from . ' 00:00:00', $to . ' 23:59:59']);
                }
                $catStudents = $catStudentQuery->pluck('id');
                $catCases = DB::table($typeInfo['table'])
                    ->whereIn($typeInfo['join_key'], $catStudents)
                    ->where('deleted', 0)
                    ->get();
                $typeData['categories'][$catKey] = [
                    'count' => $catCases->count(),
                    'subcategories' => [
                        'students' => $catCases->map(function($case) use ($catStudents) {
                            $student = DB::table('student_biodata')->where('id', $case->StudentBiodataId)->first();
                            return [
                                'id' => $case->StudentBiodataId ?? '',
                                'name' => $student->name ?? '',
                                'phone' => $student->Emergency_Contact_Number ?? '',
                            ];
                        })->toArray(),
                    ],
                ];
                $typeData['total'] += $catCases->count();
            }
            $schoolData[$typeKey] = $typeData;
        }
        $result[] = $schoolData;
    }
    // dd($result);
    return response()->json(['data' => $result]);
}

      function reportable_findings(Request $request){
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = DB::table('schools')
            ->join('form_entries', 'schools.id', '=', 'form_entries.school')
            ->join('form_data', 'form_entries.id', '=', 'form_data.entry_id');

        if ($startDate && $endDate) {
            $query->whereBetween('form_entries.created_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ]);
        }

        $results = DB::table('form_entries')
            ->join('schools', 'form_entries.school', '=', 'schools.id')
            ->when($startDate && $endDate, function($q) use ($startDate, $endDate) {
                return $q->whereBetween('form_entries.created_at', [
                    $startDate . ' 00:00:00',
                    $endDate . ' 23:59:59'
                ]);
            })
            ->select(
                'schools.id',
                'schools.school_name',
                DB::raw('(SELECT COUNT(*) FROM form_entries fe WHERE fe.school = schools.id) as total_students'),
                DB::raw('COUNT(CASE WHEN form_data.key = "Question_No_8_Normal_Posture_Gait" AND form_data.value = "No" THEN form_entries.id END) as NormalPostureCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_9_Mental_Status", "Question_No_8_Mental_Status") AND form_data.value = "Lethargic" THEN form_entries.id END) as MentalStatusCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_10_Look_For_jaundice", "Question_No_9_Look_For_jaundice") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as jaundiceCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_11_Look_For_Clubbing", "Question_No_12_Look_For_Clubbing") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as clubingCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_14_Skin", "Question_No_13_Skin") AND form_data.value IN ("Rash","Allergy","Lesion","Bruises") THEN form_entries.id END) as skinCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_16_Nails", "Question_No_15_Nails") AND form_data.value IN ("Dirty","dirty") THEN form_entries.id END) as nailCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_18_Lice_nits", "Question_No_17_Lice/nits") AND form_data.value IN ("yes","Yes") THEN form_entries.id END) as liceCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_20_Hair_and_Scalp", "Question_No_19_Hair_and_Scalp") AND form_data.value IN ("Color-faded") THEN form_entries.id END) as hairCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_22_Scalp", "Question_No_22_Scalp") AND form_data.value IN ("Scaly","Dry","Moist") THEN form_entries.id END) as ScalpCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_25_Normal_ocular_alignment", "Question_No_22_Normal_ocular_alignment") AND form_data.value IN ("no","No") THEN form_entries.id END) as ocularCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_28_Nystagmus", "Question_No_25_Nystagmus") AND form_data.value IN ("yes","Yes") THEN form_entries.id END) as NystagmusCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_27_Ear_examination", "Question_No_30_Ear_examination") AND form_data.value IN ("Ear wax","Canal infection") THEN form_entries.id END) as EarExaminationCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_32_External_nasal_examinaton", "Question_No_29_External_inasal_examinaton") AND form_data.value IN ("Deformities", "Swelling","Redness","Lesions","Nasal Discharge","Crusting") THEN form_entries.id END) as ExaminationNasalCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_34_Assess_gingiva", "Question_No_31_Assess_gingiva") AND form_data.value IN ("Infection", "Bleed") THEN form_entries.id END) as assesCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_36_Examine_tonsils", "Question_No_34_Examine_tonsils") AND form_data.value IN ("tonsillitis", "Tonsillitis") THEN form_entries.id END) as ExamineTonsileCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_36_Any_Neck_swelling", "Question_No_38_Any_Neck_swelling") AND form_data.value IN ("yes", "Yes") THEN form_entries.id END) as NeckSwelingCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_38_Any_visible_chest_deformity", "Question_No_40_Any_visible_chest_deformity") AND form_data.value IN ("yes", "Yes") THEN form_entries.id END) as ChestDeformatyCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_42_Cardiac_Auscultation", "Question_No_40_Cardiac_Auscultation") AND form_data.value IN ("Murmur", "murmur") THEN form_entries.id END) as CardiacAuscultationCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination", "Question_No_43_Did_you_observe_any_limitations_in_the_child") AND form_data.value IN ("Yes", "yes") THEN form_entries.id END) as jointMotionCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("question_no_47_side-to-side_curvature_in_the_spine_resembling", "Question_No_47_side_to_side_curvature_in_the_spine_resembling") AND form_data.value IN ("C_Shape", "S_Shape") THEN form_entries.id END) as side_to_side_curvatureCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_47_Any_foot_or_toe_abnormalities", "Question_No_49_Any_foot_or_toe_abnormalities") AND form_data.value IN ("Flat Feet","Varus","Valgus","High Arch","Hammer Toe","Bunion") THEN form_entries.id END) as footOrToeCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_54_Do_you_have_any_Allergies", "Question_No_55_Do_you_have_any_Allergies") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as AllergiesCount'),
                DB::raw('COUNT(CASE WHEN form_data.key = "Question_No_3_BMI" AND (CAST(form_data.value AS DECIMAL(10,2)) <= 18.40 OR CAST(form_data.value AS DECIMAL(10,2)) >= 24.10) THEN form_entries.id END) as bmiCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_11_Look_For_anemia", "Question_No_10_Look_For_anemia") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as anemiaCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_24_Normal_Color_vision", "Question_No_27_Normal_Color_vision") AND form_data.value IN ("No","no") THEN form_entries.id END) as ColorVisionCount'),
                DB::raw('COUNT(CASE WHEN form_data.key = "Question_No_24_Visual_acuity_using_Snellens_chart" AND form_data.value IN ("20/30 (6/9) - Below average","20/40 (6/12) - Minimum requirement for driving","20/50 (6/15) - Mild vision impairment","20/60 (6/18) - Blurred vision","20/80 (6/24) - Moderate vision impairment","20/100 (6/30) - Moderate to severe impairment","20/125 (6/38) - Vision severely compromised","20/160 (6/48) - Very poor distance vision","20/200 (6/60) - Legally blind") THEN form_entries.id END) as VisualAcuityRightCount'),
                DB::raw('COUNT(CASE WHEN form_data.key = "Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye" AND form_data.value IN ("20/30 (6/9) - Below average","20/40 (6/12) - Minimum requirement for driving","20/50 (6/15) - Mild vision impairment","20/60 (6/18) - Blurred vision","20/80 (6/24) - Moderate vision impairment","20/100 (6/30) - Moderate to severe impairment","20/125 (6/38) - Vision severely compromised","20/160 (6/48) - Very poor distance vision","20/200 (6/60) - Legally blind") THEN form_entries.id END) as VisualAcuityLeftCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_32_Are_there_dental_caries", "Question_No_35_Are_there_dental_caries") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as cariesCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_15_Breath", "Question_No_14_Breath") AND form_data.value IN ("Bad Breath","Bad Breath") THEN form_entries.id END) as BreathCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_19_Discuss_hygiene_routines_and_practices", "Question_No_18_Discuss_hygiene_routines_and_practices") AND form_data.value IN ("not-aware","not-aware") THEN form_entries.id END) as DiscussHygieneCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_17_Uniform_or_shoes", "Question_No_16_Uniform_or_shoes") AND form_data.value IN ("Untidy","Untidy") THEN form_entries.id END) as UniformCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_21_Any_Hair_Problem", "Question_No_21_Any_Hair_Problem") AND form_data.value IN ("Kinky","Brittle","Dry") THEN form_entries.id END) as HairProblemCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_29_Normal_ears_shape_and_position", "Question_No_26_Normal_ears_shape_and_position") AND form_data.value IN ("No","no") THEN form_entries.id END) as EarShapeCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber", "Question_No_28_Conclusion_of_hearing_test_with_Rinner_and_Weber") AND form_data.value IN ("right_ear_conductive_hearing_loss","left_ear_conductive_hearing_loss","right_ear_sensorineural_hearing_lossleft_ear_sensorineural_hearing_loss") THEN form_entries.id END) as RinnerWeberCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_33_perform_a_nasal_patency_test") AND form_data.value IN ("DNS","Obstruction") THEN form_entries.id END) as potensyTestCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_37_Normal_Speech_development","Question_No_35_Normal_Speech_development") AND form_data.value IN ("No","no") THEN form_entries.id END) as SpeechDevCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_41_Lung_Auscultation","Question_No_39_Lung_Auscultation") AND form_data.value IN ("Ronchi","Wheezing","Crackles","Vesicular Diminished Breath Sound(specify)") THEN form_entries.id END) as LungAuscultationCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen") AND form_data.value IN ("Distention","Scar","Mass") THEN form_entries.id END) as ScarsMassesCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_46_Spinal_curvature_assessment_tick_positive_finding","Question_No_44_Spinal_curvature_assessment_(tick_positive_finding)") AND form_data.value IN ("Uneven shoulders","Shoulder Blade","Uneven waist","Hips") THEN form_entries.id END) as SpinalCurvatureCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_50_Have_EPI_immunization_card","Question_No_48_Have_EPI_immunization_card?") AND form_data.value IN ("No","no") THEN form_entries.id END) as EpiCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_57_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination","Question_No_56_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination") AND form_data.value IN ("Urinary frequency","Urinary urgency","Pain or discomfort during urination","Nocturnal enuresis") THEN form_entries.id END) as DiscomfortDuringUrinationCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("QuestionNo_58_Any_menstrual_abnormality","QuestionNo_57_Any_menstrual_abnormality") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as MenstrualAbnormalityCount'),
               
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_60_How_would_you_describe_your_lifestyle") AND form_data.value IN ("Sedentary") THEN form_entries.id END) as lifestyleCount'),
                DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as addictionCount'),

                )
            ->Join('form_data', 'form_entries.id', '=', 'form_data.entry_id')
            ->groupBy('schools.id', 'schools.school_name')
            ->paginate(50);

        // Calculate totals in backend
        $schoolTotals = [];
        $grandTotal = 0;
        $screenedBySchool = [];
        foreach ($results as $school) {
            $rowTotal = (
                $school->NormalPostureCount +
                $school->jaundiceCount +
                $school->clubingCount +
                $school->skinCount +
                $school->nailCount +
                $school->liceCount +
                $school->hairCount +
                $school->ScalpCount +
                $school->ocularCount +
                $school->NystagmusCount +
                $school->EarExaminationCount +
                $school->ExaminationNasalCount +
                $school->assesCount +
                $school->ExamineTonsileCount +
                $school->NeckSwelingCount +
                $school->ChestDeformatyCount +
                $school->CardiacAuscultationCount +
                $school->jointMotionCount +
                $school->side_to_side_curvatureCount +
                $school->footOrToeCount +
                $school->AllergiesCount +
                $school->bmiCount+
                $school->anemiaCount +
                $school->ColorVisionCount +
                $school->VisualAcuityRightCount +
                $school->VisualAcuityLeftCount +
                $school->cariesCount +
                $school->BreathCount +
                $school->DiscussHygieneCount +
                $school->UniformCount +
                $school->HairProblemCount +
                $school->EarShapeCount +
                $school->RinnerWeberCount +
                $school->potensyTestCount +
                $school->SpeechDevCount +
                $school->LungAuscultationCount +
                $school->ScarsMassesCount +
                $school->SpinalCurvatureCount +
                $school->EpiCount +
                $school->DiscomfortDuringUrinationCount +
                $school->MenstrualAbnormalityCount +
                
                $school->lifestyleCount +
                $school->addictionCount 
            );
            $schoolTotals[$school->school_name] = $rowTotal;
            $grandTotal += $rowTotal;// Calculate screened students for this school
            $screenedQuery = DB::table('form_entries')
                ->where('school', $school->id);
            if ($startDate && $endDate) {
                $screenedQuery->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            }
            $entryIdsForSchool = $screenedQuery->pluck('id')->all();
            $screenedCount = 0;
            if (!empty($entryIdsForSchool)) {
                $screenedCount = DB::table('form_data')
                    ->whereIn('entry_id', $entryIdsForSchool)
                    ->where('key', 'Question_No_1_Height')
                    ->whereNotNull('value')
                    ->where('value', '!=', '')
                    ->distinct('entry_id')
                    ->count('entry_id');
            }
            $screenedBySchool[$school->id] = $screenedCount;
        }

        return view('admin.reportable_findings', compact('results', 'schoolTotals', 'grandTotal', 'screenedBySchool'));
    }


  public function getReportableFindingsBySchool(Request $request)
    {
        $schoolId = $request->input('school_id');
        $finding = $request->input('finding');

        // Map finding to keys/values using getReportableConditions
        $conditions = $this->getReportableConditions();
        $findingMap = [
            'NormalPosture' => 0,
            'MentalStatus' => 1,
            'jaundice' => 2,
            'clubing' => 3,
            'skin' => 4,
            'nail' => 5,
            'lice' => 6,
            'hair' => 7,
            'Scalp' => 8,
            'ocular' => 9,
            'Nystagmus' => 10,
            'EarExamination' => 11,
            'ExaminationNasal' => 12,
            'asses' => 13,
            'ExamineTonsile' => 14,
            'NeckSweling' => 15,
            'ChestDeformaty' => 16,
            'CardiacAuscultation' => 17,
            'jointMotion' => 18,
            'side_to_side_curvature' => 19,
            'footOrToe' => 20,
            'Allergies' => 21,
            'bmiresult' => 22,
            'anemia' => 23,
            'ColorVision' => 24,
            'caries' => 25,
            'Breath' => 26,
            'DiscussHygiene' => 27,
            'Uniform' => 28,
            'HairProblem' => 29,
            'EarShape' => 30,
            'RinnerWeber' => 31,
            'potensyTest' => 32,
            'SpeechDev' => 33,
            'LungAuscultation' => 34,
            'ScarsMasses' => 35,
            'SpinalCurvature' => 36,
            'Epi' => 37,
            'DiscomfortDuringUrination' => 38,
            'MenstrualAbnormality' => 39,
            // 'observation1' => 40,
            // 'observation2' => 41,
            // 'observation3' => 42,
            // 'observation4' => 43,
            // 'observation5' => 44,
            // 'observation6' => 45,
            // 'observation7' => 46,
            // 'observation8' => 47,
            // 'observation9' => 48,
            // 'observation10' => 49,
            'lifestyle' => 40,
            'addiction' => 41,
            'VisualAcuityRight' => 42,
            'VisualAcuityLeft' => 43,
        ];
        if (!isset($findingMap[$finding])) {
            return response()->json(['status' => 'error', 'data' => []]);
        }
        // Special handling for BMI using Question_No_3_BMI numeric thresholds
        if ($finding === 'bmiresult') {
            $students = DB::table('form_entries')
                ->join('form_data', 'form_entries.id', '=', 'form_data.entry_id')
                ->leftJoin('users', 'form_entries.enterby', '=', 'users.id')
                ->select('form_entries.id', 'form_entries.name', 'form_entries.lname', 'form_entries.phone', 'form_data.key', 'form_data.value', 'users.fullname as result_by')
                ->where('form_entries.school', $schoolId)
                ->where('form_data.key', 'Question_No_3_BMI')
                ->where(function($q){
                    $q->whereRaw('CAST(form_data.value AS DECIMAL(10,2)) <= 18.40')
                      ->orWhereRaw('CAST(form_data.value AS DECIMAL(10,2)) >= 24.10');
                })
                ->when($request->start_date && $request->end_date, function($q) use ($request) {
                    return $q->whereBetween('form_entries.created_at', [
                        $request->start_date . ' 00:00:00',
                        $request->end_date . ' 23:59:59'
                    ]);
                })
                ->get();

            $grouped = $students->groupBy('id');
            $result = [];
            foreach ($grouped as $id => $rows) {
                $row = $rows->first();
                $findings = $rows->map(function($item) {
                    return $item->key . ': ' . $item->value;
                })->implode(', ');
                $result[] = [
                    'id' => $row->id,
                    'name' => $row->name,
                    'lname' => $row->lname,
                    'phone' => $row->phone,
                    'result' => $findings,
                    'result_by' => $row->result_by,
                ];
            }
            return response()->json(['status' => 'success', 'data' => $result]);
        }

        $cond = $conditions[$findingMap[$finding]];
        $keys = $cond['keys'];
        $values = $cond['values'];

        // Get students from this school who match the finding (limit 100 for performance)
        $students = DB::table('form_entries')
            ->join('form_data', 'form_entries.id', '=', 'form_data.entry_id')
            ->leftJoin('users', 'form_entries.enterby', '=', 'users.id')
            ->select('form_entries.id', 'form_entries.name', 'form_entries.lname', 'form_entries.phone', 'form_data.key', 'form_data.value', 'users.fullname as result_by')
            ->where('form_entries.school', $schoolId)
            ->whereIn('form_data.key', $keys)
            ->whereIn('form_data.value', $values)
            ->when($request->start_date && $request->end_date, function($q) use ($request) {
                return $q->whereBetween('form_entries.created_at', [
                    $request->start_date . ' 00:00:00',
                    $request->end_date . ' 23:59:59'
                ]);
            })
            // ->limit(100)
            ->get();

        // Group by student id to avoid duplicates
        $grouped = $students->groupBy('id');
        $result = [];
        foreach ($grouped as $id => $rows) {
            $row = $rows->first();
            $findings = $rows->map(function($item) {
                $displayKey = $item->key;
                $displayValue = $item->value;
                if ($item->key == 'observation1') {
                    $displayKey = 'Restless or overactive?';
                    if ($item->value == '3') $displayValue = 'Pretty Much';
                    elseif ($item->value == '4') $displayValue = 'Very Much';
                }
                if ($item->key == 'observation2') {
                    $displayKey = 'Excitable, Impulsive?';
                    if ($item->value == '3') $displayValue = 'Pretty Much';
                    elseif ($item->value == '4') $displayValue = 'Very Much';
                }
                if ($item->key == 'observation3') {
                    $displayKey = 'Disturbs other children?';
                    if ($item->value == '3') $displayValue = 'Pretty Much';
                    elseif ($item->value == '4') $displayValue = 'Very Much';
                }
                if ($item->key == 'observation4') {
                    $displayKey = 'Fails to finish things started';
                    if ($item->value == '3') $displayValue = 'Pretty Much';
                    elseif ($item->value == '4') $displayValue = 'Very Much';
                }
                if ($item->key == 'observation5') {
                    $displayKey = 'Inattentive, easily distracted?';
                    if ($item->value == '3') $displayValue = 'Pretty Much';
                    elseif ($item->value == '4') $displayValue = 'Very Much';
                }
                if ($item->key == 'observation6') {
                    $displayKey = 'Cries often and easily?';
                    if ($item->value == '3') $displayValue = 'Pretty Much';
                    elseif ($item->value == '4') $displayValue = 'Very Much';
                }
                if ($item->key == 'observation7') {
                    $displayKey = 'Is your spelling poor?';
                    if ($item->value == '3') $displayValue = 'Pretty Much';
                    elseif ($item->value == '4') $displayValue = 'Very Much';
                }
                if ($item->key == 'observation8') {
                    $displayKey = 'do you often make mistakes?';
                    if ($item->value == '3') $displayValue = 'Pretty Much';
                    elseif ($item->value == '4') $displayValue = 'Very Much';
                }
                if ($item->key == 'observation9') {
                    $displayKey = 'difficulty in telling left from right?';
                    if ($item->value == '3') $displayValue = 'Pretty Much';
                    elseif ($item->value == '4') $displayValue = 'Very Much';
                }
                if ($item->key == 'observation10') {
                    $displayKey = 'mix up bus numbers?';
                    if ($item->value == '3') $displayValue = 'Pretty Much';
                    elseif ($item->value == '4') $displayValue = 'Very Much';
                }
                return $displayKey . ': ' . $displayValue;
            })->implode(', ');
            $result[] = [
                'id' => $row->id,
                'name' => $row->name,
                'lname' => $row->lname,
                'phone' => $row->phone,
                'result' => $findings,
                'result_by' => $row->result_by,
            ];
        }
        return response()->json(['status' => 'success', 'data' => $result]);
    }

            public function getCaseDetails(Request $request)
                {
                    $idsArray = explode(',', $request->ids);

                    $cases = DB::table('student_biodata')
                                ->whereIn('id', $idsArray)
                                ->get();

                    return response()->json($cases);
                }

    private function getReportableConditions()
    {
        return [
            ['keys' => ["Question_No_8_Normal_Posture_Gait"], 'values' => ['No','no']],
            ['keys' => ["Question_No_9_Mental_Status", "Question_No_8_Mental_Status"], 'values' => ['Lethargic']],
            ['keys' => ["Question_No_10_Look_For_jaundice", "Question_No_9_Look_For_jaundice"], 'values' => ['Yes', 'yes']],
            ['keys' => ["Question_No_11_Look_For_Clubbing", "Question_No_12_Look_For_Clubbing"], 'values' => ['yes','yes']],
            ['keys' => ["Question_No_14_Skin", "Question_No_13_Skin"], 'values' => ['Rash','Allergy','Lesion','Bruises']],
            ['keys' => ["Question_No_16_Nails", "Question_No_15_Nails"], 'values' => ['Dirty','dirty']],
            ['keys' => ["Question_No_18_Lice_nits", "Question_No_17_Lice/nits"], 'values' => ['Yes','yes']],
            ['keys' => ["Question_No_20_Hair_and_Scalp", "Question_No_19_Hair_and_Scalp"], 'values' => ['Color-faded']],
            ['keys' => ["Question_No_22_Scalp", "Question_No_22_Scalp"], 'values' => ['Scaly','Dry','Moist']],
            ['keys' => ["Question_No_25_Normal_ocular_alignment", "Question_No_22_Normal_ocular_alignment"], 'values' => ['No','no']],
            ['keys' => ["Question_No_28_Nystagmus", "Question_No_25_Nystagmus"], 'values' => ['Yes','yes']],
            ['keys' => ["Question_No_27_Ear_examination", "Question_No_30_Ear_examination"], 'values' => ['Ear wax','Canal infection']],
            ['keys' => ["Question_No_32_External_nasal_examinaton", "Question_No_29_External_inasal_examinaton"], 'values' => ['Deformities', 'Swelling','Redness','Lesions','Nasal Discharge','Crusting']],
            ['keys' => ["Question_No_34_Assess_gingiva", "Question_No_31_Assess_gingiva"], 'values' => ['Infection', 'Bleed']],
            ['keys' => ["Question_No_36_Examine_tonsils", "Question_No_34_Examine_tonsils"], 'values' => ['tonsillitis','Tonsillitis']],
            ['keys' => ["Question_No_36_Any_Neck_swelling", "Question_No_38_Any_Neck_swelling"], 'values' => ['Yes']],
            ['keys' => ["Question_No_38_Any_visible_chest_deformity", "Question_No_40_Any_visible_chest_deformity"], 'values' => ['Yes','yes']],
            ['keys' => ["Question_No_42_Cardiac_Auscultation", "Question_No_40_Cardiac_Auscultation"], 'values' => ['Murmur','murmur']],
            ['keys' => ["Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination", "Question_No_43_Did_you_observe_any_limitations_in_the_child"], 'values' => ['Yes','yes']],
            ['keys' => ["question_no_47_side-to-side_curvature_in_the_spine_resembling", "Question_No_47_side_to_side_curvature_in_the_spine_resembling","Question_No_31_Side_to_side_curvature"], 'values' => ['Yes','yes']],
            ['keys' => ["Question_No_47_Any_foot_or_toe_abnormalities", "Question_No_49_Any_foot_or_toe_abnormalities"], 'values' => ['Flat Feet','Varus','Valgus','High Arch','Hammer Toe','Bunion']],
            ['keys' => ["Question_No_54_Do_you_have_any_Allergies", "Question_No_55_Do_you_have_any_Allergies"], 'values' => ['Yes','yes']],
            ['keys' => ["bmiresult"], 'values' => ['High','Low']],
            ['keys' => ["Question_No_11_Look_For_anemia", "Question_No_10_Look_For_anemia"], 'values' => ['Yes','yes']],
            ['keys' => ["Question_No_24_Normal_Color_vision", "Question_No_27_Normal_Color_vision"], 'values' => ['No','no']],
            ['keys' => ["Question_No_32_Are_there_dental_caries", "Question_No_35_Are_there_dental_caries"], 'values' => ['Yes','yes']],
            ['keys' => ["Question_No_14_Breath", "Question_No_15_Breath"], 'values' => ['Bad Breath','Bad Breath']],
            ['keys' => ["Question_No_19_Discuss_hygiene_routines_and_practices", "Question_No_18_Discuss_hygiene_routines_and_practices"], 'values' => ['not-aware','not-aware']],
            ['keys' => ["Question_No_17_Uniform_or_shoes", "Question_No_16_Uniform_or_shoes"], 'values' => ['Untidy','Untidy']],
            ['keys' => ["Question_No_21_Any_Hair_Problem", "Question_No_21_Any_Hair_Problem"], 'values' => ['Kinky','Brittle','Dry']],
            ['keys' => ["Question_No_29_Normal_ears_shape_and_position", "Question_No_26_Normal_ears_shape_and_position"], 'values' => ['No','no']],
            ['keys' => ["Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber", "Question_No_28_Conclusion_of_hearing_test_with_Rinner_and_Weber"], 'values' => ['right_ear_conductive_hearing_loss','left_ear_conductive_hearing_loss','right_ear_sensorineural_hearing_loss','left_ear_sensorineural_hearing_loss']],
            ['keys' => ["Question_No_33_perform_a_nasal_patency_test"], 'values' => ['DNS','Obstruction']],
            ['keys' => ["Question_No_37_Normal_Speech_development","Question_No_35_Normal_Speech_development"], 'values' => ['No','no']],
            ['keys' => ["Question_No_41_Lung_Auscultation","Question_No_39_Lung_Auscultation"], 'values' => ['Ronchi','Wheezing','Crackles','Vesicular Diminished Breath Sound(specify)']],
            ['keys' => ["Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen"], 'values' => ['Distention','Scar','Mass']],
            ['keys' => ["Question_No_46_Spinal_curvature_assessment_tick_positive_finding","Question_No_44_Spinal_curvature_assessment_(tick_positive_finding)"], 'values' => ['Uneven shoulders','Shoulder Blade','Uneven waist','Hips']],
            ['keys' => ["Question_No_50_Have_EPI_immunization_card","Question_No_48_Have_EPI_immunization_card?"], 'values' => ['No','no']],
            ['keys' => ["Question_No_57_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination","Question_No_56_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination"], 'values' => ['Urinary frequency','Urinary urgency','Pain or discomfort during urination','Nocturnal enuresis']],
            ['keys' => ["QuestionNo_58_Any_menstrual_abnormality","QuestionNo_57_Any_menstrual_abnormality"], 'values' => ['Yes','yes']],
            // ['keys' => ["observation1"], 'values' => ['3','4']],
            // ['keys' => ["observation2"], 'values' => ['3','4']],
            // ['keys' => ["observation3"], 'values' => ['3','4']],
            // ['keys' => ["observation4"], 'values' => ['3','4']],
            // ['keys' => ["observation5"], 'values' => ['3','4']],
            // ['keys' => ["observation6"], 'values' => ['3','4']],
            // ['keys' => ["observation7"], 'values' => ['3','4']],
            // ['keys' => ["observation8"], 'values' => ['3','4']],
            // ['keys' => ["observation9"], 'values' => ['3','4']],
            // ['keys' => ["observation10"], 'values' => ['3','4']],
            ['keys' => ["Question_No_60_How_would_you_describe_your_lifestyle"], 'values' => ['Sedentary']],
            ['keys' => ["Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to"], 'values' => ['Yes','yes']],
            ['keys' => ["Question_No_24_Visual_acuity_using_Snellens_chart"], 'values' => [
                '20/30 (6/9) - Below average',
                '20/40 (6/12) - Minimum requirement for driving',
                '20/50 (6/15) - Mild vision impairment',
                '20/60 (6/18) - Blurred vision',
                '20/80 (6/24) - Moderate vision impairment',
                '20/100 (6/30) - Moderate to severe impairment',
                '20/125 (6/38) - Vision severely compromised',
                '20/160 (6/48) - Very poor distance vision',
                '20/200 (6/60) - Legally blind'
            ]],
            ['keys' => ["Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye"], 'values' => [
                '20/30 (6/9) - Below average',
                '20/40 (6/12) - Minimum requirement for driving',
                '20/50 (6/15) - Mild vision impairment',
                '20/60 (6/18) - Blurred vision',
                '20/80 (6/24) - Moderate vision impairment',
                '20/100 (6/30) - Moderate to severe impairment',
                '20/125 (6/38) - Vision severely compromised',
                '20/160 (6/48) - Very poor distance vision',
                '20/200 (6/60) - Legally blind'
            ]],
        ];
    }

    public function showStudentFinding($id)
    {
        $student = DB::table('form_entries')
            ->join('schools', 'form_entries.school', '=', 'schools.id')
            ->select('form_entries.id', 'form_entries.name', 'form_entries.lname', 'form_entries.phone', 'schools.school_name')
            ->where('form_entries.id', $id)
            ->first();

        $conditions = $this->getReportableConditions();

        // Build the query with ORs for each key-value pair group
        $findings = DB::table('form_data')
            ->where('entry_id', $id)
            ->where(function ($query) use ($conditions) {
                foreach ($conditions as $condition) {
                    $query->orWhere(function ($q) use ($condition) {
                        $q->whereIn('key', $condition['keys'])
                          ->whereIn('value', $condition['values']);
                    });
                }
            })
            ->select('key', 'value')
            ->get()
            ->unique(function ($item) {
                return $item->key . '|' . $item->value;
            })
            ->values()
            ->toArray();

        $schoolName = $student->school_name ?? '';

        return view('admin.student_finding', [
            'student' => $student,
            'findings' => $findings,
            'schoolName' => $schoolName,
        ]);
    }

   public function followupSummaryReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Category mapping
        $categoryMap = [
            1 => 'Psychologist',
            2 => 'Nutritionist',
            4 => 'External Specialists',
            5 => 'General Physician',
        ];
        $categories = array_values($categoryMap);

        // Step 1: Get all form_entries IDs with Follow_up_Required = yes
        $followupQuery = DB::table('form_data')
            ->select('entry_id')
            ->where('key', 'Follow_up_Required')
            ->whereRaw('LOWER(value) = ?', ['yes'])
            ->groupBy('entry_id');

        // Step 2: Join with form_entries and schools
        $studentsQuery = DB::table('form_entries')
            ->join('schools', 'form_entries.school', '=', 'schools.id')
            ->whereIn('form_entries.id', $followupQuery)
            ->select('form_entries.id as entry_id', 'form_entries.name as student_name', 'form_entries.phone', 'schools.school_name', 'schools.id as school_id');

        if ($startDate && $endDate) {
            $studentsQuery->whereBetween('form_entries.created_at', [$startDate, $endDate]);
        }

        $students = $studentsQuery->get();
        $entryIds = $students->pluck('entry_id')->all();

        // Step 3: Get all refer_to/refer_to[] values for these students
        $referData = DB::table('form_data')
            ->whereIn('entry_id', $entryIds)
            ->whereIn('key', ['refer_to', 'refer_to[]'])
            ->get();

        // Group refer_to data by entry_id
        $referByEntry = [];
        foreach ($referData as $row) {
            $vals = [];
            $value = $row->value;
            // Try to decode JSON array, fallback to string/int
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $vals = $decoded;
            } else {
                $vals = [$value];
            }
            foreach ($vals as $v) {
                $v = (string) $v;
                if (is_numeric($v)) {
                    $referByEntry[$row->entry_id][] = (int) $v;
                }
            }
        }

        // Step 4: Build summary per school and category
        $summary = [];
        foreach ($students as $student) {
            $school = $student->school_name;
            $entry_id = $student->entry_id;
            if (!isset($summary[$school])) {
                foreach ($categories as $cat) {
                    $summary[$school][$cat] = [
                        'count' => 0,
                        'students' => []
                    ];
                }
            }
            $studentCategories = isset($referByEntry[$entry_id]) ? $referByEntry[$entry_id] : [];
            $addedCats = [];
            foreach ($studentCategories as $catId) {
                if (isset($categoryMap[$catId]) && !in_array($catId, $addedCats)) {
                    $catName = $categoryMap[$catId];
                    $summary[$school][$catName]['count']++;
                    $summary[$school][$catName]['students'][] = [
                        'name' => $student->student_name,
                        'phone' => $student->phone,
                        'entry_id' => $entry_id,
                    ];
                    $addedCats[] = $catId;
                }
            }
        }

        // Step 5: Prepare data for Blade
        $data = [];
        // Prepare a map of school_name => school_id for efficient lookup
        $schoolNameToId = $students->pluck('school_id', 'school_name')->all();
        // Prepare a map of school_name => entry_ids for unique student count
        $schoolEntryIds = [];
        foreach ($students as $student) {
            $school = $student->school_name;
            $entry_id = $student->entry_id;
            $schoolEntryIds[$school][] = $entry_id;
        }
        foreach ($summary as $school => $counts) {
            $row = ['school' => $school];
            // 'total' is the count of form_entries for this school (optionally filter by date)
            $school_id = $schoolNameToId[$school] ?? null;
            $totalCount = 0;
            if ($school_id) {
                $totalQuery = DB::table('form_entries')->where('school', $school_id);
                if ($startDate && $endDate) {
                    $totalQuery->whereBetween('created_at', [$startDate, $endDate]);
                }
                $totalCount = $totalQuery->count();
            }
            $row['total'] = $totalCount;
            foreach ($categories as $cat) {
                $row[$cat] = $counts[$cat]['count'];
                $row[$cat . '_students'] = $counts[$cat]['students'];
            }
            // Add screened_students count
            $screenedCount = 0;
            if ($school_id) {
                // Get all form_entries for this school (optionally filter by date)
                $screenedQuery = DB::table('form_entries')
                    ->where('school', $school_id);
                if ($startDate && $endDate) {
                    $screenedQuery->whereBetween('created_at', [$startDate, $endDate]);
                }
                $entryIdsForSchool = $screenedQuery->pluck('id')->all();
                if (!empty($entryIdsForSchool)) {
                    $screenedCount = DB::table('form_data')
                        ->whereIn('entry_id', $entryIdsForSchool)
                        ->where('key', 'Question_No_1_Height')
                        ->whereNotNull('value')
                        ->where('value', '!=', '')
                        ->distinct('entry_id')
                        ->count('entry_id');
                }
            }
            $row['screened_students'] = $screenedCount;
            $data[] = $row;
        }

        return view('admin.followup_summary_report', [
            'data' => $data,
            'types' => $categories,
            'all_details_json' => json_encode($data),
        ]);
    }
 
    public function assesmentSummaryReport(Request $request)
    {
        // Group all physician types under one
        $titles = [
            // 'Child Health Checkup Survey',
            // 'General Physician', // This will be the unified column
            'School Health Physician',
            'Psychologist History & Assessment Section',
            // 'Presenting Complain',
            'Nutritionist History & Evaluation Section',
            // 'Psychologist',
            // 'Nutritionist',
            // 'External Specialists',
        ];
        $physician_titles = [
            // 'Physician',
            // 'General Physician',
            // 'General Physician (school health physician )',
        ];
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $events1Query = DB::table('calendar_events')
            ->join('form_entries', 'calendar_events.event_id', '=', 'form_entries.id')
            ->join('schools', 'form_entries.school', '=', 'schools.id')
            ->where('calendar_events.deleted', 0)
            ->where('calendar_events.event_type', 2)
            ->where('calendar_events.redirect_link', 'like', '%/cphs.biopharmainfo.net/Medical_Detail/%')
            ->where(function($q) use ($titles, $physician_titles) {
                $q->whereIn('calendar_events.title', array_diff($titles, ['General Physician']))
                  ->orWhereIn('calendar_events.title', $physician_titles);
            });
        $events2Query = DB::table('calendar_events')
            ->join('student_biodata', function($join) {
                $join->on('calendar_events.event_id', '=', 'student_biodata.id')
                     ->where('student_biodata.deleted', 0);
            })
            ->join('schools', 'student_biodata.School_Name', '=', 'schools.id')
            ->where('calendar_events.deleted', 0)
            ->where('calendar_events.event_type', 1)
            ->where('calendar_events.redirect_link', 'not like', '%/cphs.biopharmainfo.net/Medical_Detail/%')
            ->where(function($q) use ($titles, $physician_titles) {
                $q->whereIn('calendar_events.title', array_diff($titles, ['General Physician']))
                  ->orWhereIn('calendar_events.title', $physician_titles);
            });
        if ($startDate && $endDate) {
            $events1Query->whereBetween('calendar_events.startDate', [$startDate, $endDate]);
            $events2Query->whereBetween('calendar_events.startDate', [$startDate, $endDate]);
        }
        $events1 = $events1Query->select('schools.school_name', 'calendar_events.title', 'form_entries.name as student_name', 'form_entries.phone', 'calendar_events.redirect_link')->get();
        $events2 = $events2Query->select('schools.school_name', 'calendar_events.title', 'student_biodata.Name as student_name', 'student_biodata.Emergency_Contact_Number as phone', 'calendar_events.redirect_link')->get();
        $allEvents = $events1->concat($events2);
        $summary = [];
        foreach ($allEvents as $event) {
            $school = $event->school_name;
            // Map all physician types to 'General Physician'
            $title = in_array($event->title, $physician_titles) ? 'General Physician' : $event->title;
            if (!isset($summary[$school])) {
                foreach ($titles as $t) {
                    $summary[$school][$t] = [
                        'count' => 0,
                        'students' => []
                    ];
                }
            }
            if (in_array($title, $titles)) {
                $summary[$school][$title]['count']++;
                $summary[$school][$title]['students'][] = [
                    'name' => $event->student_name,
                    'phone' => $event->phone,
                    'redirect_link' => $event->redirect_link,
                ];
            }
        }
        $data = [];
        foreach ($summary as $school => $counts) {
            $row = ['school' => $school, 'total' => 0];
            foreach ($titles as $t) {
                $row[$t] = $counts[$t]['count'];
                $row[$t . '_students'] = $counts[$t]['students'];
                $row['total'] += $counts[$t]['count'];
            }
            $data[] = $row;
        }
        return view('admin.assestmen_summary_report', [
            'data' => $data,
            'types' => $titles,
            'all_details_json' => json_encode($data),
        ]);
    }
    // AJAX endpoint for finding count
    public function getFindingCount(Request $request)
    {
        $schoolId = $request->input('school_id');
        $finding = $request->input('finding');

        // Get all reportable conditions
        $conditions = $this->getReportableConditions();

        // Map finding name to index (e.g., finding_1, finding_2, ...)
        // You may want to use a more descriptive key if available
        $map = [];
        foreach ($conditions as $idx => $cond) {
            $map['finding_' . ($idx + 1)] = $cond;
        }

        if (!isset($map[$finding])) {
            return response()->json(['count' => 0]);
        }

        $keys = $map[$finding]['keys'];
        $values = $map[$finding]['values'];

        $count = DB::table('form_entries')
            ->join('form_data', 'form_entries.id', '=', 'form_data.entry_id')
            ->where('form_entries.school', $schoolId)
            ->whereIn('form_data.key', $keys)
            ->whereIn('form_data.value', $values)
            ->count();

        return response()->json(['count' => $count]);
    }

    public function PhysiciancaseIdentified()
        {
            return view('admin.physician-case-identified');
        }

    public function PhysiciancaseIdentifiedgetdata(Request $request)
        {
            $from = $request->input('from');
            $to = $request->input('to');

            // Default (all-time) counts
            $defaultResults = DB::table('schools')
                ->join('student_biodata', 'schools.id', '=', 'student_biodata.School_Name')
                ->join('school_health_physicians','school_health_physicians.StudentBiodataId','=','student_biodata.id')
                ->where('school_health_physicians.deleted', '=', 0)
                ->where('student_biodata.deleted', '=', 0)
                ->select(
                    'schools.id as school_id',
                    'schools.school_name',
                    DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Case identified through Screening"  THEN student_biodata.id END) as ScreeningCount'),
                    DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Case identified through Screening"  THEN student_biodata.id END) as ScreeningIds'),
                    DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Follow-up Case"  THEN student_biodata.id END) as FollowUpCaseCount'),
                    DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Follow-up Case"  THEN student_biodata.id END) as FollowUpCaseIds'),
                    DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "New Case"  THEN student_biodata.id END) as NewCaseCount'),
                    DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "New Case"  THEN student_biodata.id END) as NewCaseIds'),
                    DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Student Identified Through Teachers Training Session"  THEN student_biodata.id END) as TrainingSessionCount'),
                    DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Student Identified Through Teachers Training Session"  THEN student_biodata.id END) as TrainingSessionIds')
                )
                ->groupBy('schools.id', 'schools.school_name')
                ->get();

            // Filtered counts (if date range provided)
            $filteredResults = null;
            if ($from && $to) {
                $filteredResults = DB::table('schools')
                ->join('student_biodata', 'schools.id', '=', 'student_biodata.School_Name')
                ->join('school_health_physicians','school_health_physicians.StudentBiodataId','=','student_biodata.id')
                ->where('school_health_physicians.deleted', '=', 0)
                ->where('student_biodata.deleted', '=', 0)
                    ->whereBetween('student_biodata.created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
                    ->select(
                        'schools.id as school_id',
                        'schools.school_name',
                        DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Case identified through Screening"  THEN student_biodata.id END) as ScreeningCount'),
                        DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Case identified through Screening"  THEN student_biodata.id END) as ScreeningIds'),
                        DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Follow-up Case"  THEN student_biodata.id END) as FollowUpCaseCount'),
                        DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Follow-up Case"  THEN student_biodata.id END) as FollowUpCaseIds'),
                        DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "New Case"  THEN student_biodata.id END) as NewCaseCount'),
                        DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "New Case"  THEN student_biodata.id END) as NewCaseIds'),
                        DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Student Identified Through Teachers Training Session"  THEN student_biodata.id END) as TrainingSessionCount'),
                        DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Student Identified Through Teachers Training Session"  THEN student_biodata.id END) as TrainingSessionIds')
                    )
                    ->groupBy('schools.id', 'schools.school_name')
                    ->get();
            }

            // If AJAX/DataTables request, return both sets
            return response()->json([
                'default' => $defaultResults,
                'filtered' => $filteredResults,
            ]);
        }

                public function psychologistassesmentfields()
        {
            return view('admin.psychologist-case-identified');
        }
        public function psychologistIdentifiedgetdata(Request $request)
        {
            $from = $request->input('from');
            $to = $request->input('to');

            // Default (all-time) counts
            $defaultResults = DB::table('schools')
                ->join('student_biodata', 'schools.id', '=', 'student_biodata.School_Name')
                ->join('psychologist_history_assessment_sections','psychologist_history_assessment_sections.StudentBiodataId','=','student_biodata.id')
                ->where('psychologist_history_assessment_sections.deleted', '=', 0)
                ->where('student_biodata.deleted', '=', 0)
                ->select(
                    'schools.id as school_id',
                    'schools.school_name',
                    DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Case identified through Screening"  THEN student_biodata.id END) as ScreeningCount'),
                    DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Case identified through Screening"  THEN student_biodata.id END) as ScreeningIds'),
                    DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Follow-up Case"  THEN student_biodata.id END) as FollowUpCaseCount'),
                    DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Follow-up Case"  THEN student_biodata.id END) as FollowUpCaseIds'),
                    DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "New Case"  THEN student_biodata.id END) as NewCaseCount'),
                    DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "New Case"  THEN student_biodata.id END) as NewCaseIds'),
                    DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Student Identified Through Teachers Training Session"  THEN student_biodata.id END) as TrainingSessionCount'),
                    DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Student Identified Through Teachers Training Session"  THEN student_biodata.id END) as TrainingSessionIds')
                )
                ->groupBy('schools.id', 'schools.school_name')
                ->get();

            // Filtered counts (if date range provided)
            $filteredResults = null;
            if ($from && $to) {
                $filteredResults = DB::table('schools')
                ->join('student_biodata', 'schools.id', '=', 'student_biodata.School_Name')
                ->join('psychologist_history_assessment_sections','psychologist_history_assessment_sections.StudentBiodataId','=','student_biodata.id')
                ->where('psychologist_history_assessment_sections.deleted', '=', 0)
                ->where('student_biodata.deleted', '=', 0)
                    ->whereBetween('student_biodata.created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
                    ->select(
                        'schools.id as school_id',
                        'schools.school_name',
                        DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Case identified through Screening"  THEN student_biodata.id END) as ScreeningCount'),
                        DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Case identified through Screening"  THEN student_biodata.id END) as ScreeningIds'),
                        DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Follow-up Case"  THEN student_biodata.id END) as FollowUpCaseCount'),
                        DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Follow-up Case"  THEN student_biodata.id END) as FollowUpCaseIds'),
                        DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "New Case"  THEN student_biodata.id END) as NewCaseCount'),
                        DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "New Case"  THEN student_biodata.id END) as NewCaseIds'),
                        DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Student Identified Through Teachers Training Session"  THEN student_biodata.id END) as TrainingSessionCount'),
                        DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Student Identified Through Teachers Training Session"  THEN student_biodata.id END) as TrainingSessionIds')
                    )
                    ->groupBy('schools.id', 'schools.school_name')
                    ->get();
            }

            // If AJAX/DataTables request, return both sets
            return response()->json([
                'default' => $defaultResults,
                'filtered' => $filteredResults,
            ]);
        }

            public function nutritionistassesmentfields()
            {
                return view('admin.nutritionist-case-identified');
            }

        public function nutritionistIdentifiedgetdata(Request $request)
            {
                $from = $request->input('from');
                $to = $request->input('to');

                // Default (all-time) counts
                $defaultResults = DB::table('schools')
                    ->join('student_biodata', 'schools.id', '=', 'student_biodata.School_Name')
                    ->join('nutritionist_history_evaluation_sections','nutritionist_history_evaluation_sections.StudentBiodataId','=','student_biodata.id')
                    ->where('nutritionist_history_evaluation_sections.deleted', '=', 0)
                    ->where('student_biodata.deleted', '=', 0)
                    ->select(
                        'schools.id as school_id',
                        'schools.school_name',
                        DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Case identified through Screening"  THEN student_biodata.id END) as ScreeningCount'),
                        DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Case identified through Screening"  THEN student_biodata.id END) as ScreeningIds'),
                        DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Follow-up Case"  THEN student_biodata.id END) as FollowUpCaseCount'),
                        DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Follow-up Case"  THEN student_biodata.id END) as FollowUpCaseIds'),
                        DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "New Case"  THEN student_biodata.id END) as NewCaseCount'),
                        DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "New Case"  THEN student_biodata.id END) as NewCaseIds'),
                        DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Student Identified Through Teachers Training Session"  THEN student_biodata.id END) as TrainingSessionCount'),
                        DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Student Identified Through Teachers Training Session"  THEN student_biodata.id END) as TrainingSessionIds')
                    )
                    ->groupBy('schools.id', 'schools.school_name')
                    ->get();

                // Filtered counts (if date range provided)
                $filteredResults = null;
                if ($from && $to) {
                    $filteredResults = DB::table('schools')
                    ->join('student_biodata', 'schools.id', '=', 'student_biodata.School_Name')
                    ->join('nutritionist_history_evaluation_sections','nutritionist_history_evaluation_sections.StudentBiodataId','=','student_biodata.id')
                    ->where('nutritionist_history_evaluation_sections.deleted', '=', 0)
                    ->where('student_biodata.deleted', '=', 0)
                        ->whereBetween('student_biodata.created_at', [$from . ' 00:00:00', $to . ' 23:59:59'])
                        ->select(
                            'schools.id as school_id',
                            'schools.school_name',
                            DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Case identified through Screening"  THEN student_biodata.id END) as ScreeningCount'),
                            DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Case identified through Screening"  THEN student_biodata.id END) as ScreeningIds'),
                            DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Follow-up Case"  THEN student_biodata.id END) as FollowUpCaseCount'),
                            DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Follow-up Case"  THEN student_biodata.id END) as FollowUpCaseIds'),
                            DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "New Case"  THEN student_biodata.id END) as NewCaseCount'),
                            DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "New Case"  THEN student_biodata.id END) as NewCaseIds'),
                            DB::raw('COUNT(CASE WHEN student_biodata.type_of_encounter = "Student Identified Through Teachers Training Session"  THEN student_biodata.id END) as TrainingSessionCount'),
                            DB::raw('GROUP_CONCAT(CASE WHEN student_biodata.type_of_encounter = "Student Identified Through Teachers Training Session"  THEN student_biodata.id END) as TrainingSessionIds')
                        )
                        ->groupBy('schools.id', 'schools.school_name')
                        ->get();
                }

                // If AJAX/DataTables request, return both sets
                return response()->json([
                    'default' => $defaultResults,
                    'filtered' => $filteredResults,
                ]);
            }
}
