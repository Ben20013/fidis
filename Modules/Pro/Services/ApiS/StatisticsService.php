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
 * Date : 2019-03-12
 * Author : LuoJiandong
 * Description : Admin Statistics Service.
 */
namespace Modules\Pro\Services\ApiS;
use Modules\Pro\Services\CommonService;
use Modules\Pro\Models\AdminStatosCurrentYearModel;
use Modules\Pro\Models\AdminStatosDayModel;
use Modules\Pro\Models\AdminStatosModel;
use Modules\Pro\Models\AdminStatosMonthModel;
use Modules\Pro\Models\AdminStatosWeekModel;
use Modules\Pro\Models\AdminStatosYearModel;
use Modules\Pro\Models\AdminStatosCurrentDayModel;
use Modules\Pro\Models\AdminStatosCurrentMonthModel;
use Modules\Pro\Models\AdminStatosSummaryModel;
use DB,Excel;
use Exception;
use Error;

class StatisticsService extends CommonService
{
    public $mustSelect = ['data']; // 必选查询的字段
    private  $whereData; // 查询数据
    private  $statistics_id; //统计计算标识
    private  $equipment_id; //查询的设备id
    private  $table_prefix = 'admin_statos'; //分表前缀

    /********************************excel-part**********************************/
    public $excel_path;
    public $excel_width = [
        'hour'  =>  ['A'=>24, 'B'=> 55, 'C'=>20, 'D'=>10, 'E'=>8, 'F'=>8, 'G'=>8, 'H'=>15, 'I'=>26],
        'day'   =>  ['A'=>24, 'B'=> 55, 'C'=>20, 'D'=>10, 'E'=>8, 'F'=>8, 'G'=>15, 'H'=>26],
        'month' =>  ['A'=>24, 'B'=> 55, 'C'=>20, 'D'=>10, 'E'=>8, 'F'=>15, 'G'=>26],
        'year'  =>  ['A'=>24, 'B'=> 55, 'C'=>20, 'D'=>10, 'E'=>15, 'F'=>26,],
        'currentDay'    => ['A'=>24, 'B'=> 55, 'C'=>20, 'D'=>10, 'E'=>8, 'F'=>8, 'G'=>8, 'H'=>26,],
        'currentMonth'  => ['A'=>24, 'B'=> 55, 'C'=>20, 'D'=>10, 'E'=>8, 'F'=>15, 'G'=>26,],
        'currentYear'   => ['A'=>24, 'B'=> 55, 'C'=>20, 'D'=>10, 'E'=>15, 'F'=>26,],
        'total' => ['A'=>24, 'B'=> 55, 'C'=>20, 'D'=>15, 'E'=>26,]
    ];
    public $relative_excel_path;
    /********************************excel-part**********************************/

    /**
     * 根据timeFlag  year|month|week|day|hour 查询不同表里面的数据
     * @param $statistics_id
     * @param $equipment_id
     * @param $time_flag
     * @param $time_value
     * @return array
     */
    public function returnDataByTimeFlag($statistics_id,$equipment_id,$time_flag,$time_value)
    {

        if (!is_array($statistics_id)) {
            $this->statistics_id = [$statistics_id];
        } else {
            $this->statistics_id = $statistics_id;
        }
        $this->equipment_id = $equipment_id;
        switch ($time_flag) {
            case "hour":
                $selectField = [
                    "year",
                    "month",
                    "day",
                    "hour",
                    "statistics_id",
                    "created",
                ];
                $this->whereData  = $this->dealHourValue($time_value);
                // $data = $this->getHourDataBySub($selectField);
                $data = $this->getHourData($selectField);
                break;
            case "day":
                $selectField = [
                    "year",
                    "month",
                    "day",
                    "statistics_id",
                    "created",
                ];
                $this->whereData  = $this->dealDayValue($time_value);
                $data = $this->getDayData($selectField);
                break;
            case "week":
                $selectField = [
                    "year",
                    "week",
                    "statistics_id",
                    "created",

                ];
                $this->whereData  = $this->dealWeekValue($time_value);
                $data = $this->getWeekData($selectField);
                break;
            case "month":
                $selectField = [
                    "year",
                    "month",
                    "statistics_id",
                    "created",

                ];
                $this->whereData  = $this->dealMonthValue($time_value);
                $data = $this->getMonthData($selectField);
                break;
            case "year":
                $selectField = [
                    "year",
                    "statistics_id",
                    "created",
                ];
                $this->whereData  = $this->dealYearValue($time_value);
                $data = $this->getYearData($selectField);
                break;
            default:
                $data = [];
        }
        return $data;
    }

