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
 * Description : PROJECT Controller.
 */
namespace Modules\Openframe\Http\Controllers;
use Illuminate\Http\Request;
use Modules\Openframe\Models\ProjectModel;
use Modules\Openframe\Http\Controllers\Controller;
use Modules\Openframe\Services\Common\ProjectService;
use Exception;
use Error;

class ProjectController extends Controller{
    /**
     * @const MixCode 返回码
     */
    const REQUEST_SUCCESS = 130001;
    const REQUEST_FAILED = 230001;
    const PARAM_ERROR  = 230011;
    const SERVER_ERROR  = 230016;
    const NETWORK_ERROR  = 230012;
    const ADD_PROJECT_SUCCESS  = 131901;
    const ADD_PROJECT_FAILED  = 231901;
    const EDIT_PROJECT_SUCCESS  = 131902;
    const EDIT_PROJECT_FAILED  = 231902;
    const DELETE_PROJECT_SUCCESS  = 131903;
    const DELETE_PROJECT_FAILED  = 231903;
    const QUERY_PROJECT_SUCCESS  = 131904;
    const QUERY_PROJECT_FAILED  = 231904;
    /**
     * @const
     */
    const UPLOAD_FOLDER = '/app/public/uploads';
    /**
     * @var \App\Services\Common\ProjectService
     */
    protected $project_service;
    protected $page_index = 1;
    protected $page_size = 20;
    protected $is_all = 0;
    protected $is_available = 1;
    protected $field = ['*'];

