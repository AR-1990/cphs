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
        // $data = FormData::find($request->id); // Replace FormData with the actual model you are using

        // $data['details'] = FormData::where('entry_id',$id)->get();
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
                // Uncomment if "Uniform or Shoes" field is needed
                // "Uniform or Shoes" => isset($resultArray[0]['Question_No_17_Uniform_or_shoes']) ? $resultArray[0]['Question_No_17_Uniform_or_shoes'] : 
                //                      (isset($resultArray[0]['Question_No_16_Uniform_or_shoes']) ? $resultArray[0]['Question_No_16_Uniform_or_shoes'] : null),
                "lice/Nits" => isset($resultArray[0]['Question_No_18_Lice_nits']) ? $resultArray[0]['Question_No_18_Lice_nits'] : (isset($resultArray[0]['Question_No_17_Lice/nits']) ? $resultArray[0]['Question_No_17_Lice/nits'] : (isset($resultArray[0]['Question_No_18_Lice/nits']) ? $resultArray[0]['Question_No_18_Lice/nits']:null)),
                // Uncomment if "Hygiene Routines and Practices" field is needed
                // "Hygiene Routines and Practices" => isset($resultArray[0]['Question_No_19_Discuss_hygiene_routines_and_practices']) ? $resultArray[0]['Question_No_19_Discuss_hygiene_routines_and_practices'] : 
                //                                      (isset($resultArray[0]['Question_No_18_Discuss_hygiene_routines_and_practices']) ? $resultArray[0]['Question_No_18_Discuss_hygiene_routines_and_practices'] : null),
                // "Comment" => isset($resultArray[0]['inspect_hygiene_comment']) ? $resultArray[0]['inspect_hygiene_comment'] : null,
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
                // "Nose Comment" => $resultArray[0]['nose_comment'] ?? null,
                // "GUMS" => $resultArray[0]['Question_No_34_Assess_gingiva'] ?? $resultArray[0]['Question_No_31_Assess_gingiva'] ?? null,
                // "dental_caries" => $resultArray[0]['Question_No_35_Are_there_dental_caries'] ?? $resultArray[0]['Question_No_32_Are_there_dental_caries'] ?? null,
                // "Comment" => $resultArray[0]['oral_comment'] ?? null,
            ],
            "Dental Examination" => [
                "heading" => 'Dental Examination',
                // "External_nasal_examinaton" => $resultArray[0]['Question_No_32_External_nasal_examinaton'] ?? $resultArray[0]['Question_No_29_External_inasal_examinaton'] ?? null,
                // "nasal_patency_test" => $resultArray[0]["Question_No_33_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patient's_ability_to_breathe_through_each_nostril"] ?? $resultArray[0]["Question_No_30_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patient's_ability_to_breathe_through_each_nostril"] ?? null,
                // "Nose Comment" => $resultArray[0]['nose_comment'] ?? null,
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
                // "Specify_lymph_node" => $resultArray[0]['Specify_lymph_node'] ?? null,
                // "Specify_any_neck_swelling" => $resultArray[0]['Specify_Any_Neck_swelling'] ?? null,
                // "Comment" => $resultArray[0]['throat_comment'] ?? null,
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
                // "specify_limitations_in_the_childs_range_of_joint_motion_during_your_examination" => $resultArray[0]["Specify_limitations_in_the_child's_range_of_joint_motion_during_your_examination?"] ?? null,
                // "question_no_46_spinal_curvature_assessment_tick_positive_finding" => $resultArray[0]["Question_No_46_Spinal_curvature_assessment_tick_positive_finding"] ?? $resultArray[0]['Question_No_44_Spinal_curvature_assessment_(tick_positive_finding)'] ?? null,
                // "question_no_47_side-to-side_curvature_in_the_spine_resembling" => $resultArray[0]["Question_No_47_side_to_side_curvature_in_the_spine_resembling"] ?? null,
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

                    // "Frequently_put_things_in_hisher_mouth_such_as_toys_jewelry_or_keys" => $resultArray[0]["Question_51_Do_you_Frequently_put_things_in_his/her_mouth_such_as_toys,_jewelry,_or_keys?"] ?? $resultArray[0]['Question_50_Do_you_Frequently_put_things_in_his/her_mouth_such_as_toys,_jewelry,_or_keys?'] ?? null,
                    // "Child_eat_non_food_items_pica" => $resultArray[0]["Question_52_Does_your_child_eat_non_food_items_(pica)?"] ?? $resultArray[0]['Question_51_Does_your_child_eat_non_food_items_(pica)?'] ?? null,
                    // "Frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead" => $resultArray[0]["Question_53_Do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead?"] ?? $resultArray[0]['Question_52_Do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead?'] ?? null,
                    // "Frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead" => $resultArray[0]["Question_54_Do_you_frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead?"] ?? $resultArray[0]['Question_53_Do_you_frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead?'] ?? null,
                    // "Comment" => $resultArray[0]['lead_exposure_comment'] ?? null,
                    // here is the value to be shown 
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
            //    "Psychological" => array_merge(


            //     (isset($resultArray[0]['class']) && in_array(strtolower($resultArray[0]['class']), ['3', '4', '5', '6', '7', '8', '9', '10', '11', '12'])) ? [
            //         "heading" => 'Psychological Assessment',
            //         "intrusive thoughts" => $resultArray[0]['Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts'] ?? 
            //                                 $resultArray[0]['Question_No_58_How_often_do_you_experience_negative_or_intrusive_thoughts?'] ?? null,
            //         "SELF ESTEEM" => $resultArray[0]['Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence?'] ?? 
            //                          $resultArray[0]['Question_No_59_How_would_you_rate_your_overall_self_esteem_and_self_confidence?'] ?? null,
            //         "ENERGY LEVEL" => $resultArray[0]['Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day?'] ?? 
            //                           $resultArray[0]['Question_No_60_How_would_you_describe_your_energy_levels_throughout_a_typical_day?'] ?? null,
            //         "PROBLEM SOLVING SKILLS" => $resultArray[0]["Question_No_62_When_faced_with_challenges,_what_are_your_typical_coping_mechanisms?"] ?? 
            //                                     $resultArray[0]['Question_No_61_When_faced_with_challenges,_what_are_your_typical_coping_mechanisms?'] ?? null,
            //         "QUALITY OF SLEEP" => $resultArray[0]['Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average?'] ?? 
            //                               $resultArray[0]['Question_No_62_How_would_you_rate_the_quality_of_your_sleep_on_average?'] ?? null,
            //         "FEELINGS OF STRESSED OUT" => $resultArray[0]['Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks?'] ?? 
            //                                       $resultArray[0]['Question_No_63_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks?'] ?? null,
            //         "MOODS" => $resultArray[0]['Question_No_65_How_would_you_describe_your_overall_mood_during_the_day?'] ?? 
            //                    $resultArray[0]['Question_No_64_How_would_you_describe_your_overall_mood_during_the_day?'] ?? null,
            //         "FAMILY RELATIONSHIP" => $resultArray[0]['Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members?'] ?? 
            //                                  $resultArray[0]['Question_No_65_How_would_you_describe_the_quality_of_your_relationships_with_family_members?'] ?? null,
            //         "Handle Challenges" => $resultArray[0]['Question_No_67_How_well_does_you_handle_challenges_and_solve_problems?'] ?? 
            //                                $resultArray[0]['Question_No_66_How_well_does_you_handle_challenges_and_solve_probnlems?'] ?? null,
            //         "HOURS OF SLEEP" => $resultArray[0]['Question_No_68_How_many_hours_of_sleep_does_you_typically_get_on_a_school_night?'] ?? 
            //                             $resultArray[0]['Question_No_67_How_many_hours_of_sleep_does_you_typically_get_on_a_school_night?'] ?? null,
            //         "FOLLOWUP WITH PSYCHOLOGIST" => $resultArray[0]['followup_required'] ?? null,
            //         "Psychologist_Comment" => $resultArray[0]['Psychologist_Findings']  ?? null
            //     ] : [
            //         "heading" => 'Psychological Assessment',
            //         "Restless or overactive" => isset($resultArray[0]['observation1']) ? 
            //                                      ($resultArray[0]['observation1'] == 1 ? 'Not At All' : ($resultArray[0]['observation1'] == 2 ? 'Just a Little' : ($resultArray[0]['observation1'] == 3 ? 'Pretty Much' : ($resultArray[0]['observation1'] == 4 ? 'Very Much' : 'N/A')))) : null,
            //         "Excitable, Impulsive" => isset($resultArray[0]['observation2']) ?  
            //                                    ($resultArray[0]['observation2'] == 1 ? 'Not At All' : 
            //                                    ($resultArray[0]['observation2'] == 2 ? 'Just a Little' : 
            //                                    ($resultArray[0]['observation2'] == 3 ? 'Pretty Much' : 
            //                                    ($resultArray[0]['observation2'] == 4 ? 'Very Much' : 'N/A')))) : null,
            //         "Disturbs other children" => isset($resultArray[0]['observation3']) ? 
            //                                       ($resultArray[0]['observation3'] == 1 ? 'Not At All' : 
            //                                       ($resultArray[0]['observation3'] == 2 ? 'Just a Little' : 
            //                                       ($resultArray[0]['observation3'] == 3 ? 'Pretty Much' : 
            //                                       ($resultArray[0]['observation3'] == 4 ? 'Very Much' : 'N/A')))) : null,
            //         "SHORT SPAN" => isset($resultArray[0]['observation4']) ? 
            //                         ($resultArray[0]['observation4'] == 1 ? 'Not At All' : 
            //                         ($resultArray[0]['observation4'] == 2 ? 'Just a Little' : 
            //                         ($resultArray[0]['observation4'] == 3 ? 'Pretty Much' : 
            //                         ($resultArray[0]['observation4'] == 4 ? 'Very Much' : 'N/A')))) : null,
            //         "Inattentive, easily distracted" => isset($resultArray[0]['observation5']) ? 
            //                                             ($resultArray[0]['observation5'] == 1 ? 'Not At All' : 
            //                                             ($resultArray[0]['observation5'] == 2 ? 'Just a Little' : 
            //                                             ($resultArray[0]['observation5'] == 3 ? 'Pretty Much' : 
            //                                             ($resultArray[0]['observation5'] == 4 ? 'Very Much' : 'N/A')))) : null,
            //         "Cries often and easily" => isset($resultArray[0]['observation6']) ? 
            //                                     ($resultArray[0]['observation6'] == 1 ? 'Not At All' : 
            //                                     ($resultArray[0]['observation6'] == 2 ? 'Just a Little' : 
            //                                     ($resultArray[0]['observation6'] == 3 ? 'Pretty Much' : 
            //                                     ($resultArray[0]['observation6'] == 4 ? 'Very Much' : 'N/A')))) : null,
            //         "SPELLINGS" => isset($resultArray[0]['observation7']) ? 
            //                        ($resultArray[0]['observation7'] == 1 ? 'Not At All' : 
            //                        ($resultArray[0]['observation7'] == 2 ? 'Just a Little' : 
            //                        ($resultArray[0]['observation7'] == 3 ? 'Pretty Much' : 
            //                        ($resultArray[0]['observation7'] == 4 ? 'Very Much' : 'N/A')))) : null,
            //         "WRITES DATE ACCURATELY" => isset($resultArray[0]['observation8']) ? 
            //                                      ($resultArray[0]['observation8'] == 1 ? 'Not At All' : 
            //                                      ($resultArray[0]['observation8'] == 2 ? 'Just a Little' : 
            //                                      ($resultArray[0]['observation8'] == 3 ? 'Pretty Much' : 
            //                                      ($resultArray[0]['observation8'] == 4 ? 'Very Much' : 'N/A')))) : null,
            //         "DIRECTIONS SENSE" => isset($resultArray[0]['observation9']) ? 
            //                                ($resultArray[0]['observation9'] == 1 ? 'Not At All' : 
            //                                ($resultArray[0]['observation9'] == 2 ? 'Just a Little' : 
            //                                ($resultArray[0]['observation9'] == 3 ? 'Pretty Much' : 
            //                                ($resultArray[0]['observation9'] == 4 ? 'Very Much' : 'N/A')))) : null,
            //         "CRYING SPELLS" => isset($resultArray[0]['observation10']) ? 
            //                            ($resultArray[0]['observation10'] == 1 ? 'Not At All' : 
            //                            ($resultArray[0]['observation10'] == 2 ? 'Just a Little' : 
            //                            ($resultArray[0]['observation10'] == 3 ? 'Pretty Much' : 
            //                            ($resultArray[0]['observation10'] == 4 ? 'Very Much' : 'N/A')))) : null,
            //         "PSYCHOLOGIST_comment" => $resultArray[0]['psychological_comment'] ?? null
            //     ]

            //     ),
            // "mrr" => "{$year}{$id}",
            /****************************** Nutritionist ***********************************/
    //         "Psychological" => [
    //             "heading" => 'Psychological Assessment',
    //             // "Psychologist_Comment" => $resultArray[0]['Psychologist_Findings']  ??$resultArray[0]['psychological_comment']  ?? null
    //             "Psychologist_Comment" => isset($resultArray[0]['Psychologist_Findings']) 
    // ? rtrim($resultArray[0]['Psychologist_Findings'], ',No.') 
    // : (isset($resultArray[0]['psychological_comment']) 
    //     ? rtrim($resultArray[0]['psychological_comment'], ',No.') 
    //     : null),

    //         ],
            // "Psychological" => [
            //         "heading" => 'Psychological Assessment',
            //          "Psychologist_Comment" => isset($resultArray[0]['Psychologist_Findings']) && !empty($resultArray[0]['Psychologist_Findings']) 
            //         ? str_replace("No.", "", $resultArray[0]['Psychologist_Findings']) 
            //         : (isset($resultArray[0]['psychological_comment']) && !empty($resultArray[0]['psychological_comment']) 
            //             ? str_replace("No.", "", $resultArray[0]['psychological_comment']) 
            // : null)
            // ],
                "Psychological" => [
                    "heading" => 'Psychological Assessment',
                    "Psychologist_Comment" => 
                        isset($resultArray[0]['social_emotional-test']) && !empty($resultArray[0]['social_emotional-test'])
                            ? str_replace("No.", "", $resultArray[0]['social_emotional-test'])
                            : (
                                isset($resultArray[0]['Psychologist_Findings']) && !empty($resultArray[0]['Psychologist_Findings'])
                                    ? str_replace("No.", "", $resultArray[0]['Psychologist_Findings'])
                                    : (
                                        isset($resultArray[0]['psychological_comment']) && !empty($resultArray[0]['psychological_comment'])
                                            ? str_replace("No.", "", $resultArray[0]['psychological_comment'])
                                            : null
                                    )
                            ),
                ],
            "Nutritionist" => [
                "heading" => 'Nutritional Assessment',
                // "Describe_your_lifestyle" => $resultArray[0]['Question_No_60_How_would_you_describe_your_lifestyle'] ?? null,
                // "bmi61" => $resultArray[0]['bmi61'] ?? null,
                // "MUAC" => $resultArray[0]['muac'] ?? null,
                // "DAILY PROTEIN REQUIREMENT" => $resultArray[0]['Daily_Protien_requirement'] ?? null,
                // "DAILY ENERGY REQUIREMENT" => $resultArray[0]['Daily_energy_requirement'] ?? null,
                // "glasses_of_liquids_consumption_in_a_day" => $resultArray[0]['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'] ?? null,
                // "ANY HISTORY OF SUBSTANCE ABUSE" => $resultArray[0]['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'] ?? null,
                // "Addiction" => $resultArray[0]['addiction'] ?? null,
                // "Other_addiction" => $resultArray[0]['other_addiction'] ?? null,
                // "ANY KNOWN ALLERGY AS REPORTED BY CHILD" => $resultArray[0]['food_allergies'] ?? null,
                // "lifestyle" => $resultArray[0]['lifestyle'] ?? null,
                // "number of meals in a day" => $resultArray[0]['meals'] ?? null,
                // "consumption of packaged food items" => $resultArray[0]['food_items'] ?? null,
                // "consumption of fast food items" => $resultArray[0]['fast_food'] ?? null,
                "Assessment" => $resultArray[0]['NutritionistComment'] ?? $resultArray[0]['NutritionistComment '] ?? null,
                // "FOLLOWUP WITH NUTRIONIST" => $resultArray[0]['Follow_up_Required'] ?? null,
                // "Reason_for_Follow_up" => $resultArray[0]['Reason_for_Follow_up'] ?? null,
                // "Follow_up_Date" => $resultArray[0]['Follow_up_Date'] ?? null,
                // "Refer_to" => $resultArray[0]['refer_to'] ?? null,            

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

// dd($data['details']['Nutritionist']['Assessment']);
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