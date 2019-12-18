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
    // 获取采集类型列表
    get_category_list(cb, data, token) {
        fetch(config.apiq.collect + '/public_get_menu_list', 'post', data, token).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 获取离线数据采集结果列表
    get_menu_list(cb, data, token) {
        fetch(config.apiq.collectos + '/public_get_menu_list', 'post', data, token).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 获取离线数据采集结果列表
    get_list(cb, data, token) {
        fetch(config.apiq.collectos + '/public_get_list', 'post', data, token).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 获取离线数据采集结果详细信息
    get_collect_detail(cb, data, token) {
        fetch(config.apiq.collectos + '/public_get_info', 'post', data, token).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 添加离线数据采集结果
    add_collect_data(cb, data, token) {
        fetch(config.apiq.collectos + '/public_add', 'post', data, token).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
}
