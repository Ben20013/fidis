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
import '../font/fontawesome-5.8.2/css/all.min.css'
import ElementUI from 'element-ui'
import '../css/element-theme/index.css'
import VueI18n from 'vue-i18n'

import $ from 'jquery'

Vue.use(ElementUI);

Vue.component('mix-modal', require('./components/mix-modal.vue'));
Vue.component('mix-tab', require('./components/mix-tab.vue'));
Vue.component('mix-condition-search', require('./components/mix-condition-search.vue'));
Vue.component('mix-table', require('./components/mix-table.vue'));

import i18n from '../../lang/i18n'
const app = new Vue({
    router,
    i18n
}).$mount('#app');
