const routers = [{
    path: '/',
    meta: {
        title: ''
    },
    component: (resolve) => require(['./components/home.vue'], resolve)
}];
export default routers;