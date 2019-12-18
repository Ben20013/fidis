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
    <div>
        <div class="content-wrap flex-column">
            <div class="content-wrap flex-column details__box">
                <div class="nav-wrap flex-wrap flex-center flex-between">
                    <div class="nav-title flex-wrap left-box">
                        <span>详细信息</span>
                    </div>
                </div>
                <div class="body-wrap">
                    <div class="table-wrap">
                        <table class="block-body-table">
                            <tr>
                                <td>{{$t('moduleLang.name')}}</td>
                                <td>{{moduleData.name}}</td>
                                <td>{{$t('moduleLang.is_system')}}</td>
                                <td>{{moduleData.is_system}}</td>
                                <td>{{$t('moduleLang.status')}}</td>
                                <td>{{moduleData.status}}</td>
                            </tr>
                            <tr>
                                <td>{{$t('moduleLang.version')}}</td>
                                <td>{{moduleData.version}}</td>
                                <td>{{$t('moduleLang.upgrade_time')}}</td>
                                <td colspan="3">{{moduleData.upgrade_time}}</td>
                            </tr>
                            <tr>
                                <td>{{$t('moduleLang.description')}}</td>
                                <td colspan="5">{{moduleData.description}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-wrap flex-column" style="margin-top: 15px;">
            <div class="body-wrap">
                <div class="table-wrap">
                    <el-tabs
                        v-model="activeName"
                        @tab-click="handlerTabClick"
                        style="margin-bottom: 15px;"
                    >
                        <el-tab-pane label="所属菜单" name="menu">
                            <div
                                class="title-wrap flex-wrap flex-center"
                                style="padding: 0px;margin: -15px 0 0 0;"
                            >
                                <div class="left-box flex-wrap">
                                    <div
                                        class="query-box flex-wrap flex-center"
                                        @keyup.enter="getMenu"
                                    >
                                        <input
                                            type="text"
                                            v-model="searchString"
                                            placeholder="菜单名称"
                                            class="search-input"
                                        />
                                        <div class="search" @click="getMenu">
                                            <i class="mix-search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="mix-icon-txt-button" @click="refresh">
                                        <i class="mix-refresh-icon"></i>
                                        <span>重置</span>
                                    </div>
                                    <div class="mix-icon-txt-button" @click="openAddModel">
                                        <i class="mix-add-gray-icon"></i>
                                        <span>添加</span>
                                    </div>
                                </div>
                            </div>
                            <div class="table-wrap" style="padding: 0px;">
                                <div class="list-table flex-column">
                                    <el-table
                                        :data="listData"
                                        style="width: 100%;margin-bottom: 20px;"
                                        row-key="id"
                                    >
                                        <el-table-column type="index" width="50"></el-table-column>
                                        <el-table-column prop="name" label="菜单名称"></el-table-column>
                                        <el-table-column prop="icon" label="图标">
                                            <template slot-scope="scope">
                                                <i :class="scope.row.icon" aria-hidden="true"></i>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="listorder" label="排序"></el-table-column>
                                        <el-table-column
                                            prop="module_name"
                                            label="对应模块"
                                            width="120"
                                        ></el-table-column>
                                        <el-table-column prop="route" label="路径"></el-table-column>
                                        <el-table-column prop="display" label="是否显示">
                                            <template slot-scope="scope">
                                                <font
                                                    :color="scope.row.display==0?'red':'#777777'"
                                                >{{ scope.row.display==1?'是':'否' }}</font>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="is_enable" label="启用/禁用">
                                            <template slot-scope="scope">
                                                <font
                                                    :color="scope.row.is_enable==0?'red':'#777777'"
                                                >{{ scope.row.is_enable==1?'启用':'禁用' }}</font>
                                            </template>
                                        </el-table-column>
                                        <el-table-column prop="params" label="附加参数"></el-table-column>
                                        <el-table-column prop="description" label="描述"></el-table-column>
                                        <el-table-column label="操作" width="120">
                                            <template slot-scope="scope">
                                                <el-dropdown
                                                    split-button
                                                    size="medium"
                                                    type="primary"
                                                    plain
                                                    style="background-color: '#fff'"
                                                    @click="openEditModel(scope.row)"
                                                >
                                                    编辑
                                                    <el-dropdown-menu slot="dropdown">
                                                        <el-dropdown-item
                                                            @click.native="deleteItem(scope.row)"
                                                        >
                                                            <font color="red">删除信息</font>
                                                        </el-dropdown-item>
                                                    </el-dropdown-menu>
                                                </el-dropdown>
                                            </template>
                                        </el-table-column>
                                    </el-table>
                                </div>
                            </div>
                        </el-tab-pane>
                        <!-- <el-tab-pane label="外部接口" name="interface">外部接口</el-tab-pane>
                        <el-tab-pane label="任务进程" name="process">任务进程</el-tab-pane>
                        <el-tab-pane label="命题配置" name="topic">命题配置</el-tab-pane>-->
                    </el-tabs>
                </div>
            </div>
        </div>
        <mix-modal
            v-show="isAddModal"
            title="新增菜单"
            width="585px"
            height="650px"
            @close="isAddModal=false"
            @cancel="isAddModal=false"
            @confirm="add"
        >
            <div class="mix-win-modal-flex-table" slot="body">
                <el-form
                    :model="addSheetObj"
                    :rules="rules"
                    ref="addSheetObj"
                    label-width="105px"
                    class="demo-ruleForm"
                >
                    <el-form-item label="上级菜单" prop="parentid">
                        <el-cascader
                            expand-trigger="hover"
                            :options="menuOption"
                            v-model="addSheetObj.parentid"
                            change-on-select
                            style="width: 440px;"
                            :show-all-levels="false"
                        ></el-cascader>
                    </el-form-item>
                    <el-form-item label="菜单名称" prop="name">
                        <el-input v-model="addSheetObj.name" placeholder="请输入内容"></el-input>
                    </el-form-item>
                    <el-form-item label="排序">
                        <el-input-number v-model="addSheetObj.listorder" placeholder="请输入内容"></el-input-number>
                    </el-form-item>
                    <el-form-item label="对应模块" prop="module_id">
                        <el-select
                            v-model="addSheetObj.module_id"
                            filterable
                            placeholder="请选择模块名"
                            @change="menuOptionChange"
                        >
                            <el-option
                                v-for="item in moduleOption"
                                :key="item.uid"
                                :label="item.name"
                                :value="item.uid"
                            >
                                <span style="float: left">{{ item.name }}</span>
                                <span
                                    style="float: right; color: #8492a6; font-size: 13px"
                                >{{ item.version }}</span>
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="路径" prop="route">
                        <el-input v-model="addSheetObj.route" placeholder="请输入内容"></el-input>
                    </el-form-item>
                    <el-form-item label="是否显示">
                        <el-radio-group v-model="addSheetObj.display">
                            <el-radio :label="1">是</el-radio>
                            <el-radio :label="0">否</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="启用/禁用">
                        <el-radio-group v-model="addSheetObj.is_enable">
                            <el-radio :label="1">启用</el-radio>
                            <el-radio :label="0">禁用</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="显示位置">
                        <el-checkbox-group v-model="add_display_system">
                            <el-checkbox label="Fidis admin"></el-checkbox>
                            <el-checkbox label="Fidis pro"></el-checkbox>
                        </el-checkbox-group>
                    </el-form-item>
                    <el-form-item label="附加参数">
                        <el-input v-model="addSheetObj.params" placeholder="请输入内容"></el-input>
                    </el-form-item>
                    <el-form-item label="图标">
                        <el-input
                            placeholder="请输入内容"
                            v-model="addSheetObj.icon"
                            class="input-with-select"
                        >
                            <el-button slot="append" icon="el-icon-search" @click="openIconModal">选择</el-button>
                        </el-input>
                    </el-form-item>
                    <el-form-item label="菜单描述">
                        <el-input
                            type="textarea"
                            v-model="addSheetObj.description"
                            placeholder="请输入内容"
                        ></el-input>
                    </el-form-item>
                </el-form>
            </div>
        </mix-modal>
        <mix-modal
            v-show="isEditModal"
            title="编辑菜单"
            width="585px"
            height="650px"
            @close="isEditModal=false"
            @cancel="isEditModal=false"
            @confirm="edit"
        >
            <div class="mix-win-modal-flex-table" slot="body">
                <el-form
                    :model="editSheetObj"
                    :rules="rules"
                    ref="editSheetObj"
                    label-width="105px"
                    class="demo-ruleForm"
                >
                    <el-form-item label="上级菜单" prop="parentid">
                        <el-cascader
                            expand-trigger="hover"
                            :options="menuOption"
                            v-model="editSheetObj.parentid"
                            style="width: 440px;"
                            :show-all-levels="false"
                        ></el-cascader>
                    </el-form-item>
                    <el-form-item label="菜单名称" prop="name">
                        <el-input v-model="editSheetObj.name" placeholder="请输入内容"></el-input>
                    </el-form-item>
                    <el-form-item label="排序">
                        <el-input-number v-model="editSheetObj.listorder" placeholder="请输入内容"></el-input-number>
                    </el-form-item>
                    <el-form-item label="对应模块" prop="module_id">
                        <el-select
                            v-model="editSheetObj.module_id"
                            filterable
                            placeholder="请选择模块名"
                            @change="menuOptionChange"
                        >
                            <el-option
                                v-for="item in moduleOption"
                                :key="item.uid"
                                :label="item.name"
                                :value="item.uid"
                            >
                                <span style="float: left">{{ item.name }}</span>
                                <span
                                    style="float: right; color: #8492a6; font-size: 13px"
                                >{{ item.version }}</span>
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="路径" prop="route">
                        <el-input v-model="editSheetObj.route" placeholder="请输入内容"></el-input>
                    </el-form-item>
                    <el-form-item label="是否显示">
                        <el-radio-group v-model="editSheetObj.display">
                            <el-radio :label="1">是</el-radio>
                            <el-radio :label="0">否</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="启用/禁用">
                        <el-radio-group v-model="editSheetObj.is_enable">
                            <el-radio :label="1">启用</el-radio>
                            <el-radio :label="0">禁用</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="显示位置">
                        <el-checkbox-group v-model="edit_display_system">
                            <el-checkbox label="Fidis admin"></el-checkbox>
                            <el-checkbox label="Fidis pro"></el-checkbox>
                        </el-checkbox-group>
                    </el-form-item>
                    <el-form-item label="附加参数">
                        <el-input v-model="editSheetObj.params" placeholder="请输入内容"></el-input>
                    </el-form-item>
                    <el-form-item label="图标">
                        <el-input
                            placeholder="请输入内容"
                            v-model="editSheetObj.icon"
                            class="input-with-select"
                        >
                            <el-button slot="append" icon="el-icon-search" @click="openIconModal">选择</el-button>
                        </el-input>
                    </el-form-item>
                    <el-form-item label="菜单描述">
                        <el-input
                            type="textarea"
                            v-model="editSheetObj.description"
                            placeholder="请输入内容"
                        ></el-input>
                    </el-form-item>
                </el-form>
            </div>
        </mix-modal>
        <mix-modal
            v-show="isIconModal"
            title="选择图标"
            width="900px"
            height="750px"
            @close="isIconModal=false"
            @cancel="isIconModal=false"
            @confirm="iconSelected"
        >
            <div class="mix-win-modal-flex-table" slot="body" style="margin: 10px -37px 10px -8px;">
                <iconForm @selectMenuIcon="selectMenuIcon"></iconForm>
            </div>
        </mix-modal>
    </div>
</template>
<script>
import moduleApi from "../../fetch/module";
import menuApi from "../../fetch/menu";
import iconForm from "../menu/icon";
export default {
    name: "moduleGroupDetail",
    data() {
        return {
            moduleName: "",
            moduleId: "",
            moduleData: {},
            activeName: "menu",
            isEdit: false,
            isAddModal: false,
            message: "Hello world!",
            expands: [],
            currentPageSize: 10,
            isEdit: false,
            isAddModal: false,
            isEditModal: false,
            isIconModal: false,
            searchString: "",
            listData: [],
            listTotalRecord: 0,
            currentPage: 1,
            activeItem: 0,
            infoData: [],
            addSheetObj: {
                name: "",
                parentid: ["0"],
                module_id: "",
                module_name: "",
                route: "",
                display: 1,
                is_enable: 1,
                display_system: this.add_display_system,
                params: "",
                icon: "",
                listorder: "",
                description: ""
            },
            add_display_system: [],
            editSheetObj: {
                name: "",
                parentid: ["0"],
                module_id: "",
                module_name: "",
                route: "",
                display: 1,
                is_enable: 1,
                display_system: this.edit_display_system,
                params: "",
                icon: "",
                listorder: "",
                description: ""
            },
            edit_display_system: [],
            rules: {
                parentid: [
                    {
                        required: true,
                        message: "请选择上级菜单",
                        trigger: "blur"
                    }
                ],
                name: [
                    {
                        required: true,
                        message: "请输入菜单名称",
                        trigger: "blur"
                    }
                ],
                version: [
                    {
                        required: true,
                        message: "请输入模块版本号",
                        trigger: "blur"
                    }
                ],
                module_id: [
                    {
                        required: true,
                        message: "请选择对应模块",
                        trigger: "blur"
                    }
                ],
                route: [
                    {
                        required: true,
                        message: "请输入菜单路径",
                        trigger: "blur"
                    }
                ]
            },
            dynamicTags: [],
            inputVisible: false,
            inputValue: "",
            menuOption: [],
            moduleOption: [],
            icon: ""
        };
    },
    created() {},
    mounted() {
        this.moduleName = this.getQueryVariable("name");
        this.getDetail();
        this.getMenu();
        this.getMenuOption();
        this.getModuleOption();
    },
    components: { iconForm },
    methods: {
        getDetail() {
            const loading = this.$loading({
                lock: true,
                text: "Loading"
            });
            let self = this;
            moduleApi.detail(
                data => {
                    if (data.code == 200) {
                        var data = data.result;
                        data.is_system = data.is_system ? "是" : "否";
                        data.status =
                            data.status == -1
                                ? "已卸载"
                                : data.status
                                ? "已安装"
                                : "未安装";

                        this.moduleData = data;
                        this.moduleName = data.name;
                        this.moduleId = data.uid;
                    }

                    setTimeout(() => {
                        loading.close();
                        // this.getMenus();
                    }, 1000);
                },
                {
                    name: this.moduleName
                }
            );
        },
        getQueryVariable(variable) {
            var query = window.location.href.split("?");
            var vars = query[1].split("&");
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split("=");
                if (pair[0] == variable) {
                    return pair[1];
                }
            }
            return false;
        },
        handlerTabClick() {},
        getMenu() {
            const loading = this.$loading({
                lock: true,
                text: "Loading"
            });
            let self = this;
            menuApi.get_list(
                data => {
                    if (data.code == 200) {
                        self.listData = data.result.data;
                        self.listTotalRecord = data.result.total_records;
                    }
                    setTimeout(() => {
                        loading.close();
                    }, 1000);
                },
                {
                    page_index: this.currentPage,
                    page_size: this.currentPageSize,
                    name: this.searchString,
                    module_name: this.moduleName
                }
            );
        },
        handleCurrentChange(value) {
            this.currentPage = value;
            this.getMenu();
        },
        handleSizeChange(val) {
            this.currentPageSize = val;
            this.getMenu();
        },
        handleClose(tag) {
            this.dynamicTags.splice(this.dynamicTags.indexOf(tag), 1);
        },
        showInput() {
            this.inputVisible = true;
            this.$nextTick(_ => {
                this.$refs.saveTagInput.$refs.input.focus();
            });
        },
        selectMenuIcon(data) {
            console.log(data);
            this.icon = data.icon;
            if (data.dbclick) {
                this.iconSelected();
            }
        },
        handleInputConfirm() {
            let inputValue = this.inputValue;
            if (inputValue) {
                this.dynamicTags.push(inputValue);
            }
            this.inputVisible = false;
            this.inputValue = "";
        },
        refresh() {
            this.searchString = "";
            this.currentPage = 1;
            this.currentPageSize = 10;
            this.getMenu();
        },
        clearAddInfo() {
            this.addSheetObj = {
                name: "",
                parentid: ["0"],
                module_id: this.moduleId,
                module_name: this.moduleName,
                route: "",
                display: 1,
                is_enable: 1,
                params: "",
                icon: "",
                listorder: "",
                description: ""
            };
            this.add_display_system = [];
        },
        openAddModel() {
            this.clearAddInfo();
            this.isAddModal = true;
        },
        openEditModel(row) {
            this.editSheetObj = Object.assign({}, row);
            this.editSheetObj.parentid = [row.parentid];
            this.edit_display_system = JSON.parse(row.display_system);
            console.log(this.editSheetObj);
            this.isEditModal = true;
        },
        openIconModal() {
            this.isIconModal = true;
            let activeEl = document.querySelectorAll(".icon_active");
            if (typeof activeEl[0] != "undefined") {
                activeEl[0].className = "";
            }
        },
        getMenuOption() {
            let self = this;
            menuApi.getMenuOption(data => {
                if (data.code == 200) {
                    self.menuOption = data.result;
                }
            });
        },
        getModuleOption() {
            let self = this;
            menuApi.getModuleOption(data => {
                if (data.code == 200) {
                    self.moduleOption = data.result;
                }
            });
        },
        get(id) {
            let self = this;
            menuApi.get(
                data => {
                    if (data.code == 200) {
                        self.infoData = data.result;
                        self.editSheetObj = self.$mix.initParams(
                            self.editSheetObj,
                            data.result
                        );
                    }
                },
                { rule_id: id }
            );
        },
        add() {
            if (this.addSheetObj.name == "") {
                this.$message({
                    message: "模块名称不能为空",
                    type: "warning"
                });
                return;
            }
            if (this.addSheetObj.parentid == "") {
                this.$message({
                    message: "上级菜单不能为空",
                    type: "warning"
                });
                return;
            }
            let self = this;
            let data = this.addSheetObj;
            data["parentid"] = this.addSheetObj.parentid[
                data.parentid.length - 1
            ];
            this.addSheetObj.parentid = [data["parentid"]];
            menuApi.add(data => {
                let msgType = "error";
                if (data.code == 200) {
                    self.getMenu();
                    self.getMenuOption();
                    self.isAddModal = false;
                    msgType = "success";
                }
                self.$message({
                    message: data.msg,
                    type: msgType
                });
            }, data);
        },
        deleteItem(row) {
            this.$confirm("确认删除该记录？", "提示", {
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                type: "warning"
            })
                .then(() => {
                    let self = this;
                    menuApi.delete(
                        data => {
                            let msgType = "error";
                            if (data.code == 200) {
                                self.activeItem = 0;
                                self.getMenu();
                                msgType = "success";
                            }
                            self.$message({
                                type: msgType,
                                message: data.msg
                            });
                        },
                        { uid: row.uid, id: row.id }
                    );
                })
                .catch(() => {
                    this.$message({
                        type: "info",
                        message: "已取消删除"
                    });
                });
        },
        edit() {
            if (this.editSheetObj.name == "") {
                this.$message({
                    message: "菜单名称不能为空",
                    type: "warning"
                });
                return;
            }
            let self = this;
            let data = this.editSheetObj;
            data["parentid"] = this.editSheetObj.parentid[
                data.parentid.length - 1
            ];
            this.editSheetObj.parentid = [data["parentid"]];
            this.editSheetObj.display_system = [this.edit_display_system];
            delete data["children"];
            menuApi.edit(data => {
                let msgType = "error";
                if (data.code == 200) {
                    self.getMenu();
                    self.isEditModal = false;
                    msgType = "success";
                }
                self.$message({
                    message: data.msg,
                    type: msgType
                });
            }, data);
        },
        menuOptionChange(value) {
            this.moduleOption.map((item, index) => {
                if (item.uid == value) {
                    this.addSheetObj.module_name = item.name;
                }
            });
        },
        iconSelected() {
            if (this.isAddModal) {
                this.addSheetObj.icon = this.icon.replace("fa-2x", "fa-1x");
            } else if (this.isEditModal) {
                this.editSheetObj.icon = this.icon.replace("fa-2x", "fa-1x");
            }
            this.isIconModal = false;
        },
        getInterface() {},
        getProcess() {}
    }
};
</script>
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/mix-base-layout.scss";
@import "../../../sass/style.scss";
.cont-box {
    flex: 1;
    padding: 16px;
    overflow: hidden;
}
.Add__list_fileBtn {
    width: 80px;
    height: 80px;
    margin-top: 10px;
    text-align: center;

    display: inline-block;
    overflow: hidden;
    position: relative;
    border: 1px solid #ccc;
    line-height: 80px;
}
</style>
<style rel="stylesheet">
.main .right-box .container {
    overflow-y: auto !important;
}
.downloadImg {
    background-image: url(/public/images/public/dowload.png);
}
.detail-add-icon {
    display: inline-block;
    width: 16px;
    height: 16px;
    background: url("/images/public/add-gray-icon.png") no-repeat center center;
}
.avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}
.avatar-uploader .el-upload:hover {
    border-color: #409eff;
}
.avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
}
.avatar {
    width: 178px;
    height: 178px;
    display: block;
}
.add_list_file {
    width: 80px;
    height: 80px;
    margin-top: 10px;
    text-align: center;

    display: inline-block;
    overflow: hidden;
    position: relative;
    border: 1px solid #ccc;
    line-height: 80px;
}
.Add__list_fileBtn input {
    opacity: 0;
}
.Add__list_fileBtn img {
    display: inline-block;
}
.Add__list_file {
    display: flex;
    align-items: center;
    padding-bottom: 0.75rem;
}

.Add__list_fileName {
    display: inline-block;
    font-size: 0.7rem;
    padding-left: 0.5rem;
}
.search__selectBox .el-select .el-input {
    width: 130px !important;
    color: #333;
}
.input-with-select .el-input-group__prepend {
    background-color: #fff !important;
}
.left-box .el-select .el-input .el-select__caret {
    color: #333 !important;
    font-weight: 600;
}
</style>
<style>
.el-table__expand-icon {
    width: 14px;
    margin-right: 5px;
    display: inline-block;
    vertical-align: middle;
    margin-top: -4px;
}
.el-form-item {
    margin-bottom: 10px;
}
.el-tabs__header {
    padding: 0;
    position: relative;
    margin: 0 0 15px;
}
</style>
