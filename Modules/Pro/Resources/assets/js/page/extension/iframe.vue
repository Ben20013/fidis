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
    <div style="width: 100%;height: 100%;">
        <iframe
            id="show-iframe"
            frameborder="0"
            name="showHere"
            scrolling="auto"
            :src="iframeUrl"
            style="width: 100%;height: 100%;"
        ></iframe>
    </div>
</template>
<script>
export default {
    data() {
        return {
            iframeUrl: ""
        };
    },
    props: ["route", "subRoute"],
    mounted() {
        this.changeIframeUrl(this.subRoute);
    },
    created() {
        let self = this;
        window.changeIframeUrl = function(params) {
            self.$emit("sendSubRoute", "项目详情");
        };
    },
    watch: {
        $route(to, from) {
            console.log("this", this);
            this.changeIframeUrl(this.subRoute);
        }
    },
    methods: {
        changeIframeUrl(subRoute) {
            this.iframeUrl = protocol + apiqHost + this.route + "#" + subRoute;
            console.log(this.iframeUrl);
            document
                .getElementById("show-iframe")
                .contentWindow.location.reload(true);
        }
    }
};
</script>
