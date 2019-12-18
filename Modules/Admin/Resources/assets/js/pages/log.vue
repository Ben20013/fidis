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
        <div class="left-content-box flex-column">
            <div class="title-wrap flex-wrap flex-center">
                <div class="query-box flex-wrap flex-center" @keyup.enter="getList">
                    <input
                        type="text"
                        v-model="searchString"
                        placeholder="请输入关键字搜索"
                        class="search-input"
                    />
                    <div class="search" @click="getList">
                        <i class="mix-search-icon"></i>
                    </div>
                </div>
            </div>
            <div class="menu-wrap">
                <div
                    class="row flex-wrap flex-center"
                    v-for="(item,index) in listData"
                    :key="index"
                    :class="{'selected':activeItem == index}"
                    @click="menuItemSelect(index)"
                >
                    <div class="item-point"></div>
                    <div class="item-id">{{item.log_id}}</div>
                    <div class="item-name">{{item.message}}</div>
                </div>
            </div>
            <div class="pagination-wrap flex-wrap flex-pack-center flex-center">
                <div class="block">
                    <el-pagination
                        small
                        background
                        layout="prev, pager, next"
                        @current-change="handleCurrentChange"
                        :current-page="currentPage"
                        :page-size="15"
                        :pager-count="5"
                        :total="listTotalRecord"
                    ></el-pagination>
                </div>
            </div>
        </div>
        <div class="right-content-box flex-column">
            <div class="nav-wrap flex-wrap">
                <div class="nav-title flex-wrap flex-center">
                    <div class="icon"></div>
                    <div class="name">操作日志</div>
                </div>
                <div class="nav-button flex-wrap flex-center">
                    <div class="mix-icon-button" @click="refresh">
                        <i class="mix-refresh-icon"></i>
                    </div>
                </div>
            </div>
            <div class="body-wrap flex-column">
                <div class="row">
                    <div class="title">日志编号</div>
                    <div class="message">
                        <el-input class="readonly-color" v-model="infoData.log_id" readonly></el-input>
                    </div>
                </div>
                <div class="row">
                    <div class="title">操作人名称</div>
                    <div class="message">
                        <el-input class="readonly-color" v-model="infoData.username" readonly></el-input>
                    </div>
                </div>
                <div class="row">
                    <div class="title">操作类型</div>
                    <div class="message">
                        <el-input class="readonly-color" v-model="infoData.message" readonly></el-input>
                    </div>
                </div>
                <div class="row">
                    <div class="title">业务编号</div>
                    <div class="message">
                        <el-input class="readonly-color" v-model="infoData.primary_key" readonly></el-input>
                    </div>
                </div>
                <div class="row">
                    <div class="title">数据记录</div>
                    <div class="message">
                        <el-input
                            class="readonly-color"
                            type="textarea"
                            v-model="infoData.data"
                            readonly
                        ></el-input>
                    </div>
                </div>
                <div class="row">
                    <div class="title">访问IP</div>
                    <div class="message">
                        <el-input class="readonly-color" v-model="infoData.ip" readonly></el-input>
                    </div>
                </div>
                <div class="row">
                    <div class="title">操作时间</div>
                    <div class="message">
                        <el-input class="readonly-color" v-model="infoData.created" readonly></el-input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import adminLogApi from "../fetch/module/admin-log.js";
