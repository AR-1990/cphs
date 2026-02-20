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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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
    <section class="chartSec  mb-5">
        <div class="container-fluid">
            <div class="chartDivRow">

                <div class="chartDivOuter">
                    <div id="chartdiv1" class="chartdiv"></div>
                </div>


                <div class="chartDivOuter">
                    <div id="chartdiv2" class="chartdiv"></div>
                    <input type="text" id="daterange" class="form-control" />
                </div>

                <div class="chartDivOuter">
                    <div id="chartdiv3" class="chartdiv"></div>
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

    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <!-- chart 1 -->
    <script>
        am5.ready(function() {

            // Create root element
            // https://www.amcharts.com/docs/v5/getting-started/#Root_element
            var root = am5.Root.new("chartdiv1");

            // Set themes
            // https://www.amcharts.com/docs/v5/concepts/themes/
            root.setThemes([
                am5themes_Animated.new(root)
            ]);

            // Create chart
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
            // start and end angle must be set both for chart and series
            var chart = root.container.children.push(am5percent.PieChart.new(root, {
                layout: root.verticalLayout,
                innerRadius: am5.percent(40)
            }));

            // Create series
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
            // start and end angle must be set both for chart and series
            var series0 = chart.series.push(am5percent.PieSeries.new(root, {
                valueField: "bottles",
                categoryField: "country",
                alignLabels: false
            }));

            var bgColor = root.interfaceColors.get("background");

            series0.ticks.template.setAll({
                forceHidden: true
            });
            series0.labels.template.setAll({
                forceHidden: true
            });
            series0.slices.template.setAll({
                stroke: bgColor,
                strokeWidth: 2,
                tooltipText: "{category}: {valuePercentTotal.formatNumber('0.00')}% ({value} bottles)"
            });
            series0.slices.template.states.create("hover", {
                scale: 0.95
            });

            var series1 = chart.series.push(am5percent.PieSeries.new(root, {
                valueField: "litres",
                categoryField: "country",
                alignLabels: true
            }));

            series1.slices.template.setAll({
                stroke: bgColor,
                strokeWidth: 2,
                tooltipText: "{category}: {valuePercentTotal.formatNumber('0.00')}% ({value} litres)"
            });

            var data = [{
                country: "Reportable",
                litres: 700,
                bottles: 1500
            }, {
                country: "Screened",
                litres: 301.9,
                bottles: 990
            }, {
                country: "Medical complain",
                litres: 201.1,
                bottles: 785
            }, {
                country: "First aid given",
                litres: 165.8,
                bottles: 255
            }];

            // Set data
            // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
            series0.data.setAll(data);
            series1.data.setAll(data);

            // Play initial series animation
            // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
            series0.appear(1000, 100);
            series1.appear(1000, 100);

        }); // end am5.ready()
    </script>

    <!-- chart 2 -->
    <script>
        $(function() {
            $('#daterange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD'
                },
                startDate: '2002-01-01',
                endDate: '2018-12-31',
                minDate: '2002-01-01',
                maxDate: '2018-12-31'
            }, function(start, end) {
                fetchFilteredData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            });

            am5.ready(function() {
                var allData = [{
                        date: '2002-01-01',
                        network: 'Number of Reportables',
                        value: 0
                    },
                    {
                        date: '2002-01-01',
                        network: 'Number of Screened',
                        value: 0
                    },
                    {
                        date: '2003-01-01',
                        network: 'Number of Reportables',
                        value: 4470000
                    },
                    {
                        date: '2003-01-01',
                        network: 'Number of Screened',
                        value: 0
                    },
                    {
                        date: '2004-01-01',
                        network: 'Number of Reportables',
                        value: 980036
                    },
                    {
                        date: '2004-01-01',
                        network: 'Number of Screened',
                        value: 4900180
                    },
                    // Add more data here for each year, month, day as needed
                ];

                var root = am5.Root.new("chartdiv2");

                root.numberFormatter.setAll({
                    numberFormat: "#a",
                    bigNumberPrefixes: [{
                        number: 1e6,
                        suffix: "M"
                    }, {
                        number: 1e9,
                        suffix: "B"
                    }],
                    smallNumberPrefixes: []
                });

                root.setThemes([am5themes_Animated.new(root)]);

                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                    panX: true,
                    panY: true,
                    wheelX: "none",
                    wheelY: "none",
                    paddingLeft: 0
                }));

                chart.zoomOutButton.set("forceHidden", true);

                var yRenderer = am5xy.AxisRendererY.new(root, {
                    minGridDistance: 20,
                    inversed: true,
                    minorGridEnabled: true
                });
                yRenderer.grid.template.set("visible", false);

                var yAxis = chart.yAxes.push(am5xy.CategoryAxis.new(root, {
                    maxDeviation: 0,
                    categoryField: "network",
                    renderer: yRenderer
                }));

                var xAxis = chart.xAxes.push(am5xy.ValueAxis.new(root, {
                    maxDeviation: 0,
                    min: 0,
                    strictMinMax: true,
                    extraMax: 0.1,
                    renderer: am5xy.AxisRendererX.new(root, {})
                }));

                xAxis.set("interpolationDuration", 200);
                xAxis.set("interpolationEasing", am5.ease.linear);

                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueXField: "value",
                    categoryYField: "network"
                }));

                series.columns.template.setAll({
                    cornerRadiusBR: 5,
                    cornerRadiusTR: 5
                });

                series.columns.template.adapters.add("fill", function(fill, target) {
                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                });

                series.columns.template.adapters.add("stroke", function(stroke, target) {
                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                });

                series.bullets.push(function() {
                    return am5.Bullet.new(root, {
                        locationX: 1,
                        sprite: am5.Label.new(root, {
                            text: "{valueXWorking.formatNumber('#.# a')}",
                            fill: root.interfaceColors.get("alternativeText"),
                            centerX: am5.p100,
                            centerY: am5.p50,
                            populateText: true
                        })
                    });
                });

                var label = chart.plotContainer.children.push(am5.Label.new(root, {
                    text: "2002-01-01",
                    fontSize: "2em",
                    opacity: 1,
                    x: am5.p100,
                    y: am5.p100,
                    centerY: am5.p100,
                    centerX: am5.p100,
                    fill: am5.color("#d86744")
                }));

                function getSeriesItem(category) {
                    for (var i = 0; i < series.dataItems.length; i++) {
                        var dataItem = series.dataItems[i];
                        if (dataItem.get("categoryY") == category) {
                            return dataItem;
                        }
                    }
                }

                function sortCategoryAxis() {
                    series.dataItems.sort(function(x, y) {
                        return y.get("valueX") - x.get("valueX");
                    });

                    am5.array.each(yAxis.dataItems, function(dataItem) {
                        var seriesDataItem = getSeriesItem(dataItem.get("category"));
                        if (seriesDataItem) {
                            var index = series.dataItems.indexOf(seriesDataItem);
                            var deltaPosition = (index - dataItem.get("index", 0)) / series
                                .dataItems.length;
                            if (dataItem.get("index") != index) {
                                dataItem.set("index", index);
                                dataItem.set("deltaPosition", -deltaPosition);
                                dataItem.animate({
                                    key: "deltaPosition",
                                    to: 0,
                                    duration: 200,
                                    easing: am5.ease.out(am5.ease.cubic)
                                });
                            }
                        }
                    });

                    yAxis.dataItems.sort(function(x, y) {
                        return x.get("index") - y.get("index");
                    });
                }

                function setInitialData(data) {
                    series.data.setAll(data);
                    yAxis.data.setAll(data.map(item => ({
                        network: item.network
                    })));
                }

                function updateChart(data, startDate, endDate) {
                    var itemsWithNonZero = 0;

                    am5.array.each(series.dataItems, function(dataItem) {
                        var category = dataItem.get("categoryY");
                        var value = data.find(item => item.network === category)?.value || 0;

                        if (value > 0) {
                            itemsWithNonZero++;
                        }

                        dataItem.animate({
                            key: "valueX",
                            to: value,
                            duration: 200,
                            easing: am5.ease.linear
                        });
                        dataItem.animate({
                            key: "valueXWorking",
                            to: value,
                            duration: 200,
                            easing: am5.ease.linear
                        });
                    });

                    yAxis.zoom(0, itemsWithNonZero / yAxis.dataItems.length);

                    // Update the label
                    label.set("text", `${startDate} - ${endDate}`);
                }

                window.fetchFilteredData = function(startDate, endDate) {
                    var filteredData = allData.filter(item => {
                        var itemDate = moment(item.date, 'YYYY-MM-DD');
                        return itemDate.isBetween(startDate, endDate, undefined, '[]');
                    });

                    var aggregatedData = filteredData.reduce((acc, item) => {
                        var existing = acc.find(i => i.network === item.network);
                        if (existing) {
                            existing.value += item.value;
                        } else {
                            acc.push({
                                network: item.network,
                                value: item.value
                            });
                        }
                        return acc;
                    }, []);

                    updateChart(aggregatedData, startDate, endDate);
                }

                setInitialData([{
                        network: "Number of Reportables",
                        value: 5
                    },
                    {
                        network: "Number of Screened",
                        value: 2
                    }
                ]);

                series.appear(1000);
                chart.appear(1000, 100);
            });
        });
    </script>
@endsection
