<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: api_passport.class.php
* Author: MIXIOT Team
* Description: MixPassport apis
* Version:V1.0.0
*
*-------------------------------------------------------------------------------
* Date Author(s) Status & Comments
*-------------------------------------------------------------------------------
* 2018/08/28 qinguoqing Creating
*--------------------------------------------------------------------------------
*/
namespace Modules\Api\Libs\Classes;
class ApiPassport extends ApiBase{
	public static $passport_url;
	public function __construct(){
		parent::__construct();
		self::$passport_url=$this->sysconfig['protocol'].$this->sysconfig['passport_url'];
	}
	/**
	 * 登录
	 * @param string $username
	 * @param string $password
	 * @param array $source
	 */
	public function login($username, $password, $source){
		$data=array(
			'username'=>$username,
			'password'=>$password,
			'source'=>$source
		);
		$res=$this->http_post(self::$passport_url.'/api/login', $data, self::$token);
		return $res;
	}
	/**
	 * ticket鉴权
	 * @param string $source
	 * @param string $ticket
	 */
	public function check_ticket($source, $ticket){
		$data=array(
			'source'=>$source,
			'ticket'=>$ticket
		);
		$res=$this->http_post(self::$passport_url.'/api/check_ticket', $data, '');
		return $res;
	}
	/**
	 * 获取当前登录用户信息
	 */
	public function get_current_userinfo(){
		$data=array();print_r(self::$token);
		$res=$this->http_post(self::$passport_url.'/api/user', $data, self::$token);
		return $res;
	}
	/**
	 * 获取当前用户拥有应用列表
	 */
	public function get_user_client_list(){
		$data=array();
		$res=$this->http_post(self::$passport_url.'/api/client_list', $data, self::$token);
		return $res;
	}
	/**
	 * 获取制定应用的url
	 * @param string $client_id
	 */
	public function get_client_url($client_id){
		$data=array(
			'client_id'=>$client_id
		);
		$res=$this->http_post(self::$passport_url.'/api/client', $data, self::$token);
		return $res;
	}
	/**
	 * 重置密码
	 * @param string $old_password
	 * @param string $new_password
	 */
	public function reset_password($old_password, $new_password){
		$data=array(
			'old_password'=>$old_password,
			'new_password'=>$new_password
		);
		$res=$this->http_post(self::$passport_url.'/api/reset_password', $data, self::$token);
		return $res;
	}
	/**
	 * 退出登录
	 */
	public function logout($source, $ticket){
		$res=$this->http_get(self::$passport_url.'/logout?source='.$source.'&ticket='.$ticket, self::$token);
		return $res;
	}
	/**
	 * 获取列表数据
	 * @param string $type user, client, group, user_group, user_client, group_client
	 * @param int $page_index
	 * @param int $page_size
	 * @param string $condition eg:[["user_id", "=", "1001"], ["username", "LIKE", "admin"]]
	 */
	public function get_list($type, $data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$passport_url.'/api/'.$type.'/get_list', $data, self::$token);
		return $res;
	}
	/**
	 * 获取详细信息
	 * @param string $type user, client, group, user_group, user_client, group_client
	 */
	public function get_info($type, $data){
		$data=$this->data_format($data);
		self::$ticket=isset($data['ticket'])&&$data['ticket']?$data['ticket']:self::$ticket;
		$res=$this->http_post(self::$passport_url.'/api/'.$type.'/get', $data, self::$ticket);
		return $res;
	}
	/**
	 * 添加信息
	 * @param string $type user, client, group, user_group, user_client, group_client
	 */
	public function add_info($type, $data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$passport_url.'/api/'.$type.'/add', $data, self::$token);
		return $res;
	}
	/**
	 * 编辑信息
	 * @param string $type user, client, group, user_group, user_client, group_client
	 */
	public function edit_info($type, $data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$passport_url.'/api/'.$type.'/edit', $data, self::$token);
		return $res;
	}
	/**
	 * 删除信息
	 * @param string $type user, client, group, user_group, user_client, group_client
	 */
	public function delete_info($type, $data){
		$data=$this->data_format($data);
		$res=$this->http_post(self::$passport_url.'/api/'.$type.'/delete', $data, self::$token);
		return $res;
	}
}
