<?php
/******************************************************************************
 * Copyright (c) 2019-2021 Mixlinker Networks Inc. <mixiot@mixlinker.com>
 * All rights reserved.
 *
 * This program and the accompanying materials are made available under the
 * terms of the Application License of Mixlinker Networks License and Mixlinker
 * Distribution License which accompany this distribution.
 *
 * The Mixlinker License is available at
 *    http://www.mixlinker.com/legal/license.html
 * and the Mixlinker Distribution License is available at
 *    http://www.mixlinker.com/legal/distribution.html
 *
 * Contributors:
 *    Mixlinker Technical Team
 *****************************************************************************/
/*
 * Date : 2019-02-18
 * Author : LuoJiandong
 * Description : Customer Controller.
 */
namespace Modules\Pro\Http\Controllers;
use Illuminate\Http\Request;
use Modules\Pro\Models\ModuleModel;
use Modules\Pro\Models\MenuModel;
use Modules\Pro\Http\Controllers\Controller;
use Modules\Pro\Services\Common\ModuleService;
use Modules\Pro\Services\Common\MenuService;
use Exception;
use Error;

class ModuleController extends Controller{
    /**
     * @const MixCode 返回码
     */
    const REQUEST_SUCCESS = 130001;
    const REQUEST_FAILED = 230001;
    const PARAM_ERROR  = 230011;
    const SERVER_ERROR  = 230016;
    const NETWORK_ERROR  = 230012;
    const ADD_CUSTOMER_SUCCESS  = 131901;
    const ADD_CUSTOMER_FAILED  = 231901;
    const EDIT_CUSTOMER_SUCCESS  = 131902;
    const EDIT_CUSTOMER_FAILED  = 231902;
    const DELETE_CUSTOMER_SUCCESS  = 131903;
    const DELETE_CUSTOMER_FAILED  = 231903;
    const QUERY_CUSTOMER_SUCCESS  = 131904;
    const QUERY_CUSTOMER_FAILED  = 231904;

    /**
     * @var \App\Services\Common\ModuleService
     */
    protected $module_service;
    protected $page_index = 1;
    protected $page_size = 20;
    protected $is_all = 0;
    protected $is_available = 1;
    protected $field = ['*'];

    /**
     * constructor.
     *
     * @param \App\Services\Common\ModuleService $AdminCustomerService
     */
    public function __construct(ModuleService $ModuleService){
        $this->module_service = $ModuleService;
        $this->menu_service = new MenuService;
        $this->module_model=new ModuleModel;
        $this->menu_model=new MenuModel;
        $this->module_path=MODULE_PATH.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Modules';
    }

    /**
     * 显示列表.
     *
     * @param Request $request
     * @return String
     */
    public function index(Request $request){
        if($request->has('page_index')){
            $params=$request->all();
            try {
                $name='';
                if($request->has('name')){
                    $name=$params['name'];
                }
                $modules_handler=opendir($this->module_path);
                $data=array();
                while(false!==($file=readdir($modules_handler))){
                    if($file!='.' && $file!='..' && substr($file, 0, 1)!='.' && ($name!=''?strstr(strtolower($file), strtolower($name)):1)){
                        $config=array();
                        if($file=='App'){
                            $config=include($this->module_path.DIRECTORY_SEPARATOR.$file.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'config.php');
                        }else{
                            $config=config(strtolower($file));
                        }
                        //$query = ModuleModel::where(1);
                        $module_query = ModuleModel::where('name', '=', $file);
                        $info = $module_query->get($this->field)->toArray();
                        $data[]=array(
                            'name'=>isset($config['name'])?$config['name']:'',
                            'is_system'=>isset($info[0]['is_system'])?$info[0]['is_system']:0,
                            'status'=>!empty($info)?1:0,
                            'is_enable'=>isset($info[0]['is_enable'])?$info[0]['is_enable']:1,
                            'version'=>isset($config['version'])?$config['version']:'',
                            'upgrade_time'=>isset($config['upgrade_time'])?$config['upgrade_time']:'',
                            'description'=>isset($config['description'])?$config['description']:'',
                        );
                    }
                }
                // $query = ModuleModel::find(1);
                // if($request->has('name')){
                //     $query = $query->where('name', 'like', '%'.$params['name'].'%');
                // }
                // $total_records = $query->count();
                // // 数据查询
                // $data = $query->forPage($this->page_index, $this->page_size)
                //     ->orderBy('id', 'desc')
                //     ->get($this->field)->toArray();
                // foreach($data as $key=>$val){
                //     $config=config($val['name']);
                //     if($config){
                //         foreach($config as $k=>$v){
                //             $data[$key][$k]=isset($config[$k])?$config[$k]:'';
                //         }
                //     }
                // }
                $result = [
                    'page_index'=>$this->page_index,
                    'page_size'=>$this->page_size,
                    'total_pages'=>ceil(count($data)/$this->page_size),
                    'total_records'=>count($data),
                    'data'=>$data
                ];
                $result = $this->module_service->formatMixResult(self::QUERY_CUSTOMER_SUCCESS, $result);
                return $this->module_service->formatReturnResult(200, trans('查询 模块信息 成功'), $result);
            } catch(Exception  $exception) {
                $mix_code = self::QUERY_CUSTOMER_FAILED;
                $result = $this->module_service->formatMixResult($mix_code, [], $exception);
                return $this->module_service->formatReturnResult(500, trans('查询 模块信息 失败'), $result);
            } catch(Error $error) {
                $msg = trans('服务器错误，请联系管理员!');
                $result = $this->module_service->formatMixResult(self::SERVER_ERROR, []);
                return $this->module_service->formatReturnResult(500, $msg, $result);
            }
        }else{
            return view('admin::index', array('title'=>'智物联'));
        }
    }

