<template>
    <div class="content-wrap flex-column">
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
                    <el-table :data="listData" style="width: 100%;" row-key="id" height="250">
                        <el-table-column type="index" width="50"></el-table-column>
                        <el-table-column prop="project_id" label="项目编号"></el-table-column>
                        <el-table-column prop="project_name" label="项目名称"></el-table-column>
                        <el-table-column prop="class" label="项目类型"></el-table-column>
                        <el-table-column prop="environment" label="运行环境"></el-table-column>
                        <el-table-column prop="cycle" label="运行周期"></el-table-column>
                        <el-table-column prop="active" label="是否启用">
                            <template slot-scope="scope">
                                <font
                                    :color="scope.row.active==0?'red':'#777777'"
                                >{{ scope.row.active==1?'是':'否' }}</font>
                            </template>
                        </el-table-column>
                        <el-table-column prop="created" label="创建时间"></el-table-column>
                        <el-table-column prop="description" label="描述"></el-table-column>
                        <el-table-column label="操作" width="120" fixed="right">
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
                                            :disabled="scope.row.active==0?false:true"
                                            @click.native="enable(scope.row)"
                                        >启用项目</el-dropdown-item>
                                        <el-dropdown-item
                                            :disabled="scope.row.active==1?false:true"
                                            @click.native="disable(scope.row)"
                                        >禁用项目</el-dropdown-item>
                                        <el-dropdown-item
                                            divided
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
                <div class="list-pagination flex-wrap">
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
                </div>
            </div>
        </div>
        <mix-modal
            v-if="isAddModal"
            title="新增项目"
            width="685px"
            height="700px"
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
                    <el-form-item label="项目名称" prop="project_name">
                        <el-input v-model="addSheetObj.project_name" placeholder="请输入内容"></el-input>
                    </el-form-item>
                    <el-form-item label="项目类型">
                        <el-radio-group v-model="addSheetObj.class">
                            <el-radio label="customization">Customization</el-radio>
                            <el-radio label="standard">Standard</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="运行环境">
                        <el-radio-group v-model="addSheetObj.environment">
                            <el-radio label="php">php</el-radio>
                            <el-radio label="python">python</el-radio>
                            <el-radio label="go">go</el-radio>
                            <el-radio label="java">java</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="运行周期" prop="cycle">
                        <el-row>
                            <el-col :span="4">
                                <el-input v-model="cycle.add.min" placeholder="分：0~59"></el-input>
                            </el-col>
                            <el-col :span="4">
                                <el-input v-model="cycle.add.hour" placeholder="时：0~23"></el-input>
                            </el-col>
                            <el-col :span="4">
                                <el-input v-model="cycle.add.day" placeholder="日：1~31"></el-input>
                            </el-col>
                            <el-col :span="4">
                                <el-input v-model="cycle.add.month" placeholder="月：1~12"></el-input>
                            </el-col>
                            <el-col :span="4">
                                <el-input v-model="cycle.add.week" placeholder="星期：1~7"></el-input>
                            </el-col>
                        </el-row>
                    </el-form-item>
                    <el-form-item label="结果标识" prop="result_key">
                        <el-input v-model="addSheetObj.result_key" placeholder="请输入内容"></el-input>
                    </el-form-item>
                    <el-form-item label="模板">
                        <el-input
                            type="textarea"
                            v-model="addSheetObj.template"
                            placeholder="请输入内容"
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="脚本">
                        <el-input type="textarea" v-model="addSheetObj.script" placeholder="请输入内容"></el-input>
                    </el-form-item>
                    <el-form-item label="描述">
                        <el-input
                            type="textarea"
                            v-model="addSheetObj.description"
                            placeholder="请输入内容"
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="程序上传">
                        <el-upload class="upload-demo" action :limit="1" :http-request="upload">
                            <el-button size="small" type="primary">点击上传</el-button>
                            <!--<div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>-->
                        </el-upload>
                    </el-form-item>
                </el-form>
            </div>
        </mix-modal>
        <mix-modal
            v-if="isEditModal"
            title="编辑任务"
            width="685px"
            height="700px"
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
                    <el-form-item label="项目名称" prop="project_name">
                        <el-input v-model="editSheetObj.project_name" placeholder="请输入内容"></el-input>
                    </el-form-item>
                    <el-form-item label="项目类型">
                        <el-radio-group v-model="editSheetObj.class">
                            <el-radio label="customization">Customization</el-radio>
                            <el-radio label="standard">Standard</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="运行环境">
                        <el-radio-group v-model="editSheetObj.environment">
                            <el-radio label="php">php</el-radio>
                            <el-radio label="python">python</el-radio>
                            <el-radio label="go">go</el-radio>
                            <el-radio label="java">java</el-radio>
                        </el-radio-group>
                    </el-form-item>
                    <el-form-item label="运行周期" prop="cycle">
                        <el-row>
                            <el-col :span="4">
                                <el-input v-model="cycle.edit.min" placeholder="分：0~59"></el-input>
                            </el-col>
                            <el-col :span="4">
                                <el-input v-model="cycle.edit.hour" placeholder="时：0~23"></el-input>
                            </el-col>
                            <el-col :span="4">
                                <el-input v-model="cycle.edit.day" placeholder="日：1~31"></el-input>
                            </el-col>
                            <el-col :span="4">
                                <el-input v-model="cycle.edit.month" placeholder="月：1~12"></el-input>
                            </el-col>
                            <el-col :span="4">
                                <el-input v-model="cycle.edit.week" placeholder="星期：1~7"></el-input>
                            </el-col>
                        </el-row>
                    </el-form-item>
                    <el-form-item label="结果标识" prop="result_key">
                        <el-input v-model="editSheetObj.result_key" placeholder="请输入内容"></el-input>
                    </el-form-item>
                    <el-form-item label="模板">
                        <el-input
                            type="textarea"
                            v-model="editSheetObj.template"
                            placeholder="请输入内容"
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="脚本">
                        <el-input type="textarea" v-model="editSheetObj.script" placeholder="请输入内容"></el-input>
                    </el-form-item>
                    <el-form-item label="描述">
                        <el-input
                            type="textarea"
                            v-model="editSheetObj.description"
                            placeholder="请输入内容"
                        ></el-input>
                    </el-form-item>
                    <el-form-item label="程序上传">
                        <el-upload class="upload-demo" action :limit="1" :http-request="upload">
                            <el-button size="small" type="primary">点击上传</el-button>
                            <!--<div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>-->
                        </el-upload>
                    </el-form-item>
                </el-form>
            </div>
        </mix-modal>
    </div>
