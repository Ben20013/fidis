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
 * Description : Customer Service.
 */
namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;

class MenuService extends CommonService
{
    /**
     * 客户与BOSS同步
     *
     * @param $url String
     * @param $data Array
     * @return Array
     */
    public function bossSync($url, $data)
    {
        $data['customer_id'] = env('MIXIOT_ID').'.'.$data['customer_id'];
        $header = ['Content-Type: application/json', env('ADMIN_BOSS_TOKEN')];
        $result = $this->httpPost($url, json_encode($data), $header);
        return json_decode($result, true);
    }

    /**
     * 获取 EXP 下拉列表
     *
     * @param $url String
     * @param $data Array
     * @return Array
     */
    public function getExpList($url, $data)
    {
        $header = ['Content-Type: application/json', env('ADMIN_BOSS_TOKEN')];
        $result = $this->httpPost($url, json_encode($data), $header);
        return json_decode($result, true);
    }
}