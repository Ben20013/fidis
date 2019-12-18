<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: index.php
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
namespace Modules\Portal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Api\Libs\Classes\ApiBase;
use Modules\Api\Libs\Classes\Apiq;
use Modules\Api\Libs\Classes\Apip;
use Modules\Api\Libs\Classes\ApiPassport;

class SettingController extends Controller{
  public function __construct() {
		$this->api_passport=new ApiPassport;
		$this->logo_path=PC_PATH.'modules'.DIRECTORY_SEPARATOR.'portal'.DIRECTORY_SEPARATOR.'static'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
		$this->logo_url=APP_URL.'modules'.DIRECTORY_SEPARATOR.'portal'.DIRECTORY_SEPARATOR.'static'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
	}
	//配置文件写入缓存
	public function public_set_config(){
		$data=json_decode(stripslashes($_REQUEST['data']), true)?json_decode(stripslashes($_REQUEST['data']), true):json_decode($_REQUEST['data'], true);
		$cache_setting=config('portal.setting');
        $portal_config=config('portal');
		if(is_array($cache_setting)&&$cache_setting){
			foreach($data as $key=>$val){
				foreach($val as $k=>$v){
					$cache_setting[$key][$k]=stripcslashes($data[$key][$k]);
				}
			}
		}else{
			$cache_setting=$data;
        }
        $portal_config['setting']=$cache_setting;
		$file_size = file_put_contents(FIDIS_ROOT_PATH.'Modules'.DIRECTORY_SEPARATOR.'Portal'.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'config.php', "<?php\nreturn ".var_export($portal_config, true).";\n");
		echo json_encode(array(
			'code'=>200,
			'msg'=>'配置设置成功。',
		));
	}
	//读取缓存
	public function public_get_config(){
		echo json_encode(array(
			'code'=>200,
			'msg'=>'成功。',
            'result'=>config('portal.setting')
		));
	}
	//上传logo
	public function public_upload_logo(){
		$tmp_name=$_FILES['file']['tmp_name'];
		$filename='logo.png';
		move_uploaded_file($tmp_name, $this->logo_path.$filename);
		$data=array(
			'code'=>200,
			'msg'=>'logo上传成功。',
			'result'=>array(
				'path'=>$this->logo_url.$filename
			)
		);
		echo json_encode($data);
    }
    //上传图片：广告图片、背景图片等
    public function upload_images(){
        $tmp_name=$_FILES['file']['tmp_name'];
		$filename=(isset($_REQUEST['type'])&&$_REQUEST['type']=='ad')?'ad.png':'bg.png';
		move_uploaded_file($tmp_name, $this->logo_path.$filename);
		$data=array(
			'code'=>200,
			'msg'=>'logo上传成功。',
			'result'=>array(
				'path'=>$this->logo_url.$filename
			)
		);
		echo json_encode($data);
    }
	//校验ticket
	public function check_ticket(){
		$ticket=$this->api_passport->get_token(getallheaders());
		return $this->api_passport->check_ticket('MixPortal', $ticket);
	}
}
