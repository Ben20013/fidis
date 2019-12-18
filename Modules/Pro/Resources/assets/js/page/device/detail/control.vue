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
      <div class="control-block-wrap" id="controlDashboardContainer">
        <div class="no-data flex-column">
          <img src="/modules/pro/static/images/public/no-data-icon.png" alt="">
          <span>{{$t('common.no_data')}}</span>
        </div>
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
import mixControlCharts from '@/assets/js/control/index'
// import mixControlData from '@/assets/js/control/data.js'
import '@/assets/js/control/index.css'

export default {
  name: 'status',
  props:{
    equipmentId:Number
  },
  data () {
    return {
      controlPassword:'',
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
      controlSwitchDom: null,
      controlCommand: null,
      controlItemId: null,
      controlInputDom: null
    }
  },
  mounted(){
    // console.log(this.equipmentId);
    this.initControlDashBoardButtonEvent()

    this.getControlDashBoard()
    // mixControlCharts.drawDashBoard(this.equipmentId, mixControlData, document.getElementById('controlDashboardContainer'))
  },
  methods:{
    getControlDashBoard() {
      deviceApi.get_dashboard(data => {
        if (data.code == 200) {
          let control = JSON.parse(data.result['control'])
          if (typeof control == 'object' && !Array.isArray(control)) {
            mixControlCharts.drawDashBoard(this.equipmentId, control, document.getElementById('controlDashboardContainer'))
          }
        } else {
          this.$message.error(data.msg)
        }
      }, {'equipment_id': this.equipmentId, 'type': 'control'})
    },
    colseControlPwdWin(){
      this.closeMd('controlPwd')
      this.controlPassword = '';
      this.recoverControlSwitch()
      this.resetControlInput()
      this.controlCommand = null
      if (mixControlCharts.currentControlItem) {
        mixControlCharts.currentControlItem = ''
      }
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
      if (!this.controlCommand) {
        this.closeMd('controlPwd')
        return;
      }
      if (!this.equipmentId) {
        this.closeMd('control');
        return;
      }
      this.md['loading'] = true;
      let params = this.controlCommand
      params.command = JSON.parse(params.command);
      params.command.equipment_id = this.equipmentId;
      params.command.id = this.controlItemId;
      params.command = JSON.stringify(params.command)
      // console.log(params);
      let self = this;
      deviceApi.push_control_command(function(data){
        if (data.code == 200) {
          self.$alert(self.$t('deviceLang.control_command_success'),self.$t('deviceLang.equipment_control'),{
            confirmButtonText:self.$t('el.messagebox.confirm'),
          })
          self.controlSwitchDom = null
        } else {
          let msg = data.msg ? data.msg : data.mix_msg
          self.$alert(data.msg,self.$t('deviceLang.equipment_control'),{
            confirmButtonText:self.$t('el.messagebox.confirm'),
          })
          self.recoverControlSwitch()
        }
        self.colseControlPwdWin();
        self.resetControlInput();
        self.md['loading'] = false;
        self.controlCommand = null
      },params);
      let operation = params['command'];
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
      },{'type':6,'operation':'Pro control.', 'data': operation, 'primary_key':this.equipmentId});
    },
    toast(msg,type){
    	this.$message({message:msg, type:type});
    },
    recoverControlSwitch() {
      if (this.controlSwitchDom && this.controlSwitchDom.checked !== undefined) {
        this.controlSwitchDom.checked = !this.controlSwitchDom.checked
        this.controlSwitchDom = null
      }
    },
    resetControlInput() {
      if (this.controlInputDom) {
        this.controlInputDom.dataset.value = '';
        this.controlInputDom = null
      }
    },
    initControlDashBoardButtonEvent() {
      let self = this
      $('#controlDashboardContainer').delegate('div.mix-control_increase, div.mix-control_decrease', 'click', function(){
        let attribute = this.dataset.attribute
        let step = Number(this.dataset.step) || 1
        let $input = $('#'+ attribute +'__input')
        if (!$input.length) {
          return
        }
        let val = Number($input.val())
        $input.focus()
        if (!isNaN(val)) {
          let newVal = val + step
          $input.val(newVal)
        }
      }).delegate('div.mix-control__button', 'click', function(){
        self.showMd('controlPwd')
        let id = this.dataset.id
        let attribute = this.dataset.attribute
        let key = attribute + '__' + id
        self.controlCommand = mixControlCharts.getItemCommand(key, 'input')
        console.log(self.controlCommand)
        self.controlItemId = id;
      }).delegate('div.mix-control__btngroup_item', 'click', function(){
        self.showMd('controlPwd')
        let id = this.dataset.id
        let attribute = this.dataset.attribute
        let key = attribute + '__' + id
        self.controlCommand = mixControlCharts.getItemCommand(key, 'button')
        console.log(self.controlCommand)
        self.controlItemId = id;
      }).delegate('input.mix-control__switch_checkbox', 'change', function(){
        self.controlSwitchDom = this
        self.showMd('controlPwd')
        let key = this.id
        mixControlCharts.currentControlItem = this.dataset.id
        self.controlCommand = mixControlCharts.getItemCommand(key, 'switch')
        console.log(self.controlCommand)
        self.controlItemId = this.dataset.id;
      }).delegate('.mix-control_input>input', 'focus', function(){
        this.dataset.isEdit = 1
        self.controlInputDom = this
      }).delegate('.mix-control_input>input', 'blur', function(){
        this.dataset.isEdit = 0
      }).delegate('.mix-control_input>input', 'input', function(){
        this.value = this.value.replace(/[^\-?\d.]/g,'')
        this.dataset.value = this.value
      })
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
  },
  beforeDestroy(){
    if (mixControlCharts.jsonSocket!=null) {
      mixControlCharts.dashBoardUnSubscribe(this.equipmentId);
      mixControlCharts.socketConnectCount = 10;
      mixControlCharts.isDestroyed = true;
      mixControlCharts.jsonSocket=null;
      console.log('dashBoardUnSubscribe:'+this.equipmentId);
    }
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/device/detail/control.scss";
</style>
