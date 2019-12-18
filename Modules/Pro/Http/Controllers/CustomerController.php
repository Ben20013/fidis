<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: customer.php
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

class CustomerController extends Controller{
	public function __construct() {
		$this->apiq=new Apiq;
		$this->type='customer';
	}
	//客户列表
	public function public_get_list(){
		$info=$_REQUEST;
		echo $this->apiq->get_list($this->type, $info);
	}
	//客户下拉列表
	public function public_get_menu_list(){
		$info=$_REQUEST;
		echo $this->apiq->get_menu_list($this->type, $info);
	}
	//客户详情 equipment_id
	public function public_get_info(){
		$info=$_REQUEST;
		echo $this->apiq->get_info($this->type, $info);
	}
	//增加设备关注
	public function public_add(){
		$info=$_REQUEST;
		unset($info['m']);
		unset($info['c']);
		unset($info['a']);
		echo $this->apiq->add_info('user_customer', $info);
	}
	//取消关注
	public function public_multi_delete(){
		$info=$_REQUEST;
		echo $this->apiq->multi_delete('user_customer', $info);
	}
}