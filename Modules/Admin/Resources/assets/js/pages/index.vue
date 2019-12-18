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
        <leftMenu></leftMenu>
        <div class="right-box flex-column flex-con-1">
            <topHeader :breadCrumbData="breadCrumbData" ref="header"></topHeader>
            <router-view @changeBreadCrumb="changeBreadCrumb"></router-view>
        </div>
    </div>
</template>
<script>
import leftMenu from "../components/left-menu";
import topHeader from "../components/top-header";

export default {
    name: "index",
    data() {
        return {
            breadCrumbData: ""
        };
    },
    components: {
        //注册组件
        leftMenu: leftMenu,
        topHeader: topHeader
    },
    mounted() {
        console.log("index");
    },
    methods: {
        changeBreadCrumb(data) {
            console.log("indexsss", data);
            this.breadCrumbData = data;
            this.$refs.header.addBreadCrumbRoute(data);
        }
    }
};
</script>
<style rel="stylesheet/scss" lang="scss" scoped>
.main {
    width: 100%;
    height: 100%;
    padding: 0;
    margin: 0;
    overflow: hidden;
    .right-box {
        background-color: #ecedef;
        .container {
            flex: 1;
            padding: 16px;
            overflow: hidden;
        }
    }
}
</style>
