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
                                <th>{{$t('customerLang.station_id',[$t('systemLang["'+systemName+'"]')])}}</th>
                                <th>{{$t('customerLang.station_name',[$t('systemLang["'+systemName+'"]')])}}</th>
                                <th
                                    v-if="hasStatus"
                                >{{$t('customerLang.station_status',[$t('systemLang["'+systemName+'"]')])}}</th>
                                <!-- <th>气电比</th>
								<th>供气压力/Mpa</th>
                                <th>累计用气量/Nm³</th>-->
                                <th v-for="(item, index) in listHeaderVariable" :key="index">{{item.name}}</th>
                                <th>{{$t('customerLang.station_create',[$t('systemLang["'+systemName+'"]')])}}</th>
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
                                <td>{{item['group_id']}}</td>
                                <td>{{item['group_name']}}</td>
                                <td v-if="hasStatus">
                                    <div
                                        class="statusBox flex-wrap"
                                        v-if="item[systemName+'状态']!==undefined&&item[systemName+'状态']!==''"
                                    >
                                        <div class="icon offline" v-show="item[systemName+'状态']==0"></div>
                                        <div class="icon run" v-show="item[systemName+'状态']==1"></div>
                                        <div class="icon fault" v-show="item[systemName+'状态']==2"></div>
                                        <div
                                            class="statusText flex-con-1"
                                        >{{getStatusName(item[systemName+'状态'])}}</div>
                                    </div>
                                </td>
                                <!-- <td>{{item['气电比']?item['气电比']:''}}</td>
								<td>{{item['供气压力/Mpa']?item['供气压力/Mpa']:''}}</td>
                                <td>{{item['累计用气量/Nm³']?item['累计用气量/Nm³']:''}}</td>-->
                                <td v-for="(va,k) in listHeaderVariable" :key="k">{{item.template[va.key]?item.template[va.key]:''}}</td>
                                <td>{{item['created']}}</td>
                            </tr>
                            <tr v-if="listData==null||listData.length==0">
                                <td :colspan="listHeaderVariable.length+hasStatus+3">
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
import stationApi from "@/assets/js/fetch/station";
import system from "$system";
export default {
    name: "customer",
    props: {
        customerId: Number
    },
    data() {
        return {
            systemName: system.name,
            listHeaderVariable: system.header,
            hasStatus: system.hasStatus,
            listData: null,
            isSearch: false,
            searchString: "",
            searchOptionValue: "group_id",
            searchOption: [
                {
                    label: this.$t("customerLang.station_id", [
                        this.$t("systemLang['" + system.name + "']")
                    ]),
                    value: "group_id"
                },
                {
                    label: this.$t("customerLang.station_name", [
                        this.$t("systemLang['" + system.name + "']")
                    ]),
                    value: "group_name"
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
        // console.log(system);
    },
    mounted() {
        this.getList("list");
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
            stationApi.get_list(
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
            this.searchOptionValue = "group_id";
            this.conditionOptionValue = "like";
            this.searchString = "";
            this.currentPage = 1;
            this.currentPageSize = 10;
            this.isSearch = false;
            this.getList("list");
        },
        getStatusName(code) {
            let name = "";
            if (code == 0) {
                name = this.$t("customerLang.stop");
            } else if (code == 1) {
                name = this.$t("customerLang.normal");
            } else if (code == 2) {
                name = this.$t("customerLang.fault");
            }
            return name;
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
@import "../../../../sass/customer/detail/stationList.scss";
</style>
