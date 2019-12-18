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
  <div class="historyRecord flex-column">
    <div class="historyRecordContent flex-column">
      <div class="buttonTool">
        <div class="collectDate">
          <span>时间段</span>
          <div class="block">
            <el-date-picker
              v-model="historyRecordStartDateValue"
              type="datetime"
              value-format="yyyy-MM-dd HH:mm:ss"
              default-time="00:00:00"
              placeholder="开始日期">
            </el-date-picker>
          </div>
          <div class="block">
            <el-date-picker
              v-model="historyRecordEndDateValue"
              type="datetime"
              value-format="yyyy-MM-dd HH:mm:ss"
              default-time="23:59:59"
              placeholder="结束日期">
            </el-date-picker>
          </div>
          <span class="searchBtn" @click="searchHistoryList">搜索</span>
          <span class="tableHeaderBtn" @click="openSettingHeaderWin">选择参数</span>
        </div>
        <div class="ic_refresh" @click="refreshHistoryList"></div>
        <div class="ic_line" @click.stop="openCurveWin"></div>
        <div class="ic_export" v-show="isSettingTableHeader" @click="importHistoryList"></div>
      </div>
      <div class="recordList">
        <div class="tableWrap" v-if="recordListTitle.length>0">
          <el-table
          :data="recordListTableData"
          stripe
          style="width: 100%"
          height="100%"
          :header-row-style="{'fontSize':'12px','color':'#999999'}"
          :cell-style="{'fontSize':'14px','color':'#111111'}">
            <el-table-column v-for="(item,index) in recordListTitle" :key="index" :prop="item.prop" :label="item.label" :fixed="index==0 || index==1" :width="index==0?'155':'*'" min-width="120"></el-table-column>
          </el-table>
        </div>
      </div>
    </div>
    <div class="pageBtn flex-column">
      <div class="block" v-show="recordListTableData.length">
        <el-pagination background @size-change="historyRecordHandleSizeChange" @current-change="searchHistoryList" :current-page.sync="historyRecordCurrentPage" :page-sizes="[15,20,30,40,50]" :page-size="100" layout="prev, pager, next, sizes, jumper" :total="historyRecordTotal">
        </el-pagination>
      </div>
    </div>
    <!--弹框-->
    <div class="md-mask" :class="{ 'active': md.mask}"></div>
    <div class="md-loading" :class="{ 'active': md.loading}"><i class="el-icon-loading md-loading-icon"></i></div>
    <div class="modalWrap">
      <!-- 设置表头弹出框 start -->
      <div class="md-modal-container">
        <div class="md-modal md-effect-1 settingTableHeader" :class="{ 'md-show': md.header}">
          <div class="md-content">
            <!--头部-->
            <div class="titleBox flex-wrap flex-center">
              <div class="title">选择参数</div>
              <div class="iconWrap" @click="closeMd('header')"><i class="close"></i></div>
            </div>
            <!--内容-->
            <div class="contBox">
              <div class="settingWrap flex-wrap" v-if="recordListAllTitle.length">
                <div class="item" v-for="(item,index) in recordListAllTitle" :key="index">
                  <div class="ckBox" :class="{'checked':recordListSelectTitle.indexOf(item[0])>=0}" :data-titleid="item[0]" @click="settingTableHeaderCkBoxClick"></div>
                  <span>{{item[2]}}</span>
                </div>
              </div>
              <div class="nodata" v-else>
                暂无参数
              </div>
            </div>
            <!-- 按钮 -->
            <div class="buttomBox flex-wrap flex-center">
              <input type="button"  class="btn_cancel" value="全选"  @click="settingTableHeaderSelectAll" style="width:80px;"/>
              <input type="button"  class="btn_cancel" value="取消"  @click="closeMd('header')"/>
              <input type="button"  class="btn_determine" value="确认" @click="getRecordListData"/>
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
              <div class="title">数据曲线</div>
              <div class="iconWrap" @click="closeMd('curve')"><i class="close"></i></div>
            </div>
            <!--内容-->
            <div class="contBox">
              <div class="dataCurveWrap">
                <div class="topContent">
                  <el-radio-group v-model="datacurverradio" @change="dataCurverRadioChange">
                    <el-radio :label="0">日</el-radio>
                    <el-radio :label="1">周</el-radio>
                    <el-radio :label="2">月</el-radio>
                  </el-radio-group>
                  <div class="collectTime">
                    <span>时间段</span>
                    <div class="block">
                      <el-date-picker
                        v-model="datacurverTimeStart"
                        type="datetime"
                        value-format="yyyy-MM-dd HH:mm:ss"
                        placeholder="选择日期时间">
                      </el-date-picker>
                    </div>
                    <div class="block">
                      <el-date-picker
                        v-model="datacurverTimeEnd"
                        type="datetime"
                        value-format="yyyy-MM-dd HH:mm:ss"
                        placeholder="选择日期时间">
                      </el-date-picker>
                    </div>
                    <span class="searchBtn" @click="datacurverSearch">搜索</span>
                    <span class="warnBtn" @click="showDataCurverAlarmPoint">{{ isShowAlarmPoint ?'隐藏告警点':'显示告警点' }}</span>
                  </div>
                  <div class="downloadBtn" @click="downDataCurverImg"></div>
                </div>
                <div class="middleContent">
                  <div id="dataCurveEcharts"></div>
                </div>
                <div class="bottomContent flex-wrap">
                  <div class="selectItem">
                    <el-select v-model="datacurverSelectValue1"  placeholder="请选择" @change="datacurverSelectChange(0)">
                      <el-option
                        v-for="(item,index) in recordListAllTitle"
                        :key="index"
                        :label="item[2]"
                        :value="item[0]">
                      </el-option>
                    </el-select>
                  </div>
                  <div class="selectItem">
                    <el-select v-model="datacurverSelectValue2" placeholder="请选择" @change="datacurverSelectChange(1)">
                      <el-option
                        v-for="(item,index) in recordListAllTitle"
                        :key="index"
                        :label="item[2]"
                        :value="item[0]">
                      </el-option>
                    </el-select>
                  </div>
                  <div class="selectItem">
                    <el-select v-model="datacurverSelectValue3" placeholder="请选择" @change="datacurverSelectChange(2)">
                      <el-option
                        v-for="(item,index) in recordListAllTitle"
                        :key="index"
                        :label="item[2]"
                        :value="item[0]">
                      </el-option>
                    </el-select>
                  </div>
                  <div class="selectItem">
                    <el-select v-model="datacurverSelectValue4" placeholder="请选择" @change="datacurverSelectChange(3)">
                      <el-option
                        v-for="(item,index) in recordListAllTitle"
                        :key="index"
                        :label="item[2]"
                        :value="item[0]">
                      </el-option>
                    </el-select>
                  </div>
                  <div class="selectItem">
                    <el-select v-model="datacurverSelectValue5" placeholder="请选择" @change="datacurverSelectChange(4)">
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
  </div>
  <!-- 历史记录 end -->
