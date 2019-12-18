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
    <div class="content">
      <div class="listContentBox flex-column">
        <div class="topContent flex-wrap flex-center">
          <div class="contTopL">
            <div class="contentTitle">客户列表</div>
          </div>
          <div class="contTopR"></div>
        </div>
        <div class="middleContent flex-column">
          <div class="searchContent flex-wrap" @keyup.enter="getList">
            <div class="selectWrap">
              <el-select class="el-select" v-model="searchSelectValue"  placeholder="请选择" size="medium">
                <el-option
                  v-for="(item,index) in searchOptions"
                  :key="index"
                  :label="item.label"
                  :value="item.value">
                </el-option>
              </el-select>
            </div>
            <div class="selectWrap condition">
              <el-select class="el-select" v-model="conditionSelectValue"  placeholder="请选择" size="medium">
                <el-option
                  v-for="(item,index) in conditionOptions"
                  :key="index"
                  :label="item.label"
                  :value="item.value">
                </el-option>
              </el-select>
            </div>
            <div class="selectWrap inputString">
              <el-input v-model="searchString" class="search" placeholder="请输入搜索内容" size="medium"></el-input>
            </div>
            <span class="searchBtn" @click="getList">搜索</span>
          </div>
          <div class="listContent">
            <table>
              <colgroup><col width="*"><col width="*"><col width="120"></colgroup>
              <tr>
                <th>客户编号</th>
                <th>客户名称</th>
                <th>操作</th>
              </tr>
              <tr v-for="(item,index) in listData">
                <td>{{item.customer_id}}</td>
                <td>{{item.customer_name}}</td>
                <td>
                  <router-link :to="{ name: 'singleCustomerDetail', path: '/customer_detail', params: {'customer_id':item.customer_id,'token':token} }">
                    <i class="ic_show"></i>
                  </router-link>
                </td>
              </tr>
              <tr v-if="listData==null">
                <td colspan="3"><div class="nodata">暂无数据</div></td>
              </tr>
            </table>
          </div>
          <div class="pageBtn flex-column">
            <div class="block" v-show="listData!=null">
              <el-pagination background @size-change="listHandleSizeChange" @current-change="getList" :current-page.sync="listCurrentPage" :page-sizes="[15,20,30,40,50]" :page-size="100" layout="prev, pager, next, sizes, jumper" :total="listTotal">
              </el-pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import loginApi from "@/assets/js/fetch/login";
import customerApi from "@/assets/js/fetch/customer";
export default {
    name: "list",
    components: {},
    data() {
        return {
            token: "",
            username: "mixlinker.mixiot",
            password: "mix@ei01$!",
            listData: null,
            listTotal: 0,
            listCurrentPage: 1,
            searchString: "",
            searchSelectValue: "customer_name",
            searchOptions: [
                {
                    value: "customer_name",
                    label: "客户名称"
                }
            ],
            conditionSelectValue: "like",
            conditionOptions: [
                {
                    value: "like",
                    label: "包含"
                },
                {
                    value: "=",
                    label: "等于"
                }
            ]
        };
    },
    created() {
        this.getToken();
    },
    methods: {
        getToken() {
            let self = this;
            loginApi.login(
                function(data) {
                    if (data.code == 200) {
                        self.token = data.result.data.token;
                        self.getList();
                    }
                },
                {
                    username: self.username,
                    password: self.password,
                    system: "MIXIOT"
                }
            );
        },
        getList() {
            if (!this.token) {
                return;
            }
            let self = this;
            let condition = "[]";
            if (self.searchString != "") {
                condition =
                    '[["' +
                    self.searchSelectValue +
                    '", "' +
                    self.conditionSelectValue +
                    '", "' +
                    self.searchString +
                    '"]]';
            }
            customerApi.get_all_user(
                function(data) {
                    if (data.code == 200) {
                        if (data.result.data.length) {
                            self.listData = data.result.data;
                        }
                    }
                },
                { is_all: 1, condition: condition },
                this.token
            );
        },
        listHandleSizeChange() {}
    }
};
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/singleEquipment/customerList.scss";
</style>
