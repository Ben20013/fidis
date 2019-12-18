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
//import App from './App'
import router from './router'
import echarts from 'echarts' //全局引入
import axios from 'axios'
import '../font/fontawesome-5.8.2/css/all.min.css'
import ElementUI from 'element-ui'
import '../theme/index.css'
import $ from 'jquery'
import jQuery from 'jquery'
import VueI18n from 'vue-i18n'
import config from '@/assets/js/config/config'

//路由登录验证， 未登录跳转登录页面
router.beforeEach((to, from, next) => {
    var loginState = localStorage.getItem('loginState');
    if (to.matched.some(m => m.meta.auth)) {
        if (loginState == 1) {
            next();
        } else {
            next({
                path: '/login'
            });
        }
    } else {
        next();
    }
})

Vue.config.productionTip = false
Vue.prototype.$echarts = echarts
Vue.prototype.$http = axios;

Vue.use(ElementUI);
Vue.use(VueI18n);

import i18n from '../../lang/i18n'
/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    i18n,
    // render: h => h(App)
}).$mount('#app');
