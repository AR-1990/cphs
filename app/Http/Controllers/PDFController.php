<?php
// namespace App\Http\Controllers\AdminPanel;
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Models\FormData;
use App\Models\School;
use App\Models\Area;
use App\Models\City;
use Carbon\Carbon;
// use Illuminate\App\Http\Request;
class PDFController extends Controller
{
    public function downloadPDF($id)
    {
        $data = DB::table('form_data')
            ->where('entry_id', $id)
            ->pluck('value', 'key')
            ->all();

        $date = DB::table('form_entries')->where('id', $id)->first();
        $dt = $date->created_at; // Timestamp
        $data['formattedDate'] = Carbon::parse($dt)->format('j-M-Y'); 
        // dd($formattedDate);
        $columns = [];
        foreach ($data as $key => $value) {
            $columns[$key] = $value;
        }
        $resultArray = [$columns];
        $school = DB::table('schools')
            ->where('id', $resultArray[0]['school'])
            ->first();
        $areas = DB::table('areas')
            ->where('id', $resultArray[0]['area'])
            ->value('name');
// dd($school);

        $dob = $resultArray[0]['dob']; // Date of birth in '2008-10-05' format
        $age = Carbon::parse($dob)->age;

        // Map class select values to human-readable labels for PDF display
        $classCode = isset($resultArray[0]['class']) ? (string) $resultArray[0]['class'] : null;
        if ($classCode !== null) { $classCode = trim($classCode); }
        $classMap = [
            '0' => 'Play group',
            '0000' => 'Nursery',
            '00' => 'KG-1',
            '000' => 'KG-2',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '10' => '10',
            '11' => '11',
            '12' => '12',
        ];
        $classLabel = ($classCode !== null && array_key_exists($classCode, $classMap)) ? $classMap[$classCode] : $classCode;

        // Class-based Development fields mapping
        $developmentClassFields = [];
        if ($classLabel === 'Nursery') {
            $developmentClassFields = [
                "Cognitive" => $resultArray[0]['nursery_Cognitive_Result'] ?? null,
                "Motor" => $resultArray[0]['nursery_Motor_Result'] ?? null,
                "Language" => $resultArray[0]['nursery_Language_Result'] ?? null,
                "Social-Emotional" => $resultArray[0]['nursery_SocialEmotional_Result'] ?? null,
                "Adaptive" => $resultArray[0]['nursery_Adaptive_Result'] ?? null,
            ];
        } elseif ($classLabel === 'Play group') {
            $developmentClassFields = [
                "Cognitive" => $resultArray[0]['play_ground_Cognitive_Result'] ?? null,
                "Motor" => $resultArray[0]['play_ground_Motor_Result'] ?? null,
                "Language" => $resultArray[0]['play_ground_Language_Result'] ?? null,
                "Social-Emotional" => $resultArray[0]['play_ground_SocialEmotional_Result'] ?? null,
                "Adaptive" => $resultArray[0]['play_ground_Adaptive_Result'] ?? null,
            ];
        } elseif ($classLabel === 'KG-1' || $classLabel === 'KG-2') {
            $developmentClassFields = [
                "Cognitive" => $resultArray[0]['kindergarten_Cognitive_Result'] ?? null,
                "Motor" => $resultArray[0]['kindergarten_Motor_Result'] ?? null,
                "Language" => $resultArray[0]['kindergarten_Language_Result'] ?? null,
                "Social-Emotional" => $resultArray[0]['kindergarten_SocialEmotional_Result'] ?? null,
                "Adaptive" => $resultArray[0]['kindergarten_Adaptive_Result'] ?? null,
            ];
        }
        $data['details'] = [
            "Bio Data" => [
                "heading" => 'Bio Data',
                "System ID" => isset($id) ? $id : null,
                "Name" => isset($resultArray[0]['name']) ? $resultArray[0]['name'] : null,
                "Guardian Name" => isset($resultArray[0]['guardianname']) ? $resultArray[0]['guardianname'] : null,
                "Gender" => isset($resultArray[0]['gender']) ? $resultArray[0]['gender'] : null,
                "School" => isset($resultArray[0]['school']) ? ($school->school_name ?? null) : null,
                "City" => isset($resultArray[0]['city']) ? 'Karachi' : null,
                "Area" => isset($resultArray[0]['area']) ? $areas : null,
                "class_section" => $resultArray[0]['class_section'] ?? '-',
                "class" => $classLabel ?? null,
                "Date of Birth" => isset($resultArray[0]['dob']) ? $resultArray[0]['dob'] : null,
                "Age" => isset($resultArray[0]['age']) ? $age : null,
                "Emergency Contact" => isset($resultArray[0]['Emergency_Contact_Number']) ? $resultArray[0]['Emergency_Contact_Number'] : null,
                
                "GR #" => isset($resultArray[0]['Gr_Number']) ? $resultArray[0]['Gr_Number'] : null,
                "ANY KNOWN MEDICAL CONDITION" => isset($resultArray[0]['Any_Known_Medical_Condition']) ? $resultArray[0]['Any_Known_Medical_Condition'] : null,
                "Address" => isset($resultArray[0]['Address']) ? $resultArray[0]['Address'] : '-',
                 
                "Blood Group" => isset($resultArray[0]['Blood_group']) ? $resultArray[0]['Blood_group'] : '-',
                // "Comment" => isset($resultArray[0]['bio_data_comment']) ? $resultArray[0]['bio_data_comment'] : null,
            ],
            "Vitals/BMI" => [
                "heading" => 'Vitals/BMI',
                "Height" => isset($resultArray[0]['Question_No_1_Height']) ? $resultArray[0]['Question_No_1_Height'] : null,
                "Weight" => isset($resultArray[0]['Question_No_2_Weight']) ? $resultArray[0]['Question_No_2_Weight'] : null,
                "BMI" => isset($resultArray[0]['Question_No_3_BMI']) ? $resultArray[0]['Question_No_3_BMI'] : null,
                "Temperature" => isset($resultArray[0]['Question_No_4_Body_Temperature']) ? $resultArray[0]['Question_No_4_Body_Temperature'] : null,
                // "Temperature Unit" => isset($resultArray[0]['Bodytempunit']) ? $resultArray[0]['Bodytempunit'] : 'f',
                "Systolic BP" => isset($resultArray[0]['Question_No_5_Blood_Pressure_Systolic']) ? $resultArray[0]['Question_No_5_Blood_Pressure_Systolic'] : (isset($resultArray[0]['Question_No_6_Blood_Pressure_Systolic']) ? $resultArray[0]['Question_No_6_Blood_Pressure_Systolic'] : (isset($resultArray[0]['Question_No_6_Blood_Pressure']) ? $resultArray[0]['Question_No_6_Blood_Pressure'] : null)),
                "Diastolic BP" => isset($resultArray[0]['Question_No_6_Blood_Pressure_Diastolic']) ? $resultArray[0]['Question_No_6_Blood_Pressure_Diastolic'] : (isset($resultArray[0]['Question_No_7_Blood_Pressure_Diacystolic']) ? $resultArray[0]['Question_No_7_Blood_Pressure_Diacystolic'] : null),
                "Pulse" => isset($resultArray[0]['Question_No_7_Pulse']) ? $resultArray[0]['Question_No_7_Pulse'] : (isset($resultArray[0]['Question_No_5_Pulse']) ? $resultArray[0]['Question_No_5_Pulse'] : null),
                // "Comment" => isset($resultArray[0]['vitals_bmi_comment']) ? $resultArray[0]['vitals_bmi_comment'] : null,
            ],
            "General Appearance" => [
                "heading" => 'General Appearance',
                "Normal Posture Gait" => isset($resultArray[0]['Question_No_8_Normal_Posture_Gait']) ? $resultArray[0]['Question_No_8_Normal_Posture_Gait'] : (isset($resultArray[0]['Question_No_7_Normal_Posture/Gait']) ? $resultArray[0]['Question_No_7_Normal_Posture/Gait']:(isset($resultArray[0]['Question_No_8_Normal_Posture/Gait']) ? $resultArray[0]['Question_No_8_Normal_Posture/Gait'] : null)),
                "Mental Status" => isset($resultArray[0]['Question_No_9_Mental_Status']) ? $resultArray[0]['Question_No_9_Mental_Status'] : (isset($resultArray[0]['Question_No_8_Mental_Status']) ? $resultArray[0]['Question_No_8_Mental_Status'] : null),
                "JAUNDICE" => isset($resultArray[0]['Question_No_10_Look_For_jaundice']) ? $resultArray[0]['Question_No_10_Look_For_jaundice'] : (isset($resultArray[0]['Question_No_9_Look_For_jaundice']) ? $resultArray[0]['Question_No_9_Look_For_jaundice'] : 'null'),
                "ANEMIA" => isset($resultArray[0]['Question_No_11_Look_For_anemia']) ? $resultArray[0]['Question_No_11_Look_For_anemia'] : (isset($resultArray[0]['Question_No_10_Look_For_anemia']) ? $resultArray[0]['Question_No_10_Look_For_anemia'] : null),
                "CLUBBING" => isset($resultArray[0]['Question_No_12_Look_For_Clubbing']) ? $resultArray[0]['Question_No_12_Look_For_Clubbing'] : (isset($resultArray[0]['Question_No_11_Look_For_Clubbing']) ? $resultArray[0]['Question_No_11_Look_For_Clubbing'] : null),
                "CYANOSIS" => isset($resultArray[0]['Question_No_13_Look_for_Cyanosis']) ? $resultArray[0]['Question_No_13_Look_for_Cyanosis'] : (isset($resultArray[0]['Question_No_12_Look_for_Cyanosis']) ? $resultArray[0]['Question_No_12_Look_for_Cyanosis'] : null),
                "Skin" => isset($resultArray[0]['Question_No_14_Skin']) ? $resultArray[0]['Question_No_14_Skin'] : (isset($resultArray[0]['Question_No_13_Skin']) ? $resultArray[0]['Question_No_13_Skin'] : null),
                "Breath" => isset($resultArray[0]['Question_No_15_Breath']) ? $resultArray[0]['Question_No_15_Breath'] : (isset($resultArray[0]['Question_No_14_Breath']) ? $resultArray[0]['Question_No_14_Breath'] : null),
                // "Comment" => isset($resultArray[0]['general_apperance_comment']) ? $resultArray[0]['general_apperance_comment'] : null,
            ],
            "Inspect Hygiene" => [
                "heading" => 'Inspect Hygiene',
                "Nails" => isset($resultArray[0]['Question_No_16_Nails']) ? $resultArray[0]['Question_No_16_Nails'] : (isset($resultArray[0]['Question_No_15_Nails']) ? $resultArray[0]['Question_No_15_Nails'] : null),               
                "lice/Nits" => isset($resultArray[0]['Question_No_18_Lice_nits']) ? $resultArray[0]['Question_No_18_Lice_nits'] : (isset($resultArray[0]['Question_No_17_Lice/nits']) ? $resultArray[0]['Question_No_17_Lice/nits'] : (isset($resultArray[0]['Question_No_18_Lice/nits']) ? $resultArray[0]['Question_No_18_Lice/nits']:null)),
                
            ],
            "Head and Neck examination" => [
                "heading" => 'Head and Neck examination',
                "Hair/scalp" => isset($resultArray[0]['Question_No_20_Hair_and_Scalp']) ? $resultArray[0]['Question_No_20_Hair_and_Scalp'] : (isset($resultArray[0]['Question_No_19_Hair_and_Scalp']) ? $resultArray[0]['Question_No_19_Hair_and_Scalp'] : null),
                "Hair Problem" => isset($resultArray[0]['Question_No_21_Any_Hair_Problem']) ? $resultArray[0]['Question_No_21_Any_Hair_Problem'] : null,
               "Scalp" => isset($resultArray[0]['Question_No_22_Scalp']) 
    ? $resultArray[0]['Question_No_22_Scalp'] 
    : (isset($resultArray[0]['Question_No_22_Sclap']) 
        ? $resultArray[0]['Question_No_22_Sclap'] 
        : null),
                "Hair/distribution" => isset($resultArray[0]['Question_No_23_Hair_Distribution']) ? $resultArray[0]['Question_No_23_Hair_Distribution'] : (isset($resultArray[0]['Question_No_20_Hair_distribution']) ? $resultArray[0]['Question_No_20_Hair_distribution'] :(isset($resultArray[0]['Question_No_23_Hair_distribution']) ? $resultArray[0]['Question_No_23_Hair_distribution']: null)),
                // "Comment" => isset($resultArray[0]['head_and_neck_examination_comment']) ? $resultArray[0]['head_and_neck_examination_comment'] : null,
            ],

            "Eye" => [
                "heading" => 'Eye',
                "Visual_acuity_using_snellens_chart" => $resultArray[0]['Question_No_24_Visual_acuity_using_Snellens_chart'] ?? $resultArray[0]['Question_No_21_Visual_acuity_using_Snellen’s_chart'] ??$resultArray[0]['Question_No_24_Visual_acuity_using_Snellen’s_chart']?? null,
                 "Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye" => $resultArray[0]['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] ?? $resultArray[0]['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] ??$resultArray[0]['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye']?? null,
                "Normal_ocular_alignment" => $resultArray[0]['Question_No_25_Normal_ocular_alignment'] ?? $resultArray[0]['Question_No_22_Normal_ocular_alignment'] ?? null,
                "Normal_eye_inspection" => $resultArray[0]['Question_No_26_Normal_eye_inspection'] ?? $resultArray[0]['Question_No_23_Normal_eye_inspection'] ?? null,
                "Normal_color_vision" => $resultArray[0]['Question_No_27_Normal_Color_vision'] ?? $resultArray[0]['Question_No_24_Normal_Color_vision'] ?? null,
                "Nystagmus" => $resultArray[0]['Question_No_28_Nystagmus'] ?? $resultArray[0]['Question_No_25_Nystagmus'] ?? null,
                // "Comment" => $resultArray[0]['eye_comment'] ?? null,
            ],
            "Ears" => [
                "heading" => 'Ears',
                // "Normal_ears_shape_and_position" => $resultArray[0]['Question_No_29_Normal_ears_shape_and_position'] ?? $resultArray[0]['Question_No_26_Normal_ears_shape_and_position'] ?? null,
                "Ear_examination" => $resultArray[0]['Question_No_30_Ear_examination'] ?? $resultArray[0]['Question_No_27_Ear_examination'] ?? null,
                "Conclusion_of_hearing_test_with_rinne_and_weber" => $resultArray[0]['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] ?? $resultArray[0]['Question_No_28_Conclusion_of_hearing_test_with_Rinner_and_Weber'] ?? null,
                // "Comment" => $resultArray[0]['ears_comment'] ?? null,
            ],
              "development" => array_merge(
                [
                  "heading" => 'development',
                  "expouser_result"=>$resultArray[0]['expouser_result'] ?? 'No',
                  
                  "Conclusion_of_hearing_test_with_rinne_and_weber" => $resultArray[0]['Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber'] ?? $resultArray[0]['Question_No_28_Conclusion_of_hearing_test_with_Rinner_and_Weber'] ?? null,
                  "autism_spectrum_Comment"=>$resultArray[0]['autism_spectrum_Comment'] ?? null,
                  // "Comment" => $resultArray[0]['ears_comment'] ?? null,
                ],
                array_filter($developmentClassFields, function($v) { return $v !== null && $v !== ''; })
              ),
            "Nose" => [
                "heading" => 'Nose',
                "External_nasal_examinaton" => $resultArray[0]['Question_No_32_External_nasal_examinaton'] ?? $resultArray[0]['Question_No_29_External_inasal_examinaton'] ?? null,
                "nasal_patency_test" => $resultArray[0]["Question_No_33_perform_a_nasal_patency_test"] ?? $resultArray[0]["Question_No_30_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patient's_ability_to_breathe_through_each_nostril"] ??$resultArray[0]["Question_No_33_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patient's_ability_to_breathe_through_each_nostril"]?? null, 
            ],
            "Dental Examination" => [
                "heading" => 'Dental Examination',               
                "GUMS" => $resultArray[0]['Question_No_34_Assess_gingiva'] ?? $resultArray[0]['Question_No_31_Assess_gingiva'] ?? null,
                "dental_caries" => $resultArray[0]['Question_No_35_Are_there_dental_caries'] ?? $resultArray[0]['Question_No_32_Are_there_dental_caries'] ?? null,
                // "Comment" => $resultArray[0]['oral_comment'] ?? null,
            ],
            "Throat" => [
                "heading" => 'Throat',
                "tonsils" => $resultArray[0]['Question_No_36_Examine_tonsils'] ?? $resultArray[0]['Question_No_34_Examine_tonsils'] ?? null,
                // "Normal_speech_development" => $resultArray[0]['Question_No_37_Normal_Speech_development'] ?? $resultArray[0]['Question_No_35_Normal_Speech_development'] ?? null,
                "Any_neck_swelling" => $resultArray[0]['Question_No_38_Any_Neck_swelling'] ?? $resultArray[0]['Question_No_36_Any_Neck_swelling'] ?? null,
                "LYMPH NODE" => $resultArray[0]['Question_No_39_Examine_lymph_node'] ?? $resultArray[0]['Question_No_37_Examine_lymph_node'] ?? null,              
            ],
            "Chest" => [
                "heading" => 'Chest Examination',
                // "WRITE CHEST EXAMINATION-NORMAL" => $resultArray[0]['Question_No_40_Any_visible_chest_deformity'] ?? $resultArray[0]['Question_No_38_Any_visible_chest_deformity'] ?? null,
                // "Lung_auscultation" => $resultArray[0]['Question_No_41_Lung_Auscultation'] ?? $resultArray[0]['Question_No_39_Lung_Auscultation'] ?? null,
                "Lung_Auscultation" => $resultArray[0]['Question_No_41_Lung_Auscultation'] ?? $resultArray[0]['Question_No_39_Lung_Auscultation'] ?? null,
                "Cardiac_auscultation" => $resultArray[0]['Question_No_42_Cardiac_Auscultation'] ?? $resultArray[0]['Question_No_40_Cardiac_Auscultation'] ?? null,
                // "Comment" => $resultArray[0]['chest_comment'] ?? null,
            ],
            "Abdomen" => [
                "heading" => 'Abdomen Examination',
                "ABDOMEN" => $resultArray[0]["Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen"] ?? $resultArray[0]["Question_No_41_Did_you_observe_any_distension,_scars,_or_masses_on_the_child's_abdomen?"] ??$resultArray[0]["Question_No_43_Did_you_observe_any_distension,_scars,_or_masses_on_the_child's_abdomen?"]?? null,
                "Abdominal_pain" => $resultArray[0]['Question_No_44_Any_history_of_abdominal_Pain'] ?? $resultArray[0]['Question_No_42_Any_history_of_abdominal_Pain'] ?? null,
                // "Abdominal_pain_specify" => $resultArray[0]['any_history_of_abdominal_pain_specify'] ?? null,
                // "Comment" => $resultArray[0]['abdomen_comment'] ?? null,
            ],
            "Musculoskeletal" => [
                "heading" => 'Musculoskeletal Examination',
                "Any_limitation_in_child_range_of_motion" => $resultArray[0]["Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination"] ?? $resultArray[0]["Question_No_43_Did_you_observe_any_limitations_in_the_child's_range_of_joint_motion_during_your_examination?"] ??$resultArray[0]["Question_No_45_Did_you_observe_any_limitations_in_the_child's_range_of_joint_motion_during_your_examination?"]?? null,
                 "Adams_forward_bend_test" => $resultArray[0]['Question_No_48_Adams_forward_bend_test'] ?? $resultArray[0]['Question_No_46_Adams_forward_bend_test'] ?? null,
                "Any_foot_or_toe_abnormalities" => $resultArray[0]['Question_No_49_Any_foot_or_toe_abnormalities'] ?? $resultArray[0]['Question_No_47_Any_foot_or_toe_abnormalities'] ?? null,
                // "Comment" => $resultArray[0]['musculoskeletal_comment'] ?? null,
            ],
            "Vaccination" => array_filter(
                [
                    "heading" => 'Vaccination',
                    "Epi_immunization_card" => $resultArray[0]["Question_No_50_Have_EPI_immunization_card"] ?? $resultArray[0]['Question_No_48_Have_EPI_immunization_card?'] ?? null,
                    "had_any_vaccination" => $resultArray[0]['never_had_any_vaccination'] ?? null,
                    "BCG_1_dose" => isset($resultArray[0]["BCG_1_dose"]) ? 'Vaccinated' : null,
                    "OPV_4_dose" => isset($resultArray[0]["OPV_4_dose"]) ? 'Vaccinated' : null,
                    "Pentavalent_vaccine_DTP" => isset($resultArray[0]["Pentavalent_vaccine_DTP"]) ? 'Vaccinated' : null,
                    "Rota" => isset($resultArray[0]["rota"]) ? 'Vaccinated' : null,
                    "Measles" => isset($resultArray[0]["measles"]) ? 'Vaccinated' : null,
                    // "Vaccination_comment" => $resultArray[0]['vaccination_comment'] ?? null,
                ],
                function ($value) {
                    return $value !== null; // Filter out null values
                }
            ),

            "Miscellaneous" => array_merge(
                [
                    "heading" => 'Miscellaneous',

                    "ANY KNOWN ALLERGY" => $resultArray[0]["Question_No_55_Do_you_have_any_Allergies"] ?? $resultArray[0]['Question_No_54_Do_you_have_any_Allergies'] ?? null,
                    // "Any_allergies_specify" => $resultArray[0]['Do_you_have_any_allergies_specify'] ?? $resultArray[0]['do_you_have_any_allergies_specify'] ?? null,                
                    "ANY URINARY PROBLEM" => $resultArray[0]["Question_No_57_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination"] ?? $resultArray[0]['Question_No_56_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination'] ?? null,
                    // "Comment" => $resultArray[0]['miscellaneous_comment'] ?? null
                ],
                strtolower($resultArray[0]['gender'] ?? '') === 'female' ? [
                    // "Girls_above_8_years_old_ask" => $resultArray[0]['Question_No_56_Girls_above_8_years_old_ask:'] ?? $resultArray[0]['Question_No_55_Girls_above_8_years_old_ask:'] ?? null,
                    "ANY MENSTRUAL PROBLEM" => $resultArray[0]['QuestionNo_58_Any_menstrual_abnormality'] ?? $resultArray[0]['QuestionNo_57_Any_menstrual_abnormality'] ?? null,
                    "MENSTRUAL_Abnormality_Specify" => $resultArray[0]['Any_menstrual_abnormality_specify'] ?? null,
                ] : [],

            ),         
                // "Psychological" => [
                //     "heading" => 'Psychological Assessment',
                //     "Psychologist_Comment" => 
                //         isset($resultArray[0]['social_emotional-test']) && !empty($resultArray[0]['social_emotional-test'])
                //             ? str_replace("No.", "", $resultArray[0]['social_emotional-test'])
                //             : (
                //                 isset($resultArray[0]['Psychologist_Findings']) && !empty($resultArray[0]['Psychologist_Findings'])
                //                     ? str_replace("No.", "", $resultArray[0]['Psychologist_Findings'])
                //                     : (
                //                         isset($resultArray[0]['psychological_comment']) && !empty($resultArray[0]['psychological_comment'])
                //                             ? str_replace("No.", "", $resultArray[0]['psychological_comment'])
                //                             : null
                //                     )
                //             ),
                // ],
                "Psychological" => [
    "heading" => 'Psychological Assessment',

    "Psychologist_Comment" => (function() use ($resultArray, $classCode, $classMap) {

        // Determine class label
        $classLabel = ($classCode !== null && array_key_exists($classCode, $classMap))
            ? $classMap[$classCode]
            : $classCode;

        // Convert to numeric if possible
        $classNumber = is_numeric($classLabel) ? (int)$classLabel : 0;

        $comment = null;

        // Only allow social_emotional-test if class <= 1
        if ($classNumber <= 1) {
            if (!empty($resultArray[0]['social_emotional-test'])) {
                $comment = str_replace("No.", "", $resultArray[0]['social_emotional-test']);
            }
        }

        // Fallback 1
        if ($comment === null && !empty($resultArray[0]['Psychologist_Findings'])) {
            $comment = str_replace("No.", "", $resultArray[0]['Psychologist_Findings']);
        }

        // Fallback 2
        if ($comment === null && !empty($resultArray[0]['psychological_comment'])) {
            $comment = str_replace("No.", "", $resultArray[0]['psychological_comment']);
        }

        return $comment;

    })(),
],

            "Nutritionist" => [
                "heading" => 'Nutritional Assessment',             
                "Assessment" => $resultArray[0]['NutritionistComment'] ?? $resultArray[0]['NutritionistComment '] ?? null,                        

            ],
            "DIETARY ADVICE" => [
                "heading" => 'Dietary Advice',
                "advice" => $resultArray[0]['DietaryAdviceComment'] ?? $resultArray[0]['DietaryAdviceComment '] ?? null,
            ],
            "DOCTOR COMMENT" => [
                "heading" => 'Doctor Comment',
                "doctor_comment" => $resultArray[0]['doctor_comment'] ?? $resultArray[0]['doctor_comment '] ?? null,
            ]


        ];
        // dd( $data['details'] );
        if (!$data) {
            return redirect()->back()->with('error', 'Data not found.');
        }

        $data['area'] = Area::get();
        $data['city'] = City::get();
        $data['school'] = School::get();
        $data['form_id'] = $id;
        $data['school_details'] = $school;

        $gender = strtolower((string)($data['details']['Bio Data']['Gender'] ?? ''));
        $dobStr = (string)($data['details']['Bio Data']['Date of Birth'] ?? '');
        $heightVal = is_numeric($data['details']['Vitals/BMI']['Height'] ?? null) ? (float)$data['details']['Vitals/BMI']['Height'] : null;
        $bmiVal = is_numeric($data['details']['Vitals/BMI']['BMI'] ?? null) ? (float)$data['details']['Vitals/BMI']['BMI'] : null;
        $ageYears = null; $totalMonths = null;
        if (!empty($dobStr)) {
            try {
                $dobDt = Carbon::parse($dobStr);
                $nowDt = Carbon::now();
                $diff = $dobDt->diff($nowDt);
                $ageYears = (int)$diff->y;
                $totalMonths = ($diff->y * 12) + (int)$diff->m;
            } catch (\Exception $e) {}
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
            $wKey = null; $sKey = null; $map = [];
            $map['wasting_birth_to_5_girl'] = [
                // 'Severe Thinness' => [ 'n' => 'The child is severely malnourished, the z score indicates severe wasting which needs to be addressed immediately. It can also indicate any underlying medical condition causing this severe malnutrition. Ensure regular follow-ups with the health care provider', 'd' => 'Increase calorie-dense foods: whole milk, nuts, seeds, cheese, peanut butter. Include protein-rich foods like eggs, chicken, fish, and lentils. Fortify meals with healthy fats. Use full fat dairy products Provide frequent small meals with snacks in between. Consult a pediatric dietitian for a tailored plan.' ],
                'Severe Thinness' => [ 'n' => 'The child is severely underweight, the z score indicates severe wasting which needs to be addressed immediately. It can also indicate any underlying medical condition causing this severe malnutrition. Ensure regular follow-ups with the health care provider', 'd' => 'Increase calorie-dense foods: whole milk, nuts, seeds, cheese, peanut butter. Include protein-rich foods like eggs, chicken, fish, and lentils. Fortify meals with healthy fats. Use full fat dairy products Provide frequent small meals with snacks in between. Consult a pediatric dietitian for a tailored plan.' ],
                'Moderate Thinness' => [ 'n' => 'The child is underweight and at risk of health issues. The Z score indicates moderate wasting. Nutritional support and monitoring every 6 months are recommended.', 'd' => 'Add nutrient-dense foods like whole grains, dairy, and lean proteins. Increase intake of fruits and vegetables. Focus on healthy fats and oils for cooking. Encourage consistent meal patterns with 3 main meals and 2 snacks.' ],
                'Mild Thinness' => [ 'n' => 'The child is approaching underweight. Regular monitoring and preventive nutritional measures are advised.', 'd' => 'Incorporate balanced meals with complex carbohydrates like whole grains, oats rice and whole grain pasta. Add moderate amounts of healthy fats and proteins which includes all meats beans and lentils. Introduce fortified cereals and dairy products. - Encourage healthy snacking between meals, like yogurt or fruit.' ],
                'Normal Weight' => [ 'n' => 'The child has a healthy weight for age and height. Encourage balanced nutrition and regular physical activity to maintain health.', 'd' => 'Maintain a balanced diet with all food groups: carbohydrates, proteins, fats, fruits, and vegetables. - Limit sugary snacks and processed foods.- Encourage regular hydration with water.- Promote at least 60 minutes of daily physical activity.' ],
                'Mild Overweight' => [ 'n' => 'The child is approaching overweight. Promote healthy eating habits and active play to prevent further weight gain.', 'd' => 'Replace sugary beverages with water or milk. Limit processed and high-fat snacks; choose fresh fruits and whole foods. Reduce portion sizes without skipping meals. Encourage regular physical activity, such as outdoor play or sports.' ],
                'Overweight' => [ 'n' => 'The child is overweight, increasing the risk of obesity-related health issues. Monitoring of calorie consumption and physical activity is needed  Early intervention with dietary and activity changes is needed.', 'd' => '- Focus on portion control and regular meal timings. Prioritize high-fiber foods like whole grains, fruits, and vegetables. Avoid fried and sugary foods; use baking or steaming methods. Introduce fun physical activities to reduce sedentary habits.' ],
                'Obesity' => [ 'n' => 'The child has significant excess weight, posing a high risk of severe health problems. Comprehensive intervention is required, potentially involving healthcare professionals.', 'd' => 'Consult a pediatric dietitian for a tailored plan. Gradually reduce calorie intake while ensuring nutrient density. Eliminate sugary drinks and high-fat junk foods. Increase daily physical activity, aiming for structured sports or fitness routines. Involve the family in adopting healthier eating and lifestyle habits' ],
            ];
            $map['wasting_birth_to_5_boy'] = $map['wasting_birth_to_5_girl'];
            $map['wasting_5_to_19_girl'] = $map['wasting_birth_to_5_girl'];
            $map['wasting_5_to_19_boy'] = $map['wasting_birth_to_5_girl'];
            $map['stunting_5_19_girl'] = [
                'Severe Stunting' => [ 'n' => 'Severe stunting related to prolonged inadequate nutrient intake and possible health complications as evidenced by height-for-age Z-score below -3.', 'd' => 'Prioritize calorie-dense, nutrient-rich foods like lean proteins, whole grains, dairy, and regular healthy snacks to support catch-up growth.' ],
                'Stunting' => [ 'n' => 'Stunting related to insufficient nutrient variety and caloric intake as evidenced by height-for-age Z-score between -3 and -2.', 'd' => 'Incorporate protein-rich foods (e.g., meat, beans) and micronutrients (e.g., iron, calcium) to encourage healthy growth.' ],
                // 'Normal' => [ 'n' => 'Normal growth supported by adequate nutrition as evidenced by height-for-age Z-score between -2 and +2.', 'd' => 'Maintain a balanced diet with a variety of fruits, vegetables, whole grains, lean proteins, and dairy to support overall health.' ],
                 'Normal' => [ 'n' => 'Normal growth supported by adequate nutrition as evidenced by height-for-age Z-score between -2 and +2.', 'd' => ' ' ],
                'Tall' => [ 'n' => 'Above-average height likely due to genetic factors and sufficient nutrient intake, as evidenced by height-for-age Z-score greater than +2.', 'd' => ' ' ],
            ];
            $map['stunting_5_19_boy'] = $map['stunting_5_19_girl'];
            $map['stunting_2_5_girl'] = [
                'Severe Stunting (LAZ/HAZ < -3)' => [ 'n' => 'Severe stunting related to chronic malnutrition and possible recurrent infections, as evidenced by height-for-age Z-score below -3.', 'd' => 'Emphasize nutrient-dense, high-protein foods like eggs, dairy, meats, fortified cereals, and calorie-dense snacks to support growth recovery.' ],
                'Stunting (LAZ/HAZ between -3 and -2)' => [ 'n' => 'Stunting related to suboptimal dietary intake and lack of dietary diversity, as evidenced by height-for-age Z-score between -3 and -2.', 'd' => 'Increase protein and iron-rich foods, such as beans, lean meats, leafy greens, and fortified cereals, to boost growth and development.' ],
                // 'Normal (LAZ/HAZ between -2 and +2)' => [ 'n' => 'Normal growth supported by adequate nutrient intake, as evidenced by height-for-age Z-score between -2 and +2.', 'd' => 'Maintain a balanced diet with a variety of fruits, vegetables, whole grains, lean proteins, and dairy to sustain healthy growth.' ],
                 'Normal (LAZ/HAZ between -2 and +2)' => [ 'n' => 'Normal growth supported by adequate nutrient intake, as evidenced by height-for-age Z-score between -2 and +2.', 'd' => ' ' ],
                'Tall (LAZ/HAZ > +2)' => [ 'n' => 'Above-average height potentially related to genetic factors and adequate nutrition, as evidenced by height-for-age Z-score greater than +2.', 'd' => 'Ensure continued balanced nutrition with appropriate portions to support proportionate growth and energy needs.' ],
            ];
            $map['stunting_2_5_boy'] = $map['stunting_2_5_girl'];
            $map['stunting_birth_to_2_girl'] = [
                'Severe Stunting (LAZ < -3)' => [ 'n' => 'Severe stunting related to chronic inadequate nutrient intake and frequent infections, as evidenced by length-for-age Z-score below -3.', 'd' => 'Prioritize high-calorie, nutrient-dense foods, including fortified cereals, protein-rich sources, and essential fats, and consult with a pediatric nutritionist.' ],
                'Stunting (LAZ between -3 and -2)' => [ 'n' => 'Stunting related to inadequate dietary diversity and insufficient caloric intake, as evidenced by length-for-age Z-score between -3 and -2.', 'd' => 'Incorporate iron- and protein-rich foods, including meats, legumes, and leafy greens, to support growth and immunity.' ],
                'Normal (LAZ between -2 and +2)' => [ 'n' => 'Normal growth supported by balanced nutrient intake as evidenced by length-for-age Z-score between -2 and +2.', 'd' => 'Maintain a balanced diet that includes a variety of fruits, vegetables, grains, and proteins to support continued healthy growth.' ],
                'Tall (LAZ > +2)' => [ 'n' => 'Height above average likely supported by adequate nutrient intake and genetics, as evidenced by length-for-age Z-score greater than +2.', 'd' => 'Continue with a well-balanced diet, ensuring nutrients are proportionate to height and activity levels to maintain balanced growth.' ],
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
            $data['details']['Nutritionist']['Assessment'] = $computedNutrition;
            $data['details']['DIETARY ADVICE']['advice'] = $computedDiet;
        }

        @ini_set('max_execution_time', '300');
        @set_time_limit(300);
        @ini_set('memory_limit', '512M');
        $name = $resultArray[0]['name'];
        $gr = $resultArray[0]['Gr_Number'] ;
        PDF::setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'DejaVu Sans',
            'dpi' => 300,
        ]);
        // $pdf = PDF::loadView('admin.pdf_view', $data);
        // return $pdf->download($name.'_'.$gr.'.pdf');
    //    dd(compact('data', 'formattedDate'));
    


    // Choose PDF view based on class label: grades 1–12 -> pdf-2, otherwise default pdf-1
    $selectedView = 'admin.health-report-pdf-1';
    if ($classLabel !== null && in_array($classLabel, ['1','2','3','4','5','6','7','8','9','10','11','12'], true)) {
        $selectedView = 'admin.health-report-pdf-2';
    }

    $pdf = PDF::loadView($selectedView, $data);
    $pdf->setPaper('A3', 'landscape'); // Increased canvas to A2 landscape to keep single-page
        return $pdf->download($name.'_'.$gr.'.pdf');
//    dd(compact('data', 'formattedDate'));
        // return view($selectedView, $data);
        

    }
}
