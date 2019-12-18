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
  <!-- 设备历程 start -->
  <div class="course-content-wrap flex-column">
    <div class="content flex-column">
      <div class="button-tool flex-wrap">
        <span class="txt">{{$t('stationLang.period')}}</span>
        <div class="block">
          <el-date-picker
            class="mix-input mix-input-32"
            v-model="startDateValue"
            type="datetime"
            value-format="yyyy-MM-dd HH:mm:ss"
            :placeholder="$t('el.datepicker.startTime')"
          ></el-date-picker>
        </div>
        <div class="block">
          <el-date-picker
            class="mix-input mix-input-32 mix-no-right-border-radius"
            v-model="endDateValue"
            type="datetime"
            value-format="yyyy-MM-dd HH:mm:ss"
            :placeholder="$t('el.datepicker.endTime')"
          ></el-date-picker>
        </div>
        <div class="search-btn-wrap" @click="getEquipmentHistoryList">
          <i class="mix-search-white-icon"></i>
        </div>
        <div class="refresh-wrap" @click="resetEquipmentHistoryList">
          <i class="mix-refresh-icon"></i>
        </div>
      </div>
      <div class="history-list flex-column">
        <div class="list-header">
          <table>
            <colgroup>
              <col width="170">
              <col width="100">
              <col width="150">
              <col width="*">
              <col width="120">
              <col v-if="scrollWidth" :width="scrollWidth">
            </colgroup>
            <thead>
              <tr>
                <th>{{$t('stationLang.time')}}</th>
                <th>{{$t('stationLang.type')}}</th>
                <th>{{$t('stationLang.name')}}</th>
                <th>{{$t('stationLang.description')}}</th>
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
              <col width="100">
              <col width="150">
              <col width="*">
              <col width="120">
            </colgroup>
            <tbody v-if="equipmentHistoryListData!=null">
              <tr v-for="(item,index) in equipmentHistoryListData" :key="index" :class="{'active':index==equipmentHistoryListItemCode}">
                <td>{{item.created}}</td>
                <td v-if="item.type=='service'">{{$t('stationLang.service')}}</td>
                <td v-else-if="item.type=='fault'">{{$t('stationLang.fault')}}</td>
                <td v-else-if="item.type=='alert'">{{$t('stationLang.alarm')}}</td>
                <td v-else-if="item.type=='event'">{{$t('stationLang.event')}}</td>
                <td v-else-if="item.type=='activity'">{{$t('stationLang.activity')}}</td>
                <td v-else></td>
                <td>{{item.name}}</td>
                <td>{{getDescriptionLabel(item.description)}}</td>
                <td>
                  <a @click="equipmentHistoryInfo(item.id,item.type)">{{$t('stationLang.view')}}</a>
                </td>
              </tr>
            </tbody>
						<tbody v-if="equipmentHistoryListData==null">
							<tr>
                <td colspan="5">
                  <div class="nodata">{{$t('common.no_data')}}</div>
                </td>
              </tr>
						</tbody>
          </table>
        </div>
      </div>
      <div class="page-btn-wrap flex-wrap">
        <div class="block">
          <el-pagination
            background
            class="mix-pagination"
            @size-change="equipmentHistoryHandleSizeChange"
            @current-change="getEquipmentHistoryList"
            :current-page.sync="equipmentHistoryCurrentPage"
            :page-sizes="[15,20,30,40,50]"
            :page-size="equipmentHistoryCurrentPageSize"
            layout="prev, pager, next, sizes, jumper"
            :total="equipmentHistoryListTotal"
          ></el-pagination>
        </div>
      </div>
    </div>
    <div class="md-mask" :class="{ 'active': md.mask}"></div>
    <div class="md-loading" :class="{ 'active': md.loading}">
      <i class="el-icon-loading md-loading-icon"></i>
    </div>
    <!-- 设备历程查看 start -->
    <div class="md-modal-container">
      <div class="md-modal md-effect-1 view-course-modal" :class="{ 'md-show': md.view}">
        <div class="md-content">
          <!--头部-->
          <div class="titleBox flex-wrap flex-center">
            <div class="title">{{$t('stationLang.view_course_title')}}</div>
            <div class="iconWrap" @click="closeMd('view')">
              <i class="close"></i>
            </div>
          </div>
          <!--内容-->
          <div class="contBox" v-if="equipmentHistoryInfoData!=null">
            <div class="view-info-wrap" v-if="equipmentHistoryInfoData.alert_id">
              <div class="row-wrap flex-wrap">
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.equipment_id')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.equipment_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.alert_id')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.alert_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.alert_name')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.alert_name}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.created')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.created}}</div>
                </div>
              </div>
              <div class="row-wrap flex-wrap">
                <div class="colAll">
                  <div class="title">{{$t('stationLang.alert_description')}}</div>
                  <div class="value">{{getDescriptionLabel(equipmentHistoryInfoData.description)}}</div>
                </div>
              </div>
            </div>
            <div class="view-info-wrap" v-if="equipmentHistoryInfoData.event_id">
              <div class="row-wrap flex-wrap">
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.equipment_id')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.equipment_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.event_id')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.event_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.event_name')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.event_name}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.created')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.created}}</div>
                </div>
              </div>
              <div class="row-wrap flex-wrap">
                <div class="colAll">
                  <div class="title">{{$t('stationLang.event_description')}}</div>
                  <div class="value">{{getDescriptionLabel(equipmentHistoryInfoData.description)}}</div>
                </div>
              </div>
            </div>
            <div class="view-info-wrap" v-if="equipmentHistoryInfoData.fault_id">
              <div class="row-wrap flex-wrap">
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.equipment_id')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.equipment_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.fault_id')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.fault_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.fault_name')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.fault_name}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.created')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.created}}</div>
                </div>
              </div>
              <div class="row-wrap flex-wrap">
                <div class="colAll">
                  <div class="title">{{$t('stationLang.fault_description')}}</div>
                  <div class="value">{{getDescriptionLabel(equipmentHistoryInfoData.description)}}</div>
                </div>
              </div>
            </div>
            <div class="view-info-wrap" v-if="equipmentHistoryInfoData.activity_id">
              <div class="row-wrap flex-wrap">
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.equipment_id')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.equipment_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.activity_id')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.activity_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.customer_id')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.customer_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.activity_name')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.activity_name}}</div>
                </div>
              </div>
              <div class="row-wrap flex-wrap">
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.activity_category')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.category}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.activity_staff')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.staff}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.activity_date')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.date}}</div>
                </div>
              </div>
              <div class="row-wrap flex-wrap">
                <div class="colAll">
                  <div class="title">{{$t('stationLang.activity_description')}}</div>
                  <div class="value">{{getDescriptionLabel(equipmentHistoryInfoData.description)}}</div>
                </div>
              </div>
              <div class="row-wrap flex-wrap">
                <div class="colAll">
                  <div class="title">{{$t('stationLang.activity_annex')}}</div>
                  <div class="fileList">
                    <a
                      v-if="equipmentHistoryInfoData.attachment"
                      @click="downloadFile(equipmentHistoryInfoData.attachment)"
                    >{{getFileName(equipmentHistoryInfoData.attachment)}}</a>
                    <!-- <span class="ic_download download" v-if="equipmentHistoryInfoData.attachment" @click="downloadFile(equipmentHistoryInfoData.attachment)">{{$t('stationLang.download')}}</span> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="view-info-wrap" v-if="equipmentHistoryInfoData.service_id">
              <div class="row-wrap flex-wrap">
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.equipment_id')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.equipment_id}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.service_name')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.service_name}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.service_date')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.date}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.service_category')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.category}}</div>
                </div>
              </div>
              <div class="row-wrap flex-wrap">
                <div class="col-wrap">
                  <div class="title">{{$t('stationLang.service_staff')}}</div>
                  <div class="value">{{equipmentHistoryInfoData.staff}}</div>
                </div>
                <div class="col-wrap">
                  <div class="title"></div>
                  <div class="value"></div>
                </div>
                <div class="col-wrap">
                  <div class="title"></div>
                  <div class="value"></div>
                </div>
              </div>
              <div class="row-wrap flex-wrap">
                <div class="colAll">
                  <div class="title">{{$t('stationLang.service_description')}}</div>
                  <div class="value">{{getDescriptionLabel(equipmentHistoryInfoData.description)}}</div>
                </div>
              </div>
              <div class="row-wrap flex-wrap">
                <div class="colAll">
                  <div class="title">{{$t('stationLang.service_annex')}}</div>
                  <div class="fileList">
                    <a
                      v-if="equipmentHistoryInfoData.attachment"
                      @click="downloadFile(equipmentHistoryInfoData.attachment)"
                    >{{getFileName(equipmentHistoryInfoData.attachment)}}</a>
                    <!-- <span class="ic_download download" v-if="equipmentHistoryInfoData.attachment" @click="downloadFile(equipmentHistoryInfoData.attachment)">{{$t('stationLang.download')}}</span> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- 按钮 -->
          <div class="buttomBox flex-wrap flex-center">
            <!-- <input type="button"  class="btn_cancel" value="取消"/> -->
            <input
              type="button"
              class="btn_determine"
              :value="$t('common.btn_close')"
              @click="closeMd('view')"
            >
          </div>
        </div>
      </div>
    </div>
    <!-- 设备历程查看 end -->
  </div>
  <!-- 设备历程 end -->
