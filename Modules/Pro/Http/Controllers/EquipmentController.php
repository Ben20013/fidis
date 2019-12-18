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
namespace Modules\Pro\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Api\Libs\Classes\Apiq;
use Modules\Api\Libs\Classes\Apis;
use Modules\Api\Libs\Classes\Apix;
use Modules\Api\Libs\Classes\Apip;
use Modules\Api\Libs\Classes\Apie;
use Modules\Pro\Models\AdminSettingModel;
use Exception;
use Error;

class EquipmentController extends Controller{
	public function __construct() {
		$this->apiq=new Apiq;
		$this->apis=new Apis;
		$this->apix=new Apix;
        $this->apip=new Apip;
        $this->apie=new Apie;
		$this->type='equipment';
		$this->tableid='pro_equipment';
		$this->admin_setting_model=new AdminSettingModel;
	}
	//设备列表
	public function public_get_list(){
		$info=$_REQUEST;
		echo $this->apiq->get_list($this->type, $info);
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
        if(isset($info['name'])&&$info['name']){
            $res=json_decode($this->apiq->get_mapping($info['equipment_id']), true);
            $script=array();
            foreach($res['result']['script'] as $key=>$val){
                if(strstr($val[2], $info['name'])){
                    $script[]=$val;
                }
            }
            $res['result']['script']=$script;
            echo json_encode($res);
        }else{
            echo $this->apiq->get_mapping($info['equipment_id']);
        }
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
    //获取显示板数据,pro/mixshow/control/...
    public function get_dashboard(){
        $info=$_REQUEST;
        $data=array('equipment_id'=>$info['equipment_id']);
        if(isset($info['type'])&&$info['type']){
            $data['type']=$info['type'];
        }
        echo $this->apiq->get_dashboard($data);
    }
    /**
     * 获取设备历史数据参数界面设置的方案
     * @param String $equipment_id
     */
    public function get_scheme(){
        $info=$_REQUEST;
        try{
            $userid='';
            if(!session('user')['user_id']){
                $user_info=json_decode($this->apiq->get_current_userinfo(), true);
                $userid=$user_info['result']['user_id'];
            }else{
                $userid=session('user')['user_id'];
            }
            $info['name']=isset($info['name'])?$info['name']:'';
            $query = $this->admin_setting_model->where([['value', $info['equipment_id']], ['module', 'Pro'], ['userid', $userid], ['is_deleted', '0'], ['variable', 'history_scheme'], ['name', 'like', "%{$info['name']}%"]]);
            $data = $query->orderBy('id', 'asc')->get(['uid', 'name', 'setting'])->toArray();
            echo json_encode(array(
                'code'=>200,
                'msg'=>'查询成功!',
                'mix_code'=>'',
                'mix_msg'=>'',
                'mix_ext'=>'',
                'result'=>array(
                    'total_records'=>count($data),
                    'data'=>$data
                ))
            );
        }catch(Exception  $exception){
            echo json_encode(array(
                'code'=>500,
                'msg'=>$exception->getMessage(),
                'mix_code'=>'',
                'mix_msg'=>'',
                'mix_ext'=>'',
                'result'=>array())
            );
        }
    }
    /**
     * 增加参数方案
     * @param String $name
     * @param String $equipment_id
     * @param String $setting
     */
    public function add_scheme(){
        $info=$_REQUEST;
        try{
			$userid='';
            if(!session('user')['user_id']){
                $user_info=json_decode($this->apiq->get_current_userinfo(), true);
                $userid=$user_info['result']['user_id'];
            }else{
                $userid=session('user')['user_id'];
            }
			$data =$this->admin_setting_model->where([['value', $info['equipment_id']], ['module', 'Pro'], ['userid', $userid], ['is_deleted', '0'], ['variable', 'history_scheme'], ['name', $info['name']]])->first();
			if ($data) {
				echo json_encode(array(
					'code'=>500,
					'msg'=>'方案名称已存在，请修改后再保存！',
					'mix_code'=>'',
					'mix_msg'=>'',
					'mix_ext'=>'',
					'result'=>array())
				);
				return;
			}
            $this->admin_setting_model->uid= $this->randomString(16);
            $this->admin_setting_model->module='Pro';
            $this->admin_setting_model->name=$info['name'];
            $this->admin_setting_model->value=$info['equipment_id'];
            $this->admin_setting_model->userid=$userid;
            $this->admin_setting_model->variable='history_scheme';
            $this->admin_setting_model->setting=$info['setting'];
            $this->admin_setting_model->save();
            echo json_encode(array(
                'code'=>200,
                'msg'=>'添加成功!',
                'mix_code'=>'',
                'mix_msg'=>'',
                'mix_ext'=>'',
                'result'=>array())
            );
        }catch(Exception  $exception){
            echo json_encode(array(
                'code'=>500,
                'msg'=>$exception->getMessage(),
                'mix_code'=>'',
                'mix_msg'=>'',
                'mix_ext'=>'',
                'result'=>array())
            );
        }
    }
    /**
     * 修改参数方案
     * @param String $uid
     * @param String $name
     * @param String $equipment_id
     * @param String $setting
     */
    public function edit_scheme(){
        $info=$_REQUEST;
        try{
            $userid='';
            if(!session('user')['user_id']){
                $user_info=json_decode($this->apiq->get_current_userinfo(), true);
                $userid=$user_info['result']['user_id'];
            }else{
                $userid=session('user')['user_id'];
            }
			$data =$this->admin_setting_model->where([['uid', '!=', $info['uid']], ['value', $info['equipment_id']], ['module', 'Pro'], ['userid', $userid], ['is_deleted', '0'], ['variable', 'history_scheme'], ['name', $info['name']]])->first();
			if ($data) {
				echo json_encode(array(
					'code'=>500,
					'msg'=>'方案名称已存在，请修改后再保存！',
					'mix_code'=>'',
					'mix_msg'=>'',
					'mix_ext'=>'',
					'result'=>array())
				);
				return;
			}
            $this->admin_setting_model->where('uid', $info['uid'])->update(array(
                'name'=>$info['name'],
                'value'=>$info['equipment_id'],
                'setting'=>$info['setting']
            ));
            echo json_encode(array(
                'code'=>200,
                'msg'=>'修改成功!',
                'mix_code'=>'',
                'mix_msg'=>'',
                'mix_ext'=>'',
                'result'=>array())
            );
        }catch(Exception  $exception){
            echo json_encode(array(
                'code'=>500,
                'msg'=>$exception->getMessage(),
                'mix_code'=>'',
                'mix_msg'=>'',
                'mix_ext'=>'',
                'result'=>array())
            );
        }
    }
    /**
     * 删除参数方案
     * @param String $uid
     */
    public function delete_scheme(){
        $info=$_REQUEST;
        try{
            $this->admin_setting_model->where('uid', $info['uid'])->delete();
            echo json_encode(array(
                'code'=>200,
                'msg'=>'删除成功!',
                'mix_code'=>'',
                'mix_msg'=>'',
                'mix_ext'=>'',
                'result'=>array())
            );
        }catch(Exception  $exception){
            echo json_encode(array(
                'code'=>500,
                'msg'=>$exception->getMessage(),
                'mix_code'=>'',
                'mix_msg'=>'',
                'mix_ext'=>'',
                'result'=>array())
            );
        }
    }
    /**
     * 导出数据
     * @param String $start_time
     * @param String $end_time
     * @param String $equipment_id
     * @param String $keys
     * @param String $h5
     * @param String $merge
     * @param String $resample
     * @param String $method 数据降采样的方法 例子：“ffill”, “bfill", “sum”, “mean” 等,None表示不进行降采样
     */
    public function export_state_data(){
        $info=$_REQUEST;
        echo $this->apie->export_state_data($info);
    }
    /**
     * 查询文件导出状态
     */
    public function get_state_status(){
        $info=$_REQUEST;
        echo $this->apie->get_state_status($info['state_id']);
    }
    /**
     * 下载导出文件
     * @param String $state_id
     */
    public function download_state_file(){
        $info=$_REQUEST;
        echo $this->apie->download_state_file($info['state_id']);
    }
    /**
     * 删除导出文件
     * @param String $state_id
     */
    public function delete_state_file(){
        $info=$_REQUEST;
        echo $this->apie->delete_state_file($info['state_id']);
    }
    /**
     * 获取导出任务列表
     * @param String $page_size
     * @param String $page_index
     */
    public function get_state_list(){
        $info=$_REQUEST;
        echo $this->apie->get_state_list($info);
    }
    /**
     * 返回随机字符串：不包括I和O的大写字母+数字
     * @param $lenth
     * @return String
     */
    private function randomString($lenth){
        return substr(str_shuffle(md5(uniqid(md5(microtime(true)),true))), 10, $lenth);
    }
}
