<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: equipment_group.php
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

class EquipmentGroupController extends Controller{
	public function __construct() {
		$this->apiq=new Apiq;
		$this->type='equipment_group';
		$this->tableid='pro_equipment_group';
	}
	//设备列表
	public function public_get_list(){
		$info=$_REQUEST;
        $res=json_decode($this->apiq->get_list($this->type, $info), true);
        if(isset($res['result']['data'])){
            foreach($res['result']['data'] as $key=>$val){
                $equipment_group_id=$val['main_equipment'];
                $dashboard_config=json_decode($this->apiq->get_dashboard_template($equipment_group_id), true);
                $res['result']['data'][$key]['template']=json_decode($val['template'], true)?json_decode($val['template'], true):array();
                $res['result']['data'][$key]['dashboard_template']=isset($dashboard_config['result']['template'])?$dashboard_config['result']['template']:array();
            }
        }
        echo json_encode($res);
	}
	//获取所有设备列表
	public function public_get_all_list(){
		echo $this->apiq->get_all_list($this->type);
	}
	//设备下拉列表
	public function public_get_menu_list(){
		$info=$_REQUEST;
		echo $this->apiq->get_menu_list($this->type, $info);
	}
	//设备组详情
	public function public_get_info(){
		$info=$_REQUEST;
		echo $this->apiq->get_info($this->type, $info);
	}
	//获取设备组所属设备
	public function public_get_equipment(){
		$info=$_REQUEST;
		echo $this->apiq->get_group_equipment($info['group_id']);
	}
	//编辑信息
	public function public_edit(){
		$info=$_POST;
		echo $this->apiq->edit_info($this->type, $info);
	}
	//获取设备组历程
	public function public_get_process(){
		$info=$_REQUEST;
		echo $this->apiq->get_group_process($info);
	}
	//获取设备组事件
	public function public_get_event(){
		$info=$_REQUEST;
		echo $this->apiq->get_group_event($info);
	}
	//获取设备组故障
	public function public_get_fault_mosaic(){
		$info=$_REQUEST;
		echo $this->apiq->get_group_fault_mosaic($info);
	}
	//获取设备组告警
	public function public_get_alert_mosaic(){
		$info=$_REQUEST;
		echo $this->apiq->get_group_alert_mosaic($info);
	}
	//导出设备组信息
	public function public_export(){
		$info=$_REQUEST;
		//$info['head']='[["group_id","项目编号"],["group_name","项目名称"],["热效率/%","热效率/%"],["累计流量/T","累计流量/T"],["累计耗电量/kW","累计耗电量/kW"],["累计耗水量/T","累计耗水量/T"],["customer_name","客户名称"],["created","项目创建时间"]]';
		$head=array();
		$fields=array();
		foreach(json_decode(stripslashes($info['head'])) as $key=>$val){
			$head[]=$val[1];
			$fields[]=$val[0];
		}
		$res=json_decode($this->apiq->get_list($this->type, $info), true);
		header("Content-type:text/csv");
		header("Content-Disposition:attachment;filename=".date('Y-m-d-His-').rand(1000, 9999).'.csv');
		//echo '"'.iconv('UTF-8', 'gb2312', implode('","', $head))."\"\r\n";
		echo '"'.mb_convert_encoding(implode('","', $head), 'gb2312', 'UTF-8')."\"\r\n";
		foreach($res['result']['data'] as $key=>$val){
			$row=array();
			foreach($fields as $k=>$v){
				$row[]=isset($val[$v])?str_replace('"', '""', $val[$v]):'';
			}
			//echo '"'.iconv('UTF-8', 'gb2312', implode('","', $row))."\"\r\n";
			echo '"'.mb_convert_encoding(implode('","', $row), 'gb2312', 'UTF-8')."\"\r\n";
		}
	}
	//获取设备组故障/报警挂板数据
	public function public_get_mosaic_warn(){
		$info=$_REQUEST;
		echo $this->apiq->get_equipment_group_mosaic_warn($info);
	}
}