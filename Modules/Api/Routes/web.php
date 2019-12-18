<?php

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

Route::prefix('api')->group(function() {
    Route::get('/', 'ApiController@index');
    Route::prefix('apiq')->group(function () {
        //Route::match(['get', 'post'], '{name}', '\Modules\Api\Http\Controllers\ApiController@apiq');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Api\Http\Controllers\ApiController;
            $controller->apiq($name);
        });
    });
    Route::prefix('evacs')->group(function () {
        //Route::match(['get', 'post'], '{name}', '\Modules\Api\Http\Controllers\ApiController@apiq');
        Route::match(['get', 'post'], '{name}', function($name){
            $controller=new \Modules\Api\Http\Controllers\ApiEvacsController;
            $controller->$name();
        });
    });
});