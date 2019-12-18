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
    <div class="content-wrap flex-wrap">
        <div class="right-content-box flex-column">
            <div class="nav-wrap flex-wrap">
                <div class="nav-title flex-wrap flex-center">
                    <div class="name">体检结果列表</div>
                </div>
            </div>

            <div class="search-wrap">
                <div class="title-wrap flex-wrap flex-center">
                    <div class="left-box flex-wrap">
                        <div class="left_selectBox">
                            <el-select v-model="searchObj.search_key" placeholder="请选择">
                                <el-option v-for="item in searchKeyOpArr" :label="item.label" :value="item.value" :key="item.value"></el-option>
                            </el-select>
                        </div>

                        <div class="query-box " @keyup.enter="toSearch">
                            <el-input placeholder="请输入内容" v-model="searchObj.search_string" class="input-with-select" clearable>
                                <el-select v-model="searchObj.search_type" slot="prepend" placeholder="包含">
                                    <el-option v-for="item in searchTypeOpArr"
                                        :label="item.label"
                                        :value="item.value"
                                        :key="item.value"
                                        ></el-option>
                                </el-select>
                                <i class="mix-search-icon" slot="append" @click="toSearch"></i>
                            </el-input>

                        </div>
                    </div>
                    <div class="right-box flex-wrap ">
                        <div class="mix-icon-button" @click.stop="refresh"><i class="mix-refresh-icon"></i></div>
                    </div>
                </div>
            </div>

            <div class="body-wrap flex-column">
                <div class="table-wrap flex-con-1 flex-column">
                    <el-table :data="tableData" style="width: 100%" max-height="100%"
                    height="100%" @row-click="handleRowClick" class="mix-el-table">
                        <el-table-column prop="result_id" label="结果编号"></el-table-column>
                        <el-table-column prop="equipment_name" label="设备名称"></el-table-column>
                        <el-table-column prop="score" label="得分"></el-table-column>
                        <el-table-column prop="fail" label="待处理问题"></el-table-column>
                        <el-table-column prop="created" label="检查时间"></el-table-column>
                        <el-table-column label="操作" width="140">
                            <template slot-scope="scope">
                                <div class="table-operate">
                                    <div class="flex-wrap">
                                        <div class="mix-icon-button" @click.stop="handleTableRowClickDelete(scope.row)" title="删除"><i class="mix-delete-icon"></i></div>
                                    </div>
                                </div>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>

                <div class="pagination-box">
                    <my-pagination :total="searchObj.total_records" :pageSize="searchObj.page_size" @pageChange="handlePageChange" @sizeChange="handleSizeChange" ></my-pagination>
                </div>
            </div>
        </div>

        <div class="mask-loading"
            v-loading.fullscreen.lock="fullscreenLoading"
            element-loading-background="rgba(0, 0, 0, 0.3)">
        </div>
    </div>

