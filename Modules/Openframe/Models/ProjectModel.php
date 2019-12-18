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
 * Date : 2019-05-07
 * Author : qinguoqing
 * Description : Openframe Model.
 */
namespace Modules\Openframe\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model{
    public $table='openframe_project';
    public $timestamps = false;
    protected $primaryKey = 'project_id';
}