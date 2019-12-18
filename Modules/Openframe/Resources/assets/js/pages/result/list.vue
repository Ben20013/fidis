<template>
    <div class="content-wrap flex-column">
        <div class="body-wrap">
            <div class="title-wrap flex-wrap flex-center">
                <div class="left-box flex-wrap">
                    <div class="query-box flex-wrap flex-center" @keyup.enter="getList">
                        <input
                            type="text"
                            v-model="searchString"
                            placeholder="菜单名称|模块名称"
                            class="search-input"
                        >
                        <div class="search" @click="getList">
                            <i class="mix-search-icon"></i>
                        </div>
                    </div>
                    <div class="mix-icon-txt-button" @click="refresh">
                        <i class="mix-refresh-icon"></i>
                        <span>重置</span>
                    </div>
                    <!-- <div class="mix-icon-txt-button" @click="openAddModel">
                        <i class="mix-add-gray-icon"></i>
                        <span>添加</span>
                    </div>-->
                </div>
            </div>
            <div class="table-wrap">
                <div class="list-table flex-column">
                    <el-table :data="listData" style="width: 100%;" row-key="id" height="250">
                        <el-table-column type="index" width="50"></el-table-column>
                        <el-table-column prop="result_id" label="结果编号"></el-table-column>
                        <el-table-column prop="result_name" label="结果名称"></el-table-column>
                        <el-table-column prop="result_key" label="结果标识"></el-table-column>
                        <el-table-column prop="project_id" label="项目编号"></el-table-column>
                        <el-table-column prop="relation_key" label="关联标识"></el-table-column>
                        <el-table-column prop="relation_value" label="关联值"></el-table-column>
                        <el-table-column prop="category" label="数据分类"></el-table-column>
                        <el-table-column prop="value" label="数据"></el-table-column>
                        <el-table-column prop="filepath" label="附件路径"></el-table-column>
                        <el-table-column prop="description" label="描述"></el-table-column>
                        <el-table-column label="操作" width="120" fixed="right">
                            <template slot-scope="scope">
                                <el-dropdown
                                    split-button
                                    size="medium"
                                    type="primary"
                                    plain
                                    style="background-color: '#fff'"
                                    @click="detail(scope.row)"
                                >
                                    详情
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
    </div>
</template>
<script>
import resultApi from "../../fetch/result";
export default {
    name: "resultList",
    data() {
        return {
            currentPageSize: 10,
            searchString: "",
            listData: [],
            listTotalRecord: 0,
            currentPage: 1,
            activeItem: 0,
            infoData: []
        };
    },
    created() {},
    mounted() {
        this.getList();
    },
    methods: {
        getList() {
            const loading = this.$loading({
                lock: true,
                text: "Loading"
            });
            let self = this;
            resultApi.get_list(
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
                    rule_id: this.searchString,
                    rule_name: this.searchString
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
        selectresultIcon(data) {
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
        getresultOption() {
            let self = this;
            resultApi.getresultOption(data => {
                if (data.code == 200) {
                    self.resultOption = data.result;
                }
            });
        },
        getModuleOption() {
            let self = this;
            resultApi.getModuleOption(data => {
                if (data.code == 200) {
                    self.moduleOption = data.result;
                }
            });
        },
        get(id) {
            let self = this;
            resultApi.get(
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
        detail(row) {
            this.$router.push({
                path: "/openframe/result/detail?name=" + row.name,
                params: {
                    id: row.id
                }
            });
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
</style>

