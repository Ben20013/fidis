<template>
    <div class="search-wrap flex-wrap">
        <div class="search-option">
            <el-select v-model="defSearch" placeholder="请选择" class="mix-select mix-select-32">
                <el-option
                    v-for="item in searchOption"
                    :key="item.value"
                    :label="item.label"
                    :value="item.value">
                </el-option>
            </el-select>
        </div>
        <div class="search-content flex-wrap" :class="{'active':isFocus}">
            <div class="left">
                <el-select v-model="defCondition" placeholder="请选择" class="mix-select mix-no-border-32" @focus="isFocus=true" @blur="isFocus=false">
                    <el-option
                        v-for="item in conditionOption"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                    </el-option>
                </el-select>
            </div>
            <div class="split"></div>
            <div class="right" @keyup.enter="search">
                <input type="text"
                    class="search"
                    placeholder="请输入搜索内容"
                    @focus="focusInput"
                    @blur="isFocus=false"
                    v-model="defSearchString"
                >
            </div>
            <div class="search-icon-wrap" @click="search"><i class="mix-search-icon" :class="{'mix-search-press-icon':isFocus}"></i></div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        searchString: String,
        conditionValue: String,
        conditionOption: {
            type: Array,
            default: function(){
                return []
            }
        },
        searchValue: String,
        searchOption: {
            type: Array,
            default: function(){
                return []
            }
        },
    },
    data(){
        return {
            isFocus: false,
            defSearch: this.searchValue,
            defCondition: this.conditionValue,
            defSearchString: this.searchString
        }
    },
    methods: {
        search(){
            this.$emit('search',this.defSearch,this.defCondition,this.defSearchString);
        },
        focusInput(){
            let self = this;
            setTimeout(function(){
                self.isFocus = true;
            },100)
        }
    }
}
</script>
<style rel="stylesheet/scss" lang="scss" scoped>
@import '../../sass/icon.scss';
.search-option{
    width: 200px;
}
.search-content{
    margin-left: 10px;
    width: 338px;
    height: 30px;
    border: 1px solid #dddddd;
    border-radius: 2px;
    align-items: center;
    &:hover{
        border-color: #999999;
    }
    &.active{
        border-color: #4162ff;
    }
    .left{
        width: 137px;
    }
    .split{
        width: 1px;
        height: 22px;
        background-color: #e1e5ee;
    }
    .right{
        flex: 1;
        input.search{
            height: 30px;
            border: none;
            outline: none;
            padding: 0 15px;
            font-family: MicrosoftYaHei;
            font-size: 13px;
            font-weight: normal;
            font-stretch: normal;
            letter-spacing: 0.5px;
            color: #333333;
            &::placeholder{
                font-family: MicrosoftYaHei;
                font-size: 13px;
                font-weight: normal;
                font-stretch: normal;
                line-height: 28px;
                letter-spacing: 0.5px;
                color: #999999;
            }
        }
    }
    .search-icon-wrap{
        margin-right: 10px;
        cursor: pointer;
    }
}
</style>
