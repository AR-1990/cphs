<?php



namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Session;
use Str;
use Illuminate\Support\Facades\Auth;
use App\Models\CalendarEvents;
use App\Models\form_entry;
use App\Models\School;


class CalendarController extends Controller
{

    public function index(Request $request)
    {
        if ($request->isMethod('post')) {

            $dataArr = $request->all();

            // echo "<PRE>";
            // print_r($dataArr);
            // exit;

            $rules = array(
                'title' => 'required',
                'startDate' => 'required',
                // 'endDate' => 'required',
                'color' => 'required',


            );


            $this->validate($request, $rules);

            $title = (isset($dataArr['title']) && !empty($dataArr['title'])) ? trim($dataArr['title']) : null;
            $startDate = (isset($dataArr['startDate']) && !empty($dataArr['startDate'])) ? trim($dataArr['startDate']) : null;
            $endDate = (isset($dataArr['endDate']) && !empty($dataArr['endDate'])) ? trim($dataArr['endDate']) : null;
            $color = (isset($dataArr['color']) && !empty($dataArr['color'])) ? trim($dataArr['color']) : null;
            $UpdateID = (isset($dataArr['UpdateID']) && !empty($dataArr['UpdateID'])) ? trim($dataArr['UpdateID']) : 0;

            $CalendarEvents = new CalendarEvents();

            if ($UpdateID > 0) {
                $CalendarEvents = CalendarEvents::find($UpdateID);
            }
            $CalendarEvents->title = $title;
            $CalendarEvents->slug = Str::slug($title, '-');
            $CalendarEvents->startDate = $startDate;
            $CalendarEvents->endDate = $endDate;
            $CalendarEvents->color = $color;


            if ($UpdateID > 0) {
                $CalendarEvents->updated_by = Auth::user()->id;

            } else {
                $CalendarEvents->created_by = Auth::user()->id;

            }

            $CalendarEvents->save();



            if ($UpdateID > 0) {
                $CalendarEventsReturnID = $UpdateID;
                $message = "Event Updated Successfully";

            } else {
                $CalendarEventsReturnID = DB::getPdo()->lastInsertId();
                $message = "Event Create Successfully";

            }



            return response()->json(
                array(
                    'status' => true,
                    'message' => $message,
                    'CalendarEventsReturnID' => $CalendarEventsReturnID,
                )
            );
        }

        $CalendarEventsArr = array();
        $CalendarEvents = CalendarEvents::where('deleted', 0)->get()->toArray();
        if (!empty($CalendarEvents)) {
            foreach ($CalendarEvents as $CalendarEvent) {
                $CalendarEventsID = $CalendarEvent['id'];

                $title = $CalendarEvent['title'];
                $start = $CalendarEvent['startDate'];
                $end = $CalendarEvent['endDate'];
                $color = $CalendarEvent['color'];
                $description = $CalendarEvent['description'];
                $event_type = $CalendarEvent['event_type'];
                $redirect_link = $CalendarEvent['redirect_link'];
                $event_id = $CalendarEvent['event_id'];

                $custom_param1 = "N/A";
                /* Screening  = event_type 2 */
                if($event_type==2)
                {
                    $form_entry = form_entry::where('id', $event_id)->first();
                    if(!empty($form_entry))
                    {

                        $School = School::where('id',$form_entry['school'])->first();
                        if(!empty($School))
                        {
                            $custom_param1 = $School['school_name'];

                        }
                    }

                }

                $CalendarEventsArr[] = array(

                    'id' => $CalendarEventsID,
                    'title' => $title,
                    'start' => $start,
                    'end' => $end,
                    'color' => $color,
                    'description' => $description,
                    'event_type' => $event_type,
                    'event_id' => $event_id,
                    'redirect_link' => $redirect_link,
                    'extraParams' => array(
                        'custom_param1' => $custom_param1,  // Additional custom parameter 1
                        'custom_param2' => 'somethingelse'  // Additional custom parameter 2
                    )

                );
            }
        }

        // echo json_encode($CalendarEventsArr);exit;

        return view("Calendar.index")->with(compact('CalendarEvents', 'CalendarEventsArr'));
    }


