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
    <div class="leftBox flex-column" :class="{'expand':isExpand}">
        <div class="mixpro-logo flex-wrap">
            <img src="../../images/public/pro-logo.png" alt="MIXPRO" />
            <span v-show="isExpand">FIDIS Pro</span>
        </div>
        <div class="menu-box flex-column">
            <router-link
                tag="div"
                to="/index"
                class="flex-wrap menu-item"
                :class="{'active':regexPath('index',$route.path)}"
            >
                <el-tooltip
                    class="item"
                    effect="dark"
                    :content="$t('common.nav_home')"
                    placement="right"
                    :disabled="isExpand"
                >
                    <div class="flex-wrap content">
                        <i class="fas fa-home fa-1x"></i>
                        <span class="mt2" v-show="isExpand">{{$t('common.nav_home')}}</span>
                    </div>
                </el-tooltip>
            </router-link>

            <router-link
                tag="div"
                to="/customer"
                class="flex-wrap menu-item"
                :class="{'active':regexPath('customer',$route.path)}"
            >
                <el-tooltip
                    class="item"
                    effect="dark"
                    :content="$t('common.nav_customer')"
                    placement="right"
                    :disabled="isExpand"
                >
                    <div class="flex-wrap content">
                        <i class="fas fa-address-book fa-1x"></i>
                        <span v-show="isExpand">{{$t('common.nav_customer')}}</span>
                    </div>
                </el-tooltip>
            </router-link>
            <router-link
                v-if="systemName"
                tag="div"
                to="/station"
                class="flex-wrap menu-item"
                :class="{'active':regexPath('station',$route.path)}"
            >
                <el-tooltip
                    class="item"
                    effect="dark"
                    :content="$t('systemLang[\''+systemName+'\']')"
                    placement="right"
                    :disabled="isExpand"
                >
                    <div class="flex-wrap content">
                        <i class="fas fa-layer-group fa-1x"></i>
                        <span v-show="isExpand">{{$t("systemLang['"+systemName+"']")}}</span>
                    </div>
                </el-tooltip>
            </router-link>
            <router-link
                tag="div"
                to="/device"
                class="flex-wrap menu-item"
                :class="{'active':regexPath('device',$route.path)}"
            >
                <el-tooltip
                    class="item"
                    effect="dark"
                    :content="$t('common.nav_equipment')"
                    placement="right"
                    :disabled="isExpand"
                >
                    <div class="flex-wrap content">
                        <i class="fas fa-server fa-1x"></i>
                        <span v-show="isExpand">{{$t('common.nav_equipment')}}</span>
                    </div>
                </el-tooltip>
            </router-link>
            <router-link
                tag="div"
                to="/event"
                v-show="loginType==1"
                class="flex-wrap menu-item"
                :class="{'active':regexPath('event',$route.path)}"
            >
                <el-tooltip
                    class="item"
                    effect="dark"
                    :content="$t('common.nav_event')"
                    placement="right"
                    :disabled="isExpand"
                >
                    <div class="flex-wrap content">
                        <i class="fas fa-list-alt fa-1x"></i>
                        <span v-show="isExpand">{{$t('common.nav_event')}}</span>
                    </div>
                </el-tooltip>
            </router-link>
            <router-link
                tag="div"
                to="/report"
                v-show="loginType==1"
                class="flex-wrap menu-item"
                :class="{'active':regexPath('report',$route.path)}"
            >
                <el-tooltip
                    class="item"
                    effect="dark"
                    :content="$t('common.nav_report')"
                    placement="right"
                    :disabled="isExpand"
                >
                    <div class="flex-wrap content">
                        <i class="fas fa-file-contract fa-1x"></i>
                        <span v-show="isExpand">{{$t('common.nav_report')}}</span>
                    </div>
                </el-tooltip>
            </router-link>
            <router-link
                tag="div"
                to="/task"
                v-show="loginType==1"
                class="flex-wrap menu-item"
                :class="{'active':regexPath('task',$route.path)}"
            >
                <el-tooltip
                    class="item"
                    effect="dark"
                    :content="$t('common.nav_task')"
                    placement="right"
                    :disabled="isExpand"
                >
                    <div class="flex-wrap content">
                        <i class="fas fa-tasks fa-1x"></i>
                        <span v-show="isExpand">{{$t('common.nav_task')}}</span>
                    </div>
                </el-tooltip>
            </router-link>
            <router-link
                v-for="(route, index) in routes"
                :key="index"
                tag="div"
                :to="route.to"
                class="flex-wrap menu-item"
                :class="{'active':regexPath(route.reg,$route.path)}"
            >
                <el-tooltip
                    class="item"
                    effect="dark"
                    :content="route.name"
                    placement="right"
                    :disabled="isExpand"
                >
                    <div class="flex-wrap content">
                        <i :class="route.icon"></i>
                        <span v-show="isExpand">{{route.name}}</span>
                    </div>
                </el-tooltip>
            </router-link>
            <router-link
                tag="div"
                to="/setting"
                v-show="loginType==1"
                class="flex-wrap menu-item"
                :class="{'active':regexPath('setting',$route.path)}"
            >
                <el-tooltip
                    class="item"
                    effect="dark"
                    :content="$t('common.nav_setting')"
                    placement="right"
                    :disabled="isExpand"
                >
                    <div class="flex-wrap content">
                        <i class="fas fa-cog fa-1x"></i>
                        <span v-show="isExpand">{{$t('common.nav_setting')}}</span>
                    </div>
                </el-tooltip>
            </router-link>
        </div>
    </div>
