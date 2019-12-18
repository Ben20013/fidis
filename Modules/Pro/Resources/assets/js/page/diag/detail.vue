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
        <iframe v-if="currentSheetInfo.result_id" id="reportDetailIframe"
            :src="'/modules/pro/page/healthResult/resultDetail.html?id='+currentId" :data-title="currentSheetInfo.result_id"
            :data-reference="JSON.stringify(currentSheetInfo)" frameborder="0" width="100%" height="100%"></iframe>
    </div>
</template>
<script>
    import diagResultApi from '@/assets/js/fetch/diag/result';
    const path = require('path')
    export default {
        name: 'equipmentTypeList',
        data() {
            return {
                currentId: '',
                fullscreenLoading: false,
                searchObj: {
                    name: "",
                    page_size: 20,
                    page_index: 1,
                    total_records: 0
                },
                currentSheetInfo: {},
                // currentSheetInfo: {
                //     "result_id":2,
                //     "result_name":"",
                //     "description":"",
                //     "task_id":1002,
                //     "equipment_id":1001,
                //     "equipment_name":"设备1001",
                //     "score":"88",
                //     "all":3,
                //     "pass":2,
                //     "fail":1,
                //     "fail_list":'[{"name":"温度过高","result":"未通过"}]',
                //     "all_list":'[{"name":"温度过高","date":"","staff":"","result":"未通过"},{"name":"气压过低","date":"2019-04-25 10:00:00","staff":"admin","result":"通过"},{"name":"更换机油","date":"","staff":"","result":"通过"}]',
                //     "reference":"",
                //     "created":"2019-04-28 16:18:06",
                //     "is_available":1
                // },
                failTableData: [],
                allTableData: [],
            }
        },

        created() {
            // console.log(path.parse(window.location.pathname));
            console.log(this.$route);
            this.currentId = this.$route.query.id ;
            console.log(this.currentId);
            console.log(window.location.origin + '/modules/pro/page/healthResult/resultDetail.html?id=' + this.currentId)
        },

        mounted() {
            this.getInfoById(this.currentId);
        },

        methods: {
            getInfoById(id) {
                let self = this;
                diagResultApi.getInfoById((res) => {
                    if (res.code == 200) {
                        self.currentSheetInfo = res.result;
                        res.result.fail_list = res.result.fail_list.replace(/\n/g,'\\n').replace(/\r/g,'\\r');
                        res.result.all_list = res.result.all_list.replace(/\n/g,'\\n').replace(/\r/g,'\\r');
                        self.failTableData = res.result.fail_list ? JSON.parse(res.result.fail_list) : [];
                        self.allTableData = res.result.all_list ? JSON.parse(res.result.all_list) : [];
                    }
                }, {
                    result_id: id
                });
            },

            toExportResult() {
                console.log('导出');
                window.print();
            },
        },

        components: {}
    }
</script>
<style rel="stylesheet/scss" lang="scss" scoped>
.content-wrap {
    height: 100%;
    padding: 16px;
    box-sizing: border-box;
}

</style>
