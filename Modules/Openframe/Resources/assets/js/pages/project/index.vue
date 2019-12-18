<template>
    <div class="container" style="height: 100%;">
        <router-view></router-view>
    </div>
</template>
<script>
export default {
    name: "equipmentGroupIndex",
    data() {
        return {
            message: "Hello world!"
        };
    },
    created() {},
    mounted() {
        console.log("equipmentGroupIndex");
    },
    methods: {}
};
</script>
<style lang="sass" scoped>

</style>
