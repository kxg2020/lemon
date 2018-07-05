<template>
  <div>

  </div>
</template>

<script>
  export default {
    data () {
      return {
        posts: [],
        total: 0,
        currentPage: 1,
        loadingInstance: {}
      }
    },
    created () {
      this.getPosts()
    },
    methods: {
      getPosts: function () {
        let _this = this
        _this.loadingInstance =  _this.$loading()
        _this.axios.get('/posts').then(function (response) {
          _this.loadingInstance.close()
          let res = response.data
          if(res.status == 'success'){
            let _data = res.data;
            _this.total = _data.total
            _this.currentPage = _data.current_page
            _this.posts = _data.data
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

<style scoped>

</style>