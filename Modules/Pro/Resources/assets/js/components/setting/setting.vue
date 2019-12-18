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
    <div class="cont-view flex-column">
        <div class="cont-box">
            <div class="container flex-column">
                <div class="base-info">
                    <!-- <div class="title-wrap">
                        <span class="title">{{$t('settingLang.setting')}}</span>
                    </div>-->
                    <div class="content-wrap flex-column">
                        <div class="config">
                            <div class="title">{{$t('settingLang.base_conf')}}</div>
                            <div class="config-content">
                                <!-- <div class="row flex-wrap">
								<div class="name">{{$t('settingLang.product_name')}}</div>
								<div class="value">
									<el-input :placeholder="$t('common.placeholder_input')" v-model="productName"></el-input>
								</div>
                                </div>-->
                                <div class="row flex-wrap">
                                    <div class="name">{{$t('settingLang.website_title')}}</div>
                                    <div class="value">
                                        <el-input
                                            :placeholder="$t('common.placeholder_input')"
                                            v-model="websiteTitle"
                                        ></el-input>
                                    </div>
                                </div>
                                <!-- <div class="row flex-wrap">
								<div class="name">{{$t('settingLang.copyright_info')}}</div>
								<div class="value">
									<el-input :placeholder="$t('common.placeholder_input')" v-model="copyright"></el-input>
								</div>
                                </div>-->
                                <div class="row flex-wrap">
                                    <div class="name">{{$t('settingLang.app_download_address')}}</div>
                                    <div class="value">
                                        <el-input
                                            :placeholder="$t('common.placeholder_input')"
                                            v-model="appAdress"
                                        ></el-input>
                                    </div>
                                </div>
                                <div class="row flex-wrap">
                                    <div class="name">{{$t('settingLang.help_address')}}</div>
                                    <div class="value">
                                        <el-input
                                            :placeholder="$t('common.placeholder_input')"
                                            v-model="helpAdress"
                                        ></el-input>
                                    </div>
                                </div>
                                <!-- <div class="row flex-wrap">
								<div class="name">{{$t('settingLang.website_logo')}}</div>
								<div class="value">
									<div class="image-wrap">
										<img v-if="logoPath != ''" :src="logoPath" alt="">
									</div>
								</div>
							</div>
							<div class="row flex-wrap tip">
								<div class="name"></div>
								<div class="value tip-txt">{{$t('settingLang.logo_tip')}}</div>
							</div>
							<div class="row flex-wrap upload">
								<div class="name"></div>
								<div class="value">
									<div class="upload-btn">
										<span>{{$t('settingLang.upload_img')}}</span>
										<input type="file" accept="image/*" name="" value="" @change="uploadLogo($event)">
									</div>
								</div>
                                </div>-->
                                <div class="row flex-wrap">
                                    <div class="name">{{$t('settingLang.website_icon')}}</div>
                                    <div class="value">
                                        <div class="image-wrap icon">
                                        <img v-if="iconPath != ''" :src="iconPath  + '?t=' + (+new Date())" alt>
                                        </div>
                                    </div>
                                </div>
                                <div class="row flex-wrap tip">
                                    <div class="name"></div>
                                    <div class="value tip-txt">{{$t('settingLang.icon_tip')}}</div>
                                </div>
                                <div class="row flex-wrap upload">
                                    <div class="name"></div>
                                    <div class="value">
                                        <div class="upload-btn">
                                            <span>{{$t('settingLang.upload_icon')}}</span>
                                            <input
                                                type="file"
                                                accept="image/*"
                                                name
                                                value
                                                @change="uploadIcon($event)"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="base-info">
                    <div class="content-wrap flex-column">
                        <div class="config">
                            <div class="title">{{$t('settingLang.system_conf')}}</div>
                            <div class="config-content">
                                <el-tabs v-model="activeName">
                                    <el-tab-pane
                                        :label="$t('settingLang.project_config')"
                                        name="first"
                                    >
                                        <div class="row flex-wrap">
                                            <div class="name">{{$t('settingLang.system_industry')}}</div>
                                            <div class="value">
                                                <el-select
                                                    v-model="industryValue"
                                                    @change="industryChange"
                                                >
                                                    <el-option
                                                        v-for="item in industryOptions"
                                                        :key="item.value"
                                                        :label="item.label"
                                                        :value="item.value"
                                                    ></el-option>
                                                </el-select>
                                            </div>
                                        </div>
                                        <div class="row flex-wrap">
                                            <div
                                                class="name"
                                            >{{$t('settingLang.system_project_alias')}}</div>
                                            <div class="value">
                                                <el-input
                                                    :placeholder="$t('common.placeholder_input')"
                                                    v-model="projectAlias"
                                                ></el-input>
                                            </div>
                                        </div>
                                        <div class="row flex-wrap">
                                            <div class="name">{{$t('settingLang.system_hasstatus')}}</div>
                                            <div class="value">
                                                <!-- <el-select v-model="statusValue">
                                        <el-option
                                            v-for="item in statusOptions"
                                            :key="item.value"
                                            :label="item.label"
                                            :value="item.value"
                                        ></el-option>
                                                </el-select>-->
                                                <el-radio-group
                                                    v-model="statusValue"
                                                    @change="statusChange"
                                                >
                                                    <el-radio
                                                        v-for="item in statusOptions"
                                                        :key="item.value"
                                                        :label="item.value"
                                                    >{{item.label}}</el-radio>
                                                </el-radio-group>
                                            </div>
                                        </div>
                                        <div
                                            class="row flex-wrap"
                                            v-if="statusValue==1||statusValue=='1'"
                                        >
                                            <div class="name">{{$t('settingLang.status_field')}}</div>
                                            <div class="value">
                                                <el-input
                                                    class="input-new-tag"
                                                    v-model="inputStatusKey"
                                                    size="small"
                                                    placeholder="key"
                                                ></el-input>
                                                <el-input
                                                    class="input-new-tag"
                                                    v-model="inputStatusValue"
                                                    size="small"
                                                    placeholder="name"
                                                ></el-input>
                                            </div>
                                        </div>
                                        <div class="row flex-wrap">
                                            <div class="name">{{$t('settingLang.system_header')}}</div>
                                            <div class="value">
                                                <el-tag
                                                    :key="tag.key"
                                                    v-for="tag in header"
                                                    closable
                                                    :disable-transitions="false"
                                                    @close="handleClose(tag)"
                                                >{{tag.key+' | '+tag.name}}</el-tag>
                                            </div>
                                        </div>
                                        <div class="row flex-wrap">
                                            <div class="name"></div>
                                            <div class="value">
                                                <el-input
                                                    class="input-new-tag"
                                                    v-if="inputVisible"
                                                    v-model="inputKey"
                                                    ref="saveTagInputKey"
                                                    size="small"
                                                    placeholder="key"
                                                ></el-input>
                                                <el-input
                                                    class="input-new-tag"
                                                    v-if="inputVisible"
                                                    v-model="inputValue"
                                                    ref="saveTagInputValue"
                                                    size="small"
                                                    placeholder="name"
                                                ></el-input>
                                                <el-button
                                                    v-if="inputVisible"
                                                    class="button-new-tag"
                                                    size="small"
                                                    @click="handleInputConfirm('save')"
                                                >{{$t('settingLang.save')}}</el-button>
                                                <el-button
                                                    v-if="inputVisible"
                                                    class="button-new-tag"
                                                    size="small"
                                                    @click="handleInputConfirm('cancel')"
                                                    type="warning"
                                                >{{$t('settingLang.cancel')}}</el-button>
                                                <el-button
                                                    v-else
                                                    class="button-new-tag"
                                                    size="small"
                                                    @click="showInput"
                                                >{{$t('settingLang.add_field')}}</el-button>
                                            </div>
                                        </div>
                                    </el-tab-pane>
                                    <el-tab-pane
                                        :label="$t('settingLang.equipment_config')"
                                        name="second"
                                    >
                                        <el-table :data="fieldData" style="width: 100%" stripe>
                                            <el-table-column
                                                :label="$t('settingLang.field_listorder')"
                                                width="100"
                                            >
                                                <template slot-scope="scope">
                                                    <span>{{ scope.row.listorder }}</span>
                                                </template>
                                            </el-table-column>
                                            <el-table-column
                                                :label="$t('settingLang.field_width')"
                                                width="100"
                                            >
                                                <template slot-scope="scope">
                                                    <span>{{ scope.row.width }}</span>
                                                </template>
                                            </el-table-column>
                                            <!-- <el-table-column label="字段标识" width="150">
                                                <template slot-scope="scope">
                                                    <span>{{ scope.row.id }}</span>
                                                </template>
                                            </el-table-column>-->
                                            <el-table-column
                                                :label="$t('settingLang.field_name')"
                                                width="150"
                                            >
                                                <template slot-scope="scope">
                                                    <span>{{ scope.row.name }}</span>
                                                </template>
                                            </el-table-column>
                                            <el-table-column
                                                :label="$t('settingLang.field_show')"
                                                width="100"
                                            >
                                                <template slot-scope="scope">
                                                    <el-tag
                                                        size="medium"
                                                        :type="(scope.row.show=='1'||scope.row.show==1)?'':'danger'"
                                                    >{{ (scope.row.show=='1'||scope.row.show==1)?$t('settingLang.yes'):$t('settingLang.no') }}</el-tag>
                                                </template>
                                            </el-table-column>
                                            <!-- <el-table-column label="是否搜索" width="100">
                                                <template slot-scope="scope">
                                                    <el-tag
                                                        size="medium"
                                                        :type="scope.row.search?'':'danger'"
                                                    >{{ scope.row.search?'是':'否' }}</el-tag>
                                                </template>
                                            </el-table-column>-->
                                            <el-table-column :label="$t('settingLang.operation')">
                                                <template slot-scope="scope">
                                                    <el-button
                                                        size="mini"
                                                        @click="handleEdit(scope.row, scope.$index)"
                                                    >{{$t('settingLang.edit')}}</el-button>
                                                </template>
                                            </el-table-column>
                                        </el-table>
                                    </el-tab-pane>
                                </el-tabs>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="buttom-wrap flex-wrap">
                    <div class="save-btn" @click="setConfig">
                        <span>{{$t('settingLang.save')}}</span>
                    </div>
                    <div class="reset-btn" @click="getConfig">
                        <span>{{$t('settingLang.reset')}}</span>
                    </div>
                </div>
            </div>
            <el-dialog
                :title="$t('settingLang.edit_field')"
                :visible.sync="dialogFormVisible"
                :modal-append-to-body="false"
                width="350px"
            >
                <el-form label-width="100px">
                    <el-form-item :label="$t('settingLang.field_listorder')">
                        <el-input-number
                            v-model="fieldRecord.listorder"
                            :min="1"
                            :max="1000"
                            width="100%"
                        ></el-input-number>
                    </el-form-item>
                    <el-form-item :label="$t('settingLang.field_width')">
                        <el-input-number
                            v-model="fieldRecord.width"
                            :min="1"
                            :max="1000"
                            width="100%"
                        ></el-input-number>
                    </el-form-item>
                    <el-form-item :label="$t('settingLang.field_name')">
                        <el-input v-model="fieldRecord.name" :disabled="true"></el-input>
                    </el-form-item>
                    <el-form-item :label="$t('settingLang.field_show')">
                        <el-radio-group v-model="fieldRecord.show">
                            <el-radio label="1">{{$t('settingLang.yes')}}</el-radio>
                            <el-radio label="0">{{$t('settingLang.no')}}</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="是否搜索：">
                        <el-radio-group v-model="fieldRecord.search">
                            <el-radio label="1">{{$t('settingLang.yes')}}</el-radio>
                            <el-radio label="0">{{$t('settingLang.no')}}</el-radio>
                        </el-radio-group>
                    </el-form-item>
                </el-form>
                <div slot="footer" class="dialog-footer">
                    <el-button @click="dialogFormVisible = false">{{$t('settingLang.cancel')}}</el-button>
                    <el-button type="primary" @click="handleEditConfirm">{{$t('settingLang.save')}}</el-button>
                </div>
            </el-dialog>
        </div>

        <div class="md-loading" :class="{ 'active': md.loading}">
            <i class="el-icon-loading md-loading-icon"></i>
        </div>
    </div>
