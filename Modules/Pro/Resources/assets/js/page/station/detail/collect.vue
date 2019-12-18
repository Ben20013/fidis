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
    <div class="collect-content-wrap flex-column">
        <div class="content flex-column">
            <!-- <div class="collect-btn-wrap">
        <div class="collect-btn" @click="openCollectWin">{{$t('stationLang.data_collect')}}</div>
            </div>-->
            <div class="collect-list flex-column">
                <div class="list-header">
                    <table>
                        <colgroup>
                            <col width="170">
                            <col width="120">
                            <col width="120">
                            <col width="120">
                            <col width="*">
                            <col width="120">
                            <col v-if="scrollWidth" :width="scrollWidth">
                        </colgroup>
                        <thead>
                            <tr>
                                <th>{{$t('stationLang.collect_time')}}</th>
                                <th>{{$t('stationLang.collect_staff')}}</th>
                                <th>{{$t('stationLang.collect_type')}}</th>
                                <th>{{$t('stationLang.collect_value')}}</th>
                                <!-- <th>{{$t('stationLang.summary')}}</th> -->
                                <th>{{$t('stationLang.detail_description')}}</th>
                                <th>{{$t('stationLang.action')}}</th>
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
                            <col width="120">
                            <col width="120">
                            <col width="120">
                            <col width="*">
                            <col width="120">
                        </colgroup>
                        <tbody v-if="collectData!=null">
                            <tr v-for="(item,index) in collectData" :key="index">
                                <td>{{item.collect_time}}</td>
                                <td>{{item.collector}}</td>
                                <td>{{item.collect_name}}</td>
                                <td>{{item.data}}</td>
                                <!-- <td>{{item.collectos_name}}</td> -->
                                <td>{{item.description}}</td>
                                <td>
                                    <a
                                        @click="getCollectDetailInfo(item.collectos_id)"
                                    >{{$t('stationLang.view')}}</a>
                                </td>
                            </tr>
                            <tr v-if="collectData==null">
                                <td colspan="7">
                                    <div class="nodata">{{$t('common.no_data')}}</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="page-btn flex-wrap">
                <div class="block">
                    <el-pagination
                        background
                        class="mix-pagination"
                        @size-change="collectHandleSizeChange"
                        @current-change="collectHandleCurrentChange"
                        :current-page.sync="collectCurrentPage"
                        :page-sizes="[10,20,30,40,50]"
                        :page-size="collectCurrentPageSize"
                        layout="prev, pager, next, sizes, jumper"
                        :total="collectTotal"
                    ></el-pagination>
                </div>
            </div>
        </div>
        <div class="md-mask" :class="{ 'active': md.mask}"></div>
        <div class="md-loading" :class="{ 'active': md.loading}">
            <i class="el-icon-loading md-loading-icon"></i>
        </div>
        <!-- 设备-采集查看 start -->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 view-collect" :class="{ 'md-show': md.viewCollect}">
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">{{$t('stationLang.view_collect_title')}}</div>
                        <div class="iconWrap" @click="closeMd('viewCollect')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div class="contBox">
                        <div class="view-info-wrap" v-if="collectInfoData!=null">
                            <div class="row-wrap flex-wrap">
                                <!-- <div class="col-wrap">
                  <div class="title">{{$t('stationLang.data_name')}}</div>
                  <div class="value">{{collectInfoData.collectos_name}}</div>
                                </div>-->
                                <div class="col-wrap">
                                    <div class="title">{{$t('stationLang.equipment_id')}}</div>
                                    <div class="value">{{collectInfoData.equipment_id}}</div>
                                </div>
                                <div class="col-wrap">
                                    <div class="title">{{$t('stationLang.data_type')}}</div>
                                    <div class="value">{{collectInfoData.collect_name}}</div>
                                </div>
                                <div class="col-wrap">
                                    <div class="title">{{$t('stationLang.collect_value')}}</div>
                                    <div class="value">{{collectInfoData.data}}</div>
                                </div>
                            </div>
                            <div class="row-wrap flex-wrap">
                                <div class="col-wrap">
                                    <div class="title">{{$t('stationLang.unit')}}</div>
                                    <div class="value">{{collectInfoData.unit}}</div>
                                </div>
                                <div class="col-wrap">
                                    <div class="title">{{$t('stationLang.collect_staff')}}</div>
                                    <div class="value">{{collectInfoData.collector}}</div>
                                </div>
                            </div>
                            <div class="row-wrap flex-wrap">
                                <div class="colAll">
                                    <div class="title">{{$t('stationLang.collect_time')}}</div>
                                    <div class="value">{{collectInfoData.collect_time}}</div>
                                </div>
                            </div>
                            <div class="row-wrap flex-wrap">
                                <div class="colAll">
                                    <div class="title">{{$t('stationLang.collect_description')}}</div>
                                    <div class="value">{{collectInfoData.description}}</div>
                                </div>
                            </div>
                            <div class="row-wrap flex-wrap">
                                <div class="colAll">
                                    <div class="title">{{$t('stationLang.annex')}}</div>
                                    <div class="fileList">
                                        <span
                                            class="ic_download download"
                                            v-if="collectInfoData.collectos_file"
                                            @click="downloadFile(collectInfoData.collectos_file)"
                                        >{{$t('stationLang.download')}}</span>
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
                            :value="$t('common.btn_close')"
                            @click="closeMd('viewCollect')"
                        >
                    </div>
                </div>
            </div>
        </div>
        <!-- 设备-采集查看 end -->
        <!-- 数据采集 win start -->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 collect-data" :class="{ 'md-show': md.collect}">
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">{{$t('stationLang.data_collect')}}</div>
                        <div class="iconWrap" @click="closeMd('collect')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div class="contBox">
                        <div class="collect-item-table">
                            <table>
                                <colgroup>
                                    <col width="50%">
                                    <col width="*">
                                </colgroup>
                                <tr>
                                    <td>
                                        <div class="desc-title">{{$t('stationLang.data_type')}}</div>
                                        <div class="block">
                                            <el-select
                                                v-model="collectCategoryValue"
                                                :placeholder="$t('el.select.placeholder')"
                                                @change="collectCategoryChange"
                                            >
                                                <el-option
                                                    v-for="item in collectCategoryData"
                                                    :key="item.collect_id"
                                                    :label="item.collect_name"
                                                    :value="item.collect_id"
                                                ></el-option>
                                            </el-select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="desc-title">{{$t('stationLang.unit')}}</div>
                                        <div class="block">
                                            <el-input
                                                v-model="collectCategoryUnit"
                                                :placeholder="$t('common.placeholder_input')"
                                                readonly
                                            ></el-input>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="desc-title">{{$t('stationLang.collect_value')}}</div>
                                        <div class="block">
                                            <el-input
                                                v-model="collectDataValue"
                                                :placeholder="$t('common.placeholder_input')"
                                            ></el-input>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="desc-title">{{$t('stationLang.collect_time')}}</div>
                                        <div class="block">
                                            <el-date-picker
                                                v-model="collectTimeValue"
                                                type="datetime"
                                                value-format="yyyy-MM-dd HH:mm:ss"
                                                :placeholder="$t('el.datepicker.selectDate')"
                                            ></el-date-picker>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="desc-title">{{$t('stationLang.collect_staff')}}</div>
                                        <div class="block">
                                            <el-input
                                                v-model="collectorValue"
                                                :placeholder="$t('common.placeholder_input')"
                                            ></el-input>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div
                                            class="desc-title"
                                        >{{$t('stationLang.collect_description')}}</div>
                                        <el-input
                                            type="textarea"
                                            :rows="3"
                                            :placeholder="$t('common.placeholder_input')"
                                            v-model="collectDescriptionTextarea"
                                        ></el-input>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="desc-title">{{$t('stationLang.annex')}}</div>
                                        <div class="serverFileBtn">
                                            <el-upload
                                                action
                                                list-type="picture-card"
                                                :limit="1"
                                                :http-request="uploadCollectos"
                                                :file-list="collectFileList"
                                                :on-remove="collectHandleRemove"
                                            >
                                                <i class="el-icon-plus"></i>
                                            </el-upload>
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
                            :value="$t('common.btn_cancel')"
                            @click="closeMd('collect')"
                        >
                        <input
                            type="button"
                            class="btn_determine"
                            :value="$t('common.btn_determine')"
                            @click="addCollectData"
                        >
                    </div>
                </div>
            </div>
        </div>
        <!-- 数据采集 win end -->
    </div>
    <!-- 采集 end -->
