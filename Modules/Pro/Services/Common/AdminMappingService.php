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
 * Date : 2019-02-27
 * Author : LuoJiandong
 * Description : Admin Mapping Service.
 */
namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;

use Modules\Pro\Models\AdminEquipmentModel;

class AdminMappingService extends CommonService
{
    /**
     * v2 仅返回前三个元素
     * @param $equipment_id
     * @return array
     */
    public function getMappingByEquipmentId($equipment_id)
    {
       $data =  AdminEquipmentModel::where('equipment_id',$equipment_id)
           ->leftjoin('admin_mapping as m','m.mapping_id','=','admin_equipment.mapping_id')
           ->select('m.script')
           ->first();
        $result = [];
       if (isset($data->script)) {
           $script =  json_decode($data->script);
           foreach ($script as $value) {
               $value = array_slice($value,0,3);
               array_push($result,$value);
           }
       }
       return ["script"=>$result];
    }

    /**
     * 设备与MIXIOT服务同步
     *
     * @param $url String
     * @param $data Array
     * @return Array
     */
    public function mixiotSync($url, $data)
    {
        $header = ['Content-Type: application/json'];
        $result = $this->httpPost($url, json_encode($data), $header);
        return json_decode($result, true);
    }
}
