@php

    use App\Models\School;
    use App\Models\StudentBiodata;
    use App\Models\SchoolHealthPhysician;
    use App\Models\NutritionistHistoryEvaluationSection;
    use App\Models\PsychologistHistoryAssessmentSection;
    use App\Models\MedicalHistoryEmail;
    use App\Models\User;

@endphp
@extends('admin.main')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

        /*.canvasjs-chart-container {*/
        /*    width: 100%;*/
        /*    height: 400px;*/
        /*}*/
    </style>

    {{-- <script>
        // window.onload = function () {

        // var chart = new CanvasJS.Chart("chartContainer", {
        // 	animationEnabled: true,
        // 	theme: "light2", // "light1", "light2", "dark1", "dark2"
        // 	title:{
        // 		text: "No of Students Graph"
        // 	},
        // 	axisY: {
        // 		title: "Student Count"
        // 	},
        // 	data: [{
        // 		type: "column",
        // 		showInLegend: true,
        // 		legendMarkerColor: "grey",
        // 		legendText: "Nov-23 to Dec-24",
        // 		dataPoints: [
        // 			{ y: 100, label: "Nov'23"},
        // 			{ y: 100,  label: "Dec'23" },
        // 			{ y: 200,  label: "Jan'24" },
        // 			{ y: 300,  label: "Feb'24" },
        // 			{ y: 400,  label: "Mar'24" },
        // 			{ y: 500, label: "Apr'24" },
        // 			{ y: 600,  label: "May'24" },
        // 			{ y: 700,  label: "June'24" },
        // 			{ y: 800,  label: "July'24" },
        // 			{ y: 900,  label: "Aug'24" },
        // 			{ y: 1000,  label: "Sept'24" },
        // 			{ y: 150,  label: "Oct'24" },
        // 			{ y: 350,  label: "Nov'24" },
        // 			{ y: 450,  label: "Dec'24" }
        // 		]
        // 	}]
        // });
        // chart.render();

        // }
        document.addEventListener('DOMContentLoaded', function() {
            // Data
            var
        schools = []; //['School A', 'School B', 'School C', 'School D','School A', 'School B', 'School C', 'School D','School A', 'School B', 'School C', 'School D','School A', 'School B', 'School C', 'School D']; // Add more schools if needed
            var
        studentsCount = []; // [50, 100, 150, 172,195, 230, 300, 350,200, 250, 300, 350,200, 250, 300, 350]; // Add corresponding student counts

            @foreach ($data['schoolsCount'] as $school)
                schools.push('{{ $school->school_name }}');
                studentsCount.push('{{ $school->entry_count }}');
            @endforeach
            // Create a canvas
            var canvas = document.getElementById('myChart');
            var ctx = canvas.getContext('2d');

            // Create the chart
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: schools,
                    datasets: [{
                        label: 'Number of Students',
                        data: studentsCount,
                        backgroundColor: ['rgb(224, 93, 16)', 'green', 'yellow'],
                        borderColor: 'rgb(39, 25, 99)',
                        borderWidth: 3
                    }]
                },
                options: {
                    animation: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 50 // Adjust as needed
                            }
                        }
                    }
                }
            });
        });
    </script> --}}
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
    <div class="container page__container page-section d-none">

        <div class="row">
            <div class="col-md-3">
                <div class="custom_card_btn">
                    <a href="{{ route('admin.form_entry.index') }}" class="btn">
                        <i class="fas fa-school"></i>
                        Total Entries <b> 123 </b>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="custom_card_btn">
                    <a href="{{ route('admin.user.index') }}" class="btn">
                        <i class="fas fa-users"></i>
                        Users <b> 123 </b>
                    </a>
                </div>
            </div>
        </div>



    </div>
    <section class="chartSec">
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">

                    @if (Session::has('error_message'))
                    <div class="alert alert-secondary dark alert-dismissible fade show" role="alert">
                        <strong>Error ! </strong>
                        {{ Session::get('error_message') }}.


                    </div>
                @endif

                @if (Session::has('success_message'))
                    <div class="alert alert-success dark alert-dismissible fade show" role="alert">
                        <strong>Success ! </strong>
                        {{ Session::get('success_message') }}.


                    </div>
                @endif

                
                    <ul class="nav nav-tabs lisitingItems" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="School-tab" data-toggle="tab" href="#School" role="tab"
                                aria-controls="School" aria-selected="true">School</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="SchoolFollowUp-tab" data-toggle="tab" href="#SchoolFollowUp"
                                role="tab" aria-controls="SchoolFollowUp" aria-selected="false">School Follow Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="MedicalHistory-tab" data-toggle="tab" href="#MedicalHistory"
                                role="tab" aria-controls="MedicalHistory" aria-selected="false">Schools Medical History
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="MedicalHistoryDetails-tab" data-toggle="tab"
                                href="#MedicalHistoryDetails" role="tab" aria-controls="MedicalHistoryDetails"
                                aria-selected="false">Medical History Details </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="MedicalHistoryDetailsFollowUp-tab" data-toggle="tab"
                                href="#MedicalHistoryDetailsFollowUp" role="tab"
                                aria-controls="MedicalHistoryDetailsFollowUp" aria-selected="false">Medical History Follow
                                Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="MedicalHistoryDetailsUnFollow-tab" data-toggle="tab"
                                href="#MedicalHistoryDetailsUnFollow" role="tab"
                                aria-controls="MedicalHistoryDetailsUnFollow" aria-selected="false">Medical History
                                UnFollow</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="SchoolHealthPhysicianFollow-tab" data-toggle="tab"
                                href="#SchoolHealthPhysicianFollow" role="tab"
                                aria-controls="SchoolHealthPhysicianFollow" aria-selected="false">School Health Physician
                                Follow</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="PsychologistFollowUp-tab" data-toggle="tab" href="#PsychologistFollowUp"
                                role="tab" aria-controls="PsychologistFollowUp" aria-selected="false"> Psychologist
                                Follow
                                Up </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="NutritionistFollowUp-tab" data-toggle="tab" href="#NutritionistFollowUp"
                                role="tab" aria-controls="NutritionistFollowUp" aria-selected="false"> Nutritionist
                                Follow
                                Up </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="Refferals-tab" data-toggle="tab" href="#Refferals" role="tab"
                                aria-controls="Refferals" aria-selected="false"> Refferals </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="SchoolEmailsSent-tab" data-toggle="tab" href="#SchoolEmailsSent"
                                role="tab" aria-controls="SchoolEmailsSent" aria-selected="false"> School Emails Sent
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" id="SchoolLowHight-tab" data-toggle="tab" href="#SchoolLowHight"
                                role="tab" aria-controls="SchoolLowHight" aria-selected="false"> Medical History  Findings
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a class="nav-link" id="DoctorFollowUps-tab" data-toggle="tab" href="#DoctorFollowUps"
                                role="tab" aria-controls="DoctorFollowUps" aria-selected="false"> Doctor FollowUps
                            </a>
                        </li> --}}
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="School" role="tabpanel"
                            aria-labelledby="School-tab">
                            <div id="SchoolChartContainer"></div>
                        </div>
                        <div class="tab-pane fade" id="SchoolFollowUp" role="tabpanel"
                            aria-labelledby="SchoolFollowUp-tab">
                            <div id="SchoolFollowUpChartContainer"></div>
                        </div>
                        <div class="tab-pane fade" id="MedicalHistory" role="tabpanel"
                            aria-labelledby="MedicalHistory-tab">
                            <div id="MedicalHistoryChartContainer"></div>
                        </div>
                        <div class="tab-pane fade" id="MedicalHistoryDetails" role="tabpanel" aria-labelledby="MedicalHistoryDetails-tab">
                            <div id="MedicalHistoryDetailsChartContainer"></div>
                        </div>
                        <div class="tab-pane fade" id="MedicalHistoryDetailsFollowUp" role="tabpanel"
                            aria-labelledby="MedicalHistoryDetailsFollowUp-tab">
                            <div id="MedicalHistoryDetailsFollowUpChartContainer"></div>
                        </div>
                        <div class="tab-pane fade" id="MedicalHistoryDetailsUnFollow" role="tabpanel"
                            aria-labelledby="MedicalHistoryDetailsUnFollow-tab">
                            <div id="MedicalHistoryDetailsUnFollowChartContainer"></div>
                        </div>
                        <div class="tab-pane fade" id="SchoolHealthPhysicianFollow" role="tabpanel"
                            aria-labelledby="SchoolHealthPhysicianFollow-tab">
                            <div id="SchoolHealthPhysicianFollowChartContainer"></div>
                        </div>
                        <div class="tab-pane fade" id="PsychologistFollowUp" role="tabpanel"
                            aria-labelledby="PsychologistFollowUp-tab">
                            <div id="PsychologistFollowUpChartContainer"></div>
                        </div>
                        <div class="tab-pane fade" id="NutritionistFollowUp" role="tabpanel"
                            aria-labelledby="NutritionistFollowUp-tab">
                            <div id="NutritionistFollowUpChartContainer"></div>
                        </div>
                        <div class="tab-pane fade" id="Refferals" role="tabpanel" aria-labelledby="Refferals-tab">
                            <div id="Refferals-ChartContainer"></div>
                        </div>

                        <div class="tab-pane fade" id="SchoolEmailsSent" role="tabpanel"
                            aria-labelledby="SchoolEmailsSent-tab">
                            <div id="SchoolEmailsSent-ChartContainer"></div>
                        </div>

                        <div class="tab-pane fade" id="SchoolLowHight" role="tabpanel"
                            aria-labelledby="SchoolLowHight-tab">
                            <div id="SchoolLowHight-ChartContainer"></div>
                        </div>

                        {{-- <div class="tab-pane fade" id="DoctorFollowUps" role="tabpanel"
                            aria-labelledby="DoctorFollowUps-tab">
                            <div id="DoctorFollowUps-ChartContainer"></div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    
    /* Doctor Follow Ups */
    
    $grandFollowUp2 = 0;
    $User = User::where('role', 2)->get()->toArray();
    if (!empty($User)) {
        foreach ($User as $key => $value) {
            $StudentBiodata2 = StudentBiodata::where('deleted', 0)
                ->where(function ($query) use ($value) {
                    $query->where('created_by', $value['id'])->orWhere('updated_by', $value['id']);
                })
                ->get()
                ->toArray();
    
            if (!empty($StudentBiodata2)) {
                foreach ($StudentBiodata2 as $key => $StudentBiodat2) {
                    $SchoolHealthPhysician6 = SchoolHealthPhysician::where('deleted', 0)
                        ->where('Follow_up_Required', 'Yes')
                        ->where('StudentBiodataId', $StudentBiodat2['id'])
                        ->count();
                    $NutritionistHistoryEvaluationSection6 = NutritionistHistoryEvaluationSection::where('deleted', 0)
                        ->where('Follow_up_Required1', 'Yes')
                        ->where('StudentBiodataId', $StudentBiodat2['id'])
                        ->count();
                    $PsychologistHistoryAssessmentSection6 = PsychologistHistoryAssessmentSection::where('deleted', 0)
                        ->where('Follow_up_Required2', 'Yes')
                        ->where('StudentBiodataId', $StudentBiodat2['id'])
                        ->count();
    
                    $grandFollowUp2 += $SchoolHealthPhysician6 + $NutritionistHistoryEvaluationSection6 + $PsychologistHistoryAssessmentSection6;
                }
            }
    
            $dataPoints13[] = [
                'y' => $grandFollowUp2,
                'label' => $value['fullname'],
            ];
    
            $grandFollowUp2 = 0;
        }
    }
    
    /* Days Since School Creation*/
    
    $Schools = School::get()->toArray();
    
    // Prepare data points array
    $dataPoints = [];
    
    /* SchoolEmailsSent */
    $dataPoints10 = [];
    
    if (!empty($Schools)) {
        foreach ($Schools as $school) {
            // Calculate days since creation
            $createdDate = new DateTime($school['created_at']); // Assuming 'created_at' is the field storing creation date
            $today = new DateTime('now');
            $daysSinceCreation = $createdDate->diff($today)->days;
    
            // Push data point into array
            $dataPoints[] = [
                'y' => $daysSinceCreation,
                'label' => $school['school_name'], // Replace 'school_name' with your actual field name from the School model
                'id' => $school['id'], // Include the school ID
            ];
    
            $MedicalHistoryEmail = MedicalHistoryEmail::where('to', $school['email'])
                ->where('deleted', 0)
                ->count();
    
            // Push data point into array
            $dataPoints10[] = [
                'y' => $MedicalHistoryEmail,
                'label' => $school['school_name'], // Replace 'school_name' with your actual field name from the School model
            ];
        }
    }
    
    /* School Follow Up && MEDICAL HISTORY*/
    
    $dataPoints1 = [];
    $dataPoints2 = [];
    $grandFollowUp = 0;
    $grandFollowUp1 = 0;
    $SchoolHealthPhysicianGrand = 0;
    $PsychologistHistoryAssessmentSectionGrand = 0;
    
    $NutritionistHistoryEvaluationSectionGrand = 0;
    
    if (!empty($Schools)) {
        foreach ($Schools as $School) {
            $StudentBiodata = StudentBiodata::where('School_Name', $School['id'])
                ->where('deleted', 0)
                ->get()
                ->toArray();
    
            $CountLow = 0;
            $CountHigh = 0;
    
            if (!empty($StudentBiodata)) {
                foreach ($StudentBiodata as $key => $StudentBiodat) {
                    $SchoolHealthPhysician = SchoolHealthPhysician::where('deleted', 0)
                        ->where('Follow_up_Required', 'yes')
                        ->where('StudentBiodataId', $StudentBiodat['id'])
                        ->count();
                    $NutritionistHistoryEvaluationSection = NutritionistHistoryEvaluationSection::where('deleted', 0)
                        ->where('Follow_up_Required1', 'yes')
                        ->where('StudentBiodataId', $StudentBiodat['id'])
                        ->count();
                    $PsychologistHistoryAssessmentSection = PsychologistHistoryAssessmentSection::where('deleted', 0)
                        ->where('Follow_up_Required2', 'yes')
                        ->where('StudentBiodataId', $StudentBiodat['id'])
                        ->count();
    
                    $grandFollowUp += $SchoolHealthPhysician + $NutritionistHistoryEvaluationSection + $PsychologistHistoryAssessmentSection;
    
                    $SchoolHealthPhysician1 = SchoolHealthPhysician::where('deleted', 0)
                        ->where('StudentBiodataId', $StudentBiodat['id'])
                        ->count();
                    $NutritionistHistoryEvaluationSection1 = NutritionistHistoryEvaluationSection::where('deleted', 0)
                        ->where('StudentBiodataId', $StudentBiodat['id'])
                        ->count();
                    $PsychologistHistoryAssessmentSection1 = PsychologistHistoryAssessmentSection::where('deleted', 0)
                        ->where('StudentBiodataId', $StudentBiodat['id'])
                        ->count();
    
                    $grandFollowUp1 += $SchoolHealthPhysician1 + $NutritionistHistoryEvaluationSection1 + $PsychologistHistoryAssessmentSection1;
    
                    $SchoolHealthPhysicianGrand += $SchoolHealthPhysician;
                    $PsychologistHistoryAssessmentSectionGrand += $PsychologistHistoryAssessmentSection;
                    $NutritionistHistoryEvaluationSectionGrand += $NutritionistHistoryEvaluationSection;
    
                    /* SchoolLowHight*/
                    $SchoolHealthPhysician5 = SchoolHealthPhysician::where('deleted', 0)
                        ->where('StudentBiodataId', $StudentBiodat['id'])
                        ->first();
                    if (!empty($SchoolHealthPhysician5)) {
                        $CountLow = 0;
                        $CountHigh = 0;
    
                        $Blood_pressure_result = $SchoolHealthPhysician5['Blood_pressure_result'];
    
                        if ($Blood_pressure_result == 'Low') {
                            $CountLow += 1;
                        }
                        if ($Blood_pressure_result == 'High') {
                            $CountHigh += 1;
                        }
    
                        $BloodPressureDiastolicResult = $SchoolHealthPhysician5['BloodPressureDiastolicResult'];
    
                        if ($BloodPressureDiastolicResult == 'Low') {
                            $CountLow += 1;
                        }
                        if ($BloodPressureDiastolicResult == 'High') {
                            $CountHigh += 1;
                        }
    
                        $TemperatureResult = $SchoolHealthPhysician5['TemperatureResult'];
    
                        if ($TemperatureResult == 'Low') {
                            $CountLow += 1;
                        }
                        if ($TemperatureResult == 'High') {
                            $CountHigh += 1;
                        }
    
                        $PulseResult = $SchoolHealthPhysician5['PulseResult'];
    
                        if ($PulseResult == 'Low') {
                            $CountLow += 1;
                        }
                        if ($PulseResult == 'High') {
                            $CountHigh += 1;
                        }
    
                        $RespiratoryRateResult = $SchoolHealthPhysician5['RespiratoryRateResult'];
    
                        if ($RespiratoryRateResult == 'Low') {
                            $CountLow += 1;
                        }
                        if ($RespiratoryRateResult == 'High') {
                            $CountHigh += 1;
                        }
    
                        $WeightResult = $SchoolHealthPhysician5['WeightResult'];
    
                        if ($WeightResult == 'Low') {
                            $CountLow += 1;
                        }
                        if ($WeightResult == 'High') {
                            $CountHigh += 1;
                        }
    
                        $HeightResult = $SchoolHealthPhysician5['WeightResult'];
    
                        if ($HeightResult == 'Low') {
                            $CountLow += 1;
                        }
                        if ($HeightResult == 'High') {
                            $CountHigh += 1;
                        }
    
                        $BMIResult = $SchoolHealthPhysician5['BMIResult'];
    
                        if ($BMIResult == 'Low') {
                            $CountLow += 1;
                        }
                        if ($BMIResult == 'High') {
                            $CountHigh += 1;
                        }
                    }
    
                    $NutritionistHistoryEvaluationSection2 = NutritionistHistoryEvaluationSection::where('deleted', 0)
                        ->where('StudentBiodataId', $StudentBiodat['id'])
                        ->first();
    
                    if (!empty($NutritionistHistoryEvaluationSection2)) {
                        $HeightResult1 = $NutritionistHistoryEvaluationSection2['HeightResult1'];
    
                        if ($HeightResult1 == 'Low') {
                            $CountLow += 1;
                        }
                        if ($HeightResult1 == 'High') {
                            $CountHigh += 1;
                        }
    
                        $WeightResult1 = $NutritionistHistoryEvaluationSection2['WeightResult1'];
    
                        if ($WeightResult1 == 'Low') {
                            $CountLow += 1;
                        }
                        if ($WeightResult1 == 'High') {
                            $CountHigh += 1;
                        }
    
                        $BMIResult1 = $NutritionistHistoryEvaluationSection2['BMIResult1'];
    
                        if ($BMIResult1 == 'Low') {
                            $CountLow += 1;
                        }
                        if ($BMIResult1 == 'High') {
                            $CountHigh += 1;
                        }
                    }
                }
            }
    
            /* SchoolLowHight*/
            $dataPoints12[] = [
                'y' => $CountLow,
                'label' => $School['school_name'],
                // 'indexLabel' => "{$CountLow} Low, {$CountHigh} High", // Display both counts as index label
            ];
    
            /* $dataPoints12[] = [
                'y' => $CountLow, // Number of 'Low' occurrences
                'label' => $School['school_name'], // School name
                'indexLabel' => "{$CountLow} Low, {$CountHigh} High", // Display both counts as index label
            ]; */
    
            $dataPoints1[] = [
                'y' => $grandFollowUp,
                'label' => $School['school_name'],
                'id' => $School['id'], // Include the school ID
            ];
    
            $dataPoints2[] = [
                'y' => $grandFollowUp1,
                'label' => $School['school_name'],
                'id' => $School['id'], // Include the school ID
            ];
    
            /* School Health Physician Follow */
            $dataPoints6[] = [
                'y' => $SchoolHealthPhysicianGrand,
                'label' => $School['school_name'],
                'MedicalHistoryType' => 1,
                'id' => $School['id'], // Include the school ID
            ];
    
            /* Psychologist Follow Up */
    
            $dataPoints7[] = [
                'y' => $PsychologistHistoryAssessmentSectionGrand,
                'label' => $School['school_name'],
                'MedicalHistoryType' => 3,
                'id' => $School['id'], // Include the school ID
            ];
    
            /* Nutritionist Follow Up */
    
            $dataPoints8[] = [
                'y' => $NutritionistHistoryEvaluationSectionGrand,
                'label' => $School['school_name'],
                'MedicalHistoryType' => 2,
                'id' => $School['id'], // Include the school ID
            ];
    
            $grandFollowUp = 0;
            $grandFollowUp1 = 0;
            $SchoolHealthPhysicianGrand = 0;
            $PsychologistHistoryAssessmentSectionGrand = 0;
        }
    }
    
    /* Medical History Details */
    $SchoolHealthPhysician2 = SchoolHealthPhysician::where('deleted', 0)->count();
    
    $dataPoints3[] = [
        'y' => $SchoolHealthPhysician2,
        'label' => 'School Health Physician',
        'MedicalHistoryType' => 1,
    ];
    
    $NutritionistHistoryEvaluationSection2 = NutritionistHistoryEvaluationSection::where('deleted', 0)->count();
    
    $dataPoints3[] = [
        'y' => $NutritionistHistoryEvaluationSection2,
        'label' => 'Nutritionist History Evaluation Section',
        'MedicalHistoryType' => 2,
    ];
    
    $PsychologistHistoryAssessmentSection2 = PsychologistHistoryAssessmentSection::where('deleted', 0)->count();
    
    $dataPoints3[] = [
        'y' => $PsychologistHistoryAssessmentSection2,
        'label' => 'Psychologist History Assessment Section',
        'MedicalHistoryType' => 3,
    ];
    
    /* Medical History Details Follow Up */
    
    $SchoolHealthPhysician3 = SchoolHealthPhysician::where('deleted', 0)->where('Follow_up_Required', 'yes')->count();
    $dataPoints4[] = [
        'y' => $SchoolHealthPhysician3,
        'label' => 'School Health Physician',
        'MedicalHistoryType' => 1,
    ];
    
    $NutritionistHistoryEvaluationSection3 = NutritionistHistoryEvaluationSection::where('deleted', 0)->where('Follow_up_Required1', 'yes')->count();
    $dataPoints4[] = [
        'y' => $NutritionistHistoryEvaluationSection2,
        'label' => 'Nutritionist History Evaluation Section',
        'MedicalHistoryType' => 2,
    ];
    
    $PsychologistHistoryAssessmentSection3 = PsychologistHistoryAssessmentSection::where('deleted', 0)->where('Follow_up_Required2', 'yes')->count();
    $dataPoints4[] = [
        'y' => $PsychologistHistoryAssessmentSection3,
        'label' => 'Psychologist History Assessment Section',
        'MedicalHistoryType' => 3,
    ];
    
    /* Medical History Details Un Follow  */
    
    $SchoolHealthPhysician4 = SchoolHealthPhysician::where('deleted', 0)->where('Follow_up_Required', 'no')->count();
    $dataPoints5[] = [
        'y' => $SchoolHealthPhysician4,
        'label' => 'School Health Physician',
        'MedicalHistoryType' => 1,
    ];
    
    $NutritionistHistoryEvaluationSection4 = NutritionistHistoryEvaluationSection::where('deleted', 0)->where('Follow_up_Required1', 'no')->count();
    $dataPoints5[] = [
        'y' => $NutritionistHistoryEvaluationSection4,
        'label' => 'Nutritionist History Evaluation Section',
        'MedicalHistoryType' => 2,
    ];
    
    $PsychologistHistoryAssessmentSection4 = PsychologistHistoryAssessmentSection::where('deleted', 0)->where('Follow_up_Required2', 'no')->count();
    $dataPoints5[] = [
        'y' => $PsychologistHistoryAssessmentSection4,
        'label' => 'Psychologist History Assessment Section',
        'MedicalHistoryType' => 3,
    ];
    
    /* Refferals */
    
    $StudentBiodata1 = StudentBiodata::where('deleted', 0)->count();
    
    $dataPoints9[] = [
        'y' => $StudentBiodata1,
        'label' => 'Internal Referrals ',
    ];
    $dataPoints9[] = [
        'y' => $StudentBiodata1,
        'label' => 'External Referrals  ',
    ];
    
    ?>

    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
    <script>
        window.onload = function() {

            /* Days Since School Creation*/
            var chart = new CanvasJS.Chart("SchoolChartContainer", {
                animationEnabled: true,
                width: $("#myTabContent").innerWidth(),
                height: window.innerHeight / 2,
                title: {
                    text: "Days Since School Creation"
                },
                axisY: {
                    title: "Days",
                    includeZero: true,
                    labelFormatter: function(e) {
                        return ""; /* This hides the numeric labels on the y-axis */
                    },
                },

                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    cursor: "pointer",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>,
                    click: function(e) {
                        var schoolId = e.dataPoint.id;
                        var baseUrl = "<?php echo route('admin.form_entry.index'); ?>";
                        var url = baseUrl + '/?schoolId=' + encodeURIComponent(
                            schoolId);
                        window.location.href = url;
                    }


                }]
            });

            /* School Follow Up */
            var chart1 = new CanvasJS.Chart("SchoolFollowUpChartContainer", {
                animationEnabled: true,
                width: $("#myTabContent").innerWidth(),
                height: window.innerHeight / 2,
                title: {
                    text: "School Follow Up "
                },
                axisY: {
                    title: "School Follow Up",
                    includeZero: true,
                    labelFormatter: function(e) {
                        return ""; /* This hides the numeric labels on the y-axis */
                    },
                },
                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    cursor: "pointer",
                    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>,
                    click: function(e) {
                        var schoolId = e.dataPoint.id;
                        var baseUrl = "<?php echo route('follow-up-list'); ?>";
                        var url = baseUrl + '/?schoolId=' + encodeURIComponent(
                            schoolId);
                        window.location.href = url;
                    }
                }]
            });

            /* MEDICAL HISTORY */
            var chart2 = new CanvasJS.Chart("MedicalHistoryChartContainer", {
                animationEnabled: true,
                width: $("#myTabContent").innerWidth(),
                height: window.innerHeight / 2,
                title: {
                    text: "Schools Medical History "
                },
                axisY: {
                    title: "Schools Medical History ",
                    includeZero: true,
                    labelFormatter: function(e) {
                        return ""; /* This hides the numeric labels on the y-axis */
                    },
                },
                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    cursor: "pointer",
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>,
                    click: function(e) {
                        var schoolId = e.dataPoint.id;
                        var baseUrl = "<?php echo route('IndexMedicalHistory'); ?>";
                        var url = baseUrl + '/?schoolId=' + encodeURIComponent(
                            schoolId);
                        window.location.href = url;
                    }

                }]
            });

            /* Medical History Details */
            var chart3 = new CanvasJS.Chart("MedicalHistoryDetailsChartContainer", {
                animationEnabled: true,
                width: $("#myTabContent").innerWidth(),
                height: window.innerHeight / 2,
                title: {
                    text: "Medical History Details"
                },
                axisY: {
                    text: "Medical History Details",
                    includeZero: true,
                    labelFormatter: function(e) {
                        return ""; /* This hides the numeric labels on the y-axis */
                    },
                },
                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    cursor: "pointer",
                    dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>,
                    click: function(e) {
                        var MedicalHistoryType = e.dataPoint.MedicalHistoryType;
                        var baseUrl = "<?php echo route('IndexMedicalHistory'); ?>";
                        var url = baseUrl + '/?MedicalHistoryType=' + encodeURIComponent(
                            MedicalHistoryType);
                        window.location.href = url;
                    }
                }]
            });

            /* Medical History Details FollowUp */
            var chart4 = new CanvasJS.Chart("MedicalHistoryDetailsFollowUpChartContainer", {
                animationEnabled: true,
                width: $("#myTabContent").innerWidth(),
                height: window.innerHeight / 2,
                title: {
                    text: "Medical History Details Follow Up"
                },
                axisY: {
                    text: "Medical History Details Follow Up",
                    includeZero: true,
                    labelFormatter: function(e) {
                        return ""; /* This hides the numeric labels on the y-axis */
                    },
                },
                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    cursor: "pointer",
                    dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>,
                    click: function(e) {
                        var MedicalHistoryType = e.dataPoint.MedicalHistoryType;
                        var baseUrl = "<?php echo route('IndexMedicalHistory'); ?>";
                        var url = baseUrl + '/?MedicalHistoryType=' + encodeURIComponent(
                            MedicalHistoryType);
                        window.location.href = url;
                    }
                }]
            });
            /* Medical History Details Un Follow  */

            var chart5 = new CanvasJS.Chart("MedicalHistoryDetailsUnFollowChartContainer", {
                animationEnabled: true,
                width: $("#myTabContent").innerWidth(),
                height: window.innerHeight / 2,
                title: {
                    text: "Medical History Details Follow Up"
                },
                axisY: {
                    text: "Medical History Details Follow Up",
                    includeZero: true,
                    labelFormatter: function(e) {
                        return ""; /* This hides the numeric labels on the y-axis */
                    },
                },
                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    dataPoints: <?php echo json_encode($dataPoints5, JSON_NUMERIC_CHECK); ?>,
                    cursor: "pointer",
                    click: function(e) {
                        var MedicalHistoryType = e.dataPoint.MedicalHistoryType;
                        var baseUrl = "<?php echo route('IndexMedicalHistory'); ?>";
                        var url = baseUrl + '/?MedicalHistoryType=' + encodeURIComponent(
                            MedicalHistoryType);
                        window.location.href = url;
                    }

                }]
            });

            /* School Health Physician Follow */

            var chart6 = new CanvasJS.Chart("SchoolHealthPhysicianFollowChartContainer", {
                animationEnabled: true,
                width: $("#myTabContent").innerWidth(),
                height: window.innerHeight / 2,
                title: {
                    text: "School Health Physician Follow Up"
                },
                axisY: {
                    text: "School Health Physician Follow Up",
                    includeZero: true,
                    labelFormatter: function(e) {
                        return ""; /* This hides the numeric labels on the y-axis */
                    },
                },
                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    cursor: "pointer",
                    dataPoints: <?php echo json_encode($dataPoints6, JSON_NUMERIC_CHECK); ?>,
                    click: function(e) {
                        var MedicalHistoryType = e.dataPoint.MedicalHistoryType;
                        var schoolId = e.dataPoint.id;
                        var baseUrl = "<?php echo route('IndexMedicalHistory'); ?>";
                        var url = baseUrl + '/?MedicalHistoryType=' + encodeURIComponent(
                            MedicalHistoryType) + '&schoolId=' + encodeURIComponent(
                            schoolId);
                        window.location.href = url;
                    }
                }]
            });
            /* Psychologist Follow Up */

            var chart7 = new CanvasJS.Chart("PsychologistFollowUpChartContainer", {
                animationEnabled: true,
                width: $("#myTabContent").innerWidth(),
                height: window.innerHeight / 2,
                title: {
                    text: "Psychologist Follow Up"
                },
                axisY: {
                    text: "Psychologist Follow Up",
                    includeZero: true,
                    labelFormatter: function(e) {
                        return ""; /* This hides the numeric labels on the y-axis */
                    },
                },
                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    cursor: "pointer",
                    dataPoints: <?php echo json_encode($dataPoints7, JSON_NUMERIC_CHECK); ?>,
                    click: function(e) {
                        var MedicalHistoryType = e.dataPoint.MedicalHistoryType;
                        var schoolId = e.dataPoint.id;
                        var baseUrl = "<?php echo route('IndexMedicalHistory'); ?>";
                        var url = baseUrl + '/?MedicalHistoryType=' + encodeURIComponent(
                            MedicalHistoryType) + '&schoolId=' + encodeURIComponent(
                            schoolId);
                        window.location.href = url;
                    }
                }]
            });
            /* Nutritionist Follow Up */

            var chart8 = new CanvasJS.Chart("NutritionistFollowUpChartContainer", {
                animationEnabled: true,
                width: $("#myTabContent").innerWidth(),
                height: window.innerHeight / 2,
                title: {
                    text: "Nutritionist Follow Up"
                },
                axisY: {
                    text: "Nutritionist Follow Up",
                    includeZero: true,
                    labelFormatter: function(e) {
                        return ""; /* This hides the numeric labels on the y-axis */
                    },
                },
                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    cursor: "pointer",
                    dataPoints: <?php echo json_encode($dataPoints8, JSON_NUMERIC_CHECK); ?>,
                    click: function(e) {
                        var MedicalHistoryType = e.dataPoint.MedicalHistoryType;
                        var schoolId = e.dataPoint.id;
                        var baseUrl = "<?php echo route('IndexMedicalHistory'); ?>";
                        var url = baseUrl + '/?MedicalHistoryType=' + encodeURIComponent(
                            MedicalHistoryType) + '&schoolId=' + encodeURIComponent(
                            schoolId);
                        window.location.href = url;
                    }

                }]
            });

            /* Refferals */

            var chart9 = new CanvasJS.Chart("Refferals-ChartContainer", {
                animationEnabled: true,
                width: $("#myTabContent").innerWidth(),
                height: window.innerHeight / 2,
                title: {
                    text: "Refferals"
                },
                axisY: {
                    text: "Refferals",
                    includeZero: true,
                    labelFormatter: function(e) {
                        return ""; /* This hides the numeric labels on the y-axis */
                    },
                },
                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    cursor: "pointer",
                    dataPoints: <?php echo json_encode($dataPoints9, JSON_NUMERIC_CHECK); ?>,
                    click: function(e) {
                        var baseUrl = "<?php echo route('IndexMedicalHistory'); ?>";
                        var url = baseUrl;
                        window.location.href = url;
                    }
                }]
            });

            /* SchoolEmailsSent */

            var chart10 = new CanvasJS.Chart("SchoolEmailsSent-ChartContainer", {
                animationEnabled: true,
                width: $("#myTabContent").innerWidth(),
                height: window.innerHeight / 2,
                title: {
                    text: "School Emails Sent"
                },
                axisY: {
                    text: "School Emails Sent",
                    includeZero: true,
                    labelFormatter: function(e) {
                        return ""; /* This hides the numeric labels on the y-axis */
                    },
                },
                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    cursor: "pointer",
                    dataPoints: <?php echo json_encode($dataPoints10, JSON_NUMERIC_CHECK); ?>,
                    click: function(e) {
                        var baseUrl = "<?php echo route('IndexMedicalHistory'); ?>";
                        var url = baseUrl;
                        window.location.href = url;
                    }
                }]
            });



            /* SchoolLowHight*/

            var chart11 = new CanvasJS.Chart("SchoolLowHight-ChartContainer", {
                animationEnabled: true,
                width: $("#myTabContent").innerWidth(),
                height: window.innerHeight / 2,
                title: {
                    text: "Medical History Findings "
                },
                axisY: {
                    text: "Medical History  Findings ",
                    includeZero: true,
                    labelFormatter: function(e) {
                        return ""; /* This hides the numeric labels on the y-axis */
                    },
                },
                data: [{
                    type: "bar",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    cursor: "pointer",
                    dataPoints: <?php echo json_encode($dataPoints12, JSON_NUMERIC_CHECK); ?>,
                    click: function(e) {
                        var baseUrl = "<?php echo route('admin.form_entry.index'); ?>";
                        var url = baseUrl;
                        window.location.href = url;
                    }

                }]
            });


            /*  Doctor Follow Ups  */

            /* var chart12 = new CanvasJS.Chart("DoctorFollowUps-ChartContainer", {
                 animationEnabled: true,
                 width: $("#myTabContent").innerWidth(),
                 height: window.innerHeight / 2,
                 title: {
                     text: "Doctor Follow Ups "
                 },
                 axisY: {
                     text: "Doctor Follow Ups ",
                     includeZero: true
                 },
                 data: [{
                     type: "bar",
                     indexLabel: "{y}",
                     indexLabelPlacement: "inside",
                     indexLabelFontWeight: "bolder",
                     indexLabelFontColor: "white",
                     dataPoints: <?php echo json_encode($dataPoints13, JSON_NUMERIC_CHECK); ?>
                 }]
             });
             chart12.render(); */


            chart.render();
            chart1.render();
            chart2.render();
            chart3.render();
            chart4.render();
            chart5.render();
            chart6.render();
            chart7.render();
            chart8.render();
            chart9.render();
            chart10.render();
            chart11.render();
        }
    </script>
@endsection
