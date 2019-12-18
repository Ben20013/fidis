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
class Apis extends ApiBase{
	public function __construct(){
		parent::__construct();
	}
	/**
	 * Get collect data.
	 * @param string $collect_id
	 * @param string $equipment_id
	 * @param string $start_time
	 * @param string $end_time
	 */
	public function get_collect($collect_id, $equipment_id, $start_time='', $end_time=''){
		$data=array(
			'collect_id'=>$collect_id,
			'equipment_id'=>$equipment_id,
			'start_time'=>$start_time?$start_time:date('Y-m-d H:i:s', 1),
			'end_time'=>$end_time?$end_time:date('Y-m-d H:i:s')
		);
		$res=$this->http_post(self::$url.'/api/apis/getCollect', $data, self::$token);
		return $res;
	}
	/**
	 * Get statistic data.
	 * @param string $statos_id
	 * @param string $equipment_id
	 * @param string $start_time
	 * @param string $end_time
	 */
	public function get_statistic($statistics_id, $equipment_id, $start_time='', $end_time=''){
		$data=array(
			'statistics_id'=>$statistics_id,
			'equipment_id'=>$equipment_id,
			'start_time'=>$start_time?$start_time:date('Y-m-d H:i:s', 1),
			'end_time'=>$end_time?$end_time:date('Y-m-d H:i:s')
		);
		$res=$this->http_post(self::$url.'/api/apis/getStatistic', $data, self::$token);
		return $res;
	}
	/**
	 * Get statistic data by period.
	 * @param string $statistics_id
	 * @param string $equipment_id
	 * @param string $timeflag eg: week/month
	 */
	public function get_statistic_by_period($statistics_id, $equipment_id, $timeflag){
		$data=array(
			'statistics_id'=>$statistics_id,
			'equipment_id'=>$equipment_id,
			'timeFlag'=>$timeflag
		);
		$res=$this->http_post(self::$url.'/api/apis/getStatisticByPeriod', $data, self::$token);
		return $res;
	}
	/**
	 * Get statistic data by timeflag.
	 * @param string $statistics_id
	 * @param string $equipment_id
	 * @param int $timevalue 前N 小时|天|周|...
	 * @param string $timeflag eg: year/month/week/day/hour
	 */
	public function get_statistic_by_timeflag($statistics_id, $equipment_id, $timevalue, $timeflag){
		$data=array(
			'statistics_id'=>$statistics_id,
			'equipment_id'=>$equipment_id,
			'timeValue'=>$timevalue,
			'timeFlag'=>$timeflag
		);
		$res=$this->http_post(self::$url.'/api/apis/getStatisticByTimeFlag', $data, self::$token);
		return $res;
	}
	/**
	 * Get today statistic data.
	 * @param string $statistics_id
	 * @param string $equipment_id
	 */
	/*public function get_today_statistic($statistics_id, $equipment_id){
		$data=array(
			'statistics_id'=>$statistics_id,
			'equipment_id'=>$equipment_id
		);
		$res=$this->http_post(self::$url.'/api/apis/toDayStatistics', $data, self::$token);
		return $res;
	}*/
	/**
	 * Get current month statistic data.
	 * @param string $statistics_id
	 * @param string $equipment_id
	 */
	/*public function get_current_month_statistic($statistics_id, $equipment_id){
		$data=array(
			'statistics_id'=>$statistics_id,
			'equipment_id'=>$equipment_id,
			'timeFlag'=>'month'
		);
		$res=$this->http_post(self::$url.'/api/apis/getAggregate', $data, self::$token);
		return $res;
	}*/
	/**
	 * Get today data.
	 * @param string $statistics_id
	 * @param string $equipment_id
	 */
	/*public function get_taday_data($statistics_id, $equipment_id){
		$data=array(
			'statistics_id'=>$statistics_id,
			'equipment_id'=>$equipment_id
		);
		$res=$this->http_post(self::$url.'/api/apis/todayData', $data, self::$token);
		return $res;
	}*/
	/**
	 * Get current month data.
	 * @param string $statistics_id
	 * @param string $equipment_id
	 */
	/*public function get_current_month_data($statistics_id, $equipment_id){
		$data=array(
			'statistics_id'=>$statistics_id,
			'equipment_id'=>$equipment_id
		);
		$res=$this->http_post(self::$url.'/api/apis/currentMonthData', $data, self::$token);
		return $res;
	}*/
	/**
	 * Get current year data.
	 * @param string $statistics_id
	 * @param string $equipment_id
	 */
	/*public function get_current_year_data($statistics_id, $equipment_id){
		$data=array(
			'statistics_id'=>$statistics_id,
			'equipment_id'=>$equipment_id
		);
		$res=$this->http_post(self::$url.'/api/apis/currentYearData', $data, self::$token);
		return $res;
	}*/
	/**
	 * Get history data.
	 * @param string $statistics_id
	 * @param string $equipment_id
	 */
	/*public function get_history_data($statistics_id, $equipment_id){
		$data=array(
			'statistics_id'=>$statistics_id,
			'equipment_id'=>$equipment_id
		);
		$res=$this->http_post(self::$url.'/api/apis/history', $data, self::$token);
		return $res;
	}*/
	/**
	 * Get current statistic data by timeflag.
	 * @param string $statistics_id
	 * @param string $equipment_id
	 * @param string $timeflag eg: year/month/week/day/hour
	 */
	public function get_current_aggregate_by_timeflag($statistics_id, $equipment_id, $timeflag){
		$data=array(
			'statistics_id'=>$statistics_id,
			'equipment_id'=>$equipment_id,
			'timeFlag'=>$timeflag
		);
		$res=$this->http_post(self::$url.'/api/apis/getAggregate', $data, self::$token);
		return $res;
	}
    /**
     * Get  statistics data for SHOW.（HeTai）
     */
    public function get_statistics($data){
        $data=$this->data_format($data);
        $res=$this->http_post(self::$url.'/api/apis/getAggregate', $data, self::$token);
        return $res;
    }
}