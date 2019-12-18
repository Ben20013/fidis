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
  <div class="header flex-wrap">
    <div class="left-header flex-wrap">
      <div class="nav-icon flex-wrap" @click="expand">
        <i :class="{'expand':isExpand,'not-expand':!isExpand}"></i>
      </div>
      <div class="time-tip flex-wrap">
        <el-breadcrumb separator="/">
          <el-breadcrumb-item v-if="this.$route.path!='/index'" :to="{ path: '/admin' }">首页</el-breadcrumb-item>
          <el-breadcrumb-item v-if="routeList.length" :to="{ path: routeList[0].path }">{{routeList[0].meta.title}}</el-breadcrumb-item>
          <el-breadcrumb-item v-if="routeList.length>1">{{navTitle?navTitle:routeList[1].meta.title}}</el-breadcrumb-item>
        </el-breadcrumb>
      </div>
    </div>
    <div class="right-header flex-wrap">
      <div class="full-screen" @click="fullScreen">
        <i class="full-screen-icon"></i>
      </div>
      <!-- <div class="help-wrap"@click="openHelpWin">
        <i class="help-icon"></i>
      </div> -->
      <div class="user-wrap flex-wrap flex-center">
        <img class="user-icon" src="/modules/portal/static/images/public/default-user-icon.png" >
      	<div class="user-name">{{user.username}}</div>
      	<!-- <div class="arrow-down"></div> -->
      </div>
      <div class="user-menu" v-show="isShowMenu" @mouseover="isShowMenu=true" @mouseleave="isShowMenu=false">
        <div class="menu-item flex-wrap" @click="isShowMenu=false;showMd('logout');">
          <span class="ic_logout"></span>
          <span>退出登录</span>
        </div>
      </div>
    </div>
    <div class="md-mask" :class="{ 'active': md.mask}"></div>
    <!-- 退出登录提示框 start -->
    <div class="md-modal-container">
      <div class="md-modal md-effect-1 confirm-logout" :class="{ 'md-show': md.logout}">
        <div class="md-content">
          <!--头部-->
          <div class="titleBox flex-wrap flex-center">
            <div class="title">退出登录</div>
            <div class="iconWrap" @click="closeMd('logout')"><i class="close"></i></div>
          </div>
          <!--内容-->
          <div class="contBox">
            <div class="logoutTip">
             	 确认要退出登录吗？
            </div>
          </div>
          <!-- 按钮 -->
          <div class="buttomBox flex-wrap flex-center">
            <input type="button"  class="btn_cancel" value="取消"  @click="closeMd('logout')"/>
            <input type="button"  class="btn_determine" value="确认" @click="logout"/>
          </div>
        </div>
      </div>
    </div>
    <!-- 退出登录提示框 end -->
  </div>
</template>

<script>
import settingApi from '@/assets/js/fetch/setting'
import config from '@/assets/js/config'

export default {
  name: 'topHeader',
  props:{
    navTitle:String,
  },
  data () {
    return {
      routeList:[],
      isExpand:false,
      isShowMenu: false,
      currLanguage:'',
      userId:"",
      user:"",
      md:{
        mask:false,
        logout:false,
      }
    }
  },
  created(){
  	  var user=localStorage.getItem('user');
  	  this.userId=JSON.parse(user).user_id;
  	  this.user=JSON.parse(user);
  },
  mounted(){
    this.updateRouteList(this.$route);
    this.currLanguage = localStorage.getItem('MIXPRO_LOCALE_LANGUAGE') || 'zh';
    // console.log(this.$route);
  },
  methods:{
    expand(){
      this.isExpand = !this.isExpand;
      this.$emit('is-expand',this.isExpand);
    },
    fullScreen(){
      if(document.documentElement.requestFullscreen) {
        document.documentElement.requestFullscreen();
      } else if(document.documentElement.mozRequestFullScreen) {
        document.documentElement.mozRequestFullScreen();
      } else if(document.documentElement.webkitRequestFullscreen) {
        document.documentElement.webkitRequestFullscreen();
      } else if(document.documentElement.msRequestFullscreen) {
        document.documentElement.msRequestFullscreen();
      }
    },
  	toast(msg,type){
  		this.$message({
          message:msg,
          type:type
        });
  	},
    openHelpWin(){
      let a = document.createElement('a');
      a.style.display = 'none';
      a.href = 'http://www.mixlinker.com/html/pingtaijiagou/';
      a.setAttribute('target','_blank');
      let event = new MouseEvent('click');
      a.dispatchEvent(event)
    },
    logout(){
      let ticket = this.user['ticket']?this.user['ticket']:'';
      let source = this.user['source']?this.user['source']:'';
      sessionStorage.setItem('MIXPORTALSTATE',0);
      let protocol = config.mixPassport_url.split('//')[0] || window.location.protocol;
      window.location.href = protocol + config.mixPassport_url + '/logout?source='+source+'&ticket=' + ticket;
    },
    showMd: function(md) {
        this.md[md] = true;
        this.md.mask = true;
    },
    closeMd: function(md) {
        this.md[md] = false;
        this.md.mask = false;
    },
    updateRouteList (data) {
      // console.log(this.routeList);
      if (data.name != 'home'&&data.name != 'index') {
        let isParent = data.meta.isParent;
        if (isParent) {
          this.routeList = [];
          this.routeList.push(data);
        } else {
          if (this.routeList.length&&this.routeList[1]) {
            this.routeList.splice(1,1);
            this.routeList.push(data);
          } else if (this.routeList.length){
            this.routeList.push(data);
          } else if (/^\/.+(\/detail)?(?:\/(?=$))?$/.test(data.path)){
            let match = data.matched;
            if (match[1]) {
              this.routeList.push(match[1]);
              if (match[2]) {
                this.routeList.push(match[2]);
              }
            }
          }
        }
      }else{
        this.routeList = [];
      }
      // console.log(data);
    }
  },
  watch:{
    '$route':'updateRouteList'
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
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
  @import '../assets/sass/components/topHeader.scss';
</style>
