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
export default {
    base: {
        version: '/admin/version',
        user: '/admin/userInfo',
        logout: '/logout',
        getMenuList: '/admin/getMenuList'
    },
    module: {
        list: '/admin/module/index',
        detail: '/admin/module/detail',
        getModuleOption: '/admin/module/moduleOption',
        install: '/admin/module/install',
        uninstall: '/admin/module/uninstall',
        upload: '/admin/module/upload',
        enable: '/admin/module/enable',
        disable: '/admin/module/disable'
    },
    menu: {
        list: '/admin/menu/index',
        add: '/admin/menu/add',
        edit: '/admin/menu/edit',
        detail: '/admin/menu/detail',
        delete: '/admin/menu/delete',
        getMenuOption: '/admin/menu/menuOption',
    }
}
