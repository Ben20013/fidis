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
namespace Modules\Pro\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Api\Libs\Classes\ApiBase;
use Modules\Api\Libs\Classes\Apiq;
use Modules\Api\Libs\Classes\Apip;
use Modules\Api\Libs\Classes\ApiPassport;
use Illuminate\Support\Facades\Cache;
use Modules\Pro\Models\AdminSettingModel;
use Modules\Admin\Models\MenuModel;
class IndexController extends Controller
{
    public function __construct() {
		//parent::__construct();
		$this->api_base=new ApiBase;
		$this->apiq=new Apiq;
		$this->apip=new Apip;
		$this->api_passport=new ApiPassport;
		$this->config=config('system');
        $this->url_no_http=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
        $this->admin_setting_model=new AdminSettingModel;
        $this->menu_model=new MenuModel;
	}
	//加载主页
	public function index(){
		//验证ticket
		$info=$_REQUEST;
		if(isset($info['source'])&&isset($info['ticket'])){
			$res=json_decode($this->api_base->check_admin_ticket($info['source'], $info['ticket']), true);
			$res['result']['source']=$info['source'];
			$res['result']['ticket']=$info['ticket'];
			session(['user'=>$res['result']]);
            return redirect('/pro');
        }else if(isset($info['locale'])&&isset($info['_ticket'])&&isset($info['_imc_auth'])){//华为IMC登录对接
            return redirect($this->config['protocol'].$this->config['portal_url'].'/?source='.$this->config['syssource'].'&url='.(isset($info['url'])?$info['url']:'').'&locale='.$info['locale'].'&_ticket='.$info['_ticket'].'&_imc_auth='.$info['_imc_auth']);
		}else{
			$user=isset(session('user')['token'])?session('user'):array();
			$config=$this->public_get_config();
			$css_hash=$app_js_hash=$manifest_js_hash='';
			$css_handler=opendir(MODULE_PATH.'pro'.DIRECTORY_SEPARATOR.'css');
			while(false!==($file=readdir($css_handler))){
				if($file!='.' && $file!='..' && substr($file, 0, 1)!='.'){
					$name_arr=explode('.', $file);
					$css_hash=$name_arr[1];
				}
			}
			$js_handler=opendir(MODULE_PATH.'pro'.DIRECTORY_SEPARATOR.'js');
			while(false!==($file=readdir($js_handler))){
				if($file!='.' && $file!='..' && substr($file, 0, 1)!='.'){
					$name_arr=explode('.', $file);
					if($name_arr[0]=='app'){
						$app_js_hash=$name_arr[1];
					}
					if($name_arr[0]=='manifest'){
						$manifest_js_hash=$name_arr[1];
					}
				}
			}
			return view('pro::index', array('user'=>$user, 'css_hash'=>$css_hash, 'app_js_hash'=>$app_js_hash, 'manifest_js_hash'=>$manifest_js_hash, 'config'=>$config));
		}
	}
	//登录
	public function login(){
		$info=$_REQUEST;
		if(isset($info['username'])){
			$res=json_decode($this->apiq->login($info['username'], $info['password'], $info['system']), true);
			if($res['code']==200){
				session(['user'=>$res['result']]);
			}
			echo json_encode($res);
		}else{
			include $this->admin_tpl();
		}
	}
	//获取配置信息
	private function public_get_config(){
		$version_file=MODULE_PATH.'pro'.DIRECTORY_SEPARATOR.'Version';
		$version='';
		if(file_exists($version_file)){
			$version_info=parse_ini_file($version_file, true);
			$version=isset($version_info['general']['version'])?$version_info['general']['version']:$version;
        }
        $config_data = $this->admin_setting_model->where([['module', 'Pro'], ['is_deleted', '0'], ['variable', 'caches_data']])->first()->toArray();
        $pro_config=string2array(stripslashes($config_data['setting']));
        $industry=$pro_config['industry'];
        $setting=$pro_config['setting'];
		return array(
			'protocol'=>$this->config['protocol'],
			'apiqHost'=>$this->url_no_http,
			'pro_version'=>$version,
			'mixPortal_url'=>$this->config['portal_url'],
			'host_online'=>$this->config['admin_url'],
			'socketAddress'=>$this->config['socketAddress'],
			'system'=>$this->config['syssource'],
            //'industry'=>json_encode($industry[$this->config['industry']])
            'industry'=>isset($setting['system'])?json_encode($setting['system']):json_encode($industry[$this->config['industry']]),
            'report_url'=>$this->config['report_url'],
		);
	}
	//关于我们
	public function public_get_about_us(){
		echo $this->apiq->get_about_us_data();
	}
	//反馈
	public function public_feedback(){
		$info=$_REQUEST;
		echo $this->apiq->feedback($info);
	}
	//获取设备状态统计数据
	public function public_get_statistics(){
		echo $this->apiq->get_statistics();
	}
	//获取设备状态统计数据-plus
	public function public_get_statistics_plus(){
		echo $this->apiq->get_statistics_plus();
	}
	//获取15天事件、故障、报警统计
	public function public_get_efa_statistics(){
		echo $this->apiq->get_efa_statistics();
	}
	//获取设备地图分布
	public function public_get_equip_map_distribution(){
		$info=$_REQUEST;
		$info['group_id']=isset($info['group_id'])?$info['group_id']:'';
		echo $this->apiq->get_equipment_map_distribution($info);
	}
	//获取设备地区分布
	public function public_get_equip_area_distribution(){
		echo $this->apiq->get_equipment_area_distribution();
	}
	//获取近7天服务统计
	public function public_get_service_statistics(){
		$info=$_REQUEST;
		echo $this->apiq->get_service_statistics($info['intervalDay']);
	}
	//获取所有事件告警故障数据
	public function public_get_all_warn(){
		$info=$_POST;
		echo $this->apiq->get_all_warn($info);
	}
	//推送反向控制
	public function public_push(){
        $info=$_POST;
        $command=json_decode($info['command'], true);
        $equipment_id=$command['equipment_id'];
        $param=$command['id'];
        $equipment_info=json_decode($this->apiq->get_info('equipment', array('equipment_id'=>$equipment_id)), true);
        $aprus_list=json_decode($equipment_info['result']['aprus_list'], true);
        $mapping_info=json_decode($this->apiq->get_info('mapping', array('mapping_id'=>$equipment_info['result']['mapping_id'])), true);
        $aprus_id='';
        foreach(json_decode($mapping_info['result']['script'], true) as $key=>$val){
            if($val[0]==$param){
                $temp=explode('-', $val[3]);
                $aprus_id=$aprus_list[$temp[1]-1];
                break;
            }
        }
        $info['command']=json_encode(array(
            'equipment_id'=>$equipment_id,
            'aprus_id'=>$aprus_id,
            'param'=>$command['param'],
            'platform'=>$command['platform']
        ));
		echo $this->apip->push($info);
    }
    //动态获取路由
    public function getRoute(){
        $menu_info=$this->menu_model->where([['module_name', '!=', 'Admin'], ['display_system', 'like', '%Fidis_pro%']])->get(['*'])->toArray();
        $route=array();
        foreach($menu_info as $key=>$val){
            if($val['parentid']!='0'){
                $route[]=array(
                    'path'=>$val['route'],
                    'name'=>$val['module_name'],
                    'redirect'=>$val['route'],
                    'meta'=>array(
                        'auth'=>true,
                        'title'=>$val['module_name'],
                        'isParent'=>true
                    ),
                    'children'=>[[
                        'path'=>$val['route'],
                        'subPath'=>$val['params'],
                        'name'=>$val['module_name'],
                        'meta'=>array(
                            'auth'=>true,
                            'title'=>$val['module_name'],
                            'isParent'=>true
                        )
                    ]]
                );
            }
        }
        echo json_encode(array('code'=>200, 'msg'=>'', 'result'=>$route));
    }
    //获取路由数据
    public function getMenuRoute(){
        $menu_info=$this->menu_model->where([['module_name', '!=', 'Admin'], ['display_system', 'like', '%Fidis_pro%']])->get(['*'])->toArray();
        $route=array();
        foreach($menu_info as $key=>$val){
            if($val['parentid']!='0'){
                $route[]=array(
                    'to'=>$val['route'],
                    'reg'=>$val['route'],
                    'name'=>$val['name'],
                    'icon'=>$val['icon']
                );
            }
        }
        echo json_encode(array('code'=>200, 'msg'=>'', 'result'=>$route));
    }
}
