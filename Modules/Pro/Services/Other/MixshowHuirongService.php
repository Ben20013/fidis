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
 * Date : 2019-03-14
 * Author : LuoJiandong
 * Description : Mixshow Huirong Service.
 */
namespace Modules\Pro\Services\Other;
use Modules\Pro\Services\CommonService;
use \crodas\InfluxPHP\Client as InfluxClient;
class MixshowHuirongService extends CommonService
{
    protected $host;
    protected $port;
    protected $user;
    protected $pass;
    public $database;
    /**
     * 马赛克表 表前缀：mosaic_1001
     */
    protected $table_pre = 'mosaic_';
    public function __construct()
    {
        $this->host = env('INFLUXDB_HOST');
        $this->port = env('INFLUXDB_PORT');
        $this->user = env('INFLUXDB_USERNAME');
        $this->pass = env('INFLUXDB_PASSWORD');
        $this->database = env('INFLUXDB_DATABASE');
    }

    /**
     * 连接InfluxDB数据库
     */
    public function connectIfluxdb()
    {
        return new InfluxClient($this->host, $this->port, $this->user, $this->pass);
    }

    /**
     * 产气地区统计
     * @param $equipment array
     * @return array
     */
    public function getGasAreaDistribution($equipment)
    {
        /**
         *
        华南地区：广东省、    广西壮族自治区、     海南省、    香港特别行政区、澳门特别行政区   //5
        华东地区：上海市、    江苏省、     浙江省、 江西省、 安徽省、福建省、台湾省、山东省 // 8
        华北地区：北京市、    天津市、     河北省、        山西省  内蒙古自治区 //5
        华中地区：湖北省、    湖南省、     河南省 //3
        东北地区: 辽宁省、    吉林省、     黑龙江省 //3
        西北地区：陕西省、    甘肃省、      新疆维吾尔自治区 、青海省、宁夏回族自治区 // 5
        西南地区：四川省、    云南省、     重庆市、 贵州省、西藏自治区 // 5
         * total: 34
         */

        $areas = [
            'southChina'=>['value'=>0, 'name'=>'华南'],
            'eastChina'=>['value'=>0, 'name'=>'华东'],
            'northChina'=>['value'=>0, 'name'=>'华北'],
            'centralChina'=>['value'=>0, 'name'=>'华中'],
            'northEast'=>['value'=>0, 'name'=>'东北'],
            'northWest'=>['value'=>0, 'name'=>'西北'],
            'southWest'=>['value'=>0, 'name'=>'西南'],
            'other'=>['value'=>0, 'name'=>'其他']
        ];

        foreach ($equipment as $key=>$val) {
            $province = $val['province'];
            if(in_array($province, array('广东省' ,'广西壮族自治区' ,'海南省','香港特别行政区','澳门特别行政区')))
                $areas['southChina']['value'] += $val['total'];
            elseif(in_array($province, array('上海市','江苏省','浙江省','江西省','安徽省','福建省','台湾省','山东省')))
                $areas['eastChina']['value'] += $val['total'];
            elseif(in_array($province, array('北京市','天津市','河北省','山西省','内蒙古自治区')))
                $areas['northChina']['value'] += $val['total'];
            elseif(in_array($province, array('湖北省','湖南省','河南省')))
                $areas['centralChina']['value'] += $val['total'];
            elseif(in_array($province, array('辽宁省','吉林省','黑龙江省')))
                $areas['northEast']['value'] += $val['total'];
            elseif(in_array($province, array('陕西省','甘肃省','新疆维吾尔自治区','青海省','宁夏回族自治区')))
                $areas['northWest']['value'] += $val['total'];
            elseif(in_array($province, array('四川省','云南省','重庆市','贵州省','西藏自治区')))
                $areas['southWest']['value'] += $val['total'];
            else
                $areas['other']['value'] += $val['total'];
        }

        foreach ($areas as $key => $val){
            $areas[$key]['value'] =  sprintf("%01.2f", $val['value']);
        }
        return $areas;
    }

    /**
     * 获取每台设备年度运行时间
     *
     * @param array $equipment
     * @return array
     */
    public function equipmentTotalRunTime($equipment)
    {
        $this_year = gmdate('Y');
        $start_time = date('Y-01-01 00:00:00');
        $this_time = date('Y-m-d H:i:s');
        foreach ($equipment as $key=>$val){
            $equipment[$key]['total'] = 0;
            if($this_year == substr($val['created'],0,4)){
                $equipment[$key]['total'] = floor((strtotime($this_time)-strtotime($val['created']))/3600);
            }else{
                $equipment[$key]['total'] = floor((strtotime($this_time)-strtotime($start_time))/3600);
            }
        }
        return $equipment;
    }

