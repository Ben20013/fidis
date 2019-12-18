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
              <col width="170">
              <col width="100">
              <col width="170">
              <col width="*">
              <col width="120">
              <col v-if="scrollWidth" :width="scrollWidth">
            </colgroup>
            <thead>
              <tr>
                <th>{{$t('stationLang.date_time')}}</th>
                <th>{{$t('stationLang.equipment_name')}}</th>
                <th>{{$t('stationLang.code')}}</th>
                <th>{{$t('stationLang.summary')}}</th>
                <th>{{$t('stationLang.detail_description')}}</th>
                <th>{{$t('stationLang.action')}}</th>
                <th v-if="scrollWidth" :style="{'width':scrollWidth+'px','padding':0}"></th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="list-body">
          <table>
            <colgroup>
              <col width="170">
              <col width="170">
              <col width="100">
              <col width="170">
              <col width="*">
              <col width="120">
            </colgroup>
            <tbody>
              <tr v-for="(item,index) in alarmData" :key="index">
                <td>{{item.created}}</td>
                <td>{{item.equipment_name}}</td>
                <td>{{item.code}}</td>
                <td>{{item.alert_name}}</td>
                <td>{{getDescriptionLabel(item.description)}}</td>
                <td>
                  <a @click="getAlarmMosaicDetailInfo(item.alert_id)">{{$t('stationLang.view')}}</a>
                </td>
              </tr>
              <tr v-if="alarmData==null">
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
            :page-size="alarmCurrentPageSize"
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
      <div class="md-modal md-effect-1 view-equipment-efa" :class="{ 'md-show': md.viewAlarm}">
        <div class="md-content">
          <!--头部-->
          <div class="titleBox flex-wrap flex-center">
            <div class="title">{{$t('stationLang.view_modal_title')}}</div>
            <div class="iconWrap" @click="closeMd('viewAlarm')">
              <i class="close"></i>
            </div>
          </div>
          <!--内容-->
          <div class="contBox">
            <div class="view-info-wrap" v-if="alarmInfoData!=null">
              <div class="row-wrap flex-wrap">
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.alert_name')}}</div>
                  <div class="value">{{alarmInfoData.alert_name}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.alert_id')}}</div>
                  <div class="value">{{alarmInfoData.alert_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.equipment_id')}}</div>
                  <div class="value">{{alarmInfoData.equipment_id}}</div>
                </div>
              </div>
              <div class="row-wrap flex-wrap">
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.aprus_id')}}</div>
                  <div class="value">{{alarmInfoData.aprus_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.created')}}</div>
                  <div class="value">{{alarmInfoData.created}}</div>
                </div>
              </div>
              <div class="row-wrap flex-wrap">
                <div class="colAll">
                  <div class="title">{{$t('stationLang.alert_description')}}</div>
                  <div class="value">{{getDescriptionLabel(alarmInfoData.description)}}</div>
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
  </div>
  <!-- 事件 end -->
</template>

<script>
import stationApi from "@/assets/js/fetch/station";
import alarmApi from "@/assets/js/fetch/alarm";
import faultApi from "@/assets/js/fetch/fault";

export default {
  name: "status",
  props: {
    groupId: Number
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
    this.getAlarmMosaicList(this.groupId);
  },
  updated() {
    let outer = document.querySelector("div.list-body");
    let inner = document.querySelector("div.list-body>table");
    this.scrollWidth = outer.offsetWidth - inner.offsetWidth;
  },
  methods: {
    // 报警
    getAlarmMosaicList(id) {
      if (!this.groupId) {
        return;
      }
      let self = this;
      self.md["loading"] = true;
      stationApi.get_alert_mosaic(
        function(data) {
          if (data.code == 200) {
            if (data.result.data.length != 0) {
              self.alarmData = data.result.data;
              self.alarmTotal = data.result.total_records;
            }
          }
          self.md["loading"] = false;
        },
        {
          group_id: this.groupId,
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
    getDescriptionLabel(desc) {
      let result = "";
      try {
        let labelObj = JSON.parse(desc);
        result =
          this.$i18n.locale == "en" ? labelObj.Label_En : labelObj.Label_Cn;
      } catch (error) {
        result = desc;
      }
      return result;
    },
    alarmHandleSizeChange(val) {
      this.alarmCurrentPageSize = val;
      this.getAlarmMosaicList(this.groupId);
    },
    alarmHandleCurrentChange(val) {
      this.getAlarmMosaicList(this.groupId);
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
    groupId: ["getAlarmMosaicList"]
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/station/detail/efa.scss";
</style>
