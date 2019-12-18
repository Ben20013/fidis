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
    <div class="cont-box">
        <div class="container flex-column">
            <div class="title-wrap">
                <span class="title">{{$t('userLang.list_title')}}</span>
            </div>
            <div class="search-wrap">
                <div class="search flex-wrap">
                    <div class="left-content flex-wrap">
                        <div class="search-option">
                            <el-select
                                v-model="searchOptionValue"
                                :placeholder="$t('el.select.placeholder')"
                                class="mix-select mix-select-32"
                                popper-class="mix-select-item"
                            >
                                <el-option
                                    v-for="item in searchOption"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value"
                                ></el-option>
                            </el-select>
                        </div>
                        <div class="search-content flex-wrap" :class="{'active':isFocus}">
                            <div class="left">
                                <el-select
                                    v-model="conditionOptionValue"
                                    :placeholder="$t('el.select.placeholder')"
                                    class="mix-select mix-no-border-32"
                                    popper-class="mix-select-item"
                                    @focus="isFocus=true"
                                    @blur="isFocus=false"
                                >
                                    <el-option
                                        v-for="item in conditionOption"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value"
                                    ></el-option>
                                </el-select>
                            </div>
                            <div class="split"></div>
                            <div class="right" @keyup.enter="getList('search')">
                                <el-input
                                    class="mix-input mix-no-border-32"
                                    :placeholder="$t('common.placeholder_search')"
                                    @focus="focusInput"
                                    @blur="isFocus=false"
                                    v-model="searchString"
                                ></el-input>
                            </div>
                            <div class="search-icon-wrap" @click="getList('search')">
                                <i class="mix-search-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="right-content flex-wrap">
                        <div class="create-user-btn" @click="showMd('add')">
                            <i class="mix-add-icon"></i>
                            <span>{{$t('userLang.add_user')}}</span>
                        </div>
                        <div class="refresh-wrap" @click="refresh">
                            <i class="mix-refresh-icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-wrap flex-column">
                <div class="list-header">
                    <table>
                        <colgroup>
                            <col width="100">
                            <col width="100">
                            <col width="150">
                            <col width="100">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col v-if="scrollWidth" :width="scrollWidth">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>{{$t('userLang.user_id')}}</th>
                                <th>{{$t('userLang.user_name')}}</th>
                                <th>{{$t('userLang.authorization')}}</th>
                                <th>{{$t('userLang.system')}}</th>
                                <th>{{$t('userLang.mobile')}}</th>
                                <th>{{$t('userLang.email')}}</th>
                                <th>{{$t('userLang.address')}}</th>
                                <th>{{$t('userLang.created')}}</th>
                                <th>{{$t('userLang.description')}}</th>
                                <th
                                    v-if="scrollWidth"
                                    :style="{'width':scrollWidth+'px','padding':0}"
                                ></th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="list-body">
                    <table>
                        <colgroup>
                            <col width="100">
                            <col width="100">
                            <col width="150">
                            <col width="100">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                        </colgroup>
                        <tbody>
                            <tr
                                v-for="(item,index) in listData"
                                :key="index"
                                @click="enterDetailPage(item,index)"
                                :class="{'active':index===currentItemIndex}"
                            >
                                <td>{{item.user_id}}</td>
                                <td>{{item.username}}</td>
                                <td>{{item.authorization}}</td>
                                <td>{{item.system}}</td>
                                <td>{{item.mobile}}</td>
                                <td>{{item.email}}</td>
                                <td>{{item.address}}</td>
                                <td>{{item.created}}</td>
                                <td>{{item.description}}</td>
                            </tr>
                            <tr v-if="listData==null||listData.length==0">
                                <td colspan="9">
                                    <div class="nodata">{{$t('common.no_data')}}</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="page-btn-wrap flex-wrap">
                <div class="block flex-wrap" v-show="true">
                    <el-pagination
                        background
                        class="mix-pagination"
                        @size-change="handleSizeChange"
                        @current-change="getList"
                        :current-page.sync="currentPage"
                        :page-sizes="[10,15,20,25,30]"
                        :page-size="currentPageSize"
                        layout="prev, pager, next, sizes, jumper"
                        :total="totalNumber"
                    ></el-pagination>
                </div>
            </div>
        </div>
        <!--弹框-->
        <div class="md-mask" :class="{ 'active': md.mask}"></div>
        <div class="md-loading" :class="{ 'active': md.loading}">
            <i class="el-icon-loading md-loading-icon"></i>
        </div>
        <!-- 添加用户-->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 add-user" :class="{ 'md-show': md.add}">
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">{{$t('userLang.add_user')}}</div>
                        <div class="iconWrap" @click="closeMd('add')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <div class="contentBox">
                        <div class="inputBox flex-wrap">
                            <div class="contL flex-con-1">
                                <div class="title">{{$t('userLang.user_name')}}</div>
                                <input class="inputCont" type="text" v-model="addUserData.username">
                                <div class="title">{{$t('userLang.email')}}</div>
                                <input class="inputCont" type="text" v-model="addUserData.email">
                                <div class="title">{{$t('userLang.user_password')}}</div>
                                <input
                                    class="inputCont"
                                    type="text"
                                    v-model="addUserData.authentication"
                                >
                            </div>
                            <div class="contR flex-con-1">
                                <div class="title">{{$t('userLang.mobile')}}</div>
                                <input class="inputCont" type="text" v-model="addUserData.mobile">
                                <div class="title">{{$t('userLang.authorization')}}</div>
                                <el-checkbox-group
                                    class="checkbox"
                                    @change="checkboxChange"
                                    v-model="checkListAdd"
                                >
                                    <el-checkbox border label="PRO"></el-checkbox>
                                    <el-checkbox border label="APP"></el-checkbox>
                                </el-checkbox-group>
                            </div>
                        </div>
                        <div class="aLineBox">
                            <div class="aLineBoxL">{{$t('userLang.user_address')}}</div>
                            <el-input v-model="addUserData.address" class="aLineBoxR" placeholder></el-input>
                        </div>
                        <div class="serviceDescriptionT">{{$t('userLang.description')}}</div>
                        <textarea class="serviceDescription" v-model="addUserData.description"/>
                    </div>
                    <div class="buttomBox flex-wrap flex-center">
                        <input
                            type="button"
                            class="btn_cancel"
                            :value="$t('common.btn_cancel')"
                            @click="closeMd('add')"
                        >
                        <input
                            type="button"
                            class="btn_determine"
                            :value="$t('common.btn_determine')"
                            @click="addUser()"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import userApi from "@/assets/js/fetch/user";
