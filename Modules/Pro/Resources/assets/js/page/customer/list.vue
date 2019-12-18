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
            <!-- <div class="title-wrap">
                <span class="title">{{$t('customerLang.list_title')}}</span>
            </div>-->
            <div class="search-wrap flex-wrap">
                <div class="search-left-content flex-wrap">
                    <div class="search-option">
                        <el-select
                            v-model="searchOptionValue"
                            :placeholder="$t('common.placeholder_select')"
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
                                :placeholder="$t('common.placeholder_select')"
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
                    <div class="refresh-wrap" @click="refresh">
                        <i class="mix-refresh-icon"></i>
                    </div>
                </div>
                <div class="serarch-right-content flex-wrap">
                    <div class="subscribe-btn" @click="showMd('subscribe')">
                        <span>{{$t('customerLang.subscribe')}}</span>
                    </div>
                    <div class="unsubscribe-all-btn" @click="unsubscribeAll">
                        <span>{{$t('customerLang.unsubscribe_all')}}</span>
                    </div>
                </div>
            </div>
            <div class="content-wrap flex-column">
                <div class="list-header">
                    <table>
                        <colgroup>
                            <col width="60">
                            <col width="100">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="120">
                            <col v-if="scrollWidth" :width="scrollWidth">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>
                                    <input
                                        type="checkbox"
                                        class="mix-checkbox"
                                        name="all"
                                        value
                                        :checked="listData&&listData.length===checkBoxList.length"
                                        @click="checkBoxAllClick"
                                    >
                                </th>
                                <th>{{$t('customerLang.customer_id')}}</th>
                                <th>{{$t('customerLang.customer_name')}}</th>
                                <th>{{$t('customerLang.province')}}</th>
                                <th>{{$t('customerLang.city')}}</th>
                                <th>{{$t('customerLang.phone')}}</th>
                                <th>{{$t('customerLang.contact')}}</th>
                                <th>{{$t('customerLang.mobile')}}</th>
                                <th>{{$t('customerLang.address')}}</th>
                                <th>{{$t('customerLang.action')}}</th>
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
                            <col width="60">
                            <col width="100">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="120">
                        </colgroup>
                        <tbody>
                            <tr
                                v-for="(item,index) in listData"
								:key="index"
                                @click="enterDetailPage(item,index)"
                                :class="{'active':index===currentItemIndex}"
                            >
                                <td>
                                    <input
                                        type="checkbox"
                                        class="mix-checkbox"
                                        name="item"
                                        :checked="checkBoxList.indexOf(item.customer_id)>=0"
                                        @click.stop="checkBoxClick(item.customer_id)"
                                    >
                                </td>
                                <td>{{item.customer_id}}</td>
                                <td>{{item.customer_name}}</td>
                                <td>{{item.province}}</td>
                                <td>{{item.city}}</td>
                                <td>{{item.phone}}</td>
                                <td>{{item.contact}}</td>
                                <td>{{item.mobile}}</td>
                                <td>{{item.address}}</td>
                                <td>
                                    <a
                                        class="unsubscribe"
                                        @click.stop="unsubscribeSingle(item.customer_id)"
                                    >{{$t('customerLang.unsubscribe')}}</a>
                                </td>
                            </tr>
                            <tr v-if="listData==null||listData.length==0">
                                <td colspan="10">
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
        <!-- 关注客户-->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 userCustomer" :class="{ 'md-show': md.subscribe}">
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">{{$t('customerLang.subscribe')}}</div>
                        <div class="iconWrap" @click="closeMd('subscribe')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <div class="contentBox">
                        <div class="inputBoxPublic flex-wrap flex-center">
                            <div
                                class="inputBoxPublicL"
                                :class="{'en':$i18n.locale=='en'}"
                            >{{$t('customerLang.customer_id')}}:</div>
                            <el-input
                                v-model="followCustomer.customerId"
                                class="inputBoxPublicR mix-input"
                                :placeholder="$t('customerLang.placeholder_customer_id')"
                            ></el-input>
                        </div>
                        <div class="inputBoxPublic flex-wrap flex-center">
                            <div
                                class="inputBoxPublicL"
                                :class="{'en':$i18n.locale=='en'}"
                            >{{$t('customerLang.authorization_code')}}:</div>
                            <el-input
                                v-model="followCustomer.secret"
                                class="inputBoxPublicR mix-input"
                                :placeholder="$t('customerLang.placeholder_authorization_code')"
                            ></el-input>
                        </div>
                    </div>
                    <div class="buttomBox flex-wrap flex-center">
                        <input
                            type="button"
                            class="btn_cancel"
                            :value="$t('common.btn_cancel')"
                            @click="closeMd('subscribe')"
                        >
                        <input
                            type="button"
                            class="btn_determine"
                            :value="$t('common.btn_determine')"
                            @click="subscribe()"
                        >
                    </div>
                </div>
            </div>
        </div>
        <!--取消关注确认-->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 cancelCustomer" :class="{ 'md-show': md.unsubscribe}">
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">{{$t('customerLang.unsubscribe')}}</div>
                        <div class="iconWrap" @click="closeMd('unsubscribe')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <div class="contentBox">{{unsubscribeTip}}</div>
                    <div class="buttomBox flex-wrap flex-center">
                        <input
                            type="button"
                            class="btn_cancel"
                            :value="$t('common.btn_cancel')"
                            @click="closeMd('unsubscribe')"
                        >
                        <input
                            type="button"
                            class="btn_determine"
                            :value="$t('common.btn_determine')"
                            @click="unsubscribe()"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import customerApi from "@/assets/js/fetch/customer";
