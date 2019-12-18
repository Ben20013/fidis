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
            <tbody v-if="eventData!=null">
              <tr v-for="(item,index) in eventData" :key="index">
                <td>{{item.created}}</td>
                <td>{{item.equipment_name}}</td>
                <td>{{item.code}}</td>
                <td>{{item.event_name}}</td>
                <td>{{getDescriptionLabel(item.description)}}</td>
                <td>
                  <a @click="getEventMosaicDetailInfo(item.event_id)">{{$t('stationLang.view')}}</a>
                </td>
              </tr>
            </tbody>
						<tbody v-if="eventData==null">
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
        <div class="block">
          <el-pagination
            background
            class="mix-pagination"
            @size-change="eventHandleSizeChange"
            @current-change="eventHandleCurrentChange"
            :current-page.sync="eventCurrentPage"
            :page-sizes="[10,20,30,40,50]"
            :page-size="eventCurrentPageSize"
            layout="prev, pager, next, sizes, jumper"
            :total="eventTotal"
          ></el-pagination>
        </div>
      </div>
    </div>
    <div class="md-mask" :class="{ 'active': md.mask}"></div>
    <div class="md-loading" :class="{ 'active': md.loading}">
      <i class="el-icon-loading md-loading-icon"></i>
    </div>
    <!-- 设备告警-事件查看 start -->
    <div class="md-modal-container">
      <div class="md-modal md-effect-1 view-equipment-efa" :class="{ 'md-show': md.viewEvent}">
        <div class="md-content">
          <!--头部-->
          <div class="titleBox flex-wrap flex-center">
            <div class="title">{{$t('stationLang.view_event_title')}}</div>
            <div class="iconWrap" @click="closeMd('viewEvent')">
              <i class="close"></i>
            </div>
          </div>
          <!--内容-->
          <div class="contBox">
            <div class="view-info-wrap" v-if="eventInfoData!=null">
              <div class="row-wrap flex-wrap">
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.event_name')}}</div>
                  <div class="value">{{eventInfoData.event_name}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.event_id')}}</div>
                  <div class="value">{{eventInfoData.event_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.equipment_id')}}</div>
                  <div class="value">{{eventInfoData.equipment_id}}</div>
                </div>
              </div>
              <div class="row-wrap flex-wrap">
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.aprus_id')}}</div>
                  <div class="value">{{eventInfoData.aprus_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.created')}}</div>
                  <div class="value">{{eventInfoData.created}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.code')}}</div>
                  <div class="value">{{eventInfoData.code}}</div>
                </div>
              </div>
              <div class="row-wrap flex-wrap">
                <div class="colAll">
                  <div class="title">{{$t('stationLang.event_description')}}</div>
                  <div class="value">{{getDescriptionLabel(eventInfoData.description)}}</div>
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
import stationApi from "@/assets/js/fetch/station";

export default {
  name: "status",
  props: {
    groupId: Number
  },
  data() {
    return {
      msg: "Welcome to Your Vue.js App",
      // 设备 事件，故障，报警
      eventData: null,
      eventTotal: 0,
      eventInfoData: null,
      eventCurrentPage: 1,
      eventCurrentPageSize: 10,
      scrollWidth: 0,
      // 弹窗控制
      md: {
        mask: false,
        loading: false,
        viewEvent: false
      }
    };
  },
  mounted() {
    // console.log(this);
    this.getEventMosaicList(this.groupId);
  },
  updated() {
    let outer = document.querySelector("div.list-body");
    let inner = document.querySelector("div.list-body>table");
    this.scrollWidth = outer.offsetWidth - inner.offsetWidth;
  },
  methods: {
    // 事件
    getEventMosaicList(id) {
      if (!this.groupId) {
        return;
      }
      let self = this;
      self.md["loading"] = true;
      stationApi.get_event(
        function(data) {
          if (data.code == 200) {
            if (data.result.data.length != 0) {
              self.eventData = data.result.data;
              self.eventTotal = data.result.total_records;
            }
            // console.log(data);
          }
          self.md["loading"] = false;
        },
        {
          group_id: this.groupId,
          page_index: this.eventCurrentPage,
          page_size: this.eventCurrentPageSize
        }
      );
    },
    getEventMosaicDetailInfo(eventId) {
      let self = this;
      eventApi.get_event_detail(
        function(data) {
          if (data.code == "200") {
            self.showMd("viewEvent");
            self.eventInfoData = data.result;
            // console.log(data.result);
          }
        },
        { event_id: eventId }
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
    eventHandleSizeChange(val) {
      this.eventCurrentPageSize = val;
      this.getEventMosaicList(this.groupId);
    },
    eventHandleCurrentChange(val) {
      this.getEventMosaicList(this.groupId);
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
    groupId: ["getEventMosaicList"]
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/station/detail/efa.scss";
</style>
