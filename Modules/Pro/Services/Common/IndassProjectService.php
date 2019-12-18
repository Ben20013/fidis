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
 * Date : 2019-02-25
 * Author : LuoJiandong
 * Description : Indass Project Service.
 */
namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;
use Illuminate\Support\Facades\Redis;

class IndassProjectService extends CommonService
{
    /**
    * 项目启动停止数据格式化
    *
    * @param $signal string
    * @param $project object
    * @param $object object
    * @return string
    */
    public function format($signal, $project, $object)
    {
        ini_set('serialize_precision', 14);
        // 对象列表
        $object_arr = [];
        foreach ($object as $key=>$val) {
            $object_arr[] = [
                'object_id' => $val['equipment_id'],
                'object_name' => $val['equipment_name'],
                'object_reference_id' => $val['equipment_sn'],
                'object_model' => $val['model']
            ];
        }
        // 过滤器
        $data_filter = [];
        if ($filter = $project->filter) {
            $data_filter['filter_id'] = $filter->filter_id;
            $data_filter['filter_name'] = $filter->filter_name;
            $data_filter['script'] = json_decode($filter->script, true);
        }
        // 组织器
        $data_organizer = [];
        if ($organizer = $project->organizer) {
            $data_organizer['organizer_id'] = $organizer->organizer_id;
            $data_organizer['organizer_name'] = $organizer->organizer_name;
            $data_organizer['script'] = json_decode($organizer->script, true);
        }
        // 分析参数
        $analysis_parameter = [];
        if ($parameter = $project->parameter) {
            $analysis_parameter['ana_para_id'] = $parameter->parameter_id;
            $analysis_parameter['ana_para_name'] = $parameter->parameter_name;
            $analysis_parameter['script'] = json_decode($parameter->script, true);
        }
        // 消息
        $message_out = [];
        if ($message = $project->message) {
            $message_out['msg_out_id'] = $message->message_id;
            $message_out['msg_out_name'] = $message->message_name;
            $message_out['script'] = json_decode($message->script, true);
        }

        $result = [
            'id' => $project->project_id,
            'server' => $signal,
            'project_id' => $project->project_id,
            'project_name' => $project->project_name,
            'admin_user_id' => $project->user_id,
            'data_source' => ['source_id'=>1001, 'source_mode'=>'G'],
            'object' => $object_arr,
            'data_filter' => $data_filter,
            'data_organizer' => $data_organizer,
            'analysis_parameter' => $analysis_parameter,
            'message_out' => $message_out,
        ];
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 项目启动停止数据格式化
     *
     * @param $data array
     * @return null
     */
    public function save($data)
    {
        $id = Redis::INCR('incr:indass:projects:id');
        Redis::HSET('hset:indass:projects', $id, $data);
        Redis::LPUSH('list:indass:projects', $id);
    }
}
