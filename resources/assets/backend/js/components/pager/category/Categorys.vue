<template>
    <el-row>
        <el-row class="main-header">
            <el-button type="primary">新增</el-button>
        </el-row>
        <el-row>
            <el-table :data="listData" @selection-change="handleSelectionChange">
                <el-table-column type="selection"></el-table-column>
                <el-table-column label="名称" prop="cat_name"></el-table-column>
                <el-table-column label="排序" prop="cat_desc"></el-table-column>
                <el-table-column label="是否导航" prop="is_nav"></el-table-column>
            </el-table>
        </el-row>
    </el-row>
</template>
<script type="text/ecmascript-6">
    export default{
        data(){
            return {
                listData: [
                    {
                        id: 1,
                        cat_name: 'php',
                        cat_desc: 100,
                        is_nav: 1
                    },
                    {
                        id: 2,
                        cat_name: 'linux',
                        cat_desc: 200,
                        is_nav: 1
                    },
                    {
                        id: 3,
                        cat_name: 'mysql',
                        cat_desc: 10,
                        is_nav: 0
                    },
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