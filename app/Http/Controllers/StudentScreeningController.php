<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

use App\Models\School;
use App\Models\Area;
use App\Models\City;


class StudentScreeningController extends Controller
{


  
    

    private function Miscellaneous(Request $request)
    {
        try {
            // Step 1: Validate the request
            $validatedData = $request->validate([
                'bio_data_id' => 'required|integer',
                'screeningFormId' => 'required|integer',
                'Question_No_55_Do_you_have_any_Allergies' => 'required|in:Yes,No',
                'Do_you_have_any_allergies_specify' => 'nullable|string|max:255',
                'Question_No_56_Girls_above_8_years_old_ask' => 'nullable|integer|min:1|max:100',
                'Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination' => 'nullable|string',
                'QuestionNo_58_Any_menstrual_abnormality' => 'required|in:Yes,No',
                'Any_menstrual_abnormality_specify' => 'nullable|string|max:255',
                'miscellaneous_comment' => 'nullable|string|max:500',
            ], [
                'Question_No_56_Girls_above_8_years_old_ask.min' => 'The age of menarche must be at least 1.',
                'Question_No_56_Girls_above_8_years_old_ask.max' => 'The age of menarche cannot be greater than 100.',
            ]);

            // Step 2: Check if a record already exists for this bio_data_id
            $miscellaneous = DB::table('miscellaneous')
                ->where('bio_data_id', $validatedData['bio_data_id'])
                ->where('deleted', 0)
                ->first();

            // Step 3: Prepare the data for saving
            $data = [
                'bio_data_id' => $validatedData['bio_data_id'],
                'screeningFormId' => $validatedData['screeningFormId'],
                'allergies' => $validatedData['Question_No_55_Do_you_have_any_Allergies'],
                'allergies_specify' => $validatedData['Do_you_have_any_allergies_specify'] ?? null,
                'menarche_age' => $validatedData['Question_No_56_Girls_above_8_years_old_ask'] ?? null,
                'urinary_issues' => $validatedData['Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination'] ?? null,
                'menstrual_abnormality' => $validatedData['QuestionNo_58_Any_menstrual_abnormality'],
                'menstrual_abnormality_specify' => $validatedData['Any_menstrual_abnormality_specify'] ?? null,
                'miscellaneous_comment' => $validatedData['miscellaneous_comment'] ?? null,
                'created_by' => auth()->id() ?? 0,
                'updated_by' => auth()->id() ?? 0,
            ];

            // Step 4: Insert or update the record
            if ($miscellaneous) {
                // Update existing record
                DB::table('miscellaneous')
                    ->where('id', $miscellaneous->id)
                    ->update($data);
            } else {
                // Insert new record
                $data['created_at'] = now();
                DB::table('miscellaneous')->insert($data);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {

            // dd($e->getMessage());


            // If validation fails, redirect back with errors
            return redirect()->back()->withErrors($e->validator)->withInput();
        }

      
    }




    /* Vaccination */
    private function Vaccination(Request $request)
    {
        // Step 1: Validate the request
        $validatedData = $request->validate([
            'bio_data_id' => 'required|integer',
            'screeningFormId' => 'required|integer',
            'Question_No_50_Have_EPI_immunization_card' => 'required|in:Yes,No',
            'Reason_of_not_being_vaccinated' => 'nullable|string|max:255',
            'vaccinations' => 'nullable|array',
            'vaccinations.*' => 'string',
            'vaccination_comment' => 'nullable|string|max:500',
        ]);

        // Step 2: Check if a record already exists for this bio_data_id
        $Vaccination = DB::table('vaccination')
            ->where('bio_data_id', $validatedData['bio_data_id'])
            ->where('deleted', 0)
            ->first();

        // Step 3: Prepare the data for saving
        $data = [
            'bio_data_id' => $validatedData['bio_data_id'],
            'screeningFormId' => $validatedData['screeningFormId'],
            'immunization_card' => $validatedData['Question_No_50_Have_EPI_immunization_card'],
            'reason_of_not_being_vaccinated' => $validatedData['Reason_of_not_being_vaccinated'] ?? null,
            // Check if vaccinations exist and join them into a string
            'vaccinations_completed' => isset($validatedData['vaccinations']) ? implode(',', $validatedData['vaccinations']) : null,
            'vaccination_comment' => $validatedData['vaccination_comment'] ?? null,
            'created_by' => auth()->id() ?? 0,
            'updated_by' => auth()->id() ?? 0,
        ];

        // Step 4: Insert or update the record
        if ($Vaccination) {
            // Update existing record
            DB::table('vaccination')
                ->where('id', $Vaccination->id)
                ->update($data);
        } else {
            // Insert new record
            $data['created_at'] = now();
            DB::table('vaccination')->insert($data);
        }
    }




    /* Musculoskeletal */
    private function Musculoskeletal(Request $request)
    {
        // Step 1: Validate the request
        $validatedData = $request->validate([
            'bio_data_id' => 'required|integer',
            'screeningFormId' => 'required|integer',
            'Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination' => 'required|in:Yes,No',
            'Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination' => 'nullable|string|max:255',
            'Question_No_46_Spinal_curvature_assessment_tick_positive_finding' => 'required|in:Uneven shoulders,Shoulder Blade,Uneven waist,Hips,Normal',
            'Question_No_47_side-to-side_curvature_in_the_spine_resembling' => 'required|in:S_Shape,C_Shape,Normal',
            'Question_No_48_Adams_forward_bend_test' => 'required|in:Positive,Negative',
            'Question_No_49_Any_foot_or_toe_abnormalities' => 'required|in:Normal,Flat Feet,Varus,Valgus,High Arch,Hammer Toe,Bunion',
            'musculoskeletal_comment' => 'required|string|max:500',
        ]);

        // Step 2: Check if a record already exists for this bio_data_id
        $existingRecord = DB::table('musculoskeletal')
            ->where('bio_data_id', $validatedData['bio_data_id'])
            ->where('deleted', 0)
            ->first();

        // Step 3: Prepare the data for saving
        $data = [
            'bio_data_id' => $validatedData['bio_data_id'],
            'screeningFormId' => $validatedData['screeningFormId'],
            'limitations_range_motion' => $validatedData['Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination'],
            'limitations_specify' => $validatedData['Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination'] ?? null,
            'spinal_curvature_assessment' => $validatedData['Question_No_46_Spinal_curvature_assessment_tick_positive_finding'],
            'curvature_spine_resembling' => $validatedData['Question_No_47_side-to-side_curvature_in_the_spine_resembling'],
            'adams_forward_bend_test' => $validatedData['Question_No_48_Adams_forward_bend_test'],
            'foot_or_toe_abnormalities' => $validatedData['Question_No_49_Any_foot_or_toe_abnormalities'],
            'comment' => $validatedData['musculoskeletal_comment'],
            'created_by' => auth()->id() ?? 0,
            'updated_by' => auth()->id() ?? 0,
        ];

        // Step 4: Insert or update the record
        if ($existingRecord) {
            // Update existing record
            DB::table('musculoskeletal')
                ->where('id', $existingRecord->id)
                ->update($data);
        } else {
            // Insert new record
            $data['created_at'] = now();
            DB::table('musculoskeletal')->insert($data);
        }
    }


    /* Abdomens */
    private function Abdomens(Request $request)
    {
        // Step 1: Validate the request
        $validatedData = $request->validate([
            'bio_data_id' => 'required|integer',
            'screeningFormId' => 'required|integer',
            'Question_No_43_Did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen' => 'required|in:Distention,Scar,Mass,Normal',
            'Question_No_44_Any_history_of_abdominal_Pain' => 'required|in:Yes,No',
            'any_history_of_abdominal_pain_specify' => 'nullable|string|max:255',
            'abdomens_comment' => 'required|string|max:500',
        ]);

        // Step 2: Check if a record already exists for this bio_data_id
        $existingRecord = DB::table('Abdomens')
            ->where('bio_data_id', $validatedData['bio_data_id'])
            ->where('deleted', 0)
            ->first();

        // Step 3: Prepare the data for saving
        $data = [
            'bio_data_id' => $validatedData['bio_data_id'],
            'screeningFormId' => $validatedData['screeningFormId'],
            'distention_scar_mass' => $validatedData['Question_No_43_Did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen'],
            'any_history_of_abdominal_pain' => $validatedData['Question_No_44_Any_history_of_abdominal_Pain'],
            'any_history_of_abdominal_pain_specify' => $validatedData['any_history_of_abdominal_pain_specify'] ?? null,
            'abdomen_comment' => $validatedData['abdomens_comment'],
            'created_by' => auth()->id() ?? 0,
            'updated_by' => auth()->id() ?? 0,
        ];

        // Step 4: Insert or update the record
        if ($existingRecord) {
            // Update existing record
            DB::table('Abdomens')
                ->where('id', $existingRecord->id)
                ->update($data);
        } else {
            // Insert new record
            $data['created_at'] = now();
            DB::table('Abdomens')->insert($data);
        }
    }




    /* ChestExamination */
    private function ChestExamination(Request $request)
    {
        // Step 1: Validate the request
        $validatedData = $request->validate([
            'bio_data_id' => 'required|integer',
            'screeningFormId' => 'required|integer',
            'Question_No_40_Any_visible_chest_deformity' => 'required|in:Yes,No',
            'Question_No_41_Lung_Auscultation' => 'required|in:Ronchi,Wheezing,Crackles,Vesicular_Breathing,Vesicular Diminished Breath Sound(specify)',
            'Question_No_42_Cardiac_Auscultation' => 'required|in:Normal S1/S2,Murmur',
            'chest_comment' => 'required|string|max:500',
        ]);

        // Step 2: Check if a record already exists for this bio_data_id
        $existingRecord = DB::table('chestexaminations')
            ->where('bio_data_id', $validatedData['bio_data_id'])
            ->where('deleted', 0)
            ->first();

        // Step 3: Prepare the data for saving
        $data = [
            'bio_data_id' => $validatedData['bio_data_id'],
            'screeningFormId' => $validatedData['screeningFormId'],
            'Question_No_40_Any_visible_chest_deformity' => $validatedData['Question_No_40_Any_visible_chest_deformity'],
            'Question_No_41_Lung_Auscultation' => $validatedData['Question_No_41_Lung_Auscultation'],
            'Question_No_42_Cardiac_Auscultation' => $validatedData['Question_No_42_Cardiac_Auscultation'],
            'chest_comment' => $validatedData['chest_comment'],
            'created_by' => auth()->id() ?? 0,
            'updated_by' => auth()->id() ?? 0,
        ];

        // Step 4: Insert or update the record
        if ($existingRecord) {
            // Update existing record
            DB::table('chestexaminations')
                ->where('id', $existingRecord->id)
                ->update($data);
        } else {
            // Insert new record
            $data['created_at'] = now();
            DB::table('chestexaminations')->insert($data);
        }
    }


    /* ThroatExamination */
    private function ThroatExamination(Request $request)
    {
        // Step 1: Validate the request
        $validatedData = $request->validate([
            'bio_data_id' => 'required|integer',
            'screeningFormId' => 'required|integer',
            'Question_No_36_Examine_tonsils' => 'required|in:Normal,Tonsillitis,Tonsillectomy done',
            'Question_No_37_Normal_Speech_development' => 'required|in:Yes,No',
            'Question_No_38_Any_Neck_swelling' => 'required|in:Yes,No',
            'Specify_Any_Neck_swelling' => 'nullable|string|max:255',
            'Question_No_39_Examine_lymph_node' => 'required|in:normal,abnormal',
            'Specify_lymph_node' => 'nullable|string|max:255',
            'throat_comment' => 'required|string|max:500',
        ]);

        // Step 2: Check if a record already exists for this bio_data_id
        $existingRecord = DB::table('throat_examinations')
            ->where('bio_data_id', $validatedData['bio_data_id'])
            ->where('deleted', 0)
            ->first();

        // Step 3: Prepare the data for saving
        $data = [
            'bio_data_id' => $validatedData['bio_data_id'],
            'screeningFormId' => $validatedData['screeningFormId'],
            'Question_No_36_Examine_tonsils' => $validatedData['Question_No_36_Examine_tonsils'],
            'Question_No_37_Normal_Speech_development' => $validatedData['Question_No_37_Normal_Speech_development'],
            'Question_No_38_Any_Neck_swelling' => $validatedData['Question_No_38_Any_Neck_swelling'],
            'Specify_Any_Neck_swelling' => $validatedData['Specify_Any_Neck_swelling'] ?? null,
            'Question_No_39_Examine_lymph_node' => $validatedData['Question_No_39_Examine_lymph_node'],
            'Specify_lymph_node' => $validatedData['Specify_lymph_node'] ?? null,
            'throat_comment' => $validatedData['throat_comment'],
            'created_by' => auth()->id() ?? 0,
            'updated_by' => auth()->id() ?? 0,
        ];

        // Step 4: Insert or update the record
        if ($existingRecord) {
            // Update existing record
            DB::table('throat_examinations')
                ->where('id', $existingRecord->id)
                ->update($data);
        } else {
            // Insert new record
            $data['created_at'] = now();
            DB::table('throat_examinations')->insert($data);
        }
    }



    /* OralExamination */
    private function OralExamination(Request $request)
    {
        // Step 1: Validate the request
        $validatedData = $request->validate([
            'bio_data_id' => 'required|integer',
            'screeningFormId' => 'required|integer',
            'Question_No_34_Assess_gingiva' => 'required|in:Infection,Bleed,Normal',
            'Question_No_35_Are_there_dental_caries' => 'required|in:Yes,No',
            'oral_comment' => 'required|string|max:500',
        ]);

        // Step 2: Check if a record already exists for this bio_data_id
        $existingRecord = DB::table('oral_examinations')
            ->where('bio_data_id', $validatedData['bio_data_id'])
            ->where('deleted', 0)
            ->first();

        // Step 3: Prepare the data for saving
        $data = [
            'bio_data_id' => $validatedData['bio_data_id'],
            'screeningFormId' => $validatedData['screeningFormId'],
            'Question_No_34_Assess_gingiva' => $validatedData['Question_No_34_Assess_gingiva'],
            'Question_No_35_Are_there_dental_caries' => $validatedData['Question_No_35_Are_there_dental_caries'],
            'oral_comment' => $validatedData['oral_comment'],
            'created_by' => auth()->id() ?? 0, // Track who created
            'updated_by' => auth()->id() ?? 0, // Track who updated
        ];

        // Step 4: Insert or update the record
        if ($existingRecord) {
            // Update existing record
            DB::table('oral_examinations')
                ->where('id', $existingRecord->id)
                ->update($data);
        } else {
            // Insert new record
            $data['created_at'] = now();
            DB::table('oral_examinations')->insert($data);
        }
    }


    /* NoseExamination */
    private function NoseExamination(Request $request)
    {
        // Step 1: Validate the request
        $validatedData = $request->validate([
            'bio_data_id' => 'required|integer',
            'screeningFormId' => 'required|integer',
            'Question_No_32_External_nasal_examinaton' => 'required|in:Deformities,Swelling,Redness,Lesions,Nasal Discharge,Crusting,Normal',
            'Question_No_33_perform_a_nasal_patency_test' => 'required|in:Obstruction,DNS,Normal',
            'nose_comment' => 'required|string|max:500',
        ]);

        // Step 2: Check if a record already exists for this bio_data_id
        $existingRecord = DB::table('nose_examinations')
            ->where('bio_data_id', $validatedData['bio_data_id'])
            ->where('deleted', 0)
            ->first();

        // Step 3: Prepare the data for saving
        $data = [
            'bio_data_id' => $validatedData['bio_data_id'],
            'screeningFormId' => $validatedData['screeningFormId'],
            'Question_No_32_External_nasal_examinaton' => $validatedData['Question_No_32_External_nasal_examinaton'],
            'Question_No_33_perform_a_nasal_patency_test' => $validatedData['Question_No_33_perform_a_nasal_patency_test'],
            'nose_comment' => $validatedData['nose_comment'],
            'created_by' => auth()->id() ?? 0, // Track who created
            'updated_by' => auth()->id() ?? 0, // Track who updated
        ];

        // Step 4: Insert or update the record
        if ($existingRecord) {
            // Update existing record
            DB::table('nose_examinations')
                ->where('id', $existingRecord->id)
                ->update($data);
        } else {
            // Insert new record
            $data['created_at'] = now();
            DB::table('nose_examinations')->insert($data);
        }
    }


    /* EarExamination */
    private function EarExamination(Request $request)
    {
        // Step 1: Validate the request
        $validatedData = $request->validate([
            'bio_data_id' => 'required|integer',
            'screeningFormId' => 'required|integer',
            'Question_No_29_Normal_ears_shape_and_position' => 'required|in:Yes,No',
            'Question_No_30_Ear_examination' => 'required|in:Ear wax,Canal infection,None',
            'Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber' => 'required|in:Normal,right_ear_conductive_hearing_loss,left_ear_conductive_hearing_loss,right_ear_sensorineural_hearing_loss,left_ear_sensorineural_hearing_loss',
            'ears_comment' => 'required|string|max:500',
        ]);

        // Step 2: Check if a record already exists for this bio_data_id
        $existingRecord = DB::table('ear_examinations')
            ->where('bio_data_id', $validatedData['bio_data_id'])
            ->where('deleted', 0)
            ->first();

        // Step 3: Prepare the data for saving
        $data = [
            'bio_data_id' => $validatedData['bio_data_id'],
            'screeningFormId' => $validatedData['screeningFormId'],
            'Question_No_29_Normal_ears_shape_and_position' => $validatedData['Question_No_29_Normal_ears_shape_and_position'],
            'Question_No_30_Ear_examination' => $validatedData['Question_No_30_Ear_examination'],
            'Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber' => $validatedData['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'],
            'ears_comment' => $validatedData['ears_comment'],
            'created_by' => auth()->id() ?? 0, // Track who created
            'updated_by' => auth()->id() ?? 0, // Track who updated
        ];

        // Step 4: Insert or update the record
        if ($existingRecord) {
            // Update existing record
            DB::table('ear_examinations')
                ->where('id', $existingRecord->id)
                ->update($data);
        } else {
            // Insert new record
            $data['created_at'] = now();
            DB::table('ear_examinations')->insert($data);
        }
    }


    /* EyeExamination */
    private function EyeExamination(Request $request)
    {
        // Step 1: Validate the request
        $validatedData = $request->validate([
            'bio_data_id' => 'required|integer',
            'screeningFormId' => 'required|integer',
            'Question_No_24_Visual_acuity_using_Snellen_chart' => 'required|string|max:255',
            'Question_No_25_Normal_ocular_alignment' => 'required|in:Yes,No',
            'Question_No_26_Normal_eye_inspection' => 'required|in:Yes,No',
            'Question_No_27_Normal_Color_vision' => 'required|in:Yes,No',
            'Question_No_28_Nystagmus' => 'required|in:Yes,No',
            'eye_comment' => 'required|string|max:500',
        ]);

        // Step 2: Check if a record already exists for this bio_data_id
        $existingRecord = DB::table('eye_examinations')
            ->where('bio_data_id', $validatedData['bio_data_id'])
            ->where('deleted', 0)
            ->first();

        // Step 3: Prepare the data for saving
        $data = [
            'bio_data_id' => $validatedData['bio_data_id'],
            'screeningFormId' => $validatedData['screeningFormId'],
            'Question_No_24_Visual_acuity_using_Snellen_chart' => $validatedData['Question_No_24_Visual_acuity_using_Snellen_chart'],
            'Question_No_25_Normal_ocular_alignment' => $validatedData['Question_No_25_Normal_ocular_alignment'],
            'Question_No_26_Normal_eye_inspection' => $validatedData['Question_No_26_Normal_eye_inspection'],
            'Question_No_27_Normal_Color_vision' => $validatedData['Question_No_27_Normal_Color_vision'],
            'Question_No_28_Nystagmus' => $validatedData['Question_No_28_Nystagmus'],
            'eye_comment' => $validatedData['eye_comment'],
            'created_by' => auth()->id() ?? 0, // Track who created
            'updated_by' => auth()->id() ?? 0, // Track who updated
        ];

        // Step 4: Insert or update the record
        if ($existingRecord) {
            // Update existing record
            DB::table('eye_examinations')
                ->where('id', $existingRecord->id)
                ->update($data);
        } else {
            // Insert new record
            $data['created_at'] = now();
            DB::table('eye_examinations')->insert($data);
        }
    }

    /* HeadAndNeckExamination */
    private function HeadAndNeckExamination(Request $request)
    {
        // Step 1: Validate the request
        $validatedData = $request->validate([
            'bio_data_id' => 'required|integer',
            'screeningFormId' => 'required|integer',
            'Question_No_20_Hair_and_Scalp' => 'required|in:Straight,Wavy,Curly,Color-faded',
            'Question_No_21_Any_Hair_Problem' => 'required|in:Kinky,Brittle,Dry,Normal',
            'Question_No_22_Sclap' => 'required|in:Scaly,Dry,Moist,Normal',
            'Question_No_23_Hair_distribution' => 'required|in:Even,Patchy,Receding,Receding_Hair_Line',
            'head_and_neck_examination_comment' => 'required|string|max:500',
        ]);


        // Step 2: Check if a record already exists
        $existingRecord = DB::table('head_and_neck_examinations')
            ->where('bio_data_id', $validatedData['bio_data_id'])
            ->where('deleted', 0)
            ->first();

        // Step 3: Prepare the data for saving
        $data = [
            'bio_data_id' => $validatedData['bio_data_id'],
            'screeningFormId' => $validatedData['screeningFormId'],
            'Question_No_20_Hair_and_Scalp' => $validatedData['Question_No_20_Hair_and_Scalp'],
            'Question_No_21_Any_Hair_Problem' => $validatedData['Question_No_21_Any_Hair_Problem'],
            'Question_No_22_Sclap' => $validatedData['Question_No_22_Sclap'],
            'Question_No_23_Hair_distribution' => $validatedData['Question_No_23_Hair_distribution'],
            'head_and_neck_examination_comment' => $validatedData['head_and_neck_examination_comment'],
            'created_by' => auth()->id() ?? 0, // Use authenticated user ID or 0 if not logged in
            'updated_by' => auth()->id() ?? 0, // Track who updated
        ];

        // Step 4: Insert or update the record
        if ($existingRecord) {
            // Update existing record
            DB::table('head_and_neck_examinations')
                ->where('id', $existingRecord->id)
                ->update($data);
        } else {
            // Insert new record
            $data['created_at'] = now();
            DB::table('head_and_neck_examinations')->insert($data);
        }
    }



    /* screeningForm */
    public function screeningForm(Request $request, $updateID = null)
    {
        // Fetch necessary data for dropdowns
        $Area = Area::all();
        $School = School::all();
        $City = City::all();

        // Handle POST request
        if ($request->isMethod('post')) {



            // Validation rules
            $rules = [

                /* Bio Data */

                'name' => 'required|string|max:255',
                'guardianname' => 'required|string|max:255',
                'gender' => 'required|in:male,female,other',
                'class' => 'required|string|max:50',
                'school' => 'required|integer|exists:schools,id',
                'city' => 'required|integer|exists:cities,id',
                'area' => 'required|integer|exists:areas,id',
                'dob' => 'required|date',
                'age' => 'required|integer',
                'Emergency_Contact_Number' => 'required|string|max:20',
                'Gr_Number' => 'required|integer',
                'Any_Known_Medical_Condition' => 'nullable|string|max:500',
                'Address' => 'nullable|string|max:500',
                'Blood_group' => 'nullable|in:A+,A-,B+,B-,O+,O-,AB+,AB-,Unknown',
                'bio_data_comment' => 'nullable|string|max:500',
                'status' => 'nullable|in:0,1', // 0=inactive, 1=active


                /* Vitals/BMI */

                'Question_No_1_Height' => 'required|numeric|min:1',
                'Question_No_2_Weight' => 'required|numeric|min:1',
                'Question_No_3_BMI' => 'required|numeric',
                'bmiresult' => 'nullable|string',
                'Question_No_4_Body_Temperature' => 'required|numeric',
                'Bodytempunit' => 'nullable|string|max:1', // 'f' or 'c'
                'Question_No_5_Blood_Pressure_Systolic' => 'required|numeric',
                'systolicresult' => 'nullable|string',
                'Question_No_6_Blood_Pressure_Diastolic' => 'required|numeric',
                'diastolicresult' => 'nullable|string',
                'Question_No_7_Pulse' => 'required|string|max:255',
                'vitals_bmi_comment' => 'nullable|string|max:255',


                /*  General Appearance */

                'Question_No_8_Normal_Posture_Gait' => 'required|string|in:Yes,No',
                'Question_No_9_Mental_Status' => 'required|string|in:Alert,Lethargic',
                'Question_No_10_Look_For_jaundice' => 'required|string|in:Yes,No',
                'Question_No_11_Look_For_anemia' => 'required|string|in:Yes,No',
                'Question_No_12_Look_For_Clubbing' => 'required|string|in:Yes,No',
                'Question_No_13_Look_for_Cyanosis' => 'required|string|in:Yes,No',
                'Question_No_14_Skin' => 'required|string|in:Rash,Allergy,Lesion,Bruises,Normal',
                'Question_No_15_Breath' => 'required|string|in:Bad Breath,Normal',
                'general_apperance_comment' => 'required|string|max:500',


                /* Inspect Hygiene */

                'Question_No_16_Nails' => 'required|string|in:Clean,Dirty',
                'Question_No_17_Uniform_or_shoes' => 'required|string|in:Tidy,Untidy',
                'Question_No_18_Lice_nits' => 'required|string|in:Yes,No',
                'Question_No_19_Discuss_hygiene_routines_and_practices' => 'required|string|in:well-aware,not-aware,has-been-counseled',
                'inspect_hygiene_comment' => 'required|string|max:500',

            ];

            // Validate the incoming request data
            $validatedData = $request->validate($rules);

            // Begin the transaction
            DB::beginTransaction();

            try {


                /* Bio Data */

                $bio_data = [
                    'screeningFormId' => $request->input('screeningFormId'),
                    'name' => $request->input('name'),
                    'guardian_name' => $request->input('guardianname'),
                    'gender' => $request->input('gender'),
                    'class' => $request->input('class'),
                    'school_id' => $request->input('school'),
                    'city_id' => $request->input('city'),
                    'area_id' => $request->input('area'),
                    'dob' => $request->input('dob'),
                    'age' => $request->input('age'),
                    'emergency_contact_number' => $request->input('Emergency_Contact_Number'),
                    'gr_number' => $request->input('Gr_Number'),
                    'medical_condition' => $request->input('Any_Known_Medical_Condition'),
                    'address' => $request->input('Address'),
                    'blood_group' => $request->input('Blood_group'),
                    'bio_data_comment' => $request->input('bio_data_comment'),
                    'created_by' => auth()->id() ?? 0, // Use authenticated user ID or 0 if not logged in
                    'updated_by' => auth()->id() ?? 0, // Track who updated
                ];



                $bioDataId = $request->input('updateID');
                $screeningFormId = $request->input('screeningFormId');

                if ($bioDataId) {

                    DB::table('bio_data')->where('id', $bioDataId)->update($bio_data);

                    $message = 'Data updated successfully';


                } else {

                    $bioDataId = DB::table('bio_data')->insertGetId($bio_data);

                    $message = 'Data saved successfully';

                }



                $request->merge(['bio_data_id' => $bioDataId]);



                /* Miscellaneous */

                $this->Miscellaneous($request);


                /* Vaccination */

                $this->Vaccination($request);



                /* Musculoskeletal */

                $this->Musculoskeletal($request);


                /* Abdomens */

                $this->Abdomens($request);



                /* ChestExamination */

                $this->ChestExamination($request);


                /* ThroatExamination */

                $this->ThroatExamination($request);


                /* OralExamination */

                $this->OralExamination($request);

                /* NoseExamination */

                $this->NoseExamination($request);


                /* EarExamination */

                $this->EarExamination($request);

                /* HeadAndNeckExamination */

                $this->HeadAndNeckExamination($request);

                /* EyeExamination */

                $this->EyeExamination($request);



                /* Inspect Hygiene */

                $inspectHygieneData = [
                    'bio_data_id' => $bioDataId,
                    'Question_No_16_Nails' => $request->input('Question_No_16_Nails'),
                    'Question_No_17_Uniform_or_shoes' => $request->input('Question_No_17_Uniform_or_shoes'),
                    'Question_No_18_Lice_nits' => $request->input('Question_No_18_Lice_nits'),
                    'Question_No_19_Discuss_hygiene_routines_and_practices' => $request->input('Question_No_19_Discuss_hygiene_routines_and_practices'),
                    'inspect_hygiene_comment' => $request->input('inspect_hygiene_comment'),
                    'screeningFormId' => $request->input('screeningFormId'),
                    'created_by' => auth()->id() ?? 0,
                    'updated_by' => auth()->id() ?? 0,
                ];

                $existingInspectHygiene = DB::table('inspect_hygienes')
                    ->where('bio_data_id', $bioDataId)
                    ->where('deleted', 0)
                    ->first();

                if ($existingInspectHygiene) {
                    // Update existing record
                    DB::table('inspect_hygienes')
                        ->where('id', $existingInspectHygiene->id)
                        ->update($inspectHygieneData);
                } else {
                    // Insert new record
                    DB::table('inspect_hygienes')->insert($inspectHygieneData);
                }



                /* Vitals/BMI */


                $vitals_bmi_data = [
                    'screeningFormId' => $request->input('screeningFormId'),
                    'bio_data_id' => $bioDataId, // Link vitals_bms with the inserted/updated bio_data
                    'Question_No_1_Height' => $request->input('Question_No_1_Height'),
                    'Question_No_2_Weight' => $request->input('Question_No_2_Weight'),
                    'Question_No_3_BMI' => $request->input('Question_No_3_BMI'),
                    'bmiresult' => $request->input('bmiresult'),
                    'Question_No_4_Body_Temperature' => $request->input('Question_No_4_Body_Temperature'),
                    'Bodytempunit' => $request->input('Bodytempunit', 'f'), // Default to 'f' if not provided
                    'Question_No_5_Blood_Pressure_Systolic' => $request->input('Question_No_5_Blood_Pressure_Systolic'),
                    'systolicresult' => $request->input('systolicresult'),
                    'Question_No_6_Blood_Pressure_Diastolic' => $request->input('Question_No_6_Blood_Pressure_Diastolic'),
                    'diastolicresult' => $request->input('diastolicresult'),
                    'Question_No_7_Pulse' => $request->input('Question_No_7_Pulse'),
                    'vitals_bmi_comment' => $request->input('vitals_bmi_comment'),
                    'status' => $request->input('status', 1), // Default to 1 (active) if not provided
                    'created_by' => auth()->id() ?? 0,
                    'updated_by' => auth()->id() ?? 0,
                ];

                $existingVitals = DB::table('vitals_bms')
                    ->where('bio_data_id', $bioDataId)
                    ->where('deleted', 0)
                    ->first();

                if ($existingVitals) {
                    DB::table('vitals_bms')
                        ->where('bio_data_id', $bioDataId)
                        ->where('deleted', 0)
                        ->update($vitals_bmi_data);
                } else {
                    DB::table('vitals_bms')->insert($vitals_bmi_data);
                }



                /*  General Appearance */

                $generalAppearanceData = [
                    'bio_data_id' => $bioDataId,
                    'screeningFormId' => $request->input('screeningFormId'),
                    'Question_No_8_Normal_Posture_Gait' => $request->input('Question_No_8_Normal_Posture_Gait'),
                    'Question_No_9_Mental_Status' => $request->input('Question_No_9_Mental_Status'),
                    'Question_No_10_Look_For_jaundice' => $request->input('Question_No_10_Look_For_jaundice'),
                    'Question_No_11_Look_For_anemia' => $request->input('Question_No_11_Look_For_anemia'),
                    'Question_No_12_Look_For_Clubbing' => $request->input('Question_No_12_Look_For_Clubbing'),
                    'Question_No_13_Look_for_Cyanosis' => $request->input('Question_No_13_Look_for_Cyanosis'),
                    'Question_No_14_Skin' => $request->input('Question_No_14_Skin'),
                    'Question_No_15_Breath' => $request->input('Question_No_15_Breath'),
                    'general_apperance_comment' => $request->input('general_apperance_comment'),
                    'created_by' => auth()->id() ?? 0,
                    'updated_by' => auth()->id() ?? 0,
                ];

                $existingGeneralAppearance = DB::table('general_appearances')
                    ->where('bio_data_id', $bioDataId)
                    ->where('deleted', 0)
                    ->first();

                if ($existingGeneralAppearance) {
                    DB::table('general_appearances')
                        ->where('id', $existingGeneralAppearance->id)
                        ->update($generalAppearanceData);
                } else {
                    DB::table('general_appearances')->insert($generalAppearanceData);
                }




                // Commit transaction
                DB::commit();


                // dd($request->all());


                if ($screeningFormId == 0) {

                    // Redirect or return success message after insert or update
                    return redirect()->route('screeningForm')->with('success_message', $message);

                }

                // Redirect or return success message after insert or update
                return redirect()->route('GeneralInfo', ['id' => $screeningFormId])
                    ->with('success_message', $message);



            } catch (\Exception $e) {
                // Rollback the transaction if something goes wrong
                DB::rollback();

                // Log the error (optional, useful for debugging)
                \Log::error('Error in screeningForm: ' . $e->getMessage());

                dd($e->getMessage());

                // Return an error message
                return redirect()->back()->with('error_message', 'Something went wrong. Please try again.');
            }
        }

        // If it's a GET request, return the view with necessary data
        // return view('StudentScreening.screeningForm', compact('Area', 'School', 'City'));

        if ($updateID > 0) {

            $bio_data = DB::table('bio_data')->where('id', $updateID)->where('deleted', 0)->first();
            if ($bio_data) {

                $bioDataId = $bio_data->id;

                $vitals_bms = DB::table('vitals_bms')->where('bio_data_id', $bio_data->id)->where('deleted', 0)->first();

                $general_appearance = DB::table('general_appearances')
                    ->where('bio_data_id', $bio_data->id)
                    ->where('deleted', 0)
                    ->first();



                $existingInspectHygiene = DB::table('inspect_hygienes')
                    ->where('bio_data_id', $bioDataId)
                    ->where('deleted', 0)
                    ->first();


                $headAndNeckData = DB::table('head_and_neck_examinations')
                    ->where('bio_data_id', $bioDataId)
                    ->where('deleted', 0)
                    ->first();

                $eyeExamination = DB::table('eye_examinations')->where('bio_data_id', $bioDataId)->where('deleted', 0)->first();

                $earExaminations = DB::table('ear_examinations')->where('bio_data_id', $bioDataId)->where('deleted', 0)->first();

                $noseExamination = DB::table('nose_examinations')->where('bio_data_id', $bioDataId)->where('deleted', 0)->first();

                $oralExamination = DB::table('oral_examinations')->where('bio_data_id', $bioDataId)->where('deleted', 0)->first();

                $throatExaminations = DB::table('throat_examinations')->where('bio_data_id', $bioDataId)->where('deleted', 0)->first();

                $chestExamination = DB::table('chestexaminations')->where('bio_data_id', $bioDataId)->where('deleted', 0)->first();


                $Abdomens = DB::table('Abdomens')->where('bio_data_id', $bioDataId)->where('deleted', 0)->first();

                $Musculoskeletal = DB::table('musculoskeletal')->where('bio_data_id', $bioDataId)->where('deleted', 0)->first();

                $Vaccination = DB::table('vaccination')->where('bio_data_id', $bioDataId)->where('deleted', 0)->first();

                $Miscellaneous = DB::table('miscellaneous')->where('bio_data_id', $bioDataId)->where('deleted', 0)->first();



            } else {
                return redirect()->back()->with('error_message', 'Record not exist. Please try again.');

            }


        }



        return view('StudentScreening.screeningForm')->with(get_defined_vars());


    }


}


?>