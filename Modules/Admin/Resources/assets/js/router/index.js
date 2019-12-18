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
import Vue from "vue";
import Router from "vue-router";
import axios from "axios";

//通用应用组件首页
import extensionIndex from "../pages/extension/index.vue";
// 导入组件
// 根路由
import index from "../pages/index";
// 模块
import moduleIndex from "../pages/module/index";
import moduleList from "../pages/module/list";
import moduleDetail from "../pages/module/detail";

// 菜单
import menuIndex from "../pages/menu/index";
import menuList from "../pages/menu/list";

//系统设置
import settingIndex from "../pages/setting/index";
import settingDetail from "../pages/setting/detail";

//test
import iframe from "../pages/extension/iframe.vue";

Vue.use(Router);
let routers = new Router({
    routes: []
        // routes: [{
        //     path: "/",
        //     name: "index",
        //     component: index,
        //     redirect: "/po",
        //     children: [{
        //             path: "/module",
        //             name: "moduleIndex",
        //             component: moduleIndex,
        //             redirect: "/module",
        //             children: [{
        //                     path: "/module",
        //                     name: "moduleList",
        //                     component: moduleList,
        //                     meta: {
        //                         title: "模块管理",
        //                         breadcrumb: [{
        //                             name: "模块管理",
        //                             path: "/module"
        //                         }]
        //                     }
        //                 },
        //                 {
        //                     path: "/module/detail",
        //                     name: "moduleDetail",
        //                     component: moduleDetail,
        //                     meta: {
        //                         title: "模块管理",
        //                         breadcrumb: [{
        //                                 name: "模块管理",
        //                                 path: "/module"
        //                             },
        //                             {
        //                                 name: "模块详情",
        //                                 path: "/module/detail"
        //                             }
        //                         ]
        //                     }
        //                 }
        //             ]
        //         },
        //         {
        //             path: "/menu",
        //             name: "menuIndex",
        //             component: extensionIndex,
        //             redirect: "/menu",
        //             children: [{
        //                 path: "/menu",
        //                 name: "menuList",
        //                 component: menuList,
        //                 meta: {
        //                     title: "菜单管理",
        //                     breadcrumb: [{
        //                         name: "菜单管理",
        //                         path: "/menu"
        //                     }]
        //                 }
        //             }]
        //         },
        //         {
        //             path: "/setting",
        //             name: "settingIndex",
        //             component: settingIndex,
        //             redirect: "/setting",
        //             children: [{
        //                 path: "/setting",
        //                 name: "setttingDetail",
        //                 component: settingDetail,
        //                 meta: {
        //                     title: "系统设置",
        //                     breadcrumb: [{
        //                         name: "系统设置",
        //                         path: "/setting"
        //                     }]
        //                 }
        //             }]
        //         },
        //     ]
        // }]
});
axios({
        url: "/admin/getRoute",
        method: "post",
        responseType: "json",
        timeout: 10000
    })
    .then(response => {
        let data = response.data.result;
        console.log('data', data);
        let first_route = data[0] ? data[0].redirect : '_blank';
        let temp = handleRouteTree(data);
        let childRoute = [{
            path: "/",
            name: "index_extension",
            component: index,
            redirect: first_route,
            children: temp
        }];
        console.log('children', childRoute);
        routers.addRoutes(childRoute);
        console.log('routers', routers);
    })
    .catch(error => {
        console.log(error);
        resolve(error);
    });

function handleRouteTree(data) {
    let route = {};
    for (var index in data) {
        if (typeof data[index].children != "undefined") {
            data[index].component = resolve =>
                require(["../pages/extension/index.vue"], resolve);
            data[index].children = handleRouteTree(data[index].children);
        } else {
            data[index].component = iframe;
            data[index].props = {
                route: data[index].path,
                name: data[index].path,
                subRoute: data[index].subPath,
            };
        }
    }
    return data;
}

export default routers;