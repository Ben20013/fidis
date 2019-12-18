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
 * Date : 2019-03-01
 * Author : LuoJiandong
 * Description : Admin Statos Service.
 */
namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;

class AdminStatosService extends CommonService
{
    /**
     * 时间格式转换为秒
     *
     * @param $type String
     * @return String
     */
    public function getTable($type)
    {
        $type = strtolower($type);
        switch ($type){
            case 'st':
                return 'admin_statos';
                break;
            case 'st_ed':
                return 'admin_statos_day';
                break;
            case 'st_em':
                return 'admin_statos_month';
                break;
            case 'st_ew':
                return 'admin_statos_week';
                break;
            case 'st_ey':
                return 'admin_statos_year';
                break;
            case 'st_cd':
                return 'admin_statos_current_day';
                break;
            case 'st_cm':
                return 'admin_statos_current_month';
                break;
            case 'st_cy':
                return 'admin_statos_current_year';
                break;
            case 'st_sm':
                return 'admin_statos_summary';
                break;
            default:
                return 'admin_statos';
        }
    }
}
