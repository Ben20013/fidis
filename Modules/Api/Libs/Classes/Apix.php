<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: apix.class.php
* Author: MIXIOT Team
* Description: get history data
* Version:V1.0.0
*
*-------------------------------------------------------------------------------
* Date Author(s) Status & Comments
*-------------------------------------------------------------------------------
* 2018/08/28 qinguoqing Creating
*--------------------------------------------------------------------------------
*/
namespace Modules\Api\Libs\Classes;
class Apix extends ApiBase{
	public static $apix_url;
	public function __construct(){
		parent::__construct();
		self::$apix_url=$this->sysconfig['protocol'].$this->sysconfig['apix_url'];
	}
	/**
	 * Get mosaic data by keys.
	 * @param string $equipment_id
	 * @param string $start_time
	 * @param string $end_time
	 * @param int $page_size
	 * @param int $page_index
	 * @param string $keys eg: ["S01","S04","S06","S10"]
	 */
	public function get_mosaic_by_key($equipment_id, $keys, $start_time='', $end_time='', $page_size=30, $page_index=1){
		$data=array(
			'equipment_id'=>$equipment_id,
			'start_time'=>$start_time,
			'end_time'=>$end_time,
			'page_size'=>$page_size,
			'page_index'=>$page_index,
			'keys'=>stripslashes($keys)
		);
		$res=$this->http_post(self::$apix_url.'/v1/apix/mosaicByKey', $data, self::$token);
		return $res;
	}
	/**
	 * Export mosaic data to Excel file.
	 * @param string $equipment_id
	 * @param string $start_time
	 * @param string $end_time
	 * @param int $page_size
	 * @param int $page
	 * @param string $keys eg: ["SteamCumulativeFlow","SteamInstantaneousFlow","FeedWaterTotalFlow","FeedwaterInstantaneousFlow","WaterPressure","BoilerWaterTemperature","MeterReadings","FurnaceNegativePressure","TotalCumulativeFuelReading","CurrentBlowerInstantaneous","CurrentBlowerAverage","BlowerFrequency","CurrentInducedDraftFanInstantaneous","CurrentFanAverage","FanFrequency"]
	 * @param string $title eg: ["蒸汽累计流量","蒸汽瞬时流量","给水累计流量","给水瞬时流量","给水压力","锅炉给水温度","电能表读数","炉膛负压","燃料累计读数","鼓风机瞬时电流","鼓风机平均电流","鼓风机频率","引风机瞬时电流"]
	 */
	public function export_mosaic_data($equipment_id, $keys, $title, $start_time='', $end_time='', $page_size=30, $page_index=1){
		$data=array(
			'equipment_id'=>$equipment_id,
			'keys'=>stripslashes($keys),
			'title'=>stripslashes($title),
			'start_time'=>$start_time,
			'end_time'=>$end_time,
			'page_size'=>$page_size,
			'page_index'=>$page_index
		);
		$res=$this->http_post(self::$apix_url.'/v1/apix/mosaicImport', $data, self::$token);
		return $res;
	}
	/**
	 * Download files.
	 * @param string $fliename
	 * @param string $path
	 */
	public function download_file($filename, $path){
		redirect(self::$apix_url.'/v1/apix/downloadFile?fileName='.$filename.'&path='.$path)->send();
	}
	/**
	 * Get line data.
	 * @param string $equipment_id
	 * @param string $start_time
	 * @param string $end_time
	 * @param string $keys eg: ["SteamCumulativeFlow","SteamInstantaneousFlow","FeedWaterTotalFlow","FeedwaterInstantaneousFlow","WaterPressure","BoilerWaterTemperature","MeterReadings","FurnaceNegativePressure","TotalCumulativeFuelReading","CurrentBlowerInstantaneous","CurrentBlowerAverage","BlowerFrequency","CurrentInducedDraftFanInstantaneous","CurrentFanAverage","FanFrequency"]
	 */
	public function get_line_data($equipment_id, $keys, $start_time='', $end_time=''){
		$data=array(
			'equipment_id'=>$equipment_id,
			'keys'=>stripslashes($keys),
			'start_time'=>$start_time,
			'end_time'=>$end_time
		);
		$res=$this->http_post(self::$apix_url.'/v1/apix/dataLine', $data, self::$token);
		return $res;
	}
	/**
	 * Get last grid data by aprusid.
	 * @param string $aprus_id
	 */
	public function get_last_grid($aprus_id){
		$res=$this->http_get(self::$apix_url.'/v1/apix/lastGrid?aprus_id='.$aprus_id, self::$token);
		return $res;
	}
	/**
	 * Get grid data by aprusid and schedule time.
	 * @param string $aprus_id
	 * @param string $time
	 */
	public function get_schedule_time_grid($aprus_id, $time){
		$data=array(
			'aprus_id'=>$aprus_id,
			'time'=>$time
		);
		$res=$this->http_post(self::$apix_url.'/v1/apix/gridBytime', $data, self::$token);
		return $res;
	}
	/**
	 * Get designated grid data by aprusid and number.
	 * @param string $aprus_id
	 * @param string $items
	 * @param string $topic eg: n/r/i/../all
	 */
	public function get_designated_grid($aprus_id, $items, $topic){
		$res=$this->http_get(self::$apix_url.'/v1/apix/latestGridsByItems?aprus_id='.$aprus_id.'&items='.$items.'&topic='.$topic, self::$token);
		return $res;
	}
	/**
	 * Get grid data by aprusid and duration time.
	 * @param string $aprus_id
	 * @param string $start_time
	 * @param string $end_time
	 * @param int $page_size
	 * @param int $page_index
	 * @param string $topic eg: n/r/i/../all
	 */
	public function get_duration_time_grid($aprus_id, $start_time='', $end_time='', $page_size, $page_index, $topic){
		$data=array(
			'aprus_id'=>$aprus_id,
			'start_time'=>$start_time,
			'end_time'=>$end_time,
			'page_size'=>$page_size,
			'page_index'=>$page_index,
			'topic'=>$topic
		);
		$res=$this->http_post(self::$apix_url.'/v1/apix/latestGridsByDuration', $data, self::$token);
		return $res;
	}
	/**
	 * Get last mosaic data by equipment_id.
	 * @param string $equipment_id
	 */
	public function get_last_mosaic($equipment_id){
		$res=$this->http_get(self::$apix_url.'/v1/apix/lastMosaic?equipment_id='.$equipment_id, self::$token);
		return $res;
	}
	/**
	 * Get mosaic data by aprusid and schedule time.
	 * @param string $equipment_id
	 * @param string $time
	 */
	public function get_schedule_time_mosaic($equipment_id, $time){
		$res=$this->http_get(self::$apix_url.'/v1/apix/mosaicByTime?equipment_id='.$equipment_id.'&time='.$time, self::$token);
		return $res;
	}
	/**
	 * Get specified number of lastest mosaic data by equipment_id.
	 * @param string $equipment_id
	 * @param string $items specified number
	 */
	public function get_multiple_lastest_mosaic($equipment_id, $items){
		$data=array(
			'equipment_id'=>$equipment_id,
			'items'=>$items
		);
		$res=$this->http_post(self::$apix_url.'/v1/apix/latestMosaicByItems', $data, self::$token);
		return $res;
	}
	/**
	 * Get multlist.
	 * 获取适配器多媒体数据
	 * @param string $client_id 适配器id
	 * @param string $payload_type 适配器报文类型
	 * @param string $start_time 开始时间
	 * @param string $end_time 结束时间
	 * @param string $page_size 显示条数
	 * @param string $page_index 当前页
	 */
	public function get_mult_list($client_id, $payload_type, $start_time='', $end_time='', $page_size, $page_index){
		$data=array(
			'client_id'=>$client_id,
			'payload_type'=>$payload_type,
			'start_time'=>$start_time,
			'end_time'=>$end_time,
			'page_size'=>$page_size,
			'page_index'=>$page_index
		);
		$res=$this->http_post(self::$apix_url.'/v1/apix/getmultlist', $data, self::$token);
		return $res;
	}
}