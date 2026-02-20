<?php

namespace App\Exports;

use App\Models\form_entry;
use App\Models\FormData;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class ExcelExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    private $heading = [
        'id' => 'System Id',
        'name' => 'Name',
        'guardianname' => 'Guardian Name',
        'gender' => 'Gender',
        'school' => 'School',
        'city' => 'City',
        'area' => 'Area',
        'dob' => 'Date Of Birth',
        'age' => 'Age',
        'Emergency_Contact_Number' => 'Emergency Contact Number',
        'Gr_Number' => 'Gr Number',
        'Any_Known_Medical_Condition' => 'Any Known Medical Condition',
        'Address' => 'Address',
        'Blood_group' => 'Blood Group',
        'bio_data_comment' => 'Comment',
        'Question_No_1_Height' => 'Height',
        'Question_No_2_Weight' => 'Weight',
        'Question_No_3_BMI' => 'BMI',
        'Question_No_4_Body_Temperature' => 'Body Temperature',
        'Bodytempunit' => 'Temperature Unit',
        'Question_No_5_Blood_Pressure_Systolic' => 'Blood Pressure Systolic',
        'Question_No_6_Blood_Pressure_Diastolic' => 'Blood Pressure Diastolic',
        'Question_No_7_Pulse' => 'Pulse',
        'vitals_bmi_comment' => 'Vitals BMI Comment',
        'Question_No_8_Normal_Posture/Gait' => 'Normal Posture/Gait',
        'Question_No_9_Mental_Status' => 'Mental Status',
        'Question_No_10_Look_For_jaundice' => 'Look For jaundice',
        'Question_No_11_Look_For_anemia' => 'Look For Anemia',
        'Question_No_12_Look_For_Clubbing' => 'Look For Clubbing',
        'Question_No_13_Look_for_Cyanosis' => 'Look for Cyanosis',
        'Question_No_14_Skin' => 'Skin',
        'Question_No_15_Breath' => 'Breath',
        'general_apperance_comment' => 'General Apperance Comment',
        'Question_No_16_Nails' => 'Nails',
        'Question_No_17_Uniform_or_shoes' => 'Uniform or shoes',
        'Question_No_18_Lice/nits' => 'Lice/nits',
        'Question_No_19_Discuss_hygiene_routines_and_practices' => 'Hygiene routines & practices',
        'inspect_hygiene_comment' => 'Inspect Hygiene Comment',
        'Question_No_20_Hair_and_Scalp' => 'Hair & Scalp',
        'Question_No_21_Any_Hair_Problem' => 'Any Hair Problem',
        'Question_No_22_Sclap' => 'Sclap',
        'Question_No_23_Hair_distribution' => 'Hair distribution',
        'head_and_neck_examination_comment' => 'Head & Neck examination comment',
        'Question_No_24_Visual_acuity_using_Snellen’s_chart' => 'Visual acuity using Snellen’s chart & practices.',
        'Question_No_25_Normal_ocular_alignment' => 'Normal ocular alignment',
        'Question_No_26_Normal_eye_inspection' => 'Normal_eye inspection',
        'Question_No_27_Normal_Color_vision' => 'Normal Color vision',
        'Question_No_28_Nystagmus' => 'Nystagmus',
        'eye_comment' => 'Eye Comment',
        'Question_No_29_Normal_ears_shape_and_position' => 'Normal ears shape & position',
        'Question_No_30_Ear_examination' => 'Ear examination',
        'Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber' => 'Conclusion of hearing test with Rinner & Weber',
        'ears_comment' => 'Ears Comment',
        'Question_No_32_External_nasal_examinaton' => 'External inasal examinaton',
        "Question_No_33_perform_a_nasal_patency_test_which_involves_gently_closing_one_nostril_at_a_time_to_assess_the_patient's_ability_to_breathe_through_each_nostril" => 'Perform a nasal patency test',
        'nose_comment' => 'Nose Comment',
        'Question_No_34_Assess_gingiva' => 'Assess gingiva',
        'Question_No_35_Are_there_dental_caries' => 'Dentald Caries',
        'oral_comment' => 'Oral Comment',
        'Question_No_36_Examine_tonsils' => 'Examine tonsils',
        'Question_No_37_Normal_Speech_development' => 'Normal Speech development',
        'Question_No_38_Any_Neck_swelling' => 'Any Neck Swelling',
        'Question_No_39_Examine_lymph_node' => 'Examine lymph node',
        'Specify_lymph_node' => 'Specify lymph node',
        'Specify_Any_Neck_swelling' => 'Specify Any Neck swelling',
        'throat_comment' => 'Throat Comment',
        'Question_No_40_Any_visible_chest_deformity' => 'Chest deformity',
        'Question_No_41_Lung_Auscultation' => 'Lung Auscultation',
        'Question_No_42_Cardiac_Auscultation' => 'Cardiac Auscultation',
        'chest_comment' => 'Chest Comment',
        "Question_No_43_Did_you_observe_any_distension,_scars,_or_masses_on_the_child's_abdomen?" => 'Distension, scars, or masses on abdomen',
        'Question_No_44_Any_history_of_abdominal_Pain' => 'history of abdominal Pain',
        'any_history_of_abdominal_pain_specify' => 'Specify abdominal pain history',
        'abdomen_comment' => 'Abdomen Comment',
        "Question_No_45_Did_you_observe_any_limitations_in_the_child's_range_of_joint_motion_during_your_examination?" => 'Any limitations in the range of joint motion',
        "Specify_limitations_in_the_child's_range_of_joint_motion_during_your_examination?" => 'Specify limitations in the range of joint motion',
        "Question_No_46_Spinal_curvature_assessment_(tick_positive_finding)" => 'Spinal curvature assessment',
        "Question_No_47_side-to-side_curvature_in_the_spine_resembling" => 'side to side curvature',
        "Question_No_48_Adams_forward_bend_test" => "Adams forward Bend Test",
        "Question_No_49_Any_foot_or_toe_abnormalities" => "Any Foot/Toe Abnormalities",
        "musculoskeletal_comment" => "Musculoskeletal Comment",
        "Question_No_50_Have_EPI_immunization_card?" => "EPI Immunization Card",
        "Reason_of_not_being_vaccinated" => "Reason of not being vaccinated",
        "BCG_1_dose" => "BCG 1 Dose",
        "OPV_4_dose" => "OPV 4 Dose",
        "rota" => "Rota",
        "measles" => "Mesles",
        "vaccination_comment" => "Vaccination Comment",
        "Question_51_Do_you_Frequently_put_things_in_his/her_mouth_such_as_toys,_jewelry,_or_keys?" => "Frequently put thing in mouth",
        "Question_52_Does_your_child_eat_non_food_items_(pica)?" => "Child eat non food items",
        "Question_53_Do_you_frequently_come_in_contact_with_an_adult_whose_job_involves_exposure_to_lead?" => "Frequently contact with adult Job Involves Exposure to lead",
        "Question_54_Do_you_frequently_come_in_contact_with_an_adult_whose_hobby_involves_exposure_to_lead?" => "Frequently contact with adult Hobby Involves Exposure to lead",
        "lead_exposure_comment" => "Lead Exposure Comment",
        "Question_No_55_Do_you_have_any_Allergies" => "Any Allergies",
        "Do_you_have_any_allergies_specify" => "Allergies Specify",
        "Question_No_56_Girls_above_8_years_old_ask:" => "Have 8 year old Girls",
        "Question_No_57_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination" => "Urinary Inquire",
        "QuestionNo_58_Any_menstrual_abnormality" => "Abnormality Menstrual",
        "Any_menstrual_abnormality_specify" => "Specify Abnormality Menstrual",
        "miscellaneous_comment" => "Miscellaneous Comment",
        "Question_No_59_How_often_do_you_experience_negative_or_intrusive_thoughts?" => "Experience Negative Thoughts",
        "Question_No_60_How_would_you_rate_your_overall_self_esteem_and_self_confidence?" => "Overall self esteem and confidence",
        "Question_No_61_How_would_you_describe_your_energy_levels_throughout_a_typical_day?" => "Energy levels throughout a typical day",
        "Question_No_62_When_faced_with_challenges,_what_are_your_typical_coping_mechanisms?" => "Typical Coping Mechanisms",
        "Question_No_63_How_would_you_rate_the_quality_of_your_sleep_on_average?" => "Quality of Your Sleep on average",
        "Question_No_64_How_often_have_you_felt_overwhelmed_or_stressed_in_the_last_few_weeks?" => "Overwhelmed or Stressed in the last few weeks",
        "Question_No_65_How_would_you_describe_your_overall_mood_during_the_day?" => "Overall mood during the day",
        "Question_No_66_How_would_you_describe_the_quality_of_your_relationships_with_family_members?" => "Quality of your relationship with family members",
        "Question_No_67_How_well_does_you_handle_challenges_and_solve_problems?" => "Challenges and Solve problems",
        "Question_No_68_How_many_hours_of_sleep_does_you_typically_get_on_a_school_night?" => "Sleeping hours typically",
        "psychological_comment" => "Psychological Comment",
        "duration" => "Duraiton",
        "enterby" => "Entered by",
        "created_at" => "created_at"
    ];

    
    /* collection */
    public function collection()
    {
        /* 
         * Get the raw data from the database 
         */
        $formData = FormData::get();

        /* 
         * Group the data by the 'entry_id' column 
         */
        $groupedData = $formData->groupBy('entry_id');

        /* 
         * Initialize an empty array to store the transformed data 
         */
        $transformedData = [];

        /* 
         * Iterate through the grouped data 
         */
        foreach ($groupedData as $entryId => $group) {
            /* 
             * Initialize a new row for each 'entry_id' 
             */
            $row = [$entryId];

            /* 
             * Fetch the form entry with related data 
             */
            $form_entry = form_entry::with([
                "school",
                "city",
                "area",
                "filled_by"
            ])->where('id', $entryId)
                ->select('*', 'created_at')
                ->first();

            /* 
             * Convert the form entry to an array if it exists 
             */
            if ($form_entry) {
                $form_entry = $form_entry->toArray();
            } else {
                $form_entry = [];
            }

            /* 
             * Create an array of field records keyed by 'key' 
             */
            $field_records = array_column($group->toArray(), null, 'key');

            /* 
             * Process each column based on the heading 
             */
            foreach (array_keys($this->heading) as $column) {
                if ($column == "id") {
                    continue;
                }

                /* 
                 * Populate the row with the appropriate data based on column type 
                 */
                switch ($column) {
                    case "enterby":
                        $row[] = isset($form_entry['filled_by']['fullname']) ? $form_entry['filled_by']['fullname'] : 'N/A';
                        break;
                    case "school":
                        $row[] = isset($form_entry['school']['school_name']) ? $form_entry['school']['school_name'] : 'N/A';
                        break;
                    case "city":
                        $row[] = isset($form_entry['city']['name']) ? $form_entry['city']['name'] : 'N/A';
                        break;
                    case "area":
                        $row[] = isset($form_entry['area']['name']) ? $form_entry['area']['name'] : 'N/A';
                        break;
                    case "created_at":
                        if (isset($form_entry['created_at'])) {
                            $created_at = Carbon::parse($form_entry['created_at'])->addHours(5);
                            $row[] = $created_at;
                        } else {
                            $row[] = '-';
                        }
                        break;
                    default:
                        $row[] = isset($field_records[$column]) ? $field_records[$column]['value'] : 'N/A';
                        break;
                }
            }

            /* 
             * Add the processed row to the transformed data array 
             */
            $transformedData[] = $row;
        }

        /* 
         * Convert the transformed data to a new collection 
         */
        return new Collection($transformedData);
    }


    /**
     * @return array
     */
    public function headings(): array
    {
        return array_values($this->heading);
    }
}
