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
  <div class="info-content-wrap">
    <div class="base-info">
      <div class="info-title-wrap flex-wrap">
        <div class="info-title">{{$t('deviceLang.base_info')}}</div>
        <div class="info-btn-wrap flex-wrap">
          <div class="create-service-btn" @click="openServiceWin">
            <i class="mix-add-icon"></i>
            <span>{{$t('deviceLang.processing_records')}}</span>
          </div>
          <div class="edit-btn" @click="openEditEquipmentInfoWin">
            <i class="mix-edit-icon"></i>
          </div>
          <div class="refresh-btn" @click="refresh">
            <i class="mix-refresh-icon"></i>
          </div>
        </div>
      </div>
      <div class="info-content flex-wrap" v-if="deviceInfoData!=null">
        <div class="left-content">
          <div class="item">
            <div class="name">{{$t('deviceLang.equipment_image')}}</div>
            <div class="value">
              <img
                v-if="deviceInfoData.equipment_image!=''&&deviceInfoData.equipment_image!=null"
                :src="pichost+deviceInfoData.equipment_image"
                alt
              />
              <img src="../../../../images/public/no-image-icon.gif" alt v-else />
            </div>
          </div>
        </div>
        <div class="right-content flex-wrap">
          <div class="item">
            <div class="name">{{$t('deviceLang.equipment_id')}}</div>
            <div class="value num">{{deviceInfoData.equipment_id}}</div>
          </div>
          <div class="item">
            <div class="name">{{$t('deviceLang.equipment_name')}}</div>
            <div class="value">{{deviceInfoData.equipment_name}}</div>
          </div>
          <div class="item">
            <div class="name">{{$t('deviceLang.equipment_model')}}</div>
            <div class="value">{{deviceInfoData.model}}</div>
          </div>
          <div class="item">
            <div class="name">{{$t('deviceLang.datasheet')}}</div>
            <div class="value num">{{deviceInfoData.datasheet_id}}</div>
          </div>
          <div class="item">
            <div class="name">{{$t('deviceLang.equipment_create')}}</div>
            <div class="value num">{{deviceInfoData.created}}</div>
          </div>
          <div class="item">
            <div class="name">{{$t('deviceLang.mapping')}}</div>
            <div class="value num">{{deviceInfoData.mapping_id}}</div>
          </div>
          <div class="item">
            <div class="name">{{$t('deviceLang.customer_id')}}</div>
            <div class="value num">{{deviceInfoData.customer_id}}</div>
          </div>
          <div class="item">
            <div class="name">{{$t('deviceLang.customer_name')}}</div>
            <div class="value num">{{deviceInfoData.customer_name}}</div>
          </div>
          <div class="item gis">
            <div class="name">{{$t('deviceLang.equipment_address')}}</div>
            <div class="value num">{{deviceInfoGisAddress}}</div>
          </div>
          <div class="item desc">
            <div class="name">{{$t('deviceLang.aprus_list')}}</div>
            <div class="value num">{{deviceInfoData.aprus_list}}</div>
          </div>
          <div class="item desc">
            <div class="name">{{$t('deviceLang.equipment_description')}}</div>
            <div
              class="value num"
              :title="deviceInfoData.description"
            >{{deviceInfoData.description}}</div>
          </div>
        </div>
      </div>
    </div>
    <el-collapse v-model="activeName" class="mix-collapse">
      <el-collapse-item
        class="energy-info"
        v-for="(item,index) in deviceInfoDataAddition"
        :title="item.title"
        :name="index"
        :key="index"
      >
        <div class="content-info flex-wrap">
          <div class="item" v-for="(sub,sindex) in item.data" :key="sindex">
            <div class="subtext">{{sub[0]}}</div>
            <div class="name">{{sub[1]}}</div>
          </div>
        </div>
      </el-collapse-item>
    </el-collapse>
    <!--弹框-->
    <div class="md-mask" :class="{ 'active': md.mask}"></div>
    <div class="md-loading" :class="{ 'active': md.loading}">
      <i class="el-icon-loading md-loading-icon"></i>
    </div>
    <!-- 编辑设备信息 start -->
    <div class="md-modal-container">
      <div class="md-modal md-effect-1 editBaseInfo" :class="{ 'md-show': md.edit}">
        <div class="md-content">
          <!--头部-->
          <div class="titleBox flex-wrap flex-center">
            <div class="title">{{$t('deviceLang.edit_info')}}</div>
            <div class="iconWrap" @click="closeEditEquipmentInfoWin">
              <i class="close"></i>
            </div>
          </div>
          <!--内容-->
          <div class="contBox">
            <div class="editBaseInfoWrap">
              <div class="deviceBaseInfo" v-if="deviceInfoData!=null">
                <div class="title">{{$t('deviceLang.base_info')}}</div>
                <div class="contentInfo">
                  <table class="deviceDetailInfo">
                    <colgroup>
                      <col width="*" />
                      <col width="*" />
                      <col width="*" />
                      <col width="*" />
                      <col width="*" />
                    </colgroup>
                    <tr>
                      <td rowspan="3" class="center">
                        <div class="subtext">{{$t('deviceLang.equipment_image')}}</div>
                        <img
                          :src="pichost+deviceInfoData.equipment_image"
                          alt
                          v-if="deviceInfoData.equipment_image!=null&&deviceInfoData.equipment_image!='null'&&deviceInfoData.equipment_image!=''"
                        />
                        <img src="../../../../images/public/no-image-icon.gif" alt v-else />
                      </td>
                      <td>
                        <div class="subtext">{{$t('deviceLang.equipment_id')}}</div>
                        <div class="name">{{deviceInfoData.equipment_id}}</div>
                      </td>
                      <td>
                        <div class="subtext">{{$t('deviceLang.equipment_name')}}</div>
                        <div class="name">{{deviceInfoData.equipment_name}}</div>
                      </td>
                      <td>
                        <div class="subtext">{{$t('deviceLang.equipment_model')}}</div>
                        <div class="name">{{deviceInfoData.model}}</div>
                      </td>
                      <td>
                        <div class="subtext">{{$t('deviceLang.datasheet')}}</div>
                        <div class="name">{{deviceInfoData.datasheet_id}}</div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="subtext">{{$t('deviceLang.mapping')}}</div>
                        <div class="name">{{deviceInfoData.mapping_id}}</div>
                      </td>
                      <td>
                        <div class="subtext">{{$t('deviceLang.customer_id')}}</div>
                        <div class="name">{{deviceInfoData.customer_id}}</div>
                      </td>
                      <td>
                        <div class="subtext">{{$t('deviceLang.customer_name')}}</div>
                        <div class="name">{{deviceInfoData.customer_name}}</div>
                      </td>
                      <td>
                        <div class="subtext">{{$t('deviceLang.equipment_create')}}</div>
                        <div class="name">{{deviceInfoData.created}}</div>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="4">
                        <div class="subtext">{{$t('deviceLang.aprus_list')}}</div>
                        <div class="name">{{deviceInfoData.aprus_list}}</div>
                      </td>
                    </tr>
                  </table>
                  <!-- <div class="edit-info__address">
                    <div class="edit-info__address-input flex-wrap">
                      <div class="input__item">
                        <div class="edit-info_subtext">{{$t('deviceLang.equipment_address')}}</div>
                        <div class="edit-info_name">
                          <el-input v-model="editInfoGisAddress" id="editInfoMapSearch"></el-input>
                        </div>
                      </div>
                      <div class="input__item">
                        <div class="edit-info_subtext">{{$t('deviceLang.equipment_address')}}</div>
                        <div class="edit-info_name">
                          <el-input v-model="editInfoGis" readonly></el-input>
                        </div>
                      </div>
                    </div>
                    <div class="edit-info__address-map" id="editInfoMap"></div>
                  </div> -->
                  <div class="edit-info__description">
                    <div class="edit-info_subtext">{{$t('deviceLang.equipment_description')}}</div>
                    <div class="edit-info_name">
                      <el-input
                        type="textarea"
                        class="mix-input"
                        :rows="3"
                        :placeholder="$t('common.placeholder_input')"
                        v-model="editTextarea"
                      ></el-input>
                    </div>
                  </div>
                </div>
              </div>
              <div
                class="energyInfo"
                v-for="(item,index) in editdeviceInfoDataAddition"
                :title="item.title"
                :name="index"
                :key="index"
              >
                <div class="title">{{item.title}}</div>
                <div class="contentInfo flex-wrap">
                  <div class="item" v-for="(sub,sindex) in item.data" :key="sindex">
                    <div class="subtext">{{sub[0]}}</div>
                    <div class="name">
                      <el-input
                        v-model="sub[1]"
                        :placeholder="$t('common.placeholder_input')"
                        :value="sub[1]"
                        class="mix-input"
                      ></el-input>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- 按钮 -->
          <div class="buttomBox flex-wrap flex-center">
            <input
              type="button"
              class="btn_cancel"
              :value="$t('common.btn_cancel')"
              @click="closeEditEquipmentInfoWin"
            />
            <input
              type="button"
              class="btn_determine"
              :value="$t('common.btn_determine')"
              @click="editEquipmentInfo"
            />
          </div>
        </div>
      </div>
    </div>
    <!-- 编辑设备信息 end -->
    <!-- 创建服务 win start -->
    <div class="md-modal-container">
      <div class="md-modal md-effect-1 addDevice" :class="{ 'md-show': md.add}">
        <div class="md-content">
          <!--头部-->
          <div class="titleBox flex-wrap flex-center">
            <div class="title">{{$t('deviceLang.processing_records')}}</div>
            <div class="iconWrap" @click="closeMd('add')">
              <i class="close"></i>
            </div>
          </div>
          <!--内容-->
          <div class="contBox">
            <div class="serviceItemTable">
              <table>
                <colgroup>
                  <col width="50%" />
                  <col width="*" />
                </colgroup>
                <tr>
                  <td>
                    <div class="descTitle">{{$t('deviceLang.processing_date')}}</div>
                    <div class="block">
                      <el-date-picker
                        v-model="serviceCreateTime"
                        type="datetime"
                        class="mix-input"
                        value-format="yyyy-MM-dd HH:mm:ss"
                        :placeholder="$t('el.datepicker.selectDate')"
												:picker-options="{
													disabledDate(time) {
														return time.getTime() > Date.now();
													}
												}"
                      ></el-date-picker>
                    </div>
                  </td>
                  <td>
                    <div class="descTitle">{{$t('deviceLang.processing_category')}}</div>
                    <div class="block">
                      <el-select
                        v-model="serviceTypeValue"
                        :placeholder="$t('el.select.placeholder')"
                        class="mix-select"
                      >
                        <el-option
                          v-for="item in serviceTypeOptions"
                          :key="item.value"
                          :label="item.label"
                          :value="item.label"
                        ></el-option>
                      </el-select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="descTitle">{{$t('deviceLang.processing_staff')}}</div>
                    <div class="block">
                      <el-input
                        v-model="servicePersonValue"
                        :placeholder="$t('common.placeholder_input')"
                        class="mix-input"
                      ></el-input>
                    </div>
                  </td>
                  <td>
                    <div class="descTitle">{{$t('deviceLang.processing_name')}}</div>
                    <div class="block">
                      <el-input
                        v-model="serviceNameValue"
                        :placeholder="$t('common.placeholder_input')"
                        class="mix-input"
                      ></el-input>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div class="descTitle">{{$t('deviceLang.customer_id')}}</div>
                    <div class="block">
                      <el-select
                        v-model="serviceCustomerId"
                        :placeholder="$t('el.select.placeholder')"
                        class="mix-select"
                      >
                        <el-option
                          v-for="item in serviceCustomerData"
                          :key="item.customer_id"
                          :label="item.customer_name"
                          :value="item.customer_id"
                        ></el-option>
                      </el-select>
                    </div>
                  </td>
                  <td>
                    <div class="descTitle">{{$t('deviceLang.equipment_id')}}</div>
                    <div class="block">
                      <el-select
                        v-model="serviceEquipmentId"
                        :placeholder="$t('el.select.placeholder')"
                        class="mix-select"
                      >
                        <el-option
                          v-for="item in serviceEquipmentData"
                          :key="item.equipment_id"
                          :label="item.equipment_name"
                          :value="item.equipment_id"
                        ></el-option>
                      </el-select>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div class="descTitle">{{$t('deviceLang.processing_description')}}</div>
                    <el-input
                      type="textarea"
                      class="mix-input"
                      :rows="3"
                      :placeholder="$t('common.placeholder_input')"
                      v-model="serviceDescriptionTextarea"
                    ></el-input>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <div class="descTitle">{{$t('deviceLang.processing_annex')}}</div>
                    <div class="serverFileBtn">
                      <el-upload
                        action
                        list-type="picture-card"
                        :limit="1"
                        :http-request="uploadService"
                        :file-list="serviceFileList"
                        :on-remove="serviceHandleRemove"
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
              @click="closeMd('add')"
            />
            <input
              type="button"
              class="btn_determine"
              :value="$t('common.btn_determine')"
              @click="addService"
            />
          </div>
        </div>
      </div>
    </div>
    <!-- 创建服务 win end -->
  </div>
