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
  <div class="cont-box flex-column">
    <div class="top-box flex-wrap flex-center">
        <div class="box flex-wrap flex-center">
          <div class="top-one flex-wrap flex-center">
             <div class="top-one-icon"></div>
             <div class="top-one-right">
                <div class="num">{{totalData.is_customer}}</div>
                <div class="name">{{$t('homeLang.customer_total')}}</div>
             </div>
          </div>
          <div class="top-two flex-wrap flex-center">
             <div class="top-two-icon"></div>
             <div class="top-two-right">
                <div class="num">{{totalData.is_equipment}}</div>
                <div class="name">{{$t('homeLang.equipment_total')}}</div>
             </div>
          </div>
        </div>
        <div class="top-three flex-wrap flex-center">
            <div class="com-div flex-wrap">
              <div class="com">
                <div class="num">{{totalData.is_online}}</div>
                <div class="name">{{$t('homeLang.online_equipment')}}</div>
              </div>
            </div>
            <div class="split-line"></div>
            <div class="com-div flex-wrap">
              <div class="com">
                <div class="num">{{totalData.is_off}}</div>
                <div class="name">{{$t('homeLang.offline_equipment')}}</div>
              </div>
            </div>
            <div class="split-line"></div>
            <div class="com-div flex-wrap">
              <div class="com">
                <div class="num">{{totalData.is_boot}}</div>
                <div class="name">{{$t('homeLang.boot_equipment')}}</div>
              </div>
            </div>
            <div class="split-line"></div>
            <div class="com-div flex-wrap">
              <div class="com">
                <div class="num">{{totalData.is_down}}</div>
                <div class="name">{{$t('homeLang.shutdown_equipment')}}</div>
              </div>
            </div>
            <div class="split-line"></div>
            <div class="com-div flex-wrap">
              <div class="com">
                <div class="num">{{totalData.is_normal}}</div>
                <div class="name">{{$t('homeLang.normal_equipment')}}</div>
              </div>
            </div>
            <div class="split-line"></div>
            <div class="com-div flex-wrap">
              <div class="com">
                <div class="num">{{totalData.is_abnormal}}</div>
                <div class="name">{{$t('homeLang.abnormal_equipment')}}</div>
              </div>
            </div>
        </div>
    </div>
    <div class="net-box flex-wrap flex-center">
       <div class="net-one flex-column">
          <div class="title"><p>{{$t('homeLang.equipment_area_distribution_title')}}</p></div>
          <div class="distributed flex-con-1 flex-wrap">
             <div id="distributed"  class="pic"></div>
             <div class="progress flex-column">
               <div class="item flex-wrap" v-for="(item, index) in distributedData" :key="index">
                 <div class="info flex-wrap" :style="{'minWidth':$i18n.locale=='en'?'100px':'40px'}">
                   <i class="icon" :style="{borderColor: item.color}"></i>
                   <span class="name">{{ item.name }}</span>
                 </div>
                 <div class="data flex-wrap flex-con-1">
                   <span class="bar"><i :style="{width: item.percent,backgroundColor: item.color} "></i></span>
                   <span class="value flex-con-1" :title="item.percent">{{ item.value }}&nbsp;({{ item.percent }})</span>
                 </div>
               </div>
             </div>
           </div>
       </div>
       <div class="net-two flex-column">
          <div class="title"><p>{{$t('homeLang.efa_statistics_title')}}</p></div>
          <div id="statistics" class="statistics flex-con-1"></div>
       </div>
    </div>
    <div class="buttom-div flex-wrap flex-center">
       <div class="buttom-one flex-column">
          <div class="title"><p>{{$t('homeLang.service_statistics_title')}}</p></div>
          <div id="serviceStatistics" class="service-statistics flex-con-1">
            <div v-if="isNodataService" class="indexPageNodata">{{$t('homeLang.no_data')}}</div>
          </div>
       </div>
       <div class="buttom-two flex-column">
          <div class="title">
            <p>{{$t('homeLang.equipment_map_distribution_title')}}</p>
            <div class="map-full-screen-btn" @click="showFullScreenMap"></div>
          </div>
          <div class="map-box">
            <div class="map flex-con-1 flex-column">
              <div id="bdMap" class="map-container"></div>
            </div>
          </div>
       </div>
    </div>
    <div class="bdmap-full-screen flex-column" v-show="isFullScreen">
      <div class="title">
        <p>{{$t('homeLang.equipment_map_distribution_title')}}</p>
        <div class="map-full-screen-btn" @click="isFullScreen=!isFullScreen"></div>
      </div>
      <div class="map-box">
        <div class="map flex-con-1 flex-column">
          <div id="fullScreenBdMap" class="map-container"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import config from '$config';
