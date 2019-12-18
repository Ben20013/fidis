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
<template lang="html">
  <div class="register-box">
    <div class="header flex-wrap">
      <div class="logo">
        <img src="/static/images/login/logo.png" alt="">
      </div>
    </div>
    <div class="middle-content">
      <div class="register-container flex-wrap">
        <div class="content flex-column">
          <div class="title-wrap">注册</div>
          <div class="input-wrap flex-column">
            <div class="row flex-wrap">
              <div class="name">用户名:</div>
              <div class="value">
                <input type="text" name="username" value="" placeholder="" :class="{'active':username!=''}" v-model="username">
              </div>
            </div>
            <div class="row flex-wrap">
              <div class="name"></div>
              <div class="tip-txt">6~18个字符，可使用字母、数字、下划线，需以字母开头</div>
            </div>
            <div class="row flex-wrap">
              <div class="name">密码:</div>
              <div class="value">
                <input type="password" name="password" value="" placeholder="" :class="{'active':password!=''}" v-model="password">
              </div>
            </div>
            <div class="row flex-wrap">
              <div class="name"></div>
              <div class="tip-txt">6~18个字符，区分大小写</div>
            </div>
            <div class="row flex-wrap">
              <div class="name">确认密码:</div>
              <div class="value">
                <input type="password" name="repassword" value="" placeholder="" :class="{'active':repassword!=''}" v-model="repassword">
              </div>
            </div>
            <div class="row flex-wrap">
              <div class="name"></div>
              <div class="tip-txt">再次填写密码</div>
            </div>
            <div class="row flex-wrap">
              <div class="name">公司名称:</div>
              <div class="value">
                <input type="text" name="description" value="" placeholder="" :class="{'active':description!=''}" v-model="description">
              </div>
            </div>
            <div class="row flex-wrap mr">
              <div class="name">手机号码:</div>
              <div class="value">
                <input type="text" name="mobile" value="" placeholder="" :class="{'active':mobile!=''}" v-model="mobile">
              </div>
            </div>
            <div class="row flex-wrap mr">
              <div class="name">E-mail:</div>
              <div class="value">
                <input type="text" name="email" value="" placeholder="" :class="{'active':email!=''}" v-model="email">
              </div>
            </div>
            <div class="row flex-wrap mr">
              <div class="name"></div>
              <div class="tip-txt terms flex-wrap">
                <input type="checkbox" name="terms" v-model="checked" value="">
                <div class="txt-wrap">
                  同意<a>"服务条款"</a>和<a>"隐私相关政策"</a>
                </div>
              </div>
            </div>
            <div class="row flex-wrap mr">
              <div class="name"></div>
              <div class="value flex-wrap">
                <div class="register-btn" :class="{'disabled':!checked}" @click="register">立刻注册</div>
                <div class="back-wrap flex-wrap">
                  <router-link class="back-btn" :to="{ name: 'login', path: '/login' }">已注册，返回登录</router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>CopyRight 2014-2017 深圳市智物联网络有限公司</p>
    </div>
  </div>
</template>

<script>
import userApi from "@/assets/js/fetch/user";
import config from "$config";
import * as THREE from "three";
export default {
  name: 'register',
  data(){
    return {
      version:config.pro_version,
      username:'',
      password:'',
      repassword:'',
      description:'',
      mobile:'',
      email:'',
      errorTip:'用户名或密码不正确',
      checked:false,
    }
  },
  created(){
    this.password="";
  },
  mounted(){
    // this.initThreeBackground();
  },
  methods:{
    toast(msg,type){
  		this.$message({
        message:msg,
        type:type
      });
  	},
    register(){
      if (!this.checked) {
        return;
      }
      if (this.username == '' || !this.username || !/^[a-zA-Z]\w{5,18}$/.test(this.username)) {
        this.toast("用户名格式不正确","warning");
        return;
      }
      if (this.password == '' || !this.password || this.password.length<6 || this.password.length>18) {
        this.toast("密码长度不正确","warning");
        return;
      }
      if (this.password != this.repassword) {
        this.toast("两次输入的密码不一致","warning");
        return;
      }
      if (this.mobile == '' || !this.mobile || !/^((13[0-9])|(14[0-9])|(15[0-9])|(17[0-9])|(18[0-9]))\d{8}$/.test(this.mobile)) {
        this.toast("请输入正确的手机号码","warning");
        return;
      }
      let self = this;
      userApi.add(function(data){
        if (data.code == 200) {
          self.toast(data.msg,"success");
          self.$router.push("/login");
        }else{
          self.toast(data.msg,"error");
        }
      },{username:self.username,password:self.password,mobile:self.mobile,email:self.email,description:self.description,system:config.system})
    },
  },
}
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/register/register.scss";
</style>
