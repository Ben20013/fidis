<!--
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
 -->
<template>
    <div class="left-box flex-column">
        <div class="admin-logo flex-wrap">
            <img src="/images/public/messenger-logo.png" alt="MIXAdmin" />
            <span>FIDIS Admin</span>
        </div>
        <div class="menu-box flex-column">
            <div class="menu-item-wrap" v-for="(item,index) in menuList" :key="item.uid">
                <div
                    class="main-menu-item-wrap"
                    @click="showSubmenuToggle(item)"
                    v-on:mouseenter="isHover=index"
                    v-on:mouseleave="isHover=-1"
                >
                    <router-link
                        v-if="!item.children.length"
                        tag="div"
                        :to="item.route"
                        class="flex-wrap menu-item"
                        :class="{'active':regexPath(item.route,$route.path)}"
                    >
                        <div class="flex-wrap content">
                            <i :class="item.icon"></i>
                            <span class="mt2">{{item.name}}</span>
                            <i
                                class="arrow arrow-down"
                                v-if="item.children.length"
                                :class="{'arrow-up':item.isSubmenuShow}"
                            ></i>
                        </div>
                    </router-link>
                    <div
                        v-else
                        class="flex-wrap menu-item"
                        :class="{'active':regexPath(item.route,$route.path),'has-child':item.params}"
                    >
                        <div class="flex-wrap content">
                            <i :class="item.icon"></i>
                            <span class="mt2">{{item.name}}</span>
                            <i
                                class="arrow arrow-down"
                                v-if="item.children.length"
                                :class="{'arrow-up':(item.isSubmenuShow || $route.path.indexOf(item.route)===0)}"
                            ></i>
                        </div>
                    </div>
                </div>
                <div
                    class="sub-menu-item-wrap"
                    v-if="item.children.length"
                    :class="{'hide':(!item.isSubmenuShow && $route.path.indexOf(item.route)!==0)}"
                >
                    <router-link
                        v-for="(citem,cindex) in item.children"
                        :key="citem.uid"
                        tag="div"
                        :to="citem.route"
                        class="flex-wrap menu-item"
                        :class="{'active':regexPath(citem.route,$route.path)}"
                    >
                        <div class="flex-wrap content">
                            <span class="sub-txt">{{citem.name}}</span>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import menuConfig from "../config/left-menu.conf";
import indexApi from "../fetch/index";

export default {
    name: "leftMenu",
    props: {
        isExpand: Boolean
    },
    data() {
        return {
            loginType: "",
            menuList: [],
            isHover: -1
        };
    },
    created() {},
    mounted() {
        this.getMenuList();
    },
    methods: {
        regexPath(type, path) {
            let reg = new RegExp(
                // "^/" + type + "(/list)?|/" + type + "(/detail)?(?:/(?=$))?$"
                "^/" +
                    type +
                    "(/list)?|/" +
                    type +
                    "(/detail)?|" +
                    type +
                    "(?:/(?=$))?$"
            );
            return reg.test(path);
        },
        isActiveMenu(item) {
            if (typeof item.children != "undefined") {
                return this.$route.query._menuid === item.uid;
            } else {
                return this.$route.query._menuid === item.uid;
            }
        },
        showSubmenuToggle(item) {
            // 是否需要遍历menuList关闭其他展开的菜单？
            if (item.children.length) {
                item.isSubmenuShow = !item.isSubmenuShow;
            }
        },
        getMenuList() {
            let self = this;
            indexApi.getMenuList(data => {
                if (data.code == 200) {
                    console.log("menulist");
                    self.menuList = data.result;
                    console.log(self.menuList);
                }
            });
        }
    },
    watch: {}
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../sass/components/left-menu.scss";
</style>
<style>
.fa-1x {
    font-size: 1.3em;
}
</style>

