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
				<span class="title">{{$t('reportLang.list_title')}}</span>
			</div> -->
			<div class="search-wrap flex-wrap">
				<div class="search-option">
					<el-select v-model="searchOptionValue" :placeholder="$t('el.select.placeholder')" class="mix-select mix-select-32" popper-class="mix-select-item">
				    <el-option
				      v-for="item in searchOption"
				      :key="item.value"
				      :label="item.label"
				      :value="item.value">
				    </el-option>
				  </el-select>
				</div>
				<div class="search-content flex-wrap" :class="{'active':isFocus}">
					<div class="left">
						<el-select v-model="conditionOptionValue" :placeholder="$t('el.select.placeholder')" class="mix-select mix-no-border-32" popper-class="mix-select-item" @focus="isFocus=true" @blur="isFocus=false">
					    <el-option
					      v-for="item in conditionOption"
					      :key="item.value"
					      :label="item.label"
					      :value="item.value">
					    </el-option>
					  </el-select>
					</div>
					<div class="split"></div>
					<div class="right" @keyup.enter="getList('search')">
						<el-input
							class="mix-input mix-no-border-32"
					    :placeholder="$t('common.placeholder_search')"
							@focus="focusInput"
							@blur="isFocus=false"
					    v-model="searchString">
					  </el-input>
					</div>
					<div class="search-icon-wrap" @click="getList('search')"><i class="mix-search-icon"></i></div>
				</div>
				<div class="refresh-wrap" @click="refresh">
					<i class="mix-refresh-icon"></i>
				</div>
			</div>
			<div class="content-wrap flex-column">
				<div class="list-header">
					<table>
						<colgroup><col width="100"><col width="*"><col width="*"><col width="*"><col width="150"></colgroup>
						<thead>
							<tr>
								<th>{{$t('reportLang.report_id')}}</th>
								<th>{{$t('reportLang.report_name')}}</th>
								<th>{{$t('reportLang.created')}}</th>
								<th>{{$t('reportLang.report_description')}}</th>
								<th>{{$t('reportLang.action')}}</th>
								<th v-if="scrollWidth" :style="{'width':scrollWidth+'px','padding':0}"></th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="list-body">
					<table>
						<colgroup><col width="100"><col width="*"><col width="*"><col width="*"><col width="150"></colgroup>
						<tbody>
							<tr v-for="(item,index) in listData" :key="index" :class="{'active':index===currentItemIndex}">
								<td>{{item.output_id}}</td>
								<td>{{item.output_name}}</td>
								<td>{{item.created}}</td>
								<td>{{item.description}}</td>
								<td>
									<div class="action-wrap flex-wrap">
										<div class="mix-icon-button" @click="viewReport(item.file)"><i class="mix-view-icon"></i></div>
										<div class="mix-icon-button" @click="downloadReport(item)"><i class="mix-download-icon"></i></div>
										<div class="mix-icon-button" @click="deleteReport(item.output_id)"><i class="mix-delete-icon"></i></div>
									</div>
								</td>
							</tr>
							<tr v-if="listData==null||listData.length==0">
                <td colspan="5"><div class="nodata">{{$t('common.no_data')}}</div></td>
              </tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="page-btn-wrap flex-wrap">
				<div class="block flex-wrap" v-show="true">
					<el-pagination background class="mix-pagination" @size-change="handleSizeChange" @current-change="getList" :current-page.sync="currentPage" :page-sizes="[10,15,20,25,30]" :page-size="currentPageSize" layout="prev, pager, next, sizes, jumper" :total="totalNumber">
					</el-pagination>
				</div>
			</div>
		</div>
		<div class="md-loading" :class="{ 'active': md.loading}"><i class="el-icon-loading md-loading-icon"></i></div>
	</div>
</template>

