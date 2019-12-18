<?php
/******************************************************************************
 * Copyright (c) 2014-2018 Mixlinker Networks Inc. <mixiot@mixlinker.com>
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
 *****************************************************************************/ /*
 * Date : 2019-08-29
 * Author : zengpinghua
 * Description : Modules/Diag
 */
namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Modules\Diag\Services\DiagTaskService;
use Modules\Diag\Models\DiagResultModel;
use Modules\Diag\Models\DiagLogModel;
use Exception;
use Error;

class TaskDiag extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'TaskDiag';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'TaskDiag Controller';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $task_service = new DiagTaskService();
        $result_model = new DiagResultModel();
        // 查询 体检任务 数据
        $task = DB::table('diag_task')->get(['task_id', 'task_name', 'mapping_id', 'check_list'])
            ->map(function ($value) {
                return (array)$value;
            })
            ->toArray();
        // 进行 设备体检
        foreach ($task as $key => $val) {
            try {
                $check_list = json_decode($val['check_list'], true);
                if (!$check_list || !$val['mapping_id']) {
                    continue;
                }
                $respond = $task_service->taskDiag($val['mapping_id'], $check_list);
                $respond_data = json_decode($respond, true);
                if (!$respond_data || !isset($respond_data['code'])) {
                    // 请求网络错误
                    $log_data = ['message'=>'请求网络错误', 'primary_key'=>$val['task_id'], 'data'=>$respond];
                    $this->addLog($log_data);
                    continue;
                }
                // 查询失败
                if ($respond_data['code'] != 200) {
                    // 一键体检 失败
                    $msg = $respond_data['msg'].$respond_data['mix_msg'];
                    $log_data = ['message'=>'一键体检失败', 'primary_key'=>$val['task_id'], 'data'=>$msg];
                    $this->addLog($log_data);
                    continue;
                }
                $data = $respond_data['result']['data'];
                if (!$data) {
                    // 无体检结果产生：检查项为空，或设备为空
                    $msg = '检查项为空，或设备为空';
                    $log_data = ['message'=>'无体检结果产生', 'primary_key'=>$val['task_id'], 'data'=>$msg];
                    $this->addLog($log_data);
                    continue;
                }
                // 组合体检结果并保存
                $add_data = [
                    'task_name' => $val['task_name'],
                    'task_id' => $val['task_id'],
                    'reference' => $respond_data['mix_msg']
                ];
                $data = $task_service->formatData($data, $add_data);
                // 保存数据
                $result_model->batch_save($data);
            } catch(Exception  $exception) {
                // 运行 Exception错误
                $log_data = ['message'=>'运行 Exception 错误', 'primary_key'=>$val['task_id'], 'data'=>$exception];
                $this->addLog($log_data);
                continue;
            } catch(Error $e){
                // 运行 Error 错误
                $log_data = ['message'=>'运行 Error 错误', 'primary_key'=>$val['task_id'], 'data'=>''];
                $this->addLog($log_data);
                continue;
            }
        }
    }

    /**
     * 记录操作日志
     *
     * @param $log array
     * @return string
     */
    public function addLog($log)
    {
        $log_model = new DiagLogModel;
        foreach($log as $key=>$val){
            $log_model->$key = $val;
        }
        $log_model->type = 10;
        $log_model->route = __CLASS__.'\\'.__FUNCTION__;
        $log_model->save();
    }
}
