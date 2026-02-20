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

    .chartDivOuter h4 {
        margin: 20px 0;
    }

    .chartdiv {
        width: 100%;
        height: 100%;
    }

    .daterange {
        width: 200px;
        margin-left: auto !important;
        margin-bottom: 10px !important;
        margin-right: 10px !important;
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
<section class="chartSec mb-5">
    <div class="container-fluid">
        <div class="chartDivRow">












            <div class="chartDivOuter chartdiv1">
                <h4>School</h4>
                <div id="chartdiv1" class="chartdiv"></div>
                <input type="text" class="form-control daterange" />
            </div>


            <div class="chartDivOuter chartdiv2">
                <h4>School Follow Up</h4>
                <div id="chartdiv2" class="chartdiv"></div>
                <input type="text" class="form-control daterange" />
            </div>

            <div class="chartDivOuter chartdiv3">
                <h4>Schools Medical History</h4>
                <div id="chartdiv3" class="chartdiv"></div>
                <input type="text" class="form-control daterange" />
            </div>
            <div class="chartDivOuter chartdiv4">
                <h4>Medical History Details</h4>
                <div id="chartdiv4" class="chartdiv"></div>
                <input type="text" class="form-control daterange" />
            </div>


            <div class="chartDivOuter chartdiv5">
                <h4>Medical History Follow Up</h4>
                <div id="chartdiv5" class="chartdiv"></div>
                <input type="text" class="form-control daterange" />
            </div>

            <div class="chartDivOuter chartdiv6">
                <h4>Medical History UnFollow</h4>
                <div id="chartdiv6" class="chartdiv"></div>
                <input type="text" class="form-control daterange" />
            </div>

            <div class="chartDivOuter chartdiv7">
                <h4>School Health Physician Follow</h4>
                <div id="chartdiv7" class="chartdiv"></div>
                <input type="text" class="form-control daterange" />
            </div>


            <div class="chartDivOuter chartdiv8">
                <h4>Psychologist Follow Up</h4>
                <div id="chartdiv8" class="chartdiv"></div>
                <input type="text" class="form-control daterange" />
            </div>

            <div class="chartDivOuter chartdiv9">
                <h4>Nutritionist Follow Up</h4>
                <div id="chartdiv9" class="chartdiv"></div>
                <input type="text" class="form-control daterange" />
            </div>

            <div class="chartDivOuter chartdiv10">
                <h4>Refferals</h4>
                <div id="chartdiv10" class="chartdiv"></div>
                <input type="text" class="form-control daterange" />
            </div>


            <div class="chartDivOuter chartdiv11">
                <h4>School Emails Sent</h4>
                <div id="chartdiv11" class="chartdiv"></div>
                <input type="text" class="form-control daterange" />
            </div>

            <div class="chartDivOuter chartdiv12">
                <h4>Medical History Findings</h4>
                <div id="chartdiv12" class="chartdiv"></div>
                <input type="text" class="form-control daterange" />
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
        $formattedDate = $createdDate->format('Y-m-d');

        // Push data point into array
        $dataPoints[] = [
            'date' => $formattedDate,
            'y' => $daysSinceCreation,
            'label' => $school['school_name'], // Replace 'school_name' with your actual field name from the School model
            'id' => $school['id'], // Include the school ID
        ];

        $MedicalHistoryEmail = MedicalHistoryEmail::where('to', $school['email'])
            ->where('deleted', 0)
            ->count();

        // Push data point into array
        $dataPoints10[] = [
            'date' => $formattedDate,
            'y' => $MedicalHistoryEmail,
            'label' => $school['school_name'], // Replace 'school_name' with your actual field name from the School model
        ];
    }
}

// dd($dataPoints);

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

                $StudentBiodataCreatedAt = $StudentBiodat['created_at'];

                $StudentBiodataCreatedAt = new DateTime($StudentBiodat['created_at']); // Assuming 'created_at' is the field storing creation date

                $StudentBiodataCreatedAt = $StudentBiodataCreatedAt->format('Y-m-d');


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

        // dd($dataPoints1);

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


