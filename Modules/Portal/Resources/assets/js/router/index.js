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
import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/assets/js/page/login/login'
import Home from '@/assets/js/page/home/home'
import Admin from '@/assets/js/page/admin/index'
import Setting from '@/assets/js/page/admin/setting/setting'

Vue.use(Router)

export default new Router({
    //mode: 'history',
    routes: [{
            path: '/',
            name: 'index',
            meta: { auth: true },
            redirect: '/index',
        },
        {
            path: '/_blank',
            name: 'index',
            meta: { auth: true },
            // redirect: '/_blank',
        },
        {
            path: '/index',
            name: 'home',
            component: Home,
            meta: { auth: true, title: '首页', isParent: true }
        },
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/logout',
            name: 'logout',
            component: Login,
        },
        {
            path: '/setting',
            name: 'setting',
            component: Setting,
            meta: { auth: true, title: '设置', isParent: true }
        },
    ]
})
