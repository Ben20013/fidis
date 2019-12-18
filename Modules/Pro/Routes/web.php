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

Route::prefix('pro')->group(function() {
    Route::match(['get', 'post'], '/', '\Modules\Pro\Http\Controllers\IndexController@index');
    Route::match(['get', 'post'], 'login', '\Modules\Pro\Http\Controllers\IndexController@login');
    Route::match(['get', 'post'], 'logout', '\Modules\Pro\Http\Controllers\IndexController@logout');
    Route::match(['get', 'post'], 'getMenuRoute', '\Modules\Pro\Http\Controllers\IndexController@getMenuRoute');
    Route::match(['get', 'post'], 'getRoute', '\Modules\Pro\Http\Controllers\IndexController@getRoute');
    Route::get('home', '\Modules\Pro\Http\Controllers\HomeController@index');
    //alert
    Route::prefix('alert')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\AlertController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\AlertController;
            $controller->$name();
        });
    });
    //api
    Route::prefix('api')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\ApiController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\ApiController;
            $controller->$name();
        });
    });
    //collect
    Route::prefix('collect')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\CollectController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\CollectController;
            $controller->$name();
        });
    });
    //客户
    Route::prefix('customer')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\CustomerController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\CustomerController;
            $controller->$name();
        });
    });
    //设备
    Route::prefix('equipment')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\EquipmentController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\EquipmentController;
            $controller->$name();
        });
    });
    //项目
    Route::prefix('equipment_group')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\EquipmentGroupController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\EquipmentGroupController;
            $controller->$name();
        });
    });
    //event
    Route::prefix('event')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\EventController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\EventController;
            $controller->$name();
        });
    });
    //fault
    Route::prefix('fault')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\FaultController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\FaultController;
            $controller->$name();
        });
    });
    //file
    Route::prefix('file')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\FileController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\FileController;
            $controller->$name();
        });
    });
    //主页
    Route::prefix('index')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\indexController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\IndexController;
            $controller->$name();
        });
    });
    //log
    Route::prefix('log')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\LogController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\LogController;
            $controller->$name();
        });
    });
    //message
    Route::prefix('message')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\MessageController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\MessageController;
            $controller->$name();
        });
    });
    //report
    Route::prefix('report')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\ReportController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\ReportController;
            $controller->$name();
        });
    });
    //service
    Route::prefix('service')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\ServiceController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\ServiceController;
            $controller->$name();
        });
    });
    //设置
    Route::prefix('setting')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\SettingController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\SettingController;
            $controller->$name();
        });
    });
    //task
    Route::prefix('task')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\TaskController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\TaskController;
            $controller->$name();
        });
    });
    //user
    Route::prefix('user')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\UserController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\UserController;
            $controller->$name();
        });
    });
    //work
    Route::prefix('work')->group(function () {
        Route::match(['get', 'post'], '/index', '\Modules\Pro\Http\Controllers\WorkController@index');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Pro\Http\Controllers\WorkController;
            $controller->$name();
        });
    });
});