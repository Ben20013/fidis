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
 * Description : Admin Event Service.
 */
namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;
use Modules\Pro\Models\AdminEquipmentModel;
use Modules\Pro\Models\AdminEventModel;

class AdminEventService extends CommonService
{
    public function events($user_id)
    {
        $Equipments_ids = (new AdminEquipmentModel())->getEquipmentIdsByUser($user_id);
        return (new AdminEventModel())->EventsByEquipmentIds($Equipments_ids);
    }
}
