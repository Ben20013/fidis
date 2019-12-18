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
    <div class="diag-box-container flex-column">
        <div class="diag-main flex-con-1 flex-column">
            <div class="tabs-box flex-con-1 flex-column">
                <div class="tabs-main flex-con-1 flex-column">
                    <div class="tabs-main__head">
                        <div class="wrap-overflow clearfix">
                            <div class="tab-list">
                                <div class="tab-item" :class="{active: activeName == 'task'}" @click="activeName='task'">
                                    <span>任务</span>
                                </div>
                                <div class="tab-item" :class="{active: activeName == 'result'}"  @click="activeName='result'">
                                    <span>结果</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tabs-main__body flex-con-1 flex-column">
                        <div class="body-main flex-con-1 flex-column">
                             <template>
                                <div class="pane-content flex-con-1 flex-column" >
                                    <diag-task-list v-if="activeName == 'task'"></diag-task-list>
                                    <diag-result-list v-if="activeName == 'result'"></diag-result-list>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>


            </div>

            <!-- <el-tabs class="flex-con-1 flex-column" v-model="activeName" type="border-card" @tab-click="handleClick">
                <el-tab-pane label="任务" name="task" class="flex-con-1 flex-column">
                    <template>
                        <div class="pane-content flex-con-1 flex-column" >
                            <diag-task-list v-if="activeName == 'task'"></diag-task-list>
                        </div>
                    </template>
                </el-tab-pane>

                <el-tab-pane label="结果" name="result" class="flex-con-1 flex-column">
                    <template>
                        <div class="pane-content flex-con-1 flex-column">
                            <diag-result-list  v-if="activeName == 'result'"></diag-result-list>
                        </div>
                    </template>
                </el-tab-pane>
            </el-tabs> -->
        </div>
    </div>
</template>

<script  >
import DiagTaskList from './diag/tasklist'
import DiagResultList from './diag/resultlist'

export default {
    data() {
        return {
            activeName: 'result'
        }
    },

    components: {
        DiagTaskList,
        DiagResultList
    },

    methods: {
        handleClick() {

        }
    },
}

</script>

<style lang="scss" scoped>
.diag-box-container {
    height: 100%;

    .diag-main {
        background-color: #fff;
        .tabs-main {
            background-color: #f9f9f9;
            border-bottom: 1px solid #e4e7ed;
            margin: 0;
            .tabs-main__head {
                overflow: hidden;
                margin-bottom: -1px;
                position: relative;
                .wrap-overflow {
                    overflow: hidden;
                    .tab-list {
                        .tab-item {
                            position: relative;
                            float: left;
                            box-sizing: border-box;
                            display: inline-block;
                            padding: 0 20px;
                            height: 40px;
                            line-height: 40px;
                            font-size: 14px;
                            font-weight: 500;
                            list-style: none;
                            color: #333333;
                            white-space: nowrap;
                            transition: transform .3s;
                            z-index: 2;
                            cursor: pointer;

                            &.active {
                                color: #4162ff;
                                background: #fff;
                            }
                        }
                    }
                }
            }

            .tab-main__bod y {
                .body-main {

                }
            }

        }
    }
}
</style>
