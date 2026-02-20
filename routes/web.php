<?php

use Illuminate\Http\Request;

use App\Http\Controllers\AdminPanel\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

use App\Http\Controllers\AdminPanel\AdminFormController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPanel\AdminDashBoardController;
use App\Http\Controllers\MedicalHistoryController;
use App\Http\Controllers\StudentScreeningController;
use App\Http\Controllers\MedicalNotificationController;
use App\Http\Controllers\ScreeningController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\AdminPanel\AdminUserController;
use App\Http\Controllers\ExportController;

Route::post('/test-generate-csv','App\Http\Controllers\TestController@generateCsvReportForAll')->name('csv');
Route::get('/export-data', [ExportController::class, 'exportData'])->name('export.data');


Route::get('/', function () {
    return redirect(route('login', 'admin'));
});

Route::get('/{loginfor}/login', [
    AuthenticationController::class,
    'index'
])->name('login')->where('loginfor', 'admin|student');

Route::post('/{loginfor}/login', [
    AuthenticationController::class,
    'submitForm'
])->name('submitForm')->where('loginfor', 'admin|student');

// Routes for Admin Dashboard


Route::group(['middleware' => ['admin'], "prefix" => "admin"], function () {

    Route::prefix('student-screening')->group(function () {

        Route::match(array('get', 'post'), '/screeningForm/{id?}', array(StudentScreeningController::class, 'screeningForm'))->name('screeningForm');

    });


    Route::prefix('dashboard')->name('admin.dashboard.')->group(function () {
      
        // Route::get('', 'App\Http\Controllers\AdminPanel\AdminDashBoardController@index')->name('index');

        Route::match(array('get', 'post'), '', array(AdminDashBoardController::class, 'index'))->name('index');
        Route::match(array('get', 'post'), 'schoolDashboard1', array(AdminDashBoardController::class, 'schoolDashboard1'))->name('schoolDashboard1');
        Route::match(array('get', 'post'), 'schoolDashboard2', array(AdminDashBoardController::class, 'schoolDashboard2'))->name('schoolDashboard2');


    });

    // Route::match(array ('get', 'post'), 'medical_history/{id?}', array (MedicalHistoryController::class, 'index'))->name('medical_history');


    Route::match(array('get', 'post'), '/HeightForAge', array(AdminFormController::class, 'HeightForAge'))->name('HeightForAge');

    Route::prefix('Calendar')->group(function () {

        Route::match(array('get', 'post'), '/', array(CalendarController::class, 'index'))->name('Calendar');
        Route::match(array('get', 'post'), '/Delete', array(CalendarController::class, 'Delete'))->name('CalendarDelete');
        // Route::match(array('get', 'post'), '/FollowupsByDate', array(CalendarController::class, 'FollowupsByDate'))->name('CalendarFollowupsByDate');
           Route::match(array('get', 'post'), '/FollowupsByDate', array(CalendarController::class, 'followupsByDateMedical'))->name('CalendarFollowupsByDate');

    });

    /* team-performance*/
    Route::prefix('team-performance')->group(function () {

        Route::match(array('get', 'post'), 'Psychologist', array(MedicalHistoryController::class, 'Psychologist'))->name('Psychologist');
        Route::match(array('get', 'post'), 'PsychologistList', array(MedicalHistoryController::class, 'PsychologistList'))->name('PsychologistList');
        Route::match(array('get', 'post'), 'Nutritionist', array(MedicalHistoryController::class, 'Nutritionist'))->name('Nutritionist');
        Route::match(array('get', 'post'), 'NutritionistList', array(MedicalHistoryController::class, 'NutritionistList'))->name('NutritionistList');

        Route::match(array('get', 'post'), 'Physician', array(MedicalHistoryController::class, 'Physician'))->name('Physician');
        Route::match(array('get', 'post'), 'PhysicianList', array(MedicalHistoryController::class, 'PhysicianList'))->name('PhysicianList');


    });

    /*  Notification  */
    Route::prefix('notification')->group(function () {

        Route::match(array('get', 'post'), '/MedicalNotificationClick/{id?}', array(MedicalNotificationController::class, 'MedicalNotificationClick'))->name('MedicalNotificationClick');
        Route::match(array('get', 'post'), 'getMedicalNotifications', array(MedicalNotificationController::class, 'getMedicalNotifications'))->name('getMedicalNotifications');
        Route::match(array('get', 'post'), 'ShowMedicalNotificationView', array(MedicalNotificationController::class, 'ShowMedicalNotificationView'))->name('ShowMedicalNotificationView');

    });


    /* ScreeningController */
    Route::prefix('screening')->group(function () {

        Route::match(array('get', 'post'), '/', array(ScreeningController::class, 'index'))->name('Screening');
        Route::match(array('get', 'post'), 'ScreeningForm', array(ScreeningController::class, 'ScreeningForm'))->name('ScreeningForm');
        Route::match(array('get', 'post'), 'ScreeningList', array(ScreeningController::class, 'ScreeningList'))->name('ScreeningList');
        Route::match(array('get', 'post'), 'ScreeningListIndex', array(ScreeningController::class, 'ScreeningListIndex'))->name('ScreeningListIndex');
        Route::match(array('get', 'post'), 'BioData/{id?}', array(ScreeningController::class, 'BioData'))->name('BioData');
        Route::match(array('get', 'post'), 'VitalsBMI/{id}', array(ScreeningController::class, 'VitalsBMI'))->name('VitalsBMI');
        Route::match(array('get', 'post'), 'Create/{id?}', array(ScreeningController::class, 'CreateUpdate'))->name('CreateScreening');
        Route::match(array('get', 'post'), 'Update/{id?}', array(ScreeningController::class, 'CreateUpdate'))->name('UpdateScreening');
        Route::match(array('get', 'post'), 'Sample/{id?}', array(ScreeningController::class, 'Sample'))->name('SampleScreening');
        Route::match(['get', 'post'], 'DeleteRecord/{id?}', [ScreeningController::class, 'DeleteRecord'])->name('DeleteRecord');
        Route::match(['get', 'post'], 'Details/{id?}', [ScreeningController::class, 'Details'])->name('Details');
        Route::match(['get', 'post'], 'WastingCalculation/{id?}', [ScreeningController::class, 'WastingCalculation'])->name('WastingCalculation');
        Route::match(['get', 'post'], 'WastingBMICalculation/{id?}', [ScreeningController::class, 'WastingBMICalculation'])->name('WastingBMICalculation');
        Route::match(['get', 'post'], 'WHZCalculationBmi/{id?}', [ScreeningController::class, 'WHZCalculationBmi'])->name('WHZCalculationBmi');
        Route::match(['get', 'post'], 'StuntingCriteria5/{id?}', [ScreeningController::class, 'StuntingCriteria5'])->name('StuntingCriteria5');

    });


    Route::prefix('data_entry')->name('admin.form_entry.')->group(function () {

        // Route::get('', 'App\Http\Controllers\AdminPanel\AdminFormController@getformData1')->name('index');
        Route::match(['get', 'post'], '', [AdminFormController::class, 'getformData1'])->name('index');

        Route::get('list', 'App\Http\Controllers\AdminPanel\AdminFormController@list')->name('list');
        // Route::get('', 'App\Http\Controllers\AdminPanel\AdminFormController@getformData1')->name('index');
        /* Route::get('', 'App\Http\Controllers\AdminPanel\AdminFormController@getformData')->name('index');*/
        Route::match(array('get', 'post'), 'getformData1', array(AdminFormController::class, 'getformData1'))->name('getformData1');
        Route::match(['get', 'post'], 'data_entries1', [AdminFormController::class, 'getformData1List'])->name('getformData1List');
        // web.php or api.php
        Route::match(['get', 'post'], 'check-gr-number', [AdminFormController::class, 'checkGrNumber'])->name('checkGrNumber');
        Route::match(['get', 'post'], 'deleteRecord/{id?}', [AdminFormController::class, 'deleteRecord'])->name('deleteRecord');

    });


    /* medical_history */
    Route::prefix('medical_history')->group(function () {

        Route::match(array('get', 'post'), '/', array(MedicalHistoryController::class, 'index'))->name('IndexMedicalHistory');
        Route::match(array('get', 'post'), 'List/{id?}', array(MedicalHistoryController::class, 'List'))->name('ListMedicalHistory');
        Route::match(array('get', 'post'), 'Create/{id?}', array(MedicalHistoryController::class, 'CreateUpdate'))->name('CreateMedicalHistory');
        Route::match(array('get', 'post'), 'Update/{id?}', array(MedicalHistoryController::class, 'CreateUpdate'))->name('UpdateMedicalHistory');
        Route::match(array('get', 'post'), 'Delete/{id?}', array(MedicalHistoryController::class, 'Delete'))->name('DeleteMedicalHistory');
        Route::match(array('get', 'post'), 'View/{id?}', array(MedicalHistoryController::class, 'ViewMedicalHistory'))->name('ViewMedicalHistory');
        Route::match(array('get', 'post'), 'Views/{id?}', array(MedicalHistoryController::class, 'ViewMedicalHistory1'))->name('ViewMedicalHistory1');
        Route::match(array('get', 'post'), 'GetDetails/{id?}', array(MedicalHistoryController::class, 'GetDetails'))->name('GetDetails');

        Route::match(array('get', 'post'), 'StudentBiodata/{id?}', array(MedicalHistoryController::class, 'StudentBiodata'))->name('StudentBiodata');
        Route::match(array('get', 'post'), 'SchoolHealthPhysician/{StudentBiodataId?}', array(MedicalHistoryController::class, 'SchoolHealthPhysician'))->name('SchoolHealthPhysician');
        Route::match(array('get', 'post'), 'NutritionistHistoryEvaluationSection/{StudentBiodataId?}', array(MedicalHistoryController::class, 'NutritionistHistoryEvaluationSection'))->name('NutritionistHistoryEvaluationSection');
        Route::match(array('get', 'post'), 'PsychologistHistoryAssessmentSection/{StudentBiodataId?}', array(MedicalHistoryController::class, 'PsychologistHistoryAssessmentSection'))->name('PsychologistHistoryAssessmentSection');
        Route::match(array('get', 'post'), 'BmiRange/{StudentBiodataId?}', array(MedicalHistoryController::class, 'BmiRange'))->name('BmiRange');
        Route::match(array('get', 'post'), 'Weight1Response/{StudentBiodataId?}', array(MedicalHistoryController::class, 'Weight1Response'))->name('Weight1Response');
        Route::match(array('get', 'post'), 'height1Response/{StudentBiodataId?}', array(MedicalHistoryController::class, 'height1Response'))->name('height1Response');
        Route::match(array('get', 'post'), 'medicalhistorydata/{StudentBiodataId?}', array(MedicalHistoryController::class, 'MedicalHistroyView'))->name('medicalhistorydata');
        Route::match(array('get', 'post'), 'saveFollowup', array(MedicalHistoryController::class, 'saveFollowup'))->name('saveFollowup');
        Route::match(array('get', 'post'), 'FollowUp/{StudentBiodataId?}', array(MedicalHistoryController::class, 'FollowUp'))->name('FollowUp');
        Route::match(array('get', 'post'), 'FollowUpList/{StudentBiodataId?}', array(MedicalHistoryController::class, 'FollowUpList'))->name('FollowUpList');

        Route::match(array('get', 'post'), '/generate-pdf/{StudentBiodataId?}', array(MedicalHistoryController::class, 'generatePdf'))->name('generate.pdf');

        Route::match(array('get', 'post'), '/SendEmail/{SendEmail?}', array(MedicalHistoryController::class, 'SendEmail'))->name('SendEmail');

        Route::match(array('get', 'post'), '/generateAndSendPdf/{SendEmail?}', array(MedicalHistoryController::class, 'generateAndSendPdf'))->name('generateAndSendPdf');


        // web.php (routes file)
        // Route::get('/generate-pdf/{StudentBiodataId?}', 'MedicalHistoryController@generatePdf')->name('generate.pdf');

    });

    Route::prefix('log-activity')->group(function () {

        Route::match(array('get', 'post'), '/', array(AdminController::class, 'LogActivity'))->name('LogActivity');
        Route::match(array('get', 'post'), '/LogActivityList', array(AdminController::class, 'LogActivityList'))->name('LogActivityList');
        Route::match(array('get', 'post'), '/delete', array(AdminController::class, 'LogActivityDelete'))->name('LogActivityDelete');
    });


    // Route::get('dashboard1', 'App\Http\Controllers\AdminPanel\AdminDashBoardController@dashboard1')->name('dashboard1');
    Route::get('schoolDashboard', 'App\Http\Controllers\AdminPanel\AdminDashBoardController@schoolDashboard')->name('schoolDashboard');
    Route::match(array('get', 'post'), 'mainDashboard', array(AdminDashBoardController::class, 'mainDashboard'))->name('mainDashboard');

    
    Route::match(array('get', 'post'), 'findings', array(AdminDashBoardController::class, 'student_findings'))->name('findings');
    Route::get('/questions-data', [AdminDashBoardController::class,'getQuestionsData'])->name('questions-data');
    Route::match(array('get', 'post'), 'getQuestionData', array(AdminDashBoardController::class, 'getQuestionData'))->name('getQuestionData');
    Route::match(array('get', 'post'), 'findingss', array(AdminDashBoardController::class, 'student_findings'))->name('findings');



    Route::prefix('students')->name('admin.students.')->group(function () {
        Route::get('', 'App\Http\Controllers\AdminPanel\AdminStudentController@index')->name('index');
        Route::post('', 'App\Http\Controllers\AdminPanel\AdminStudentController@create')->name('create');

    });
    Route::prefix('user')->name('admin.user.')->group(function () {

        Route::match(array('get', 'post'), '/', array(AdminUserController::class, 'index'))->name('index');

        // Route::get('', 'App\Http\Controllers\AdminPanel\AdminUserController@index')->name('index');

        // Route::match(array ('get', 'post'), '/', array (AdminUserController::class, 'index'))->name('users');


    });

    Route::match(array('get', 'post'), '/userCheckEmail', array(AdminUserController::class, 'userCheckEmail'))->name('userCheckEmail');

    Route::prefix('doctorperformance')->name('admin.doctorperformance.')->group(function () {
        Route::get('', 'App\Http\Controllers\AdminPanel\AdminFormController@doc_performance')->name('index');
        Route::post('', 'App\Http\Controllers\AdminPanel\AdminFormController@Filter_doc_performance')->name('Filter_doc_performance');
    });
    Route::prefix('school')->name('admin.school.')->group(function () {
        Route::get('', 'App\Http\Controllers\AdminPanel\AdminSchoolController@index')->name('index');
        Route::get('trainings', 'App\Http\Controllers\AdminPanel\AdminSchoolController@trainingsIndex')->name('trainingsIndex');
    });
    Route::prefix('location')->name('admin.location.')->group(function () {
        Route::get('', 'App\Http\Controllers\AdminPanel\AdminLocationController@index')->name('index');
    });

    Route::prefix('form')->name('admin.form.')->group(function (): void {
     

        Route::match(array('get', 'post'), '/{id?}', array(AdminFormController::class, 'index'))->name('index');

    });


    // Route::prefix('school')->name('admin.school.')->group(function () {
    //     Route::get('', 'App\Http\Controllers\AdminPanel\AdminSchoolController@school_index')->name('index');
    //     Route::get('list', 'App\Http\Controllers\AdminPanel\AdminSchoolController@school_list')->name('list');
    // });
    Route::prefix('databank')->name('admin.databank.')->group(function () {
        Route::get('', 'App\Http\Controllers\AdminPanel\AdminDatabankController@index')->name('index');
    });

    Route::post('getAreasByCity', 'App\Http\Controllers\GeneralController@getAreasByCity')->name('admin.getAreasByCity');

    Route::get('logout', 'App\Http\Controllers\AdminPanel\Auth\AuthenticationController@logout')->name('admin.logout');

    Route::get('user_form_data', 'App\Http\Controllers\AdminPanel\AdminFormController@use_getformData')->name('user_form_data');
});

