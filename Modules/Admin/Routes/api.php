<?php
/******************************************************************************
 * Copyright (c) 2019-2021 Mixlinker Networks Inc. <mixiot@mixlinker.com>
 * All rights reserved.
 *
 * This program and the accompanying materials are made available under the
 * terms of the Application License of Mixlinker Networks License and Mixlinker
 * Distribution License which accompany this distribution.
 *
 * The Mixlinker License is available at
 *    [图片]http://www.mixlinker.com/legal/license.html
 * and the Mixlinker Distribution License is available at
 *    [图片]http://www.mixlinker.com/legal/distribution.html
 *
 * Contributors:
 *    Mixlinker Technical Team
 *****************************************************************************/

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// CheckTicket
Route::group(['namespace' => 'Api'], function() {
    Route::post('check_ticket', 'AuthController@checkTicket');
});

// APIQ-LOGIN
Route::group(['namespace' => 'Api'], function() {
    Route::post('login', 'AuthController@login');
    Route::post('app/login', 'AuthController@appLogin');
});

// Current user
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api'], function() {
    Route::post('user', 'AuthController@thisUser');
    Route::post('reset_password', 'AuthController@resetPassword');
});
// 注册
Route::group(['namespace' => 'Api\ApiQ', 'prefix' => 'user'], function() {
    Route::post('register', 'AdminUserController@add');
});

// APIQ
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'aprus'], function() {
    Route::post('get_list', 'AdminAprusController@getList');
    Route::post('get', 'AdminAprusController@get');
    Route::post('add', 'AdminAprusController@add');
    Route::post('edit', 'AdminAprusController@edit');
    Route::post('delete', 'AdminAprusController@delete');
});

Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'customer'], function() {
    Route::post('get_list', 'AdminCustomerController@getList');
    Route::post('get_all_list', 'AdminCustomerController@getAllList');
    Route::post('get', 'AdminCustomerController@get');
    Route::post('add', 'AdminCustomerController@add');
    Route::post('edit', 'AdminCustomerController@edit');
    Route::post('delete', 'AdminCustomerController@delete');
    Route::post('get_menu_list', 'AdminCustomerController@getMenuList');
    Route::post('get_exp_list', 'AdminCustomerController@getExpList');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'codebase'], function() {
    Route::post('get_list', 'AdminCodebaseController@getList');
    Route::post('get', 'AdminCodebaseController@get');
    Route::post('add', 'AdminCodebaseController@add');
    Route::post('edit', 'AdminCodebaseController@edit');
    Route::post('delete', 'AdminCodebaseController@delete');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'config'], function() {
    Route::post('get_list', 'AdminConfigController@getList');
    Route::post('get', 'AdminConfigController@get');
    Route::post('add', 'AdminConfigController@add');
    Route::post('edit', 'AdminConfigController@edit');
    Route::post('delete', 'AdminConfigController@delete');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'equipment'], function() {
    Route::post('get_list', 'AdminEquipmentController@getList');
    Route::post('get_all_list', 'AdminEquipmentController@getAllList');
    Route::post('get', 'AdminEquipmentController@get');
    Route::post('add', 'AdminEquipmentController@add');
    Route::post('edit', 'AdminEquipmentController@edit');
    Route::post('delete', 'AdminEquipmentController@delete');
    Route::post('get_menu_list', 'AdminEquipmentController@getMenuList');
    Route::post('get_codebase_template', 'AdminEquipmentController@getCodebaseTemplate');
    Route::post('get_warn_info', 'AdminEquipmentController@getWarnInfo');
    Route::post('get_task_info', 'AdminEquipmentController@getTaskInfo');
    Route::post('get_dashboard_template', 'AdminEquipmentController@getDashboardTemplate');
    Route::post('get_fidis_variable', 'AdminEquipmentController@getFidisVariable');
    Route::post('get_mosaic_warn', 'AdminEquipmentController@getMosaicWarn');
    Route::post('auth_check', 'AdminEquipmentController@authCheck');
    Route::post('reset_auth', 'AdminEquipmentController@resetAuth');
});

