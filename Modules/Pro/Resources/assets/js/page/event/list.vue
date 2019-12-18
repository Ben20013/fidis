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
    <div class="cont-box flex-column">
        <div class="title-wrap flex-wrap">
            <div class="nav-wrap flex-column">
                <div class="menu-wrap flex-wrap">
                    <div
                        class="menu-item flex-column"
                        :class="{'active':currentTab=='event'}"
                        @click="changeMenu('event')"
                    >
                        <div class="txt">{{$t('eventLang.event_list')}}</div>
                        <div class="buttom-choose" v-show="currentTab=='event'"></div>
                    </div>
                    <div
                        class="menu-item flex-column"
                        :class="{'active':currentTab=='fault'}"
                        @click="changeMenu('fault')"
                    >
                        <div class="txt">{{$t('eventLang.fault_list')}}</div>
                        <div class="buttom-choose" v-show="currentTab=='fault'"></div>
                    </div>
                    <div
                        class="menu-item flex-column"
                        :class="{'active':currentTab=='alarm'}"
                        @click="changeMenu('alarm')"
                    >
                        <div class="txt">{{$t('eventLang.alert_list')}}</div>
                        <div class="buttom-choose" v-show="currentTab=='alarm'"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container flex-column">
            <component :ref="currentTab" :is="currentTab"></component>
        </div>
    </div>
</template>

<script>
import event from "./list/event";
import fault from "./list/fault";
import alarm from "./list/alarm";
export default {
    name: "eventList",
    components: {
        event: event,
        fault: fault,
        alarm: alarm
    },
    data() {
        return {
            currentTab: "event"
        };
    },

    created() {},
    mounted() {},
    methods: {
        changeMenu(type) {
            this.currentTab = type;
        }
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/event/list.scss";
</style>