    /**
     * constructor.
     *
     * @param \App\Services\Common\ProjectService $OpenframePROJECTService
     */
    public function __construct(ProjectService $ProjectService){
        $this->project_service = $ProjectService;
        $this->project_model=new ProjectModel;
        $this->modules_path=MODULE_PATH.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'Modules';
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
                $query = $this->project_model->all(['*']);
                if($request->has('name')){
                    $query = $query->where('name', 'like', '%'.$params['name'].'%');
                }
                $data=array();
                if($query){
                    // 数据查询
                    $data = $this->project_model->forPage($this->page_index, $this->page_size)
                        ->orderBy('project_id', 'desc')
                        ->get($this->field)->toArray();
                }
                $result = [
                    'page_index'=>$this->page_index,
                    'page_size'=>$this->page_size,
                    'total_pages'=>ceil(count($data)/$this->page_size),
                    'total_records'=>count($data),
                    'data'=>$data
                ];
                $result = $this->project_service->formatMixResult(self::QUERY_PROJECT_SUCCESS, $result);
                return $this->project_service->formatReturnResult(200, trans('查询 项目信息 成功'), $result);
            } catch(Exception  $exception) {
                $mix_code = self::QUERY_PROJECT_FAILED;
                $result = $this->project_service->formatMixResult($mix_code, [], $exception);
                return $this->project_service->formatReturnResult(500, trans('查询 项目信息 失败'), $result);
            } catch(Error $error) {
                $msg = trans('服务器错误，请联系管理员!');
                $result = $this->project_service->formatMixResult(self::SERVER_ERROR, []);
                return $this->project_service->formatReturnResult(500, $msg, $result);
            }
        }else{
            return view('openframe::index', array('title'=>'智物联'));
        }
    }
    /**
     * 创建 保存
     *
     * @param Request $request
     * @return String
     */
    public function add(Request $request){
        $param=$request->all();
        $param['created']=date('Y-m-d H:i:s');
        foreach ($param as $key =>$val) {
            $this->project_model->$key = $val;
        }
        $project_id=$this->project_model->max('project_id');
        $this->project_model->project_id= $project_id?$project_id+1:1001;

        try{
            $this->project_model->save();
            // PHP程序处理
            $env_flag = isset($param['environment']) && $param['environment'];
            $program_flag = isset($this->project_model->program) && $this->project_model->program;
            if ($env_flag && $param['environment'] == 'php' && $program_flag) {
                $this->moveProgram($this->project_model->project_id, $this->project_model->program);
            }
            // 结果输出
            $result = ['project_id'=>$this->project_model->project_id];
            $result = $this->project_service->formatMixResult(self::ADD_PROJECT_SUCCESS, $result);
            return $this->project_service->formatReturnResult(200, trans('添加 项目 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::ADD_PROJECT_FAILED;
            $result = $this->project_service->formatMixResult($mix_code, [], $exception);
            return $this->project_service->formatReturnResult(500, trans('添加 项目 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->project_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->project_service->formatReturnResult(500, $msg, $result);
        }
    }
    /**
     * 编辑 保存
     *
     * @param Request $request
     * @return String
     */
    public function edit(Request $request){
        $param=$request->all();
        try {
            $this->project_model->where('project_id', $param['project_id'])->update($param);
            // PHP程序处理
            $program_flag = isset($param['program']) && $param['program'];
            $item = $this->project_model->where('project_id',  $param['project_id'])->first();
            if ($item && $item->environment == 'php' && $program_flag) {
                $this->moveProgram($param['project_id'], $param['program']);
            }
            // 结果输出
            $result = $this->project_service->formatMixResult(self::EDIT_PROJECT_SUCCESS, []);
            return $this->project_service->formatReturnResult(200, trans('编辑 项目信息 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::EDIT_PROJECT_FAILED;
            $result = $this->project_service->formatMixResult($mix_code, [], $exception);
            return $this->project_service->formatReturnResult(500, trans('编辑 项目信息 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->project_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->project_service->formatReturnResult(500, $msg, $result);
        }
    }
    /**
     * 删除
     *
     * @param Request $request
     * @return String
     */
    public function delete(Request $request){
        $param = $request->only(['project_id']);
        $itme = $this->project_model->where('project_id', $param['project_id'])->first();
        if ($itme && $itme['active']) {
            $result = $this->project_service->formatMixResult(self::DELETE_PROJECT_FAILED, []);
            $msg = trans('该任务正在执行中，请禁用后再删除！');
            return $this->project_service->formatReturnResult(500, $msg, $result);
        }
        // 删除数据
        $this->project_model->where('project_id', $param['project_id'])->delete();
        // 删除 文件
        $program_path = app_path().'/Console/Jobs/'.$this->getOpenframeId().'/'.$itme->program;
        if(file_exists($program_path))
        {
            unlink($program_path);
        }
        $result = $this->project_service->formatMixResult(self::DELETE_PROJECT_SUCCESS, []);
        return $this->project_service->formatReturnResult(200, trans('删除 项目 成功'), $result);
    }
    /**
     * 启用
     *
     * @param Request $request
     * @return String
     */
    public function enable(Request $request){
        $param=$request->all();
        try{
            $field = ['project_id', 'environment', 'cycle', 'program', 'active'];
            $item = $this->project_model->where('project_id',  $param['project_id'])->first($field);
            if (!$item || $item->active) {
                $mix_code = self::ADD_PROJECT_FAILED;
                $msg = trans('项目不存在 或 已启动');
                $result = $this->project_service->formatMixResult($mix_code, []);
                return $this->project_service->formatReturnResult(500, $msg, $result);
            }
            if ($item->environment == 'php' && $item->program) {
                // 添加运行记录
                $program_info = pathinfo($item->program);
                $job_data = [
                    'job_name' => $program_info['filename'],
                    'openframe_id' => $this->getOpenframeId(),
                    'project_id' => $item->project_id,
                    'cycle' => $item->cycle
                ];
                \DB::table('admin_job')->insert($job_data);
            }
            // 更新项目状态
            $this->project_model->where('project_id', $param['project_id'])->update(array('active'=>1));
            // 输出
            $result = $this->project_service->formatMixResult(self::ADD_PROJECT_SUCCESS, []);
            return $this->project_service->formatReturnResult(200, trans('启用 项目 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::ADD_PROJECT_FAILED;
            $result = $this->project_service->formatMixResult($mix_code, [], $exception);
            return $this->project_service->formatReturnResult(500, trans('启用 项目 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->project_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->project_service->formatReturnResult(500, $msg, $result);
        }
    }
    /**
     * 禁用
     *
     * @param Request $request
     * @return String
     */
    public function disable(Request $request){
        $param=$request->all();
        try{
            $field = ['project_id', 'environment', 'cycle', 'program', 'active'];
            $item = $this->project_model->where('project_id',  $param['project_id'])->first($field);
            if (!$item || !$item->active) {
                $mix_code = self::ADD_PROJECT_FAILED;
                $msg = trans('项目不存在 或 已禁用');
                $result = $this->project_service->formatMixResult($mix_code, []);
                return $this->project_service->formatReturnResult(500, $msg, $result);
            }
            if ($item->environment == 'php') {
                // 删除运行记录
                \DB::table('admin_job')
                    ->where('project_id', $item->project_id)
                    ->where('openframe_id', $this->getOpenframeId())
                    ->delete();
            }
            // 更新项目状态
            $this->project_model->where('project_id', $param['project_id'])->update(array('active'=>0));
            $result = $this->project_service->formatMixResult(self::ADD_PROJECT_SUCCESS, []);
            return $this->project_service->formatReturnResult(200, trans('禁用 项目 成功'), $result);
        } catch(Exception  $exception) {
            $mix_code = self::ADD_PROJECT_FAILED;
            $result = $this->project_service->formatMixResult($mix_code, [], $exception);
            return $this->project_service->formatReturnResult(500, trans('禁用 项目 失败'), $result);
        } catch(Error $error) {
            $msg = trans('服务器错误，请联系管理员!');
            $result = $this->project_service->formatMixResult(self::SERVER_ERROR, []);
            return $this->project_service->formatReturnResult(500, $msg, $result);
        }
    }

    /**
     * 文件上传
     *
     * @param Request $request
     * @return String
     */
    public function upload(Request $request){
        // 参数校验
        $param = $request->all();
        $validator = \Validator::make($param, [

        ]);
        if ($validator->fails()) {
            $msg = trans('请求参数错误：');
            $mix_msg = $this->project_service->formatValidatorError($validator->errors());
            $result = $this->project_service->formatMixResult(self::PARAM_ERROR, [], $mix_msg);
            return $this->project_service->formatReturnResult(500, $msg.$mix_msg, $result);
        }
        $openframe_id = $this->getOpenframeId();
        $file = $request->file('file');
        if ($file->isValid()) {
            $original_name = $file->getClientOriginalName(); // 文件原名
            $path = $file->storeAs($openframe_id, $original_name);
            $result = ['path'=>$path];
            $result = $this->project_service->formatMixResult(self::REQUEST_SUCCESS, $result);
            return $this->project_service->formatReturnResult(200, trans('上传文件成功'), $result);
        } else {
            $result = $this->project_service->formatMixResult(self::REQUEST_FAILED, []);
            return $this->project_service->formatReturnResult(500, trans('上传文件失败'), $result);
        }
    }

    /**
     * 文件转储
     *
     * @param int $project_id
     * @param string $path
     * @return String
     */
    private function moveProgram($project_id, $path){
        $path_info = pathinfo($path);
        if ($path_info['dirname']) {
            // 原文件
            $source_name = $path_info['filename'];
            $origin_path = storage_path().'/app/'.$path;
            // 目标文件
            $program_dir = app_path().'/Console/Jobs/'.$path_info['dirname'];
            $program_name = $path_info['filename'].'_'.$project_id;
            $program_path = $program_dir.'/'.$program_name.'.php';
            is_dir($program_dir) OR mkdir($program_dir, 0777, true);
            // 替换 文件名/类名/定时任务命令，并转存
            if(file_exists($origin_path))
            {
                $file = str_replace($source_name, $program_name, file_get_contents($origin_path));
                file_put_contents($program_path, $file);
                chmod($program_path, 0755);
                unlink($origin_path); //删除旧文件
            }
            $this->project_model->where('project_id', $project_id)->update(['program'=>$program_name.'.php']);
        }
    }

    /**
     * 获取应用目录：标识
     *
     * @return String
     */
    private function getOpenframeId(){
        $dir = explode(DIRECTORY_SEPARATOR, __DIR__);
        $result = $dir[count($dir)-3];
        return $result;
    }
}