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
  <div class="main-box flex-column">
    <div class="header flex-wrap">
    	<div class="header-text" v-if="aboutInfoData != null&&aboutInfoData.product_name">{{aboutInfoData.product_name}}</div>
    	<div class="header-text" v-else>智物联工业数据云平台</div>
      <div class="header-user flex-wrap flex-center" :class="{'active':isShowMenu}" @mouseover="isShowMenu=true" @mouseleave="isShowMenu=false">
        <img class="user-icon" src="/modules/portal/static/images/public/default-user-icon.png" >
      	<div class="user-name">{{user.username}}</div>
      	<div class="arrow-down"></div>
      </div>
      <div class="user-menu" v-show="isShowMenu" @mouseover="isShowMenu=true" @mouseleave="isShowMenu=false">
        <div class="menu-item flex-wrap" @click="isShowMenu=false;openUserInfoWin()">
          <span class="ic_user"></span>
          <span>账户信息</span>
        </div>
        <div class="menu-item flex-wrap" @click="isShowMenu=false;openModifyPwdWin()">
          <span class="ic_password"></span>
          <span>修改密码</span>
        </div>
        <div class="menu-item flex-wrap" @click="isShowMenu=false;showMd('versioninfo')">
          <span class="ic_version"></span>
          <span>版本信息</span>
        </div>
        <div class="menu-item flex-wrap" @click="isShowMenu=false;showMd('logout');">
          <span class="ic_logout"></span>
          <span>退出登录</span>
        </div>
      </div>
    </div>
  	<div class="content flex-con-1 flex-column">
	    <div class="flex-wrap flex-con-1">
        <div class="left flex-wrap flex-con-1">
          <div v-if="appPageList.length>1" class="left-btn flex-wrap" :class="{'disabled':appPageIndex==0}" @click="togglePage(-1)"><i class="left"></i></div>
        </div>
        <div class="menu-box flex-wrap">
          <div class="menu flex-column flex-center flex-pack-center" v-for="(item,index) in appPageList[appPageIndex]" :class="{'mt0':index<4,'ml0':index%4==0}" @click="openApp(item.url,item.client_id)">
          	<div class="menu-logo">
              <img v-if="item.logo" :src="item.logo" :alt="item.client_name">
              <img v-else src="/static/images/index/menuIcon1.png" :alt="item.client_name">
            </div>
          	<div class="menu-text">{{item.client_name}}</div>
          </div>
        </div>
        <div class="right flex-wrap flex-con-1">
          <div v-if="appPageList.length>1" class="right-btn flex-wrap" :class="{'disabled':appPageIndex==(appPageList.length-1)}" @click="togglePage(1)"><i class="right"></i></div>
        </div>
	    </div>
      <div class="page-label flex-wrap" v-if="appPageList.length>1">
        <div class="label" v-for="(item,index) in appPageList" :class="{'active':index==appPageIndex}"></div>
      </div>
	    <div class="footer">
        <p class="copyright-text" v-if="aboutInfoData != null&&aboutInfoData.copyright" v-html="aboutInfoData.copyright"></p>
        <p class="copyright-text" v-else>CopyRight 2014-2018 深圳市智物联网络有限公司 版权所有</p>
      </div>
  	</div>
    <div class="md-mask" :class="{ 'active': md.mask}"></div>
    <!--账户信息-->
    <div class="md-modal-container">
      <div class="md-modal md-effect-1 user-info-win"  :class="{ 'md-show': md.userinfo}">
        <div class="md-content">
          <!--头部-->
          <div class="titleBox flex-wrap flex-center">
            <div class="title">账户信息</div>
            <div class="iconWrap" @click="closeMd('userinfo')"><i class="close"></i></div>
          </div>
          <!--内容-->
          <div class="contBox">
            <div class="user-info-content flex-column">
              <div class="baseInfo flex-wrap">
                <div class="leftContent">
                  <img src="/modules/portal/static/images/public/default-user-large-icon.png" alt="">
                </div>
                <div class="rightContent">
                  <div class="info-wrap flex-wrap">
                    <div class="item">
                      <span class="name">登录账号 ：</span>
                      <span class="value" v-if="userInfoData">{{user.username}}</span>
                    </div>
                    <div class="item">
                      <span class="name">手机号码 ：</span>
                      <span class="value" v-if="userInfoData">{{ userInfoData.mobile }}</span>
                    </div>
                    <div class="item">
                      <span class="name">登录角色 ：</span>
                      <span class="value" v-if="userInfoData">{{userInfoData.is_super==1?'超级管理员':'普通用户'}}</span>
                    </div>
                    <div class="item">
                      <span class="name">邮箱 ：</span>
                      <span class="value" v-if="userInfoData">{{ userInfoData.email }}</span>
                    </div>
                    <div class="item time">
                      <span class="name">注册时间 ：</span>
                      <span class="value" v-if="userInfoData">{{ userInfoData.created }}</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="info-row">
                <div class="name">地址</div>
                <div class="value">
                  <el-input v-model="userInfoData.address" class="mix-input" :class="{'mix-active-input':userInfoData.address!=''}" placeholder="" :value="userInfoData.address"></el-input>
                </div>
              </div>
              <div class="info-row">
                <div class="name">描述</div>
                <div class="value">
                  <el-input
                    type="textarea"
                    :rows="2"
                    class="mix-input"
                    :class="{'mix-active-input':userInfoData.description!=''}"
                    placeholder=""
                    :value="userInfoData.description"
                    v-model="userInfoData.description">
                  </el-input>
                </div>
              </div>
            </div>
          </div>
          <div class="buttomBox flex-wrap flex-center">
            <input type="button"  class="btn_cancel" @click="closeMd('userinfo')" value="取消"/>
            <input type="button"  class="btn_determine" @click="submitUserInfo" value="确认"/>
          </div>
        </div>
      </div>
    </div>
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
    <!-- 版本信息-->
		<div class="md-modal-container">
			<div class="md-modal md-effect-1 version-info-win"  :class="{ 'md-show': md.versioninfo}">
				<div class="md-content">
					<!--头部-->
					<div class="titleBox flex-wrap flex-center">
						<div class="title">版本信息</div>
						<div class="iconWrap" @click="closeMd('versioninfo')"><i class="close"></i></div>
					</div>
					<div class="contentBox">
            <div class="version-info flex-column">
             <div class="info-title">
               <span class="text">当前版本信息：</span>
               <span class="value">{{version}}</span>
             </div>
             <div class="info-split"></div>
             <div class="info-content flex-wrap">
               <div class="warn-icon"><i></i></div>
               <div class="warn-text">
                 本计算机程序受版权法及国际公约的保护，未经授权擅自复制或散布本程序的部分或全部，将承受严厉的民事和刑事处罚，对已知的违反者将给予法律范围内的全面制裁。
               </div>
             </div>
             <div class="info-copy flex-wrap">
               <div class="copyright-icon"><i></i></div>
               <div class="copyright-text" v-if="aboutInfoData != null&&aboutInfoData.copyright" v-html="aboutInfoData.copyright"></div>
             </div>
            </div>
					</div>
				</div>
			</div>
		</div>
    <!-- 修改密码-->
		<div class="md-modal-container">
			<div class="md-modal md-effect-1 modify-pwd-win"  :class="{ 'md-show': md.modifypwd}">
				<div class="md-content">
					<!--头部-->
					<div class="titleBox flex-wrap flex-center">
						<div class="title">修改密码</div>
						<div class="iconWrap" @click="closeMd('modifypwd')"><i class="close"></i></div>
					</div>
					<div class="contentBox">
            <div class="flex-column">
              <div class="info-row">
                <div class="name">旧密码</div>
                <div class="value">
                  <el-input type="password" v-model="oldpassword" class="mix-input" autoComplete="new-password" :class="{'mix-active-input':oldpassword!=''}" placeholder="请输入旧密码"></el-input>
                </div>
              </div>
              <div class="info-row">
                <div class="name">新密码</div>
                <div class="value">
                  <el-input type="password" v-model="newpassword" class="mix-input" autoComplete="new-password" :class="{'mix-active-input':newpassword!=''}" placeholder="请输入新密码"></el-input>
                </div>
              </div>
              <div class="info-row">
                <div class="name">确认新密码</div>
                <div class="value">
                  <el-input type="password" v-model="confirmnewpassword" class="mix-input" autoComplete="new-password" :class="{'mix-active-input':confirmnewpassword!=''}" placeholder="请再次输入新密码"></el-input>
                </div>
              </div>
            </div>
					</div>
					<div class="buttomBox flex-wrap flex-center">
						<input type="button"  class="btn_cancel" value="取消"  @click="closeMd('modifypwd')"/>
						<input type="button"  class="btn_determine" value="确认" @click="submitModifyPwd"/>
					</div>
				</div>
			</div>
		</div>
  </div>
