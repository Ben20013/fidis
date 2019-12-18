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
import axios from "axios";

import system from '$system'
import index from '@/assets/js/page/index'
import home from '@/assets/js/page/home/home'
import customer from '@/assets/js/page/customer/customer'
import customerList from '@/assets/js/page/customer/list'
import customerDetail from '@/assets/js/page/customer/detail'
import device from '@/assets/js/page/device/device'
import deviceList from '@/assets/js/page/device/list'
import deviceDetail from '@/assets/js/page/device/detail'
import station from '@/assets/js/page/station/station'
import stationList from '@/assets/js/page/station/list'
import stationDetail from '@/assets/js/page/station/detail'
import event from '@/assets/js/page/event/event'
import eventList from '@/assets/js/page/event/list'
import eventDetail from '@/assets/js/page/event/detail'
import report from '@/assets/js/page/report/report'
import reportList from '@/assets/js/page/report/list'
import reportDetail from '@/assets/js/page/report/detail'
// import message from '@/assets/js/page/message/message'
// import messageList from '@/assets/js/page/message/list'
import task from '@/assets/js/page/task/task'
import taskList from '@/assets/js/page/task/list'
import taskDetail from '@/assets/js/page/task/detail'
import user from '@/assets/js/page/user/user'
import userList from '@/assets/js/page/user/list'
import userDetail from '@/assets/js/page/user/detail'
import setting from '@/assets/js/components/setting/setting'

import grid from '@/assets/js/page/grid/grid'
import equipment from '@/assets/js/page/singleEquipment/equipment'
import singleCustomerList from '@/assets/js/page/singleEquipment/customerList'
import singleCustomerDetail from '@/assets/js/page/singleEquipment/customerDetail'


import login from '@/assets/js/page/login/login'
import register from '@/assets/js/page/register/register'

import iframe from "@/assets/js/page/extension/iframe.vue";

import diagResultIndex from "@/assets/js/page/diag/index.vue";
import diagResultDetail from "@/assets/js/page/diag/detail.vue";

//import aplec from "../../../../../Aplec/Resources/assets/js/pages/aprus/list";

