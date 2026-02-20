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
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">
                            Dashboard 3
                        </li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <div class="secHeading">
                        <span></span>
                        <h2>Students</h2>
                        <span></span>
                    </div>
                    <canvas id="studentChart"></canvas>
                </div>
                <!-- <div class="col-md-6">
                    <div class="secHeading">
                        <span></span>
                        <h2>Follow Up</h2>
                        <span></span>
                    </div>
                    <canvas id="followupChart"></canvas>
                </div> -->
                <div class="col-md-6">
                    <div class="secHeading">
                        <span></span>
                        <h2>Days Since School Collaboration</h2>
                        <span></span>
                    </div>
                    <canvas class="fit" id="daysSinceSchoolChart"></canvas>
                </div>
                <div class="col-md-6">
                    <div class="secHeading">
                        <span></span>
                        <h2>Reportables Findings</h2>
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

        $labels1 = array_map(function ($school) {
            return $school['id']; // Ensure this matches your field name
        }, $schools);

        $followups = [];
        $studentCount = [];

        $UnfollowUps = [];
        $SchoolName = [];
        $daysSinceSchoolCreation = [];
        $PendingfollowUps = [];
        $detailedDataMap = [];
        $TotalPhysicanCount = [];
        $schoolId = 0;

        $TotalnutritionFollowUps = [];
        $TotalPsychologistFollowUps = [];
        $External_referrals = [];
        $Internal_referrals = [];

        $schools = School::get()->toArray();

        if (!empty($schools)) {
            foreach ($schools as $school) {
                $Physicians = [];

                $schoolId = $school['id'];
                $school_name = $school['school_name'];

                $schoolIdArr[] = $schoolId;

                $schoolStudentCount = StudentBiodata::join('users', 'users.id', '=', 'student_biodata.created_by')
    ->leftJoin('school_health_physicians', function ($join) {
        $join->on('school_health_physicians.StudentBiodataId', '=', 'student_biodata.id')
             ->where('school_health_physicians.deleted', 0);
    })
    ->leftJoin('nutritionist_history_evaluation_sections', function ($join) {
        $join->on('nutritionist_history_evaluation_sections.StudentBiodataId', '=', 'student_biodata.id')
             ->where('nutritionist_history_evaluation_sections.deleted', 0);
    })
    ->leftJoin('psychologist_history_assessment_sections', function ($join) {
        $join->on('psychologist_history_assessment_sections.StudentBiodataId', '=', 'student_biodata.id')
             ->where('psychologist_history_assessment_sections.deleted', 0);
    })
    ->where('student_biodata.School_Name', $schoolId)
    ->where('student_biodata.deleted', 0)
    ->where(function ($query) {
        $query->whereNotNull('school_health_physicians.StudentBiodataId')
              ->orWhereNotNull('nutritionist_history_evaluation_sections.StudentBiodataId')
              ->orWhereNotNull('psychologist_history_assessment_sections.StudentBiodataId');
    });

// Debug SQL query before execution


// Execute the count
$schoolStudentCount = $schoolStudentCount->count();
                $studentCount[] = $schoolStudentCount;

                $studentIds = StudentBiodata::where('School_Name', $schoolId)->where('deleted', 0)->limit(25)->get()->toArray();


                
                $totalFollowUps = 0;

                $totalUnFollowUps = 0;
                $totalPendingFollowUps = 0;
                $TotalPhysicanFollowUps = 0;
                $TotalnutritionFollowUps1 = 0;
                $TotalpsychologistFollowUps1 = 0;
                $TotalInternal_referrals = 0;
                $TotalExternal_referrals = 0;

                $Blood_pressure_result_count = 0;
                $BloodPressureDiastolicResultCount = 0;
                $TemperatureResultCount = 0;
                $PulseResultCount = 0;
                $RespiratoryRateResultCount = 0;
                $HeightResultCount = 0;
                $BMIResultCount = 0;

                $HeightResult1Count = 0;
                $WeightResult1Count = 0;
                $BMIResult1Count = 0;
                $schoolFollowUps = StudentBiodata::join('school_health_physicians', 'school_health_physicians.StudentBiodataId', '=', 'student_biodata.id')
                         ->where('school_health_physicians.deleted', 0)
                         ->where('school_health_physicians.Follow_up_Required', 'Yes')
                         ->where('student_biodata.School_Name', $schoolId)
                         ->where('student_biodata.deleted', 0)
                         ->count(); 
                        
                        $nutritionFollowUps = StudentBiodata::join('nutritionist_history_evaluation_sections', 'nutritionist_history_evaluation_sections.StudentBiodataId', '=', 'student_biodata.id')
                         ->where('nutritionist_history_evaluation_sections.deleted', 0)
                         ->where('nutritionist_history_evaluation_sections.Follow_up_Required1', 'Yes')
                         ->where('student_biodata.School_Name', $schoolId)
                         ->where('student_biodata.deleted', 0)
                         ->count(); 

                       /*$nutritionFollowUps = NutritionistHistoryEvaluationSection::where('deleted', 0)
                            ->where('Follow_up_Required1', 'Yes')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();*/

                        $psychologistFollowUps = StudentBiodata::join('psychologist_history_assessment_sections', 'psychologist_history_assessment_sections.StudentBiodataId', '=', 'student_biodata.id')
                         ->where('psychologist_history_assessment_sections.deleted', 0)
                         ->where('psychologist_history_assessment_sections.Follow_up_Required2', 'Yes')
                         ->where('student_biodata.School_Name', $schoolId)
                         ->where('student_biodata.deleted', 0)
                         ->count(); 
                       
                        /*PsychologistHistoryAssessmentSection::where('deleted', 0)
                            ->where('Follow_up_Required2', 'Yes')
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();*/

                        $totalFollowUps += $schoolFollowUps + $nutritionFollowUps + $psychologistFollowUps;

                        $TotalPhysicanFollowUps += $schoolFollowUps;
                        $TotalnutritionFollowUps1 += $nutritionFollowUps;
                        $TotalpsychologistFollowUps1 += $psychologistFollowUps;

                        /*  $schoolUnFollowUps = StudentBiodata::join('school_health_physicians', 'school_health_physicians.StudentBiodataId', '=', 'student_biodata.id')
                         ->where('school_health_physicians.deleted', 0)
                         ->where('school_health_physicians.Follow_up_Required', 'No')
                         ->where('student_biodata.School_Name', $schoolId)
                         ->where('student_biodata.deleted', 0)
                         ->count(); 

                        $nutritionUnFollowUps = StudentBiodata::join('nutritionist_history_evaluation_sections', 'nutritionist_history_evaluation_sections.StudentBiodataId', '=', 'student_biodata.id')
                         ->where('nutritionist_history_evaluation_sections.deleted', 0)
                         ->where('nutritionist_history_evaluation_sections.Follow_up_Required1', 'No')
                         ->where('student_biodata.School_Name', $schoolId)
                         ->where('student_biodata.deleted', 0)
                         ->count(); 

                        $psychologistUnFollowUps = StudentBiodata::join('psychologist_history_assessment_sections', 'psychologist_history_assessment_sections.StudentBiodataId', '=', 'student_biodata.id')
                         ->where('psychologist_history_assessment_sections.deleted', 0)
                         ->where('psychologist_history_assessment_sections.Follow_up_Required2', 'No')
                         ->where('student_biodata.School_Name', $schoolId)
                         ->where('student_biodata.deleted', 0)
                         ->count(); 

                        $totalUnFollowUps += $schoolUnFollowUps + $nutritionUnFollowUps + $psychologistUnFollowUps;*/

                        $schoolFollowUpsInternal_referrals = StudentBiodata::join('school_health_physicians', 'school_health_physicians.StudentBiodataId', '=', 'student_biodata.id')
                         ->where('school_health_physicians.deleted', 0)
                         ->where('school_health_physicians.Follow_up_Required', 'Yes')
                         ->where('school_health_physicians.internal_referrals', '!=', null)
                         ->where('school_health_physicians.internal_referrals', '!=', '')
                         ->where('school_health_physicians.internal_referrals', '!=', 'Not Required')
                         ->where('student_biodata.School_Name', $schoolId)
                         ->where('student_biodata.deleted', 0)
                         ->count(); 

                         $nutritionFollowUpsInternal_referrals = StudentBiodata::join('nutritionist_history_evaluation_sections', 'nutritionist_history_evaluation_sections.StudentBiodataId', '=', 'student_biodata.id')
                         ->where('nutritionist_history_evaluation_sections.deleted', 0)
                         ->where('nutritionist_history_evaluation_sections.Follow_up_Required1', 'Yes')
                         ->where('nutritionist_history_evaluation_sections.internal_referrals1', '!=', null)
                         ->where('nutritionist_history_evaluation_sections.internal_referrals1', '!=', '')
                         ->where('nutritionist_history_evaluation_sections.internal_referrals1', '!=', 'Not Required')
                         ->where('student_biodata.School_Name', $schoolId)
                         ->where('student_biodata.deleted', 0)
                         ->count(); 

                         $psychologistFollowUpsInternal_referrals = StudentBiodata::join('psychologist_history_assessment_sections', 'psychologist_history_assessment_sections.StudentBiodataId', '=', 'student_biodata.id')
                         ->where('psychologist_history_assessment_sections.deleted', 0)
                         ->where('psychologist_history_assessment_sections.Follow_up_Required2', 'Yes')
                         ->where('psychologist_history_assessment_sections.internal_referrals2', '!=', null)
                        ->where('psychologist_history_assessment_sections.internal_referrals2', '!=', '')
                        ->where('psychologist_history_assessment_sections.internal_referrals2', '!=', 'Not Required')
                         ->where('student_biodata.School_Name', $schoolId)
                         ->where('student_biodata.deleted', 0)
                         ->count(); 
                        
                         $TotalInternal_referrals +=
                            $schoolFollowUpsInternal_referrals +
                            $nutritionFollowUpsInternal_referrals +
                            $psychologistFollowUpsInternal_referrals;
                            $schoolFollowUpsExternal_referrals = StudentBiodata::join('school_health_physicians', 'school_health_physicians.StudentBiodataId', '=', 'student_biodata.id')
                         ->where('school_health_physicians.deleted', 0)
                         ->where('school_health_physicians.Follow_up_Required', 'Yes')
                         ->where('school_health_physicians.external_referrals', '!=', null)
                         ->where('school_health_physicians.external_referrals', '!=', '')
                         ->where('school_health_physicians.external_referrals', '!=', 'Not Required')
                         ->where('student_biodata.School_Name', $schoolId)
                         ->where('student_biodata.deleted', 0)
                         ->count(); 
                        
                        
                      

                        $nutritionFollowUpsExternal_referrals = StudentBiodata::join('nutritionist_history_evaluation_sections', 'nutritionist_history_evaluation_sections.StudentBiodataId', '=', 'student_biodata.id')
                         ->where('nutritionist_history_evaluation_sections.deleted', 0)
                         ->where('nutritionist_history_evaluation_sections.Follow_up_Required1', 'Yes')
                         ->where('nutritionist_history_evaluation_sections.external_referrals1', '!=', null)
                         ->where('nutritionist_history_evaluation_sections.external_referrals1', '!=', '')
                         ->where('nutritionist_history_evaluation_sections.external_referrals1', '!=', 'Not Required')
                         ->where('student_biodata.School_Name', $schoolId)
                         ->where('student_biodata.deleted', 0)
                         ->count(); 
                        
                        
                      

                        $psychologistFollowUpsExternal_referrals = StudentBiodata::join('psychologist_history_assessment_sections', 'psychologist_history_assessment_sections.StudentBiodataId', '=', 'student_biodata.id')
                         ->where('psychologist_history_assessment_sections.deleted', 0)
                         ->where('psychologist_history_assessment_sections.Follow_up_Required2', 'Yes')
                         ->where('psychologist_history_assessment_sections.external_referrals2', '!=', null)
                        ->where('psychologist_history_assessment_sections.external_referrals2', '!=', '')
                        ->where('psychologist_history_assessment_sections.external_referrals2', '!=', 'Not Required')
                         ->where('student_biodata.School_Name', $schoolId)
                         ->where('student_biodata.deleted', 0)
                         ->count(); 
                        
                        
                    

                        $TotalExternal_referrals +=
                            $schoolFollowUpsExternal_referrals +
                            $nutritionFollowUpsExternal_referrals +
                            $psychologistFollowUpsExternal_referrals;

                          
                            
                if (!empty($studentIds)) {
                    foreach ($studentIds as $key => $value) {
                        $StudentBiodataId = $value['id'];

                        

                       

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

                        /*$schoolFollowUps1 = SchoolHealthPhysician::where('deleted', 0)
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $nutritionFollowUps1 = NutritionistHistoryEvaluationSection::where('deleted', 0)
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count();

                        $psychologistFollowUps1 = PsychologistHistoryAssessmentSection::where('deleted', 0)
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->count(); */

                       

                        
                        
                        
                        

                        
                        
                        
                      

                       
                     

                        

                       

                        // echo "StudentBiodataId ".$StudentBiodataId.'<br>';

                        $SchoolHealthPhysician1 = SchoolHealthPhysician::where('deleted', 0)
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->first();

                        // dd($SchoolHealthPhysician1);

                        if (!empty($SchoolHealthPhysician1)) {
                            $Blood_pressure_result = $SchoolHealthPhysician1['Blood_pressure_result'];
                            if ($Blood_pressure_result == 'Low') {
                                $Blood_pressure_result_count += 1;
                            } else {
                                $Blood_pressure_result_count += 0;
                            }
                            $BloodPressureDiastolicResult = $SchoolHealthPhysician1['BloodPressureDiastolicResult'];
                            if ($BloodPressureDiastolicResult == 'Low') {
                                $BloodPressureDiastolicResultCount += 1;
                            } else {
                                $BloodPressureDiastolicResultCount += 0;
                            }

                            $TemperatureResult = $SchoolHealthPhysician1['TemperatureResult'];
                            if ($TemperatureResult == 'Low') {
                                $TemperatureResultCount += 1;
                            } else {
                                $TemperatureResultCount += 0;
                            }

                            $PulseResult = $SchoolHealthPhysician1['PulseResult'];
                            if ($PulseResult == 'Low') {
                                $PulseResultCount += 1;
                            } else {
                                $PulseResultCount += 0;
                            }

                            $RespiratoryRateResult = $SchoolHealthPhysician1['RespiratoryRateResult'];
                            if ($RespiratoryRateResult == 'Low') {
                                $RespiratoryRateResultCount += 1;
                            } else {
                                $RespiratoryRateResultCount += 0;
                            }

                            $HeightResult = $SchoolHealthPhysician1['HeightResult'];
                            if ($HeightResult == 'Low') {
                                $HeightResultCount += 1;
                            } else {
                                $HeightResultCount += 0;
                            }
                            $BMIResult = $SchoolHealthPhysician1['BMIResult'];
                            if ($BMIResult == 'Low') {
                                $BMIResultCount += 1;
                            } else {
                                $BMIResultCount += 0;
                            }
                        }

                        $NutritionistHistoryEvaluationSection1 = NutritionistHistoryEvaluationSection::where(
                            'deleted',
                            0,
                        )
                            ->where('StudentBiodataId', $StudentBiodataId)
                            ->first();

                        if (!empty($NutritionistHistoryEvaluationSection1)) {
                            $HeightResult1 = $NutritionistHistoryEvaluationSection1['HeightResult1'];
                            if ($HeightResult1 == 'Low') {
                                $HeightResult1Count += 1;
                            } else {
                                $HeightResult1Count += 0;
                            }

                            $WeightResult1 = $NutritionistHistoryEvaluationSection1['WeightResult1'];
                            if ($WeightResult1 == 'Low') {
                                $WeightResult1Count += 1;
                            } else {
                                $WeightResult1Count += 0;
                            }

                            $BMIResult1 = $NutritionistHistoryEvaluationSection1['BMIResult1'];
                            if ($BMIResult1 == 'Low') {
                                $BMIResult1Count += 1;
                            } else {
                                $BMIResult1Count += 0;
                            }
                        }
                    }

                    $Physicians[] = $Blood_pressure_result_count;
                    $Physicians[] = $BloodPressureDiastolicResultCount;
                    $Physicians[] = $PulseResultCount;
                    $Physicians[] = $TemperatureResultCount;
                    $Physicians[] = $RespiratoryRateResultCount;
                    $Physicians[] = $HeightResultCount;
                    $Physicians[] = $BMIResultCount;

                    $NutritionistGraph[] = $HeightResult1Count;
                    $NutritionistGraph[] = $WeightResult1Count;
                    $NutritionistGraph[] = $BMIResult1Count;

                }


                $detailedDataMap[$school_name] = $Physicians;
                $detailedDataMap1[$school_name] = $NutritionistGraph;

               

                $followups[] = $totalFollowUps;
                $UnfollowUps[] = $totalUnFollowUps;
                $PendingfollowUps[] = $totalPendingFollowUps;
                $TotalPhysicanCount[] = $TotalPhysicanFollowUps;
                $TotalnutritionFollowUps[] = $TotalnutritionFollowUps1;
                $TotalPsychologistFollowUps[] = $TotalpsychologistFollowUps1;
                $Internal_referrals[] = $TotalInternal_referrals;
                $External_referrals[] = $TotalExternal_referrals;
            }
        }

        $schools = School::all()->toArray();

        if (!empty($schools)) {
            foreach ($schools as $index => $school) {
                $School = $school['school_name'];
                $School_id = $school['id'];
                $createdAt = $school['created_at'];
                $daysSince = now()->diffInDays($createdAt);

                $daysSinceSchoolCreation[] = $daysSince;
                $SchoolName[] = $School;
            }
        }

        $findings = DB::table('student_biodata')
            ->select('School_Name', DB::raw('COUNT(id) as count'))
            ->groupBy('School_Name')
            ->having(DB::raw('COUNT(id)'), '>', 1)
            ->get()
            ->toArray();

        $schools1 = School::all(); // Adjust the query to get the data you need

        // Define an array of colors to use for the chart
        $colors = [
            ['borderColor' => 'rgba(255,99,132,1)', 'backgroundColor' => 'rgba(255,99,132,0.2)'], // Red
            ['borderColor' => 'rgba(54,162,235,1)', 'backgroundColor' => 'rgba(54,162,235,0.2)'], // Blue
            ['borderColor' => 'rgba(255,206,86,1)', 'backgroundColor' => 'rgba(255,206,86,0.2)'], // Yellow
            ['borderColor' => 'rgba(75,192,192,1)', 'backgroundColor' => 'rgba(75,192,192,0.2)'], // Green
            ['borderColor' => 'rgba(153,102,255,1)', 'backgroundColor' => 'rgba(153,102,255,0.2)'], // Purple
            ['borderColor' => 'rgba(255,159,64,1)', 'backgroundColor' => 'rgba(255,159,64,0.2)'], // Orange
            // Add more colors as needed
        ];

        $schoolData = $schools1->map(function ($school, $index) use ($colors) {
            // Initialize an array with 12 zeros to represent counts for each month (Jan to Dec)
            $monthlyCounts = array_fill(0, 12, 0);

            // Fetch all MedicalHistoryEmails for the school and group by month
            $emails = MedicalHistoryEmail::where('to', $school->email)
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->groupBy('month')
                ->limit(25)
                ->get();

            // Populate the monthlyCounts array with actual counts
            foreach ($emails as $email) {
                $monthIndex = $email->month - 1; // Convert month to zero-based index
                $monthlyCounts[$monthIndex] = $email->count;
            }

            // Use a predefined color or a random color if the index exceeds the array size
            $color = $colors[$index % count($colors)];

            return [
                'label' => $school->school_name,
                'backgroundColor' => $color['backgroundColor'],
                'borderColor' => $color['borderColor'],
                'borderWidth' => 2,
                'data' => $monthlyCounts, // Array of counts for each month
            ];
        });

        /*

        // Prepare the data to be used in the chart (this assumes each school has 'name' and 'data' fields)
        $schoolData = $schools1->map(function ($school) {
            
            $monthlyCounts = array_fill(0, 12, 0);
            $emails = MedicalHistoryEmail::where('to', $school->email)
                        ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->groupBy('month')
                        ->get();
            foreach ($emails as $email) {
                $monthIndex = $email->month - 1; // Convert month to zero-based index
                $monthlyCounts[$monthIndex] = $email->count;
            }

            return [
                'label' => $school->school_name,
                'backgroundColor' => 'rgba(135,206,250,0.2)', // Lightblue with transparency
                'borderColor' => 'blue',
                'borderWidth' => 2,
                // 'data' => json_decode($school->data), // Assuming 'data' field is a JSON encoded array
                // 'data' => [175, 180, 190, 170, 160, 175, 190, 200, 180, 195, 180, 190]
                'data' => $monthlyCounts // Array of counts for each month

            ];
        });
*/


        $screenedData = [];
        $unscreenedData = [];
        $schools2 = School::get()->toArray(); // Adjust the query to get the data you need
        if (!empty($schools2)) {
            foreach ($schools2 as $key => $value) {
                $schools2ID = $value['id'];
                // echo ' schools2ID ' . $schools2ID . '<br>';

                $entriesCount[] = form_entry::where('school', $schools2ID)->count();

                $entries = form_entry::where('school', $schools2ID)
                    ->limit(25) // Add a limit of 10 entries
                    ->get()
                    ->toArray();

                $Question_No_1_Height_count_grand = 0;
                $Question_No_1_Height_count_1_grand = 0;
                $Question_No_1_Height_count = form_entry::join('form_data','form_data.entry_id','=','form_entries.id')
                            ->where('form_data.key', 'Question_No_1_Height')
                            ->where('form_entries.school', $schools2ID)
                            ->count();
                       
                        $Question_No_1_Height_count_grand += $Question_No_1_Height_count;


                        $Question_No_1_Height_count_1 =form_entry::join('form_data','form_data.entry_id','=','form_entries.id')
                            ->where('form_data.key', 'Question_No_1_Height')
                            ->where('form_data.value', '')
                            ->where('form_data.value', null)
                            ->where('form_entries.school', $schools2ID)
                            ->count();
                       
                  
                        $Question_No_1_Height_count_1_grand += $Question_No_1_Height_count_1;
                        
              /*  if (!empty($entries)) {
                    foreach ($entries as $entry) {
                        $entriesID = $entry['id'];
                       
                      
                       
                    }
                }*/

                $screenedData[] = $Question_No_1_Height_count_grand;
                $unscreenedData[] = $Question_No_1_Height_count_1_grand;

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
];


                          $PresentingComplains =  form_entry::join('form_data', 'form_data.entry_id', '=', 'form_entries.id')
                                        ->where('form_entries.school', $schools2ID)
                                        ->where(function ($query) use ($questions) {
                                            foreach ($questions as $question) {
                                                if (is_array($question['value'])) {
                                                    // If value is an array, use `whereIn`
                                                    $query->orWhere(function ($subQuery) use ($question) {
                                                        $subQuery->where('form_data.key', $question['key'])
                                                                ->whereIn('form_data.value', $question['value']);
                                                    });
                                                } else {
                                                    // If value is a single string, use `where`
                                                    $query->orWhere(function ($subQuery) use ($question) {
                                                        $subQuery->where('form_data.key', $question['key'])
                                                                ->where('form_data.value', $question['value']);
                                                    });
                                                }
                                            }
                                        })
                                        ->count();
                                       
            }

          
            
        }

    @endphp

    <script>
        window.addEventListener("load", function() {

            /********** Emails Sent Graph ****************/

            const schoolData = @json($schoolData);

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
                    datasets: schoolData // Use the dynamic datasets from Laravel
                },
                /*data: {
                    labels: labels,
                    datasets: [

                        {
                            label: 'Kiran Foundation School 123',
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
                },*/

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


         /*   const followUpChartCtx = document.getElementById('followupChart').getContext('2d');
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
                            label: "Follow-ups Not Required",
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

                    // onClick: function() {
                    //     // if (elements.length > 0) {
                    //     //     const dataIndex = elements[0].index;

                    //     let schoolid = @json($schoolId)



                    //     const baseUrl = "{{ route('IndexMedicalHistory') }}";
                    //     const url = `${baseUrl}?schoolId=${encodeURIComponent(schoolid)}`;

                    //     window.location.href = url;
                    //     // }
                    // }


                    onClick: function(event, elements) {

                        if (elements.length > 0) {
                            // Get the index of the clicked bar
                            const dataIndex = elements[0].index;

                            // Get the school ID corresponding to the clicked bar
                            const schoolIds = @json($schoolIdArr); // Array of school IDs
                            const schoolId = schoolIds[dataIndex];

                            console.log("schoolIds " + schoolIds);
                            console.log("schoolId " + schoolId);

                            // Construct the URL for redirection
                            const baseUrl = "{{ route('IndexMedicalHistory') }}";
                            const url = `${baseUrl}?schoolId=${encodeURIComponent(schoolId)}`;

                            // Redirect to the constructed URL
                            window.location.href = url;
                        }
                    }

                }


            });*/


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




            const detailedDataMap = @json($detailedDataMap);
            // console.log("detailedDataMap ", @json($detailedDataMap));



            function getDetailedData(dataValue) {

                console.log("dataValue ----- ", dataValue);

                // Define the detailed data map
                // const detailedDataMap = {
                //     '1': [5, 10],
                //     '2': [10],
                //     '3': [2, 2],

                // };

                // const detailedDataMap = {

                //     'The SET School': [5, 10],
                //     'Save The Future School': [10],
                //     'Kiran Foundation School': [2, 2],

                // };



                // Log the detailedDataMap object properly
                console.log("detailedDataMap:", detailedDataMap);

                // Log the specific data associated with dataValue
                // console.log("Data for value", dataValue, ":", detailedDataMap[dataValue]);

                // Return the data based on dataValue or a default value
                return detailedDataMap[dataValue] || [0, 0, 0, 0, 0, 0, 0, 0];
            }


            const detailedDataMap1 = @json($detailedDataMap1);
            // console.log("detailedDataMap1 ", @json($detailedDataMap1));


            let followUpChart2;

            function getDetailedData1(dataValue) {

                console.log("dataValue ----- ", dataValue);

                // Define the detailed data map
                // const detailedDataMap = {
                //     '1': [5, 10],
                //     '2': [10],
                //     '3': [2, 2],

                // };

                // const detailedDataMap = {

                //     'The SET School': [5, 10],
                //     'Save The Future School': [10],
                //     'Kiran Foundation School': [2, 2],

                // };



                // Log the detailedDataMap object properly
                console.log("detailedDataMap:", detailedDataMap);

                // Log the specific data associated with dataValue
                // console.log("Data for value", dataValue, ":", detailedDataMap[dataValue]);

                // Return the data based on dataValue or a default value
                return detailedDataMap[dataValue] || [0, 0, 0, 0, 0, 0, 0, 0];
            }

            const findingsChartCtx = document.getElementById('findingsChart');
            let delayed;

            // Example usage
            // console.log(getDetailedData('1')); // Should log [5, 10]

            let followUpChart1;
            const findingsChart = new Chart(findingsChartCtx, {
                type: 'bar',
                data: {

                    labels: @json($labels),
                    // labels: @json($labels1),
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



                    // onClick: (event, elements) => {

                    //     if (elements.length > 0) {

                    //         console.log(elements.length)
                    //         console.log(findingsChart.data)

                    //         const element = elements[0];
                    //         const datasetLabel = findingsChart.data.datasets[element.datasetIndex]
                    //             .label;
                    //         const dataLabel = findingsChart.data.labels[element.index];
                    //         const dataValue = findingsChart.data.datasets[element.datasetIndex].data[
                    //             element.index];

                    //         const datasetIndex = element.datasetIndex;
                    //         const backgroundColor = findingsChart.data.datasets[datasetIndex]
                    //             .backgroundColor;
                    //         const borderColor = findingsChart.data.datasets[datasetIndex].borderColor;

                    //         console.log("datasetLabel " + datasetLabel);
                    //         console.log("dataLabel " + dataLabel);
                    //         console.log("dataValue " + dataValue);

                    //         console.log("backgroundColor " + backgroundColor);
                    //         console.log("borderColor " + borderColor);


                    //         // Trigger the modal
                    //         // $('#followUpModal').modal('toggle');

                    //         // Update content or add a chart to the modal
                    //         document.querySelector('#followUpModal #modalContent').textContent =
                    //             `${datasetLabel}: ${dataLabel}, Value: ${dataValue}`;


                    //         setTimeout(() => {



                    //             if (followUpChart1) {
                    //                 followUpChart1.destroy();
                    //             }

                    //             let modalLabels = [];
                    //             let detailedData = [];

                    //             if (datasetLabel === "Physicians") {

                    //                 $('#followUpModal').modal('toggle');

                    //                 detailedData = getDetailedData(dataLabel);
                    //                 // detailedData =detailedDataMap;

                    //                 modalLabels = [

                    //                     'Blood Pressure (Systolic)',
                    //                     'Blood Pressure (Diastolic)',
                    //                     'Temperature',
                    //                     // 'Pulse rate',
                    //                     'Respiratory Rate',
                    //                     'Weight',
                    //                     'Height',
                    //                     'BMI'

                    //                 ];


                    //                 // Render a chart inside the modal (example)
                    //                 followUpChart1 = new Chart(document.getElementById(
                    //                     'followUpModalChart'), {
                    //                     type: 'bar', // or any other chart type
                    //                     data: {
                    //                         // labels: ['a', 'b', 'c', 'd', 'e', 'f', 'g','h'],
                    //                         labels: modalLabels,
                    //                         datasets: [{
                    //                             label: 'Detailed Data',
                    //                             // data: [10, 20, 30, 40, 50, 60, 70,80],
                    //                             data: detailedData,
                    //                             backgroundColor: backgroundColor,
                    //                             // backgroundColor: 'lightblue',
                    //                             // borderColor: 'blue',
                    //                             borderColor: borderColor,
                    //                             borderWidth: 1
                    //                         }]
                    //                     },
                    //                     options: {
                    //                         onClick: function(event, elements) {
                    //                             // Check if an element was clicked
                    //                             if (elements.length > 0) {
                    //                                 // Get the index of the clicked element
                    //                                 const index = elements[0].index;
                    //                                 // Get the label and data of the clicked element
                    //                                 const label = this.data.labels[index];
                    //                                 const value = this.data.datasets[0].data[index];

                    //                                 console.log(`Clicked on: ${label} with value: ${value}`);
                    //                             //    alert(`Clicked on: ${label} with value: ${value}`);

                    //                                 const baseUrl = "{{ route('IndexMedicalHistory') }}";
                    //                                 console.log(`baseUrl: ${baseUrl}`);

                                                    
                                                    

                    //                                 if(label == 'Blood Pressure (Systolic)')
                    //                                 {
                                                        
                    //                                     // const  url = `${baseUrl}?Blood_pressure_result=${encodeURIComponent(value)}`;
                    //                                     const  url = `${baseUrl}?Blood_pressure_result=Low`;
                                                                                                               
                    //                                     window.location.href = url;
                                                        
                    //                                 }
                    //                                 else if(label =='Blood Pressure (Diastolic)')
                    //                                 {
                                                        
                                                       

                    //                                     // const  url = `${baseUrl}?BloodPressureDiastolicResult=${encodeURIComponent(value)}`;
                    //                                     const  url = `${baseUrl}?BloodPressureDiastolicResult=Low`;
                    //                                     window.location.href = url;
                                                                                                               
                                                        
                    //                                 }
                    //                                 else if(label =='Temperature')
                    //                                 {
                                                        
                    //                                     // const  url = `${baseUrl}?TemperatureResult=${encodeURIComponent(value)}`;
                    //                                     const  url = `${baseUrl}?TemperatureResult=Low`;
                    //                                     window.location.href = url;
                                                                                                               
                                                        
                    //                                 }
                    //                                 else if(label =='Pulse rate')
                    //                                 {
                                                        
                                                    

                    //                                     // const  url = `${baseUrl}?PulseResult rate=${encodeURIComponent(value)}`;
                    //                                     // const  url = `${baseUrl}?PulseResult=Low`;
                    //                                     const  url = `${baseUrl}?PulseResult=Normal`;
                    //                                     window.location.href = url;
                                                                                                               
                                                        
                    //                                 }
                    //                                 else if(label =='Respiratory Rate')
                    //                                 {
                                                        

                                                       

                    //                                     // const  url = `${baseUrl}?RespiratoryRateResult rate=${encodeURIComponent(value)}`;
                    //                                     const  url = `${baseUrl}?RespiratoryRateResult=Low`;
                    //                                     window.location.href = url;
                                                                                                               
                                                        
                    //                                 }
                    //                                 else if(label =='Weight')
                    //                                 {
                                                        
                                                        

                    //                                     // const  url = `${baseUrl}?WeightResult rate=${encodeURIComponent(value)}`;
                    //                                     const  url = `${baseUrl}?WeightResult=Low`;
                    //                                     window.location.href = url;
                                                                                                               
                                                        
                    //                                 }
                    //                                 else if(label =='Height')
                    //                                 {

                    //                                     // const  url = `${baseUrl}?HeightResult rate=${encodeURIComponent(value)}`;
                    //                                     const  url = `${baseUrl}?HeightResult=Low`;
                    //                                     window.location.href = url;
                                                                                                               
                                                        
                    //                                 }
                    //                                 else if(label =='BMI')
                    //                                 {

                    //                                     // const  url = `${baseUrl}?BMIResult rate=${encodeURIComponent(value)}`;
                    //                                     const  url = `${baseUrl}?BMIResult=Low`;
                    //                                     window.location.href = url;
                                                                                                               
                                                        
                    //                                 }




                    //                                 // You can also update another part of your app or perform additional actions here
                    //                             }
                    //                         }
                    //                     }
                    //                 });

                    //             } else if (datasetLabel === "Nutritionist") {

                    //                 $('#followUpModal').modal('toggle');

                    //                 detailedData = getDetailedData1(dataLabel);
                    //                 // detailedData = detailedDataMap1;

                    //                 modalLabels = [

                    //                     'Height (cm)',
                    //                     'Weight (kg)',
                    //                     'BMI (auto-generated)',


                    //                 ];


                    //                 // Render a chart inside the modal (example)
                    //                 followUpChart1 = new Chart(document.getElementById(
                    //                     'followUpModalChart'), {
                    //                     type: 'bar', // or any other chart type
                    //                     data: {
                    //                         // labels: ['a', 'b', 'c', 'd', 'e', 'f', 'g','h'],
                    //                         labels: modalLabels,
                    //                         datasets: [{
                    //                             label: 'Detailed Data',
                    //                             // data: [10, 20, 30, 40, 50, 60, 70,80],
                    //                             data: detailedData,
                    //                             backgroundColor: backgroundColor,
                    //                             // backgroundColor: 'lightblue',
                    //                             // borderColor: 'blue',
                    //                             borderColor: borderColor,
                    //                             borderWidth: 1
                    //                         }]
                    //                     },
                    //                     options: {
                    //                         onClick: function(event, elements) {
                    //                             // Check if an element was clicked
                    //                             if (elements.length > 0) {
                    //                                 // Get the index of the clicked element
                    //                                 const index = elements[0].index;
                    //                                 // Get the label and data of the clicked element
                    //                                 const label = this.data.labels[
                    //                                     index];
                    //                                 const value = this.data
                    //                                     .datasets[0].data[index];

                    //                                 // Handle the click event (e.g., show an alert or perform some action)
                    //                                 alert(
                    //                                     `Clicked on: ${label} with value: ${value}`);

                    //                                 // You can also update another part of your app or perform additional actions here
                    //                             }
                    //                         }
                    //                     }

                    //                 });

                    //             } else {

                    //                 if (followUpChart1) {
                    //                     followUpChart1.destroy();
                    //                 }

                    //             }




                    //         }, 300);



                    //     }
                    // }


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
                    // onClick: (event, elements) => {
                    //     if (elements.length > 0) {
                    //         const element = elements[0];
                    //         const datasetLabel = chartInstance.data.datasets[element.datasetIndex]
                    //             .label;

                    //         const dataLabel = chartInstance.data.labels[element.index];
                    //         const dataValue = chartInstance.data.datasets[element.datasetIndex].data[
                    //             element.index];

                    //         // Determine which modal to open based on the label
                    //         if (datasetLabel === 'Internal') {
                    //             // Trigger the internal modal
                    //             $('#internalModal').modal('toggle');
                    //             // Update content or add a chart to the internal modal
                    //             document.getElementById('modalContentInternal').textContent =
                    //                 `Internal: ${dataLabel}, Value: ${dataValue}`;

                    //             setTimeout(() => {
                    //                 // Render a chart inside the internal modal (example)
                    //                 new Chart(document.getElementById('internalModalChart'), {
                    //                     type: 'bar', // or any other chart type
                    //                     data: {
                    //                         labels: ['a', 'b', 'c', 'd', 'e', 'f', 'g',
                    //                             'h'
                    //                         ],
                    //                         datasets: [{
                    //                             label: 'Internal Data',
                    //                             data: [10, 20, 30, 40, 50, 60,
                    //                                 70, 80
                    //                             ],
                    //                             backgroundColor: 'lightblue',
                    //                             borderColor: 'blue',
                    //                             borderWidth: 1
                    //                         }]
                    //                     }
                    //                 });
                    //             }, 300)

                    //         } else if (datasetLabel === 'External') {
                    //             // Trigger the external modal
                    //             $('#externalModal').modal('toggle');
                    //             // Update content or add a chart to the external modal
                    //             document.getElementById('modalContentExternal').textContent =
                    //                 `External: ${dataLabel}, Value: ${dataValue}`;

                    //             setTimeout(() => {
                    //                 // Render a chart inside the external modal (example)
                    //                 new Chart(document.getElementById('externalModalChart'), {
                    //                     type: 'bar', // or any other chart type
                    //                     data: {
                    //                         labels: ['a', 'b', 'c', 'd', 'e', 'f', 'g',
                    //                             'h'
                    //                         ],
                    //                         datasets: [{
                    //                             label: 'External Data',
                    //                             data: [15, 25, 35, 45, 55, 65,
                    //                                 75, 85
                    //                             ],
                    //                             backgroundColor: 'pink',
                    //                             borderColor: 'red',
                    //                             borderWidth: 1
                    //                         }]
                    //                     }
                    //                 });
                    //             }, 300)
                    //         }
                    //     }
                    // }
                }
            });



            const studentChartCtx = document.getElementById('studentChart');
            let studentDelay;
            new Chart(studentChartCtx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                            label: 'Total Students',
                            backgroundColor: "lightblue",
                            borderColor: "blue",
                            borderWidth: 1,
                            data: @json($entriesCount),

                        },
                        {
                            label: 'Screened Students',
                            backgroundColor: "lightgreen",
                            borderColor: "green",
                            borderWidth: 1,
                            data: @json($screenedData),

                        },
                        {
                            label: 'UnScreened Students',
                            backgroundColor: "pink",
                            borderColor: "red",
                            borderWidth: 1,
                            data: @json($unscreenedData),

                        },
                        {
                            label: 'Presenting Complains',
                            backgroundColor: "pink",
                            borderColor: "red",
                            borderWidth: 1,
                            data: @json($studentCount),

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
