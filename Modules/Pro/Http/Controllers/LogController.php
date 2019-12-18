<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: efa.php
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

class LogController extends Controller{
	public function __construct() {
		$this->apiq=new Apiq;
		$this->type='log';
	}
	//列表信息
	public function public_get_list(){
		$info=$_REQUEST;
		echo $this->apiq->get_list($this->type, $info);
	}
	//详情
	public function public_get_info(){
		$info=$_REQUEST;
		echo $this->apiq->get_info($this->type, $info);
	}
	//增加信息
	public function public_add(){
		$info=$_REQUEST;
		echo $this->apiq->add_info($this->type, $info);
	}
}