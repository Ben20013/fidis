<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: report.php
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

class ReportController extends Controller{
	public function __construct() {
		$this->apiq=new Apiq;
		$this->apie=new Apie;
	}
	//获取报告列表
	public function public_get_outlist(){
		$info=$_REQUEST;
		echo $this->apie->get_report_outlist($info);
	}
	//获取报告详情
	public function public_get_outdata(){
		$info=$_REQUEST;
		echo $this->apie->get_report_outdata($info['output_id']);
	}
	//获取对应用户报告列表
	public function public_get_user_outlist(){
        $info=$_REQUEST;
        $info['user_id']=isset($info['user_id'])?$info['user_id']:session('user')['user_id'];
        $info['is_super']=isset($info['is_super'])?$info['is_super']:session('user')['is_super'];
        //echo $this->apie->get_user_report_outlist($info);
        echo $this->apie->get_report_list($info);
	}
	//下载文件
	public function public_download_report_file(){
		$info=$_REQUEST;
		$info['output_name']=isset($info['output_name'])?$info['output_name']:'';
        //$this->apie->download_report_file($info['output_id']);
        $this->apie->download_report($info['file_path'], $info['output_name']);
    }
    //删除报表
    public function delete_report(){
        $info=$_REQUEST;
        echo $this->apie->delete_report($info);
    }
}