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
    get_app_list(cb, params, conf) {
        mixGetJson(config.api.client_list, 'post', params, conf).then((data) => { cb(data) })
    },
    check_ticket(cb, params, conf) {
        mixGetJson(config.api.check_ticket, 'post', params, conf).then((data) => { cb(data) })
    },
    get_user(cb, params, conf) {
        mixGetJson(config.api.user, 'post', params, conf).then((data) => { cb(data) })
    },
    user_edit(cb, params, conf) {
        mixGetJson(config.api.user_edit, 'post', params, conf).then((data) => { cb(data) })
    },
    modify_pwd(cb, params, conf) {
        mixGetJson(config.api.reset_password, 'post', params, conf).then((data) => { cb(data) })
    },
    get_about_us(cb, params, conf) {
        mixGetJson(config.admin.get_config, 'post', params, conf).then((data) => { cb(data) })
    },
}