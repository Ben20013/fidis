<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: equipment.php
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
namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Api\Libs\Classes\Apiq;
use Modules\Api\Libs\Classes\Apis;
use Modules\Api\Libs\Classes\Apix;
use Modules\Api\Libs\Classes\Apip;
use Modules\Api\Libs\Classes\ApiEvacs;

class ApiEvacsController extends Controller{
	public function __construct() {
		$this->api_evacs=new ApiEvacs;
	}
	//设备列表
	public function get_project_list(){
		$info=$_REQUEST;
		echo $this->api_evacs->get_project_list($info);
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
	//设备详情 equipment_id
	public function public_get_info(){
		$info=$_REQUEST;
		echo $this->apiq->get_info($this->type, $info);
	}
	//增加设备关注
	public function public_add(){
		$info=$_REQUEST;
		echo $this->apiq->add_info($this->type, $info);
	}
	//编辑信息
	public function public_edit(){
		$info=$_POST;
		echo $this->apiq->edit_info($this->type, $info);
	}
	//取消设备关注
	public function public_multi_delete(){

	}
	//获取dashboard equipment_id
	public function public_get_dashboard_config(){
		$info=$_REQUEST;
		echo $this->apiq->get_dashboard_config($info['equipment_id']);
	}
	//获取报警故障数据
	public function public_get_warn_info(){
		$info=$_REQUEST;
		echo $this->apiq->get_warn_info($info['equipment_id'], $info['total']);
	}
	//获取任务数据
	public function public_get_task_info(){
		$info=$_REQUEST;
		echo $this->apiq->get_task_info($info['equipment_id'], $info['total']);
	}
	//获取设备定位信息
	public function public_get_location(){
		$info=$_REQUEST;
		echo $this->apiq->get_location($info['equipment_id']);
	}
	//获取最新栅格数据
	public function public_get_latest_grids_by_duration(){
		$info=$_REQUEST;
		echo $this->apix->get_duration_time_grid($info['aprus_id'], $info['start_time'], $info['end_time'], $info['page_size'], $info['page_index'], $info['topic']);
	}
	//获取最新mosaic数据
	public function public_get_last_mosaic(){
		$info=$_REQUEST;
		echo $this->apix->get_last_mosaic($info['equipment_id']);
	}
	//获取设备统计数据
	public function public_get_statistics(){
		$info=$_REQUEST;
		$info['statistics_id']=isset($info['statistics_id'])?$info['statistics_id']:'';
		echo $this->apis->get_statistic($info['statistics_id'], $info['equipment_id']);
	}
	//根据时间标识获取统计数据
	public function public_get_statistics_by_timeflag(){
		$info=$_REQUEST;
		echo $this->apis->get_statistic_by_timeflag($info['statistics_id'], $info['equipment_id'], $info['timeValue'], $info['timeFlag']);
	}
	//根据时间间隔获取统计数据
	public function public_get_statistics_by_period(){
		$info=$_REQUEST;
		echo $this->apis->get_statistic_by_period($info['statistics_id'], $info['equipment_id'], $info['timeFlag']);
	}
	//获取当月设备统计数据
	public function public_get_current_month_statistics(){
		$info=$_REQUEST;
		echo $this->apis->get_current_month_statistic($info['statistics_id'], $info['equipment_id']);
	}
	//获取当天设备统计数据
	public function public_get_today_statistic(){
		$info=$_REQUEST;
		echo $this->apis->get_today_statistic($info['statistics_id'], $info['equipment_id']);
	}
	//获取当天设备数据
	public function public_get_today_data(){
		$info=$_REQUEST;
		echo $this->apis->get_today_data($info['statistics_id'], $info['equipment_id']);
	}
	//获取当月设备数据
	public function public_get_current_month_data(){
		$info=$_REQUEST;
		echo $this->apis->get_current_month_data($info['statistics_id'], $info['equipment_id']);
	}
	//获取当年设备数据
	public function public_get_current_year_data(){
		$info=$_REQUEST;
		echo $this->apis->get_current_year_data($info['statistics_id'], $info['equipment_id']);
	}
	//获取历史数据
	public function public_get_history_data(){
		$info=$_REQUEST;
		echo $this->apis->get_history_data($info['statistics_id'], $info['equipment_id']);
	}
	//获取映射表 equipment_id
	public function public_get_mapping(){
		$info=$_REQUEST;
		echo $this->apiq->get_mapping($info['equipment_id']);
	}
	//根据key获取历史数据
	public function public_get_mosaic_by_key(){
		$info=$_REQUEST;
		echo $this->apix->get_mosaic_by_key($info['equipment_id'], $info['keys'], $info['start_time'], $info['end_time'], $info['page_size'], $info['page_index']);
	}
	//获取曲线数据
	public function public_get_line_data(){
		$info=$_REQUEST;
		echo $this->apix->get_line_data($info['equipment_id'], $info['keys'], $info['start_time'], $info['end_time']);
	}
	//获取告警点 equipment_id/start_time/end_time
	public function public_get_alert_point(){
		$info=$_REQUEST;
		echo $this->apiq->get_alert_point($info['equipment_id'], $info['start_time'], $info['end_time']);
	}
	//导出设备历史数据
	public function public_export_mosaic_data(){
		$info=$_REQUEST;
		echo $this->apix->export_mosaic_data($info['equipment_id'], $info['keys'], $info['title'], $info['start_time'], $info['end_time'], $info['page_size'], $info['page_index']);
	}
	//获取设备历程
	public function public_get_equip_process_history(){
		$info=$_REQUEST;
		echo $this->apiq->get_process_history($info['equipment_id'], $info['start_time'], $info['end_time'], $info['page_index'], $info['page_size']);
	}
	//获取设备历程
	public function public_get_equip_process_history_item(){
		$info=$_REQUEST;
		echo $this->apiq->get_process_history_item($info['id'], $info['type']);
	}
	//获取采集数据
	public function public_get_collectos_data(){
		$info=$_REQUEST;
		echo $this->apiq->get_list('collectos', $info);
	}
	//获取反向控制
	public function public_get_codebase_template(){
		$info=$_REQUEST;
		echo $this->apiq->get_codebase_template($info['equipment_id']);
	}
	//获取设备故障/报警挂板数据
	public function public_get_mosaic_warn(){
		$info=$_REQUEST;
		echo $this->apiq->get_equipment_mosaic_warn($info);
	}
	//监控界面曲线获取最近50条数据
	/**
	 * @param string equipment_id
	 * @param string keys eg:S01,S02,S03
	 */
	public function public_get_latest_line_data(){
		$info=$_REQUEST;
		$keys=explode(',', $info['keys']);
		$equip_res=json_decode($this->apiq->get_info($this->type, $info), true);
		$data=array(
			'code'=>$equip_res['code'],
			'msg'=>$equip_res['msg'],
		);
		foreach($keys as $key=>$val){
			if($val){
				$res=json_decode($this->apix->get_multiple_lastest_mosaic($info['equipment_id'], 100), true);
				$data['result'][$val]['data']=$data['result'][$val]['datetime']=array();
				if($res['code']==200){
					foreach($res['result']['data'] as $k=>$v){
						if(isset($v['value'][$val])){
							$data['result'][$val]['data'][]=$v['value'][$val];
							$data['result'][$val]['datetime'][]=$v['time'];
						}
					}
				}
				$data['result'][$val]['data']=array_reverse($data['result'][$val]['data']);
				$data['result'][$val]['datetime']=array_reverse($data['result'][$val]['datetime']);
			}
		}
		echo json_encode($data);
	}
	//导出设备数据
	public function public_export(){
		$info=$_REQUEST;
		//$info['head']='[["equipment_id","设备ID"],["equipment_name","设备名称"],["model","设备型号"],["status_name","设备状态"],["customer_name","客户名称"],["created","设备创建时间"]]';
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
	//获取设备状态统计
	public function public_get_normal_list(){
		$info=$_REQUEST;
		echo $this->apiq->get_list('normal', $info);
	}
	//获取设备状态统计
	public function public_get_normal_info(){
		$info=$_REQUEST;
		echo $this->apiq->get_info('normal', $info);
	}
	//反向控制鉴权
	public function public_check_control_auth(){
		$info=$_REQUEST;
		echo $this->apiq->check_equipment_control_auth($info);
	}
	//更改控制码
	public function public_reset_control_auth(){
		$info=$_REQUEST;
		echo $this->apiq->reset_equipment_control_auth($info);
	}
	//获取当前统计数据
	public function public_get_current_aggregate_by_timeflag(){
		$info=$_REQUEST;
		echo $this->apis->get_current_aggregate_by_timeflag($info['statistics_id'], $info['equipment_id'], $info['timeFlag']);
	}
}