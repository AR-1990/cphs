<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\form_entry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\School;
use App\Models\StudentBiodata;
use App\Models\FormData;
use App\Models\SchoolHealthPhysician;
use App\Models\NutritionistHistoryEvaluationSection;
use App\Models\PsychologistHistoryAssessmentSection;
use App\Models\MedicalHistory;
use DataTables;

class AdminDashBoardController extends Controller
{
    //

    public function student_findings()
    {


        return view("admin.findings3");
    }


    public function getQuestionsData()
    {

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

        $data = [];
        $schoolid= json_decode(auth()->guard('admin')->user()?->school_id);
// dd($schoolid[0]);
        $count1 = 1;
        foreach ($questions as $key => $question) {


            /*$FormData1 = FormData::where('key', $question['key'])->get()->toArray();
            if(!empty($FormData1))
            {
                foreach($FormData1 as $key2=>$value2)
                {

                     $findings = form_entry::where("id", $value2['entry_id'])->count();
                     if(!empty($findings) && $findings > 0)
                     {

                     }

                }
            }*/


            // $query = FormData::where('key', $question['key']);


            $query = FormData::join('form_entries', 'form_data.entry_id', '=', 'form_entries.id')
                ->where('form_data.key', $question['key'])
                ->whereIn('form_entries.school', $schoolid);


            if (is_array($question['value'])) {
                $count = $query->whereIn('value', $question['value'])->count();
            } elseif ($question['value'] !== null) {
                $count = $query->where('value', $question['value'])->count();
            } elseif ($question['value'] == null) {
                $count = $query->where('value', $question['value'])->count();
            } else {
                $count = $query->count();
            }



            $data[] = [
                'id' => count($data),
                'entryId' => $count1,
                'question' => $question['key'],
                'label' => $question['label'],
                'question_key' => $question['value'],
                'count' => $count,
            ];

            $count1++;
        }
// dd($data['entryId']);
        return DataTables::of($data)->make(true);
    }

    public function getQuestionData(Request $request)
    {
        $question = $request->input('question');
        $question_key = $request->input("question_key");

        // dd($request->input("entry_id"));

        if ($question_key !== null) {
            $question_key = explode(",", $question_key);

        }


        $entryIds = FormData::where('key', $question);

        if (is_array($question_key)) {
            // echo "HERE 1"; exit;
            // dd($question_key);

            $entryIds = $entryIds->whereIn('value', $question_key);


        } elseif ($question_key == null) {
            // echo "HERE 2"; exit;

            $entryIds = $entryIds->where('value', $question_key);



        } else {
            // echo "HERE 3"; exit;

            $entryIds = $entryIds->where('value', $question_key);

        }



        $entryIds = $entryIds->pluck('entry_id');
        // dd($entryIds);

        if ($entryIds->isEmpty()) {
            return DataTables::of([])->make(true);
        }
        $schoolid= json_decode(auth()->guard('admin')->user()?->school_id);
        $findings = form_entry::whereIn("school", $schoolid)->whereIn("id", $entryIds)->get()->toArray();


        return DataTables::of($findings)->make(true);
    }


    public function dashboard1()
    {

        return view('admin.dashboard1');

    }
    public function schoolDashboard()
    {

        return view('admin.schoolDashboard');

    }
    public function mainDashboard()
    {

        return view('admin.mainDashboard');

    }


    /* schoolDashboard2 */

    public function schoolDashboard2()
    {

        return view('admin.schoolDashboard2');

    }


    /* schoolDashboard1 */