</template>

<script>
import deviceApi from "@/assets/js/fetch/device";
import collectApi from "@/assets/js/fetch/collect";

export default {
    name: "status",
    props: {
        mainEquipmentId: Number
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
            scrollWidth: 0,
            // 采集win
            collectNameValue: "",
            collectCategoryValue: "",
            collectCategoryUnit: "",
            collectCategoryData: [],
            collectDataValue: "",
            collectorValue: "",
            collectTimeValue: "",
            collectDescriptionTextarea: "",
            collectFilePath: "",
            collectFileList: [],
            // 弹窗控制
            md: {
                mask: false,
                loading: false,
                viewCollect: false
            }
        };
    },
    mounted() {
        // console.log(this);
        this.getCollectList(this.mainEquipmentId);
    },
    updated() {
        let outer = document.querySelector("div.list-body");
        let inner = document.querySelector("div.list-body>table");
        this.scrollWidth = outer.offsetWidth - inner.offsetWidth;
    },
    methods: {
        // 采集
        collectChangeSelect(index) {
            this.collectListItemCode = index;
        },
        getCollectList(id) {
            if (!this.mainEquipmentId) {
                return;
            }
            let self = this;
            self.md["loading"] = true;
            collectApi.get_list(
                function(data) {
                    if (data.code == 200) {
                        if (data.result.data.length == 0) {
                            self.md["loading"] = false;
                            return;
                        }
                        self.collectData = data.result.data;
                        self.collectTotal = data.result.total_records;
                        // console.log(data);
                    }
                    self.md["loading"] = false;
                },
                {
                    condition: JSON.stringify([
                        ["equipment_id", "=", this.mainEquipmentId]
                    ]),
                    page_index: this.collectCurrentPage,
                    page_size: this.collectCurrentPageSize
                }
            );
        },
        getCollectDetailInfo(collectosId) {
            let self = this;
            collectApi.get_collect_detail(
                function(data) {
                    if (data.code == "200") {
                        self.showMd("viewCollect");
                        self.collectInfoData = data.result;
                        // console.log(data.result);
                    }
                },
                { collectos_id: collectosId }
            );
        },
        collectHandleSizeChange(val) {
            this.collectCurrentPageSize = val;
            this.getCollectList(this.mainEquipmentId);
        },
        collectHandleCurrentChange(val) {
            this.getCollectList(this.mainEquipmentId);
        },
        downloadFile(path) {
            if (path == "" || path == null) {
                return;
            }
            deviceApi.download(path);
        },
        // 采集win
        openCollectWin() {
            // 重置输入框
            this.collectNameValue = "";
            this.collectCategoryValue = "";
            this.collectCategoryUnit = "";
            this.collectCategoryData = [];
            this.collectDataValue = "";
            this.collectorValue =
                this.userName ||
                JSON.parse(localStorage.getItem("user")).username;
            this.collectTimeValue = this.getCurrentTime();
            this.collectDescriptionTextarea = "";
            this.collectFilePath = "";
            this.collectFileList = [];
            if (!this.mainEquipmentId) {
                this.$alert(
                    this.$t("stationLang.no_equipment_collect_tip"),
                    this.$t("stationLang.data_collect"),
                    {
                        confirmButtonText: this.$t("el.messagebox.confirm")
                    }
                );
                return;
            }
            let self = this;
            self.showMd("collect");
            collectApi.get_category_list(
                data => {
                    if (data.code == 200) {
                        self.collectFilePath = "";
                        self.collectFileList = [];
                        if (data.result.data.length == 0) {
                            return;
                        }
                        self.collectCategoryData = data.result.data;
                        self.collectCategoryValue = data.result.collect_id;
                        self.collectCategoryUnit = data.result.unit;
                        // console.log(data);
                    }
                },
                { is_all: 1 }
            );
        },
        collectCategoryChange(val) {
            // console.log(val);
            // console.log(this.collectCategoryData);
            let obj = {};
            obj = this.collectCategoryData.find(item => {
                //这里的userList就是上面遍历的数据源
                return item.collect_id === val; //筛选出匹配数据
            });
            this.collectCategoryUnit = obj.unit;
            // console.log(obj);
        },
        addCollectData() {
            if (this.collectDataValue == "") {
                this.$alert(
                    this.$t("stationLang.collect_value_not_null"),
                    this.$t("stationLang.data_collect"),
                    {
                        confirmButtonText: this.$t("el.messagebox.confirm")
                    }
                );
                return false;
            }
            let self = this;
            collectApi.add_collect_data(
                data => {
                    if (data.code == 200) {
                        self.getCollectList(self.mainEquipmentId);
                        self.closeMd("collect");
                        // console.log(data);
                    }
                },
                {
                    "collectos id": "",
                    collectos_name: this.collectNameValue,
                    collect_time: this.collectTimeValue,
                    description: this.collectDescriptionTextarea,
                    collect_id: this.collectCategoryValue,
                    equipment_id: this.mainEquipmentId,
                    data: this.collectDataValue,
                    collectos_file: this.collectFilePath,
                    collector: this.collectorValue
                }
            );
        },
        uploadCollectos(item) {
            let formData = new FormData();
            formData.append("upload_file", item.file);
            formData.append("type", "collectos");
            let self = this;
            deviceApi.upload(function(data) {
                if (data.code == 200) {
                    self.collectFilePath = data.result.path;
                    let type = item.file.type.split("/");
                    if (type[0] != "image") {
                        self.collectFileList.push({
                            name: item.file.name,
                            url:
                                "./modules/pro/static/images/public/uploadfile.png"
                        });
                    }
                }
            }, formData);
        },
        collectHandleRemove() {
            this.collectFileList = [];
        },
        getCurrentTime() {
            let time = "";
            let date = new Date();
            let year = date.getFullYear();
            let month = date.getMonth() + 1;
            let day = date.getDate();
            let h = date.getHours();
            let m = date.getMinutes();
            let s = date.getSeconds();
            time =
                year +
                "-" +
                formatStr(month) +
                "-" +
                formatStr(day) +
                " " +
                formatStr(h) +
                ":" +
                formatStr(m) +
                ":" +
                formatStr(s);
            function formatStr(str) {
                str = str < 10 ? "0" + str : str;
                return str;
            }
            return time;
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
        mainEquipmentId: ["getCollectList"]
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/station/detail/collect.scss";
</style>