</template>

<script>
import settingApi from "@/assets/js/fetch/setting";
export default {
    name: "setting",
    data() {
        return {
            productName: "",
            websiteTitle: "",
            copyright: "",
            appAdress: "",
            helpAdress: "",
            logoPath: "",
            iconPath: "",
            md: {
                loading: false
            },
            industryOptions: [],
            industryValue: "",
            statusOptions: [],
            statusValue: "",
            isSetStatus: 0,
            projectAlias: "",
            header: [],
            statusField: [],
            inputVisible: false,
            inputValue: "",
            inputKey: "",
            inputStatusKey: "",
            inputStatusValue: "",
            config: {},
            activeName: "first",
            fieldData: [],
            dialogFormVisible: false,
            fieldRecord: {
                id: "",
                listorder: "",
                name: "",
                show: "",
                search: "",
                width: ""
            },
            fieldIndex: ""
        };
    },

    created() {},
    mounted() {
        this.getConfig();
    },
    methods: {
        setConfig() {
            let common = {
                product_name: this.productName,
                website_title: this.websiteTitle,
                // 'copyright':this.copyright,
                app_url: this.appAdress,
                help_url: this.helpAdress,
                // 'logo_path':this.logoPath,
                icon_path: this.iconPath
            };
            let system = {
                industry: this.industryValue,
                hasStatus: this.statusValue,
                name: this.projectAlias,
                header: this.header,
                status: {
                    key: this.inputStatusKey,
                    name: this.inputStatusValue
                },
                equipment: this.fieldData
            };
            let self = this;
            self.md["loading"] = true;
            settingApi.set_config(
                data => {
                    self.md["loading"] = false;
                    if (data.code == 200) {
                        self.$alert(
                            self.$t("settingLang.save_conf_success"),
                            self.$t("settingLang.setting"),
                            {
                                confirmButtonText: self.$t( "el.messagebox.confirm"),
                                callback: action => {
                                    window.location.reload()
                                }
                            }
                        );
                        document.querySelector("title").innerHTML =
                            self.websiteTitle;
                        if (self.iconPath) {
                            var link =
                                document.querySelector("link[rel*='icon']") ||
                                document.createElement("link");
                            link.type = "image/x-icon";
                            link.rel = "shortcut icon";
                            link.href = self.iconPath + "?t=" + +new Date();
                            document.getElementsByTagName("head")[0].appendChild(link);
                        }
                        // console.log(data);
                    } else {
                        self.$alert(
                            self.$t("settingLang.save_conf_fail"),
                            self.$t("settingLang.setting"),
                            {
                                confirmButtonText: self.$t(
                                    "el.messagebox.confirm"
                                )
                            }
                        );
                    }
                },
                { data: JSON.stringify({ common: common, system: system }) }
            );
        },
        getConfig() {
            let self = this;
            self.productName = "";
            self.websiteTitle = "";
            // self.copyright = '';
            self.appAdress = "";
            self.helpAdress = "";
            self.logoPath = "";
            self.iconPath = "";
            self.md["loading"] = true;
            self.industryValue = "";
            self.industryOptions = [];
            self.statusValue = "";
            self.projectAlias = "";
            self.header = [];
            self.config = {};
            self.inputStatusKey = "";
            self.inputStatusValue = "";
            settingApi.get_config(data => {
                self.md["loading"] = false;
                if (data.code == 200) {
                    let result = data.result;
                    if (result["common"]) {
                        let common = result["common"];
                        self.productName = common["product_name"]
                            ? common["product_name"]
                            : "";
                        self.websiteTitle = common["website_title"]
                            ? common["website_title"]
                            : "";
                        // self.copyright = common['copyright']?common['copyright']:'';
                        self.appAdress = common["app_url"]
                            ? common["app_url"]
                            : "";
                        self.helpAdress = common["help_url"]
                            ? common["help_url"]
                            : "";
                        // self.logoPath = common['logo_path']?common['logo_path']:'';
                        self.iconPath = common["icon_path"]
                            ? common["icon_path"]
                            : "";
                        let system = result["system"];
                        self.industryOptions = system["industry_option"]
                            ? system["industry_option"]
                            : "";
                        self.industryValue = system["industry"]
                            ? system["industry"]
                            : "";
                        self.statusOptions = system["status_option"]
                            ? system["status_option"]
                            : "";
                        self.statusValue =
                            typeof system["hasStatus"] != "undefined"
                                ? system["hasStatus"]
                                : "";
                        self.projectAlias = system["name"]
                            ? system["name"]
                            : "";
                        self.header = system["header"] ? system["header"] : "";
                        self.config = system["config"] ? system["config"] : "";
                        self.inputStatusKey = system["status"]["key"]
                            ? system["status"]["key"]
                            : "";
                        self.inputStatusValue = system["status"]["name"]
                            ? system["status"]["name"]
                            : "";
                    }
                    self.fieldData = result.system.equipment;
                }
            });
        },
        uploadLogo(event) {
            let file = event.target.files[0];
            if (file) {
                let formData = new FormData();
                formData.append("file", file);
                let self = this;
                settingApi.upload_logo(data => {
                    if (data.code == 200) {
                        self.logoPath = data.result.path;
                        // console.log(self.logoPath);
                    }
                }, formData);
            }
        },
        uploadIcon(event) {
            let file = event.target.files[0];
            if (file) {
                let formData = new FormData();
                formData.append("file", file);
                let self = this;
                settingApi.upload_icon(data => {
                    if (data.code == 200) {
                        self.iconPath = data.result.path;
                        // console.log(self.logoPath);
                    }
                }, formData);
            }
        },
        industryChange(industryOption) {
            console.log(industryOption);
            // this.header = this.config[industry].header;
            this.header =
                industryOption != industry.industry ? [] : industry.header;
            this.industryValue = industryOption;
            this.projectAlias = this.config[industryOption].name;
            this.statusValue = this.config[industryOption].hasStatus;
            this.inputStatusKey = "";
            this.inputStatusValue = "";
        },
        handleClose(tag) {
            this.header.splice(this.header.indexOf(tag), 1);
        },

        showInput() {
            this.inputVisible = true;
            this.$nextTick(_ => {
                this.$refs.saveTagInputKey.$refs.input.focus();
            });
        },

        handleInputConfirm(type) {
            let self = this;
            if (type == "save") {
                let inputValue = self.inputValue;
                let inputKey = self.inputKey;
                let isExist = false;
                self.header.some(function(item) {
                    if (item.key == inputKey) {
                        self.$message({
                            message: self.$t("settingLang.key_exist"),
                            type: "warning"
                        });
                        isExist = true;
                        return;
                    }
                });
                if (inputValue && inputKey && !isExist) {
                    self.header.push({
                        name: inputValue,
                        key: inputKey
                    });
                    self.inputVisible = false;
                    self.inputValue = "";
                    self.inputKey = "";
                }
            } else {
                self.inputVisible = false;
                self.inputValue = "";
                self.inputKey = "";
            }
        },
        statusChange(value) {
            console.log(value);
            if (value == 0) {
                this.inputStatusKey = "";
                this.inputStatusValue = "";
            }
        },
        handleEdit(row, index) {
            this.dialogFormVisible = true;
            this.fieldRecord.id = row.id;
            this.fieldRecord.listorder = row.listorder;
            this.fieldRecord.name = row.name;
            this.fieldRecord.show = row.show;
            this.fieldRecord.search = row.search;
            this.fieldRecord.width = row.width;
            //this.fieldRecord = row;
            this.fieldIndex = index;
        },
        handleEditConfirm() {
            this.dialogFormVisible = false;
            console.log(this.fieldIndex);
            console.log(this.fieldRecord);
            console.log(this.fieldData[this.fieldIndex]);
            this.fieldData[
                this.fieldIndex
            ].listorder = this.fieldRecord.listorder;
            this.fieldData[this.fieldIndex].show = this.fieldRecord.show;
            this.fieldData[this.fieldIndex].search = this.fieldRecord.search;
            this.fieldData[this.fieldIndex].width = this.fieldRecord.width;
        }
    },
    watch: {}
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/setting/setting.scss";
</style>
