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
 * Description : Admin Message Service.
 */
namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;

use Modules\Pro\Models\AdminMessageModel;

class AdminMessageService extends CommonService
{
    public  function  risk ($equipment_ids,$items) {
        return (new  AdminMessageModel())
            ->where('is_available',1)
            ->where("unit","indass")
            ->orderBy("created","desc")
            ->whereIn("messenger",$equipment_ids)
            ->select(
                "message_id",
                "message_name",
                "unit",
                "created",
                "messenger",
                "description"
            )
            ->paginate($items);
    }

    public  function  notice ($user,$items) {
        if (!is_array($user)) $user = [$user];
        return (new  AdminMessageModel())
            ->where('is_available',1)
            ->where("unit","user")
            ->where("category","Notice")
            ->orderBy("created","desc")
            ->whereIn("messenger",$user)
            ->select(
                "message_id",
                "message_name",
                "unit",
                "created",
                "messenger",
                "description"
            )
            ->paginate($items);
    }
}