</template>

<script>
import deviceApi from "@/assets/js/fetch/device";
import serviceApi from "@/assets/js/fetch/service";
import customerApi from "@/assets/js/fetch/customer";
import config from "$config";
export default {
  name: "customer",
  props: {
    equipmentId: Number
  },
  data() {
    return {
      pichost: config.apiq.pictureAddress,
      currentTab: "info",
      activeName: "",
      deviceInfoData: null,
      deviceInfoDataAddition: {},
      editTextarea: "",
      editdeviceInfoDataAddition: {},
      serviceEquipmentData: [],
      serviceTypeOptions: [
        { value: 0, label: this.$t("deviceLang.daily_inspection") },
        { value: 1, label: this.$t("deviceLang.equipment_repair") },
        { value: 2, label: this.$t("deviceLang.regular_maintenance") },
        { value: 3, label: this.$t("deviceLang.troubleshooting") },
        { value: 4, label: this.$t("deviceLang.alarm_processing") },
        { value: 5, label: this.$t("deviceLang.other") }
      ],
      serviceTypeValue: "",
      servicePersonValue: "",
      serviceNameValue: "",
      serviceCreateTime: "",
      serviceCustomerId: "",
      serviceCustomerData: [],
      serviceEquipmentId: "",
      serviceDescriptionTextarea: "",
      serviceFilePath: "",
      serviceFileList: [],
      activeName: "",
      editInfoGisAddress: "",
      editInfoGis: "",
      deviceInfoGisAddress: "",
      // 弹窗控制
      md: {
        mask: false,
        loading: false,
        add: false
      }
    };
  },
  created() {},
  mounted() {
    this.getEquipmentInfo(this.equipmentId);
  },
  methods: {
    refresh() {
      this.getEquipmentInfo(this.equipmentId);
    },
    getEquipmentInfo(id) {
      if (!this.equipmentId) {
        return;
      }
      let self = this;
      self.md["loading"] = true;
      deviceApi.get_detail(
        function(data) {
          if (data.code == "200") {
            self.deviceInfoData = data.result;
            self.deviceInfoDataAddition = JSON.parse(data.result.addition);
            self.editdeviceInfoDataAddition = self.deviceInfoDataAddition;
            self.getGisAddress(data.result.gis);
          }
          self.md["loading"] = false;
        },
        { equipment_id: this.equipmentId }
      );
    },
    getGisAddress(gis) {
      if (gis != "" && gis != null) {
        let self = this;
        let pp = gis.split(",");
        let point = new BMap.Point(pp[1], pp[0]);
        let geocoder = new BMap.Geocoder();
        geocoder.getLocation(point, function(res) {
          self.deviceInfoGisAddress = res.address;
        });
      }
    },
    openEditEquipmentInfoWin() {
      if (!this.deviceInfoData) {
        this.$alert(
          this.$t("deviceLang.no_eidt_equipment_info"),
          this.$t("deviceLang.edit_info"),
          {
            confirmButtonText: this.$t("el.messagebox.confirm")
          }
        );
        return;
      }
      this.editTextarea = "";
      this.editInfoGisAddress = "";
      this.editInfoGis = "";
      this.showMd("edit");
      let self = this;
      deviceApi.get_detail(
        function(data) {
          if (data.code == "200") {
            if (data.result.length == 0) {
              return;
            }
            self.editdeviceInfoDataAddition = JSON.parse(data.result.addition);
            self.editTextarea = self.deviceInfoData.description;
            self.editInfoGis = self.deviceInfoData.gis;
            self.editInfoMap();
            // console.log(data);
          }
        },
        { equipment_id: this.deviceInfoData.equipment_id }
      );
    },
    closeEditEquipmentInfoWin() {
      this.closeMd("edit");
      this.editTextarea = "";
      this.editdeviceInfoDataAddition = null;
    },
    editEquipmentInfo() {
      let data = {};
      data.equipment_id = this.deviceInfoData.equipment_id;
      data.equipment_name = this.deviceInfoData.equipment_name;
      data.description = this.editTextarea;
      data.gis = this.editInfoGis;
      data.addition = "";
      if (this.editdeviceInfoDataAddition != null) {
        data.addition = JSON.stringify(this.editdeviceInfoDataAddition);
      }
      let self = this;
      deviceApi.edit_equipment_info(function(data) {
        if (data.code == 200) {
          self.closeMd("edit");
          self.getEquipmentInfo(self.equipmentId);
          self.$message(data.msg, "success");
          // self.deviceInfoData.description = self.editTextarea;
          // self.deviceInfoDataAddition = self.editdeviceInfoDataAddition;
        }
      }, data);
    },
    openServiceWin() {
      //重置输入框的值
      this.serviceTypeValue = "";
      this.servicePersonValue =
        this.userName || JSON.parse(localStorage.getItem("user")).username;
      this.serviceNameValue = "";
      this.serviceCreateTime = this.getCurrentTime();
      this.serviceDescriptionTextarea = "";
      this.serviceFilePath = "";
      this.serviceFileList = [];
      this.serviceEquipmentId = this.deviceInfoData
        ? this.deviceInfoData.equipment_id
        : "";
      this.serviceCustomerId = this.deviceInfoData
        ? this.deviceInfoData.customer_id
        : "";
      this.getCustomerList();
      this.getEquipmentList();
      // 打开窗口
      this.showMd("add");
    },
    getCustomerList() {
      let self = this;
      customerApi.get_menu_list(
        function(data) {
          if (data.code == 200) {
            self.serviceCustomerData = data.result.data;
          }
        },
        { is_all: 1 }
      );
    },
    getEquipmentList() {
      let self = this;
      deviceApi.get_menu_list(
        function(data) {
          if (data.code == 200) {
            self.serviceEquipmentData = data.result.data;
          }
        },
        { is_all: 1 }
      );
    },
    addService() {
      if (this.serviceNameValue == "") {
        this.$alert(
          this.$t("deviceLang.service_name_not_null"),
          this.$t("deviceLang.processing_records"),
          {
            confirmButtonText: this.$t("el.messagebox.confirm")
          }
        );
        return false;
      }
    //开始时间和结束时间判断
      if(new Date( this.serviceCreateTime ) > new Date()){
          this.$confirm(this.$t('common.exceed_current_time'), this.$t('common.tip'), {
          confirmButtonText: this.$t('el.messagebox.confirm'),
          cancelButtonText: this.$t('el.messagebox.cancel'),
          type: 'warning'
        });
        this.md['loading'] = false;
        return;
      }
      let data = {
        service_name: this.serviceNameValue,
        date: this.serviceCreateTime,
        category: this.serviceTypeValue,
        staff: this.servicePersonValue,
        description: this.serviceDescriptionTextarea,
        attachment: this.serviceFilePath,
        customer_id: this.serviceCustomerId,
        equipment_id: this.serviceEquipmentId,
        reference: "equipment:" + this.serviceEquipmentId,
        language: this.$i18n.locale == "en" ? "en" : "zh_cn"
      };
      let self = this;
      serviceApi.add(function(data) {
        if (data.code == 200) {
          self.closeMd("add");
          self.serviceNameValue = "";
          self.serviceCreateTime = "";
          self.serviceTypeValue = "";
          self.servicePersonValue = "";
          self.serviceDescriptionTextarea = "";
          self.$message(data.msg, "success");
        }
      }, data);
    },
    uploadService(item) {
      let formData = new FormData();
      formData.append("upload_file", item.file);
      formData.append("type", "service");
      // console.log(item.file);
      let self = this;
      deviceApi.upload(function(data) {
        if (data.code == 200) {
          self.serviceFilePath = data.result.path;
          let type = item.file.type.split("/");
          if (type[0] != "image") {
            self.serviceFileList.push({
              name: item.file.name,
              url: "./modules/pro/static/images/public/uploadfile.png"
            });
          }
        }
      }, formData);
    },
    serviceHandleRemove() {
      this.serviceFileList = [];
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
    },
    editInfoMap() {
      let self = this;
      var map = new BMap.Map("editInfoMap");
      // 初始化地图,设置城市和地图级别。
      // map.centerAndZoom("北京",12);
      // 启动鼠标滚轮操作
      map.enableScrollWheelZoom();
      var geocoder = new BMap.Geocoder();
      if (self.editInfoGis && self.editInfoGis != "") {
        let gis = self.editInfoGis.split(",");
        let point = new BMap.Point(gis[1], gis[0]);
        map.centerAndZoom(point, 18);
        map.clearOverlays(); //清除地图上所有覆盖物
        map.addOverlay(new BMap.Marker(point)); //添加标注
        geocoder.getLocation(point, function(res) {
          self.editInfoGisAddress = res.address;
        });
      } else {
        map.centerAndZoom("北京", 12);
      }
      // 地图点击事件
      map.addEventListener("click", function(e) {
        map.clearOverlays(); //清除地图上所有覆盖物
        map.centerAndZoom(e.point, 18);
        map.addOverlay(new BMap.Marker(e.point)); //添加标注
        geocoder.getLocation(e.point, function(res) {
          self.editInfoGisAddress = res.address;
          self.editInfoGis = res.point.lat + "," + res.point.lng;
        });
        // console.log(e.point.lng + ", " + e.point.lat);
      });
      // 建立一个自动完成的对象
      var ac = new BMap.Autocomplete({
        input: "editInfoMapSearch",
        location: map
      });
      //鼠标放在下拉列表上的事件
      ac.addEventListener("onhighlight", function(e) {
        // console.log(e.fromitem.value)
      });
      var myValue;
      //鼠标点击下拉列表后的事件
      ac.addEventListener("onconfirm", function(e) {
        var _value = e.item.value;
        myValue =
          _value.province +
          _value.city +
          _value.district +
          _value.street +
          _value.business;
        setPlace();
      });
      function setPlace() {
        map.clearOverlays(); //清除地图上所有覆盖物
        var local = new BMap.LocalSearch(map, {
          //智能搜索
          onSearchComplete: myFun
        });
        local.search(myValue);
        function myFun() {
          var pp = local.getResults().getPoi(0).point; //获取第一个智能搜索的结果
          map.centerAndZoom(pp, 18);
          map.addOverlay(new BMap.Marker(pp)); //添加标注
          self.editInfoGis = pp.lat + "," + pp.lng;
        }
      }
    }
  },
  watch: {
    equipmentId: ["getEquipmentInfo"]
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/device/detail/info.scss";
</style>
