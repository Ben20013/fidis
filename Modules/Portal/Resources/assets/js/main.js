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

// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
// import App from './App'
import router from './router'
import ElementUI from 'element-ui'
import '@/assets/elementui-theme/index.css'
import config from '@/config'
import { mixGetJson } from '@/fetch/api'

//路由登录验证，未登录跳转登录页面
router.beforeEach((to, from, next) => {
    let query = to.query;
    let loginState = localStorage.getItem('loginState');
    if (query['source']) { //路由有source
        if (query['ticket']) { //门户中心后台验证
            mixGetJson(config.admin.check_ticket, 'post', { 'source': query['source'], 'ticket': query['ticket'] })
                .then(data => {
                    console.log(data);
                    if (data.code == 200) {
                        if (to.path == '/logout') {
                            next({ path: '/index' });
                        } else {
                            let user = data.result;
                            user.ticket = query['ticket']
                            user.source = query['source']
                            localStorage.setItem('user', JSON.stringify(user));
                            sessionStorage.setItem('MIXPORTALSTATE', 1);
                            next({ path: '/admin' });
                        }
                    } else {
                        if (to.path == '/logout') {
                            next({ path: '/index' });
                        } else {
                            // window.location.href = window.location.origin + '?source='+query['source'];
                        }
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        } else { //其他应用带有source过来的
            let user = localStorage.getItem('user');
            // console.log(user);
            if (user && to.path != '/login') { //门户中心有登录，校验应用是否有权限
                let ticket = JSON.parse(user).ticket;
                // next({path:'/index'});
                mixGetJson(config.api.check_ticket, 'post', { 'source': query['source'], 'ticket': ticket })
                    .then(data => {
                        // console.log(data);
                        if (data.code == 200) { //有权限，哪里来回哪去
                            window.location.href = data.result.url + '?source=' + query['source'] + '&ticket=' + ticket;
                        } else if (data.code == 500) { // 没权限，回到门户中心首页
                            next({ path: '/index' });
                        } else { // 其他的跳到登录页面
                            next({ path: '/login', query: query });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            } else { // 门户中心没登录的
                if (to.matched.some(m => m.meta.auth)) { // 设置了路由验证的页面
                    next({ path: '/login', query: query });
                } else { // 没有设置路由验证的
                    next();
                }
            }
        }
    } else { //路由没有source
        if (to.matched.some(m => m.meta.auth)) { // 设置了路由验证的页面
            // console.log(loginState);
            // console.log(to.path);
            if (loginState == 1) { // 门户中心有登录
                if (to.path == '/admin/setting') { // 门户中心的管理端
                    let adminState = sessionStorage.getItem('MIXPORTALSTATE');
                    if (adminState) { // 已登录
                        next();
                    } else { // 未登录
                        next({ path: '/index', query: { 'source': config.adminSource, 'url': window.location.origin + to.path } });
                    }
                } else {
                    next();
                }
            } else { // 门户中心未登录
                if (to.path == '/admin/setting') {
                    next({ path: '/login', query: { 'source': config.adminSource, 'url': window.location.origin + to.path } });
                } else {
                    next({ path: '/login' });
                }
            }
        } else { // 没有设置路由验证的
            next();
        }
    }
})

Vue.config.productionTip = false

Vue.use(ElementUI);

Vue.prototype.$getByteLength = function(val) {
    var len = 0;
    for (var i = 0; i < val.length; i++) {
        var a = val.charAt(i);
        if (a.match(/[^\x00-\xff]/ig) != null) {
            len += 2;
        } else {
            len += 1;
        }
    }
    return len;
}

window.onresize = setHtmlFontSize;
function setHtmlFontSize(){
    const htmlWidth = document.body.clientWidth || document.documentElement.clientWidth;
    const htmlDom = document.getElementsByTagName('html')[0];
    htmlDom.style.fontSize = htmlWidth / 19.2 + 'px';
};
setHtmlFontSize();

/* eslint-disable no-new */
new Vue({
    el: '#app',
    router,
    render: h => h(App)
})