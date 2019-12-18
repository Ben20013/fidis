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
import config from '$config';
import { fetch } from '$api.js';

export default {
    //获取组设备列表
    get_list(cb, data) {
        fetch(config.apiq.equipment_group + '/public_get_list', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 获取组设备信息
    get_detail(cb, data) {
        fetch(config.apiq.equipment_group + '/public_get_info', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 获取组设备中的关联设备列表
    get_equipment_list(cb, data) {
        fetch(config.apiq.equipment_group + '/public_get_equipment', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 编辑组设备
    edit_group_equipment(cb, data) {
        fetch(config.apiq.equipment_group + '/public_edit', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 获取组设备中的历程列表
    get_process(cb, data) {
        fetch(config.apiq.equipment_group + '/public_get_process', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 获取组设备中的事件列表
    get_event(cb, data) {
        fetch(config.apiq.equipment_group + '/public_get_event', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 获取设备报警&故障挂板列表
    get_mosaic_warn_list(cb, data, token) {
        fetch(config.apiq.equipment_group + '/public_get_mosaic_warn', 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },
    // 获取组设备中的故障挂板列表
    get_fault_mosaic(cb, data) {
        fetch(config.apiq.equipment_group + '/public_get_fault_mosaic', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 获取组设备中的报警挂板列表
    get_alert_mosaic(cb, data) {
        fetch(config.apiq.equipment_group + '/public_get_alert_mosaic', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 导出设备列表
    export_list(cb, data) {
        fetch(config.apiq.group_list_export, 'get', data).then((data) => { cb(data) })
    },
}
