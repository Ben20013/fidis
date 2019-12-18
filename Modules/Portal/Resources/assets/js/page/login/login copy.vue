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
  <div class="login-box">
    <!-- <div class="header flex-wrap">
      <div class="logo">
        <img src="/static/images/login/logo.png" alt="">
      </div>
    </div> -->
    <div class="middle-content">
      <div class="tree-container" id="threeBackground"></div>
      <div class="login-container flex-wrap">
        <div class="content flex-wrap">
          <div class="left-content">
            <div class="logo">
              <img height="50" v-if="logoPath" :src="logoPath" alt="">
            </div>
            <div class="news-title">
              工业物联网，发现数据的价值
            </div>
            <div class="news-desc">
              设备风险识别，能耗分析，实时监控，维保提醒，生产报表...
            </div>
          </div>
          <div class="right-content" @keyup.enter="login()">
            <div class="title-wrap">
              账号登录
            </div>
            <div class="error-wrap" :class="{'hide':!isError}">
              <div class="err-tip">
                <i class="err-icon"></i>
                <span class="err-txt">{{errorTip}}</span>
              </div>
            </div>
            <div class="username-wrap" :class="{'is-error':isError}">
              <input type="text" name="username" value="" placeholder="用户账号" :class="{'active':username!=''}" v-model="username" autofocus="autofocus">
            </div>
            <div class="password-wrap">
              <input type="password" name="password" value="" placeholder="密码" :class="{'active':password!=''}" v-model="password">
            </div>
            <div class="button-wrap">
              <a class="login-btn"  @click="login()">登录</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <p class="copyright-text" v-html="copyright"></p>
    </div>
  </div>
</template>

<script>
import loginApi from '@/fetch/login';
import settingApi from '@/fetch/setting';
export default {
  name: 'login',
  data(){
    return {
      version:'V0.1.0',
      username:'',
      password:'',
      errorTip:'用户名或密码不正确',
      isError:false,
      copyright:'',
      logoPath:'',
    }
  },
  created(){
    this.password="";
    this.getAboutUs();
  },
  mounted(){

  },
  methods:{
    getAboutUs(){
      let self = this;
      settingApi.get_config(function(data){
        if (data.code == 200) {
          let result = data.result;
					if (result['common']) {
						let common = result['common'];
						document.querySelector('title').innerHTML = common['website_title']?common['website_title']:'FIDIS PRO';
						self.copyright = common['copyright']?common['copyright']:'';
						self.logoPath = common['logo_path']?common['logo_path']:'';
						if (common['icon_path']) {
              var link = document.querySelector("link[rel*='icon']") || document.createElement('link');
              link.type = 'image/x-icon';
              link.rel = 'shortcut icon';
              link.href = common['icon_path'];
              document.getElementsByTagName('head')[0].appendChild(link);
            }
					}
        } else {
          self.$message.error('获取配置：' + data.msg)
        }
      },{});
    },
    login(){
      if (this.username == '' || !this.username) {
        this.errorTip = '用户名不能为空';
        this.isError = true;
        return;
      }
      if (this.password == '' || !this.password) {
        this.errorTip = '密码不能为空';
        this.isError = true;
        return;
      }
      if (this.isError) {
        this.isError = false;
      }
      let self = this;
      loginApi.login((data)=>{
        // console.log(data);
        if (data.code == 200) {
          let result = data.result;
          localStorage.setItem('loginState',1);
          let user=JSON.stringify(result);
          localStorage.setItem('user',user);
          let query = self.$route.query;
          if (query['source']) {
            let ticket = result.ticket;
            if (query['url']) {
              window.location.href = query['url'] + '?source='+query['source'] + '&ticket='+ ticket;
            } else {
              loginApi.get_client_url((data)=>{
                if (data.code == 200) {
                  let client = data.result
                  window.location.href = client.url + '?source=' + client['client_id'] + '&ticket='+ ticket;
                } else {
                  self.$router.push("/index");
                }
              },{'client_id':query['source']})
            }
          } else {
            self.$router.push("/index");
          }
        }else{
          self.isError = true;
          self.errorTip = data.msg;
        }
      },{'username':this.username,'password':this.password,'source':'{MixPortal}'})
    },
  },
}
</script>
<style rel="stylesheet/scss" lang="scss">
  .copyright-text{
    a{
      text-decoration: underline;
      color: #4162ff;
    }
  }
</style>
<style rel="stylesheet/scss" lang="scss" scoped>
@import '../../assets/sass/login/login.scss';
</style>
