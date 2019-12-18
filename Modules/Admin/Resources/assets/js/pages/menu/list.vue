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
    <div class="content-wrap flex-column">
        <!-- <div class="nav-wrap flex-wrap">
            <div class="nav-title flex-wrap flex-center">
                <span>模块管理</span>
            </div>
        </div>-->
        <div class="body-wrap">
            <div class="title-wrap flex-wrap flex-center">
                <div class="left-box flex-wrap">
                    <div class="query-box flex-wrap flex-center" @keyup.enter="getList">
                        <input
                            type="text"
                            v-model="searchString"
                            placeholder="菜单名称"
                            class="search-input"
                        />
                        <div class="search" @click="getList">
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
            <div class="table-wrap">
                <div class="list-table flex-column">
                    <el-table
                        :data="listData"
                        style="width: 100%;margin-bottom: 20px;"
                        row-key="id"
                        height="250"
                    >
                        <el-table-column type="index" width="50"></el-table-column>
                        <el-table-column prop="name" label="菜单名称"></el-table-column>
                        <el-table-column prop="icon" label="图标">
                            <template slot-scope="scope">
                                <i :class="scope.row.icon" aria-hidden="true"></i>
                            </template>
                        </el-table-column>
                        <el-table-column prop="listorder" label="排序"></el-table-column>
                        <el-table-column prop="module_name" label="对应模块"></el-table-column>
                        <el-table-column prop="route" label="路径"></el-table-column>
                        <el-table-column prop="display" label="是否显示">
                            <template slot-scope="scope">
                                <font
                                    :color="scope.row.display==0?'red':'#777777'"
                                >{{ scope.row.display==1?'是':'否' }}</font>
                            </template>
                        </el-table-column>
                        <el-table-column prop="display_system" label="显示位置"></el-table-column>
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
                                        <el-dropdown-item @click.native="deleteItem(scope.row)">
                                            <font color="red">删除信息</font>
                                        </el-dropdown-item>
                                    </el-dropdown-menu>
                                </el-dropdown>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
                <!-- <div class="list-pagination flex-wrap">
                    <el-pagination
                        background
                        @size-change="handleSizeChange"
                        @current-change="handleCurrentChange"
                        :current-page="currentPage"
                        :page-size="currentPageSize"
                        :page-sizes="[10,15,20,25,30]"
                        layout="prev, pager, next, sizes, jumper"
                        :total="listTotalRecord"
                    ></el-pagination>
                </div>-->
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
                            style="width: 423px;"
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
                        <!-- <el-row>
                            <el-col :span="2">
                                <span>
                                    <i :class="editSheetObj.icon" aria-hidden="true"></i>
                                </span>
                            </el-col>
                        <el-col :span="22">-->
                        <el-input
                            placeholder="请输入内容"
                            v-model="editSheetObj.icon"
                            class="input-with-select"
                        >
                            <el-button slot="append" icon="el-icon-search" @click="openIconModal">选择</el-button>
                        </el-input>
                        <!-- </el-col>
                        </el-row>-->
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
import menuApi from "../../fetch/menu";
import iconForm from "./icon";
export default {
    name: "menuList",
    data() {
        return {
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
        this.getList();
        this.getMenuOption();
        this.getModuleOption();
    },
    components: { iconForm },
    methods: {
        getList() {
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
                    name: this.searchString
                }
            );
        },
        add() {},
        upload() {},

        handleCurrentChange(value) {
            this.currentPage = value;
            this.getList();
        },
        handleSizeChange(val) {
            this.currentPageSize = val;
            this.getList();
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
            this.getList();
        },
        clearAddInfo() {
            this.addSheetObj = {
                name: "",
                parentid: ["0"],
                module_id: "",
                module_name: "",
                route: "",
                display: 1,
                is_enable: 1,
                display_system: [],
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
            console.log(this.edit_display_system);
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
                    self.getList();
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
                                self.getList();
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
            console.log(this.edit_display_system);
            this.editSheetObj.display_system = [this.edit_display_system];
            delete data["children"];
            menuApi.edit(data => {
                let msgType = "error";
                if (data.code == 200) {
                    self.getList();
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
        }
    }
};
</script>
<style rel="stylesheet/scss" lang="scss" scoped>
@import "../../../sass/mix-base-layout.scss";
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
</style>

