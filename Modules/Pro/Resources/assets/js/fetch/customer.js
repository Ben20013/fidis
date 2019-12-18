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
    //获取客户详情信息
    get_customer(cb, data, token) {
        fetch(config.apiq.customer + '/public_get_info', 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //获取客户列表
    get_list(cb, data) {
        fetch(config.apiq.customer + '/public_get_list', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //获取客户列表
    add_customer(cb, data) {
        fetch(config.apiq.customer + '/public_add', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },


    add_devicer(cb, data) {
        fetch(config.apiq.device + '/public_add', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //菜单搜索
    get_menu_list(cb, data) {
        fetch(config.apiq.customer + '/public_get_menu_list', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //关注客户
    user_customer(cb, data) {
        fetch(config.apiq.userCustomer + '/public_add', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //取消关注
    cancel_customer(cb, data) {
        fetch(config.apiq.userCustomer + '/public_delete', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //根据用户Id查询关注客户列表
    get_customer_list(cb, data) {
        fetch(config.apiq.userCustomer + '/public_get_customer_list', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //删除客户
    delete_customer(cb, data) {
        fetch(config.apiq.customer + '/public_delete', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //编辑客户
    edit(cb, data) {
        fetch(config.apiq.customer + '/public_edit', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },


    //根据用户Id查询关注设备列表
    get_equipment_list(cb, data) {
        fetch(config.apiq.user_equipment + '/public_get_equipment_list', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

    //批量取消对客户关注
    user_customer_multi_delete(cb, data) {
        fetch(config.apiq.userCustomer + '/public_multi_delete', 'post', data).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },
    // 获取所有客户列表
    get_all_user(cb, data, token) {
        fetch(config.apiq.customer + '/public_get_all_list', 'post', data, token).then(function(data) {
            cb(data)
        }).catch((e) => { cb(e) })
    },

}
