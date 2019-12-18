<?php
/*
* Copyright (c) 2014-2018 Mixlinker , All Rights Reserved
* THIS IS UNPUBLISHED PROPRIETARY SOURCE CODE OF mixlinker
*
* File: api.php
* Author: qinguoqing
* Description: user application
* Version:V1.0.0
*
*-------------------------------------------------------------------------------
* Date Author(s) Status & Comments
*-------------------------------------------------------------------------------
* 2018/09/12 qinguoqing Creating
*--------------------------------------------------------------------------------
*/
namespace Modules\Pro\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\Api\Libs\Classes\Apiq;
use Modules\Pro\Models\AppGpsModel;

class ApiController extends Controller{
	public function __construct() {
		$this->apiq=new Apiq;
  }
  //Api for care
  //Get data list;
  public function get_customer_list(){
    $info=array(
      'is_all'=>0,
      'page_index'=>1,
      'page_size'=>10000,
      'condition'=>isset($_GET['condition'])?$_GET['condition']:'[]'
    );
    $combo_array=array();
    $res=json_decode($this->apiq->get_list('customer', $info), true);
    foreach($res['result']['data'] as $key=>$val){
      $combo_array[]=array($val['customer_id'], $val['customer_name']);
    }
    echo json_encode(array('count'=>count($combo_array), 'msg'=>'success', 'data'=>$combo_array));
  }
  //获取客户所属设备
  public function get_cutomer_equipment_list(){
    $customer_name=$_GET['customer_name'];
    $info=array(
      'is_all'=>0,
      'page_index'=>1,
      'page_size'=>10000,
      'condition'=>isset($_GET['condition'])?$_GET['condition']:'[]'
    );
    $res=json_decode($this->apiq->get_list('equipment', $info), true);
    $combo_array=array();
    foreach($res['result']['data'] as $key=>$val){
      if($val['customer_name']==$customer_name){
        $combo_array[]=array($val['equipment_id'], $val['equipment_name']);
      }
    }
    echo json_encode(array('count'=>count($combo_array), 'msg'=>'success', 'data'=>$combo_array));
  }
  //Get equipment detail info.
  public function get_data_info(){
    $info=$_REQUEST;
    $res=json_decode($this->apiq->get_info($info['type'], $info), true);
    foreach($res['result']['data'] as $key=>$val){
      if(isset($val['addition'])){
        $addition=json_decode($val['addition'], true);//printr($addition);
        foreach($addition[0]['data'] as $k=>$v){
          $res['result']['data'][$key][$v[0]]=$v[1];
        }
      }
    }
    echo json_encode($res);
  }
    /**
     * 上报经纬度
     * 用户名：username
     * 经纬度：lon_lat
     * 具体地址：address
     * 录入时间：inputtime
     */
    public function pub_gps(){
        $info=$_REQUEST;
        $info['rid']=0;
        if(isset($info['username'])&&isset($info['lon_lat'])&&isset($info['address'])&&isset($info['inputtime'])){
            (new AppGpsModel())->change($info);
            echo json_encode(array(
                'code'=>200,
                'msg'=>'Gps info pub success.',
                'mix_code'=>'',
                'mix_msg'=>'',
                'mix_ext'=>'',
                'result'=>array()
            ));
        }else{
            echo json_encode(array(
                'code'=>500,
                'msg'=>'Fields username/lon_lat/address/inputtime are required.',
                'mix_code'=>'',
                'mix_msg'=>'',
                'mix_ext'=>'',
                'result'=>array()
            ));
        }
    }
}