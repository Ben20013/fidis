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
 *    http://www.mixlinker.com/legal/license.html
 * and the Mixlinker Distribution License is available at
 *    http://www.mixlinker.com/legal/distribution.html
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

Route::prefix('portal')->group(function() {
    Route::get('/', 'IndexController@index');
    Route::get('/index', 'IndexController@index');
    Route::get('/login', 'IndexController@index');
    Route::get('/_blank', 'IndexController@index');
    Route::get('/logout', 'IndexController@logout');
    Route::get('/test', 'IndexController@index');
    Route::get('/admin/setting', 'IndexController@index');
    Route::get('/setting', 'IndexController@index');
    //index
    Route::prefix('index')->group(function () {
        Route::match(['get', 'post'], '/', '\Modules\Portal\Http\Controllers\IndexController@index');
        Route::match(['get', 'post'], '/index', '\Modules\Portal\Http\Controllers\IndexController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Portal\Http\Controllers\IndexController;
            $controller->$name();
        });
    });
    //setting
    Route::prefix('setting')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Portal\Http\Controllers\SettingController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Portal\Http\Controllers\SettingController;
            $controller->$name();
        });
    });
});