    public function Delete(Request $request)
    {

        if ($request->isMethod('post')) {

            $dataArr = $request->all();

            //                echo "<PRE>";
            //    print_r($dataArr);
            //    exit;

            $returnAffected = CalendarEvents::where('id', $dataArr['id'])->update(array('deleted' => 1, 'updated_by' => Auth::user()->id));

            if ($returnAffected === 0) {
                $message = "Some Issue Occurs try later";
                return response()->json(
                    array(
                        'status' => false,
                        'message' => $message,
                    )
                );
            }

            $message = "Deleted successfully";

            return response()->json(
                array(
                    'status' => true,
                    'message' => $message,
                    'returnAffected' => $returnAffected,
                )
            );

        } else {
            $message = "Some Issue Occurs try later";
            return response()->json(
                array(
                    'status' => false,
                    'message' => $message,
                )
            );
        }
    }

    public function newFollowupCalendar(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $categoryMap = [
            1 => 'Psychologist',
            2 => 'Nutritionist',
            5 => 'School Health Physician',
        ];
        $categories = [
            'Psychologist',
            'Nutritionist',
            'General Physician',
        ];

        // derive entries from actual follow-up date keys (module-specific)
        $dateKeysToCategory = [
            'Physician_Follow_up_Date' => 'Psychologist',
            'Follow_up_Date'  => 'Nutritionist',
            'generalphysician_Follow_up_Date' => 'General Physician',
        ];
        $datesQuery = DB::table('form_data')
            ->whereIn('key', array_keys($dateKeysToCategory))
            ->whereNotNull('value')
            ->where('value', '!=', '');
        if ($startDate && $endDate) {
            $datesQuery->whereBetween('value', [$startDate, $endDate]);
        }
        $datesRows = $datesQuery->get();
        $entryIds = $datesRows->pluck('entry_id')->unique()->values()->all();

        $studentsQuery = DB::table('form_entries as fe')
            ->join('schools as s', 'fe.school', '=', 's.id')
            ->whereIn('fe.id', $entryIds)
            ->select('fe.id as entry_id', 'fe.name as student_name', 's.school_name', 's.id as school_id');

        $students = $studentsQuery->get();

        // phone from form_data
        $phoneRows = DB::table('form_data')
            ->whereIn('entry_id', $entryIds)
            ->where('key', 'Emergency_Contact_Number')
            ->get()
            ->groupBy('entry_id');

        // gr number from form_data
        $grRows = DB::table('form_data')
            ->whereIn('entry_id', $entryIds)
            ->where('key', 'Gr_Number')
            ->get()
            ->groupBy('entry_id');

        // precompute past follow-up counts per (school, gr_number)
        $pastCountsRaw = DB::table('form_entries as fe2')
            ->leftJoin('form_data as gr2', function($join) {
                $join->on('gr2.entry_id', '=', 'fe2.id')
                     ->where('gr2.key', 'Gr_Number');
            })
            ->join('form_data as fd2', function($join) {
                $join->on('fd2.entry_id', '=', 'fe2.id')
                     ->where('fd2.key', 'Follow_up_Required');
            })
            ->whereRaw('LOWER(fd2.value) = ?', ['yes'])
            ->select('fe2.school as school_id', 'gr2.value as grno', DB::raw('COUNT(*) as cnt'))
            ->groupBy('fe2.school', 'gr2.value')
            ->get();

        $pastCounts = [];
        foreach ($pastCountsRaw as $pc) {
            if (!empty($pc->grno)) {
                $pastCounts[$pc->school_id][$pc->grno] = (int)$pc->cnt;
            }
        }

        // follow-up dates per entry keyed by category name
        $datesByEntry = [];
        foreach ($datesRows as $r) {
            $cat = $dateKeysToCategory[$r->key] ?? null;
            if ($cat) {
                $datesByEntry[$r->entry_id][$cat] = $r->value;
            }
        }

        // reason and encounter per entry
        $reasonRows = DB::table('form_data')
            ->whereIn('entry_id', $entryIds)
            ->where('key', 'Reason_for_Referral')
            ->get()->groupBy('entry_id');
        $encRows = DB::table('form_data')
            ->whereIn('entry_id', $entryIds)
            ->where('key', 'type_of_encounter')
            ->get()->groupBy('entry_id');

        // build summary per date and category
        $dateSummary = [];
        foreach ($students as $stu) {
            $entryId = $stu->entry_id;
            // Iterate follow-up dates for this entry by mapped category
            $datesForEntry = isset($datesByEntry[$entryId]) ? $datesByEntry[$entryId] : [];
            foreach ($datesForEntry as $catName => $date) {
                if ($startDate && $endDate) {
                    if (!($date >= $startDate && $date <= $endDate)) continue;
                }
                if (!isset($dateSummary[$date])) {
                    foreach ($categories as $c) {
                        $dateSummary[$date][$c] = ['count' => 0, 'students' => []];
                    }
                }
                $reason = '';
                if (isset($reasonRows[$entryId]) && $reasonRows[$entryId]->count()) {
                    $reason = (string)($reasonRows[$entryId]->first()->value ?? '');
                }
                $encounter = '';
                if (isset($encRows[$entryId]) && $encRows[$entryId]->count()) {
                    $encounter = (string)($encRows[$entryId]->first()->value ?? '');
                }
                $followupType = 'Follow-up 1';
                $dateSummary[$date][$catName]['count']++;
                $dateSummary[$date][$catName]['students'][] = [
                    'entry_id' => $entryId,
                    'name' => $stu->student_name,
                    'phone' => isset($phoneRows[$entryId]) && $phoneRows[$entryId]->count() ? (string)$phoneRows[$entryId]->first()->value : '',
                    'school_name' => $stu->school_name,
                    'referral_date' => $date,
                    'reason_for_referral' => $reason,
                    'followup_type' => $followupType,
                ];
            }
        }

        // Merge medical module follow-ups into summary
        $gpQuery = DB::table('school_health_physicians as shp')
            ->join('student_biodata as sb', 'shp.StudentBiodataId', '=', 'sb.id')
            ->join('schools as s', 'sb.School_Name', '=', 's.id')
            ->where('shp.deleted', 0)
            ->where('sb.deleted', 0)
            ->whereNotNull('shp.Follow_up_Date')
            ->where('shp.Follow_up_Date', '!=', '');
        if ($startDate && $endDate) {
            $gpQuery->whereBetween('shp.Follow_up_Date', [$startDate, $endDate]);
        }
        $gpRows = $gpQuery->select('shp.Follow_up_Date as fdate', 'shp.Reason_for_Follow_up as reason', 'sb.name', 'sb.GRNo', 'sb.class', 'sb.Emergency_Contact_Number', 'sb.type_of_encounter', 's.school_name', 'sb.id as biodata_id')->get();
        foreach ($gpRows as $r) {
            $date = $r->fdate;
            $ts = strtotime($date);
            if ($ts) { $date = date('Y-m-d', $ts); }
            if (!isset($dateSummary[$date])) {
                foreach ($categories as $c) {
                    $dateSummary[$date][$c] = ['count' => 0, 'students' => []];
                }
            }
            $followupType = 'Follow-up 2';
            $dateSummary[$date]['General Physician']['count']++;
            $dateSummary[$date]['General Physician']['students'][] = [
                'name' => $r->name,
                'phone' => (string)($r->Emergency_Contact_Number ?? ''),
                'school_name' => $r->school_name,
                'referral_date' => $date,
                'reason_for_referral' => (string)($r->reason ?? ''),
                'class' => (string)($r->class ?? ''),
                'grNumber' => (string)($r->GRNo ?? ''),
                'followup_type' => $followupType,
                'redirect_link' => 'https://cphs.biopharmainfo.net/admin/medical_history/SchoolHealthPhysician/' . $r->biodata_id,
            ];
        }

        $nutQuery = DB::table('nutritionist_history_evaluation_sections as nhes')
            ->join('student_biodata as sb', 'nhes.StudentBiodataId', '=', 'sb.id')
            ->join('schools as s', 'sb.School_Name', '=', 's.id')
            ->where('nhes.deleted', 0)
            ->where('sb.deleted', 0)
            ->whereNotNull('nhes.Follow_up_Date1')
            ->where('nhes.Follow_up_Date1', '!=', '');
        if ($startDate && $endDate) {
            $nutQuery->whereBetween('nhes.Follow_up_Date1', [$startDate, $endDate]);
        }
        $nutRows = $nutQuery->select('nhes.Follow_up_Date1 as fdate', 'nhes.Reason_for_Follow_up1 as reason', 'sb.name', 'sb.GRNo', 'sb.class', 'sb.Emergency_Contact_Number', 'sb.type_of_encounter', 's.school_name', 'sb.id as biodata_id')->get();
        foreach ($nutRows as $r) {
            $date = $r->fdate;
            $ts = strtotime($date);
            if ($ts) { $date = date('Y-m-d', $ts); }
            if (!isset($dateSummary[$date])) {
                foreach ($categories as $c) {
                    $dateSummary[$date][$c] = ['count' => 0, 'students' => []];
                }
            }
            $followupType = 'Follow-up 2';
            $dateSummary[$date]['Nutritionist']['count']++;
            $dateSummary[$date]['Nutritionist']['students'][] = [
                'name' => $r->name,
                'phone' => (string)($r->Emergency_Contact_Number ?? ''),
                'school_name' => $r->school_name,
                'referral_date' => $date,
                'reason_for_referral' => (string)($r->reason ?? ''),
                'class' => (string)($r->class ?? ''),
                'grNumber' => (string)($r->GRNo ?? ''),
                'followup_type' => $followupType,
                'redirect_link' => 'https://cphs.biopharmainfo.net/admin/medical_history/SchoolHealthPhysician/' . $r->biodata_id,
            ];
        }

        $psyQuery = DB::table('psychologist_history_assessment_sections as phas')
            ->join('student_biodata as sb', 'phas.StudentBiodataId', '=', 'sb.id')
            ->join('schools as s', 'sb.School_Name', '=', 's.id')
            ->where('phas.deleted', 0)
            ->where('sb.deleted', 0)
            ->whereNotNull('phas.Follow_up_Date2')
            ->where('phas.Follow_up_Date2', '!=', '');
        if ($startDate && $endDate) {
            $psyQuery->whereBetween('phas.Follow_up_Date2', [$startDate, $endDate]);
        }
        $psyRows = $psyQuery->select('phas.Follow_up_Date2 as fdate', 'phas.Reason_for_Follow_up2 as reason', 'sb.name', 'sb.GRNo', 'sb.class', 'sb.Emergency_Contact_Number', 'sb.type_of_encounter', 's.school_name', 'sb.id as biodata_id')->get();
        foreach ($psyRows as $r) {
            $date = $r->fdate;
            $ts = strtotime($date);
            if ($ts) { $date = date('Y-m-d', $ts); }
            if (!isset($dateSummary[$date])) {
                foreach ($categories as $c) {
                    $dateSummary[$date][$c] = ['count' => 0, 'students' => []];
                }
            }
            $followupType = 'Follow-up 2';
            $dateSummary[$date]['Psychologist']['count']++;
            $dateSummary[$date]['Psychologist']['students'][] = [
                'name' => $r->name,
                'phone' => (string)($r->Emergency_Contact_Number ?? ''),
                'school_name' => $r->school_name,
                'referral_date' => $date,
                'reason_for_referral' => (string)($r->reason ?? ''),
                'class' => (string)($r->class ?? ''),
                'grNumber' => (string)($r->GRNo ?? ''),
                'followup_type' => $followupType,
                'redirect_link' => 'https://cphs.biopharmainfo.net/admin/medical_history/SchoolHealthPhysician/' . $r->biodata_id,
            ];
        }

        $data = [];
        $events = [];
        $colorMap = [
            'Psychologist' => '#d86744',
            'Nutritionist' => '#2b8a3e',
            'General Physician' => '#1f6feb',
        ];
        foreach ($dateSummary as $date => $counts) {
            $row = ['date' => $date];
            foreach ($categories as $cat) {
                $row[$cat] = $counts[$cat]['count'];
                $row[$cat . '_students'] = $counts[$cat]['students'];
                if ($counts[$cat]['count'] > 0) {
                    $events[] = [
                        'title' => $cat,
                        'start' => $date,
                        'backgroundColor' => $colorMap[$cat] ?? '#3788d8',
                        'borderColor' => $colorMap[$cat] ?? '#3788d8',
                    ];
                }
            }
            $data[] = $row;
        }
        return view('Calendar.new_calendar', [
            'data' => $data,
            'types' => $categories,
            'events_json' => json_encode($events),
        ]);
    }

