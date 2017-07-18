<template>
    <el-row type="flex" class="row-bg" justify="center">
        <el-col :span="8" :xs="{span:20}">
            <el-form :model="loginForm" :roules="loginRules" ref="loginForm" label-positin="left" label-width="0px" class="">
                <h3 class="title">系统登录</h3>
                <el-form-item prop="email">
                    <el-input type="text" v-model="loginForm.email" auto-complete="off" placeholder="email"></el-input>
                </el-form-item>
                <el-form-item prop="password">
                    <el-input type="password" v-model="loginForm.password" auto-complete="off" placeholder="password"></el-input>
                </el-form-item>
                <!--<el-checkbox v-model="loginForm.remember">Remember me</el-checkbox>-->
                <el-form-item>
                    <el-button type="primary" style="width: 100%;" @click.native.prevent="loginFormSubmit" :loading="logining">Login</el-button>
                </el-form-item>
            </el-form>
        </el-col>
    </el-row>
</template>
<style>

</style>
<script type="text/ecmascript-6">
    export default {
        data() {
            return {
                logining: false,
                loginForm: {
                    email: '1225039937@qq.com',
                    password: '111111'
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
        methods: {
            loginFormSubmit(){
                var _this = this;
                _this.$refs.loginForm.validate((valid) => {
                    if(valid) {
                        _this.logining = true;
                        var loginParams = { email: _this.loginForm.email, password: _this.loginForm.password};
                        _this.axios.post('/login', loginParams).then(function (response) {
                            let data = response.data;
                            if(data.status == 200){
                                sessionStorage.setItem('lemon', JSON.stringify(data.user));
                                _this.$message({
                                    message: "登录成功",
                                    type: 'success',
                                    duration: 2000
                                });
                                setTimeout(function () {
                                    _this.$router.push({path: '/posts'})
                                })
                                _this.logining = false;
                            }else{
                                _this.$message.error("登录失败");
                                _this.logining = false;
                            }
                        })
                    }
                })
            }
        }
    }
</script>