// 设备列表 - 用户中心 // 内部扩展模块调用 接口暂不鉴权
Route::group(['namespace' => 'Api\ApiQ', 'prefix' => 'equipment'], function() {
    Route::post('opt_list', 'AdminEquipmentController@optList');
    Route::post('menu_list', 'AdminEquipmentController@menuList');
    Route::post('get_info_by_ids', 'AdminEquipmentController@getEquipmentInfo');
});

Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'common'], function() {
    Route::post('get_all_warn', 'CommonController@getAllWarn');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'datasheet'], function() {
    Route::post('get_list', 'AdminDatasheetController@getList');
    Route::post('get', 'AdminDatasheetController@get');
    Route::post('add', 'AdminDatasheetController@add');
    Route::post('edit', 'AdminDatasheetController@edit');
    Route::post('delete', 'AdminDatasheetController@delete');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'mapping'], function() {
    Route::post('get_list', 'AdminMappingController@getList');
    Route::post('get_menu_list', 'AdminMappingController@getMenuList');
    Route::post('get', 'AdminMappingController@get');
    Route::post('add', 'AdminMappingController@add');
    Route::post('edit', 'AdminMappingController@edit');
    Route::post('delete', 'AdminMappingController@delete');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'statistics'], function() {
    Route::post('get_list', 'AdminStatisticsController@getList');
    Route::post('get', 'AdminStatisticsController@get');
    Route::post('add', 'AdminStatisticsController@add');
    Route::post('edit', 'AdminStatisticsController@edit');
    Route::post('delete', 'AdminStatisticsController@delete');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'statos'], function() {
    Route::post('get_list', 'AdminStatosController@getList');
    Route::post('get', 'AdminStatosController@get');
    Route::post('add', 'AdminStatosController@add');
    Route::post('edit', 'AdminStatosController@edit');
    Route::post('delete', 'AdminStatosController@delete');
    Route::post('get_menu_list', 'AdminStatosController@getMenuList');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'dashboard'], function() {
    Route::post('get_list', 'AdminDashboardController@getList');
    Route::post('get', 'AdminDashboardController@get');
    Route::post('add', 'AdminDashboardController@add');
    Route::post('edit', 'AdminDashboardController@edit');
    Route::post('delete', 'AdminDashboardController@delete');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'user'], function() {
    Route::post('get_list', 'AdminUserController@getList');
    Route::post('get', 'AdminUserController@get');
    Route::post('add', 'AdminUserController@add');
    Route::post('edit', 'AdminUserController@edit');
    Route::post('delete', 'AdminUserController@delete');
    Route::post('get_menu_list', 'AdminUserController@getMenuList');
    Route::post('reset_password', 'AdminUserController@resetPassword');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'user_equipment'], function() {
    Route::post('get_list', 'AdminUserEquipmentController@getList');
    Route::post('get', 'AdminUserEquipmentController@get');
    Route::post('add', 'AdminUserEquipmentController@add');
    Route::post('multi_add', 'AdminUserEquipmentController@multiAdd');
    Route::post('edit', 'AdminUserEquipmentController@edit');
    Route::post('delete', 'AdminUserEquipmentController@delete');
    Route::post('multi_delete', 'AdminUserEquipmentController@multiDelete');
    Route::post('get_equipment_list', 'AdminUserEquipmentController@getEquipmentList');
});
// MixWeChat
Route::group(['namespace' => 'Api\ApiQ', 'prefix' => 'user_equipment'], function() {
    Route::post('user_list', 'AdminUserEquipmentController@userList');
    Route::post('user_list_by_equipment', 'AdminUserEquipmentController@userListByEquipment');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'user_customer'], function() {
    Route::post('get_list', 'AdminUserCustomerController@getList');
    Route::post('get', 'AdminUserCustomerController@get');
    Route::post('add', 'AdminUserCustomerController@add');
    Route::post('multi_add', 'AdminUserCustomerController@multiAdd');
    Route::post('edit', 'AdminUserCustomerController@edit');
    Route::post('delete', 'AdminUserCustomerController@delete');
    Route::post('multi_delete', 'AdminUserCustomerController@multiDelete');
    Route::post('get_customer_list', 'AdminUserCustomerController@getCustomerList');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'collect'], function() {
    Route::post('get_list', 'AdminCollectController@getList');
    Route::post('get', 'AdminCollectController@get');
    Route::post('add', 'AdminCollectController@add');
    Route::post('edit', 'AdminCollectController@edit');
    Route::post('delete', 'AdminCollectController@delete');
    Route::post('get_menu_list', 'AdminCollectController@getMenuList');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'collectos'], function() {
    Route::post('get_list', 'AdminCollectosController@getList');
    Route::post('get', 'AdminCollectosController@get');
    Route::post('add', 'AdminCollectosController@add');
    Route::post('edit', 'AdminCollectosController@edit');
    Route::post('delete', 'AdminCollectosController@delete');
    Route::post('get_menu_list', 'AdminCollectosController@getMenuList');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'event'], function() {
    Route::post('get_list', 'AdminEventController@getList');
    Route::post('get', 'AdminEventController@get');
    Route::post('add', 'AdminEventController@add');
    Route::post('edit', 'AdminEventController@edit');
    Route::post('delete', 'AdminEventController@delete');
    Route::post('get_menu_list', 'AdminEventController@getMenuList');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'fault'], function() {
    Route::post('get_list', 'AdminFaultController@getList');
    Route::post('get', 'AdminFaultController@get');
    Route::post('add', 'AdminFaultController@add');
    Route::post('edit', 'AdminFaultController@edit');
    Route::post('delete', 'AdminFaultController@delete');
    Route::post('get_menu_list', 'AdminFaultController@getMenuList');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'fault_mosaic'], function() {
    Route::post('get_list', 'AdminFaultMosaicController@getList');
    Route::post('get', 'AdminFaultMosaicController@get');
    Route::post('add', 'AdminFaultMosaicController@add');
    Route::post('edit', 'AdminFaultMosaicController@edit');
    Route::post('delete', 'AdminFaultMosaicController@delete');
    Route::post('get_list_by_equipment_id', 'AdminFaultMosaicController@getListByEquipment');
    Route::post('get_list_by_equipment', 'AdminFaultMosaicController@getListByEquipment');
    Route::post('get_list_by_user', 'AdminFaultMosaicController@getListByUser');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'alert'], function() {
    Route::post('get_list', 'AdminAlertController@getList');
    Route::post('get', 'AdminAlertController@get');
    Route::post('add', 'AdminAlertController@add');
    Route::post('edit', 'AdminAlertController@edit');
    Route::post('delete', 'AdminAlertController@delete');
    Route::post('get_menu_list', 'AdminAlertController@getMenuList');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'alert_mosaic'], function() {
    Route::post('get_list', 'AdminAlertMosaicController@getList');
    Route::post('get', 'AdminAlertMosaicController@get');
    Route::post('add', 'AdminAlertMosaicController@add');
    Route::post('edit', 'AdminAlertMosaicController@edit');
    Route::post('delete', 'AdminAlertMosaicController@delete');
    Route::post('get_list_by_equipment_id', 'AdminAlertMosaicController@getListByEquipment');
    Route::post('get_list_by_equipment', 'AdminAlertMosaicController@getListByEquipment');
    Route::post('get_list_by_user', 'AdminAlertMosaicController@getListByUser');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'service'], function() {
    Route::post('get_list', 'AdminServiceController@getList');
    Route::post('get', 'AdminServiceController@get');
    Route::post('add', 'AdminServiceController@add');
    Route::post('edit', 'AdminServiceController@edit');
    Route::post('delete', 'AdminServiceController@delete');
    Route::post('get_menu_list', 'AdminServiceController@getMenuList');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'activity'], function() {
    Route::post('get_list', 'AdminActivityController@getList');
    Route::post('get', 'AdminActivityController@get');
    Route::post('add', 'AdminActivityController@add');
    Route::post('edit', 'AdminActivityController@edit');
    Route::post('delete', 'AdminActivityController@delete');
    Route::post('get_menu_list', 'AdminActivityController@getMenuList');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'log'], function() {
    Route::post('get_list', 'AdminLogController@getList');
    Route::post('get', 'AdminLogController@get');
    Route::post('add', 'AdminLogController@add');
    Route::post('edit', 'AdminLogController@edit');
    Route::post('delete', 'AdminLogController@delete');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'message'], function() {
    Route::post('get_list', 'AdminMessageController@getList');
    Route::post('get', 'AdminMessageController@get');
    Route::post('add', 'AdminMessageController@add');
    Route::post('edit', 'AdminMessageController@edit');
    Route::post('delete', 'AdminMessageController@delete');
    Route::post('get_menu_list', 'AdminMessageController@getMenuList');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'setting'], function() {
    Route::post('get_list', 'AdminSettingController@getList');
    Route::post('get', 'AdminSettingController@get');
    Route::post('add', 'AdminSettingController@add');
    Route::post('edit', 'AdminSettingController@edit');
    Route::post('delete', 'AdminSettingController@delete');
    Route::post('about_us', 'AdminSettingController@aboutUs');
    Route::post('feedback', 'AdminSettingController@feedback');
});
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'normal'], function() {
    Route::post('get_list', 'AdminNormalController@getList');
    Route::post('get', 'AdminNormalController@get');
    Route::post('add', 'AdminNormalController@add');
    Route::post('edit', 'AdminNormalController@edit');
    Route::post('delete', 'AdminNormalController@delete');
});