// Route::get('edit_student/{id}', 'App\Http\Controllers\AdminPanel\AdminFormController@edit_student')->name('edit_student');
Route::match(array('get', 'post'), 'edit_student/{id?}', array(AdminFormController::class, 'edit_student'))->name('edit_student');


Route::post('add_user', 'App\Http\Controllers\AdminPanel\AdminUserController@create')->name('add_user');
Route::get('edit_user', 'App\Http\Controllers\AdminPanel\AdminUserController@edituser')->name('edit_user');
Route::get('edit_user_form/{id}', 'App\Http\Controllers\AdminPanel\AdminUserController@edituser')->name('edit_user_form');
Route::post('update_user', 'App\Http\Controllers\AdminPanel\AdminUserController@update')->name('update_user');
// Route::post('edit_user','App\Http\Controllers\AdminPanel\AdminUserController@update')->name('edit_user');
Route::post('add_school', 'App\Http\Controllers\AdminPanel\AdminSchoolController@create')->name('add_school');
Route::post('add_Training', 'App\Http\Controllers\AdminPanel\AdminSchoolController@add_Training')->name('add_Training');
Route::post('update_training', 'App\Http\Controllers\AdminPanel\AdminSchoolController@update_training')->name('update_training');
Route::post('edit_school', 'App\Http\Controllers\AdminPanel\AdminSchoolController@edit')->name('edit_school');
Route::get('edit_school_form/{id}', 'App\Http\Controllers\AdminPanel\AdminSchoolController@editschool')->name('edit_school_form');
Route::post('edit_school', 'App\Http\Controllers\AdminPanel\AdminSchoolController@update')->name('edit_school');
Route::get('school_status/{id}/{status}', 'App\Http\Controllers\AdminPanel\AdminSchoolController@delete')->name('school_status');
Route::get('user_status/{id}/{status}', 'App\Http\Controllers\AdminPanel\AdminUserController@delete')->name('user_status');
Route::get('detail_page/{id}', 'App\Http\Controllers\AdminPanel\AdminFormController@detail')->name('detail_page');
Route::post('ViewByphy', 'App\Http\Controllers\AdminPanel\AdminFormController@ViewByphy')->name('ViewByphy');
Route::post('ViewByDoc', 'App\Http\Controllers\AdminPanel\AdminFormController@ViewByDoc')->name('ViewByDoc');
Route::post('DoctorComment', 'App\Http\Controllers\AdminPanel\AdminFormController@DoctorComment')->name('DoctorComment');
Route::post('ViewBynutritionist', 'App\Http\Controllers\AdminPanel\AdminFormController@ViewBynutritionist')->name('ViewBynutritionist');
// Route::get('edit_student/{id}', 'App\Http\Controllers\AdminPanel\AdminFormController@edit_student')->name('edit_student');

