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
    //创建服务接口
    add(cb, data) {
        fetch(config.apiq.service + '/public_add', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },
    //获取服务列表
    get_list(cb, data, token) {
        fetch(config.apiq.service + '/public_get_list', 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },
    //获取服务详情
    get(cb, data) {
        fetch(config.apiq.service + '/public_get_info', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //搜索服务
    getMenuList(cb, data) {
        fetch(config.apiq.service + '/public_get_menu_list', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //编辑服务
    edit(cb, data) {
        fetch(config.apiq.service + '/public_edit', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },
}
