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
                <div class="content-wrap flex-column">
                    <div class="config">
                        <div class="title">系统配置</div>
                    </div>
                </div>
                <div class="buttom-wrap flex-wrap">
                    <div class="save-btn" @click="setConfig">
                        <span>保存</span>
                    </div>
                    <div class="reset-btn" @click="getConfig">
                        <span>重置</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="md-loading" :class="{ 'active': md.loading}">
            <i class="el-icon-loading md-loading-icon"></i>
        </div>
    </div>
</template>

<script>
//import settingApi from "@/fetch/setting";
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
            }
        };
    },

    created() {},
    mounted() {
        //this.getConfig();
    },
    methods: {
        setConfig() {
            let common = {
                product_name: this.productName,
                website_title: this.websiteTitle,
                copyright: this.copyright,
                app_url: this.appAdress,
                help_url: this.helpAdress,
                logo_path: this.logoPath,
                icon_path: this.iconPath
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
                                confirmButtonText: self.$t(
                                    "el.messagebox.confirm"
                                )
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
                            link.href = self.iconPath;
                            document
                                .getElementsByTagName("head")[0]
                                .appendChild(link);
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
                { data: JSON.stringify({ common: common }) }
            );
        },
        getConfig() {
            let self = this;
            self.productName = "";
            self.websiteTitle = "";
            self.copyright = "";
            self.appAdress = "";
            self.helpAdress = "";
            self.logoPath = "";
            self.iconPath = "";
            self.md["loading"] = true;
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
                        self.copyright = common["copyright"]
                            ? common["copyright"]
                            : "";
                        self.appAdress = common["app_url"]
                            ? common["app_url"]
                            : "";
                        self.helpAdress = common["help_url"]
                            ? common["help_url"]
                            : "";
                        self.logoPath = common["logo_path"]
                            ? common["logo_path"]
                            : "";
                        self.iconPath = common["icon_path"]
                            ? common["icon_path"]
                            : "";
                    }
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
        }
    },
    watch: {}
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/setting/detail.scss";
</style>
