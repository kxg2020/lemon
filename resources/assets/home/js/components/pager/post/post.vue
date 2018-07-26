<template>
  <div id="post" class="post" style="min-height: 600px; width: 100%;">
    <div v-if="post">
      <h2 class="post-title">{{post.title}}</h2>
      <div class="post-meta">
        <span class="author"></span>
        <time>{{post.created_at}}</time>
      </div>
      <div class="post-content markdown" v-html="post.content" v-highlight></div>
      <div class="post-footer">
        <div class="post-tags">
          <span><i class="ion-folder"></i>分类</span>
          <span class="coral"><code>{{post.category.cat_name}}</code></span>
          <span><i class="ion-pricetags"></i>标签</span>
          <template v-for="(tag, tag_index) in post.tags" class="tag">
            <span class="coral"><code>{{tag.tag_name}}</code></span>
          </template>
        </div>
      </div>
      <comment :post-id="post.id"></comment>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        id: 0,
        post: null
      }
    },
    created() {
      if (typeof(this.$route.params.id) != undefined) {
        this.id = this.$route.params.id
      } else {
        this.$router.replace('/')
      }
    },
    mounted() {
      this.getPost()
    },
    methods: {
      getPost: function () {
        let _this = this
        let loadingInstance = _this.$loading({
          target: document.getElementById('post')
        })
        _this.axios.get('/post/' + _this.id).then(function (response) {
          let res = response.data
          if (res.status == 'success') {
            _this.post = res.data
            _this.$nextTick(() => {
              loadingInstance.close()
            })
          } else {
            loadingInstance.close()
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
  .post {

  }

  .post-title {
    font-weight: bold;
    margin-top: 30px;
  }

  .post-meta {
    font-size: 14px;
    padding-bottom: 15px;
    margin-bottom: 6px;
    margin: 0.9em 0 0.5em;
    vertical-align: baseline;
  }

  .post-content {
    margin: 0.9em 0 0.5em;
    padding-bottom: 0.6em;
    font-size: 100%;
    vertical-align: baseline;
  }

  .post-footer {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: space-between;
    margin: 2em 0;
  }

  .post-tags {
    color: #959595;
  }

  .post-tags i {
    margin-right: 10px;
  }

  .coral {
    padding: 2px 4px;
    font-size: 14px;
  }

  .coral code {
    color: #c7254e;
    background-color: #f9f2f4;
    border-radius: 4px;
  }
</style>