import indexApi from '@/assets/js/fetch/index';
import '@/assets/js/resizeDiv/resize';

export default {
  name: 'home',
  props:{
    isExpand:Boolean,
  },
  data () {
    return {
      totalData:[],
      distributedData:[],
      isFullScreen:false,
      isNodataService:false,
    }
  },
  mounted(){
    let self = this;
    indexApi.get_statistics_plus((data)=>{
      if (data.code == 200) {
        self.totalData = data.result;
        // console.log(data);
      }
    },{});
    this.getStatisticsData();
    this.getMapData();
    this.getDistributionData();
    this.getServiceCountData();
  },
  methods: {
    getStatisticsData(){
      let self = this;
      indexApi.get_statistics((data)=>{
        if (data.code == 200) {
          let result = data.result;
          let time_arr = result.timeDate
          let faultData = [];
          let alarmData = [];
          let eventData = []
          for (var i = 0; i < time_arr.length; i++) {
            faultData.push(result.fault[time_arr[i]]?result.fault[time_arr[i]]:0);
            alarmData.push(result.alert[time_arr[i]]?result.alert[time_arr[i]]:0);
            eventData.push(result.event[time_arr[i]]?result.event[time_arr[i]]:0);
          }
          self.drawLine(time_arr,faultData,alarmData,eventData);
        }
      },{'intervalDay':15});
    },
    drawLine(time_arr,faultData,alarmData,eventData) {
      // 基于准备好的dom，初始化echarts实例
      let myChart = this.$echarts.init(document.getElementById('statistics'));
			myChart.setOption({
			    title : {
            show:false
			    },
          // color:['#e24359','#fdcd61','#44b4ff','#4162ff','#3bbc6a'],
			    tooltip : {
			        trigger: 'axis'
			    },
			    legend: {
            top:'15',
            right:'30',
			        data:[this.$t('homeLang.event'),this.$t('homeLang.fault'),this.$t('homeLang.alert')]
			    },
			    calculable : true,
          grid:{
            show:false,
            left:45,
            right:30,
            // top:"8%",
            bottom:45,
          },
			    xAxis : [
			        {
			            type : 'category',
			            boundaryGap : false,
                  axisLine:{
                    show:false
                  },
                  axisTick:{
                    show:false
                  },
                  axisLabel:{
                    color: '#999999',
                    fontFamily:'ArialMT',
                  },
                  splitLine:{
                    lineStyle:{
                      color:'#eeeeee'
                    }
                  },
			            data : time_arr&&time_arr.length?time_arr:[] // 日期
			        }
			    ],
			    yAxis : [
			        {
			            type : 'value',
                  axisLine:{
                    show:false
                  },
                  axisTick:{
                    show:false
                  },
                  splitLine:{
                    lineStyle:{
                      color:'#f3f3f3',
                    }
                  },
                  axisLabel:{
                    color: '#999999',
                    fontFamily:'ArialMT',
                  }
			        }
			    ],
			    series : [
            {
                name:this.$t('homeLang.event'),
                type:'line',
                smooth:true,
                itemStyle: {normal: {areaStyle: {type: 'default'}}},
                color: {
                    type: 'linear',
                    x: 1,
                    y: 0,
                    x2: 0,
                    y2: 1,
                    colorStops: [{
                        offset: 0, color: '#fbb71f' // 0% 处的颜色
                    }, {
                        offset: 1, color: '#fdd16d' // 100% 处的颜色
                    }],
                    globalCoord: false // 缺省为 false
                },
                data:eventData&&eventData.length?eventData:[]
            },
		        {
		            name:this.$t('homeLang.fault'),
		            type:'line',
		            smooth:true,
		            itemStyle: {normal: {areaStyle: {type: 'default'}}},
                color: {
                    type: 'linear',
                    x: 1,
                    y: 0,
                    x2: 0,
                    y2: 1,
                    colorStops: [{
                          offset: 0, color: 'rgba(67,105,255,0.8)' // 0% 处的颜色
                    }, {
                          offset: 1, color: 'rgba(65,135,255,0.8)' // 100% 处的颜色
                    }],
                      globalCoord: false // 缺省为 false
                },
		            data:faultData&&faultData.length?faultData:[]
		        },
		        {
		            name:this.$t('homeLang.alert'),
		            type:'line',
		            smooth:true,
		            itemStyle: {normal: {areaStyle: {type: 'default'}}},
                color: {
                    type: 'linear',
                    x: 1,
                    y: 0,
                    x2: 0,
                    y2: 1,
                    colorStops: [{
                          offset: 0, color: 'rgba(55,186,106,0.8)' // 0% 处的颜色
                    }, {
                          offset: 1, color: 'rgba(103,194,88,0.8)' // 100% 处的颜色
                    }],
                      globalCoord: false // 缺省为 false
                },
		            data:alarmData&&alarmData.length?alarmData:[]
		        }
			    ]
			});
      $('div.cont-box').resize(function(){
        myChart.resize();
      });
    },
    getDistributionData(){
      let self = this;
      indexApi.get_distribution_data((data)=>{
        if (data.code == 200) {
          //['华东','华南','华中','华北','东北','西北','西南']
          let legend = {
            "east_china":this.$t('homeLang.east_china'),
            "south_china":this.$t('homeLang.south_china'),
            "central_china":this.$t('homeLang.central_china'),
            "north_china":this.$t('homeLang.north_china'),
            "northeast":this.$t('homeLang.northeast'),
            "northwest":this.$t('homeLang.northwest'),
            "southwest":this.$t('homeLang.southwest'),
            "unknown":this.$t('homeLang.other'),
          };
          // console.log(data);
          let result = data.result;
          let dataArr = [];
          for (var k in result) {
            if (result.hasOwnProperty(k)) {
              dataArr.push({'value':result[k],'name':legend[k]});
            }
          }
        self.localDistribution(dataArr);
        }
      },{})
    },
    localDistribution(data){
    	let myChart = this.$echarts.init(document.getElementById('distributed'))
      let percentArr = [];
      // 绘制图表
      myChart.setOption({
        tooltip : {
          trigger: 'item',
          formatter: '{c} ({d}%) &nbsp; {b}',
          confine:true,
  	    },
        color:['#4162ff','#3bbc6a','#e24359','#fdcd61','#44b4ff','#474c53','#8b9efc','#808080'],
  	    legend: {
          show:false,
          icon:'pin',
  	        orient : 'vertical',
  	        // x : 'right',
  	        y:'center',
            left:'60%',
            align:'left',
  	        data:[
              this.$t('homeLang.east_china'),
              this.$t('homeLang.south_china'),
              this.$t('homeLang.central_china'),
              this.$t('homeLang.north_china'),
              this.$t('homeLang.northeast'),
              this.$t('homeLang.northwest'),
              this.$t('homeLang.southwest'),
              this.$t('homeLang.other'),
            ]
  	    },
  	    calculable : true,
  	    series : [
  	        {
  	            name:this.$t('homeLang.equipment_area_distribution_title'),
  	            type:'pie',
  	            radius : ['50%', '70%'],
                // center: ['30%', '50%'],
  	            itemStyle : {
  	                normal : {
  	                    label : {
  	                        show : false,
                            fontSize : window.innerWidth<1520?'14':'18',
                            baseline : 'top',
                            position : 'center',
                            formatter : function(data) {
                              percentArr.push(data.percent);
                              return data.value + ' ('+data.percent+'%) &nbsp; ' + data.name;
                            }
  	                    },
  	                    labelLine : {
  	                        show : false
  	                    }
  	                },
  	                emphasis : {
  	                    label : {
  	                        show : false,
  	                        position : 'center',
  	                        textStyle : {
  	                            fontSize : window.innerWidth<1520?'14':'18',
  	                            fontWeight : 'bold'
  	                        }
  	                    }
  	                }
  	            },
  	            data:data&&data.length?data:[]
  	        }
  	    ]
      });
      this.createLegend(data,percentArr);
      $('div.cont-box').resize(function(){
        myChart.resize();
      });
    },
    createLegend(data,percentArr){
      // let data = [
      //   {value:135, name:'华东'},//['华东','华南','华中','华北','东北','西北','西南']
      //   {value:110, name:'华南'},
      //   {value:134, name:'华中'},
      //   {value:135, name:'华北'},
      //   {value:154, name:'东北'},
      //   {value:114, name:'西北'},
      //   {value:104, name:'西南'},
      // ];
      let color = ['#4162ff','#3bbc6a','#e24359','#fdcd61','#44b4ff','#474c53','#8b9efc','#808080'];
      var total = 0;
      for (var i = 0; i < data.length; i++) {
        total += data[i].value;
      }
      for (var i = 0; i < data.length && i < color.length; i++) {
        if (total) {
          data[i].percent = (percentArr[i] + '%') || ((data[i].value / total * 100).toFixed(2) + '%');
        }else{
          data[i].percent ='0%';
        }
        data[i].color = color[i];
      }
      this.distributedData = data;
      // console.log(this.distributedData)
    },
    getServiceCountData(){
      let self = this;
      indexApi.get_service_count_data((data)=>{
        if (data.code == 200) {
          // console.log(data);
          let result = data.result;
          if (result.length==0) {
            if (document.getElementById('serviceStatistics')) {
              self.isNodataService = true;
              // document.getElementById('serviceStatistics').innerHTML='<div class="indexPageNodata">'+this.$t('homeLang.no_data')+'</div>';
            }
            return;
          }
          //['日常巡检', '设备维修','定期保养','故障排除','报警处理','其他']
          let time_arr = result.timeDate?result.timeDate:[];
          let service = result.service?result.service:[];
          let obj = {
            'inspection':[],
            'repair':[],
            'maintenance':[],
            'fault':[],
            'alarm':[],
            'other':[],
          }
          for (var i = 0; i < time_arr.length; i++) {
            obj['inspection'].push(service[time_arr[i]]['日常巡检']?service[time_arr[i]]['日常巡检']:0);
            obj['repair'].push(service[time_arr[i]]['设备维修']?service[time_arr[i]]['设备维修']:0);
            obj['maintenance'].push(service[time_arr[i]]['定期保养']?service[time_arr[i]]['定期保养']:0);
            obj['fault'].push(service[time_arr[i]]['故障排除']?service[time_arr[i]]['故障排除']:0);
            obj['alarm'].push(service[time_arr[i]]['报警处理']?service[time_arr[i]]['报警处理']:0);
            obj['other'].push(service[time_arr[i]]['其他']?service[time_arr[i]]['其他']:0);
          }
          self.serviceCount(time_arr,obj);
        }
      },{'intervalDay':7})
    },
    serviceCount(time,obj){
      let dom = document.getElementById('serviceStatistics');
    	let myChart = this.$echarts.init(dom);
      // 绘制图表
      myChart.setOption({
      	tooltip : {
          trigger: 'axis',
          axisPointer : {            // 坐标轴指示器，坐标轴触发有效
              type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
          }
		    },
		    legend: {
          icon:'pin',
          top:'15',
          right:'30',
          textStyle:{
            color:'#888888',
            fontSize:'12',
            fontFamily:'MicrosoftYaHei',
          },
		      data:[
            this.$t('homeLang.daily_inspection'),
            this.$t('homeLang.equipment_repair'),
            this.$t('homeLang.regular_maintenance'),
            this.$t('homeLang.troubleshooting'),
            this.$t('homeLang.alarm_processing'),
            this.$t('homeLang.other')
          ]
		    },
		    calculable : true,
        grid:{
          show:false,
          left:45,
          right:30,
          // top:"8%",
          bottom:45,
        },
		    xAxis : [
		        {
		            type : 'value',
                axisLine:{
                  show:false
                },
                axisTick:{
                  show:false
                },
                axisLabel:{
                  color: '#999999',
                  fontFamily:'ArialMT',
                },
                splitLine:{
                  lineStyle:{
                    color:'#f3f3f5'
                  }
                }
		        }
		    ],
		    yAxis : [
		        {
		            type : 'category',
                axisLine:{
                  show:false
                },
                axisTick:{
                  show:false
                },
                axisLabel:{
                  color: '#999999',
                  fontFamily:'ArialMT',
                },
		            data : time&&time.length?time:[]
		        }
		    ],
		    series : [
		        {
		            name:this.$t('homeLang.daily_inspection'),
		            type:'bar',
		            stack: '总量',
                barWidth:dom.offsetHeight<270?'10':'20',
		            itemStyle : { normal: {label : {show: true, position: 'insideRight',color:'#ffffff',formatter:(obj)=>{return obj.value==0?'':obj.value}}}},
                color: {
                    type: 'linear',
                    x: 1,
                    y: 0,
                    x2: 0,
                    y2: 1,
                    colorStops: [{
                        offset: 0, color: '#4368ff' // 0% 处的颜色
                    }, {
                        offset: 1, color: '#4187ff' // 100% 处的颜色
                    }],
                    globalCoord: false // 缺省为 false
                },
		            data:obj&&obj.inspection?obj.inspection:[]
		        },
		        {
		            name:this.$t('homeLang.equipment_repair'),
		            type:'bar',
		            stack: '总量',
                barWidth:dom.offsetHeight<270?'10':'20',
		            itemStyle : { normal: {label : {show: true, position: 'insideRight',color:'#ffffff',formatter:(obj)=>{return obj.value==0?'':obj.value}}}},
                color: {
                    type: 'linear',
                    x: 1,
                    y: 0,
                    x2: 0,
                    y2: 1,
                    colorStops: [{
                        offset: 0, color: '#474c53' // 0% 处的颜色
                    }, {
                        offset: 1, color: '#2a2f37' // 100% 处的颜色
                    }],
                    globalCoord: false // 缺省为 false
                },
		            data:obj&&obj.repair?obj.repair:[]
		        },
		        {
		            name:this.$t('homeLang.regular_maintenance'),
		            type:'bar',
		            stack: '总量',
                barWidth:dom.offsetHeight<270?'10':'20',
		            itemStyle : { normal: {label : {show: true, position: 'insideRight',color:'#ffffff',formatter:(obj)=>{return obj.value==0?'':obj.value}}}},
                color: {
                    type: 'linear',
                    x: 1,
                    y: 0,
                    x2: 0,
                    y2: 1,
                    colorStops: [{
                        offset: 0, color: 'rgba(55, 186, 106, 0.97)' // 0% 处的颜色
                    }, {
                        offset: 1, color: 'rgba(103, 194, 88, 0.97)' // 100% 处的颜色
                    }],
                    globalCoord: false // 缺省为 false
                },
		            data:obj&&obj.maintenance?obj.maintenance:[]
		        },
		        {
		            name:this.$t('homeLang.troubleshooting'),
		            type:'bar',
		            stack: '总量',
                barWidth:dom.offsetHeight<270?'10':'20',
		            itemStyle : { normal: {label : {show: true, position: 'insideRight',color:'#ffffff',formatter:(obj)=>{return obj.value==0?'':obj.value}}}},
                color: {
                    type: 'linear',
                    x: 1,
                    y: 0,
                    x2: 0,
                    y2: 1,
                    colorStops: [{
                        offset: 0, color: '#fbb71e' // 0% 处的颜色
                    }, {
                        offset: 1, color: '#fdcd61' // 100% 处的颜色
                    }],
                    globalCoord: false // 缺省为 false
                },
		            data:obj&&obj.fault?obj.fault:[]
		        },
		        {
		            name:this.$t('homeLang.alarm_processing'),
		            type:'bar',
		            stack: '总量',
                barWidth:dom.offsetHeight<270?'10':'20',
		            itemStyle : { normal: {label : {show: true, position: 'insideRight',color:'#ffffff',formatter:(obj)=>{return obj.value==0?'':obj.value}}}},
                color: {
                    type: 'linear',
                    x: 1,
                    y: 0,
                    x2: 0,
                    y2: 0,
                    colorStops: [{
                        offset: 0, color: '#e24359' // 0% 处的颜色
                    }, {
                        offset: 1, color: '#f2a9a3' // 100% 处的颜色
                    }],
                    globalCoord: false // 缺省为 false
                },
		            data:obj&&obj.alarm?obj.alarm:[]
		        },
		        {
		            name:this.$t('homeLang.other'),
		            type:'bar',
		            stack: '总量',
                barWidth:dom.offsetHeight<270?'10':'20',
		            itemStyle : { normal: {label : {show: true, position: 'insideRight',color:'#ffffff',formatter:(obj)=>{return obj.value==0?'':obj.value}}}},
                color: {
                    type: 'linear',
                    x: 1,
                    y: 0,
                    x2: 0,
                    y2: 0,
                    colorStops: [{
                        offset: 0, color: '#8b9efc' // 0% 处的颜色
                    }, {
                        offset: 1, color: '#dee5ef' // 100% 处的颜色
                    }],
                    globalCoord: false // 缺省为 false
                },
		            data:obj&&obj.other?obj.other:[]
		        }
		    ]
      });
      $('div.cont-box').resize(function(){
        myChart.resize();
      });
    },
    getMapData(id){
      let self = this;
      indexApi.get_map_data((data)=>{
        if (data.code == 200) {
          // console.log(data);
          self.bdMap(data.result.data,id);
        }
      },{'group_id':'none'})
    },
    showFullScreenMap(){
      this.isFullScreen=!this.isFullScreen;
      this.getMapData("fullScreenBdMap");
    },
    bdMap(data,id){
      // 百度地图API功能
    	var map = new BMap.Map(id?id:"bdMap");    // 创建Map实例
      var geo = new BMap.Geocoder();
    	// map.centerAndZoom(new BMap.Point(113.933782,22.582649), 15);  // 初始化地图,设置中心点坐标和地图级别
    	//添加地图类型控件
    	map.addControl(new BMap.MapTypeControl({
    		mapTypes:[
                BMAP_NORMAL_MAP,
                BMAP_HYBRID_MAP
            ]}));
    	map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
      let pt;
      if (data&&data.length>0) {
        for (let i = 0; i < data.length; i++) {
          // console.log(data[i]);
          // data[i].gis = null
          if(data[i].gis == null){continue;}
          let gis = data[i].gis.split(',');
          if (gis&&gis.length>1) {
            // console.log(gis);
            pt = new BMap.Point(gis[1],gis[0]);
      		  let marker = new BMap.Marker(pt);//创建标注
            map.addOverlay(marker);
            geo.getLocation(pt,(res)=>{
              let addComp=res.addressComponents;
    					let opts={width: 310,height: 115};
    					let address=addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber;
              let imageurl = data[i].equipment_image?(config.apiq.pictureAddress+data[i].equipment_image):'./modules/pro/static/images/public/no-image-icon.gif';
    					let infoWindow = new BMap.InfoWindow(`<div class="index-bdmap-equipment" >
    						<div class="image">
    							<a><img src="${imageurl}"/></a>
    						</div>
    						<div class="bdmap-base-info flex-column">
    							<div><span class="name">${this.$t('homeLang.equipment_id')}</span><span class="value">${data[i].equipment_id}</span></div>
    							<div><span class="name">${this.$t('homeLang.equipment_name')}</span><span class="value">${data[i].equipment_name}</span></div>
    							<div><span class="name">${this.$t('homeLang.equipment_address')}</span><span class="value">${address}</span></div>
    						</div>
    					</div>`, opts);  // 创建信息窗口对象
    					marker.openInfoWindow(infoWindow);
              marker.addEventListener("click", function(){
            	   this.openInfoWindow(infoWindow);
            	   //图片加载完毕重绘infowindow
            	   // document.getElementById('imgDemo').onload = function (){
            		 //   infoWindow.redraw();   //防止在网速较慢，图片未加载时，生成的信息框高度比图片的总高度小，导致图片部分被隐藏
            	   // }
            	});
            });
          }
        }
      }
      if (!pt) {
        let geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function(r){
          if(this.getStatus() == BMAP_STATUS_SUCCESS){
            map.centerAndZoom(new BMap.Point(r.point.lng,r.point.lat), 10);
          }
          else {
            map.centerAndZoom(new BMap.Point(113.933782,22.582649), 10);
          }
        });
        return;
      }
      map.centerAndZoom(pt, 10);
      geo.getLocation(pt,(res)=>{
        // console.log(res);
        if(res){
          map.setCurrentCity(res.addressComponents.city);          // 设置地图显示的城市 此项是必须设置的
        }
      });
    },
  },
}
</script>

