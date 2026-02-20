@php
    use App\Models\School;
    use App\Models\StudentBiodata;
    use App\Models\SchoolHealthPhysician;
    use App\Models\NutritionistHistoryEvaluationSection;
    use App\Models\PsychologistHistoryAssessmentSection;
    use App\Models\MedicalHistoryEmail;
    use App\Models\User;
    use Carbon\Carbon;

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
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">
                            Dashboard
                        </li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <div class="secHeading">
                        <span></span>
                        <h2>Follow Up</h2>
                        <span></span>
                    </div>
                    <canvas id="followupChart"></canvas>
                </div>
                <div class="col-md-6">
                    <div class="secHeading">
                        <span></span>
                        <h2>Days Since School Creation</h2>
                        <span></span>
                    </div>
                    <canvas class="fit" id="daysSinceSchoolChart"></canvas>
                </div>
                <div class="col-md-6">
                    <div class="secHeading">
                        <span></span>
                        <h2>Findings</h2>
                        <span></span>
                    </div>
                    <canvas id="findingsChart"></canvas>
                </div>
                <div class="col-md-6">
                    <div class="secHeading">
                        <span></span>
                        <h2>referrals</h2>
                        <span></span>
                    </div>
                    <canvas id="referralsChart"></canvas>
                </div>
                <div class="col-md-6">
                    <div class="secHeading">
                        <span></span>
                        <h2>Emails Sent</h2>
                        <span></span>
                    </div>
                    <canvas id="emailChart"></canvas>
                </div>
                <div class="col-md-6">
                    <div class="secHeading">
                        <span></span>
                        <h2>Students</h2>
                        <span></span>
                    </div>
                    <canvas id="studentChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @php
        $schools = School::get()->toArray();
        $labels = array_map(function ($school) {
            return $school['school_name']; // Ensure this matches your field name
        }, $schools);

        $labels = array_map(function ($label) {
            return $label;
        }, $labels);

        $followups = [];
        $studentCount = [];

        $schools = School::get()->toArray();

        if (!empty($schools)) {
            foreach ($schools as $school) {
                $schoolId = $school['id'];

                $schoolIdArr[] = $schoolId;

                $schoolStudentCount = StudentBiodata::where('School_Name', $schoolId)->count();
                $studentCount[] = $schoolStudentCount;

                // echo $schoolId ;
                //     exit();

                $studentIds = StudentBiodata::where('School_Name', $schoolId)->where('deleted', 0)->get()->toArray();
                // dd($studentIds);
                // exit();

                $totalFollowUps = 0;

                $totalUnFollowUps = 0;
                $totalPendingFollowUps = 0;
                $TotalPhysicanFollowUps = 0;
                $TotalnutritionFollowUps1 = 0;
                $TotalpsychologistFollowUps1 = 0;
                $TotalInternal_referrals = 0;
                $TotalExternal_referrals = 0;
                $Blood_pressure_result_count = 0;
                if (!empty($studentIds)) {
                    foreach ($studentIds as $key => $value) {
                        $StudentBiodataId = $value['id'];
                        //  echo $StudentBiodataId;

                        // exit();

                        $schoolFollowUps = SchoolHealthPhysician::where('deleted', 0)
                            ->where('Follow_up_Required', 'Yes')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $nutritionFollowUps = NutritionistHistoryEvaluationSection::where('deleted', 0)
                            ->where('Follow_up_Required1', 'Yes')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $psychologistFollowUps = PsychologistHistoryAssessmentSection::where('deleted', 0)
                            ->where('Follow_up_Required2', 'Yes')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $totalFollowUps += $schoolFollowUps + $nutritionFollowUps + $psychologistFollowUps;

                        $schoolUnFollowUps = SchoolHealthPhysician::where('deleted', 0)
                            ->where('Follow_up_Required', 'No')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $nutritionUnFollowUps = NutritionistHistoryEvaluationSection::where('deleted', 0)
                            ->where('Follow_up_Required1', 'No')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $psychologistUnFollowUps = PsychologistHistoryAssessmentSection::where('deleted', 0)
                            ->where('Follow_up_Required2', 'No')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $totalUnFollowUps += $schoolUnFollowUps + $nutritionUnFollowUps + $psychologistUnFollowUps;

                        $schoolPendingFollowUps = SchoolHealthPhysician::where('deleted', 0)
                            ->where('Follow_up_Required', 'Yes')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->where('Follow_up_Date', '>=', Carbon::today())
                            ->count();

                        $nutritionPendingFollowUps = NutritionistHistoryEvaluationSection::where('deleted', 0)
                            ->where('Follow_up_Required1', 'Yes')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->where('Follow_up_Date1', '>=', Carbon::today())

                            ->count();

                        $psychologistPendingFollowUps = PsychologistHistoryAssessmentSection::where('deleted', 0)
                            ->where('Follow_up_Required2', 'Yes')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->where('Follow_up_Date2', '>=', Carbon::today())
                            ->count();

                        $totalPendingFollowUps +=
                            $schoolPendingFollowUps + $nutritionPendingFollowUps + $psychologistPendingFollowUps;

                        //  echo "totalFollowUps ". $totalFollowUps ."<br>";

                        //  echo "schoolId ". $schoolId ."<br>";

                        $schoolFollowUps1 = SchoolHealthPhysician::where('deleted', 0)
                            // ->where('Follow_up_Required', 'Yes')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $nutritionFollowUps1 = NutritionistHistoryEvaluationSection::where('deleted', 0)
                            // ->where('Follow_up_Required1', 'Yes')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $psychologistFollowUps1 = PsychologistHistoryAssessmentSection::where('deleted', 0)
                            // ->where('Follow_up_Required2', 'Yes')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $TotalPhysicanFollowUps += $schoolFollowUps1;
                        $TotalnutritionFollowUps1 += $nutritionFollowUps1;
                        $TotalpsychologistFollowUps1 += $psychologistFollowUps1;

                        $schoolFollowUpsInternal_referrals = SchoolHealthPhysician::where('deleted', 0)
                            ->where('internal_referrals', '!=', null)
                            ->where('internal_referrals', '!=', '')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $nutritionFollowUpsInternal_referrals = NutritionistHistoryEvaluationSection::where(
                            'deleted',
                            0,
                        )
                            ->where('internal_referrals1', '!=', null)
                            ->where('internal_referrals1', '!=', '')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $psychologistFollowUpsInternal_referrals = PsychologistHistoryAssessmentSection::where(
                            'deleted',
                            0,
                        )
                            ->where('internal_referrals2', '!=', null)
                            ->where('internal_referrals2', '!=', '')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $TotalInternal_referrals +=
                            $schoolFollowUpsInternal_referrals +
                            $nutritionFollowUpsInternal_referrals +
                            $psychologistFollowUpsInternal_referrals;

                        // dd($TotalInternal_referrals);
                        // echo $TotalInternal_referrals;
                        // exit();

                        $schoolFollowUpsExternal_referrals = SchoolHealthPhysician::where('deleted', 0)
                            ->where('external_referrals', '!=', null)
                            ->where('external_referrals', '!=', '')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $nutritionFollowUpsExternal_referrals = NutritionistHistoryEvaluationSection::where(
                            'deleted',
                            0,
                        )
                            ->where('external_referrals1', '!=', null)
                            ->where('external_referrals1', '!=', '')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $psychologistFollowUpsExternal_referrals = PsychologistHistoryAssessmentSection::where(
                            'deleted',
                            0,
                        )
                            ->where('external_referrals2', '!=', null)
                            ->where('external_referrals2', '!=', '')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $TotalExternal_referrals +=
                            $schoolFollowUpsExternal_referrals +
                            $nutritionFollowUpsExternal_referrals +
                            $psychologistFollowUpsExternal_referrals;

                        // dd($TotalExternal_referrals);
                        // // echo $TotalInternal_referrals;
                        // exit();

                        $SchoolHealthPhysician1 = SchoolHealthPhysician::where('deleted', 0)
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->first();
                        if (!empty($SchoolHealthPhysician1)) {
                            $Blood_pressure_result = $SchoolHealthPhysician1['Blood_pressure_result'];
                            if ($Blood_pressure_result == 'Low') {
                                $Blood_pressure_result_count += 1;
                            }


                        }
                    }

                    //  dd($totalFollowUps);
                    //  exit();
                }

                // dd($totalFollowUps);

                $followups[] = $totalFollowUps;
                $UnfollowUps[] = $totalUnFollowUps;
                $PendingfollowUps[] = $totalPendingFollowUps;
                $TotalPhysicanCount[] = $TotalPhysicanFollowUps;
                $TotalnutritionFollowUps[] = $TotalnutritionFollowUps1;
                $TotalPsychologistFollowUps[] = $TotalpsychologistFollowUps1;
                $Internal_referrals[] = $TotalInternal_referrals;
                $External_referrals[] = $TotalExternal_referrals;

                // dd($TotalPsychologistFollowUps);
                // exit();
                // dd($TotalExternal_referrals);
                // exit();
            }
        }

        // dd($followups);
        // exit();

        $schools = School::all()->toArray();

        // $daysSinceSchoolCreation = 0;
        // $SchoolName=" ";
        // $colors = ['lightblue', 'lightgreen', 'pink', 'lightyellow', 'lightcoral'];
        // $borderColors = ['blue', 'green', 'red', 'yellow', 'darkred'];

        foreach ($schools as $index => $school) {
            $School = $school['school_name'];
            $School_id = $school['id'];
            $createdAt = $school['created_at'];
            $daysSince = now()->diffInDays($createdAt);

            $daysSinceSchoolCreation[] = $daysSince;
            $SchoolName[] = $School;

            // echo $daysSince."<br>";
            // echo $School_id."<br>";
            // exit();
        }

        // dd($daysSinceSchoolCreation);
        // exit();

        $findings = DB::table('student_biodata')
            ->select('School_Name', DB::raw('COUNT(id) as count'))
            ->groupBy('School_Name')
            ->having(DB::raw('COUNT(id)'), '>', 1)
            ->get()
            ->toArray();

    @endphp

    <script>
        window.addEventListener("load", function() {


            const followUpChartCtx = document.getElementById('followupChart').getContext('2d');
            new Chart(followUpChartCtx, {
                type: 'bar',
                data: {
                    // labels: ["The set School","The Future School ","Kiran Foundation School"],
                    labels: @json($labels),
                    datasets: [{
                            label: "Total Students",
                            backgroundColor: "lightblue",
                            borderColor: "blue",
                            borderWidth: 1,
                            data: @json($studentCount),
                        },

                        {
                            label: "Follow-ups",
                            backgroundColor: "lightgreen",
                            borderColor: "green",
                            borderWidth: 1,
                            data: @json($followups),

                        },
                        {
                            label: "UnFollow-ups",
                            backgroundColor: "lightyellow",
                            borderColor: "yellow",
                            borderWidth: 1,
                            data: @json($UnfollowUps),
                        },
                        {
                            label: "Pending",
                            backgroundColor: "pink",
                            borderColor: "red",
                            borderWidth: 1,
                            data: @json($PendingfollowUps),
                        },
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

                    onClick: function() {
                        // if (elements.length > 0) {
                        //     const dataIndex = elements[0].index;

                        let schoolid = @json($schoolId)



                        const baseUrl = "{{ route('IndexMedicalHistory') }}";
                        const url = `${baseUrl}?schoolId=${encodeURIComponent(schoolid)}`;

                        window.location.href = url;
                        // }
                    }
                }


            });


            const DaysSinceSchoolChart = document.getElementById('daysSinceSchoolChart');
            let pieDelay;
            new Chart(DaysSinceSchoolChart, {
                type: 'pie',
                data: {
                    // labels: [
                    //     'Kiran Foundation School',
                    //     'Save The Future School',
                    //     'The SET School'
                    // ],
                    labels: @json($SchoolName),
                    datasets: [{
                        label: "Days",
                        backgroundColor: ["lightblue", "lightgreen", "pink"],
                        borderColor: ["blue", "green", "red"],
                        borderWidth: 1,
                        // data: [197, 224, 224] // Each data point corresponds to a school
                        data: @json($daysSinceSchoolCreation)
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false // Display the legend to identify schools
                        }
                    },
                    responsive: true,
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



            const findingsChartCtx = document.getElementById('findingsChart');
            let delayed;
            let followUpChart1;

            // Pass PHP data to JavaScript
            const schoolIdArr = <?php echo json_encode($schoolIdArr); ?>; 
            const bloodPressureResultCount = <?php echo json_encode($Blood_pressure_result_count); ?>;
            console.log("schoolIdArr ", schoolIdArr);
            console.log("bloodPressureResultCount ", bloodPressureResultCount);

            function getDetailedData(dataValue) {

                console.log("dataValue ----- ", dataValue);
                
                // Define the detailed data map
                const detailedDataMap = {
                    '1': [5, 10],
                    '2': [10],
                    '3': [2, 2],
                    '4': [2, 2],
                };

                /*// Define the detailed data map
                const detailedDataMap = {
                    '1': [5, 10],
                    '2': [10],
                    '3': [2, 2],
                    '4': [2, 2],
                };*/

                // Log the detailedDataMap object properly
                console.log("detailedDataMap:", detailedDataMap);

                // Log the specific data associated with dataValue
                console.log("Data for value", dataValue, ":", detailedDataMap[dataValue]);

                // Return the data based on dataValue or a default value
                return detailedDataMap[dataValue] || [0, 0, 0, 0, 0, 0, 0, 0];
            }

            // Example usage
            console.log(getDetailedData('1')); // Should log [5, 10]



            const findingsChart = new Chart(findingsChartCtx, {
                type: 'bar',
                data: {

                    labels: @json($labels),
                    datasets: [{
                            label: "Total Students ",
                            backgroundColor: "lightblue",
                            borderColor: "blue",
                            borderWidth: 1,
                            data: @json($studentCount),
                        },
                        {
                            label: "Physicians",
                            backgroundColor: "lightgreen",
                            borderColor: "green",
                            borderWidth: 1,
                            data: @json($TotalPhysicanCount),
                        },
                        {
                            label: "Nutritionist",
                            backgroundColor: "pink",
                            borderColor: "red",
                            borderWidth: 1,
                            data: @json($TotalnutritionFollowUps),

                        },
                        {
                            label: "Psychologist",
                            backgroundColor: "lightyellow",
                            borderColor: "yellow",
                            borderWidth: 1,
                            data: @json($TotalPsychologistFollowUps),
                        },
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    responsive: true,
                    animation: {
                        onComplete: () => {
                            delayed = true;
                        },
                        delay: (context) => {
                            let delay = 0;
                            if (context.type === 'data' && context.mode === 'default' && !delayed) {
                                delay = context.dataIndex * 300 + context.datasetIndex * 100;
                            }
                            return delay;
                        },
                    },





                    // Declare a variable to store the chart instance

                    onClick: (event, elements) => {

                        if (elements.length > 0) {

                            console.log(findingsChart.data);
                            const element = elements[0];

                            // Get the details of the clicked element
                            const datasetIndex = element.datasetIndex;
                            const dataIndex = element.index;

                            const datasetLabel = findingsChart.data.datasets[datasetIndex].label;
                            const dataLabel = findingsChart.data.labels[dataIndex];
                            const dataValue = findingsChart.data.datasets[datasetIndex].data[dataIndex];

                            console.log("datasetLabel " + datasetLabel);
                            console.log("dataLabel " + dataLabel);
                            console.log("dataValue " + dataValue);


                            // Get the existing color of the clicked dataset
                            const backgroundColor = findingsChart.data.datasets[datasetIndex]
                                .backgroundColor;
                            const borderColor = findingsChart.data.datasets[datasetIndex].borderColor;

                            console.log("backgroundColor " + backgroundColor);
                            console.log("borderColor " + borderColor);


                            // Example data for the modal chart
                            const modalLabels = findingsChart.data.labels; // or update as needed
                            const modalData = findingsChart.data.datasets[datasetIndex]
                                .data; // or update as needed

                            console.log("modalData " + modalData);
                            console.log("modalLabels " + modalLabels);
                            // Trigger the modal
                            $('#followUpModal').modal('toggle');

                            // Update content or add a chart to the modal
                            document.querySelector('#followUpModal #modalContent').textContent =
                                `${datasetLabel}: ${dataLabel}, Value: ${dataValue}`;

                            setTimeout(() => {
                                // Destroy the existing chart instance if it exists
                                if (followUpChart1) {
                                    followUpChart1.destroy();
                                }

                                if (datasetLabel == "Psychologist") {


                                } else if (datasetLabel == "Physicians") {

                                    const detailedData = getDetailedData(dataValue);
                                    console.log("detailedData " + detailedData);

                                    followUpChart1 = new Chart(document.getElementById(
                                        'followUpModalChart'), {
                                        type: 'bar', // or any other chart type
                                        data: {
                                            labels: [
                                                'Blood Pressure (Systolic)',
                                                'Blood Pressure (Diastolic)',
                                                'Temperature',
                                                'Pulse rate',
                                                'Respiratory Rate',
                                                'Weight',
                                                'Height',
                                                'BMI'
                                            ],

                                            datasets: [{
                                                label: 'Detiled Data',
                                                data: detailedData, // Use data from the clicked dataset
                                                // data: ['5','10'], // Use data from the clicked dataset
                                                backgroundColor: backgroundColor, // Use the same background color
                                                borderColor: borderColor, // Use the same border color
                                                borderWidth: 1
                                            }]
                                        }
                                    });

                                } else if (datasetLabel == "Nutritionist") {


                                } else {

                                    // Render a new chart inside the modal with dynamic data
                                    followUpChart1 = new Chart(document.getElementById(
                                        'followUpModalChart'), {
                                        type: 'bar', // or any other chart type
                                        data: {
                                            labels: modalLabels, // Use labels from the original chart
                                            datasets: [{
                                                label: 'Detailed Data',
                                                data: modalData, // Use data from the clicked dataset
                                                backgroundColor: backgroundColor, // Use the same background color
                                                borderColor: borderColor, // Use the same border color
                                                borderWidth: 1
                                            }]
                                        }
                                    });

                                }

                            }, 300);
                        }
                    }





                },
            });

            const referralsChart = document.getElementById('referralsChart');
            let referralsDelay;

            const chartInstance = new Chart(referralsChart, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    // labels: [
                    //     'Kiran Foundation School',
                    //     'Save The Future School',
                    //     'The SET School'
                    // ],
                    datasets: [{
                            label: 'External',
                            backgroundColor: ["lightgreen", "lightgreen", "lightgreen"],
                            borderColor: ["green", "green", "green"],
                            borderWidth: 1,
                            // data: [33, 25, 20]
                            data: @json($External_referrals),
                        },
                        {
                            label: 'Internal',
                            backgroundColor: ["lightblue", "lightblue", "lightblue"],
                            borderColor: ["blue", "blue", "blue"],
                            borderWidth: 1,
                            // data: [18, 18, 35]
                            data: @json($Internal_referrals),

                        },
                    ]
                },
                options: {
                    indexAxis: 'y',
                    elements: {
                        bar: {
                            borderWidth: 2,
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    responsive: true,
                    animation: {
                        onComplete: () => {
                            referralsDelay = true;
                        },
                        delay: (context) => {
                            let delay = 0;
                            if (context.type === 'data' && context.mode === 'default' && !
                                referralsDelay) {
                                delay = context.dataIndex * 300 + context.datasetIndex * 100;
                            }
                            return delay;
                        },
                    },
                    onClick: (event, elements) => {
                        if (elements.length > 0) {
                            const element = elements[0];
                            const datasetLabel = chartInstance.data.datasets[element.datasetIndex]
                                .label;
                            const dataLabel = chartInstance.data.labels[element.index];
                            const dataValue = chartInstance.data.datasets[element.datasetIndex].data[
                                element.index];

                            // Determine which modal to open based on the label
                            if (datasetLabel === 'Internal') {
                                // Trigger the internal modal
                                $('#internalModal').modal('toggle');
                                // Update content or add a chart to the internal modal
                                document.getElementById('modalContentInternal').textContent =
                                    `Internal: ${dataLabel}, Value: ${dataValue}`;

                                setTimeout(() => {
                                    // Render a chart inside the internal modal (example)
                                    new Chart(document.getElementById('internalModalChart'), {
                                        type: 'bar', // or any other chart type
                                        data: {
                                            labels: ['a', 'b', 'c', 'd', 'e', 'f', 'g',
                                                'h'
                                            ],
                                            datasets: [{
                                                label: 'Internal Data',
                                                data: [10, 20, 30, 40, 50, 60,
                                                    70, 80
                                                ],
                                                backgroundColor: 'lightblue',
                                                borderColor: 'blue',
                                                borderWidth: 1
                                            }]
                                        }
                                    });
                                }, 300)

                            } else if (datasetLabel === 'External') {
                                // Trigger the external modal
                                $('#externalModal').modal('toggle');
                                // Update content or add a chart to the external modal
                                document.getElementById('modalContentExternal').textContent =
                                    `External: ${dataLabel}, Value: ${dataValue}`;

                                setTimeout(() => {
                                    // Render a chart inside the external modal (example)
                                    new Chart(document.getElementById('externalModalChart'), {
                                        type: 'bar', // or any other chart type
                                        data: {
                                            labels: ['a', 'b', 'c', 'd', 'e', 'f', 'g',
                                                'h'
                                            ],
                                            datasets: [{
                                                label: 'External Data',
                                                data: [15, 25, 35, 45, 55, 65,
                                                    75, 85
                                                ],
                                                backgroundColor: 'pink',
                                                borderColor: 'red',
                                                borderWidth: 1
                                            }]
                                        }
                                    });
                                }, 300)
                            }
                        }
                    }
                }
            });

            const emailChart = document.getElementById('emailChart');
            let emailDelay;

            const MONTHS = [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ];

            function months(config) {
                var cfg = config || {};
                var count = cfg.count || 12;
                var section = cfg.section;
                var values = [];
                var i, value;

                for (i = 0; i < count; ++i) {
                    value = MONTHS[Math.ceil(i) % 12];
                    values.push(value.substring(0, section));
                }

                return values;
            }

            const labels = months({
                count: 12
            });
            new Chart(emailChart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Kiran Foundation School',
                            backgroundColor: "lightblue", // lightblue with transparency
                            borderColor: "blue",
                            borderWidth: 2,
                            data: [175, 180, 190, 170, 160, 175, 190, 200, 180, 195, 180, 190]
                        },
                        {
                            label: 'Save The Future School',
                            backgroundColor: "lightgreen", // lightgreen with transparency
                            borderColor: "green",
                            borderWidth: 2,
                            data: [109, 115, 120, 130, 125, 110, 115, 125, 130, 135, 120, 110]
                        },
                        {
                            label: 'The SET School',
                            backgroundColor: "pink", // pink with transparency
                            borderColor: "red",
                            borderWidth: 2,
                            data: [140, 145, 150, 135, 130, 140, 150, 160, 155, 165, 150, 145]
                        },
                    ]
                },

                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true, // Display legend to show each school's line
                        }
                    },
                    animation: {
                        onComplete: () => {
                            emailDelay = true;
                        },
                        delay: (context) => {
                            let delay = 0;
                            if (context.type === 'data' && context.mode === 'default' && !emailDelay) {
                                delay = context.dataIndex * 300 + context.datasetIndex * 100;
                            }
                            return delay;
                        },
                    },
                    scales: {
                        x: {
                            stacked: false,
                        },
                        y: {
                            stacked: false,
                            beginAtZero: true,
                        }
                    }
                }
            });

            const studentChartCtx = document.getElementById('studentChart');
            let studentDelay;
            new Chart(studentChartCtx, {
                type: 'bar',
                data: {
                    labels: [
                        'Kiran Foundation School',
                        'Save The Future School',
                        'The SET School'
                    ],
                    datasets: [{
                            label: 'Total Students',
                            backgroundColor: "lightblue",
                            borderColor: "blue",
                            borderWidth: 1,
                            data: [28, 35, 56]
                        },
                        {
                            label: 'Screened Students',
                            backgroundColor: "lightgreen",
                            borderColor: "green",
                            borderWidth: 1,
                            data: [15, 27, 33]
                        },
                        {
                            label: 'UnScreened Students',
                            backgroundColor: "pink",
                            borderColor: "red",
                            borderWidth: 1,
                            data: [19, 27, 34]
                        },
                        {
                            label: 'Presenting Complains',
                            backgroundColor: "pink",
                            borderColor: "red",
                            borderWidth: 1,
                            data: [21, 17, 29]
                        },
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    animation: {
                        onComplete: () => {
                            studentDelay = true;
                        },
                        delay: (context) => {
                            let delay = 0;
                            if (context.type === 'data' && context.mode === 'default' && !
                                studentDelay) {
                                delay = context.dataIndex * 300 + context.datasetIndex * 100;
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
