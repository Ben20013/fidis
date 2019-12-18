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
    <div class="info-container">
        <div class="info-content-wrap flex-wrap" v-if="infoData!=null">
            <div class="info-item">
                <div class="name">{{$t('customerLang.customer_id')}}</div>
                <div class="value num">{{infoData.customer_id}}</div>
            </div>
            <div class="info-item">
                <div class="name">{{$t('customerLang.customer_name')}}</div>
                <div class="value">{{infoData.customer_name}}</div>
            </div>
            <div class="info-item">
                <div class="name">{{$t('customerLang.province')}}</div>
                <div class="value">{{infoData.province}}</div>
            </div>
            <div class="info-item">
                <div class="name">{{$t('customerLang.city')}}</div>
                <div class="value">{{infoData.city}}</div>
            </div>
            <div class="info-item">
                <div class="name">{{$t('customerLang.phone')}}</div>
                <div class="value num">{{infoData.phone}}</div>
            </div>
            <div class="info-item">
                <div class="name">{{$t('customerLang.contact')}}</div>
                <div class="value">{{infoData.contact}}</div>
            </div>
            <div class="info-item">
                <div class="name">{{$t('customerLang.mobile')}}</div>
                <div class="value num">{{infoData.mobile}}</div>
            </div>
            <div class="info-item">
                <div class="name">{{$t('customerLang.exp_id')}}</div>
                <div class="value num">{{infoData.exp_id}}</div>
            </div>
            <div class="info-item">
                <div class="name">{{$t('customerLang.email')}}</div>
                <div class="value num">{{infoData.email}}</div>
            </div>
            <div class="info-item">
                <div class="name">{{$t('customerLang.create')}}</div>
                <div class="value num">{{infoData.created}}</div>
            </div>
            <div class="info-item desc">
                <div class="name">{{$t('customerLang.address')}}</div>
                <div class="value num">{{infoData.address}}</div>
            </div>
            <div class="info-item desc">
                <div class="name">{{$t('customerLang.description')}}</div>
                <div class="value num">{{infoData.description}}</div>
            </div>
        </div>
        <div class="md-loading" :class="{ 'active': md.loading}">
            <i class="el-icon-loading md-loading-icon"></i>
        </div>
    </div>
</template>

<script>
import customerApi from "@/assets/js/fetch/customer";

export default {
    name: "customer",
    props: {
        customerId: Number
    },
    data() {
        return {
            infoData: null,
            md: {
                loading: false
            }
        };
    },

    created() {},
    mounted() {
        this.getInfo(this.customerId);
    },
    methods: {
        getInfo(id) {
            if (!id) {
                return;
            }
            let self = this;
            self.md["loading"] = true;
            customerApi.get_customer(
                function(data) {
                    if (data.code == 200) {
                        // console.log(data);
                        self.infoData = data.result;
                    }
                    self.md["loading"] = false;
                },
                { customer_id: id }
            );
        }
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../../sass/customer/detail/info.scss";
</style>