<style>
.index-bdmap-equipment{
	width: 310px;
	height: 115px;
	background-color: #ffffff;
	box-shadow: 2px 0px 8px 0px rgba(83, 135, 255, 0.41);
}
.index-bdmap-equipment div{
	/* display: inline-block; */
	float: left;
  line-height: 16px;
}

.index-bdmap-equipment div a{
 display: inline-block;
 width: 117px;
 height: 82px;
 background-color: #edeef2;
}
.index-bdmap-equipment div a img{
 width: 100%;
}
.index-bdmap-equipment .bdmap-base-info{
 width: 50%;
 margin-left: 10px;
}
.index-bdmap-equipment .bdmap-base-info span.name{
  font-family: MicrosoftYaHei;
	font-size: 12px;
	font-weight: normal;
	font-stretch: normal;
	line-height: 24px;
	letter-spacing: 0px;
	color: #333333;
}
.index-bdmap-equipment .bdmap-base-info span.value{
  font-family: MicrosoftYaHei;
	font-size: 12px;
	font-weight: normal;
	letter-spacing: 0px;
	color: #999999;
}
.indexPageNodata{
  margin: 100px auto;
  text-align: center;
  color:#999999;
  font-size: 16px;
}
</style>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
    @import '../../../sass/home/home.scss';
</style>