    /**
     * 根据日期获取统计数据 列如 2018-09 获取九月份数数据 2018-02-03 获取 2月3号的数据
     * @param $equipment_id
     * @param $statistics_id
     * @param $date
     * @return array|mixed
     */
    public function returnDataByDate($equipment_id,$statistics_id,$date)
    {

        if (!is_array($statistics_id)) {
            $this->statistics_id = [$statistics_id];
        } else {
            $this->statistics_id = $statistics_id;
        }
        $this->equipment_id = $equipment_id;

        $dates  = $this->dealDateValue($date);
        $data = [];
        foreach ($dates as $k => $v) {
            $this->whereData  = [$k=>$v];
            switch ($k) {
                case "hour":
                    $selectField = [
                        "year",
                        "month",
                        "day",
                        "hour",
                        "statistics_id",
                        "created",
                    ];
                    $data[] = $this->getHourData($selectField);
                    break;
                case "day":
                    $selectField = [
                        "year",
                        "month",
                        "day",
                        "statistics_id",
                        "created",
                    ];
                    $data[] = $this->getDayData($selectField);
                    break;
                case "month":
                    $selectField = [
                        "year",
                        "month",
                        "statistics_id",
                        "created",

                    ];
                    $data[] = $this->getMonthData($selectField);
                    break;
                case "year":
                    $selectField = [
                        "year",
                        "statistics_id",
                        "created",
                    ];
                    $data[] = $this->getYearData($selectField);
                    break;
            }
        }
        return $data;
    }

    public function  dealDateValue($date)
    {
        if ( strpos($date,",") != false ) {
            $date = explode(",",$date);
        } else {
            $date = [$date];
        }
        $result = [];
        foreach ($date as  $value) {
            $tmp = explode("-",$value);
            switch (count($tmp)) {
                case  1 :
                    $result["year"][] = $tmp;
                    break;
                case 2 :
                    $result["month"][$tmp[0]][] = $tmp[1];
                    break;
                case 3 : // 2018 -  01  - 01  || 2018 -  01  - 01 11
                    $t = explode(" ",$tmp[2]);
                    if (count($t) == 1) {
                        $result["day"][$tmp[0]][$tmp[1]][] = $tmp[2];
                    } else {
                        $result["hour"][$tmp[0]][$tmp[1]][$t[0]][] = $t[1];
                    }
                    break;
            }
        }
        return $result;
    }

    /**
     * 将小时数转换为实际要查询的条件
     * @param $hourNum
     * @return mixed
     */
    public function dealHourValue($hourNum)
    {
        $year = date("Y");
        $month = date("m");
        $today = date("d");
        $hour = date("H");

        // 判断小时数是否大于当前的点数  如果小于如果小于则说明时间没有超出今天的范围
        if ( ($diffHour = $hourNum - $hour) <= 0) {
            //时间就在今天范围-- 获取今天小时 点数的数组
            if ($hourNum == 0) {
                $yearsMonthsDaysHours["hour"][$year][$month][$today] = [$hour];
            } else {
                $yearsMonthsDaysHours["hour"][$year][$month][$today] = reverse_number_to_array($hour-$hourNum,$hour-1);
            }
        } else {
            $yearsMonthsDaysHours["hour"][$year][$month][$today] = reverse_number_to_array(0,$hour);
            $dayNum = floor($diffHour / 24); //折合成天数
            $afterHour = $diffHour - $dayNum*24; // 余下的小时数

            //判断天数是否大于当前的天数，如果大于说明时间已经超出了本月的时间,每月的天数，然后往后推算出月数和年数
            if (($remainingDay =  $dayNum - $today) > 0) {//是否大于本月过去的天数，计算出用于递减的天数
                //此时 $remainingDay 是大于本月的天数

                $yearsMonthsDaysHours = $this->recursionGetLastMonthTimes($remainingDay,$month,$year,[]);
                // 得到 最前一天
                $foremostYear =  $yearsMonthsDaysHours["foremost"][0];
                $foremostMonth =  $yearsMonthsDaysHours["foremost"][1];
                $foremostDay =  $yearsMonthsDaysHours["foremost"][2];
                $yearsMonthsDaysHours["day"][$year][$month] = reverse_number_to_array(1,$today);
                //$today-$dayNum,$today
                // 获取最前一天的小时点数数组
                if ($afterHour) {
                    $yearsMonthsDaysHours["hour"][$foremostYear][$foremostMonth][$foremostDay] = reverse_number_to_array(23-$afterHour+1,23);
                }
            } else {
                //说明时间就在当月 究竟多少天
                $days =  reverse_number_to_day($today,$dayNum+2); //加上前后两天
                if ($afterHour) {
                    $yearsMonthsDaysHours["hour"][$year][$month][$days[count($days)-1]] =  reverse_number_to_array(23-$afterHour+1,23);
                }
                array_shift($days);
                array_pop($days);
                // 取中间值存储
                count($days) > 0 ? $yearsMonthsDaysHours["day"][$year][$month] = $days : "";
            }
        }
        return $yearsMonthsDaysHours;

    }


    /**
     * 将天数转换为实际要查询的条件
     * @param $dayNum
     * @return mixed
     */
    public function dealDayValue($dayNum)
    {
        $year = date("Y");
        $month = date("m");
        $today = date("d");

        if (( $remainingDay = $dayNum - $today) >=0) {  //超出当前月月份的天数
            //将当前月份的天数存入数组中
            //然后往后推算出月数和年数
            // 判断是否到前一年了
            $yearsMonthsDays = $this->recursionGetLastMonthTimes($remainingDay,$month,$year,[]);
            unset($yearsMonthsDays["foremost"]);
            if ($today - 1 != 0 ) {
                $yearsMonthsDays["day"][$year][$month] = reverse_number_to_array(1,$today-1);
            }
        } else {
            // 今天不包含在内
            // $today-1 不包含今天、$today-$dayNum 表示 取多少天
            $yearsMonthsDays["day"][$year][$month] = reverse_number_to_array($today-$dayNum,$today);
        }
        return $yearsMonthsDays;
    }

