<template>
    <el-row>
        <el-col :span="24" class="nav" style="background: #324157;">
            <el-menu theme="dark"  class="el-menu-demo" mode="horizontal"  style="float: right;border-radius: 0;">
                <el-menu-item index="1" href="/">首页</el-menu-item>
                <el-submenu index="2">
                    <template slot="title">Lemon</template>
                    <el-menu-item @click.native="logout" index="2-1">退出</el-menu-item>
                </el-submenu>
            </el-menu>
        </el-col>

        <el-col :span="24">
            <el-col :span="3" class="menu">
                <el-menu default-active="2" class="el-menu-vertical-demo"   theme="dark" style="border-radius: 0;" :router="routerState">
                    <template v-for="(item, index) in $router.options.routes" v-if="item.children">
                        <template v-if="item.leaf">
                            <el-submenu :index="index + ''">
                                <template slot="title">{{item.name}}</template>
                                <el-menu-item-group>
                                    <template v-for="(menu, index2) in item.children" v-if="menu.name">
                                        <el-menu-item :index="menu.path" >{{menu.name}}</el-menu-item>
                                    </template>
                                </el-menu-item-group>
                            </el-submenu>
                        </template>
                        <template v-else>
                            <el-menu-item :index="item.children[0].path" >{{item.children[0].name}}</el-menu-item>
                        </template>
                    </template>
                </el-menu>
            </el-col>
            <el-col :span="21" class="content">
                <el-col :span="24" class="content-nav">
                    <el-breadcrumb separator="/">
                        <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                        <el-breadcrumb-item :to="pathParent" v-if="pathNameParent">{{pathNameParent}}</el-breadcrumb-item>
                        <el-breadcrumb-item>{{pathName}}</el-breadcrumb-item>
                    </el-breadcrumb>
                </el-col>
                <el-col :span="24" class="content-main">
                    <router-view></router-view>
                </el-col>
            </el-col>
        </el-col>
    </el-row>
</template>
<style>
    .nav{
        position: fixed;
        z-index: 999;
    }
    .menu{
        position: fixed;
        top: 60px;
        z-index: 99;
        bottom: 0;
        background: #324157;
    }
    .content{
        position: absolute;
        top: 60px;
        left: 12.5%;
        z-index: 9;
        padding: 20px;
    }
    .content-nav{
        padding-bottom: 15px;
    }
    .content-main{

    }
    .main-header{
        margin: 15px 0;
    }
    .main-page{
        margin: 15px 0;
    }
</style>
<script type="text/ecmascript-6">
    export default {
        data() {
            return {
                routerState: true,
                pathName: '文章列表',
                pathNameParent: '文章管理',
                pathParent: '/posts'
            };
        },
        watch: {
            '$route'(to, from){
                this.pathName = to.name;
                this.pathNameParent = to.matched[0].name;
                this.pathParent = to.matched[0].path;
            }
        },
        methods: {
            logout: function () {
                var _this = this;
                this.$confirm("确认退出么？", '提示', {}).then(() => {
                    _this.axios.post('/logout').then(function (response) {
                        let data = response.data;
                        if(data.status == 200){
                            sessionStorage.removeItem('lemon');
                            _this.$message({
                                message: data.msg,
                                type: 'success',
                                duration: 2000
                            });
                            setTimeout(function () {
                                _this.$router.replace('/login');
                            }, 2000)
                        }else {
                            _this.$message.error('退出失败');
                        }
                    }).catch(function (error) {
                        _this.$message.error('退出失败');
                        console.log(error);
                    })
                })
            },
            checklogin: function () {
                let _this = this;
                let user = JSON.parse(sessionStorage.getItem('lemon'));
                if(!user){
                    _this.$router.push({path: '/login'});
                }
                _this.axios.post('/check').then(function (response) {
                    let res = response.data;
                    if(!res.status){
                        sessionStorage.removeItem('lemon');
                        _this.$router.push({path: '/login'});
                    }
                })
            }
        },
        created: function () {
            this.checklogin();
        }
    }
</script>