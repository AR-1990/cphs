@php
    use App\Models\School;
    use App\Models\StudentBiodata;
    use App\Models\SchoolHealthPhysician;
    use App\Models\NutritionistHistoryEvaluationSection;
    use App\Models\PsychologistHistoryAssessmentSection;
    use App\Models\MedicalHistoryEmail;
    use App\Models\User;
    use Carbon\Carbon;
    use App\Models\form_entry;
    use App\Models\FormData;

@endphp


@extends('admin.main')
@section('content')
    <style>
        .chartSec {
            padding: 2rem 0;
        }

        .chartSec .container-fluid {
            max-width: 100%;
        }

        .secHeading {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .secHeading span {
            width: 100%;
            height: 2px;
            background: #d86744;
        }

        .secHeading h2 {
            white-space: nowrap;
            font-size: 2rem;
            text-transform: capitalize;
        }

        .chartSec canvas.fit {
            height: 400px !important;
            width: 400px !important;
            margin: auto;
        }

        .chartSec .row {
            gap: 2rem 0;
        }
    </style>

    <section class="chartSec">
        <div class="container-fluid w-100">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-0">Dashboard</h2>
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.schoolDashboard2') }}">Home</a></li>
                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>
                    </ol>
                </div>
                <div class="col-md-7">
                    <div class="secHeading">
                        <span></span>
                        <h2>Reportable Findings </h2>
                        <span></span>
                    </div>
                    <canvas id="followupChart"></canvas>
                </div>
                <div class="col-md-5">
                    <div class="secHeading">
                        <span></span>
                        <h2>Student</h2>
                        <span></span>
                    </div>
                    <canvas class="fit" id="daysSinceSchoolChart"></canvas>
                </div>




            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @php

        /* School Role  = 3 */

        $form_entry_count = 0;
        $ScreenedStudentsCount = 0;
        $UnScreenedStudentsCount = 0;
        $UsersRoles = User::where('role', 3)
            ->where('id', auth()->guard('admin')->user()->id)
            ->first();
        if (!empty($UsersRoles)) {

            $UsersRoleSchoolID = $UsersRoles['school_id'];

            $schoolIDsArray = json_decode($UsersRoleSchoolID, true);

            if (!empty($schoolIDsArray)) {
                foreach ($schoolIDsArray as $key => $value) {
                   
                    $form_entry_count += form_entry::where('school', $value)->count();

                    $ScreenedStudentsCount +=  form_entry::join('form_data', 'form_entries.id', '=', 'form_data.entry_id')
                            ->where('form_entries.school', $value)
                            ->where('form_data.key', 'Follow_up_Required')
                            ->whereIn('form_data.value', ['Yes', 'yes'])
                            ->count();

                   
                }
                $UnScreenedStudentsCount = $form_entry_count - $ScreenedStudentsCount;
            }
        }

        /* Student Questions */

       
        
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

            ['key' => 'Question_No_43_Did_you_observe_any_distension,_scars,_or_masses_on_the_childs_abdomen?', 'label' => '  Distension/Scars/Masses on Abdomen', 'value' => ['distension', 'scar', 'mass']],

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
            
            /* ['key' => 'Question_No_58_Note_any_discomfort_or_pain_in_the_abdominal_area?', 'label' => '   Discomfort or Pain in the Abdominal Area', 'value' => 'yes'],
            ['key' => 'Question_No_59_Looking_for_clinical_signs_of_dehydration?', 'label' => '  Clinical Signs of Dehydration', 'value' => 'yes'],
            ['key' => 'Question_No_60_Swelling_in_the_extremities?', 'label' => '  Swelling in the Extremities', 'value' => 'yes'], */

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

             /* ['key' => 'bmi61', 'label' => 'BMI', 'value' => null],
            ['key' => 'muac', 'label' => 'MUAC', 'value' => null],
            ['key' => 'Daily_Protien_requirement', 'label' => 'Daily Protein Requirement', 'value' => null],
            ['key' => 'Daily_energy_requirement', 'label' => 'Daily Energy Requirement', 'value' => null],
            ['key' => 'meals', 'label' => 'Meals', 'value' => null],
            ['key' => 'food_items', 'label' => 'Food Items', 'value' => null], */
        ];
        $schoolid= json_decode(auth()->guard('admin')->user()?->school_id);
        $questionLabels = [];
        $answers = [];

        $questionLabelsAnswers = [];

        foreach ($questions as $key => $question) {

            $query = FormData::join('form_entries', 'form_data.entry_id', '=', 'form_entries.id')->whereIn('form_entries.school', $schoolid)->where(
                'form_data.key',
                $question['key'],
            );

            if (is_array($question['value'])) {
                $count = $query->whereIn('value', $question['value'])->count();
            } elseif ($question['value'] !== null) {
                $count = $query->where('value', $question['value'])->count();
            } elseif ($question['value'] == null) {
                $count = $query->where('value', $question['value'])->count();
            } else {
                $count = $query->count();
            }

            $questionLabels[] = $question['label'];

            $answers[] = $count;

            $questionLabelsAnswers[] = [$question['label'],$count];


        }

        // dd($questionLabelsAnswers);

    @endphp

    <script>
        window.addEventListener("load", function() {

            /********** Student Questions ****************/

            // Function to generate random RGB colors
            function generateRandomColors(count) {
                const colors = [];
                for (let i = 0; i < count; i++) {
                    const r = Math.floor(Math.random() * 256);
                    const g = Math.floor(Math.random() * 256);
                    const b = Math.floor(Math.random() * 256);
                    colors.push(`rgba(${r}, ${g}, ${b}, 0.7)`); // Semi-transparent colors
                }
                return colors;
            }

            // Get dynamic labels and answers from PHP
            const questionLabels = @json($questionLabels);
            const answers = @json($answers);

            // Generate random colors for each bar
            const randomColors = generateRandomColors(answers.length);



            const followUpChartCtx = document.getElementById('followupChart').getContext('2d');
            new Chart(followUpChartCtx, {
                type: 'bar',
                data: {
                    // labels: ["The set School","The Future School ","Kiran Foundation School"],
                    labels: questionLabels, // Dynamic question labels

                    datasets: [{
                            label: "Total Students",
                            // backgroundColor: "lightblue",
                            backgroundColor: randomColors,
                            borderColor: randomColors,
                            // borderColor: "blue",
                            borderWidth: 1,
                            // data: [10],
                            data: answers,

                        },

                        // {
                        //     label: "Follow-ups",
                        //     backgroundColor: "lightgreen",
                        //     borderColor: "green",
                        //     borderWidth: 1,
                        //     data: [10],

                        // },

                        // {
                        //     label: "Not Required",
                        //     backgroundColor: "lightyellow",
                        //     borderColor: "yellow",
                        //     borderWidth: 1,
                        //     data: [2],
                        // },
                        // {
                        //     label: "Pending",
                        //     backgroundColor: "pink",
                        //     borderColor: "red",
                        //     borderWidth: 1,
                        //     data: [3],
                        // },
                    ]
                },

                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }

                    },




                }


            });

            /********** Student ****************/


            const DaysSinceSchoolChart = document.getElementById('daysSinceSchoolChart');
            let pieDelay;
            new Chart(DaysSinceSchoolChart, {
                type: 'pie',
                data: {

                    /*labels: [
                        'Kiran Foundation School',
                        'Save The Future School',
                        'The SET School'
                    ],*/

                    labels: ['Total Students', 'Scheduled', 'UnScheduled'],


                    datasets: [{
                        label: "Total Students",
                        backgroundColor: ["lightblue", "lightgreen", "pink"],
                        borderColor: ["blue", "green", "red"],
                        borderWidth: 1,
                        // data: [197, 224, 224]
                        data: [<?php echo $form_entry_count; ?>, <?php echo $ScreenedStudentsCount; ?>, <?php echo $UnScreenedStudentsCount; ?>, ]

                    }]
                },
                options: {

                    plugins: {

                        legend: {
                            display: true, // Display the legend to identify schools
                            position: 'top' // Adjust legend position

                        }
                    },

                    responsive: true,
                    maintainAspectRatio: false, // Ensures responsive design

                    animation: {
                        onComplete: () => {
                            pieDelay = true;
                        },
                        delay: (context) => {
                            let delay = 0;
                            if (context.type === 'data' && context.mode === 'default' && !pieDelay) {
                                delay = context.dataIndex * 500 + context.datasetIndex * 100;
                            }
                            return delay;
                        },
                    },


                }
            });






        })
    </script>
@endsection

<!-- Internal Modal -->
<div class="modal fade" id="internalModal" tabindex="-1" aria-labelledby="internalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="internalModalLabel">Internal Data</h5>
            </div>
            <div class="modal-body">
                <p id="modalContentInternal">This is the content of the internal modal.</p>
                <canvas id="internalModalChart"></canvas>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- External Modal -->
<div class="modal fade" id="externalModal" tabindex="-1" aria-labelledby="externalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="externalModalLabel">External Data</h5>
            </div>
            <div class="modal-body">
                <p id="modalContentExternal">This is the content of the external modal.</p>
                <canvas id="externalModalChart"></canvas>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- External Modal -->
<div class="modal fade" id="followUpModal" tabindex="-1" aria-labelledby="externalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="externalModalLabel">Reportable findings</h5>
            </div>
            <div class="modal-body">
                <p id="modalContent"></p>
                <canvas id="followUpModalChart"></canvas>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
