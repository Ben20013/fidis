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
 * Date : 2019-03-07
 * Author : LuoJiandong
 * Description : Admin User Service.
 */
namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;
use Modules\Pro\Models\AdminUserModel;

class AdminUserService extends CommonService
{
    public function __construct()
    {

    }

    /**
     * 判断用户类型
     * @param $uid //用户id
     * @return string  //ADMIN、PRO、EXP、APP
     */
    public function  userType($uid)
    {
        // $type = AdminUserModel::where("user_id", $uid)->select("system")->first();
        // return isset($type->system) ? $type->system : "";
        return '';
    }

    /**
     * 用户与BOSS同步
     *
     * @param $url string
     * @param $data array
     * @return array
     */
    public function bossSync($url, $data)
    {
        $data['user_id'] = env('MIXIOT_ID').'.'.$data['user_id'];
        $header = ['Content-Type: application/json', env('ADMIN_BOSS_TOKEN')];
        $result = $this->httpPost($url, json_encode($data), $header);
        return json_decode($result, true);
    }
}
