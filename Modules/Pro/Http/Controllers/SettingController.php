<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: setting.php
* Author: qinguoqing
* Description: user application
* Version:V1.0.0
*
*-------------------------------------------------------------------------------
* Date Author(s) Status & Comments
*-------------------------------------------------------------------------------
* 2018/10/18 qinguoqing Creating
*--------------------------------------------------------------------------------
*/
namespace Modules\Pro\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use QRcode;
use Modules\Pro\Models\AdminSettingModel;
class SettingController extends Controller
{
	public function __construct() {
		$this->logo_path=$path=PC_PATH.'modules'.DIRECTORY_SEPARATOR.'pro'.DIRECTORY_SEPARATOR.'static'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'login'.DIRECTORY_SEPARATOR;
		$this->logo_url=$path=APP_URL.'modules'.DIRECTORY_SEPARATOR.'pro'.DIRECTORY_SEPARATOR.'static'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'login'.DIRECTORY_SEPARATOR;
		$this->icon_logo_path=$path=PC_PATH;
        $this->icon_logo_url=$path=APP_URL;
        $this->config=config('system');
        $this->admin_setting_model=new AdminSettingModel;
	}
	//配置文件写入缓存
	public function public_set_config(){
		$data=json_decode(stripslashes($_POST['data']),true);
        $config_data = $this->admin_setting_model->where([['module', 'Pro'], ['is_deleted', '0'], ['variable', 'caches_data']])->first()->toArray();
        $pro_config=string2array(stripslashes($config_data['setting']));
        $cache_setting=isset($pro_config['setting'])?$pro_config['setting']:'';
		if(is_array($cache_setting)&&$cache_setting){
			foreach($data as $key=>$val){
				foreach($val as $k=>$v){
					$cache_setting[$key][$k]=$data[$key][$k];
				}
            }
            $pro_config['setting']=$cache_setting;//print_r($pro_config);exit;
            $this->admin_setting_model->where('uid', $config_data['uid'])->update(array(
                'setting'=>array2string($pro_config)
            ));
		}else{
            $pro_config['setting']=$cache_setting;
            $this->admin_setting_model->insert(array(
                'uid'=>$this->randomString(16),
                'module'=>'Pro',
                'name'=>'FIDIS-Pro模块配置信息',
                'variable'=>'caches_data',
                'setting'=>array2string($pro_config)
            ));
        }
		echo json_encode(array(
			'code'=>200,
			'msg'=>'配置设置成功。',
		));
	}
	//读取缓存
	public function public_get_config(){
        $pro_config = $this->admin_setting_model->where([['module', 'Pro'], ['is_deleted', '0'], ['variable', 'caches_data']])->first()->toArray();
        $pro_config['setting']=string2array(stripslashes($pro_config['setting']));
        $setting=$pro_config['setting']['setting'];
        $industry=$pro_config['setting']['industry'];
        $industry_option=array();
        foreach($industry as $key=>$val){
            $industry_option[]=array(
                'value'=>$key,
                'label'=>$val['industry_name']
            );
        }
        $setting['system']['industry_option']=$industry_option;
        $setting['system']['status_option']=array(
            array(
                'value'=>'1',
                'label'=>'是'
            ),
            array(
                'value'=>'0',
                'label'=>'否'
            )
        );
        $setting['system']['config']=$industry;
        $setting['system']['config'][$setting['system']['industry']]['header']=$setting['system']['header'];
        //设备列表配置项目
        // $setting['system']['equipment']=array(
        //     [
        //         'id'=>'equipment_image',
        //         'listorder'=>10,
        //         'name'=>'设备图片',
        //         'show'=>1,
        //         'search'=>0,
        //         'width'=>'100'
        //     ],

        //     [
        //         'id'=>'equipment_name',
        //         'listorder'=>20,
        //         'name'=>'设备名称',
        //         'show'=>1,
        //         'search'=>0,
        //         'width'=>'100'
        //     ],
        //     [
        //         'id'=>'model',
        //         'listorder'=>30,
        //         'name'=>'设备型号',
        //         'show'=>1,
        //         'search'=>0,
        //         'width'=>'100'
        //     ],
        //     [
        //         'id'=>'status_name',
        //         'listorder'=>40,
        //         'name'=>'设备状态',
        //         'show'=>1,
        //         'search'=>0,
        //         'width'=>'100'
        //     ],
        //     [
        //         'id'=>'customer_name',
        //         'listorder'=>50,
        //         'name'=>'客户名称',
        //         'show'=>1,
        //         'search'=>0,
        //         'width'=>'100'
        //     ],
        //     [
        //         'id'=>'created',
        //         'listorder'=>60,
        //         'name'=>'设备创建时间',
        //         'show'=>1,
        //         'search'=>0,
        //         'width'=>'100'
        //     ],
        //     [
        //         'id'=>'equipment_id',
        //         'listorder'=>70,
        //         'name'=>'设备编号',
        //         'show'=>0,
        //         'search'=>0,
        //         'width'=>'100'
        //     ],
        //     [
        //         'id'=>'customer_id',
        //         'listorder'=>80,
        //         'name'=>'客户编号',
        //         'show'=>0,
        //         'search'=>0,
        //         'width'=>'100'
        //     ],
        //     [
        //         'id'=>'aprus_list',
        //         'listorder'=>90,
        //         'name'=>'适配器列表',
        //         'show'=>0,
        //         'search'=>0,
        //         'width'=>'100'
        //     ],
        //     [
        //         'id'=>'description',
        //         'listorder'=>100,
        //         'name'=>'描述',
        //         'show'=>0,
        //         'search'=>0,
        //         'width'=>'100'
        //     ],
        //     [
        //         'id'=>'gis',
        //         'listorder'=>110,
        //         'name'=>'设备地理信息',
        //         'show'=>0,
        //         'search'=>0,
        //         'width'=>'100'
        //     ]
        // );
		echo json_encode(array(
			'code'=>200,
			'msg'=>'成功。',
			'result'=>$setting
        ));

	}
	//上传logo和选项卡小logo
	public function public_upload_logo(){
		$file_path='';
		$file_url='';
		if(isset($_GET['type'])&&$_GET['type']=='ico'){
			$filename='favicon.ico';
			$file_path=$this->icon_logo_path.$filename;
			$file_url=$this->icon_logo_url.$filename;
		}else{
			$filename='logo.png';
			$file_path=$this->logo_path.$filename;
			$file_url=$this->logo_url.$filename;
		}
		$tmp_name=$_FILES['file']['tmp_name'];
		move_uploaded_file($tmp_name, $file_path);
		$data=array(
			'code'=>200,
			'msg'=>'上传成功。',
			'result'=>array(
				'path'=>$file_url
			)
		);
		echo json_encode($data);
	}
	//生成二维码
	public function create_qrcode(){
		$filename=MODULE_PATH.'pro'.DIRECTORY_SEPARATOR.'qrcode.png';
		$qrcode=new QRcode();
		$qrcode->png(APP_URL.'pro/setting/scan_qrcode', $filename, 0, 8, 1);
		if(file_exists($filename)){
			echo json_encode(array('code'=>200, 'msg'=>'success.', 'result'=>array('filename'=>$filename=MODULE_URL.'pro'.DIRECTORY_SEPARATOR.'qrcode.png')));
		}else{
			echo json_encode(array('code'=>400, 'msg'=>'生成二维码失败', 'result'=>array()));
		}
	}
	//扫描二维码
	public function scan_qrcode(){
		if(isset($_REQUEST['get_app_url'])){
			echo json_encode(array('code'=>200, 'msg'=>'success.', 'result'=>array('url'=>APP_URL)));
		}else{
			$pro_config = $this->admin_setting_model->where([['module', 'Pro'], ['is_deleted', '0'], ['variable', 'caches_data']])->first()->toArray();
            $pro_config['setting']=string2array(stripslashes($pro_config['setting']));
            $setting=$pro_config['setting']['setting'];
			$location=$setting['common']['app_url']?$setting['common']['app_url']:APP_URL;
			redirect($location)->send();
		}
    }

