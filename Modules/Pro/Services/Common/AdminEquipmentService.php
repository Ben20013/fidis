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
 * Description : Equipment Service.
 */
namespace Modules\Pro\Services\Common;
use Modules\Pro\Services\CommonService;
use Modules\Pro\Models\AdminEquipmentModel;
use Modules\Pro\Models\AdminUserEquipmentModel;
use Log;
class AdminEquipmentService extends CommonService
{

    /**
     * 返回包含设备状态的 列表数据
     * @param $data
     * @return array
     */
    public function returnStatusData($data)
    {
        foreach($data as $key=>$val){
            if(!$val->is_online){
                $data[$key]->status_code = -1;
                $data[$key]->status_name = trans('离线');
            }elseif(!$val->is_boot){
                $data[$key]->status_code = 0;
                $data[$key]->status_name = trans('停止');
            }elseif($val->is_fault || $val->is_alert){
                $data[$key]->status_code = 2;
                if($val->is_fault && !$val->is_alert){
                    $data[$key]->status_name = trans('故障');
                }elseif(!$val->is_fault && $val->is_alert){
                    $data[$key]->status_name = trans('报警');
                }else{
                    $data[$key]->status_name = trans('故障且报警');
                }
            }else{
                $data[$key]->status_code = 1;
                $data[$key]->status_name = trans('正常');
            }
            unset($data[$key]->is_online);
            unset($data[$key]->is_boot);
            unset($data[$key]->is_fault);
            unset($data[$key]->is_alert);
        }
        return $data;
    }

    /**
     * 返回包含设备 详细状态的 列表数据
     * @param $data
     * @return array
     */
    public function returnStatusDetailData($data)
    {
        foreach($data as $key=>$val){
            $status_arr = [];
            if(!$val->is_online){
                $data[$key]->status_code = -1;
                $status_arr[] = '离线';
                if($val->is_fault && !$val->is_alert){
                    $status_arr[] = '故障';
                }elseif(!$val->is_fault && $val->is_alert){
                    $status_arr[] = '报警';
                }elseif($val->is_fault && $val->is_alert){
                    $status_arr[] = '故障';
                    $status_arr[] = '报警';
                }
                $data[$key]->status_name = implode('|', $status_arr);
            }elseif(!$val->is_boot){
                $data[$key]->status_code = 0;
                $status_arr[] = '关机';
                if($val->is_fault && !$val->is_alert){
                    $status_arr[] = '故障';
                }elseif(!$val->is_fault && $val->is_alert){
                    $status_arr[] = '报警';
                }elseif($val->is_fault && $val->is_alert){
                    $status_arr[] = '故障';
                    $status_arr[] = '报警';
                }
                $data[$key]->status_name = implode('|', $status_arr);
            }elseif($val->is_fault || $val->is_alert){
                $data[$key]->status_code = 1;
                $status_arr[] = '开机';
                if($val->is_fault && !$val->is_alert){
                    $status_arr[] = '故障';
                }elseif(!$val->is_fault && $val->is_alert){
                    $status_arr[] = '报警';
                }elseif($val->is_fault && $val->is_alert){
                    $status_arr[] = '故障';
                    $status_arr[] = '报警';
                }
                $data[$key]->status_name = implode('|', $status_arr);
            }else{
                $data[$key]->status_code = 1;
                $status_arr[] = '开机';
                $data[$key]->status_name = implode('|', $status_arr);
            }
            unset($data[$key]->is_online);
            unset($data[$key]->is_boot);
            unset($data[$key]->is_fault);
            unset($data[$key]->is_alert);
        }
        return $data;
    }

    /**
     * 获取该用户下的所有设备在每个地区（华南、华东...）所占的百分比
     * @param $userId
     * @return array
     */
    public function equipmentAreaBelongToUser($userId)
    {

        // version 1 调用百度地图 对 gis 解析
//        $gpses = (new AdminEquipmentModel())
//            ->getGisByUser($userId);
//        $provinces = [];
//        foreach ($gpses as $gis) {
//            $provinces[] = $this->parseGps($gis["gis"]);
//        }

        // version 2 根据扩展字段进行解析
        $equipment_ids = (new AdminUserEquipmentModel())->equipmentIdsNotGroup($userId);
        $addition  = (new AdminEquipmentModel())
            ->getOneField($equipment_ids);

        return $this->provincesInAreaPer(
            $this->parseAddition($addition)
        );
    }


    public function  parseAddition($data)
    {
        $provinces = [];
        foreach ($data as $value) {
//            $value = '[{"title":"基本信息","data":[["机组型号","1000GF"],["装机容量","600"]]},{"title":"附加信息","data":[["所属地区","浙江省"],["省","浙江省"]]}]';
            $addition = json_decode($value,true);
            // 每一个设备的 扩展字段, 从此次开始解析
            $province = "";
            foreach ($addition as $k => $v) {
                if (!array_key_exists("data",$v)) continue;
                foreach ($v["data"] as $item) {
                    if (!in_array("省",$item)) continue;
                    $province = $item[1];
                }
            }
            $provinces[] = $province;
        }
        return $provinces;
    }

    /**
     * gps 解析
     * @param $gps
     * @return string
     */
    public function parseGps($gps) {
        if (empty($gps)) return "";
        $geotable_id = env("BAIDU_MAP_API_GEOTABLE_ID") ;
        $ak = env("BAIDU_MAP_API_AK");
        $url = env('BAIDU_MAP_API_PREASE_GPS') ."?location=" .$gps . "&geotable_id=" .$geotable_id."&ak=".$ak;

        $response = curl_get($url);
        $data = json_decode($response,true);
        if (array_key_exists("status",$data) && $data["status"] == 0) {
               if (!array_key_exists("address_component",$data)) {
                   Log::Error("gis 地理位置不存在");
                   return "";
               }
            return $data["address_component"]["province"];
        } else {
            Log::Error("获取百度地图地理位置解析失败");
            Log::Info("响应结果".$response);
            Log::Info("请求url:".$url);
            return "";
        }

    }

