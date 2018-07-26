<template>
  <el-row>
    <el-col :span="11" class="el-card">
      <div class="el-card__body">
        <el-table :data="listData" v-loading="listLoading" @selection-change="handleSelectionChange">
          <el-table-column type="selection"></el-table-column>
          <el-table-column label="名称" prop="tag_name"></el-table-column>
        </el-table>
      </div>
    </el-col>
    <el-col :span="11" class="el-card" style="margin-left: 10px;">
      <div class="el-card__body">
        <el-form ref="tagForm" :model="tagModel" :rules="tagRules" label-width="80px">
          <el-form-item label="标签名称" prop="tag_name">
            <el-input v-model="tagModel.tag_name"></el-input>
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
  export default {
    data() {
      return {
        listData: [],
        listLoading: true,
        checkedAll: [],
        tagModel: {
          id: '',
          tag_name: ''
        },
        tagRules: {
          tag: [
            {required: true, type: 'string', message: '请填写标签名称', trigger: 'blur'}
          ]
        }
      }
    },
    mounted() {
      this.getData();
    },
    methods: {
      getData() {
        let _this = this;
        _this.axios.get('/tags').then(function (response) {
          let res = response.data;
          if (res.status == 'success') {
            _this.listData = res.data;
            _this.listLoading = false;
          } else {
            _this.$notify({
              title: 'error',
              message: '获取数据失败',
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
      onSubmit() {
        let _this = this;
        _this.$refs.tagForm.validate((valid) => {
          if (!valid) {
            console.log("submit error");
            return false;
          }
          _this.axios.post('/tags', _this.tagModel).then(function (response) {
            let res = response.data;
            if (res.status == 'success') {
              _this.$notify({
                title: 'success',
                message: '添加成功',
                type: 'success'
              })
              _this.$refs.tagForm.resetFields();
              _this.$router.replace('/tags');
              _this.getData();
            } else {
              _this.$notify({
                title: 'error',
                message: '添加失败',
                type: 'error'
              })
            }
          })
        })
      },
      closeForm() {
        this.$refs[tagRules].resetFields();
        this.tgaModel = {
          tag_name: ''
        }
      }
    }
  }
</script>