// 文件上传下载
Route::group(['middleware' => 'mix.api', 'namespace' => 'Api\ApiQ', 'prefix' => 'file'], function() {
    Route::post('upload', 'FileController@upload');
    Route::get('download', 'FileController@download');
});
Route::group(['namespace' => 'Api\ApiQ', 'prefix' => 'file'], function() {
    Route::get('download', 'FileController@download');
});

// D&C Project
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\ApiQ', 'prefix'=>'apiq/dc_project'], function() {
    Route::get('get_list', 'DcProjectController@index');
    Route::get('get', 'DcProjectController@show');
    Route::post('add', 'DcProjectController@store');
    Route::post('edit', 'DcProjectController@update');
    Route::post('delete', 'DcProjectController@destroy');
    Route::post('start', 'DcProjectController@start');
    Route::post('stop', 'DcProjectController@stop');
    Route::get('status', 'DcProjectController@status');
});

// D&C Port
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\ApiQ', 'prefix'=>'apiq/dc_port'], function() {
    Route::get('get_list', 'DcPortController@index');
    Route::get('get', 'DcPortController@show');
    Route::post('add', 'DcPortController@store');
    Route::post('edit', 'DcPortController@update');
    Route::post('delete', 'DcPortController@destroy');
});

// D&C Process
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\ApiQ', 'prefix'=>'apiq/dc_process'], function() {
    Route::get('get_list', 'DcProcessController@index');
    Route::get('get', 'DcProcessController@show');
    Route::post('add', 'DcProcessController@store');
    Route::post('edit', 'DcProcessController@update');
    Route::post('delete', 'DcProcessController@destroy');
});

