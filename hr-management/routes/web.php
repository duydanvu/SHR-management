<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//route login,logout
Route::get('/','Auth\CustomAuthController@showLoginForm')->name('login');
Route::post('/','Auth\CustomAuthController@login')->name('login_process');
Route::post('/logout','Auth\CustomAuthController@logout')->name('logout');

Route::group(['middleware' => ['web','checkLogOut']],function (){
    Route::get('/home', 'HomeController@index')->name('dashboard');

    // route area
    Route::get('/admin/area','AreaController@listArea')->name('show_list_area');
    Route::post('/admin/area/addnew','AreaController@addNewArea')->name('add_new_area');
    Route::get('/admin/area/view_update/{id}','AreaController@viewUpdateArea')->name('admin_list_update_area');
    Route::post('/admin/area/update','AreaController@updateInforArea')->name('update_information_area');
    Route::get('/admin/area/delete/{id}','AreaController@deleteArea')->name('delete_information_area');

    //route store
    Route::get('/admin/store','StoresController@index')->name('show_list_store');
    Route::post('/admin/store/addnew','StoresController@store')->name('add_new_store');
    Route::get('/admin/store/view_update/{id}','StoresController@edit')->name('view_update_store');
    Route::post('/admin/store/update','StoresController@update')->name('update_information_store');
    Route::get('/admin/store/delete/{id}','StoresController@destroy')->name('delete_information_store');

    //route contract
    Route::get('/admin/contract','ContractController@index')->name('show_list_contract');
    Route::post('/admin/contract/addnew','ContractController@store')->name('add_new_contract');
    Route::get('/admin/contract/view_update/{id}','ContractController@edit')->name('view_update_contract');
    Route::post('/admin/contract/update','ContractController@update')->name('update_information_contract');
    Route::get('/admin/contract/delete/{id}','ContractController@destroy')->name('delete_information_contract');

    //route departments
    Route::get('/admin/department','DepartmentController@index')->name('show_list_department');
    Route::post('/admin/department/addnew','DepartmentController@store')->name('add_new_department');
    Route::get('/admin/department/view_update/{id}','DepartmentController@edit')->name('view_update_department');
    Route::post('/admin/department/update','DepartmentController@update')->name('update_information_department');
    Route::get('/admin/department/delete/{id}','DepartmentController@destroy')->name('delete_information_department');

    //route Services
    Route::get('/admin/service','ServicesController@index')->name('show_list_service');
    Route::post('/admin/service/addnew','ServicesController@store')->name('add_new_service');
    Route::get('/admin/service/view_update/{id}','ServicesController@edit')->name('view_update_service');
    Route::post('/admin/service/update','ServicesController@update')->name('update_information_service');
    Route::get('/admin/service/delete/{id}','ServicesController@destroy')->name('delete_information_service');

    //route Position
    Route::get('/admin/position','PositionController@index')->name('show_list_position');
    Route::post('/admin/position/addnew','PositionController@store')->name('add_new_position');
    Route::get('/admin/position/view_update/{id}','PositionController@edit')->name('view_update_position');
    Route::post('/admin/position/update','PositionController@update')->name('update_information_position');
    Route::get('/admin/position/delete/{id}','PositionController@destroy')->name('delete_information_position');

    //route user
    Route::get('/admin/user','UserController@index')->name('show_list_user');
    Route::post('/admin/user/addnew','UserController@store')->name('add_new_user');
    Route::get('/admin/user/view_update/{id}','UserController@viewUpdate')->name('view_update_user');
    Route::post('/admin/user/update','UserController@update')->name('update_information_user');
    Route::get('/admin/user/delete/{id}','UserController@destroy')->name('delete_information_user');
    Route::get('/admin/user/view_update_detail/{id}','UserController@edit_detail')->name('view_update_user_detail');
    Route::post('/admin/user/update/detail','UserController@update_detail')->name('update_information_user_detail');
    Route::post('/admin/user/area_store','UserController@store_area')->name('search_store_area');
    Route::get('/admin/user/view_update_image/{id}','UserController@viewImage')->name('view_update_user_image');
    Route::post('/admin/user/update_image','UserController@updateImage')->name('update_information_user_image');
    Route::post('/admin/user/import_view','UserController@import')->name('import');
    Route::post('/admin/user/search_user_with_store','UserController@search_user_with_store')->name('search_user_with_store');


    //route report
    Route::get('/report/report_with_time','ReportController@showReportTime')->name('show_report_time');
    Route::get('/report/view_detail/{id}','ReportController@view_detail')->name('view_user_detail_report');
    Route::post('/report/export/user','ReportController@export_users')->name('export_report_user');
    Route::get('/report/report_with_user','ReportController@showDetailTime')->name('show_report_detail');
    Route::post('/report/report_search','ReportController@searchReport')->name('search_date_time');

    //timesheets
    Route::get('/timekeeping/timekeeping_for_staff','RequestController@logsTimesheets')->name('show_log_time_sheets');
    Route::get('/timekeeping/request_timekeeping','RequestController@checkRequest')->name('show_request_staff');
    Route::get('/timekeeping/add_view_time_sheet/{id}','RequestController@addViewTimesheet')->name('show_view_add_time_sheet');
    Route::post('/timerkeeping/add_time_sheets','RequestController@addTimeSheet')->name('add_time_sheet_for_staff');
    Route::get('/timekeeping/view_update_request_time/{id}','RequestController@updateTimesheet')->name('show_view_update_time_sheet');
    Route::post('/timekeeping/add_time_sheets_cht','RequestController@addTimesheetCht')->name('add_logtime_cht');
    Route::get('/timekeeping/view_request_logtime/{id}','RequestController@viewRequestStaff')->name('view_request_staff');
    Route::post('/timekeeping/request/update_with_request','RequestController@updateWithRequest')->name('add_request_with_log_time_sheet');
    Route::post('/timekeeping/time_sheet/update_time_sheet','RequestController@updaeTimeSheetStoreManage')->name('update_time_sheet_for_store_manage');
    Route::get('/request/timesheet/update_request/{id}','RequestController@updateTimesheetWithTime')->name('update_timesheet_with_request_staff');
    Route::post('/request/timesheet/update_request/update_status','RequestController@updateStatusTimesheetWithTime')->name('update_request_with_log_time_sheet');
    Route::get('/request/timesheet/dismiss_request/{id}','RequestController@dismissTimesheetWithTime')->name('dismiss_timesheet_with_request_staff');

    Route::get('/request/report_view','RequestController@viewReportTimesheet')->name('view_request_report');

    //route upload file
    Route::post('/file/upload_file','FileImageController@doUpdload')->name('upload_file_image');
});