    /**
     * 递归处理时间天数
     * @param $remainingDay
     * @param $month
     * @param $year
     * @param $result
     * @return mixed
     */
    public function recursionGetLastMonthTimes ($remainingDay,$month,$year,$result)
    {
        if ($month -1 == 0) { // 说明已经到了12月份
            $month = 12;
            $year--;
            if ($remainingDay > get_year_days($year)) {
                $remainingDay = $remainingDay - get_year_days($year);
                $result["year"][] = $year;
                $year--;
            }
        } else {
            $month --;
        }
        try{
            //在计算某个月中的天数时，由于PHP编译时没有加上--enable-calendar选项，会导致cal_days_in_month方法不可用
            $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        }catch (Exception $e){
            //替代方法
            $days = date('t', strtotime("$year-$month"));
        }catch(Error $e){
            //替代方法
            $days = date('t', strtotime("$year-$month"));
        }

        // 此天数是大于本月天数的
        if (($remainingDayNext = $remainingDay - $days) > 0 ) { // 大于这个月的天数
            $result["month"][$year][] = $month;
            return $this->recursionGetLastMonthTimes ($remainingDayNext,$month,$year,$result);
        } else {
            //获取最前面一天的小时点数
            $monthDays = get_each_days_by_year_month($year,$month);
            $result["day"][$year][$month] = array_slice($monthDays,$days-$remainingDay-1,$remainingDay+1);
        }
        $result["foremost"] =  [$year,$month,$days];
        return $result;
    }

    /**
     * 查询一小时为单位的统计数据
     * @param $selectField
     * @return mixed
     */
    public function getHourData($selectField)
    {
        $model =  AdminStatosModel::where("is_available",1)
            ->where("equipment_id",$this->equipment_id)
            ->orderBy("created","desc");

        $model =  $model->whereIn("statistics_id",$this->statistics_id);
        $whereData = $this->whereData;
        $model = $model->where(function ($model) use ($whereData){
            foreach ($whereData as $key => $value) {
                switch ($key) {
                    case "year" :
                        $model =  $model->orWhereIn("year",$value);
                        break;
                    case "month" :
                        foreach ($value as $year => $month) {
                            $model = $model->orWhere(function ($query) use ($year,$month){
                                $query->where("year",$year)->whereIn("month",$month);
                            });
                        }
                        break;
                    case "day" :
                        foreach ($value as $year => $mv) {
                            foreach ($mv as  $month => $days) {
                                $model = $model->orWhere(function ($query) use ($year,$month,$days){
                                    $query->where("year",$year)
                                        ->where("month",$month)
                                        ->whereIn("day",$days);
                                });
                            }
                        }
                        break;
                    case "hour" :
                        foreach ($value as $year => $mv) {
                            foreach ($mv as  $month => $dv) {
                                foreach ($dv as $day => $hours) {
                                    $model = $model->orWhere(function ($query) use ($year,$month,$day,$hours){
                                        $query->where("year",$year)
                                            ->where("month",$month)
                                            ->where("day",$day)
                                            ->whereIn("hour",$hours);
                                    });
                                }
                            }
                        }
                        break;
                }

            }
        });

        $finalSelectField = array_merge($selectField,$this->mustSelect);

        $model =  $model->get(
            $finalSelectField //最终要查询的字段
        )->groupBy('statistics_id');//,'year','day','hour'
        $data = $model->toArray();

        foreach ($data as &$v) {
            $v = remove_repeat_by_factor($v,"hour",array("year","month","day","hour"));
        }
        $data = $this->orderByKey($data,"hour");
        return $data;
    }

    public function  orderByKey($data,$sign)
    {
        $result = [];
        foreach ($data as $key => $value) {
            $result[$key] = $this->orderByKeyPart2($value,$sign);
        }
        return $result;

    }

    /**
     * 排序
     * @param $value | 排序的对象
     * @param $sign | year|month|week|day|hour
     * @param string $sort | asc|desc
     * @return array
     */
    public function orderByKeyPart2($value,$sign,$sort="asc") {
        $result = array();
        foreach ($value as $k=>$v) {
            switch ($sign) {
                case "year":
                    $result[$k]["sort"] = mktime(0,0,0,0,0,$v["year"]);
                    $result[$k]["year"] = $v ["year"];
                    break;
                case "month":
                    $result[$k]["sort"] = mktime(0,0,0,$v["month"],0,$v["year"]);
                    $result[$k]["year"] = $v ["year"];
                    $result[$k]["month"] = $v ["month"];
                    // $result[$k]["day"] = $v ["day"];
                    break;
                case "week":
                    $result[$k]["sort"] = mktime(0,0,$v["week"],0,0,$v["year"]);
                    $result[$k]["year"] = $v ["year"];
                    $result[$k]["month"] = $v ["week"];
                    break;
                case "day":
                    if (isset($v["year"])) {
                        $result[$k]["sort"] = mktime(0,0,0,$v["month"],$v["day"],$v["year"]);
                        $result[$k]["year"] = $v ["year"];
                    } else {
                        $result[$k]["sort"] = mktime(0,0,0,$v["month"],$v["day"],0);
                    }
                    $result[$k]["month"] = $v ["month"];
                    $result[$k]["day"] = $v ["day"];
                    break;
                case "hour":
                    $result[$k]["sort"] = mktime($v["hour"],0,0,$v["month"],$v["day"],$v["year"]);
                    $result[$k]["year"] = $v ["year"];
                    $result[$k]["month"] = $v ["month"];
                    $result[$k]["day"] = $v ["day"];
                    $result[$k]["hour"] = $v ["hour"];
                    break;
            }
            $result[$k]["data"] = $v ["data"];
            if (isset($v["statistics_id"])) {
                $result[$k]["statistics_id"] = $v ["statistics_id"];
            }
        }

        $t = array_column($result,"sort");
        if ($sort == "asc") {
            array_multisort($t,SORT_ASC,$result);
        } else {
            array_multisort($t,SORT_DESC,$result);
        }
        return $result;
    }

