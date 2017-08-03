<template>
    <el-row>
        <el-form ref="postForm" :model="postModel" :rules="postRules" label-width="80px" v-loading="formLoading">
            <el-form-item label="标题" prop="title">
                <el-input v-model="postModel.title"></el-input>
            </el-form-item>
            <el-form-item label="分类" prop="cat_id">
                <el-select v-model="postModel.cat_id" placeholder="请选择分类">
                    <el-option v-for="item in categorys" :label="item.cat_name" :value="item.id" :key="item.id"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="标签" prop="tags">
                <el-select v-model="postModel.tags" multiple placeholder="请选择">
                    <el-option
                            v-for="item in tags"
                            :key="item.tag_id"
                            :label="item.tag_name"
                            :value="item.tag_id">
                    </el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="首页图" prop="thumb">
                <el-upload
                        class="upload-demo"
                        drag
                        :action="uploadApi"
                        :headers="headers"
                        :on-success="uploadSuccess"
                        :multiple="false"
                        :show-file-list="false">
                    <i class="el-icon-upload"></i>
                    <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                </el-upload>
                <el-input placeholder="" v-model="postModel.thumbInput" v-on:blur="thumbInputSuccess()">
                    <template slot="prepend">{{thumbInputPrefix}}</template>
                </el-input>
                <img v-if="thumbUrl" :src="thumbUrl" class="thumb-view">
            </el-form-item>
            <el-form-item label="正文" prop="markdown">
                <textarea id="editor"></textarea>
                <el-input type="hidden" v-model="postModel.markdown"></el-input>
            </el-form-item>
            <el-form-item>
                <el-input type="hidden" v-model="postModel.content"></el-input>
                <el-button type="primary" @click="onSubmit">{{sumitTitle}}</el-button>
                <el-button>取消</el-button>
            </el-form-item>
        </el-form>
    </el-row>
</template>
<style>
    .fullscreen{
        margin-top: 70px;
        margin-left: 13%;
        z-index: 99999 !important;
    }
    .CodeMirror-fullscreen{
        margin-top: 70px;
        margin-left: 13%;
        z-index: 99999 !important;
    }
    .editor-preview-active-side{
        margin-left: 13%;
        margin-top: 70px;
        z-index: 99999 !important;
    }
    .thumb-view{

    }
</style>
<script type="text/ecmascript-6">
    import { default as SimpleMDE } from 'simplemde/dist/simplemde.min';
    export default{
        data() {
            return {
                formLoading: true,
                uploadApi: window.Dashboard.apiUrl + '/posts/upload',
                headers: {'X-CSRF-TOKEN': window.Dashboard.csrfToken},
                postModel: {
                    title: '',
                    cat_id: '',
                    tags: {},
                    thumb: '',
                    content: '',
                    markdown: '',
                    thumbInput: '',
                },
                categorys: [],
                tags: [],
                thumbUrl: '',
                thumbInputPrefix: 'http://img.it9g.com/',
                postRules: {
                    title: [
                        {required: true, type: 'string', message: '请填写标题', trigger: 'blur'}
                    ],
                    tags: [
                        {required: true, type: 'array', message: '请选择标签', trigger: 'click'}
                    ]
                },
                postType: 'add',
                sumitTitle: '立即创建'
            }
        },
        created() {
            this.getCategorys();
            this.getTags();
            if(this.$route.params.id != undefined){
                this.postType = 'edit';
                this.getPost(this.$route.params.id);
                this.sumitTitle = '立即修改';
            }
            this.formLoading = false;
        },
        mounted() {
            this.simplemde = new SimpleMDE({
                element: document.getElementById("editor")
            })
        },
        methods: {
            getPost: function (id) {
                let _this = this;
                _this.axios.get('/posts/'+id).then(function (response) {
                    let res = response.data;
                    if(res.status == 'success'){
                        _this.postModel = res.data;
                        _this.thumbUrl = res.data.thumb;
                        _this.simplemde.value(res.data.markdown);
                    }
                })
            },
            getCategorys: function()  {
                let _this = this;
                _this.axios.get('/categorys').then(function (response) {
                    let res = response.data;
                    if(res.status == 'success'){
                        if(res.data.length < 1){
                            _this.$message({
                                message: "请添加至少一个分类",
                                type: 'error'
                            })
                            setTimeout(function () {
                                _this.$router.replace('/categorys');
                            }, 2000)
                        }
                        _this.categorys = res.data;
                    }else {
                        _this.$message({
                            message: "获取数据失败",
                            type: 'error'
                        })
                    }
                })
            },
            getTags: function()  {
                let _this = this;
                _this.axios.get('/tags').then(function (response) {
                    let res = response.data;
                    if(res.status == 'success'){
                        if(res.data.length < 1){
                            _this.$message({
                                message: "请添加至少一个标签",
                                type: 'error'
                            })
                            setTimeout(function () {
                                _this.$router.replace('/tags');
                            }, 2000)
                        }
                        _this.tags = res.data;
                    }else {
                        _this.$message({
                            message: "获取数据失败",
                            type: 'error'
                        })
                    }
                })
            },
            onSubmit: function () {
                let _this = this;
                _this.postModel.markdown = this.simplemde.value();
                _this.postModel.content = this.simplemde.markdown(this.postModel.markdown);
                _this.$refs.postForm.validate((valid) => {
                    if(!valid){
                        console.log("submit error");
                        return false;
                    }
                    if(_this.postModel.markdown.length < 1){
                        _this.$message({
                            message: "请输入正文",
                            type: 'error'
                        })
                    }
                    if(_this.postModel.content.length < 1){
                        _this.$message({
                            message: "内容转换失败",
                            type: 'error'
                        })
                    }
                    if(_this.postType == 'add') {
                        _this.axios.post('/posts', _this.postModel).then(function (response) {
                            let res = response.data;
                            if (res.status == 'success') {
                                _this.$message({
                                    message: "添加成功",
                                    type: 'success'
                                })
                                setTimeout(function () {
                                    _this.$router.replace('/posts');
                                }, 2000)
                            } else {
                                _this.$message({
                                    message: "添加失败",
                                    type: 'error'
                                })
                            }
                        })
                    }else {
                        _this.axios.put('/posts/update', _this.postModel).then(function (response) {
                            let res = response.data;
                            if (res.status == 'success') {
                                _this.$message({
                                    message: "修改成功",
                                    type: 'success'
                                })
                                setTimeout(function () {
                                    _this.$router.replace('/posts');
                                }, 2000)
                            } else {
                                _this.$message({
                                    message: "修改失败",
                                    type: 'error'
                                })
                            }
                        })
                    }
                })
            },
            uploadSuccess: function(response, file, fileList) {
                if(response.status == 200) {
                    this.postModel.thumb = response.fileUrl;
                    this.thumbUrl = response.fileUrl;
                }
            },
            thumbInputSuccess: function () {
                this.postModel.thumb = this.thumbInputPrefix + this.postModel.thumbInput;
                //判断图片是否存在
                let imgObj = new Image();
                imgObj.src = this.postModel.thumb;
                if (imgObj.fileSize <= 0 || (imgObj.width <= 0 || imgObj.height <= 0)) {
                    this.$message({
                        message: "图片地址无效",
                        type: 'error'
                    });
                    this.thumbUrl = this.thumbInputPrefix + '404.gif';
                }else {
                    this.thumbUrl = this.thumbInputPrefix + this.postModel.thumbInput;
                }
            }
        },
        watch: {

        }
    }
</script>
