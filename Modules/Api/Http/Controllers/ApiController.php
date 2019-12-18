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

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Api\Libs\Classes\ApiBase;
use Modules\Api\Libs\Classes\Apip;
use Modules\Api\Libs\Classes\Apiq;
use Modules\Api\Libs\Classes\Apis;
use Modules\Api\Libs\Classes\Apix;

class ApiController extends Controller{
    public function __construct() {
        $this->apip=new Apip;
        $this->apiq=new Apiq;
        $this->apis=new Apis;
        $this->apix=new Apix;
	}
    public function index(){
        return view('api::index');
    }
    public function apiq($action){
        //$res=$this->apiq->$action();
        //print_r($res);
        $actions=get_class_methods($this->apiq);
        print_r($actions);
    }
}