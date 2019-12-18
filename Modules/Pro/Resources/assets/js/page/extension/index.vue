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
    <div class="container" style="padding: 16px;height: 100%;">
        <router-view @sendSubRoute="changeBreadCrumb"></router-view>
    </div>
</template>
<script>
export default {
    name: "extension",
    data() {
        return {
            message: "Hello world!"
        };
    },
    created() {},
    mounted() {
        console.log("extension");
    },
    methods: {
        changeBreadCrumb(data) {
            console.log("index", data);
            this.$emit("changeBreadCrumb", data);
        }
    }
};
</script>
<style lang="sass" scoped>

</style>
