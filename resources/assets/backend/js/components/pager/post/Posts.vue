<template>
    <el-row>
        <el-row class="main-header">
            <router-link to="/posts/add">
                <el-button type="primary">新增</el-button>
            </router-link>
        </el-row>
        <el-row>
            <el-table :data="listData" v-loading="listLoading" @selection-change="handleSelectionChange">
                <el-table-column type="selection"></el-table-column>
                <el-table-column label="标题" prop="title">
                    <template scope="scope">
                        <router-link :to="{path: 'post/edit/' + scope.row.id}" class="link">{{scope.row.title}}</router-link>
                    </template>
                </el-table-column>
                <el-table-column label="分类" prop="category.cat_name"></el-table-column>
                <el-table-column label="日期" prop="created_at"></el-table-column>
            </el-table>
        </el-row>
        <el-row class="main-page">
            <el-pagination
                    @size-change="handleSizeChange"
                    @current-change="handleCurrentChange"
                    :current-page="currentPage"
                    :page-sizes="[10, 15, 20]"
                    :page-size="pageSize"
                    layout="total, sizes, prev, pager, next, jumper"
                    :total="total">
            </el-pagination>
        </el-row>
    </el-row>
</template>
<style>
    .link{
        text-decoration: none;
        color: #1f2d3d;
    }
</style>
<script type="text/ecmascript-6">
    export default{
        data(){
            return {
                listData: [],
                checkedAll: [],
                listLoading: true,
                currentPage: 1,
                pageSize: 10,
                total: 0
            }
        },
        mounted() {
            this.getPosts();
        },
        methods: {
            getPosts(){
                let _this = this;
                _this.listLoading = true;
                let query = {
                    page_size:  _this.pageSize,
                    page: _this.currentPage
                }
                _this.axios.get('/posts', {params: query}).then(function (response) {
                    let res = response.data;
                    if(res.status == 'success'){
                        let _data = res.data;
                        _this.total = _data.total,
                        _this.currentPage = _data.current_page,
                        _this.listData = _data.data;
                        _this.listLoading = false;
                    }else {
                        _this.$message({
                            message: "获取数据失败",
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
            handleSizeChange(val) {
                this.pageSize = val;
                this.getPosts()
            },
            handleCurrentChange(val) {
                this.currentPage = val;
                this.getPosts();
            }
        }
    }
</script>