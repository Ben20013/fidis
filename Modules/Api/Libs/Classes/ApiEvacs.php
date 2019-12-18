<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: ApiEvacs.class.php
* Author: MIXIOT Team
* Description: send a command to control the equipment(s)
* Version:V1.0.0
*
*-------------------------------------------------------------------------------
* Date Author(s) Status & Comments
*-------------------------------------------------------------------------------
* 2018/08/28 qinguoqing Creating
*--------------------------------------------------------------------------------
*/
namespace Modules\Api\Libs\Classes;
class ApiEvacs extends ApiBase{
    public static $evacs_url;
	public function __construct(){
        parent::__construct();
        self::$evacs_url=$this->sysconfig['protocol'].$this->sysconfig['evacs_url'];
        //self::$evacs_url='http://52.82.119.95:9110';
	}
	/**
	 * Get project data.
	 * @param string $token
	 * @param int $project_id
	 * @param string $keyword
	 * @param int $page_index
	 * @param int $page_size
     * @param string $data 是否返回所有数据,all 返回所有
	 */
	public function get_project_list($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$evacs_url.'/incresa/project/project_list', $data, self::$token);
		return $res;
	}
	/**
	 * Get project info.
	 * @param string $token
	 * @param int $project_id
	 * @param string $keyword
	 */
	public function get_project_info($project_id, $keyword=''){
		$res=$this->http_get(self::$evacs_url.'/incresa/project/get_project?project_id='.$project_id.'&keyword='.$keyword, self::$token);
		return $res;
	}
	/**
	 * add project info.
	 * @param string $token
	 * @param string $project_name
	 * @param string $equipment_id
	 * @param string $active
	 * @param string $created
	 * @param string $script
	 * @param string $eference
	 * @param string $template
	 * @param string $algorithm_id 算法标识
	 * @param string $cycle 周期
	 */
	public function add_project($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$evacs_url.'/incresa/project/get_project', $data, self::$token);
		return $res;
    }
    /**
	 * edit project info.
	 * @param string $token
	 * @param string $project_name
	 * @param string $equipment_id
	 * @param string $active
	 * @param string $created
	 * @param string $script
	 * @param string $eference
	 * @param string $template
	 * @param string $algorithm_id
	 * @param string $cycle
	 */
	public function edit_project($data){
        $data=$this->data_format($data);
		$res=$this->http_put(self::$evacs_url.'/incresa/project/get_project', $data, self::$token);
		return $res;
    }
    /**
	 * Get latest grids by duration.
	 * @param string $token
	 * @param int $project_id
	 * @param int $active 1为启动 0 为停止
	 */
	public function start_project($data){
        $data=$this->data_format($data);
		$res=$this->http_post(self::$evacs_url.'/incresa/project/start_project', $data, self::$token);
		return $res;
    }
    /**
	 * Get equipment list.
	 * @param string $token
	 */
	public function get_equipment_list($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$evacs_url.'/incresa/project/get_equipment', $data, self::$token);
		return $res;
	}
	/**
	 * Get mapping info.
	 * @param string $token
	 */
	public function get_mapping($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$evacs_url.'/incresa/project/get_mapping', $data, self::$token);
		return $res;
	}
	/**
	 * Get engine list.
	 * @param string $token
	 * @param string $engine_id
	 * @param string $keyword
	 */
	public function get_engine_list($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$evacs_url.'/incresa/engine/engine_list', $data, self::$token);
		return $res;
	}
	/**
	 * Get engint info.
	 * @param string $token
	 * @param int $engine_id
	 * @param string $keyword
	 */
	public function get_engine_info($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$evacs_url.'/incresa/engine/get_engine', $data, self::$token);
		return $res;
	}
	/**
	 * add engine info.
	 * @param string $token
	 * @param string $engine_name
	 * @param string $project_id
	 * @param string $is_available
	 * @param string $created
	 * @param string $script
	 * @param string $eference
	 * @param string $template
	 * @param string $type
	 * @param string $limit
	 * @param string interval
	 */
	public function add_engine($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$evacs_url.'/incresa/engine/get_engine', $data, self::$token);
		return $res;
    }
    /**
	 * add engine info.
	 * @param string $token
	 * @param string $engine_name
	 * @param string $project_id
	 * @param string $is_available
	 * @param string $created
	 * @param string $script
	 * @param string $eference
	 * @param string $template
	 * @param string $type
	 * @param string $limit
	 * @param string interval
	 */
	public function edit_engine($data){
        $data=$this->data_format($data);
		$res=$this->http_post(self::$evacs_url.'/incresa/engine/get_engine', $data, self::$token);
		return $res;
	}
	/**
	 * Delete engine info.
	 * @param string $token
	 * @param int $id
	 */
	public function delete_engine($data){
        $data=$this->data_format($data);
		$res=$this->http_post(self::$evacs_url.'/incresa/engine/get_engine', $data, self::$token);
		return $res;
    }
    /**
	 * Get result list.
	 */
	public function get_result_list($data){
        $data=$this->data_format($data);
		$res=$this->http_post(self::$evacs_url.'/incresa/result/get_result', $data, self::$token);
		return $res;
    }
    /**
	 * Get user info.
	 */
	public function get_user_info(){
		$res=$this->http_post(self::$evacs_url.'/incresa/project/get_info', array(), self::$token);
		return $res;
    }
    /**
	 * Get version info.
	 */
	public function get_version_info(){
		$res=$this->http_post(self::$evacs_url.'/incresa/project/get_version', array(), self::$token);
		return $res;
	}
}