    /**
     * 项目地区分类
     * @param $equipment array
     * @return array
     */
    public function projectAreaDistribution($equipment)
    {
        /**
         *
        华南地区：广东省、    广西壮族自治区、     海南省、    香港特别行政区、澳门特别行政区   //5
        华东地区：上海市、    江苏省、     浙江省、 江西省、 安徽省、福建省、台湾省、山东省 // 8
        华北地区：北京市、    天津市、     河北省、        山西省  内蒙古自治区 //5
        华中地区：湖北省、    湖南省、     河南省 //3
        东北地区: 辽宁省、    吉林省、     黑龙江省 //3
        西北地区：陕西省、    甘肃省、      新疆维吾尔自治区 、青海省、宁夏回族自治区 // 5
        西南地区：四川省、    云南省、     重庆市、 贵州省、西藏自治区 // 5
         * total: 34
         */
        $areas = [
            '华南'=>[],
            '华东'=>[],
            '华北'=>[],
            '华中'=>[],
            '东北'=>[],
            '西北'=>[],
            '西南'=>[],
            '其他'=>[]
        ];
        foreach ($equipment as $key=>$val) {
            $province = $val['province'];
            if(in_array($province, array('广东省' ,'广西壮族自治区' ,'海南省','香港特别行政区','澳门特别行政区')))
                $areas['华南'][] = ['id'=>$val['equipment_id'], 'title'=>$val['equipment_name'], 'list'=>$val['sub_arr']];
            elseif(in_array($province, array('上海市','江苏省','浙江省','江西省','安徽省','福建省','台湾省','山东省')))
                $areas['华东'][] = ['id'=>$val['equipment_id'], 'title'=>$val['equipment_name'], 'list'=>$val['sub_arr']];
            elseif(in_array($province, array('北京市','天津市','河北省','山西省','内蒙古自治区')))
                $areas['华北'][] = ['id'=>$val['equipment_id'], 'title'=>$val['equipment_name'], 'list'=>$val['sub_arr']];
            elseif(in_array($province, array('湖北省','湖南省','河南省')))
                $areas['华中'][] = ['id'=>$val['equipment_id'], 'title'=>$val['equipment_name'], 'list'=>$val['sub_arr']];
            elseif(in_array($province, array('辽宁省','吉林省','黑龙江省')))
                $areas['东北'][] = ['id'=>$val['equipment_id'], 'title'=>$val['equipment_name'], 'list'=>$val['sub_arr']];
            elseif(in_array($province, array('陕西省','甘肃省','新疆维吾尔自治区','青海省','宁夏回族自治区')))
                $areas['西北'][] = ['id'=>$val['equipment_id'], 'title'=>$val['equipment_name'], 'list'=>$val['sub_arr']];
            elseif(in_array($province, array('四川省','云南省','重庆市','贵州省','西藏自治区')))
                $areas['西南'][] = ['id'=>$val['equipment_id'], 'title'=>$val['equipment_name'], 'list'=>$val['sub_arr']];
            else
                $areas['其他'][] = ['id'=>$val['equipment_id'], 'title'=>$val['equipment_name'], 'list'=>$val['sub_arr']];
        }
         // 删除空值数据
         foreach ($areas as $key => $val){
             if(!$val){
                 unset($areas[$key]);
             }
         }
        return $areas;
    }

    /**
     * 设备按设备组分类
     * @param $equipment array
     * @return array
     */
    public function equipmentClassify($equipment)
    {
        $data = [];
        foreach ($equipment as $key => $val){
            if($val['is_group'] == 0){
                continue;
            }
            $val['sub_equipment'] = explode(',', $val['sub_equipment']);
            $val['sub_equipment'] = array_filter($val['sub_equipment']);
            $data[] = $val;
        }
        foreach ($data as $key => $val){
            $data[$key]['sub_arr'] = [];
            foreach ($equipment as $ekey => $eval){
                if(in_array($eval['equipment_id'], $val['sub_equipment'])){
                    $data[$key]['sub_arr'][] = [$eval['equipment_id'], $eval['equipment_name']];
                }
            }
        }
        return $data;
    }
}
