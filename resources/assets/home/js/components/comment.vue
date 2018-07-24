<template>
  <div class="comments-container">
    <div class="comment-list">
      <div class="comment-header">
        <h2 class="comment-header-title">{{comment_count}}条评论</h2>
      </div>
      <template v-for="(comment, index) in comments" v-if="comments">
        <div class="comment-item">
          <div class="comment-item-meta">
                        <span class="user-link comment-gravatar">
                            <div class="comment-gravatar-p">
                                <img :src="comment.gravatar_src" alt="" style="width: 36px">
                            </div>
                        </span>
            <span class="user-link"><a class="user-link-link" target="_blank" :href="comment.url">{{comment.email}}</a></span>
            <span class="comment-item-date">{{comment.created_at}}</span>
          </div>
          <div class="comment-content">{{comment.body}}</div>
        </div>
      </template>
      <div class="comment-footer comment-edit">
        <el-form class="comment-form" ref="commentRef" :model="newComment" :rules="newCommentRules" label-width="80px">
          <el-form-item label="联系邮箱">
            <el-input v-model="newComment.email" placeholder="请输入联系邮箱"></el-input>
          </el-form-item>
          <el-form-item label="个人站点">
            <el-input v-model="newComment.url" placeholder="请输入个人站点"></el-input>
          </el-form-item>
          <el-form-item label="评论内容">
            <el-input type="textarea" :autosize="{ minRows: 5, maxRows: 20 }" v-model="newComment.body" placeholder="请输入评论内容"></el-input>
          </el-form-item>
          <el-form-item>
            <el-button type="primary" @click="onSubmit">提交评论</el-button>
          </el-form-item>
        </el-form>
      </div>
    </div>
  </div>
</template>
<style>
  .comment-list {
    border: 1px solid #e7eaf2;
  }

  .comment-header {
    padding: 0 20px;
    border-bottom: 1px solid #f0f2f7;
  }

  .comment-header-title {
    font-size: 15px;
    font-weight: 700;
  }

  .comment-item {
    border-bottom: 1px solid #f0f2f7;
    position: relative;
    padding: 12px 16px 10px;
  }

  .comment-item-meta {
    position: relative;
    height: 48px;
    padding-right: 3px;
    padding-left: 1px;
    margin-bottom: 5px;
    line-height: 24px;
  }

  .user-link {

  }

  .comment-gravatar {
    margin-right: 8px;
  }

  .comment-gravatar-p {
    position: relative;
    display: inline-block;
  }

  .user-link-link {
    /*color: inherit;*/
    text-decoration: none;
  }

  .comment-item-date {
    float: right;
    font-size: 14px;
    color: #8590a6;
  }

  .comment-content {
    margin-bottom: 6px;
    line-height: 25px;
  }

  .comment-form {
    padding: 12px 16px 10px;
  }

  .comment-form-header {
    padding: 10px 0;
  }

  .comment-form-edit {
    width: 100%;
  }

  .comment-form-textarea {
    width: 100% !important;
  }
</style>
<script>
  export default {
    props: {
      postId: {
        type: Number,
        default() {
          return 0
        }
      }
    },
    data() {
      return {
        comments: [],
        loadingError: false,
        comment_count: 0,
        newComment: {
          post_id: 0,
          email: '',
          url: '',
          body: '',
          gravatar_src: ''
        },
        newCommentRules: {
          email: [
            {required: true, type: 'string', message: '请填写联系邮箱', trigger: 'blur'}
          ],
          url: [
            {required: true, type: 'string', message: '请填写个人站点', trigger: 'blur'}
          ],
          body: [
            {required: true, type: 'string', message: '请填写评论内容', trigger: 'blur'}
          ],
        },
        submitStatus: false
      }
    },
    created: function () {
      this.newComment.post_id = this.postId
      this.getComments()
      this.getUserInfo()
    },
    mounted: function () {

    },
    methods: {
      getComments: function () {
        let _this = this
        _this.axios.get('/comment/' + _this.postId).then(function (response) {
          let res = response.data
          if (res.status != 'success') {
            _this.loadingError = true
            return false
          }
          _this.comments = res.data
          _this.comment_count = res.data.length;
        })
      },
      getUserInfo: function () {
        let userinfo = JSON.parse(sessionStorage.getItem('userinfo'));
        if (userinfo) {
          console.log(userinfo)
          this.newComment.email = userinfo.email
          this.newComment.url = userinfo.url
        }
      },
      onSubmit: function () {
        let _this = this
        _this.$refs.commentRef.validate((valid) => {
          if (!valid) {
            console.log("submit error")
            return false
          }
        })
        _this.axios.post('/comment', _this.newComment).then(function (response) {
          let res = response.data
          if (res.status == 'success') {
            _this.comments.push(res.data)
            _this.comment_count++
            _this.newComment.body = null
            let userinfo = {
              email: res.data.email,
              url: res.data.url,
              last_time: new Date()
            }
            sessionStorage.setItem('userinfo', JSON.stringify(userinfo))
            _this.newComment.body = ''
          } else {
            _this.$message({
              message: res.msg,
              type: 'error'
            })
          }
        })
      }
    }
  }
</script>