Route::group(['middleware' => ['student'], "prefix" => "student"], function () {

    // Student Routes
    Route::get('/student-dashboard', function () {
        return view('student.index');
    })->name('studentDashboard');
    Route::get('/edit_profile', function () {
        return view('student.edit_profile');
    });
    Route::get('/student_lesson', function () {
        return view('student.lesson');
    });
    Route::get('/student_module', function () {
        return view('student.module');
    });
    Route::get('/student_quiz_show', function () {
        return view('student.quiz_show');
    });
    Route::get('/student_quiz', function () {
        return view('student.quiz');
    });
    Route::get('/student_results', function () {
        return view('student.results');
    });
});
Route::get('/user-detail', function () {
    return view('admin.user-detail');
});
Route::get('/admin/notifications', function () {
    return view('admin.notifications');
});
Route::get('uploader', function () {
    return view('admin.uploader');
})->name('uploader');


Route::match(array('get', 'post'), '/post_data', array(AdminFormController::class, 'PostData'))->name('post_data');
Route::match(array('get', 'post'), '/ScreeningFormCreateUpdate', array(AdminFormController::class, 'ScreeningFormCreateUpdate'))->name('ScreeningFormCreateUpdate');


Route::post('editpost_data', 'App\Http\Controllers\AdminPanel\AdminFormController@EditPostData')->name('editpost_data');
Route::get('/export_data', 'App\Http\Controllers\AdminPanel\AdminFormController@exportData')->name('export_data');
// Route::get('/export_data', 'App\Http\Controllers\AdminPanel\AdminFormController@exportData');
Route::post('/upload-csv', 'App\Http\Controllers\AdminPanel\AdminFormController@uploadCSV')->name('upload.csv');
Route::get('/Medical_Detail/{id?}', 'App\Http\Controllers\AdminPanel\AdminFormController@Medical_Detail')->name('Medical_Detail');
Route::get('/download-pdf/{id}', [PDFController::class, 'downloadPDF'])->name('download.pdf');


