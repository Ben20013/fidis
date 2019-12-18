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
 * Description : D&C Engine Service.
 */
namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;

class DcEngineService extends CommonService
{
    /**
     * 引擎与Engine服务同步
     *
     * @param $url string
     * @param $data array
     * @return array
     */
    public function engineSync($url, $data)
    {
        $header = ['Content-Type: application/json'];
        $result = $this->httpPost($url, json_encode($data), $header);
        return $result;
    }
}