</template>
<script>
import projectApi from "../../fetch/project";
export default {
    name: "projectList",
    data() {
        return {
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
            cycle: {
                add: {
                    min: "*",
                    hour: "*",
                    day: "*",
                    month: "*",
                    week: "*"
                },
                edit: {
                    min: "",
                    hour: "",
                    day: "",
                    month: "",
                    week: ""
                }
            },
            addSheetObj: {
                project_id: "",
                project_name: "",
                class: "customization",
                environment: "php",
                cycle: "",
                result_key: "",
                program: "",
                active: 0,
                template: "",
                script: "",
                reference: "",
                description: "",
                created: "",
                is_available: 1
            },
            editSheetObj: {
                project_id: "",
                project_name: "",
                class: "customization",
                environment: "php",
                cycle: "",
                result_key: "",
                program: "",
                active: 0,
                template: "",
                script: "",
                reference: "",
                description: "",
                created: "",
                is_available: 1
            },
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
            projectOption: [],
            moduleOption: [],
            icon: "",
            fileList: []
        };
    },
    created() {},
    mounted() {
        this.getList();
    },
    components: {},
    methods: {
        getList() {
            const loading = this.$loading({
                lock: true,
                text: "Loading"
            });
            let self = this;
            projectApi.get_list(
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
        selectprojectIcon(data) {
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
                project_id: "",
                project_name: "",
                class: "customization",
                environment: "php",
                cycle: "",
                result_key: "",
                program: "",
                active: 0,
                template: "",
                script: "",
                reference: "",
                description: "",
                created: "",
                is_available: 1
            };
        },
        openAddModel() {
            this.clearAddInfo();
            this.isAddModal = true;
            this.isEdit = false;
        },
        openEditModel(row) {
            this.editSheetObj = Object.assign({}, row);
            let editCycle = row.cycle.split(" ");
            this.cycle.edit.min = editCycle[0];
            this.cycle.edit.hour = editCycle[1];
            this.cycle.edit.day = editCycle[2];
            this.cycle.edit.month = editCycle[3];
            this.cycle.edit.week = editCycle[4];
            console.log(this.editSheetObj);
            this.isEditModal = true;
            this.isEdit = true;
        },
        getprojectOption() {
            let self = this;
            projectApi.getprojectOption(data => {
                if (data.code == 200) {
                    self.projectOption = data.result;
                }
            });
        },
        getModuleOption() {
            let self = this;
            projectApi.getModuleOption(data => {
                if (data.code == 200) {
                    self.moduleOption = data.result;
                }
            });
        },
        get(id) {
            let self = this;
            projectApi.get(
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
            data["cycle"] =
                this.cycle.add.min +
                " " +
                this.cycle.add.hour +
                " " +
                this.cycle.add.day +
                " " +
                this.cycle.add.month +
                " " +
                this.cycle.add.week;
            projectApi.add(data => {
                let msgType = "error";
                if (data.code == 200) {
                    self.getList();
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
                    projectApi.delete(
                        data => {
                            let msgType = "error";
                            if (data.code == 200) {
                                self.getList();
                                msgType = "success";
                            }
                            self.$message({
                                type: msgType,
                                message: data.msg
                            });
                        },
                        { project_id: row.project_id }
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
            data["cycle"] =
                this.cycle.edit.min +
                " " +
                this.cycle.edit.hour +
                " " +
                this.cycle.edit.day +
                " " +
                this.cycle.edit.month +
                " " +
                this.cycle.edit.week;
            projectApi.edit(data => {
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
        enable(row) {
            this.$confirm("确认启用该项目？", "系统提示", {
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                type: "warning"
            })
                .then(() => {
                    let self = this;
                    projectApi.enable(
                        data => {
                            let msgType = "error";
                            if (data.code == 200) {
                                self.getList();
                                msgType = "success";
                            }
                            self.$message({
                                type: msgType,
                                message: data.msg
                            });
                        },
                        {
                            project_id: row.project_id
                        }
                    );
                })
                .catch(() => {
                    this.$message({
                        type: "info",
                        message: "已取消操作。"
                    });
                });
        },
        disable(row) {
            this.$confirm("确认禁用该项目？", "系统提示", {
                confirmButtonText: "确定",
                cancelButtonText: "取消",
                type: "warning"
            })
                .then(() => {
                    let self = this;
                    projectApi.disable(
                        data => {
                            let msgType = "error";
                            if (data.code == 200) {
                                self.getList();
                                msgType = "success";
                            }
                            self.$message({
                                type: msgType,
                                message: data.msg
                            });
                        },
                        {
                            project_id: row.project_id
                        }
                    );
                })
                .catch(() => {
                    this.$message({
                        type: "info",
                        message: "已取消操作。"
                    });
                });
        },
        handleRemove(file, fileList) {
            console.log(file, fileList);
        },
        handlePreview(file) {
            console.log(file);
        },
        handleExceed(files, fileList) {
            this.$message.warning(
                `当前限制选择 1 个文件，本次选择了 ${
                    files.length
                } 个文件，共选择了 ${files.length + fileList.length} 个文件`
            );
        },
        beforeRemove(file, fileList) {
            return this.$confirm(`确定移除 ${file.name}？`);
        },
        upload(item) {
            let fd = new FormData();
            fd.append("file", item.file); //传文件
            fd.append("type", "openframe"); //传其他参数
            let self = this;
            projectApi.upload(data => {
                if (data.code == 200) {
                    if (self.isEdit) {
                        self.editSheetObj.program = data.result.path;
                    } else {
                        self.addSheetObj.program = data.result.path;
                    }
                }
            }, fd);
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
.el-col-4 {
    width: 20%;
}
.el-upload__tip {
    font-size: 12px;
    color: #333333;
    margin-top: -38px;
    margin-left: 87px;
}
</style>

