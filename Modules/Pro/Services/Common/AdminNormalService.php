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
 * Date : 2019-03-11
 * Author : LuoJiandong
 * Description : Admin Normal Service.
 */

namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;
use Modules\Pro\Models\AdminNormalModel;

class AdminNormalService extends CommonService
{
    public function countNormalNumByEquipments($equipment_ids)
    {
        $normals = AdminNormalModel::whereIn("equipment_id",$equipment_ids)->get([
            "is_online",
            "is_boot",
        ])->toArray();
        $result = [
            "is_online" => 0,   // 在线
            "is_boot"   => 0,   // 开机
        ];
        foreach ($normals as $value) {
            foreach ($value as $k => $v) {
                if ($k == "is_online") {
                    if ($v == 1) {
                        $result[$k] ++;
                    }
                }

            }
            if ($value["is_online"] == 1 && $value["is_boot"] == 1) {
                $result["is_boot"] ++;
            }
        }
        return $result;
    }

    public function fitterEquipmentIdsByBooting($equipment_id)
    {
        $equipment_ids = [];
        foreach ($equipment_id as $value) {
            array_push($equipment_ids ,$value['equipment_id']);
        }

        return AdminNormalModel::whereIn("equipment_id",$equipment_ids)
            ->where("is_online",1)
            ->where("is_boot",1)
            ->pluck("equipment_id")
            ->toArray();
    }
}
