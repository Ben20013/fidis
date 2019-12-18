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
 * Date : 2019-01-31
 * Author : LuoJiandong
 * Description : Common Service.
 */
namespace Modules\Pro\Services;
use Illuminate\Support\Facades\Redis;

class CommonService
{
    /**
     * @const
     */
    const UPLOAD_FOLDER = '/app/public/uploads';

    /**
     * 生成文件名
     *
     * @param  $folder
     * @param  $original_name
     * @param  $ext
     *
     * @return string
     */
    private function getFileName($folder, $original_name, $ext){
        $route = storage_path().self::UPLOAD_FOLDER;
        $route_file = $route.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$original_name;
        if(is_file($route_file)){
            $real_name = basename($original_name,'.'.$ext);
            $real_name .= '_'.$this->randomString(5);
            if($ext){
                $original_name = $real_name.'.'.$ext;
            }else{
                $original_name = $real_name;
            }
        }
        return $original_name;
    }

    /**
     * 文件上传
     *
     * @param  $file
     * @param  $folder
     * @param  $defined_type
     *
     * @return string
     */
    public function uploadFile ($file, $folder, $defined_type=[]) {
        //$default_type = ['image/png', 'image/jpeg'];
        //$allow_type = array_merge($default_type, $defined_type);
        //$mime_type = $file->getMimeType();
        //if (!in_array($mime_type, $allow_type)){
        //return trans('不支持的文件类型');
        //}
        $original_name = $file->getClientOriginalName(); // 文件原名
        $ext = $file->getClientOriginalExtension();     // 扩展名
        $folder .= DIRECTORY_SEPARATOR.date('Y').DIRECTORY_SEPARATOR.date('m');
        $file_name = $this->getFileName($folder, $original_name, $ext);

        $path = $file->storeAs($folder, $file_name);
        $route = storage_path().self::UPLOAD_FOLDER;
        chmod($route.DIRECTORY_SEPARATOR.$path,0755);
        $path = str_replace( '\\',  '/', $path);
        return $path;
    }

    /**
     * 文件下载
     *
     * @param  $path
     *
     * @return string
     */
    public function download($path){
        $route = self::UPLOAD_FOLDER;
        $route_file = storage_path().DIRECTORY_SEPARATOR.$route.DIRECTORY_SEPARATOR.$path;
        if(!is_file($route_file) ){
            return trans('文件不存在！');
        }
        $handle = fopen($route_file, 'rb');
        if (FALSE === $handle){
            return trans('文件不存在或者文件已损坏！');
        }

        header('Cache-Control: max-age=0');
        header('Content-Description: File Transfer');
        header('Content-disposition: attachment; filename=' . basename($path)); // 文件名
        header('Content-Transfer-Encoding: binary'); // 告诉浏览器，这是二进制文件
        header('Content-Length: ' . filesize($route_file)); // 告诉浏览器，文件大小

        //输出文件;
        while (!feof($handle)) {
            $content = fread($handle, 8192);
            echo $content;
            @ob_flush();//把数据从PHP的缓冲中释放出来
            flush();//把被释放出来的数据发送到浏览器
        }
        fclose($handle);
    }

    /**
     * 参数校验错误时，格式化'说明信息'
     *
     * @param $error json
     *
     * @return string
     */
    public function formatValidatorError($error)
    {
        $error = json_decode($error,true);
        $msg = [];
        foreach($error as $key=>$val){
            $msg[] = $val[0];
        }
        return implode($msg, ' | ');
    }

    /**
     * 格式化 接口返回数据
     *
     * @param $code int
     * @param $msg string
     * @param $data array
     *
     * @return json
     */
    public function formatReturnResult($code, $msg, $data=['result'=>[]])
    {
        $result = array_merge(['code'=>$code, 'msg'=>$msg], $data);
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 格式化 接口返回 MixCode结果
     *
     * @param $mix_code int
     * @param $result mixed
     * @param $mix_msg string
     * @param $mix_ext string
     *
     * @return array
     */
    public function formatMixResult($mix_code, $result=[], $mix_msg='', $mix_ext='')
    {
        return ['mix_code'=>$mix_code, 'mix_msg'=>$mix_msg, 'mix_ext'=>$mix_ext, 'result'=>$result];
    }

    /**
     * 生成唯一编号
     *
     * @param $key redis保存key
     * @param $length	int 长度
     * @param $prefix 	null|string 前缀（只能是字母(大小写不限)加数字）
     *
     * @return String
     */
    public function getUid($key, $length = 3, $prefix=null){
        $id = Redis::INCR('incr:admin:uid:'.$key);
        $format_id = pow(10, $length) + $id;
        return $prefix.$format_id;
    }

    /**
     * 返回自定长度的字符串
     *
     * @param $str
     * @param $lenth
     * @param $direction  LEFT|RINGHT
     *
     * @return String
     */
    public function formatDecimalString($str, $lenth, $direction){
        if(strlen($str)<$lenth){
            return str_pad($str, $lenth, '0', STR_PAD_RIGHT);
        }
        if($direction === 'LEFT'){
            return substr($str, 0, $lenth);
        }
        return substr($str, -$lenth);
    }

    /**
     * 返回随机字符串：不包括I和O的大写字母+数字
     *
     * @param $lenth
     *
     * @return String
     */
    public function randomString($lenth){
        $str = 'ABCDEFGHJKLMNPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($str),10, $lenth);
    }

    /**
     * 发送http post请求
     *
     * @param string 		$url  		发送地址
     * @param array|string 	$data		发送数据
     * @param array|string 	$header		请求头
     * @param int 			$timeOut	超时时间
     * @param boolean 		$ssl	    超时时间
     * @return string 		$result 	返回接口
     */
    public function httpPost($url, $data=null, $header=['charset=UTF-8'], $timeOut=30, $ssl=false){
        //发送POST请求
        $ch=curl_init() or die (curl_error());
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);
        curl_setopt($ch, CURLOPT_POST, 1);//post方式提交
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $ssl);
        $result=curl_exec($ch);
        if(curl_errno($ch)){
            return curl_error($ch);
        }
        curl_close($ch);
        return $result;
    }

    /**
     * 删除环形队列数据
     *
     * @param $key String
     * @return Boolean
     */
    public function delRedisList($key)
    {
        return Redis::DEL($key);
    }

    /**
     * 添加 环形队列数据（右边插入）
     *
     * @param $key String
     * @param $value String
     * @return Boolean
     */
    public function addRedisList($key, $value)
    {
        return Redis::RPUSH($key, $value);
    }

    /**
     * 删除Redis哈希队列数据
     *
     * @param $list String
     * @param $key String
     * @return Boolean
     */
    public function delRedisHash($list, $key)
    {
        return Redis::HDEL($list, $key);
    }

    /**
     * 删除Redis队列
     *
     * @param $list String
     * @param $key String
     * @return Boolean
     */
    public function delRedisQueue($list)
    {
        return Redis::DEL($list);
    }

    /**
     * 添加Redis哈希队列数据
     *
     * @param $list String
     * @param $key String
     * @param $value String
     * @return Boolean
     */
    public function setRedisHash($list, $key, $value)
    {
        return Redis::HSET($list, $key, $value);
    }

    /**
     * 获取Redis哈希队列数据
     *
     * @param $list String
     * @param $key String
     * @return Boolean
     */
    public function getRedisHash($list, $key)
    {
        return Redis::HGET($list, $key);
    }

    /**
     * 获取所有Redis哈希队列数据
     *
     * @param $list String
     * @return Boolean
     */
    public function getAllRedisHash($list)
    {
        return Redis::HGETALL($list);
    }
}