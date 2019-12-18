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
  <div class="deviceStatus flex-column">
    <div id="dashBoardContent" class="dashBoardContent"></div>
    <div class="pageBtn flex-wrap">
      <div class="mixBtn" v-for="item in dashBoardPageLabel":key="item.key" :class="currDashBoard==item.key?'active':''" @click="changeDashBoard(item.key)">
        <span>{{item.title}}</span>
      </div>
    </div>
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
    token:String
  },
  data () {
    return {
      msg: 'Welcome to Your Vue.js App',
      dashBoardConf:null,
      currDashBoard:'',
      dashBoardPageLabel:[],
    }
  },
  mounted(){
    // console.log(this);
    this.getEquipmentStatusConfig(this.equipmentId)
  },
  methods:{
    getEquipmentStatusConfig(id){
      if (!id || !this.token) {
        return;
      }
      console.log(id);
      let self = this;
      deviceApi.get_equipment_status_conf(function(data){
        if (data.code == 200) {
          if (data.result.length==0) {
            document.getElementById('dashBoardContent').innerHTML='<div class="echarts_nodata">暂无数据</div>';
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
          mixEcharts.drawDashBoard(self.equipmentId,result,document.getElementById('dashBoardContent'),self.currDashBoard,true,this.token);
        }
      },{'equipment_id':id},this.token)
    },
    changeDashBoard(type){//设备状态分页切换
      this.currDashBoard = type;
      if (mixEcharts.jsonSocket!=null&&!this.equipmentId) {
        mixEcharts.dashBoardUnSubscribe(this.equipmentId);
      }
      if (this.dashBoardConf!=null) {
        mixEcharts.drawDashBoard(this.equipmentId,this.dashBoardConf,document.getElementById('dashBoardContent'),this.currDashBoard,false,this.token)
      }
    },
  },
  watch:{
    equipmentId:['getEquipmentStatusConfig']
  },
  destroyed(){
    // console.log('destroyed');
    if (mixEcharts.jsonSocket!=null&&this.deviceInfoData!=null) {
      mixEcharts.dashBoardUnSubscribe(equipmentId);
    }
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/singleEquipment/tab/status.scss";
</style>
