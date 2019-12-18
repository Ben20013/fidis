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
 * Date : 2019-02-20
 * Author : LuoJiandong
 * Description : D&C Project Service.
 */
namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;
use Illuminate\Support\Facades\Redis;

class DcProjectService extends CommonService
{
    /**
     * 程序文件拷贝
     * @param  array $model
     * @return array $data
     */
    public function copyFile($model){
        $data = [];
        $origin_path = storage_path().'/app/public/uploads/';
        $path = app_path().'/Console/Commands/DcModel/';
        foreach ($model as $key => $val) {
            if (!$val['program']) {
                break;
            }
            $pathinfo = pathinfo($val['program']);
            if ($pathinfo['extension'] != 'php') {
                break;
            }
            $origin_file = $val['program'];
            $source_name = basename($origin_file,'.php');
            $name = $source_name.'_'.$val['project_id'].'_'.$val['model_id'];
            $file = str_replace($source_name, $name, file_get_contents($origin_path.$origin_file));
            file_put_contents($path.$name.'.php', $file);
            $data[] = [
                'project_id' => $val['project_id'],
                'model_id' => $val['model_id'],
                'cycle' => $val['cycle'],
                'run_name' => $name,
            ];
        }
        return $data;
    }

    /**
     * 工程与Engine服务同步
     *
     * @param $url string
     * @param $data array
     * @return string
     */
    public function EngineSync($url, $data)
    {
        $header = ['Content-Type: application/json'];
        $result = $this->httpPost($url, json_encode($data), $header);
        return $result;
    }

    /**
     * Python 模型启动
     *
     * @param $project_id int
     * @param $active boolean
     * @param $data array
     * @return null
     */
    public function modelRun($project_id, $active, $data)
    {
        $result = [
            'project_id' => (int)$project_id,
            'active' => $active,
            'model_list' => $data,
        ];

        $result = json_encode($result, JSON_UNESCAPED_UNICODE);

        Redis::LPUSH('list:dc:py_model:manage', $result);
    }
}
