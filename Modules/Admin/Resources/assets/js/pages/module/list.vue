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
    <div class="body-wrap">
      <div class="title-wrap flex-wrap flex-center">
        <div class="left-box flex-wrap">
          <div class="query-box flex-wrap flex-center" @keyup.enter="getList">
            <input type="text" v-model="searchString" placeholder="请输入模块名称" class="search-input" />
            <div class="search" @click="getList">
              <i class="mix-search-icon"></i>
            </div>
          </div>
          <div class="mix-icon-txt-button" @click="refresh">
            <i class="mix-refresh-icon"></i>
            <span>重置</span>
          </div>
          <!-- <div class="mix-icon-txt-button" @click="openUploadModal">
                        <i class="el-icon-upload2" style="font-size: 18px;font-weight: bold;"></i>
                        <span>上传</span>
          </div>-->
        </div>
      </div>
      <div class="table-wrap">
        <div class="list-table flex-column">
          <el-table :data="listData" style="width: 100%" height="250" stripe highlight-current-row @row-click="detail">
            <el-table-column type="index" width="50" fixed></el-table-column>
            <el-table-column prop="name" label="模块名称"></el-table-column>
            <el-table-column prop="is_system" label="是否系统模块">
              <template slot-scope="scope">{{ scope.row.is_system?'是':'否' }}</template>
            </el-table-column>
            <el-table-column prop="status" label="启用/禁用">
              <template slot-scope="scope">
                <font
                  :color="scope.row.is_enable==0?'red':'#777777'"
                >{{ scope.row.is_enable==1?'启用':'禁用' }}</font>
              </template>
            </el-table-column>
            <el-table-column prop="status" label="模块状态">
              <template slot-scope="scope">
                <font
                  :color="scope.row.status==-1?'red':(scope.row.status?'#777777':'#008800')"
                >{{ scope.row.status==-1?'已卸载':(scope.row.status?'已安装':'未安装') }}</font>
              </template>
            </el-table-column>
            <el-table-column prop="version" label="版本号"></el-table-column>
            <el-table-column prop="upgrade_time" label="更新时间" sortable></el-table-column>
            <el-table-column prop="description" label="模块描述"></el-table-column>
            <el-table-column label="操作" width="120">
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
                    <!-- <el-dropdown-item
                                            @click.native="openEditModel(scope.row)"
                    >编辑信息</el-dropdown-item>-->
                    <el-dropdown-item
                      :disabled="scope.row.status==-1?false:(scope.row.status==0?false:true)"
                      @click.native="install(scope.row)"
                    >安装模块</el-dropdown-item>
                    <el-dropdown-item
                      :disabled="(scope.row.status==1&&scope.row.is_system!=1)?false:true"
                      @click.native="uninstall(scope.row)"
                    >卸载模块</el-dropdown-item>
                    <el-dropdown-item
                      divided
                      :disabled="scope.row.is_enable==0?false:true"
                      @click.native="enable(scope.row)"
                    >启用模块</el-dropdown-item>
                    <el-dropdown-item
                      :disabled="scope.row.is_enable==1?false:true"
                      @click.native="disable(scope.row)"
                    >禁用模块</el-dropdown-item>
                    <el-dropdown-item
                      divided
                      :disabled="(scope.row.status==1&&scope.row.is_system!=1)?false:true"
                      @click.native="generate(scope.row)"
                    >生成模块</el-dropdown-item>
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
      v-show="isUploadModal"
      title="上传模块"
      width="350px"
      height="210px"
      @close="isUploadModal=false"
      @cancel="isUploadModal=false"
      @confirm="upload"
    >
      <div class="mix-win-modal-flex-table" slot="body">
        <el-upload
          class="upload-demo"
          action
          multiple
          :limit="1"
          :http-request="upload"
          :file-list="fileList"
        >
          <el-button size="small" type="primary">点击上传</el-button>
          <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
        </el-upload>
      </div>
    </mix-modal>
  </div>
