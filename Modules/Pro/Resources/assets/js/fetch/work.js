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
    // 查询作业数据列表
    get_list(cb, data) {
        fetch(config.apiq.work + '/public_get_list', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 查询作业详细信息
    get_detial(cb, data) {
        fetch(config.apiq.work + '/public_get_info', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 添加作业
    add_work(cb, data) {
        fetch(config.apiq.work + '/public_add', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 编辑作业
    edit_work(cb, data) {
        fetch(config.apiq.work + '/public_edit', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 删除作业
    delete_work(cb, data) {
        fetch(config.apiq.work + '/public_delete', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
}
