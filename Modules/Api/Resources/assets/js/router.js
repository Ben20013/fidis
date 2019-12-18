const routers = [{
    path: '/',
    name: 'index',
    component: (resolve) => require(['./components/index.vue'], resolve),
    redirect: '/doc',
    children: [{
        path: '/doc',
        meta: {
            title: ''
        },
        component: (resolve) => require(['./components/doc.vue'], resolve)
    }]
}];
export default routers;