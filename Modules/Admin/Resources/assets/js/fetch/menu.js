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
import config from '../config/api.conf';
import {
    mixGetJson
} from './api';

export default {
    get_list(cb, params, conf) {
        mixGetJson(config.menu.list, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
    detail(cb, params, conf) {
        mixGetJson(config.menu.detail, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
    add(cb, params, conf) {
        mixGetJson(config.menu.add, 'post', params, conf).then((data) => {
            cb(data)
        })
    },
    edit(cb, params, conf) {
        mixGetJson(config.menu.edit, 'post', params, conf).then((data) => {
            cb(data)
        })
    },
    delete(cb, params, conf) {
        mixGetJson(config.menu.delete, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
    getModuleOption(cb, params, conf) {
        mixGetJson(config.module.getModuleOption, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
    getMenuOption(cb, params, conf) {
        mixGetJson(config.menu.getMenuOption, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
}
