<style scoped>
.layout{
    border: 0px solid #d7dde4;
    background: #f5f7f9;
    position: relative;
    border-radius: 0px;
    overflow: hidden;
    height: 100%;
}
.layout-logo{
    width: 210px;
    height: 60px;
    /* background: #5b6270; */
    background: url(http://dev.fidis.com/images/logo.png) no-repeat;
    border-radius: 3px;
    float: left;
    position: relative;
    top: 7px;
    left: 0px;
}
.layout-nav{
    width: 100px;
    margin: 0 auto;
    margin-right: 0px;
}
.layout-footer-center{
    text-align: center;
}
.demo-tabs-style1 > .ivu-tabs-card > .ivu-tabs-content {
    height: 120px;
    margin-top: -16px;
}

.demo-tabs-style1 > .ivu-tabs-card > .ivu-tabs-content > .ivu-tabs-tabpane {
    background: #fff;
    padding: 16px;
}

.demo-tabs-style1 > .ivu-tabs.ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-tab {
    border-color: transparent;
}

.demo-tabs-style1 > .ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-tab-active {
    border-color: #fff;
}
.demo-tabs-style2 > .ivu-tabs.ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-tab{
    border-radius: 0;
    background: #fff;
}
.demo-tabs-style2 > .ivu-tabs.ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-tab-active{
    border-top: 1px solid #3399ff;
}
.demo-tabs-style2 > .ivu-tabs.ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-tab-active:before{
    content: '';
    display: block;
    width: 100%;
    height: 1px;
    background: #3399ff;
    position: absolute;
    top: 0;
    left: 0;
}
.ivu-layout-header {
    padding: 0px 10px;
    height: 60px;
    line-height: 60px;
}
.ivu-menu-horizontal.ivu-menu-light:after {
    height: 0px;
}
.ivu-tabs.ivu-tabs-card>.ivu-tabs-bar .ivu-tabs-nav-wrap {
    margin-bottom: 0;
    background: #eee;
}
.ivu-tabs-nav-scroll {
    overflow: hidden;
    white-space: nowrap;
    background: #eee;
}
.ivu-tabs.ivu-tabs-card>.ivu-tabs-bar .ivu-tabs-nav-container {
    height: 32px;
    background: #eee;
}
.ivu-tabs-bar {
    margin-bottom: 0px;
}
</style>
<template>
    <div class="layout">
        <Layout style="height: 100%;">
            <Sider ref="side1" hide-trigger collapsible :collapsed-width="78" v-model="isCollapsed">
                <div class="layout-logo"></div>
                <Menu active-name="1-2" theme="dark" width="auto" :open-names="['1']">
                    <Submenu name="1">
                        <template slot="title">
                            <Icon type="ios-navigate"></Icon>
                            Item 1
                        </template>
                        <MenuItem name="1-1">Option 1</MenuItem>
                        <MenuItem name="1-2">Option 2</MenuItem>
                        <MenuItem name="1-3">Option 3</MenuItem>
                    </Submenu>
                    <Submenu name="2">
                        <template slot="title">
                            <Icon type="ios-keypad"></Icon>
                            Item 2
                        </template>
                        <MenuItem name="2-1">Option 1</MenuItem>
                        <MenuItem name="2-2">Option 2</MenuItem>
                    </Submenu>
                    <Submenu name="3">
                        <template slot="title">
                            <Icon type="ios-analytics"></Icon>
                            Item 3
                        </template>
                        <MenuItem name="3-1">Option 1</MenuItem>
                        <MenuItem name="3-2">Option 2</MenuItem>
                    </Submenu>
                </Menu>
            </Sider>
            <Layout :style="{height: '100%'}">
                <Header class="layout-header-bar" :style="{background: '#fff', boxShadow: '0 2px 3px 2px rgba(0,0,0,.1)'}">
                    <Menu mode="horizontal" theme="light" active-name="1">
                        <!-- <div class="layout-logo"></div> -->
                        <Breadcrumb>
                        <BreadcrumbItem to="/">首页</BreadcrumbItem>
                        <BreadcrumbItem to="/components/breadcrumb"><Dropdown  @on-click="changeMenu">
                                <a href="javascript:void(0)">
                                    admin
                                    <Icon type="ios-arrow-down"></Icon>
                                </a>
                                <DropdownMenu slot="list">
                                    <DropdownItem>修改密码</DropdownItem>
                                    <DropdownItem divided style="color: red;" name="logout">退出</DropdownItem>
                                </DropdownMenu>
                            </Dropdown></BreadcrumbItem>
                        <BreadcrumbItem>设备管理</BreadcrumbItem>
                    </Breadcrumb>
                        <div class="layout-nav">
                            <Dropdown  @on-click="changeMenu" style="float: right;">
                                <a href="javascript:void(0)" >
                                    admin
                                    <Icon type="ios-arrow-down"></Icon>
                                </a>
                                <DropdownMenu slot="list">
                                    <DropdownItem>修改密码</DropdownItem>
                                    <DropdownItem divided style="color: red;" name="logout">退出</DropdownItem>
                                </DropdownMenu>
                            </Dropdown>
                        </div>
                    </Menu>
                </Header>
                <Content :style="{padding: '10px 10px'}" style="background-color: #eeeeee;">
                    <Row :gutter="24">
                        <Col span="24" class="demo-tabs-style1" style="background: #eee;padding:15px;">
                            <Tabs type="card">
                                <TabPane label="标签一">标签一的内容</TabPane>
                                <TabPane label="标签二">标签二的内容</TabPane>
                                <TabPane label="标签三">标签三的内容</TabPane>
                            </Tabs>
                        </Col>
                    </Row>
                </Content>
                </layout>
        </layout>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                isCollapsed: false
            }
        },
        computed: {
            rotateIcon () {
                return [
                    'menu-icon',
                    this.isCollapsed ? 'rotate-icon' : ''
                ];
            },
            menuitemClasses () {
                return [
                    'menu-item',
                    this.isCollapsed ? 'collapsed-menu' : ''
                ]
            }
        },
        methods: {
            collapsedSider () {
                this.$refs.side1.toggleCollapse();
            }
        }
    }
</script>
