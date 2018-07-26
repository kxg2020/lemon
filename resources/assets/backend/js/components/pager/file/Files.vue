<template>
  <el-row>
    <el-card class="main-header">
      <router-link to="/files/add">
        <el-button type="primary">上传</el-button>
      </router-link>
    </el-card>
    <el-card>
      <el-table :data="listData" v-loading="listLoading" @selection-change="handleSelectionChange">
        <el-table-column type="selection"></el-table-column>
        <el-table-column label="目录" prop="dir"></el-table-column>
        <el-table-column label="文件名" prop="file_name"></el-table-column>
        <el-table-column label="文件类型" prop="file_ext"></el-table-column>
        <el-table-column label="操作">
          <template slot-scope="scope">
            <el-popover
              placement="left"
              width="300"
              trigger="click">
              <img
                :src="imgPrefix + scope.row.file_name + '?imageMogr2/auto-orient/thumbnail/300x200/blur/1x0/quality/100|imageslim'"
                alt="">
              <el-button slot="reference">预览</el-button>
            </el-popover>
          </template>
        </el-table-column>
      </el-table>
    </el-card>
    <el-card class="main-page">
      <el-pagination
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
        :current-page="currentPage"
        :page-sizes="[10, 15, 20]"
        :page-size="pageSize"
        layout="total, sizes, prev, pager, next, jumper"
        :total="total">
      </el-pagination>
    </el-card>
  </el-row>
</template>
<style>
  .link {
    text-decoration: none;
    color: #1f2d3d;
  }

  .el-card:nth-child(n+2) {
    margin-top: 10px;
  }
</style>
<script type="text/ecmascript-6">
  export default {
    data() {
      return {
        listData: [],
        checkedAll: [],
        listLoading: true,
        currentPage: 1,
        pageSize: 10,
        total: 0,
        imgPrefix: 'https://img.it9g.com/',
      }
    },
    mounted() {
      this.getFiles();
    },
    methods: {
      getFiles() {
        let _this = this;
        _this.listLoading = true;
        let query = {
          page_size: _this.pageSize,
          page: _this.currentPage
        }
        _this.axios.get('/files', {params: query}).then(function (response) {
          let res = response.data;
          if (res.status == 'success') {
            let _data = res.data;
            _this.total = _data.total,
              _this.currentPage = _data.current_page,
              _this.listData = _data.data;
            _this.listLoading = false;
          } else {
            _this.$message({
              message: "获取数据失败",
              type: 'error'
            })
          }
        });
      },
      deleteRow(index, rows) {
        rows.splice(index, 1);
      },
      handleSelectionChange(val) {
        this.checkedAll = val;
      },
      handleSizeChange(val) {
        this.pageSize = val;
        this.getFiles()
      },
      handleCurrentChange(val) {
        this.currentPage = val;
        this.getFiles();
      },
      openUpload() {

      }
    }
  }
</script>