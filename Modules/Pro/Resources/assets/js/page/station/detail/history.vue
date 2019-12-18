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
  <!-- 历史记录 start -->
  <div class="history-content-wrap flex-column">
    <div class="content flex-column">
      <div class="button-tool flex-wrap">
        <div class="button-tool__left">
          <div class="tool__content flex-wrap" v-show="!isExportView">
            <span class="txt">{{$t('stationLang.period')}}</span>
            <div class="block">
              <el-date-picker
                class="mix-input mix-input-32"
                v-model="historyRecordStartDateValue"
                type="datetime"
                value-format="yyyy-MM-dd HH:mm:ss"
                default-time="00:00:00"
                :picker-options="{
                  disabledDate(time) {
                    return time.getTime() > Date.now();
                  }
                }"
                :placeholder="$t('el.datepicker.startTime')">
              </el-date-picker>
            </div>
            <div class="block">
              <el-date-picker
                class="mix-input mix-input-32 mix-no-right-border-radius"
                v-model="historyRecordEndDateValue"
                type="datetime"
                value-format="yyyy-MM-dd HH:mm:ss"
                default-time="23:59:59"
                :picker-options="{
                  disabledDate(time) {
                    return time.getTime() > Date.now() || time.getTime() < new Date(historyRecordStartDateValue);
                  }
                }"
                :placeholder="$t('el.datepicker.endTime')">
              </el-date-picker>
            </div>
            <div class="search-btn-wrap" @click="searchHistoryList">
              <i class="mix-search-white-icon"></i>
            </div>
            <div class="select-header-btn" @click="openSettingHeaderWin">
              <span>{{$t('stationLang.select_params')}}</span>
            </div>
            <div class="refresh-wrap" @click="refreshHistoryList">
              <i class="mix-refresh-icon"></i>
            </div>
            <div class="line-wrap" @click.stop="openCurveWin">
              <i class="mix-line-icon"></i>
            </div>
          </div>
          <div class="tool__content flex-wrap" v-show="isExportView">
            <span class="txt">{{$t('stationLang.period')}}</span>
            <div class="block">
              <el-date-picker
                v-model="exportDateTimeRange"
                type="datetimerange"
                size="small"
                value-format="yyyy-MM-dd HH:mm:ss"
                :picker-options="{
                  disabledDate(time) {
                    return time.getTime() > Date.now();
                  }
                }"
                :default-value="new Date(new Date().setMonth(new Date().getMonth() -1))"
                range-separator="-"
                :start-placeholder="$t('el.datepicker.startTime')"
                :end-placeholder="$t('el.datepicker.endTime')">
              </el-date-picker>
            </div>
            <div class="tool__interval flex-wrap" :class="{'active': toolIntervalFocus}">
              <div class="tool__interval_txt">{{$t('stationLang.interval')}}</div>
              <div class="tool__interval_input-wrap">
                <input type="text" class="tool__interval_input" @focus="toolIntervalFocus=true" @blur="toolIntervalFocus=false" v-model="exportTimeInterval" />
              </div>
            </div>
            <div class="select-header-btn" @click="openSettingHeaderWin">
              <span>{{$t('stationLang.select_params')}}</span>
            </div>
            <div class="refresh-wrap" @click="getStateList">
              <i class="mix-refresh-icon"></i>
            </div>
            <div class="export-wrap" @click="exportStateData">
              <i class="mix-export-icon"></i>
            </div>
          </div>
        </div>
        <div class="button-tool__right flex-wrap">
          <div class="tool__tab-btn left" :class="{'active': !isExportView}" @click="handelChangeView(false)">{{$t('stationLang.historical_data')}}</div>
          <div class="tool__tab-btn right" :class="{'active': isExportView}" @click="handelChangeView(true)">{{$t('stationLang.export_data')}}</div>
        </div>
      </div>
      <div class="record-list" v-if="!isExportView">
        <div class="table-wrap" v-if="recordListTitle.length>0">
          <el-table
          :data="recordListTableData"
          class="mix-el-table"
          stripe
          style="width: 100%"
          height="100%">
            <el-table-column v-for="(item,index) in recordListTitle" :key="index" :prop="item.prop" :label="item.label" :fixed="index==0" :width="index==0?'155':'*'" min-width="120"></el-table-column>
          </el-table>
        </div>
      </div>
      <div class="record-list" v-if="isExportView">
        <div class="table-wrap">
          <el-table 
          :data="exportTaskList"
          class="mix-el-table"
          stripe
          style="width:100%"
          height="100%">
            <el-table-column
              prop="task_start"
              :label="$t('stationLang.task_start')"
              width="170">
            </el-table-column>
            <el-table-column
              prop="task_id"
              :label="$t('stationLang.task_id')"
              width="290">
            </el-table-column>
            <el-table-column
              prop="filename"
              :label="$t('stationLang.filename')"
              width="*">
            </el-table-column>
            <el-table-column
              prop="task_status"
              :label="$t('stationLang.task_status')"
              width="150">
            </el-table-column>
            <el-table-column
              :label="$t('stationLang.action')"
              width="120">
              <template slot-scope="scope">
                <div class="export-action" :class="{'disabled': scope.row.task_status !== 'SUCCESS'}" @click="downloadStateFile(scope.row)"><i class="mix-download-gray-icon"></i></div>
                <div class="export-action" :class="{'disabled': scope.row.task_status === 'PENDING' || scope.row.task_status === 'STARTED'}" @click="deleteStateFile(scope.row)"><i class="mix-delete-icon"></i></div>
              </template>
            </el-table-column>
          </el-table>
        </div>
      </div>
    </div>
    <div class="page-btn flex-wrap" v-if="!isExportView">
      <div class="block" v-show="recordListTableData.length">
        <el-pagination background class="mix-pagination" @size-change="historyRecordHandleSizeChange" @current-change="searchHistoryList" :current-page.sync="historyRecordCurrentPage" :page-sizes="[15,20,30,40,50]" :page-size="historyRecordCurrentPageSize" layout="prev, pager, next, sizes, jumper" :total="historyRecordTotal">
        </el-pagination>
      </div>
    </div>
    <div class="page-btn flex-wrap" v-if="isExportView">
      <div class="block" v-show="exportTaskList.length">
        <el-pagination background class="mix-pagination" @size-change="exportTaskHandleSizeChange" @current-change="getStateList" :current-page.sync="exportRecordCurrentPage" :page-sizes="[15,20,30,40,50]" :page-size="exportRecordCurrentPageSize" layout="prev, pager, next, sizes, jumper" :total="exportRecordTotal">
        </el-pagination>
      </div>
    </div>
    <!--弹框-->
    <div class="md-mask" :class="{ 'active': md.mask}"></div>
    <div class="md-loading" :class="{ 'active': md.loading}"><i class="el-icon-loading md-loading-icon"></i></div>
    <!-- 设置表头弹出框 start -->
    <div class="md-modal-container">
      <div class="md-modal md-effect-1 setting-table-header" :class="{ 'md-show': md.header}">
        <div class="md-content">
          <!--头部-->
          <div class="titleBox flex-wrap flex-center">
            <div class="title">{{$t('stationLang.select_params')}}</div>
            <div class="iconWrap" @click="closeSettingHeaderWin"><i class="close"></i></div>
          </div>
          <!--内容-->
          <div class="contBox">
            <div class="params__content flex-wrap">
              <div class="params__content_left flex-column">
                <div class="params__header flex-wrap">
                  <div class="header__item">{{$t('stationLang.parameter_item')}}</div>
                  <div class="header__item flex-wrap">
                    <div class="header__item select-btn" @click="settingTableHeaderSelectAll">{{isSelectAllTitle?$t('stationLang.select_all'):$t('stationLang.cancel_select_all')}}</div>
                    <div class="params__search">
                      <input type="text" class="params__search_input" v-model="paramsSearchString">
                      <div class="params__search_icon"><i class="mix-search-icon"></i></div>
                    </div>
                  </div>
                </div>
                <div class="params__body">
                  <div class="setting-wrap flex-wrap" v-if="recordListAllTitle.length">
                    <div class="item" v-for="(item,index) in filterRecordListTitle" :key="index">
                      <div class="ck-box" :class="{'checked': recordListSelectTitle.indexOf(item[0])>=0}" @click="settingTableHeaderCkBoxClick(item[0])"></div>
                      <span>{{item[2]}}</span>
                    </div>
                  </div>
                  <div class="no-data flex-column" v-else>
                    <img src="/modules/pro/static/images/public/no-data-icon.png" alt="">
                    <span>{{$t('common.no_data')}}</span>
                  </div>
                </div>
              </div>
              <div class="params__content_right flex-column">
                <div class="program__header flex-wrap">
                  <div class="header__item">{{$t('stationLang.plan_item')}}</div>
                  <div class="header__item flex-wrap">
                    <div class="params__search">
                      <input type="text" class="params__search_input" v-model="planSearchString">
                      <div class="params__search_icon"><i class="mix-search-icon"></i></div>
                    </div>
                  </div>
                </div>
                <div class="program__body">
                  <div class="program__item flex-wrap" :class="{'active': selectedPlanIndex === index}" v-for="(item, index) in filterPlanData" :key="index">
                    <div class="item__name flex-wrap">
                      <div class="ck-box" :class="{'checked': selectedPlanIndex === index}" @click="selectPlanItem(index)"></div>
                      <div class="item__name_txt">
                        <span v-if="!item.isEdit">{{item.name}}</span>
                        <input v-else class="item__name_input" type="text" v-model="item.name" :placeholder="$t('stationLang.plan_name_tip')">
                      </div>
                    </div>
                    <div class="item__button" v-if="!item.isEdit" @click="editPlanItem(item)">
                      <i class="mix-edit-icon"></i>
                    </div>
                    <div class="item__button" v-else @click="savePlanItem(item)">
                      <i class="mix-save-icon"></i>
                    </div>
                    <div class="item__button" @click="deletePlanItem(item)">
                      <i class="mix-delete-icon"></i>
                    </div>
                  </div>
                  <div class="program__item flex-wrap">
                    <div class="item__button_add" @click="addPlanItem">
                      <i class="mix-add-gray-icon"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- 按钮 -->
          <div class="buttomBox flex-wrap flex-center">
            <!-- <input type="button"  class="btn_cancel" :value="isSelectAllTitle?$t('stationLang.select_all'):$t('stationLang.cancel_select_all')"  @click="settingTableHeaderSelectAll" style="width:90px;"/> -->
            <input type="button"  class="btn_cancel" :value="$t('common.btn_cancel')"  @click="closeSettingHeaderWin"/>
            <input type="button"  class="btn_determine" :value="$t('common.btn_determine')" @click="handelHeaderParamsConfirm"/>
          </div>
        </div>
      </div>
    </div>
    <!-- 设置表头弹出框 end -->
    <!-- 数据曲线弹出框 start -->
    <div class="md-modal-container">
      <div class="md-modal md-effect-1 dataCurvewin" :class="{ 'md-show': md.curve}">
        <div class="md-content">
          <!--头部-->
          <div class="titleBox flex-wrap flex-center">
            <div class="title">{{$t('stationLang.data_line')}}</div>
            <div class="iconWrap" @click="closeMd('curve')"><i class="close"></i></div>
          </div>
          <!--内容-->
          <div class="contBox">
            <div class="data-curve-wrap">
              <div class="top-content flex-wrap">
                <el-radio-group v-model="datacurverradio" @change="dataCurverRadioChange">
                  <el-radio :label="0">{{$t('stationLang.day')}}</el-radio>
                  <el-radio :label="1">{{$t('stationLang.week')}}</el-radio>
                  <el-radio :label="2">{{$t('stationLang.month')}}</el-radio>
                </el-radio-group>
                <div class="collect-time flex-wrap">
                  <span>{{$t('stationLang.period')}}</span>
                  <div class="block">
                    <el-date-picker
                      v-model="datacurverTimeStart"
                      type="datetime"
                      value-format="yyyy-MM-dd HH:mm:ss"
                      :picker-options="{
                        disabledDate(time) {
                          return time.getTime() > Date.now();
                        }
                      }"
                      :placeholder="$t('el.datepicker.startTime')">
                    </el-date-picker>
                  </div>
                  <div class="block">
                    <el-date-picker
                      class="mix-no-right-border-radius"
                      v-model="datacurverTimeEnd"
                      type="datetime"
                      value-format="yyyy-MM-dd HH:mm:ss"
                      :picker-options="{
                        disabledDate(time) {
                          return time.getTime() > Date.now() || time.getTime() < new Date(datacurverTimeStart);
                        }
                      }"
                      :placeholder="$t('el.datepicker.endTime')">
                    </el-date-picker>
                  </div>
                  <div class="search-btn-wrap" @click="datacurverSearch">
                    <i class="mix-search-white-icon"></i>
                  </div>
                  <!-- <div class="warn-btn" @click="showDataCurverAlarmPoint">
                    <span>{{ isShowAlarmPoint ?$t('stationLang.hide_alarm_point'):$t('stationLang.show_alarm_point') }}</span>
                  </div> -->
                  <!-- <span class="searchBtn" @click="datacurverSearch">搜索</span>
                  <span class="warnBtn" @click="showDataCurverAlarmPoint">{{ isShowAlarmPoint ?'隐藏告警点':'显示告警点' }}</span> -->
                </div>
                <div class="download-btn" @click="downDataCurverImg"></div>
              </div>
              <div class="middle-content">
                <div id="dataCurveEcharts"></div>
              </div>
              <div class="bottom-content flex-wrap">
                <div class="select-item">
                  <el-select v-model="datacurverSelectValue1"  :placeholder="$t('el.select.placeholder')" @change="datacurverSelectChange(0)">
                    <el-option
                      v-for="(item,index) in recordListAllTitle"
                      :key="index"
                      :label="item[2]"
                      :value="item[0]">
                    </el-option>
                  </el-select>
                </div>
                <div class="select-item">
                  <el-select v-model="datacurverSelectValue2" :placeholder="$t('el.select.placeholder')" @change="datacurverSelectChange(1)">
                    <el-option
                      v-for="(item,index) in recordListAllTitle"
                      :key="index"
                      :label="item[2]"
                      :value="item[0]">
                    </el-option>
                  </el-select>
                </div>
                <div class="select-item">
                  <el-select v-model="datacurverSelectValue3" :placeholder="$t('el.select.placeholder')" @change="datacurverSelectChange(2)">
                    <el-option
                      v-for="(item,index) in recordListAllTitle"
                      :key="index"
                      :label="item[2]"
                      :value="item[0]">
                    </el-option>
                  </el-select>
                </div>
                <div class="select-item">
                  <el-select v-model="datacurverSelectValue4" :placeholder="$t('el.select.placeholder')" @change="datacurverSelectChange(3)">
                    <el-option
                      v-for="(item,index) in recordListAllTitle"
                      :key="index"
                      :label="item[2]"
                      :value="item[0]">
                    </el-option>
                  </el-select>
                </div>
                <div class="select-item">
                  <el-select v-model="datacurverSelectValue5" :placeholder="$t('el.select.placeholder')" @change="datacurverSelectChange(4)">
                    <el-option
                      v-for="(item,index) in recordListAllTitle"
                      :key="index"
                      :label="item[2]"
                      :value="item[0]">
                    </el-option>
                  </el-select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- 数据曲线弹出框 end -->
  </div>
  <!-- 历史记录 end -->
