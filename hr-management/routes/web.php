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
    Route::get('/home1', 'HomeController@index_system')->name('dashboard2');

    //route home quan ly nhan su
    Route::get('/home/detail_staff_of_company/{id}','HomeController@detail_nv_of_company')->name('detail_nv_of_company');
    Route::get('/home/detail_KAM_of_company/{id}','HomeController@detail_KAM_of_company')->name('detail_KAM_of_company');
    Route::get('/home/detail_AM_of_company/{id}','HomeController@detail_AM_of_company')->name('detail_AM_of_company');
    Route::get('/home/detail_GDV_of_company/{id}','HomeController@detail_GDV_of_company')->name('detail_GDV_of_company');

    //admin1
    Route::get('/admin1/view','Admin1Controller@index')->name('view_list_account_admin_lv2');
    Route::get('/admin1/search_update/{id}','Admin1Controller@search_user_update')->name('search_view_update_admin_lv2');
    Route::post('/admin1/update_account_user','Admin1Controller@update_account_user')->name('update_account_admin_lv2');
    Route::post('/admin1/add_account_admin_lv2','Admin1Controller@add_account_user')->name('add_account_admin_lv2');
    Route::post('/admin1/search_ajax_admin_lv2','Admin1Controller@search_ajax_admin_lv2')->name('search_ajax_admin_lv2');

    //admin1/warehouse
    Route::get('/admin1/warehouse','Admin1Controller@index_warehouse')->name('home_manager_warehouse');
    Route::post('/admin/warehouse','Admin1Controller@addWarehouse')->name('add_warehouse');
    Route::get('/admin1/warehouse/{id}','Admin1Controller@searchWarehouse')->name('search_Warehouse');
    Route::get('/admin1/warehouse/status/{id}','Admin1Controller@updateStatusWarehouse')->name('update_status_Warehouse');
    Route::post('/admin1/warehouse/update','Admin1Controller@updateWarehouse')->name('update_Warehouse');

    //admin1/connect/landingpage
    Route::get('/admin1/connect/landingpage','Admin1Controller@index_connect_landing_page')->name('connect_landing_page');
    Route::get('/admin1/connect/landingpage/product/{id}','Admin1Controller@connect_landing_page')->name('connect_landingpage');
    Route::get('/admin1/connect/doi_tac/product/{id}','Admin1Controller@connect_doi_tac')->name('connect_doi_tac');
    Route::post('/admin1/connect/landing_page','Admin1Controller@updateLandingPage')->name('update_landing_page');
    Route::post('/admin1/connect/doi_tac','Admin1Controller@updateDoiTac')->name('update_doi_tac');


    //admin2/chuyen_san_pham
    Route::get('/admin2/chuyen_san_pham','Admin2Controller@chuyen_san_pham')->name('chuyen_san_pham');

    //admin2/tiep_nhan_san_pham
    Route::get('/admin2/tiep_nhan_san_pham','Admin2Controller@tiep_nhan_san_pham')->name('tiep_nhan_san_pham');

    //admin2
    Route::get('/admin2/view','Admin2Controller@index')->name('view_list_account_user');
    Route::resource('ajaxUserWebsSellProduct','Admin2Controller');
    Route::get('/admin2/search_update/{id}','Admin2Controller@search_user_update')->name('search_view_update_user');
    Route::post('/admin2/add_user2','Admin2Controller@add_account_user')->name('add_new_acc_user');
    Route::post('/admin2/update_user2','Admin2Controller@update_account_user')->name('update_account_user_sts');

    Route::get('/admin2/group','Admin2Controller@group')->name('view_list_group_user');
    Route::post('/admin2/group/create','Admin2Controller@createGroup')->name('create_group_for_user');
    Route::get('/admin2/add_to_group/{id}','Admin2Controller@addUserToGroup')->name('add_user_to_group');
    Route::get('/admin2/list_user_of_group/{id}','Admin2Controller@list_user_of_group')->name('list_user_of_group');
    Route::get('/admin2/han_muc/{id}','Admin2Controller@view_han_muc_user')->name('view_han_muc_tung_user');
    Route::post('/admin2/update_han_muc_cho_user','Admin2Controller@update_han_muc')->name('update_han_muc_cho_user');
    Route::get('/admin2/view_lock_account/{id}','Admin2Controller@view_lock_account')->name('view_lock_account');
    Route::post('/admin2/action_lock_account','Admin2Controller@action_lock_account')->name('action_lock_account');
    Route::post('/admin2/insert_to_group','Admin2Controller@insertUserToGroup')->name('add_user_group');
    Route::post('/admin2/insert_asm_to_group','Admin2Controller@insertASMforGroup')->name('add_asm_group');
    Route::post('/admin2/leave_user_from_group','Admin2Controller@leave_user_from_group')->name('leave_user_from_group');

    Route::get('/admin2/add_asm_to_group/{id}','Admin2Controller@addASMToGroup')->name('add_asm_to_group');
    Route::get('/admin2/add_wh_to_group/{id}','Admin2Controller@addWarehouseToGroup')->name('add_wh_to_group');
    Route::get('/admin2/detail_product_on_wh/{id}','Admin2Controller@detailProductOnWh')->name('chi_tiet_san_pham_trong_kho');
    Route::post('/admin2/insert_wh_for_group','Admin2Controller@insertWHforGroup')->name('add_wh_group');

    //admin2/supplier
    Route::get('/admin2/supplier','Admin2Controller@index_supplier')->name('home_manager_supplier');
    Route::post('/admin2/supplier/add','Admin2Controller@addSupplier')->name('add_supplier');
    Route::get('/admin2/supplier/{id}','Admin2Controller@searchSupplier')->name('search_supplier');
    Route::get('/admin2/supplier/status/{id}','Admin2Controller@updateStatusSupplier')->name('update_status_supplier');
    Route::post('/admin2/supplier/update','Admin2Controller@updateSupplier')->name('update_supplier');

    //admin2/banner
    Route::get('/admin2/banner_manager','Admin2Controller@index_banner')->name('home_mange_banner');
    Route::get('/admin2/manager_list_banner','Admin2Controller@manager_list_banner')->name('manager_list_banner');
    Route::get('/admin2/view_edit_banner/{id}','Admin2Controller@view_edit_banner')->name('view_edit_banner');
    Route::post('/admin2/banner_add','Admin2Controller@add_banner')->name('add_banner');
    Route::post('/admin2/update_infor_banner','Admin2Controller@update_infor_banner')->name('update_infor_banner');

    //admin2/transporter
    Route::get('/admin2/transporter','Admin2Controller@index_transporter')->name('home_manager_transporter');
    Route::post('/admin2/transporter/add','Admin2Controller@addTransporter')->name('add_transporter');
    Route::get('/admin2/transporter/{id}','Admin2Controller@searchTransporter')->name('search_transporter');
    Route::get('/admin2/transporter/status/{id}','Admin2Controller@updateStatusTransporter')->name('update_status_transporter');
    Route::post('/admin2/transporter/update','Admin2Controller@updateTransporter')->name('update_transporter');

    //admin2/chuong trinh khuyen mai
    Route::get('/admin2/sales_product','Admin2Controller@indexSaleProduct')->name('home_sales_product');
    Route::post('/admin2/add_sales_product','Admin2Controller@addSaleProduct')->name('add_sale_product');
    Route::get('/admin2/list_sales_product','Admin2Controller@listSaleProduct')->name('list_sale_product');
    Route::get('/admin2/search_sales_product/{id}','Admin2Controller@searchSalesProduct')->name('search_sales_product');
    Route::post('/admin2/update_sale_product','Admin2Controller@updateSaleProduct')->name('update_sale_product');

    //admin2/tao giai thuong thi dua
    Route::get('/admin2/add_reward_emulation','Admin2Controller@addRewardEmulation')->name('add_reward_emulation');
    Route::post('/admin2/add_reward_for_emulation','Admin2Controller@insertRewardEmulation')->name('add_reward_for_emulation');

    //admin2/chuong trinh thi dua
    Route::get('/admin2/emulation_product','Admin2Controller@indexEmulationProduct')->name('home_emulation_product');
    Route::post('/admin2/add_emulation_product','Admin2Controller@addEmulationProduct')->name('add_emulation_product');
    Route::get('/admin2/list_emulation_product','Admin2Controller@listEmulationProduct')->name('list_emulation_product');
    Route::get('/admin2/add_product_to_emulation/{id}','Admin2Controller@addProductToEmulation')->name('add_product_to_emulation');
    Route::get('/admin2/add_group_to_emulation/{id}','Admin2Controller@addGroupToEmulation')->name('add_group_to_emulation');
    Route::get('/admin2/edit_information_emulation/{id}','Admin2Controller@editInformationEmulation')->name('edit_information_emulation');
    Route::post('/admin2/update_add_product_emulation','Admin2Controller@updateAddProductEmulation')->name('update_add_product_emulation');
    Route::post('/admin2/update_add_group_emulation','Admin2Controller@updateAddGroupEmulation')->name('update_add_group_emulation');
    Route::post('/admin2/update_information_product_emulation','Admin2Controller@updateInformationProductEmulation')
        ->name('update_information_product_emulation');
    Route::get('/admin2/list_product_detail_to_emulation/{id}','Admin2Controller@listProductDetailEmulation')->name('list_product_detail_to_emulation');
    Route::get('/admin2/update_total_product_emulation/{id}/{id_emu}','Admin2Controller@updateTotalProductEmulation')
        ->name('update_total_product_emulation');
    Route::post('/admin2/edit_total_product_emulation','Admin2Controller@edit_total_product_emulation')->name('edit_total_product_emulation');

    //admin2/giao muc tieu ban hang
    Route::get('/admin2/goal_product','Admin2Controller@indexGoalProduct')->name('home_goal_product');
    Route::post('/admin2/add_goal-product','Admin2Controller@addGoalProduct')->name('add_goal_product');
    Route::get('/admin2/list_goal_product','Admin2Controller@listGoalProduct')->name('list_goal_product');
    Route::get('/admin2/add_product_to_goal/{id}','Admin2Controller@addProductToGoal')->name('add_product_to_goal');
    Route::get('/admin2/add_asm_to_goal/{id}','Admin2Controller@addAsmToGoal')->name('add_asm_to_goal');
    Route::post('/admin2/update_add_product_goal','Admin2Controller@updateAddProductGoal')->name('update_add_product_goal');
    Route::post('/admin2/update_add_asm_goal','Admin2Controller@updateAddAsmGoal')->name('update_add_asm_goal');
    Route::get('/admin2/view_update_information_goal/{id}','Admin2Controller@viewUpdateInformationGoal')
        ->name('view_update_information_goal');
    Route::post('/admin2/update_information_goal','Admin2Controller@updateInformationGoal')->name('update_information_goal');

    //admin2/product
    Route::get('/admin2/product','Admin2Controller@index_products')->name('home_manager_product');
    Route::get('/admin2/product/add/new','Admin2Controller@indexAddNewProducts')->name('add_new_product');
    Route::post('/admin2/product/add','Admin2Controller@addProduct')->name('add_product');
    Route::get('/admin2/product/{id}','Admin2Controller@searchProduct')->name('search_product');
    Route::get('/admin2/product/update/{id}','Admin2Controller@updateStatusProduct')->name('update_status_product');
    Route::get('/admin2/product/search_image/{id}','Admin2Controller@viewImagePrduct')->name('search_image_product');
    Route::post('/admin2/product/update_image','Admin2Controller@updateImagePrduct')->name('update_image_product');

    //report admin2
    Route::get('/admin2/report_sale','Admin2Controller@reportSale')->name('report_sale_product');
    Route::get('/admin2/report_warehouse','Admin2Controller@reportWarehouse')->name('report_warehouse_product');

    // view chuyen san pham gia cac kho
    Route::get('/admin2/product/transport_warehouse/{id}','Admin2Controller@transportProductToWarehouse')->name('view_chuyen_san_pham_warehouse');
    Route::post('/admin2/product/warehouse_to_warehouse','Admin2Controller@actionWarehouseToWarehouse')->name('action_warehouse_to_warehouse');
    Route::get('/admin2/accept_w2w/{id}','Admin2Controller@acceptW2W')->name('accept_w2w');
    Route::post('/admin2/accept_w2w/action_update','Admin2Controller@acceptActionW2W')->name('action_accept_w2w');

    Route::post('/admin2/product/update','Admin2Controller@updateProduct')->name('update_product');
    Route::get('/admin2/product/receive_product/{id}','Admin2Controller@receiveProductView')->name('tim_san_pham_de_nhap');
    Route::get('/admin2/product/return_product/{id}','Admin2Controller@returnProductView')->name('tim_san_pham_de_tra');

    Route::post('/admin2/product/import_total_product','Admin2Controller@importTotalProduct')->name('import_total_product');
    Route::post('/admin2/product/export_total_product','Admin2Controller@exportTotalProduct')->name('export_total_product');

    //ajax tim kiem hang ton
    Route::post('admin2/warehouse/total_product','Admin2Controller@searchTotalProduct')->name('search_total_product');

    //admin2/product_decentralization
    Route::get('/admin2/product_decentralization','Admin2Controller@index_products_decentralization')->name('home_product_decentralization');
    Route::get('/admin2/product_decentralization/group/{id}','Admin2Controller@products_decentralization_list_group')
        ->name('list_product_decentralization_with_group');
    Route::post('/admin2/add_product_for_group','Admin2Controller@addProductForGroup')->name('add_group_to_sell_product');

    // route hoan ung tien
    Route::get('admin2/danh_sach_hoan_ung','Admin2Controller@listHoanUng')->name('danh_sach_hoan_ung_admin2');
    Route::get('admin2/view_detail_hoan_ung/{id}','Admin2Controller@view_detail_hoan_ung')->name('view_detail_hoan_ung_admin2');
    Route::post('admin2/action_update_hoan_ung_admin2','Admin2Controller@action_update_hoan_ung_admin2')
        ->name('action_update_hoan_ung_admin2');

    //import lock acc and han muc
    Route::post('/admin2/import_lock_acc','Admin2Controller@import_lock_acc')->name('import_lock_acc');
    Route::post('/admin2/import_han_muc','Admin2Controller@import_han_muc')->name('import_han_muc');


    //ajax
    Route::post('/admin2/search_list_acc_admin_lv2','Admin2Controller@searchListAccAdminLv2')->name('search_list_acc_with_area_name');
    Route::post('/admin2/searchListProduct','Admin2Controller@searchListProduct')->name('search_list_product_report');
    Route::post('/admin2/ajaxSearchReportSale','Admin2Controller@ajaxSearchReportSale')->name('search_report_sale_ad2');
    Route::post('/admin2/ajaxSearchReportHoanUng','Admin2Controller@searchReportHoanUng')->name('search_report_hoan_ung');
    Route::post('/admin2/searchReportHoanUngUser2','User2Controller@searchReportHoanUngUser2')->name('search_report_hoan_ung_user2');
    Route::post('/admin2/search_report_hoa_hong_user2','User2Controller@searchReportHoaHongUser2')->name('search_report_hoa_hong_user2');


    Route::post('/admin2/search_han_muc_thu_tien','Admin2Controller@search_han_muc_thu_tien')->name('search_han_muc_thu_tien');
    Route::post('/admin2/search_account_active','Admin2Controller@search_account_active')->name('search_account_active');
    Route::post('/admin2/search_group_with_name_or_id_group','Admin2Controller@search_ajax_group_with_infor')->name('search_group_with_name_or_id_group');

    Route::get('/admin2/add_han_muc','Admin2Controller@viewHanMuc')->name('view_han_muc_user');
    Route::get('/admin2/lock_acc_user','Admin2Controller@lockAccUser')->name('view_list_lock_acc_user');
    Route::get('/admin2/view_information','Admin2Controller@view_information')->name('view_information_user_auth');

    Route::post('/admin2/update_password_for_user','Admin2Controller@update_password_for_user')->name('update_password_for_user');
    Route::post('/admin2/update_information_auth_user','Admin2Controller@update_information_auth_user')->name('update_information_auth_user');

    //user1
    Route::get('/user1/lock_acc_user','User1Controller@lockAccUser')->name('view_list_lock_acc_user2');
    Route::get('/user1/view_information','User1Controller@view_information')->name('view_information_user1_auth');
    Route::post('/user1/search_user_with_user1','User1Controller@search_user_with_user1')->name('search_user_with_user1');
    Route::get('/user1/view_user_with_sale_product/{id}','User1Controller@view_user_with_sale_product')->name('view_user_with_sale_product');
    Route::get('/user1/update_user_to_sale_product/{id}','User1Controller@updateUserSaleProduct')->name('update_user_to_sale_product');

    //user1/danh_sach_hoan_ung
    Route::get('/user1/danh_sach_hoan_ung','User1Controller@danhSachHoanUng')->name('dannh_sach_hoan_ung');

    //user1/phan_quyen_san_pham
    Route::get('/user1/phan_quyen_san_pham','User1Controller@phanQuyenSanPham')->name('phan_quyen_san_pham');

    //user2/danh sach san pham kha dung
    Route::get('/user2/list_product','User2Controller@list_product')->name('danh_sach_san_pham_kha_dung');
    Route::get('/user2/view_manage_goal','User2Controller@view_manage_goal')->name('view_manage_goal_user2');
    Route::get('/user2/chi_tiet_muc_tieu_ban_hang/{id}','User2Controller@chi_tiet_muc_tieu_ban_hang')->name('chi_tiet_muc_tieu_ban_hang');
    Route::get('/user2/notification','User2Controller@notification')->name('notification_user2');

    Route::get('/user2/view_manage_emulation','User2Controller@view_manage_emulation')->name('view_manage_emulation_user2');
    Route::get('/user2/list_view_product','User2Controller@list_view_product')->name('view_danh_sach_san_pham');
    Route::get('/user2/view_detail_product_user2/{id}','User2Controller@view_detail_product_user2')->name('view_detail_product_user2');
    Route::get('/user2/view_list_detail_product','User2Controller@view_list_product_user2')->name('view_list_product_detail');
    Route::get('/view_list_emulation_detail/{id}','User2Controller@view_list_emulation_detail')->name('view_list_emulation_detail');

    Route::post('/user2/add_new_sell_product','User2Controller@add_new_sell_product')->name('add_new_sell_product');
    Route::post('/user2/add_new_sell_product_code','User2Controller@add_new_sell_product_code')->name('add_new_sell_product_code');
    Route::get('/user2/chi_tiet_hoa_hong_san_pham/{id}','User2Controller@detail_hoa_hong')->name('chi_tiet_hoa_hong_san_pham');

    Route::get('user2/danh_sach_hoan_ung','User2Controller@hoan_ung')->name('danh_sach_hoan_ung');
    Route::get('user2/danh_sach_hoa_hong','User2Controller@shippingProduct')->name('danh_sach_giao_hang');
    Route::get('user2/view_detail_hoan_ung/{id}','User2Controller@view_detail_hoan_ung')->name('view_detail_hoan_ung');
    Route::get('user2/view_detail_shipping/{id}','User2Controller@view_detail_shipping')->name('view_detail_shipping');
    Route::post('user2/action_update_hoan_ung_user2','User2Controller@action_update_hoan_ung_user2')->name('action_update_hoan_ung_user2');

    Route::post('user2/add_more_image','FileImageController@uploadMoreImage')->name('add_more_image');
    Route::get('analysis/goal-product','User2Controller@viewAnalysisGoal')->name('view_list_analys_goal');
    Route::get('analysis/emulation-product','User2Controller@viewAnalysisEmulation')->name('view_list_analys_emulation');

    //route ktkt
    Route::get('ktkt/danh_sach_hoan_ung','KtktController@listHoanUng')->name('danh_sach_hoan_ung_kt');
    Route::get('ktkt/view_detail_hoan_ung/{id}','KtktController@view_detail_hoan_ung')->name('view_detail_hoan_ung_kt');
    Route::post('ktkt/action_update_hoan_ung_ktkt','KtktController@action_update_hoan_ung_ktkt')
        ->name('action_update_hoan_ung_ktkt');


    // route area
    Route::get('/admin/area','AreaController@listArea')->name('show_list_area');
    Route::post('/admin/area/addnew','AreaController@addNewArea')->name('add_new_area');
    Route::get('/admin/area/view_update/{id}','AreaController@viewUpdateArea')->name('admin_list_update_area');
    Route::post('/admin/area/update','AreaController@updateInforArea')->name('update_information_area');
    Route::get('/admin/area/delete/{id}','AreaController@deleteArea')->name('delete_information_area');
    Route::get('/admin/area/export','AreaController@export_area')->name('export_report_area');

    //route store
    Route::get('/admin/store','StoresController@index')->name('show_list_store');
    Route::post('/admin/store/addnew','StoresController@store')->name('add_new_store');
    Route::get('/admin/store/view_update/{id}','StoresController@edit')->name('view_update_store');
    Route::post('/admin/store/update','StoresController@update')->name('update_information_store');
    Route::get('/admin/store/delete/{id}','StoresController@destroy')->name('delete_information_store');
    Route::get('/admin/store/view_store_area/{id}','StoresController@view_all_store_of_area')->name('view_store_of_area');
    Route::get('/admin/store/export','StoresController@export_stores')->name('export_report_stores');
    Route::resource('ajaxstores','StoresController');

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
    Route::resource('ajaxuser','UserController');
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
    Route::get('/admin/user/view_user_of_store/{id}','UserController@view_user_of_store')->name('view_user_of_store');
    Route::get('/admin/user/view_user_of_position/{id}','UserController@view_user_of_position')->name('view_user_of_position');
    Route::get('/admin/user/view_user_of_contract/{id}','UserController@view_user_of_contract')->name('view_user_of_contract');
    Route::get('/admin/user/view_user_of_department/{id}','UserController@view_user_of_department')->name('view_user_of_department');
    Route::get('/admin/user/view_user_of_service/{id}','UserController@view_user_of_service')->name('view_user_of_service');

    //route report
    Route::get('/report/report_with_time','ReportController@showReportTime')->name('show_report_time');
    Route::get('/report/view_detail/{id}','ReportController@view_detail')->name('view_user_detail_report');
    Route::post('/report/export/user','ReportController@export_users')->name('export_report_user');
    Route::get('/report/report_with_user','ReportController@showDetailTime')->name('show_report_detail');
    Route::post('/report/report_search','ReportController@searchReport')->name('search_date_time');

    //timesheets
    Route::get('/timekeeping/timekeeping_for_staff','RequestController@logsTimesheets')->name('show_log_time_sheets');
    Route::get('/timekeeping/request_timekeeping','RequestController@checkRequest')->name('show_request_staff');
    Route::get('/timekeeping/request_timekeeping/request_month','RequestController@checkTimesheetMonth')->name('show_timesheet_staff');
    Route::get('/timekeeping/add_view_time_sheet/{id}','RequestController@addViewTimesheet')->name('show_view_add_time_sheet');
    Route::post('/timerkeeping/add_time_sheets','RequestController@addTimeSheet')->name('add_time_sheet_for_staff');
    Route::get('/timekeeping/view_update_request_time/{id}/{date}','RequestController@updateTimesheet')->name('show_view_update_time_sheet');
    Route::post('/timekeeping/add_time_sheets_cht','RequestController@addTimesheetCht')->name('add_logtime_cht');
    Route::get('/timekeeping/view_request_logtime/{id}','RequestController@viewRequestStaff')->name('view_request_staff');
    Route::post('/timekeeping/request/update_with_request','RequestController@updateWithRequest')->name('add_request_with_log_time_sheet');
    Route::post('/timekeeping/time_sheet/update_time_sheet','RequestController@updaeTimeSheetStoreManage')->name('update_time_sheet_for_store_manage');
    Route::get('/request/timesheet/update_request/{id}','RequestController@updateTimesheetWithTime')->name('update_timesheet_with_request_staff');
    Route::post('/request/timesheet/update_request/update_status','RequestController@updateStatusTimesheetWithTime')->name('update_request_with_log_time_sheet');
    Route::get('/request/timesheet/dismiss_request/{id}','RequestController@dismissTimesheetWithTime')->name('dismiss_timesheet_with_request_staff');
    Route::post('/request/timesheet/search_user_with_time','RequestController@search_user_with_time')->name('search_user_with_time');


    Route::get('/request/report_view','RequestController@viewReportTimesheet')->name('view_request_report');
    Route::post('/request/timesheet_search','RequestController@searchTimesheet')->name('search_date_timesheet');
    Route::post('/request/export/timesheet','RequestController@export_timesheet')->name('export_report_timesheet');

    //route upload file
    Route::post('/file/upload_file','FileImageController@doUpdload')->name('upload_file_image');
});
