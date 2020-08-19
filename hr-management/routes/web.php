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

    //route report
    Route::get('/report/report_with_time','ReportController@showReportTime')->name('show_report_time');
    Route::get('/report/report_with_user','ReportController@showDetailTime')->name('show_report_detail');

    //timesheets
    Route::get('/timekeeping/timekeeping_for_staff','RequestController@logsTimesheets')->name('show_log_time_sheets');
    Route::get('/timekeeping/request_timekeeping','RequestController@checkRequest')->name('show_request_staff');

    //route upload file
    Route::post('/file/upload_file','FileImageController@doUpdload')->name('upload_file_image');
});
