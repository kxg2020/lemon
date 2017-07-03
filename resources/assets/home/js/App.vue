<template>
    <div id="app">
        <el-row>
            <el-col :span="24" class="nav" style="background: #324157;">
                <el-menu theme="dark" :default-active="activeIndex" class="el-menu-demo" mode="horizontal" @select="handleSelect" style="float: right;border-radius: 0;">
                    <el-menu-item index="1">处理中心</el-menu-item>
                    <el-submenu index="2">
                        <template slot="title">我的工作台</template>
                        <el-menu-item index="2-1">选项1</el-menu-item>
                        <el-menu-item index="2-2">选项2</el-menu-item>
                        <el-menu-item index="2-3">选项3</el-menu-item>
                    </el-submenu>
                </el-menu>
            </el-col>

            <el-col :span="24">
                <el-col :span="3" class="menu">
                    <el-menu default-active="2" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" theme="dark" style="border-radius: 0;" :router="routerState">
                        <template v-for="(item, index) in $router.options.routes" v-if="!item.hidden">
                            <el-menu-item :index="item.path">{{item.name}}</el-menu-item>
                        </template>
                    </el-menu>
                </el-col>
                <el-col :span="21" class="content">
                        <router-view></router-view>
                </el-col>
            </el-col>
        </el-row>
    </div>
</template>
<style>
    body{
        margin: 0;
        padding: 0;
        height: 100%;
    }
    #app{
        position: absolute;
        top: 0;
        bottom: 0;
        width: 100%;
    }
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
        padding: 10px;
    }

</style>
<script type="text/ecmascript-6">
    export default {
        data() {
            return {
                activeIndex: '1',
                activeIndex2: '1',
                routerState: true
            };
        },
        methods: {
            handleSelect(key, keyPath) {
                console.log(key, keyPath);
            },
            handleOpen() {

            },
            handleClose() {

            }
        }
    }
</script>