</template>
<script>
import diagResultApi from "@/assets/js/fetch/diag/result"
import MyPagination from '@/assets/js/components/pagination.vue'
    export default {
        name: 'equipmentTypeList',
        data() {
            return {
                fullscreenLoading: false,
                equipment_id: '',
                searchObj: {
                    search_string: '',
                    search_key: "equipment_name",
                    search_type: "like",
                    page_size: 20,
                    page_index: 1,
                    total_records: 0
                },
                tableData: [],
                searchKeyOpArr: [
                    {
                        label: "设备名称",
                        value: "equipment_name"
                    },
                    {
                        label: "结果编号",
                        value: "result_id"
                    }
                ],
                searchTypeOpArr: [
                    {
                        label: "精确查询",
                        value: "="
                    },
                    {
                        label: "模糊查询",
                        value: "like"
                    }
                ],
            }
        },

        created() {
            this.equipment_id = this.$route.query.id;
        },

        mounted() {
            this.toSearch();
        },

        methods: {

            toSearch(obj) {

                let self = this;
                    self.tableData = [];
                let condition = '';
                    condition = JSON.stringify([ [this.searchObj.search_key, this.searchObj.search_type, this.searchObj.search_string] ]);
                let searchCondition = {
                    condition: condition,
                    equipment_id: this.equipment_id,
                    page_size: this.searchObj.page_size,
                    page_index: this.searchObj.page_index,
                };

                self.openScreenLoading();
                diagResultApi.list((res) => {
                    self.closeScreenLoading();
                    if (res.code == 200) {
                        self.tableData = res.result.data;
                        self.searchObj.total_records = res.result.total_records;
                        return ;
                    }

                }, searchCondition);
            },

            refresh() {
                this.initSearchCondition();
                this.toSearch();
            },

             initSearchCondition() {
                this.searchObj.search_string = '';
                this.searchObj.search_key = 'equipment_name';
                this.searchObj.search_type = 'like';
                this.searchObj.page_index = 1;
                this.searchObj.page_size = 20;
                this.searchObj.total_records = 0;
            },

            handleRowClick(row) {
                // this.$router.push({name: 'healthResultDetail', query: {id: row.result_id}});
                //http://mix.fidis.my/pro#/     'http://mix.fidis.my'    +   '/pro'  +   '#/'
                window.open(location.origin + location.pathname + "#"+ "/diag/result/detail?id="+row.result_id);
            },

            handlePageChange(page) {
                // console.log("跳转到第"+ page + "页");
                this.searchObj.page_index =page;
                this.toSearch();
            },
            handleSizeChange(size) {
                // console.log("每页"+ size + "条");
                this.searchObj.page_size = size;
                this.toSearch();
            },

            openScreenLoading() {
                this.fullscreenLoading = true;
            },

            closeScreenLoading(time = 300) {
                let self = this;
                setTimeout(() => {
                    self.fullscreenLoading = false;
                }, time);
            },

            handleTableRowClickEdit(row) {
            },

            handleTableRowClickDelete(row) {
                // console.log("删除");
                let self = this;

                self.$confirm("确定删除id为" + row.result_id +"的体检结果？", "提示", {
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                }).then( () => {
                    diagResultApi.delete( (res) => {
                        if (res.code == 200) {
                            self.$message({type: 'success', message: res.msg});
                            self.toSearch();
                            return ;
                        }
                        self.$message({type: 'error', message: res.msg});
                    }, {result_id: row.result_id});
                }).catch( () => {
                    self.$message({type: 'info', message: "已取消删除"});
                });

            },
        },

        components: {
            MyPagination,
        }
    }
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
// variables
@mixin baseTable() {
    width: 100%;
    table-layout: fixed;
    border-collapse: collapse;
    border-spacing: 0;
    tr {
        td {
            font-family: 'Arial-BoldMT', 'MicrosoftYaHei';
            font-size: 14px;
            font-weight: normal;
            font-stretch: normal;
            letter-spacing: 0px;
        }
    }
}

@mixin flexWrap() {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    display: -moz-flex;
}

@mixin flexColumn() {
    @include flexWrap();
    -webkit-flex-direction: column;
    flex-direction: column;
}


@mixin overEllipsis() {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}


//超出n行省略....
@mixin overflowNLineHidden($n) {
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: $n;
    /*解决-webkit-box-orient: vertical 丢失的问题  */
    /* autoprefixer: ignore next */
    -webkit-box-orient: vertical;
}

