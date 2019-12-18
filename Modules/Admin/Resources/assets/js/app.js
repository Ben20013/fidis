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
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

window.Vue = require('vue');
import router from './router/index'
import vueBus from './vue-bus/index'
import '../font/fontawesome-5.8.2/css/all.min.css'
import ElementUI from 'element-ui'
import '../css/element-theme/index.css'
import mixBase from './utils/mix-base'
import VueI18n from 'vue-i18n'
//import './promission' //这里进行路由后台获取的模拟

import $ from 'jquery'

Vue.use(vueBus)
Vue.use(ElementUI);
Vue.use(mixBase);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('examplecomponent', require('./components/ExampleComponent.vue'));
Vue.component('mix-modal', require('./components/mix-modal.vue').default);
Vue.component('mix-tab', require('./components/mix-tab.vue').default);
Vue.component('mix-condition-search', require('./components/mix-condition-search.vue').default);
Vue.component('mix-table', require('./components/mix-table.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import i18n from '../../lang/i18n'
const app = new Vue({
    router,
    i18n
}).$mount('#app');
