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
		<div style="height:100%;overflow:hidden;">
			<div class="content-wrap flex-column">
				<!-- <div class="nav-wrap flex-wrap">
					<div class="nav-title flex-wrap flex-center"><span>{{$t('weibaoLang.maintenance_list')}}</span></div>
				</div> -->
				<div class="body-wrap flex-column">
					<!--页面头部-->
					<div class="title-wrap flex-wrap flex-center">
						<div class="left-box flex-wrap">
							<div class="left__selectBox">
								<el-select v-model="device_select" :placeholder="$t('weibaoLang.maintenance_id')">
									<!-- <el-option :label="$t('weibaoLang.maintenance_id')" value="maintenance_id"></el-option> -->
                                    <el-option
                                        v-for="item in searchOption"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                    </el-option>
								</el-select>
							</div>
							<div class="search__selectBox">
								<el-input :placeholder="$t('common.placeholder_input')" v-model="input5" class="input-with-select">
									<!-- <el-select v-model="search_select" slot="prepend" :placeholder="$t('common.search_like')">
										<el-option :label="$t('weibaoLang.exact')" value="1"></el-option>
										<el-option :label="$t('weibaoLang.fuzzy')" value="2"></el-option>
									</el-select> -->
                                    <el-select v-model="search_select" slot="prepend" :placeholder="$t('common.search_like')">
										<!-- <el-option :label="$t('weibaoLang.exact')" value="1"></el-option>
										<el-option :label="$t('weibaoLang.fuzzy')" value="2"></el-option> -->
                                        <el-option
                                            v-for="item in conditionOption"
                                            :key="item.value"
                                            :label="item.label"
                                            :value="item.value">
                                        </el-option>
									</el-select>
									<el-button @click="getList" slot="append" icon="el-icon-search"></el-button>
								</el-input>
							</div>
						</div>
						<div class="right-box flex-wrap">
							<div class="mix-icon-button" @click="refresh"><i class="mix-refresh-icon"></i></div>
						</div>
					</div>

					<!--表格-->
					<div class="table-wrap">
						<div class="list-table flex-column">
							<el-table style="width: 100%"
									:data="listData"
									ref="table"
									height="100%"
									highlight-current-row
									row-key="maintenance_id"
									:expand-row-keys="expands"
									@row-click="detailUrl">
								<!--table点击每一行展示的内容-->
								<el-table-column   type="expand" fixed width="1" class-name="expand-table">
								<!--  <template slot-scope="props">
										<table class="block-body-table">
											<tr>
												<td>维保编号</td>
												<td>{{ props.row.rule_id }}</td>
												<td>维保名称</td>

												<td>{{ props.row.rule_name }}</td>
												<td>维保点</td>
												<td>{{ props.row.rule_name }}</td>
											</tr>
											<tr>
												<td>维保类型</td>
												<td>倒计时</td>
												<td>维保周期</td>
												<td>{{ props.row.period }} {{props.row.unit}}</td>
												<td>维保时间类型</td>
												<td>自然时间</td>
											</tr>
											<tr>
												<td>维保提醒渠道</td>
												<td colspan="5">无</td>
											</tr>
										</table>
									</template> -->
								</el-table-column>

								<!--table-->
								<el-table-column :label="$t('weibaoLang.maintenance_id')" width="100">
									<template slot-scope="props">{{ props.row.maintenance_id }}</template>
								</el-table-column>
								<!--  <el-table-column label="维保名称">
									<template slot-scope="props">{{ props.row.rule_name }}</template>
								</el-table-column> -->
								<el-table-column  :label="$t('weibaoLang.maintenance_point')">
									<template slot-scope="props">{{ props.row.rule_name }}</template>
								</el-table-column>
								<el-table-column  :label="$t('weibaoLang.equipment_id')">
									<template slot-scope="props">{{ props.row.equipment_id }}</template>
								</el-table-column>
								<el-table-column  :label="$t('weibaoLang.maintenance_cycle')">
									<template slot-scope="props">{{ props.row.period }} {{props.row.unit}}</template>
								</el-table-column>
								<el-table-column :label="$t('weibaoLang.maintenance_time_type')">
									<template slot-scope="props">{{ props.row.time_type === 1 ? $t('weibaoLang.natural_time') : $t('weibaoLang.equipment_running_time') }}</template>
								</el-table-column>
								<el-table-column :label="$t('weibaoLang.last_maintenance_time')">
									<template slot-scope="props">{{ props.row.last_maintenance_time }}</template>
								</el-table-column>
								<el-table-column :label="$t('weibaoLang.maintenance_cycle_countdown')" width="300">
									<template slot-scope="props">
										<!-- <el-tooltip class="item" effect="dark" :content="props.row.content" placement="top-start">
										<el-progress v-if="props.row.time==100" :percentage="props.row.time" :show-text="false" :stroke-width="12" status="success">{{$t('weibaoLang.progress')}}</el-progress>
										<el-progress v-else :percentage="props.row.time" :show-text="false" :stroke-width="12">{{$t('weibaoLang.progress')}}</el-progress>
										</el-tooltip> -->
										<el-tooltip class="item" effect="dark" :content="props.row.content" placement="top-start">
											<div class="mix-progress">
												<div class="mix-progress-bar">
													<div class="mix-progress-bar__ourter" v-if="props.row.time<0" style="background-color:#ececec;">
														<div class="mix-progress-bar__inner" :style="{'width': getBarWidth(props.row.time),'background-color':'#f53368','right':'0'}"></div>
													</div>
													<div class="mix-progress-bar__ourter" v-else>
														<div class="mix-progress-bar__inner" :style="{'width': getBarWidth(props.row.time),'left':'0'}"></div>
													</div>
												</div>
											</div>
										</el-tooltip>
									</template>
								</el-table-column>
							</el-table>
						</div>

						<!--分页-->
						<div class="list-pagination flex-wrap">
							<el-pagination
								background
								@size-change="handleSizeChange"
								@current-change="handleCurrentChange"
								:current-page="currentPage"
								:page-size="currentPageSize"
								:page-sizes="[10,15,20,25,30]"
								layout="prev, pager, next, sizes, jumper"
								:total="listTotalRecord">
							</el-pagination>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
