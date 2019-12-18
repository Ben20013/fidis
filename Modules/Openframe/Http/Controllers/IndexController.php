<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: index.php
* Author: qinguoqing
* Description: user application
* Version:V1.0.0
*
*-------------------------------------------------------------------------------
* Date Author(s) Status & Comments
*-------------------------------------------------------------------------------
* 2018/09/12 qinguoqing Creating
*--------------------------------------------------------------------------------
*/
namespace Modules\OpenFrame\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Api\Libs\Classes\ApiBase;
use Modules\Api\Libs\Classes\Apiq;
use Modules\Api\Libs\Classes\Apip;
use Modules\Api\Libs\Classes\ApiPassport;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller{
    public function __construct() {

	}
	//加载主页
	public function index(){
        return view('openframe::index', array('title'=>'智物联'));
    }
    //版本
    public function version(){

    }
    //当前登录用户信息
    public function userInfo(){

    }
    //动态获取路由
    public function getRoute(){

        echo json_encode(array('code'=>200, 'msg'=>'', 'result'=>array(
            [
                'path'=>'/openframe/project',
                'redirect'=>'/openframe/project',
                'children'=>[[
                    'path'=>'/openframe/project',
                    'meta'=>[
                        'title'=>'维保',
                        'breadcrumb'=>[[
                            'name'=>'维保',
                            'path'=>'/openframe/project'
                        ]]
                    ],
                ]]
            ],
            [
                'path'=>'/openframe/result',
                'redirect'=>'/openframe/result',
                'children'=>[[
                    'path'=>'/openframe/result',
                    'meta'=>[
                        'title'=>'维保',
                        'breadcrumb'=>[[
                            'name'=>'维保',
                            'path'=>'/openframe/result'
                        ]]
                    ],
                ]]
            ]
        )));
    }
}