    /**
     * 分表查询小时数据
     * @param $prefix_table
     * @param string $start_time
     * @param string $end_time
     * @return array
     */
    public function subTableByMonth($prefix_table,$start_time ="",$end_time="")
    {
        $table = array();
        empty($end_time) ? $end_time = date("Y-m") : "";
        if (!$start_time && array_key_exists("foremost",$this->whereData)) {
            $start_time =$this->whereData["foremost"][0] . "-" . $this->whereData["foremost"][1];
            $months = get_months_in_time_interval($start_time,$end_time);
            foreach ($months as $value ) {
                $table[$value] = $prefix_table . "_" .$value;
            }
        } else {
            $end_time = str_replace("-","",$end_time);
            if (strlen($end_time) < 4) {
                $end_time = substr_replace($end_time, 0, 2, 0);
            }
            $table[$end_time] = $prefix_table . "_" .$end_time;
        }
        return $table;

    }

    /**
     * 查询以天数为单位的统计数据
     * @param $selectField
     * @return mixed
     */
    public function getDayData($selectField)
    {
        $model =  AdminStatosDayModel::where("is_available",1)
            ->where("equipment_id",$this->equipment_id)
            ->orderBy("created","desc");
        $model =  $model->whereIn("statistics_id",$this->statistics_id);

        $whereData = $this->whereData;
        $model = $model->where(function ($model) use ($whereData){
            foreach ($whereData as $key => $value) {
                switch ($key) {
                    case "year" :
                        $model =  $model->orWhereIn("year",$value);
                        break;
                    case "month" :
                        foreach ($value as $year => $month) {
                            foreach ($month as $mv) {
                                $model = $model->orWhere(function ($query) use ($year,$mv){
                                    $query->where("year",$year)->where("month",$mv);
                                });
                            }
                        }
                        break;
                    case "day" :
                        foreach ($value as $year => $mv) {
                            foreach ($mv as  $month => $days) {
                                $model = $model->orWhere(function ($query) use ($year,$month,$days){
                                    $query->where("year",$year)
                                        ->where("month",$month)
                                        ->whereIn("day",$days);
                                });
                            }
                        }
                        break;
                }

            }
        });

        $finalSelectField = array_merge($selectField,$this->mustSelect);
        $model =  $model->get(
            $finalSelectField //最终要查询的字段
        )->groupBy('statistics_id');
        $data = $model->toArray();
        foreach ($data as &$v) {
            $v = remove_repeat_by_factor($v,"day",array("year","month","day"));
        }
        $data = $this->orderByKey($data,"day");
        return $data;
    }

    /**
     * 将周数转换符合查询条件的数组
     * @param $weekNum
     * @return mixed
     */
    public function dealWeekValue($weekNum)
    {
        $year = date("Y");
        //目前处于第几周
        $week = date("W");

        // 判断是否是今年的范围
        if (($RemainingWeek =  $weekNum-$week) > 0) {
            // 否 （今年+周） +（某后年+ 某周 ）+ （某整年）
            //（今年+周）
            $yearsWeeks["week"][$year] =   reverse_number_to_array(1,$week-1);
            //递归,计算出某周的日期
            $yearNum = floor($RemainingWeek / 52);
            if ($yearNum >0 ) {
                for ($y = 1; $y <= $yearNum; $y++) {
                    //（某整年）
                    $yearsWeeks["year"][] = $year-$y;
                }
                $RemainingWeek = $RemainingWeek - $yearNum*52;
                $year = $year - $yearNum-1;
            } else {
                $year = $year - 1;
            }
            $yearsWeeks["week"][$year] =   reverse_number_to_array(52-$RemainingWeek,52);
        } else {
            // 是（今年加某周）
            $yearsWeeks["week"][$year] =   reverse_number_to_array($week-$weekNum,$week-1);

        }
        return $yearsWeeks;
    }

