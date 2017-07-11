<template>
    <el-row>
        <el-row class="main-header">
            <router-link to="/posts/add">
                <el-button type="primary">新增</el-button>
            </router-link>
        </el-row>
        <el-row>
            <el-table :data="listData" @selection-change="handleSelectionChange">
                <el-table-column type="selection"></el-table-column>
                <el-table-column label="标题" prop="title">
                    <template scope="scope">
                        <router-link :to="{path: 'post/edit/' + scope.row.id}" class="link">{{scope.row.title}}</router-link>
                    </template>
                </el-table-column>
                <el-table-column label="分类" prop="category_name"></el-table-column>
                <el-table-column label="日期" prop="create_at"></el-table-column>
            </el-table>
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
                listData: [
                    {
                        id: 1,
                        title: 'ha',
                        category_name: 'php',
                        create_at: '2017-06-17',
                    },
                    {
                        id: 2,
                        title: 'hi',
                        category_name: 'linux',
                        create_at: '2017-06-17',
                    },
                    {
                        id: 3,
                        title: 'e',
                        category_name: 'js',
                        create_at: '2017-06-17',
                    }
                ],
                checkedAll: [],
            }
        },
        methods: {
            deleteRow(index, rows){
                rows.splice(index, 1);
            },
            handleSelectionChange(val){
                this.checkedAll = val;
            }
        }
    }
</script>