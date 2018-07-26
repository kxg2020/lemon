<template>
  <el-row class="login">
    <el-form :model="loginForm" :roules="loginRules" ref="loginForm" label-positin="left" label-width="0px"
             class="login-form">
      <h3 class="login-title">Lemon</h3>
      <el-form-item prop="email">
        <el-input type="text" v-model="loginForm.email" auto-complete="off" placeholder="email" autofocus></el-input>
      </el-form-item>
      <el-form-item prop="password">
        <el-input type="password" v-model="loginForm.password" auto-complete="off" @keyup.native.13="loginFormSubmit"
                  placeholder="password"></el-input>
      </el-form-item>
      <!--<el-checkbox v-model="loginForm.remember">Remember me</el-checkbox>-->
      <el-form-item>
        <el-button type="primary" style="width: 100%;" @click.native.prevent="loginFormSubmit" :loading="logining">
          Login
        </el-button>
      </el-form-item>
    </el-form>
  </el-row>
</template>
<style>
  .login {
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
  }

  .login-form {
    width: 500px;
    height: fit-content;
    margin: auto;
  }

  .login-title {
    margin: 1em 0;
    font-size: 1.6em;
    text-align: center;
  }
</style>
<script type="text/ecmascript-6">
  export default {
    data() {
      return {
        logining: false,
        loginForm: {
          email: '',
          password: ''
        },
        loginRules: {
          email: [
            {required: true, message: "请输入邮箱", trigger: "blur"}
          ],
          password: [
            {required: true, message: "请输入密码", trigger: "blur"}
          ]
        }
      }
    },
    created () {
      let _this = this
      let user = JSON.parse(sessionStorage.getItem('lemon'))
      if(!user){
        _this.$router.push({path: '/login'})
      }
      _this.axios.post('/check').then(function (response) {
        let res = response.data
        if(!res.status){
          sessionStorage.removeItem('lemon')
          _this.$router.push({path: '/login'})
        }else {
          _this.$router.push({path: '/'})
        }
      })
    },
    methods: {
      loginFormSubmit() {
        var _this = this;
        _this.$refs.loginForm.validate((valid) => {
          if (valid) {
            _this.logining = true;
            var loginParams = {email: _this.loginForm.email, password: _this.loginForm.password};
            _this.axios.post('/login', loginParams).then(function (response) {
              let data = response.data;
              if (data.status == 200) {
                sessionStorage.setItem('lemon', JSON.stringify(data.user));
                _this.$notify({
                  title: 'success',
                  message: '登录成功',
                  type: 'success',
                  duration: 2000
                })
                setTimeout(function () {
                  _this.$router.push({path: '/main'})
                })
                _this.logining = false;
              } else {
                _this.$notify({
                  title: 'error',
                  message: '登录失败',
                  type: 'error'
                })
                _this.logining = false;
              }
            })
          }
        })
      }
    }
  }
</script>