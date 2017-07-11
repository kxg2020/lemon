<template>
    <el-row>
        <el-form ref="form" :model="postModel" label-width="80px">
            <el-form-item label="标题" prop="title">
                <el-input v-model="postModel.title"></el-input>
            </el-form-item>
            <el-form-item label="分类" prop="category_id">
                <el-select v-model="postModel.category_id" placeholder="请选择分类">
                    <el-option v-for="item in categorys" :label="item.cat_name" :value="item.id" :key="item.id"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="首页图" prop="thumb">
                <el-upload
                        class="upload-demo"
                        drag
                        action="https://jsonplaceholder.typicode.com/posts/"
                        multiple>
                    <i class="el-icon-upload"></i>
                    <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
                    <div class="el-upload__tip" slot="tip">只能上传jpg/png文件，且不超过500kb</div>
                </el-upload>
            </el-form-item>
            <el-form-item label="正文" prop="markdown">
                <textarea id="editor"></textarea>
                <el-input type="hidden" v-model="postModel.markdown"></el-input>
            </el-form-item>
            <el-form-item>
                <el-input type="hidden" v-model="postModel.content"></el-input>
                <el-button type="primary" @click="onSubmit">立即创建</el-button>
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
</style>
<script type="text/ecmascript-6">
    import { default as SimpleMDE } from 'simplemde/dist/simplemde.min';
    export default{
        data() {
            return {
                postModel: {
                    title: '',
                    category_id: '',
                    thumd: '',
                    content: '',
                    markdown: '',
                },
                categorys: [
                    {id: 1, cat_name: 'php'},
                    {id: 2, cat_name: 'linux'},
                    {id: 3, cat_name: 'mysql'}
                ]
            }
        },
        created() {
//            this.getPost();
        },
        mounted() {
            this.simplemde = new SimpleMDE({
                element: document.getElementById("editor")
            })
        },
        methods: {
            getPost: function()  {
                let _this = this;
                _this.axios.get('/post').then(function (response) {
                    let res = response.data;
                })
            },
            onSubmit: function () {
                this.postModel.markdown = this.simplemde.value();
                this.postModel.content = this.simplemde.markdown(this.postModel.markdown);
            }
        },
        watch: {

        }
    }
</script>
