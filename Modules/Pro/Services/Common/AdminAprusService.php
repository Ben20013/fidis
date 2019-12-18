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
 * Description : Admin Aprus Service.
 */
namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;

class AdminAprusService extends CommonService
{
    /**
     * 格式化acl接口的返回数据
     *
     * @param $data object
     * @param $param string
     *
     * @return string
     */
    public function formatAclMessage($data, $param)
    {
        switch ($data->access){
            case 'all':
                return implode([0, 'all'], '|');
            case 'pub':
                if($param == 'publish'){
                    return implode([0, $data->topic], '|');
                }else{
                    return implode([1, trans('没有相关权限')], '|');
                }
            case 'sub':
                if($param == 'subscribe'){
                    return implode([0, $data->topic], '|');
                }else{
                    return implode([1, trans('没有相关权限')], '|');
                }
            default:
                return implode([1, trans('没有相关权限')], '|');
        }
    }

    /**
     * 校验适配器是否备案
     *
     * @param $aprus_id string
     * @return array
     */
    public function checkIsOnRecord($aprus_id)
    {
        $url = env('ADMIN_BOSS_APRUS_CHECK_URL');
        $data['aprus_id'] = $aprus_id;
        $data['gards_id'] = env('MIXIOT_ID');
        $header = ['Content-Type: application/json', env('ADMIN_BOSS_TOKEN')];
        $result = $this->httpPost($url, json_encode($data), $header);
        return json_decode($result, true);
    }

    /**
     * 适配器与BOSS同步
     *
     * @param $url String
     * @param $data array
     * @return array
     */
    public function bossSync($url, $data)
    {
        $header = ['Content-Type: application/json', env('ADMIN_BOSS_TOKEN')];
        $result = $this->httpPost($url, json_encode($data), $header);
        return json_decode($result, true);
    }
}
