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
 * Description : RESULT Controller.
 */
namespace Modules\Openframe\Http\Controllers;
use Illuminate\Http\Request;
use Modules\Openframe\Models\ResultModel;
use Modules\Openframe\Models\ModuleModel;
use Modules\Openframe\Http\Controllers\Controller;
use Modules\Openframe\Services\Common\ResultService;
use Exception;
use Error;

class ResultController extends Controller{
    /**
     * @const MixCode 返回码
     */
    const REQUEST_SUCCESS = 130001;
    const REQUEST_FAILED = 230001;
    const PARAM_ERROR  = 230011;
    const SERVER_ERROR  = 230016;
    const NETWORK_ERROR  = 230012;
    const ADD_RESULT_SUCCESS  = 131901;
    const ADD_RESULT_FAILED  = 231901;
    const EDIT_RESULT_SUCCESS  = 131902;
    const EDIT_RESULT_FAILED  = 231902;
    const DELETE_RESULT_SUCCESS  = 131903;
    const DELETE_RESULT_FAILED  = 231903;
    const QUERY_RESULT_SUCCESS  = 131904;
    const QUERY_RESULT_FAILED  = 231904;

    /**
     * @var \App\Services\Common\ResultService
     */
    protected $result_service;
    protected $page_index = 1;
    protected $page_size = 20;
    protected $is_all = 0;
    protected $is_available = 1;
    protected $field = ['*'];

    /**
     * constructor.
     *
     * @param \App\Services\Common\ResultService $AdminRESULTService
     */
    public function __construct(ResultService $ResultService){
        $this->result_service = $ResultService;
        $this->result_model=new ResultModel;
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
                $query = $this->result_model->all(['*']);
                if($request->has('name')){
                    $query = $query->where('name', 'like', '%'.$params['name'].'%');
                }
                $data=array();
                if($query){
                    // 数据查询
                    $data = $this->result_model->forPage($this->page_index, $this->page_size)
                        ->orderBy('result_id', 'desc')
                        ->get($this->field)->toArray();
                }
                $result = [
                    'page_index'=>$this->page_index,
                    'page_size'=>$this->page_size,
                    'total_pages'=>ceil(count($data)/$this->page_size),
                    'total_records'=>count($data),
                    'data'=>$data
                ];
                $result = $this->result_service->formatMixResult(self::QUERY_RESULT_SUCCESS, $result);
                return $this->result_service->formatReturnResult(200, trans('查询 菜单信息 成功'), $result);
            } catch(Exception  $exception) {
                $mix_code = self::QUERY_RESULT_FAILED;
                $result = $this->result_service->formatMixResult($mix_code, [], $exception);
                return $this->result_service->formatReturnResult(500, trans('查询 菜单信息 失败'), $result);
            } catch(Error $error) {
                $msg = trans('服务器错误，请联系管理员!');
                $result = $this->result_service->formatMixResult(self::SERVER_ERROR, []);
                return $this->result_service->formatReturnResult(500, $msg, $result);
            }
        }else{
            return view('admin::index', array('title'=>'智物联'));
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
            $mix_msg = $this->result_service->formatValidatorError($validator->errors());
            $result = $this->result_service->formatMixResult(self::PARAM_ERROR, [], $mix_msg);
            return $this->result_service->formatReturnResult(500, $msg.$mix_msg, $result);
        }
        $data =$this->result_model::where('id', $param['id'])->first();
        $result = $this->result_service->formatMixResult(self::QUERY_RESULT_SUCCESS, $data);
        return $this->result_service->formatReturnResult(200, trans('查询 菜单信息 成功'), $result);
    }
}