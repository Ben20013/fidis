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
  <div class="container__content flex-column">
    <div class="search-wrap flex-wrap">
        <div class="search-option">
            <el-select v-model="searchOptionValue" :placeholder="$t('el.select.placeholder')" class="mix-select mix-select-32">
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
              <el-select v-model="conditionOptionValue" :placeholder="$t('el.select.placeholder')" class="mix-select mix-no-border-32" @focus="isFocus=true" @blur="isFocus=false">
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
    </div>
    <div class="content-wrap flex-column">
      <div class="list-header">
        <table>
          <colgroup><col width="*"><col width="*"><col width="*"><col width="*"><col width="*"><col width="*"></colgroup>
          <thead>
            <tr>
                <th>{{$t('eventLang.created')}}</th>
                <th>{{$t('eventLang.equipment_id')}}</th>
                <th>{{$t('eventLang.equipment_name')}}</th>
                <th>{{$t('eventLang.aprus_id')}}</th>
                <th>{{$t('eventLang.code')}}</th>
                <th>{{$t('eventLang.alert_name')}}</th>
              <th v-if="scrollWidth" :style="{'width':scrollWidth+'px','padding':0}"></th>
            </tr>
          </thead>
        </table>
      </div>
        <div class="list-body">
            <table>
              <colgroup><col width="*"><col width="*"><col width="*"><col width="*"><col width="*"><col width="*"></colgroup>
              <tbody>
                <tr v-for="(item,index) in listData" @click="enterDetailPage(item,index)" :key="index" :class="{'active':index===currentItemIndex}">
                  <td>{{item.created}}</td>
                    <td>{{item.equipment_id}}</td>
                    <td>{{item.equipment_name}}</td>
                    <td>{{item.aprus_id}}</td>
                    <td>{{item.code}}</td>
                    <td>{{item.alert_name}}</td>
                </tr>
                <tr v-if="listData==null||listData.length==0">
                  <td colspan="8">
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
    <div class="md-loading" :class="{ 'active': md.loading}">
        <i class="el-icon-loading md-loading-icon"></i>
    </div>
  </div>
</template>
<script>
import alarmApi from "@/assets/js/fetch/alarm";
export default {
  name: "alertListComponent",
  data(){
    return {
      listData: null,
      currentItemIndex: null,
      isSearch: false,
      searchString: "",
      searchOptionValue: "equipment_name",
      searchOption: [
        { label: this.$t("eventLang.equipment_name"), value: "equipment_name" },
        { label: this.$t("eventLang.equipment_id"), value: "equipment_id" },
        { label: this.$t("eventLang.created"), value: "created" },
        { label: this.$t("eventLang.aprus_id"), value: "aprus_id" },
        { label: this.$t("eventLang.code"), value: "code" },
        { label: this.$t("eventLang.alert_name"), value: "alert_name" }
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
      md: {
          loading: false
      }
    }
  },
  mounted() {
    this.getList("list");
  },
  updated() {
    let outer = document.querySelector("div.list-body");
    let inner = document.querySelector("div.list-body>table");
    if (outer && inner) {
      this.scrollWidth = outer.offsetWidth - inner.offsetWidth;
    }
  },
  methods: {
    getList(type) {
      let self = this;
      let condition = "[]";
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
          [
            this.searchOptionValue,
            this.conditionOptionValue,
            this.searchString
          ]
        ]);
      }
      self.md["loading"] = true;
      this.currentItemIndex = null;
      alarmApi.get_list(
        function(data) {
          if (data.code == 200) {
              self.listData = data.result.data;
              self.totalNumber = data.result.total_records;
          }
          self.md["loading"] = false;
        },
        {
          is_all: 0,
          page_index: this.currentPage,
          page_size: this.currentPageSize,
          condition: condition
        }
      );
    },
    enterDetailPage(item, index) {
        this.currentItemIndex = index;
        this.$emit("nav-title", { name: item.name, id: item.alert_id, type: 'alert' });
        this.$router.push({
            name: "eventDetail",
            path: "/event/detail",
            query: {
              id: item.alert_id,
              type: 'alert'
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
    focusInput() {
        let self = this;
        setTimeout(function() {
            self.isFocus = true;
        }, 100);
    }
  }
}
</script>
<style lang="scss" scoped>
@import "../../../../sass/event/list.scss";
</style>