    //配置文件迁移
    public function upgrade_config(){
        $data=config('pro.setting');
        $config_data = $this->admin_setting_model->where([['module', 'Pro'], ['is_deleted', '0'], ['variable', 'caches_data']])->first()->toArray();
        $pro_config=string2array(stripslashes($config_data['setting']));
        $cache_setting=isset($pro_config['setting'])?$pro_config['setting']:'';
		if(is_array($cache_setting)&&$cache_setting){
			foreach($data as $key=>$val){
				foreach($val as $k=>$v){
					$cache_setting[$key][$k]=$data[$key][$k];
				}
            }
            $is_equipment_sn=false;
            foreach($cache_setting['system']['equipment'] as $key=>$val){
                if($val['id']=='equipment_sn'){
                    $is_equipment_sn=true;
                }
            }
            if(!$is_equipment_sn){
                $cache_setting['system']['equipment'][]=array (
                    'id' => 'equipment_sn',
                    'listorder' => '120',
                    'name' => '序列号',
                    'show' => '0',
                    'search' => '0',
                    'width' => '100',
                );
            }
            $pro_config['setting']=$cache_setting;
            $this->admin_setting_model->where('uid', $config_data['uid'])->update(array(
                'setting'=>array2string($pro_config)
            ));
		}else{
            $pro_config['setting']=$cache_setting;
            $is_equipment_sn=false;
            foreach($cache_setting['system']['equipment'] as $key=>$val){
                if($val['id']=='equipment_sn'){
                    $is_equipment_sn=true;
                }
            }
            if(!$is_equipment_sn){
                $cache_setting['system']['equipment'][]=array (
                    'id' => 'equipment_sn',
                    'listorder' => '120',
                    'name' => '序列号',
                    'show' => '0',
                    'search' => '0',
                    'width' => '100',
                );
            }
            $this->admin_setting_model->insert(array(
                'uid'=>$this->randomString(16),
                'module'=>'Pro',
                'name'=>'FIDIS-Pro模块配置信息',
                'variable'=>'caches_data',
                'setting'=>array2string($pro_config)
            ));
        }
		echo json_encode(array(
			'code'=>200,
			'msg'=>'Upgrade success.',
		));
    }
    /**
     * 返回随机字符串：不包括I和O的大写字母+数字
     * @param $lenth
     * @return String
     */
    private function randomString($lenth){
        return substr(str_shuffle(md5(uniqid(md5(microtime(true)),true))), 10, $lenth);
    }
}