    /**
     * 查询以周数为单位的统计数据
     * @param $selectField
     * @return mixed
     */
    public function getWeekData($selectField)
    {
        $model =  AdminStatosWeekModel::where("is_available",1)
            ->where("equipment_id",$this->equipment_id)
            ->orderBy("created","desc");
        $model =  $model->whereIn("statistics_id",$this->statistics_id);

        $whereData = $this->whereData;
        $model = $model->where(function ($model) use ($whereData){
            foreach ($whereData as $key => $value) {
                switch ($key) {
                    case "year" :
                        $model =  $model->orWhereIn("year",$value);
                        break;
                    case "week" :
                        foreach ($value as $year => $week) {
                            $model = $model->orWhere(function ($query) use ($year,$week){
                                $query->where("year",$year)->whereIn("month",$week);
                            });
                        }
                        break;
                }
            }
        });

        $finalSelectField = array_merge($selectField,$this->mustSelect);
        $model =  $model->get(
            $finalSelectField //最终要查询的字段
        )->groupBy("statistics_id");

        $data = $model->toArray();
        foreach ($data as &$v) {
            $v = remove_repeat_by_factor($v,"week",array("year","week"));
        }
        $data = $this->orderByKey($data,"week");
        return $data;
    }

    /**
     * 将月数转换符合查询条件的数组
     * @param $monthNum
     * @return mixed
     */
    public function dealMonthValue($monthNum)
    {
        $year = date("Y");
        $month = date("m");

        // 判断是否是今年的范围
        if (($remaining =  $monthNum-$month) >= 0) {
            // 否 （今年+月） +（某后年+ 某月 ）+ （某整年）
            //（今年+月）
            $yearsMonth["month"][$year] =   reverse_number_to_array(1,$month-1);
            $yearNum = floor($remaining / 12);
            if ($yearNum >0 ) {
                for ($y = 1; $y <= $yearNum; $y++) {
                    //（某整年）
                    $yearsMonth["year"][] = $year-$y;
                }
                $remaining = $remaining - $yearNum*12;
                $year = $year - $yearNum-1;
            } else {
                $year = $year - 1;
            }
            $yearsMonth["month"][$year] =   reverse_number_to_array(12-$remaining,12);
        } else {
            if ($monthNum == 0) {
                $yearsMonth["month"][$year] = [$month];
            } else {
                $yearsMonth["month"][$year] =   reverse_number_to_array($month-$monthNum,$month-1);//不包含本月
            }
        }
        return $yearsMonth;
    }

    /**
     * 获取月有关的统计数据
     * @param $selectField
     * @return mixed
     */
    public function getMonthData($selectField)
    {
        $model =  AdminStatosMonthModel::where("is_available",1)
            ->where("equipment_id",$this->equipment_id)
            ->orderBy("created","desc");

        $model =  $model->whereIn("statistics_id",$this->statistics_id);


        $whereData = $this->whereData;
        $model = $model->where(function ($model) use ($whereData){
            foreach ($whereData as $key => $value) {
                switch ($key) {
                    case "year" :
                        $model =  $model->orWhereIn("year",$value);
                        break;
                    case "month" :
                        foreach ($value as $year => $month) {
                            $model = $model->orWhere(function ($query) use ($year,$month){
                                $query->where("year",$year)->whereIn("month",$month);
                            });
                        }
                        break;
                }
            }
        });

        $finalSelectField = array_merge($selectField,$this->mustSelect);
        $model =  $model->get(
            $finalSelectField //最终要查询的字段
        )->groupBy("statistics_id");

        $data = $model->toArray();
        foreach ($data as &$v) {
            $v = remove_repeat_by_factor($v,"month",array("year","month"));
        }

        $data = $this->orderByKey($data,"month");
        return $data;
    }

    /**
     * 将年数处理符合查询条件的数据格式
     * @param $yearNum
     * @return array
     */
    public function dealYearValue($yearNum)
    {
        $year = date("Y");
        $years =  [];
        for ($y = 0;$y<$yearNum;$y++) {
            $years[] = $year - $y;
        }
        return $years;
    }

    /**
     * 获取年有关的数据
     * @param $selectField
     * @return mixed
     */
    public function getYearData($selectField)
    {
        $model =  AdminStatosYearModel::where("is_available",1)
            ->where("equipment_id",$this->equipment_id)
            ->orderBy("created","desc");

        $model =  $model->whereIn("statistics_id",$this->statistics_id);


        $model =  $model->WhereIn("year",$this->whereData);

        $finalSelectField = array_merge($selectField,$this->mustSelect);
        $model =  $model->get(
            $finalSelectField //最终要查询的字段
        )->groupBy("statistics_id");

        $data = $model->toArray();
        foreach ($data as &$v) {
            $v = remove_repeat_by_factor($v,"year",array("year"));
        }
        $data = $this->orderByKey($data,"year");
        return $data;
    }

    /**
     * 获取今天的数据
     * @param $equipment_id
     * @param $statistics_id
     * @return array
     */
    public function returnTodayData($equipment_id,$statistics_id)
    {
        $hour = date("H");
        //统计计算标识
        if (!is_array($statistics_id)) {
            $this->statistics_id = [$statistics_id];
        } else {
            $this->statistics_id = $statistics_id;
        }
        $this->equipment_id = $equipment_id; //查询的设备id
        $this->whereData  = $this->dealHourValue($hour);
        $selectField = [
            "year",
            "month",
            "day",
            "hour",
            "statistics_id",
        ];
        $data = $this->getHourData($selectField);
        $result = [];
        foreach ($data as $statistics => $value) {
            $count = 0;
            foreach ($value as $v) {
                if (!is_numeric($v["data"])) continue;
                $count += $v["data"];
            }
            $count = number_format($count,3);
            $result[$statistics] =$count;
        }
        return $result;

    }