    public function followupsByDate(Request $request)
    {
        $date = $request->input('date');
        if (!$date) {
            return response()->json(['data' => []]);
        }

        $categories = [
            'Psychologist',
            'Nutritionist',
            'General Physician',
        ];
        $dateKeysToCategory = [
            'Physician_Follow_up_Date' => 'Psychologist',
            'Follow_up_Date'  => 'Nutritionist',
            'generalphysician_Follow_up_Date' => 'General Physician',
        ];

        $datesRows = DB::table('form_data')
            ->whereIn('key', array_keys($dateKeysToCategory))
            ->where('value', $date)
            ->get();
        $entryIds = $datesRows->pluck('entry_id')->unique()->values()->all();

        if (empty($entryIds)) {
            return response()->json(['data' => []]);
        }

        $students = DB::table('form_entries as fe')
            ->join('schools as s', 'fe.school', '=', 's.id')
            ->whereIn('fe.id', $entryIds)
            ->select('fe.id as entry_id', 'fe.name as student_name', 's.school_name', 's.id as school_id')
            ->get();

        $phoneRows = DB::table('form_data')
            ->whereIn('entry_id', $entryIds)
            ->where('key', 'Emergency_Contact_Number')
            ->get()->groupBy('entry_id');
        $grRows = DB::table('form_data')
            ->whereIn('entry_id', $entryIds)
            ->where('key', 'Gr_Number')
            ->get()->groupBy('entry_id');
        $classRows = DB::table('form_data')
            ->whereIn('entry_id', $entryIds)
            ->whereIn('key', ['Class', 'class'])
            ->get()->groupBy('entry_id');

        $reasonRows = DB::table('form_data')
            ->whereIn('entry_id', $entryIds)
            ->whereIn('key', ['Reason_for_Referral', 'Reason_for_Follow_up', 'Reason_for_Follow_up1', 'Reason_for_Follow_up2'])
            ->get()->groupBy('entry_id');
        $encRows = DB::table('form_data')
            ->whereIn('entry_id', $entryIds)
            ->where('key', 'type_of_encounter')
            ->get()->groupBy('entry_id');

        $datesByEntry = [];
        foreach ($datesRows as $r) {
            $cat = $dateKeysToCategory[$r->key] ?? null;
            if ($cat) {
                $datesByEntry[$r->entry_id][$cat] = $r->value;
            }
        }

        $pastCountsRaw = DB::table('form_entries as fe2')
            ->leftJoin('form_data as gr2', function($join) {
                $join->on('gr2.entry_id', '=', 'fe2.id')
                     ->where('gr2.key', 'Gr_Number');
            })
            ->join('form_data as fd2', function($join) {
                $join->on('fd2.entry_id', '=', 'fe2.id')
                     ->where('fd2.key', 'Follow_up_Required');
            })
            ->whereRaw('LOWER(fd2.value) = ?', ['yes'])
            ->select('fe2.school as school_id', 'gr2.value as grno', DB::raw('COUNT(*) as cnt'))
            ->groupBy('fe2.school', 'gr2.value')
            ->get();
        $pastCounts = [];
        foreach ($pastCountsRaw as $pc) {
            if (!empty($pc->grno)) {
                $pastCounts[$pc->school_id][$pc->grno] = (int)$pc->cnt;
            }
        }

        $summary = [];
        foreach ($students as $stu) {
            $entryId = $stu->entry_id;
            $catsForEntry = isset($datesByEntry[$entryId]) ? $datesByEntry[$entryId] : [];
            foreach ($catsForEntry as $catName => $dateVal) {
                if (!isset($summary[$catName])) {
                    $summary[$catName] = ['count' => 0, 'students' => []];
                }
                $reason = '';
                if (isset($reasonRows[$entryId]) && $reasonRows[$entryId]->count()) {
                    $reason = (string)($reasonRows[$entryId]->first()->value ?? '');
                }
                $encounter = '';
                if (isset($encRows[$entryId]) && $encRows[$entryId]->count()) {
                    $encounter = (string)($encRows[$entryId]->first()->value ?? '');
                }
                $grnoVal = isset($grRows[$entryId]) && $grRows[$entryId]->count() ? (string)$grRows[$entryId]->first()->value : null;
                $pastCount = ($grnoVal && isset($pastCounts[$stu->school_id][$grnoVal])) ? (int)$pastCounts[$stu->school_id][$grnoVal] : 1;
                $followupType = (strtolower($encounter) === 'case identified through screening') ? 'First Follow-up' : ('Follow-up ' . max(1, $pastCount));

                $summary[$catName]['count']++;
                $summary[$catName]['students'][] = [
                    'name' => $stu->student_name,
                    'phone' => isset($phoneRows[$entryId]) && $phoneRows[$entryId]->count() ? (string)$phoneRows[$entryId]->first()->value : '',
                    'referralDate' => $dateVal,
                    'schoolName' => $stu->school_name,
                    'class' => isset($classRows[$entryId]) && $classRows[$entryId]->count() ? (string)$classRows[$entryId]->first()->value : '',
                    'grNumber' => $grnoVal ?? '',
                    'reason' => $reason,
                    'followUpType' => $followupType,
                    'redirect_link' => route('Medical_Detail') . '/' . $entryId,
                ];
            }
        }

        return response()->json(['data' => $summary]);
    }

