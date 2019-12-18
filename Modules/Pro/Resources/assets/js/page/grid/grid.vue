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
	<div class="main flex-wrap">
		<div class="customerContNext3 flex-column flex-con-1" @keyup.enter="gridMethods(1)">
			<div class="serchBox flex-wrap flex-center">
				<el-date-picker
					class="dateBox mg"
					default-time="00:00:00"
		      v-model="starTime"
		      type="datetime"
		      value-format="yyyy-MM-dd HH:mm:ss"
		      placeholder="开始时间">
		    </el-date-picker>
				<el-date-picker
          class="dateBox"
          default-time="12:00:00"
		      v-model="endTime"
		      type="datetime"
		      value-format="yyyy-MM-dd HH:mm:ss"
		      placeholder="结束时间">
		    </el-date-picker>
				<el-input  class="search" placeholder="请输入适配器标识" v-model="aprus_id" auto-complete="on"></el-input>
				<el-select v-model="topic" placeholder="请选择" class="topic">
					<el-option
						v-for="item in topicOption"
						:key="item.value"
						:label="item.label"
						:value="item.value">
					</el-option>
				</el-select>
				<div class="searchBtn flex-wrap flex-center" @click="gridMethods(1)"><div class="ic_search"></div>搜索</div>
				<!--<div class="ic_refresh" @click="getServerList(pageSize,1,1)"></div>-->
			</div>
			<div class="equipmentList">
				<table>
					<colgroup><col width="180"><col width="180"><col width="*"></colgroup>
					<tr>
						<th>采集时间</th>
						<th>主题</th>
						<th>报文</th>
					</tr>
					<tr v-for="(item,index) in resultList" :key="index">
						<td>{{item.time}}</td>
						<td>{{item.topic}}</td>
						<td :title="getPayload(item.payload)">{{item.payload}}</td>
					</tr>
				</table>
				<div class="noFw" v-show="noFw">
					 没有当前搜索内容
				</div>
			</div>
			<el-pagination class="myPage flex-wrap flex-center"
				background
				layout="prev, pager, next, sizes, jumper"
				:total="total"
				:page-size="pageSize"
				:page-sizes="[10,15,20,25,30,50]"
				:current-page.sync="currentPage"
				@current-change="currentChange"
				@size-change="handleSizeChange"
				>
			</el-pagination>
		</div>
	</div>
</template>

<script>
import grid from "@/assets/js/fetch/grid";
import config from "$config";
export default {
  name: 'grid',
  components: {//注册组件
  },
  data () {
    return {
      msg: 'Welcome to Your Vue.js App',
      md:{
      	mask:false,
      },
			currentPage:1,
      pageSize:10,
      noFw:false,
      resultList:'',
      starTime:'',
      endTime:'',
      total:0,
      aprus_id:'',
      topic:'all',
			topicOption:[
				{'label':'所有报文','value':'all'},
				{'label':'r报文','value':'r'},
				{'label':'i报文','value':'i'},
				{'label':'n报文','value':'n'},
				{'label':'d报文','value':'d'},
                {'label':'e报文','value':'e'},
				{'label':'connected','value':'connected'},
				{'label':'disconnected','value':'disconnected'},
			],
    }
  },
  created(){

  },
  mounted(){

  },
  methods:{
  	getPayload(msg){
  		return JSON.stringify(msg);
  	},
  	gridMethods(page){
  		let self=this;
  		if(this.starTime==""||this.starTime==null){
  			 this.toast("请输入采集开始时间！","warning");
  		}else if(this.endTime==""||this.endTime==null){
  			 this.toast("请输入采集结束时间！","warning");
  		}else if(this.aprus_id==""||this.aprus_id==null){
  			 this.toast("请输入适配器标识！","warning");
  		}else{
  			grid.doTest(function(data){
		        if (data.code == 200) {
		        	self.resultList=data.result.data;
		        	if(data.result==[]||data.result==""){
		        		self.noFw=true;
		        	}else{
		        		self.noFw=false;
		        	}
		            self.total=data.result.total_records;
		        }else{
		        	self.toast(data.msg,"warning");
		        }
        	},{start_time:self.starTime,end_time:self.endTime,page_size:self.pageSize,page_index:self.currentPage,aprus_id:self.aprus_id,topic:this.topic});
        }
  	},
  	toast(msg,type){
  		this.$message({
          message:msg,
          type:type
        });
  	},
  	//分页触发
  	currentChange(value){
  		this.gridMethods(value);
  	},
  	handleSizeChange(value){
			this.pageSize = value;
  		this.gridMethods(this.page);
  	},
  	showMd: function(md) {
			this.md[md] = true;
			this.md.mask = true;
		},
		closeMd: function(md) {
			this.md[md] = false
			this.md.mask = false
		},
  },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/grid/grid.scss";
</style>