Vue.use(Router)
let routers = new Router({
    // mode: 'history',
    routes: [{
            path: '/',
            name: 'index',
            component: index,
            meta: {
                auth: true
            },
            redirect: '/index',
            children: [{
                    path: 'index',
                    name: 'home',
                    component: home,
                    meta: {
                        auth: true,
                        title: 'nav_home',
                        isParent: true
                    }
                },
                {
                    path: '/customer',
                    name: 'customer',
                    component: customer,
                    redirect: '/customer/list',
                    meta: {
                        auth: true,
                        title: 'nav_customer',
                        isParent: true
                    },
                    children: [{
                            path: '/customer/list',
                            name: 'customerList',
                            component: customerList,
                            meta: {
                                auth: true,
                                title: 'nav_customer',
                                isParent: true
                            }
                        },
                        {
                            path: '/customer/detail',
                            name: 'customerDetail',
                            component: customerDetail,
                            meta: {
                                auth: true,
                                title: '详情',
                                isParent: false
                            },
                            children: [{
                                path: '/customer/detail/equipment',
                                name: 'customerDetailEquipment',
                                component: deviceDetail,
                                meta: {
                                    auth: true,
                                    title: '详情',
                                    isParent: false
                                }
                            }]
                        },
                    ]
                },
                {
                    path: '/station',
                    name: 'station',
                    component: station,
                    redirect: '/station/list',
                    meta: {
                        auth: true,
                        title: system.name,
                        isParent: true
                    },
                    children: [{
                            path: '/station/list',
                            name: 'stationList',
                            component: stationList,
                            meta: {
                                auth: true,
                                title: system.name,
                                isParent: true
                            }
                        },
                        {
                            path: '/station/detail',
                            name: 'stationDetail',
                            component: stationDetail,
                            meta: {
                                auth: true,
                                title: '详情',
                                isParent: false
                            },
                            children: [{
                                path: '/station/detail/equipment',
                                name: 'stationDetailEquipment',
                                component: deviceDetail,
                                meta: {
                                    auth: true,
                                    title: '详情',
                                    isParent: false
                                }
                            }]
                        },
                    ]
                },
                {
                    path: '/device',
                    name: 'device',
                    component: device,
                    redirect: '/device/list',
                    meta: {
                        auth: true,
                        title: 'nav_equipment',
                        isParent: true
                    },
                    children: [{
                            path: '/device/list',
                            name: 'deviceList',
                            component: deviceList,
                            meta: {
                                auth: true,
                                title: 'nav_equipment',
                                isParent: true
                            }
                        },
                        {
                            path: '/device/detail',
                            name: 'deviceDetail',
                            component: deviceDetail,
                            meta: {
                                auth: true,
                                title: '详情',
                                isParent: false
                            }
                        },
                    ]
                },
                {
                    path: '/event',
                    name: 'event',
                    component: event,
                    redirect: '/event/list',
                    meta: {
                        auth: true,
                        title: 'nav_event',
                        isParent: true
                    },
                    children: [{
                            path: '/event/list',
                            name: 'eventList',
                            component: eventList,
                            meta: {
                                auth: true,
                                title: 'nav_event',
                                isParent: true
                            }
                        },
                        {
                            path: '/event/detail',
                            name: 'eventDetail',
                            component: eventDetail,
                            meta: {
                                auth: true,
                                title: '详情',
                                isParent: false
                            }
                        },
                    ]
                },
                {
                    path: '/report',
                    name: 'report',
                    component: report,
                    redirect: '/report/list',
                    meta: {
                        auth: true,
                        title: 'nav_report',
                        isParent: true
                    },
                    children: [{
                            path: '/report/list',
                            name: 'reportList',
                            component: reportList,
                            meta: {
                                auth: true,
                                title: 'nav_report',
                                isParent: true
                            }
                        },
                        {
                            path: '/report/detail',
                            name: 'reportDetail',
                            component: reportDetail,
                            meta: {
                                auth: true,
                                title: '详情',
                                isParent: false
                            }
                        },
                    ]
                },
                {
                    path: '/task',
                    name: 'task',
                    component: task,
                    redirect: '/task/list',
                    meta: {
                        auth: true,
                        title: 'nav_task',
                        isParent: true
                    },
                    children: [{
                            path: '/task/list',
                            name: 'taskList',
                            component: taskList,
                            meta: {
                                auth: true,
                                title: 'nav_task',
                                isParent: true
                            }
                        },
                        {
                            path: '/task/detail',
                            name: 'taskDetail',
                            component: taskDetail,
                            meta: {
                                auth: true,
                                title: '详情',
                                isParent: false
                            }
                        },
                    ]
                },
                {
                    path: '/user',
                    name: 'user',
                    component: user,
                    redirect: '/user/list',
                    meta: {
                        auth: true,
                        title: 'nav_user',
                        isParent: true
                    },
                    children: [{
                            path: '/user/list',
                            name: 'userList',
                            component: userList,
                            meta: {
                                auth: true,
                                title: 'nav_user',
                                isParent: true
                            }
                        },
                        {
                            path: '/user/detail',
                            name: 'userDetail',
                            component: userDetail,
                            meta: {
                                auth: true,
                                title: '详情',
                                isParent: false
                            }
                        },
                    ]
                },
                {
                    path: '/setting',
                    name: 'setting',
                    component: setting,
                    meta: {
                        auth: true,
                        title: 'nav_setting',
                        isParent: true
                    }
                },
                {
                    path: '/diag',
                    name: 'DiagResult',
                    component: diagResultIndex,
                    redirect: '/diag/result/detail',
                    meta: {
                        auth: true,
                        title: 'nav_diag',
                        isParent: true
                    },
                    children: [{
                        path: '/diag/result/detail',
                        name: 'diagResultDetail',
                        component: diagResultDetail,
                        meta: {
                            auth: true,
                            title: 'nav_user',
                            isParent: true
                        }
                    }, ]
                }
            ]
        },

        {
            path: '/login',
            name: 'login',
            component: login,
        },
        {
            path: '/register',
            name: 'register',
            component: register,
        },
        // 隐藏链接
        {
            path: '/grid',
            name: 'grid',
            component: grid,
            meta: {
                auth: true
            }
        },
        {
            path: '/list',
            name: 'singleCustomerList',
            component: singleCustomerList,
            meta: {
                auth: false
            }
        },
        {
            path: '/equipment',
            name: 'equipment',
            component: equipment,
            meta: {
                auth: false
            }
        },
        {
            path: '/customer_detail',
            name: 'singleCustomerDetail',
            component: singleCustomerDetail,
            meta: {
                auth: false
            }
        },

    ]
})
axios({
        url: "/pro/getRoute",
        method: "post",
        responseType: "json",
        timeout: 10000
    })
    .then(response => {
        console.log('response', response);
        let data = response.result;

        let temp = handleRouteTree(data);
        let childRoute = [{
            path: "/",
            name: "index_extension",
            component: index,
            redirect: "/module",
            children: temp
        }];
        console.log('children', childRoute);
        routers.addRoutes(childRoute);
        console.log('routers', routers);
    })
    .catch(error => {
        console.log(error);
        //resolve(error);
    });

function handleRouteTree(data) {
    let route = {};
    for (var index in data) {
        if (typeof data[index].children != "undefined") {
            data[index].component = resolve =>
                require(["@/assets/js/page/extension/index.vue"], resolve);
            data[index].children = handleRouteTree(data[index].children);
        } else {
            data[index].component = iframe;
            data[index].props = {
                route: data[index].path,
                subRoute: data[index].subPath,
            };
        }
    }
    return data;
}
export default routers;