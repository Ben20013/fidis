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
	<div class="cont-box">
		<div class="container flex-column">
			<!-- <div class="title-wrap">
				<span class="title">{{$t('deviceLang.list_title')}}</span>
			</div> -->
            <div class="nav-wrap flex-column">
                <div class="menu-wrap flex-wrap">
                    <div
                        class="menu-item flex-column"
                        :class="{'active':activeName=='all'}"
                        @click="changeMenu('all')"
                    >
                        <div class="txt" :style="{'color': activeName=='all'?'#5387ff':'#333333'}">{{$t('deviceLang.all')}}</div>
                        <div class="buttom-choose" v-show="activeName=='all'"></div>
                    </div>
                    <div
                        class="menu-item flex-column"
                        :class="{'active':activeName=='online'}"
                        @click="changeMenu('online')"
                    >
                        <div class="txt" :style="{'color': activeName=='online'?'#5387ff':'#333333'}">{{$t('deviceLang.online')}}</div>
                        <div class="buttom-choose" v-show="activeName=='online'"></div>
                    </div>
                    <div
                        class="menu-item flex-column"
                        :class="{'active':activeName=='stop'}"
                        @click="changeMenu('stop')"
                    >
                        <div class="txt" :style="{'color': activeName=='stop'?'#5387ff':'#333333'}">{{$t('deviceLang.stop')}}</div>
                        <div class="buttom-choose" v-show="activeName=='stop'"></div>
                    </div>
                    <div
                        class="menu-item flex-column"
                        :class="{'active':activeName=='alert'}"
                        @click="changeMenu('alert')"
                    >
                        <div class="txt" :style="{'color': activeName=='alert'?'#5387ff':'#333333'}">{{$t('deviceLang.alert')}}</div>
                        <div class="buttom-choose" v-show="activeName=='alert'"></div>
                    </div>
                    <div
                        class="menu-item flex-column"
                        :class="{'active':activeName=='fault'}"
                        @click="changeMenu('fault')"
                    >
                        <div class="txt" :style="{'color': activeName=='fault'?'#5387ff':'#333333'}">{{$t('deviceLang.fault')}}</div>
                        <div class="buttom-choose" v-show="activeName=='fault'"></div>
                    </div>
                    <div
                        class="menu-item flex-column"
                        :class="{'active':activeName=='offline'}"
                        @click="changeMenu('offline')"
                    >
                        <div class="txt" :style="{'color': activeName=='offline'?'#5387ff':'#333333'}">{{$t('deviceLang.offline')}}</div>
                        <div class="buttom-choose" v-show="activeName=='offline'"></div>
                    </div>
                </div>
            </div>
			<div class="search-wrap flex-wrap">
				<div class="search-option">
					<el-select
						v-model="searchOptionValue"
						:placeholder="$t('common.placeholder_select')"
						class="mix-select mix-select-32"
						popper-class="mix-select-item"
					>
						<el-option
							v-for="item in searchOption"
							:key="item.value"
							:label="item.label"
							:value="item.value"
						></el-option>
					</el-select>
				</div>
				<div class="search-content flex-wrap" :class="{'active':isFocus}">
					<div class="left">
						<el-select
							v-model="conditionOptionValue"
							:placeholder="$t('common.placeholder_select')"
							class="mix-select mix-no-border-32"
							popper-class="mix-select-item"
							@focus="isFocus=true"
							@blur="isFocus=false"
						>
							<el-option
								v-for="item in conditionOption"
								:key="item.value"
								:label="item.label"
								:value="item.value"
							></el-option>
						</el-select>
					</div>
					<div class="split"></div>
					<div class="right" @keyup.enter="getList('search')">
						<el-input
							class="mix-input mix-no-border-32"
							:placeholder="$t('common.placeholder_search')"
							@focus="focusInput"
							@blur="isFocus=false"
							v-model="searchString"
						></el-input>
					</div>
					<div class="search-icon-wrap" @click="getList('search')">
						<i class="mix-search-icon"></i>
					</div>
				</div>
				<div class="refresh-wrap" @click="refresh">
					<i class="mix-refresh-icon"></i>
				</div>
				<div class="export-wrap" @click="exportList">
					<i class="mix-export-icon"></i>
				</div>
				<!-- <div class="search-right flex-wrap">
					<div class="search-status__select">
						<el-select v-model="searchStatus" placeholder="请选择" size="small" @change="getList('list')">
							<el-option :label="$t('deviceLang.all')" value="all"></el-option>
							<el-option :label="$t('deviceLang.online')" value="online"></el-option>
							<el-option :label="$t('deviceLang.offline')" value="offline"></el-option>
						</el-select>
					</div>
				</div> -->
			</div>
			<div class="content-wrap flex-column">
				<div class="list-header" :style="{'width': listWidth}">
					<table>
						<colgroup>
							<template v-for="(item, index) in listVariable">
								<col v-if="index === listVariable.length -1" :key="index" :width="lastListItemWidth">
								<col v-else :key="index" :width="item.width">
							</template>
							<col v-if="scrollWidth" :width="scrollWidth">
						</colgroup>
						<thead>
                            <tr>
								<th v-for="(item, index) in listVariable" :key="index">{{$t('deviceLang.'+item.id)}}</th>
								<th v-if="scrollWidth" :style="{'width': scrollWidth+'px','padding':0}"></th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="list-body" :style="{'width': listWidth}">
					<table>
						<colgroup>
							<template v-for="(item, index) in listVariable">
								<col v-if="index === listVariable.length -1" :key="index" :width="lastListItemWidth">
								<col v-else :key="index" :width="item.width">
							</template>
						</colgroup>
						<tbody>
							<tr v-for="(item,index) in listData" :key="index" @click="enterDetailPage(item,index)" :class="{'active':index===currentItemIndex}">
								<template v-for="(vari, vk) in listVariable">
									<td :key="vk" v-if="vari.id === 'equipment_image'">
										<img :src="pichost + item.equipment_image" alt v-if="item.equipment_image!=''&& item.equipment_image != null">
                                    <img src="../../../images/public/no-image-icon.gif" alt v-else />
									</td>
									<td :key="vk" v-else-if="vari.id === 'status_name'">
										<div class="status-wrap flex-wrap">
											<i class="status-icon offline" v-if="item.status_code==-1"></i>
											<i class="status-icon online" v-if="item.status_code!=-1"></i>
											<i class="status-icon boot" v-if="item.status_code==1"></i>
											<i class="status-icon shutdown" v-if="item.status_code==0"></i>
											<i class="status-icon warn" v-if="getStatusMsg(item.status_name)"></i>
										</div>
									</td>
									<td :key="vk" v-else>{{item[vari.id]}}</td>
								</template>
							</tr>
							<tr v-if="listData==null||listData.length==0">
								<td :colspan="listVariable.length">
									<div class="nodata">{{$t('common.no_data')}}</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="page-btn-wrap flex-wrap">
				<div class="block flex-wrap" v-show="true">
					<el-pagination
						background
						class="mix-pagination"
						@size-change="handleSizeChange"
						@current-change="getList"
						:current-page.sync="currentPage"
						:page-sizes="[10,15,20,25,30]"
						:page-size="currentPageSize"
						layout="prev, pager, next, sizes, jumper"
						:total="totalNumber"
					></el-pagination>
				</div>
			</div>
		</div>
		<div class="md-loading" :class="{ 'active': md.loading}">
			<i class="el-icon-loading md-loading-icon"></i>
		</div>
	</div>
