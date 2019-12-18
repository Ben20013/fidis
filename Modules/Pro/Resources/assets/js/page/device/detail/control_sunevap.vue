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
      <div class="control-block-wrap" v-if="codeBaseList.length">
        <div class="control-block" v-for="(aprus,pindex) in codeBaseList">
          <div class="title">{{aprus['aprus_id']}}({{aprus['aprus_name']}})</div>
          <!-- <div class="row flex-wrap" v-for="(item,index) in aprus['template']" v-if="item[7]&&(item[7].indexOf('E')!=-1||item[7].indexOf('e')!=-1)"> -->
            <!-- <div class="name">
              {{item[2]}}：
            </div>
            <div class="button-group flex-wrap" v-if="item[5]!='$'">
              <div class="item" v-for="(citem,cindex) in item[6]" @click="openControlPwdWin(pindex,index,cindex)">
                <span class="button">{{item[6][cindex]}}</span>
              </div>
            </div>
            <div class="button-group flex-wrap" v-else>
              <div class="item">
                <!-- <el-input-number v-model="num1" @change="handleChange" :min="-9999999" :max="9999999" label="描述文字"></el-input-number> -->
                <!-- <input :id="'control_'+aprus['aprus_id']+'_'+item[0]" type="text" class="controlVal" :placeholder="item[6]"><span class="confirm" @click="openControlPwdWin(pindex,index)">{{$t('common.btn_determine')}}</span>
              </div>
            </div> -->
            <el-row>
              <el-col :span="4">
                <div class="row flex-wrap" v-for="(item,index) in switchItems" v-if="item[7]&&(item[7].indexOf('E')!=-1||item[7].indexOf('e')!=-1)" style="background: #e3e3e3;margin-top: 5px;">
                  <div class="name" style="font-size: 14px;font-weight: bold;width: 200px;margin: 15px 0px;">
                    {{item[2]}}：
                  </div>
                  <div class="button-group flex-wrap" >
                    <!-- <div class="item" v-for="(citem,cindex) in item[6]" @click="openControlPwdWin(pindex,index,cindex)">
                      <span class="button">{{item[6][cindex]}}</span>
                    </div> -->
                    <el-switch
                        @change="openSwitchControlPwdWin($event, pindex,index)"
                        v-model="mosaic[item[4]]"
                        inactive-text="关"
                        active-text="开"
                        active-color="#3E9323"
                        inactive-color="#DC352A"
                        :width=55>
                    </el-switch>
                  </div>
                </div>
              </el-col>
              <el-col :span="5">
                <div class="row flex-wrap" v-for="(item,index) in vauleItems" v-if="item[7]&&(item[7].indexOf('E')!=-1||item[7].indexOf('e')!=-1)&&index<(Math.ceil(vauleItems.length/4)*1)" style="margin-top: 5px;">
                  <!-- <div class="name" >
                    {{item[2]}}：
                  </div>
                  <div class="button-group flex-wrap" >
                    <div class="item">
                      <input :id="'control_'+aprus['aprus_id']+'_'+item[0]" type="text" class="controlVal" :placeholder="item[6]"><span class="confirm" @click="openControlPwdWin(pindex,index)">{{$t('common.btn_determine')}}</span>
                    </div>
                  </div> -->
                  <el-card v-if="item[5]=='$'" class="box-card" shadow="never">
                      <div slot="header" class="clearfix">
                          <span>{{item[2]}}</span>
                      </div>
                      <div class="text item">
                          <el-row>
                              <el-col :span="24">
                                  <el-input-number :id="'control_'+aprus['aprus_id']+'_'+item[0]" v-model="mosaic[item[4]]" ></el-input-number>
                              </el-col>
                          </el-row>
                          <el-row>
                              <el-col :span="24">
                                  <el-button type="primary" size="small" @click="openControlPwdWin(pindex,index)" style="background: #409eff;border-color: #409eff;">发送控制</el-button>
                              </el-col>
                          </el-row>
                      </div>
                  </el-card>
                </div>
              </el-col>
              <el-col :span="5">
                <div class="row flex-wrap" v-for="(item,index) in vauleItems" v-if="item[7]&&(item[7].indexOf('E')!=-1||item[7].indexOf('e')!=-1)&&index<(Math.ceil(vauleItems.length/4)*2)&&index>=(Math.ceil(vauleItems.length/4)*1)"  style="margin-top: 5px;">
                  <el-card v-if="item[5]=='$'" class="box-card" shadow="never">
                      <div slot="header" class="clearfix">
                          <span>{{item[2]}}</span>
                      </div>
                      <div class="text item">
                          <el-row>
                              <el-col :span="24">
                                  <el-input-number :id="'control_'+aprus['aprus_id']+'_'+item[0]" v-model="mosaic[item[4]]" :min="-9999999" :max="9999999"></el-input-number>
                              </el-col>
                          </el-row>
                          <el-row>
                              <el-col :span="24">
                                  <el-button type="primary" size="small" @click="openControlPwdWin(pindex,index)" style="background: #409eff;border-color: #409eff;">发送控制</el-button>
                              </el-col>
                          </el-row>
                      </div>
                  </el-card>
                </div>
              </el-col>
              <el-col :span="5">
                <div class="row flex-wrap" v-for="(item,index) in vauleItems" v-if="item[7]&&(item[7].indexOf('E')!=-1||item[7].indexOf('e')!=-1)&&index<(Math.ceil(vauleItems.length/4)*3)&&index>=(Math.ceil(vauleItems.length/4)*2)"  style="margin-top: 5px;">
                  <el-card v-if="item[5]=='$'" class="box-card" shadow="never">
                      <div slot="header" class="clearfix">
                          <span>{{item[2]}}</span>
                      </div>
                      <div class="text item">
                          <el-row>
                              <el-col :span="24">
                                  <el-input-number :id="'control_'+aprus['aprus_id']+'_'+item[0]" v-model="mosaic[item[4]]" :min="-9999999" :max="9999999"></el-input-number>
                              </el-col>
                          </el-row>
                          <el-row>
                              <el-col :span="24">
                                  <el-button type="primary" size="small" @click="openControlPwdWin(pindex,index)" style="background: #409eff;border-color: #409eff;">发送控制</el-button>
                              </el-col>
                          </el-row>
                      </div>
                  </el-card>
                </div>
              </el-col>
              <el-col :span="5">
                <div class="row flex-wrap" v-for="(item,index) in vauleItems" v-if="item[7]&&(item[7].indexOf('E')!=-1||item[7].indexOf('e')!=-1)&&index>=(Math.ceil(vauleItems.length/4)*3)"  style="margin-top: 5px;">
                  <el-card v-if="item[5]=='$'" class="box-card" shadow="never">
                      <div slot="header" class="clearfix">
                          <span>{{item[2]}}</span>
                      </div>
                      <div class="text item">
                          <el-row>
                              <el-col :span="24">
                                  <el-input-number :id="'control_'+aprus['aprus_id']+'_'+item[0]" v-model="mosaic[item[4]]" :min="-9999999" :max="9999999"></el-input-number>
                              </el-col>
                          </el-row>
                          <el-row>
                              <el-col :span="24">
                                  <el-button type="primary" size="small" @click="openControlPwdWin(pindex,index)" style="background: #409eff;border-color: #409eff;">发送控制</el-button>
                              </el-col>
                          </el-row>
                      </div>
                  </el-card>
                </div>
              </el-col>
            </el-row>
            <!-- <el-card v-if="item[5]=='$'" class="box-card" shadow="never">
                <div slot="header" class="clearfix">
                    <span>{{item[2]}}</span>
                </div>
                <div class="text item">
                    <el-row type="flex" justify="center">
                        <el-col :span="24" style="font-size: 30px;font-weight: bold;">
                            120
                        </el-col>
                    </el-row>
                    <el-row>
                        <el-col :span="24">
                            <el-input-number v-model="num" :min="-9999999" :max="9999999" label="描述文字"></el-input-number>
                        </el-col>
                    </el-row>
                    <el-row>
                        <el-col :span="24">
                            <el-button type="primary">发送控制</el-button>
                        </el-col>
                    </el-row>
                </div>
            </el-card>
            <div v-else class="block" style="background: #E3E3E3; padding: 10px; border: 1px #e3e3e3 solid;">
              <el-row type="flex" class="row-bg" justify="space-between">
                <el-col :span="14"><span class="demonstration">{{item[2]}}</span></el-col>
                <el-col :span="10">
                  <el-switch
                    v-model="value1"
                    inactive-text="关"
                    active-text="开"
                    inactive-color="#9F9F9F"
                    :width=50
                    name="test">
                  </el-switch>
                </el-col>
              </el-row>


            </div> -->
          <!-- </div> -->
        </div>
      </div>
      <div class="no-data flex-column" v-else>
        <img src="/modules/pro/static/images/public/no-data-icon.png" alt="">
        <span>{{$t('common.no_data')}}</span>
      </div>
    </div>
    <div class="md-mask" :class="{ 'active': md.mask}"></div>
    <div class="md-loading" :class="{ 'active': md.loading}"><i class="el-icon-loading md-loading-icon"></i></div>
    <!-- 输入控制密码提示框 start -->
    <div class="md-modal-container">
      <div class="md-modal md-effect-1 control-passwd-win" :class="{ 'md-show': md.controlPwd}">
        <div class="md-content">
          <!--头部-->
          <div class="titleBox flex-wrap flex-center">
            <div class="title">{{$t('deviceLang.control_password_tip')}}</div>
            <div class="iconWrap" @click="colseControlPwdWin"><i class="close"></i></div>
          </div>
          <!--内容-->
          <div class="contBox">
            <div class="input-control-passwd">
              <el-input type="password" v-model="controlPassword" :placeholder="$t('deviceLang.control_password_tip')"></el-input>
            </div>
          </div>
          <!-- 按钮 -->
          <div class="buttomBox flex-wrap flex-center">
            <input type="button"  class="btn_cancel" :value="$t('common.btn_cancel')"  @click="colseControlPwdWin"/>
            <input type="button"  class="btn_determine" :value="$t('common.btn_determine')" @click="checkControlPwd"/>
          </div>
        </div>
      </div>
    </div>
    <!-- 输入控制密码提示框 end -->
    <!-- 修改密码-->
		<div class="md-modal-container">
			<div class="md-modal md-effect-1 modify-pwd-win"  :class="{ 'md-show': md.modifypwd}">
				<div class="md-content">
					<!--头部-->
					<div class="titleBox flex-wrap flex-center">
						<div class="title">{{$t('deviceLang.modify_pwd')}}</div>
						<div class="iconWrap" @click="closeMd('modifypwd')"><i class="close"></i></div>
					</div>
					<div class="contentBox">
            <div class="flex-column">
              <div class="info-row">
                <div class="name">{{$t('deviceLang.old_pwd')}}</div>
                <div class="value">
                  <el-input type="password" v-model="oldpassword" class="mix-input" auto-complete="new-password" :class="{'mix-active-input':oldpassword!=''}" :placeholder="$t('deviceLang.please_input_old_pwd')"></el-input>
                </div>
              </div>
              <div class="info-row">
                <div class="name">{{$t('deviceLang.new_pwd')}}</div>
                <div class="value">
                  <el-input type="password" v-model="newpassword" class="mix-input" auto-complete="new-password" :class="{'mix-active-input':newpassword!=''}" :placeholder="$t('deviceLang.please_input_new_pwd')"></el-input>
                </div>
              </div>
              <div class="info-row">
                <div class="name">{{$t('deviceLang.confirm_new_pwd')}}</div>
                <div class="value">
                  <el-input type="password" v-model="confirmnewpassword" class="mix-input" auto-complete="new-password" :class="{'mix-active-input':confirmnewpassword!=''}" :placeholder="$t('deviceLang.please_input_new_pwd_once_more')"></el-input>
                </div>
              </div>
            </div>
					</div>
					<div class="buttomBox flex-wrap flex-center">
						<input type="button"  class="btn_cancel" :value="$t('common.btn_cancel')"  @click="closeMd('modifypwd')"/>
						<input type="button"  class="btn_determine" :value="$t('common.btn_determine')" @click="submitModifyPwd"/>
					</div>
				</div>
			</div>
		</div>
  </div>
  <!-- 采集 end -->
