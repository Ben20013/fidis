<template>
    <div class="tab-wrap flex-wrap">
        <div class="tab-list flex-wrap flex-center">
            <div class="tab-item flex-column" v-for="(item,index) in tabData" :key="index" @click="changTab(item.id || item.value)">
                <div class="label flex-wrap flex-center" :class="{'active':item.value===tabValue || item.id===tabValue}">
                    <span>{{item.label}}</span>
                </div>
                <div class="selected" :class="{'active':item.value===tabValue || item.id===tabValue}"></div>
            </div>
        </div>
        <div class="tab-tool flex-wrap">
            <slot></slot>
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
.tab-wrap{
    height: 78px;
    background-color: #ffffff;
    padding: 0 20px;
    justify-content: space-between;
    .tab-item{
        height: 100%;
        justify-content: space-between;
        align-items: center;
        margin-right: 40px;
        cursor: default;
        .label{
            flex: 1;
            font-family: MicrosoftYaHei;
            font-size: 18px;
            font-weight: normal;
            font-stretch: normal;
            letter-spacing: 0px;
            color: #777777;
            margin: 0 10px;
            &.active{
                color: #333333;
            }
        }
        .selected{
            width: 100%;
            height: 4px;
	        &.active{
                background-color: #4162ff;
            }
        }
    }
    .tab-tool{
        align-items: center;
    }
}
</style>
