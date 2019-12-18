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
  <div class="main-box flex-column" :style="mainBoxStyle">
    <div class="content flex-wrap">
      <div class="content__banner flex-wrap" :style="bannerStyle">
        <div class="logo-box">
          <img class="logo" v-if="logoPath" :src="logoPath" />
        </div>
        <div class="text-box">
          <div v-if="adTitle" class="title">{{adTitle}}</div>
          <div v-else class="title">欢迎使用智物联工业物联网平台</div>
          <p v-if="adSlogan" class="summary">{{adSlogan}}</p>
          <p v-else class="summary">降低能耗、提升效率、减低成本、提升产值方面助力，引领工业4.0</p>
        </div>
      </div>
      <div class="content__login flex-column" @keyup.enter="login()">
        <div class="login-title">
          <div class="title">LOGIN</div>
          <div class="icon"></div>
        </div>
        <div class="login-content">
          <div class="input-item">
            <div class="name">账号：</div>
            <div class="input">
              <input v-model="username" type="text" name="account" placeholder="请输入您的用户名">
            </div>
          </div>
          <div class="input-item">
            <div class="name">密码：</div>
            <div class="input">
              <input v-model="password" type="password" name="password" placeholder="请输入您的密码">
            </div>
          </div>
        </div>
        <div class="login-button flex-wrap">
          <div class="login-btn" @click="login">
            <span>立即登录</span>
          </div>
        </div>
      </div>
    </div>
    <div class="footer flex-column">
      <p class="copy-right" v-html="copyright">CopyRight 2014-2017 深圳市智物联网络有限公司   版权所有</p>
    </div>
  </div>
</template>

<script>
import loginApi from '@/assets/js/fetch/login';
import settingApi from '@/assets/js/fetch/setting';
export default {
  name: 'login',
  data(){
    return {
      username:'',
      password:'',
      copyright:'',
      logoPath:'',
      adTitle: '',
			adSlogan: '',
			theme: 1,
			backgroundImagePath: '',
			bannerImagePath: '',
    }
  },
  computed: {
    bannerStyle(){
      if (!this.bannerImagePath) {
        return {}
      }
      return {'background-image': 'url('+ this.bannerImagePath +')'}
    },
    mainBoxStyle(){
      if (!this.backgroundImagePath) {
        return {}
      }
      return {'background-image': 'url('+ this.backgroundImagePath +')'}
    }
  },
  created(){
    this.password="";
    this.getAboutUs();
  },
  mounted(){
    this.setTheme()
  },
  methods:{
    setTheme(){
      let app = document.getElementById('app')
      let theme = sessionStorage.getItem('MIXPORTALTHEME')
      app.className = theme == 1 ? 'mix-theme-dark' : 'mix-theme-bright'
    },
    getAboutUs(){
      let self = this;
      settingApi.get_config((data) => {
        if (data.code == 200) {
          let result = data.result;
					if (result['common']) {
						let common = result['common'];
						document.querySelector('title').innerHTML = common['website_title']?common['website_title']:'FIDIS PRO';
						this.copyright = common['copyright']?common['copyright']:'';
						this.logoPath = common['logo_path']?common['logo_path']:'';
						if (common['icon_path']) {
              var link = document.querySelector("link[rel*='icon']") || document.createElement('link');
              link.type = 'image/x-icon';
              link.rel = 'shortcut icon';
              link.href = common['icon_path'];
              document.getElementsByTagName('head')[0].appendChild(link);
            }
            this.adTitle = common['ad_title'] ? common['ad_title'] : ''
            this.adSlogan = common['ad_slogan'] ? common['ad_slogan'] : ''
            let theme = common['mix_theme'] ? common['mix_theme'] : 1
            document.querySelector('div#app').className = theme == 1 ? 'mix-theme-dark' : 'mix-theme-bright'
						sessionStorage.setItem('MIXPORTALTHEME', theme)
            this.bannerImagePath = common['banner_image_path'] ? common['banner_image_path'] : ''
            this.backgroundImagePath = common['background_image_path'] ? common['background_image_path'] : ''
					}
        } else {
          this.$message.error('获取配置：' + data.msg)
        }
      },{});
    },
    login(){
      if (this.username == '' || !this.username) {
        this.$message.error('用户名不能为空')
        return;
      }
      if (this.password == '' || !this.password) {
        this.$message.error('密码不能为空')
        return;
      }
      // let self = this;
      loginApi.login((data)=>{
        // console.log(data);
        if (data.code == 200) {
          let result = data.result;
          localStorage.setItem('loginState',1);
          let user=JSON.stringify(result);
          localStorage.setItem('user',user);
          let query = this.$route.query;
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
                  this.$router.push("/index");
                }
              },{'client_id':query['source']})
            }
          } else {
            this.$router.push("/index");
          }
        }else{
          this.$message.error(data.msg)
        }
      },{'username':this.username,'password':this.password,'source':'{MixPortal}'})
    },
  },
}
</script>
<style rel="stylesheet/scss" lang="scss">
  .copy-right{
    a{
      text-decoration: underline;
      color: #959eb4;
    }
  }
</style>
<style rel="stylesheet/scss" lang="scss" scoped>
  @import '@/assets/theme/bright/login.scss';
  @import '@/assets/theme/dark/login.scss';
</style>
