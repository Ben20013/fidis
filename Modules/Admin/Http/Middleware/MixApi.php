<?php

namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class MixApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $header = $request->header('Authorization');

        if(!$header){
            $result = [
                'code'=>401,
                'msg'=>trans('Token不存在，请重新登录'),
                'mix_code'=>230014,
                'mix_msg'=>'',
                'mix_ext'=>'',
                'result'=>[]
            ];
            return response()->json($result, 200);
        }
        $token = trim(substr($header, 7));
        if(!$token){
            $result = [
                'code'=>401,
                'msg'=>trans('Token不合法，请重新登录'),
                'mix_code'=>230014,
                'mix_msg'=>'',
                'mix_ext'=>'',
                'result'=>[]
            ];
            return response()->json($result, 200);
        }

        $auth = Redis::EXISTS('admin:token:'.$token);

        if(!$auth){
            $result = [
                'code'=>401,
                'msg'=>trans('Token已过期，请重新登录'),
                'mix_code'=>230014,
                'mix_msg'=>'',
                'mix_ext'=>'',
                'result'=>[]
            ];
            return response()->json($result, 200);
        }

        return $next($request);
    }
}