</template>

<script>
import deviceApi from "@/assets/js/fetch/device";
import config from "$config";
import system from "$system";
export default {
	name: "deviceList",
	data() {
		return {
			pichost: config.apiq.pictureAddress,
			listData: null,
			currentItemIndex: null,
			isSearch: false,
			searchString: "",
			searchOptionValue: "equipment_name",
			searchOption: [
				// {
				// 	label: this.$t("deviceLang.equipment_name"),
				// 	value: "equipment_name"
				// },
				// { label: this.$t("deviceLang.equipment_model"), value: "model" },
				// { label: this.$t("deviceLang.customer_name"), value: "customer_name" }
				// {'label':this.$t('deviceLang.equipment_id'),'value':'equipment_id'},
			],
			conditionOptionValue: "like",
			conditionOption: [
                { label: this.$t("common.search_like"), value: "like" },
                // { label: this.$t("common.search_nc"), value: "not like" },
                { label: this.$t("common.search_eq"), value: "=" },
                { label: this.$t("common.search_ne"), value: "!=" },
                { label: this.$t("common.search_lt"), value: "<" },
                { label: this.$t("common.search_le"), value: "<=" },
                { label: this.$t("common.search_gt"), value: ">" },
                { label: this.$t("common.search_ge"), value: ">=" }
			],
			isFocus: false,
			currentPage: 1,
			currentPageSize: 10,
			totalNumber: 0,
			scrollWidth: 0,
			containerWidth: 0,
			md: {
				loading: false
			},
			searchStatus: 'all',
            activeName: 'all'
		};
	},

	created() {},
	mounted() {
		this.getList("list");
        this.containerWidth = document.querySelector('div.cont-box>div.container').offsetWidth
        this.filterSearchField();
	},
	updated() {
		let outer = document.querySelector("div.list-body");
		let inner = document.querySelector("div.list-body>table");
		if (outer && inner) {
			this.scrollWidth = outer.offsetWidth - inner.offsetWidth +1;
		}
	},
	computed: {
		listVariable() {
			let equpment = system.equipment.filter((item) => {
				return item.show > 0
			})
			equpment.sort((a,b) => { return a.listorder - b.listorder})
			return equpment
		},
		lastListItemWidth() {
			let c_width = this.containerWidth
			let width = '*'
			let sum = 0
			let list = this.listVariable
			for (const k in list) {
				if (list.hasOwnProperty(k)) {
					const item = list[k];
					if (isNaN(item.width)) {
						sum = 0
						break
					}
					sum += Number(item.width)
				}
			}
			if (sum > c_width) {
				width = list[list.length-1].width
			}
			return width
		},
		listWidth(){
			let width = '100%';
			let list = this.listVariable
			let sum = 0
			for (const k in list) {
				if (list.hasOwnProperty(k)) {
					const item = list[k];
					if (isNaN(item.width)) {
						sum = 0
						break
					}
					sum += Number(item.width)
				}
			}
			let c_width = this.containerWidth
			if (sum > c_width) {
				width = sum + this.scrollWidth +  'px'
			}
			return width
		}
	},
	methods: {
		getList(type) {
			let self = this;
			let condition = '[["is_group","=","0"]]';
			if (type == "search") {
				this.isSearch = true;
				if (this.searchString == "") {
					this.isSearch = false;
				}
				this.currentPage = 1;
				this.currentPageSize = 10;
			} else if (type == "list") {
				this.currentPage = 1;
				this.currentPageSize = 10;
				this.isSearch = false;
			}
			if (this.isSearch) {
				condition = JSON.stringify([
					["is_group", "=", "0"],
					[
						this.searchOptionValue,
						this.conditionOptionValue,
						this.searchString
					]
				]);
			}
            let state_and = '[]'
            if (this.activeName !== 'all') {
                switch(this.activeName) {
                    case "online":
                        state_and = JSON.stringify([["is_online", "=", 1], ["is_boot", "=", "1"]])
                        break;

                    case "stop":
                        state_and = JSON.stringify([["is_online","=","1"],["is_boot","=","0"]])
                        break;
                    case "alert":
                        state_and = JSON.stringify([["is_alert", "=", 1]])
                        break;
                    case "fault":
                        state_and = JSON.stringify([["is_fault", "=", 1]])
                        break;
                    case "offline":
                        state_and = JSON.stringify([["is_online", "=", 0]])
                        break;
                    default:
                        state_and = JSON.stringify([])
                }
			}
			// if (this.searchStatus !== 'all') {
			// 	let flag = this.searchStatus === 'online' ? 1 : 0
			// 	state_and = JSON.stringify([["is_online", "=", flag]])
			// }
			self.md["loading"] = true;
			this.currentItemIndex = null;
			deviceApi.get_list( function(data) {
					if (data.code == 200) {
						self.listData = data.result.data;
						self.totalNumber = data.result.total_records;
					}
					self.md["loading"] = false;
				}, { is_all: 0, status: "details", page_index: this.currentPage, page_size: this.currentPageSize, condition: condition, state_and: state_and});
		},
		enterDetailPage(item, index) {
			this.currentItemIndex = index;
			this.$emit("nav-title", {
				name: item.equipment_name,
				id: item.equipment_id
			});
			this.$router.push({
				name: "deviceDetail",
				path: "/device/detail",
				query: {
					id: item.equipment_id
				}
			});
		},
		handleSizeChange(val) {
			this.currentPageSize = val;
			this.getList();
		},
		refresh() {
			this.searchOptionValue = "equipment_name";
			this.conditionOptionValue = "like";
			this.searchString = "";
			this.currentPage = 1;
			this.currentPageSize = 10;
			this.isSearch = false;
			this.getList("list");
		},
		exportList() {
			let condition = "[]";
			let head = [
				["equipment_image", this.$t("deviceLang.equipment_image")],
				["equipment_name", this.$t("deviceLang.equipment_name")],
				["model", this.$t("deviceLang.equipment_model")],
				["status_name", this.$t("deviceLang.equipment_status")],
				["customer_name", this.$t("deviceLang.customer_name")],
				["created", this.$t("deviceLang.equipment_create")]
			];
			if (this.isSearch) {
				condition = JSON.stringify([
					[
						this.searchOptionValue,
						this.conditionOptionValue,
						this.searchString
					]
				]);
			}
			let self = this;
			// self.md['loading'] = true;
			let url =
				config.apiq.equipment_list_export +
				"?is_all=1&condition=" +
				condition +
				"&head=" +
				JSON.stringify(head);
			window.open(url);
		},
		getStatusName(str) {
			let tmp = [];
			if (str.indexOf("|") >= 0) {
				tmp = str.split("|");
			} else {
				tmp.push(str);
			}
			return tmp[0];
		},
		getStatusMsg(str) {
			if (str.indexOf("|") >= 0) {
				return str.split("|")[1];
			} else {
				return false;
			}
		},
		focusInput() {
			let self = this;
			setTimeout(function() {
				self.isFocus = true;
			}, 100);
		},
        changeMenu(type) {
            this.activeName = type;
            this.getList('list');
        },
        filterSearchField(){
            let self=this;
            let equpment = system.equipment.filter((item) => {
				if(item.show>0&&item.search > 0){
                    self.searchOption.push({
                        label: this.$t("deviceLang."+item.id),
					    value: item.id
                    });
                }
			})
        }
	}
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
// @import "../../../sass/event/list.scss";
@import "../../../sass/device/list.scss";


</style>