    public function followupsByDateMedical(Request $request)
    {
        $date = $request->input('date');
        $category = $request->input('category');
        if (!$date) {
            return response()->json(['data' => []]);
        }

        $summary = [
            'Psychologist' => ['count' => 0, 'students' => []],
            'Nutritionist' => ['count' => 0, 'students' => []],
            'General Physician' => ['count' => 0, 'students' => []],
        ];

        $ts = strtotime($date);
        $variants = [$date];
        if ($ts) {
            $variants[] = date('d-m-Y', $ts);
            $variants[] = date('d/m/Y', $ts);
            $variants[] = date('j F Y', $ts);
            $variants[] = date('d F Y', $ts);
            $variants[] = date('j M Y', $ts);
            $variants[] = date('d M Y', $ts);
        }

        if (!$category || $category === 'General Physician') {
            $gpRows = DB::table('school_health_physicians as shp')
                ->join('student_biodata as sb', 'shp.StudentBiodataId', '=', 'sb.id')
                ->join('schools as s', 'sb.School_Name', '=', 's.id')
                ->where('shp.deleted', 0)
                ->where('sb.deleted', 0)
                ->whereIn('shp.Follow_up_Date', $variants)
                ->select('shp.Reason_for_Follow_up as reason', 'sb.name', 'sb.GRNo', 'sb.class', 'sb.Emergency_Contact_Number', 'sb.type_of_encounter', 's.school_name', 'sb.id as biodata_id')
                ->get();
            foreach ($gpRows as $r) {
                $followupType = 'Follow-up 2';
                $summary['General Physician']['count']++;
                $summary['General Physician']['students'][] = [
                    'name' => $r->name,
                    'phone' => (string)($r->Emergency_Contact_Number ?? ''),
                    'referralDate' => $date,
                    'schoolName' => $r->school_name,
                    'class' => (string)($r->class ?? ''),
                    'grNumber' => (string)($r->GRNo ?? ''),
                    'reason' => (string)($r->reason ?? ''),
                    'followUpType' => $followupType,
                    'redirect_link' => 'https://cphs.biopharmainfo.net/admin/medical_history/SchoolHealthPhysician/' . $r->biodata_id,
                ];
            }
        }

        if (!$category || $category === 'Nutritionist') {
            $nutRows = DB::table('nutritionist_history_evaluation_sections as nhes')
                ->join('student_biodata as sb', 'nhes.StudentBiodataId', '=', 'sb.id')
                ->join('schools as s', 'sb.School_Name', '=', 's.id')
                ->where('nhes.deleted', 0)
                ->where('sb.deleted', 0)
                ->whereIn('nhes.Follow_up_Date1', $variants)
                ->select('nhes.Reason_for_Follow_up1 as reason', 'sb.name', 'sb.GRNo', 'sb.class', 'sb.Emergency_Contact_Number', 'sb.type_of_encounter', 's.school_name', 'sb.id as biodata_id')
                ->get();
            foreach ($nutRows as $r) {
                $followupType = 'Follow-up 2';
                $summary['Nutritionist']['count']++;
                $summary['Nutritionist']['students'][] = [
                    'name' => $r->name,
                    'phone' => (string)($r->Emergency_Contact_Number ?? ''),
                    'referralDate' => $date,
                    'schoolName' => $r->school_name,
                    'class' => (string)($r->class ?? ''),
                    'grNumber' => (string)($r->GRNo ?? ''),
                    'reason' => (string)($r->reason ?? ''),
                    'followUpType' => $followupType,
                    'redirect_link' => 'https://cphs.biopharmainfo.net/admin/medical_history/SchoolHealthPhysician/' . $r->biodata_id,
                ];
            }
        }

        if (!$category || $category === 'Psychologist') {
            $psyRows = DB::table('psychologist_history_assessment_sections as phas')
                ->join('student_biodata as sb', 'phas.StudentBiodataId', '=', 'sb.id')
                ->join('schools as s', 'sb.School_Name', '=', 's.id')
                ->where('phas.deleted', 0)
                ->where('sb.deleted', 0)
                ->whereIn('phas.Follow_up_Date2', $variants)
                ->select('phas.Reason_for_Follow_up2 as reason', 'sb.name', 'sb.GRNo', 'sb.class', 'sb.Emergency_Contact_Number', 'sb.type_of_encounter', 's.school_name', 'sb.id as biodata_id')
                ->get();
            foreach ($psyRows as $r) {
                $followupType = 'Follow-up 2';
                $summary['Psychologist']['count']++;
                $summary['Psychologist']['students'][] = [
                    'name' => $r->name,
                    'phone' => (string)($r->Emergency_Contact_Number ?? ''),
                    'referralDate' => $date,
                    'schoolName' => $r->school_name,
                    'class' => (string)($r->class ?? ''),
                    'grNumber' => (string)($r->GRNo ?? ''),
                    'reason' => (string)($r->reason ?? ''),
                    'followUpType' => $followupType,
                    'redirect_link' => 'https://cphs.biopharmainfo.net/admin/medical_history/SchoolHealthPhysician/' . $r->biodata_id,
                ];
            }
        }

        // Existing form_data follow-ups
        $dateKeysToCategory = [
            'Physician_Follow_up_Date' => 'Psychologist',
            'Follow_up_Date'  => 'Nutritionist',
            'generalphysician_Follow_up_Date' => 'General Physician',
        ];
        $fdKeys = array_keys($dateKeysToCategory);
        if ($category === 'Psychologist') { $fdKeys = ['Physician_Follow_up_Date']; }
        elseif ($category === 'Nutritionist') { $fdKeys = ['Follow_up_Date']; }
        elseif ($category === 'General Physician') { $fdKeys = ['generalphysician_Follow_up_Date']; }
        $datesRows = DB::table('form_data')
            ->whereIn('key', $fdKeys)
            ->whereIn('value', $variants)
            ->get();
        $entryIds = $datesRows->pluck('entry_id')->unique()->values()->all();
        if (!empty($entryIds)) {
            $students = DB::table('form_entries as fe')
                ->join('schools as s', 'fe.school', '=', 's.id')
                ->whereIn('fe.id', $entryIds)
                ->select('fe.id as entry_id', 'fe.name as student_name', 's.school_name', 's.id as school_id')
                ->get();
            $fdAgg = DB::table('form_data')
                ->whereIn('entry_id', $entryIds)
                ->whereIn('key', ['Emergency_Contact_Number','Gr_Number','Class','class','Reason_for_Referral','Reason_for_Follow_up','Reason_for_Follow_up1','Reason_for_Follow_up2','type_of_encounter'])
                ->selectRaw("entry_id,
                    MAX(CASE WHEN `key`='Emergency_Contact_Number' THEN `value` END) AS phone,
                    MAX(CASE WHEN `key`='Gr_Number' THEN `value` END) AS gr,
                    MAX(CASE WHEN `key` IN ('Class','class') THEN `value` END) AS class,
                    MAX(CASE WHEN `key` IN ('Reason_for_Referral','Reason_for_Follow_up','Reason_for_Follow_up1','Reason_for_Follow_up2') THEN `value` END) AS reason,
                    MAX(CASE WHEN `key`='type_of_encounter' THEN `value` END) AS encounter")
                ->groupBy('entry_id')
                ->get()
                ->keyBy('entry_id');
            $datesByEntry = [];
            foreach ($datesRows as $r) {
                $cat = $dateKeysToCategory[$r->key] ?? null;
                if ($cat) {
                    $datesByEntry[$r->entry_id][$cat] = $r->value;
                }
            }
            foreach ($students as $stu) {
                $entryId = $stu->entry_id;
                $catsForEntry = isset($datesByEntry[$entryId]) ? $datesByEntry[$entryId] : [];
                foreach ($catsForEntry as $catName => $dateVal) {
                    $agg = $fdAgg->get($entryId);
                    $reason = $agg ? (string)($agg->reason ?? '') : '';
                    $encounter = $agg ? (string)($agg->encounter ?? '') : '';
                    $grnoVal = $agg ? (string)($agg->gr ?? '') : '';
                    $followUpType = 'Follow-up 1';
                    $summary[$catName]['count']++;
                    $summary[$catName]['students'][] = [
                        'name' => $stu->student_name,
                        'phone' => $agg ? (string)($agg->phone ?? '') : '',
                        'referralDate' => $dateVal,
                        'schoolName' => $stu->school_name,
                        'class' => $agg ? (string)($agg->class ?? '') : '',
                        'grNumber' => $grnoVal,
                        'reason' => $reason,
                        'followUpType' => $followUpType,
                        'redirect_link' => route('Medical_Detail') . '/' . $entryId,
                    ];
                }
            }
        }

        return response()->json(['data' => $summary]);
    }
}

