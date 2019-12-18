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
                <span class="title">成本记录</span>
            </div>
            <div class="search-wrap flex-wrap">
                <div class="search-left-content flex-wrap">
                    <div class="search-option">
                        <el-select
                            v-model="searchOptionValue"
                            placeholder="请选择"
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
                                placeholder="请选择"
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
                                placeholder="请输入搜索内容"
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
                    <div class="add-record-btn" @click="openAddRecordWin(false)">
                        <span>添加</span>
                    </div>
                    <div class="export-wrap hide" @click>
                        <i class="mix-export-icon"></i>
                    </div>
                </div>
            </div>
            <div class="content-wrap flex-column">
                <div class="list-header">
                    <table>
                        <colgroup>
                            <col width="80">
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
                                <th>ID</th>
                                <th>记录时间</th>
                                <th>成本产生时间</th>
                                <th>成本类型</th>
                                <th>金额</th>
                                <th>备注</th>
                                <th>关联项目/设备</th>
                                <th>操作</th>
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
                            <col width="80">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="*">
                            <col width="120">
                        </colgroup>
                        <tbody>
                            <tr v-for="(item,index) in listData">
                                <td>{{item.id}}</td>
                                <td>{{item.input_time}}</td>
                                <td>{{item.cost_create_time}}</td>
                                <td>{{item.cost_type}}</td>
                                <td>{{item.amount}}</td>
                                <td>{{item.description}}</td>
                                <td>{{item.relate_type=='group'?item.group_id:item.equipment_id}}</td>
                                <td>
                                    <a @click.stop="openAddRecordWin(item.id)">编辑</a>
                                    <a @click.stop="openDeleteWin(item.id)">删除</a>
                                </td>
                            </tr>
                            <tr v-if="listData==null||listData.length==0">
                                <td colspan="8">
                                    <div class="nodata">暂无数据</div>
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
                        :page-size="100"
                        layout="prev, pager, next, sizes, jumper"
                        :total="totalNumber"
                    ></el-pagination>
                </div>
            </div>
        </div>
        <div class="md-mask" :class="{ 'active': md.mask}"></div>
        <div class="md-loading" :class="{ 'active': md.loading}">
            <i class="el-icon-loading md-loading-icon"></i>
        </div>
        <!--添加/编辑记录modal-->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 addRecord" :class="{ 'md-show': md.addRecord}">
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">添加</div>
                        <div class="iconWrap" @click="closeMd('addRecord')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div class="contBox">
                        <div class="itemTable">
                            <table>
                                <colgroup>
                                    <col width="50%">
                                    <col width="*">
                                </colgroup>
                                <tr>
                                    <td>
                                        <el-radio-group
                                            v-model="addRecord.radio"
                                            @change="changeRelateType"
                                        >
                                            <el-radio label="group">项目</el-radio>
                                            <el-radio label="equipment">设备</el-radio>
                                        </el-radio-group>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr v-if="addRecord.radio=='group'">
                                    <td>
                                        <div class="descTitle">项目编号</div>
                                        <div class="block">
                                            <el-select
                                                v-model="addRecord.groupId"
                                                placeholder="请选择"
                                            >
                                                <el-option
                                                    v-for="item in addRecord.stationList"
                                                    :key="item.group_id"
                                                    :label="item.group_id"
                                                    :value="item.group_id"
                                                ></el-option>
                                            </el-select>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr v-if="addRecord.radio=='equipment'">
                                    <td>
                                        <div class="descTitle">项目编号</div>
                                        <div class="block">
                                            <el-select
                                                v-model="addRecord.groupId"
                                                placeholder="请选择"
                                                @change="getStationEquipmentList"
                                            >
                                                <el-option
                                                    v-for="item in addRecord.stationList"
                                                    :key="item.group_id"
                                                    :label="item.group_id"
                                                    :value="item.group_id"
                                                ></el-option>
                                            </el-select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="descTitle">设备编号</div>
                                        <div class="block">
                                            <el-select
                                                v-model="addRecord.equipmentId"
                                                placeholder="请选择"
                                            >
                                                <el-option
                                                    v-for="item in addRecord.equipmentList"
                                                    :key="item.equipment_id"
                                                    :label="item.equipment_id"
                                                    :value="item.equipment_id"
                                                ></el-option>
                                            </el-select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="descTitle">记录时间</div>
                                        <div class="block">
                                            <el-date-picker
                                                v-model="addRecord.recordTime"
                                                type="datetime"
                                                value-format="yyyy-MM-dd HH:mm:ss"
                                                placeholder="选择日期"
                                            ></el-date-picker>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="descTitle">成本产生时间</div>
                                        <div class="block">
                                            <el-date-picker
                                                v-model="addRecord.productTime"
                                                type="datetime"
                                                value-format="yyyy-MM-dd HH:mm:ss"
                                                placeholder="选择日期"
                                            ></el-date-picker>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="descTitle">成本类型</div>
                                        <div class="block">
                                            <el-select
                                                v-model="addRecord.costType"
                                                placeholder="请选择"
                                            >
                                                <el-option
                                                    v-for="item in addRecord.costTypeOptions"
                                                    :key="item.value"
                                                    :label="item.label"
                                                    :value="item.label"
                                                ></el-option>
                                            </el-select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="descTitle">金额</div>
                                        <div class="block">
                                            <el-input-number
                                                class="mix-input-number"
                                                v-model="addRecord.amount"
                                                controls-position="right"
                                            ></el-input-number>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="descTitle">备注</div>
                                        <el-input
                                            type="textarea"
                                            :rows="3"
                                            placeholder
                                            v-model="addRecord.description"
                                        ></el-input>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="buttomBox flex-wrap flex-center">
                        <input
                            type="button"
                            class="btn_cancel"
                            @click="closeMd('addRecord')"
                            value="取消"
                        >
                        <input
                            type="button"
                            class="btn_determine"
                            @click="submitRecordData"
                            value="确认"
                        >
                    </div>
                </div>
            </div>
        </div>
        <!--删除确认-->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 deleteRecord" :class="{ 'md-show': md.delete}">
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">成本记录</div>
                        <div class="iconWrap" @click="closeMd('delete')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <div class="contentBox">确认删除此记录？</div>
                    <div class="buttomBox flex-wrap flex-center">
                        <input
                            type="button"
                            class="btn_cancel"
                            value="取消"
                            @click="closeMd('delete')"
                        >
                        <input
                            type="button"
                            class="btn_determine"
                            value="确认"
                            @click="deleteRecord()"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import eventApi from "@/assets/js/fetch/event";
