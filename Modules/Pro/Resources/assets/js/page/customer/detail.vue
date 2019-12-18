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
	<div class="cont-box flex-column" :class="{'is-device':isDevice}">
		<div class="detail-container flex-column">
			<!-- <div class="title-wrap">
				<span class="title">{{customerName}}</span>
			</div> -->
			<div class="nav-wrap flex-column" v-if="!isDevice">
				<div class="menu-wrap flex-wrap">
					<div class="menu-item flex-column" :class="{'active':currentTab=='info'}" @click="changeMenu('info')">
						<div class="txt">{{$t('customerLang.customer_info')}}</div>
						<div class="buttom-choose" v-show="currentTab=='info'"></div>
					</div>
					<div v-if="systemName" class="menu-item flex-column" :class="{'active':currentTab=='station'}" @click="changeMenu('station')">
						<div class="txt">{{$t('customerLang.list',[$t('systemLang["'+systemName+'"]')])}}</div>
						<div class="buttom-choose" v-show="currentTab=='station'"></div>
					</div>
					<div class="menu-item flex-column" :class="{'active':currentTab=='device'}" @click="changeMenu('device')">
						<div class="txt">{{$t('customerLang.equipment_list')}}</div>
						<div class="buttom-choose" v-show="currentTab=='device'"></div>
					</div>
					<div class="menu-item flex-column" :class="{'active':currentTab=='record'}" @click="changeMenu('record')">
						<div class="txt">{{$t('customerLang.record_list')}}</div>
						<div class="buttom-choose" v-show="currentTab=='record'"></div>
					</div>
				</div>
				<div class="split-line"></div>
			</div>
			<div class="content-wrap flex-wrap">
				<info :ref="currentTab" :customerId="Number(customerId)" :is="currentTab" v-on:nav-title="onNavTitle"></info>
			</div>
		</div>
	</div>
</template>

<script>
import system from "$system";
import customerApi from "@/assets/js/fetch/customer";
import linkage from "@/assets/js/components/linkage";
import info from "./detail/info";
import station from "./detail/stationList";
import device from "./detail/deviceList";
import record from "./detail/record";

export default {
  name: 'customerDetail',
  components: {//注册组件
    'linkage':linkage,
		'info':info,
		'station':station,
		'device':device,
		'record':record,
  },
	props:{
		customerId:Number,
	},
  data () {
    return {
			systemName:system.name,
			currentTab:'info',
			customerName:'',
			isDevice:false,
    }
  },

  created(){

  },
  mounted(){
		let params = this.$route.params;
		if(params.customerId&&params.customerName){
			this.customerId = params.customerId;
			this.customerName = params.customerName;
		}else if(!this.customerId){
			this.$router.push({name:'customer',path:'/customer'});
		}
	},
  methods:{
		changeMenu(type){
			this.currentTab = type;
			// this.$emit('nav-title',{'name':name,'id':this.customerId});
		},
		onNavTitle(data){
			this.customerName = data.name;
			this.isDevice = data.isDevice;
    },
		updateRouteList(data){
			if (/^\/customer\/detail(?:\/(?=$))?$/i.test(data.path)&&this.customerId) {
				this.isDevice = false;
				this.currentTab = 'device';
			}
		},
	},
	watch:{
    '$route':'updateRouteList'
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/customer/detail.scss";
</style>
