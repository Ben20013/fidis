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
    <div class="body flex-column">
      <div class="content flex-column">
        <div class="content__header">
          <div class="header-content flex-column">
            <div class="header__top-content flex-wrap">
              <div class="header__top-content_left">
                <div class="title" v-if="aboutInfoData != null&&aboutInfoData.product_name">{{aboutInfoData.product_name}}</div>
                <div class="title" v-else>智物联工业数据云平台</div>
              </div>
              <div class="header__top-content_right flex-wrap">
                <div class="header__top-content_date flex-column">
                  <div class="date__top-content">Today</div>
                  <div class="date__bottom-content">{{dateTime}}</div>
                </div>
                <div class="header__top-content_user flex-wrap" :class="{'active':isShowMenu}" @mouseover="handleHoverMenu" @mouseleave="isShowMenu=false">
                  <div class="user__left-content">
                    <span class="chart">{{userNameChart(user.username)}}</span>
                  </div>
                  <div class="user__right-content flex-wrap">
                    <div class="user-name flex-column">
                      <div class="name">{{user.username}}</div>
                      <div class="address">{{user.is_super ===1 ? '超级管理员' : '普通用户'}}</div>
                    </div>
                    <i class="arrow-down"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="header__bottom-content" v-if="aboutInfoData != null&&aboutInfoData.ad_slogan">{{aboutInfoData.ad_slogan}}</div>
            <div class="header__bottom-content" v-else>降低能耗、提升效率、减低成本、提升产值方面助力，引领工业4.0</div>
          </div>
        </div>
        <div class="content__app">
          <div class="page__btn page__left" @click="togglePage(-1)"><i class="left"></i></div>
          <div class="app__content flex-wrap">
            <div class="app__item flex-column" v-for="(item,index) in appPageList[appPageIndex]" :class="{'mt0':index<4,'ml0':index%4==0}" @click="openApp(item.url,item.client_id)">
              <div class="app__item_name">{{item.client_name}}</div>
              <div class="app__item_content">
                <div class="app__summary flex-column">
                  <i class="summary__line-icon"></i>
                  <div class="summary__text">{{item.description}}</div>
                </div>
                <div class="app__icon">
                  <img v-if="item.logo" class="app__logo" :src="item.logo" :alt="item.client_name">
                  <img v-else class="app__logo" src="/modules/portal/static/images/app-icon.png" :alt="item.client_name">
                </div>
              </div>
            </div>
          </div>
          <div class="page__btn page__right" @click="togglePage(1)"><i class="right"></i></div>
        </div>
      </div>
    </div>
    <div class="footer flex-column">
      <div class="page-label flex-wrap" v-if="appPageList.length>1">
        <div class="label" v-for="(item,index) in appPageList" :class="{'active':index==appPageIndex}"></div>
      </div>
      <div class="copyright">
        <p class="copyright-text" v-if="aboutInfoData != null&&aboutInfoData.copyright" v-html="aboutInfoData.copyright"></p>
      </div>
    </div>
    <div class="user-menu" v-show="isShowMenu" @mouseover="isShowMenu=true" @mouseleave="isShowMenu=true" :style="userMenuStyle">
        <div class="menu-item flex-wrap" @click="isShowMenu=false;openAdmin()">
        <span class="ic_home"></span>
        <span>后台管理</span>
      </div>
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
                      <span class="name">登录角色 ：</span>
                      <span class="value" v-if="userInfoData">{{userInfoData.is_super==1?'超级管理员':'普通用户'}}</span>
                    </div>
                    <div class="item time">
                      <span class="name">手机号码 ：</span>
                      <span class="value" v-if="userInfoData">{{ userInfoData.mobile }}</span>
                    </div>
                    <div class="item time">
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
              <div class="info-row newpasswd">
                <div class="name flex-wrap">
                  <span>新密码</span>
                  <div class="alert" v-show="cpt_pswStrongValue < 2">（{{pswErrorMsg}}）</div>
                </div>
                <div class="value">
                  <el-input type="password" v-model="newpassword" class="mix-input" autoComplete="new-password" :class="{'mix-active-input':newpassword!='', 'error': cpt_pswStrongValue ==0}" placeholder="请输入新密码"></el-input>
                </div>
                <div class="strong">
                      <div class="color-item" >
                        <div class="bg" :class="{weakstrong: cpt_pswStrongValue >=1}"></div>
                        <div class="desc">弱</div>
                      </div>
                      <div class="color-item">
                        <div class="bg"  :class="{middlestrong: cpt_pswStrongValue >=2}"></div>
                        <div class="desc">中</div>
                      </div>
                      <div class="color-item">
                        <div class="bg"  :class="{highstrong: cpt_pswStrongValue >=3}"></div>
                        <div class="desc">强</div>
                      </div>
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
import homeApi from '@/assets/js/fetch/home'
import config from '@/assets/js/config'

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
      },
      dateTime: '',
      dateTimer: null,
      userMenuTop: 0,
      userMenuLeft: 0,
      backgroundImagePath: '',
      pswErrorMsg: '8-16位， 以字母或下划线开头， 含字母（区分大小写）、数字、下划线; 不含特殊字符'
    }
  },
  computed: {
    userMenuStyle() {
      return {'top': this.userMenuTop+'px', 'left': this.userMenuLeft+'px'}
    },
    mainBoxStyle(){
      if (!this.backgroundImagePath) {
        return {}
      }
      return {'background-image': 'url('+ this.backgroundImagePath +')'}
    },
    cpt_pswStrongValue() {
      return this.getPswStrong(this.newpassword);
    }
  },
  beforeCreate(){
    // console.log(localStorage.getItem('loginState'));
    // console.log(this.$route);
  },
  created(){
    var user=localStorage.getItem('user');
    this.user=JSON.parse(user);
    this.getAboutUs();
  },
  mounted(){
    this.getAppList();
    this.setTheme()
    this.setDate()
    this.userMenuDom = document.querySelector('.header__top-content_user')
    if (this.dateTimer) {
      clearInterval(this.dateTimer)
    }
    this.dateTimer = setInterval(()=>{
      this.setDate()
    }, 1000)
  },
  methods:{
    handleHoverMenu() {
      this.getUserDomTL();
      this.isShowMenu = true
    },
    getUserDomTL() {
      let userMenuDom = document.querySelector('.header__top-content_user')
      let height = userMenuDom.offsetHeight
      this.userMenuTop = userMenuDom.offsetTop + height
      this.userMenuLeft = userMenuDom.offsetLeft
    },
    setTheme(){
      let app = document.getElementById('app')
      let theme = sessionStorage.getItem('MIXPORTALTHEME')
      app.className = theme == 1 ? 'mix-theme-dark' : 'mix-theme-bright'
    },
    setDate(){
      let getMonth = ['January', 'February', 'March','April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
      let date = new Date()
      let day = date.getDate()
      let month = getMonth[date.getMonth()]
      let year = date.getFullYear()
      // this.dateTime = '25 January,2019'
      this.dateTime = day + ' ' + month + ',' + year
    },
    userNameChart(name){
      if (name.length) {
        return name.substring(0, 1).toUpperCase()
      }
      return ''
    },
    togglePage(num){
      if ( num > 0 && this.appPageIndex < (this.appPageList.length-1) || num < 0 && this.appPageIndex > 0 ) {
        this.appPageIndex += num;
      }
    },
    getAppList(){
      let ticket = this.user.ticket;
      let header = { 'Authorization':'Bearer '+ticket }
      let self = this;
      homeApi.get_app_list((data)=>{
        if (data&&data.code == 200) {
          self.appList = data.result;
          let row = 2;
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
          // console.log(self.appList);
          // console.log(self.appPageList);
        }
      },null,{'headers':header});
    },
    openApp(url,client_id){
      let self = this;
      let mixWindow=window.open('#/_blank'); // 先打开页面
      homeApi.check_ticket((data)=>{
        if (data.code == 200) {
          url = url + '?source='+client_id+'&ticket=' + self.user.ticket;
          // console.log(url)
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
      homeApi.get_about_us(data =>{
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
                    let theme = common['mix_theme'] ? common['mix_theme'] : 1
                    document.querySelector('div#app').className = theme == 1 ? 'mix-theme-dark' : 'mix-theme-bright'
                                sessionStorage.setItem('MIXPORTALTHEME', theme)
                    this.backgroundImagePath = common['background_image_path'] ? common['background_image_path'] : ''
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
      if (!(this.getPswStrong(this.newpassword) >=2 )) {
        this.toast(this.pswErrorMsg,'error');
        return;
      }
      if (this.oldpassword == '') {
        this.toast('旧密码不能为空','error');
        return;
      }
      // if (this.newpassword == '') {
      //   this.toast('新密码不能为空','error');
      //   return;
      // }
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
      window.location.href = config.mixPassport_url + '/portal/logout?source={MixPortal}&ticket=' + this.user.ticket;
    },
    getPswStrong(psw) {
      // console.log(psw);
      if (psw == '') {
        this.pswErrorMsg = '密码不能为空'
        return 0
      }
      if (psw.trim().length < 8) {
        // console.log("密码长度不小于8位");
        this.pswErrorMsg = '密码长度不小于8位'
        return 1;
      }

      if (psw.trim().length > 16) {
        // console.log("密码长度不大于16位");
        this.pswErrorMsg = '密码长度不大于16位'
        return 1;
      }

      // if (!/^[a-zA-Z_]/.test(this.addSheetObj.password)) {
      //   console.log("密码必须以字母或下划线开头");
      //   this.pswErrorMsg = '密码必须以字母或下划线开头';
      //   return 0;
      // }

      let hasLowercase = /[a-z]/.test(psw) ? 1 : 0;
      let hasUppercase = /[A-Z]/.test(psw) ? 1 : 0;
      let hasAlphabet = /[a-zA-Z]/.test(psw) ? 1 : 0;
      let hasNumber = /\d/.test(psw) ? 1 : 0;
      let hasSpecialChar = /[~!@#$%^&*()_+`\-={}:";'<>?,.\/]/.test(psw) ? 1: 0;
      // console.log(psw);
      // console.log("hasLowercase========>" + hasLowercase);
      // console.log("hasUppercase========>" + hasUppercase);
      // console.log("hasAlphabet========>" + hasAlphabet);
      // console.log("hasNumber========>" + hasNumber);
      // console.log("hasSpecialChar========>" + hasSpecialChar);
      if(hasSpecialChar + hasAlphabet + hasNumber == 3) {
        // console.log("强密码");
        return 3;
      }

      if( hasAlphabet + hasNumber == 2 ) {
        if (hasSpecialChar + hasAlphabet + hasNumber == 3) {
          // console.log("强密码");
          return 3;
        }

        if (hasLowercase + hasUppercase + hasNumber == 3) {
          // console.log("强密码");
          return 3;
        }
        // console.log("中密码");
        return 2;
      }

      if(hasAlphabet + hasNumber <= 1) {
        // console.log("弱密码");
        this.pswErrorMsg = '密码强度太弱， 请设置强度更高的密码， 至少同时包含字母和数字';
        return 1;
      }

      return 0;
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
    openAdmin(){
        window.open('admin');
    }
  },
  beforeDestroy(){
    if (this.dateTimer) {
      clearInterval(this.dateTimer)
    }
  }
}
</script>
<style rel="stylesheet/scss" lang="scss">
@import '@/assets/theme/func.scss';
.mix-input.error .el-input__inner, .mix-input.error .el-input__inner:focus,.mix-input.error .el-textarea__inner:focus{
  border: solid px2rem(1px) #ff0000;
}
  .copyright-text{
    a{
      text-decoration: underline;
      color: #4162ff;
    }
  }
</style>
<style rel="stylesheet/scss" lang="scss" scoped>
  @import '@/assets/theme/bright/home.scss';
  @import '@/assets/theme/dark/home.scss';
</style>
