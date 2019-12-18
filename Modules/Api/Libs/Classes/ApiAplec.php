<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: apip.class.php
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
class ApiAplec extends ApiBase{
    public static $aplec_url;
	public function __construct(){
        parent::__construct();
        self::$aplec_url=$this->sysconfig['protocol'].$this->sysconfig['aplec_url'];
        self::$aplec_url='http://kps.mixiot.top:9003';
	}
	/**
	 * Get aplec data.
	 * @param string $page_index
	 * @param string $page_size
	 * @param string $aprus_id
	 * @param int $prob
     * @param string $type all/online/offline
	 */
	public function get_aplec_data($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$aplec_url.'/aplec_qy/aplec/get_aplec_data', $data, self::$token);
		return $res;
	}
	/**
	 * Control aplec.
	 * @param string $token
	 * @param string $i_type
	 * @param array $command
	 */
	public function control_aplec($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$aplec_url.'/aplec_qy/aplec/aplec_control', $data, self::$token);
		return $res;
	}
	/**
	 * Get aprus info.
	 * @param string $aprus_id
	 */
	public function get_aprus_info($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$aplec_url.'/aplec_qy/aplec/aprus_message', $data, self::$token);
		return $res;
    }
    /**
	 * Get aplec version.
	 * @param string $aprus_id
	 */
	public function get_aplec_version(){
		$res=$this->http_post(self::$aplec_url.'/aplec_qy/aplec/version', array(), self::$token);
		return $res;
    }
    /**
	 * Get latest grids by duration.
	 * @param string $page_index
	 * @param string $page_size
	 * @param string $aprus_id
	 * @param string $topic
     * @param string $start_time
     * @param string $end_time
	 */
	public function get_latest_grids_by_duration($data){
        $data=$this->data_format($data);
		$res=$this->http_post(self::$aplec_url.'/aplec_qy/aplec/latestGridsByDuration', $data, self::$token);
		return $res;
    }
    /**
	 * Get aplec detail.
	 * @param string $page_index
	 * @param string $page_size
	 * @param string $aprus_id
	 * @param int $prob
     * @param int $create_time
	 */
	public function get_aplec_detail($data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$aplec_url.'/aplec_qy/aplec/aplec_detail', $data, self::$token);
		return $res;
	}
}