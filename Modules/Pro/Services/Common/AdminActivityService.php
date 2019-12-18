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
 * Date : 2019-03-08
 * Author : LuoJiandong
 * Description : Admin Activity Service.
 */

namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;

class AdminActivityService extends CommonService
{
    /* 重组数据，转换数据格式
    * @param array $data
    * @param $interval //默认七天的数据
    * @return  array
    */
    public function recombinedData(array $data,$interval = 7)
    {
        $timeDate = get_recent_date($interval);
        $result = [
            'timeDate'=>$timeDate,
        ];
        //巡检/维修/保养/故障排除/报警处置
        $categorys =['日常巡检','设备维修','定期保养','故障排除','报警处理','其他'];
        foreach ($categorys as $category) {
            foreach ($timeDate as $day) {
                $result['activity'][$day][$category] = 0;
            }
        }
        foreach ($data as $value) {
            $result['activity'][$value->timeDay][$value->category] = $value->number;
        }
        return $result;
    }
}
