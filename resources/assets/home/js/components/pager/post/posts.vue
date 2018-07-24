<template>
  <div class="posts" id="posts" style="min-height: 600px; width: 100%;">
    <div v-if="posts.length > 0" v-for="(post, index) in posts" class="post">
      <h2 class="post-title" @click="readPost(post.id)">{{post.title}}</h2>
      <div class="post-meta">
        <span class="author"></span>
        <time>{{post.created_at}}</time>
      </div>
      <div class="post-intro">{{post.intro}}</div>
      <div class="post-footer">
        <div class="post-tags">
          <span><i class="ion-folder"></i>分类</span>
          <span class="coral"><code>{{post.category.cat_name}}</code></span>
          <span><i class="ion-pricetags"></i>标签</span>
          <template v-for="(tag, tag_index) in post.tags" class="tag">
            <span class="coral"><code>{{tag.tag_name}}</code></span>
          </template>
        </div>
        <button class="readall" @click="readPost(post.id)">阅读全文</button>
      </div>
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

    },
    mounted () {
      this.getPosts()
    },
    methods: {
      getPosts: function () {
        let _this = this
        let loadingInstance = _this.$loading({
          target: document.getElementById('posts')
        })
        _this.axios.get('/posts').then(function (response) {
          let res = response.data
          if(res.status == 'success'){
            let _data = res.data
            _this.total = _data.total
            _this.currentPage = _data.current_page
            _this.posts = _data.data
            _this.listLoading = false
            _this.$nextTick(() => {
              loadingInstance.close()
            })
          }else {
            loadingInstance.close()
            _this.$message({
              message: "获取数据失败",
              type: 'error'
            })
          }
        })
      },
      readPost: function (id) {
        this.$router.replace('/post/' + id)
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
  .post-footer{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
  }
  .post-tags{
    color: #959595;
  }
  .post-tags i{
    margin-right: 10px;
  }
  .coral{
    padding: 2px 4px;
    font-size: 14px;
  }
  .coral code{
    color: #c7254e;
    background-color: #f9f2f4;
    border-radius: 4px;
  }
  .readall{
    right: 0;
    color: #333;
    background-color: #fff;
    font-weight: 400;
    text-align: center;
    padding: 6px 12px;
    font-size: 14px;
    border-radius: 4px;
    border: 1px solid #ccc;
  }
</style>