    /**
     * 获取本月的数据
     * @param $equipment_id
     * @param $statistics_id
     * @return array
     */
    public function returnCurrentMonthData($equipment_id,$statistics_id)
    {
        $day = date("d");
        //统计计算标识
        if (!is_array($statistics_id)) {
            $this->statistics_id = [$statistics_id];
        } else {
            $this->statistics_id = $statistics_id;
        }
        $this->equipment_id = $equipment_id; //查询的设备id
        $dayNum = $day-1; // 今天不包含在内,所以 取的天数为$day-1
        $this->whereData  = $this->dealDayValue($dayNum);
        $selectField = [
            "year",
            "month",
            "day",
            "statistics_id",
        ];

        $data = $this->getDayData($selectField);
        $result = [];

        foreach ($data as $statistics => $value) {
            $count = 0;
            foreach ($value as $v) {
                if (!is_numeric($v["data"])) continue;
                $count += $v["data"];
            }
            $count = number_format($count,3,".","");
            $result[$statistics] =$count;
        }
        return $result;

    }

    /**
     * 获取一段时间内的统计结果集
     * @param $statistics_id
     * @param $equipment_id
     * @param $timeFlag
     * @return mixed
     */
    function getPeriodStatistics($statistics_id,$equipment_id,$timeFlag) {

        switch ($timeFlag) {
            case "month":
                $result = $this->getPeriodMonth($statistics_id,$equipment_id);
                break;
            case "week":
                $result = $this->getPeriodWeek($statistics_id,$equipment_id);
                break;
            default:
                $result = [];
        }

        return $result;
    }

    /**
     * 处理本|上月数据
     * @param $statistics_id
     * @param $equipment_id
     * @return mixed
     */
    public function getPeriodMonth($statistics_id,$equipment_id)
    {
        $currentMonth = date("m");
        $currentYear = date("Y");
        $timestamp=strtotime( date("Y-m"));
        $lastMonth=date('Y-m',strtotime(date('Y',$timestamp).'-'.(date('m',$timestamp)-1)));
        $lastTime = explode("-",$lastMonth);
        $model  = (new AdminStatosDayModel());

        $lastResult = $model->getPeriodMonth($equipment_id,$statistics_id,$lastTime[0],$lastTime[1]);
        $currentResult = $model->getPeriodMonth($equipment_id,$statistics_id,$currentYear,$currentMonth);
        $result = [];
        $result["last"] = $this->dealPeriodFormat($lastResult);
        $result["current"] = $this->dealPeriodFormat($currentResult);
        return $result;

    }

    /**
     * 处理本|上周数据
     * @param $statistics_id
     * @param $equipment_id
     * @return mixed
     */
    public function getPeriodWeek($statistics_id,$equipment_id)
    {
        $day_in_week = get_day_week()["week_day"];
        $cul_day = $day_in_week -1; // 用于计算的天数, 本周的上一天+ 上周的七天的时间
        $currentTime = get_recent_date($cul_day,'m^d');
        $lastTime =get_recent_date(7,'m^d',$cul_day);
        $model  = (new AdminStatosDayModel());
        $lastResult = $model->getPeriodWeek($equipment_id,$statistics_id,$lastTime);
        $currentResult = $model->getPeriodWeek($equipment_id,$statistics_id,$currentTime);
        $result = [];
        $result["last"] = $this->orderByKeyPart2($lastResult,"day");
        $result["current"] = $this->orderByKeyPart2($currentResult,"day");
        return $result;

    }

    /**
     * 将时间格式化成 m-d 格式
     * @param $data
     * @return mixed
     */
    public function dealPeriodFormat($data)
    {
        $result = [];
        $data = $this->orderByKeyPart2($data,"day");
        foreach ($data as $k=>$v) {
            if (empty($v["month"]) || empty($v["day"])) continue;
            $result[$k]["created"] = $v["month"] . "-" .$v["day"];
            $result[$k]["data"] = $v["data"];
        }
        return $result;
    }

    /**
     * 获取累积数据
     * @param $timeFlg
     * @param $equipment_id
     * @param $statistics_id
     * @return array
     */
    public function getAggregate($timeFlg,$equipment_id,$statistics_id)
    {
        switch ($timeFlg) {
            case "day":
                $result = $this->getAggregateDay($equipment_id,$statistics_id);
                break;
            case "month":
                $result = $this->getAggregateMonth($equipment_id,$statistics_id);
                break;
            case "year":
                $result = $this->getAggregateYear($equipment_id,$statistics_id);
                break;
            case "total":
                $result = $this->getAggregateTotal($equipment_id,$statistics_id);
                break;
            default:
                $result = [];
        }
        return $result;
    }

