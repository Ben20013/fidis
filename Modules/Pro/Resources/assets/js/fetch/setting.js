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
    set_config(cb, data) {
        fetch(config.apiq.set_config, 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    get_config(cb, data) {
        fetch(config.apiq.get_config, 'post', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    upload_logo(cb, data) {
        fetch(config.apiq.upload_logo, 'upload', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
    upload_icon(cb, data) {
        fetch(config.apiq.upload_logo + '?type=ico', 'upload', data).then((data) => { cb(data) }).catch((e) => { cb(e) })
    },
}
