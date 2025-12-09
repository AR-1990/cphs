<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TestController extends Controller
{
    
    public function generateCsvReportForAll(Request $request)
    {
        $validated = $request->validate([
            'start' => 'nullable|date',
            'end' => 'nullable|date|after_or_equal:start',
        ]);

        $start = $validated['start'] ? Carbon::parse($validated['start'])->startOfDay() : null;
        $end = $validated['end'] ? Carbon::parse($validated['end'])->endOfDay() : null;
        $observationQuestions = [
            'observation1' => 'Restless or overactive?',
            'observation2' => 'Excitable, Impulsive?',
            'observation3' => 'Disturbs other children?',
            'observation4' => 'Fails to finish things started - short attention span?',
            'observation5' => 'Inattentive, easily distracted?',
            'observation6' => 'Cries often and easily?',
            'observation7' => 'Is your spelling poor?',
            'observation8' => 'When writing down the date, do you often make mistakes?',
            'observation9' => 'Do you find difficulty in telling left from right?',
            'observation10' => 'Do you mix up bus numbers like 35 and 53?'
        ];
        $observationValues = [
            1 => 'Not At All',
            2 => 'Just a Little',
            3 => 'Pretty Much',
            4 => 'Very Much'
        ];
        $query = DB::table('form_entries')
            ->select('id', 'created_at', 'enterby', 'doc_id', 'psychiatrist_id', 'nutritionist_id');

        if ($start && $end) {
            $query->whereBetween('created_at', [$start, $end]);
        }
        $formEntries = $query->get()->keyBy('id');
        $formData = DB::table('form_data')
            ->select('entry_id', 'key', 'value')
            ->whereIn('entry_id', $formEntries->keys())
            ->get()
            ->groupBy('entry_id');
        $schools = DB::table('schools')->pluck('school_name', 'id');
        $cities = DB::table('cities')->pluck('name', 'id');
        $areas = DB::table('areas')->pluck('name', 'id'); 
        $users = DB::table('users')->pluck('fullname', 'id');

        $uniqueKeys = $this->prepareUniqueKeys($formData, $observationQuestions);

        //dd($uniqueKeys);

        $fileName = 'student_data_report_' . date('Y-m-d_H-i-s') . '.csv';
        $output = fopen("php://output", "w");

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        fputcsv($output, array_merge(['Entry ID'], $uniqueKeys));
        
        foreach ($formData as $entryId => $rows) {

            $row = array_fill_keys($uniqueKeys, '-');

            foreach ($rows as $data) {
                $this->mapFormDataToRow($data, $row, $observationQuestions, $observationValues, $schools, $cities, $areas, $users);
            }

            $formEntry = $formEntries->get($entryId);
            if ($formEntry) {
                
                $row['Created By'] = $users[$formEntry->enterby] ?? '-';
                $row['Created At'] = $formEntry->created_at ?? '-';
                $row['Doctor'] = $users[$formEntry->doc_id] ?? '-';
                $row['Psychiatrist'] = $users[$formEntry->psychiatrist_id] ?? '-';
                $row['Nutritionist'] = $users[$formEntry->nutritionist_id] ?? '-';
            }
            fputcsv($output, array_merge([$entryId], $row));
        }
        fclose($output);
        exit;
    }

    private function prepareUniqueKeys($formData, $observationQuestions)
    {
        return collect($formData)->flatMap(function ($rows) use ($observationQuestions) {
            return collect($rows)->map(function ($data) use ($observationQuestions) {
                if (isset($observationQuestions[$data->key])) {
                    return $observationQuestions[$data->key];
                }
                $cleanedKey = preg_replace('/^Question(_No_?\d+_|No_?\d+_|_?\d+_)/', '', $data->key);
                return ucfirst(str_replace('_', ' ', $cleanedKey));
            });
        })
        ->unique()
        ->filter()
        ->push('Doctor', 'Psychiatrist', 'Nutritionist', 'Created By', 'Created At')
        ->values()
        ->toArray();
    }

    private function mapFormDataToRow($data, &$row, $observationQuestions, $observationValues, $schools, $cities, $areas, $users)
    {
        $classLabels = [
            "0" => "Play group",
            "00" => "KG-1",
            "000" => "KG-2"
        ];

        if (isset($observationQuestions[$data->key])) {
            $cleanedKey = $observationQuestions[$data->key];
            $row[$cleanedKey] = $observationValues[$data->value] ?? '-';
        } else {
            $actualKey = preg_replace('/^Question(_No_?\d+_|No_?\d+_|_?\d+_)/', '', $data->key);
            $cleanedKey = ucfirst(str_replace('_', ' ', $actualKey));

            if ($cleanedKey === 'School') {
                $row[$cleanedKey] = $schools[$data->value] ?? '-';
            } elseif ($cleanedKey === 'City') {
                $row[$cleanedKey] = $cities[$data->value] ?? '-';
            } elseif ($cleanedKey === 'Area') {
                $row[$cleanedKey] = $areas[$data->value] ?? '-';
            } elseif ($cleanedKey === 'Refer to') {
                $row[$cleanedKey] = $users[$data->value] ?? '-';
            } 
            elseif ($cleanedKey === 'Class') {
                // Handle class labels
                $row[$cleanedKey] = $classLabels[$data->value] ?? $data->value;
            }
            elseif ($cleanedKey === 'Visual acuity using Snellens chart') {
                // Prevent Snellen's chart values from being interpreted as dates
                //$row[$cleanedKey] = '"' . $data->value;
                $row[$cleanedKey] = '(' . $data->value . ')';
            } 
            else {
                $row[$cleanedKey] = $data->value ?? '-';
            }
        }
    }
}