import linkage from "@/assets/js/components/linkage";
export default {
    name: "customerList",
    components: {
        //注册组件
        linkage: linkage
    },
    data() {
        return {
            userId: "",
            listData: null,
            currentItemIndex: null,
            isSearch: false,
            searchString: "",
            searchOptionValue: "customer_name",
            searchOption: [
                {
                    label: this.$t("customerLang.customer_name"),
                    value: "customer_name"
                },
                {
                    label: this.$t("customerLang.customer_id"),
                    value: "customer_id"
                },
                { label: this.$t("customerLang.phone"), value: "phone" },
                { label: this.$t("customerLang.province"), value: "province" },
                { label: this.$t("customerLang.city"), value: "city" },
                { label: this.$t("customerLang.contact"), value: "contact" },
                { label: this.$t("customerLang.mobile"), value: "mobile" },
                { label: this.$t("customerLang.address"), value: "address" }
            ],
            conditionOptionValue: "like",
            conditionOption: [
                { label: this.$t("common.search_like"), value: "like" },
                // { label: this.$t("common.search_nc"), value: "not like" },
                { label: this.$t("common.search_eq"), value: "=" },
                { label: this.$t("common.search_ne"), value: "!=" },
                { label: this.$t("common.search_lt"), value: "<" },
                { label: this.$t("common.search_le"), value: "<=" },
                { label: this.$t("common.search_gt"), value: ">" },
                { label: this.$t("common.search_ge"), value: ">=" }
            ],
            isFocus: false,
            currentPage: 1,
            currentPageSize: 10,
            totalNumber: 0,
            scrollWidth: 0,
            checkBoxList: [],
            unsubscribeTip: "",
            followCustomer: {
                customerId: "",
                customerName: "",
                secret: ""
            },
            md: {
                mask: false,
                loading: false,
                subscribe: false,
                unsubscribe: false
            }
        };
    },

    created() {
        let user = localStorage.getItem("user");
        this.userId = JSON.parse(user).user_id;
    },
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
            this.md["loading"] = true;
            this.currentItemIndex = null;
            customerApi.get_list(
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
            this.$emit("nav-title", {
                name: item.customer_name,
                id: item.customer_id
            });
            this.$router.push({
                name: "customerDetail",
                path: "/customer/detail",
                params: {
                    customerId: item.customer_id,
                    customerName: item.customer_name
                }
            });
        },
        handleSizeChange(val) {
            this.currentPageSize = val;
            this.getList();
        },
        refresh() {
            this.searchOptionValue = "customer_name";
            this.conditionOptionValue = "like";
            this.searchString = "";
            this.currentPage = 1;
            this.currentPageSize = 10;
            this.isSearch = false;
            this.getList("list");
        },
        subscribe() {
            let self = this;
            if (
                this.followCustomer.customerId == "" ||
                this.followCustomer.customerId == null
            ) {
                this.toast(
                    this.$t("customerLang.customer_id_not_null"),
                    "warning"
                );
            } else if (
                this.followCustomer.secret == "" ||
                this.followCustomer.secret == null
            ) {
                this.toast(
                    this.$t("customerLang.authorization_code_not_null"),
                    "warning"
                );
            } else {
                customerApi.user_customer(
                    function(data) {
                        if (data.code == "200") {
                            self.toast(data.msg, "seccess");
                            self.closeMd("subscribe");
                            self.getList("list");
                        } else {
                            self.toast(data.msg, "warning");
                        }
                    },
                    {
                        user_id: self.userId,
                        customer_id: self.followCustomer.customerId,
                        secret: self.followCustomer.secret
                    }
                );
            }
        },
        unsubscribeSingle(id) {
            this.unsubscribeTip = this.$t(
                "customerLang.unsubscribe_customer_tip"
            );
            this.showMd("unsubscribe");
            (this.checkBoxList = []), this.checkBoxList.push(id);
        },
        unsubscribeAll() {
            if (this.checkBoxList == [] || this.checkBoxList == "") {
                this.toast(
                    this.$t("customerLang.want_unsubscribe_customer_tip"),
                    "warning"
                );
                return;
            }
            this.unsubscribeTip = this.$t(
                "customerLang.unsubscribe_select_customer_tip"
            );
            this.showMd("unsubscribe");
        },
        unsubscribe() {
            let self = this;
            customerApi.user_customer_multi_delete(
                function(data) {
                    if (data.code == "200") {
                        self.toast(data.msg, "success");
                        self.closeMd("unsubscribe");
                        self.getList("list");
                    }
                },
                {
                    user_id: self.userId,
                    customer_id: JSON.stringify(self.checkBoxList)
                }
            );
        },
        checkBoxAllClick(e) {
            let checked = e.target.checked;
            if (checked) {
                if (this.listData && Array.isArray(this.listData)) {
                    this.checkBoxList = [];
                    let self = this;
                    this.listData.forEach(function(item) {
                        self.checkBoxList.push(item.customer_id);
                    });
                }
            } else {
                this.checkBoxList = [];
            }
        },
        checkBoxClick(val) {
            if (this.checkBoxList.indexOf(val) == -1) {
                this.checkBoxList.push(val);
            } else {
                this.checkBoxList.splice(this.checkBoxList.indexOf(val), 1);
            }
        },
        toast(msg, type) {
            this.$message({
                message: msg,
                type: type
            });
        },
        //弹框事件开关
        showMd(md) {
            this.md[md] = true;
            this.md.mask = true;
            if (md == "subscribe") {
                this.followCustomer.customerId = "";
                this.followCustomer.secret = "";
            }
        },
        closeMd(md) {
            this.md[md] = false;
            this.md.mask = false;
        },
        focusInput() {
            let self = this;
            setTimeout(function() {
                self.isFocus = true;
            }, 100);
        }
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/customer/list.scss";
</style>
