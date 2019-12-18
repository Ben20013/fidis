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

//Route::match(['get', 'post'], '/', function () {
//    return view('welcome');
//});
// Route::prefix('admin')->group(function() {
//     Route::match(['get', 'post'], '/', '\Modules\Admin\Http\Controllers\Admin\AuthController@checkIsLogin');
// });
Route::group(['namespace'=>'Admin', 'prefix'=>'admin'], function() {
    Route::match(['get', 'post'], '/', '\Modules\Admin\Http\Controllers\IndexController@index');
    Route::match(['get', 'post'], 'check_ticket', 'AuthController@checkTicket');
    Route::match(['get', 'post'], 'logout', 'AuthController@logout');
    Route::match(['get', 'post'], 'logout', 'AuthController@logout');
    Route::match(['get', 'post'], 'version', '\Modules\Admin\Http\Controllers\IndexController@version');
    Route::match(['get', 'post'], 'userInfo', '\Modules\Admin\Http\Controllers\IndexController@userInfo');
    Route::match(['get', 'post'], 'getMenuList', '\Modules\Admin\Http\Controllers\MenuController@getMenuList');
    Route::match(['get', 'post'], 'getRoute', '\Modules\Admin\Http\Controllers\IndexController@getRoute');
});

// About Us
Route::group(['middleware'=>'admin.auth', 'namespace'=>'Admin'], function() {
    Route::match(['get', 'post'], 'user', 'AuthController@thisUser');
    Route::match(['get', 'post'], 'about_us', 'AdminSettingController@aboutUs');
    Route::match(['get', 'post'], 'send_us', 'AdminSettingController@sendUs');
    Route::match(['get', 'post'], 'common/exp_list', 'AdminCustomerController@getExpList');

});

// Module
Route::group(['namespace'=>'Admin', 'prefix'=>'admin/module'], function() {
    Route::match(['get', 'post'], 'index', '\Modules\Admin\Http\Controllers\ModuleController@index');
    Route::match(['get', 'post'], 'list', '\Modules\Admin\Http\Controllers\ModuleController@index');
    Route::match(['get', 'post'], 'detail', '\Modules\Admin\Http\Controllers\ModuleController@detail');
    Route::match(['get', 'post'], 'moduleOption', '\Modules\Admin\Http\Controllers\ModuleController@moduleOption');
    Route::match(['get', 'post'], 'install', '\Modules\Admin\Http\Controllers\ModuleController@install');
    Route::match(['get', 'post'], 'uninstall', '\Modules\Admin\Http\Controllers\ModuleController@uninstall');
    Route::match(['get', 'post'], 'enable', '\Modules\Admin\Http\Controllers\ModuleController@enable');
    Route::match(['get', 'post'], 'disable', '\Modules\Admin\Http\Controllers\ModuleController@disable');
    Route::match(['get', 'post'], 'createMenu', '\Modules\Admin\Http\Controllers\ModuleController@createMenu');
    Route::match(['get', 'post'], 'generate', '\Modules\Admin\Http\Controllers\ModuleController@generate');
    Route::match(['get', 'post'], 'upload', '\Modules\Admin\Http\Controllers\ModuleController@upload');
    Route::match(['get', 'post'], 'test', '\Modules\Admin\Http\Controllers\ModuleController@test');
});
// menu
Route::group(['namespace'=>'Admin', 'prefix'=>'admin/menu'], function() {
    Route::match(['get', 'post'], 'index', '\Modules\Admin\Http\Controllers\MenuController@index');
    Route::match(['get', 'post'], 'list', '\Modules\Admin\Http\Controllers\MenuController@index');
    Route::match(['get', 'post'], 'add', '\Modules\Admin\Http\Controllers\MenuController@add');
    Route::match(['get', 'post'], 'edit', '\Modules\Admin\Http\Controllers\MenuController@edit');
    Route::match(['get', 'post'], 'detail', '\Modules\Admin\Http\Controllers\MenuController@detail');
    Route::match(['get', 'post'], 'delete', '\Modules\Admin\Http\Controllers\MenuController@delete');
    Route::match(['get', 'post'], 'menuOption', '\Modules\Admin\Http\Controllers\MenuController@menuOption');
    Route::match(['get', 'post'], 'enable', '\Modules\Admin\Http\Controllers\MenuController@enable');
    Route::match(['get', 'post'], 'disable', '\Modules\Admin\Http\Controllers\MenuController@disable');
});
