<template>
    <div class="wh100">
        <div class="appbar" :class="navHidden ? 'nav-hidden-appbar' : ''">
            <div class="left">
                <button @click="changeNavStatus" class="icon-button" style="height: 64px"><i class="ion-navicon-round"></i></button>
            </div>
            <div class="center">
                <span>{{pathName}}</span>
            </div>
            <div class="right">
                <el-menu
                        class="el-menu-demo"
                        mode="horizontal"
                        background-color="#545c64"
                        text-color="#FFF"
                        active-text-color="#FFF"
                >
                    <el-menu-item index="1" href="/">首页</el-menu-item>
                    <el-submenu index="2">
                        <template slot="title">Lemon</template>
                        <el-menu-item @click.native="logout" index="2-1" style="min-width: unset;">退出</el-menu-item>
                    </el-submenu>
                </el-menu>
            </div>
        </div>
        <div class="paper" :class="navHidden ? '' : 'open-paper'">
            <div class="paper-herder">
                <span>Lemon</span>
            </div>
            <div class="paper-menu">
                <el-scrollbar style="position: absolute;top: 64px;bottom: 0;width: 256px;">
                    <el-menu default-active="/main" class="el-menu-vertical-demo"   theme="dark" style="border-radius: 0;" :router="routerState" :unique-opened="true">
                        <template v-for="(item, index) in $router.options.routes" v-if="item.children">
                            <template v-if="item.leaf">
                                <el-submenu :index="index + ''">
                                    <template slot="title"><i :class="item.icon" style="padding-right: 10px"></i>{{item.name}}</template>
                                    <el-menu-item-group>
                                        <template v-for="(menu, index2) in item.children" v-if="!menu.hidden">
                                            <el-menu-item :index="menu.path" >{{menu.name}}</el-menu-item>
                                        </template>
                                    </el-menu-item-group>
                                </el-submenu>
                            </template>
                            <template v-else>
                                <el-menu-item :index="item.children[0].path" ><i :class="item.children[0].icon" style="padding-right: 10px"></i>{{item.children[0].name}}</el-menu-item>
                            </template>
                        </template>
                    </el-menu>
                </el-scrollbar>
            </div>
        </div>
        <div class="example" :class="navHidden ? 'nav-hidden-example' : ''">
            <el-scrollbar class="example-scrollbar">
                <el-row class="example-main wh100">
                    <router-view v-on:newWidthChang="widthChange"></router-view>
                </el-row>
            </el-scrollbar>
        </div>
    </div>
</template>
<style>
    .appbar{
        height: 64px;
        position: absolute;
        left: 256px;
        right:  0;
        top: 0;
        width: auto;
        color: #fff;
        background-color: #545c64;
        z-index: 3;
        transition-duration: .45s;
        display: flex;
        justify-content: space-between;
    }
    .appbar .left{
        display: flex;
        height: 100%;
    }
    .appbar .center{
        display: flex;
        height: 100%;
        font-size: 24px;
        line-height: 64px;
        flex: 1;
    }
    .appbar .right{
        display: flex;
        height: 100%;
    }
    .nav-hidden-appbar{
        left: 0;
        transform: translateZ(0);
    }
    .el-menu-demo{
        border-bottom: none;
    }
    .el-menu-demo .is-active{
        background-color: #2d2f33;
        border-bottom: none !important;
    }
    .el-menu--horizontal .el-menu-item{
        height: 64px;
    }
    .paper{
        position: absolute;
        width: 256px;
        top: 0;
        bottom: 0;
        left: 0;
        overflow: auto;
        box-shadow: 0 1px 6px rgba(0,0,0,.117647), 0 1px 4px rgba(0,0,0,.117647);
        z-index: 4;
        /*transition-property: transform,visibility,-webkit-transform;*/
        transition-duration: .45s;
        transform: translate3d(-256px, 0, 0);
        visibility: hidden;
    }
    .open-paper{
        transform: translateZ(0);
        visibility: visible;
    }
    .paper::-webkit-scrollbar {
        display: none!important;
        width: 0!important;
        height: 0!important;
        -webkit-appearance: none;
        opacity: 0!important;
    }
    .paper-herder{
        height: 64px;
        display: flex;
        width: 100%;
        color: #fff;
        background-color: #545c64;
        z-index: 3;
        font-size: 24px;
        line-height: 64px;
        padding: 0 16px;
    }
    .paper-menu{
        padding: 8px 0;
        width: 100%;
    }
    .example{
        position: absolute;
        top: 64px;
        left: 256px;
        right: 0;
        bottom: 0;
        transition-duration: .45s;
    }
    .nav-hidden-example{
        left: 0;
        transform: translateZ(0);
    }
    .example-scrollbar{
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }
    .example-main{
        padding: 20px;
    }
    .el-menu {
        border-right: none;
    }
    .el-scrollbar__wrap{
        overflow-x: auto;
    }
    .el-select-dropdown__wrap{
        overflow: scroll;
    }
</style>
<script type="text/ecmascript-6">
    export default {
        data() {
            return {
                navHidden: false,
                routerState: true,
                pathName: '主页',
                pathNameParent: '',
                pathParent: '/posts'
            }
        },
        watch: {
            '$route'(to, from){
                this.pathName = to.name
                this.pathNameParent = to.matched[0].name
                this.pathParent = to.matched[0].path
            }
        },
        created: function () {
            this.checklogin()
            this.widthChange(document.documentElement.clientWidth)
            let that = this
            window.onresize = function () {
                that.widthChange(document.documentElement.clientWidth)
            }
        },
        methods: {
            logout: function () {
                var _this = this
                this.$confirm("确认退出么？", '提示', {}).then(() => {
                    _this.axios.post('/logout').then(function (response) {
                        let data = response.data
                        if(data.status == 200){
                            sessionStorage.removeItem('lemon')
                            _this.$notify({
                                title: 'success',
                                message: data.msg,
                                type: 'success',
                                duration: 2000
                            })
                            setTimeout(function () {
                                _this.$router.replace('/login')
                            }, 2000)
                        }else {
                            _this.$notify({
                                title: 'error',
                                message: '退出失败',
                                type: 'error'
                            })
                        }
                    }).catch(function (error) {
                        _this.$notify({
                            title: 'error',
                            message: '退出失败',
                            type: 'error'
                        })
                        console.log(error);
                    })
                })
            },
            checklogin: function () {
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
                    }
                })
            },
            changeNavStatus() {
                this.navHidden = !this.navHidden
            },
            widthChange (width) {
                if (width <= 996) {
                    this.navHidden = true
                } else {
                    this.navHidden = false
                }
            }
        }
    }
</script>