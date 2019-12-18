<?php

namespace Modules\Pro\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Moudles\Admin\Models\AdminLogModel;
use Request;
use Illuminate\Support\Facades\Redis;
use Exception;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //状态码、提示信息
    public $codeMsg = [
        // APIS
        138000 => "操作成功",
        238000 => "文件不存在或者文件已损坏",
        238001 => "缺少必要参数",
        238002 => "不支持的值",
        238003 => "参数格式不正确",
        //APIQ-PRO
        139000 => "操作成功",
        239000 => "缺少必要参数",
        239001 => "参数格式不正确",
        239002 => "内部错误",
    ];

    /**
     * 格式化 接口返回请求成功之后的数据
     * @param $code int
     * @param $msg string
     * @param $data array
     * 默认使用的是APIQ-PRO
     *
     * @return json
     */
    public function returnWithSuccess($data=[],$code=200, $msg='操作成功',$mix_code=139000,$mix_ext='')
    {
        $result = ['code'=>$code, 'msg'=>$msg,'result'=>$data,'mix_code'=>$mix_code,'mix_msg'=>$this->codeMsg[$mix_code],'mix_ext'=>$mix_ext];
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 格式化 接口返回请求失败之后的数据
     * @param $code int
     * @param $msg string
     *  默认使用的是APIQ-PRO
     * @return json
     */
    public function returnWithError($code=500,$msg='操作失败',$mix_code=239000,$mix_msg='操作失败',$mix_ext='')
    {
        $result = ['code'=>$code, 'msg'=>$msg,'mix_code'=>$mix_code,'mix_msg'=>$this->codeMsg[$mix_code],'mix_ext'=>$mix_ext];
        return json_encode($result, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 获取session认证用户信息
     *
     * @return object|null
     */
    public function user()
    {
        $user = null;
        try {
            $user = Request::session()->get('user');
            $user = json_decode($user);
        } catch(Exception  $exception) {
            $header = Request::header('Authorization');
            $token = trim(substr($header, 7));
            $user =  Redis::GET('admin:token:'.$token);
            $user = json_decode($user);
        }
        return $user;
    }

    /**
     * 获取session认证用户信息
     *
     * @return object|null
     */
    public function userId()
    {
        $user_id = null;
        try{
            $user = Request::session()->get('user');
            $user = json_decode($user);
            if($user){
                $user_id = $user->user_id;
            }
        } catch(Exception  $exception) {
            $header = Request::header('Authorization');
            $token = trim(substr($header, 7));
            $user =  Redis::GET('admin:token:'.$token);
            $user = json_decode($user);
            if($user){
                $user_id =  $user->user_id;
            }
        }
        return $user_id;
    }

    /**
     * 获取session认证用户信息
     *
     * @return object|null
     */
    public function ticket()
    {
        $ticket = null;
        try {
            $user = Request::session()->get('user');
            $user = json_decode($user);
            if ($user) {
                $ticket = $user->ticket;
            }
        } catch (Exception  $exception) {
            $header = Request::header('Authorization');
            $token = trim(substr($header, 7));
            $user = Redis::GET('admin:token:'.$token);
            $user = json_decode($user);
            if($user){
                $ticket = $user->ticket;
            }
        }
        return $ticket;
    }

    /**
     * 记录操作日志
     *
     * @param $log array
     * @return string
     */
    public function addLog($log)
    {
        $log_model = new AdminLogModel;
        foreach($log as $key=>$val){
            if($val){
                $log_model->$key = $val;
            }
        }
        $user = $this->user();
        $log_model->user_id = isset($user->user_id) ? $user->user_id : null;
        $log_model->username = isset($user->username) ? $user->username : '';
        $log_model->ip = Request::getClientIp();
        $log_model->save();
    }
}