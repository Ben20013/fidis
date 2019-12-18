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

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use Modules\Api\Libs\Classes\ApiPassport;
use Modules\Api\Libs\Classes\ApiBase;

class AdminController extends Controller{
    public function __construct(){
        $this->api_passport=new ApiPassport;
        $this->api_base=new ApiBase;
        return self::check_ticket();
    }
    //check login status.
    final public function check_ticket(){

        //return redirect('http://www.baidu.com');

        $login_status=Cache::get('login_status');
        $userinfo=Cache::get('user');

        if($login_status==1&&!empty($userinfo)){
            //print_r($login_status);print_r($userinfo);echo 1231321;
            $res=json_decode($this->api_passport->check_ticket('MixPortal', $userinfo['ticket']), true);//print_r($login_status);print_r($userinfo);exit;
            if($res['code']!=200){
                return redirect('/#/login');
                exit;
            }else{
                return true;
            }
        }else{

            //return redirect('http://www.baidu.com');
            //return redirect()->action('\Modules\Admin\Http\Controllers\IndexController@index');//exit;
        }
    }
}
