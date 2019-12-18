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
			<div class="base-info">
				<div class="info-title-wrap flex-wrap">
					<div class="info-title">{{$t('eventLang.base_info')}}</div>
					<div class="info-btn-wrap flex-wrap">
						<div class="create-service-btn" @click="openCreateServiceWin">
							<i class="mix-add-icon"></i>
							<span>{{$t('eventLang.event_processing')}}</span>
						</div>
					</div>
				</div>
				<div class="info-content flex-wrap" v-if="infoData!=null">
					<div class="item">
						<div class="name">{{$t('eventLang.event_id')}}</div>
						<div class="value num">{{infoData.id}}</div>
					</div>
					<div class="item">
						<div class="name">{{$t('eventLang.event_name')}}</div>
						<div class="value">{{infoData.name}}</div>
					</div>
					<div class="item">
						<div class="name">{{$t('eventLang.equipment_id')}}</div>
						<div class="value">{{infoData.equipment_id}}</div>
					</div>
					<div class="item">
						<div class="name">{{$t('eventLang.aprus_id')}}</div>
						<div class="value num">{{infoData.aprus_id}}</div>
					</div>
					<div class="item">
						<div class="name">{{$t('eventLang.code')}}</div>
						<div class="value num">{{infoData.code}}</div>
					</div>
					<div class="item">
						<div class="name">{{$t('eventLang.created')}}</div>
						<div class="value num">{{infoData.created}}</div>
					</div>
					<div class="item">
						<div class="name">{{$t('eventLang.event_type')}}</div>
						<div class="value num">{{infoData.type}}</div>
					</div>
					<div class="item desc">
						<div class="name">{{$t('eventLang.description')}}</div>
						<div class="value num">{{getDescriptionLabel(infoData.description)}}</div>
					</div>
				</div>
			</div>
			<div class="record-list">
				<div class="record-title-wrap flex-wrap">
					<div class="record-title">{{$t('eventLang.processing_record')}}</div>
				</div>
				<div class="list-wrap">
					<table>
						<thead>
							<tr>
								<th>{{$t('eventLang.processing_id')}}</th>
								<th>{{$t('eventLang.processing_name')}}</th>
								<th>{{$t('eventLang.processing_date')}}</th>
								<th>{{$t('eventLang.processing_type')}}</th>
								<th>{{$t('eventLang.processing_staff')}}</th>
								<th>{{$t('eventLang.processing_description')}}</th>
								<th>{{$t('eventLang.processing_annex')}}</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(item,index) in recordData" :key="index">
								<td>{{item.service_id}}</td>
								<td>{{item.service_name}}</td>
								<td>{{item.date}}</td>
								<td>{{item.category}}</td>
								<td>{{item.staff}}</td>
								<td>{{getDescriptionLabel(item.description)}}</td>
								<td>
									<a
										@click="downloadFile(item.attachment)"
									>{{getFileName(item.attachment)}}</a>
								</td>
							</tr>
							<tr v-if="recordData==null||recordData.length==0">
								<td colspan="7">
									<div class="nodata">{{$t('common.no_data')}}</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="page-btn-wrap flex-wrap">
					<div class="block flex-wrap" v-show="true">
						<el-pagination
							background
							class="mix-pagination"
							@size-change="handleSizeChange"
							@current-change="getServiceList"
							:current-page.sync="currentPage"
							:page-sizes="[10,15,20,25,30]"
							:page-size="currentPageSize"
							layout="prev, pager, next, sizes, jumper"
							:total="totalNumber"
						></el-pagination>
					</div>
				</div>
			</div>
		</div>

		<div class="md-mask" :class="{ 'active': md.mask}"></div>
		<div class="md-loading" :class="{ 'active': md.loading}">
			<i class="el-icon-loading md-loading-icon"></i>
		</div>
		<!--事件处理modal-->
		<div class="md-modal-container">
			<div class="md-modal md-effect-1 createService" :class="{ 'md-show': md.createService}">
				<div class="md-content">
					<!--头部-->
					<div class="titleBox flex-wrap flex-center">
						<div class="title">{{$t('eventLang.event_processing')}}</div>
						<div class="iconWrap" @click="closeMd('createService')">
							<i class="close"></i>
						</div>
					</div>
					<!--内容-->
					<div class="contBox">
						<div class="serviceItemTable">
							<table>
								<colgroup>
									<col width="50%">
									<col width="*">
								</colgroup>
								<tr>
									<td>
										<div class="descTitle">{{$t('eventLang.processing_date')}}</div>
										<div class="block">
											<el-date-picker
												v-model="serviceCreateTime"
												type="datetime"
												value-format="yyyy-MM-dd HH:mm:ss"
												:placeholder="$t('el.datepicker.selectDate')"
												:picker-options="{
													disabledDate(time) {
														return time.getTime() > Date.now();
													}
												}"
											></el-date-picker>
										</div>
									</td>
									<td>
										<div class="descTitle">{{$t('eventLang.processing_type')}}</div>
										<div class="block">
											<el-select
												v-model="serviceTypeValue"
												:placeholder="$t('el.select.placeholder')"
											>
												<el-option
													v-for="item in serviceTypeOptions"
													:key="item.value"
													:label="item.label"
													:value="item.label"
												></el-option>
											</el-select>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="descTitle">{{$t('eventLang.processing_staff')}}</div>
										<div class="block">
											<el-input
												v-model="servicePersonValue"
												:placeholder="$t('common.placeholder_input')"
											></el-input>
										</div>
									</td>
									<td>
										<div class="descTitle">{{$t('eventLang.processing_name')}}</div>
										<div class="block">
											<el-input
												v-model="serviceNameValue"
												:placeholder="$t('common.placeholder_input')"
											></el-input>
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="descTitle">{{$t('eventLang.customer_id')}}</div>
										<div class="block">
											<el-select
												v-model="serviceCustomerId"
												:placeholder="$t('el.select.placeholder')"
											>
												<el-option
													v-for="item in serviceCustomerData"
													:key="item.customer_id"
													:label="item.customer_name"
													:value="item.customer_id"
												></el-option>
											</el-select>
										</div>
									</td>
									<td>
										<div class="descTitle">{{$t('eventLang.equipment_id')}}</div>
										<div class="block">
											<el-select
												v-model="serviceEquipmentId"
												:placeholder="$t('el.select.placeholder')"
											>
												<el-option
													v-for="item in serviceEquipmentData"
													:key="item.equipment_id"
													:label="item.equipment_name"
													:value="item.equipment_id"
												></el-option>
											</el-select>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<div
											class="descTitle"
										>{{$t('eventLang.processing_description')}}</div>
										<el-input
											type="textarea"
											:rows="3"
											:placeholder="$t('common.placeholder_input')"
											v-model="serviceDescriptionTextarea"
										></el-input>
									</td>
								</tr>
								<tr>
									<td colspan="2">
										<div class="descTitle">{{$t('eventLang.processing_annex')}}</div>
										<div class="serverFileBtn">
											<el-upload
												action
												list-type="picture-card"
												:limit="1"
												:http-request="upload"
												:file-list="serviceFileList"
												:on-remove="handleRemove"
											>
												<i class="el-icon-plus"></i>
											</el-upload>
										</div>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div class="buttomBox flex-wrap flex-center">
						<input
							type="button"
							class="btn_cancel"
							@click="closeMd('createService')"
							:value="$t('common.btn_cancel')"
						>
						<input
							type="button"
							class="btn_determine"
							@click="createService"
							:value="$t('common.btn_determine')"
						>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import eventApi from "@/assets/js/fetch/event";