import taskApi from '@/assets/js/fetch/task'

export default {
	name: 'taskList',
	data() {
		return {
			message: 'Hello world!',
			expands:[],
			currentPageSize: 10,
			isEdit: false,
			isAddModal: false,
			isEditModal: false,
			searchString: '',
			listData: [],
			listTotalRecord: 0,
			currentPage: 1,
			activeItem: 0,
			infoData: null,

			input3: '',
			input4: '',
			input5: '',
			device_select:'maintenance_id',
			search_select: 'like',
			search:'',
			dynamicTags: [],
			inputVisible: false,
			inputValue: '',
			agentRule:{
				type: '',
				addition: '',
				callback: '',
				cycle:''
			},
			isUseAgent: 0,
			routeIdList: [],
			tplTypeList: [],
			agentTypeList: [],
			scheduleType: [
				{label:'倒计时',value:'1'},
				{label:'倒计时2',value:'2'},
				{label:'倒计时3',value:'3'}
			],
			scheduleDate:[
				{label:'按天',value:'1'},
				{label:'按月',value:'2'},
				{label:'按年',value:'3'}
			],
			timeType:[
				{label:'自然时间',value:'1'},
				{label:'工作日',value:'2'}
			],
			remindChannel:[
				{label:'提醒渠道1',value:'1'},
				{label:'提醒渠道2',value:'2'}
			],
            listData: [],
            searchOption:[
                {'label':this.$t('weibaoLang.maintenance_id'),'value':'maintenance_id'},
                {'label':this.$t('weibaoLang.maintenance_point'),'value':'rule_name'},
                {'label':this.$t('weibaoLang.equipment_id'),'value':'equipment_id'},
                {'label':this.$t('weibaoLang.maintenance_cycle'),'value':'period'},
                {'label':this.$t('weibaoLang.maintenance_time_type'),'value':'time_type'},
                {'label':this.$t('weibaoLang.last_maintenance_time'),'value':'last_maintenance_time'},
            ],
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
		}
	},
	mounted() {
		this.getList();
	},

	methods: {
		toogleExpand(row) {
			let $table = this.$refs.table;
			this.listData.map((item) => {
				if (row.maintenance_id != item.maintenance_id)
			{
				$table.toggleRowExpansion(item, false)
			}
		})
			$table.layout.scrollY = true;
			$table.toggleRowExpansion(row)
		},
		searchFunciton(){
			var res = [JSON.stringify([[this.device_select, this.search_select, this.input5]])];
			// if(this.device_select && this.search_select==1){
			// 	//精确
			// 	res = [
			// 		JSON.stringify([[this.device_select,this.input5]])
			// 	];
			// }else if((this.device_select && this.search_select==2)){
			// 	res = [
			// 		JSON.stringify([[this.device_select,"like",this.input5]])
			// 	];
			// }else{
			// 	res = '';
			// }

			this.search = res;
		},
		detailUrl(row,event,column){
				// window.location.href = '/index#/task/detail'+'?maintenance_id='+row.maintenance_id;
				this.$router.push({ path:'/task/detail'+'?maintenance_id='+row.maintenance_id})
		},
		getList(){
			this.searchFunciton();
			const loading = this.$loading({
				lock: true,
				text: 'Loading'
			});
            let self = this;
			taskApi.list((data)=>{
				if (data.code == 200) {
					self.listData = data.result.data;
					self.listTotalRecord = data.result.total_records;


					for (var i = self.listData.length - 1; i >= 0; i--) {
						self.listData[i].time = this.getTime(self.listData[i]);
						// console.log('进度条百分比'+self.listData[i].time);
						self.listData[i].unit = this.getShowTime(self.listData[i]);
						if(self.listData[i].time_type==1){
							var closing_date = Date.parse(new Date(self.listData[i].closing_date))/1000;
							// console.log('结束时间'+closing_date);
							var timestamp = Date.parse(new Date());

							//获取当前时间
							var time = timestamp/1000;
							// console.log('当前时间'+time);
							//获得剩余时间
							var remaining =(closing_date-time)/3600;
							// console.log('剩余时间'+remaining)
							var remaining = remaining.toFixed(1);
						}else{
							var remaining = self.listData[i].remaining
						}

						// console.log('剩余时间'+remaining);
						// self.listData[i].content = '总周期'+self.listData[i].period+self.listData[i].unit+',剩余'+remaining+'小时';
						let content = this.$t('weibaoLang.progress_tip',[self.listData[i].period+self.listData[i].unit,remaining]);
						if (Number(remaining)<0) {
							content = this.$t('weibaoLang.progress_tip1',[self.listData[i].period+self.listData[i].unit,Math.abs(Number(remaining))]);
						}
						self.listData[i].content = content;
					}

				}
				setTimeout(()=>{
					loading.close();
				},1000)
			},{'page_index':this.currentPage,'page_size':this.currentPageSize,'search': this.search})
		},
		getShowTime(item){
				if(item.unit == 'hour'){
						return this.$t('weibaoLang.hour');
					}else if(item.unit == 'day'){
						return this.$t('weibaoLang.day');
					}else if(item.unit == 'month'){
						return  this.$t('weibaoLang.month');
					}else if(item.unit== 'year'){
						return this.$t('weibaoLang.year');
					}

		},
		getTime(item) {

			var unit;
			if(item.unit === 'yea') unit = 8760
			if(item.unit === 'month') unit = 720
			if(item.unit === 'day') unit = 24
			if(item.unit === 'hour') unit = 1

			// time_type为1 自然运行时间 ： closing_date（截止日期） - start_date（开始日期）
			// time_type为2 设备运行时间： perid * unit - remaining

			if(item.time_type == 1) {
				// let startDateHours = new Date(item.start_date) //开始日期

				// let closingDateHours = new Date(item.closing_date) //截止日期
				// let closingHours = closingDateHours.valueOf() // 截止日期毫秒数
				// let t1 = (closingHours / 3600000).toFixed(0) // 截止日期小时数

				// let t = parseInt(closingDateHours - startDateHours) //剩余时间毫秒数
				// let num = (t / 3600000).toFixed(0) //剩余时间小时数

				// 屏蔽数据
				// 总时间 （小时）
				let allTime = item.period * unit;
				// console.log('总时间'+allTime);
				//截止日期
				let closingDateHours1 =  Date.parse(new Date(item.closing_date))/1000;
					//截止日期

				//当前时间
				let timestamp = Date.parse(new Date());
				let time1 = timestamp/1000;


				//剩余时间 截止日期-系统当前时间
				var remain =(closingDateHours1-time1)/60/60;
				var remain1 = remain.toFixed(0);
				// console.log('剩余时间'+remain1);
				//剩余时间占总时间的百分比
				let time = +((remain1 / allTime) * 100).toFixed(2); // 求百分比
				// console.log('占比'+time);
				if(remain1 === 0 ||  time === 100 || isNaN(time)|| time>100) {
					// this.list[index].isDone = '1' // 状态改为完结
					time = 100 // 进度条为100
					return time
				} else {
					return time
				}

			} else if(item.time_type == 2){
				//   运行时间  = 维保周期（perid）  *  时间单位（unit）  - 剩余时间（remaining）  # 此处 remaining 单位为小时
				//   #关于unit
				//   month = 30 day  year = 365 day
				// 总时间 =运行时间 + 剩余时间（remaining）= 维保周期（perid）  *  unit（时间单位）
				let t1 = item.period * unit - item.remaining //运行时间小时数

				var time = item.remaining / (item.period * unit) * 100 //百分比

				if(t1 === 0 || time === 100 || isNaN(time) || time> 100) {
					// this.list[index].isDone = '1'
					time = 100
					return time
				} else {
					return time
				}
			}
		},

		handleEdit(index, row) {
			console.log(index, row);
		},
		handleDelete(index, row) {
			console.log(index, row);
		},


		handleCurrentChange(value){
			this.currentPage = value;
			this.getList();
		},
		handleSizeChange(val){
			this.currentPageSize = val;
			this.getList();
		},
		refresh(){
			this.searchString = '';
			this.currentPage = 1;
            this.currentPageSize = 10;
            this.input5='';
			this.device_select='maintenance_id';
			this.search_select='like';
			this.getList();
		},

		showInput() {
			this.inputVisible = true;
			this.$nextTick(_ => {
				this.$refs.saveTagInput.$refs.input.focus();
			});
		},
		getBarWidth(time){
			if (time < 0) {
				let tmp_time = Math.abs(time)
				time = tmp_time > 100 ? 100 : tmp_time
			} else {
				time = 100 - time
			}
			return  time + '%'
		}
	}
}

</script>
<style rel="stylesheet/scss" lang="scss" scoped>
    @import '../../../sass/mix-base-layout.scss';
	@import '../../../sass/style.scss';
	.cont-box{
		flex: 1;
		padding: 16px;
		overflow: hidden;
	}
</style>
<style rel="stylesheet">
.main .right-box .container{
        overflow-y: auto!important;
    }
    .search__selectBox .el-select .el-input {
        width: 130px!important;
        color: #333;
    }
    .input-with-select .el-input-group__prepend,.input-with-select .el-input-group__append {
        background-color: #fff!important;
    }
    .left-box .el-select .el-input .el-select__caret{
        color: #333!important;
        font-weight: 600;
    }

</style>
