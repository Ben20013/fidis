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
            <div class="nav-icon flex-wrap" @click="expand">
                <i :class="{'expand':!isExpand,'not-expand':isExpand}"></i>
            </div>
            <div class="time-tip flex-wrap">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item
                        v-if="this.$route.path!='/index'"
                        :to="{ path: '/index' }"
                    >{{$t('common["nav_home"]')}}</el-breadcrumb-item>
                    <el-breadcrumb-item
                        v-if="routeList.length"
                        :to="{ path: routeList[0].path }"
                    >{{$t('common["'+routeList[0].meta.title+'"]')}}</el-breadcrumb-item>
                    <el-breadcrumb-item
                        v-if="routeList.length>1"
                        :to="{ path: routeList[1].path,params:routeList[2]?routeList[2]['params']:{} }"
                    >{{navTitle?navTitle:routeList[1].meta.title}}</el-breadcrumb-item>
                    <el-breadcrumb-item
                        v-if="routeList.length>2"
                    >{{routeList[2]['params']['equipmentName']?routeList[2]['params']['equipmentName']:routeList[2].meta.title}}</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
        </div>
        <div class="right-header flex-wrap">
            <div class="qr-code" @click="openQrCodeWin">
                <i class="qr-code-icon"></i>
            </div>
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
                v-if="aboutInfoData!=null"
                v-show="isShowVersion"
                @mouseover="isShowVersion=true"
                @mouseleave="isShowVersion=false"
            >
                <div class="info-title">
                    <span class="text">{{$t('headerLang.current_version')}}</span>
                    <span class="value">{{version}}</span>
                </div>
                <div
                    class="info-sub-title"
                    v-show="aboutInfoData.kernel"
                >({{$t('headerLang.kernel_version')}}{{aboutInfoData.kernel}})</div>
                <div class="info-split"></div>
                <div class="info-content flex-wrap portal">
                    <div class="warn-icon">
                        <i></i>
                    </div>
                    <div class="warn-text">{{aboutInfoData.warning}}</div>
                </div>
                <!-- <div class="info-copy flex-wrap">
         <div class="copyright-icon"><i></i></div>
         <div class="copyright-text" v-html="copyright"></div>
                </div>-->
            </div>
            <div class="feedback-wrap" @click="openFeedbackWin">
                <i class="feedback-icon"></i>
            </div>
            <div class="help-wrap" v-if="helpUrl!=''" @click="openHelpWin">
                <i class="help-icon"></i>
            </div>
            <div
                class="user-wrap flex-wrap flex-center"
                :class="{'active':isShowMenu}"
                @mouseover="isShowMenu=true"
                @mouseleave="isShowMenu=false"
            >
                <img class="user-icon" src="../../images/public/default-user-icon.png" />
                <div class="user-name">{{user.username}}</div>
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
                    <span>{{$t('headerLang.account_info')}}</span>
                </div>
                <div
                    class="menu-item flex-wrap"
                    @mouseover="isShowLanguage=true"
                    @mouseleave="isShowLanguage=false"
                >
                    <span class="ic_language"></span>
                    <span>{{$t('headerLang.language_settings')}}</span>
                </div>
                <!-- <div class="menu-item flex-wrap" @click="isShowMenu=false;showMd('logout');">
          <span class="ic_logout"></span>
          <span>{{$t('headerLang.logout')}}</span>
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
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">{{$t('headerLang.account_info')}}</div>
                        <div class="iconWrap" @click="closeMd('userinfo')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div class="contBox">
                        <div class="user-info-content flex-column">
                            <div class="baseInfo flex-wrap">
                                <div class="leftContent">
                                    <img src="../../images/public/default-user-large-icon.png" alt />
                                </div>
                                <div class="rightContent">
                                    <div class="info-wrap flex-wrap">
                                        <div class="item">
                                            <span class="name">{{$t('headerLang.login_account')}}</span>
                                            <span
                                                class="value"
                                                v-if="userInfoData"
                                            >{{user.username}}</span>
                                        </div>
                                        <div class="item">
                                            <span class="name">{{$t('headerLang.mobile')}}</span>
                                            <span
                                                class="value"
                                                v-if="userInfoData"
                                            >{{ userInfoData.mobile }}</span>
                                        </div>
                                        <div class="item">
                                            <span class="name">{{$t('headerLang.login_role')}}</span>
                                            <span
                                                class="value"
                                                v-if="userInfoData"
                                            >{{userInfoData.is_super==1?$t('headerLang.super_administrator'):$t('headerLang.general_user')}}</span>
                                        </div>
                                        <div class="item">
                                            <span class="name">{{$t('headerLang.email')}}</span>
                                            <span
                                                class="value"
                                                v-if="userInfoData"
                                            >{{ userInfoData.email }}</span>
                                        </div>
                                        <div class="item time">
                                            <span
                                                class="name"
                                            >{{$t('headerLang.registration_time')}}</span>
                                            <span
                                                class="value"
                                                v-if="userInfoData"
                                            >{{ userInfoData.created }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="name">{{$t('headerLang.address')}}</div>
                                <div class="value">
                                    <el-input
                                        v-model="userInfoData.address"
                                        class="mix-input"
                                        readonly
                                        :class="{'mix-active-input':userInfoData.address!=''}"
                                        placeholder
                                        :value="userInfoData.address"
                                    ></el-input>
                                </div>
                            </div>
                            <div class="info-row">
                                <div class="name">{{$t('headerLang.description')}}</div>
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
                    <!-- <div class="buttomBox flex-wrap flex-center">
              <input type="button"  class="btn_cancel" @click="closeMd('userinfo')" :value="$t('common.btn_cancel')"/>
              <input type="button"  class="btn_determine" @click="submitUserInfo" :value="$t('common.btn_determine')"/>
                    </div>-->
                </div>
            </div>
        </div>
        <!-- 退出登录提示框 start -->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 confirm-logout" :class="{ 'md-show': md.logout}">
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">{{$t('headerLang.logout')}}</div>
                        <div class="iconWrap" @click="closeMd('logout')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div class="contBox">
                        <div class="logoutTip">{{$t('headerLang.logout_tip')}}</div>
                    </div>
                    <!-- 按钮 -->
                    <div class="buttomBox flex-wrap flex-center">
                        <input
                            type="button"
                            class="btn_cancel"
                            :value="$t('common.btn_cancel')"
                            @click="closeMd('logout')"
                        />
                        <input
                            type="button"
                            class="btn_determine"
                            :value="$t('common.btn_determine')"
                            @click="logout"
                        />
                    </div>
                </div>
            </div>
        </div>
        <!-- 退出登录提示框 end -->
        <!--问题反馈-->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 feedback-win" :class="{ 'md-show': md.feedback}">
                <div class="md-content flex-column">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">{{$t('headerLang.feedback')}}</div>
                        <div class="iconWrap" @click="closeMd('feedback')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div class="contBox">
                        <div class="feedback-content flex-column">
                            <div class="row flex-wrap">
                                <div
                                    class="name"
                                    :class="{'en':$i18n.locale=='en'}"
                                >{{$t('headerLang.company_name')}}</div>
                                <div class="value">
                                    <el-input
                                        v-model="feedback.company"
                                        class="mix-input"
                                        :placeholder="$t('common.placeholder_input')"
                                    ></el-input>
                                </div>
                            </div>
                            <div class="row flex-wrap">
                                <div
                                    class="name"
                                    :class="{'en':$i18n.locale=='en'}"
                                >{{$t('headerLang.feedback_staff')}}</div>
                                <div class="value">
                                    <el-input
                                        v-model="feedback.staff"
                                        class="mix-input"
                                        :placeholder="$t('common.placeholder_input')"
                                    ></el-input>
                                </div>
                            </div>
                            <div class="row flex-wrap">
                                <div
                                    class="name"
                                    :class="{'en':$i18n.locale=='en'}"
                                >{{$t('headerLang.contact')}}</div>
                                <div class="value">
                                    <el-input
                                        v-model="feedback.contact"
                                        class="mix-input"
                                        :placeholder="$t('common.placeholder_input')"
                                    ></el-input>
                                </div>
                            </div>
                            <div class="row flex-wrap">
                                <div
                                    class="name"
                                    :class="{'en':$i18n.locale=='en'}"
                                >{{$t('headerLang.feedback_title')}}</div>
                                <div class="value">
                                    <el-input
                                        v-model="feedback.title"
                                        class="mix-input"
                                        :placeholder="$t('common.placeholder_input')"
                                    ></el-input>
                                </div>
                            </div>
                            <div class="row flex-wrap">
                                <div
                                    class="name"
                                    :class="{'en':$i18n.locale=='en'}"
                                >{{$t('headerLang.feedback_type')}}</div>
                                <div class="value">
                                    <el-select
                                        v-model="feedback.typeValue"
                                        :placeholder="$t('el.select.placeholder')"
                                        class="mix-select"
                                        popper-class="mix-select-item"
                                        :popper-append-to-body="false"
                                    >
                                        <el-option
                                            v-for="item in feedback.typeOption"
                                            :key="item.value"
                                            :label="item.label"
                                            :value="item.value"
                                        ></el-option>
                                    </el-select>
                                </div>
                            </div>
                            <div class="row flex-wrap desc">
                                <div
                                    class="name"
                                    :class="{'en':$i18n.locale=='en'}"
                                >{{$t('headerLang.feedback_content')}}</div>
                                <div class="value">
                                    <vue-editor
                                        v-model="feedback.content"
                                        :editorToolbar="feedback.customToolbar"
                                    ></vue-editor>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="buttomBox flex-wrap flex-center">
                        <input
                            type="button"
                            class="btn_determine"
                            @click="submitFeedback"
                            :value="$t('headerLang.submit_btn')"
                        />
                    </div>
                </div>
            </div>
        </div>
        <!-- 二维码 start -->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 qr-code-win" :class="{ 'md-show': md.qrcode}">
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">{{$t('headerLang.app_download')}}</div>
                        <div class="iconWrap" @click="closeMd('qrcode')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div class="contBox">
                        <div class="qr-code-wrap">
                            <div class="qr-code-icon flex-wrap">
                                <img v-if="qrCodeUrl!=''" :src="qrCodeUrl" alt />
                                <div class="no-code" v-else>{{$t('headerLang.get_qrcode_fail')}}</div>
                            </div>
                            <div class="qr-code-desc">{{$t('headerLang.qrcode_tip')}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 二维码 end -->
    </div>
</template>

<script>
import userApi from "@/assets/js/fetch/user";
import settingApi from "@/assets/js/fetch/setting";
import config from "$config";
import { VueEditor } from "vue2-editor";

export default {
    name: "topHeader",
    components: {
        VueEditor
    },
    props: {
        navTitle: String
    },
    data() {
        return {
            aboutInfoData: null,
            copyright: "",
            helpUrl: "",
            routeList: [],
            isExpand: false,
            isShowMenu: false,
            isShowVersion: false,
            isShowLanguage: false,
            version: config.pro_version,
            currLanguage: "",
            userId: "",
            user: "",
            userInfoData: {
                address: "",
                description: ""
            },
            oldpassword: "",
            newpassword: "",
            confirmnewpassword: "",
            userName: "",
            descTextarea: "",
            feedback: {
                company: "",
                staff: "",
                contact: "",
                title: "",
                typeValue: this.$t("headerLang.interface_problem"),
                typeOption: [
                    {
                        label: this.$t("headerLang.interface_problem"),
                        value: this.$t("headerLang.interface_problem")
                    },
                    {
                        label: this.$t("headerLang.system_bug"),
                        value: this.$t("headerLang.system_bug")
                    },
                    {
                        label: this.$t("headerLang.operating_habit"),
                        value: this.$t("headerLang.operating_habit")
                    }
                ],
                content: "",
                customToolbar: [
                    ["bold", "italic", "underline"],
                    [{ list: "ordered" }, { list: "bullet" }],
                    ["image", "code-block"]
                ]
            },
            qrCodeUrl: "",
            md: {
                mask: false,
                userinfo: false,
                logout: false,
                feedback: false,
                qrcode: false
            }
        };
    },
    created() {
        var user = localStorage.getItem("user");
        this.userId = JSON.parse(user).user_id;
        this.user = JSON.parse(user);
    },
    mounted() {
        this.getAboutUs();
        this.updateRouteList(this.$route);
        this.currLanguage =
            localStorage.getItem("MIXPRO_LOCALE_LANGUAGE") || "zh";
        // console.log(this.$route);
    },
    methods: {
        openQrCodeWin() {
            this.showMd("qrcode");
            let self = this;
            userApi.get_qrcode(function(data) {
                if (data.code == 200) {
                    if (data.result && data.result.filename) {
                        self.qrCodeUrl = data.result.filename;
                    }
                }
            }, {});
        },
        getAboutUs() {
            let self = this;
            userApi.get_setting_about_us(function(data) {
                if (data.code == 200) {
                    self.aboutInfoData = data.result;
                }
            }, {});
            settingApi.get_config(function(data) {
                if (data.code == 200) {
                    let result = data.result;
                    if (result["common"]) {
                        let common = result["common"];
                        document.querySelector("title").innerHTML = common[
                            "website_title"
                        ]
                            ? common["website_title"]
                            : "MIXPRO";
                        self.copyright = common["copyright"]
                            ? common["copyright"]
                            : "";
                        self.helpUrl = common["help_url"]
                            ? common["help_url"]
                            : "";
                        if (common["icon_path"]) {
                            var link =
                                document.querySelector("link[rel*='icon']") ||
                                document.createElement("link");
                            link.type = "image/x-icon";
                            link.rel = "shortcut icon";
                            link.href = common["icon_path"];
                            document
                                .getElementsByTagName("head")[0]
                                .appendChild(link);
                        }
                    }
                }
            }, {});
        },
        expand() {
            this.isExpand = !this.isExpand;
            this.$emit("is-expand", this.isExpand);
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
            let self = this;
            userApi.get(
                data => {
                    if (data.code == 200) {
                        if (data.result.data == "" || data.result.data == []) {
                        } else {
                            self.userInfoData = data.result;
                        }
                    }
                },
                { user_id: self.userId, ticket: this.user.ticket }
            );
        },
        submitUserInfo() {
            if (this.newpassword != null && this.newpassword != "") {
                if (this.confirmnewpassword != this.newpassword) {
                    this.toast(
                        this.$t("headerLang.input_password_not_eq"),
                        "warning"
                    );
                    return false;
                }
            }

            this.userInfoData.password = this.newpassword;
            if (this.userInfoData == null) {
                return false;
            }
            let self = this;
            userApi.edit(data => {
                if (data.code == 200) {
                    self.closeMd("userinfo");
                    self.toast(self.$t("headerLang.modify_success"), "success");
                    //self.userInfoData = null;
                } else {
                    this.toast(data.msg, "warning");
                }
            }, this.userInfoData);
        },
        openFeedbackWin() {
            this.feedback.company = "";
            this.feedback.staff = "";
            this.feedback.contact = "";
            this.feedback.title = "";
            this.feedback.typeValue = this.$t("headerLang.interface_problem");
            this.feedback.content = "";
            this.showMd("feedback");
        },
        submitFeedback() {
            if (this.feedback.company == "") {
                this.toast(
                    this.$t("headerLang.company_name_not_null"),
                    "warning"
                );
                return;
            }
            if (this.feedback.staff == "") {
                this.toast(
                    this.$t("headerLang.feedback_staff_not_null"),
                    "warning"
                );
                return;
            }
            if (this.feedback.contact == "") {
                this.toast(this.$t("headerLang.contact_not_null"), "warning");
                return;
            }
            if (this.feedback.title == "") {
                this.toast(
                    this.$t("headerLang.feedback_title_not_null"),
                    "warning"
                );
                return;
            }
            let self = this;
            let data = {
                name: this.feedback.staff,
                company: this.feedback.company,
                phone: this.feedback.contact,
                title: this.feedback.title,
                type: this.feedback.typeValue,
                description: this.feedback.content
            };
            userApi.add_feedback(function(data) {
                if (data.code == 200) {
                    self.closeMd("feedback");
                    self.toast(
                        self.$t("headerLang.submit_feedback_success"),
                        "success"
                    );
                } else {
                    self.toast(data.msg, "warning");
                }
            }, data);
        },
        openHelpWin() {
            if (this.helpUrl) {
                let a = document.createElement("a");
                a.style.display = "none";
                a.href = this.helpUrl;
                a.setAttribute("target", "_blank");
                let event = new MouseEvent("click");
                a.dispatchEvent(event);
            }
        },
        logout() {
            localStorage.setItem("loginState", 0);
            this.$router.push("/login");
        },
        toggleLang(lang) {
            if (lang == "zh") {
                localStorage.setItem("MIXPRO_LOCALE_LANGUAGE", "zh");
                this.$i18n.locale = localStorage.getItem(
                    "MIXPRO_LOCALE_LANGUAGE"
                );
            } else if (lang == "en") {
                localStorage.setItem("MIXPRO_LOCALE_LANGUAGE", "en");
                this.$i18n.locale = localStorage.getItem(
                    "MIXPRO_LOCALE_LANGUAGE"
                );
            }
            window.location.reload();
        },
        showMd: function(md) {
            this.md[md] = true;
            this.md.mask = true;
        },
        closeMd: function(md) {
            this.md[md] = false;
            this.md.mask = false;
        },
        updateRouteList(data) {
            //console.log(this.routeList);
            console.log("data", data);
            if (data.name != "home" && data.name != "index") {
                let isParent = data.meta.isParent;
                if (isParent) {
                    this.routeList = [];
                    this.routeList.push(data);
                } else {
                    if (this.routeList.length && this.routeList[1]) {
                        if (
                            !/^\/.+(\/detail\/equipment)(?:\/(?=$))?$/i.test(
                                data.path
                            )
                        ) {
                            this.routeList.splice(1, this.routeList.length);
                            this.routeList.splice(1, 0, data);
                            // this.routeList.push(data);
                        } else {
                            this.routeList.push(data);
                        }
                    } else if (this.routeList.length) {
                        this.routeList.push(data);
                    } else if (
                        /^\/.+(\/detail)?(?:\/(?=$))?$/.test(data.path)
                    ) {
                        let match = data.matched;
                        if (match[1]) {
                            this.routeList.push(match[1]);
                            if (match[2]) {
                                this.routeList.push(match[2]);
                            }
                        }
                    }
                }
            } else {
                this.routeList = [];
            }
            // console.log(data);
        },
        addBreadCrumbRoute(data) {
            console.log("header", data);
            this.routes.push({
                path: "",
                name: data
            });
        },
    },
    watch: {
        $route: "updateRouteList"
    }
};
</script>
<style rel="stylesheet/scss" lang="scss">
.copyright-text {
    a {
        text-decoration: underline;
        color: #4162ff;
    }
}
</style>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../sass/components/topHeader.scss";
</style>