Route::get('/admin/health-report-pdf-1', function () {
    return view('admin.health-report-pdf-1');
});

Route::get('/admin/health-report-pdf-2', function () {
    return view('admin.health-report-pdf-2');
});

// Route::get('/medical_history', function () {
//     return view('admin.medical_history');
// });

Route::post('/store-follow-up-date', [AdminFormController::class, 'storeFollowUpDate'])->name('store.follow.up.date');
Route::post('/store-follow-up-Phycologist-date', [AdminFormController::class, 'phycologist'])->name('store.follow.up.Phycologist.date');
Route::post('/store-follow-up-External-date', [AdminFormController::class, 'External'])->name('store.follow.up.External.date');
Route::post('/store-follow-up-generalphysician-date', [AdminFormController::class, 'generalphysician'])->name('store.follow.up.generalphysician.date');

Route::get('/medical_history_view', function () {
    return view('admin.medical_history_view');
});

Route::post('PsychologistFindings', 'App\Http\Controllers\AdminPanel\AdminFormController@PsychologistFindings')->name('PsychologistFindings');


/* Student Details */
Route::prefix('student-details')->group(function () {

    Route::match(array('get', 'post'), '/GeneralInfo/{id?}', array(AdminFormController::class, 'GeneralInfo'))->name('GeneralInfo');
    Route::match(array('get', 'post'), '/Prescription/{id?}', array(AdminFormController::class, 'Prescription'))->name('Prescription');
    Route::match(array('get', 'post'), '/Aids/{id?}', array(AdminFormController::class, 'Aids'))->name('Aids');
    Route::match(array('get', 'post'), '/Labs/{id?}', array(AdminFormController::class, 'Labs'))->name('Labs');
    Route::match(array('get', 'post'), '/upload-profile-image/{id?}', array(AdminFormController::class, 'uploadProfileImage'))->name('upload.profile.image');

});


