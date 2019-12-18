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
	<div class="cont-box flex-column">
		<div class="detail-container flex-column">
			<div class="title-wrap">
				<span class="title">廉江市强达五金</span>
			</div>
			<div class="nav-wrap flex-column">
				<div class="menu-wrap flex-wrap">
					<div class="menu-item flex-column" :class="{'active':currentTab=='info'}" @click="changeMenu('info')">
						<div class="txt">客户信息</div>
						<div class="buttom-choose" v-show="currentTab=='info'"></div>
					</div>
					<div class="menu-item flex-column" :class="{'active':currentTab=='station'}" @click="changeMenu('station')">
						<div class="txt">气站列表</div>
						<div class="buttom-choose" v-show="currentTab=='station'"></div>
					</div>
					<div class="menu-item flex-column" :class="{'active':currentTab=='device'}" @click="changeMenu('device')">
						<div class="txt">设备列表</div>
						<div class="buttom-choose" v-show="currentTab=='device'"></div>
					</div>
					<div class="menu-item flex-column" :class="{'active':currentTab=='record'}" @click="changeMenu('record')">
						<div class="txt">处理记录</div>
						<div class="buttom-choose" v-show="currentTab=='record'"></div>
					</div>
				</div>
				<div class="split-line"></div>
			</div>
			<div class="content-wrap flex-wrap">
				
			</div>
		</div>
	</div>
</template>

<script>
import customerApi from "@/assets/js/fetch/customer";

export default {
  name: 'eventDetail',
	props:{
		eventId:Number,
	},
  data () {
    return {
			userId:'',
			currentTab:'info',
    }
  },

  created(){
  	let user=localStorage.getItem('user');
  	this.userId=JSON.parse(user).user_id;
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
			let name = '客户信息';
			switch (type) {
				case 'station':
					name = '气站列表';
					break;
				case 'device':
					name = '设备列表';
					break;
				case 'record':
					name = '处理记录';
					break;
				default:
					name = '客户信息';
			}
			this.$emit('nav-title',{'name':name,'id':this.customerId});
		},
		onNavTitle(data){
			this.equipmentName = data.name;
    },
	},
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/customer/detail.scss";
</style>
