<template>
    <el-row>
        <el-row class="main-header">

        </el-row>
        <el-row>
            <el-table :data="listData" v-loading="listLoading" @selection-change="handleSelectionChange">
                <el-table-column type="selection"></el-table-column>
                <el-table-column label="email" prop="email"></el-table-column>
                <el-table-column label="url" prop="url">
                    <template slot-scope="scope">
                        <a :href="scope.row.url" class="link" target="_blank">{{scope.row.url}}</a>
                    </template>
                </el-table-column>
                <el-table-column label="评论" prop="body_show">
                    <template slot-scope="scope">
                        {{scope.row.body_show}}
                        <el-popover
                                placement="left"
                                width="400"
                                trigger="click">
                            <div class="comment_body_show">
                                {{scope.row.body}}
                            </div>
                            <a v-if="scope.row.body != scope.row.body_show" href="javascript:void(0)" slot="reference" style="color: black;">...</a>
                        </el-popover>
                    </template>
                </el-table-column>
                <el-table-column label="时间" prop="created_at"></el-table-column>
                <el-table-column label="操作" prop="id">
                    <template slot-scope="scope">
                        <el-button type="danger" size="small" @click="handleDistory(scope.$index, scope.row.id)">删除</el-button>
                    </template>
                </el-table-column>
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
    .comment_body_show{
        padding: 20px;
        line-height: 20px;
        font-size: 15px;
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
            this.getComments();
        },
        methods: {
            getComments(){
                let _this = this
                _this.listLoading = true
                let query = {
                    page_size:  _this.pageSize,
                    page: _this.currentPage
                }
                _this.axios.get('/comments', {params: query}).then(function (response) {
                    let res = response.data
                    if(res.status == 'success'){
                        let _data = res.data
                        _this.total = _data.total,
                        _this.currentPage = _data.current_page,
                        _this.listData = _data.data
                        _this.listLoading = false
                    }else {
                        _this.$notify({
                            title: 'error',
                            message: '获取数据失败',
                            type: 'error'
                        })
                    }
                });
            },
            handleDistory(index, _id){
                let _this = this
                _this.axios.delete('/comments/destroy', {params: {id: _id}}).then(function (response) {
                    let res = response.data
                    if(res.status == 'success'){
                        _this.listData.splice(index, 1)
                        _this.$notify({
                            title: 'success',
                            message: '删除成功',
                            type: 'success'
                        })
                    }else{
                        _this.$notify({
                            title: 'error',
                            message: '删除数据失败' + res.message,
                            type: 'error'
                        })
                    }
                })
            },
            deleteRow(index, rows){
                rows.splice(index, 1)
            },
            handleSelectionChange(val){
                this.checkedAll = val
            },
            handleSizeChange(val) {
                this.pageSize = val
                this.getComments()
            },
            handleCurrentChange(val) {
                this.currentPage = val
                this.getComments();
            }
        }
    }
</script>