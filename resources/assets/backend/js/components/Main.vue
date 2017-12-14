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
        <el-card class="box-card" v-loading="pubgLoading">
            <el-row style="margin: 0 auto; max-width: 1024px;">
                <el-carousel indicator-position="outside" :height="pubgHeight" id="pubg">
                    <el-carousel-item v-for="(item, index) in pubgImages" :key="index">
                        <img class="pubg-img" :src="imgPrefix + item.file_name" alt="">
                    </el-carousel-item>
                </el-carousel>
            </el-row>
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
    .pubg-img {
        width: 100%;
        height: auto;
    }
    .box-card {
        margin-bottom: 20px;
    }
</style>
<script type="text/ecmascript-6">
    export default{
        data(){
            return {
                listLoading: true,
                pubgLoading: true,
                post_count: 0,
                page_view: 0,
                pubgImages: [],
                imgPrefix: 'https://img.it9g.com/',
                pubgHeight: '576px',
            }
        },
        created: function () {
            let _this = this
            window.onresize = function () {
                _this.widthChange()
            }
        },
        mounted() {
            this.getDatas()
            this.getPubgImages()
            this.widthChange()
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
            },
            getPubgImages() {
                let _this = this
                _this.axios.get('/files', {params: {dir: 'pubg', 'page_size': 20, 'page': 1}})
                  .then(function (response) {
                      let res = response.data
                      if(res.status == 'success') {
                          _this.pubgImages = res.data.data
                          _this.pubgLoading = false
                      }else {
                          _this.$message({
                              message: "获取数据失败",
                              type: 'error'
                          })
                      }
                  })
            },
            widthChange() {
                let pubgDom = document.getElementById("pubg")
                try {
                    if (pubgDom.clientWidth) {
                        let pubgWidth = pubgDom.clientWidth
                        pubgWidth = pubgWidth > 1024 ? 1024 : pubgWidth
                        this.pubgHeight = (pubgWidth * 9 / 16) + "px"
                    }
                } catch (e) {

                }
                this.$emit('newWidthChang', document.documentElement.clientWidth)
            }
        }
    }
</script>