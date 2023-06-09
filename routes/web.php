<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
->group(function ()
{
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('home');

    // --------------- Agent Activity --------------- //
    Route::get('agentactivity', 'AgentActivityController@index')
        ->name('agentactivity.index')
        ->middleware('can:agentactivity.index');
    Route::post('agentactivity', 'AgentActivityController@store')
        ->name('agentactivity.store')
        ->middleware('can:agentactivity.index');
    Route::get('agentactivity/supervisor', 'AgentActivityController@supervisor')
        ->name('agentactivity.supervisor')
        ->middleware('can:agentactivity.supervisor');
    Route::post(
        'agentactivity/supervisor/logout/',
        'AgentActivityController@supervisor_Logout'
    )
        ->name('agentactivity.supervisor-logout')
        ->middleware('can:agentactivity.supervisor');
    Route::get(
        'agentactivity/supervisor/getActivities',
        'AgentActivityController@getActivities'
    )
        ->name('agentactivity.getActivity')
        ->middleware('can:agentactivity.supervisor');

    Route::get('agentactivity/report', 'AgentActivityController@report')
        ->name('agentactivity.report')
        ->middleware('can:agentactivity.report');
    Route::post(
        'agentactivity/report/getData',
        'AgentActivityController@reportGetData'
    )
        ->name('agentactivity.reportgetdata')
        ->middleware('can:agentactivity.report');
    Route::get(
        'agentactivity/report/getData/download_report/{dates}',
        'AgentActivityController@reportDownloadReport'
    )
        ->name('agentactivity.reportdownload')
        ->middleware('can:agentactivity.report');
    // --------------- END Agent Activity --------------- //

    // --------------- CGM --------------- //
    Route::get('cgm/appointmenttracker', 'CGMController@appointmentTracker')
        ->name('cgm.appointmenttracker')
        ->middleware('can:cgm.appointmenttracker');
    Route::get(
        'cgm/appointmenttracker/{callData}',
        'CGMController@appointmentTrackerGetData'
    )
        ->name('cgm.appointmenttracker.getdata')
        ->middleware('can:cgm.appointmenttracker');
    Route::post(
        'cgm/appointmenttracker',
        'CGMController@appointmentTrackersearch'
    )
        ->name('cgm.appointmenttracker.search')
        ->middleware('can:cgm.appointmenttracker');
    Route::post(
        'cgm/appointmenttracker/store',
        'CGMController@appointmentTrackerStore'
    )
        ->name('cgm.appointmenttracker.store')
        ->middleware('can:cgm.appointmenttracker');

    Route::get('cgm/qa', 'CGMController@qa_Index')
        ->name('cgm.qa.index')
        ->middleware('can:cgm.qa');
    Route::get('cgm/qa/{callData}', 'CGMController@qa_rating')
        ->name('cgm.qa.rating')
        ->middleware('can:cgm.qa');
    Route::post('cgm/qa/store/', 'CGMController@qa_rating_Store')
        ->name('cgm.qa.ratingStore')
        ->middleware('can:cgm.qa');

    Route::get('cgm/uploadlist', 'CGMController@uploadlist')
        ->name('cgm.uploadlist')
        ->middleware('can:cgm.uploadlist');
    Route::post('cgm/uploadlist', 'CGMController@uploadlistStore')
        ->name('cgm.uploadlist.store')
        ->middleware('can:cgm.uploadlist');
    Route::get('cgm/downloadlists', 'CGMController@downliadlists')
        ->name('cgm.downloadlists')
        ->middleware('can:cgm.downloadlists');
    Route::get('cgm/downloadlists/{nameList}', 'CGMController@downliadlist')
        ->name('cgm.downloadlist')
        ->middleware('can:cgm.downloadlists');
    Route::get('cgm/reports', 'CGMController@reports')
        ->name('cgm.reports')
        ->middleware('can:cgm.reports');
    Route::post('cgm/reports/getData', 'CGMController@reportsgetData')
        ->name('cgm.reports.getData')
        ->middleware('can:cgm.reports');
    Route::get(
        'cgm/reports/getData/download_report/{dates}',
        'CGMController@downloadReport'
    )
        ->name('cgm.reports.downloadReport')
        ->middleware('can:cgm.reports');

    Route::get('cgm/reports/pdf/{id}', 'CGMController@pdf')
        ->name('cgm.reports.pdf')
        ->middleware('can:cgm.reports');
    Route::get('cgm/reports/pdfView/{id}', 'CGMController@viewpdf')
        ->name('cgm.reports.viewpdf')
        ->middleware('can:cgm.reports');

    // --------------- Enercare --------------- //

    //CallTracker
    Route::get('enercare/calltracker', 'EnercareController@calltracker')
        ->name('enercare.calltracker')
        ->middleware('can:enercare.calltracker');
    Route::post('enercare/calltracker', 'EnercareController@calltrackerStore')
        ->name('enercare.calltrackerStore')
        ->middleware('can:enercare.calltracker');

    //Report Sales
    Route::get('enercare/reports/sales', 'EnercareController@reportSales')
        ->name('enercare.reportsales')
        ->middleware('can:enercare.reportsales');
    Route::post('enercare/reports/sales', 'EnercareController@getReportSales')
        ->name('enercare.getreportsales')
        ->middleware('can:enercare.reportsales');
    Route::get(
        'enercare/reports/sales/download_report/
        {startDate}||{endDate}||{teamleader}',
        'EnercareController@downloadreportSales'
    )
        ->name('enercare.downloadreportsales')
        ->middleware('can:enercare.reportsales');

    //Report CallTracker
    Route::get(
        'enercare/reports/calltracker',
        'EnercareController@reportCallTracker'
    )
        ->name('enercare.reportcalltracker')
        ->middleware('can:enercare.reportcalltracker');
    Route::post(
        'enercare/reports/calltracker',
        'EnercareController@downloadreportCallTracker'
    )
        ->name('enercare.downloadreportcalltracker')
        ->middleware('can:enercare.reportcalltracker');

    //Report CallTracker
    Route::get('enercare/reports/kpis', 'EnercareController@reportkpis')
        ->name('enercare.reportcalltracker')
        ->middleware('can:enercare.reportkpis');
    Route::post('enercare/reports/kpis', 'EnercareController@reportkpisPOST')
        ->name('enercare.reportkpisPOST')
        ->middleware('can:enercare.reportkpis');

    //Enercare Bo Tracker
    Route::get(
        'enercare/botracker/reports/general',
        'EnercareBoTrackerController@general'
    )->name('enercare.botracker.reportsGeneral');
    Route::post(
        'enercare/botracker/reports/general',
        'EnercareBoTrackerController@generalDownload'
    )->name('enercare.botracker.reportsGeneralDownload');
    Route::resource('enercare/botracker', 'EnercareBoTrackerController');

    //Enercare Support facilitator tracker
    Route::get(
        'enercare/supportfacilitator/reports/general',
        'EnercareTrackerSupportFacilitatorController@general'
    )->name('enercare.supportfacilitator.reportsGeneral');
    Route::post(
        'enercare/supportfacilitator/reports/general',
        'EnercareTrackerSupportFacilitatorController@generalDownload'
    )->name('enercare.supportfacilitator.reportsGeneralDownload');
    Route::resource(
        'enercare/supportfacilitator',
        'EnercareTrackerSupportFacilitatorController'
    );

    //Uploads
    Route::get(
        'enercare/uploads/agentperformance',
        'EnercareController@uploadAgentPerformance'
    )
        ->name('enercare.uploadAgentPerformance')
        ->middleware('can:enercare.uploadAgentPerformance');
    Route::post(
        'enercare/uploads/agentperformance',
        'EnercareController@uploadAgentPerformancePost'
    )
        ->name('enercare.uploadAgentPerformancePost')
        ->middleware('can:enercare.uploadAgentPerformance');

    //SalesShow
    Route::get('enercare/rankingsales', 'SalesShowController@index')->name(
        'enercare.rankingsales'
    );

    // --------------- Service Experts --------------- //

    Route::get('serviceexperts', 'ServiceExpertsController@files')
        ->name('serviceexperts.files')
        ->middleware('can:serviceexperts.files');

    Route::get(
        'serviceexperts/getdirectory',
        'ServiceExpertsController@getDirectory'
    )
        ->name('serviceexperts.getdirectory')
        ->middleware('can:serviceexperts.files');

    Route::get(
        'serviceexperts/uploadFiles',
        'ServiceExpertsController@filesUpload'
    )
        ->name('serviceexperts.filesupload')
        ->middleware('can:serviceexperts.filesupload');
    Route::post(
        'serviceexperts/uploadFiles',
        'ServiceExpertsController@filesUploadStore'
    )
        ->name('serviceexperts.filesuploadstore')
        ->middleware('can:serviceexperts.filesupload');
    Route::get(
        'serviceexperts/files/{file}',
        'ServiceExpertsController@filesDownload'
    )
        ->name('serviceexperts.filesdownload')
        ->middleware('can:serviceexperts.files');

    Route::post(
        'serviceexperts/files/delete',
        'ServiceExpertsController@filesDelete'
    )
        ->name('serviceexperts.filesdelete')
        ->middleware('can:serviceexperts.filesdelete');
    //Route::get('serviceexperts/files/{filename}','ServiceExpertsController@filesDownload')->name('serviceexperts.filesdownload')->middleware('can:serviceexperts.files');

    Route::post(
        'serviceexperts/createdirectory',
        'ServiceExpertsController@createDirectory'
    )
        ->name('serviceexperts.filescreatedirectory')
        ->middleware('can:serviceexperts.filescreatedirectory');

    // --------------- Resources --------------- //
    Route::post('users/upload', 'UserController@upload')->name('users.upload');
    Route::post('users/uploadstore', 'UserController@uploadStore')->name(
        'users.uploadStore'
    );
    Route::get(
        'users/upload/downloadusers',
        'UserController@downloadUsersCreated'
    )->name('users.downloadUsersCreated');
    Route::resource('roles', 'RoleController'); //Roles
    Route::resource('users', 'UserController'); //Users

    // --------------- MasterFile --------------- //
    Route::get(
        'management/uploadmasterfile',
        'ManagementController@uploadMasterfile'
    )
        ->name('management.uploadMasterfile')
        ->middleware('can:masterfile.upload');
    Route::post(
        'management/uploadmasterfile',
        'ManagementController@uploadMasterfilePost'
    )
        ->name('management.uploadMasterfilePost')
        ->middleware('can:masterfile.upload');

    Route::get('masterfile/wfh', 'MasterfileController@wfhIndex')->name(
        'masterfile.wfh.index'
    );
    Route::post('masterfile/wfh', 'MasterfileController@wfhStore')->name(
        'masterfile.wfh.store'
    );
    Route::post(
        'masterfile/wfh/update',
        'MasterfileController@wfhUpdate'
    )->name('masterfile.wfh.update');

    Route::post('kaizen/assign', 'KaizenController@assign')->name(
        'kaizen.assign'
    );
    Route::post('kaizen/comment', 'KaizenController@comment')->name(
        'kaizen.comment'
    );
    Route::get(
        'kaizen/{id}/downloadfile/{comment_id?}',
        'KaizenController@downloadfile'
    )->name('kaizen.downloadfile');
    Route::resource('kaizen', 'KaizenController');

    // Reminders

    Route::get(
        'reminder/popup/{reminderUserId}',
        'ReminderController@popup'
    )->name('reminder.popup');
    Route::post(
        'reminder/popup/{reminderUserId}',
        'ReminderController@acknowledge'
    )->name('reminder.acknowledge');
    Route::get('reminder/outbox', 'ReminderController@outbox')->name(
        'reminder.outbox'
    );
    Route::resource('reminder', 'ReminderController');

    // Pandora's Box
    Route::get('pandorasbox', 'PandorasBoxController@index')->name(
        'pandorasbox.index'
    );
    Route::post('pandorasbox', 'PandorasBoxController@store')->name(
        'pandorasbox.store'
    );

    Route::get('logs/{configDate?}', 'LogController@index')->name('logs.index');

    // Payroll Novelty
    Route::resource(
        'payrollnovelty', 'PayrollNoveltyController',
        [
        'only' => ['store', 'update', 'destroy'],
        ]
    );

    Route::get('payrollnovelty/{novelty?}', 'PayrollNoveltyController@index')
        ->name('payrollnovelty.index')
        ->where('novelty', '[0-9]+');
    Route::get(
        'payrollnovelty/pending',
        'PayrollNoveltyController@pending'
    )->name('payrollnovelty.pending');

    Route::post(
        'payrollnovelty/cie10s',
        'PayrollNoveltyController@cie10s'
    )->name('payrollnovelty.cie10s');
    Route::post(
        'payrollnovelty/findemployee',
        'PayrollNoveltyController@findemployee'
    )->name('payrollnovelty.findemployee');
    Route::get(
        'payrollnovelty/downloadflatfile',
        'PayrollNoveltyController@downloadFlatFile'
    )->name('payrollnovelty.downloadFlatFile');
    Route::post(
        'payrollnoveelty/updateTags',
        'PayrollNoveltyController@updateTags'
    )->name('payrollnovelty.updateTags');

    //Payroll Novelty Admin
    Route::get(
        'payrollnovelty/admin',
        'PayrollNoveltyAdminController@index'
    )->name('payrollnovelty.admin.index');
    Route::post(
        'payrollnovelty/admin/smlv',
        'PayrollNoveltyAdminController@smlvSave'
    )->name('payrollnovelty.admin.smlvSave');

    //Payroll Novelty Reports
    Route::get(
        'payrollnovelty/reports/novelties',
        'PayrollNoveltyReportsController@novelties'
    )->name('payrollnovelty.reports.novelties');
    Route::post(
        'payrollnovelty/reports/novelties',
        'PayrollNoveltyReportsController@noveltiesDownload'
    )->name('payrollnovelty.reports.noveltiesDownload');

    Route::get(
        'payrollnovelty/reports/general',
        'PayrollNoveltyReportsController@general'
    )->name('payrollnovelty.reports.general');
    Route::post(
        'payrollnovelty/reports/general',
        'PayrollNoveltyReportsController@generalDownload'
    )->name('payrollnovelty.reports.generalDownload');

    Route::get(
        'payrollnovelty/reports/noveltiesrrhh',
        'PayrollNoveltyReportsController@noveltiesrrhh'
    )->name('payrollnovelty.reports.noveltiesrrhh');
    Route::post(
        'payrollnovelty/reports/noveltiesrrhh',
        'PayrollNoveltyReportsController@noveltiesrrhhDownload'
    )->name('payrollnovelty.reports.noveltiesrrhhDownload');

    // American Water BO Tracker
    Route::get(
        'americanwater/botracker',
        'AmericanWaterBoTrackerController@index'
    )->name('americanwater.botracker');
    Route::post(
        'americanwater/botracker',
        'AmericanWaterBoTrackerController@store'
    )->name('americanwater.botrackerStore');
    Route::post(
        'americanwater/botracker/getlists',
        'AmericanWaterBoTrackerController@getLists'
    )->name('americanwater.getLists');

    Route::get(
        'americanwater/botracker/reports/general',
        'AmericanWaterBoTrackerReportsController@general'
    )->name('americanwater.botracker.reportsGeneral');
    Route::post(
        'americanwater/botracker/reports/general',
        'AmericanWaterBoTrackerReportsController@generalDownload'
    )->name('americanwater.botracker.reportsGeneralDownload');

    // American water filed support tracker

    Route::get(
        'americanwater/fieldsupport/reports/general',
        'AmericanWaterFieldSupportTrackerController@general'
    )->name('americanwater.fieldsupport.reportsGeneral');
    Route::post(
        'americanwater/fieldsupport/reports/general',
        'AmericanWaterFieldSupportTrackerController@generalDownload'
    )->name('americanwater.fieldsupport.reportsGeneralDownload');
    Route::resource(
        'americanwater/fieldsupport',
        'AmericanWaterFieldSupportTrackerController'
    );
    Route::get(
        '/getdatenow', function () {
            return date('Y-m-d H:i:s');
        }
    );

    //Inv
    Route::resource(
        'inventories/proveedores',
        ('InvProveedoresController')::class
    )->middleware('can:inventories.proveedores');
    Route::resource(
        'inventories/activos', ('InvActivosController')::class, [
        'except' => ['show'],
        ]
    )->middleware('can:inventories.activos');

    Route::get(
        'inventories/activos/articulos',
        'InvActivosController@list'
    )->name('activos.list');

    Route::resource(
        'inventories/inactivos',
        ('InvInactivosController')::class
    )->middleware('can:inventories.inactivos');
    Route::resource(
        'inventories/asignacion',
        ('InvAsignacionController')::class
    )->middleware('can:inventories.asignacion');
    Route::post(
        'inventories/asignacion/findemployee',
        'InvAsignacionController@findEmployee'
    )->name('inventories.asignacion.findEmployee');
    Route::post(
        'inventories/asignacion/employeeAssignations',
        'InvAsignacionController@employeeAssignations'
    )->name('inventories.asignacion.employeeAssignations');
    Route::post(
        'inventories/asignacion/findArticulo',
        'InvAsignacionController@findArticulo'
    )->name('inventories.asignacion.findArticulo');
    Route::post(
        'inventories/asignacion/articuloAsignacion',
        'InvAsignacionController@articuloAsignacion'
    )->name('inventories.asignacion.articuloAsignacion');

    Route::resource(
        'inventories/adquisicion',
        ('InvAdquisicionController')::class
    )->middleware('can:inventories.adquisicion');
    Route::post(
        'inventories/adquisicion/buscarArticulo',
        'InvAdquisicionController@buscarArticulo'
    )
        ->name('adquisicion.buscarArticulo')
        ->middleware('can:inventories.adquisicion');
    Route::resource(
        'inventories/bajas',
        ('InvBajaStockController')::class
    )->middleware('can:inventories.bajas');
    Route::resource(
        'inventories/cambios',
        ('InvCambioStockController')::class
    )->middleware('can:inventories.cambios');
    Route::resource(
        'inventories/traslado',
        ('InvTrasladoStockController')::class
    )->middleware('can:inventories.traslado');
    Route::resource(
        'inventories/consulta',
        ('InvConsultaStockController')::class
    )->middleware('can:inventories.consulta');

    Route::get(
        '/searchArchivos',
        'InvConsultaStockController@searchArchivos'
    )->name('searchArchivos');

    Route::post(
        '/app/InvArticulos', [
        'as' => 'Articulo',
        'uses' => 'selectsController@Articulo',
        ]
    );
    Route::get(
        '/searchInvArticulo',
        'InvAsignacionController@searchInvArticulo'
    );
    Route::get(
        'inventories/proveedores/{id}',
        'InvAdquisicionController@getAdquisicionById'
    );
    Route::post(
        '/app/Empresas', [
        'as' => 'Empresa',
        'uses' => 'InvAdquisicionController@buscarProveedor',
        ]
    );
    Route::post(
        '/app/Atributo', [
        'as' => 'Atributo',
        'uses' => 'InvAdquisicionController@buscarAtributo',
        ]
    );
    Route::post(
        '/app/Articulo', [
        'as' => 'Articulo',
        'uses' => 'InvAsignacionController@buscarArticulo',
        ]
    );
    Route::post(
        '/app/Responsable', [
        'as' => 'Responsable',
        'uses' => 'InvAsignacionController@buscarResponsable',
        ]
    );
    Route::post(
        '/app/Asignacion', [
        'as' => 'Asignacion',
        'uses' => 'InvAsignacionController@buscarAsignacion',
        ]
    )
        ->name('asignacion.buscarAsignacion')
        ->middleware('can:inventories.adquisicion');

    // Daily Sessions
    Route::post(
        '/dailysessions/download',
        'DailySessionController@download'
    )->name('dailysession.download');
    Route::get('/dailysessions/admin', 'DailySessionController@admin')->name(
        'dailysession.admin'
    );
    Route::post(
        '/dailysessions/admin/savepositions',
        'DailySessionController@savePositions'
    )->name('dailysession.admin.savePositions');
    Route::resource('dailysessions', 'DailySessionController');
    Route::put(
        '/dailysessions/acknowledge/{dailySession}',
        'DailySessionController@acknowledge'
    )->name('dailysession.acknowledge');

    // Trivias
    Route::get('trivias/admin', 'TriviaController@admin')->name(
        'trivias.admin'
    );
    Route::put('trivias/download', 'TriviaController@download')->name(
        'trivias.download'
    );
    Route::post('trivias/answer', 'TriviaController@answer')->name(
        'trivias.answer'
    );
    Route::resource('trivias', 'TriviaController');

    // Reporting Links
    Route::get(
        '/reporting/links/scorecard',
        'ReportingLinkController@scorecard'
    )->name('links.scorecard');
    Route::get(
        '/reporting/links/dashboard',
        'ReportingLinkController@dashboard'
    )->name('links.dashboard');
    Route::resource(
        'reporting/links', 'ReportingLinkController', [
        'only' => ['index', 'create', 'store', 'edit', 'update'],
        ]
    );
    // Prenomina
    Route::get('/prenomina', 'PrenominaController@index')->name(
        'prenomina.index'
    );
    Route::post(
        '/prenomina/getpayroll',
        'PrenominaController@getPayroll'
    )->name('prenomina.getPayroll');
    Route::post(
        '/prenomina/getemployees',
        'PrenominaController@getEmployees'
    )->name('prenomina.getEmployees');

    Route::get(
        '/prenomina/adjustments',
        'PrenominaAdjustmentController@index'
    )->name('prenomina.adjustments');
    Route::get(
        '/prenomina/adjustments/pending/',
        'PrenominaAdjustmentController@pending'
    )->name('prenomina.adjustments.pending');
    Route::get(
        '/prenomina/adjustments/{adjustment}',
        'PrenominaAdjustmentController@show'
    )->name('prenomina.adjustments.show');
    Route::get(
        '/prenomina/adjustments/create/{activity_code}',
        'PrenominaAdjustmentController@create'
    )->name('prenomina.adjustments.create');
    Route::post(
        '/prenomina/adjustments',
        'PrenominaAdjustmentController@store'
    )->name('prenomina.adjustments.store');
    Route::post(
        '/prenomina/adjustments/approve/{id}',
        'PrenominaAdjustmentController@approve'
    )->name('prenomina.adjustments.approve');
    Route::post(
        '/prenomina/adjustments/approveall',
        'PrenominaAdjustmentController@approveAll'
    )->name('prenomina.adjustments.approveall');
    Route::post(
        '/prenomina/adjustments/offsetholiday',
        'PrenominaAdjustmentController@offsetHoliday'
    )->name('prenomina.adjustments.offsetholiday');
    Route::post(
        '/prenomina/adjustments/justifyabsence',
        'PrenominaAdjustmentController@justifyAbsence'
    )->name('prenomina.adjustments.justifyabsence');
    Route::post(
        '/prenomina/adjustments/exception',
        'PrenominaAdjustmentController@exception'
    )->name('prenomina.adjustments.exception');

    Route::get('/prenomina/admin', 'PrenominaAdminController@index')->name(
        'prenomina.admin'
    );
    Route::post(
        '/prenomina/admin/savepositions',
        'PrenominaAdminController@savePositions'
    )->name('prenomina.admin.savePositions');
    Route::post(
        '/prenomina/admin/saveemailsreportadjustmentspending',
        'PrenominaAdminController@saveEmailsReportAdjustmentsPending'
    )->name('prenomina.admin.saveEmailsReportAdjustmentsPending');
    Route::post(
        '/prenomina/admin/saveconfigs',
        'PrenominaAdminController@saveConfigs'
    )->name('prenomina.admin.saveConfigs');

    Route::get(
        'moduurn/calltracker/reports/general',
        'ModuurnCalltrackerController@general'
    )->name('moduurn.calltracker.reportsGeneral');
    Route::post(
        'moduurn/calltracker/reports/general',
        'ModuurnCalltrackerController@generalDownload'
    )->name('moduurn.calltracker.reportsGeneralDownload');
    Route::resource(
        'moduurn/calltracker', 'ModuurnCalltrackerController', [
        'as' => 'moduurn',
        ]
    );

    Route::get(
        'dearservice/tracker/reports/general',
        'DearServiceController@general'
    )->name('dearservice.tracker.reportsGeneral');
    Route::post(
        'dearservice/tracker/reports/general',
        'DearServiceController@generalDownload'
    )->name('dearservice.tracker.reportsGeneralDownload');
    Route::resource('dearservice/tracker', 'DearServiceController');

    Route::resource(
        'developers/testLab', 'DevelopersTestController'
    );
}

);

Auth::routes(['register' => false]);
