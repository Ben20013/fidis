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
    //查询用户列表
    get_list(cb, data) {
        fetch(config.apiq.user + '/public_get_list', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //获取用户信息
    get(cb, data) {
        fetch(config.apiq.user + '/public_get_info', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //添加用户
    add(cb, data) {
        fetch(config.apiq.user + '/public_add', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //编辑用户
    edit(cb, data) {
        fetch(config.apiq.user + '/public_edit', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //删除用户
    delete(cb, data) {
        fetch(config.apiq.user + '/public_delete', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //搜索用户
    get_menu_list(cb, data) {
        fetch(config.apiq.user + '/public_get_menu_list', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //取消关注（超管）
    delete_user_equipment(cb, data) {
        fetch(config.apiq.user_equipment + '/public_delete', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },
    // 获取关于我们信息
    get_setting_about_us(cb, data) {
        fetch(config.apiq.setting + '/public_get_about_us', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },
    // 获取关于我们信息
    add_feedback(cb, data) {
        fetch(config.apiq.setting + '/public_feedback', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },
    // 获取二维码
    get_qrcode(cb, data) {
        fetch(config.apiq.get_qrcode, 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

}
