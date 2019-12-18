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
        mixGetJson(config.module.list, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
    detail(cb, params, conf) {
        mixGetJson(config.module.detail, 'get', params, conf).then((data) => {
            cb(data)
        })
    },
    install(cb, params, conf) {
        mixGetJson(config.module.install, 'post', params, conf).then((data) => {
            cb(data)
        })
    },
    uninstall(cb, params, conf) {
        mixGetJson(config.module.uninstall, 'post', params, conf).then((data) => {
            cb(data)
        })
    },
    upload(cb, params, conf) {
        mixGetJson(config.module.upload, 'post', params, conf).then((data) => {
            cb(data)
        })
    },
    enable(cb, params, conf) {
        mixGetJson(config.module.enable, 'post', params, conf).then((data) => {
            cb(data)
        })
    },
    disable(cb, params, conf) {
        mixGetJson(config.module.disable, 'post', params, conf).then((data) => {
            cb(data)
        })
    },
    generate(cb, params, conf) {
        mixGetJson(config.module.generate, 'post', params, conf).then((data) => {
            cb(data)
        })
    },
}