</template>

<script>
import homeApi from '@/fetch/home'
import config from '@/config'

export default {
  name: 'home',
  data(){
    return {
      user:null,
      appList:null,
      appPageList:[],
      appPageIndex:0,
      isShowMenu:false,
      version:config.version,
      aboutInfoData:null,
      userInfoData:{
      	address:'',
      	description:'',
      },
      oldpassword:'',
      newpassword:'',
      confirmnewpassword:'',
      md:{
        mask:false,
        userinfo:false,
        versioninfo:false,
        modifypwd:false,
        logout:false,
      }
    }
  },
  beforeCreate(){
    // console.log(localStorage.getItem('loginState'));
    // console.log(this.$route);
  },
  created(){
  	  var user=localStorage.getItem('user');
      this.user=JSON.parse(user);
  },
  mounted(){
    this.getAppList();
    this.getAboutUs();
    window.onload = function () {};
  },
  methods:{
    togglePage(num){
      if ( num > 0 && this.appPageIndex < (this.appPageList.length-1) || num < 0 && this.appPageIndex > 0 ) {
        this.appPageIndex += num;
        let tmpList = this.appPageList[this.appPageIndex];
        let row = Math.ceil(tmpList.length / 4);
        document.querySelector('div.menu-box').style.height = (row * (160+20) - 20) + 'px';
      }
    },
    getAppList(){
      let ticket = this.user.ticket;
      let header = { 'Authorization':'Bearer '+ticket }
      let self = this;
      homeApi.get_app_list((data)=>{
        if (data.code == 200) {
          self.appList = data.result;
          // self.appList.splice(self.appList.length-1,1);
          let $box = document.querySelector('div.menu-box');
          let boxHeight = $box.offsetHeight;
          // console.log(boxHeight);
          let row = parseInt((boxHeight + 20) / (160+20));
          let len = self.appList.length;
          if (len-row*4>0) {
            let start = 0;
            let end = row * 4;
            for (var i = 0; i <= parseInt(len/(row*4)); i++) {
              self.appPageList.push(self.appList.slice(start,end));
              start = end;
              end += row * 4;
              end = end > len ? len : end;
            }
          } else {
            self.appPageList.push(self.appList);
          }
          $box.style.height = (Math.ceil(self.appPageList[0].length / 4) * (160+20) - 20) + 'px';
          // console.log(self.appList);
          // console.log(self.appPageList);
        }
      },null,{'headers':header});
    },
    openApp(url,client_id){
      let self = this;
      let mixWindow=window.open('_blank'); // 先打开页面
      homeApi.check_ticket((data)=>{
        if (data.code == 200) {
          url = url + '?source='+client_id+'&ticket=' + self.user.ticket;
          console.log(url)
          mixWindow.location.href= url; // 后更改页面地址
          // let newWin = window.open(url);
          // console.log(url);
        } else if (data.code == 400) { // ticket 过期
          self.$message({'message': data.msg, 'type': 'error', 'onClose': function(){
            self.$router.push('/login')
          }});
          // self.$router.push('/login')
        } else {
          self.$message.error(data.msg);
          try {
            mixWindow.close();
          } catch (e) {
            console.log(e);
          }
        }
      },{'source':client_id,'ticket':this.user.ticket})
      // setTimeout(function(){
      //   newWin.postMessage({'client_id':client_id,'ticket':user.token},url);
      // },16)
    },
    getAboutUs(){
      let self = this;
      homeApi.get_about_us(function(data){
        if (data.code == 200) {
          let result = data.result;
          if (result['common']) {
            self.aboutInfoData = data.result['common'];
          }
          if (result['common']) {
						let common = result['common'];
						document.querySelector('title').innerHTML = common['website_title']?common['website_title']:'MixPortal';
						if (common['icon_path']) {
              var link = document.querySelector("link[rel*='icon']") || document.createElement('link');
              link.type = 'image/x-icon';
              link.rel = 'shortcut icon';
              link.href = common['icon_path'];
              document.getElementsByTagName('head')[0].appendChild(link);
            }
					}
        } else {
          self.$message.error('获取配置：' + data.msg);
        }
      },{});
    },
    openUserInfoWin(){
      this.showMd('userinfo');
      let ticket = this.user.ticket;
      let header = { 'Authorization':'Bearer '+ticket };
      let self = this;
      homeApi.get_user((data)=>{
        if (data.code == 200) {
           if(data.data!=""||data.data!=[]){
             self.userInfoData = data.result;
           }
        }
      },{},{'headers':header})
    },
    submitUserInfo(){
      let ticket = this.user.ticket;
      let header = { 'Authorization':'Bearer '+ticket }
      let self = this;
      if (this.$getByteLength(this.userInfoData['address']) > 64) {
        this.toast('地址字符长度不能超过64个字符','error');
        return
      }
      if (this.$getByteLength(this.userInfoData['description']) > 500) {
        this.toast('描述字符长度不能超过500个字符','error');
        return
      }
      homeApi.user_edit((data) => {
        if (data.code == 200) {
          // console.log(data);
          self.toast('修改成功','success');
          self.closeMd('userinfo');
        }
      },{'user_id':this.userInfoData['user_id'],'username':this.userInfoData['username'],'mobile':this.userInfoData['mobile'],'address':this.userInfoData['address'],'description':this.userInfoData['description']},{'headers':header})
    },
    openModifyPwdWin(){
      this.oldpassword = '';
      this.newpassword = '';
      this.confirmnewpassword = '';
      this.showMd('modifypwd')
    },
    submitModifyPwd(){
      if (this.oldpassword == '') {
        this.toast('旧密码不能为空','error');
        return;
      }
      if (this.newpassword == '') {
        this.toast('新密码不能为空','error');
        return;
      }
      if (this.newpassword != this.confirmnewpassword) {
        this.toast('两次输入的新密码不相同','error');
        return;
      }
      let ticket = this.user.ticket;
      let header = { 'Authorization':'Bearer '+ticket }
      let self = this;
      homeApi.modify_pwd((data) => {
        if (data.code == 200) {
          self.toast('修改成功','success');
          self.closeMd('modifypwd');
        } else {
          self.$message.error(data.msg)
        }
      },{'old_password':this.oldpassword,'new_password':this.newpassword},{'headers':header})
    },
    logout(){
      localStorage.setItem('loginState',0);
      window.location.href = config.mixPassport_url + '/logout?source={MixPortal}&ticket=' + this.user.ticket;
    },
    toast(msg,type){
    	this.$message({
          message:msg,
          type:type
        });
    },
    showMd(md) {
        this.md[md] = true;
        this.md.mask = true;
    },
    closeMd(md) {
        this.md[md] = false;
        this.md.mask = false;
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
@import '../../assets/sass/home/home.scss';
</style>
