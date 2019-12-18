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
    <transition name="modal-fade">
        <div
            class="md-modal-container"
            @click.stop
            role="dialog"
            aria-labelledby="modalHeader"
            arial-describedby="modalBody"
        >
            <div
                class="md-modal md-effect-1 md-show flex-column"
                :style="{
                'width':width,
                'height':height,
                'max-width':maxWidth,
                'max-height':maxHeight
            }"
            >
                <div class="md-content flex-con-1 flex-column">
                    <!--头部-->
                    <div class="title-box flex-wrap flex-center" id="modalHeader">
                        <div class="title">{{title}}</div>
                        <div class="icon-wrap" @click="close">
                            <i class="close"></i>
                        </div>
                    </div>
                    <!--内容-->
                    <div
                        class="cont-box flex-con-1"
                        id="modalBody"
                        @click.stop
                        :class="{'no-buttom':!buttom}"
                    >
                        <slot name="body"></slot>
                    </div>
                    <div class="buttom-box flex-wrap flex-center" v-if="buttom">
                        <slot name="footer">
                            <input
                                type="button"
                                class="btn-cancel"
                                @click="cancel"
                                :value="cancelText"
                            >
                            <input
                                type="button"
                                class="btn-determine"
                                @click="confirm"
                                :value="confirmText"
                            >
                        </slot>
                    </div>
                </div>
            </div>
            <div class="md-mask active"></div>
        </div>
    </transition>
</template>
<script>
export default {
    name: "mixModal",
    props: {
        title: {
            type: String,
            default: "提示"
        },
        width: {
            type: String,
            default: "auto"
        },
        height: {
            type: String,
            default: "auto"
        },
        cancelText: {
            type: String,
            default: "取消"
        },
        confirmText: {
            type: String,
            default: "确认"
        },
        buttom: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {
            msg: "mix modal"
        };
    },
    computed: {
        maxWidth() {
            return document.body.clientWidth + "px";
        },
        maxHeight() {
            return document.body.clientHeight - 50 + "px";
        }
    },
    methods: {
        close() {
            this.$emit("close");
        },
        confirm() {
            this.$emit("confirm");
        },
        cancel() {
            this.$emit("cancel");
        }
    }
};
</script>
<style  rel="stylesheet/scss" lang="scss" scoped>
@import "../../sass/common.scss";
@import "../../sass/dialog.scss";
.modal-fade-enter,
.modal-fade-leave-active {
    opacity: 0;
}
.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: opacity 0.5s ease;
}
</style>
