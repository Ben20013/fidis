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
                <span class="title">收益规则</span>
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
                            <col width="120">
                            <col v-if="scrollWidth" :width="scrollWidth">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>设置时间</th>
                                <th>设置类型</th>
                                <th>项目编号</th>
                                <th>设备编号</th>
                                <!-- <th>设置内容</th> -->
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
                            <col width="120">
                        </colgroup>
                        <tbody>
                            <tr v-for="(item,index) in listData">
                                <td>{{item.id}}</td>
                                <td>{{item.input_time}}</td>
                                <td>{{item.setting_type}}</td>
                                <td>{{item.group_id}}</td>
                                <td>{{item.equipment_id}}</td>
                                <!-- <td>{{item.settings}}</td> -->
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
                                        <div class="desc-title">设置类型</div>
                                        <div class="block radio">
                                            <el-radio-group
                                                v-model="addRecord.radio"
                                                @change="changeRelateType"
                                            >
                                                <el-radio label="group">项目</el-radio>
                                                <el-radio label="equipment">设备</el-radio>
                                            </el-radio-group>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="desc-title">设置时间</div>
                                        <div class="block">
                                            <el-date-picker
                                                v-model="addRecord.recordTime"
                                                type="datetime"
                                                value-format="yyyy-MM-dd HH:mm:ss"
                                                placeholder="选择日期"
                                            ></el-date-picker>
                                        </div>
                                    </td>
                                </tr>
                                <tr v-if="addRecord.radio=='group'">
                                    <td>
                                        <div class="desc-title">项目编号</div>
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
                                        <div class="desc-title">项目编号</div>
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
                                        <div class="desc-title">设备编号</div>
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
                                    <td colspan="2">
                                        <div class="desc-title">设置内容</div>
                                        <div class="settings">
                                            <div class="peak flex-wrap">
                                                <div class="duration flex-wrap">
                                                    <div class="name">峰电</div>
                                                    <div class="time">
                                                        <el-select
                                                            v-model="addRecord.peak.duration[0]"
                                                            placeholder="请选择"
                                                        >
                                                            <el-option
                                                                v-for="item in addRecord.timeList"
                                                                :key="item.value"
                                                                :label="item.label"
                                                                :value="item.value"
                                                            ></el-option>
                                                        </el-select>
                                                    </div>
                                                    <div class="split">-</div>
                                                    <div class="time">
                                                        <el-select
                                                            v-model="addRecord.peak.duration[1]"
                                                            placeholder="请选择"
                                                        >
                                                            <el-option
                                                                v-for="item in addRecord.timeList"
                                                                :key="item.value"
                                                                :label="item.label"
                                                                :value="item.value"
                                                            ></el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                                <div class="price flex-wrap">
                                                    <div class="name">峰电单价</div>
                                                    <div class="value">
                                                        <el-input-number
                                                            class="mix-input-number"
                                                            v-model="addRecord.peak.price"
                                                            controls-position="right"
                                                        ></el-input-number>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="valley flex-wrap">
                                                <div class="duration flex-wrap">
                                                    <div class="name">谷电</div>
                                                    <div class="time">
                                                        <el-select
                                                            v-model="addRecord.valley.duration[0]"
                                                            placeholder="请选择"
                                                        >
                                                            <el-option
                                                                v-for="item in addRecord.timeList"
                                                                :key="item.value"
                                                                :label="item.label"
                                                                :value="item.value"
                                                            ></el-option>
                                                        </el-select>
                                                    </div>
                                                    <div class="split">-</div>
                                                    <div class="time">
                                                        <el-select
                                                            v-model="addRecord.valley.duration[1]"
                                                            placeholder="请选择"
                                                        >
                                                            <el-option
                                                                v-for="item in addRecord.timeList"
                                                                :key="item.value"
                                                                :label="item.label"
                                                                :value="item.value"
                                                            ></el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                                <div class="price flex-wrap">
                                                    <div class="name">谷电单价</div>
                                                    <div class="value">
                                                        <el-input-number
                                                            class="mix-input-number"
                                                            v-model="addRecord.valley.price"
                                                            controls-position="right"
                                                        ></el-input-number>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flat flex-wrap">
                                                <div class="duration flex-wrap">
                                                    <div class="name">平电</div>
                                                    <div class="time">
                                                        <el-select
                                                            v-model="addRecord.flat.duration[0]"
                                                            placeholder="请选择"
                                                        >
                                                            <el-option
                                                                v-for="item in addRecord.timeList"
                                                                :key="item.value"
                                                                :label="item.label"
                                                                :value="item.value"
                                                            ></el-option>
                                                        </el-select>
                                                    </div>
                                                    <div class="split">-</div>
                                                    <div class="time">
                                                        <el-select
                                                            v-model="addRecord.flat.duration[1]"
                                                            placeholder="请选择"
                                                        >
                                                            <el-option
                                                                v-for="item in addRecord.timeList"
                                                                :key="item.value"
                                                                :label="item.label"
                                                                :value="item.value"
                                                            ></el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                                <div class="price flex-wrap">
                                                    <div class="name">平电单价</div>
                                                    <div class="value">
                                                        <el-input-number
                                                            class="mix-input-number"
                                                            v-model="addRecord.flat.price"
                                                            controls-position="right"
                                                        ></el-input-number>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                        <div class="title">收益规则</div>
                        <div class="iconWrap" @click="closeMd('delete')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <div class="contentBox">确认删除此规则？</div>
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
import earningApi from "@/assets/js/fetch/earning";
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
                { label: "设置时间", value: "input_time" },
                { label: "设置类型", value: "setting_type" },
                { label: "项目编号", value: "group_id" },
                { label: "设备编号", value: "equipment_id" }
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
                timeList: [
                    { value: "00:00", label: "00:00" },
                    { value: "01:00", label: "01:00" },
                    { value: "02:00", label: "02:00" },
                    { value: "03:00", label: "03:00" },
                    { value: "04:00", label: "04:00" },
                    { value: "05:00", label: "05:00" },
                    { value: "06:00", label: "06:00" },
                    { value: "07:00", label: "07:00" },
                    { value: "08:00", label: "08:00" },
                    { value: "09:00", label: "09:00" },
                    { value: "10:00", label: "10:00" },
                    { value: "11:00", label: "11:00" },
                    { value: "12:00", label: "12:00" },
                    { value: "13:00", label: "13:00" },
                    { value: "14:00", label: "14:00" },
                    { value: "15:00", label: "15:00" },
                    { value: "16:00", label: "16:00" },
                    { value: "17:00", label: "17:00" },
                    { value: "18:00", label: "18:00" },
                    { value: "19:00", label: "19:00" },
                    { value: "20:00", label: "20:00" },
                    { value: "21:00", label: "21:00" },
                    { value: "22:00", label: "22:00" },
                    { value: "23:00", label: "23:00" }
                ],
                peak: {
                    duration: [null, null],
                    price: ""
                },
                valley: {
                    duration: [null, null],
                    price: ""
                },
                flat: {
                    duration: [null, null],
                    price: ""
                },
                price: "",
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
            earningApi.get_list(function(data) {
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
            this.addRecord.groupId = "";
            this.addRecord.stationList = null;
            this.addRecord.equipmentId = "";
            this.addRecord.equipmentList = null;
            this.addRecord.peak.duration = [null, null];
            this.addRecord.peak.price = "";
            this.addRecord.valley.duration = [null, null];
            this.addRecord.valley.price = "";
            this.addRecord.flat.duration = [null, null];
            this.addRecord.flat.price = "";
        },
        openAddRecordWin(id) {
            this.currentRecordId = "";
            this.resetAddRecord();
            if (id) {
                this.getRecordInfo(id);
                this.currentRecordId = id;
            }
            this.getStationList();
            this.showMd("addRecord");
        },
        getRecordInfo(id) {
            let self = this;
            earningApi.get_list(
                function(data) {
                    if (data.ret === 0) {
                        let info = data.result;
                        let settings = JSON.parse(info.settings);
                        self.addRecord.radio = info.setting_type;
                        self.addRecord.recordTime = info.input_time;
                        self.addRecord.groupId = info.grouop_id;
                        self.addRecord.equipmentId = info.equipment_id;
                        self.addRecord.peak = settings.peak;
                        self.addRecord.valley = settings.valley;
                        self.addRecord.flat = settings.flat;
                        if (info.setting_type == "equipment") {
                            self.getEquipmentList();
                        }
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
            if (
                !self.addRecord.peak.duration[0] ||
                !self.addRecord.peak.duration[1]
            ) {
                self.toast("峰电时间段不能为空", "warning");
                return;
            }
            if (
                !self.addRecord.valley.duration[0] ||
                !self.addRecord.valley.duration[1]
            ) {
                self.toast("谷电时间段不能为空", "warning");
                return;
            }
            if (
                !self.addRecord.flat.duration[0] ||
                !self.addRecord.flat.duration[1]
            ) {
                self.toast("平电时间段不能为空", "warning");
                return;
            }
            let settings = {
                peak: self.addRecord.peak,
                valley: self.addRecord.valley,
                flat: self.addRecord.flat
            };
            let params = {
                setting_type: self.addRecord.radio,
                input_time: self.addRecord.recordTime,
                group_id: self.addRecord.groupId,
                equipment_id: self.addRecord.equipmentId,
                settings: JSON.stringify(settings)
            };
            if (this.currentRecordId) {
                params["id"] = this.currentRecordId;
                earningApi.edit(function(data) {
                    if (data.ret === 0) {
                        self.toast(data.msg, "success");
                    } else {
                        self.toast(data.msg, "error");
                    }
                    self.closeMd("addRecord");
                    self.getList("list");
                }, params);
            } else {
                earningApi.add(function(data) {
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
            earningApi.del(
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
        enterDetailPage(item) {
            this.$emit("nav-title", {
                name: item.name,
                id: item.id,
                type: item.type
            });
            this.$router.push({
                name: "costDetail",
                path: "/earning/detail",
                params: {
                    recordId: item.id,
                    costName: item.name,
                    eventType: item.type
                }
            });
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
@import "../../../sass/earning/list.scss";
</style>
