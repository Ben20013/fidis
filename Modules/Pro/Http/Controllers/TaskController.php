<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: task.php
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
namespace Modules\Pro\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Api\Libs\Classes\Apiq;
use Modules\Api\Libs\Classes\Apie;

class TaskController extends Controller{
	public function __construct() {
		$this->apiq=new Apiq;
		$this->apie=new Apie;
	}
	//获取列表
	public function public_get_tasklist(){
		$info=$_REQUEST;
		$info['user_id']=isset($info['user_id'])?$info['user_id']:session('user')['user_id'];
		echo $this->apie->get_user_works_tasklist($info);
	}
	//获取详情
	public function public_get_taskdetail(){
		$info=$_REQUEST;
		echo $this->apie->get_works_taskdetail($info['task_id']);
    }
    //获取设备维保列表
    public function get_maintenance(){
        $info=$_REQUEST;
        $info['user_id']=isset($info['user_id'])?$info['user_id']:session('user')['user_id'];
        $info['is_super']=isset($info['is_super'])?$info['is_super']:session('user')['is_super'];
        echo $this->apie->get_maintenance($info);
    }
    //获取维保详情
    public function get_maintenance_detail(){
        $info=$_REQUEST;
        echo $this->apie->get_maintenance_detail($info);
    }
    //修改周期
    public function change_period(){
        $info=$_REQUEST;
        echo $this->apie->change_period($info);
    }
    //获取设备名称
    public function get_default_equipment(){
        $info=$_REQUEST;
        echo $this->apie->get_default_equipment($info);
    }
    //获取设备关联客户.
    public function get_default_customer(){
        $info=$_REQUEST;
        echo $this->apie->get_default_customer($info);
    }
    //添加或更新维保记录.
    public function change_record(){
        $info=$_REQUEST;
        $info['attachment']=isset($_FILES['attachment'])?$_FILES['attachment']:'';
        echo $this->apie->change_record($info);
    }
    //维保记录列表.
    public function get_maintenance_record(){
        $info=$_REQUEST;
        echo $this->apie->get_maintenance_record($info);
    }
    //维保记录详情.
    public function get_maintenance_record_detail(){
        $info=$_REQUEST;
        echo $this->apie->get_maintenance_record_detail($info);
    }
    //附件下载
    public function download_file(){
        $info=$_REQUEST;
        $this->apie->download_file($info['attach']);
    }
}