    public function getAggregateDay($equipment_id,$statistics_id,$selectField=["data","statistics_id"]){
        $data = AdminStatosCurrentDayModel::where("is_available",1)
            ->where("year",date("Y"))
            ->where("month",date("m"))
            ->where("day",date("d"))
            ->where("equipment_id",$equipment_id)
            ->whereIn("statistics_id",$statistics_id)
            ->get($selectField)
            ->groupBy("statistics_id")->toArray();
        $result = [];
        foreach ($data as $key => $value) {
            foreach ($value as $k => $v) {
                $v["data"] = isset($v["data"]) ? $v["data"] : 0;
                $result[$key] = $v["data"];
            }
        }
        return $result;
    }

    public function getAggregateMonth($equipment_id,$statistics_id,$selectField=["data","statistics_id"]){
        $data = AdminStatosCurrentMonthModel::where("is_available",1)
            ->where("year",date("Y"))
            ->where("month",date("m"))
            ->where("equipment_id",$equipment_id)
            ->whereIn("statistics_id",$statistics_id)
            ->get($selectField)
            ->groupBy("statistics_id")->toArray();
        $result = [];
        foreach ($data as $key => $value) {
            foreach ($value as $k => $v) {
                $v["data"] = isset($v["data"]) ? $v["data"] : 0;
                $result[$key] = $v["data"];
            }
        }
        return $result;
    }

    public function getAggregateYear($equipment_id,$statistics_id,$selectField=["data","statistics_id"]){
        $data = AdminStatosCurrentYearModel::where("is_available",1)
            ->where("year",date("Y"))
            ->where("equipment_id",$equipment_id)
            ->whereIn("statistics_id",$statistics_id)
            ->get($selectField)
            ->groupBy("statistics_id")->toArray();
        $result = [];
        foreach ($data as $key => $value) {
            foreach ($value as $k => $v) {
                $v["data"] = isset($v["data"]) ? $v["data"] : 0;
                $result[$key] = $v["data"];
            }
        }
        return $result;
    }

    public function getAggregateTotal($equipment_id,$statistics_id,$selectField=["data","statistics_id"]){
        $data = AdminStatosSummaryModel::where("is_available",1)
            ->where("equipment_id",$equipment_id)
            ->whereIn("statistics_id",$statistics_id)
            ->get($selectField)
            ->groupBy("statistics_id")->toArray();
        $result = [];
        foreach ($data as $key => $value) {
            foreach ($value as $k => $v) {
                $v["data"] = isset($v["data"]) ? $v["data"] : 0;
                $result[$key] = $v["data"];
            }
        }
        return $result;
    }

    public function  CreateExcel($equipment_id,$statistics_id,$type,$page_index,$page_size) {

        if ( strpos($type,",") != false ) {
            $type = explode(",",$type);
        } else {
            $type = [$type];
        }
        $page_index = $page_index ? $page_index : 1;
        $page_size = $page_size ? $page_size : 15;
        // 查询字段
        $selectFields = [
            "hour"=> ["statistics_id","statos_name","equipment_id","year","month","day","hour","data","created"],
            "day"=> ["statistics_id","statos_name","equipment_id","year","month","day","data","created"],
            "month"=> ["statistics_id","statos_name","equipment_id","year","month","data","created"],
            "year"=> ["statistics_id","statos_name","equipment_id","year","data","created"],
            "currentDay"=> ["statistics_id","statos_name","equipment_id","year","month","day","data","created"],
            "currentMonth"=> ["statistics_id","statos_name","equipment_id","year","month","data","created"],
            "currentYear"=> ["statistics_id","statos_name","equipment_id","year","data","created"],
            "total"=> ["statistics_id","statos_name","equipment_id","data","created"],
        ];
        $excelData = $this->organizeExcelData($equipment_id,$statistics_id,$type,$page_index,$page_size,$selectFields);
        // 标题
        $titles = [
            "hour" => ["统计计算编号", "统计计算名称","设备编号","年","月","日","小时","结果","计算时间"],
            "day" => ["统计计算编号", "统计计算名称","设备编号","年","月","日","结果","计算时间"],
            "month" => ["统计计算编号", "统计计算名称","设备编号","年","月","结果","计算时间"],
            "year" => ["统计计算编号", "统计计算名称","设备编号","年","结果","计算时间"],
            "currentDay" => ["统计计算编号", "统计计算名称","设备编号","年","月","日","结果","计算时间"],
            "currentMonth" => ["统计计算编号", "统计计算名称","设备编号","年","月","结果","计算时间"],
            "currentYear" => ["统计计算编号", "统计计算名称","设备编号","年","结果","计算时间"],
            "total" => ["统计计算编号", "统计计算名称","设备编号","结果","计算时间"],
        ];
        // sheet 名称
        $sheetNames = [
            "hour"  =>  "小时",
            "day"  =>  "昨天",
            "month"  =>  "上月",
            "year"  =>  "去年",
            "currentDay"  =>  "当天",
            "currentMonth"  =>  "当月",
            "currentYear"  =>  "当年",
            "total"  =>  "累计"
        ];
        // 设置文件存储路径
        $this->setPath();
        if ($type[0] == "all") $type = ["hour","day","month","year","currentDay","currentMonth","currentYear","total"];

        // 将数据放到excel 中去
        Excel::create("statistics",
            function ($excel) use($excelData,$titles,$sheetNames,$type){
                foreach ($type as $index) {
                    $sheetName = $sheetNames[$index];
                    $title = $titles[$index];
                    $width = $this->excel_width[$index];
                    $data = $excelData[$index];
                    $excel->sheet($sheetName, function ($sheet) use($title,$data,$width) {
                        // 横向处理
                        $this->setCellEachSheet($sheet,$data,$title,$width);
                    });
                }
            })->store('xls',$this->getPath());
        return $this->relative_excel_path . "statistics.xls" ;
    }