</template>

<script>
import system from "$system";
import axios from "axios";

export default {
    name: "leftMenu",
    props: {
        isExpand: Boolean
    },
    data() {
        return {
            systemName: system.name,
            loginType: "",
            routes: []
        };
    },
    created() {
        var user = localStorage.getItem("user");
        this.loginType = JSON.parse(user).is_super;
    },
    mounted() {
        // console.log(this.$route.path);
        // console.log(/^\/customer(\/detail)?(?:\/(?=$))?$/i.test(this.$route.path));
        this.getRoutes();
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
        expand(data) {
            // console.log(data);
        },
        getRoutes() {
            let self = this;
            axios({
                url: "/pro/getMenuRoute",
                method: "post",
                responseType: "json",
                timeout: 10000
            })
                .then(response => {
                    self.routes = response.result;
                    console.log('routes', self.routes);
                })
                .catch(error => {
                    console.log(error);
                    //resolve(error);
                });
        }
    },
    watch: {
        isExpand: ["expand"]
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
.leftBox {
    position: relative;
    width: 64px;
    min-width: 64px;
    height: 100%;
    // overflow: hidden;
    transition: width 0.5s ease 0s;
    -moz-transition: width 0.5s ease 0s; /* Firefox 4 */
    -webkit-transition: width 0.5s ease 0s; /* Safari and Chrome */
    -o-transition: width 0.5s ease 0s; /* Opera */
    &.expand {
        width: 180px;
    }
}
.mixpro-logo {
    width: 100%;
    line-height: 50px;
    height: 50px;
    background-color: #111e31;
    font-family: DIN-Medium;
    font-size: 20px;
    font-weight: normal;
    font-stretch: normal;
    letter-spacing: 0px;
    color: #ffffff;
    border-style: none;
    align-items: center;
    img {
        margin-left: 20px;
    }
    span {
        margin-left: 11px;
    }
}
.menu-box {
    flex: 1;
    background-color: #242d3d;
    box-shadow: 5px 0px 6px -3px #dddddd;
    padding-top: 10px;
    .menu-item {
        height: 48px;
        font-family: MicrosoftYaHei;
        font-size: 14px;
        font-weight: normal;
        font-stretch: normal;
        letter-spacing: 0px;
        color: #959eb4;
        align-items: center;
        padding-left: 24px;
        cursor: pointer;
        .content {
            flex: 1;
            height: 100%;
            align-items: center;
            white-space: nowrap;
            overflow: hidden;
            outline: none;
            &.focusing {
                outline: none;
            }
        }
        img {
            width: 16px;
            height: 16px;
        }
        span {
            margin-left: 14px;
            flex: 1;
            height: 16px;
            transition: width 0.5s ease 0s;
            -moz-transition: width 0.5s ease 0s; /* Firefox 4 */
            -webkit-transition: width 0.5s ease 0s; /* Safari and Chrome */
            -o-transition: width 0.5s ease 0s; /* Opera */
            &.mt2 {
                margin-top: 2px;
            }
        }
        &:hover {
            background: #0e131a;
        }
        &.active {
            background: #4162ff;
            color: #ffffff;
        }
    }
}
.fa-1x {
    font-size: 1.3em;
    width: 16px;
}
</style>
