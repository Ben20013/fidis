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
   <div class="leftBox flex-column" :class="{'expand':isExpand}">
   	  <div class="mixpro-logo flex-wrap">
         <img src="/static/images/public/pro-logo.png" alt="MIXPRO">
         <span v-show="isExpand">MixPortal</span>
       </div>
   	  <div class="menu-box flex-column">
        <router-link tag="div" to="/admin/setting" class="flex-wrap menu-item" :class="{'active':$route.name=='setting'}">
          <el-tooltip class="item" effect="dark" content="设置" placement="right" :disabled="isExpand">
            <div class="flex-wrap content">
              <img src="/static/images/public/press/setting-icon.png" v-show="$route.name=='setting'">
              <img src="/static/images/public/normal/setting-icon.png" v-show="$route.name!='setting'">
       	    	<span v-show="isExpand">设置</span>
            </div>
          </el-tooltip>
   	    </router-link>
   	  </div>
   </div>
</template>

<script>
export default {
  name: 'leftMenu',
  props:{
    isExpand: Boolean,
  },
  data () {
    return {
      loginType:"",
    }
  },
  created(){
	  var user=localStorage.getItem('user');
	  this.loginType=JSON.parse(user).is_super;
  },
  mounted(){

  },
  methods:{

  },
  watch:{
    isExpand:['expand']
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
    .leftBox{
  	  position: relative;
  	  width: 64px;
  	  min-width: 64px;
  	  height: 100%;
  	  // overflow: hidden;
      transition:width .5s ease 0s;
      -moz-transition:width .5s ease 0s; /* Firefox 4 */
      -webkit-transition:width .5s ease 0s; /* Safari and Chrome */
      -o-transition:width .5s ease 0s; /* Opera */
      &.expand{
        width: 180px;
      }
    }
    .mixpro-logo{
   	  width: 100%;
   	  line-height: 50px;
   	  height: 50px;
   	  background-color: #111e31;
      font-family: Microsoft YaHei;
    	font-size: 20px;
    	font-weight: normal;
    	font-stretch: normal;
    	letter-spacing: 0px;
    	color: #ffffff;
      border-style:none;
      align-items: center;
      img{
        margin-left: 20px;
      }
      span{
        margin-left: 11px;
      }
    }
    .menu-box{
      flex: 1;
      background-color: #242d3d;
      box-shadow: 5px 0px 6px -3px #dddddd;
      padding-top: 10px;
    	.menu-item{
        height: 48px;
        font-family: MicrosoftYaHei;
      	font-size: 14px;
      	font-weight: normal;
      	font-stretch: normal;
      	letter-spacing: 0px;
      	color: #959eb4;
        align-items: center;
        padding-left: 24px;
        .content{
          flex: 1;
          height: 100%;
          align-items: center;
          white-space: nowrap;
          overflow: hidden;
        }
        img{
      	 width: 16px;
      	 height: 16px;
        }
        span{
          margin-left: 14px;
          flex: 1;
          height: 16px;
          transition:width .5s ease 0s;
          -moz-transition:width .5s ease 0s; /* Firefox 4 */
          -webkit-transition:width .5s ease 0s; /* Safari and Chrome */
          -o-transition:width .5s ease 0s; /* Opera */
          &.mt2{
            margin-top: 2px;
          }
        }
        &:hover{
          background: #0e131a;
        }
        &.active{
      		background: #4162ff;
          color: #ffffff;
      	}
    	}
    }
</style>
