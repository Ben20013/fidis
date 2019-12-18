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
        <leftMenu :isExpand="isExpand"></leftMenu>
        <div class="content flex-column flex-con-1">
            <topHeader
                v-on:is-expand="onExpand"
                :navTitle="navTitle"
                :breadCrumbData="breadCrumbData"
            ></topHeader>
            <router-view
                :isExpand="isExpand"
                v-on:nav-title="onNavTitle"
                @changeBreadCrumb="changeBreadCrumb"
            ></router-view>
        </div>
    </div>
</template>

<script>
import leftMenu from "@components/leftMenu";
import topHeader from "@components/topHeader";

export default {
    name: "index",
    components: {
        //注册组件
        leftMenu: leftMenu,
        topHeader: topHeader
    },
    data() {
        return {
            navTitle: "",
            isExpand: false,
            totalData: [],
            fenbuData: [],
            isFullScreen: false,
            breadCrumbData: ""
        };
    },
    mounted() {},
    methods: {
        onExpand(isExpand) {
            this.isExpand = isExpand;
        },
        onNavTitle(navTitle) {
            console.log(navTitle);
            this.navTitle = navTitle;
        },
        changeBreadCrumb(data) {
            console.log("indexsss", data);
            this.breadCrumbData = data;
            this.$refs.header.addBreadCrumbRoute(data);
        }
    }
};
</script>

<style>
.index-bdmap-equipment {
    width: 310px;
    height: 115px;
    background-color: #ffffff;
    box-shadow: 2px 0px 8px 0px rgba(83, 135, 255, 0.41);
}
.index-bdmap-equipment div {
    /* display: inline-block; */
    float: left;
    line-height: 16px;
}

.index-bdmap-equipment div a {
    display: inline-block;
    width: 117px;
    height: 82px;
    background-color: #edeef2;
}
.index-bdmap-equipment div a img {
    width: 100%;
}
.index-bdmap-equipment .bdmap-base-info {
    width: 50%;
    margin-left: 10px;
}
.indexPageNodata {
    margin: 100px auto;
    text-align: center;
    color: #999999;
    font-size: 16px;
}
</style>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
.main {
    .content {
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
}
</style>
