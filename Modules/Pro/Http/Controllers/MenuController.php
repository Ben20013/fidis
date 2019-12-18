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
use Modules\Pro\Models\MenuModel;
use Modules\Pro\Models\ModuleModel;
use Modules\Pro\Http\Controllers\Controller;
use Modules\Pro\Services\Common\MenuService;
use Exception;
use Error;

class MenuController extends Controller{
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
     * @var \App\Services\Common\MenuService
     */
    protected $menu_service;
    protected $page_index = 1;
    protected $page_size = 20;
    protected $is_all = 0;
    protected $is_available = 1;
    protected $field = ['*'];

    /**
     * constructor.
     *
     * @param \App\Services\Common\MenuService $AdminCustomerService
     */
    public function __construct(MenuService $MenuService){
        $this->menu_service = $MenuService;
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
                $query = $this->menu_model::find(1);
                if($request->has('name')){
                    $query = $query->where('name', 'like', '%'.$params['name'].'%');
                }
                if($request->has('module_name')){
                    $query = $query->where('module_name', 'like', '%'.$params['module_name'].'%');
                }
                $total_records = $query->count();
                // 数据查询
                $data = $query->forPage($this->page_index, $this->page_size)
                    ->orderBy('listorder', 'asc')
                    ->get($this->field)->toArray();
                foreach($data as $key=>$val){
                    $config=config($val['name']);
                    if($config){
                        foreach($config as $k=>$v){
                            $data[$key][$k]=isset($config[$k])?$config[$k]:'';
                        }
                    }
                }
                $data=$this->listToTree($data);
                $result = [
                    'page_index'=>$this->page_index,
                    'page_size'=>$this->page_size,
                    'total_pages'=>ceil(count($data)/$this->page_size),
                    'total_records'=>count($data),
                    'data'=>$data
                ];
                $result = $this->menu_service->formatMixResult(self::QUERY_CUSTOMER_SUCCESS, $result);
                return $this->menu_service->formatReturnResult(200, trans('查询 菜单信息 成功'), $result);
            } catch(Exception  $exception) {
                $mix_code = self::QUERY_CUSTOMER_FAILED;
                $result = $this->menu_service->formatMixResult($mix_code, [], $exception);
                return $this->menu_service->formatReturnResult(500, trans('查询 菜单信息 失败'), $result);
            } catch(Error $error) {
                $msg = trans('服务器错误，请联系管理员!');
                $result = $this->menu_service->formatMixResult(self::SERVER_ERROR, []);
                return $this->menu_service->formatReturnResult(500, $msg, $result);
            }
        }else{
            return view('admin::index', array('title'=>'智物联'));
        }
    }

    /**
     * 创建 保存
     *
     * @param Request $request
     * @return String
     */
    public function add(Request $request){
        $info=$request->all();
        foreach ($info as $key =>$val) {
            $this->menu_model->$key = $val;
        }
        $this->menu_model->uid= $this->menu_service->randomString(16);
        try{
            $this->menu_model->save();
            $result = ['id'=>$this->menu_model->id];
            $result = $this->menu_service->formatMixResult(self::ADD_CUSTOMER_SUCCESS, $result);
            return $this->menu_service->formatReturnResult(200, trans('添加 菜单 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::ADD_CUSTOMER_FAILED;
            $result = $this->menu_service->formatMixResult($mix_code, [], $exception);
            return $this->menu_service->formatReturnResult(500, trans('添加 菜单 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->menu_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->menu_service->formatReturnResult(500, $msg, $result);
        }
    }

    /**
     * 显示 指定记录
     *
     * @param Request $request
     * @return String
     */
    public function detail(Request $request){
        $param = $request->only(['id']);
        // 参数校验
        $validator = \Validator::make($param, [
            'id' => ['required'],
        ]);
        if ($validator->fails()) {
            $msg = trans('请求参数错误：');
            $mix_msg = $this->menu_service->formatValidatorError($validator->errors());
            $result = $this->menu_service->formatMixResult(self::PARAM_ERROR, [], $mix_msg);
            return $this->menu_service->formatReturnResult(500, $msg.$mix_msg, $result);
        }
        $data =$this->menu_model::where('id', $param['id'])->first();
        $result = $this->menu_service->formatMixResult(self::QUERY_CUSTOMER_SUCCESS, $data);
        return $this->menu_service->formatReturnResult(200, trans('查询 菜单信息 成功'), $result);
    }

    /**
     * 编辑 保存
     *
     * @param Request $request
     * @return String
     */
    public function edit(Request $request){
        $info=$request->all();
        try{
            $this->menu_model->where('id', $info['id'])->update($info);
            $result = $this->menu_service->formatMixResult(self::EDIT_CUSTOMER_SUCCESS, []);
            return $this->menu_service->formatReturnResult(200, trans('编辑 菜单信息 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::EDIT_CUSTOMER_FAILED;
            $result = $this->menu_service->formatMixResult($mix_code, [], $exception);
            return $this->menu_service->formatReturnResult(500, trans('编辑 菜单信息 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->menu_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->menu_service->formatReturnResult(500, $msg, $result);
        }
    }

    /**
     * 删除
     *
     * @param Request $request
     * @return String
     */
    public function delete(Request $request){
        $param = $request->only(['id', 'uid']);
        $data = $this->menu_model->where('parentid', $param['uid'])->first();
        if ($data) {
            $result = $this->menu_service->formatMixResult(self::DELETE_CUSTOMER_FAILED, []);
            $msg = trans('当前菜单包含有子菜单，请先删除子菜单！');
            return $this->menu_service->formatReturnResult(500, $msg, $result);
        }

        $this->menu_model->where('id', $param['id'])->delete();
        $result = $this->menu_service->formatMixResult(self::DELETE_CUSTOMER_SUCCESS, []);
        return $this->menu_service->formatReturnResult(200, trans('删除 菜单 成功'), $result);
    }
    /**
     * 启用菜单
     *
     * @param Request $request
     * @return String
     */
    public function enable(Request $request){
        $info=$request->all();
        try{
            $this->menu_model->where('id', $info['id'])->update(array('is_enable'=>1));
            $result = $this->menu_service->formatMixResult(self::ADD_CUSTOMER_SUCCESS, []);
            return $this->menu_service->formatReturnResult(200, trans('启用 菜单 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::ADD_CUSTOMER_FAILED;
            $result = $this->menu_service->formatMixResult($mix_code, [], $exception);
            return $this->menu_service->formatReturnResult(500, trans('启用 菜单 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->menu_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->menu_service->formatReturnResult(500, $msg, $result);
        }
    }
    /**
     * 禁用菜单
     *
     * @param Request $request
     * @return String
     */
    public function disable(Request $request){
        $param=$request->all();
        try{
            $this->menu_model->where('id', $param['id'])->update(array('is_enable'=>0));
            $result = $this->menu_service->formatMixResult(self::ADD_CUSTOMER_SUCCESS, []);
            return $this->menu_service->formatReturnResult(200, trans('禁用 菜单 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::ADD_CUSTOMER_FAILED;
            $result = $this->menu_service->formatMixResult($mix_code, [], $exception);
            return $this->menu_service->formatReturnResult(500, trans('禁用 菜单 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->menu_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->menu_service->formatReturnResult(500, $msg, $result);
        }
    }
    /**
     * 获取菜单选项下拉列表
     *
     * @param Request $request
     * @return String
     */
    public function menuOption(Request $request){
        try {
            $query = $this->menu_model::find(1);
            $data=array();
            if($query){
            // 数据查询
                $data = $query->forPage($this->page_index, $this->page_size)
                    ->orderBy('listorder', 'asc')
                    ->get(['parentid', 'name as label', 'uid as value', 'uid'])->toArray();
                $data=$this->listToTree($data);
            }
            array_unshift($data, array('parentid'=>'0', 'label'=>'作为一级菜单', 'value'=>'0'));
            $result = $this->menu_service->formatMixResult(self::QUERY_CUSTOMER_SUCCESS, $data);
            return $this->menu_service->formatReturnResult(200, trans('查询 菜单信息 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::QUERY_CUSTOMER_FAILED;
            $result = $this->menu_service->formatMixResult($mix_code, [], $exception);
            return $this->menu_service->formatReturnResult(500, trans('查询 菜单信息 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->menu_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->menu_service->formatReturnResult(500, $msg, $result);
        }
    }
    /**
     * 获取左侧菜单项
     *
     * @param Request $request
     * @return String
     */
    public function getMenuList(){
        try {
            $query = $this->menu_model->where([['display', 1], ['is_enable', 1]]);
            $data=array();
            if($query){
            // 数据查询
                $data = $query->forPage($this->page_index, $this->page_size)
                    ->orderBy('listorder', 'asc')
                    ->get(['*'])->toArray();
                $data=$this->listToTree($data);
                foreach($data as $key=>$val){
                    $data[$key]['children']=isset($val['children'])?$val['children']:array();
                    $data[$key]['isSubmenuShow']=false;
                }
            }
            $result = $this->menu_service->formatMixResult(self::QUERY_CUSTOMER_SUCCESS, $data);
            return $this->menu_service->formatReturnResult(200, trans('查询 菜单信息 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::QUERY_CUSTOMER_FAILED;
            $result = $this->menu_service->formatMixResult($mix_code, [], $exception);
            return $this->menu_service->formatReturnResult(500, trans('查询 菜单信息 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->menu_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->menu_service->formatReturnResult(500, $msg, $result);
        }
    }
    //将一维数组转换成递归数组
	private function listToTree($arr=array(), $parentid='0'){
		$output=array();
		foreach($arr as $k=>$row){
			if($row['parentid']==$parentid){
                if($this->listToTree($arr, $row['uid'])){

                    $row['children']=$this->listToTree($arr, $row['uid']);
                }
                $row['route']=$row['route'].'/?_menuid='.$row['uid'];
                $output[]=$row;
			}
		}//print_r($output);
		return $output;
	}
	//将递归数组转换成一维数组
	private function treeToList($arr=array()){
		$output=array();
		foreach($arr as $row){
			$output[]=$row['uid'];
			$output=array_merge($output, $this->treeTolist($row['children']));
		}
		return $output;
    }
    public function icon(){

    }
}