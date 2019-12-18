<?php
/******************************************************************************
 * Copyright (c) 2014-2018 Mixlinker Networks Inc. <mixiot@mixlinker.com>
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
 * Date : 2018-5-29
 * Author : Minton
 * Description : common function
 */




/**
 * 以get的方式发送https请求，并返回请求的结果
 * @param string $url
 * @param array $param
 * @return mixed
 */
if (!function_exists('curl_get')) {

    function curl_get($url, $header = array('Content-type' => 'application/json'))
    {
        if (!$header) {
            $header = array('Accept-Charset: utf-8');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        $ret = curl_exec($ch);
        curl_close($ch);
        return $ret;
    }
}


/**
 * 发送https post请求，需要开启php_curl
 * @param string $url
 * @param array $param
 * @return mixed
 */
if (!function_exists('http_post')) {
    function http_post($url, $param = array(), $header = "") //array('Content-type' => 'application/json')
    {
//
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    //设置该选项，表示函数curl_exec执行成功时会返回执行的结果，失败时返回 FALSE
//        curl_setopt($ch, CURLOPT_HEADER, 0);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//        curl_setopt($ch, CURLOPT_POST, 1);    //POST请求
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
//        curl_setopt($ch, CURLOPT_VERBOSE, 1);    //启用时会汇报所有的信息
//        $ret = curl_exec($ch);
//        curl_close($ch);
//        return $ret;
        if (!$header) {
            $header = array('Accept-Charset: utf-8');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);	//设置该选项，表示函数curl_exec执行成功时会返回执行的结果，失败时返回 FALSE
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_POST, 1);	//POST请求
        curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
        curl_setopt($ch, CURLOPT_VERBOSE, 1 );	//启用时会汇报所有的信息
        $ret = curl_exec($ch);
        curl_close($ch);
        return $ret;
    }
}


