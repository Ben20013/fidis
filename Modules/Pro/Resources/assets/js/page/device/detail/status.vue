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
  <div class="status-content-wrap flex-column">
    <div id="dashBoardContent" class="content">
      <div class="no-data flex-column" v-if="!dashBoardConf">
        <img src="/modules/pro/static/images/public/no-data-icon.png" alt="">
        <span>{{$t('common.no_data')}}</span>
      </div>
    </div>
    <div class="page-btn flex-wrap">
      <div class="mix-btn" v-for="item in dashBoardPageLabel" :key="item.key" :class="currDashBoard==item.key?'active':''" @click="changeDashBoard(item.key)">
        <span>{{item.title}}</span>
      </div>
      <!-- <div class="mix-btn active"><span>设备监控</span></div> -->
    </div>
    <div class="md-loading" :class="{ 'active': md.loading}"><i class="el-icon-loading md-loading-icon"></i></div>
  </div>
</template>

<script>
import deviceApi from "@/assets/js/fetch/device";
import mixEcharts from "@/assets/js/echarts/mixEcharts";
import "@/assets/js/echarts/echarts.css";

export default {
  name: 'status',
  props:{
    equipmentId:Number,
  },
  data () {
    return {
      msg: 'Welcome to Your Vue.js App',
      dashBoardConf:null,
      currDashBoard:'',
      dashBoardPageLabel:[],
      // 弹窗控制
      md:{
      	mask:false,
      	loading:false,
      },
    }
  },
  mounted(){
    this.getEquipmentStatusConfig(this.equipmentId)
  },
  methods:{
    getEquipmentStatusConfig(id){
      if (!this.equipmentId) {
        return;
      }
      let self = this;
      self.md['loading'] = true;
      deviceApi.get_equipment_status_conf(function(data){
        if (data.code == 200) {
          if (data.result.length==0) {
            self.md['loading'] = false;
            // document.getElementById('dashBoardContent').innerHTML='<div class="echarts_nodata">暂无数据</div>';
            return false;
          }
          let infoStr = data.result;
          let result = JSON.parse(infoStr.replace(/\r|\n|\r\n|\s|↵/g,""));
          self.dashBoardConf = result;
          for (var k in result) {
            if (result.hasOwnProperty(k)) {
              self.dashBoardPageLabel.push({key:k,title:result[k]['name']});//title
            }
          }
          self.currDashBoard = self.dashBoardPageLabel[0].key;
          mixEcharts.drawDashBoard(self.equipmentId,result,document.getElementById('dashBoardContent'),self.currDashBoard,true);
        }
        self.md['loading'] = false;
      },{'equipment_id':this.equipmentId})
    },
    changeDashBoard(type){//设备状态分页切换
      this.currDashBoard = type;
      if (mixEcharts.jsonSocket!=null&&!this.equipmentId) {
        mixEcharts.dashBoardUnSubscribe(this.equipmentId);
      }
      if (this.dashBoardConf!=null) {
        mixEcharts.drawDashBoard(this.equipmentId,this.dashBoardConf,document.getElementById('dashBoardContent'),this.currDashBoard,false)
      }
    },
  },
  watch:{
    equipmentId:['getEquipmentStatusConfig']
  },
  beforeDestroy(){
    if (mixEcharts.jsonSocket!=null) {
      mixEcharts.dashBoardUnSubscribe(this.equipmentId);
      mixEcharts.socketConnectCount = 10;
      mixEcharts.isDestroyed = true;
      mixEcharts.jsonSocket=null;
      if (mixEcharts.getEquipmentStatusTimer) {
        clearTimeout(mixEcharts.getEquipmentStatusTimer);
        mixEcharts.getEquipmentStatusTimer = null;
      }
      if (mixEcharts.videoCache.length) {
        for (var i = 0; i < mixEcharts.videoCache.length; i++) {
          if (mixEcharts.videoCache[i].stop) {
            try {
              mixEcharts.videoCache[i].stop();
            } catch (e) {
              console.log(e);
            }
          }
        }
        mixEcharts.videoCache = [];
      }
      console.log('dashBoardUnSubscribe:'+this.equipmentId);
    }
  },
  destroyed(){
    // console.log('destroyed');
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/device/detail/status.scss";
</style>
