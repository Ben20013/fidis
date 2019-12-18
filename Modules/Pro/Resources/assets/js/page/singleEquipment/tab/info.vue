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
    <div class="deviceInfo" v-if="deviceInfoData!=null">
        <div class="deviceBaseInfo">
            <div class="title">设备基本信息</div>
            <div class="contentInfo">
                <table class="deviceDetailInfo">
                    <colgroup>
                        <col width="*">
                        <col width="*">
                        <col width="*">
                        <col width="*">
                        <col width="*">
                    </colgroup>
                    <tr>
                        <td rowspan="5" class="center" style="padding-right:10px;">
                            <div class="subtext">设备图片</div>
                            <img
                                :src="pichost+deviceInfoData.equipment_image"
                                alt
                                v-if="deviceInfoData.equipment_image!=null&&deviceInfoData.equipment_image!='null'&&deviceInfoData.equipment_image!=''"
                            >
                            <img src="../../../../images/public/no-image-icon.gif" alt v-else>
                        </td>
                        <td>
                            <div class="subtext">设备ID</div>
                            <div class="name">{{deviceInfoData.equipment_id}}</div>
                        </td>
                        <td>
                            <div class="subtext">设备名称</div>
                            <div class="name">{{deviceInfoData.equipment_name}}</div>
                        </td>
                        <td>
                            <div class="subtext">设备型号</div>
                            <div class="name">{{deviceInfoData.model}}</div>
                        </td>
                        <td>
                            <div class="subtext">数据表</div>
                            <div class="name">{{deviceInfoData.datasheet_id}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="subtext">映射表</div>
                            <div class="name">{{deviceInfoData.mapping_id}}</div>
                        </td>
                        <td>
                            <div class="subtext">客户编号</div>
                            <div class="name">{{deviceInfoData.customer_id}}</div>
                        </td>
                        <td>
                            <div class="subtext">客户名称</div>
                            <div class="name">{{deviceInfoData.customer_name}}</div>
                        </td>
                        <td>
                            <div class="subtext">设备创建时间</div>
                            <div class="name">{{deviceInfoData.created}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="subtext">适配器列表</div>
                            <div class="name">{{deviceInfoData.aprus_list}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="subtext">设备地理信息</div>
                            <div class="name">{{deviceInfoData.gis}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <div class="subtext">描述</div>
                            <div class="name">{{deviceInfoData.description}}</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <el-collapse v-model="activeName">
            <el-collapse-item
                class="energyInfo"
                v-for="(item,index) in deviceInfoDataAddition"
                :title="item.title"
                :name="index"
                :key="index"
            >
                <div class="contentInfo flex-wrap">
                    <div class="item" v-for="sub in item.data">
                        <div class="subtext">{{sub[0]}}</div>
                        <div class="name">{{sub[1]}}</div>
                    </div>
                </div>
            </el-collapse-item>
        </el-collapse>
    </div>
</template>

<script>
import deviceApi from "@/assets/js/fetch/device";
import config from "$config";

export default {
    name: "info",
    props: {
        equipmentId: Number,
        token: String
    },
    data() {
        return {
            msg: "Welcome to Your Vue.js App",
            pichost: config.apiq.pictureAddress,
            deviceInfoData: null,
            deviceInfoDataAddition: {},
            activeName: ""
        };
    },
    mounted() {
        // console.log(this);
        this.getEquipmentInfo(this.equipmentId);
    },
    methods: {
        getEquipmentInfo(id) {
            if (!id || !this.token) {
                return;
            }
            let self = this;
            deviceApi.get_detail(
                function(data) {
                    if (data.code == "200") {
                        // console.log(data);
                        self.deviceInfoData = data.result;
                        self.deviceInfoDataAddition = JSON.parse(
                            data.result.addition
                        );
                    }
                },
                { equipment_id: id },
                this.token
            );
        }
    },
    watch: {
        equipmentId: ["getEquipmentInfo"]
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/singleEquipment/tab/info.scss";
</style>
