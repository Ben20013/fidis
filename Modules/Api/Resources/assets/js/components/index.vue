<style scoped>
.layout {
    border: none;
    background: #f5f7f9;
    position: relative;
    border-radius: 0px;
    overflow: hidden;
}
.layout-logo {
    width: 100px;
    height: 30px;
    background: #5b6270;
    border-radius: 3px;
    float: left;
    position: relative;
    top: 15px;
    left: 150px;
}
.layout-logo-footer {
    width: 100px;
    height: 30px;
    background: #5b6270;
    border-radius: 3px;
    float: left;
    position: relative;
    top: 0px;
    left: 0px;
}
.layout-nav {
    width: 425px;
    margin: 0 auto;
    margin-right: 150px;
}
.layout-footer-center {
    text-align: center;
    background-color: #343434;
}
.demo-carousel {
    height: 600px;
    line-height: 600px;
    text-align: center;
    color: #fff;
    font-size: 20px;
    border: none;
    background: #506b9e;
}
.ivu-layout-header {
    background: #343434;
    padding: 0 50px;
    height: 64px;
    line-height: 64px;
}
.ivu-menu-dark {
    background: #343434;
}
.menu-item-text {
    font-size: 16px;
}
.ivu-card {
    background: #fff;
    border-radius: 0px;
    font-size: 14px;
    position: relative;
    -webkit-transition: all 0.2s ease-in-out;
    transition: all 0.2s ease-in-out;
}
.ivu-layout-footer {
    background: #343434;
    padding: 10px 50px;
    color: #515a6e;
    font-size: 14px;
}
</style>
<template>
    <div class="layout">
        <Layout>
            <router-view></router-view>
        </Layout>
    </div>
</template>
<script>
export default {
    data() {
        return {};
    },
    methods: {}
};
</script>