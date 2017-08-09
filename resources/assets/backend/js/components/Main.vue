<template>
    <el-row>
        <el-card class="box-card" v-loading="listLoading">
            <div class="text item">
                <span>文章数量：</span><span class="coral">{{post_count}}</span>
            </div>
            <div class="text item">
                <span>浏览量：</span><span class="coral">{{page_view}}</span>
            </div>
        </el-card>
    </el-row>
</template>
<style>
    .coral{
        color: coral;
    }
    .text {
        font-size: 14px;
    }

    .item {
        padding: 18px 0;
    }
</style>
<script type="text/ecmascript-6">
    export default{
        data(){
            return {
                listLoading: true,
                post_conunt: 0,
                page_view: 0,
            }
        },
        mounted() {
            this.getDatas()
        },
        methods: {
            getDatas() {
                let _this = this
                _this.axios.get('/main').then(function (response) {
                    let res = response.data
                    if(res.status == 'success'){
                        _this.post_count = res.data.post_count
                        _this.page_view = res.data.page_view
                        _this.listLoading = false
                    }else {
                        _this.$message({
                            message: "获取数据失败",
                            type: 'error'
                        })
                    }
                })
            }
        }
    }
</script>