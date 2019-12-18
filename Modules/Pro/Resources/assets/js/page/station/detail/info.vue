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
	<div class="detail-wrap flex-column">
		<div class="cont-view flex-column flex-con-1" v-if="equipmentId!=''">
			<router-view v-on:nav-title="onNavTitle" :equipmentId="Number(equipmentId)"></router-view>
		</div>
		<div class="info-content-wrap" v-else>
			<div class="base-info">
				<div class="info-title-wrap flex-wrap">
					<div
						class="info-title"
					>{{$t('stationLang.base_info',[$t("systemLang['"+systemName+"']")])}}</div>
					<div class="info-btn-wrap flex-wrap">
						<!-- <div class="create-service-btn" @click="openServiceWin">
							<i class="mix-add-icon"></i>
							<span>创建服务</span>
						</div>-->
						<div class="edit-btn" @click="openEditEquipmentInfoWin">
							<i class="mix-edit-icon"></i>
						</div>
						<div class="refresh-btn" @click="refresh">
							<i class="mix-refresh-icon"></i>
						</div>
					</div>
				</div>
				<div class="info-content flex-wrap" v-if="stationInfoData!=null">
					<div class="left-content">
						<div class="item">
							<div
								class="name"
							>{{$t('stationLang.group_image',[$t("systemLang['"+systemName+"']")])}}</div>
							<div class="value">
								<img
									v-if="stationInfoData.image!=''&&stationInfoData.image!=null"
									:src="pichost+stationInfoData.image"
									alt
								>
								<img
									src="../../../../images/public/no-image-icon.gif"
									alt
									v-else
								>
							</div>
						</div>
					</div>
					<div class="right-content flex-wrap">
						<div class="item">
							<div
								class="name"
							>{{$t('stationLang.group_id',[$t("systemLang['"+systemName+"']")])}}</div>
							<div class="value num">{{stationInfoData.group_id}}</div>
						</div>
						<div class="item">
							<div
								class="name"
							>{{$t('stationLang.group_name',[$t("systemLang['"+systemName+"']")])}}</div>
							<div class="value">{{stationInfoData.group_name}}</div>
						</div>
						<div class="item">
							<div
								class="name"
							>{{$t('stationLang.group_created',[$t("systemLang['"+systemName+"']")])}}</div>
							<div class="value num">{{stationInfoData.created}}</div>
						</div>
						<div class="item">
							<div class="name">{{$t('stationLang.customer_id')}}</div>
							<div class="value num">{{stationInfoData.customer_id}}</div>
						</div>
						<div class="item">
							<div class="name">{{$t('stationLang.customer_name')}}</div>
							<div class="value num">{{stationInfoData.customer_name}}</div>
						</div>
						<div class="item">
							<div
								class="name"
							>{{$t('stationLang.group_address',[$t("systemLang['"+systemName+"']")])}}</div>
							<div class="value num">{{stationInfoData.gis}}</div>
						</div>
						<div class="item desc">
							<div
								class="name"
							>{{$t('stationLang.group_description',[$t("systemLang['"+systemName+"']")])}}</div>
							<div class="value num" :title="stationInfoData.description">{{stationInfoData.description}}</div>
						</div>
					</div>
				</div>
			</div>
			<div class="equipment-list">
				<div class="equipment-list-title-wrap flex-wrap">
					<div
						class="equipment-list-title"
					>{{$t('stationLang.association_equipment_info')}}</div>
				</div>
				<div class="equipment-list-table">
					<div class="list-header">
						<table>
							<thead>
								<tr>
									<th>{{$t('stationLang.equipment_image')}}</th>
									<th>{{$t('stationLang.equipment_id')}}</th>
									<th>{{$t('stationLang.equipment_name')}}</th>
									<th>{{$t('stationLang.equipment_model')}}</th>
									<th>{{$t('stationLang.equipment_status')}}</th>
									<th>{{$t('stationLang.aprus_id')}}</th>
									<th>{{$t('stationLang.equipment_create')}}</th>
								</tr>
							</thead>
						</table>
					</div>
					<div class="list-body">
						<table>
							<tbody>
								<tr v-for="(item,index) in listData" :key="index" @click="enterDetailPage(item)">
									<td>
										<img
											:src="pichost+item.equipment_image"
											alt
											v-if="item.equipment_image!=''&&item.equipment_image!=null"
										>
										<img
											src="../../../../images/public/no-image-icon.gif"
											alt
											v-else
										>
									</td>
									<td>{{item.equipment_id}}</td>
									<td>{{item.equipment_name}}</td>
									<td>{{item.model}}</td>
									<td>
										<div class="status-wrap flex-wrap">
											<i
												class="status-icon offline"
												v-if="item.status_code==-1"
											></i>
											<i
												class="status-icon online"
												v-if="item.status_code!=-1"
											></i>
											<i class="status-icon boot" v-if="item.status_code==1"></i>
											<i
												class="status-icon shutdown"
												v-if="item.status_code==0"
											></i>
											<i
												class="status-icon warn"
												v-if="getStatusMsg(item.status_name)"
											></i>
										</div>
									</td>
									<td>{{item.aprus_list}}</td>
									<td>{{item.created}}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<el-collapse v-model="activeName" class="mix-collapse">
				<el-collapse-item
					class="energy-info"
					v-for="(item,index) in stationInfoDataAddition"
					:title="item.title"
					:name="index"
					:key="index"
				>
					<div class="content-info flex-wrap">
						<div class="item" v-for="(sub,index) in item.data" :key="index">
							<div class="subtext">{{sub[0]}}</div>
							<div class="name">{{sub[1]}}</div>
						</div>
					</div>
				</el-collapse-item>
			</el-collapse>
			<!--弹框-->
			<div class="md-mask" :class="{ 'active': md.mask}"></div>
			<div class="md-loading" :class="{ 'active': md.loading}">
				<i class="el-icon-loading md-loading-icon"></i>
			</div>
			<!-- 编辑设备信息 start -->
			<div class="md-modal-container">
				<div class="md-modal md-effect-1 editBaseInfo" :class="{ 'md-show': md.edit}">
					<div class="md-content">
						<!--头部-->
						<div class="titleBox flex-wrap flex-center">
							<div class="title">{{$t('stationLang.edit_info')}}</div>
							<div class="iconWrap" @click="closeEditEquipmentInfoWin">
								<i class="close"></i>
							</div>
						</div>
						<!--内容-->
						<div class="contBox">
							<div class="editBaseInfoWrap">
								<div class="deviceBaseInfo" v-if="stationInfoData!=null">
									<div
										class="title"
									>{{$t('stationLang.base_info',[$t("systemLang['"+systemName+"']")])}}</div>
									<div class="contentInfo">
										<table class="deviceDetailInfo">
											<colgroup>
												<col width="*">
												<col width="*">
												<col width="*">
												<col width="*">
											</colgroup>
											<tr>
												<td rowspan="3" class="center">
													<div
														class="subtext"
													>{{$t('stationLang.group_image',[$t("systemLang['"+systemName+"']")])}}</div>
													<img
														:src="pichost+stationInfoData.image"
														alt
														v-if="stationInfoData.image!=null&&stationInfoData.image!='null'&&stationInfoData.image!=''"
													>
													<img
														src="../../../../images/public/no-image-icon.gif"
														alt
														v-else
													>
												</td>
												<td>
													<div
														class="subtext"
													>{{$t('stationLang.group_id',[$t("systemLang['"+systemName+"']")])}}</div>
													<div class="name">{{stationInfoData.group_id}}</div>
												</td>
												<td>
													<div
														class="subtext"
													>{{$t('stationLang.group_name',[$t("systemLang['"+systemName+"']")])}}</div>
													<div class="name">{{stationInfoData.group_name}}</div>
												</td>
												<td>
													<div
														class="subtext"
													>{{$t('stationLang.group_created',[$t("systemLang['"+systemName+"']")])}}</div>
													<div class="name">{{stationInfoData.created}}</div>
												</td>
											</tr>
											<tr>
												<td>
													<div
														class="subtext"
													>{{$t('stationLang.customer_id')}}</div>
													<div
														class="name"
													>{{stationInfoData.customer_id}}</div>
												</td>
												<td>
													<div
														class="subtext"
													>{{$t('stationLang.customer_name')}}</div>
													<div
														class="name"
													>{{stationInfoData.customer_name}}</div>
												</td>
												<td>
													<div class="subtext">{{$t('stationLang.group_address',[$t("systemLang['"+systemName+"']")])}}</div>
													<div class="name">{{stationInfoData.gis}}</div>
												</td>
											</tr>
											<tr>
												<td colspan="3">
													<div
														class="subtext"
													>{{$t('stationLang.group_description',[$t("systemLang['"+systemName+"']")])}}</div>
													<div class="name">
														<el-input
															type="textarea"
															class="mix-input"
															:rows="3"
															:placeholder="$t('common.placeholder_input')"
															v-model="editTextarea"
														></el-input>
													</div>
												</td>
											</tr>
										</table>
									</div>
								</div>
								<div
									class="energyInfo"
									v-for="(item,index) in editstationInfoDataAddition"
									:title="item.title"
									:name="index"
									:key="index"
								>
									<div class="title">{{item.title}}</div>
									<div class="contentInfo flex-wrap">
										<div class="item" v-for="(sub,index) in item.data" :key="index">
											<div class="subtext">{{sub[0]}}</div>
											<div class="name">
												<el-input
													v-model="sub[1]"
													:placeholder="$t('common.placeholder_input')"
													:value="sub[1]"
													class="mix-input"
												></el-input>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- 按钮 -->
						<div class="buttomBox flex-wrap flex-center">
							<input
								type="button"
								class="btn_cancel"
								:value="$t('common.btn_cancel')"
								@click="closeEditEquipmentInfoWin"
							>
							<input
								type="button"
								class="btn_determine"
								:value="$t('common.btn_determine')"
								@click="editStationInfo"
							>
						</div>
					</div>
				</div>
			</div>
			<!-- 编辑设备信息 end -->
			<!-- 创建服务 win start -->
			<div class="md-modal-container">
				<div class="md-modal md-effect-1 addDevice" :class="{ 'md-show': md.add}">
					<div class="md-content">
						<!--头部-->
						<div class="titleBox flex-wrap flex-center">
							<div class="title">{{$t('stationLang.create_service')}}</div>
							<div class="iconWrap" @click="closeMd('add')">
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
											<div
												class="descTitle"
											>{{$t('stationLang.service_date')}}</div>
											<div class="block">
												<el-date-picker
													v-model="serviceCreateTime"
													type="datetime"
													class="mix-input"
													value-format="yyyy-MM-dd HH:mm:ss"
													:picker-options="{
														disabledDate(time) {
															return time.getTime() > Date.now();
														}
													}"
													:placeholder="$t('el.datepicker.selectDate')"
												></el-date-picker>
											</div>
										</td>
										<td>
											<div
												class="descTitle"
											>{{$t('stationLang.service_category')}}</div>
											<div class="block">
												<el-select
													v-model="serviceTypeValue"
													:placeholder="$t('el.select.placeholder')"
													class="mix-select"
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
											<div
												class="descTitle"
											>{{$t('stationLang.service_staff')}}</div>
											<div class="block">
												<el-input
													v-model="servicePersonValue"
													:placeholder="$t('common.placeholder_input')"
													class="mix-input"
												></el-input>
											</div>
										</td>
										<td>
											<div
												class="descTitle"
											>{{$t('stationLang.service_name')}}</div>
											<div class="block">
												<el-input
													v-model="serviceNameValue"
													:placeholder="$t('common.placeholder_input')"
													class="mix-input"
												></el-input>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="descTitle">{{$t('stationLang.customer_id')}}</div>
											<div class="block">
												<el-select
													v-model="serviceCustomerId"
													:placeholder="$t('el.select.placeholder')"
													class="mix-select"
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
											<div
												class="descTitle"
											>{{$t('stationLang.equipment_id')}}</div>
											<div class="block">
												<el-select
													v-model="serviceEquipmentId"
													:placeholder="$t('el.select.placeholder')"
													class="mix-select"
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
											>{{$t('stationLang.service_description')}}</div>
											<el-input
												type="textarea"
												class="mix-input"
												:rows="3"
												:placeholder="$t('common.placeholder_input')"
												v-model="serviceDescriptionTextarea"
											></el-input>
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<div
												class="descTitle"
											>{{$t('stationLang.service_annex')}}</div>
											<div class="serverFileBtn">
												<el-upload
													action
													list-type="picture-card"
													:limit="1"
													:http-request="uploadService"
													:file-list="serviceFileList"
													:on-remove="serviceHandleRemove"
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
								:value="$t('common.btn_cancel')"
								@click="closeMd('add')"
							>
							<input
								type="button"
								class="btn_determine"
								:value="$t('common.btn_determine')"
								@click="addService"
							>
						</div>
					</div>
				</div>
			</div>
			<!-- 创建服务 win end -->
		</div>
	</div>