    public function schoolDashboard1()
    {

        return view('admin.schoolDashboard1');

    }
    public function index()
    {



        $enter_by = Auth::guard('admin')->user()->id;
        $role = Auth::guard('admin')->user()->role;
        if ($role == '1') {

           $schools = \Illuminate\Support\Facades\DB::table('schools')
        ->select('school_name', 'created_at')
        // ->whereNull('deleted')
        // ->orWhere('deleted', 0)
        ->get();

    $collabSchoolLabels = [];
    $daysSinceSchool = [];
    foreach ($schools as $s) {
        $collabSchoolLabels[] = $s->school_name ?? '';
        $daysSinceSchool[] = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($s->created_at));
    }

    $schoolTurnoverRows = \Illuminate\Support\Facades\DB::table('schools')
        ->select('id','school_name','turnover')
        ->get();

    $studentLabels = [];
    $studentTotals = [];
    $studentScreened = [];
    $studentMonthlyBreakdown = [];
    $presentingTotals = [];
    foreach ($schoolTurnoverRows as $sch) {
        $studentLabels[] = $sch->school_name;
        $totalCount = DB::table('form_entries')
            ->where('school', $sch->id)
            
            ->whereRaw('CAST(COALESCE(NULLIF(screeningFormId, ""), "0") AS SIGNED) = 0')
            ->count();
        $screenedCount = DB::table('form_entries')
            ->where('school', $sch->id)
            ->count();
        $studentTotals[] = $totalCount;
        $studentScreened[] = $screenedCount;

        $turnoverMonth = is_null($sch->turnover) ? null : (int)$sch->turnover;

        if ($turnoverMonth && $turnoverMonth >= 1 && $turnoverMonth <= 12) {
            $cycleStart = \Carbon\Carbon::createFromDate(\Carbon\Carbon::now()->year, $turnoverMonth, 1)->startOfMonth();
            $cycleEnd = $cycleStart->copy()->addMonths(12)->endOfMonth();
            $months = [];
            
            for ($i=0; $i<12; $i++) { $months[] = $cycleStart->copy()->addMonths($i)->format('M Y'); }

            $totalRows = DB::table('form_entries')
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as ym, COUNT(*) as cnt')
                ->where('school', $sch->id)
                ->whereRaw('CAST(COALESCE(NULLIF(screeningFormId, ""), "0") AS SIGNED) = 0')
                // ->whereBetween('created_at', [$cycleStart, $cycleEnd])
                ->groupBy('ym')
                ->get();
            $totalsMap = [];
            foreach ($totalRows as $r) { $totalsMap[$r->ym] = (int)$r->cnt; }

            $screenedRows = DB::table('form_entries')
                ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as ym, COUNT(*) as cnt')
                ->where('school', $sch->id)
                ->whereBetween('created_at', [$cycleStart, $cycleEnd])
                // ->whereRaw('CAST(COALESCE(NULLIF(screeningFormId, ""), "0") AS SIGNED) > 0')
                ->groupBy('ym')
                ->get();
                // dd($cycleStart);
            $screenedMap = [];
            foreach ($screenedRows as $r) { $screenedMap[$r->ym] = (int)$r->cnt; }

            $totalsByMonth = [];
            $screenedByMonth = [];
            for ($i=0; $i<12; $i++) {
                $ym = $cycleStart->copy()->addMonths($i)->format('Y-m');
                $totalsByMonth[] = $totalsMap[$ym] ?? 0;
                $screenedByMonth[] = $screenedMap[$ym] ?? 0;
            }
            $studentMonthlyBreakdown[$sch->school_name] = [
                'months' => $months,
                'total' => $totalsByMonth,
                'screened' => $screenedByMonth,
            ];
            // dd( $studentMonthlyBreakdown);
            $cycleEntryIds = DB::table('form_entries')
                ->where('school', $sch->id)
                ->whereBetween('created_at', [$cycleStart, $cycleEnd])
                ->pluck('id')
                ->all();
            $screenedCountHeight = 0;
            if (!empty($cycleEntryIds)) {
                $screenedCountHeight = DB::table('form_data')
                    ->whereIn('entry_id', $cycleEntryIds)
                    ->where('key', 'Question_No_1_Height')
                    ->whereNotNull('value')
                    ->where('value', '!=', '')
                    ->distinct('entry_id')
                    ->count('entry_id');
            }
            $studentScreened[count($studentScreened)-1] = (int)$screenedCountHeight;
            $res = DB::table('form_entries')
                ->join('schools', 'form_entries.school', '=', 'schools.id')
                ->join('form_data', 'form_entries.id', '=', 'form_data.entry_id')
                ->select(
                    'schools.id',
                    'schools.school_name',
                    DB::raw('COUNT(CASE WHEN form_data.key = "Question_No_8_Normal_Posture_Gait" AND form_data.value = "No" THEN form_entries.id END) as NormalPostureCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_9_Mental_Status", "Question_No_8_Mental_Status") AND form_data.value = "Lethargic" THEN form_entries.id END) as MentalStatusCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_10_Look_For_jaundice", "Question_No_9_Look_For_jaundice") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as jaundiceCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_11_Look_For_Clubbing", "Question_No_12_Look_For_Clubbing") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as clubingCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_14_Skin", "Question_No_13_Skin") AND form_data.value IN ("Rash","Allergy","Lesion","Bruises") THEN form_entries.id END) as skinCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_16_Nails", "Question_No_15_Nails") AND form_data.value IN ("Dirty","dirty") THEN form_entries.id END) as nailCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_18_Lice_nits", "Question_No_17_Lice/nits") AND form_data.value IN ("yes","Yes") THEN form_entries.id END) as liceCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_20_Hair_and_Scalp", "Question_No_19_Hair_and_Scalp") AND form_data.value IN ("Color-faded") THEN form_entries.id END) as hairCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_22_Scalp", "Question_No_22_Scalp") AND form_data.value IN ("Scaly","Dry","Moist") THEN form_entries.id END) as ScalpCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_25_Normal_ocular_alignment", "Question_No_22_Normal_ocular_alignment") AND form_data.value IN ("no","No") THEN form_entries.id END) as ocularCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_28_Nystagmus", "Question_No_25_Nystagmus") AND form_data.value IN ("yes","Yes") THEN form_entries.id END) as NystagmusCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_27_Ear_examination", "Question_No_30_Ear_examination") AND form_data.value IN ("Ear wax","Canal infection") THEN form_entries.id END) as EarExaminationCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_32_External_nasal_examinaton", "Question_No_29_External_inasal_examinaton") AND form_data.value IN ("Deformities", "Swelling","Redness","Lesions","Nasal Discharge","Crusting") THEN form_entries.id END) as ExaminationNasalCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_34_Assess_gingiva", "Question_No_31_Assess_gingiva") AND form_data.value IN ("Infection", "Bleed") THEN form_entries.id END) as assesCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_36_Examine_tonsils", "Question_No_34_Examine_tonsils") AND form_data.value IN ("tonsillitis", "Tonsillitis") THEN form_entries.id END) as ExamineTonsileCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_36_Any_Neck_swelling", "Question_No_38_Any_Neck_swelling") AND form_data.value IN ("yes", "Yes") THEN form_entries.id END) as NeckSwelingCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_38_Any_visible_chest_deformity", "Question_No_40_Any_visible_chest_deformity") AND form_data.value IN ("yes", "Yes") THEN form_entries.id END) as ChestDeformatyCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_42_Cardiac_Auscultation", "Question_No_40_Cardiac_Auscultation") AND form_data.value IN ("Murmur", "murmur") THEN form_entries.id END) as CardiacAuscultationCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination", "Question_No_43_Did_you_observe_any_limitations_in_the_child") AND form_data.value IN ("Yes", "yes") THEN form_entries.id END) as jointMotionCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("question_no_47_side-to-side_curvature_in_the_spine_resembling", "Question_No_47_side_to_side_curvature_in_the_spine_resembling") AND form_data.value IN ("C_Shape", "S_Shape") THEN form_entries.id END) as side_to_side_curvatureCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_47_Any_foot_or_toe_abnormalities", "Question_No_49_Any_foot_or_toe_abnormalities") AND form_data.value IN ("Flat Feet","Varus","Valgus","High Arch","Hammer Toe","Bunion") THEN form_entries.id END) as footOrToeCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_54_Do_you_have_any_Allergies", "Question_No_55_Do_you_have_any_Allergies") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as AllergiesCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("bmiresult", "bmiresult") AND form_data.value IN ("High","Low") THEN form_entries.id END) as bmiresultCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_11_Look_For_anemia", "Question_No_10_Look_For_anemia") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as anemiaCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_24_Normal_Color_vision", "Question_No_27_Normal_Color_vision") AND form_data.value IN ("No","no") THEN form_entries.id END) as ColorVisionCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_32_Are_there_dental_caries", "Question_No_35_Are_there_dental_caries") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as cariesCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_15_Breath", "Question_No_14_Breath") AND form_data.value IN ("Bad Breath","Bad Breath") THEN form_entries.id END) as BreathCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_19_Discuss_hygiene_routines_and_practices", "Question_No_18_Discuss_hygiene_routines_and_practices") AND form_data.value IN ("not-aware","not-aware") THEN form_entries.id END) as DiscussHygieneCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_17_Uniform_or_shoes", "Question_No_16_Uniform_or_shoes") AND form_data.value IN ("Untidy","Untidy") THEN form_entries.id END) as UniformCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_21_Any_Hair_Problem", "Question_No_21_Any_Hair_Problem") AND form_data.value IN ("Kinky","Brittle","Dry") THEN form_entries.id END) as HairProblemCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_29_Normal_ears_shape_and_position", "Question_No_26_Normal_ears_shape_and_position") AND form_data.value IN ("No","no") THEN form_entries.id END) as EarShapeCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber", "Question_No_28_Conclusion_of_hearing_test_with_Rinner_and_Weber") AND form_data.value IN ("right_ear_conductive_hearing_loss","left_ear_conductive_hearing_loss","right_ear_sensorineural_hearing_lossleft_ear_sensorineural_hearing_loss") THEN form_entries.id END) as RinnerWeberCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_33_perform_a_nasal_patency_test") AND form_data.value IN ("DNS","Obstruction") THEN form_entries.id END) as potensyTestCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_37_Normal_Speech_development","Question_No_35_Normal_Speech_development") AND form_data.value IN ("No","no") THEN form_entries.id END) as SpeechDevCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_41_Lung_Auscultation","Question_No_39_Lung_Auscultation") AND form_data.value IN ("Ronchi","Wheezing","Crackles","Vesicular Diminished Breath Sound(specify)") THEN form_entries.id END) as LungAuscultationCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen") AND form_data.value IN ("Distention","Scar","Mass") THEN form_entries.id END) as ScarsMassesCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_46_Spinal_curvature_assessment_tick_positive_finding","Question_No_44_Spinal_curvature_assessment_(tick_positive_finding)") AND form_data.value IN ("Uneven shoulders","Shoulder Blade","Uneven waist","Hips") THEN form_entries.id END) as SpinalCurvatureCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_50_Have_EPI_immunization_card","Question_No_48_Have_EPI_immunization_card?") AND form_data.value IN ("No","no") THEN form_entries.id END) as EpiCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_57_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination","Question_No_56_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination") AND form_data.value IN ("Urinary frequency","Urinary urgency","Pain or discomfort during urination","Nocturnal enuresis") THEN form_entries.id END) as DiscomfortDuringUrinationCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("QuestionNo_58_Any_menstrual_abnormality","QuestionNo_57_Any_menstrual_abnormality") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as MenstrualAbnormalityCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_60_How_would_you_describe_your_lifestyle") AND form_data.value IN ("Sedentary") THEN form_entries.id END) as lifestyleCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as addictionCount')
                )
                ->where('schools.id', $sch->id)
                ->whereBetween('form_entries.created_at', [$cycleStart, $cycleEnd])
                ->groupBy('schools.id', 'schools.school_name')
                ->get();
            $totMap = [];
            foreach ($res as $school) {
                $rowTotal = (
                    $school->NormalPostureCount +
                    $school->jaundiceCount +
                    $school->clubingCount +
                    $school->skinCount +
                    $school->nailCount +
                    $school->liceCount +
                    $school->hairCount +
                    $school->ScalpCount +
                    $school->ocularCount +
                    $school->NystagmusCount +
                    $school->EarExaminationCount +
                    $school->ExaminationNasalCount +
                    $school->assesCount +
                    $school->ExamineTonsileCount +
                    $school->NeckSwelingCount +
                    $school->ChestDeformatyCount +
                    $school->CardiacAuscultationCount +
                    $school->jointMotionCount +
                    $school->side_to_side_curvatureCount +
                    $school->footOrToeCount +
                    $school->AllergiesCount +
                    $school->bmiresultCount +
                    $school->anemiaCount +
                    $school->ColorVisionCount +
                    $school->cariesCount +
                    $school->BreathCount +
                    $school->DiscussHygieneCount +
                    $school->UniformCount +
                    $school->HairProblemCount +
                    $school->EarShapeCount +
                    $school->RinnerWeberCount +
                    $school->potensyTestCount +
                    $school->SpeechDevCount +
                    $school->LungAuscultationCount +
                    $school->ScarsMassesCount +
                    $school->SpinalCurvatureCount +
                    $school->EpiCount +
                    $school->DiscomfortDuringUrinationCount +
                    $school->MenstrualAbnormalityCount +
                    $school->lifestyleCount +
                    $school->addictionCount
                );
                $totMap[$school->school_name] = $rowTotal;
            }
            $presentingTotals[] = (int)($totMap[$sch->school_name] ?? 0);
        }
        else {
            // For non-turnover schools, compute screened students (height-based) without cycle filter
            $allEntryIds = DB::table('form_entries')
                ->where('school', $sch->id)
                ->pluck('id')
                ->all();
            $screenedCountHeightAll = 0;
            if (!empty($allEntryIds)) {
                $screenedCountHeightAll = DB::table('form_data')
                    ->whereIn('entry_id', $allEntryIds)
                    ->where('key', 'Question_No_1_Height')
                    ->whereNotNull('value')
                    ->where('value', '!=', '')
                    ->distinct('entry_id')
                    ->count('entry_id');
            }
            $studentScreened[count($studentScreened)-1] = (int)$screenedCountHeightAll;
            $res = DB::table('form_entries')
                ->join('schools', 'form_entries.school', '=', 'schools.id')
                ->join('form_data', 'form_entries.id', '=', 'form_data.entry_id')
                ->select(
                    'schools.id',
                    'schools.school_name',
                    DB::raw('COUNT(CASE WHEN form_data.key = "Question_No_8_Normal_Posture_Gait" AND form_data.value = "No" THEN form_entries.id END) as NormalPostureCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_9_Mental_Status", "Question_No_8_Mental_Status") AND form_data.value = "Lethargic" THEN form_entries.id END) as MentalStatusCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_10_Look_For_jaundice", "Question_No_9_Look_For_jaundice") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as jaundiceCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_11_Look_For_Clubbing", "Question_No_12_Look_For_Clubbing") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as clubingCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_14_Skin", "Question_No_13_Skin") AND form_data.value IN ("Rash","Allergy","Lesion","Bruises") THEN form_entries.id END) as skinCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_16_Nails", "Question_No_15_Nails") AND form_data.value IN ("Dirty","dirty") THEN form_entries.id END) as nailCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_18_Lice_nits", "Question_No_17_Lice/nits") AND form_data.value IN ("yes","Yes") THEN form_entries.id END) as liceCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_20_Hair_and_Scalp", "Question_No_19_Hair_and_Scalp") AND form_data.value IN ("Color-faded") THEN form_entries.id END) as hairCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_22_Scalp", "Question_No_22_Scalp") AND form_data.value IN ("Scaly","Dry","Moist") THEN form_entries.id END) as ScalpCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_25_Normal_ocular_alignment", "Question_No_22_Normal_ocular_alignment") AND form_data.value IN ("no","No") THEN form_entries.id END) as ocularCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_28_Nystagmus", "Question_No_25_Nystagmus") AND form_data.value IN ("yes","Yes") THEN form_entries.id END) as NystagmusCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_27_Ear_examination", "Question_No_30_Ear_examination") AND form_data.value IN ("Ear wax","Canal infection") THEN form_entries.id END) as EarExaminationCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_32_External_nasal_examinaton", "Question_No_29_External_inasal_examinaton") AND form_data.value IN ("Deformities", "Swelling","Redness","Lesions","Nasal Discharge","Crusting") THEN form_entries.id END) as ExaminationNasalCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_34_Assess_gingiva", "Question_No_31_Assess_gingiva") AND form_data.value IN ("Infection", "Bleed") THEN form_entries.id END) as assesCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_36_Examine_tonsils", "Question_No_34_Examine_tonsils") AND form_data.value IN ("tonsillitis", "Tonsillitis") THEN form_entries.id END) as ExamineTonsileCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_36_Any_Neck_swelling", "Question_No_38_Any_Neck_swelling") AND form_data.value IN ("yes", "Yes") THEN form_entries.id END) as NeckSwelingCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_38_Any_visible_chest_deformity", "Question_No_40_Any_visible_chest_deformity") AND form_data.value IN ("yes", "Yes") THEN form_entries.id END) as ChestDeformatyCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_42_Cardiac_Auscultation", "Question_No_40_Cardiac_Auscultation") AND form_data.value IN ("Murmur", "murmur") THEN form_entries.id END) as CardiacAuscultationCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_45_Did_you_observe_any_limitations_in_the_child_s_range_of_joint_motion_during_your_examination", "Question_No_43_Did_you_observe_any_limitations_in_the_child") AND form_data.value IN ("Yes", "yes") THEN form_entries.id END) as jointMotionCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("question_no_47_side-to-side_curvature_in_the_spine_resembling", "Question_No_47_side_to_side_curvature_in_the_spine_resembling") AND form_data.value IN ("C_Shape", "S_Shape") THEN form_entries.id END) as side_to_side_curvatureCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_47_Any_foot_or_toe_abnormalities", "Question_No_49_Any_foot_or_toe_abnormalities") AND form_data.value IN ("Flat Feet","Varus","Valgus","High Arch","Hammer Toe","Bunion") THEN form_entries.id END) as footOrToeCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_54_Do_you_have_any_Allergies", "Question_No_55_Do_you_have_any_Allergies") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as AllergiesCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("bmiresult", "bmiresult") AND form_data.value IN ("High","Low") THEN form_entries.id END) as bmiresultCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_11_Look_For_anemia", "Question_No_10_Look_For_anemia") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as anemiaCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_24_Normal_Color_vision", "Question_No_27_Normal_Color_vision") AND form_data.value IN ("No","no") THEN form_entries.id END) as ColorVisionCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_32_Are_there_dental_caries", "Question_No_35_Are_there_dental_caries") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as cariesCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_15_Breath", "Question_No_14_Breath") AND form_data.value IN ("Bad Breath","Bad Breath") THEN form_entries.id END) as BreathCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_19_Discuss_hygiene_routines_and_practices", "Question_No_18_Discuss_hygiene_routines_and_practices") AND form_data.value IN ("not-aware","not-aware") THEN form_entries.id END) as DiscussHygieneCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_17_Uniform_or_shoes", "Question_No_16_Uniform_or_shoes") AND form_data.value IN ("Untidy","Untidy") THEN form_entries.id END) as UniformCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_21_Any_Hair_Problem", "Question_No_21_Any_Hair_Problem") AND form_data.value IN ("Kinky","Brittle","Dry") THEN form_entries.id END) as HairProblemCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_29_Normal_ears_shape_and_position", "Question_No_26_Normal_ears_shape_and_position") AND form_data.value IN ("No","no") THEN form_entries.id END) as EarShapeCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_31_Conclusion_of_hearing_test_with_Rinner_and_Weber", "Question_No_28_Conclusion_of_hearing_test_with_Rinner_and_Weber") AND form_data.value IN ("right_ear_conductive_hearing_loss","left_ear_conductive_hearing_loss","right_ear_sensorineural_hearing_lossleft_ear_sensorineural_hearing_loss") THEN form_entries.id END) as RinnerWeberCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_33_perform_a_nasal_patency_test") AND form_data.value IN ("DNS","Obstruction") THEN form_entries.id END) as potensyTestCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_37_Normal_Speech_development","Question_No_35_Normal_Speech_development") AND form_data.value IN ("No","no") THEN form_entries.id END) as SpeechDevCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_41_Lung_Auscultation","Question_No_39_Lung_Auscultation") AND form_data.value IN ("Ronchi","Wheezing","Crackles","Vesicular Diminished Breath Sound(specify)") THEN form_entries.id END) as LungAuscultationCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_no_43_did_you_observe_any_distension_scars_or_masses_on_the_childs_abdomen") AND form_data.value IN ("Distention","Scar","Mass") THEN form_entries.id END) as ScarsMassesCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_46_Spinal_curvature_assessment_tick_positive_finding","Question_No_44_Spinal_curvature_assessment_(tick_positive_finding)") AND form_data.value IN ("Uneven shoulders","Shoulder Blade","Uneven waist","Hips") THEN form_entries.id END) as SpinalCurvatureCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_50_Have_EPI_immunization_card","Question_No_48_Have_EPI_immunization_card?") AND form_data.value IN ("No","no") THEN form_entries.id END) as EpiCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_57_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination","Question_No_56_Inquire_about_urinary_frequency,_urgency,_and_any_pain_or_discomfort_during_urination") AND form_data.value IN ("Urinary frequency","Urinary urgency","Pain or discomfort during urination","Nocturnal enuresis") THEN form_entries.id END) as DiscomfortDuringUrinationCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("QuestionNo_58_Any_menstrual_abnormality","QuestionNo_57_Any_menstrual_abnormality") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as MenstrualAbnormalityCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No_60_How_would_you_describe_your_lifestyle") AND form_data.value IN ("Sedentary") THEN form_entries.id END) as lifestyleCount'),
                    DB::raw('COUNT(CASE WHEN form_data.key IN ("Question_No66_Does_the_child_have_any_history_of_substances_abuse_or_addiction_to") AND form_data.value IN ("Yes","yes") THEN form_entries.id END) as addictionCount')
                )
                ->where('schools.id', $sch->id)
                ->groupBy('schools.id', 'schools.school_name')
                ->get();
                
            $totMap = [];
            foreach ($res as $school) {
                $rowTotal = (
                    $school->NormalPostureCount +
                    $school->jaundiceCount +
                    $school->clubingCount +
                    $school->skinCount +
                    $school->nailCount +
                    $school->liceCount +
                    $school->hairCount +
                    $school->ScalpCount +
                    $school->ocularCount +
                    $school->NystagmusCount +
                    $school->EarExaminationCount +
                    $school->ExaminationNasalCount +
                    $school->assesCount +
                    $school->ExamineTonsileCount +
                    $school->NeckSwelingCount +
                    $school->ChestDeformatyCount +
                    $school->CardiacAuscultationCount +
                    $school->jointMotionCount +
                    $school->side_to_side_curvatureCount +
                    $school->footOrToeCount +
                    $school->AllergiesCount +
                    $school->bmiresultCount +
                    $school->anemiaCount +
                    $school->ColorVisionCount +
                    $school->cariesCount +
                    $school->BreathCount +
                    $school->DiscussHygieneCount +
                    $school->UniformCount +
                    $school->HairProblemCount +
                    $school->EarShapeCount +
                    $school->RinnerWeberCount +
                    $school->potensyTestCount +
                    $school->SpeechDevCount +
                    $school->LungAuscultationCount +
                    $school->ScarsMassesCount +
                    $school->SpinalCurvatureCount +
                    $school->EpiCount +
                    $school->DiscomfortDuringUrinationCount +
                    $school->MenstrualAbnormalityCount +
                    $school->lifestyleCount +
                    $school->addictionCount
                );
                $totMap[$school->school_name] = $rowTotal;
            }
            $presentingTotals[] = (int)($totMap[$sch->school_name] ?? 0);
        }
    }

    $start = \Carbon\Carbon::now()->subMonths(11)->startOfMonth();
    $monthKeys = [];
    for ($i = 0; $i < 12; $i++) {
        $monthKeys[] = \Carbon\Carbon::now()->subMonths(11 - $i)->format('Y-m');
    }
    $emailRows = DB::table('medical_history_emails')
        ->leftJoin('schools', function($join){
            $join->on(DB::raw('LOWER(TRIM(schools.email))'), '=', DB::raw('LOWER(TRIM(medical_history_emails.to))'));
        })
        ->where('medical_history_emails.status', 1)
        ->where('medical_history_emails.created_at', '>=', $start)
        ->whereNotNull('schools.school_name')
        ->select('schools.school_name as school', DB::raw('DATE_FORMAT(medical_history_emails.created_at, "%Y-%m") as ym'), DB::raw('COUNT(*) as cnt'))
        ->groupBy('school', 'ym')
        ->get();
        // dd($emailRows );
    $emailMap = [];
    $schoolTotals = [];
    foreach ($emailRows as $r) {
        if (!isset($emailMap[$r->school])) $emailMap[$r->school] = [];
        $emailMap[$r->school][$r->ym] = (int)$r->cnt;
        $schoolTotals[$r->school] = ($schoolTotals[$r->school] ?? 0) + (int)$r->cnt;
    }
    arsort($schoolTotals);
    $topSchools = array_slice(array_keys($schoolTotals), 0, 8);
    $emailMonthsLabels = [];
    foreach ($monthKeys as $ym) {
        $emailMonthsLabels[] = \Carbon\Carbon::createFromFormat('Y-m', $ym)->format('F Y');
    }
    $palette = [
        ['borderColor' => 'rgba(255,99,132,1)', 'backgroundColor' => 'rgba(255,99,132,0.2)'],
        ['borderColor' => 'rgba(54,162,235,1)', 'backgroundColor' => 'rgba(54,162,235,0.2)'],
        ['borderColor' => 'rgba(255,206,86,1)', 'backgroundColor' => 'rgba(255,206,86,0.2)'],
        ['borderColor' => 'rgba(75,192,192,1)', 'backgroundColor' => 'rgba(75,192,192,0.2)'],
        ['borderColor' => 'rgba(153,102,255,1)', 'backgroundColor' => 'rgba(153,102,255,0.2)'],
        ['borderColor' => 'rgba(255,159,64,1)', 'backgroundColor' => 'rgba(255,159,64,0.2)'],
        ['borderColor' => 'rgba(199,199,199,1)', 'backgroundColor' => 'rgba(199,199,199,0.2)'],
        ['borderColor' => 'rgba(0,123,255,1)', 'backgroundColor' => 'rgba(0,123,255,0.2)'],
    ];
    $emailSeries = [];
    $pi = 0;
    foreach ($topSchools as $school) {
        $data = [];
        foreach ($monthKeys as $ym) {
            $data[] = (int)($emailMap[$school][$ym] ?? 0);
        }
        $colors = $palette[$pi % count($palette)];
        $emailSeries[] = [
            'label' => $school,
            'borderColor' => $colors['borderColor'],
            'backgroundColor' => $colors['backgroundColor'],
            'borderWidth' => 2,
            'data' => $data,
        ];
        $pi++;
    }
    if (empty($emailSeries) && !empty($emailRows)) {
        $sumByMonth = [];
        foreach ($emailRows as $r) {
            $sumByMonth[$r->ym] = ($sumByMonth[$r->ym] ?? 0) + (int)$r->cnt;
        }
        $data = [];
        foreach ($monthKeys as $ym) {
            $data[] = (int)($sumByMonth[$ym] ?? 0);
        }
        $emailSeries[] = [
            'label' => 'All Schools',
            'borderColor' => 'rgba(54,162,235,1)',
            'backgroundColor' => 'rgba(54,162,235,0.2)',
            'borderWidth' => 2,
            'data' => $data,
        ];
    }
    return view("admin.main-dashboard", [
        'collabSchoolLabels' => $collabSchoolLabels,
        'daysSinceSchool' => $daysSinceSchool,
        'emailMonthsLabels' => $emailMonthsLabels,
        'emailSeries' => $emailSeries,
        'studentLabels' => $studentLabels,
        'studentTotals' => $studentTotals,
        'studentScreened' => $studentScreened,
        'studentMonthlyBreakdown' => $studentMonthlyBreakdown,
        'presentingTotals' => $presentingTotals,
    ]);

        } else if ($role == 3) {


            return view('admin.schoolDashboard2');


        } else {
            $data1['total_entries1'] = form_entry::where('enterby', $enter_by)->count();
            return view('admin.indexdoctor', $data1);
        }

    }
}
