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
                        v-if="eventData!=null"
                        v-for="(item,index) in eventData"
                        :class="{'active':index==eventListItemCode}"
                        @click="eventChangeSelect(index)"
                    >
                        <td>{{item.created}}</td>
                        <td>{{item.code}}</td>
                        <td>{{item.event_name}}</td>
                        <td>{{item.description}}</td>
                        <td>
                            <div class="ic_show" @click="getEventMosaicDetailInfo(item.event_id)"></div>
                        </td>
                    </tr>
                    <tr v-if="eventData==null">
                        <td colspan="5">
                            <div class="nodata">暂无数据</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="pageBtn flex-wrap">
            <div class="block" v-show="eventData!=null">
                <el-pagination
                    background
                    @size-change="eventHandleSizeChange"
                    @current-change="eventHandleCurrentChange"
                    :current-page.sync="eventCurrentPage"
                    :page-sizes="[10,20,30,40,50]"
                    :page-size="100"
                    layout="prev, pager, next, sizes, jumper"
                    :total="eventTotal"
                ></el-pagination>
            </div>
        </div>
        <div class="md-mask" :class="{ 'active': md.mask}"></div>
        <div class="md-loading" :class="{ 'active': md.loading}">
            <i class="el-icon-loading md-loading-icon"></i>
        </div>
        <!-- 设备告警-事件查看 start -->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 viewequipmentEFA" :class="{ 'md-show': md.viewEvent}">
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">查看事件信息</div>
                        <div class="iconWrap" @click="closeMd('viewEvent')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div class="contBox">
                        <div class="viewInfoWrap" v-if="eventInfoData!=null">
                            <div class="rowWrap flex-wrap">
                                <div class="colWrap">
                                    <div class="title">事件名称</div>
                                    <div class="value">{{eventInfoData.event_name}}</div>
                                </div>
                                <div class="colWrap">
                                    <div class="title">事件编号</div>
                                    <div class="value">{{eventInfoData.event_id}}</div>
                                </div>
                                <div class="colWrap">
                                    <div class="title">设备ID</div>
                                    <div class="value">{{eventInfoData.equipment_id}}</div>
                                </div>
                            </div>
                            <div class="rowWrap flex-wrap">
                                <div class="colWrap">
                                    <div class="title">适配器编号</div>
                                    <div class="value">{{eventInfoData.aprus_id}}</div>
                                </div>
                                <div class="colWrap">
                                    <div class="title">产生时间</div>
                                    <div class="value">{{eventInfoData.created}}</div>
                                </div>
                                <div class="colWrap">
                                    <div class="title">统一编码</div>
                                    <div class="value">{{eventInfoData.code}}</div>
                                </div>
                            </div>
                            <div class="rowWrap flex-wrap">
                                <div class="colAll">
                                    <div class="title">事件描述</div>
                                    <div class="value">{{eventInfoData.description}}</div>
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
                            @click="closeMd('viewEvent')"
                        >
                    </div>
                </div>
            </div>
        </div>
        <!-- 设备-事件查看 end -->
    </div>
    <!-- 事件 end -->
</template>

<script>
import eventApi from "@/assets/js/fetch/event";

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
            eventData: null,
            eventListItemCode: 0,
            eventTotal: 0,
            eventInfoData: null,
            eventCurrentPage: 1,
            eventCurrentPageSize: 10,
            // 弹窗控制
            md: {
                mask: false,
                viewEvent: false
            }
        };
    },
    mounted() {
        // console.log(this);
        this.getEventMosaicList(this.equipmentId);
    },
    methods: {
        // 事件
        eventChangeSelect(index) {
            this.eventListItemCode = index;
        },
        getEventMosaicList(id) {
            if (!id || !this.token) {
                return;
            }
            let self = this;
            eventApi.get_list(
                function(data) {
                    if (data.code == 200) {
                        if (data.result.data.length == 0) {
                            return;
                        }
                        self.eventData = data.result.data;
                        self.eventTotal = data.result.total_records;
                        // console.log(data);
                    }
                },
                {
                    condition: JSON.stringify([["equipment_id", "=", id]]),
                    page_index: this.eventCurrentPage,
                    page_size: this.eventCurrentPageSize
                },
                this.token
            );
        },
        getEventMosaicDetailInfo(eventId) {
            if (!this.token) {
                return;
            }
            let self = this;
            eventApi.get_event_detail(
                function(data) {
                    if (data.code == "200") {
                        self.showMd("viewEvent");
                        self.eventInfoData = data.result;
                        // console.log(data.result);
                    }
                },
                { event_id: eventId },
                this.token
            );
        },
        eventHandleSizeChange(val) {
            this.eventCurrentPageSize = val;
            this.getEventMosaicList();
        },
        eventHandleCurrentChange(val) {
            this.getEventMosaicList();
        },
        // 设备历程 end
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
        equipmentId: ["getEventMosaicList"]
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/singleEquipment/tab/efa.scss";
</style>
