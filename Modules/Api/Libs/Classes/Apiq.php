<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: apiq.class.php
* Author: MIXIOT Team
* Description: Interface for querying basic data
* Version:V1.0.0
*
*-------------------------------------------------------------------------------
* Date Author(s) Status & Comments
*-------------------------------------------------------------------------------
* 2018/08/28 qinguoqing Creating
*--------------------------------------------------------------------------------
*/
namespace Modules\Api\Libs\Classes;
class Apiq extends ApiBase{
	public function __construct(){
		parent::__construct();
        $this->sys_url=self::$url;
        $this->boss_url='http://boss.mixiot.top:9000/';
	}
	/**
	 * Login the system.
	 * @param string $username
	 * @param string $password
	 * @param string $system
	 */
	public function login($username, $password, $system, $keep_alive='default'){
		$data=array(
			'username'=>$username,
			'password'=>$password,
            'system'=>$system,
            'keep_alive'=>$keep_alive
		);
		$res=$this->http_post(self::$url.'/api/login', $data);
		return $res;
    }
    /**
	 * Login the system.
	 * @param string $username
	 * @param string $password
	 * @param string $system
	 */
    public function get_app_url($mobile){
        $data=array(
			'mobile'=>$mobile
        );
        $res=$this->http_post(self::$url.'/api/app/login', $data);
		return $res;
    }
	/**
	 * App login the system.
	 * @param string $username
	 * @param string $password
	 * @param string $system
	 */
	public function app_login($username, $password, $system, $keep_alive='default'){
		$data=array(
			'username'=>$username,
			'password'=>$password,
            'system'=>$system,
            'keep_alive'=>$keep_alive
		);
		$res=$this->http_post(self::$url.'/api/app/login', $data);
		return $res;
    }
    /**
	 * Get token by refreshtoken.
	 * @param string $refreshtoken
	 * @param string $source
	 */
    public function refresh_token($data){
        $res=$this->http_post(self::$url.'/api/refresh_token', $data);
		return $res;
    }
	/**
	 * Get current userinfo
	 */
	public function get_current_userinfo(){
		$data=array();
		$res=$this->http_post(self::$url.'/api/user', $data, self::$token);
		return $res;
	}
	/**
	 * Reset the user password.
	 * @param string $old_password
	 * @param string $new_password
	 */
	public function reset_password($old_password, $new_password){
		$data=array(
			'old_password'=>$old_password,
			'new_password'=>$new_password
		);
		$res=$this->http_post(self::$url.'/api/user/reset_password', $data, self::$token);
		return $res;
	}
	/**
	 * Upload file.
	 * @param string $upload_file
	 * @param string $type activity/service
	 */
	public function upload_file($upload_file, $type){
		$file=new \CurlFile($upload_file['tmp_name'], $upload_file['type'], $upload_file['name']);
		$data=array(
			'upload_file'=>$file,
			'type'=>$type
		);
		$res=$this->http_post(self::$url.'/api/file/upload', $data, self::$token);
		return $res;
	}
	/**
	 * Download file.
	 * @param string $path
	 */
	public function download_file($path){
		redirect(self::$url.'/api/file/download?path='.$path)->send();
	}
	/**
	 * Get data list.
	 * @param string $type
	 * 		customer(客户)/aprus(适配器)/codebase(代码含义)/config(代码含义)/equipment(设备)/
	 * 		datasheet(设备数据)/mapping(映射表)/statistics(统计计算映射表)/dashboard(显示板)/user(用户)/
	 * 		user_equipment(用户与设备关联关系)/user_customer(用户与客户关注对应)/collect(离线数据采集类型)/event(事件)/fault(故障)/
	 * 		fault_mosaic(设备故障)/alert(告警)/alert_mosaic(设备告警)/service(服务)/activity(作业)/
	 * 		message(消息)/collectos(离线数据采集结果记录)/statos(统计计算结果)/normal(设备状态统计)/log(日志)
	 * @param bool $is_all
	 * @param int $page_index
	 * @param int $page_size
	 * @param string $condition eg:[["customer_id", "like", "zhiwulian"], ["customer_name", "=", "智物联"]]
	 * @param string $start_time
	 * @param string $end_time
	 */
	public function get_list($type, $data){
		$data=$this->data_format($data);
		if(isset($data['condition'])){
			$data['condition']=str_replace('\\', '', $data['condition']);
		}
		$res=$this->http_post(self::$url.'/api/'.$type.'/get_list', $data, self::$token);
		return $res;
	}
	/**
	 * Get detail info.
	 * @param string $type
	 * 		customer(客户)/aprus(适配器)/codebase(代码含义)/config(代码含义)/equipment(设备)/
	 * 		datasheet(设备数据)/mapping(映射表)/statistics(统计计算映射表)/dashboard(显示板)/user(用户)/
	 * 		user_equipment(用户与设备关联关系)/user_customer(用户与客户关注对应)/collect(离线数据采集类型)/event(事件)/fault(故障)/
	 * 		fault_mosaic(设备故障)/alert(告警)/alert_mosaic(设备告警)/service(服务)/activity(作业)/
	 * 		message(消息)/collectos(离线数据采集结果记录)/statos(统计计算结果)/log(日志)
	 * @param string $data_id
	 */
	public function get_info($type, $data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/'.$type.'/get', $data, self::$token);
		return $res;
	}
	/**
	 * Add info.
	 * @param string $type
	 * 		customer(客户)/aprus(适配器)/codebase(代码含义)/config(代码含义)/equipment(设备)/
	 * 		datasheet(设备数据)/mapping(映射表)/statistics(统计计算映射表)/dashboard(显示板)/user(用户)/
	 * 		user_equipment(用户与设备关联关系)/user_customer(用户与客户关注对应)/collect(离线数据采集类型)/event(事件)/fault(故障)/
	 * 		fault_mosaic(设备故障)/alert(告警)/alert_mosaic(设备告警)/service(服务)/activity(作业)/
	 * 		message(消息)/collectos(离线数据采集结果记录)/statos(统计计算结果)/log(日志)
	 * @param string $data
	 */
	public function add_info($type, $data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/'.$type.'/add', $data, self::$token);
		return $res;
	}
	/**
	 * Edit info.
	 * @param string $type
	 * 		customer(客户)/aprus(适配器)/codebase(代码含义)/config(代码含义)/equipment(设备)/
	 * 		datasheet(设备数据)/mapping(映射表)/statistics(统计计算映射表)/dashboard(显示板)/user(用户)/
	 * 		user_equipment(用户与设备关联关系)/user_customer(用户与客户关注对应)/collect(离线数据采集类型)/event(事件)/fault(故障)/
	 * 		fault_mosaic(设备故障)/alert(告警)/alert_mosaic(设备告警)/service(服务)/activity(作业)/
	 * 		message(消息)/collectos(离线数据采集结果记录)/statos(统计计算结果)
	 * @param string $data
	 */
	public function edit_info($type, $data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/'.$type.'/edit', $data, self::$token);
		return $res;
	}
	/**
	 * Delete info.
	 * @param string $type
	 * 		customer(客户)/aprus(适配器)/codebase(代码含义)/config(代码含义)/equipment(设备)/
	 * 		datasheet(设备数据)/mapping(映射表)/statistics(统计计算映射表)/dashboard(显示板)/user(用户)/
	 * 		user_equipment(用户与设备关联关系)/user_customer(用户与客户关注对应)/collect(离线数据采集类型)/event(事件)/fault(故障)/
	 * 		fault_mosaic(设备故障)/alert(告警)/alert_mosaic(设备告警)/service(服务)/activity(作业)/
	 * 		message(消息)/collectos(离线数据采集结果记录)/statos(统计计算结果)
	 * @param string $data_id
	 */
	public function delete_info($type, $data_id){
		$data=array(
			$type.'_id'=>$data_id,
		);
		$res=$this->http_post(self::$url.'/api/'.$type.'/delete', $data, self::$token);
		return $res;
	}
	/**
	 * Delete info.
	 * @param string $type
	 * 		user_equipment(用户与设备关联关系)/user_customer(用户与客户关注对应)
	 * @param string $data_id
	 */
	public function multi_delete($type, $data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/'.$type.'/multi_delete', $data, self::$token);
		return $res;
	}
	/**
	 * Get all data list.
	 * @param string $type customer(客户)/equipment(设备)/
	 * @param bool $is_all
	 * @param int $page_index
	 * @param int $page_size
	 * @param string $condition eg:[["customer_id", "like", "zhiwulian"], ["customer_name", "=", "智物联"]]
	 * @param string $start_time
	 * @param string $end_time
	 */
	public function get_all_list($type, $is_all=1, $page_index=1, $page_size=20, $condition='[]', $start_time='', $end_time=''){
		$data=array(
			'is_all'=>$is_all,
			'page_index'=>$page_index,
			'page_size'=>$page_size,
			'condition'=>$condition,
			//'start_time'=>$start_time?$start_time:date('Y-m-d H:i:s', 1),
			//'end_time'=>$end_time?$end_time:date('Y-m-d H:i:s')
		);
		if(isset($data['condition'])){
			$data['condition']=str_replace('\\', '', $data['condition']);
		}
		$res=$this->http_post(self::$url.'/api/'.$type.'/get_all_list', $data, self::$token);
		return $res;
	}
	/**
	 * Get menu list.
	 * @param string $type customer(客户)/equipment(设备)/collect(离线数据采集类型)/collectos(离线数据采集结果记录)/statos(统计计算结果)
	 * @param bool $is_all
	 * @param int $page_index
	 * @param int $page_size
	 * @param string $condition eg:[["customer_id", "like", "zhiwulian"], ["customer_name", "=", "智物联"]]
	 */
	public function get_menu_list($type, $data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/'.$type.'/get_menu_list', $data, self::$token);
		return $res;
	}
	/**
	 * Get codebase template by equipment_id.
	 * @param string $equipment_id
	 */
	public function get_codebase_template($equipment_id){
		$data=array(
			'equipment_id'=>$equipment_id,
		);
		$res=$this->http_post(self::$url.'/api/equipment/get_codebase_template', $data, self::$token);
		return $res;
	}
	/**
	 * Get warn info by equipment_id.
	 * @param string $equipment_id
	 * @param string $total
	 */
	public function get_warn_info($equipment_id, $total=20){
		$data=array(
			'equipment_id'=>$equipment_id,
			'total'=>$total
		);
		$res=$this->http_post(self::$url.'/api/equipment/get_warn_info', $data, self::$token);
		return $res;
	}
	/**
	 * Get task info by equipment_id.
	 * @param string $equipment_id
	 * @param string $total
	 */
	public function get_task_info($equipment_id, $total=20){
		$data=array(
			'equipment_id'=>$equipment_id,
			'total'=>$total
		);
		$res=$this->http_post(self::$url.'/api/equipment/get_task_info', $data, self::$token);
		return $res;
	}
	/**
	 * Get dashboard template by equipment_id.
	 * @param string $equipment_id
	 */
	public function get_dashboard_template($equipment_id){
		$data=array(
			'equipment_id'=>$equipment_id,
		);
		$res=$this->http_post(self::$url.'/api/equipment/get_dashboard_template', $data, self::$token);
		return $res;
	}
	/**
	 * Get concerned equipment list by user id.
	 * @param string $user_id
	 * @param bool $is_all
	 * @param int $page_index
	 * @param int $page_size
	 */
	public function get_concerned_equipment_list($user_id, $is_all=1, $page_index=1, $page_size=20){
		$data=array(
			'user_id'=>$user_id,
			'is_all'=>$is_all,
			'page_index'=>$page_index,
			'page_size'=>$page_size,
		);
		$res=$this->http_post(self::$url.'/api/user_equipment/get_equipment_list', $data, self::$token);
		return $res;
	}
	/**
	 * Get concerned customer list by user id.
	 * @param string $user_id
	 * @param bool $is_all
	 * @param int $page_index
	 * @param int $page_size
	 */
	public function get_concerned_customer_list($user_id, $is_all=1, $page_index=1, $page_size=20){
		$data=array(
			'user_id'=>$user_id,
			'is_all'=>$is_all,
			'page_index'=>$page_index,
			'page_size'=>$page_size,
		);
		$res=$this->http_post(self::$url.'/api/user_customer/get_customer_list', $data, self::$token);
		return $res;
	}
	/**
	 * Get fault list by equipment id.
	 * @param string $type fault_mosaic(设备故障)/alert_mosaic(设备告警)
	 * @param string $equipment_id
	 * @param bool $is_all
	 * @param int $page_index
	 * @param int $page_size
	 */
	public function get_list_by_equipment_id($type, $data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/'.$type.'/get_list_by_equipment_id', $data, self::$token);
		return $res;
	}
	/**
	 * Get fault list by user id.
	 * @param string $type fault_mosaic(设备故障)/alert_mosaic(设备告警)
	 * @param bool $is_all
	 * @param int $page_index
	 * @param int $page_size
	 */
	public function get_fault_list_by_user_id($type, $is_all=1, $page_index=1, $page_size=20){
		$data=array(
			'is_all'=>$is_all,
			'page_index'=>$page_index,
			'page_size'=>$page_size,
		);
		$res=$this->http_post(self::$url.'/api/'.$type.'/get_list_by_user', $data, self::$token);
		return $res;
	}
	/**
	 * Get about us data.
	 */
	public function get_about_us_data(){
		$res=$this->http_post(self::$url.'/api/setting/about_us', array(), self::$token);
		return $res;
	}
	/**
	 * Feedback.
	 */
	public function feedback($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/setting/about_us', $data, self::$token);
		return $res;
	}
	/**
	 * Get equipment group`s equipment.
	 * @param string $group_id
	 */
	public function get_group_equipment($group_id){
		$data=array(
			'group_id'=>$group_id,
		);
		$res=$this->http_post(self::$url.'/api/equipment_group/get_equipment', $data, self::$token);
		return $res;
	}
	/**
	 * Get equipment group`s process.
	 * @param string $group_id
	 */
	public function get_group_process($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/equipment_group/get_process', $data, self::$token);
		return $res;
	}
	/**
	 * Get equipment group`s event.
	 * @param string $group_id
	 */
	public function get_group_event($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/equipment_group/get_event', $data, self::$token);
		return $res;
	}
	/**
	 * Get equipment group`s fault mosaic.
	 * @param string $group_id
	 */
	public function get_group_fault_mosaic($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/equipment_group/get_fault_mosaic', $data, self::$token);
		return $res;
	}
	/**
	 * Get equipment group`s alert mosaic.
	 * @param string $group_id
	 */
	public function get_group_alert_mosaic($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/equipment_group/get_alert_mosaic', $data, self::$token);
		return $res;
	}
	/**
	 * Get equipment group`s alert mosaic.
	 * @param string $group_id
	 */
	public function get_all_warn($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/common/get_all_warn', $data, self::$token);
		return $res;
	}
	/*=========== API FOR EXP ===========*/
	/**
	 * Get menu list for EXP.
	 * @param string $type event(事件)/fault(故障)/alert(告警)/service(服务)/activity(作业)
	 * @param bool $is_all
	 * @param int $page_index
	 * @param int $page_size
	 * @param string $condition eg:[["customer_id", "like", "zhiwulian"], ["customer_name", "=", "智物联"]]
	 */
	public function get_exp_menu_list($type, $is_all=1, $page_index=1, $page_size=20, $condition='[]', $start_time='', $end_time=''){
		$data=array(
			'is_all'=>$is_all,
			'page_index'=>$page_index,
			'page_size'=>$page_size,
			'condition'=>$condition,
			'start_time'=>$start_time?$start_time:date('Y-m-d H:i:s', 1),
			'end_time'=>$end_time?$end_time:date('Y-m-d H:i:s')
		);
		$res=$this->http_post(self::$url.'/api/exp/'.$type.'/get_menu_list', $data, self::$token);
		return $res;
	}
	/*=========== API FOR PRO ===========*/
	/**
	 * Get statistics data for PRO.
	 */
	public function get_statistics(){
		$res=$this->http_post(self::$url.'/api/pro/statistics', array(), self::$token);
		return $res;
	}
	/**
	 * Get statistics data for PRO.（PLUS）
	 */
	public function get_statistics_plus()
    {
        $res = $this->http_post(self::$url . '/api/pro/statisticsPlus', array(), self::$token);
        return $res;
    }
    /**
     * Get statistics data for PRO.（SHOW）
     */
    public function get_equipment_total_plus()
    {
        $res = $this->http_post(self::$url . '/api/pro/getEquipmentTotalPlus', array(), self::$token);
        return $res;
    }
	/**
	 * Get equipment map distribution data for PRO to show in map.
	 */
	public function get_equipment_map_distribution($info){
		$res=$this->http_get(self::$url.'/api/pro/equipment/distributionInMap?group_id='.$info['group_id'], self::$token);
		return $res;
	}
	/**
	 * Get equipment area distribution data for PRO.
	 */
	public function get_equipment_area_distribution(){
		$res=$this->http_get(self::$url.'/api/pro/equipment/distribution', self::$token);
		return $res;
	}
	/**
	 * Get service statistics data for PRO.
	 */
	public function get_service_statistics($interval=7){
		$res=$this->http_get(self::$url.'/api/pro/service/count?intervalDay='.$interval, self::$token);
		return $res;
	}
	/**
	 * Get efa statistics data for PRO.
	 */
	public function get_efa_statistics($interval=15){
		$res=$this->http_get(self::$url.'/api/pro/equipment/statisticsQuestion?intervalDay='.$interval, self::$token);
		return $res;
	}
	/**
	 * Get mapping data for PRO.
	 */
	public function get_mapping($equipment_id){
		$data=array(
			'equipment_id'=>$equipment_id
		);
		$res=$this->http_post(self::$url.'/api/pro/getMapping', $data, self::$token);
		return $res;
	}
	/**
	 * Get alert point data for PRO.
	 */
	public function get_alert_point($equipment_id, $start_time, $end_time){
		$res=$this->http_get(self::$url.'/api/pro/equipment/alertPoint?equipment_id='.$equipment_id.'&start_time='.$start_time.'&end_time='.$end_time, self::$token);
		return $res;
	}
	/**
	 * Get dashboard config data for PRO.
	 */
	public function get_dashboard_config($equipment_id){
		$data=array(
			'equipment_id'=>$equipment_id
		);
		$res=$this->http_post(self::$url.'/api/pro/equipment/dashboardConfig', $data, self::$token);
		return $res;
	}
	/**
	 * Get single equipment gps data for PRO.
	 */
	public function get_location($equipment_id){
		$res=$this->http_get(self::$url.'/api/pro/equipment/singleInMap?equipment_id='.$equipment_id, self::$token);
		return $res;
	}
	/**
	 * Get equipment process data for PRO.
	 */
	public function get_process_history($equipment_id, $start_time, $end_time, $page_index, $page_size){
		$data=array(
			'equipment_id'=>$equipment_id,
			'start_time'=>$start_time,
			'end_time'=>$end_time,
			'page_index'=>$page_index,
			'page_size'=>$page_size
		);
		$res=$this->http_get(self::$url.'/api/pro/events/history?equipment_id='.$equipment_id.'&start_time='.$start_time.'&end_time='.$end_time.'&page_index='.$page_index.'&page_size='.$page_size, self::$token);
		return $res;
	}
	/**
	 * Get equipment process data for PRO.
	 */
	public function get_process_history_item($id, $type){
		$data=array(
			'id'=>$id,
			'type'=>$type,
		);
		$res=$this->http_get(self::$url.'/api/pro/events/historyItem?id='.$id.'&type='.$type, self::$token);
		return $res;
	}
	/**
	 * Get equipment mosaic warn data for PRO.
	 */
	public function get_equipment_mosaic_warn($data){
		$res=$this->http_post(self::$url.'/api/equipment/get_mosaic_warn', $data, self::$token);
		return $res;
	}
	/**
	 * Get equipment mosaic warn data for PRO.
	 */
	public function get_equipment_group_mosaic_warn($data){
		$res=$this->http_post(self::$url.'/api/equipment_group/get_mosaic_warn', $data, self::$token);
		return $res;
	}
	/**
	 * Check equipment control auth.
	 */
	public function check_equipment_control_auth($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/equipment/auth_check', $data, self::$token);
		return $res;
	}
	/**
	 * Reset equipment control auth.
	 */
	public function reset_equipment_control_auth($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/equipment/reset_auth', $data, self::$token);
		return $res;
	}
    /**
     * Get customer month statistics data for SHOW.（HeTai）
     */
    public function get_customer_plus(){
        $res=$this->http_post(self::$url.'/api/mixshow/customer/get_customer_plus', array(), self::$token);
        return $res;
    }
    /**
     * Get customer equipment statistics data for SHOW.（HeTai）
     */
    public function get_customer_equipment($type, $is_all=1, $page_index=1, $page_size=20){
        $data=array(
            'is_all'=>$is_all,
            'page_index'=>$page_index,
            'page_size'=>$page_size,
        );
        $res=$this->http_post(self::$url.'/api/mixshow/customer/get_customer_equipment', $data, self::$token);
        return $res;
    }
    /**
     * Get equipment type statistics data for SHOW.（HeTai）
     */
    public function get_equipment_type_plus(){
        $res=$this->http_post(self::$url.'/api/mixshow/equipment/get_equipment_type_plus', array(), self::$token);
        return $res;
    }
    /**
     * Get equipment statistics data for SHOW.（HeTai）
     */
    public function get_equipment_plus(){
        $res=$this->http_post(self::$url.'/api/mixshow/equipment/get_equipment_plus', array(), self::$token);
        return $res;
    }

    /**
     * Get dashboard data.
     * @param string $equipment_id
     * @param string $type 类型为：template/script/exp/mixshow/control，不传则返回所有
     */
    public function get_dashboard($data){
        $data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/equipment/get_dashboard', $data, self::$token);
		return $res;
    }
    /**
     * Get equipment data for SHOW.（HeTai）
     */
    public function get_equipment_list($type, $is_all=1, $page_index=1, $page_size=20, $condition='[]', $start_time='', $end_time=''){
        $data=array(
            'is_all'=>$is_all,
            'page_index'=>$page_index,
            'page_size'=>$page_size,
            'condition'=>$condition,
            //'start_time'=>$start_time?$start_time:date('Y-m-d H:i:s', 1),
            //'end_time'=>$end_time?$end_time:date('Y-m-d H:i:s')
        );
        if(isset($data['condition'])){
            $data['condition']=str_replace('\\', '', $data['condition']);
        }
        $res=$this->http_post(self::$url.'/api/mixshow/equipment/get_all_list', $data, self::$token);
        return $res;
    }
}