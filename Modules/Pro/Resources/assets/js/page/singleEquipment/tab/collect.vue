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
    <!-- 采集 start -->
    <div class="equipmentEFA equipmentCollect flex-column">
        <div class="equipmentEFAContent flex-column">
            <div class="EFAList">
                <table>
                    <colgroup>
                        <col width="170">
                        <col width="120">
                        <col width="120">
                        <col width="120">
                        <col width="*">
                        <col width="120">
                    </colgroup>
                    <tr>
                        <th>采集时间</th>
                        <th>采集人员</th>
                        <th>采集类型</th>
                        <th>摘要</th>
                        <th>详细描述</th>
                        <th>操作</th>
                    </tr>
                    <tr
                        v-if="collectData!=null"
                        v-for="(item,index) in collectData"
                        :class="{'active':index==collectListItemCode}"
                        @click="collectChangeSelect(index)"
                    >
                        <td>{{item.collect_time}}</td>
                        <td>{{item.collector}}</td>
                        <td>{{item.collect_name}}</td>
                        <td>{{item.collectos_name}}</td>
                        <td>{{item.description}}</td>
                        <td>
                            <div class="ic_show" @click="getCollectDetailInfo(item.collectos_id)"></div>
                        </td>
                    </tr>
                    <tr v-if="collectData==null">
                        <td colspan="5">
                            <div class="nodata">暂无数据</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="pageBtn flex-wrap">
            <div class="block" v-show="collectData!=null">
                <el-pagination
                    background
                    @size-change="collectHandleSizeChange"
                    @current-change="collectHandleCurrentChange"
                    :current-page.sync="collectCurrentPage"
                    :page-sizes="[10,20,30,40,50]"
                    :page-size="100"
                    layout="prev, pager, next, sizes, jumper"
                    :total="collectTotal"
                ></el-pagination>
            </div>
        </div>
        <div class="md-mask" :class="{ 'active': md.mask}"></div>
        <div class="md-loading" :class="{ 'active': md.loading}">
            <i class="el-icon-loading md-loading-icon"></i>
        </div>
        <!-- 设备-采集查看 start -->
        <div class="md-modal-container">
            <div
                class="md-modal md-effect-1 viewequipmentEFA viewCollect"
                :class="{ 'md-show': md.viewCollect}"
            >
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">查看采集信息</div>
                        <div class="iconWrap" @click="closeMd('viewCollect')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div class="contBox">
                        <div class="viewInfoWrap" v-if="collectInfoData!=null">
                            <div class="rowWrap flex-wrap">
                                <div class="colWrap">
                                    <div class="title">数据名称</div>
                                    <div class="value">{{collectInfoData.collectos_name}}</div>
                                </div>
                                <div class="colWrap">
                                    <div class="title">设备ID</div>
                                    <div class="value">{{collectInfoData.equipment_id}}</div>
                                </div>
                                <div class="colWrap">
                                    <div class="title">数据类型</div>
                                    <div class="value">{{collectInfoData.collect_name}}</div>
                                </div>
                            </div>
                            <div class="rowWrap flex-wrap">
                                <div class="colWrap">
                                    <div class="title">数值</div>
                                    <div class="value">{{collectInfoData.data}}</div>
                                </div>
                                <div class="colWrap">
                                    <div class="title">单位</div>
                                    <div class="value">{{collectInfoData.unit}}</div>
                                </div>
                                <div class="colWrap">
                                    <div class="title">采集人员</div>
                                    <div class="value">{{collectInfoData.collector}}</div>
                                </div>
                            </div>
                            <div class="rowWrap flex-wrap">
                                <div class="colAll">
                                    <div class="title">采集时间</div>
                                    <div class="value">{{collectInfoData.collect_time}}</div>
                                </div>
                            </div>
                            <div class="rowWrap flex-wrap">
                                <div class="colAll">
                                    <div class="title">设备描述</div>
                                    <div class="value">{{collectInfoData.description}}</div>
                                </div>
                            </div>
                            <div class="rowWrap flex-wrap">
                                <div class="colAll">
                                    <div class="title">附件</div>
                                    <div class="fileList">
                                        <span
                                            class="ic_download download"
                                            v-if="collectInfoData.collectos_file"
                                            @click="downloadFile(collectInfoData.collectos_file)"
                                        >立即下载</span>
                                    </div>
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
                            @click="closeMd('viewCollect')"
                        >
                    </div>
                </div>
            </div>
        </div>
        <!-- 设备-采集查看 end -->
    </div>
    <!-- 采集 end -->
</template>

<script>
import collectApi from "@/assets/js/fetch/collect";

export default {
    name: "status",
    props: {
        equipmentId: Number,
        token: String
    },
    data() {
        return {
            msg: "Welcome to Your Vue.js App",
            // 采集
            collectData: null,
            collectListItemCode: 0,
            collectListItemCode: 0,
            collectTotal: 0,
            collectInfoData: null,
            collectCurrentPage: 1,
            collectCurrentPageSize: 10,
            // 弹窗控制
            md: {
                mask: false,
                viewCollect: false
            }
        };
    },
    mounted() {
        // console.log(this);
        this.getCollectList(this.equipmentId);
    },
    methods: {
        // 采集
        collectChangeSelect(index) {
            this.collectListItemCode = index;
        },
        getCollectList(id) {
            if (!id || !this.token) {
                return;
            }
            let self = this;
            collectApi.get_list(
                function(data) {
                    if (data.code == 200) {
                        if (data.result.data.length == 0) {
                            return;
                        }
                        self.collectData = data.result.data;
                        self.collectTotal = data.result.total_records;
                        // console.log(data);
                    }
                },
                {
                    condition: JSON.stringify([["equipment_id", "=", id]]),
                    page_index: this.collectCurrentPage,
                    page_size: this.collectCurrentPageSize
                },
                this.token
            );
        },
        getCollectDetailInfo(collectosId) {
            if (!this.token) {
                return;
            }
            let self = this;
            collectApi.get_collect_detail(
                function(data) {
                    if (data.code == "200") {
                        self.showMd("viewCollect");
                        self.collectInfoData = data.result;
                        // console.log(data.result);
                    }
                },
                { collectos_id: collectosId },
                this.token
            );
        },
        collectHandleSizeChange(val) {
            this.collectCurrentPageSize = val;
            this.getCollectList(this.equipmentId);
        },
        collectHandleCurrentChange(val) {
            this.getCollectList(this.equipmentId);
        },
        downloadFile(path) {
            if (path == "" || path == null) {
                return;
            }
            deviceApi.download(path);
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
        equipmentId: ["getCollectList"]
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/singleEquipment/tab/efa.scss";
</style>
