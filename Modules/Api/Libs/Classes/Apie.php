<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: apip.class.php
* Author: MIXIOT Team
* Description: expands`s api(s)
* Version:V1.0.0
*
*-------------------------------------------------------------------------------
* Date Author(s) Status & Comments
*-------------------------------------------------------------------------------
* 2018/08/28 qinguoqing Creating
*--------------------------------------------------------------------------------
*/
namespace Modules\Api\Libs\Classes;
use Illuminate\Support\Facades\Redis;
class Apie extends ApiBase{
	public static $report_url;
	public static $work_url;
	public static $fidata_url;
	public function __construct(){
		parent::__construct();
		self::$report_url=$this->sysconfig['protocol'].$this->sysconfig['report_url'];
		self::$work_url=$this->sysconfig['protocol'].$this->sysconfig['works_url'];
        self::$fidata_url=$this->sysconfig['protocol'].$this->sysconfig['fidata_url'];
	}
	/*=START========== API OF Mixreport ===========*/
	/**
	 * Get report outlist.
	 * @param bool $is_all
	 * @param int $page_index
	 * @param int $page_size
	 * @param string $condition eg:[["output_name", "LIKE", "长沙三和能耗分析"]]:查询报告名称中包含‘长沙三和能源分析’的报告；[["output_id", "EQ", "2"]]:查询报告编号中等于‘2’的报告；
	 */
	public function get_report_outlist($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$report_url.'/api/pro/outlist', $data, self::$token);
		return $res;
	}
	/**
	 * Get report outdata.
	 * @param int $output_id
	 */
	public function get_report_outdata($output_id){
		$res=$this->http_get(self::$report_url.'/api/pro/outdata?output_id='.$output_id, self::$token);
		return $res;
	}
	/**
	 * Download report file.
	 * @param int $output_id
	 */
	public function download_report_file($output_id){
		redirect(self::$report_url.'/api/pro/download?output_id='.$output_id)->send();
	}
	/**
	 * Get report outlist.
	 * @param bool $is_all
	 * @param string $username
	 * @param int $page_index
	 * @param int $page_size
	 * @param string $condition eg:[["output_name", "LIKE", "长沙三和能耗分析"]]:查询报告名称中包含‘长沙三和能源分析’的报告；[["output_id", "EQ", "2"]]:查询报告编号中等于‘2’的报告；
	 */
	public function get_user_report_outlist($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$report_url.'/api/pro/outlistauth', $data, self::$token);
		return $res;
    }
    /*=END========== API OF Mixreport ===========*/
	/*=START========== API OF Mixworks ===========*/
	/**
	 * Get works tasklist.
	 * @param bool $is_all
	 * @param int $page_index
	 * @param int $page_size
	 * @param string $condition eg:[["task_name", "LIKE", "定制"]]:查询任务名称中包含‘定制’的任务；[["task_id", "EQ", "2"]]:查询任务编号中等于‘2’的任务；
	 * @param string $equipment_id
	 * @param int $is_avaiable 0:已处理；1:未处理
	 */
	public function get_works_tasklist($data){
		$data=$this->data_format($data);
		//$res=$this->http_post(self::$work_url.'/api/pro/tasklist', $data, self::$token);
        $res=$this->http_post(self::$work_url.'/api/app/tasklist', $data, self::$token);
		return $res;
	}
	/**
	 * Get user works tasklist.
	 * @param bool $is_all
	 * @param int $page_index
	 * @param int $page_size
	 * @param string $condition eg:[["task_name", "LIKE", "定制"]]:查询任务名称中包含‘定制’的任务；[["task_id", "EQ", "2"]]:查询任务编号中等于‘2’的任务；
	 * @param string $equipment_id
	 * @param int $is_avaiable 0:已处理；1:未处理
	 * @param string $user_id
	 */
	public function get_user_works_tasklist($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$work_url.'/api/pro/taskauthlist', $data, self::$token);
		return $res;
	}
	/**
	 * Get works taskequlist.
	 * @param int $task_id
	 */
	public function get_works_taskdetail($task_id){
		$res=$this->http_get(self::$work_url.'/api/pro/taskdetail?task_id='.$task_id, self::$token);
		return $res;
	}
	/**
	 * Dispose works task.
	 * @param int $task_id
	 */
	public function dispose_works_task($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$work_url.'/api/pro/taskdispose', $data, self::$token);
		return $res;
    }
    /**
	 * 获取维保列表.
	 * @param int $page_index
	 * @param int $page_size
	 * @param string $search json数组Eg:[[‘equipment_id’,1001]]
	 */
	public function get_maintenance($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$work_url.'/api/app/maintenance', $data, self::$token);
		return $res;
    }
    /**
	 * 获取维保详情.
	 * @param int $maintenance_id
	 */
	public function get_maintenance_detail($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$work_url.'/api/app/maintenanceDetail', $data, self::$token);
		return $res;
    }
    /**
	 * 周期变更.
     * @param string $maintenance_id
     * @param string $period
     * @param string $unit
	 */
	public function change_period($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$work_url.'/api/app/changePeriod', $data, self::$token);
		return $res;
    }
    /**
	 * 获取设备名称.
	 * @param int $equipment_id
	 */
	public function get_default_equipment($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$work_url.'/api/app/getDefaultEquipment', $data, self::$token);
		return $res;
    }
    /**
	 * 获取设备关联客户.
	 * @param int $customer_id
	 */
	public function get_default_customer($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$work_url.'/api/app/getDefaultCustomer', $data, self::$token);
		return $res;
    }
    /**
	 * 添加或更新维保记录.
	 * @param int $service_id
	 * @param string $service_name
	 * @param string $date
     * @param string $description
     * @param string $customer_id
     * @param string $equipment_id
     * @param string $staff
     * @param string $attachment
     * @param string $maintenance_id
	 */
	public function change_record($data){
        $file=isset($data['attachment'])&&$data['attachment']?new \CurlFile($data['attachment']['tmp_name'], $data['attachment']['type'], $data['attachment']['name']):'';
		$data['attachment']=$file;
		$res=$this->http_post(self::$work_url.'/api/app/changeRecord', $data, self::$token);
		return $res;
    }
    /**
	 * 维保记录列表.
	 * @param int $page_index
	 * @param int $page_size
	 * @param string $search json数组Eg:[["maintenance_id",[8623,8622]]]
	 */
	public function get_maintenance_record($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$work_url.'/api/app/maintenanceRecord', $data, self::$token);
		return $res;
    }
    /**
	 * 维保记录详情.
	 * @param int $service_id
	 */
	public function get_maintenance_record_detail($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$work_url.'/api/app/maintenanceRecordDetail', $data, self::$token);
		return $res;
    }
    /**
	 * Download file.
	 * @param int $attach
	 */
	public function download_file($attach){
		redirect(self::$work_url.'/api/app/download?attach='.$attach)->send();
    }
    /**
	 * 获取报表列表.
	 * @param int $page_index
	 * @param int $page_size
	 * @param string $out_name
     * @param string $project_id
	 */
	public function get_report_list($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$report_url.'/api/report/list', $data, self::$token);
		return $res;
    }
    /**
	 * Download report file.
	 * @param int $output_id
	 */
	public function download_report($file_path, $output_name=''){
        $redis_key = self::$token.'_'.time();
        Redis::set('report_down', $redis_key);
        redirect(self::$report_url.'/api/report/download?file_path='.$file_path.'&output_name='.$output_name.'&down_token='.$redis_key)->send();
    }
    /**
	 * Download report file.
	 * @param int $output_id
	 */
	public function delete_report($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$report_url.'/api/report/delete', $data, self::$token);
		return $res;
    }
    /*=END========== API OF Mixworks ===========*/
    /*=START========== API OF Fidata ===========*/
    /**
     * 数据转存
     * @param String $start_time
     * @param String $end_time
     * @param String $equipment_id
     * @param String $keys
     * @param String $h5
     * @param String $merge
     * @param String $resample
     * @param String $method 数据降采样的方法 例子：“ffill”, “bfill", “sum”, “mean” 等,None表示不进行降采样
     */
    public function export_state_data($data){
        $data=$this->data_format($data);
		$res=$this->http_post(self::$fidata_url.'/export/export_data', $data, self::$token);
		return $res;
    }
    /**
     * 查询状态
     * @param String $state_id
     */
    public function get_state_status($state_id){
        $res=$this->http_get(self::$fidata_url.'/status/'.$state_id, self::$token);
		return $res;
    }
    /**
     * 下载导出文件
     * @param String $state_id
     */
    public function download_state_file($state_id){
        redirect(self::$fidata_url.'/download/'.$state_id)->send();
    }
    /**
     * 删除导出文件
     * @param String $state_id
     */
    public function delete_state_file($state_id){
        $res=$this->http_post(self::$fidata_url.'/delete/'.$state_id, array(), self::$token);
        return $res;
    }
    /**
     * 获取导出任务列表
     * @param String $page_size
     * @param String $page_index
     */
    public function get_state_list($data){
        $data=$this->data_format($data);
		$res=$this->http_post(self::$fidata_url.'/export/get_list', $data, self::$token);
		return $res;
    }
    /*=END========== API OF Fidata ===========*/
}
