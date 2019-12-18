<!--/******************************************************************************
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
    <div id="app">
        <!--<img src="./assets/logo.png">-->
        <router-view />
    </div>
</template>

<script>
export default {
    name: "App"
};
</script>

<style>
@import "../sass/index.scss";
@import "../css/reset.css";
@import "../css/elementreset.css";
@import "../sass/common.scss";
#app {
    width: 100%;
    height: 100%;
    background: #eff2f7;
}
</style>