export default {
    name: "log",
    data() {
        return {
            message: "Hello world!",
            searchString: "",
            listData: [],
            listTotalRecord: 0,
            currentPage: 1,
            activeItem: 0,
            infoData: {
                log_id: "",
                user_id: "",
                username: "",
                operation: "",
                type: "",
                function: "",
                table_name: "",
                primary_key: "",
                data: "",
                ip: "",
                created: ""
            }
        };
    },
    mounted() {
        console.log("log");
        this.getList();
    },
    methods: {
        menuItemSelect(index) {
            this.activeItem = index;
            this.get(this.listData[index]["log_id"]);
        },
        getList() {
            const loading = this.$loading({
                lock: true,
                text: "Loading"
            });
            let self = this;
            adminLogApi.get_list(
                data => {
                    if (data.code == 200) {
                        self.listData = data.result.data;
                        self.listTotalRecord = data.result.total_records;
                        if (data.result.data.length) {
                            self.get(self.listData[0]["log_id"]);
                        }
                    }
                    setTimeout(() => {
                        loading.close();
                    }, 1000);
                },
                {
                    page_index: this.currentPage,
                    page_size: 16,
                    or_where: JSON.stringify([
                        "log_id,message",
                        this.searchString
                    ])
                }
            );
        },
        handleCurrentChange(value) {
            this.currentPage = value;
            this.getList();
        },
        refresh() {
            this.searchString = "";
            this.currentPage = 1;
            this.getList();
        },
        get(id) {
            let self = this;
            adminLogApi.get(
                data => {
                    if (data.code == 200) {
                        self.infoData = data.result;
                    }
                },
                { log_id: id }
            );
        }
    }
};
</script>
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../sass/common.scss";
@import "../../sass/icon.scss";
.main {
    padding: 16px;
    margin: 0;
    overflow: hidden;
    width: calc(100% - 32px);
    height: calc(100% - 32px);
    background-color: #ecedef;
    .left-content-box {
        width: 314px;
        background-color: #ffffff;
        .title-wrap {
            height: 78px;
            border-bottom: 1px solid #dddddd;
            padding: 0 20px;
            justify-content: space-between;
            .query-box {
                // width: 227px;
                flex: 1;
                height: 30px;
                border-radius: 15px;
                border: 1px solid #dddddd;
                padding: 0 10px;
                justify-content: space-between;
                .search-input {
                    flex: 1;
                    border: none;
                    outline: none;
                    height: 100%;
                    padding-left: 10px;
                }
            }
        }
        .menu-wrap {
            flex: 1;
            overflow-x: hidden;
            overflow-y: auto;
            .row {
                padding: 16px 0 16px 20px;
                cursor: default;
                .item-point {
                    width: 8px;
                    height: 8px;
                    background-color: #959eb4;
                    border-radius: 50%;
                    margin-right: 18px;
                }
                .item-id {
                    flex: 1;
                    font-family: "Arial-BoldMT", "MicrosoftYaHei";
                    font-size: 14px;
                    font-weight: normal;
                    font-stretch: normal;
                    letter-spacing: 0px;
                    color: #333333;
                    @include overEllipsis();
                    &.col-1-5 {
                        flex: 1.5;
                    }
                }
                .item-name {
                    flex: 1;
                    font-family: "Arial-BoldMT", "MicrosoftYaHei";
                    font-size: 14px;
                    font-weight: normal;
                    letter-spacing: 0px;
                    color: #888888;
                    @include overEllipsis();
                }
                @mixin color() {
                    .item-point {
                        background-color: #4162ff;
                    }
                    .item-id,
                    .item-name {
                        color: #4162ff;
                    }
                }
                &:hover {
                    border-left: 4px solid #4162ff;
                    padding-left: 16px;
                    @include color();
                }
                &.selected,
                &.selected:hover {
                    background-color: #e6f7ff;
                    border-left-width: 0px;
                    padding-left: 20px;
                    @include color();
                }
            }
        }
        .pagination-wrap {
            padding: 15px 0;
        }
    }
    .right-content-box {
        flex: 1;
        margin-left: 16px;
        .nav-wrap {
            height: 78px;
            background-color: #ffffff;
            padding: 0 20px;
            .nav-title {
                flex: 2;
                .icon {
                    width: 4px;
                    height: 22px;
                    background-color: #4162ff;
                    border-radius: 2px;
                    margin-right: 15px;
                }
                .name {
                    font-family: "Arial-BoldMT", "MicrosoftYaHei";
                    font-size: 20px;
                    font-weight: normal;
                    font-stretch: normal;
                    letter-spacing: 0px;
                    color: #111111;
                }
                .warning {
                    font-family: "Arial-BoldMT", "MicrosoftYaHei";
                    font-size: 12px;
                    font-weight: normal;
                    font-stretch: normal;
                    letter-spacing: 0px;
                    color: #fe7800;
                    margin-left: 40px;
                }
            }
            .nav-button {
                flex: 1;
                justify-content: flex-end;
            }
        }
        .body-wrap {
            flex: 1;
            overflow-x: hidden;
            overflow-y: auto;
            margin-top: 16px;
            background-color: #ffffff;
            padding: 20px 40px;
            .row {
                &:not(:first-child) {
                    margin-top: 20px;
                }
                .title {
                    font-family: "Arial-BoldMT", "MicrosoftYaHei";
                    font-size: 13px;
                    font-weight: normal;
                    font-stretch: normal;
                    letter-spacing: 0.5px;
                    color: #888888;
                }
                .message {
                    margin-top: 10px;
                }
            }
        }
    }
    .mix-icon-button {
        width: 30px;
        height: 30px;
        line-height: 36px;
        border-radius: 2px;
        border: 1px solid #dddddd;
        background-color: #ffffff;
        text-align: center;
        margin-left: 10px;
        cursor: pointer;
        &:hover {
            background-color: #f9f9f9;
        }
        &:active {
            background-color: #ecedef;
        }
    }
}
</style>
