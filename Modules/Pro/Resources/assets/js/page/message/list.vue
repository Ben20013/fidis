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
            <div class="title-wrap">
                <span class="title">消息列表</span>
            </div>
            <div class="search-wrap flex-wrap">
                <div class="search-option">
                    <el-select
                        v-model="searchOptionValue"
                        placeholder="请选择"
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
                <div class="search-content flex-wrap">
                    <div class="left">
                        <el-select
                            v-model="conditionOptionValue"
                            placeholder="请选择"
                            class="mix-select mix-no-border-32"
                            popper-class="mix-select-item"
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
                    <div class="right">
                        <el-input
                            class="mix-input mix-no-border-32"
                            placeholder="请输入搜索内容"
                            v-model="searchString"
                        ></el-input>
                    </div>
                </div>
                <div class="date-between">
                    <el-date-picker
                        v-model="dateBetween"
                        class="mix-input mix-input-32 mix-no-right-border-radius"
                        type="datetimerange"
                        format="yyyy-MM-dd HH:mm:ss"
                        value-format="yyyy-MM-dd HH:mm:ss"
                        range-separator="至"
                        start-placeholder="开始日期"
                        end-placeholder="结束日期"
                    ></el-date-picker>
                </div>
                <div class="search-btn-wrap" @click="getList('search')">
                    <i class="mix-search-white-icon"></i>
                </div>
                <div class="refresh-wrap" @click="refresh">
                    <i class="mix-refresh-icon"></i>
                </div>
            </div>
            <div class="content-wrap flex-column">
                <div class="list-header">
                    <table>
                        <thead>
                            <tr>
                                <th>消息编号</th>
                                <th>消息名称</th>
                                <th>消息来源</th>
                                <th>消息时间</th>
                                <th>消息类型</th>
                                <th>消息描述</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="list-body">
                    <table>
                        <tbody>
                            <tr v-for="(item,index) in listData">
                                <td>{{item.message_id}}</td>
                                <td>{{item.message_name}}</td>
                                <td>{{item.messenger}}</td>
                                <td>{{item.created}}</td>
                                <td>{{item.category}}</td>
                                <td>{{item.description}}</td>
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
                        :page-size="100"
                        layout="prev, pager, next, sizes, jumper"
                        :total="totalNumber"
                    ></el-pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import messageApi from "@/assets/js/fetch/message";
export default {
    name: "customer",
    data() {
        return {
            userId: "",
            listData: null,
            dateBetween: "",
            isSearch: false,
            searchString: "",
            searchOptionValue: "messenger",
            searchOption: [
                { label: "消息来源", value: "messenger" },
                { label: "消息名称", value: "message_name" },
                { label: "消息类型", value: "category" }
            ],
            conditionOptionValue: "like",
            conditionOption: [
                { label: "包含", value: "like" },
                { label: "等于", value: "=" }
            ],
            currentPage: 1,
            currentPageSize: 10,
            totalNumber: 0
        };
    },

    created() {},
    mounted() {
        this.getList("list");
    },
    methods: {
        getList(type) {
            let self = this;
            let condition = "[]";
            if (type == "search") {
                this.isSearch = true;
                if (
                    this.searchString == "" &&
                    (this.dateBetween == "" || !this.dateBetween.length)
                ) {
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
                let tmp = [];
                if (this.searchString != "") {
                    tmp.push([
                        this.searchOptionValue,
                        this.conditionOptionValue,
                        this.searchString
                    ]);
                }
                if (this.dateBetween.length) {
                    tmp.push(["created", ">=", this.dateBetween[0]]);
                    tmp.push(["created", "<=", this.dateBetween[1]]);
                }
                condition = JSON.stringify(tmp);
            }
            messageApi.get_list(
                function(data) {
                    if (data.code == 200) {
                        self.listData = data.result.data;
                        self.totalNumber = data.result.total_records;
                    }
                },
                {
                    is_all: 0,
                    page_index: this.currentPage,
                    page_size: this.currentPageSize,
                    condition: condition
                }
            );
        },
        handleSizeChange(val) {
            this.currentPageSize = val;
            this.getList();
        },
        refresh() {
            this.searchString = "";
            this.searchOptionValue = "messenger";
            this.dateBetween = "";
            this.conditionOptionValue = "like";
            this.currentPage = 1;
            this.currentPageSize = 10;
            this.isSearch = false;
            this.getList("list");
        }
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/message/list.scss";
</style>