// D&C Engine
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\ApiQ', 'prefix'=>'apiq/dc_engine'], function() {
    Route::get('get_list', 'DcEngineController@index');
    Route::get('get', 'DcEngineController@show');
    Route::post('add', 'DcEngineController@store');
    Route::post('edit', 'DcEngineController@update');
    Route::post('delete', 'DcEngineController@destroy');
});

// D&C Model
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\ApiQ', 'prefix'=>'apiq/dc_model'], function() {
    Route::get('get_list', 'DcModelController@index');
    Route::get('get', 'DcModelController@show');
    Route::post('add', 'DcModelController@store');
    Route::post('edit', 'DcModelController@update');
    Route::post('delete', 'DcModelController@destroy');
});

// D&C Library
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\ApiQ', 'prefix'=>'apiq/dc_library'], function() {
    Route::get('get_list', 'DcLibraryController@index');
    Route::get('get', 'DcLibraryController@show');
    Route::post('add', 'DcLibraryController@store');
    Route::post('edit', 'DcLibraryController@update');
    Route::post('delete', 'DcLibraryController@destroy');
});

// D&C Importos
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\ApiQ', 'prefix'=>'apiq/dc_importos'], function() {
    Route::get('get_list', 'DcImportosController@index');
    Route::get('get', 'DcImportosController@show');
});

