<style scoped>
.layout {
    border: 1px solid #d7dde4;
    background: #f5f7f9;
    position: relative;
    border-radius: 4px;
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
    left: 20px;
}
.layout-nav {
    width: 420px;
    margin: 0 auto;
    margin-right: 20px;
}
</style>
<template>
    <div class="layout">
        <Layout>
            <!-- <Header>
                <Menu mode="horizontal" theme="dark" active-name="1">
                    <div class="layout-logo"></div>
                    <div class="layout-nav">
                        <MenuItem name="1">
                            <Icon type="ios-navigate"></Icon>Item 1
                        </MenuItem>
                        <MenuItem name="2">
                            <Icon type="ios-keypad"></Icon>Item 2
                        </MenuItem>
                        <MenuItem name="3">
                            <Icon type="ios-analytics"></Icon>Item 3
                        </MenuItem>
                        <MenuItem name="4">
                            <Icon type="ios-paper"></Icon>Item 4
                        </MenuItem>
                    </div>
                </Menu>
            </Header>-->
            <Layout>
                <Sider hide-trigger :style="{background: '#fff',height: '100%'}">
                    <Menu active-name="1-2" theme="light" width="auto" :open-names="['1']">
                        <MenuItem name="apip">APIP</MenuItem>
                        <MenuItem name="apiq">APIQ</MenuItem>
                        <MenuItem name="apis">APIS</MenuItem>
                        <MenuItem name="apix">APIX</MenuItem>
                        <MenuItem name="apipassport">APIPASSPORT</MenuItem>
                    </Menu>
                </Sider>
                <Layout :style="{padding: '0 24px 24px'}">
                    <Breadcrumb :style="{margin: '24px 0'}">
                        <BreadcrumbItem>Home</BreadcrumbItem>
                        <BreadcrumbItem>Components</BreadcrumbItem>
                        <BreadcrumbItem>Layout</BreadcrumbItem>
                    </Breadcrumb>
                    <Content :style="{padding: '24px', minHeight: '280px', background: '#fff'}">
                        <Table :columns="columns11" :data="data10" border height="500"></Table>
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
            columns11: [
                {
                    title: "Name",
                    key: "name",
                    align: "center",
                    width: 200,
                    fixed: "left",
                    filters: [
                        {
                            label: "Joe",
                            value: 1
                        },
                        {
                            label: "John",
                            value: 2
                        }
                    ],
                    filterMultiple: false,
                    filterMethod(value, row) {
                        if (value === 1) {
                            return row.name === "Joe";
                        } else if (value === 2) {
                            return row.name === "John Brown";
                        }
                    }
                },
                {
                    title: "Other",
                    align: "center",
                    children: [
                        {
                            title: "Age",
                            key: "age",
                            align: "center",
                            width: 200,
                            sortable: true
                        },
                        {
                            title: "Address",
                            align: "center",
                            children: [
                                {
                                    title: "Street",
                                    key: "street",
                                    align: "center",
                                    width: 200
                                },
                                {
                                    title: "Block",
                                    align: "center",
                                    children: [
                                        {
                                            title: "Building",
                                            key: "building",
                                            align: "center",
                                            width: 200,
                                            sortable: true
                                        },
                                        {
                                            title: "Door No.",
                                            key: "door",
                                            align: "center",
                                            width: 200
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                },
                {
                    title: "Company",
                    align: "center",
                    children: [
                        {
                            title: "Company Address",
                            key: "caddress",
                            align: "center",
                            width: 200
                        },
                        {
                            title: "Company Name",
                            key: "cname",
                            align: "center",
                            width: 200
                        }
                    ]
                },
                {
                    title: "Gender",
                    key: "gender",
                    align: "center",
                    width: 200,
                    fixed: "right"
                }
            ],
            data10: []
        };
    },
    mounted() {
        const data = [];
        for (let i = 0; i < 20; i++) {
            data.push({
                key: i,
                name: "John Brown",
                age: i + 1,
                street: "Lake Park",
                building: "C",
                door: 2035,
                caddress: "Lake Street 42",
                cname: "SoftLake Co",
                gender: "M"
            });
        }
        this.data10 = data;
    }
};
</script>