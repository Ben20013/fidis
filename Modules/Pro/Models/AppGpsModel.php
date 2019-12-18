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
 * Date : 2019-09-05
 * Author : zengpinghua
 * Description : Modules/Pro
 */
namespace Modules\Pro\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class AppGpsModel extends Model
{
    protected $table = 'pro_app_gps_data';
    public $primaryKey = 'id';
    public $timestamps = false;
    protected  $fillable  = [
        "id",
        "rid",
        "username",
        "lon_lat",
        "address",
        "inputtime"
    ];


    public function change($data)
    {
        $data = array_only($data, $this->fillable);
        if (array_key_exists($this->primaryKey, $data)) {
            $model = self::find($data[$this->primaryKey]);
            if (empty($model)) throw  new \Exception("该记录不存在，无法更新");
            foreach ($data as $key => $value) {
                $model->$key = $value;
            }
        } else {
            $model = new self($data);
        }

        if ($model->save()) {
            return $model->rule_id;
        } else {
            return false;
        }

    }

}
