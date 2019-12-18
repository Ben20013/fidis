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
const version = VERSION;
/**
 * [mixPortal_url description]
 * @type {String}
 */
const mixPortal_url = MIXPROTAL_URL;
/**
 * [mixPassport_url description]
 * 用户中心地址，用来退出登录
 */
const mixPassport_url = MIXPASSPORT_URL;
/**
 * [protocol description]
 * 协议 http https
 */
// const protocol = MIX_PROTOCOL;
/**
 * [host description]
 *  用户中心接口的代理地址
 */
const host = MIXPROTAL_URL;
/**
 * [adminHost description]
 *  门户中心后台接口代理地址
 */
const adminHost = MIX_FIDIS_PROXY_URL;
/**
 * [adminSource description]
 * 门户中心管理端标识
 */
const adminSource = 'MixPortal';
/**
 * [mix description]
 * @type {Object}
 */
const api = {
        login: host + '/portal/index/login',
        client_list: host + '/portal/index/get_user_client_list',
        check_ticket: host + '/portal/index/check_ticket',
        user: host + '/portal/index/user',
        user_edit: host + '/portal/index/user_edit',
        reset_password: host + '/portal/index/reset_password',
        get_client_url: host + '/portal/index/client',
    }
    /**
     * [admin description]
     * @type {Object}
     */
    // const admin = {
    //   check_ticket: adminHost +'/?m=portal&c=index&a=check_ticket',
    //   set_config: adminHost +'/?m=portal&c=setting&a=public_set_config',
    //   get_config: adminHost +'/?m=portal&c=setting&a=public_get_config',
    //   upload_logo: adminHost +'/?m=portal&c=setting&a=public_upload_logo',
    //   logout: adminHost +'/?m=portal&c=index&a=logout',
    // }
const admin = {
    check_ticket: adminHost + '/portal/index/check_ticket',
    set_config: adminHost + '/portal/setting/public_set_config',
    get_config: adminHost + '/portal/setting/public_get_config',
    upload_logo: adminHost + '/portal/setting/public_upload_logo',
    upload_images: adminHost + '/portal/setting/upload_images',
    logout: adminHost + '/portal/index/logout',
}

module.exports = {
    api: api,
    admin: admin,
    adminSource: adminSource,
    // protocol : protocol,
    mixPortal_url: mixPortal_url,
    mixPassport_url: mixPassport_url,
    version: version,
}