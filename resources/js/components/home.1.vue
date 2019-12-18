<style scoped>
.layout {
    border: 0px solid #d7dde4;
    background: #f5f7f9;
    position: relative;
    border-radius: 0px;
    overflow: hidden;
    height: 100%;
}
.layout-logo {
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
.layout-nav {
    width: 100px;
    margin: 0 auto;
    margin-right: 0px;
}
.layout-footer-center {
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
.demo-tabs-style2 > .ivu-tabs.ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-tab {
    border-radius: 0;
    background: #fff;
}
.demo-tabs-style2
    > .ivu-tabs.ivu-tabs-card
    > .ivu-tabs-bar
    .ivu-tabs-tab-active {
    border-top: 1px solid #3399ff;
}
.demo-tabs-style2
    > .ivu-tabs.ivu-tabs-card
    > .ivu-tabs-bar
    .ivu-tabs-tab-active:before {
    content: "";
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
.ivu-tabs.ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-nav-wrap {
    margin-bottom: 0;
    background: #eee;
}
.ivu-tabs-nav-scroll {
    overflow: hidden;
    white-space: nowrap;
    background: #eee;
}
.ivu-tabs.ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-nav-container {
    height: 32px;
    background: #eee;
}
.ivu-tabs-bar {
    margin-bottom: 0px;
}
.tab-item {
    margin-top: -16px;
    border: 1px solid #dcdee2;
    border-top: 0px;
}
</style>
<template>
    <div class="layout">
        <Layout :style="{height: '100%'}">
            <Header :style="{background: '#fff', boxShadow: '0 2px 3px 2px rgba(0,0,0,.1)'}">
                <Menu mode="horizontal" theme="light" active-name="1">
                    <div class="layout-logo"></div>
                    <!-- <Breadcrumb>
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
                    </Breadcrumb>-->
                    <div class="layout-nav">
                        <Dropdown @on-click="changeMenu" style="float: right;">
                            <a href="javascript:void(0)">
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
            <Layout>
                <Sider hide-trigger :style="{background: '#515a6e'}">
                    <Menu active-name="1-2" theme="dark" width="auto" :open-names="['1']">
                        <Submenu name="1">
                            <template slot="title">
                                <Icon type="ios-navigate"></Icon>Item 1
                            </template>
                            <MenuItem name="1-1">Option 1</MenuItem>
                            <MenuItem name="1-2">Option 2</MenuItem>
                            <MenuItem name="1-3">Option 3</MenuItem>
                        </Submenu>
                        <Submenu name="2">
                            <template slot="title">
                                <Icon type="ios-keypad"></Icon>Item 2
                            </template>
                            <MenuItem name="2-1">Option 1</MenuItem>
                            <MenuItem name="2-2">Option 2</MenuItem>
                        </Submenu>
                        <Submenu name="3">
                            <template slot="title">
                                <Icon type="ios-analytics"></Icon>Item 3
                            </template>
                            <MenuItem name="3-1">Option 1</MenuItem>
                            <MenuItem name="3-2">Option 2</MenuItem>
                        </Submenu>
                        <Submenu name="4">
                            <template slot="title">
                                <Icon type="ios-filing"/>Navigation Two
                            </template>
                            <MenuItem name="4-1">Option 5</MenuItem>
                            <MenuItem name="4-2">Option 6</MenuItem>
                            <Submenu name="5">
                                <template slot="title">Submenu</template>
                                <MenuItem name="5-1">Option 7</MenuItem>
                                <MenuItem name="5-2">Option 8</MenuItem>
                            </Submenu>
                        </Submenu>
                        <MenuItem name="6-1">Option 5</MenuItem>
                    </Menu>
                </Sider>
                <Layout :style="{padding: '0 0'}">
                    <Content :style="{padding: '0px 10px'}" style="background-color: #eeeeee;">
                        <Row :gutter="24">
                            <Col
                                span="12"
                                class="demo-tabs-style1"
                                style="background: #eee;padding:15px;"
                            >
                                <Tabs type="card" :animated="true">
                                    <TabPane label="设备列表" class="tab-item">
                                        <!-- <Row type="flex" justify="space-around" class="code-row-bg">
                                            <Col span="3">
                                                <Card style="background: #eee;">
                                                    <div style="min-height: 150px;">
                                                        Content
                                                    </div>
                                                </Card>
                                            </Col>
                                            <Col span="3">
                                                <Card>
                                                    <div style="min-height: 150px;">
                                                        Content
                                                    </div>
                                                </Card>
                                            </Col>
                                            <Col span="3">
                                                <Card>
                                                    <div style="min-height: 150px;">
                                                        Content
                                                    </div>
                                                </Card>
                                            </Col>
                                            <Col span="3">
                                                <Card>
                                                    <div style="min-height: 150px;">
                                                        Content
                                                    </div>
                                                </Card>
                                            </Col>
                                            <Col span="3">
                                                <Card>
                                                    <div style="min-height: 150px;">
                                                        Content
                                                    </div>
                                                </Card>
                                            </Col>
                                            <Col span="3">
                                                <Card>
                                                    <div style="min-height: 150px;">
                                                        Content
                                                    </div>
                                                </Card>
                                            </Col>
                                        </Row>-->
                                        <Input
                                            v-model="value"
                                            placeholder="Enter something..."
                                            style="width: 300px;margin-bottom: 0px;"
                                        />
                                        <Button type="primary" icon="ios-search">搜索</Button>
                                        <div style="float: right;">
                                            <Button type="primary" icon="ios-add">添加</Button>
                                        </div>
                                        <Table
                                            border
                                            :columns="columns12"
                                            :data="data6"
                                            style="margin: 10px 0"
                                        >
                                            <template slot-scope="{ row }" slot="name">
                                                <strong>{{ row.name }}</strong>
                                            </template>
                                            <template slot-scope="{ row, index }" slot="action">
                                                <Button
                                                    type="primary"
                                                    size="small"
                                                    style="margin-right: 5px"
                                                    @click="show(index)"
                                                >View</Button>
                                                <Button
                                                    type="error"
                                                    size="small"
                                                    @click="remove(index)"
                                                >Delete</Button>
                                            </template>
                                        </Table>
                                        <div style="float: right;">
                                            <Page
                                                :total="100"
                                                show-sizer
                                                show-elevator
                                                show-total
                                                style="float: left;"
                                            />
                                        </div>
                                    </TabPane>
                                    <TabPane label="标签二" class="tab-item">标签二的内容</TabPane>
                                    <TabPane label="标签三" class="tab-item">标签三的内容</TabPane>
                                </Tabs>
                            </Col>
                            <Col span="12" class="demo-tabs-style1">
                                <Tabs type="card">
                                    <TabPane label="标签一">标签一的内容</TabPane>
                                    <TabPane label="标签二">标签二的内容</TabPane>
                                    <TabPane label="标签三">标签三的内容</TabPane>
                                </Tabs>
                            </Col>
                        </Row>
                    </Content>
                </Layout>
            </Layout>
        </Layout>
    </div>
</template>
<script>
export default {
    data() {
        return {
            tab0: true,
            tab1: true,
            tab2: true,
            columns12: [
                {
                    title: "Name",
                    slot: "name"
                },
                {
                    title: "Age",
                    key: "age"
                },
                {
                    title: "Address",
                    key: "address"
                },
                {
                    title: "Action",
                    slot: "action",
                    width: 150,
                    align: "center"
                }
            ],
            data6: [
                {
                    name: "John Brown",
                    age: 18,
                    address: "New York No. 1 Lake Park"
                },
                {
                    name: "Jim Green",
                    age: 24,
                    address: "London No. 1 Lake Park"
                },
                {
                    name: "Joe Black",
                    age: 30,
                    address: "Sydney No. 1 Lake Park"
                },
                {
                    name: "Jon Snow",
                    age: 26,
                    address: "Ottawa No. 2 Lake Park"
                },
                {
                    name: "John Brown",
                    age: 18,
                    address: "New York No. 1 Lake Park"
                },
                {
                    name: "Jim Green",
                    age: 24,
                    address: "London No. 1 Lake Park"
                },
                {
                    name: "Joe Black",
                    age: 30,
                    address: "Sydney No. 1 Lake Park"
                },
                {
                    name: "Jon Snowsssss",
                    age: 26,
                    address: "Ottawa No. 2 Lake Park"
                }
            ]
        };
    },
    methods: {
        handleTabRemove(name) {
            this["tab" + name] = false;
        },
        show(index) {
            this.$Modal.info({
                title: "User Info",
                content: `Name：${this.data6[index].name}<br>Age：${
                    this.data6[index].age
                }<br>Address：${this.data6[index].address}`
            });
        },
        remove(index) {
            this.data6.splice(index, 1);
        },
        changeMenu() {}
    }
};
</script>
