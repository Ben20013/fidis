<template>
    <div class="main flex-wrap">
        <leftMenu></leftMenu>
        <div class="right-box flex-column flex-con-1">
            <topHeader></topHeader>
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
import leftMenu from "../components/left-menu";
import topHeader from "../components/top-header";

export default {
    name: "index",
    components: {
        //注册组件
        leftMenu: leftMenu,
        topHeader: topHeader
    },
    mounted() {
        console.log("index");
    }
};
</script>
<style rel="stylesheet/scss" lang="scss" scoped>
.main {
    width: 100%;
    height: 100%;
    padding: 0;
    margin: 0;
    overflow: hidden;
    .right-box {
        background-color: #ecedef;
        .container {
            flex: 1;
            padding: 16px;
            overflow: hidden;
        }
    }
}
</style>
