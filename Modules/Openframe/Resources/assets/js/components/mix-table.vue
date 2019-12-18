<template>
    <div class="table-wrap flex-column">
        <div class="list-header">
            <table>
                <thead>
                    <tr>
                        <th>事件编号</th>
                        <th>事件名称</th>
                        <th>事件类型</th>
                        <th>设备ID</th>
                        <th>适配器编号</th>
                        <th>统一编码</th>
                        <th>产生时间</th>
                        <th>描述</th>
                        <th v-if="scrollWidth" :style="{'width':scrollWidth+'px','padding':0}"></th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="list-body">
            <table>
                <tbody>
                    <tr v-for="(item,index) in listData" @click="enterDetailPage(item)">
                        <td>{{item.id}}</td>
                        <td>{{item.name}}</td>
                        <td>{{item.type_name}}</td>
                        <td>{{item.equipment_id}}</td>
                        <td>{{item.aprus_id}}</td>
                        <td>{{item.code}}</td>
                        <td>{{item.created}}</td>
                        <td>{{item.description}}</td>
                    </tr>
                    <tr v-if="listData==null||listData.length==0">
                        <td colspan="8"><div class="nodata">暂无数据</div></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    model: {
        prop: 'tabValue',
        event: 'tabchange'
    },
    props: {
        tabValue: String,
        tabData: {
            type: Array,
            default: function(){
                return []
            }
        },
    },
    methods: {
        changTab(value){
            this.$emit('tabchange', value)
        }
    }
}
</script>
<style rel="stylesheet/scss" lang="scss" scoped>

</style>
