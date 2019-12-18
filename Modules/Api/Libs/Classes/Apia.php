<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: apia.class.php
* Author: MIXIOT Team
* Description: api of Mixagent
* Version:V1.0.0
*
*-------------------------------------------------------------------------------
* Date Author(s) Status & Comments
*-------------------------------------------------------------------------------
* 2018/08/28 qinguoqing Creating
*--------------------------------------------------------------------------------
*/
defined('IN_ADMIN') or exit('No permission resources.');
pc_base::load_app_class('api_base', 'api', 0);
class apia extends api_base{
	public function __construct(){
		parent::__construct();
	}
} 