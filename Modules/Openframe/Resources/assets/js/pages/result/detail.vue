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
                                <td>{{$t('projectLang.name')}}</td>
                                <td>{{projectData.name}}</td>
                                <td>{{$t('projectLang.is_system')}}</td>
                                <td>{{projectData.is_system}}</td>
                                <td>{{$t('projectLang.status')}}</td>
                                <td>{{projectData.status}}</td>
                            </tr>
                            <tr>
                                <td>{{$t('projectLang.version')}}</td>
                                <td>{{projectData.version}}</td>
                                <td>{{$t('projectLang.upgrade_time')}}</td>
                                <td colspan="3">{{projectData.upgrade_time}}</td>
                            </tr>
                            <tr>
                                <td>{{$t('projectLang.description')}}</td>
                                <td colspan="5">{{projectData.description}}</td>
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
                        <el-tab-pane label="所属菜单" name="menu">所属菜单</el-tab-pane>
                        <el-tab-pane label="外部接口" name="interface">外部接口</el-tab-pane>
                        <el-tab-pane label="任务进程" name="process">任务进程</el-tab-pane>
                        <el-tab-pane label="命题配置" name="topic">命题配置</el-tab-pane>
                    </el-tabs>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import projectApi from "../../fetch/project";
export default {
    name: "projectGroupDetail",
    data() {
        return {
            projectName: "",
            projectData: {},
            activeName: "menu"
        };
    },
    created() {},
    mounted() {
        this.projectName = this.getQueryVariable("name");
        this.getDetail();
    },
    methods: {
        getDetail() {
            const loading = this.$loading({
                lock: true,
                text: "Loading"
            });
            let self = this;
            projectApi.detail(
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

                        this.projectData = data;
                    }

                    setTimeout(() => {
                        loading.close();
                        // this.getLists();
                    }, 1000);
                },
                {
                    name: this.projectName
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
        getMenu() {},
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