    /**
     * 安装扩展模块
     *
     * @param Request $request
     * @return String
     */
    public function install(Request $request){
        $param=$request->all();
        //try{
            $info=array(
                'uid'=> $this->module_service->randomString(16),
                'name'=>$param['name'],
                'is_system'=>isset($param['is_system'])?$param['is_system']:0,
                'status'=>1,
                'version'=>isset($param['version'])?$param['version']:'',
                'upgrade_time'=>isset($param['upgrade_time'])?$param['upgrade_time']:date('Y-m-d H:i:s'),
                'description'=>isset($param['description'])?$param['description']:'',
            );
            foreach ($info as $key =>$val) {
                $this->module_model->$key = $val;
            }
            $this->module_model->save();
            $this->createMenu($param['name']);
            $result = ['id'=>$this->module_model->id];
            $result = $this->module_service->formatMixResult(self::ADD_CUSTOMER_SUCCESS, $result);
            return $this->module_service->formatReturnResult(200, trans('安装 模块 成功'), $result);
        // } catch(Exception  $exception) {
        //     $mix_code = self::ADD_CUSTOMER_FAILED;
        //     $result = $this->module_service->formatMixResult($mix_code, [], $exception);
        //     return $this->module_service->formatReturnResult(500, trans('安装 模块 失败'), $result);
        // } catch(Error $error) {
        //     $msg = trans('服务器错误，请联系管理员!');
        //     $result = $this->module_service->formatMixResult(self::SERVER_ERROR, []);
        //     return $this->module_service->formatReturnResult(500, $msg, $result);
        // }
    }
    /**
     * 卸载扩展模块
     *
     * @param Request $request
     * @return String
     */
    public function uninstall(Request $request){
        $param=$request->all();
        try{
            $data = $this->module_model->where([['name', $param['name']], ['is_system', 1]])->first();
            if ($data) {
                $result = $this->module_service->formatMixResult(self::DELETE_CUSTOMER_FAILED, []);
                $msg = trans('当前模块为系统模块，不可卸载！');
                return $this->module_service->formatReturnResult(500, $msg, $result);
            }
            $module_info=$this->module_model->where('name', $param['name'])->first()->toArray();
            $this->module_model->where('name', $param['name'])->delete();//删除模块信息
            //删除菜单
            $this->menu_model->where('module_id', $module_info['uid'])->delete();
            $result = $this->module_service->formatMixResult(self::DELETE_CUSTOMER_SUCCESS, []);
            return $this->module_service->formatReturnResult(200, trans('卸载 模块 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::ADD_CUSTOMER_FAILED;
            $result = $this->module_service->formatMixResult($mix_code, [], $exception);
            return $this->module_service->formatReturnResult(500, trans('卸载 模块 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->module_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->module_service->formatReturnResult(500, $msg, $result);
        }
    }
    /**
     * 启用扩展模块
     *
     * @param Request $request
     * @return String
     */
    public function enable(Request $request){
        $param=$request->all();
        try{
            $this->module_model->where('name', $param['name'])->update(array('is_enable'=>1));
            $result = $this->module_service->formatMixResult(self::ADD_CUSTOMER_SUCCESS, []);
            return $this->module_service->formatReturnResult(200, trans('启用 模块 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::ADD_CUSTOMER_FAILED;
            $result = $this->module_service->formatMixResult($mix_code, [], $exception);
            return $this->module_service->formatReturnResult(500, trans('启用 模块 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->module_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->module_service->formatReturnResult(500, $msg, $result);
        }
    }
    /**
     * 禁用扩展模块
     *
     * @param Request $request
     * @return String
     */
    public function disable(Request $request){
        $param=$request->all();
        try{
            $this->module_model->where('name', $param['name'])->update(array('is_enable'=>0));
            $result = $this->module_service->formatMixResult(self::ADD_CUSTOMER_SUCCESS, []);
            return $this->module_service->formatReturnResult(200, trans('禁用 模块 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::ADD_CUSTOMER_FAILED;
            $result = $this->module_service->formatMixResult($mix_code, [], $exception);
            return $this->module_service->formatReturnResult(500, trans('禁用 模块 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->module_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->module_service->formatReturnResult(500, $msg, $result);
        }
    }
    /**
     * 显示 指定记录
     *
     * @param Request $request
     * @return String
     */
    public function detail(Request $request){
        $param = $request->only(['name']);
        // 参数校验
        $validator = \Validator::make($param, [
            'name' => ['required'],
        ]);
        if ($validator->fails()) {
            $msg = trans('请求参数错误：');
            $mix_msg = $this->module_service->formatValidatorError($validator->errors());
            $result = $this->module_service->formatMixResult(self::PARAM_ERROR, [], $mix_msg);
            return $this->module_service->formatReturnResult(500, $msg.$mix_msg, $result);
        }
        $data =$this->module_model::where('name', $param['name'])->first();
        $result = $this->module_service->formatMixResult(self::QUERY_CUSTOMER_SUCCESS, $data);
        return $this->module_service->formatReturnResult(200, trans('查询 模块信息 成功'), $result);
    }

    /**
     * 获取模块选项下拉列表
     *
     * @param Request $request
     * @return String
     */
    public function moduleOption(Request $request){
        try {
            // $query = ModuleModel::find(1);
            // $modules_handler=opendir($this->module_path);
            // $data=array();
            // while(false!==($file=readdir($modules_handler))){
            //     if($file!='.' && $file!='..' && substr($file, 0, 1)!='.'){
            //         $config=array();
            //         if($file=='App'){
            //             $config=include($this->module_path.DIRECTORY_SEPARATOR.$file.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'config.php');
            //         }else{
            //             $config=config(strtolower($file));
            //         }
            //         $module_query = $query->where('name', '=', $file);
            //         $info = $module_query->get($this->field)->toArray();
            //         $data[]=array(
            //             'name'=>isset($config['name'])?$config['name']:'',
            //             'version'=>isset($config['version'])?$config['version']:'',
            //         );
            //     }
            // }
            $query = ModuleModel::find(1);
            // 数据查询
            $data = $query->forPage($this->page_index, $this->page_size)
                ->orderBy('id', 'desc')
                ->get(['uid', 'name', 'version'])->toArray();
            foreach($data as $key=>$val){
                $config=config($val['name']);
                if($config){
                    foreach($config as $k=>$v){
                        $data[$key][$k]=isset($config[$k])?$config[$k]:'';
                    }
                }
            }
            $result = $this->module_service->formatMixResult(self::QUERY_CUSTOMER_SUCCESS, $data);
            return $this->module_service->formatReturnResult(200, trans('查询 模块信息 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::QUERY_CUSTOMER_FAILED;
            $result = $this->module_service->formatMixResult($mix_code, [], $exception);
            return $this->module_service->formatReturnResult(500, trans('查询 模块信息 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->module_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->module_service->formatReturnResult(500, $msg, $result);
        }
    }
     /**
     * 上传模块
     *
     * @param Request $request
     * @return String
     */
    public function upload(Request $request){

    }
    /**
     * 创建模块菜单
     *
     * @param string $module_name
     * @return String
     */
    public function createMenu($module_name){
        //$module_name='Openframe';
        $menu_config=include($this->module_path.DIRECTORY_SEPARATOR.$module_name.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.'menu.php');
        $menu_arr=$this->treeToList($menu_config);
        $module_info=$this->module_model->where('name', $module_name)->first()->toArray();
        foreach($menu_arr as $key=>$val){
            $val['module_name']=$module_name;
            $val['module_id']=$module_info['uid'];
            $val['display']=1;
            $val['is_enable']=1;
            $val['icon']='fas fa-file fa-1x';

            $this->menu_model->insert($val);
        }
    }
    /**
     * 创建模块路由
     *
     * @param string $module_name
     * @return String
     */
    private function createRoute($module_name){

    }
    /**
     * 安装模块扩展库
     *
     * @param string $module_name
     * @return String
     */
    private function installPackage($module_name){

    }
    /**
     * 获取模块对外接口
     *
     * @param string $module_name
     * @return String
     */
    private function createApi($module_name){

    }
    //递归插入菜单数据
	private function treeToList($arr=array(), $parentid='0'){
		$output=array();
        foreach($arr as $key=>$row){
            $temp=$row;
            $temp['uid']=$this->menu_service->randomString(16);
            $temp['parentid']=$parentid;
            $temp['listorder']=100;
            unset($temp['children']);
            $output[]=$temp;
            if(isset($row['children'])){
                $output=array_merge($output, $this->treeTolist($row['children'], $temp['uid']));
            }
		}
		return $output;
    }
}
