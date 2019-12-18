<template>
    <div class="pagination-container">
        <el-pagination
            background
            layout="total, sizes, prev, pager, next, jumper"
            @current-change="handlePageChange"
            @size-change="handleSizeChange"
            :page-size="pageSize"
            :page-sizes="pageSizes"
            :total="total">
        </el-pagination>
    </div>
</template>

<script>
export default {
    data: function() {
        return {
            currentPage: 1,
            pageSizes: [10,20,50,100,200],
        }
    },
    methods: {

        // 当前页更改
        handlePageChange(current) {
            console.log("page-change", current);
            this.$emit("pageChange", current);
        },

        //每页多少条数据更改
        handleSizeChange(size) {
            console.log("pagesize-change",size);
            this.$emit("sizeChange", size);
        },
    },
    props: ['pageIndex', 'total','pageSize'],
}
</script>


<style lang="scss" scoped>
    .pagination-container {
        text-align: center;
    }
</style>




