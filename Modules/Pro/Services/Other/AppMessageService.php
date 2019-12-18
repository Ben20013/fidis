<?php

namespace Modules\Pro\Services\Other;

use Modules\Pro\Models\AdminAlertMosaicModel;
use Modules\Pro\Models\AdminFaultMosaicModel;

class AppMessageService
{

    public function faultMosaicMessage($equipment_ids)
    {
        if (!is_array($equipment_ids)) $equipment_ids = [$equipment_ids];

        return  AdminFaultMosaicModel::where("is_available",1)
            ->whereIn("equipment_id",$equipment_ids)
            ->select("equipment_id","count(*) as items")
            ->get()
            ->toArray();
    }

    public function AdminAlertMosaicModelMessage($equipment_ids)
    {
        if (!is_array($equipment_ids)) $equipment_ids = [$equipment_ids];
        return AdminAlertMosaicModel::where("is_available",1)
            ->whereIn("equipment_id",$equipment_ids)
            ->select("equipment_id","count(*) as items")
            ->get()
            ->toArray();
    }
}
