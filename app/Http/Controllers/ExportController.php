<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExcelExport;
use Session;

class ExportController extends Controller
{
    public function exportData()
    {
        // Clear Laravel caches
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        // Artisan::call('route:cache');
        Artisan::call('view:clear');

        // Perform the data export
        // return Excel::download(new ExcelExport, 'exported-data.xlsx');

        $message = "Cache cleared";
        Session::flash("success_message", $message);
        return redirect()->back();
    }
}