import faultApi from "@/assets/js/fetch/fault";
import alarmApi from "@/assets/js/fetch/alarm";
import deviceApi from "@/assets/js/fetch/device";
import customerApi from "@/assets/js/fetch/customer";
import serviceApi from "@/assets/js/fetch/service";

export default {
	name: "eventDetail",
	data() {
		return {
			eventId: null,
			eventType: '',
			infoData: null,
			recordData: null,
			currentPage: 1,
			currentPageSize: 10,
			totalNumber: 0,
			// 创建服务
			serviceTypeOptions: [
				{ value: 0, label: this.$t("eventLang.replacement_parts") },
				{ value: 1, label: this.$t("eventLang.equipment_repair") },
				{ value: 2, label: this.$t("eventLang.regular_maintenance") },
				{ value: 3, label: this.$t("eventLang.troubleshooting") },
				{ value: 4, label: this.$t("eventLang.alarm_processing") },
				{ value: 5, label: this.$t("eventLang.other") }
			],
			serviceCreateTime: "",
			serviceTypeValue: "",
			servicePersonValue: "",
			serviceNameValue: "",
			serviceCustomerId: "",
			serviceCustomerData: [],
			serviceEquipmentId: "",
			serviceEquipmentData: [],
			serviceDescriptionTextarea: "",
			serviceFilePath: "",
			serviceFileList: [],
			// 弹框控制
			md: {
				mask: false,
				loading: false,
				createService: false
			}
		};
	},

	created() {},
	mounted() {
		let query = this.$route.query;
		this.eventId = query.id || null;
		this.eventType = query.type || '';
		if (!query.id || !query.type) {
			this.$router.push({ name: "event", path: "/event" });
		}
		this.getInfoByType();
	},
	methods: {
		getFileName(path) {
			if (path && path.indexOf("/")) {
				let tmp = path.split("/");
				return tmp[tmp.length - 1];
			}
			return "";
		},
		getDescriptionLabel(desc){
			console.log(desc)
			let result = '';
			try {
				let labelObj = JSON.parse(desc);
				result = this.$i18n.locale == 'en' ? labelObj.Label_En : labelObj.Label_Cn;
			} catch (error) {
				result = desc;
			}
			return result
		},
		getInfoByType() {
			if (!this.eventType) {
				return;
			}
			switch (this.eventType) {
				case "event":
					this.getEventInfo();
					break;
				case "fault":
					this.getFaultInfo();
					break;
				case "alert":
					this.getAlarmInfo();
					break;
				default:
			}
			this.getServiceList();
		},
		getEventInfo() {
			if (!this.eventId) {
				return;
			}
			let self = this;
			self["loading"] = true;
			eventApi.get_event_detail(
				function(data) {
					if (data.code == 200) {
						self.infoData = data.result;
						self.infoData["id"] = data.result["event_id"];
						self.infoData["name"] = data.result["event_name"];
						self.infoData["type"] = self.$t("eventLang.evnet");
					}
					self["loading"] = false;
				},
				{ event_id: this.eventId }
			);
		},
		getFaultInfo() {
			if (!this.eventId) {
				return;
			}
			let self = this;
			self["loading"] = true;
			faultApi.get_fault_detail(
				function(data) {
					if (data.code == 200) {
						self.infoData = data.result;
						self.infoData["id"] = data.result["fault_id"];
						self.infoData["name"] = data.result["fault_name"];
						self.infoData["type"] = self.$t("eventLang.fault");
					}
					self["loading"] = false;
				},
				{ fault_id: this.eventId }
			);
		},
		getAlarmInfo() {
			if (!this.eventId) {
				return;
			}
			let self = this;
			self["loading"] = true;
			alarmApi.get_alarm_detail(
				function(data) {
					if (data.code == 200) {
						self.infoData = data.result;
						self.infoData = data.result;
						self.infoData["id"] = data.result["alert_id"];
						self.infoData["name"] = data.result["alert_name"];
						self.infoData["type"] = self.$t("eventLang.alarm");
					}
					self["loading"] = false;
				},
				{ alert_id: this.eventId }
			);
		},
		getServiceList() {
			if (!this.eventId) {
				return;
			}
			let self = this;
			serviceApi.get_list(
				function(data) {
					if (data.code == 200) {
						self.recordData = data.result.data;
						self.totalNumber = data.result.total_records;
					}
				},
				{
					is_all: 0,
					page_index: this.currentPage,
					page_size: this.currentPageSize,
					condition: JSON.stringify([
						["reference", "=", this.eventType + ":" + this.eventId]
					])
				}
			);
		},
		handleSizeChange(val) {
			this.currentPageSize = val;
			this.getServiceList();
		},
		// 创建服务
		openCreateServiceWin() {
			// 重置输入框
			this.serviceCreateTime = this.getCurrentTime();
			this.serviceTypeValue = "";
			this.servicePersonValue =
				this.userName ||
				JSON.parse(localStorage.getItem("user")).username;
			this.serviceNameValue = "";
			this.serviceDescriptionTextarea = "";
			this.serviceFilePath = "";
			this.serviceFileList = [];
			this.getEquipmentList();
			this.getCustomerList();
			this.serviceEquipmentId = this.infoData
				? this.infoData.equipment_id
				: "";
			if (this.serviceEquipmentId != "") {
				//通过设备ID查找客户编号
				this.getEquipmentInfo();
			}
			this.showMd("createService");
		},
		getCurrentTime() {
			let time = "";
			let date = new Date();
			let year = date.getFullYear();
			let month = date.getMonth() + 1;
			let day = date.getDate();
			let h = date.getHours();
			let m = date.getMinutes();
			let s = date.getSeconds();
			time =
				year +
				"-" +
				formatStr(month) +
				"-" +
				formatStr(day) +
				" " +
				formatStr(h) +
				":" +
				formatStr(m) +
				":" +
				formatStr(s);
			function formatStr(str) {
				str = str > 0 && str < 10 ? "0" + str : str;
				return str;
			}
			return time;
		},
		getCustomerList() {
			let self = this;
			customerApi.get_menu_list(
				function(data) {
					if (data.code == 200) {
						self.serviceCustomerData = data.result.data;
					}
				},
				{ is_all: 1 }
			);
		},
		getEquipmentList() {
			let self = this;
			deviceApi.get_menu_list(
				function(data) {
					if (data.code == 200) {
						self.serviceEquipmentData = data.result.data;
					}
				},
				{ is_all: 1 }
			);
		},
		getEquipmentInfo() {
			let self = this;
			deviceApi.get_detail(
				function(data) {
					if (data.code == "200") {
						if (data.result.length == 0) {
							return;
						}
						self.serviceCustomerId = data.result.customer_id;
					}
				},
				{ equipment_id: this.infoData.equipment_id }
			);
		},
		createService() {
			if (this.serviceNameValue == "") {
				this.$alert(
					this.$t("eventLang.processing_name_not_null"),
					this.$t("eventLang.event_processing"),
					{
						confirmButtonText: this.$t("el.messagebox.confirm")
					}
				);
				return false;
			}
			//开始时间和结束时间判断
      if(new Date(this.serviceCreateTime)>new Date()){
          this.$confirm(this.$t('common.exceed_current_time'), this.$t('common.tip'), {
          confirmButtonText: this.$t('el.messagebox.confirm'),
          cancelButtonText: this.$t('el.messagebox.cancel'),
          type: 'warning'
        });
        this.md['loading'] = false;
        return;
      }

			let data = {
				service_name: this.serviceNameValue,
				date: this.serviceCreateTime,
				category: this.serviceTypeValue,
				description: this.serviceDescriptionTextarea,
				attachment: this.serviceFilePath,
				staff: this.servicePersonValue,
				customer_id: this.serviceCustomerId,
				equipment_id: this.serviceEquipmentId,
				reference: this.eventType + ":" + (this.infoData ? this.infoData.id : this.eventId ? this.eventId : ""),
				language: this.$i18n.locale == 'en' ? 'en' : 'zh_cn'
			};
			let self = this;
			serviceApi.add(function(data) {
				if (data.code == 200) {
					self.closeMd("createService");
					self.serviceNameValue = "";
					self.serviceCreateTime = "";
					self.serviceTypeValue = "";
					self.serviceDescriptionTextarea = "";
					self.getServiceList();
				}
			}, data);
		},
		upload(item) {
			let formData = new FormData();
			formData.append("upload_file", item.file);
			formData.append("type", "service");
			let self = this;
			deviceApi.upload(function(data) {
				if (data.code == 200) {
					self.serviceFilePath = data.result.path;
					let type = item.file.type.split("/");
					if (type[0] != "image") {
						self.serviceFileList.push({
							name: item.file.name,
							url: "./modules/pro/static/images/public/uploadfile.png"
						});
					}
				}
			}, formData);
		},
		handleRemove() {
			this.serviceFileList = [];
		},
		downloadFile(path) {
			if (path == "" || path == null) {
				return;
			}
			deviceApi.download(path);
		},
		showMd: function(md) {
			this.md[md] = true;
			this.md.mask = true;
		},
		closeMd: function(md) {
			this.md[md] = false;
			this.md.mask = false;
		}
	}
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/event/detail.scss";
</style>
