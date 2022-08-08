<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('home');

   

    // --------------- Agent Activity --------------- //
    Route::get('agentactivity', 'AgentActivityController@index')->name('agentactivity.index')->middleware('can:agentactivity.index');
    Route::post('agentactivity', 'AgentActivityController@store')->name('agentactivity.store')->middleware('can:agentactivity.index');
    Route::get('agentactivity/supervisor', 'AgentActivityController@supervisor')->name('agentactivity.supervisor')->middleware('can:agentactivity.supervisor');
    Route::post('agentactivity/supervisor/logout/', 'AgentActivityController@supervisor_Logout')->name('agentactivity.supervisor-logout')->middleware('can:agentactivity.supervisor');
    Route::get('agentactivity/supervisor/getActivities', 'AgentActivityController@getActivities')->name('agentactivity.getActivity')->middleware('can:agentactivity.supervisor');


    Route::get('agentactivity/report', 'AgentActivityController@report')->name('agentactivity.report')->middleware('can:agentactivity.report');
    Route::post('agentactivity/report/getData', 'AgentActivityController@reportGetData')->name('agentactivity.reportgetdata')->middleware('can:agentactivity.report');
    Route::get('agentactivity/report/getData/download_report/{dates}', 'AgentActivityController@reportDownloadReport')->name('agentactivity.reportdownload')->middleware('can:agentactivity.report');
    // --------------- END Agent Activity --------------- //

    // --------------- CGM --------------- //
    Route::get('cgm/appointmenttracker', 'CGMController@appointmentTracker')->name('cgm.appointmenttracker')->middleware('can:cgm.appointmenttracker') ;
    Route::get('cgm/appointmenttracker/{callData}','CGMController@appointmentTrackerGetData')->name('cgm.appointmenttracker.getdata')->middleware('can:cgm.appointmenttracker') ;
    Route::post('cgm/appointmenttracker', 'CGMController@appointmentTrackersearch')->name('cgm.appointmenttracker.search')->middleware('can:cgm.appointmenttracker');
    Route::post('cgm/appointmenttracker/store', 'CGMController@appointmentTrackerStore')->name('cgm.appointmenttracker.store')->middleware('can:cgm.appointmenttracker');

    Route::get('cgm/qa','CGMController@qa_Index')->name('cgm.qa.index')->middleware('can:cgm.qa');
    Route::get('cgm/qa/{callData}','CGMController@qa_rating')->name('cgm.qa.rating')->middleware('can:cgm.qa');
    Route::post('cgm/qa/store/','CGMController@qa_rating_Store')->name('cgm.qa.ratingStore')->middleware('can:cgm.qa');

    Route::get('cgm/uploadlist', 'CGMController@uploadlist')->name('cgm.uploadlist')->middleware('can:cgm.uploadlist');
    Route::post('cgm/uploadlist', 'CGMController@uploadlistStore')->name('cgm.uploadlist.store')->middleware('can:cgm.uploadlist');
    Route::get('cgm/downloadlists', 'CGMController@downliadlists')->name('cgm.downloadlists')->middleware('can:cgm.downloadlists');
    Route::get('cgm/downloadlists/{nameList}', 'CGMController@downliadlist')->name('cgm.downloadlist')->middleware('can:cgm.downloadlists');
    Route::get('cgm/reports', 'CGMController@reports')->name('cgm.reports')->middleware('can:cgm.reports');
    Route::post('cgm/reports/getData', 'CGMController@reportsgetData')->name('cgm.reports.getData')->middleware('can:cgm.reports');
    Route::get('cgm/reports/getData/download_report/{dates}', 'CGMController@downloadReport')->name('cgm.reports.downloadReport')->middleware('can:cgm.reports');

    Route::get('cgm/reports/pdf/{id}','CGMController@pdf')->name('cgm.reports.pdf')->middleware('can:cgm.reports');
    Route::get('cgm/reports/pdfView/{id}','CGMController@viewpdf')->name('cgm.reports.viewpdf')->middleware('can:cgm.reports');

 
    // --------------- Enercare --------------- //

    //CallTracker
    Route::get('enercare/calltracker','EnercareController@calltracker')->name('enercare.calltracker')->middleware('can:enercare.calltracker');
    Route::post('enercare/calltracker','EnercareController@calltrackerStore')->name('enercare.calltrackerStore')->middleware('can:enercare.calltracker');
    
    //Report Sales
    Route::get('enercare/reports/sales','EnercareController@reportSales')->name('enercare.reportsales')->middleware('can:enercare.reportsales');
    Route::post('enercare/reports/sales','EnercareController@getReportSales')->name('enercare.getreportsales')->middleware('can:enercare.reportsales');
    Route::get('enercare/reports/sales/download_report/{startDate}||{endDate}||{teamleader}','EnercareController@downloadreportSales')->name('enercare.downloadreportsales')->middleware('can:enercare.reportsales');

    //Report CallTracker
    Route::get('enercare/reports/calltracker','EnercareController@reportCallTracker')->name('enercare.reportcalltracker')->middleware('can:enercare.reportcalltracker');
    Route::post('enercare/reports/calltracker','EnercareController@downloadreportCallTracker')->name('enercare.downloadreportcalltracker')->middleware('can:enercare.reportcalltracker');
    
    //Report CallTracker
    Route::get('enercare/reports/kpis','EnercareController@reportkpis')->name('enercare.reportcalltracker')->middleware('can:enercare.reportkpis');
    Route::post('enercare/reports/kpis','EnercareController@reportkpisPOST')->name('enercare.reportkpisPOST')->middleware('can:enercare.reportkpis');


    //Uploads
    Route::get('enercare/uploads/agentperformance','EnercareController@uploadAgentPerformance')->name('enercare.uploadAgentPerformance')->middleware('can:enercare.uploadAgentPerformance');
    Route::post('enercare/uploads/agentperformance','EnercareController@uploadAgentPerformancePost')->name('enercare.uploadAgentPerformancePost')->middleware('can:enercare.uploadAgentPerformance');

    

    // --------------- Service Experts --------------- //

    Route::get('serviceexperts','ServiceExpertsController@files')->name('serviceexperts.files')->middleware('can:serviceexperts.files');

    Route::get('serviceexperts/getdirectory','ServiceExpertsController@getDirectory')->name('serviceexperts.getdirectory')->middleware('can:serviceexperts.files');

    Route::get('serviceexperts/uploadFiles','ServiceExpertsController@filesUpload')->name('serviceexperts.filesupload')->middleware('can:serviceexperts.filesupload');
    Route::post('serviceexperts/uploadFiles','ServiceExpertsController@filesUploadStore')->name('serviceexperts.filesuploadstore')->middleware('can:serviceexperts.filesupload');
    Route::get('serviceexperts/files/{file}','ServiceExpertsController@filesDownload')->name('serviceexperts.filesdownload')->middleware('can:serviceexperts.files');
    
    Route::post('serviceexperts/files/delete','ServiceExpertsController@filesDelete')->name('serviceexperts.filesdelete')->middleware('can:serviceexperts.filesdelete');
    //Route::get('serviceexperts/files/{filename}','ServiceExpertsController@filesDownload')->name('serviceexperts.filesdownload')->middleware('can:serviceexperts.files');
    
    Route::post('serviceexperts/createdirectory','ServiceExpertsController@createDirectory')->name('serviceexperts.filescreatedirectory')->middleware('can:serviceexperts.filescreatedirectory');

    // --------------- Resources --------------- //
    Route::post('users/upload','UserController@upload')->name('users.upload');
    Route::post('users/uploadstore','UserController@uploadStore')->name('users.uploadStore');
    Route::get('users/upload/downloadusers','UserController@downloadUsersCreated')->name('users.downloadUsersCreated');
    Route::resource('roles', 'RoleController'); //Roles
    Route::resource('users', 'UserController'); //Users
    
    // --------------- MasterFile --------------- //
    Route::get('management/uploadmasterfile','ManagementController@uploadMasterfile')->name('management.uploadMasterfile')->middleware('can:masterfile.upload');
    Route::post('management/uploadmasterfile','ManagementController@uploadMasterfilePost')->name('management.uploadMasterfilePost')->middleware('can:masterfile.upload');
    
    Route::get('masterfile/wfh','MasterfileController@wfhIndex')->name('masterfile.wfw.index');
    Route::post('masterfile/wfh','MasterfileController@wfhStore')->name('masterfile.wfw.store');

    Route::post('kaizen/assign','KaizenController@assign')->name('kaizen.assign');
    Route::post('kaizen/comment','KaizenController@comment')->name('kaizen.comment');
    Route::get('kaizen/{id}/downloadfile/{comment_id?}','KaizenController@downloadfile')->name('kaizen.downloadfile');
    Route::resource('kaizen','KaizenController');

    Route::get('reminders','ReminderController@index')->name('reminder.index');
    Route::get('reminders/popup','ReminderController@popup')->name('reminder.popup');

    // Pandora's Box
    Route::get('pandorasbox','PandorasBoxController@index')->name('pandorasbox.index');
    Route::post('pandorasbox','PandorasBoxController@store')->name('pandorasbox.store');

    Route::get('logs/{configDate?}','LogController@index')->name('logs.index');


    // Payroll Novelty
    Route::resource('payrollnovelty', 'PayrollNoveltyController',[
        'only'=>['store','update','destroy']
    ]);
    
    Route::get('payrollnovelty/{novelty?}', 'PayrollNoveltyController@index')->name('payrollnovelty.index')->where('novelty', '[0-9]+');
    Route::get('payrollnovelty/pending', 'PayrollNoveltyController@pending')->name('payrollnovelty.pending');

    Route::post('payrollnovelty/cie10s','PayrollNoveltyController@cie10s')->name('payrollnovelty.cie10s');
    Route::post('payrollnovelty/findemployee','PayrollNoveltyController@findemployee')->name('payrollnovelty.findemployee');
    Route::get('payrollnovelty/downloadflatfile','PayrollNoveltyController@downloadFlatFile')->name('payrollnovelty.downloadFlatFile');
    Route::post('payrollnoveelty/updateTags','PayrollNoveltyController@updateTags')->name('payrollnovelty.updateTags');

    //Payroll Novelty Admin
    Route::get('payrollnovelty/admin','PayrollNoveltyAdminController@index')->name('payrollnovelty.admin.index');
    Route::post('payrollnovelty/admin/smlv','PayrollNoveltyAdminController@smlvSave')->name('payrollnovelty.admin.smlvSave');
    
    //Payroll Novelty Reports
    Route::get('payrollnovelty/reports/novelties','PayrollNoveltyReportsController@novelties')->name('payrollnovelty.reports.novelties');
    Route::post('payrollnovelty/reports/novelties','PayrollNoveltyReportsController@noveltiesDownload')->name('payrollnovelty.reports.noveltiesDownload');
    
    Route::get('payrollnovelty/reports/general','PayrollNoveltyReportsController@general')->name('payrollnovelty.reports.general');
    Route::post('payrollnovelty/reports/general','PayrollNoveltyReportsController@generalDownload')->name('payrollnovelty.reports.generalDownload');
    
    Route::get('payrollnovelty/reports/noveltiesrrhh','PayrollNoveltyReportsController@noveltiesrrhh')->name('payrollnovelty.reports.noveltiesrrhh');
    Route::post('payrollnovelty/reports/noveltiesrrhh','PayrollNoveltyReportsController@noveltiesrrhhDownload')->name('payrollnovelty.reports.noveltiesrrhhDownload');

    // American Water BO Tracker
    Route::get('americanwater/botracker','AmericanWaterBoTrackerController@index')->name('americanwater.botracker');
    Route::post('americanwater/botracker','AmericanWaterBoTrackerController@store')->name('americanwater.botrackerStore');
    Route::post('americanwater/botracker/getlists','AmericanWaterBoTrackerController@getLists')->name('americanwater.getLists');

    Route::get('americanwater/botracker/reports/general','AmericanWaterBoTrackerReportsController@general')->name('americanwater.botracker.reportsGeneral');
    Route::post('americanwater/botracker/reports/general','AmericanWaterBoTrackerReportsController@generalDownload')->name('americanwater.botracker.reportsGeneralDownload');

    Route::get('/getdatenow',function(){
        return date('Y-m-d H:i:s');
    });

    // Daily Sessions
    Route::post('/dailysessions/download','DailySessionController@download')->name('dailysession.download');
    Route::resource('dailysessions','DailySessionController');
    Route::put('/dailysessions/acknowledge/{dailySession}','DailySessionController@acknowledge')->name('dailysession.acknowledge');

    // Trivias
    Route::get('trivias/admin','TriviaController@admin')->name('trivias.admin');
    Route::put('trivias/download','TriviaController@download')->name('trivias.download');
    Route::post('trivias/answer','TriviaController@answer')->name('trivias.answer');
    Route::resource('trivias','TriviaController');

    // Reporting Links
    Route::get('/reporting/links/scorecard','ReportingLinkController@scorecard')->name('links.scorecard');
    Route::get('/reporting/links/dashboard','ReportingLinkController@dashboard')->name('links.dashboard');
    Route::resource('reporting/links','ReportingLinkController',['only'=>['index','create','store','edit','update']]);

    Route::get('/prenomina','PrenominaController@index')->name('prenomina.index');
    Route::post('/prenomina/getpayroll','PrenominaController@getPayroll')->name('prenomina.getPayroll');
    Route::post('/prenomina/getemployees','PrenominaController@getEmployees')->name('prenomina.getEmployees');

    Route::get('/prenomina/adjustments','PrenominaAdjustmentController@index')->name('prenomina.adjustments');
    Route::get('/prenomina/adjustments/pending/om','PrenominaAdjustmentController@pendingForOM')->name('prenomina.adjustments.pending.om');
    Route::get('/prenomina/adjustments/pending/supervisor','PrenominaAdjustmentController@pendingForSupervisor')->name('prenomina.adjustments.pending.supervisor');

    Route::get('/prenomina/adjustments/{adjustment}','PrenominaAdjustmentController@show')->name('prenomina.adjustments.show');
    Route::get('/prenomina/adjustments/create/{activity_code}','PrenominaAdjustmentController@create')->name('prenomina.adjustments.create');
    Route::post('/prenomina/adjustments','PrenominaAdjustmentController@store')->name('prenomina.adjustments.store');
    
    Route::post('/prenomina/adjustments/approve/{id}','PrenominaAdjustmentController@approve')->name('prenomina.adjustments.approve');
    Route::post('/prenomina/adjustments/approveall','PrenominaAdjustmentController@approveAll')->name('prenomina.adjustments.approveall');
    Route::post('/prenomina/adjustments/offsetholiday','PrenominaAdjustmentController@offsetHoliday')->name('prenomina.adjustments.offsetholiday');
});

Auth::routes(['register' => false]);
