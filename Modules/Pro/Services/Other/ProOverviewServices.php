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
 *****************************************************************************/ /*
 * Date : 2018-05-29
 * Author : Minton
 * Description : Pro Overview Services
 */
namespace Modules\Pro\Services\Other;
//use Modules\Pro\Models\AdminEquipmentGroupModel;
use Modules\Admin\Models\AdminEquipmentModel;
use Modules\Admin\Models\AdminUserEquipmentModel;

class ProOverviewServices
{
    public function getGroupEquipmentAboutGis($group_id) {
        // 第一步获取主设备id
        $group_id = explode(",",$group_id);
        // $equipment_list = (new AdminEquipmentGroupModel())->getGroupEquipment($group_id);
        $equipment_list = [];
        $groups = [];
        foreach ($equipment_list as $group_id => $item ) {
            if (count($item)==0) {
                $groups[$group_id] = "";
                continue;
            }
            $groups[$group_id][] = $item[0]["main_equipment"];
            $groups[$group_id] = array_merge($groups[$group_id],explode(",",$item[0]["sub_equipment"]));
        }
        // 第一个元素为主设备id
        $result = [];
        $model = new AdminEquipmentModel();
        foreach ($groups as $group_id => $equipment_ids) {
            foreach ($equipment_ids as $index => $equipment_id) {
                $data = $model->getEquipmentInfoById($equipment_id);
                if (isset($data->gis)) {
                    $result[$group_id] = [
                        "group_id" => $group_id,
                        "equipment_id" => $data->equipment_id,
                        "gis" => $data->gis,
                        "equipment_image" => $data->equipment_image,
                        "description" => $data->description,
                        "equipment_name" => $data->equipment_name,
                        "model" => $data->model
                    ];
                    break;
                }
                // 获取主设备数据
                if ($index == 0 ) {
                    $result[$group_id] = [
                        "group_id" => $group_id,
                        "equipment_id" => $data->equipment_id,
                        "gis" => $data->gis,
                        "equipment_image" => $data->equipment_image,
                        "description" => $data->description,
                        "equipment_name" => $data->equipment_name,
                        "model" => $data->model
                    ];
                }
            }
        }
        return $result;
    }

    // 不包含设备组的处理
    public function getNoneGroupEquipmentAboutGis ($user_id) {
        $equipment_ids = (new AdminUserEquipmentModel())->equipmentIdsArr($user_id);
        if (count($equipment_ids) == 0)  return [];

        return AdminEquipmentModel::where('is_available',1)
            ->where("is_group",0)
            ->whereIn('equipment_id',$equipment_ids)
            ->get(['equipment_id', 'gis', 'equipment_image', 'description', 'equipment_name','model'])
            ->toArray();
    }
}