</template>
<script>
import moduleApi from "../../fetch/module";
export default {
  name: "moduleList",
  data() {
    return {
      message: "Hello world!",
      expands: [],
      currentPageSize: 10,
      isEdit: false,
      isUploadModal: false,
      searchString: "",
      listData: [],
      listTotalRecord: 0,
      currentPage: 1,
      activeItem: 0,
      infoData: null,
      moduleFilePath: "",
      moduleFileList: [],
      rules: {
        name: [
          {
            required: true,
            message: "请输入活动名称",
            trigger: "blur"
          },
          {
            min: 3,
            max: 20,
            message: "长度在 3 到 20 个字符",
            trigger: "blur"
          }
        ],
        version: [
          {
            required: true,
            message: "请输入模块版本号",
            trigger: "blur"
          }
        ]
      },
      inputVisible: false,
      inputValue: "",
      fileList: []
    };
  },
  created() {},
  mounted() {
    console.log("moduleGroupDetail");
    this.getList();
  },
  methods: {
    getList() {
      const loading = this.$loading({
        lock: true,
        text: "Loading"
      });
      let self = this;
      moduleApi.get_list(
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
    openUploadModal() {
      this.isUploadModal = true;
    },
    upload(item) {
      let fd = new FormData();
      fd.append("file", item.file); //传文件
      fd.append("type", "openframe"); //传其他参数
      let self = this;
      moduleApi.upload(data => {
        if (data.code == 200) {
          if (self.isEdit) {
            self.editSheetObj.program = data.result.path;
          } else {
            self.addSheetObj.program = data.result.path;
          }
        }
      }, fd);
    },
    fileRemove() {},
    install(row) {
      this.$confirm("确认安装该模块？", "系统提示", {
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        type: "warning"
      })
        .then(() => {
          let self = this;
          moduleApi.install(
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
              name: row.name,
              is_system: row.is_system,
              version: row.version,
              upgrade_time: row.upgrade_time,
              description: row.description
            }
          );
        })
        .catch(() => {
          this.$message({
            type: "info",
            message: "已取消安装。"
          });
        });
    },
    uninstall(row) {
      this.$confirm("确认卸载该模块？", "系统提示", {
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        type: "warning"
      })
        .then(() => {
          let self = this;
          moduleApi.uninstall(
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
              name: row.name
            }
          );
        })
        .catch(() => {
          this.$message({
            type: "info",
            message: "已取消卸载。"
          });
        });
    },
    enable(row) {
      this.$confirm("确认启用该模块？", "系统提示", {
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        type: "warning"
      })
        .then(() => {
          let self = this;
          moduleApi.enable(
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
              name: row.name
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
      this.$confirm("确认禁用该模块？", "系统提示", {
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        type: "warning"
      })
        .then(() => {
          let self = this;
          moduleApi.disable(
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
              name: row.name
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
    showInput() {
      this.inputVisible = true;
      this.$nextTick(_ => {
        this.$refs.saveTagInput.$refs.input.focus();
      });
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
    detail(row) {console.log('row', row);
      this.$router.push({
        path: "/module/detail/?name=" + row.name,
        params: {
          id: row.id
        }
      });
    },
    getNowFormatDate() {
      var date = new Date();
      var seperator1 = "/";
      var seperator2 = ":";
      var month = date.getMonth() + 1;
      var strDate = date.getDate();
      if (month >= 1 && month <= 9) {
        month = "0" + month;
      }
      if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
      }
      var currentdate =
        date.getFullYear() +
        seperator1 +
        month +
        seperator1 +
        strDate +
        " " +
        date.getHours() +
        seperator2 +
        date.getMinutes() +
        seperator2 +
        date.getSeconds();
      return currentdate;
    },
    generate(row) {
      this.$confirm("确认生成该模块安装包？", "系统提示", {
        confirmButtonText: "确定",
        cancelButtonText: "取消",
        type: "warning"
      })
        .then(() => {
          let self = this;
          moduleApi.generate(
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
              name: row.name
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
        `当前限制选择 3 个文件，本次选择了 ${
          files.length
        } 个文件，共选择了 ${files.length + fileList.length} 个文件`
      );
    },
    beforeRemove(file, fileList) {
      return this.$confirm(`确定移除 ${file.name}？`);
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
  margin-top: -22px;
  margin-left: 87px;
}
</style>

