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
    //获取列表
    get_list(cb, data) {
        fetch(config.apiq.earning + '/init', 'get', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 添加记录
    add(cb, data) {
        fetch(config.apiq.earning + '/public_add', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 删除记录
    del(cb, data) {
        fetch(config.apiq.earning + '/public_delete', 'get', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    // 编辑记录
    edit(cb, data) {
        fetch(config.apiq.earning + '/public_edit', 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
}
