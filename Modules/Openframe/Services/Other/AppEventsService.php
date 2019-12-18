<?php

namespace Modules\Openframe\Services\Other;

use Modules\Openframe\Models\AdminEquipmentModel;
use DB;
class AppEventsService
{
    public $prefix = "admin_";

    /**
     * @param $equipment_ids
     * @param int $item
     * @param array $user_id
     * @return mixed
     */
    public function getEvents($equipment_ids,$item = 5,$user_id=[]) {
        //暂时消息、 故障 、 报警
        $alert =  DB::table($this->prefix.'alert')
            ->select(
                DB::raw('
                    alert_id as id , 
                    alert_name as name,
                    3 as type,
                    0 as category,
                    0 as unit,
                    description,
                    created
                ')
            )
            ->whereIn('equipment_id',$equipment_ids);

        $fault =  DB::table($this->prefix.'fault')
            ->select(
                DB::raw('
                    fault_id as id , 
                    fault_name as name,
                    2 as type,
                    0 as category,
                    0 as unit,
                    description,
                    created
                ')
            )
            ->whereIn('equipment_id',$equipment_ids);

        $this->getAprusByEquipmentIds($equipment_ids);
        $query = $alert->union($fault);
        $querySql = $query->toSql();

        $result = DB::table(DB::raw("($querySql) as a"))
            ->mergeBindings($query)
            ->orderBy('created','desc')
            ->paginate($item);
        return $result;

    }

    public function getAprusByEquipmentIds($equipment_ids) {
        $aprus_ids = (new AdminEquipmentModel())->getAprusList($equipment_ids);
        $apruses = [];
        foreach ($aprus_ids as $v) {
            $tmp = json_decode($v);
            foreach ($tmp as $value) {
                if ($value) {
                    array_push($apruses,$value);
                }
            }
        }
        return $apruses;
    }
}
