@php

    use App\Models\User;
    use App\Models\form_entry;
    use App\Models\FormData;

@endphp
@extends('admin.main')
@section('content')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}
    <style>
        @media (min-width: 992px) {

            .mdk-drawer-layout .container,
            .mdk-drawer-layout .container-fluid,
            .mdk-drawer-layout .container-lg,
            .mdk-drawer-layout .container-md,
            .mdk-drawer-layout .container-sm,
            .mdk-drawer-layout .container-xl {
                max-width: 1440px;
            }
        }

        .custom_card_btn {
            width: 100%;
            text-align: center;
        }


        .custom_card_btn .btn {
            background: #ffffff;
            color: #000;
            width: 100%;
            border-radius: 20px;
            padding: 20px 20px;
            font-size: 24px;
            margin: 0;
            font-weight: 700;
            gap: 0px;
            transition: 0.3s ease;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(0, 0, 0, .15);
        }

        .custom_card_btn .btn:hover {
            background: #d86744 !important;
        }

        .custom_card_btn .btn b {
            font-size: 36px;
            margin-top: -10px;
            padding: 0;
            color: #000;
        }

        .custom_card_btn .btn svg {
            color: #d86744;
            width: 50px;
            height: 50px;
            margin-bottom: 10px;
        }

        .custom_card_btn .btn:hover svg {
            color: #fff;
        }

        .custom_card_btn .btn:hover b {
            color: #fff;
        }

        .graph {
            padding: 20px;
        }

        .h1 {
            text-align: center;
        }

        .chartDivRow {
            display: flex;
            align-items: center;
            justify-content: start;
            flex-wrap: wrap;
            gap: 10px;
        }

        .chartDivOuter {
            height: 350px;
            border-radius: 5px;
            border: 1px solid rgba(0, 0, 0, .15);
            width: calc(50% - 10px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .chartdiv {
            width: 100%;
            height: 100%;
        }

        #daterange {
            width: 200px;
            margin-left: auto;
            margin-bottom: 10px;
            margin-right: 10px;
        }

        .secHeading {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .secHeading span {
            width: 50px;
            height: 3px;
            background-color: #007bff;
            margin: 0 10px;
        }

        .secHeading h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        canvas {
            display: block;
            margin: 0 auto;
        }
    </style>


    <div class="pt-32pt">
        <div class="container page__container page-section">
            <div class="flex d-flex flex-column flex-sm-row align-items-center mb-24pt mb-md-0">
                <div class="mb-24pt mb-sm-0 mr-sm-24pt">
                    <h2 class="mb-0">Dashboard</h2>
                    <ol class="breadcrumb p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="chartSec">
        <div class="container-fluid w-100">

            <div class="row mt-5">
                <!-- First Chart Container -->
                <div class="col-md-6">
                    <div class="secHeading text-center">
                        <span></span>
                        <h2>Students</h2>
                        <span></span>
                    </div>
                    <canvas id="firstChart" style="max-height: 300px;"></canvas>
                </div>

                <!-- Referrals Chart Container -->
                <div class="col-md-6">
                    <div class="secHeading text-center">
                        <span></span>
                        <h2>Student Questions</h2>
                        <span></span>
                    </div>
                    <canvas id="referralsChart" style="max-height: 300px;"></canvas>
                </div>
            </div>

        </div>

    </section>


        @php

            /* Student Questions */

            $questions = [
                [
                    'key' => 'Question_No_8_Normal_Posture/Gait',
                    'label' => 'Question No.8: Normal Posture/Gait',
                    'value' => 'yes',
                ],
                [
                    'key' => 'Question_No_9_Mental_Status',
                    'label' => 'Question No.9: Mental Status',
                    'value' => 'Lethargic',
                ],
                [
                    'key' => 'Question_No_10_Look_For_jaundice',
                    'label' => 'Question No.10: Look For Jaundice',
                    'value' => 'yes',
                ],
            ];

            $questionLabels = [];
            $answers = [];

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

                        $ScreenedStudentsCount += form_entry::where('school', $value)
                            ->where('Follow_up_Date_flag', 1)
                            ->count();

                        $UnScreenedStudentsCount += form_entry::where('school', $value)
                            ->where('Follow_up_Date_flag', 0)
                            ->count();

                        /* Student Questions */

                        /*foreach ($questions as $key => $question) {
                        $query = FormData::join('form_entries', 'form_data.entry_id', '=', 'form_entries.id')
                            ->where('form_data.key', $question['key'])
                            ->where('form_entries.school', $value);

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
                    }*/
                    }
                }
            }

            /* Student Questions */

            $Question_No_8_Normal_Posture_Gait = FormData::join(
                'form_entries',
                'form_data.entry_id',
                '=',
                'form_entries.id',
            )->where('form_data.key', 'Question_No_8_Normal_Posture/Gait');
            $Question_No_8_Normal_Posture_Gait = $Question_No_8_Normal_Posture_Gait->where('value', 'No')->count();

            foreach ($questions as $key => $question) {
                $query = FormData::join('form_entries', 'form_data.entry_id', '=', 'form_entries.id')->where(
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
            }

        @endphp


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Configure the first chart
            const firstChart = document.getElementById('firstChart').getContext('2d');
            new Chart(firstChart, {
                type: 'doughnut',
                data: {
                    labels: ['Students', 'Screened Students', 'Unscreened Students'],
                    datasets: [{
                        label: 'Total',
                        data: [<?php echo $form_entry_count; ?>, <?php echo $ScreenedStudentsCount; ?>, <?php echo $UnScreenedStudentsCount; ?>, ],
                        // backgroundColor: ['#ffc107', '#17a2b8', '#28a745'], // Added colors for clarity
                        // borderColor: ['#e0a800', '#138496', '#1e7e34'], // Border colors for contrast
                        // borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Ensures responsive design
                    plugins: {
                        legend: {
                            display: true, // Display chart legend
                            position: 'top' // Adjust legend position
                        }
                    }
                }
            });



            // Referrals Chart
            const referralsChart = document.getElementById('referralsChart').getContext('2d');

            // Generate dynamic labels and data from PHP
            const questionLabels = @json($questionLabels);
            const answers = @json($answers);

            // Create the chart
            new Chart(referralsChart, {
                type: 'bar',
                data: {
                    labels: questionLabels, // Dynamic question labels
                    datasets: [{
                        label: 'Responses', // Dynamic label for the dataset
                        data: answers, // Dynamic data for the chart
                        backgroundColor: 'rgba(144, 238, 144, 0.7)', // Transparent light green
                        borderColor: 'green',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y', // Horizontal bar chart
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true, // Show legend
                            position: 'top'
                        },
                        tooltip: {
                            enabled: true,
                            callbacks: {
                                label: (tooltipItem) => `${tooltipItem.dataset.label}: ${tooltipItem.raw}`
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Responses',
                                color: '#666',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Questions',
                                color: '#666',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });



            // // Referrals Chart

            // const referralsChart = document.getElementById('referralsChart').getContext('2d');
            // new Chart(referralsChart, {
            //     type: 'bar',
            //     data: {

            //         // labels: [
            //         //     'Question No.8: Normal Posture/Gait', 
            //         //     'Question No.9: Mental Status', 

            //         //  ],

            //          

            //          datasets: [{
            //             label: 'Yes',
            //             // data: [{{ $Question_No_8_Normal_Posture_Gait }}],

            //             

            //             backgroundColor: 'lightgreen',
            //             borderColor: 'green',
            //             borderWidth: 1
            //         }, 

            //         // {
            //         //     label: 'Internal',
            //         //     data: [18, 18, 35],
            //         //     backgroundColor: 'lightblue',
            //         //     borderColor: 'blue',
            //         //     borderWidth: 1
            //         // }
            //     ]
            //     },
            //     options: {
            //         indexAxis: 'y',
            //         responsive: true,
            //         maintainAspectRatio: false,
            //         scales: {
            //             x: {
            //                 beginAtZero: true
            //             }
            //         }
            //     }
            // });
        </script>
    @endsection
