<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: apis.class.php
* Author: MIXIOT Team
* Description: get the statistic data
* Version:V1.0.0
*
*-------------------------------------------------------------------------------
* Date Author(s) Status & Comments
*-------------------------------------------------------------------------------
* 2018/08/28 qinguoqing Creating
*--------------------------------------------------------------------------------
*/
namespace Modules\Api\Libs\Classes;
class Apii extends ApiBase{
    public static $indass_url;
	public function __construct(){
        parent::__construct();
        self::$indass_url=$this->sysconfig['protocol'].$this->sysconfig['indass_url'];
	}
	/**
	 * Get last result data.
	 * @param string $project_id
	 */
	public function get_last_result($data){
        $data=$this->data_format($data);
		$res=$this->http_post(self::$indass_url.'/v1/apii/lastResult', $data, self::$token);
		return $res;
	}
	/**
	 * Get result data by al.
	 * @param string $project_id
	 * @param string $page_size
     * @param string $page_index
     * @param array $algorithm_name
	 * @param string $start_time
	 * @param string $end_time
	 */
	public function get_result_by_al($project_id, $page_size, $page_index, $algorithm_name=[], $start_time='', $end_time=''){
		$res=$this->http_get(self::$indass_url.'/v1/apii/ResultByAl?project_id='.$project_id.'&page_size='.$page_size.'&page_index='.$page_index.'&algorithm_name='.$algorithm_name.'&start_time='.$start_time.'&end_time='.$end_time, self::$token);
		return $res;
	}
	/**
	 * Get all al projects.
	 * @param string $page_size
     * @param string $page_index
	 * @param string $start_time
	 * @param string $end_time
	 */
	public function get_all_projects($page_size, $page_index, $start_time='', $end_time=''){
		$res=$this->http_get(self::$indass_url.'/v1/apii/AllProjects?page_size='.$page_size.'&page_index='.$page_index.'&start_time='.$start_time.'&end_time='.$end_time, self::$token);
		return $res;
	}
}