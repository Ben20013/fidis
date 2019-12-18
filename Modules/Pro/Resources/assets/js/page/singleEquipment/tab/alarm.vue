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
    <div class="equipmentEFA flex-column">
        <div class="equipmentEFAContent flex-column">
            <div class="EFAList">
                <table>
                    <colgroup>
                        <col width="170">
                        <col width="100">
                        <col width="170">
                        <col width="*">
                        <col width="120">
                    </colgroup>
                    <tr>
                        <th>日期时间</th>
                        <th>统一编号</th>
                        <th>摘要</th>
                        <th>详细描述</th>
                        <th>操作</th>
                    </tr>
                    <tr
                        v-if="alarmData!=null"
                        v-for="(item,index) in alarmData"
                        :class="{'active':index==alarmListItemCode}"
                        @click="alarmChangeSelect(index)"
                    >
                        <td>{{item.created}}</td>
                        <td>{{item.code}}</td>
                        <td>{{item.alert_name}}</td>
                        <td>{{item.description}}</td>
                        <td>
                            <div class="ic_show" @click="getAlarmMosaicDetailInfo(item.alert_id)"></div>
                        </td>
                    </tr>
                    <tr v-if="alarmData==null">
                        <td colspan="5">
                            <div class="nodata">暂无数据</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="pageBtn flex-wrap">
            <div class="block" v-show="alarmData!=null">
                <el-pagination
                    background
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
        <div class="md-mask" :class="{ 'active': md.mask}"></div>
        <div class="md-loading" :class="{ 'active': md.loading}">
            <i class="el-icon-loading md-loading-icon"></i>
        </div>
        <!-- 设备-报警查看 start -->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 viewequipmentEFA" :class="{ 'md-show': md.viewAlarm}">
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">查看报警信息</div>
                        <div class="iconWrap" @click="closeMd('viewAlarm')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div class="contBox">
                        <div class="viewInfoWrap" v-if="alarmInfoData!=null">
                            <div class="rowWrap flex-wrap">
                                <div class="colWrap">
                                    <div class="title">故障名称</div>
                                    <div class="value">{{alarmInfoData.alert_name}}</div>
                                </div>
                                <div class="colWrap">
                                    <div class="title">故障编号</div>
                                    <div class="value">{{alarmInfoData.alert_id}}</div>
                                </div>
                                <div class="colWrap">
                                    <div class="title">设备ID</div>
                                    <div class="value">{{alarmInfoData.equipment_id}}</div>
                                </div>
                            </div>
                            <div class="rowWrap flex-wrap">
                                <div class="colWrap">
                                    <div class="title">适配器编号</div>
                                    <div class="value">{{alarmInfoData.aprus_id}}</div>
                                </div>
                                <div class="colWrap">
                                    <div class="title">产生时间</div>
                                    <div class="value">{{alarmInfoData.created}}</div>
                                </div>
                            </div>
                            <div class="rowWrap flex-wrap">
                                <div class="colAll">
                                    <div class="title">设备描述</div>
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
                            value="关闭"
                            @click="closeMd('viewAlarm')"
                        >
                    </div>
                </div>
            </div>
        </div>
        <!-- 设备-报警查看 end -->
    </div>
    <!-- 事件 end -->
</template>

<script>
import deviceApi from "@/assets/js/fetch/device";
import alarmApi from "@/assets/js/fetch/alarm";

export default {
    name: "status",
    props: {
        equipmentId: Number,
        token: String
    },
    data() {
        return {
            msg: "Welcome to Your Vue.js App",
            // 设备 事件，故障，报警
            alarmData: null,
            alarmListItemCode: 0,
            alarmListItemCode: 0,
            alarmTotal: 0,
            alarmInfoData: null,
            alarmCurrentPage: 1,
            alarmCurrentPageSize: 10,
            // 弹窗控制
            md: {
                mask: false,
                viewEvent: false
            }
        };
    },
    mounted() {
        // console.log(this);
        this.getAlarmMosaicList(this.equipmentId);
    },
    methods: {
        // 报警
        alarmChangeSelect(index) {
            this.alarmListItemCode = index;
        },
        getAlarmMosaicList(id) {
            if (!id || !this.token) {
                return;
            }
            let self = this;
            deviceApi.get_alarm_mosaic_list(
                function(data) {
                    if (data.code == 200) {
                        if (data.result.data.length == 0) {
                            return;
                        }
                        self.alarmData = data.result.data;
                        self.alarmTotal = data.result.total_records;
                        // console.log(data);
                    }
                },
                {
                    equipment_id: id,
                    page_index: this.alarmCurrentPage,
                    page_size: this.alarmCurrentPageSize
                },
                this.token
            );
        },
        getAlarmMosaicDetailInfo(alarmId) {
            if (!this.token) {
                return;
            }
            let self = this;
            alarmApi.get_alarm_detail(
                function(data) {
                    if (data.code == "200") {
                        self.showMd("viewAlarm");
                        self.alarmInfoData = data.result;
                        // console.log(data.result);
                    }
                },
                { alert_id: alarmId },
                this.token
            );
        },
        alarmHandleSizeChange(val) {
            this.alarmCurrentPageSize = val;
            this.getAlarmMosaicList();
        },
        alarmHandleCurrentChange(val) {
            this.getAlarmMosaicList();
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
@import "../../../../sass/singleEquipment/tab/efa.scss";
</style>
