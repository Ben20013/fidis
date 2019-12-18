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
    <!-- 事件 start -->
    <div class="equipment-efa-content-wrap flex-column">
        <div class="content flex-column">
            <div class="efa-list flex-column">
                <div class="list-header">
                    <table>
                        <colgroup>
                            <col width="170">
                            <col width="100">
                            <col width="170">
                            <col width="*">
                            <col width="120">
                            <col v-if="scrollWidth" :width="scrollWidth">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>{{$t('deviceLang.date_time')}}</th>
                                <th>{{$t('deviceLang.code')}}</th>
                                <th>{{$t('deviceLang.summary')}}</th>
                                <th>{{$t('deviceLang.detail_description')}}</th>
                                <th>{{$t('deviceLang.action')}}</th>
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
                            <col width="170">
                            <col width="100">
                            <col width="170">
                            <col width="*">
                            <col width="120">
                        </colgroup>
                        <tbody v-if="alarmData !=null ">
                            <tr v-for="(item,index) in alarmData" :key="index">
                                <td>{{item.created}}</td>
                                <td>{{item.code}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.description}}</td>
                                <td>
                                    <a
                                        v-if="item.type == 'alert'"
                                        @click="getAlarmMosaicDetailInfo(item.id)"
                                    >{{$t('deviceLang.view')}}</a>
                                    <a
                                        v-if="item.type == 'fault'"
                                        @click="getFaultMosaicDetailInfo(item.id)"
                                    >{{$t('deviceLang.view')}}</a>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-if="alarmData==null">
                            <tr>
                                <td colspan="5">
                                    <div class="nodata">{{$t('common.no_data')}}</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="page-btn flex-wrap">
                <div class="block" v-show="alarmData!=null">
                    <el-pagination
                        background
                        class="mix-pagination"
                        @size-change="alarmHandleSizeChange"
                        @current-change="alarmHandleCurrentChange"
                        :current-page.sync="alarmCurrentPage"
                        :page-sizes="[10,20,30,40,50]"
                        :page-size="100"
                        layout="prev, pager, next, sizes, jumper"
                        :total="alarmTotal"
                    ></el-pagination>
                </div>
            </div>
        </div>

        <div class="md-mask" :class="{ 'active': md.mask}"></div>
        <div class="md-loading" :class="{ 'active': md.loading}">
            <i class="el-icon-loading md-loading-icon"></i>
        </div>
        <!-- 设备-报警查看 start -->
        <div class="md-modal-container">
            <div
                class="md-modal md-effect-1 view-equipment-efa"
                :class="{ 'md-show': md.viewAlarm}"
            >
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">{{$t('deviceLang.view_modal_title')}}</div>
                        <div class="iconWrap" @click="closeMd('viewAlarm')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div class="contBox">
                        <div class="view-info-wrap" v-if="alarmInfoData!=null">
                            <div class="row-wrap flex-wrap">
                                <div class="col-wrap">
                                    <div class="title">{{$t('deviceLang.alert_name')}}</div>
                                    <div class="value">{{alarmInfoData.alert_name}}</div>
                                </div>
                                <div class="col-wrap">
                                    <div class="title">{{$t('deviceLang.alert_id')}}</div>
                                    <div class="value">{{alarmInfoData.alert_id}}</div>
                                </div>
                                <div class="col-wrap">
                                    <div class="title">{{$t('deviceLang.equipment_id')}}</div>
                                    <div class="value">{{alarmInfoData.equipment_id}}</div>
                                </div>
                            </div>
                            <div class="row-wrap flex-wrap">
                                <div class="col-wrap">
                                    <div class="title">{{$t('deviceLang.aprus_id')}}</div>
                                    <div class="value">{{alarmInfoData.aprus_id}}</div>
                                </div>
                                <div class="col-wrap">
                                    <div class="title">{{$t('deviceLang.created')}}</div>
                                    <div class="value">{{alarmInfoData.created}}</div>
                                </div>
                            </div>
                            <div class="row-wrap flex-wrap">
                                <div class="colAll">
                                    <div class="title">{{$t('deviceLang.alert_description')}}</div>
                                    <div class="value">{{alarmInfoData.description}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 按钮 -->
                    <div class="buttomBox flex-wrap flex-center">
                        <input
                            type="button"
                            class="btn_determine"
                            :value="$t('common.btn_close')"
                            @click="closeMd('viewAlarm')"
                        >
                    </div>
                </div>
            </div>
        </div>
        <!-- 设备-报警查看 end -->
        <!-- 设备-故障查看 start -->
        <div class="md-modal-container">
            <div
                class="md-modal md-effect-1 view-equipment-efa"
                :class="{ 'md-show': md.viewFault}"
            >
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">{{$t('deviceLang.view_fault_title')}}</div>
                        <div class="iconWrap" @click="closeMd('viewFault')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div class="contBox">
                        <div class="view-info-wrap" v-if="faultInfoData!=null">
                            <div class="row-wrap flex-wrap">
                                <div class="col-wrap">
                                    <div class="title">{{$t('deviceLang.fault_name')}}</div>
                                    <div class="value">{{faultInfoData.fault_name}}</div>
                                </div>
                                <div class="col-wrap">
                                    <div class="title">{{$t('deviceLang.fault_id')}}</div>
                                    <div class="value">{{faultInfoData.fault_id}}</div>
                                </div>
                                <div class="col-wrap">
                                    <div class="title">{{$t('deviceLang.equipment_id')}}</div>
                                    <div class="value">{{faultInfoData.equipment_id}}</div>
                                </div>
                            </div>
                            <div class="row-wrap flex-wrap">
                                <div class="col-wrap">
                                    <div class="title">{{$t('deviceLang.aprus_id')}}</div>
                                    <div class="value">{{faultInfoData.aprus_id}}</div>
                                </div>
                                <div class="col-wrap">
                                    <div class="title">{{$t('deviceLang.created')}}</div>
                                    <div class="value">{{faultInfoData.created}}</div>
                                </div>
                            </div>
                            <div class="row-wrap flex-wrap">
                                <div class="colAll">
                                    <div class="title">{{$t('deviceLang.fault_description')}}</div>
                                    <div class="value">{{faultInfoData.description}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 按钮 -->
                    <div class="buttomBox flex-wrap flex-center">
                        <input
                            type="button"
                            class="btn_determine"
                            :value="$t('common.btn_close')"
                            @click="closeMd('viewFault')"
                        >
                    </div>
                </div>
            </div>
        </div>
        <!-- 设备-故障查看 end -->
    </div>
    <!-- 事件 end -->
</template>

<script>
import deviceApi from "@/fetch/device";
import alarmApi from "@/fetch/alarm";
import faultApi from "@/fetch/fault";

export default {
    name: "status",
    props: {
        equipmentId: Number
    },
    data() {
        return {
            msg: "Welcome to Your Vue.js App",
            // 设备 事件，故障，报警
            alarmData: null,
            alarmTotal: 0,
            alarmInfoData: null,
            faultInfoData: null,
            alarmCurrentPage: 1,
            alarmCurrentPageSize: 10,
            scrollWidth: 0,
            // 弹窗控制
            md: {
                mask: false,
                loading: false,
                viewAlarm: false,
                viewFault: false
            }
        };
    },
    mounted() {
        // console.log(this);
        this.getAlarmMosaicList(this.equipmentId);
    },
    updated() {
        let outer = document.querySelector("div.list-body");
        let inner = document.querySelector("div.list-body>table");
        this.scrollWidth = outer.offsetWidth - inner.offsetWidth;
    },
    methods: {
        // 报警
        getAlarmMosaicList(id) {
            if (!this.equipmentId) {
                return;
            }
            let self = this;
            self.md["loading"] = true;
            deviceApi.get_mosaic_warn_list(
                function(data) {
                    if (data.code == 200) {
                        if (data.result.data.length == 0) {
                            self.md["loading"] = false;
                            return;
                        }
                        self.alarmData = data.result.data;
                        self.alarmTotal = data.result.total_records;
                        // console.log(data);
                    }
                    self.md["loading"] = false;
                },
                {
                    equipment_id: this.equipmentId,
                    page_index: this.alarmCurrentPage,
                    page_size: this.alarmCurrentPageSize
                }
            );
        },
        getAlarmMosaicDetailInfo(alarmId) {
            let self = this;
            self.md["loading"] = true;
            alarmApi.get_alarm_detail(
                function(data) {
                    if (data.code == "200") {
                        self.showMd("viewAlarm");
                        self.alarmInfoData = data.result;
                        // console.log(data.result);
                    }
                    self.md["loading"] = false;
                },
                { alert_id: alarmId }
            );
        },
        getFaultMosaicDetailInfo(faultId) {
            let self = this;
            self.md["loading"] = true;
            faultApi.get_fault_detail(
                function(data) {
                    if (data.code == "200") {
                        self.showMd("viewFault");
                        self.faultInfoData = data.result;
                        // console.log(data);
                    }
                    self.md["loading"] = false;
                },
                { fault_id: faultId }
            );
        },
        alarmHandleSizeChange(val) {
            this.alarmCurrentPageSize = val;
            this.getAlarmMosaicList(this.equipmentId);
        },
        alarmHandleCurrentChange(val) {
            this.getAlarmMosaicList(this.equipmentId);
        },
        // 弹框事件开关
        showMd(md) {
            this.md[md] = true;
            this.md.mask = true;
        },
        closeMd(md) {
            this.md[md] = false;
            this.md.mask = false;
        }
    },
    watch: {
        equipmentId: ["getAlarmMosaicList"]
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "@/assets/sass/device/detail/efa.scss";
</style>
