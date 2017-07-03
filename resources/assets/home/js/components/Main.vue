<template>
    <p>this is Main</p>
</template>
<script type="text/ecmascript-6">
    export default{
        data() {
            return {

            }
        },
        created() {

        },
        methods() {
            getMeta: function () {
                let _this = this;
                _this.axios.get('/meta').then(function (response) {
                    let res = response.data;
                })
            }
        }
    }
</script>