// D&C Exportos
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\ApiQ', 'prefix'=>'apiq/dc_exportos'], function() {
    Route::get('get_list', 'DcExportosController@index');
    Route::get('get', 'DcExportosController@show');
});

// Indass Project
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\ApiQ', 'prefix'=>'apiq/indass_project'], function() {
    Route::get('get_list', 'IndassProjectController@index');
    Route::get('get', 'IndassProjectController@show');
    Route::post('add', 'IndassProjectController@store');
    Route::post('edit', 'IndassProjectController@update');
    Route::post('delete', 'IndassProjectController@destroy');
    Route::post('start', 'IndassProjectController@start');
    Route::post('stop', 'IndassProjectController@stop');
    Route::get('status', 'IndassProjectController@status');
});

// Indass Filter
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\ApiQ', 'prefix'=>'apiq/indass_filter'], function() {
    Route::get('get_list', 'IndassFilterController@index');
    Route::get('get', 'IndassFilterController@show');
    Route::post('add', 'IndassFilterController@store');
    Route::post('edit', 'IndassFilterController@update');
    Route::post('delete', 'IndassFilterController@destroy');
});

// Indass Organizer
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\ApiQ', 'prefix'=>'apiq/indass_organizer'], function() {
    Route::get('get_list', 'IndassOrganizerController@index');
    Route::get('get', 'IndassOrganizerController@show');
    Route::post('add', 'IndassOrganizerController@store');
    Route::post('edit', 'IndassOrganizerController@update');
    Route::post('delete', 'IndassOrganizerController@destroy');
});

// Indass Parameter
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\ApiQ', 'prefix'=>'apiq/indass_parameter'], function() {
    Route::get('get_list', 'IndassParameterController@index');
    Route::get('get', 'IndassParameterController@show');
    Route::post('add', 'IndassParameterController@store');
    Route::post('edit', 'IndassParameterController@update');
    Route::post('delete', 'IndassParameterController@destroy');
});

// Indass Message
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\ApiQ', 'prefix'=>'apiq/indass_message'], function() {
    Route::get('get_list', 'IndassMessageController@index');
    Route::get('get', 'IndassMessageController@show');
    Route::post('add', 'IndassMessageController@store');
    Route::post('edit', 'IndassMessageController@update');
    Route::post('delete', 'IndassMessageController@destroy');
});

// APIP
Route::group(['middleware' => 'mix.api', 'namespace'=>'Api\ApiP', 'prefix'=>'apip'], function() {
    Route::post('apip_push', 'ApipController@apip_push');
});
// APIP
Route::group(['namespace'=>'Api\ApiP', 'prefix'=>'apip'], function() {
    Route::post('get_token', 'ApipController@get_token');
    Route::post('apip_push2', 'ApipController@apip_push2');
});

// APIS
Route::group(['namespace'=>'Api\ApiS', 'prefix'=>'apis'], function() {
    Route::post('getCollect', 'ApiSController@getCollect');
    Route::post('getStatisticByPeriod', 'ApiSController@getStatisticByPeriod');
    Route::post('getStatisticByTimeFlag', 'ApiSController@getStatisticByTimeFlag');
    Route::post('getAggregate', 'ApiSController@getAggregate');
    Route::post('getStatistic', 'ApiSController@getStatistic');
    Route::post('getStatisticByDate', 'ApiSController@getStatisticByDate');
    Route::get('getStatisticsExcel', 'ApiSController@getStatisticsExcel');
    Route::get('downloadExcel', 'ApiSController@downloadExcel');
});

// APP
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\Other', 'prefix'=>'app'], function() {
    Route::get('index', 'AppIndexController@index');
    Route::post('notice', 'AppIndexController@notice');
    Route::post('risk', 'AppIndexController@risk');
});

