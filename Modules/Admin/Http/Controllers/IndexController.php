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
namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Api\Libs\Classes\ApiBase;
use Modules\Api\Libs\Classes\Apiq;
use Modules\Api\Libs\Classes\Apip;
use Modules\Api\Libs\Classes\ApiPassport;
use Illuminate\Support\Facades\Cache;
use Modules\Admin\Models\MenuModel;
use Modules\Admin\Http\Controllers\Auth\AdminController;

class IndexController extends AdminController
{
    public function __construct() {
        parent::__construct();
        $this->api_base=new ApiBase;
        $this->api_passport=new ApiPassport;
        $this->menu_model=new MenuModel;
        $this->url_no_http=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
    }
    //加载主页
    public function index(){
        $info=$_REQUEST;
        if(isset($info['source'])&&isset($info['ticket'])){
            $res=json_decode($this->api_base->check_admin_ticket($info['source'], $info['ticket']), true);
            $res['result']['source']=$info['source'];
            $res['result']['ticket']=$info['ticket'];
            session(['user'=>$res['result']]);
            return redirect('/admin');
        }else{
            $config=config('portal.setting');
            $user=session('user')?session('user'):array();
            if($user){
                $res=json_decode($this->api_passport->check_ticket('MixPortal', $user['ticket']), true);//print_r($login_status);print_r($userinfo);exit;
                if($res['code']!=200){
                    return redirect('/#/login');
                }else{
                    return view('admin::index', array('title'=>$config['common']['website_title'], 'host'=>$this->url_no_http, 'user'=>$user));
                }
            }else{
                return redirect('/#/login');
            }
        }
    }
    //版本
    public function version(){
        $version_file=MODULE_PATH.'admin'.DIRECTORY_SEPARATOR.'Version';
        $version='';
        if(file_exists($version_file)){
            $version_info=parse_ini_file($version_file, true);
            $version=isset($version_info['general']['version'])?$version_info['general']['version']:$version;
        }
        echo json_encode(array(
            'code'=>200,
            'msg'=>'Success!',
            'result'=>array(
                'version'=>$version
            )
        ));
    }
    //当前登录用户信息
    public function userInfo(){
        $info=$_REQUEST;
        echo $this->api_passport->get_info('user', $info);
    }
    //动态获取路由
    public function getRoute(){
        $menu_info=$this->menu_model->where([['module_name', '!=', 'Admin'], ['display_system', 'like', '%Fidis_admin%'], ['display', '=', '1']])->get(['*'])->toArray();
        $route=array();
        foreach($menu_info as $key=>$val){
            if($val['parentid']!='0'){
                $route[]=array(
                    'path'=>$val['route'],
                    'redirect'=>$val['route'],
                    'children'=>[[
                        'path'=>$val['route'],
                        'subPath'=>$val['params'],
                        'meta'=>array(
                            'title'=>$val['name'],
                            'breadcrumb'=>[[
                                'name'=>$val['name'],
                                'path'=>$val['route']
                            ]]
                        )
                    ]]
                );
            }
        }
        echo json_encode(array('code'=>200, 'msg'=>'', 'result'=>$route));
    }
}