    public function setPath()
    {
        $this->relative_excel_path = "app".DIRECTORY_SEPARATOR."exports".DIRECTORY_SEPARATOR;
        $this->excel_path = storage_path($this->relative_excel_path);
    }

    public function getPath()
    {
        return $this->excel_path;
    }

    /**
     * 为有公共特征的sheet 设置 cell 单元格样式和填写数据
     * @param object $sheet
     * @param array $titles   小标题列表
     * @param array $content  核心数据
     * @param array $width  cell 宽度
     * @return mixed            sheet object | 验证提示信息array
     */
    public function setCellEachSheet($sheet,$content,$titles,$width)
    {
        // 设置列宽
        $sheet->setWidth($width);

        // 为小标题部分设置样式和填充数据
        foreach ( $titles as $col =>$cell_value) {
            $sheet_x_point = excel_cell_y_by_number($col+1);
            $sheet = $sheet->cell($sheet_x_point."1",function ($cell) use($cell_value){
                $cell->setBorder("thin","thin","thin","thin")
                    ->setValue($cell_value)
                    ->setBackground("#7FD0FF")
                    ->setAlignment('center')
                    ->setValignment('center');

            });
        }
        // 考虑要合并的单元格
        foreach ($content as $index => $value) {
            $i = 0;
            foreach ($value as $v) {
                $sheet_x_point = excel_cell_y_by_number($i+1);
                $sheet =  $sheet->cell($sheet_x_point.($index+2),function ($cell) use($v){
                    $cell->setBorder("thin","thin","thin","thin")
                        ->setValue($v)
                        //                     ->setBackground("#88E168")
                        ->setAlignment('center')
                        ->setValignment('center');
                });
                $i ++;
            }

        }
        return $sheet;
    }

    public function  organizeExcelData($equipment_id,$statistics_id,$type,$page_index,$page_size,$selectField) {
        // type 为all 表示导出 所有类型的统计数据

        if (empty($statistics_id[0])) $statistics_id  = ["all"];
        $data = [];
        if ($type[0] != "all") {
            foreach ($type as $value) {
                switch ($value) {
                    case "hour":
                        $data["hour"] = (new AdminStatosModel())->getList($equipment_id,$page_index,$page_size,$selectField["hour"],$statistics_id);
                        break;
                    case "day":
                        $data["day"] = (new AdminStatosDayModel())->getList($equipment_id,$page_index,$page_size,$selectField["day"],$statistics_id);
                        break;
                    case "month":
                        $data["month"] = (new AdminStatosMonthModel())->getData($equipment_id,$selectField["month"],$statistics_id);
                        break;
                    case "year":
                        $data["year"] = (new AdminStatosYearModel())->getData($equipment_id,$selectField["year"],$statistics_id);
                        break;
                    case "currentDay":
                        $data["currentDay"] =  (new AdminStatosCurrentDayModel())->getAggregateDay($equipment_id,$statistics_id,$selectField["currentDay"]);
                        break;
                    case "currentMonth":
                        $data["currentMonth"] =  (new AdminStatosCurrentMonthModel())->getAggregateMonth($equipment_id,$statistics_id,$selectField["currentMonth"]);
                        break;
                    case "currentYear":
                        $data["currentYear"] =  (new AdminStatosCurrentYearModel())->getAggregateYear($equipment_id,$statistics_id,$selectField["currentYear"]);
                        break;
                    case "total":
                        $data["total"] =  (new AdminStatosSummaryModel())->getAggregateTotal($equipment_id,$statistics_id,$selectField["total"]);
                        break;
                }
            }
        } else {
            $data["hour"] = (new AdminStatosModel())->getList($equipment_id,$page_index,$page_size,$selectField["hour"],$statistics_id);
            $data["day"] = (new AdminStatosDayModel())->getList($equipment_id,$page_index,$page_size,$selectField["day"],$statistics_id);
            $data["month"] = (new AdminStatosMonthModel())->getData($equipment_id,$selectField["month"],$statistics_id);
            $data["year"] = (new AdminStatosYearModel())->getData($equipment_id,$selectField["year"],$statistics_id);
            $data["currentDay"] =  (new AdminStatosCurrentDayModel())->getAggregateDay($equipment_id,$statistics_id,$selectField["currentDay"]);
            $data["currentMonth"] =  (new AdminStatosCurrentMonthModel())->getAggregateMonth($equipment_id,$statistics_id,$selectField["currentMonth"]);
            $data["currentYear"] =  (new AdminStatosCurrentYearModel())->getAggregateYear($equipment_id,$statistics_id,$selectField["currentYear"]);
            $data["total"] =  (new AdminStatosSummaryModel())->getAggregateTotal($equipment_id,$statistics_id,$selectField["total"]);
        }
        return $data;
    }
}