// EXP
Route::group(['middleware'=>'mix.api', 'namespace'=>'Api\Other', 'prefix'=>'exp'], function() {
    Route::post('activity/count', 'ExpOverviewController@countActivity');
    Route::post('alert/get_menu_list', 'ExpAlertController@getMenuList');
    Route::post('alert/get_list', 'ExpAlertController@getList');
    Route::post('event/get_menu_list', 'ExpEventController@getMenuList');
    Route::post('event/get_list', 'ExpEventController@getList');
    Route::post('fault/get_menu_list', 'ExpFaultController@getMenuList');
    Route::post('fault/get_list', 'ExpFaultController@getList');
    Route::post('activity/get_list', 'ExpActivityController@getList');
    Route::post('activity/get_menu_list', 'ExpActivityController@getMenuList');
    Route::post('service/get_list', 'ExpServiceController@getList');
    Route::post('service/get_menu_list', 'ExpServiceController@getMenuList');
});

// Mixshow/Huirong
Route::group(['namespace'=>'Api\Other', 'prefix'=>'mixshow'], function() {
    Route::post('huirong/gas_production', 'MixshowHuirongController@gasProduction');
    Route::post('huirong/total_project', 'MixshowHuirongController@totalProject');
    Route::post('huirong/total_equipment', 'MixshowHuirongController@totalEquipment');
    Route::post('huirong/gas_area_distribution', 'MixshowHuirongController@gasAreaDistribution');
    Route::post('huirong/total_run_time', 'MixshowHuirongController@totalRunTime');
    Route::post('huirong/safe_run_time', 'MixshowHuirongController@safeRunTime');
    Route::post('huirong/map', 'MixshowHuirongController@map');
    Route::post('huirong/project_list', 'MixshowHuirongController@projectList');
    Route::post('huirong/equipment_type_statistics', 'MixshowHuirongController@equipmentTypeStatistics');
    Route::post('huirong/project_area_list', 'MixshowHuirongController@projectAreaList');
    Route::post('huirong/warn_info', 'MixshowHuirongController@warnInfo');
    Route::post('huirong/get_template', 'MixshowHuirongController@getTemplate');
    Route::post('huirong/get_camera_url', 'MixshowHuirongController@getCameraUrl');
});

// Mixshow/Longzheng
Route::group(['namespace'=>'Api\Other', 'prefix'=>'mixshow'], function() {
    Route::post('longzheng/total_gas', 'MixshowLongzhengController@totalGas');
    Route::post('longzheng/year_gas', 'MixshowLongzhengController@yearGas');
    Route::post('longzheng/month_gas', 'MixshowLongzhengController@monthGas');
    Route::post('longzheng/gas_area_distribution', 'MixshowLongzhengController@gasAreaDistribution');
    Route::post('longzheng/total_run_day', 'MixshowLongzhengController@totalRunDay');
    Route::post('longzheng/year_run_day', 'MixshowLongzhengController@yearRunDay');
    Route::post('longzheng/map', 'MixshowLongzhengController@map');
    Route::post('longzheng/project_list', 'MixshowLongzhengController@projectList');
    Route::post('longzheng/video_monitor', 'MixshowLongzhengController@videoMonitor');
    Route::post('longzheng/project_menu_list', 'MixshowLongzhengController@projectMenuList');
    Route::post('longzheng/equipment_menu_list', 'MixshowLongzhengController@equipmentMenuList');
    Route::post('longzheng/project_warn_info', 'MixshowLongzhengController@projectWarnInfo');
    Route::post('longzheng/equipment_warn_info', 'MixshowLongzhengController@equipmentWarnInfo');
    Route::post('longzheng/get_template', 'MixshowLongzhengController@getTemplate');
    Route::post('longzheng/project_area_list', 'MixshowLongzhengController@projectAreaList');
});

// PRO
Route::group(['middleware'=>'mix.api','namespace'=>'Api\Other', 'prefix'=>'pro'], function() {
    Route::post('statistics', 'ProOverviewController@statistics');
    Route::post('statisticsPlus', 'ProOverviewController@statisticsPlus');
    Route::get('equipment/statisticsQuestion', 'ProOverviewController@statisticsQuestion');
    Route::get('equipment/distributionInMap', 'ProOverviewController@distributionInMap');
    Route::get('equipment/singleInMap', 'ProOverviewController@singleDistributionInMap');
    Route::get('service/count', 'ProOverviewController@countService');
    Route::get('equipment/distribution', 'ProOverviewController@distribution');
    Route::get('equipment/alertPoint', 'ProEquipmentController@getAlertPoint');
    Route::post('equipment/dashboardConfig', 'ProEquipmentController@getDashboardConfig');
    Route::get('events/history', 'ProEquipmentController@history');
    Route::get('events/historyItem', 'ProEquipmentController@historyItem');
});
// PRO：非登录
Route::group(['namespace'=>'Api\Other', 'prefix'=>'pro'], function() {
    Route::get('getMapping', 'ProEquipmentController@getMapping');
    Route::post('getMapping', 'ProEquipmentController@getMapping');
});

