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
                <span
                    class="title"
                >{{$t('stationLang.list_title',[$t("systemLang['"+systemName+"']")])}}</span>
            </div>-->
            <div class="search-wrap flex-wrap">
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
                <div class="refresh-wrap" @click="refresh">
                    <i class="mix-refresh-icon"></i>
                </div>
                <div class="export-wrap" @click="exportList">
                    <i class="mix-export-icon"></i>
                </div>
            </div>
            <div class="content-wrap flex-column">
                <div class="list-header">
                    <table>
                        <thead>
                            <tr>
                                <!-- <th>{{$t('stationLang.group_id',[$t("systemLang['"+systemName+"']")])}}</th> -->
                                <th>{{$t('stationLang.group_name',[$t("systemLang['"+systemName+"']")])}}</th>
                                <th
                                    v-if="hasStatus==1||hasStatus=='1'"
                                >{{$t('stationLang.group_status',[$t("systemLang['"+systemName+"']")])}}</th>
                                <!-- <th>气电比</th>
								<th>供气压力/Mpa</th>
                                <th>累计用气量/Nm³</th>-->
                                <th
                                    v-for="(item,index) in listHeaderVariable"
                                    :key="index"
                                >{{item.name}}</th>
                                <th>{{$t("stationLang['customer_name']")}}</th>
                                <th>{{$t('stationLang.group_created',[$t('systemLang.'+systemName)])}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="list-body">
                    <table>
                        <tbody>
                            <tr
                                v-for="(item,index) in listData"
                                :key="index"
                                @click="enterDetailPage(item,index)"
                                :class="{'active':index===currentItemIndex}"
                            >
                                <!-- <td>{{item.group_id}}</td> -->
                                <td>{{item.group_name}}</td>
                                <td v-if="hasStatus">
                                    <div
                                        class="statusBox flex-wrap"
                                        v-if="item.template[statusKey]!=undefined&&item.template[statusKey]!==''"
                                    >
                                        <div
                                            class="icon offline"
                                            v-show="item.template[statusKey]==0"
                                        ></div>
                                        <div class="icon run" v-show="item.template[statusKey]==1"></div>
                                        <div
                                            class="icon fault"
                                            v-show="item.template[statusKey]==2"
                                        ></div>
                                        <div
                                            class="statusText flex-con-1"
                                        >{{getStatusName(item.template[statusKey])}}</div>
                                    </div>
                                </td>
                                <!-- <td>{{item['气电比']?item['气电比']:''}}</td>
								<td>{{item['供气压力/Mpa']?item['供气压力/Mpa']:''}}</td>
                                <td>{{item['累计用气量/Nm³']?item['累计用气量/Nm³']:''}}</td>-->
                                <td
                                    v-for="(va,k) in listHeaderVariable"
                                    :key="k"
                                >{{item.template[va.key]?item.template[va.key]:''}}</td>
                                <td>{{item.customer_name}}</td>
                                <td>{{item.created}}</td>
                            </tr>
                            <tr v-if="listData==null||listData.length==0">
                                <td :colspan="listHeaderVariable.length+hasStatus+4">
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
import system from "$system";
import stationApi from "@/assets/js/fetch/station";
import config from "$config";
export default {
    name: "stationList",
    data() {
        return {
            systemName: system.name,
            statusKey: system.status ? system.status.key : "",
            listHeaderVariable: system.header,
            hasStatus: system.hasStatus,
            pichost: config.apiq.pictureAddress,
            getListTimer: null,
            listData: null,
            currentItemIndex: null,
            isSearch: false,
            searchString: "",
            searchOptionValue: "group_name",
            searchOption: [
                {
                    label: this.$t("stationLang.group_name", [
                        this.$t("systemLang['" + system.name + "']")
                    ]),
                    value: "group_name"
                },
                {
                    label: this.$t("stationLang.customer_name"),
                    value: "customer_name"
                },
                {
                    label: this.$t("stationLang.created"),
                    value: "created"
                }
                // {'label':this.$t('stationLang.group_id',[this.$t("systemLang['"+system.name+"']")]),'value':'group_id'},
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
            md: {
                loading: false
            }
        };
    },

    created() {},
    mounted() {
        console.log(system);
        this.getList("list");
        this.getListTimer = window.setInterval(this.listTimer, 180000);
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
        enterDetailPage(item, index) {
            this.currentItemIndex = index;
            this.$emit("nav-title", {
                name: item.group_name,
                id: item.group_id,
                main_equipment: item.main_equipment
            });
            this.$router.push({
                name: "stationDetail",
                path: "/station/detail",
                query: {
                    id: item.main_equipment,
                    gid: item.group_id
                }
            });
        },
        handleSizeChange(val) {
            this.currentPageSize = val;
            this.getList();
        },
        refresh() {
            this.searchOptionValue = "group_name";
            this.conditionOptionValue = "like";
            this.searchString = "";
            this.currentPage = 1;
            this.currentPageSize = 10;
            this.isSearch = false;
            this.getList("list");
        },
        exportList() {
            let condition = "[]";
            let head = [
                [
                    "group_name",
                    this.$t("stationLang.group_name", [
                        this.$t("systemLang['" + this.systemName + "']")
                    ])
                ]
            ];
            if (this.hasStatus) {
                head.push([
                    this.systemName + "状态",
                    this.$t("stationLang.group_status", [
                        this.$t("systemLang['" + this.systemName + "']")
                    ])
                ]);
            }
            if (this.listHeaderVariable.length) {
                for (var i = 0; i < this.listHeaderVariable.length; i++) {
                    head.push([
                        this.listHeaderVariable[i],
                        this.$t(
                            "systemLang['" + this.listHeaderVariable[i] + "']"
                        )
                    ]);
                }
            }
            head.push([
                "customer_name",
                this.$t("stationLang['customer_name']")
            ]);
            head.push([
                "created",
                this.$t("stationLang.group_created", [
                    this.$t("systemLang." + this.systemName)
                ])
            ]);
            if (this.isSearch) {
                condition = JSON.stringify([
                    [
                        this.searchOptionValue,
                        this.conditionOptionValue,
                        this.searchString
                    ]
                ]);
            }
            let self = this;
            // self.md['loading'] = true;
            let url =
                config.apiq.group_list_export +
                "?is_all=1&condition=" +
                condition +
                "&head=" +
                JSON.stringify(head);
            window.open(url);
            // let iframe = document.createElement('iframe')
            // iframe.style.display = 'none';
            // iframe.onload = function() {
            // 	self.md['loading'] = false;
            // 	document.body.removeChild(iframe);
            // }
            // iframe.src = url
            // document.body.appendChild(iframe);
            // stationApi.export_list(function(data){
            // 	self.md['loading'] = false;
            // 	if (iframe) {
            // 		document.body.removeChild(iframe);
            // 	}
            // },{'is_all':1,'condition':condition})
        },
        listTimer() {
            let self = this;
            stationApi.get_list(
                function(data) {
                    if (data.code == 200) {
                        self.listData = data.result.data;
                        self.totalNumber = data.result.total_records;
                    }
                },
                {
                    is_all: 0,
                    page_index: this.currentPage,
                    page_size: this.currentPageSize
                }
            );
        },
        getStatusName(code) {
            let name = "";
            if (code == 0) {
                name = this.$t("stationLang.stop");
            } else if (code == 1) {
                name = this.$t("stationLang.normal");
            } else if (code == 2) {
                name = this.$t("stationLang.fault");
            }
            return name;
        },
        focusInput() {
            let self = this;
            setTimeout(function() {
                self.isFocus = true;
            }, 100);
        }
    },
    destroyed() {
        window.clearInterval(this.getListTimer);
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/station/list.scss";
</style>
