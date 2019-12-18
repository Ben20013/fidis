import Vue from "vue";
import Router from "vue-router";
import axios from "axios";

// 根路由
import index from "../pages/index";
// 模块
import projectIndex from "../pages/project/index";
import projectList from "../pages/project/list";
// import projectDetail from "../pages/project/detail";

// 菜单
import resultIndex from "../pages/result/index";
import resultList from "../pages/result/list";


Vue.use(Router);
let routers = new Router({
    routes: [{
            path: "/project",
            name: "projectIndex",
            component: projectIndex,
            redirect: "/project",
            children: [{
                path: "/project",
                name: "projectList",
                component: projectList,
                meta: {
                    title: "项目管理",
                    breadcrumb: [{
                        name: "项目管理",
                        path: "/project"
                    }]
                }
            }]
        },
        {
            path: "/result",
            name: "resultIndex",
            component: resultIndex,
            redirect: "/result",
            children: [{
                path: "/result",
                name: "resultList",
                component: resultList,
                meta: {
                    title: "菜单管理",
                    breadcrumb: [{
                        name: "菜单管理",
                        path: "/result"
                    }]
                }
            }]
        },
    ]
});
export default routers;