</template>

<script>
import deviceApi from "@/assets/js/fetch/device";
import collectApi from "@/assets/js/fetch/collect";
import echarts from 'echarts'
import Vue from 'vue'
Vue.prototype.$echarts = echarts

export default {
  name: 'status',
  props:{
    equipmentId:Number
  },
  data () {
    return {
      codeBaseList:[],
      controlPitemIndex:null,
      controlItemIndex:null,
      controlCitemIndex:null,
      controlPassword:'',
      controlpasswdTip:'',
      oldpassword:'',
      newpassword:'',
      confirmnewpassword:'',
      // 弹窗控制
      md:{
      	mask:false,
      	loading:false,
      	controlPwd:false,
      	modifypwd:false,
      },
      switchItems: [],
      vauleItems: [],
      value1: true,
      num: 0,
      mosaic: {}
    }
  },
  mounted(){
    // console.log(this.equipmentId);
    this.getCodeBaseList(this.equipmentId);
  },
  methods:{
    getCodeBaseList(id){
      if (!this.equipmentId) {
        return;
      }
      this.codeBaseList=[];
      let self = this;
      self.md['loading'] = true;
      deviceApi.get_control_conf(function(data){
        if (data.code == 200) {
          // console.log(data);
          if (data.result.length == 0) {
            self.md['loading'] = false;
            return;
          }
          self.codeBaseList = data.result;
          for (var i = 0; i < self.codeBaseList.length; i++) {
            let templateArr = self.codeBaseList[i]['template'];
            if (!templateArr || !Array.isArray(templateArr)) {
              continue;
            }
            for (var j = 0; j < templateArr.length; j++) {
              if(templateArr[j][5]=="$"){
                self.vauleItems.push(templateArr[j]);
              }else{
                self.switchItems.push(templateArr[j]);
              }
              if (templateArr[j][5] == '$') {
                continue;
              }
              if (templateArr[j][5].indexOf('|') == -1) {
                templateArr[j][5] = [templateArr[j][5]];
                templateArr[j][6] = [templateArr[j][6]];
              } else {
                templateArr[j][5] = templateArr[j][5].split('|');
                templateArr[j][6] = templateArr[j][6].split('|');
              }
            }
            self.codeBaseList[i]['template'] = templateArr;
            self.mosaic=data.result[i].mosaic;
          }
          console.log('mosaic', self.mosaic);
          // self.md['controlLoading'] = false;
          self.md['loading'] = false;
          return;
        }
        // self.md['controlLoading'] = false;
        self.md['loading'] = false;
        self.$alert(data.msg,self.$t('deviceLang.equipment_control'),{
          confirmButtonText:self.$t('el.messagebox.confirm'),
        });
      },{'equipment_id':this.equipmentId});
    },
    openControlPwdWin(pindex,index,cindex){
      let item = this.codeBaseList[pindex]['template'][index];
      // console.log(item);
      this.controlpasswdTip = item[2];
      this.controlPitemIndex = pindex;
      this.controlItemIndex = index;
      this.controlCitemIndex = typeof item[5] != 'string'&&cindex!=undefined?cindex:null;
      this.showMd('controlPwd');
      // this.sendControlCommand();
    },
    openSwitchControlPwdWin(val, pindex,index){console.log(val);
      let item = this.codeBaseList[pindex]['template'][index];
      // console.log(item);
      this.controlpasswdTip = item[2];
      this.controlPitemIndex = pindex;
      this.controlItemIndex = index;
      this.controlCitemIndex = typeof item[5] != 'string'&&cindex!=undefined?cindex:null;
      this.showMd('controlPwd');
      // this.sendControlCommand();
    },
    colseControlPwdWin(){
      this.closeMd('controlPwd')
      this.controlpasswdTip = '';
      this.controlPassword = '';
      this.controlPitemIndex = null;
      this.controlItemIndex = null;
      this.controlCitemIndex = null;
    },
    checkControlPwd(){
      let self = this;
      deviceApi.check_control_auth(function(data){
        if (data.code == 200) {
          self.sendControlCommand();
        } else {
          self.toast(data.msg,'error');
        }
      },{'equipment_id':this.equipmentId,'auth_code':this.controlPassword})
    },
    sendControlCommand(){
      if (this.controlPitemIndex==null || this.controlItemIndex==null) {
        this.closeMd('controlPwd')
        return;
      }
      let pitem = this.codeBaseList[this.controlPitemIndex];
      let item = pitem['template'][this.controlItemIndex];
      let inputDom = document.getElementById('control_'+pitem['aprus_id']+'_'+item[0]);
      let val = this.controlCitemIndex != null?item[5][this.controlCitemIndex]:(inputDom!=null?inputDom.value:'');
      if (inputDom && val =='') {
        this.$alert(this.$t('deviceLang.input_value_tip',[item[2]]),self.$t('deviceLang.equipment_control'),{
          confirmButtonText:this.$t('el.messagebox.confirm'),
          callback:this.colseControlPwdWin,
        });
        return;
      }
      // console.log('执行提交程序');
      if (!this.equipmentId) {
        this.closeMd('control');
        return;
      }
      this.md['loading'] = true;
      let command = {"equipment_id":this.equipmentId,"aprus_id":pitem['aprus_id'],"param":"[\""+item[0]+"\",\""+val+"\"]","platform":"P"};
      let params = {
        "i_type": "equipment",
      	"command": JSON.stringify(command)
      };
      // console.log(params);
      let self = this;
      deviceApi.push_control_command(function(data){
        if (data.code == 200) {
          self.$alert(self.$t('deviceLang.control_command_success'),self.$t('deviceLang.equipment_control'),{
            confirmButtonText:self.$t('el.messagebox.confirm'),
          })
        } else {
          self.$alert(data.msg,self.$t('deviceLang.equipment_control'),{
            confirmButtonText:self.$t('el.messagebox.confirm'),
          })
        }
        self.colseControlPwdWin();
        self.md['loading'] = false;
      },params);
      let operation = item[2] + ':' + val;
      this.addLog(operation);
    },
    openModifyPwdWin(){
      this.oldpassword = '';
      this.newpassword = '';
      this.confirmnewpassword = '';
      this.showMd('modifypwd');
    },
    submitModifyPwd(){
      if (this.oldpassword == '') {
        this.toast(this.$t('deviceLang.old_pwd_not_null'),'error');
        return;
      }
      if (this.newpassword == '') {
        this.toast(this.$t('deviceLang.new_pwd_not_null'),'error');
        return;
      }
      if (this.newpassword != this.confirmnewpassword) {
        this.toast(this.$t('deviceLang.twice_pwd_not_same'),'error');
        return;
      }
      let self = this;
      deviceApi.reset_control_auth(function(data){
        if (data.code == 200) {
          self.closeMd('modifypwd');
          self.toast(self.$t('deviceLang.modify_pwd_success'),'success');
        } else {
          self.toast(data.msg,'error');
        }
      },{'equipment_id':this.equipmentId,'old_code':this.oldpassword,'new_code':this.newpassword})
    },
    addLog(operation){
      deviceApi.log_add(function(data){
        if (data.code == 200) {
          console.log('add log success');
        }
      },{'type':6,'operation':operation,'primary_key':this.equipmentId});
    },
    toast(msg,type){
    	this.$message({message:msg, type:type});
    },
    // 弹框事件开关
    showMd(md) {
      this.md[md] = true;
      this.md.mask = true;
    },
    closeMd(md) {
      this.md[md] = false
      this.md.mask = false
    },
    drawPieItem(id){
        console.log('id', id);
        // 基于准备好的dom，初始化echarts实例
        let myChart = this.$echarts.init(document.getElementById(id))
        // 绘制图表
        myChart.setOption({
            title: { text: '在Vue中使用echarts' },
            tooltip: {},
            xAxis: {
                data: ["衬衫","羊毛衫","雪纺衫","裤子","高跟鞋","袜子"]
            },
            yAxis: {},
            series: [{
                name: '销量',
                type: 'bar',
                data: [5, 20, 36, 10, 10, 20]
            }]
        });
    },
    test (val) {
        console.log(val)
    }
  },
  watch:{
    equipmentId:['getCollectList']
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/device/detail/control.scss";
</style>
<style>
.el-switch__label--left{
  position: relative;
  left: 50px;
  color: #fff;
  z-index: -1111;
}
.el-switch__label--right{
  position: relative;
  right: 50px;
  color: #fff;
  z-index: -1111;
}
.el-switch__label.is-active{
  z-index: 1111;
  color: #fff;
}
.el-switch__label--left{
  position: relative;
  left: 50px;
  color: #fff;
  z-index: -1111;
}
.el-switch__label--right{
  position: relative;
  right: 50px;
  color: #fff;
  z-index: -1111;
}
.el-switch__label--right.is-active{
  z-index: 1111;
  color: #fff !important;
}
.el-switch__label--left.is-active{
  z-index: 1111;
  color: #fff !important;
}
.box-card {
    width: 100%;
    border-radius: 0px;
    border: 1px solid #e3e3e3;
}
.el-card{
  font-size: 14px;
  font-weight: bold;
  margin: 0px 5px;
}
.el-card__header {
    padding: 14px 20px;
    height: 42px;
    background: #e3e3e3;
}
.el-card__body {
    padding: 5px;
}
.pie-item {
    width:100px;
    height:100px;
    background-color:transparent;
    border:4px solid #409eff;
    border-radius:60px;
    margin-top:20px;
}
.el-col-24 {
    text-align: center;
    margin: 2px;
}
.el-row {
    width: 100%;
}
.name {
    font-size: 13px;
    font-weight: bold;
}
.el-input__inner {
    font-size: 18px;
    font-weight: bold;
}
.el-button--small {
    padding: 9px 40px;
    background: #409eff;
    border-color: #409eff;
}
.el-switch__core {
    height: 24px;
    border-radius: 13px;
}
.el-switch.is-checked .el-switch__core::after {
    left: 100%;
    margin-left: -20px;
}
.el-switch__core:after {
    content: "";
    position: absolute;
    top: 1px;
    left: 1px;
    border-radius: 100%;
    -webkit-transition: all .3s;
    transition: all .3s;
    width: 20px;
    height: 20px;
    background-color: #fff;
}
</style>
