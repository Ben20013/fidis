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
class Apip extends ApiBase{
	public function __construct(){
		parent::__construct();
	}
	/**
	 * Push  command info.
	 * @param string $equipment_id
	 * @param string $aprus_id
	 * @param array $param eg: ["Start", "1"]
	 * @param string $platform EFA
	 */
	public function push($data){
		//$data=$this->data_format($data);
		$res=$this->http_post(self::$url.'/api/apip/apip_push', $data, self::$token);
		return $res;
	}
	/**
	 * Push equipment command info.
	 * @param string $equipment_id
	 * @param string $aprus_id
	 * @param array $param eg: ["Start", "1"]
	 * @param string $platform EFA
	 */
	public function push_equipment_command($equipment_id, $aprus_id, $param, $platform){
		$data=array(
			'i_type'=>'equipment',
			'command'=>array(
				'equipment_id'=>$equipment_id,
				'param'=>$param,
				'aprus_id'=>$aprus_id,
				'platform'=>$platform
			),
		);
		$res=$this->http_post(self::$url.'/api/apip/apip_push', $data, self::$token);
		return $res;
	}
	/**
	 * Push aprus command info.
	 * @param string $aprus_id
	 * @param string $param eg: ["Reboot"]、["Upgrade", "LUA"]、["Upgrade", "REMOSU"]、["Upgrade", "MCU"]
	 */
	public function push_aprus_command($aprus_id, $param){
		$data=array(
			'i_type'=>'adapter',
			'command'=>array(
				'aprus_id'=>$aprus_id,
				'param'=>$param
			),
		);
		$res=$this->http_post(self::$url.'/api/apip/apip_push', $data, self::$token);
		return $res;
	}
}