Route::match(array('get', 'post'), '/follow-up/{id?}/{followId?}', 'App\Http\Controllers\AdminPanel\AdminFormController@followUpView')->name('follow-up');
Route::match(array('get', 'post'), '/follow-up-list/{id?}/{followId?}', 'App\Http\Controllers\AdminPanel\AdminFormController@followUpList')->name('follow-up-list');
Route::match(array('get', 'post'), '/follow-up-list-datatable/{id?}/{followId?}', 'App\Http\Controllers\AdminPanel\AdminFormController@followUpListDatatable')->name('followUpListDatatable');

Route::match(array('get', 'post'), '/follow-up-join', 'App\\Http\\Controllers\\AdminPanel\\AdminFormController@followUpJoinList')->name('followUpJoinList');
Route::match(array('get', 'post'), '/follow-up-join-datatable', 'App\\Http\\Controllers\\AdminPanel\\AdminFormController@followUpJoinListDatatable')->name('followUpJoinListDatatable');


Route::get("/dashboard_new", function () {
    return view("admin.dashboard_new");
});

Route::get("/admin/main-dashboard", function () {
    return view("admin.main-dashboard");
});

// Route::get("/new-calendar", function () {
//     return view("Calendar.new_calendar");
// })->name('new_calendar');
Route::get('/new-calendar', [App\Http\Controllers\CalendarController::class, 'newFollowupCalendar'])->name('new_calendar');
Route::get('/test-generate-csv', [TestController::class, 'generateCsvReportForAll']);
Route::post('admin/get-case-details', 'App\Http\Controllers\AdminPanel\AdminFormController@getCaseDetails')->name('get.case.details');
// Route::get('admin/case-identified/data', 'App\Http\Controllers\AdminPanel\AdminFormController@caseIdentifiedData')->name('case.identified.data');
Route::get('admin/case-identified/data', 'App\Http\Controllers\AdminPanel\AdminFormController@caseIdentifiedData')->name('caseIdentifiedData');
Route::get('/case-identified', 'App\Http\Controllers\AdminPanel\AdminFormController@caseIdentified')->name('case-identified');
Route::get('/reportable-findings', 'App\Http\Controllers\AdminPanel\AdminFormController@reportable_findings')->name('reportable-findings');
Route::post('/getReportableFindingsBySchool', 'App\Http\Controllers\AdminPanel\AdminFormController@getReportableFindingsBySchool')->name('getReportableFindingsBySchool');
Route::get('/student-finding/{id}', 'App\Http\Controllers\AdminPanel\AdminFormController@showStudentFinding')->name('student.finding');
Route::get('/followup-summary-report', [App\Http\Controllers\AdminPanel\AdminFormController::class, 'followupSummaryReport'])->name('admin.followupSummaryReport');
Route::get('/assesment-summary-report', [App\Http\Controllers\AdminPanel\AdminFormController::class, 'assesmentSummaryReport'])->name('admin.assesment-summary-report');
Route::get('/PhysiciancaseIdentified', 'App\Http\Controllers\AdminPanel\AdminFormController@PhysiciancaseIdentified')->name('PhysiciancaseIdentified');
Route::get('/PhysiciancaseIdentifiedgetdata', 'App\Http\Controllers\AdminPanel\AdminFormController@PhysiciancaseIdentifiedgetdata')->name('PhysiciancaseIdentifiedgetdata');
Route::get('/psychologistassesmentfields', 'App\Http\Controllers\AdminPanel\AdminFormController@psychologistassesmentfields')->name('psychologistassesmentfields');
Route::get('/psychologistIdentifiedgetdata', 'App\Http\Controllers\AdminPanel\AdminFormController@psychologistIdentifiedgetdata')->name('psychologistIdentifiedgetdata');
Route::get('/nutritionistassesmentfields', 'App\Http\Controllers\AdminPanel\AdminFormController@nutritionistassesmentfields')->name('nutritionistassesmentfields');
Route::get('/nutritionistIdentifiedgetdata', 'App\Http\Controllers\AdminPanel\AdminFormController@nutritionistIdentifiedgetdata')->name('nutritionistIdentifiedgetdata');
Route::post('admin/get-finding-count', 'App\Http\Controllers\AdminPanel\AdminFormController@getFindingCount')->name('admin.getFindingCount');
Route::post('admin/get-school-finding-counts', 'App\Http\Controllers\AdminPanel\AdminFormController@getSchoolFindingCounts')->name('admin.getSchoolFindingCounts');
