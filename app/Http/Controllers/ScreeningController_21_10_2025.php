<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

use App\Models\BioData;

use App\Models\School;
use App\Models\Area;
use App\Models\City;

use App\Models\form_entry;
use App\Models\Prescription;
use App\Models\StudentBiodata;
use App\Models\Aids;
use App\Models\FormData;
use App\Models\medicalComplain;
use App\Models\Labs;


use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\CalendarEvents;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class ScreeningController extends Controller
{


   /* CreateUpdate */
   public function CreateUpdate(Request $request, $id = null)
   {
        @set_time_limit(300); // 5 minutes
      @ini_set('max_execution_time', '300');
      @ini_set('memory_limit', '512M');

      if ($id > 0) {
         // dd($request->all());

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



         $resultArray = [$columns];

         // dd($resultArray);


         $data['details'] = [

            /* Bio Data */

            "id" => $id,
            "screeningFormId" => $resultArray[0]['screeningFormId'] ?? 0,

            "name" => $resultArray[0]['name'] ?? null,
            "guardianname" => $resultArray[0]['guardianname'] ?? null,
            "gender" => $resultArray[0]['gender'] ?? null,
            "class" => $resultArray[0]['class'] ?? null,
             "class_section" => $resultArray[0]['class_section'] ?? 'null',
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
            "Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye" => $resultArray[0]['Question_No_24B_Visual_acuity_using_Snellens_chart_left_eye'] ?? null,
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
            "Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen" => $resultArray[0]["Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen"] ?? null,
            "Question_No_44_Any_history_of_abdominal_Pain" => $resultArray[0]['Question_No_44_Any_history_of_abdominal_Pain'] ?? null,
            "any_history_of_abdominal_pain_specify" => $resultArray[0]['any_history_of_abdominal_pain_specify'] ?? null,
            "abdomen_comment" => $resultArray[0]['abdomen_comment'] ?? null,


            /* Musculoskeletal */
            "Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination" => $resultArray[0]["Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination"] ?? null,
            "Specify_limitations_in_the_childs_range_of_joint_motion_during_your_examination" => $resultArray[0]["Specify_limitations_in_the_child_s_range_of_joint_motion_during_your_examination"] ?? null,
            "Question_No_46_Spinal_curvature_assessment_tick_positive_finding" => $resultArray[0]["Question_No_46_Spinal_curvature_assessment_tick_positive_finding"] ?? null,
            "Question_No_47_side_to_side_curvature_in_the_spine_resembling" => $resultArray[0]["Question_No_47_side_to_side_curvature_in_the_spine_resembling"] ?? null,
            "Question_No_48_Adams_forward_bend_test" => $resultArray[0]['Question_No_48_Adams_forward_bend_test'] ?? null,
            "Question_No_49_Any_foot_or_toe_abnormalities" => $resultArray[0]['Question_No_49_Any_foot_or_toe_abnormalities'] ?? null,
            "musculoskeletal_comment" => $resultArray[0]['musculoskeletal_comment'] ?? null,


            /* Step Fourteen - Vaccination */

            "Question_No_50_Have_EPI_immunization_card" => $resultArray[0]["Question_No_50_Have_EPI_immunization_card"] ?? $resultArray[0]['Question_No_50_Have_EPI_immunization_card'] ?? null,
            "BCG_1_dose" => $resultArray[0]["BCG_1_dose"] ?? null,
            "OPV_4_dose" => $resultArray[0]["OPV_4_dose"] ?? null,
            "Pentavalent_vaccine_DTP" => $resultArray[0]["Pentavalent_vaccine_DTP"] ?? null,
            "rota" => $resultArray[0]["rota"] ?? null,
            "measles" => $resultArray[0]["measles"] ?? null,
            "never_had_any_vaccination" => $resultArray[0]['never_had_any_vaccination'] ?? null,
            "Reason_of_not_being_vaccinated" => $resultArray[0]['Reason_of_not_being_vaccinated'] ?? null,
            "vaccination_comment" => $resultArray[0]['vaccination_comment'] ?? null,


            /* Step Fifteen - Miscellaneous  */

            "Question_No_55_Do_you_have_any_Allergies" => $resultArray[0]["Question_No_55_Do_you_have_any_Allergies"] ?? $resultArray[0]['Question_No_55_Do_you_have_any_Allergies'] ?? null,
            "Do_you_have_any_allergies_specify" => $resultArray[0]['Do_you_have_any_allergies_specify'] ?? $resultArray[0]['Do_you_have_any_allergies_specify'] ?? null,
            "Question_No_56_Girls_above_8_years_old_ask" => $resultArray[0]['Question_No_56_Girls_above_8_years_old_ask'] ?? $resultArray[0]['Question_No_56_Girls_above_8_years_old_ask'] ?? null,
            "Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination" => $resultArray[0]["Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination"] ?? $resultArray[0]['Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination'] ?? null,
            "QuestionNo_58_Any_menstrual_abnormality" => $resultArray[0]['QuestionNo_58_Any_menstrual_abnormality'] ?? $resultArray[0]['QuestionNo_58_Any_menstrual_abnormality'] ?? null,
            "Any_menstrual_abnormality_specify" => $resultArray[0]['Any_menstrual_abnormality_specify'] ?? null,
            "miscellaneous_comment" => $resultArray[0]['miscellaneous_comment'] ?? null,

            // lead exposure
            "Question_No_48_Frequently_put_things_in_mouth" => $resultArray[0]["Question_No_48_Frequently_put_things_in_mouth"] ?? $resultArray[0]['Question_No_48_Frequently_put_things_in_mouth'] ?? null,
            "Question_No_49_Child_eat_non_food_items_pica" => $resultArray[0]['Question_No_49_Child_eat_non_food_items_pica'] ?? null,
            "Question_No_50_Contact_adult_job_lead_exposure" => $resultArray[0]['Question_No_50_Contact_adult_job_lead_exposure'] ?? null,
            "Question_No_51_Contact_adult_hobby_lead_exposure" => $resultArray[0]['Question_No_51_Contact_adult_hobby_lead_exposure'] ?? null,
            "lead_exposure_comment" => $resultArray[0]['lead_exposure_comment'] ?? null,

            /* Step Seventeen - Psychological */

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
            "social_emotional-test" => $resultArray[0]['social_emotional-test'] ?? null,
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
            "social_emotional_Attention_result" => $resultArray[0]['social_emotional_Attention_result'] ?? null,
            /* Step Seventeen - Nutritionist  */

            "Question_No_60_How_would_you_describe_your_lifestyle" => $resultArray[0]['Question_No_60_How_would_you_describe_your_lifestyle'] ?? null,
            "bmi61" => $resultArray[0]['bmi61'] ?? null,
            "muac_right_eye" => $resultArray[0]['muac_right_eye'] ?? null,
            "muac_left_eye" => $resultArray[0]['muac_left_eye'] ?? null,
            "Daily_Protien_requirement" => $resultArray[0]['Daily_Protien_requirement'] ?? null,
            "Daily_energy_requirement" => $resultArray[0]['Daily_energy_requirement'] ?? null,
            "Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day" => $resultArray[0]['Question_No65_How_many_glasses_of_waterliquids_do_you_consume_in_a_day'] ?? null,
            "Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to" => $resultArray[0]['Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to'] ?? null,
            "Question_No66_Substance_Abuse" => $resultArray[0]['Question_No66_Substance_Abuse'] ?? null,
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
            "doctor_comment" => $resultArray[0]['doctor_comment'] ?? null,
            "Reason_for_Follow_up" => $resultArray[0]['Reason_for_Follow_up'] ?? null,
            // "followup_required" => $resultArray[0]['followup_required'] ?? null,
            "Follow_up_Date" => $resultArray[0]['Follow_up_Date'] ?? null,
            "generalphysician_Follow_up_Date" => $resultArray[0]['generalphysician_Follow_up_Date'] ?? null,
            "externalspecialist_Follow_up_Date" => $resultArray[0]['externalspecialist_Follow_up_Date'] ?? null,
            "Physician_Follow_up_Date" => $resultArray[0]['Physician_Follow_up_Date'] ?? null,
            // "refer_to" => $resultArray[0]['refer_to'] ?? $resultArray[0]['refer_to[]'] ??null,
            "refer_to" => $resultArray[0]['refer_to'] ?? $resultArray[0]['refer_to[]'] ?? null,
            "referred_by" => $resultArray[0]['referred_by'] ?? null,
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



         ];


         // dd($data);

      }

      if ($request->isMethod('post')) {
         // Start database transaction for better performance and atomicity
         DB::beginTransaction();
         
         try {
         $groupedReferTo = [];
         $formData = $request->input('formData');
         $updateID = $request->input('updateID');
         $screeningFormId = $request->input('screeningFormId');
         $currentStepNumber = $request->input('currentStepNumber');
            
            // Initialize default message
            $message = 'Form data has been processed successfully';
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

            // Process form data to extract key values
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
            } elseif ($field['name'] === 'refer_to[]') {
               $groupedReferTo[] = $field['value'];
               } elseif ($field['name'] === 'Gr_Number') {
               $gr = $field['value'];

               // Check if 'Gr_Number' is present and numeric
               if ($gr === null) {
                     DB::rollback();
                  return response()->json([
                     'status' => false,
                     'message' => 'Gr Number is required.'
                  ]);
               }

               if (!is_numeric($gr)) {
                     DB::rollback();
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
            } elseif (isset($field['name']) && $field['name'] === 'Follow_up_Required') {
               $Follow_up_Required = $field['value'];
            } elseif ($field['name'] === 'Follow_up_Date') {
               $Follow_up_Date = $field['value'];
            }
         }

         if ($currentStepNumber == 1) {
            if ($updateID > 0) {
               $form = form_entry::where("id", $updateID)->first();
               $message = 'Enrollment has been updated successfully';
            } else {
               $form = new form_entry();
               $message = 'Enrollment has been submitted successfully';
            }

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
            $form->save();
            $storedRecordId = $form->id;

            $formData[] = ['name' => 'screeningFormId', 'value' => $screeningFormId];

               // Prepare bulk data for FormData
               $bulkFormData = [];
            foreach ($formData as $field) {
               if ($field['name'] !== '_token') {
                     $value = ($field['name'] == 'refer_to[]') ? json_encode($groupedReferTo) : (trim($field['value']) ?? null);
                     
                     $bulkFormData[] = [
                        'entry_id' => $storedRecordId,
                        'key' => trim($field['name']),
                        'value' => $value,
                        'created_at' => now(),
                        'updated_at' => now()
                     ];
                  }
               }

               // Bulk insert FormData records
               if (!empty($bulkFormData)) {
                  FormData::insert($bulkFormData);
               }

         } else {
            $storedRecordId = $updateID;

            // Set message for non-step1 submissions
            $message = 'Form data has been updated successfully';

            // Update Follow_up_Date_flag
            if (isset($Follow_up_Required) && isset($Follow_up_Date) && $Follow_up_Required == "Yes" && empty($Follow_up_Date)) {
               form_entry::where('id', $storedRecordId)->update(['Follow_up_Date_flag' => 0]);
            } elseif (isset($Follow_up_Required) && isset($Follow_up_Date) && $Follow_up_Required == "Yes" && !empty($Follow_up_Date)) {
               form_entry::where('id', $storedRecordId)->update(['Follow_up_Date_flag' => 1]);
            } else {
               form_entry::where('id', $storedRecordId)->update(['Follow_up_Date_flag' => 2]);
            }

            if ($currentStepNumber == 9) {
                  CalendarEvents::where('event_id', $storedRecordId)->where('event_type', 2)->update(['deleted' => 1]);
               }

               // Prepare bulk data for FormData updates/inserts
               $bulkUpdateData = [];
               $bulkInsertData = [];
               $existingKeys = FormData::where('entry_id', $storedRecordId)->pluck('key')->toArray();
      
            foreach ($formData as $field) {
               if ($field['name'] !== '_token') {
                     $value = ($field['name'] == 'refer_to[]') ? json_encode($groupedReferTo) : (trim($field['value']) ?? null);
                     
                     if (in_array($field['name'], $existingKeys)) {
                        // Update existing record
                        FormData::where('entry_id', $storedRecordId)
                               ->where('key', $field['name'])
                               ->update(['value' => $value, 'updated_at' => now()]);
                 } else {
                        // Insert new record
                        $bulkInsertData[] = [
                           'entry_id' => $storedRecordId,
                           'key' => trim($field['name']),
                           'value' => $value,
                           'created_at' => now(),
                           'updated_at' => now()
                        ];
                     }

                  // Create Calendar Event if Follow_up_Required is Yes
                  if ($field['name'] == "Follow_up_Required" && $field['value'] == "Yes" || $field['name'] == "refer_to[]") {
                     // Extract additional fields
                     $grNumber = null;
                     $followUpDate = null;
                     $Physician_Follow_up_Date = null;
                     $externalspecialist_Follow_up_Date = null;
                     $generalphysician_Follow_up_Date = null;
                        $reasonForFollowUp = null;

                     foreach ($formData as $item) {
                        switch ($item['name']) {
                           case 'Gr_Number':
                              $grNumber = $item['value'];
                              break;
                           case 'Follow_up_Date':
                              $followUpDate = $item['value'];
                              break;
                           case 'Physician_Follow_up_Date':
                              $Physician_Follow_up_Date = $item['value'];
                              break;
                           case 'externalspecialist_Follow_up_Date':
                              $externalspecialist_Follow_up_Date = $item['value'];
                              break;
                           case 'generalphysician_Follow_up_Date':
                              $generalphysician_Follow_up_Date = $item['value'];
                              break;
                              case 'Reason_for_Follow_up':
                                 $reasonForFollowUp = $item['value'];
                                 break;
                           }
                        }

                     if ($field['name'] == "refer_to[]") {
                        $refer_to_values = explode(',', $field['value']);  
            
                        $referrals = [
                           1 => ['color' => 'blue', 'description' => 'Psychologist', 'title' => 'Psychologist', 'date_key' => 'Physician_Follow_up_Date'],
                           2 => ['color' => 'green', 'description' => 'Nutritionist', 'title' => 'Nutritionist', 'date_key' => 'followUpDate'],
                           4 => ['color' => 'red', 'description' => 'External Specialists', 'title' => 'External Specialists', 'date_key' => 'externalspecialist_Follow_up_Date'],
                           5 => ['color' => 'red', 'description' => 'General Physician', 'title' => 'General Physician', 'date_key' => 'generalphysician_Follow_up_Date'],
                       ];
               
                        foreach ($refer_to_values as $refer_to) {
                            $CalendarEvents = new CalendarEvents();
                    
                            if (isset($referrals[$refer_to])) {
                                  $datekey = $referrals[$refer_to]['date_key'];
                              $specificdate = $$datekey ?? $followUpDate;
                              $CalendarEvents->startDate = $specificdate;
                              $CalendarEvents->endDate = $specificdate;
                              $CalendarEvents->color = $referrals[$refer_to]['color'];
                              $CalendarEvents->description = $referrals[$refer_to]['description'];
                              $CalendarEvents->title = $referrals[$refer_to]['title'];
                              $CalendarEvents->slug = Str::slug($referrals[$refer_to]['title'] . '-' . $grNumber);
                                             } else {
                              $CalendarEvents->startDate = $followUpDate;
                              $CalendarEvents->endDate = $followUpDate;
                              $CalendarEvents->color = 'gray';
                              $CalendarEvents->description = $reasonForFollowUp;
                              $CalendarEvents->title = 'Follow-up';
                              $CalendarEvents->slug = Str::slug('Follow-up-' . $grNumber);
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

               // Bulk insert new FormData records
               if (!empty($bulkInsertData)) {
                  FormData::insert($bulkInsertData);
               }
         }

            // Commit the transaction
            DB::commit();

         return response()->json([
            'status' => true,
            'message' => $message,
            'storedRecordId' => $storedRecordId
         ]);

         } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollback();
            
            // Log the error for debugging
            Log::error('Screening form submission error: ' . $e->getMessage(), [
               'file' => $e->getFile(),
               'line' => $e->getLine(),
               'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
               'status' => false,
               'message' => 'An error occurred while processing the request: ' . $e->getMessage()
            ]);
         }
      }

      $data['area'] = Area::get();
      $data['school'] = School::get();
      $data['city'] = City::get();
// dd($data);

      /* return view('Screening.CreateUpdate')->with(get_defined_vars()); */
      return view('Screening.CreateUpdate')->with($data);

   }

   /* Sample */
   public function Sample(Request $request)
   {
      return view('Screening.Sample')->with(get_defined_vars());

   }

   /* VitalsBMI */
   public function VitalsBMI(Request $request, $id = null)
   {
      $BioData = BioData::where('id', $id)->where('deleted', 0)->first();
      if (empty($BioData)) {
         return redirect()->back()->with('error_message', "Data not available");
      }


      return view('Screening.VitalsBMI')->with(get_defined_vars());

   }

   /* BioData */

   public function BioData(Request $request, $id = null)
   {
      if ($request->isMethod('post')) {

         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'guardianname' => 'required|string|max:255',
            'gender' => 'required|in:male,female,other',
            'school' => 'required|exists:schools,id',
            'city' => 'required|exists:cities,id',
            'area' => 'required|exists:areas,id',
            'dob' => 'required|date',
            'age' => 'required|numeric',
            'Emergency_Contact_Number' => 'required|string|max:255',
            'Gr_Number' => 'required|string|max:255',
            'Any_Known_Medical_Condition' => 'required|string|max:255',
            'Address' => 'required|string|max:255',
            'Blood_group' => 'required|string',
            'bio_data_comment' => 'required|string',
         ]);



         $UserID = auth()->guard('admin')->user()->id;
         $UserRole = auth()->guard('admin')->user()->role;

         // Create or update a BioData instance
         if ($id === null) {
            $BioData = new BioData();
            $BioData->created_by = $UserID;
         } else {
            $BioData = BioData::where('id', $id)->where('deleted', 0)->first();
            $BioData->updated_by = $UserID; // Record the updater

            if (empty($BioData)) {
               return redirect()->route('BioData')->with('error_message', "Data not available");
            }

            $BioData->updated_by = $UserID; // Record the updater

         }

         // Fill the BioData instance with the validated data
         $BioData->fill($validated);



         // Save the BioData instance
         $BioData->save();



         // Iterate over each attribute of BioData
         foreach ($BioData->getAttributes() as $key => $value) {
            // Skip the attributes you do not want to save in FormData
            if (in_array($key, ['created_at', 'updated_at', 'deleted'])) {
               continue;
            }

            // Check if a record already exists with the same entry_id and key
            $formDataModel = FormData::where('entry_id', $BioData->id)
               ->where('key', $key)
               ->first();

            if ($formDataModel) {
               // Update existing record
               $formDataModel->value = $value ?? '-';
            } else {
               // Create new record
               $formDataModel = new FormData();
               $formDataModel->entry_id = $BioData->id;
               $formDataModel->key = $key;
               $formDataModel->value = $value ?? '-';
            }

            // Save the record (either update or create)
            $formDataModel->save();
         }


         return redirect()->route('VitalsBMI', $BioData->id)->with(compact('BioData'));
      }

      // Load data if $id is not null
      if ($id !== null) {
         $BioData = BioData::where('id', $id)->where('deleted', 0)->first();
         // dd($BioData);
         if (empty($BioData)) {
            return redirect()->route('BioData')->with('error_message', "Data not available");
         }
      }

      $school = School::all(); // Assuming you have a School model
      $city = City::all(); // Assuming you have a City model
      $area = Area::all(); // Assuming you have an Area model

      return view('Screening.BioData')->with(get_defined_vars());
   }


   /* index*/
   public function index()
   {
      return view('Screening.index');

   }
   public function ScreeningForm()
   {
      return view('Screening.ScreeningIndex');

   }
   public function ScreeningList(Request $request)
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
            // 'form_entries.psychiatrist_id',
            // 'form_entries.nutritionist_id',
            'form_entries.doc_id',
            // 'form_entries.gender',
            'schools.school_name as school',
            'cities.name as city',
            // 'form_entries.age',
            'form_entries.phone',
            'form_entries.grno',
            'users.fullname as enterby',
            'form_entries.duration',
            'form_entries.created_at',
            'form_entries.Follow_up_Date_flag',

            DB::raw('COALESCE(docs.fullname, "N/A") as doctor_name'),
            // DB::raw('COALESCE(psychologists.fullname, "N/A") as psychologist_name'),
            // DB::raw('COALESCE(nutritionists.fullname, "N/A") as nutritionist_name'),
            DB::raw('CONCAT(schools.school_name, IF(users.fullname IS NOT NULL AND users.fullname != "", CONCAT(" - ", users.fullname), "")) as school_enterby')
         )
         ->join('schools', 'form_entries.school', '=', 'schools.id')
         ->join('cities', 'cities.id', '=', 'form_entries.city')
         ->join('users', 'users.id', '=', 'form_entries.enterby')
         ->leftJoin('users as docs', 'form_entries.doc_id', '=', 'docs.id');
         // ->leftJoin('users as psychologists', 'form_entries.psychiatrist_id', '=', 'psychologists.id')
         // ->leftJoin('users as nutritionists', 'form_entries.nutritionist_id', '=', 'nutritionists.id');


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
      if ($UserRole === 3) {
         $query->whereIn('form_entries.school', $UserSchoolIds);
      }
      if ($UserRole === 2) {
         $query->whereIn('form_entries.school', $UserSchoolIds);
         // $query->where('form_entries.enterby', $UserID);
      }

      /*if ($request->has('Follow_up_Date_flag')) {

          $Follow_up_Date_flag = $request->input('Follow_up_Date_flag');
          $query = $query->where('Follow_up_Date_flag', $Follow_up_Date_flag); // Adjust this to match your actual field name
      }*/

      if ($request->has('Follow_up_Date_flag')) {
         $Follow_up_Date_flag = $request->input('Follow_up_Date_flag');

         // If the value is empty (meaning "N/A" was selected), filter for null values
         if ($Follow_up_Date_flag == '') {
            $query->whereNull('form_entries.Follow_up_Date_flag');
         } else {
            $query->where('form_entries.Follow_up_Date_flag', $Follow_up_Date_flag);
         }

      }

      $query->where('form_entries.screeningFormId', 0);


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
            return '<a class="link" href="' . route('Details', $row->id) . '">' . $row->name . '</a>';
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

   public function ScreeningListIndex(Request $request)
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
   /* WastingBMICalculation */
   public function WastingBMICalculation(Request $request, $id = null)
   {

      if ($request->ajax()) {

         $DataArr = $request->all();


         $gender = $DataArr['gender'];
         $totalMonths = $DataArr['totalMonths'];
         $gender = ucfirst($gender);



         $data = DB::table('bmiForAge')
            ->where('Sex', $gender)
            ->where('Months', $totalMonths)
            ->first();
         // dd($data);
         if (!empty($data)) {
          
            return response()->json([
               'status' => true,
               'data' => $data,
               'DataArr' => $DataArr,
            ]);
         }


         return response()->json([
            'status' => false,
            'data' => $data,
            'DataArr' => $DataArr,

         ]);


      }

   }
  
   /* WastingCalculation */
   public function WastingCalculation(Request $request, $id = null)
   {
      // $temp = DB::table('bmiForAge2To5')->get();
      
      if ($request->ajax()) {
         
         $DataArr = $request->all();
         
         
         
         $gender = $DataArr['gender'];
         // $gender = ucfirst($gender);
         // dd( $gender);

         // $height = $DataArr['height'];
         $totalMonths = $DataArr['months'];

         $data = DB::table('wasting')
         ->where('Sex', $gender)
         ->where('Months', $totalMonths)
         ->first();
         // dd($data);

         if (!empty($data)) {
          
            return response()->json([
               'status' => true,
               'data' => $data,
            ]);
         }


         return response()->json([
            'status' => false,
            'data' => $data,
         ]);


      }

   }

   /* StuntingCriteria5 */
   public function StuntingCriteria5(Request $request, $id = null)
   {

      if ($request->ajax()) {

         $DataArr = $request->all();



         $gender = $DataArr['gender'];
         $gender = ucfirst($gender);

         $totalMonths = $DataArr['totalMonths'];


         $data = DB::table('ZScores')
            ->where('Gender', $gender)
            ->where('Month', $totalMonths)
            ->first();

         if (!empty($data)) {
          
            return response()->json([
               'status' => true,
               'data' => $data,
            ]);
         }


         return response()->json([
            'status' => false,
            'data' => $data,
         ]);


      }

   }

   /* WHZCalculationBmi */
   public function WHZCalculationBmi(Request $request, $id = null)
   {

      if ($request->ajax()) {

         $DataArr = $request->all();



         $gender = $DataArr['gender'];
         $gender = ucfirst($gender);

         $totalMonths = $DataArr['totalMonths'];
         $bmi = $DataArr['bmi'];



         $data = DB::table('ZScores')
            ->where('sex', $gender)
            ->where('Month', $totalMonths)
            ->first();

         if (!empty($data)) {

            // $data = $data->toArray();

            $L = $data->L;
            $M = $data->M;
            $S = $data->S;

            $z_index = (pow(($bmi / $M), $L) - 1) / ($S * $L);

            return response()->json([
               'status' => true,
               'data' => $data,
               'z_index' => $z_index,
            ]);
         }


         return response()->json([
            'status' => false,
            'data' => $data,
         ]);


      }


   }

   /* Details */

   public function Details(Request $request, $id = null)
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
         "class_section" => $resultArray[0]['class_section'] ?? null,
         "area" => $resultArray[0]['area'] ?? null,
         "dob" => $resultArray[0]['dob'] ?? null,
         "age" => $resultArray[0]['age'] ?? null,
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
         // "question_no_24_visual_acuity_using_snellens_chart" => $resultArray[0]['Question_No_24_Visual_acuity_using_Snellen's_chart'] ?? $resultArray[0]['Question_No_21_Visual_acuity_using_Snellen's_chart'] ?? null,
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
      $CountTotalIssues = 0;

      $questions = [

         /* General Apperance */


         ['key' => 'Question_No_8_Normal_Posture_Gait', 'label' => 'Posture/Gait', 'value' => 'no'],
         ['key' => 'Question_No_9_Mental_Status', 'label' => 'Mental Status', 'value' => 'Lethargic'],
         ['key' => 'Question_No_10_Look_For_jaundice', 'label' => 'Jaundice', 'value' => 'yes'],
         ['key' => 'Question_No_11_Look_For_anemia', 'label' => 'Anemia', 'value' => 'yes'],
         ['key' => 'Question_No_12_Look_For_Clubbing', 'label' => 'Clubbing', 'value' => 'yes'],
         ['key' => 'Question_No_13_Look_for_Cyanosis', 'label' => 'Cyanosis', 'value' => 'yes'],
         ['key' => 'Question_No_14_Skin', 'label' => 'Skin', 'value' => ['rash', 'allergy', 'lesion', 'bruises', 'Bad Breath']],
         ['key' => 'Question_No_15_Breath', 'label' => 'Breath', 'value' => 'Bad Breath'],

         /* Inspect Hygiene */

         ['key' => 'Question_No_16_Nails', 'label' => 'Nails', 'value' => 'dirty'],
         ['key' => 'Question_No_17_Uniform_or_shoes', 'label' => 'Uniform or Shoes', 'value' => 'untidy'],
         ['key' => 'Question_No_18_Lice/nits', 'label' => 'Lice/Nits', 'value' => 'yes'],
         ['key' => 'Question_No_19_Discuss_hygiene_routines_and_practices', 'label' => 'Hygiene Routines and Practices', 'value' => 'not-aware'],

         /* Head and Neck Examination */

         ['key' => 'Question_No_20_Hair_and_Scalp', 'label' => 'Hair and Scalp', 'value' => 'Color-faded'],
         ['key' => 'Question_No_21_Any_Hair_Problem', 'label' => 'Hair Problem', 'value' => ['Dry', 'Kinky', 'Brittle']],
         ['key' => 'Question_No_22_Scalp', 'label' => 'Scalp', 'value' => ['Dry', 'Scaly', 'Moist']],
         ['key' => 'Question_No_23_Hair_Distribution', 'label' => 'Hair Distribution', 'value' => ['Patchy', 'Receding', 'Receding_hair_line']],

         /* Eye Examination */

         ['key' => 'Question_No_25_Normal_ocular_alignment', 'label' => 'Ocular Alignment', 'value' => 'no'],
         ['key' => 'Question_No_26_Normal_eye_inspection', 'label' => 'Eye Inspection', 'value' => 'no'],
         ['key' => 'Question_No_28_Nystagmus', 'label' => 'Nystagmus', 'value' => 'yes'],

         /* Ears */

         ['key' => 'Question_No_29_Normal_ears_shape_and_position', 'label' => '  Ears Shape and Position', 'value' => 'no'],
         ['key' => 'Question_No_30_Ear_examination', 'label' => '  Ear Examination', 'value' => ['Ear wax', 'Canal Infection']],
         ['key' => 'Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber', 'label' => '  Conclusion of Hearing Test', 'value' => ['right_ear_conductive_hearing_loss', 'left_ear_conductive_hearing_loss', 'right_sensorineural_loss', 'left_sensorineural_loss']],


         /* Nose */

         ['key' => 'Question_No_32_External_nasal_examinaton', 'label' => '  External Nasal Examination', 'value' => ['deformities', 'swelling', 'redness', 'lesions', 'Nasal Discharge']],
         ['key' => 'Question_No_33_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patients_ability_to_breathe_through_each_nostril', 'label' => '  Nasal Patency Test', 'value' => ['obstruction', 'dns']],

         /* Oral */

         ['key' => 'Question_No_34_Assess_gingiva', 'label' => ' Assess Gingiva', 'value' => ['Infection', 'bleed']],
         ['key' => 'Question_No_35_Are_there_dental_caries', 'label' => '  Are There Dental Caries', 'value' => 'yes'],

         /* Throat */

         ['key' => 'Question_No_36_Examine_tonsils', 'label' => '  Examine Tonsils', 'value' => 'tonsillitis'],
         ['key' => 'Question_No_37_Normal_Speech_development', 'label' => '  Speech Development', 'value' => 'no'],
         ['key' => 'Question_No_38_Any_Neck_swelling', 'label' => '  Neck Swelling', 'value' => 'yes'],
         ['key' => 'Question_No_39_Examine_lymph_node', 'label' => '  Examine Lymph Node', 'value' => 'abnormal'],

         /* Chest */

         ['key' => 'Question_No_40_Any_visible_chest_deformity', 'label' => '  Visible Chest Deformity', 'value' => 'yes'],
         ['key' => 'Question_No_41_Lung_Auscultation', 'label' => '  Lung Auscultation', 'value' => ['wheezing', 'crackles']],
         ['key' => 'Question_No_42_Cardiac_Auscultation', 'label' => '  Cardiac Auscultation', 'value' => 'murmur'],

         /* Abdomen */

         ['key' => 'Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen', 'label' => '  Distension/Scars/Masses on Abdomen', 'value' => ['distension', 'scar', 'mass']],

         /* Musculoskeletal */

         ['key' => 'Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination', 'label' => ' Limitations in Joint Motion', 'value' => 'yes'],
         ['key' => 'Question_No_46_Spinal_curvature_assessment_tick_positive_finding', 'label' => ' Spinal Curvature Assessment', 'value' => ['uneven shoulder', 'shoulder blade', 'uneven waist', 'Hips']],
         ['key' => 'Question_No_47_side_to_side_curvature_in_the_spine_resembling', 'label' => '  Side-to-Side Curvature', 'value' => ['c_shape', 's_shape']],
         ['key' => 'Question_No_48_Adams_forward_bend_test', 'label' => '  Adams Forward Bend Test', 'value' => 'positive'],
         ['key' => 'Question_No_49_Any_foot_or_toe_abnormalities', 'label' => '  Foot or Toe Abnormalities', 'value' => ['flat feet', 'varus', 'valgus', 'high arch', 'hammer toe', 'bunion']],

         /*    Vaccination */

         ['key' => 'Question_No_50_Have_EPI_immunization_card', 'label' => '  EPI Immunization Card', 'value' => ['No','no']],

         /*   Miscellaneous  */

         ['key' => 'Question_No_55_Do_you_have_any_Allergies', 'label' => '   Allergies', 'value' => 'yes'],
         /* ['key' => 'Question_No_56_Girls_above_8_years_old_ask:?', 'label' => '  Girls Above 8 Years Old Ask?', 'value' => 'no'], */
         ['key' => 'Question_No_57_Inquire_about_urinary_frequency_urgency_and_any_pain_or_discomfort_during_urination', 'label' => ' Inquire About Urinary Frequency', 'value' => 'yes'],
       
         /* Psychological */
         
         // ['key' => 'Question_No_58_Note_any_discomfort_or_pain_in_the_abdominal_area?', 'label' => '   Discomfort or Pain in the Abdominal Area', 'value' => 'yes'],
         // ['key' => 'Question_No_59_Looking_for_clinical_signs_of_dehydration?', 'label' => '  Clinical Signs of Dehydration', 'value' => 'yes'],
         // ['key' => 'Question_No_60_Swelling_in_the_extremities?', 'label' => '  Swelling in the Extremities', 'value' => 'yes'],

         /* ['key' => 'observation1', 'label' => 'Observation 1', 'value' => [3, 4]],
          ['key' => 'observation2', 'label' => 'Observation 2', 'value' => [3, 4]],
          ['key' => 'observation3', 'label' => 'Observation 3', 'value' => [3, 4]],
          ['key' => 'observation4', 'label' => 'Observation 4', 'value' => [3, 4]],
          ['key' => 'observation5', 'label' => 'Observation 5', 'value' => [3, 4]],
          ['key' => 'observation6', 'label' => 'Observation 6', 'value' => [3, 4]],
          ['key' => 'observation7', 'label' => 'Observation 7', 'value' => [3, 4]],
          ['key' => 'observation8', 'label' => 'Observation 8', 'value' => [3, 4]],
          ['key' => 'observation9', 'label' => 'Observation 9', 'value' => [3, 4]],
          ['key' => 'observation10', 'label' => 'Observation 10', 'value' => [3, 4]],*/

         // ['key' => 'bmi61', 'label' => 'BMI', 'value' => null],
         // ['key' => 'muac', 'label' => 'MUAC', 'value' => null],
         // ['key' => 'Daily_Protien_requirement', 'label' => 'Daily Protein Requirement', 'value' => null],
         // ['key' => 'Daily_energy_requirement', 'label' => 'Daily Energy Requirement', 'value' => null],
         // ['key' => 'meals', 'label' => 'Meals', 'value' => null],
         // ['key' => 'food_items', 'label' => 'Food Items', 'value' => null],
     ];

// $Screeningform = form_entry::where('screeningFormId', $id)
//                     ->orWhere('id', $id)
//                     ->get()
//                     ->toArray(); 
// dd($Screeningform);
$count1 = 1;
$data['findings'] = [];

$entries = form_entry::where('id', $id)
    ->orWhere('screeningFormId', $id)
    ->get(['id', 'created_at', 'enterby']);

foreach ($entries as $entry) {

    $questionKeys = [];
    $questionValues = [];
    $labels = [];
    $questionsWithAnswers = [];

    foreach ($questions as $question) {
        $query = FormData::where('entry_id', $entry->id)
            ->where('key', $question['key']);

        if (is_array($question['value'])) {
            $query->whereIn('value', $question['value']);
        } else {
            $query->where('value', $question['value']);
        }

        $matchedValues = $query->pluck('value')->toArray();
        $count = count($matchedValues);

        if ($count > 0) {
            $questionKeys[] = $question['key'];
            $questionValues[] = is_array($question['value']) ? implode(', ', $question['value']) : $question['value'];
            $labels[] = $question['label'];
            $questionsWithAnswers[] = $question['label'] . ': ' . implode(', ', $matchedValues);
        }
    }

    $data['findings'][] = [
        'entryId' => $entry->id,
        'created_at' => $entry->created_at->format('Y-m-d H:i:s'),
        'created_by' => $entry->enterby,
        'question_key' => implode(' | ', $questionKeys),
        'question_value' => implode(' | ', $questionValues),
        'label' => implode(' | ', $labels),
        'questions_with_answers' => implode(' | ', $questionsWithAnswers),
        'count' => count($questionsWithAnswers),
    ];

    $count1++;
}

// dd($data['findings']);




      $data['area'] = Area::get();
      $data['school'] = School::get();
      $data['city'] = City::get();
      $data['form_id'] = $id;
      $data['form_date'] = form_entry::where('id', $id)->first()->created_at;

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
            $data['followUps'] =  DB::table('followUp')->whereIn('ref',$data['medical_history_id'])->get();
            // dd($data['followUps']);

      }

      
      return view('Screening.Details', $data);

      /*return view('admin.GeneralInfo', $data);*/
   }


   /* DeleteRecord */
   public function DeleteRecord($id)
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


}
