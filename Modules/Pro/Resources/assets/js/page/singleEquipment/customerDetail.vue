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
<template lang="html">
  <div class="main flex-wrap">
    <div class="content flex-column">
      <div class="contBox flex-wrap flex-con-1">
        <div class="customerCont flex-column">
          <div class="customerContTop flex-wrap flex-center">
            <div class="customerContTopL flex-wrap">
              <div class="leftMenu1" @click="changeMenu(1)">客户信息
                <div class="buttomChoose" v-show="topMenu==1"></div>
              </div>
              <div class="leftMenu2" @click="changeMenu(2)">设备信息
                <div class="buttomChoose" v-show="topMenu==2"></div>
              </div>
              <div class="leftMenu3" @click="changeMenu(3)">服务记录
                <div class="buttomChoose" v-show="topMenu==3"></div>
              </div>
            </div>
            <div class="customerContTopR flex-wrap">
              <router-link :to="{ name: 'singleCustomerList', params: {} }">
                <div class="ic_return"></div>
              </router-link>
            </div>
          </div>
          <div class="customerContNext  flex-con-1"  v-show="topMenu==1&&customer!=''">
            <div class="commonBox flex-wrap flex-center">
              <div class="commonDiv">
                <div class="title">客户编号</div>
                <div class="cont" v-if="customer.customer_id">{{customer.customer_id}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
              <div class="commonDiv">
                <div class="title">客户名称</div>
                <div class="cont" v-if="customer.customer_name">{{customer.customer_name}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
              <div class="commonDiv">
                <div class="title">省份</div>
                <div class="cont" v-if="customer.province">{{customer.province}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
            </div>
            <div class="commonBox flex-wrap flex-center">
              <div class="commonDiv">
                <div class="title">城市</div>
                <div class="cont" v-if="customer.city">{{customer.city}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
              <div class="commonDiv">
                <div class="title">电话</div>
                <div class="cont" v-if="customer.phone">{{customer.phone}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
              <div class="commonDiv">
                <div class="title">联系人</div>
                <div class="cont" v-if="customer.contact">{{customer.contact}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
            </div>
            <div class="commonBox flex-wrap flex-center">
              <div class="commonDiv">
                <div class="title">联系人手机</div>
                <div class="cont" v-if="customer.mobile">{{customer.mobile}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
              <div class="commonDiv">
                <div class="title">EXP标识</div>
                <div class="cont">PRO</div>
              </div>
              <div class="commonDiv hide">
                <div class="title">是否有效</div>
                <div class="cont" v-show="customer.is_available==1||customer.is_available==true">有效</div>
                <div class="cont" v-show="customer.is_available==0||customer.is_available==false">无效</div>
              </div>
              <div class="commonDiv">
                <div class="title">创建日期</div>
                <div class="cont" v-if="customer.created">{{customer.created}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
            </div>
            <div class="commonBox flex-wrap flex-center">
              <div class="commonDiv">
                <div class="title">邮箱</div>
                <div class="cont" v-if="customer.email">{{customer.email}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
              <div class="commonDiv"></div>
            </div>
            <div class="commonBox flex-wrap flex-center">
              <div class="commonDiv hightAuto changeLine">
                <div class="title">地址</div>
                <div class="cont" v-if="customer.address">{{customer.address}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
            </div>
            <div class="commonBox flex-wrap flex-center">
              <div class="commonDiv hightAuto changeLine">
                <div class="title">描述</div>
                <div class="cont" v-if="customer.description">{{customer.description}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
            </div>
          </div>

          <div class="customerContNext2 flex-column flex-con-1" v-show="topMenu==2" @keyup.enter="getEquipmentList(pageSize,1,2)">
            <div class="serchBox flex-wrap flex-center">
              <el-select class="selectOne" v-model="searchTypeForsb" placeholder="请选择" size="medium">
                <el-option
                  v-for="item in equipmentOptions"
                  :key="item.value"
                  :label="item.label"
                  :value="item.value">
                </el-option>
              </el-select>
              <el-select class="selectTwo" v-model="searchStyleSb" placeholder="请选择" size="medium">
                  <el-option
                    v-for="item in options2"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
                  </el-option>
              </el-select>
              <el-input v-model="searchKeySb" class="search" placeholder="请输入搜索内容" size="medium"></el-input>
              <div class="searchBtn flex-wrap flex-center" @click="getEquipmentList(pageSize,1,2)"><div class="ic_search"></div>搜索</div>
              <div class="ic_refresh"  @click="getEquipmentList(pageSize,1,1)"></div>
            </div>
            <div class="menuTitle flex-wrap flex-center">
              <div class="menuPic menuPublic">设备图片</div>
              <div class="flex1 menuPublic">设备ID</div>
              <div class="flex1 menuPublic">设备名称</div>
              <div class="flex1 menuPublic">设备型号</div>
              <div class="equipmentState menuPublic">设备状态</div>
              <div class="flex1 menuPublic">操作</div>
            </div>
            <div class="equipmentList flex-column flex-con-1">
              <div class="noSb" v-show="!equipmentListData">
                当前客户没有设备信息
              </div>
              <div class="list flex-wrap flex-center" v-for="(item,ce) in equipmentListData">
                <div class="listPicBox flex-wrap flex-center">
                  <img v-if="item.equipment_image!=null&&item.equipment_image!='null'&&item.equipment_image!=''" :src="pictureAddress+item.equipment_image" class="listPic border">
                  <img v-else src="../../../images/public/no-image-icon.gif" class="listPic">
                </div>
                <div class="flex1 listPublic">{{item.equipment_id}}</div>
                <div class="flex1 listPublic">{{item.equipment_name}}</div>
                <div class="flex1 listPublic" v-if="item.model!=null&&item.model!=''">{{item.model}}</div>
                <div class="flex1 listPublic" v-else>未编辑</div>
                <div class="equipmentState  listPublic">
                  <div class="yuanBox">
                    <div class="yuan" v-show="item.status_code==1"></div>
                    <div class="yuan red" v-show="item.status_code==-1"></div>
                    <div class="yuan yellow" v-show="item.status_code==-2"></div>
                    <div class="yuan blue" v-show="item.status_code==0"></div>
                    <div class="yuanText">{{item.status_name}}</div>
                  </div>
                </div>
                <div class="flex1 listPublic flex-wrap flex-center picCenter">
                  <div class="operation flex-wrap flex-center">
                    <router-link :to="{ name: 'equipment', params: {'equipment_id':item.equipment_id,'token':token,'customer_id':customerId}}">
                      <div class="operationPic"></div>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="customerContNext3 flex-column flex-con-1" v-show="topMenu==3&&!noData" @keyup.enter="getServerList(pageSize,1,2)">
            <div class="serchBox flex-wrap flex-center">
              <el-select class="selectOne" v-model="searchTypeForFw" placeholder="请选择" size="medium">
                <el-option
                  v-for="item in optionServerType"
                  :key="item.value"
                  :label="item.label"
                  :value="item.value">
                </el-option>
              </el-select>
              <el-select class="selectTwo" v-model="searchStyleFw" placeholder="请选择" size="medium">
                <el-option
                  v-for="item in optionStyleFw"
                  :key="item.value"
                  :label="item.label"
                  :value="item.value">
                </el-option>
              </el-select>
              <el-input v-model="searchKeyFw" class="search" placeholder="请输入搜索内容" size="medium"></el-input>
              <div class="searchBtn flex-wrap flex-center" @click="getServerList()"><div class="ic_search"></div>搜索</div>
              <div class="ic_refresh" @click="getServerList()"></div>
            </div>
            <div class="menuTitle flex-wrap flex-center">
              <div class="flex1 menuPublic">服务编号</div>
              <div class="flex1 menuPublic">服务名称</div>
              <div class="flex1 menuPublic">服务类型</div>
              <div class="flex1 menuPublic">服务人员</div>
              <div class="flex15 menuPublic">服务时间</div>
              <div class="flex1 menuPublic">操作</div>
            </div>
            <div class="equipmentList flex-column flex-con-1">
              <div class="noFw" v-show="noFw">
                当前客户没有服务信息
              </div>
                <div class="list flex-wrap flex-center" v-for="(item,index) in listServer">
                  <div class="flex1 listPublic">{{item.service_id}}</div>
                  <div class="flex1 listPublic">{{item.service_name}}</div>
                  <div class="flex1 listPublic" v-if="item.category!=''&&item.category!=null">{{item.category}}</div>
                  <div class="flex1 listPublic" v-else>未编辑</div>
                  <div class="flex1 listPublic" v-if="item.staff!=''&&item.staff!=null">{{item.staff}}</div>
                  <div class="flex1 listPublic" v-else>未编辑</div>
                  <div class="flex15 listPublic" v-if="item.date!=''&&item.date!=null">{{item.date}}</div>
                  <div class="flex1 listPublic" v-else>未编辑</div>
                  <div class="flex1 listPublic flex-wrap flex-center picCenter" @click="getServerDetail(item.service_id)">
                    <div class="operation flex-wrap flex-center">
                    <div class="operationPic"></div>
                  </div>
                  </div>
                </div>
            </div>
          </div>
          <el-pagination class="myPage flex-wrap flex-center" v-show="(topMenu==2||topMenu==3)&&!noData"
            background
            layout="prev, pager, next"
            :total="total"
            :page-size="pageSize"
            @current-change="currentChange"
            @size-change="sizeChange">
          </el-pagination>
        </div>
      </div>
    </div>
    <!--弹框-->
    <div class="md-mask" :class="{ 'active': md.mask}"></div>
    <!-- 查看服务详情-->
    <div class="md-modal-container">
      <div class="md-modal md-effect-1 lookDetailsElse"  :class="{ 'md-show': md.lookDetailsElse}">
        <div class="md-content">
          <!--头部-->
          <div class="titleBox flex-wrap flex-center">
            <div class="title">查看服务详情</div>
            <div class="iconWrap" @click="closeMd('lookDetailsElse')"><i class="close"></i></div>
          </div>
          <div class="contentBox flex-wrap">
            <div class="detailsListBox flex-wrap">
              <div class="listDiv">
                <div class="title">服务编号</div>
                <div class="cont" v-if="getDetailServer.service_id">{{getDetailServer.service_id}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
              <div class="listDiv">
                <div class="title">客户编号</div>
                <div class="cont" v-if="getDetailServer.customer_id">{{getDetailServer.customer_id}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
              <div class="listDiv">
                <div class="title">服务名称</div>
                <div class="cont" v-if="getDetailServer.service_name">{{getDetailServer.service_name}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
              <div class="listDiv">
                <div class="title">服务类型</div>
                <div class="cont" v-if="getDetailServer.category">{{getDetailServer.category}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
              <div class="listDiv">
                <div class="title">服务人员</div>
                <div class="cont" v-if="getDetailServer.staff!=''&&getDetailServer.staff!=null">{{getDetailServer.staff}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
              <div class="listDiv">
                <div class="title">服务日期</div>
                <div class="cont" v-if="getDetailServer.date">{{getDetailServer.date}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
              <div class="listDiv">
                <div class="title">服务附件</div>
                <div class="downloadBtn flex-wrap flex-center" @click="download(getDetailServer.attachment)">
                <div class="downloadPic"></div>
                立即下载
              </div>
              </div>
              <div class="shebeiMx">
                <div class="title">服务描述</div>
                <div class="cont" v-if="getDetailServer.description">{{getDetailServer.description}}</div>
                <div class="cont" v-else>未编辑</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </div>
  </div>
</template>

<script>
import deviceApi from "@/assets/js/fetch/device";
import customerApi from "@/assets/js/fetch/customer";
import serviceApi from "@/assets/js/fetch/service";
import config from "$config";
export default {
    name: "customerDetail",
    components: {},
    data() {
        return {
            customerId: "",
            token: "",
            pictureAddress: "",
            noData: false,
            noSb: false,
            noFw: false,
            listServer: "",
            topMenu: 1,
            customer: "",
            equipmentListData: null,
            total: 0,
            pageSize: 4,
            getDetailServer: "",
            //搜索杂七杂八
            searchKeySb: "",
            searchKeyFw: "",
            searchStyleSb: "like",
            searchTypeForsb: "equipment_id",
            searchStyleFw: "like",
            searchTypeForFw: "service_id",
            equipmentOptions: [
                {
                    value: "equipment_id",
                    label: "设备ID"
                },
                {
                    value: "equipment_name",
                    label: "设备名称"
                },
                {
                    value: "model",
                    label: "设备型号"
                }
            ],
            options2: [
                {
                    value: "like",
                    label: "包含"
                },
                {
                    value: "=",
                    label: "等于"
                }
            ],
            optionStyleFw: [
                {
                    value: "like",
                    label: "包含"
                },
                {
                    value: "=",
                    label: "等于"
                }
            ],
            optionServerType: [
                {
                    value: "service_id",
                    label: "服务编号"
                },
                {
                    value: "service_name",
                    label: "服务名称"
                },
                {
                    value: "category",
                    label: "服务类型"
                },
                {
                    value: "staff",
                    label: "服务人员"
                },
                {
                    value: "description",
                    label: "服务描述"
                }
            ],
            md: {
                mask: false,
                lookDetailsElse: false
            }
        };
    },
    mounted() {
        this.customerId = this.$route.params["customer_id"];
        this.token = this.$route.params["token"];
        if (this.customerId != "" && this.token != "") {
            this.getCustomerDetail();
        }
    },
    methods: {
        changeMenu(type) {
            this.topMenu = type;
            this.total = 0;
            if (type == "2") {
                this.getEquipmentList(this.pageSize, 1);
            } else if (type == "3") {
                this.getServerList(this.pageSize, 1, 1);
            }
        },
        getCustomerDetail() {
            let self = this;
            customerApi.get_customer(
                function(data) {
                    if (data.code == 200) {
                        self.customer = data.result;
                    }
                },
                { customer_id: this.customerId },
                this.token
            );
        },
        getEquipmentList(pageSize, pageIndex, type) {
            if (this.customerId == "" && this.token == "") {
                return;
            }
            let self = this;
            let condition = '[["customer_id", "=", "' + self.customerId + '"]]';
            if (self.searchKeySb != "") {
                condition =
                    '[["' +
                    self.searchTypeForsb +
                    '", "' +
                    self.searchStyleSb +
                    '", "' +
                    self.searchKeySb +
                    '"],["customer_id", "=", "' +
                    self.customerId +
                    '"]]';
            }
            deviceApi.get_all_list(
                function(data) {
                    if (data.code == 200) {
                        self.equipmentListData = data.result.data;
                        self.listData = data.result.data;
                        self.total = data.result.total_records;
                    }
                },
                {
                    page_size: pageSize,
                    page_index: pageIndex,
                    condition: condition
                },
                this.token
            );
        },
        getServerList(pageSize, pageIndex, type) {
            if (this.customerId == "" && this.token == "") {
                return;
            }
            let self = this;
            let condition = '[["customer_id", "=", "' + self.customerId + '"]]';
            if (self.searchKeyFw != "") {
                condition =
                    '[["' +
                    self.searchTypeForFw +
                    '", "' +
                    self.searchStyleFw +
                    '", "' +
                    self.searchKeyFw +
                    '"],["customer_id", "=", "' +
                    self.customerId +
                    '"]]';
            }
            serviceApi.get_list(
                function(data) {
                    if (data.code == 200) {
                        self.listServer = data.result.data;
                        self.total = data.result.total_records;
                    }
                },
                {
                    page_index: pageIndex,
                    page_size: pageSize,
                    condition: condition
                },
                this.token
            );
        },
        getServerDetail(serviceId) {
            let self = this;
            serviceApi.get(
                function(data) {
                    if (data.code == "200") {
                        self.getDetailServer = data.result;
                        self.showMd("lookDetailsElse");
                    }
                },
                { service_id: serviceId }
            );
        },
        currentChange(value) {
            if (this.topMenu == "2") {
                this.getEquipmentList(this.pageSize, value);
            } else if (this.topMenu == "3") {
                this.getServerList(this.pageSize, value, 1);
            }
        },
        sizeChange(value) {
            if (this.topMenu == "2") {
                this.getEquipmentList(value, this.pageIndex);
            } else if (this.topMenu == "3") {
                this.getServerList(value, this.pageIndex, 1);
            }
        },
        download(url) {
            if (url == "" || url == null) {
                this.$message({
                    message: "当前没有下载内容！",
                    type: "success"
                });
            } else {
                location.href = this.downloadAddress + "?path=" + url;
            }
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

<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/singleEquipment/customerDetail.scss";
</style>
