<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: api_messenger.class.php
* Author: MIXIOT Team
* Description: MixMessenger apis
* Version:V1.0.0
*
*-------------------------------------------------------------------------------
* Date Author(s) Status & Comments
*-------------------------------------------------------------------------------
* 2018/08/28 qinguoqing Creating
*--------------------------------------------------------------------------------
*/
namespace Modules\Api\Libs\Classes;
class ApiMessenger extends ApiBase{
	public static $messenger_url;
	public static $sysname='rnd';//MIXIOT Name
	public function __construct(){
		parent::__construct();
		self::$messenger_url=$this->sysconfig['protocol'].$this->sysconfig['messenger_url'];
	}
	
}