<template>
  <div class="posts">
    <div v-if="posts.length > 0" v-for="(post, index) in posts" class="post">
      <h2 class="post-title">{{post.title}}</h2>
      <div class="post-meta">
        <span class="author"></span>
        <time>{{post.created_at}}</time>
      </div>
      <div class="post-intro">{{post.intro}}</div>

    </div>
    <div v-else>
      <h1> TODO Empty. </h1>
    </div>
  </div>
</template>
<script>
  export default {
    data () {
      return {
        posts: [],
        total: 0,
        currentPage: 1
      }
    },
    created () {
      this.getPosts()
    },
    methods: {
      getPosts: function () {
        let _this = this
        _this.axios.get('/posts').then(function (response) {
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
  .post{
    margin-bottom: 40px;
    border-bottom: 1px solid #e2e2e2;
    padding-bottom: 20px;
  }
  .post-title{
    font-weight: bold;
    margin-top: 30px;
  }
  .post-meta{
    font-size: 14px;
    padding-bottom: 15px;
    margin-bottom: 6px;
    margin: 0.9em 0 0.5em;
    vertical-align: baseline;
  }
  .post-intro{
    margin: 0.9em 0 0.5em;
    padding-bottom: 0.6em;
    font-size: 100%;
    vertical-align: baseline;
  }
</style>