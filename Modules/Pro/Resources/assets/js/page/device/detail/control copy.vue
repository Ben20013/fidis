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
        <div class="control-block" v-for="(aprus,pindex) in codeBaseList" :key="pindex">
          <div class="title">{{aprus['aprus_id']}}({{aprus['aprus_name']}})</div>
          <div class="row flex-wrap" v-for="(item,index) in aprus['template']" :key="index">
            <div class="flex-wrap" v-if="item[7]&&(item[7].indexOf('E')!=-1||item[7].indexOf('e')!=-1)">
              <div class="name">
                {{item[2]}}：
              </div>
              <div class="button-group flex-wrap" v-if="item[5]!='$'">
                <div class="item" v-for="(citem,cindex) in item[6]" :key="cindex" @click="openControlPwdWin(pindex,index,cindex)">
                  <span class="button">{{item[6][cindex]}}</span>
                </div>
              </div>
              <div class="button-group flex-wrap" v-else>
                <div class="item">
                  <!-- <el-input-number v-model="num1" @change="handleChange" :min="1" :max="10" label="描述文字"></el-input-number> -->
                  <input :id="'control_'+aprus['aprus_id']+'_'+item[0]" type="text" class="controlVal" :placeholder="item[6]"><span class="confirm" @click="openControlPwdWin(pindex,index)">{{$t('common.btn_determine')}}</span>
                </div>
              </div>
            </div>
          </div>
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
import deviceApi from '@/fetch/device';
import collectApi from '@/fetch/collect';

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
          }
          // self.md['controlLoading'] = false;
          self.md['loading'] = false;
          return;
        } else {
          // self.md['controlLoading'] = false;
          self.md['loading'] = false;
          self.$alert(data.msg,self.$t('deviceLang.equipment_control'),{
            confirmButtonText:self.$t('el.messagebox.confirm'),
          });
        }
        
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
        this.$alert(this.$t('deviceLang.input_value_tip',[item[2]]),this.$t('deviceLang.equipment_control'),{
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
  },
  watch:{
    equipmentId:['getCollectList']
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
  @import '@/assets/sass/device/detail/control.scss';
</style>
