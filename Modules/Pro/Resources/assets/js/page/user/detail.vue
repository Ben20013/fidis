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
        <div class="detail-container flex-column">
            <div class="title-wrap flex-wrap">
                <span class="title">{{$t('userLang.user_base_info')}}</span>
                <div class="btn-wrap flex-wrap">
                    <div class="edit-btn" @click="showMd('edit')">
                        <i class="mix-edit-icon"></i>
                    </div>
                    <div
                        class="delete-btn"
                        v-if="userData&&!userData['is_super']"
                        @click="showMd('delete')"
                    >
                        <i class="mix-delete-icon"></i>
                    </div>
                </div>
            </div>
            <div class="content-wrap">
                <div class="info-container">
                    <div class="info-content-wrap flex-wrap" v-if="userData!=null">
                        <div class="info-item">
                            <div class="name">{{$t('userLang.user_id')}}</div>
                            <div class="value num">{{userData.user_id}}</div>
                        </div>
                        <div class="info-item">
                            <div class="name">{{$t('userLang.user_name')}}</div>
                            <div class="value">{{userData.username}}</div>
                        </div>
                        <div class="info-item">
                            <div class="name">{{$t('userLang.authorization')}}</div>
                            <div class="value">{{userData.authorization}}</div>
                        </div>
                        <div class="info-item">
                            <div class="name">{{$t('userLang.system')}}</div>
                            <div class="value">{{userData.system}}</div>
                        </div>
                        <div class="info-item">
                            <div class="name">{{$t('userLang.mobile')}}</div>
                            <div class="value num">{{userData.mobile}}</div>
                        </div>
                        <div class="info-item">
                            <div class="name">{{$t('userLang.email')}}</div>
                            <div class="value">{{userData.email}}</div>
                        </div>
                        <div class="info-item">
                            <div class="name">{{$t('userLang.created')}}</div>
                            <div class="value num">{{userData.created}}</div>
                        </div>
                        <div class="info-item">
                            <div class="name">{{$t('userLang.address')}}</div>
                            <div class="value num">{{userData.address}}</div>
                        </div>
                        <div class="info-item">
                            <div class="name">{{$t('userLang.description')}}</div>
                            <div class="value num">{{userData.description}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--弹框-->
        <div class="md-mask" :class="{ 'active': md.mask}"></div>
        <div class="md-loading" :class="{ 'active': md.loading}">
            <i class="el-icon-loading md-loading-icon"></i>
        </div>
        <!-- 编辑-->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 edit-user" :class="{ 'md-show': md.edit}">
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">{{$t('userLang.edit_info')}}</div>
                        <div class="iconWrap" @click="closeMd('edit')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <div class="contentBox">
                        <div class="inputBox flex-wrap">
                            <div class="contL flex-con-1">
                                <div class="title">{{$t('userLang.user_name')}}</div>
                                <el-input
                                    v-model="editUserData.username"
                                    class="mix-input"
                                    :placeholder="$t('userLang.please_input_user_name')"
                                ></el-input>
                                <div class="title">{{$t('userLang.email')}}</div>
                                <el-input
                                    v-model="editUserData.email"
                                    class="mix-input"
                                    :placeholder="$t('userLang.please_input_email')"
                                ></el-input>
                                <div class="title">{{$t('userLang.user_password')}}</div>
                                <el-input
                                    v-model="editUserData.authentication"
                                    class="mix-input"
                                    :placeholder="$t('userLang.please_input_passwrod')"
                                ></el-input>
                            </div>
                            <div class="contR flex-con-1">
                                <div class="title">{{$t('userLang.mobile')}}</div>
                                <el-input
                                    v-model="editUserData.mobile"
                                    class="mix-input"
                                    :placeholder="$t('userLang.please_input_mobile')"
                                ></el-input>
                                <div class="title">{{$t('userLang.authorization')}}</div>
                                <el-checkbox-group
                                    class="checkbox"
                                    @change="checkboxChange"
                                    v-model="checkListEdit"
                                >
                                    <el-checkbox border label="PRO"></el-checkbox>
                                    <el-checkbox border label="APP"></el-checkbox>
                                </el-checkbox-group>
                            </div>
                        </div>
                        <div class="aLineBox">
                            <div class="aLineBoxL">{{$t('userLang.address')}}</div>
                            <el-input
                                v-model="editUserData.address"
                                class="mix-input"
                                :placeholder="$t('common.placeholder_input')"
                            ></el-input>
                        </div>
                        <div class="serviceDescriptionT">{{$t('userLang.description')}}</div>
                        <el-input
                            type="textarea"
                            class="mix-input"
                            :rows="3"
                            :placeholder="$t('common.placeholder_input')"
                            v-model="editUserData.description"
                        ></el-input>
                    </div>
                    <div class="buttomBox flex-wrap flex-center">
                        <input
                            type="button"
                            class="btn_cancel"
                            :value="$t('common.btn_cancel')"
                            @click="closeMd('edit')"
                        >
                        <input
                            type="button"
                            class="btn_determine"
                            :value="$t('common.btn_determine')"
                            @click="editUser('edit')"
                        >
                    </div>
                </div>
            </div>
        </div>
        <!--删除用户确认-->
        <div class="md-modal-container">
            <div class="md-modal md-effect-1 delete" :class="{ 'md-show': md.delete}">
                <div class="md-content">
                    <!--头部-->
                    <div class="titleBox flex-wrap flex-center">
                        <div class="title">{{$t('userLang.delete')}}</div>
                        <div class="iconWrap" @click="closeMd('delete')">
                            <i class="close"></i>
                        </div>
                    </div>
                    <div class="contentBox">{{$t('userLang.confirm_delete_tip')}}</div>
                    <div class="buttomBox flex-wrap flex-center">
                        <input
                            type="button"
                            class="btn_cancel"
                            :value="$t('common.btn_cancel')"
                            @click="closeMd('delete')"
                        >
                        <input
                            type="button"
                            class="btn_determine"
                            :value="$t('common.btn_determine')"
                            @click="deleteUser()"
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import userApi from "@/assets/js/fetch/user";

export default {
    name: "userDetail",
    props: {
        userId: Number
    },
    data() {
        return {
            userData: null,
            checkListEdit: ["PRO"],
            editUserData: {
                user_id: "",
                username: "",
                mobile: "",
                address: "",
                email: "",
                description: "",
                authentication: ""
            },
            md: {
                mask: false,
                edit: false,
                delete: false
            }
        };
    },

    created() {},
    mounted() {
        let params = this.$route.params;
        if (params.userId && params.userName) {
            this.userId = params.userId;
            this.userName = params.userName;
        } else if (!this.userId) {
            this.$router.push({ name: "user", path: "/user" });
        }
        this.getInfo();
    },
    methods: {
        getInfo() {
            if (!this.userId) {
                return;
            }
            let self = this;
            userApi.get(
                function(data) {
                    if (data.code == 200) {
                        self.userData = data.result;
                        self.editUserData = Object.assign(
                            {},
                            data.result
                        );
                        self.checkListEdit = self.editUserData.authorization.split(
                            ","
                        );
                        return;
                    }
                },
                { user_id: this.userId }
            );
        },
        editUser() {
            let self = this;
            if (
                this.editUserData.username == "" ||
                this.editUserData.username == null
            ) {
                self.toast(this.$t("userLang.user_name_not_null"), "warning");
            } else if (
                this.editUserData.mobile == "" ||
                this.editUserData.mobile == null
            ) {
                self.toast(self.$t("userLang.input_mobile_tip"), "warning");
            } else {
                if (
                    self.editUserData.authentication == "" ||
                    self.editUserData.authentication == undefined
                ) {
                    self.editUserData.authentication = "";
                }
                userApi.edit(
                    function(data) {
                        if (data.code == "200") {
                            self.toast(
                                self.$t("userLang.edit_success"),
                                "success"
                            );
                            self.closeMd("edit");
                            self.getInfo();
                        } else {
                            self.toast(self.$t("userLang.edit_fail"), "error");
                        }
                    },
                    {
                        user_id: self.userId,
                        password: self.editUserData.authentication,
                        username: self.editUserData.username,
                        mobile: self.editUserData.mobile,
                        address: self.editUserData.address,
                        email: self.editUserData.email,
                        authorization: self.checkListEdit,
                        description: self.editUserData.description,
                        system: "PRO"
                    }
                );
            }
        },
        checkboxChange(value) {},
        deleteUser() {
            let self = this;
            userApi.delete(
                function(data) {
                    if (data.code == "200") {
                        self.toast(
                            self.$t("userLang.delete_success"),
                            "success"
                        );
                        self.closeMd("delete");
                        self.$router.push({ name: "user", path: "/user" });
                    } else {
                        self.toast(data.msg, "error");
                    }
                },
                { user_id: this.userId }
            );
        },
        toast(msg, type) {
            this.$message({
                message: msg,
                type: type
            });
        },
        //弹框事件开关
        showMd(md) {
            this.md[md] = true;
            this.md.mask = true;
            if (md == "edit") {
                this.editUserData = Object.assign({}, this.userData);
            }
        },
        closeMd(md) {
            this.md[md] = false;
            this.md.mask = false;
        }
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/user/detail.scss";
</style>
