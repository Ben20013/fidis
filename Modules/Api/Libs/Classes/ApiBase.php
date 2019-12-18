<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: api.class.php
* Author: MIXIOT Team
* Description: Interface for querying MIXIOT data
* Version:V1.0.0
*
*-------------------------------------------------------------------------------
* Date Author(s) Status & Comments
*-------------------------------------------------------------------------------
* 2018/08/28 qinguoqing Creating
*--------------------------------------------------------------------------------
*/
namespace Modules\Api\Libs\Classes;
class ApiBase{
	public static $url;
	protected static $token='';
	protected static $ticket='';
	public function __construct(){
		$this->sysconfig=config('system');
		self::$url=$this->sysconfig['protocol'].$this->sysconfig['admin_url'];
		$this->userinfo=array();
		self::$token=$this->get_token(getallheaders());
		if(!self::$token&&isset(session('user')['token'])){
			self::$token=session('user')['token'];
		}
		if(isset(session('user')['ticket'])){
			self::$ticket=session('user')['ticket'];
        }
	}
	/**
	 * Get the priv token.
	 * @param string $username
	 * @param string $password
	 * @param string $system
	 */
	protected function sys_login($username, $password, $system){
		$data=array(
			'username'=>$username,
			'password'=>$password,
			'system'=>$system
		);
		$res=json_decode($this->http_post(self::$url.'/api/login', $data), true);
		if($res['code']==200){
			self::$token=$res['data']['token'];
			unset($res['data']['token']);
			$this->userinfo=$res['data'];
		}else{
			echo json_encode($res);
		}
	}
	//去掉参数中m/c/a/d参数
	public function data_format($data){
		if(isset($data['m'])) unset($data['m']);
		if(isset($data['c'])) unset($data['c']);
		if(isset($data['a'])) unset($data['a']);
		if(isset($data['d'])) unset($data['d']);
		foreach($data as $key=>$val){
			$data[$key]=is_array(json_decode($val, true))?$val:stripslashes($val);
		}
		return $data;
	}
	//获取前端界面返回的token
	public function get_token($headers){
		if(isset($headers['Authorization'])){
			$auth=explode(' ', $headers['Authorization']);
			$token=isset($auth[1])?$auth[1]:'';
		}else{
			$token='';
		}

		return $token;
	}
	/**
	 * admin鉴权
	 * @param string $source
	 * @param array $ticket
	 */
	public function check_admin_ticket($source, $ticket){
		$data=array(
			'source'=>$source,
			'ticket'=>$ticket,
		);
		return $this->http_post(self::$url.'/api/check_ticket', $data, self::$token);
	}
	/**
	 * 发送http post请求，需要开启php_curl
	 * @param string $url
	 * @param array $data
	 * @param string $token
	 */
	protected function http_post($url, $data, $token='', $content_type=''){
		$curl = curl_init();
		if($token!=''){
			$header[]='Authorization: Bearer '.$token;
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }
        if($content_type!=''){
			$header[]='Content-Type: '.$content_type;
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		}
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($curl);
		if (curl_errno($curl)) {
			return 'Error: '.curl_error($curl);
		}
		curl_close($curl);
		return $output;
	}
	/**
	 * 发送http get请求，需要开启php_curl
	 * @param string $url
	 * @param string $token
	 */
	protected function http_get($url, $token=''){
		$curl=curl_init();
		if($token!=''){
			$header=array('Authorization: Bearer '.$token);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		}
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		$output=curl_exec($curl);
		if (curl_errno($curl)) {
			return 'Error: '.curl_error($curl);
		}
		curl_close($curl);
		return $output;
    }
    /**
	 * 发送http put请求，需要开启php_curl
	 * @param string $url
     * @param array $data
	 * @param string $token
	 */
	protected function http_put($url, $data, $token=''){
		$curl=curl_init();
		if($token!=''){
			$header=array('Authorization: Bearer '.$token);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		}
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$output=curl_exec($curl);
		if (curl_errno($curl)) {
			return 'Error: '.curl_error($curl);
		}
		curl_close($curl);
		return $output;
    }
    /**
	 * 发送http delete请求，需要开启php_curl
	 * @param string $url
     * @param array $data
	 * @param string $token
	 */
	protected function http_delete($url, $data, $token=''){
		$curl=curl_init();
		if($token!=''){
			$header=array('Authorization: Bearer '.$token);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		}
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$output=curl_exec($curl);
		if (curl_errno($curl)) {
			return 'Error: '.curl_error($curl);
		}
		curl_close($curl);
		return $output;
	}
}