</template>

<script>
import deviceApi from '@/assets/js/fetch/device';

export default {
  name: 'history',
  props:{
    equipmentId:Number,
    token:String,
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
      recordListAllTitle:[],
      recordListSelectTitle:[],
      recordListTitle:[],
      recordListTableData:[],
      isSettingTableHeader:false,
      historyRecordTotal:0,
      historyRecordCurrentPage:1,
      historyRecordCurrentPageSize:15,
      historyRecordStartDateValue:'',//new Date(new Date(new Date().toLocaleDateString()).getTime())
      historyRecordEndDateValue:'',
      dataCurveTime:{},
      // 弹窗控制
      md:{
      	mask:false,
        loading:false,
      	header:false,
      	curve:false,
      },
    }
  },
  mounted(){
    // console.log(this);
    // this.getEquipmentStatusConfig(this.equipmentId)
    this.setHistoryRecordTime();
  },
  methods:{
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
      if (!this.equipmentId) {
        this.$alert('暂无可查看的设备','历史记录',{
          confirmButtonText:'确定',
        })
        return;
      }
      this.showMd('header');
      this.getTableHeaderList();
      // this.getRecordListData();
    },
    getTableHeaderList(){
      if (!this.equipmentId || !this.token) {
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
      },{'equipment_id':this.equipmentId},this.token)
    },
    getRecordListData(){
      if (this.recordListAllTitle.length==0 || this.recordListSelectTitle.length==0||!this.equipmentId || !this.token) {
        return;
      }
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
          self.recordListTitle.unshift({'prop':'time','label':'采集时间'});
          // 拼装表格数据格式
          let result = data.result.result;
          self.historyRecordTotal = data.result.total;
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
      },{'equipment_id':this.equipmentId,'start_time':this.historyRecordStartDateValue,'end_time':this.historyRecordEndDateValue,'page_size':15,'page':1,'keys':JSON.stringify(this.recordListSelectTitle)},this.token)
    },
    settingTableHeaderCkBoxClick(e){
      if (this.recordListSelectTitle.indexOf(e.target.dataset.titleid) == -1) {
        this.recordListSelectTitle.push(e.target.dataset.titleid);
      }else{
        this.recordListSelectTitle.splice(this.recordListSelectTitle.indexOf(e.target.dataset.titleid),1);
      }
    },
    settingTableHeaderSelectAll(){
      for (var i = 0; i < this.recordListAllTitle.length; i++) {
        if (this.recordListSelectTitle.indexOf(this.recordListAllTitle[i][0])==-1) {
          this.recordListSelectTitle.push(this.recordListAllTitle[i][0])
        }
      }
    },
    historyRecordHandleSizeChange(val){
      this.historyRecordCurrentPageSize = val;
      this.searchHistoryList();
    },
    searchHistoryList(){
      if (!this.recordListSelectTitle || this.recordListSelectTitle.length==0||!this.equipmentId || !this.token) {
        return false;
      }
      let start_time = this.historyRecordStartDateValue?this.historyRecordStartDateValue:'';
      let end_time = this.historyRecordEndDateValue?this.historyRecordEndDateValue:'';
      let self = this;
      deviceApi.get_record_list_data(function(data){
        if (data.code == 200) {
          // 拼装表格数据格式
          let result = data.result.result;
          self.historyRecordTotal = data.result.total;
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
      },{'equipment_id':this.equipmentId,'start_time':start_time,'end_time':end_time,'page_size':this.historyRecordCurrentPageSize,'page':this.historyRecordCurrentPage,'keys':JSON.stringify(this.recordListSelectTitle)},this.token)
    },
    refreshHistoryList(){
      this.setHistoryRecordTime();
      this.historyRecordCurrentPageSize = 15;
      this.historyRecordCurrentPage = 1;
      this.searchHistoryList();
    },
    importHistoryList(){
      if (!this.equipmentId || !this.token) {
        return;
      }
      let ins = new Date(this.historyRecordEndDateValue).getTime()-new Date(this.historyRecordStartDateValue).getTime();
      if (ins>604800000) { //大于7天
        this.$alert('一次最多导出7天的记录，请重新设置时间段','历史记录',{
          confirmButtonText:'确定',
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
        // equipmentId
      },{'equipment_id':this.equipmentId,'start_time':this.historyRecordStartDateValue,'end_time':this.historyRecordEndDateValue,'page_size':999999999,'page':1,'keys':JSON.stringify(this.recordListSelectTitle),'title':JSON.stringify(title)},this.token)
    },
    openCurveWin(){
      this.getTableHeaderList();
      this.datacurverradio=0;
      this.datacurverSelectValue1 = '';
      this.datacurverSelectValue2 = '';
      this.datacurverSelectValue3 = '';
      this.datacurverSelectValue4 = '';
      this.datacurverSelectValue5 = '';
      this.datacurverSelectValueArr=['','','','',''];
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
          		left: 'left'
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
      let inter = (Date.parse(self.datacurverTimeEnd)-Date.parse(self.datacurverTimeStart))/1000;//秒
      let flag = [0, 1, 1];
      self.dataCurveTime['ori'] = new Array();
      self.dataCurveTime['def_start'] = self.datacurverTimeStart;
      self.dataCurveTime['def_end'] = self.datacurverTimeEnd;
      self.dataCurveTime['ori'][0]=[self.dataCurveTime['def_start'], self.dataCurveTime['def_end']];
      dataCurve.on('dataZoom',function(params){
        let options = dataCurve.getOption();
        let xdata = options.xAxis[0].data;
        let default_starttime=self.dataCurveTime['def_start'];
        let default_endtime=self.dataCurveTime['def_end'];
				let dz = options.dataZoom[0];
				let starttime = xdata[dz.startValue];
				let endtime = xdata[dz.endValue];
        if (!starttime || !endtime) {
          return;
        }
				let interval_s=(Date.parse(endtime)-Date.parse(starttime))/1000;//秒
				let dir=1;//时间段变小
        if(inter<=interval_s){
					dir=0;//时间段变大
				}else{
					dir=1;
				}
				inter=interval_s;
        let echartsInstance = self.$echarts.getInstanceByDom(document.getElementById('dataCurveEcharts'));
        let zoomOption = echartsInstance.getOption();
        if (dir) {//变小
          if (interval_s<=604800&&interval_s>18000&&(typeof(flag[1])!='undefined' &&flag[1])) {
            self.dataCurveTime['starttime']=typeof(self.dataCurveTime['starttime'])!='undefined'?self.dataCurveTime['starttime']:default_starttime;
						self.dataCurveTime['endtime']=typeof(self.dataCurveTime['endtime'])!='undefined'?self.dataCurveTime['endtime']:default_endtime;
            flag[1]=0; //避免重复触发
            flag[0]=1;
            self.throttle(self.datacurverSearch,null,300,{'startTime':starttime,'endTime':endtime},1000);
            self.dataCurveTime['starttime']=starttime;
            self.dataCurveTime['endtime']=endtime;
            // console.log(starttime);
            // console.log(endtime);
            self.dataCurveTime['zoom']=1;
            self.dataCurveTime['ori'][self.dataCurveTime['zoom']]=[self.dataCurveTime['def_start'], self.dataCurveTime['def_end']];
            self.dataCurveTime['def_start'] = starttime;
            self.dataCurveTime['def_end'] = endtime;
            zoomOption.dataZoom[0].start=0;
            zoomOption.dataZoom[0].end=99;
            echartsInstance.setOption(zoomOption, true);
          } else if (interval_s<=18000&&(typeof(flag[2])!='undefined' &&flag[2])){
            self.dataCurveTime['starttime']=typeof(self.dataCurveTime['starttime'])!='undefined'?self.dataCurveTime['starttime']:default_starttime;
						self.dataCurveTime['endtime']=typeof(self.dataCurveTime['endtime'])!='undefined'?self.dataCurveTime['endtime']:default_endtime;
            flag[2]=0; //避免重复触发
            flag[0]=1;
            self.throttle(self.datacurverSearch,null,300,{'startTime':starttime,'endTime':endtime},1000);
            self.dataCurveTime['starttime']=starttime;
            self.dataCurveTime['endtime']=endtime;
            self.dataCurveTime['zoom']=2;
            self.dataCurveTime['ori'][self.dataCurveTime['zoom']]=[self.dataCurveTime['def_start'], self.dataCurveTime['def_end']];
            self.dataCurveTime['def_start'] = starttime;
            self.dataCurveTime['def_end'] = endtime;
            zoomOption.dataZoom[0].start=0;
            zoomOption.dataZoom[0].end=99;
            echartsInstance.setOption(zoomOption, true);
          }
        } else {//变大
          let def_start=Date.parse(self.dataCurveTime['def_start']);
          let def_end=Date.parse(self.dataCurveTime['def_end']);
          // console.log(starttime);
          // console.log(self.dataCurveTime['starttime']);
          // console.log(self.dataCurveTime['def_start']);
          // console.log('start===========end');
          // console.log(endtime);
          // console.log(self.dataCurveTime['endtime']);
          // console.log(self.dataCurveTime['def_end']);
          var is_right=(def_end-def_start)/1000==interval_s||dz.end==100&&dz.start==0;
          // let is_right=dz.end==100&&dz.start==0;
          if (is_right || interval_s==(Date.parse(self.dataCurveTime['endtime'])-Date.parse(self.dataCurveTime['starttime'])/1000)&&(typeof(flag[0])!='undefined' &&flag[0])) {
            self.dataCurveTime['starttime']=typeof(self.dataCurveTime['starttime'])!='undefined'?self.dataCurveTime['starttime']:default_starttime;
						self.dataCurveTime['endtime']=typeof(self.dataCurveTime['endtime'])!='undefined'?self.dataCurveTime['endtime']:default_endtime;
            flag[0]=0; //避免重复触发
            flag[1]=1; //允许加载
            flag[2]=1; //允许加载
            self.dataCurveTime['zoom']=self.dataCurveTime['zoom']!=0?self.dataCurveTime['zoom']-1:0;
            var zoom_type=self.dataCurveTime['zoom']==0?'init':'zoom';
            // console.log(self.dataCurveTime['zoom']);
            // console.log(self.dataCurveTime['ori']);
            self.throttle(self.datacurverSearch,null,500,{'startTime': self.dataCurveTime['ori'][self.dataCurveTime['zoom']][0],'endTime':	self.dataCurveTime['ori'][self.dataCurveTime['zoom']][1]},1500);
            self.dataCurveTime['starttime'] = self.dataCurveTime['ori'][self.dataCurveTime['zoom']][0];
            self.dataCurveTime['endtime'] = self.dataCurveTime['ori'][self.dataCurveTime['zoom']][1];
            self.dataCurveTime['def_start'] = self.dataCurveTime['ori'][self.dataCurveTime['zoom']][0];
            self.dataCurveTime['def_end'] = self.dataCurveTime['ori'][self.dataCurveTime['zoom']][1];
            if (self.dataCurveTime['zoom']!=0) {
              setTimeout(function(){
                var dateAarr=zoomOption.xAxis[0].data;
                dateAarr.push(self.dataCurveTime['ori'][self.dataCurveTime['zoom']][0]);
                dateAarr.push(self.dataCurveTime['ori'][self.dataCurveTime['zoom']][1]);
                dateAarr.sort();
                var length=zoomOption.xAxis[0].data.length;
                var index_start=dateAarr.indexOf(self.dataCurveTime['ori'][self.dataCurveTime['zoom']][0])-1;
                var index_end=dateAarr.indexOf(self.dataCurveTime['ori'][self.dataCurveTime['zoom']][1]);
                var start=parseInt((index_start/length)*100);
                var end=parseInt((index_end/length)*100);
                zoomOption.dataZoom[0].start=start;
                zoomOption.dataZoom[0].end=end;
                echartsInstance.setOption(zoomOption, true);
              }, 500);
            }

          }
        }
      });
      dataCurve.setOption(option);
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
      if (!this.equipmentId || !this.token) {
        return;
      }
      if (this.isShowAlarmPoint) {
        this.isShowAlarmPoint = !this.isShowAlarmPoint;
        let echartsInstance = this.$echarts.getInstanceByDom(document.getElementById('dataCurveEcharts'));
        let option = echartsInstance.getOption();
        let seriesItem = option.series;
        for (var i = 0; i < seriesItem.length; i++) {
          if (seriesItem[i].uniqueid == 'warning_point') {
            seriesItem.splice(i, 1);
          }
        }
        option.series = seriesItem;
        echartsInstance.setOption(option,true);
        return ;
      }
      let self = this;
      deviceApi.get_record_alarm_point(function(data){
        if (data.code == 200) {
          self.isShowAlarmPoint = !self.isShowAlarmPoint;
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
          option.series.push(
            {
            	type:'line',
            	uniqueid: 'warning_point',
            	data: dateTime.map(function(item){
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
            }
          );//end
          // console.log(option.yAxis.length);
          option.yAxis.push({
  					show: false,
  					type: 'value',
  					name: '',
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
  					let x = option.xAxis[0].data;
            // console.log(x.concat(dateTime));
            let xAll = [...new Set(x.concat(dateTime))].sort();
            option.xAxis[0].data = xAll;
  				}
          echartsInstance.setOption(option,true);
          // console.log(data);
        }
      },{'equipment_id':this.equipmentId,'start_time':this.datacurverTimeStart,'end_time':this.datacurverTimeEnd},this.token)
    },
    datacurverSearch(params){
      if (!this.equipmentId || !this.token) {
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
        this.$alert('请选择需要查看的参数','数据曲线',{
          confirmButtonText:'确定',
        });
        return;
      }
      let start_time = params&&params.startTime?params.startTime:this.datacurverTimeStart;
      let end_time = params&&params.endTime?params.endTime:this.datacurverTimeEnd;
      let self = this;
      deviceApi.get_record_line_data(function(data){
        if (data.code == 200) {
          let echartsInstance = self.$echarts.getInstanceByDom(document.getElementById('dataCurveEcharts'));
          let obj = data.result;
          if (JSON.stringify(obj) == "{}") {
            return;
          }
          let option = echartsInstance.getOption();
          if (!params) {
            option.xAxis[0].data = [];
          }
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
                    option.series[i] = {
                      name: name,
              				type:'line',
                      uniqueid:'line_'+uniqueid[key],
              				smooth: true,
              				data:obj[key].data.map((item)=>{
                        return item;
                      }),
              				animation: false,
                      yAxisIndex:option.yAxis.map((item,index)=>{
                        return item.name==name?index:null;
                      }),
                    }
                    // console.log(option.yAxis);
                    option.legend[0].data[i]=name;
                  }
                }
              }
              if (!option.xAxis[0].data.length||obj[key].datetime.length) {
                option.xAxis[0].data=obj[key].datetime;
              }
            }
          }
          echartsInstance.setOption(option,true);
          // console.log(data);
        }
      },{'equipment_id':this.equipmentId,'start_time':start_time,end_time,'keys':JSON.stringify(val)},this.token)
    },
    datacurverSelectChange(type){
      if (!this.equipmentId || !this.token) {
        return;
      }
      let obj = this.dealSelectValue(type);
      if (obj.isExist) {
        this.$alert('该曲线已存在，请重新选择','数据曲线',{
          confirmButtonText:'确定',
        });
        return;
      }
      let val = obj.val;
      let self = this;
      deviceApi.get_record_line_data(function(data){
        if (data.code == 200) {
          let echartsInstance = self.$echarts.getInstanceByDom(document.getElementById('dataCurveEcharts'));
          let obj = data.result;
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
              				smooth: true,
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
              				smooth: true,
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
          				smooth: true,
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
        }//this.datacurverTimeStart //this.datacurverTimeEnd
      },{'equipment_id':this.equipmentId,'start_time':this.datacurverTimeStart,'end_time':this.datacurverTimeEnd,'keys':JSON.stringify([val])},this.token)
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
      }
      if (type == 1) {//周
        this.datacurverTimeEnd = year+'-'+formatStr(month)+'-'+formatStr(day)+' 23:59:59';
        date= +date - 1000*60*60*24*6;
        date = new Date(date);
        year = date.getFullYear();
        month = date.getMonth()+1;
        day = date.getDate();
        this.datacurverTimeStart = year+'-'+formatStr(month)+'-'+formatStr(day)+' 00:00:00';
      }
      if (type == 2) {//月
        this.datacurverTimeEnd = year+'-'+formatStr(month)+'-'+formatStr(day)+' 23:59:59';
        date= +date - 1000*60*60*24*30;
        date = new Date(date);
        year = date.getFullYear();
        month = date.getMonth()+1;
        day = date.getDate();
        this.datacurverTimeStart = year+'-'+formatStr(month)+'-'+formatStr(day)+' 00:00:00';
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
  @import '../../../../sass/singleEquipment/tab/history.scss';
</style>
