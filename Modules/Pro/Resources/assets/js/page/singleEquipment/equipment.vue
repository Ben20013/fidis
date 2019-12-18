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
<template lang="html">
  <div class="main flex-wrap">
    <div class="content">
      <div class="deviceContentBox flex-column">
        <div class="deviceTopMenu flex-wrap flex-center">
          <div class="deviceContTopL">
            <div class="customerContTopL flex-wrap">
              <div class="menuItem" :class="{'active':currentTab=='info'}" @click="changeMenu('info')">信息
                <div class="buttomChoose" v-show="currentTab=='info'"></div>
              </div>
              <div class="menuItem" :class="{'active':currentTab=='status'}" @click="changeMenu('status')">状态
                <div class="buttomChoose" v-show="currentTab=='status'"></div>
              </div>
              <div class="menuItem" :class="{'active':currentTab=='history'}" @click="changeMenu('history')">历史
                <div class="buttomChoose" v-show="currentTab=='history'"></div>
              </div>
              <div class="menuItem" :class="{'active':currentTab=='course'}" @click="changeMenu('course')">历程
                <div class="buttomChoose" v-show="currentTab=='course'"></div>
              </div>
              <div class="menuItem" :class="{'active':currentTab=='event'}" @click="changeMenu('event')">事件
                <div class="buttomChoose" v-show="currentTab=='event'"></div>
              </div>
              <div class="menuItem" :class="{'active':currentTab=='fault'}" @click="changeMenu('fault')">故障
                <div class="buttomChoose" v-show="currentTab=='fault'"></div>
              </div>
              <div class="menuItem" :class="{'active':currentTab=='alarm'}" @click="changeMenu('alarm')">报警
                <div class="buttomChoose" v-show="currentTab=='alarm'"></div>
              </div>
              <div class="menuItem" :class="{'active':currentTab=='collect'}" @click="changeMenu('collect')">采集
                <div class="buttomChoose" v-show="currentTab=='collect'"></div>
              </div>
            </div>
          </div>
          <div class="deviceContTopR">
            <router-link :to="{ name: 'singleCustomerDetail', params: {'customer_id':customerId,'token':token} }">
              <div class="ic_return"></div>
            </router-link>
          </div>
        </div>
        <div class="deviceDashBoard">
          <info :ref="currentTab" :equipmentId="equipmentId" :token="token" :is="currentTab"></info>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import loginApi from "@/assets/js/fetch/login";
import config from "$config";
import info from "./tab/info";
import status from "./tab/status";
import history from "./tab/history";
import course from "./tab/course";
import event from "./tab/event";
import fault from "./tab/fault";
import alarm from "./tab/alarm";
import collect from "./tab/collect";
export default {
    name: "equipment",
    components: {
        info: info,
        status: status,
        history: history,
        course: course,
        event: event,
        fault: fault,
        alarm: alarm,
        collect: collect
    },
    data() {
        return {
            customerId: "",
            equipmentId: "",
            token: "",
            currentTab: "info",
            username: "admin",
            password: "mix123456"
        };
    },
    created() {
        this.equipmentId = this.$route.params["equipment_id"];
        this.token = this.$route.params["token"];
        this.customerId = this.$route.params["customer_id"];
    },
    mounted() {},
    methods: {
        refreshPage() {},
        changeMenu(type) {
            this.currentTab = type;
        },
        getToken() {
            let self = this;
            loginApi.login(
                function(data) {
                    if (data.code == 200) {
                        self.token = data.result.data.token;
                        self.equipmentId = self.$route.query.equipment_id;
                    }
                },
                {
                    username: self.username,
                    password: self.password,
                    system: config.system
                }
            );
        }
    }
};
</script>

<style rel="stylesheet/scss">
.el-collapse-item__header {
    border-bottom: none;
    padding-left: 30px;
    font-family: MicrosoftYaHei;
    font-size: 16px;
    font-weight: normal;
    font-stretch: normal;
    letter-spacing: 0px;
    color: #111111;
}
.el-collapse-item__header.is-active {
    border-bottom: 1px solid #e5e5e5;
}
.dataCurvewin
    .el-date-editor.el-input.el-input--prefix.el-input--suffix.el-date-editor--datetime {
    width: 175px;
}
</style>
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/singleEquipment/equipment.scss";
</style>
