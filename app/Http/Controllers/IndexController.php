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

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;
use Modules\Api\Libs\Classes\Apiq;
use Modules\Api\Libs\Classes\ApiBase;
class IndexController extends Controller{
    public function __construct(){
        $this->ApiBase=new ApiBase();
		$this->apiq=new Apiq();
    }
    //默认界面，应用中心
    public function index(){
        //验证ticket
		$info=$_REQUEST;
		if(isset($info['source'])&&isset($info['ticket'])){
			$res=json_decode($this->ApiBase->check_admin_ticket($info['source'], $info['ticket']), true);
			$res['result']['source']=$info['source'];
			$res['result']['ticket']=$info['ticket'];
			session(['user'=>$res['result']]);
			return redirect(APP_URL);
		}else{
			return view('index');
		}
    }
}
