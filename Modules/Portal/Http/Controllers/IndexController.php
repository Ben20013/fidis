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
namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Api\Libs\Classes\ApiPassport;
use Modules\Api\Libs\Classes\Apiq;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller{
	public function __construct() {
        $this->api_passport=new ApiPassport;
        $this->apiq=new Apiq;
        $this->url_no_http=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
    }
    //加载首页
    public function index(){
        $user=isset(session('user')['token'])?session('user'):array();
        $version_file=MODULE_PATH.'portal'.DIRECTORY_SEPARATOR.'Version';
        $version='';
        if(file_exists($version_file)){
            $version_info=parse_ini_file($version_file, true);
            $version=isset($version_info['general']['version'])?$version_info['general']['version']:$version;
        }
        return view('portal::index', array('host'=>$this->url_no_http, 'config'=>config('system'), 'version'=>$version));
    }
    //获取应用
    public function get_user_client_list(){
        $info=$_REQUEST;
        echo $this->api_passport->get_user_client_list();
    }
    //登录
    public function login(){
        $info=$_REQUEST;
        $res=json_decode($this->api_passport->login($info['username'], $info['password'], $info['source']), true);
        if($res['code']==200){
            session(['user'=>$res['result']]);
            session(['login_status'=>1]);
            Cache::forever('user', $res['result']);
            Cache::forever('login_status', 1);
        }
        echo json_encode($res);
    }
    //获取用户信息
    public function user(){
        $info=$_REQUEST;
        echo $this->api_passport->get_current_userinfo();
    }
    //编辑用户信息
    public function user_edit(){
        $info=$_REQUEST;
        echo $this->api_passport->edit_info('user', $info);
    }
    //修改密码
    public function reset_password(){
        $info=$_REQUEST;
        echo $this->api_passport->reset_password($info['old_password'], $info['new_password']);
    }
	//校验ticket http://localhost:8080/?source=MixPortal&ticket=sEBfLJhB0KdGwFjFqSwqIr2zmO63TLZF2zKNGb4EIvoFXGkcj3TVzWoMCModi4eT
	public function check_ticket(){
		$info=$_REQUEST;
		echo $this->api_passport->check_ticket($info['source'], $info['ticket']);
	}
	//退出登录
	public function logout(){
		$info=$_REQUEST;
        $this->api_passport->logout($info['source'], $info['ticket']);
        session(['user'=>array()]);
        session(['login_status'=>0]);
        Cache::forever('user', array());
        Cache::forever('login_status', 0);
		echo json_encode(array(
			'code'=>200,
			'msg'=>'退出成功。'
        ));
        return redirect('/');
    }
    //获取应用地址
    public function get_client_url(){
        $info=$_REQUEST;
        echo $this->api_passport->get_client_url($info['client_id']);
    }
    //空页面地址
    public function _blank(){

    }
}
