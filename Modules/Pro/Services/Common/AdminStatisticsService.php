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
 * Date : 2019-02-28
 * Author : LuoJiandong
 * Description : Admin Statistics Service.
 */
namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;
use Exception;

class AdminStatisticsService extends CommonService
{
    /**
     * 统计程序交互管理
     *
     * @param $url String
     * @param $data Array
     * @return Array
     */
    public function programManage($url, $data)
    {
        $header = ['Content-Type: application/json'];
        $result = $this->httpPost($url, json_encode($data), $header);
        return json_decode($result, true);
    }

    /**
     * 时间格式转换为秒
     *
     * @param $time Array
     * @return String
     */
    public function timeConversion($time)
    {
        try{
            switch ($time[0]){
                case 'I':
                    return $time[1]*60;
                    break;
                case 'H':
                    return $time[1]*60*60;
                    break;
                case 'D':
                    return $time[1]*60*60*24;
                    break;
                case 'W':
                    return $time[1]*60*60*24*7;
                    break;
                case 'M':
                    return $time[1]*60*60*24*30;
                    break;
                default:
                    return 60*60*24;
            }
        } catch(Exception  $exception) {
            return 60*60*24;
        }

    }

    /**
     * 获取文件名
     *
     * @param $path String
     * @return String
     */
    public function getFileName($path)
    {
        $path_info = pathinfo($path);
        return $path_info['basename'];
    }

    /**
     * 获取文件路径
     *
     * @param $path String
     * @return String
     */
    public function getFilePath($path)
    {
        $path_info = pathinfo($path);
        return $path_info['dirname'];
    }
}