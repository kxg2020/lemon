<template>
  <el-card>
    <el-form v-model="fileModel" label-width="80px" v-loading="formLoading">
      <el-form-item label="目录" prop="dir">
        <el-select
          v-model="fileModel.dir"
          :multiple="false"
          filterable
          allow-create
          placeholder="请选择上传目录">
          <el-option
            v-for="(fileDir, index) in fileDirs"
            :key="index"
            :label="fileDir.dir"
            :value="fileDir.dir">
          </el-option>
        </el-select>
      </el-form-item>
      <el-form-item label="文件" prop="file">
        <el-upload
          class="upload-demo"
          drag
          :action="uploadApi"
          :headers="headers"
          :on-success="uploadSuccess"
          :before-upload="uploadBefore"
          :multiple="false"
          :show-file-list="true"
          :data="{'dir': fileModel.dir}">
          <i class="el-icon-upload"></i>
          <div class="el-upload__text">将文件拖到此处，或<em>点击上传</em></div>
        </el-upload>
      </el-form-item>
    </el-form>
  </el-card>
</template>
<script type="text/ecmascript-6">
  export default {
    data() {
      return {
        formLoading: true,
        uploadApi: window.Dashboard.apiUrl + '/files',
        headers: {'X-CSRF-TOKEN': window.Dashboard.csrfToken},
        fileModel: {
          dir: '',
          file: ''
        },
        fileDirs: [],
        uploadData: {}
      }
    },
    created() {
      this.getDirs()
    },
    methods: {
      getDirs: function () {
        let _this = this;
        _this.axios.get('/dirs').then(function (response) {
          let res = response.data;
          if (res.status == 'success') {
            _this.fileDirs = res.data;
            _this.formLoading = false;
          } else {
            _this.$notify({
              title: 'error',
              message: '获取数据失败',
              type: 'error'
            })
          }
        })
      },
      uploadSuccess: function (response) {

      },
      uploadBefore: function () {
        let _this = this
        if (!this.fileModel.dir) {
          _this.$notify({
            title: 'error',
            message: '请选择目录',
            type: 'error'
          })
          return false
        } else {
          return true
        }
      }
    }
  }
</script>