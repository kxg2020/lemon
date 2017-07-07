<template>
    <p>this is post</p>
</template>
<script type="text/ecmascript-6">
    export default{
        data() {
            return {

            }
        },
        created() {
            this.getPost();
        },
        methods: {
            getPost: function()  {
                let _this = this;
                _this.axios.get('/post').then(function (response) {
                    let res = response.data;
                })
            }
        }
    }
</script>
