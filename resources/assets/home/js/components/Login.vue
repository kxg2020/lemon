<template>
    <el-form :model="loginForm" :roules="loginRules" ref="loginForm" label-positin="left" label-width="0px" class="">
        <h3 class="title">系统登录</h3>
        <el-form-item prop="account">
            <el-input type="text" v-model="loginForm.account" auto-complete="off" placeholder="account"></el-input>
        </el-form-item>
        <el-form-item prop="password">
            <el-input type="password" v-model="loginForm.password" auto-complete="off" placeholder="password"></el-input>
        </el-form-item>
        <el-checkbox v-model="loginForm.remember">Remember me</el-checkbox>
        <el-form-item>
            <el-button type="primary" style="width: 100%;" @click.native.prevent="loginFormSubmit" :loading="logining">Login</el-button>
        </el-form-item>
    </el-form>
</template>

<script type="text/ecmascript-6">
    export default {
        data() {
            return {
                logining: false,
                loginForm: {
                    account: 'admin',
                    password: '111111'
                },
                loginRules: {
                    account: [
                        {required: true, message: "请输入用户名", trigger: "blur"}
                    ],
                    password: [
                        {required: true, message: "请输入密码", trigger: "blur"}
                    ]
                }
            }
        },
        methods: {
            loginFormSubmit(){
                var _this = this;
                _this.$refs.loginForm.validate((valid) => {
                    if(valid) {
                        _this.logining = true;
                        var loginParams = { account: _this.loginForm.account, password: _this.loginForm.password};
                        _this.axios.get('/login', loginParams).then(function (response) {
                            let data = response.data;
                            if(data.state){
                                sessionStorage.setItem('dashboard', JSON.stringify(data.user));
                                _this.$message({
                                    message: "登录成功",
                                    type: 'success',
                                    duration: 2000
                                });
                                setTimeout(function () {
                                    _this.$router.push({path: '/home'})
                                })
                            }else{
                                _this.$message.error("登录失败")
                            }
                        })
                    }
                })
            }
        }
    }
</script>