if (!function_exists("is_assoc")) {
    function is_assoc($arr) {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}

/**
 * 获取apiq token
 */

if (!function_exists("get_token_apiq")) {
    function get_token_apiq() {
        $url = env("ADMIN_URL") . "/api/login";
        $params = [
            "username"  =>  env('ADMIN_USERNAME'),
            "password"  => env('ADMIN_PASSWORD'),
            "system"      => env('ADMIN_SYSTEM')
        ];
        $response =  http_post($url,$params);
        $result = json_decode($response,true);
        if (is_array($result) && count($result) !== 0 && $result["code"] == 200) {
            return $result["result"]["token"];
        } else {
            throw new \Exception("get token failed . response : " . $response);
        }
    }
}

/**
 * 获取apiq token
 */

if (!function_exists("get_token_passport")) {
    function get_token_passport() {
        $url = env("MIXPASSPORT_URL") . "/api/login";
        $params = [
            "username"  =>  env('ADMIN_USERNAME'),
            "password"  => env('ADMIN_PASSWORD'),
            "source"      => env('ADMIN_SYSTEM')
        ];
        $response =  http_post($url,$params);
        $result = json_decode($response,true);
        if (is_array($result) && count($result) !== 0 && $result["code"] == 200) {
            return $result["result"]["ticket"];
        } else {
            throw new \Exception("get token failed . response : " . $response);
        }
    }
}

/**
 * 发送http post 请求 根据标准接口格式 获取 数据
 */

if (!function_exists("be_stripped_data")) {
    function be_stripped_data($url,$params,$header=[]) {
        if (count($header) == 0 ) {
            $response =  http_post($url,$params);
        } else {
            $response =  http_post($url,$params,$header);
        }
        $results = json_decode($response,true);
        if (!is_array($results)) throw new \Exception("request return data not array . response : " . $response);
        if (!array_key_exists("code",$results)) throw new \Exception("request return data not container code . response : " . $response);
        if ($results["code"] != 200)  throw new \Exception("request return data not container code . response : " . $response);
         // 说明获取到了数据
        if (is_array($results["result"]) && array_key_exists("data", $results["result"])) {
            return $results["result"]["data"];
        } else {
            return $results["result"];
        }
    }
}

/**
 * 二维数组按照指定键值去重
 * @param $arr [需要去重的二维数组]
 * @param $key [需要去重所根据的索引]
 * @return mixed
 */
if (!function_exists("arr_unique")) {
    function arr_unique($arr,$key)
    {
//        $id = "";
//        switch ($type) {
//            case "alert":
//                $id = "alert_id";
//                break;
//            case "fault":
//                $id = "fault_id";
//                break;
//            case "task":
//                $id = "maintenance_id";
//                break;
//            case "report":
//                $id = "output_id";
//                break;
//        }

        $key_arr = [];
        foreach ($arr as $k => $v) {
            $t = strtotime($v[$key]);
            if (in_array($t,$key_arr)) {
                unset($arr[$k]);
            } else {
                $key_arr[] = $t;
            }
        }
        sort($arr);
        return $arr;
    }
}
/**
 *  文件上传
 */

if (!function_exists("file_upload")) {
    function file_upload($file,$sub_path='',$disk='local')
    {
        if(empty($file))  throw  new \Exception("file  is empty");;
        $name=$file->getClientOriginalName();//得到图片名；
        $ext=$file->getClientOriginalExtension();//得到图片后缀；
        $fileName=md5(uniqid($name));
        $fileName=$fileName.'.'.$ext;//生成新的的文件名
        $bool=\Storage::disk($disk)->put($fileName,file_get_contents($file->getRealPath()));//
        if (!$bool) throw  new \Exception("upload file  failed");
        if ($disk == "maintenance") {
            return [
                "path"=>'maintenance' . DIRECTORY_SEPARATOR.$fileName,
                "filename"=>$name,
            ];//返回文件路径存贮在数据库 存放在public目录下面
        } else {
            if ($sub_path)  return 'app'.DIRECTORY_SEPARATOR.$sub_path.DIRECTORY_SEPARATOR.$fileName;//返回文件路径存贮在数据库
            return 'app'.DIRECTORY_SEPARATOR.$fileName;//返回文件路径存贮在数据库
        }
    }
}

/**
 *  获取截止日期
 */
if (!function_exists("get_close_date_by_period")) {
    function get_close_date_by_period($period, $unit,$start_time="")
    {
        switch ($unit) {
            case "year" :
            case "month" :
            case "day" :
                if (empty($start_time))  {
                    $result = date("Y-m-d H:i", strtotime("+" . $period . " " . $unit));
                } else {
                    $result = date("Y-m-d H:i", strtotime("+" . $period . " " . $unit, strtotime($start_time)));
                }
                break;
            case "hour" :
                if (empty($start_time))  {
                    $result = date("Y-m-d H:i", strtotime("+" . $period . " hours"));
                } else {
                    $result = date("Y-m-d H:i", strtotime("+" . $period . " hours", strtotime($start_time)));
                }
//                return date("Y-m-d H:i", strtotime("+" . $period . " hours"));
                break;
            default :
                throw new \Exception("not support unit : " . $unit);
        }
        return $result;

    }
}

/**
 * @param $path //文件路径 相对 $prefix_path 目录 ，列如完整路径为 $path.$prefix_path
 * @param $prefix_path //目录前半部分
 * @return array // code 状态码 msg 提示信息
 */

if (!function_exists('download')) {
    function download($path, $prefix_path = "/storage/app/public/")
    {
        $route_file = base_path() . $prefix_path . $path;
        $handle = fopen($route_file, "rb");
        if (FALSE === $handle) {
            return ["code" => 404, "msg" => "文件不存在或者文件已损坏！"];
        }

        header("Cache-Control: max-age=0");
        header("Content-Description: File Transfer");
        header('Content-disposition: attachment; filename=' . $path); // 文件名
        header("Content-Transfer-Encoding: binary"); // 告诉浏览器，这是二进制文件
        header('Content-Length: ' . filesize($route_file)); // 告诉浏览器，文件大小

        //输出文件;
        while (!feof($handle)) {
            $content = fread($handle, 8192);
            echo $content;
            @ob_flush();//把数据从PHP的缓冲中释放出来
            flush();//把被释放出来的数据发送到浏览器
        }
        fclose($handle);
        return ["code" => 200, "msg" => "下载成功"];
    }
}
/**
 * url 拼接参数
 * @param string $url
 * @param array $params
 * @return mixed
 */
if (!function_exists('join_url_params')) {
    function join_url_params($url, $params)
    {
        $i = 0;
        $suffix = "";
        foreach ($params as $key => $value) {
            if ($i == 0) {
                $suffix .= "?" . $key . "=" . $value;
            } else {
                $suffix .= "&" . $key . "=" . $value;
            }
            $i++;
        }
        $url = $url . $suffix;
        return $url;
    }
}
/**
 * 判断是否是关联数组
 * @param array $arr
 * @return bool
 */
if (!function_exists('is_assoc_array')) {
    function is_assoc_array($arr)
    {
        $index = 0;
        foreach (array_keys($arr) as $key) {
            if ($index++ != $key) return false;
        }
        return true;
    }
}
/**
 * 判断数组的维数
 * @param array $arr
 * @return int
 */
if (!function_exists('array_level')) {
    function array_level($arr)
    {
        $al = array(0);


        aL($arr, $al);
        $res = $al;
        unset($al);
        return max($res);
    }
}
if (!function_exists('aL')) {
    function aL($arr, &$al, $level = 0)
    {
        if (is_array($arr)) {
            $level++;
            $al[] = $level;
            foreach ($arr as $v) {
                aL($v, $al, $level);
            }
        }
    }
}
/**
 * 根据数组数组维取每一层的key，仅支持关联数组
 * @param array $arr
 * @return array
 */
if (!function_exists('get_all_level_key')) {
    function get_all_level_key($arr)
    {

        $level = array_level($arr);
        $keys = [];
        for ($i = 0; $i < $level; $i++) {
            $key = key($arr);
            $keys[] = $key;
            $arr = $arr[$key];
        }
        $keys[] = $arr;
        return $keys;
    }
}
/**
 * excel  number to character
 * eg : 26 return "Z" | 27 余数 1 return AA
 */

if (!function_exists('excel_cell_y_by_number')) {

    function excel_cell_y_by_number($index)
    {
        $index = $index + 1;
        $letter_lib = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"];
        if ($index <= 26) {
            return $letter_lib[$index - 1];
        } else {
            $i = intval($index / 26) - 1;
            $r = $index % 26;
            // 如果余数不为0 说明不是末尾元素,即 不是 52 、 78 这类
            $r = ($r != 0 ? intval($r) - 1 : $r = 25);
            return $letter_lib[$i] . $letter_lib[$r];
        }
    }
}
/**
 * 获取str 中包含的str 并返回数组
 *
 */

if (!function_exists('get_str_container_str')) {
    function get_str_container_str($haystack, $needles)
    {
        foreach ($needles as $needle) {
            //substr_count
            if (strpos($haystack, $needle) !== false) {
                return true;
            }
        }
        return false;
    }

}
/**
 * 将  "A1+A2"   ===> ["A1","+","A2"]
 */

if (!function_exists('get_each_elm_for_cul')) {
    function get_each_elm_for_cul($str)
    {
        $result = [];
        $tmp = "";
        for ($i = 0; $i < strlen($str); $i++) {
            $elm = substr($str, $i, 1);
            if (in_array($elm, ["(", ")", "*", "/", "-", "+"])) {
                if (!empty($tmp)) {
                    $result[] = $tmp;
                    $tmp = "";
                }
                $result[] = $elm;
            } else {
                $tmp .= $elm;
            }
            // 最后一个
            if ($i == strlen($str) - 1 && !empty($tmp)) $result[] = $tmp;
        }

        return $result;

    }
}
/**
 *  将 含有字母和数字的字符串分离成一个 长度为2 的一维数组
 */
if (!function_exists('split_str_by_number_string')) {
    function split_str_by_number_string($str)
    {
        $s = "";
        $n = "";
        for ($i = 0; $i < strlen($str); $i++) {
            $elm = substr($str, $i, 1);
            if (is_numeric($elm)) {
                $n .= $elm;
            } else {
                $s .= $elm;
            }

        }
        return [$s, $n];

    }
}
if (!function_exists("deep_in_array")) {
    function deep_in_array($value, $array)
    {
        foreach ($array as $item) {
            if (!is_array($item)) {
                if ($item == $value) {
                    return true;
                } else {
                    continue;
                }
            }

            if (in_array($value, $item)) {
                return true;
            } else if (deep_in_array($value, $item)) {
                return true;
            }
        }
        return false;
    }
}
if (!function_exists("issetKey")) {
    function issetKey($arr, $k)
    {
        if (!is_array($arr)) return false;
        foreach ($arr as $key => $value) {
            if ($key === $k) {
                return true;
            } else {
                if (is_array($value)) {
                    $rel = issetKey($value, $k);
                    if ($rel) return $rel;
                }
            }
            return false;
        }
    }
}

