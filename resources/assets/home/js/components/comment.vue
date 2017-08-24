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
                <form class="comment-form form-inline">
                    <div class="comment-form-header">
                        <div class="form-group" id="email-group">
                            <label for="email">邮箱</label>
                            <input type="text" class="form-control" id="email" name="email" v-model="newComment.email" placeholder="email">
                        </div>
                        <div class="form-group" id="url-group">
                            <label for="url">个人站点</label>
                            <input type="text" class="form-control" id="url" name="url" v-model="newComment.url" placeholder="url">
                        </div>
                    </div>
                    <div class="comment-form-edit">
                        <div class="form-group" style="display: block" id="body-group">
                        <textarea class="comment-form-textarea form-control" rows="3" name="new_comment" id="new_comment"  v-model="newComment.body" placeholder="写下你的评论..."></textarea>
                        </div>
                    </div>
                    <button style="margin: 10px 0;" type="button" class="btn btn-default" @click="onSubmit">{{submitTitle}}</button>
                </form>
            </div>
        </div>
    </div>
</template>
<style>
    .comment-list{
        border: 1px solid #e7eaf2;
    }
    .comment-header{
        padding: 0 20px;
        border-bottom: 1px solid #f0f2f7;
    }
    .comment-header-title{
        font-size: 15px;
        font-weight: 700;
    }
    .comment-item{
        border-bottom: 1px solid #f0f2f7;
        position: relative;
        padding: 12px 16px 10px;
    }
    .comment-item-meta{
        position: relative;
        height: 48px;
        padding-right: 3px;
        padding-left: 1px;
        margin-bottom: 5px;
        line-height: 24px;
    }
    .user-link{

    }
    .comment-gravatar{
        margin-right: 8px;
    }
    .comment-gravatar-p{
        position: relative;
        display: inline-block;
    }
    .user-link-link{
        /*color: inherit;*/
        text-decoration: none;
    }
    .comment-item-date{
        float: right;
        font-size: 14px;
        color: #8590a6;
    }
    .comment-content{
        margin-bottom: 6px;
        line-height: 25px;
    }
    .comment-form{
        padding: 12px 16px 10px;
    }
    .comment-form-header{
        padding: 10px 0;
    }
    .comment-form-edit{
        width: 100%;
    }
    .comment-form-textarea{
        width: 100% !important;
    }
</style>
<script>
export default {
    props: {
        postId: {
            type: String,
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
            submitTitle: '评论',
            newComment: {
                post_id: 0,
                email: '',
                url: 'http://',
                body: '',
                gravatar_src: ''
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
            _this.axios.get('/comment/'+_this.postId).then(function (response) {
                let res = response.data
                if(res.status != 'success'){
                    _this.loadingError = true
                    return false
                }
                _this.comments = res.data
                _this.comment_count = res.data.length;
            })
        },
        getUserInfo: function () {
            let userinfo = JSON.parse(sessionStorage.getItem('userinfo'));
            if(userinfo){
                console.log(userinfo)
                this.newComment.email = userinfo.email
                this.newComment.url = userinfo.url
            }
        },
        onSubmit: function () {
            let _this = this
            let emailReg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/
            let urlReg = /[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+\.?/

            _this.submitStatus = true

            if(!emailReg.test(this.newComment.email)){
                $("#email-group").addClass('has-error')
                _this.submitStatus = false
            }else {
                $("#email-group").removeClass('has-error')
            }

            if(!urlReg.test(this.newComment.url)){
                $("#url-group").addClass('has-error')
                _this.submitStatus = false
            }else {
                $("#url-group").removeClass('has-error')
            }

            if(this.newComment.body == ''){
                $("#body-group").addClass('has-error')
                _this.submitStatus = false
            }else {
                $("#body-group").removeClass('has-error')
            }

            if(!_this.submitStatus){
                return false
            }
            _this.axios.post('/comment', _this.newComment).then(function (response) {
                let res = response.data
                if(res.status == 'success'){
                    _this.comments.push(res.data)
                    _this.comment_count++
                    _this.newComment.body = null
                    let userinfo = {
                        email: res.data.email,
                        url: res.data.url,
                        last_time: new Date()
                    }
                    sessionStorage.setItem('userinfo', JSON.stringify(userinfo));
                }else {
                    console.log(res);
                    alert("数据格式错误");
                }
            })
        }
    }
}
</script>