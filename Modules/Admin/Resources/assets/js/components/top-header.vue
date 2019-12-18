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
    <div class="header flex-wrap">
        <div class="left-header flex-wrap">
            <div class="time-tip flex-wrap">
                <el-breadcrumb
                    separator-class="el-icon-arrow-right"
                    style="line-height: 50px;margin-left: 20px;"
                >
                    <el-breadcrumb-item v-if="this.$route.path!='/'" :to="{ path: '/' }">首页</el-breadcrumb-item>
                    <el-breadcrumb-item v-for="(route, index) in routes" :key="route.index">
                        <a @click="breadClick(route.path)">{{route.name}}</a>
                    </el-breadcrumb-item>
                    <!-- <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                    <el-breadcrumb-item :to="{ path: '/' }">模块管理</el-breadcrumb-item>
                    <el-breadcrumb-item>模块列表</el-breadcrumb-item>
                    <el-breadcrumb-item>模块详情</el-breadcrumb-item>-->
                </el-breadcrumb>
            </div>
        </div>
        <div class="right-header flex-wrap">
            <div class="full-screen" @click="fullScreen">
                <i class="full-screen-icon"></i>
            </div>
            <div
                class="version"
                :class="{'active':isShowVersion}"
                @mouseover="isShowVersion=true"
                @mouseleave="isShowVersion=false"
            >
                <i class="version-icon"></i>
            </div>
            <div
                class="version-info flex-column"
                v-show="isShowVersion"
                @mouseover="isShowVersion=true"
                @mouseleave="isShowVersion=false"
            >
                <div class="info-title">
                    <span class="text">当前版本：</span>
                    <span class="value">{{versionInfoData.version}}</span>
                </div>
                <div
                    class="info-sub-title"
                    v-show="versionInfoData.kernel_version"
                >(内核版本：{{versionInfoData.kernel_version}})</div>
                <div class="info-split"></div>
                <div class="info-content flex-wrap">
                    <div class="warn-icon">
                        <i></i>
                    </div>
                    <div
                        class="warn-text"
                    >本计算机程序受版权法及国际公约的保护，未经授权擅自复制或散布本程序的部分或全部，将承受严厉的民事和刑事处罚，对已知的违反者将给予法律范围内的全面制裁。</div>
                </div>
            </div>
            <div
                class="user-wrap flex-wrap flex-center"
                :class="{'active':isShowMenu}"
                @mouseover="isShowMenu=true"
                @mouseleave="isShowMenu=false"
            >
                <img class="user-icon" src="/images/public/default-user-icon.png" />
                <div class="user-name">{{userInfoData.username || 'admin'}}</div>
                <div class="arrow-down"></div>
            </div>
            <div
                class="user-menu"
                v-show="isShowMenu"
                @mouseover="isShowMenu=true"
                @mouseleave="isShowMenu=false"
            >
                <div class="menu-item flex-wrap" @click="isShowMenu=false;openUserInfoWin()">
                    <span class="ic_user"></span>
                    <span>账户信息</span>
                </div>
                <!-- <div class="menu-item flex-wrap" @click="logout">
                    <span class="ic_user"></span>
                    <span>用户登出</span>
                </div> -->
                <!-- <div
                    class="menu-item flex-wrap"
                    @mouseover="isShowLanguage=true"
                    @mouseleave="isShowLanguage=false"
                >
                    <span class="ic_language"></span>
                    <span>语言设置</span>
                </div>-->
            </div>
            <div
                class="language-menu"
                v-show="isShowLanguage"
                @mouseover="isShowMenu=true;isShowLanguage=true"
                @mouseleave="isShowMenu=false;isShowLanguage=false"
            >
                <div class="menu-item flex-wrap" @click="toggleLang('zh')">
                    <span class="check">
                        <i :class="{'active':$i18n.locale=='zh'}"></i>
                    </span>
                    <span>简体中文</span>
                </div>
                <div class="menu-item flex-wrap" @click="toggleLang('en')">
                    <span class="check">
                        <i :class="{'active':$i18n.locale=='en'}"></i>
                    </span>
                    <span>English</span>
                </div>
            </div>
        </div>
        <div class="md-mask" :class="{ 'active': md.mask}"></div>
        <!--账户信息-->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 user-info-win" :class="{ 'md-show': md.userinfo}">
                <div class="md-content">
                    <!--头部-->
                    <div class="title-box flex-wrap flex-center">
                        <div class="title">账户信息</div>
                        <div class="icon-wrap" @click="closeMd('userinfo')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div class="cont-box">
                        <div class="user-info-content flex-column">
                            <div class="baseInfo flex-wrap">
                                <div class="leftContent">
                                    <img src="/images/public/default-user-large-icon.png" alt />
                                </div>
                                <div class="rightContent">
                                    <div class="info-wrap flex-wrap">
                                        <div class="item">
                                            <span class="name">登录账号 ：</span>
                                            <span
                                                class="value"
                                                v-if="userInfoData"
                                            >{{userInfoData.username}}</span>
                                        </div>
                                        <div class="item">
                                            <span class="name">手机号码 ：</span>
                                            <span
                                                class="value"
                                                v-if="userInfoData"
                                            >{{ userInfoData.mobile }}</span>
                                        </div>
                                        <div class="item">
                                            <span class="name">登录角色 ：</span>
                                            <span
                                                class="value"
                                                v-if="userInfoData"
                                            >{{userInfoData.is_super==1?'超级管理员':'普通用户'}}</span>
                                        </div>
                                        <div class="item">
                                            <span class="name">邮箱 ：</span>
                                            <span
                                                class="value"
                                                v-if="userInfoData"
                                            >{{ userInfoData.email }}</span>
                                        </div>
                                        <div class="item time">
                                            <span class="name">注册时间 ：</span>
                                            <span
                                                class="value"
                                                v-if="userInfoData"
                                            >{{ userInfoData.created }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="name">地址</div>
                                <div class="value">
                                    <el-input
                                        v-model="userInfoData.address"
                                        readonly
                                        class="mix-input"
                                        :class="{'mix-active-input':userInfoData.address!=''}"
                                        placeholder
                                        :value="userInfoData.address"
                                    ></el-input>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="name">描述</div>
                                <div class="value">
                                    <el-input
                                        type="textarea"
                                        readonly
                                        :rows="2"
                                        class="mix-input"
                                        :class="{'mix-active-input':userInfoData.description!=''}"
                                        placeholder
                                        :value="userInfoData.description"
                                        v-model="userInfoData.description"
                                    ></el-input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="buttom-box flex-wrap flex-center">
                        <!-- <input type="button"  class="btn-cancel" @click="closeMd('userinfo')" value="取消"/>
                        <input type="button"  class="btn-determine" @click="submitUserInfo" value="确认"/>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import baseApi from "../fetch/module/base.js";
export default {
    name: "topHeader",
    data() {
        return {
            versionInfoData: {
                version: "",
            },
            isShowMenu: false,
            isShowVersion: false,
            isShowLanguage: false,
            currLanguage: "",
            userInfoData: {
                address: "",
                description: ""
            },
            md: {
                mask: false,
                userinfo: false
            },
            routes: []
        };
    },
    created() {},
    mounted() {
        this.getVersion();
        // this.getUser();
        this.updateRouteList();
    },
    methods: {
        getVersion() {
            let self = this;

            baseApi.get_version(function(data) {
                if (data.code == 200) {
                    self.versionInfoData = data.result;
                }
            }, {});
        },
        fullScreen() {
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
            }
        },
        toast(msg, type) {
            this.$message({
                message: msg,
                type: type
            });
        },
        openUserInfoWin() {
            this.showMd("userinfo");
            this.getUser();
        },
        getUser() {
            let self = this;
            let user = JSON.parse(localStorage.getItem('user'));
            baseApi.get_user(data => {
                if (data.code == 200) {
                    if (data.result) {
                        self.userInfoData = data.result;
                    }
                }
            },
                { user_id: user.user_id, ticket: user.ticket });
        },
        logout() {
            window.location.href = "/logout";
        },
        submitUserInfo() {
            if (this.userInfoData == null) {
                return false;
            }
            let self = this;
            baseApi.edit_user(data => {
                if (data.code == 200) {
                    self.closeMd("userinfo");
                    self.toast("修改成功!", "success");
                } else {
                    this.toast(data.msg, "warning");
                }
            }, this.userInfoData);
        },
        showMd(md) {
            this.md[md] = true;
            this.md.mask = true;
        },
        closeMd(md) {
            this.md[md] = false;
            this.md.mask = false;
        },
        updateRouteList(data) {
            this.routes = [];
            let path = this.$route.path;
            let label = this.$route.meta.label;
            this.routes = this.$route.meta.breadcrumb;
            console.log("routes", this.routes);
        },
        addBreadCrumbRoute(data) {
            console.log("header", data);
            console.log('this.routes', this.routes);
            this.routes.push({
                path: "",
                name: data
            });
        },
        breadClick(data) {
            console.log(data);
            if(data){
                this.$router.push({
                    //name: "aprusList",
                    path: data
                });
            }
        }
    },
    watch: {
        $route: "updateRouteList"
    }
};
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../sass/components/top-header.scss";
</style>
