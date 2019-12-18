require('./bootstrap');
import Vue from 'vue';
window.Vue = require('vue');
import VueRouter from 'vue-router';
import routers from './router.js';
import iView from 'iview';
import 'iview/dist/styles/iview.css';

Vue.use(VueRouter);
Vue.use(iView);

const router = new VueRouter({
    routes: routers
});
const app = new Vue({
    router,
    el: '#app'
});