</template>

<script>
import deviceApi from "@/assets/js/fetch/device";
import stationApi from "@/assets/js/fetch/station";

export default {
  name: "status",
  props: {
    groupId: Number
  },
  data() {
    return {
      msg: "Welcome to Your Vue.js App",
      // 设备历程
      startDateValue: "",
      endDateValue: "",
      equipmentHistoryInfoData: null,
      equipmentHistoryListData: null,
      equipmentHistoryListItemCode: 0,
      equipmentHistoryListTotal: 0,
      equipmentHistoryCurrentPage: 1,
      equipmentHistoryCurrentPageSize: 15,
      scrollWidth: 0,
      // 弹窗控制
      md: {
        mask: false,
        loading: false,
        view: false
      }
    };
  },
  mounted() {
    // console.log(this);
    this.setEquipmentHistoryTime();
    this.getEquipmentHistoryList(this.groupId);
  },
  updated() {
    let outer = document.querySelector("div.list-body");
    let inner = document.querySelector("div.list-body>table");
    this.scrollWidth = outer.offsetWidth - inner.offsetWidth;
  },
  methods: {
    // 设备历程 start
    getFileName(path) {
      if (path && path.indexOf("/")) {
        let tmp = path.split("/");
        return tmp[tmp.length - 1];
      }
      return "";
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
    equipmentHistoryInfo(id, type) {
      if (!id) {
        return;
      }
      // if (type == "service") {
      //   type = 1;
      // } else if (type == "fault") {
      //   type = 2;
      // } else if (type == "alert") {
      //   type = 3;
      // } else if (type == "event") {
      //   type = 4;
      // } else if (type == "activity") {
      //   type = 5;
      // }
      let self = this;
      self.md["loading"] = true;
      deviceApi.get_equipment_history_info(
        function(data) {
          if (data.code == 200) {
            self.showMd("view");
            self.equipmentHistoryInfoData = data.result;
          }
          self.md["loading"] = false;
        },
        { id: id, type: type }
      );
    },
    resetEquipmentHistoryList() {
      this.setEquipmentHistoryTime();
      this.equipmentHistoryCurrentPage = 1;
      this.equipmentHistoryCurrentPageSize = 15;
      this.getEquipmentHistoryList(this.groupId);
    },
    getEquipmentHistoryList(id) {
      if (!this.groupId) {
        return;
      }
      let self = this;
      self.md["loading"] = true;
      //开始时间和结束时间判断
      if(new Date(this.startDateValue)>new Date(this.endDateValue)){
          this.$confirm(this.$t('stationLang.start_end_time_notice'), this.$t('stationLang.tip'), {
          confirmButtonText: this.$t('el.messagebox.confirm'),
          cancelButtonText: this.$t('el.messagebox.cancel'),
          type: 'warning'
        });
        self.md['loading'] = false;
        return;
      }
      stationApi.get_process(
        function(data) {
          if (data.code == 200) {
            if (data.result.data.length == 0) {
              self.md["loading"] = false;
              return;
            }
            self.equipmentHistoryListTotal = data.result.total_records;
            self.equipmentHistoryListData = data.result.data;
          }
          self.md["loading"] = false;
        },
        {
          group_id: this.groupId,
          start_time: this.startDateValue,
          end_time: this.endDateValue,
          page_index: this.equipmentHistoryCurrentPage,
          page_size: this.equipmentHistoryCurrentPageSize
        }
      );
    },
    equipmentHistoryHandleSizeChange(val) {
      // console.log(val);
      this.equipmentHistoryCurrentPageSize = val;
      this.getEquipmentHistoryList(this.groupId);
    },
    setEquipmentHistoryTime() {
      let date = new Date();
      let year = date.getFullYear();
      let month = date.getMonth() + 1;
      let day = date.getDate();
      let h = date.getHours();
      let m = date.getMinutes();
      let s = date.getSeconds();
      this.endDateValue =
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
      date = +date - 1000 * 60 * 60 * 24 * 6;
      date = new Date(date);
      year = date.getFullYear();
      month = date.getMonth() + 1;
      day = date.getDate();
      this.startDateValue =
        year + "-" + formatStr(month) + "-" + formatStr(day) + " 00:00:00";
      function formatStr(str) {
        str = str < 10 ? "0" + str : str;
        return str;
      }
    },
    downloadFile(path) {
      if (path == "" || path == null) {
        return;
      }
      deviceApi.download(path);
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
    groupId: ["getEquipmentHistoryList"]
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/station/detail/course.scss";
</style>