<script>
	import reportApi from '@/assets/js/fetch/report';
	import config from "$config";
	export default {
	  name: 'reportList',
	  data () {
	    return {
				user:null,
				listData:null,
				currentItemIndex:null,
				isSearch:false,
				searchString:'',
				searchOptionValue:'output_name',
				searchOption:[
					{'label':this.$t('reportLang.report_name'),'value':'output_name'},
					{'label':this.$t('reportLang.created'),'value':'created'},
                    {'label':this.$t('reportLang.report_id'),'value':'output_id'},
                    {'label':this.$t('reportLang.report_description'),'value':'description'},
				],
				conditionOptionValue:'like',
				conditionOption:[
					{ label: this.$t("common.search_like"), value: "like" },
                    // { label: this.$t("common.search_nc"), value: "not like" },
                    { label: this.$t("common.search_eq"), value: "=" },
                    { label: this.$t("common.search_ne"), value: "!=" },
                    { label: this.$t("common.search_lt"), value: "<" },
                    { label: this.$t("common.search_le"), value: "<=" },
                    { label: this.$t("common.search_gt"), value: ">" },
                    { label: this.$t("common.search_ge"), value: ">=" }
				],
				isFocus:false,
				currentPage:1,
				currentPageSize:10,
				totalNumber:0,
				scrollWidth:0,
				md:{
					loading:false,
				},
	    }
	  },

	  created(){
			this.user = JSON.parse(localStorage.getItem('user'))
			// console.log(this.user);
		},
	  mounted(){
			this.getList('list');
		},
		updated(){
			let outer = document.querySelector('div.list-body');
			let inner = document.querySelector('div.list-body>table');
			if (outer&&inner) {
				this.scrollWidth = outer.offsetWidth -inner.offsetWidth;
			}
		},
	  methods:{
			getList(type){
				let self = this;
				let condition = '[]';
				if (type=='search') {
					this.isSearch = true;
					if (this.searchString=='') {
						this.isSearch = false;
					}
					this.currentPage=1;
					this.currentPageSize=10;
				} else if (type == 'list'){
					this.currentPage=1;
					this.currentPageSize=10;
					this.isSearch = false;
				}
				if (this.isSearch) {
					condition = JSON.stringify([[this.searchOptionValue,this.conditionOptionValue,this.searchString]]);
				}
				self.md['loading'] = true;
				this.currentItemIndex = null;
				reportApi.get_list_by_user(function(data){
					if (data.code == 200) {
						self.listData = data.result.data;
						self.totalNumber = data.result.total_records;
					}
					self.md['loading'] = false;
				},{'is_all':0,'page_index':this.currentPage,'page_size':this.currentPageSize,'condition':condition,'user_name':this.user['username']});
			},
			viewReport(file){
				let apir_url = config.protocol + report_url + '/report/download?file_path='
				let online_url = "https://view.officeapps.live.com/op/view.aspx?src=" + apir_url;
				console.log(online_url + file);
				window.open(online_url + file);
			},
			downloadReport(item){
				var elink = document.createElement("a");
				elink.download = item.output_name;
				elink.style.display = "none";
				elink.href = config.apir.download + "?file_path=" +item.file+"&output_name="+item.output_name;
				document.body.appendChild(elink);
				elink.click();
				document.body.removeChild(elink);
			},
			deleteReport(outputid){
				if (!outputid) {
					return
				}
				let self = this;
				this.$confirm(this.$t("reportLang.del_tip"), this.$t("el.messagebox.title"), {
          confirmButtonText: this.$t("el.messagebox.confirm"),
          cancelButtonText: this.$t("el.messagebox.cancel"),
          type: 'warning'
        }).then(() => {
          reportApi.delete_report(function(data){
						if (data.code == 200) {
							self.getList();
						}
					},{'output_id': outputid})
        }).catch(() => {
          this.$message({
            type: 'info',
            message: this.$t("reportLang.cancel_del")
          });
        });
			},
			enterDetailPage(item,index){
				this.currentItemIndex = index;
				this.$emit('nav-title',{'name':item.output_name,'id':item.output_id});
				this.$router.push({name:'reportDetail',path:'/report/detail',params:{'outPutId':item.output_id,'outPutName':item.output_name}});
			},
			handleSizeChange(val){
				this.currentPageSize = val;
				this.getList();
			},
			refresh(){
				this.searchOptionValue='output_name';
				this.conditionOptionValue='like';
				this.searchString='';
				this.currentPage=1;
				this.currentPageSize=10;
				this.isSearch = false;
				this.getList('list');
			},
			focusInput(){
				let self = this;
				setTimeout(function(){
					self.isFocus = true;
				},100)
			},
		},
	}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
     @import '../../../sass/report/list.scss';
</style>