// APIM：ADMIN Interface
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/activity'], function() {
    Route::post('get_list', 'AdminActivityController@index');
    Route::post('get_menu_list', 'AdminActivityController@getMenuList');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/alert'], function() {
    Route::post('get_list', 'AdminAlertController@index');
    Route::post('get_menu_list', 'AdminAlertController@getMenuList');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/alert_mosaic'], function() {
    Route::post('get_list', 'AdminAlertMosaicController@index');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/aprus'], function() {
    Route::post('get_list', 'AdminAprusController@index');
    Route::post('get_menu_list', 'AdminAprusController@getMenuList');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/codebase'], function() {
    Route::post('get_list', 'AdminCodebaseController@index');
    Route::post('get_menu_list', 'AdminCodebaseController@getMenuList');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/collect'], function() {
    Route::post('get_list', 'AdminCollectController@index');
    Route::post('get_menu_list', 'AdminCollectController@getMenuList');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/config'], function() {
    Route::post('get_list', 'AdminConfigController@index');
    Route::post('get_menu_list', 'AdminConfigController@getMenuList');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/customer'], function() {
    Route::post('get_list', 'AdminCustomerController@index');
    Route::post('get_menu_list', 'AdminCustomerController@getMenuList');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/dashboard'], function() {
    Route::post('get_list', 'AdminDashboardController@index');
    Route::post('get_menu_list', 'AdminDashboardController@getMenuList');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/datasheet'], function() {
    Route::post('get_list', 'AdminDatasheetController@index');
    Route::post('get_menu_list', 'AdminDatasheetController@getMenuList');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/equipment'], function() {
    Route::post('get_list', 'AdminEquipmentController@index');
    Route::post('get_menu_list', 'AdminEquipmentController@getMenuList');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/event'], function() {
    Route::post('get_list', 'AdminEventController@index');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/fault'], function() {
    Route::post('get_list', 'AdminFaultController@index');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/fault_mosaic'], function() {
    Route::post('get_list', 'AdminFaultMosaicController@index');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/log'], function() {
    Route::post('get_list', 'AdminLogController@index');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/mapping'], function() {
    Route::post('get_list', 'AdminMappingController@index');
    Route::post('get_menu_list', 'AdminMappingController@getMenuList');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/message'], function() {
    Route::post('get_list', 'AdminMessageController@index');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/service'], function() {
    Route::post('get_list', 'AdminServiceController@index');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/statistics'], function() {
    Route::post('get_list', 'AdminStatisticsController@index');
    Route::post('get_menu_list', 'AdminStatisticsController@getMenuList');
});

Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/statos'], function() {
    Route::post('get_list', 'AdminStatosController@index');
    Route::post('get_menu_list', 'AdminStatosController@getMenuList');
    Route::post('get_list_by_time', 'AdminStatosController@getListByTime');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/user'], function() {
    Route::post('get_list', 'AdminUserController@index');
    Route::post('get_menu_list', 'AdminUserController@getMenuList');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/user_customer'], function() {
    Route::post('get_list', 'AdminUserCustomerController@index');
});
Route::group(['middleware'=>'mix.api', 'namespace'=>'Admin', 'prefix'=>'m/user_equipment'], function() {
    Route::post('get_list', 'AdminUserEquipmentController@index');
});
// 非登录 APIQ-PRO
Route::group(['namespace' => 'Api\Other', 'prefix' => 'outer'], function() {
    // 供推送服务使用
    Route::post('getUserByEquipment', 'ProEquipmentController@getUserByEquipment');

});
