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
        <div class="cont-view flex-column flex-con-1" v-if="equipmentId!=''">
            <router-view v-on:nav-title="onNavTitle" :equipmentId="Number(equipmentId)"></router-view>
        </div>
        <div class="content flex-column" v-else>
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
                                <th>{{$t('customerLang.equipment_image')}}</th>
                                <th>{{$t('customerLang.equipment_id')}}</th>
                                <th>{{$t('customerLang.equipment_name')}}</th>
                                <th>{{$t('customerLang.equipment_model')}}</th>
                                <th>{{$t('customerLang.equipment_status')}}</th>
                                <th>{{$t('customerLang.equipment_create')}}</th>
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
                            <tr v-for="(item,index) in listData" @click="enterDetailPage(item)" :key="index">
                                <td>
                                    <img
                                        :src="pichost+item.equipment_image"
                                        alt
                                        v-if="item.equipment_image!=''&&item.equipment_image!=null"
                                    >
                                    <img
                                        src="../../../../images/public/no-image-icon.gif"
                                        alt
                                        v-else
                                    >
                                </td>
                                <td>{{item.equipment_id}}</td>
                                <td>{{item.equipment_name}}</td>
                                <td>{{item.model}}</td>
                                <td>
                                    <div class="status-wrap flex-wrap">
                                        <i class="status-icon offline" v-if="item.status_code==-1"></i>
                                        <i class="status-icon online" v-if="item.status_code!=-1"></i>
                                        <i class="status-icon boot" v-if="item.status_code==1"></i>
                                        <i class="status-icon shutdown" v-if="item.status_code==0"></i>
                                        <i
                                            class="status-icon warn"
                                            v-if="getStatusMsg(item.status_name)"
                                        ></i>
                                        <!-- <div class="statusBox flex-wrap">
											<div class="icon run" v-show="item.status_code==1"></div>
											<div class="icon offline" v-show="item.status_code==-1"></div>
											<div class="icon shut-down" v-show="item.status_code==0"></div>
											<div class="statusText">{{getStatusName(item.status_name)}}</div>
										</div>
										<div class="statusBox flex-wrap msg" v-if="getStatusMsg(item.status_name)">
											<div class="icon fault" v-show="getStatusMsg(item.status_name)=='故障'"></div>
											<div class="icon warn" v-show="getStatusMsg(item.status_name)=='报警'"></div>
											<div class="statusText">{{getStatusMsg(item.status_name)}}</div>
                                        </div>-->
                                    </div>
                                </td>
                                <td>{{item.created}}</td>
                            </tr>
                            <tr v-if="listData==null||listData.length==0">
                                <td colspan="6">
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
import deviceApi from "@/assets/js/fetch/device";
import config from "$config";
export default {
    name: "customerDevice",
    props: {
        customerId: Number
    },
    data() {
        return {
            equipmentId: "",
            pichost: config.apiq.pictureAddress,
            listData: null,
            isSearch: false,
            searchString: "",
            searchOptionValue: "equipment_id",
            searchOption: [
                {
                    label: this.$t("customerLang.equipment_id"),
                    value: "equipment_id"
                },
                {
                    label: this.$t("customerLang.equipment_name"),
                    value: "equipment_name"
                },
                {
                    label: this.$t("customerLang.equipment_model"),
                    value: "model"
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
            let condition =
                '[["customer_id","=",' +
                this.customerId +
                '],["is_group","=","0"]]';
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
                    ["is_group", "=", "0"],
                    ["customer_id", "=", this.customerId],
                    [
                        this.searchOptionValue,
                        this.conditionOptionValue,
                        this.searchString
                    ]
                ]);
            }
            self.md["loading"] = true;
            deviceApi.get_list(
                function(data) {
                    if (data.code == 200) {
                        self.listData = data.result.data;
                        self.totalNumber = data.result.total_records;
                    }
                    self.md["loading"] = false;
                },
                {
                    is_all: 0,
                    status: "details",
                    page_index: this.currentPage,
                    page_size: this.currentPageSize,
                    condition: condition
                }
            );
        },
        enterDetailPage(item) {
            // console.log(item);
            // return;
            this.equipmentId = item.equipment_id;
            this.$emit("nav-title", {
                name: item.customer_name,
                id: item.customer_id,
                isDevice: true
            });
            this.$router.push({
                name: "customerDetailEquipment",
                path: "/customer/detail/equipment",
                query: {
                    id: item.equipment_id
                },
                params: {
                    equipmentId: item.equipment_id,
                    equipmentName: item.equipment_name,
                    customerId: item.customer_id,
                    customerName: item.customer_name
                }
            });
        },
        onNavTitle(data) {
            this.$emit("nav-title", data.name);
            this.equipmentId = data.id;
        },
        handleSizeChange(val) {
            this.currentPageSize = val;
            this.getList();
        },
        refresh() {
            this.searchOptionValue = "equipment_id";
            this.conditionOptionValue = "like";
            this.searchString = "";
            this.currentPage = 1;
            this.currentPageSize = 10;
            this.isSearch = false;
            this.getList("list");
        },
        getStatusName(str) {
            let tmp = [];
            if (str.indexOf("|") >= 0) {
                tmp = str.split("|");
            } else {
                tmp.push(str);
            }
            return tmp[0];
        },
        getStatusMsg(str) {
            if (str.indexOf("|") >= 0) {
                return str.split("|")[1];
            } else {
                return false;
            }
        },
        focusInput() {
            let self = this;
            setTimeout(function() {
                self.isFocus = true;
            }, 100);
        },
        updateRouteList(data) {
            if (
                /^\/customer\/detail(?:\/(?=$))?$/i.test(data.path) &&
                this.equipmentId != ""
            ) {
                this.equipmentId = "";
                this.getList("list");
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
@import "../../../../sass/customer/detail/deviceList.scss";
</style>
