<template>
    <el-row>
        <el-col :span="11" class="el-card">
            <div class="el-card__body">
                <el-table :data="listData" v-loading="listLoading" @selection-change="handleSelectionChange">
                    <el-table-column type="selection"></el-table-column>
                    <el-table-column label="名称" prop="cat_name"></el-table-column>
                    <el-table-column label="排序" prop="cat_desc"></el-table-column>
                    <el-table-column label="是否导航" prop="is_nav"></el-table-column>
                </el-table>
            </div>
        </el-col>
        <el-col :span="11" class="el-card" style="margin-left: 10px;">
            <div class="el-card__body">
                <el-form ref="categoryForm" :model="categoryModel" :rules="categoryRules" label-width="80px">
                    <el-form-item label="分类名称" prop="cat_name">
                        <el-input v-model="categoryModel.cat_name"></el-input>
                    </el-form-item>
                    <el-form-item label="排序" prop="cat_desc">
                        <el-input v-model="categoryModel.cat_desc"></el-input>
                    </el-form-item>
                    <el-form-item label="首页导航">
                        <el-switch on-text="是" off-text="否" v-model="categoryModel.is_nav" on-value="1" off-value="0"></el-switch>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="onSubmit()">立即创建</el-button>
                        <el-button>取消</el-button>
                    </el-form-item>
                </el-form>
            </div>
        </el-col>
    </el-row>
</template>
<script type="text/ecmascript-6">
    export default{
        data(){
            return {
                listData: [],
                listLoading: true,
                checkedAll: [],
                categoryModel: {
                    cat_name: '',
                    cat_desc: '',
                    is_nav: '1'
                },
                categoryRules: {
                    cat_name: [
                        {required: true, type: 'string', message: '请填写分类名称', trigger: 'blur'}
                    ],
                    cat_desc: [
                        {required: true, validator:(rule, value, callback) => {
                            if(/^\d+/.test(value) == false){
                                callback(new Error('排序只能输入数字'));
                            }else {
                                callback();
                            }
                        }, trigger: 'blur'}
                    ]
                }
            }
        },
        mounted() {
            this.getData();
        },
        methods: {
            getData(){
               let _this = this;
               _this.axios.get('/categorys').then(function (response) {
                   let res = response.data;
                   if(res.status == 'success'){
                       _this.listData = res.data;
                       _this.listLoading = false;
                   }else {
                       _this.$notify({
                           title: 'error',
                           message: '获取数据失败',
                           type: 'error'
                       })
                   }
               });
            },
            deleteRow(index, rows){
                rows.splice(index, 1);
            },
            handleSelectionChange(val){
                this.checkedAll = val;
            },
            onSubmit(){
                let _this = this;
                _this.$refs.categoryForm.validate((valid) => {
                    if(!valid){
                        console.log("submit error");
                        return false;
                    }
                    _this.axios.post('/categorys', _this.categoryModel).then(function (response) {
                        let res = response.data;
                        if(res.status == 'success'){
                            _this.$notify({
                                title: 'success',
                                message: '添加成功',
                                type: 'success'
                            })
                            _this.$refs.categoryForm.resetFields();
                            _this.$router.replace('/categorys');
                            _this.getData();
                        }else {
                            _this.$notify({
                                title: 'erorr',
                                message: '添加失败',
                                type: 'erorr'
                            })
                        }
                    })
                })
            },
            closeForm(){
                this.$refs[categoryRules].resetFields();
                this.categoryModel = {
                    cat_name: '',
                    cat_desc: '',
                    is_nav: '1'
                }
            }
        }
    }
</script>