.content-wrap {
    width: 100%;
    height: 100%;
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
                    flex: 2;
                    font-family: 'Arial-BoldMT', 'MicrosoftYaHei';
                    font-size: 14px;
                    font-weight: normal;
                    font-stretch: normal;
                    letter-spacing: 0px;
                    color: #333333;
                    @include overEllipsis();
                }
                .item-name {
                    flex: 1;
                    font-family: 'Arial-BoldMT', 'MicrosoftYaHei';
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
        // margin-left: 16px;
        overflow: auto;
        .nav-wrap {
            height: 78px;
            background-color: #ffffff;
            padding: 0 20px;
            border-bottom: 1px solid #ececec;
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
                    font-family: 'Arial-BoldMT', 'MicrosoftYaHei';
                    font-size: 20px;
                    font-weight: normal;
                    font-stretch: normal;
                    letter-spacing: 0px;
                    color: #111111;
                }
                .warning {
                    font-family: 'Arial-BoldMT', 'MicrosoftYaHei';
                    font-size: 12px;
                    font-weight: normal;
                    font-stretch: normal;
                    letter-spacing: 0px;
                    color: #fe7800;
                    margin-left: 40px;
                }
            }
            .nav-tools {
                .tool-item {
                    margin-right: 10px;
                    .time {
                        font-size: 14px;
                    }
                }
            }
            .nav-button {
                flex: 1;
                justify-content: flex-end;
            }
            .stepbox {
                padding: 0 100px;
            }
        }
        .search-box {
            height: 40px;
            padding: 20px 10px;
            // margin: 10px 0;
            background: #fff;
            overflow: hidden;
            .search-item {
                position: relative;
                float: left;
                width: 200px;
                height: 40px;
                line-height: 40px;
                margin-right: 10px;
                .search-icon {
                    position: absolute;
                    width: 36px;
                    height: 36px;
                    top: 2px;
                    right: 0px;
                    text-align: center;
                    cursor: pointer;
                }
                &.operate {
                    float: right;
                    width: auto;
                }
            }
        }
        .search-wrap {
            background: #fff;
            .title-wrap {
                height: 72px;
                padding: 0 10px;
                justify-content: space-between;
                .left-box {
                    background-color: #fff;
                    .left_selectBox {
                        width: 190px;
                        margin-right: 10px;
                    }
                    .query-box {
                        width: 380px;
                        height: 36px;
                        // border: 1px solid #dddddd;
                        justify-content: space-between;
                        border-left: 0;
                        .search-input {
                            flex: 1;
                            border: none;
                            outline: none;
                            height: 100%;
                            padding-left: 10px;
                        }
                        .search {
                            margin-right: 10px;
                        }
                    }
                }
                .right-box {}
            }
        }
        .check-wrap {
            background-color: #ffffff;
            .check-block {
                padding: 15px 10px;
                .info-block {
                    height: 100px;
                    font-size: 16px;
                    display: flex;
                    text-align: center;
                    .info-item {
                        float: left;
                        width: 300px;
                        height: 100px;
                        padding: 15px 0;
                        border-radius: 2px;
                        border: solid 1px #5b89ff;
                        align-content: center;
                        box-sizing: border-box;
                        margin-right: 20px;
                        .number {
                            height: 40px;
                            line-height: 40px;
                            font-size: 20px;
                        }
                        .text {
                            height: 30px;
                            line-height: 30px;
                        }
                        &.score {
                            .number {
                                color: #5b89ff;
                            }
                        }
                        &.pass {}
                        &.notpass {}
                    }
                }
            }
        }
        .body-wrap {
            flex: 1;
            overflow-x: hidden;
            overflow-y: auto;
            margin-bottom: 16px;
            background: #fff;
            &:last-child {
                margin-bottom: 0;
            }
            .tag {
                span.el-tag {
                    margin: 0 10px 10px 0;
                }
            }
            .table-wrap {
                padding: 0 10px;
                .message-row-box {
                    .row-item {
                        display: flex;
                        justify-content: center;
                        line-height: 30px;
                        text-align: center;
                        .label {
                            width: 100px;
                            text-align: right;
                        }
                        .content {
                            flex: 1;
                            text-align: left;
                            .content-wrap {
                                line-height: 30px;
                                .title {
                                    width: 200px;
                                    margin-right: 20px;
                                }
                                .status {
                                    flex: 1;
                                }
                            }
                        }
                    }
                }
                .model-name {
                    a {
                        text-decoration: underline;
                    }
                }
            }
            .block-wrap {
                background-color: #ffffff;
                &:not(:first-child) {
                    margin-top: 16px;
                }
                .block-title {
                    height: 49px;
                    border-bottom: 1px solid #dddddd;
                    padding: 0 20px;
                    justify-content: space-between;
                    .block-title-txt {
                        font-family: 'Arial-BoldMT', 'MicrosoftYaHei';
                        font-size: 18px;
                        font-weight: normal;
                        font-stretch: normal;
                        height: 50px;
                        line-height: 50px;
                        letter-spacing: 0px;
                        color: #111111;
                    }
                }
                .block-body {
                    padding: 20px;
                    overflow-x: hidden;
                    overflow-y: auto;
                    .block-body-content {
                        background-color: #fafafa;
                        border-radius: 2px;
                        border: solid 1px #ececec;
                        font-family: 'Arial-BoldMT', 'MicrosoftYaHei';
                        font-size: 14px;
                        font-weight: normal;
                        font-stretch: normal;
                        line-height: 28px;
                        letter-spacing: 0px;
                        color: #333333;
                        padding: 15px;
                        max-height: 300px;
                        overflow-x: hidden;
                        overflow-y: auto;
                        &::-webkit-scrollbar {
                            /*滚动条整体样式*/
                            width: 5px;
                            /*高宽分别对应横竖滚动条的尺寸*/
                            height: 1px;
                        }
                        &::-webkit-scrollbar-thumb {
                            /*滚动条里面小方块*/
                            border-radius: 1px;
                            -webkit-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
                            background: #959eb4;
                        }
                        &::-webkit-scrollbar-track {
                            /*滚动条里面轨道*/
                            -webkit-box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
                            border-radius: 10px;
                            background: #111e31;
                        }
                    }
                    .block-body-table {
                        @include baseTable();
                        .needorder {
                            ol {
                                padding-left: 20px;
                                li {
                                    list-style: decimal;
                                    padding-left: 10px;
                                    line-height: 30px;
                                }
                            }
                        }
                        tr {
                            td {
                                padding: 0 5px 0 20px;
                                height: 39px;
                                border: 1px solid #ececec;
                                word-break: break-all;
                                &:nth-child(2n+1) {
                                    width: 93px;
                                    background-color: #fafafa;
                                    color: #333333;
                                }
                                &:nth-child(2n) {
                                    color: #999999;
                                }
                                &.empty {
                                    color: #fe7800;
                                }
                                &.no-background {
                                    background-color: transparent;
                                }
                            }
                        }
                        &.input-table {
                            tr {
                                td {
                                    line-height: 40px;
                                    padding: 0 5px;
                                }
                            }
                        }
                    }
                    .card-wrap {
                        .card-box {
                            float: left;
                            width: 22%;
                            height: 400px;
                            margin-right: 2%;
                            margin-bottom: 16px;
                            padding: 20px;
                            box-shadow: 0px 1px 10px 0px rgba(65, 98, 255, 0.4);
                            // border: solid 1px #4162ff;
                            box-sizing: border-box;
                            .card-main {
                                height: 380px;
                                font-family: MicrosoftYaHei;
                                font-weight: normal;
                                font-stretch: normal;
                                .card-title {
                                    height: 40px;
                                    line-height: 20px;
                                    display: flex;
                                    justify-content: space-between;
                                    .name {
                                        font-size: 18px;
                                        font-weight: 700;
                                        letter-spacing: 0px;
                                        color: #111111;
                                    }
                                    .skim {
                                        .times {
                                            font-size: 18px;
                                            font-weight: 700;
                                            color: #4162ff;
                                        }
                                    }
                                }
                                .detail {
                                    height: 40px;
                                    font-size: 13px;
                                    line-height: 18px;
                                    letter-spacing: 0.5px;
                                    color: #a9a9a9;
                                    padding: 10px 0;
                                }
                                .tag-list {
                                    height: 90px;
                                    padding: 10px 0;
                                    border-top: 1px solid #ddd;
                                    border-bottom: 1px solid #ddd;
                                    .el-tag {
                                        margin-right: 10px;
                                    }
                                }
                                .desc {
                                    height: 80px;
                                    margin-top: 20px;
                                    font-size: 12px;
                                    line-height: 18px;
                                    letter-spacing: 0px;
                                    color: #999999;
                                    .text {
                                        height: 30px;
                                        line-height: 30px;
                                    }
                                    .description {
                                        height: 80px;
                                        line-height: 20px;
                                        @include overflowNLineHidden(2);
                                        // overflow: hidden;
                                        // text-overflow: ellipsis;
                                        // display: -webkit-box;
                                        // -webkit-box-orient: vertical;
                                        // -webkit-line-clamp: 4;
                                    }
                                }
                                .option {
                                    height: 40px;
                                    padding: 10px 0;
                                    box-sizing: border-box;
                                }
                            }
                        }
                    }
                    .accesskey {
                        display: inline-block;
                        width: 300px;
                        font-weight: 700;
                        margin-right: 20px;
                    }
                    .handle-message {
                        text-align: center;
                        display: flex;
                        justify-content: center;
                    }
                }
                table {
                    text-align: left;
                    thead {
                        th {
                            height: 40px;
                            line-height: 40px;
                            background: #fafafa;
                            font-size: 14px;
                        }
                    }
                    tr,
                    th,
                    td {
                        border: 1px solid #ececec;
                        padding: 5px 15px;
                    }
                    tr {
                        height: 40px;
                    }
                }
            }
            .list-wrap {
                flex: 1;
                // margin-top: 16px;
                background: #ffffff;
                .list-content {
                    padding: 0 20px;
                    max-height: 100%;
                    overflow: hidden;
                    .list-tool {
                        margin-top: 22px;
                        justify-content: space-between;
                    }
                    .list-table {
                        flex: 1;
                        margin-top: 20px;
                        overflow: hidden;
                    }
                    .list-pagination {
                        margin-top: 10px;
                        justify-content: flex-end;
                    }
                }
            }
            .pagination-box {
                height: 30px;
                padding: 10px;
            }
            &.neededit {
                .block-wrap {
                    .block-body {
                        .block-body-table {
                            tr {
                                td {
                                    padding: 5px 10px 5px 10px;
                                    background: none;
                                }
                            }
                        }
                    }
                }
            }
            .normal-atag {
                a {
                    text-decoration: underline;
                    cursor: pointer;
                }
            }
        }
        .foot-wrap {
            height: auto;
        }
    }
    .mix-txt-button {
        background-color: #44b4ff;
        border-radius: 2px;
        font-family: 'Arial-BoldMT', 'MicrosoftYaHei';
        font-size: 13px;
        font-weight: normal;
        font-stretch: normal;
        letter-spacing: 0px;
        color: #ffffff;
        padding: 9px 20px;
        margin-left: 10px;
        cursor: pointer;
        &:hover {
            background-color: #5c78ff;
        }
        &:active {
            background-color: #4162ff;
        }
    }
    .mix-determine-button {
        background-color: #4162ff;
        border-radius: 2px;
        font-family: 'Arial-BoldMT', 'MicrosoftYaHei';
        font-size: 13px;
        font-weight: normal;
        font-stretch: normal;
        letter-spacing: 0px;
        color: #ffffff;
        padding: 9px 20px;
        margin-left: 10px;
        cursor: pointer;
        &:hover {
            background-color: #6781fd;
        }
        &:active {
            background-color: #4162ff;
        }
    }
    .mix-win-modal-flex-table {
        @include flexColumn();
        .row {
            @include flexWrap();
            margin-top: 20px;
            .col {
                flex: 1;
                &:not(:first-child) {
                    margin-left: 104px;
                }
                .label {
                    font-family: 'Arial-BoldMT', 'MicrosoftYaHei';
                    font-size: 13px;
                    font-weight: normal;
                    font-stretch: normal;
                    letter-spacing: 0.5px;
                    color: #888888;
                }
                .input {
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
        &:first-child {
            margin-left: 0;
        }
        &:hover {
            background-color: #f9f9f9;
        }
        &:active {
            background-color: #ecedef;
        }
    }
    .mix-icon-txt-button {
        height: 32px;
        line-height: 32px;
        padding: 0 10px;
        border-radius: 2px;
        border: 1px solid #dddddd;
        background-color: #ffffff;
        text-align: center;
        margin-left: 10px;
        cursor: pointer;
        @include flexWrap();
        align-items: center;
        span {
            font-family: MicrosoftYaHei;
            font-size: 14px;
            font-weight: normal;
            font-stretch: normal;
            line-height: 28px;
            letter-spacing: 0px;
            color: #333333;
            margin-left: 8px;
        }
        &:hover {
            background-color: #f9f9f9;
        }
        &:active {
            background-color: #ecedef;
        }
    }
    .mix-cancel-button,
    .mix-txt-gray-button {
        background-color: #f9f9f9;
        border: solid 1px #dddddd;
        border-radius: 2px;
        font-family: 'Arial-BoldMT', 'MicrosoftYaHei';
        font-size: 13px;
        font-weight: normal;
        font-stretch: normal;
        letter-spacing: 0px;
        color: #333333;
        padding: 9px 20px;
        margin-left: 10px;
        cursor: pointer;
        &:hover {
            background-color: #ecedef;
        }
        &:active {
            background-color: #ecedef;
        }
    }
}

.el-tabs__content {
    flex: 1;
    display: flex !important;
    flex-direction: column;
}


.mix-refresh-icon {
    display: inline-block;
    width: 16px;
    height: 16px;
    background: url('../../../../../images/public/refresh-icon.png') no-repeat center center;
}

.mix-search-icon {
    display: inline-block;
    width: 16px;
    height: 16px;
    background: url('../../../../../images/public/search-icon.png') no-repeat center center;
}


.mix-delete-icon {
    display: inline-block;
    width: 16px;
    height: 16px;
    background: url('../../../../../images/public/delete-icon.png') no-repeat center center;
}
</style>
