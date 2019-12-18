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
    <div class="station-list-container flex-column">
        <div class="content flex-column">
            <div class="search-wrap">
                <div class="flex-wrap">
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
            </div>
            <div class="content-wrap flex-column">
                <div class="list-header">
                    <table>
                        <thead>
                            <tr>
                                <th>{{$t('customerLang.record_id')}}</th>
                                <th>{{$t('customerLang.record_name')}}</th>
                                <th>{{$t('customerLang.record_type')}}</th>
                                <th>{{$t('customerLang.record_staff')}}</th>
                                <th>{{$t('customerLang.record_date')}}</th>
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
                        <tbody>
                            <tr v-for="(item,index) in listData" :key="index">
                                <td>{{item.service_id}}</td>
                                <td>{{item.service_name}}</td>
                                <td>{{item.category}}</td>
                                <td>{{item.staff}}</td>
                                <td>{{item.created}}</td>
                            </tr>
                            <tr v-if="listData==null||listData.length==0">
                                <td colspan="5">
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
        <div class="md-loading" :class="{ 'active': md.loading}">
            <i class="el-icon-loading md-loading-icon"></i>
        </div>
    </div>
</template>

<script>
import serviceApi from "@/assets/js/fetch/service";
export default {
    name: "customer",
    props: {
        customerId: Number
    },
    data() {
        return {
            userId: "",
            listData: null,
            isSearch: false,
            searchString: "",
            searchOptionValue: "service_id",
            searchOption: [
                {
                    label: this.$t("customerLang.record_id"),
                    value: "service_id"
                },
                {
                    label: this.$t("customerLang.record_name"),
                    value: "service_name"
                },
                {
                    label: this.$t("customerLang.record_type"),
                    value: "category"
                }
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
            md: {
                loading: false
            }
        };
    },

    created() {
        let user = localStorage.getItem("user");
        this.userId = JSON.parse(user).user_id;
    },
    mounted() {
        this.getList();
    },
    updated() {
        let outer = document.querySelector("div.list-body");
        let inner = document.querySelector("div.list-body>table");
        this.scrollWidth = outer.offsetWidth - inner.offsetWidth;
    },
    methods: {
        getList(type) {
            let self = this;
            let condition = '[["customer_id","=",' + this.customerId + "]]";
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
                    ["customer_id", "=", this.customerId],
                    [
                        this.searchOptionValue,
                        this.conditionOptionValue,
                        this.searchString
                    ]
                ]);
            }
            self.md["loading"] = true;
            serviceApi.get_list(
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
        handleSizeChange(val) {
            this.currentPageSize = val;
            this.getList();
        },
        refresh() {
            this.searchOptionValue = "service_id";
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
        }
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/customer/detail/record.scss";
</style>