<!-- chart 2 -->
<script>
    $(function() {

        function initializeChart(chartDivId, daterangeSelector, allData) {
            am5.ready(function() {
                var root = am5.Root.new(chartDivId);
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

                // Add event handlers for hover and click
                series.columns.template.events.on("pointerover", function(ev) {
                    ev.target.set("fill", am5.color("#FF0000")); // Example: Change color on hover
                });

                series.columns.template.events.on("pointerout", function(ev) {
                    ev.target.set("fill", chart.get("colors").getIndex(series.columns.indexOf(ev.target))); // Reset to original color
                });

                series.columns.template.events.on("hit", function(ev) {
                    var dataItem = ev.target.dataItem;
                    if (dataItem) {
                        var category = dataItem.get("categoryY");
                        var value = dataItem.get("valueX");
                        console.log(`Clicked on ${category}: ${value}`);
                        // You can also trigger other actions here
                    }
                });

                function getCurrentDate() {
                    const today = new Date();
                    const year = today.getFullYear();
                    const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based, so add 1
                    const day = String(today.getDate()).padStart(2, '0');
                    return `${year}-${month}-${day}`;
                }

                var label = chart.plotContainer.children.push(am5.Label.new(root, {
                    text: getCurrentDate(),
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
                            var deltaPosition = (index - dataItem.get("index", 0)) / series.dataItems.length;
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
                    series.appear(1000);
                    chart.appear(1000, 100);
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

                function getMinMaxDates(data) {
                    const dates = data.map(item => moment(item.date, 'YYYY-MM-DD'));
                    const minDate = moment.min(dates);
                    const maxDate = moment.max(dates);
                    return {
                        minDate: minDate.format('YYYY-MM-DD'),
                        maxDate: maxDate.format('YYYY-MM-DD')
                    };
                }

                const {
                    minDate,
                    maxDate
                } = getMinMaxDates(allData);

                $(daterangeSelector).daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD'
                    },
                    startDate: minDate,
                    endDate: maxDate,
                    minDate: minDate,
                    maxDate: maxDate
                }, function(start, end) {
                    fetchFilteredData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
                });

                function fetchFilteredData(startDate, endDate) {
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

                // Call setInitialData to set data and trigger initial animations
                setInitialData(allData);
            });
        }







        const chartIds = [
            "chartdiv1", "chartdiv2", "chartdiv3", "chartdiv4", "chartdiv5",
            "chartdiv6", "chartdiv7", "chartdiv8", "chartdiv9", "chartdiv10",
            "chartdiv11", "chartdiv12"
        ];
        console.log(JSON.parse(JSON.stringify(<?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>)))
        const dataPoints = [
            <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>,
            <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>,
            <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>,
            <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>,
            <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>,
            <?php echo json_encode($dataPoints5, JSON_NUMERIC_CHECK); ?>,
            <?php echo json_encode($dataPoints6, JSON_NUMERIC_CHECK); ?>,
            <?php echo json_encode($dataPoints7, JSON_NUMERIC_CHECK); ?>,
            <?php echo json_encode($dataPoints8, JSON_NUMERIC_CHECK); ?>,
            <?php echo json_encode($dataPoints9, JSON_NUMERIC_CHECK); ?>,
            <?php echo json_encode($dataPoints10, JSON_NUMERIC_CHECK); ?>,
            <?php echo json_encode($dataPoints12, JSON_NUMERIC_CHECK); ?>
        ];

        const chartData = fetchChartData(chartIds, dataPoints);
        initializeAllCharts(chartData);




        function prepareChartData(jsonData) {
            const data = JSON.parse(jsonData);
            return data.map(item => ({
                date: item.date,
                network: item.label,
                value: item.y
            }));
        }

        function fetchChartData(chartIds, dataPoints) {
            return chartIds.reduce((acc, chartId, index) => {
                // Check if dataPoints has a valid entry for the given index
                const data = dataPoints[index] ? JSON.stringify(dataPoints[index]) : '[]';
                acc[chartId] = prepareChartData(data);
                return acc;
            }, {});
        }

        function initializeAllCharts(chartData) {
            Object.keys(chartData).forEach(chartId => {
                const selector = `.${chartId} .daterange`;
                initializeChart(chartId, selector, chartData[chartId]);
            });
        }
    });
</script>
@endsection