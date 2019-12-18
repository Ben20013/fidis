<style>
.demo-tabs-style1 {
    height: 100%;
    background: #eeeeee;
    padding: 0px;
}
.demo-tabs-style1 > .ivu-tabs-card {
    height: 100%;
}
.demo-tabs-style1 > .ivu-tabs-card > .ivu-tabs-bar {
    border-bottom: 0px;
    margin-bottom: 1px;
}
.demo-tabs-style1 > .ivu-tabs-card > .ivu-tabs-content {
    height: 100%;
}

.demo-tabs-style1 > .ivu-tabs-card > .ivu-tabs-content > .ivu-tabs-tabpane {
    background: #fff;
    padding: 10px 10px;
}

.demo-tabs-style1 > .ivu-tabs.ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-tab {
    border-color: transparent;
}

.demo-tabs-style1 > .ivu-tabs-card > .ivu-tabs-bar .ivu-tabs-tab-active {
    border-color: #fff;
}
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
    top: 5px;
    left: 5px;
}
.layout-nav {
    width: 100px;
    margin: 0 auto;
    margin-right: 0px;
    height: 60px;
}
.ivu-layout-header {
    padding: 0px 10px;
    height: 60px;
    line-height: 60px;
}
.ivu-menu-horizontal.ivu-menu-light:after {
    height: 0px;
}
</style>
<template>
    <div class="layout">
        <Layout :style="{height: '100%'}">
            <Sider hide-trigger :style="{background: '#515a6e'}">
                <Row style="background-color: #ffffff;">
                    <div class="layout-logo"></div>
                </Row>
                <Row>
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
                </Row>
            </Sider>
            <Layout>
                <Header
                    :style="{position: 'fixed',background: '#fff', boxShadow: '0 0px 0px 0px rgba(0,0,0,.1)', }"
                >
                    <Menu mode="horizontal" theme="light" active-name="1">
                        <div class="layout-nav">
                            <Dropdown @on-click="changeMenu" style="float: right;z-index: 99">
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

                <Layout :style="{padding: '0 0', 'margin-top': '60px'}">
                    <Content :style="{padding: '10px 10px'}" style="background-color: #eeeeee;">
                        <Row style="height: 100%;">
                            <Col span="24" class="demo-tabs-style1">
                                <Tabs type="card">
                                    <TabPane label="标签一">
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
                                            :data="tableData1"
                                            :columns="tableColumns1"
                                            border
                                            stripe
                                            style="margin-top: 10px;"
                                        ></Table>
                                        <div style="margin: 10px;overflow: hidden">
                                            <div style="float: right;">
                                                <Page
                                                    :total="100"
                                                    :current="1"
                                                    @on-change="changePage"
                                                ></Page>
                                            </div>
                                        </div>
                                    </TabPane>
                                    <TabPane label="标签二">
                                        <Table border :columns="columns7" :data="data6"></Table>
                                    </TabPane>
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
            tableData1: this.mockTableData1(),
            tableColumns1: [
                {
                    title: "Name",
                    key: "name"
                },
                {
                    title: "Status",
                    key: "status",
                    render: (h, params) => {
                        const row = params.row;
                        const color =
                            row.status === 1
                                ? "primary"
                                : row.status === 2
                                ? "success"
                                : "error";
                        const text =
                            row.status === 1
                                ? "Working"
                                : row.status === 2
                                ? "Success"
                                : "Fail";

                        return h(
                            "Tag",
                            {
                                props: {
                                    type: "dot",
                                    color: color
                                }
                            },
                            text
                        );
                    }
                },
                {
                    title: "Portrayal",
                    key: "portrayal",
                    render: (h, params) => {
                        return h(
                            "Poptip",
                            {
                                props: {
                                    trigger: "hover",
                                    title:
                                        params.row.portrayal.length +
                                        "portrayals",
                                    placement: "bottom"
                                }
                            },
                            [
                                h("Tag", params.row.portrayal.length),
                                h(
                                    "div",
                                    {
                                        slot: "content"
                                    },
                                    [
                                        h(
                                            "ul",
                                            this.tableData1[
                                                params.index
                                            ].portrayal.map(item => {
                                                return h(
                                                    "li",
                                                    {
                                                        style: {
                                                            textAlign: "center",
                                                            padding: "4px"
                                                        }
                                                    },
                                                    item
                                                );
                                            })
                                        )
                                    ]
                                )
                            ]
                        );
                    }
                },
                {
                    title: "People",
                    key: "people",
                    render: (h, params) => {
                        return h(
                            "Poptip",
                            {
                                props: {
                                    trigger: "hover",
                                    title:
                                        params.row.people.length + "customers",
                                    placement: "bottom"
                                }
                            },
                            [
                                h("Tag", params.row.people.length),
                                h(
                                    "div",
                                    {
                                        slot: "content"
                                    },
                                    [
                                        h(
                                            "ul",
                                            this.tableData1[
                                                params.index
                                            ].people.map(item => {
                                                return h(
                                                    "li",
                                                    {
                                                        style: {
                                                            textAlign: "center",
                                                            padding: "4px"
                                                        }
                                                    },
                                                    item.n +
                                                        "：" +
                                                        item.c +
                                                        "People"
                                                );
                                            })
                                        )
                                    ]
                                )
                            ]
                        );
                    }
                },
                {
                    title: "Sampling Time",
                    key: "time",
                    render: (h, params) => {
                        return h("div", "Almost" + params.row.time + "days");
                    }
                },
                {
                    title: "Updated Time",
                    key: "update",
                    render: (h, params) => {
                        return h(
                            "div",
                            this.formatDate(
                                this.tableData1[params.index].update
                            )
                        );
                    }
                },
                {
                    title: "Action",
                    key: "action",
                    width: 150,
                    align: "center",
                    render: (h, params) => {
                        return h("div", [
                            h(
                                "Button",
                                {
                                    props: {
                                        type: "primary",
                                        size: "small"
                                    },
                                    style: {
                                        marginRight: "5px"
                                    },
                                    on: {
                                        click: () => {
                                            this.show(params.index);
                                        }
                                    }
                                },
                                "View"
                            ),
                            h(
                                "Button",
                                {
                                    props: {
                                        type: "error",
                                        size: "small"
                                    },
                                    on: {
                                        click: () => {
                                            this.remove(params.index);
                                        }
                                    }
                                },
                                "Delete"
                            )
                        ]);
                    }
                }
            ],
            columns7: [
                {
                    title: "类别",
                    key: "name",
                    render: (h, params) => {
                        return h("div", [
                            h("Icon", {
                                props: {
                                    type: "person"
                                }
                            }),
                            h("strong", params.row.name)
                        ]);
                    },
                    width: 150
                },
                {
                    title: "type-a",
                    key: "age"
                },
                {
                    title: "type-b",
                    key: "address"
                },
                {
                    title: "type-c",
                    key: "action",
                    align: "center"
                }
            ],
            data6: [
                {
                    name: "姓名",
                    age: 18,
                    address: "New York No. 1 Lake Park"
                },
                {
                    name: "性别",
                    age: 24,
                    address: "London No. 1 Lake Park"
                },
                {
                    name: "年龄",
                    age: 30,
                    address: "Sydney No. 1 Lake Park"
                },
                {
                    name: "出生日期",
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
        changeMenu() {},
        mockTableData1() {
            let data = [];
            for (let i = 0; i < 10; i++) {
                data.push({
                    name: "Business" + Math.floor(Math.random() * 100 + 1),
                    status: Math.floor(Math.random() * 3 + 1),
                    portrayal: [
                        "City",
                        "People",
                        "Cost",
                        "Life",
                        "Entertainment"
                    ],
                    people: [
                        {
                            n: "People" + Math.floor(Math.random() * 100 + 1),
                            c: Math.floor(Math.random() * 1000000 + 100000)
                        },
                        {
                            n: "People" + Math.floor(Math.random() * 100 + 1),
                            c: Math.floor(Math.random() * 1000000 + 100000)
                        },
                        {
                            n: "People" + Math.floor(Math.random() * 100 + 1),
                            c: Math.floor(Math.random() * 1000000 + 100000)
                        }
                    ],
                    time: Math.floor(Math.random() * 7 + 1),
                    update: new Date()
                });
            }
            return data;
        },
        formatDate(date) {
            const y = date.getFullYear();
            let m = date.getMonth() + 1;
            m = m < 10 ? "0" + m : m;
            let d = date.getDate();
            d = d < 10 ? "0" + d : d;
            return y + "-" + m + "-" + d;
        },
        changePage() {
            // The simulated data is changed directly here, and the actual usage scenario should fetch the data from the server
            this.tableData1 = this.mockTableData1();
        }
    }
};
</script>