    /**
     * 通过城市列表统计在每个地区（华南、华东...）所占的百分比
     * @param $provinces
     * @return array
     */
    public function provincesInAreaPer($provinces)
    {
        /**
         *
            华南地区：广东省、    广西壮族自治区、     海南省、    香港特别行政区、澳门特别行政区   //5
            华东地区：上海市、    江苏省、     浙江省、 江西省、 安徽省、福建省、台湾省、山东省 //8
            华北地区：北京市、    天津市、     河北省、        山西省  内蒙古自治区 //5
            华中地区：湖北省、    湖南省、     河南省 //3
            东北地区: 辽宁省、    吉林省、     黑龙江省 //3
            西北地区：陕西省、    甘肃省、      新疆维吾尔自治区 、青海省、宁夏回族自治区 // 5
            西南地区：四川省、    云南省、     重庆市、 贵州省、西藏自治区 // 5
         * total: 34
         */

        $areas = [
            'south_china'       => 0,
            'east_china'        => 0,
            'north_china'       => 0,
            'central_china'     => 0,
            'northeast'         => 0,
            'northwest'         => 0,
            'southwest'         => 0,
            'unknown'           => 0
        ];

        foreach ($provinces as $province) {
//            $province = $province["province"];
                if(in_array($province,array('广东省' ,'广西壮族自治区' ,'海南省','香港特别行政区','澳门特别行政区')))
                    $areas["south_china"] ++;
                elseif(in_array($province,array('上海市','江苏省','浙江省','江西省','安徽省','福建省','台湾省','山东省')))
                    $areas["east_china"] ++;
                elseif(in_array($province,array('北京市','天津市','河北省','山西省','内蒙古自治区')))
                    $areas["north_china"] ++;
                elseif(in_array($province,array('湖北省','湖南省','河南省')))
                    $areas["central_china"] ++;
                elseif(in_array($province,array('辽宁省','吉林省','黑龙江省')))
                    $areas["northeast"] ++;
                elseif(in_array($province,array('陕西省','甘肃省','新疆维吾尔自治区','青海省','宁夏回族自治区')))
                    $areas["northwest"] ++;
                elseif(in_array($province,array('四川省','云南省','重庆市','贵州省','西藏自治区')))
                    $areas["southwest"] ++;
                else
                    $areas["unknown"] ++;
        }
        // 统计计算
        return $areas;
//        return $this->percentagePartInAll($areas);
    }


    /**
     * 处理数组数据中每个元素占总元素的百分比
     * @param array $target
     * @return array
     */
    public function percentagePartInAll(array $target){

        $total = 0 ;
        foreach ($target as $value) {
            $total += $value;
        }
        // 当total为零的时候 每部分的百分比都为零
        if ($total == 0)    return $target;

        foreach ($target as $key => $value) {
            $target[$key] = round(($value/$total)*100)."%";
        }

        return $target;
    }

    /**
     * 格式化 equipment_ids 的数组
     * @param array $equipment_ids_array
     * @return string
     */
    public function formatEquipmentIds( array $equipment_ids_array)
    {

        /**
         *  eg:
         * array:16 [
                0 => array:1 [
                "equipment_id" => "equipment_0"
                ]
                1 => array:1 [
                "equipment_id" => "equipment_100"
                ]
            ]
         */
        $result ='';
        foreach ($equipment_ids_array as $key => $value) {
            if ($key == sizeof($equipment_ids_array)-1) {
                $result .='"'.$value["equipment_id"] .'"';
            } else {
                $result .='"'.$value["equipment_id"] .'",';
            }
        }
        return $result;
    }


    /**
     * 重组数据，转换数据格式
     * @param array $data
     * @param $interval //默认七天的数据
     * @return  array
     */
    public function recombinedData(array $data,$interval = 7)
    {
        $result = [
            'timeDate'=>get_recent_date_container_today($interval),
            'fault'=> [],
            'alert'=> [],
            'event'=> [],

        ];

        foreach ($data["fault"] as $value) {
            $result['fault'][$value->timeDay] = $value->number;
        }

        foreach ($data["alert"] as $value) {
                $result['alert'][$value->timeDay] = $value->number;
        }

        foreach ($data["event"] as $value) {
                $result['event'][$value->timeDay] = $value->number;
        }
        return $result;
    }


    /**
     * 获取时间间隔内 的日期 格式为 月/日 从当前日期往后推
     * @param $days //天数
     * @return array
     */
    public function getRecentDate($days) {
        $dates = [];
        if ($days <= 0 ) return $dates;

        for ($i=$days; $i>=1;$i--) {
            $dates[] = date('m/d', strtotime('-'. $i .' days')); //第i 天的日期、
        }

        return $dates;
    }

    /**
     * 设备与MIXIOT服务同步
     *
     * @param $url string
     * @param $data array
     * @return array
     */
    public function mixiotSync($url, $data)
    {
        $header = ['Content-Type: application/json'];
        $result = $this->httpPost($url, json_encode($data), $header);
        return json_decode($result, true);
    }

    /**
     * 设备与BOSS同步
     *
     * @param $url string
     * @param $data array
     * @return array
     */
    public function bossSync($url, $data)
    {
        $data['equipment_id'] = env('MIXIOT_ID').'.'.$data['equipment_id'];
        $header = ['Content-Type: application/json', env('ADMIN_BOSS_TOKEN')];
        $result = $this->httpPost($url, json_encode($data), $header);
        return json_decode($result, true);
    }
}