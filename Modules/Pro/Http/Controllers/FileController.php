<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: task.php
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
use Modules\Api\Libs\Classes\Apix;

class FileController extends Controller{
	public function __construct() {
		$this->apiq=new Apiq;
		$this->apix=new Apix;
		$this->type='file';
	}
	//上传文件
	public function public_upload(){
		$info=$_REQUEST;
		echo $this->apiq->upload_file($_FILES['upload_file'], $info['type']);
	}
	//下载文件
	public function public_download(){
		$info=$_REQUEST;
		echo $this->apiq->download_file($info['path']);
	}
	//apix下载文件
	public function public_apix_download(){
		$info=$_REQUEST;
		echo $this->apix->download_file($info['fileName'], $info['path']);
	}
}