</template>

<script>
import deviceApi from '@/assets/js/fetch/device';

export default {
  name: 'history',
  props:{
    mainEquipmentId:Number,
  },
  data () {
    return {
      msg: 'Welcome to Your Vue.js App',
      // 历史记录
      isShowAlarmPoint:false,
      datacurverradio:0,
      datacurverTimeStart:'',
      datacurverTimeEnd:'',
      datacurverSelectOptions:[],
      datacurverSelectValue1:'',
      datacurverSelectValue2:'',
      datacurverSelectValue3:'',
      datacurverSelectValue4:'',
      datacurverSelectValue5:'',
      datacurverSelectValueArr:['','','','',''],
      isSelectAllTitle:true,
      recordListAllTitle:[],
      recordListSelectTitle:[],
      recordListSelectTitleCache:[],
      recordListTitle:[],
      recordListTableData:[],
      isSettingTableHeader:false,
      historyRecordTotal:0,
      historyRecordCurrentPage:1,
      historyRecordCurrentPageSize:15,
      historyRecordStartDateValue:'',//new Date(new Date(new Date().toLocaleDateString()).getTime())
      historyRecordEndDateValue:'',
      oldStartDateValue:'',
      oldEndDateValue:'',
      dataCurveTime:{
        inter:0,
        def:[],
        ori:[],
        flag:[0, 1, 1, 1, 1]
      },
      // 弹窗控制
      md:{
      	mask:false,
        loading:false,
      	header:false,
      	curve:false,
      },
      planData:[],
      selectedPlanIndex: -1,
      isExportView: false,
      exportDateTimeRange: [],
      exportTimeInterval: '',
      toolIntervalFocus: false,
      exportRecordTotal:0,
      exportRecordCurrentPage:1,
      exportRecordCurrentPageSize:15,
      exportTaskList: [],
      paramsSearchString: '',
      planSearchString: '',
    }
  },
  mounted(){
    // console.log(this);
    this.setHistoryRecordTime();
  },
  computed: {
    filterRecordListTitle(){
      let list = this.recordListAllTitle
      let search_str = this.paramsSearchString.trim()
      if (search_str != '') {
        return list.filter(function (item) {
          return item[2].indexOf(search_str) != -1
        });;
      }
      return list
    },
    filterPlanData(){
      let list = this.planData
      let search_str = this.planSearchString.trim()
      if (search_str != '') {
        return list.filter(function (item) {
          return item.name.indexOf(search_str) != -1
        });;
      }
      return list
    },
  },
  methods:{
    recordListTitleList(){},
    handelChangeView(flag) {
      if (this.isExportView == flag) {
        return
      }
      this.isExportView = !this.isExportView
      if (this.isExportView) {
        this.getStateList()
      } else {
        if (this.recordListAllTitle.length) {
          this.getRecordListData()
        }
      }
    },
    getStateList() {
      deviceApi.get_state_list(data => {
        if (data.code == 200) {
          this.exportTaskList = data.result.data
          this.exportRecordTotal = data.result.total_records
        } else {
          this.$message.error(data.msg)
        }
      }, {'equipment_id':this.mainEquipmentId,'page_size':this.exportRecordCurrentPageSize,'page_index':this.exportRecordCurrentPage})
    },
    exportStateData() {
      if (this.exportDateTimeRange.length < 2) {
        this.$message.error(this.$t('stationLang.select_time_period'))
        return
      }
      if (this.recordListSelectTitle.length == 0) {
        this.$message.error(this.$t('stationLang.parameter_cannot_be_empty'))
        return;
      }
      deviceApi.export_state_data(data => {
        if (data.code == 200) {
          let state_id = data.result.state
          this.getStateList()
          this.getStateStatus(state_id)
        } else {
          this.$message.error(data.msg)
        }
      }, {'equipment_id': this.mainEquipmentId,'start_time': this.exportDateTimeRange[0],'end_time': this.exportDateTimeRange[1], 'resample': this.exportTimeInterval,'keys': JSON.stringify(this.recordListSelectTitle)})
    },
    getStateStatus(state_id) {
      deviceApi.get_state_status(data => {
        if (data.code == 200) {
          this.updateStateList(state_id, data.result.state)
          if (data.result.state !== 'SUCCESS' && data.result.state !== 'FAILURE') {
            setTimeout(() => {
              this.getStateStatus(state_id)
            }, 3000)
          } else {
            this.getStateList()
          }
        } else {
          this.$message.error(data.msg)
        }
      }, {'state_id': state_id})
    },
    downloadStateFile(task) {
      if (task.task_status !== 'SUCCESS') {
        return
      }
      deviceApi.download_state_file(task)
    },
    deleteStateFile(task) {
      if (task.task_status === 'PENDING' || task.task_status === 'STARTED') {
        return
      }
      this.$confirm(this.$t('stationLang.continue'), this.$t('stationLang.tip'), {
        confirmButtonText: this.$t('el.messagebox.confirm'),
        cancelButtonText: this.$t('el.messagebox.cancel'),
        type: 'warning'
      }).then(() => {
        deviceApi.delete_state_file(data => {
          if (data.code == 200) {
            this.getStateList()
          } else {
            this.$message.error(data.msg)
          }
        }, {'state_id': task.task_id})
      }).catch(() => {
        this.$message({
          type: 'info',
          message: this.$t('stationLang.cancel_delete')
        });          
      });
    },
    updateStateList(state_id, state) {
      let i = 0
      while( i < this.exportTaskList.length) {
        if (state_id == this.exportTaskList[i].task_id) {
          this.exportTaskList[i].task_status = state
          break
        }
        i++
      }
    },
    handelHeaderParamsConfirm() {
      if (this.isExportView) {
        this.closeMd('header');
        // this.isSettingTableHeader = true;
      } else {
        this.getRecordListData()
      }
    },
    selectPlanItem(index) {
      if (this.selectedPlanIndex === index) {
        this.selectedPlanIndex = -1
        this.recordListSelectTitle = []
      } else {
        let item = this.planData[index]
        this.selectedPlanIndex = index
        this.recordListSelectTitle = item.data
      }
      if(this.recordListSelectTitle.length != this.recordListAllTitle.length){
        this.isSelectAllTitle = true;
      }
    },
    addPlanItem() {
      let item = {
        name: this.$t('stationLang.new_plan') + (this.planData.length +1),
        isEdit: false,
        data: []
      }
      this.planData.push(item)
      this.addPlanItemSave(item)
    },
    deletePlanItem(item) {
      this.md['loading'] = true
      if (!item.uid) {
        let index = this.planData.indexOf(item)
        this.planData.splice(index, 1)
        this.md['loading'] = false
        return
      }
      deviceApi.delete_scheme( data => {
        if (data.code == 200) {
          this.getPlanList()
          this.$message.success(data.msg)
        } else {
          this.$message.error(data.msg)
        }
      },{'uid': item.uid})
    },
    editPlanItem(item) {
      item.isEdit = true
    },
    savePlanItem(item) {
      if (item.name.length > 10) {
        this.$message({
          message: this.$t('stationLang.plan_name_tip'),
          type: 'warning'
        });
        return
      }
      if (item.uid != undefined) {
        this.editPlanItemSave(item)
      } else {
        this.addPlanItemSave(item)
      }
    },
    addPlanItemSave(item) {
      deviceApi.add_scheme(data => {
        if (data.code == 200) {
          this.getPlanList()
        } else {
          this.$message.error(data.msg)
        }
        item.isEdit = false
      }, {'equipment_id': this.mainEquipmentId, 'name': item.name, 'setting': JSON.stringify(item.data)})
    },
    editPlanItemSave(item) {
      deviceApi.edit_scheme(data => {
        if (data.code == 200) {
          this.getPlanList()
        } else {
          this.$message.error(data.msg)
        }
        item.isEdit = false
      }, {'equipment_id': this.mainEquipmentId, 'uid': item.uid, 'name': item.name, 'setting': JSON.stringify(item.data)})
    },
    getPlanList() {
      deviceApi.get_scheme(data => {
        if (data.code == 200) {
          let result = data.result.data
          let plans = []
          for (let i = 0; i < result.length; i++) {
            const item = result[i];
            let obj = {}
            obj['name'] = item.name
            obj['data'] = JSON.parse(item.setting)
            obj['uid'] = item.uid
            obj['isEdit'] = false
            plans.push(obj)
          }
          this.planData = plans
        } else {
          this.$message.error(data.msg)
        }
      }, {'equipment_id': this.mainEquipmentId})
    },
    // 历史记录 start
    setHistoryRecordTime(){
      let date = new Date();
      let year = date.getFullYear();
      let month = date.getMonth()+1;
      let day = date.getDate();
      let h = date.getHours();
      let m = date.getMinutes();
      let s = date.getSeconds();
      this.historyRecordEndDateValue = year+'-'+formatStr(month)+'-'+formatStr(day)+' '+formatStr(h)+':'+formatStr(m)+':'+formatStr(s);
      this.historyRecordStartDateValue = year+'-'+formatStr(month)+'-'+formatStr(day)+' 00:00:00';
      function formatStr(str){
        str = str<10?'0'+str:str;
        return str;
      }
    },
    openSettingHeaderWin(){
      if (!this.mainEquipmentId) {
        this.$alert(this.$t('stationLang.no_query_equipment'),this.$t('stationLang.history_record'),{
          confirmButtonText:this.$t('el.messagebox.confirm'),
        })
        return;
      }
      // this.recordListSelectTitle = [];
      this.recordListSelectTitleCache = Object.assign([],this.recordListSelectTitle);//缓存选择的标题
      this.showMd('header');
      this.getTableHeaderList();
      this.getPlanList()
    },
    closeSettingHeaderWin(){
      this.closeMd('header');
      this.recordListSelectTitle = this.recordListSelectTitleCache;//取消操作还原选择的title
    },
    getTableHeaderList(){
      if (!this.mainEquipmentId) {
        return
      }
      let self= this;
      deviceApi.get_table_header_list(function(data){
        if(data.code=='200'){
          if (data.result.script == null) {
            self.recordListAllTitle = [];
            return;
          }
          if (typeof data.result.script == 'string') {
            self.recordListAllTitle = JSON.parse(data.result.script);
          } else {
            self.recordListAllTitle = data.result.script;
          }
           // console.log(self.recordListAllTitle);
        }
      },{'equipment_id':this.mainEquipmentId})
    },
    getRecordListData(){
      if (this.recordListAllTitle.length==0 || !this.mainEquipmentId) {
        this.$message.error(this.$t('stationLang.parameter_error'))
        return;
      }
      if (this.recordListSelectTitle.length==0) {
        this.$message.error(this.$t('stationLang.parameter_cannot_be_empty'))
        return;
      }
      this.oldStartDateValue = this.historyRecordStartDateValue;
      this.oldEndDateValue = this.historyRecordEndDateValue;
      let self = this;
      deviceApi.get_record_list_data(function(data){
        if(data.code=='200'){
          // 拼装表头格式
          let select = self.recordListSelectTitle;
          let all = self.recordListAllTitle;
          // console.log(select);
          // console.log(all);
          self.recordListTitle = [];
          for (let i = 0; i < select.length; i++) {
            let obj = {};
            for (var k = 0; k < all.length; k++) {
              if (all[k][0]==select[i]) {
                obj.prop = all[k][0];
                obj.label = all[k][2];
                self.recordListTitle.push(obj);
              }
            }
          }
          self.recordListTitle.unshift({'prop':'time','label':self.$t('stationLang.collect_time')});
          // 拼装表格数据格式
          let result = data.result.data;
          self.historyRecordTotal = data.result.total_records;
          // console.log(data);
          self.recordListTableData = [];
          for (let j = 0; j < result.length; j++) {
            // console.log((new Date(result[0].time)).toString());
            let item = result[j].value;
            item['time'] = result[j].time;
            // item['equipment_id'] = self.deviceInfoData.equipment_id;
            self.recordListTableData.push(item);
          }
          // console.log(self.recordListTableData);
          self.closeMd('header');
          self.isSettingTableHeader = true;
          // self.recordListSelectTitle = [];
        }
      },{'equipment_id':this.mainEquipmentId,'start_time':this.historyRecordStartDateValue,'end_time':this.historyRecordEndDateValue,'page_size':15,'page_index':1,'keys':JSON.stringify(this.recordListSelectTitle)})
    },
    settingTableHeaderCkBoxClick(id){
      if (this.recordListSelectTitle.indexOf(id) == -1) {
        this.recordListSelectTitle.push(id);
      }else{
        this.recordListSelectTitle.splice(this.recordListSelectTitle.indexOf(id),1);
      }
      if(this.recordListSelectTitle.length!=this.recordListAllTitle.length){
        this.isSelectAllTitle = true;
      }
      if (this.selectedPlanIndex != -1) {
        this.planData[this.selectedPlanIndex]['data'] = this.recordListSelectTitle
      }
    },
    settingTableHeaderSelectAll(){
      if (this.isSelectAllTitle) {
        for (var i = 0; i < this.recordListAllTitle.length; i++) {
          if (this.recordListSelectTitle.indexOf(this.recordListAllTitle[i][0])==-1) {
            this.recordListSelectTitle.push(this.recordListAllTitle[i][0])
          }
        }
      } else {
        this.recordListSelectTitle = [];
      }
      if (this.selectedPlanIndex != -1) {
        this.planData[this.selectedPlanIndex]['data'] = this.recordListSelectTitle
      }
      this.isSelectAllTitle = !this.isSelectAllTitle;
    },
    historyRecordHandleSizeChange(val){
      this.historyRecordCurrentPageSize = val;
      this.searchHistoryList();
    },
    exportTaskHandleSizeChange(val){
      this.exportRecordCurrentPageSize = val;
      this.getStateList();
    },
    searchHistoryList(){
      if (!this.recordListSelectTitle || this.recordListSelectTitle.length==0||!this.mainEquipmentId) {
        return false;
      }
      let start_time = this.historyRecordStartDateValue?this.historyRecordStartDateValue:'';
      let end_time = this.historyRecordEndDateValue?this.historyRecordEndDateValue:'';
      if (start_time != this.oldStartDateValue || end_time != this.oldEndDateValue) {
        this.historyRecordCurrentPage = 1;
        this.historyRecordCurrentPageSize = 15;
        this.oldStartDateValue = start_time;
        this.oldEndDateValue = end_time;
      }
      let self = this;
      deviceApi.get_record_list_data(function(data){
        if (data.code == 200) {
          // 拼装表格数据格式
          let result = data.result.data;
          self.historyRecordTotal = data.result.total_records;
          // console.log(data);
          self.recordListTableData = [];
          for (let j = 0; j < result.length; j++) {
            // console.log((new Date(result[0].time)).toString());
            let item = result[j].value;
            item['time'] = result[j].time;
            // item['equipment_id'] = self.deviceInfoData.equipment_id;
            self.recordListTableData.push(item);
          }
        }
      },{'equipment_id':this.mainEquipmentId,'start_time':start_time,'end_time':end_time,'page_size':this.historyRecordCurrentPageSize,'page_index':this.historyRecordCurrentPage,'keys':JSON.stringify(this.recordListSelectTitle)})
    },
    refreshHistoryList(){
      this.setHistoryRecordTime();
      this.historyRecordCurrentPageSize = 15;
      this.historyRecordCurrentPage = 1;
      this.searchHistoryList();
    },
    importHistoryList(){
      if (!this.mainEquipmentId) {
        return;
      }
      let ins = new Date(this.historyRecordEndDateValue).getTime()-new Date(this.historyRecordStartDateValue).getTime();
      if (ins>604800000) { //大于7天
        this.$alert(this.$t('stationLang.import_history_tip'),this.$t('stationLang.history_record'),{
          confirmButtonText:this.$t('el.messagebox.confirm'),
        })
        return;
      }
      let title = [];
      for (var i = 0; i < this.recordListTitle.length; i++) {
        // console.log(this.recordListTitle[i].prop);
        if (this.recordListSelectTitle.indexOf(this.recordListTitle[i].prop) != -1) {
          title.push(this.recordListTitle[i].label);
        }
      }
      this.md['loading']=true;
      let self = this;
      deviceApi.import_record_list_data(function(data){
        if(data.code == 200){

        }
        self.md['loading']=false;
        // mainEquipmentId
      },{'equipment_id':this.mainEquipmentId,'start_time':this.historyRecordStartDateValue,'end_time':this.historyRecordEndDateValue,'page_size':999999999,'page_index':1,'keys':JSON.stringify(this.recordListSelectTitle),'title':JSON.stringify(title)})
    },
    openCurveWin(){
      this.getTableHeaderList();
      this.datacurverradio=0;
      this.datacurverSelectValue1 = this.recordListSelectTitle[0]?this.recordListSelectTitle[0]:'';
      this.datacurverSelectValue2 = this.recordListSelectTitle[1]?this.recordListSelectTitle[1]:'';
      this.datacurverSelectValue3 = this.recordListSelectTitle[2]?this.recordListSelectTitle[2]:'';
      this.datacurverSelectValue4 = this.recordListSelectTitle[3]?this.recordListSelectTitle[3]:'';
      this.datacurverSelectValue5 = this.recordListSelectTitle[4]?this.recordListSelectTitle[4]:'';
      this.datacurverSelectValueArr=[
        this.recordListSelectTitle[0]?this.recordListSelectTitle[0]:'',
        this.recordListSelectTitle[1]?this.recordListSelectTitle[1]:'',
        this.recordListSelectTitle[2]?this.recordListSelectTitle[2]:'',
        this.recordListSelectTitle[3]?this.recordListSelectTitle[3]:'',
        this.recordListSelectTitle[4]?this.recordListSelectTitle[4]:''
      ];
      let echartsInstance = this.$echarts.getInstanceByDom(document.getElementById('dataCurveEcharts'));
      if (echartsInstance) {
        echartsInstance.dispose();
      }
      this.showMd('curve');
      this.setCurveDate(0);
      let dataCurve = this.$echarts.init(document.getElementById('dataCurveEcharts'));
      let option = {
          	color: ['#4162ff','#3bbc6a','#fdcd61','#44b4ff','#8b9efc','#474c53','#e24359'],
          	tooltip: {
          		trigger: 'axis',
          	},
          	legend: {
          		data:[],
          		left: '20',
          	},
          	grid: {
          		left: '4.5%',
          		right: '4.5%',
          		bottom: '80px',
          		top: '50px',
          	},
          	xAxis: {
          		type: 'category',
          		boundaryGap: false,
          		data: [].map(function (str) {
          			return str.replace(' ', '\n')
          		}),
          		splitLine: {
          			show: false
          		},
          		axisLabel: {
          			formatter: function (value, index) {
          				value=typeof(value)=='undefined'?'':value;
          				return value.replace(' ', '\n')
          			}
          		}

          	},
          	yAxis: [{
          		show: false,
          		type: 'value',
          		axisLine: {
          			show: false
          		}
          	}],
          	dataZoom: [{
          		type: 'inside',
          	}, {
          	}],
          	series: [],
      };
      let self = this;
      // let self.dataCurveTime['flag'] = [0, 1, 1, 1, 1];
      dataCurve.on('dataZoom',function(params){
        let options = dataCurve.getOption();
        let xdata = options.xAxis[0].data;
        let default_starttime=self.dataCurveTime['def'][0];
        let default_endtime=self.dataCurveTime['def'][1];
				let dz = options.dataZoom[0];
				let starttime = xdata[dz.startValue];
				let endtime = xdata[dz.endValue];
        if (!starttime || !endtime) {
          return;
        }
				let interval_s = Date.parse(endtime) - Date.parse(starttime);//毫秒
				let dir=1;//时间段变小
        if(self.dataCurveTime['inter'] <= interval_s){
					dir=0;//时间段变大
				}else{
					dir=1;
				}
				self.dataCurveTime['inter'] = interval_s;
        let echartsInstance = self.$echarts.getInstanceByDom(document.getElementById('dataCurveEcharts'));
        let zoomOption = echartsInstance.getOption();
        if (dir) {//变小
          if (interval_s <= 1*60*60*1000 && typeof(flag[1]) != 'undefined' && self.dataCurveTime['flag'][1]) { // 间隔时间<=1h  数据点间隔 = 1 m
            self.dataCurveTime['flag'][0] = self.dataCurveTime['flag'][0] + 1;
            self.dataCurveTime['flag'][1] = 0;//避免重复触发
            self.dataCurveTime['ori'].push([starttime,endtime]);
            self.datacurverSearch({'startTime':starttime,'endTime':endtime})
            // console.log(starttime);
            // console.log(endtime);
            // console.log('小于1h:'+interval_s);
          } else if (1*60*60*1000 < interval_s && interval_s <= 24*60*60*1000 && typeof(self.dataCurveTime['flag'][2]) != 'undefined' && self.dataCurveTime['flag'][2]) {  // 1h<=间隔时间<=1d  数据点间隔 = 30 m
            self.dataCurveTime['flag'][0] = self.dataCurveTime['flag'][0] + 1;
            self.dataCurveTime['flag'][2] = 0;//避免重复触发
            self.dataCurveTime['ori'].push([starttime,endtime]);
            self.datacurverSearch({'startTime':starttime,'endTime':endtime,'end':0})
            // console.log(starttime);
            // console.log(endtime);
            // console.log('小于1d:'+interval_s);
            // console.log(self.dataCurveTime['ori']);
          } else if (24*60*60*1000 < interval_s && interval_s <= 30*24*60*60*1000 && typeof(self.dataCurveTime['flag'][3]) != 'undefined' && self.dataCurveTime['flag'][3]) {  // 1d<=间隔时间<=1m  数据点间隔 = 1h
            self.dataCurveTime['flag'][0] = self.dataCurveTime['flag'][0] + 1;
            self.dataCurveTime['flag'][3] = 0;//避免重复触发
            self.dataCurveTime['ori'].push([starttime,endtime]);
            self.datacurverSearch({'startTime':starttime,'endTime':endtime,'end':0})
            // console.log(starttime);
            // console.log(endtime);
            // console.log('小于1m:'+interval_s);
            // console.log(self.dataCurveTime['ori']);
          } else if (30*24*60*60*1000 < interval_s && typeof(self.dataCurveTime['flag'][4]) != 'undefined' && self.dataCurveTime['flag'][4]) { // 1m<=间隔时间  数据点间隔 = 1d
            self.dataCurveTime['flag'][0] = self.dataCurveTime['flag'][0] + 1;
            self.dataCurveTime['flag'][4] = 0;//避免重复触发
            self.dataCurveTime['ori'].push([starttime,endtime]);
            self.datacurverSearch({'startTime':starttime,'endTime':endtime,'end':0})
          }
        } else {//变大
          let ori_start = Date.parse(self.dataCurveTime['ori'][self.dataCurveTime['ori'].length-1][0]);
          let ori_end = Date.parse(self.dataCurveTime['ori'][self.dataCurveTime['ori'].length-1][1]);
          var is_right = (ori_end - ori_start)==interval_s || dz.end==100&&dz.start==0;
          if (is_right && typeof(self.dataCurveTime['flag'][0]) != 'undefined' && self.dataCurveTime['flag'][0]) {
            // console.log(starttime);
            // console.log(endtime);
            // console.log('放大:'+interval_s);
            // console.log(self.dataCurveTime['ori']);
            let last_startTime = self.dataCurveTime['ori'][self.dataCurveTime['ori'].length-2][0];
            let last_endTime = self.dataCurveTime['ori'][self.dataCurveTime['ori'].length-2][1];
            self.dataCurveTime['flag'][0] = self.dataCurveTime['flag'][0] - 1;
            self.dataCurveTime['flag'][1] = 1;//允许加载
            self.dataCurveTime['flag'][2] = 1;//允许加载
            self.dataCurveTime['flag'][3] = 1;//允许加载
            self.dataCurveTime['flag'][4] = 1;//允许加载
            self.dataCurveTime['ori'].splice(self.dataCurveTime['ori'].length-1,1);
            if (last_startTime && last_endTime) {
              self.dataCurveTime['inter'] = Date.parse(last_endTime) - Date.parse(last_startTime);
              self.datacurverSearch({'startTime':last_startTime,'endTime':last_endTime,'end':self.dataCurveTime['ori'].length==1?100:0});
            }
          }
        }
      });
      dataCurve.setOption(option);
      //是否初始化数据曲线
      if (this.isSettingTableHeader) {
        let val = [];
        for (var i = 0; i < this.datacurverSelectValueArr.length; i++) {
          if (this.datacurverSelectValueArr[i] != '') {
            val.push(this.datacurverSelectValueArr[i]);
          }
        }
        let self = this;
        deviceApi.get_record_line_data(function(data){
          if (data.code == 200) {
            let echartsInstance = self.$echarts.getInstanceByDom(document.getElementById('dataCurveEcharts'));
            let obj = data.result.data;
            let type = 0;
            for (var key in obj) {
              if (obj.hasOwnProperty(key)) {
                let option = echartsInstance.getOption();
                let name = '';
                for (var i = 0; i < self.recordListAllTitle.length; i++) {
                  if(self.recordListAllTitle[i][0]==key){
                    name = self.recordListAllTitle[i][2];
                  }
                }
                option.series.push({
                  name: name,
                  type:'line',
                  uniqueid:'line_'+type,
                  smooth: false,
                  data:obj[key].data.map((item)=>{
                    return item;
                  }),
                  animation: false,
                  yAxisIndex:option.yAxis.length,
                });
                option.legend[0].data.push(name);
                if (!option.xAxis[0].data.length) {
                  option.xAxis[0].data=obj[key].datetime;
                }
                option.yAxis.push({
          				show: false,
          				type: 'value',
          				name: name,
          				axisLine: {
          					show: false
          				},
          				axisLabel: {
          					formatter: '{value}'
          				}
          			});
                echartsInstance.setOption(option,true);
                type++;
              }
            }
          }
        },{'equipment_id':this.mainEquipmentId,'start_time':this.datacurverTimeStart,'end_time':this.datacurverTimeEnd,'keys':JSON.stringify(val)})
      }
    },
    downDataCurverImg(){
      let echartsInstance = this.$echarts.getInstanceByDom(document.getElementById('dataCurveEcharts'));
      let imgUrl = echartsInstance.getDataURL({
        backgroundColor:'#ffffff',
      });
      let $a = document.createElement('a');
      $a.download = 'echarts_'+(new Date().getTime()*Math.random()).toFixed(0);
      $a.target = '_blank';
      $a.href = imgUrl;
      if (typeof MouseEvent === 'function') {
          var evt = new MouseEvent('click', {
              view: window,
              bubbles: true,
              cancelable: false
          });
          $a.dispatchEvent(evt);
      }
    },
    showDataCurverAlarmPoint(){
      if (!this.mainEquipmentId) {
        return;
      }
      if (this.isShowAlarmPoint) {
        let echartsInstance = this.$echarts.getInstanceByDom(document.getElementById('dataCurveEcharts'));
        let option = echartsInstance.getOption();
        let seriesItem = option.series;
        let wxAxis = option.xAxis;
        let wyAxis = option.yAxis;
        for (var i = 0; i < seriesItem.length; i++) {
          if (seriesItem[i].uniqueid == 'warning_point') {
            seriesItem.splice(i, 1);
          }
        }
        for (var j = 0; j < wxAxis.length; j++) {
          if (wxAxis[j].uniqueid&&wxAxis[j].uniqueid=='warning_point') {
            wxAxis.splice(j, 1);
          }
        }
        for (var k = 0; k < wyAxis.length; k++) {
          if (wyAxis[k].uniqueid&&wyAxis[k].uniqueid=='warning_point') {
            wyAxis.splice(k, 1);
          }
        }
        option.series = seriesItem;
        echartsInstance.setOption(option,true);
        let args = arguments;
        if (!arguments.length) {
          this.isShowAlarmPoint = !this.isShowAlarmPoint;
          return ;
        }
      }
      let self = this;
      deviceApi.get_record_alarm_point(function(data){
        if (data.code == 200) {
          if (!args.length) {
            self.isShowAlarmPoint = !self.isShowAlarmPoint;
          }
          let echartsInstance = self.$echarts.getInstanceByDom(document.getElementById('dataCurveEcharts'));
          let option = echartsInstance.getOption();
          let result = data.result;
          let coordArr = [];
          let dateTime = [];
          for (var i = 0; i < result.length; i++) {
            dateTime.push(result[i].created);
            coordArr.push([{
  						name: result[i].alert,
  						coord:[result[i].created,0],
  					}, {
  						coord:[result[i].created, 500]
  					}]);
          }//end
          let currxAxisData = option.xAxis[0].data;
          let xAll = [...new Set(currxAxisData.concat(dateTime))].sort(function(a,b){
            return Date.parse(a) - Date.parse(b);
          });
          option.series.push(
            {
            	type:'line',
            	uniqueid: 'warning_point',
            	data: xAll.map(function(item){
                return 500;
              }),
            	animation: false,
            	lineStyle: {
            		width:0,
            		color: '#fff',
            		opacity:0,
            	},
            	markLine: {
            		lineStyle: {
            			normal: {
            				color: 'red',
            				type: 'solid',
            				width: 1
            			}
            		},
            		symbol: 'none',
            		data:coordArr,
            		animation: false,
            		tooltip: {
            			formatter: ''
            		}
            	},
            	symbol: 'none',
            	tooltip: {
            		trigger: 'item',
            		backgroundColor: '#fff'
            	},
              yAxisIndex:option.yAxis.length,
              xAxisIndex:option.xAxis.length,
            }
          );//end
          // console.log(option.yAxis.length);
          option.yAxis.push({
          	show: false,
          	type: 'value',
          	name: '',
            uniqueid: 'warning_point',
          	min: 0,
          	max: 500,
          	axisLine: {
          		show: false
          	},
          	axisLabel: {
          		formatter: '{value}'
          	},
          	axisPointer: {
          		triggerTooltip: false
          	}
          });
          // console.log(option);
          if(dateTime.length>0){
  					// let x = option.xAxis[0].data;
            // // console.log(x.concat(dateTime));
            // let xAll = [...new Set(x.concat(dateTime))].sort();
            // option.xAxis[0].data = xAll;
            option.xAxis.push({
                show : false,
                type : 'category',
                uniqueid: 'warning_point',
                boundaryGap : false,
                axisLine:{
                  show:true
                },
                axisTick:{
                  show:false
                },
                splitLine:{
                  lineStyle:{
                    color:'#eeeeee'
                  }
                },
                data : xAll
            });
  				}
          echartsInstance.setOption(option,true);
          // console.log(data);
        }
      },{'equipment_id':this.mainEquipmentId,'start_time':this.datacurverTimeStart,'end_time':this.datacurverTimeEnd})
    },
    datacurverSearch(params){
      if (!this.mainEquipmentId) {
        return;
      }
      let val = [];
      let uniqueid = {};
      for (var i = 0; i < this.datacurverSelectValueArr.length; i++) {
        if (this.datacurverSelectValueArr[i] != '') {
          val.push(this.datacurverSelectValueArr[i]);
          uniqueid[this.datacurverSelectValueArr[i]]=i;
        }
      }
      if (val.length == 0) {
        this.$alert(this.$t('stationLang.data_line_tip'),this.$t('stationLang.data_line'),{
          confirmButtonText:this.$t('el.messagebox.confirm'),
        });
        return;
      }
      // if (this.isShowAlarmPoint) {
      //   this.showDataCurverAlarmPoint(true);
      // }
      let start_time = params&&params.startTime?params.startTime:this.datacurverTimeStart;
      let end_time = params&&params.endTime?params.endTime:this.datacurverTimeEnd;
      let self = this;
      if (!params) {
        self.dataCurveTime['flag'] = [0, 1, 1, 1, 1];
        self.dataCurveTime['def'] = [this.datacurverTimeStart,this.datacurverTimeEnd];
        self.dataCurveTime['ori'][0] = self.dataCurveTime['def'];
        self.dataCurveTime['inter'] = Date.parse(this.datacurverTimeEnd) - Date.parse(this.datacurverTimeStart);
      }
      deviceApi.get_record_line_data(function(data){
        if (data.code == 200) {
          let echartsInstance = self.$echarts.getInstanceByDom(document.getElementById('dataCurveEcharts'));
          let obj = data.result.data;
          if (JSON.stringify(obj) == "{}") {
            return;
          }
          let option = echartsInstance.getOption();
          for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
              let name = '';
              for (var i = 0; i < self.recordListAllTitle.length; i++) {
                if(self.recordListAllTitle[i][0]==key){
                  name = self.recordListAllTitle[i][2];
                }
              }
              if (option.series.length>0) {
                for (var i = 0; i < option.series.length; i++) {
                  if (option.series[i].uniqueid == ('line_'+uniqueid[key])) {
                    option.series[i]['data'] = obj[key].data.map((item)=>{
                      return item;
                    })
                  }
                }
              }
              if (obj[key].datetime.length&&option.xAxis[0].data.length) {
                option.xAxis[0].data=obj[key].datetime;
              }
            }
          }
          if (params) {
            let xdata = option.xAxis[0].data;
            option.dataZoom[0].start = 0;
            option.dataZoom[0].end = params['end']?params['end']:(xdata.length - 2) / xdata.length * 100;
          } else {
            option.dataZoom[0].start = 0;
            option.dataZoom[0].end = 100;
          }
          echartsInstance.setOption(option,true);
          // console.log(data);
        }
      },{'equipment_id':this.mainEquipmentId,'start_time':start_time,end_time,'keys':JSON.stringify(val)})
    },
    datacurverSelectChange(type){
      if (!this.mainEquipmentId) {
        return;
      }
      let obj = this.dealSelectValue(type);
      if (obj.isExist) {
        this.$alert(this.$t('stationLang.data_line_exist'),this.$t('stationLang.data_line'),{
          confirmButtonText:this.$t('el.messagebox.confirm'),
        });
        return;
      }
      // if (this.isShowAlarmPoint) {
      //   this.showDataCurverAlarmPoint(true);
      // }
      let val = obj.val;
      let self = this;
      if (self.dataCurveTime['ori'].length>1) {
        self.dataCurveTime['flag'] = [0, 1, 1, 1, 1];
        self.dataCurveTime['def'] = [this.datacurverTimeStart,this.datacurverTimeEnd];
        self.dataCurveTime['ori'][0] = self.dataCurveTime['def'];
        self.dataCurveTime['inter'] = Date.parse(this.datacurverTimeEnd) - Date.parse(this.datacurverTimeStart);
      }
      deviceApi.get_record_line_data(function(data){
        if (data.code == 200) {
          let echartsInstance = self.$echarts.getInstanceByDom(document.getElementById('dataCurveEcharts'));
          let obj = data.result.data;
          // console.log(obj);
          for (var key in obj) {
            if (obj.hasOwnProperty(key)) {
              let option = echartsInstance.getOption();
              let name = '';
              for (var i = 0; i < self.recordListAllTitle.length; i++) {
                if(self.recordListAllTitle[i][0]==key){
                  name = self.recordListAllTitle[i][2];
                }
              }
              if (option.series.length>0) {
                for (var i = 0; i < option.series.length; i++) {
                  if (option.series[i].uniqueid == ('line_'+type)) {
                    option.series[i] = {
                      name: name,
              				type:'line',
                      uniqueid:'line_'+type,
              				smooth: false,
              				data:obj[key].data.map((item)=>{
                        return item;
                      }),
              				animation: false,
                      yAxisIndex:option.yAxis.length,
                    }
                    option.legend[0].data[i]=name;
                    break;
                  }else if(i == option.series.length-1){
                    option.series.push({
                      name: name,
              				type:'line',
                      uniqueid:'line_'+type,
              				smooth: false,
              				data:obj[key].data.map((item)=>{
                        return item;
                      }),
              				animation: false,
                      yAxisIndex:option.yAxis.length,
                    });
                    option.legend[0].data.push(name);
                    break;
                  }
                }
              }else{
                option.series.push({
                  name: name,
          				type:'line',
                  uniqueid:'line_'+type,
          				smooth: false,
          				data:obj[key].data.map((item)=>{
                    return item;
                  }),
          				animation: false,
                  yAxisIndex:option.yAxis.length,
                });
                option.legend[0].data.push(name);
              }
              if (!option.xAxis[0].data.length) {
                option.xAxis[0].data=obj[key].datetime;
              }
              // console.log(option.yAxis);
              // let tmp = self.quickSort(obj[key].data);
              // let max = obj[key].max[0]*1;
              // let min = obj[key].min[0]*1;
              option.yAxis.push({
              	show: false,
              	type: 'value',
              	name: name,
              	// min: min,
              	// max: max,
              	axisLine: {
              		show: false
              	},
              	axisLabel: {
              		formatter: '{value}'
              	}
              });
              // console.log(JSON.stringify(option));
              echartsInstance.setOption(option,true);
            }
          }
          // console.log(data);
        }
      },{'equipment_id':this.mainEquipmentId,'start_time':this.datacurverTimeStart,'end_time':this.datacurverTimeEnd,'keys':JSON.stringify([val])})
    },
    throttle(fn,context,delay,text,mustApplyTime){
      clearTimeout(fn.timer);
      fn._cur=Date.now();  //记录当前时间

      if(!fn._start){      //若该函数是第一次调用，则直接设置_start,即开始时间，为_cur，即此刻的时间
          fn._start=fn._cur;
      }
      if(fn._cur-fn._start>mustApplyTime){
      //当前时间与上一次函数被执行的时间作差，与mustApplyTime比较，若大于，则必须执行一次函数，若小于，则重新设置计时器
          fn.call(context,text);
          fn._start=fn._cur;
      }else{
          fn.timer=setTimeout(function(){
              fn.call(context,text);
          },delay);
      }
    },
    quickSort(arr){
      //如果数组长度小于等于1，则返回数组本身
      if(arr.length<=1){
          return arr;
      }
      //定义中间值的索引
      var index = Math.floor(arr.length/2);
      //取到中间值
      var temp = arr.splice(index,1);
      //定义左右部分数组
      var left = [];
      var right = [];
      for(var i=0;i<arr.length;i++){
      //如果元素比中间值小，那么放在左边，否则放右边
          if(arr[i]<temp){
              left.push(arr[i]);
          }else{
              right.push(arr[i]);
          }
      }
      return this.quickSort(left).concat(temp,this.quickSort(right));
    },
    dealSelectValue(type){
      let val = '';
      let isExist = true;
      if (type == 0) {
        if (this.datacurverSelectValueArr.indexOf(this.datacurverSelectValue1)==-1) {
          this.datacurverSelectValueArr[0]=this.datacurverSelectValue1;
          val = this.datacurverSelectValue1;
          isExist = false;
        } else {
          this.datacurverSelectValue1 = this.datacurverSelectValueArr[0];
        }
      } else if (type == 1) {
        if (this.datacurverSelectValueArr.indexOf(this.datacurverSelectValue2)==-1) {
          this.datacurverSelectValueArr[1]=this.datacurverSelectValue2;
          val = this.datacurverSelectValue2;
          isExist = false;
        } else {
          this.datacurverSelectValue2 = this.datacurverSelectValueArr[1];
        }
      } else if (type == 2) {
        if (this.datacurverSelectValueArr.indexOf(this.datacurverSelectValue3)==-1) {
          this.datacurverSelectValueArr[2]=this.datacurverSelectValue3;
          val = this.datacurverSelectValue3;
          isExist = false;
        } else {
          this.datacurverSelectValue3 = this.datacurverSelectValueArr[2];
        }
      } else if (type == 3) {
        if (this.datacurverSelectValueArr.indexOf(this.datacurverSelectValue4)==-1) {
          this.datacurverSelectValueArr[3]=this.datacurverSelectValue4;
          val = this.datacurverSelectValue4;
          isExist = false;
        } else {
          this.datacurverSelectValue4 = this.datacurverSelectValueArr[3];
        }
      } else if (type == 4) {
        if (this.datacurverSelectValueArr.indexOf(this.datacurverSelectValue5)==-1) {
          this.datacurverSelectValueArr[4]=this.datacurverSelectValue5;
          val = this.datacurverSelectValue5;
          isExist = false;
        } else {
          this.datacurverSelectValue5 = this.datacurverSelectValueArr[4];
        }
      }
      return {isExist:isExist,val:val};
    },
    dataCurverRadioChange(val){
      this.setCurveDate(val);
    },
    setCurveDate(type){
      let date = new Date();
      let year = date.getFullYear();
      let month = date.getMonth()+1;
      let day = date.getDate();
      let h = date.getHours();
      let m = date.getMinutes();
      let s = date.getSeconds();
      if(type == 0){//日
        this.datacurverTimeEnd = year+'-'+formatStr(month)+'-'+formatStr(day)+' '+formatStr(h)+':'+formatStr(m)+':'+formatStr(s);
        this.datacurverTimeStart = year+'-'+formatStr(month)+'-'+formatStr(day)+' 00:00:00';
        this.dataCurveTime['def'] = [this.datacurverTimeStart,this.datacurverTimeEnd];
        this.dataCurveTime['ori'][0] = this.dataCurveTime['def'];
        this.dataCurveTime['inter'] = Date.parse(this.datacurverTimeEnd)-Date.parse(this.datacurverTimeStart);//毫秒
      }
      if (type == 1) {//周
        this.datacurverTimeEnd = year+'-'+formatStr(month)+'-'+formatStr(day)+' 00:00:00';
        date= +date - 1000*60*60*24*6;
        date = new Date(date);
        year = date.getFullYear();
        month = date.getMonth()+1;
        day = date.getDate();
        this.datacurverTimeStart = year+'-'+formatStr(month)+'-'+formatStr(day)+' 00:00:00';
        this.dataCurveTime['def'] = [this.datacurverTimeStart,this.datacurverTimeEnd];
        this.dataCurveTime['ori'][0] = this.dataCurveTime['def'];
        this.dataCurveTime['inter'] = Date.parse(this.datacurverTimeEnd)-Date.parse(this.datacurverTimeStart);//毫秒
      }
      if (type == 2) {//月
        this.datacurverTimeEnd = year+'-'+formatStr(month)+'-'+formatStr(day)+' 00:00:00';
        date= +date - 1000*60*60*24*30;
        date = new Date(date);
        year = date.getFullYear();
        month = date.getMonth()+1;
        day = date.getDate();
        this.datacurverTimeStart = year+'-'+formatStr(month)+'-'+formatStr(day)+' 00:00:00';
        this.dataCurveTime['def'] = [this.datacurverTimeStart,this.datacurverTimeEnd];
        this.dataCurveTime['ori'][0] = this.dataCurveTime['def'];
        this.dataCurveTime['inter'] = Date.parse(this.datacurverTimeEnd)-Date.parse(this.datacurverTimeStart);//毫秒
      }
      function formatStr(str){
        str = str<10?'0'+str:str;
        return str;
      }
    },
    // 历史记录 end
    // //弹框事件开关
    showMd(md) {
      this.md[md] = true;
      this.md.mask = true;
    },
    closeMd(md) {
      this.md[md] = false
      this.md.mask = false
    },
  },
  watch:{

  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
  @import '../../../../sass/station/detail/history.scss';
</style>