import config from "$config";
export default {
    name: "userList",
    data() {
        return {
            listData: null,
            currentItemIndex: null,
            isSearch: false,
            searchString: "",
            searchOptionValue: "username",
            searchOption: [
                { label: this.$t("userLang.user_name"), value: "username" },
                { label: this.$t("userLang.mobile"), value: "mobile" },
                { label: this.$t("userLang.user_id"), value: "user_id" }
            ],
            conditionOptionValue: "like",
            conditionOption: [
                { label: this.$t("common.search_like"), value: "like" },
                { label: this.$t("common.search_eq"), value: "=" }
            ],
            isFocus: false,
            currentPage: 1,
            currentPageSize: 10,
            totalNumber: 0,
            scrollWidth: 0,
            addUserData: {
                user_id: "",
                username: "",
                mobile: "",
                address: "",
                email: "",
                description: "",
                authentication: ""
            },
            checkListAdd: ["PRO"],
            md: {
                mask: false,
                loading: false,
                add: false
            }
        };
    },

    created() {},
    mounted() {
        this.getList("list");
    },
    updated() {
        let outer = document.querySelector("div.list-body");
        let inner = document.querySelector("div.list-body>table");
        if (outer && inner) {
            this.scrollWidth = outer.offsetWidth - inner.offsetWidth;
        }
    },
    methods: {
        getList(type) {
            let self = this;
            let condition = "[]";
            if (type == "search") {
                this.isSearch = true;
                if (this.searchString == "") {
                    this.isSearch = false;
                }
                this.currentPage = 1;
                this.currentPageSize = 10;
            } else if (type == "list") {
                this.currentPage = 1;
                this.currentPageSize = 10;
                this.isSearch = false;
            }
            if (this.isSearch) {
                condition = JSON.stringify([
                    [
                        this.searchOptionValue,
                        this.conditionOptionValue,
                        this.searchString
                    ]
                ]);
            }
            self.md["loading"] = true;
            this.currentItemIndex = null;
            userApi.get_list(
                function(data) {
                    if (data.code == 200) {
                        self.listData = data.result.data;
                        self.totalNumber = data.result.total_records;
                    }
                    self.md["loading"] = false;
                },
                {
                    is_all: 0,
                    page_index: this.currentPage,
                    page_size: this.currentPageSize,
                    condition: condition
                }
            );
        },
        enterDetailPage(item, index) {
            this.currentItemIndex = index;
            this.$emit("nav-title", { name: item.username, id: item.user_id });
            this.$router.push({
                name: "userDetail",
                path: "/user/detail",
                params: { userId: item.user_id, userName: item.username }
            });
        },
        handleSizeChange(val) {
            this.currentPageSize = val;
            this.getList();
        },
        refresh() {
            this.searchOptionValue = "username";
            this.conditionOptionValue = "like";
            this.searchString = "";
            this.currentPage = 1;
            this.currentPageSize = 10;
            this.isSearch = false;
            this.getList("list");
        },
        focusInput() {
            let self = this;
            setTimeout(function() {
                self.isFocus = true;
            }, 100);
        },
        addUser() {
            let self = this;
            if (
                this.addUserData.username == "" ||
                this.addUserData.username == null
            ) {
                self.toast(self.$t("userLang.user_name_not_null"), "warning");
                return;
            }
            if (
                this.addUserData.authentication == "" ||
                this.addUserData.authentication == null
            ) {
                self.toast(
                    self.$t("userLang.user_password_not_null"),
                    "warning"
                );
                return;
            }
            if (
                this.addUserData.mobile == "" ||
                this.addUserData.mobile == null
            ) {
                self.toast(self.$t("userLang.input_mobile_tip"), "warning");
                return;
            }
            userApi.add(
                function(data) {
                    if (data.code == "200") {
                        self.toast(self.$t("userLang.add_success"), "success");
                        self.closeMd("add");
                        self.getList();
                    } else {
                        self.toast(self.$t("userLang.add_fail"), "error");
                    }
                },
                {
                    password: self.addUserData.authentication,
                    username: self.addUserData.username,
                    mobile: self.addUserData.mobile,
                    address: self.addUserData.address,
                    email: self.addUserData.email,
                    authorization: self.checkListAdd,
                    description: self.addUserData.description,
                    system: config.system
                }
            );
        },
        toast(msg, type) {
            this.$message({
                message: msg,
                type: type
            });
        },
        checkboxChange(value) {},
        //弹框事件开关
        showMd(md) {
            this.md[md] = true;
            this.md.mask = true;
            if (md == "add") {
                this.addUserData.user_id = "";
                this.addUserData.username = "";
                this.addUserData.mobile = "";
                this.addUserData.address = "";
                this.addUserData.email = "";
                this.addUserData.description = "";
                this.addUserData.authentication = "";
            }
        },
        closeMd(md) {
            this.md[md] = false;
            this.md.mask = false;
        }
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/user/list.scss";
</style>
