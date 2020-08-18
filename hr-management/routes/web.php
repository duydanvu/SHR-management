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
    Route::get('/admin/area/view_update','AreaController@viewUpdateArea')->name('admin_list_update_area');

    //route store
    Route::get('/admin/store','StoresController@index')->name('show_list_store');

    //route user
    Route::get('/admin/user','UserController@index')->name('show_list_user');

    //route report
    Route::get('/report/report_with_time','ReportController@showReportTime')->name('show_report_time');
    Route::get('/report/report_with_user','ReportController@showDetailTime')->name('show_report_detail');

    //timesheets
    Route::get('/timekeeping/timekeeping_for_staff','RequestController@logsTimesheets')->name('show_log_time_sheets');
    Route::get('/timekeeping/request_timekeeping','RequestController@checkRequest')->name('show_request_staff');

    //route upload file
    Route::post('/file/upload_file','FileImageController@doUpdload')->name('upload_file_image');
});
