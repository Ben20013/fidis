// require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router';
import Routers from './router';
import iView from 'iview';
import 'iview/dist/styles/iview.css';

Vue.use(VueRouter);
Vue.use(iView);
const router = new VueRouter({
    routes: Routers
});

const app = new Vue({
    el: '#app',
    router,
})