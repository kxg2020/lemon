<template>

</template>
<style>
    body{
        margin: 0;
        padding: 0;
        height: 100%;
    }
    #app{
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
    }
    .nav{
        position: fixed;
        z-index: 999;
    }
    .menu{
        position: fixed;
        top: 60px;
        z-index: 99;
        bottom: 0;
        background: #324157;
    }
    .content{
        position: absolute;
        top: 60px;
        left: 16.66666%;
        z-index: 9;
        padding: 10px;
    }

</style>
<script type="text/ecmascript-6">
    export default {
        data() {
            return {
                activeIndex: '1',
                activeIndex2: '1'
            };
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            },
            handleOpen() {

            },
            handleClose() {

            }
        }
    }
</script>