</template>

<script>
import system from "$system";
import deviceApi from "@/assets/js/fetch/device";
import stationApi from "@/assets/js/fetch/station";
import customerApi from "@/assets/js/fetch/customer";
import config from "$config";
export default {
	name: "customer",
	props: {
		groupId: Number,
		mainEquipmentId: Number
	},
	data() {
		return {
			systemName: system.name,
			pichost: config.apiq.pictureAddress,
			equipmentId: "",
			listData: null,
			activeName: "",
			stationInfoData: null,
			stationInfoDataAddition: {},
			editTextarea: "",
			editstationInfoDataAddition: {},
			serviceEquipmentData: [],
			serviceTypeOptions: [
				{ value: 0, label: this.$t("stationLang.daily_inspection") },
				{ value: 1, label: this.$t("stationLang.equipment_repair") },
				{ value: 2, label: this.$t("stationLang.regular_maintenance") },
				{ value: 3, label: this.$t("stationLang.troubleshooting") },
				{ value: 4, label: this.$t("stationLang.alarm_processing") },
				{ value: 5, label: this.$t("stationLang.other") }
			],
			serviceTypeValue: "",
			servicePersonValue: "",
			serviceNameValue: "",
			serviceCreateTime: "",
			serviceCustomerId: "",
			serviceCustomerData: [],
			serviceEquipmentId: "",
			serviceDescriptionTextarea: "",
			serviceFilePath: "",
			serviceFileList: [],
			// 弹窗控制
			md: {
				mask: false,
				loading: false,
				add: false
			}
		};
	},
	created() {},
	mounted() {
		// console.log(this.mainEquipmentId);
		this.getStationInfo(this.groupId);
		this.getStationEquipmentList(this.groupId);
	},
	methods: {
		refresh() {
			this.getStationInfo(this.groupId);
		},
		getStationInfo(id) {
			if (!this.groupId) {
				return;
			}
			let self = this;
			self.md["loading"] = true;
			stationApi.get_detail(
				function(data) {
					if (data.code == "200") {
						self.stationInfoData = data.result;
						self.stationInfoDataAddition = JSON.parse(
							data.result.addition
						);
												self.editstationInfoDataAddition = self.stationInfoDataAddition;
					}
					self.md["loading"] = false;
				},
				{ group_id: this.groupId }
			);
		},
		getStationEquipmentList(id) {
			if (!this.groupId) {
				return;
			}
			let self = this;
			stationApi.get_equipment_list(
				function(data) {
					if (data.code == 200) {
						self.listData = data.result.data;
					}
				},
				{ group_id: this.groupId }
			);
		},
		enterDetailPage(item) {
			// console.log(item);
			// return;
			this.equipmentId = item.equipment_id;
			this.$emit("nav-title", {
				name: item.equipment_name,
				id: item.equipment_id,
				isDevice: true
			});
			this.$router.push({
				name: "stationDetailEquipment",
				path: "/station/detail/equipment",
				query: {
					id: item.equipment_id
				},
				params: {
					equipmentId: item.equipment_id,
					equipmentName: item.equipment_name
				}
			});
		},
		onNavTitle(data) {
			this.$emit("nav-title", data.name);
			this.equipmentId = data.id;
		},
		openEditEquipmentInfoWin() {
			if (!this.stationInfoData) {
				this.$alert(
					this.$t("stationLang.no_eidt_equipment_info"),
					this.$t("stationLang.edit_info"),
					{
						confirmButtonText: this.$t("el.messagebox.confirm")
					}
				);
				return;
			}
			this.showMd("edit");
			let self = this;
			stationApi.get_detail(
				function(data) {
					if (data.code == "200") {
						self.stationInfoData = data.result;
						self.editstationInfoDataAddition = JSON.parse(
							data.result.addition
						);
						self.editTextarea = self.stationInfoData.description;
					}
				},
				{ group_id: this.groupId }
			);
		},
		closeEditEquipmentInfoWin() {
			this.closeMd("edit");
			this.editTextarea = "";
			this.editstationInfoDataAddition = null;
		},
		editStationInfo() {
			let data = {};
			data.group_id = this.stationInfoData.group_id;
			data.main_equipment = this.mainEquipmentId;
			data.description = this.editTextarea;
			data.addition = "";
			if (this.editstationInfoDataAddition != null) {
				data.addition = JSON.stringify(
					this.editstationInfoDataAddition
				);
			}
			let self = this;
			stationApi.edit_group_equipment(function(data) {
				if (data.code == 200) {
					self.closeMd("edit");
					self.getStationInfo(self.groupId);
					self.$message(data.msg, "success");
					// self.stationInfoData.description = self.editTextarea;
					// self.stationInfoDataAddition = self.editstationInfoDataAddition;
				}
			}, data);
		},
		openServiceWin() {
			//重置输入框的值
			this.serviceTypeValue = "";
			this.servicePersonValue =
				this.userName ||
				JSON.parse(localStorage.getItem("user")).username;
			this.serviceNameValue = "";
			this.serviceCreateTime = this.getCurrentTime();
			this.serviceDescriptionTextarea = "";
			this.serviceFilePath = "";
			this.serviceFileList = [];
			this.serviceEquipmentId = this.stationInfoData
				? this.stationInfoData.equipment_id
				: "";
			this.serviceCustomerId = this.stationInfoData
				? this.stationInfoData.customer_id
				: "";
			this.getCustomerList();
			this.getEquipmentList();
			// 打开窗口
			this.showMd("add");
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
		addService() {
			if (this.serviceNameValue == "") {
				this.$alert(
					this.$t("stationLang.service_name_not_null"),
					this.$t("stationLang.create_service"),
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
				staff: this.servicePersonValue,
				description: this.serviceDescriptionTextarea,
				attachment: this.serviceFilePath,
				customer_id: this.serviceCustomerId,
				equipment_id: this.serviceEquipmentId,
				reference: "equipment:" + this.serviceEquipmentId,
				language: this.$i18n.locale == 'en' ? 'en' : 'zh_cn'
			};
			let self = this;
			serviceApi.add(function(data) {
				if (data.code == 200) {
					self.closeMd("add");
					self.serviceNameValue = "";
					self.serviceCreateTime = "";
					self.serviceTypeValue = "";
					self.servicePersonValue = "";
					self.serviceDescriptionTextarea = "";
					self.$message(data.msg, "success");
				}
			}, data);
		},
		uploadService(item) {
			let formData = new FormData();
			formData.append("upload_file", item.file);
			formData.append("type", "service");
			// console.log(item.file);
			let self = this;
			deviceApi.upload(function(data) {
				if (data.code == 200) {
					self.serviceFilePath = data.result.path;
					let type = item.file.type.split("/");
					if (type[0] != "image") {
						self.serviceFileList.push({
							name: item.file.name,
							url:
								"./modules/pro/static/images/public/uploadfile.png"
						});
					}
				}
			}, formData);
		},
		serviceHandleRemove() {
			this.serviceFileList = [];
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
				str = str < 10 ? "0" + str : str;
				return str;
			}
			return time;
		},
		getStatusName(str) {
			let tmp = [];
			if (str && str.indexOf("|") >= 0) {
				tmp = str.split("|");
			} else {
				tmp.push(str);
			}
			return tmp[0];
		},
		getStatusMsg(str) {
			if (str && str.indexOf("|") >= 0) {
				return str.split("|")[1];
			} else {
				return false;
			}
		},
		// 弹框事件开关
		showMd(md) {
			this.md[md] = true;
			this.md.mask = true;
		},
		closeMd(md) {
			this.md[md] = false;
			this.md.mask = false;
		},
		updateRouteList(data) {
			if (
				/^\/station\/detail(?:\/(?=$))?$/i.test(data.path) &&
				this.equipmentId != "" &&
				this.groupId
			) {
				this.equipmentId = "";
				this.getStationInfo(this.groupId);
			}
		}
	},
	watch: {
		groupId: ["getStationInfo"],
		$route: "updateRouteList"
	}
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/station/detail/info.scss";
</style>
