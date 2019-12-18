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
import config from '@/assets/js/config';
import { mixGetJson } from '@/assets/js/fetch/api';

export default {
    set_config(cb, params) {
        mixGetJson(config.admin.set_config, 'post', params).then((data) => { cb(data) })
    },
    get_config(cb, params) {
        mixGetJson(config.admin.get_config, 'post', params).then((data) => { cb(data) })
    },
    upload_logo(cb, params) {
        mixGetJson(config.admin.upload_logo, 'upload', params).then((data) => { cb(data) })
    },
    upload_images(cb, params) {
        mixGetJson(config.admin.upload_images, 'upload', params).then((data) => { cb(data) })
    },
    logout(cb, params) {
        mixGetJson(config.admin.logout, 'post', params).then((data) => { cb(data) })
    },
}