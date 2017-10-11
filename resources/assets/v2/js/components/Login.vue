<template>
    <mu-row style="margin-top: 200px">
        <mu-col width="5" tablet="20" desktop="30"></mu-col>
        <mu-col width="90" tablet="60" desktop="40">
            <form :model="loginForm" :rules="loginRules">
                <mu-auto-complete hintText="Email" labelFloat label="Email" fullWidth  :dataSource="dataSource" v-model="loginForm.email" type="email" errorText="error"/>
                <mu-auto-complete hintText="Password" labelFloat label="Password" fullWidth  :dataSource="dataSource" v-model="loginForm.password" type="password"/>
            </form>
        </mu-col>
        <mu-col width="5" tablet="20" desktop="30"></mu-col>
    </mu-row>
</template>
<style>

</style>
<script>
    export default {
        data () {
            return {
                dataSource: [],
                loginForm: {
                    email: '123',
                    password: '456'
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
        created: function () {

        },
        methods: {

        },
        watch: {

        }
    }
</script>