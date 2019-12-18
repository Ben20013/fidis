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
		<div class="title-wrap flex-wrap" v-if="!isDevice">
			<div class="nav-wrap flex-column">
				<div class="menu-wrap flex-wrap">
					<div class="menu-item flex-column" :class="{'active':currentTab=='status'}" @click="changeMenu('status')">
						<div class="txt">{{$t('stationLang.status')}}</div>
						<div class="buttom-choose" v-show="currentTab=='status'"></div>
					</div>
					<div class="menu-item flex-column" :class="{'active':currentTab=='info'}" @click="changeMenu('info')">
						<div class="txt">{{$t('stationLang.info')}}</div>
						<div class="buttom-choose" v-show="currentTab=='info'"></div>
					</div>
					<div class="menu-item flex-column" :class="{'active':currentTab=='history'}" @click="changeMenu('history')">
						<div class="txt">{{$t('stationLang.history')}}</div>
						<div class="buttom-choose" v-show="currentTab=='history'"></div>
					</div>
					<div class="menu-item flex-column" :class="{'active':currentTab=='course'}" @click="changeMenu('course')">
						<div class="txt">{{$t('stationLang.course')}}</div>
						<div class="buttom-choose" v-show="currentTab=='course'"></div>
					</div>
					<div class="menu-item flex-column" :class="{'active':currentTab=='event'}" @click="changeMenu('event')">
						<div class="txt">{{$t('stationLang.event')}}</div>
						<div class="buttom-choose" v-show="currentTab=='event'"></div>
					</div>
					<div class="menu-item flex-column" :class="{'active':currentTab=='fault'}" @click="changeMenu('fault')">
						<div class="txt">{{$t('stationLang.fault')}}</div>
						<div class="buttom-choose" v-show="currentTab=='fault'"></div>
					</div>
					<div class="menu-item flex-column" :class="{'active':currentTab=='alarm'}" @click="changeMenu('alarm')">
						<div class="txt">{{$t('stationLang.alert')}}</div>
						<div class="buttom-choose" v-show="currentTab=='alarm'"></div>
					</div>
					<div class="menu-item flex-column" :class="{'active':currentTab=='collect'}" @click="changeMenu('collect')">
						<div class="txt">{{$t('stationLang.collect')}}</div>
						<div class="buttom-choose" v-show="currentTab=='collect'"></div>
					</div>
					<div class="menu-item flex-column" :class="{'active':currentTab=='control'}" @click="changeMenu('control')">
						<div class="txt">{{$t('stationLang.control')}}</div>
						<div class="buttom-choose" v-show="currentTab=='control'"></div>
					</div>
				</div>
			</div>
			<div class="btn-wrap" v-if="currentTab=='collect'">
        <div class="common-btn" @click="openCollectWin">{{$t('stationLang.data_collect')}}</div>
      </div>
			<div class="btn-wrap" v-if="currentTab=='control'">
        <div class="common-btn" @click="openControlModifyPwdWin">{{$t('deviceLang.modify_pwd')}}</div>
      </div>
		</div>
		<div class="container flex-column" :class="{'is-device':isDevice}">
			<div class="content-wrap">
				<status :ref="currentTab" :groupId="Number(groupId)" :mainEquipmentId="Number(mainEquipmentId)" :is="currentTab" v-on:nav-title="onNavTitle"></status>
			</div>
		</div>
	</div>
</template>

<script>
import deviceApi from "@/assets/js/fetch/device";
import config from "$config";
import info from "./detail/info";
import status from "./detail/status";
import history from "./detail/history";
import course from "./detail/course";
import event from "./detail/event";
import fault from "./detail/fault";
import alarm from "./detail/alarm";
import collect from "./detail/collect";
import control from "./detail/control";
export default {
  name: 'stationDetail',
	components:{
    'info':info,
    'status':status,
    'history':history,
    'course':course,
    'event':event,
    'fault':fault,
    'alarm':alarm,
    'collect':collect,
    'control':control,
  },
  data () {
    return {
			pichost:config.apiq.pictureAddress,
			currentTab:'status',
			groupId: null,
			mainEquipmentId: null,
			isDevice:false,
    }
  },
  created(){
		let query = this.$route.query;
		this.mainEquipmentId = query.id || null;
		this.groupId = query.gid || null;
		if(!this.mainEquipmentId && !this.groupId){
			this.$router.push({name:'station',path:'/station'});
		}
	},
  mounted(){
		
	},
  methods:{
		openCollectWin(){
			if (this.currentTab=='collect'&&this.$refs['collect']) {
				this.$refs['collect'].openCollectWin();
			}
		},
		openControlModifyPwdWin(){
			if (this.currentTab=='control'&&this.$refs['control']) {
				this.$refs['control'].openModifyPwdWin();
			}
		},
		handleSizeChange(){},
		changeMenu(type){
			this.currentTab = type;
		},
		onNavTitle(data){
			// this.groupName = data.name;
			this.isDevice = data.isDevice;
    },
		updateRouteList(data){
			if (/^\/station\/detail(?:\/(?=$))?$/i.test(data.path)&&this.mainEquipmentId) {
				this.isDevice = false;
				this.currentTab = 'info';
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
@import "../../../sass/station/detail.scss";
</style>