import costApi from "@/assets/js/fetch/cost";
import stationApi from "@/assets/js/fetch/station";
import deviceApi from "@/assets/js/fetch/device";

export default {
    name: "costList",
    data() {
        return {
            listData: null,
            isSearch: false,
            searchString: "",
            searchOptionValue: "id",
            searchOption: [
                { label: "ID", value: "id" },
                { label: "记录时间", value: "input_time" },
                { label: "成本产生时间", value: "cost_create_time" },
                { label: "成本类型", value: "cost_type" },
                { label: "金额", value: "amount" },
                { label: "备注", value: "description" }
            ],
            conditionOptionValue: "cn",
            conditionOption: [
                { label: "包含", value: "cn" },
                { label: "等于", value: "eq" }
            ],
            isFocus: false,
            currentPage: 1,
            currentPageSize: 10,
            totalNumber: 0,
            scrollWidth: 0,
            currentRecordId: "",
            addRecord: {
                radio: "group",
                recordTime: "",
                productTime: "",
                costType: "",
                costTypeOptions: [
                    { value: 0, label: "设备采购成本" },
                    { value: 1, label: "安装工程成本" },
                    { value: 2, label: "设备维修材料成本" },
                    { value: 3, label: "设备维修人工成本" },
                    { value: 4, label: "设备保养材料成本" },
                    { value: 5, label: "设备保养人工成本" },
                    { value: 6, label: "设备托管人工成本" }
                ],
                amount: 0,
                description: "",
                groupId: "",
                stationList: null,
                equipmentId: "",
                equipmentList: null
            },
            md: {
                mask: false,
                loading: false,
                addRecord: false,
                delete: false
            }
        };
    },

    created() {},
    mounted() {
        this.getList("list");
        this.getStationList();
    },
    updated() {
        let outer = document.querySelector("div.list-body");
        let inner = document.querySelector("div.list-body>table");
        this.scrollWidth = outer.offsetWidth - inner.offsetWidth;
    },
    methods: {
        getList(type) {
            let self = this;
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
            self.md["loading"] = true;
            let start =
                this.currentPage > 1
                    ? (this.currentPage - 1) * this.currentPageSize
                    : 0;
            let params = {
                start: start,
                limit: this.currentPageSize
            };
            if (this.isSearch) {
                params["searchField"] = this.searchOptionValue;
                params["searchOper"] = this.conditionOptionValue;
                params["searchString"] = this.searchString;
            }
            costApi.get_list(function(data) {
                if (data.ret === 0) {
                    self.listData = data.result.data;
                    self.totalNumber = Number(data.total);
                }
                self.md["loading"] = false;
            }, params);
        },
        resetAddRecord() {
            this.addRecord.radio = "group";
            this.addRecord.recordTime = "";
            this.addRecord.productTime = "";
            this.addRecord.costType = "";
            this.addRecord.amount = 0;
            this.addRecord.description = "";
            this.addRecord.groupId = "";
            this.addRecord.stationList = null;
            this.addRecord.equipmentId = "";
            this.addRecord.equipmentList = null;
        },
        openAddRecordWin(id) {
            this.currentRecordId = "";
            if (id) {
                this.getRecordInfo(id);
                this.currentRecordId = id;
            } else {
                this.resetAddRecord();
            }
            this.getStationList();
            this.showMd("addRecord");
        },
        getRecordInfo(id) {
            let self = this;
            costApi.get_list(
                function(data) {
                    if (data.ret === 0) {
                        let info = data.result;
                        self.addRecord.radio = info.relate_type;
                        self.addRecord.recordTime = info.input_time;
                        self.addRecord.productTime = info.cost_create_time;
                        self.addRecord.costType = info.cost_type;
                        self.addRecord.amount = info.amount;
                        self.addRecord.description = info.description;
                        self.addRecord.groupId = info.grouop_id;
                        self.addRecord.equipmentId = info.equipment_id;
                    }
                },
                {
                    start: 0,
                    limit: 1,
                    searchField: "id",
                    searchOper: "eq",
                    searchString: id
                }
            );
        },
        submitRecordData() {
            let self = this;
            if (self.addRecord.recordTime == "") {
                self.toast("记录时间不能为空", "warning");
                return;
            }
            if (self.addRecord.productTime == "") {
                self.toast("成本产生时间不能为空", "warning");
                return;
            }
            if (self.addRecord.costType == "") {
                self.toast("成本类型不能为空", "warning");
                return;
            }
            let params = {
                relate_type: self.addRecord.radio,
                input_time: self.addRecord.recordTime,
                cost_create_time: self.addRecord.productTime,
                cost_type: self.addRecord.costType,
                amount: self.addRecord.amount,
                description: self.addRecord.description,
                group_id: self.addRecord.groupId,
                equipment_id: self.addRecord.equipmentId
            };
            if (this.currentRecordId) {
                params["id"] = this.currentRecordId;
                costApi.edit(function(data) {
                    if (data.ret === 0) {
                        self.toast(data.msg, "success");
                    } else {
                        self.toast(data.msg, "error");
                    }
                    self.closeMd("addRecord");
                    self.getList("list");
                }, params);
            } else {
                costApi.add(function(data) {
                    if (data.ret === 0) {
                        self.toast(data.msg, "success");
                    } else {
                        self.toast(data.msg, "error");
                    }
                    self.closeMd("addRecord");
                    self.getList("list");
                }, params);
            }
        },
        getStationList() {
            let self = this;
            stationApi.get_list(
                function(data) {
                    if (data.code == 200) {
                        self.addRecord.stationList = data.result.data;
                    }
                },
                { is_all: 1 }
            );
        },
        getStationEquipmentList(id) {
            if (!id) {
                return;
            }
            let self = this;
            stationApi.get_equipment_list(
                function(data) {
                    if (data.code == 200) {
                        self.addRecord.equipmentList = data.result.data;
                    }
                },
                { group_id: id }
            );
        },
        getEquipmentList() {
            let self = this;
            deviceApi.get_list(
                function(data) {
                    if (data.code == 200) {
                        self.addRecord.equipmentList = data.result.data;
                    }
                },
                { is_all: 1 }
            );
        },
        changeRelateType(val) {
            this.addRecord.groupId = "";
            this.addRecord.equipmentId = "";
            this.getStationList();
        },
        openDeleteWin(id) {
            this.currentRecordId = id;
            this.showMd("delete");
        },
        deleteRecord() {
            let self = this;
            costApi.del(
                function(data) {
                    if (data.ret === 0) {
                        self.toast(data.msg, "success");
                        self.getList("list");
                    } else {
                        self.toast(data.msg, "error");
                    }
                    self.closeMd("delete");
                },
                { id: this.currentRecordId }
            );
        },
        handleSizeChange(val) {
            this.currentPageSize = val;
            this.getList();
        },
        refresh() {
            this.searchOptionValue = "id";
            this.conditionOptionValue = "cn";
            this.searchString = "";
            this.currentPage = 1;
            this.currentPageSize = 10;
            this.isSearch = false;
            this.getList("list");
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
@import "../../../sass/cost/list.scss";
</style>
