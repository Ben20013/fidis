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

Route::prefix('openframe')->group(function() {
    Route::get('/', 'IndexController@index');
    Route::get('/project', 'IndexController@index');
    Route::get('/result', 'IndexController@index');
    //项目管理
    Route::prefix('project')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Openframe\Http\Controllers\ProjectController@index');
        Route::match(['get', 'post'], 'add', '\Modules\Openframe\Http\Controllers\ProjectController@add');
        Route::match(['get', 'post'], 'edit', '\Modules\Openframe\Http\Controllers\ProjectController@edit');
        Route::match(['get', 'post'], 'detail', '\Modules\Openframe\Http\Controllers\ProjectController@detail');
        Route::match(['get', 'post'], 'delete', '\Modules\Openframe\Http\Controllers\ProjectController@delete');
        Route::match(['get', 'post'], 'enable', '\Modules\Openframe\Http\Controllers\ProjectController@enable');
        Route::match(['get', 'post'], 'disable', '\Modules\Openframe\Http\Controllers\ProjectController@disable');
        Route::match(['post'], 'upload', '\Modules\Openframe\Http\Controllers\ProjectController@upload');
    });
    //结果管理
    Route::prefix('result')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Openframe\Http\Controllers\ResultController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $result=new \Modules\Openframe\Http\Controllers\ResultController;
            $result->$name(Request);
        });
    });
});