<template>
    <div id="app">
        <div class="navbar">
            <div class="container">
                <h1>Title</h1>
                <ul class="flex-row">
                    <li class="nav-item">item</li>
                    <li class="nav-item">item</li>
                    <li class="nav-item">item</li>
                    <li class="nav-item">item</li>
                    <li class="nav-item">item</li>
                </ul>
            </div>
        </div>
        <div class="main">
            <div class="container">
                <div class="breadcrumb">
                    <el-breadcrumb separator="/">
                        <el-breadcrumb-item :to="{ path: '/' }">首页</el-breadcrumb-item>
                        <el-breadcrumb-item><a href="/">活动管理</a></el-breadcrumb-item>
                        <el-breadcrumb-item>活动列表</el-breadcrumb-item>
                        <el-breadcrumb-item>活动详情</el-breadcrumb-item>
                    </el-breadcrumb>
                </div>
                <router-view></router-view>
            </div>
        </div>
        <div class="footer">
            <div class="container">
                <h1>Footer</h1>
            </div>
        </div>
    </div>
</template>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    html, body{
        height: 100%;
    }
    li{
        list-style: none;
    }
    .flex-row{
        display: flex;
        flex-direction: row;
    }
    #app{
        height: 100%;
    }
    .navbar{
        height: 80px;
        color: #656D6D;
        line-height: 80px;
    }
    .navbar .container{
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }
    .nav-item{
        width: 100px;
        text-align: center;
    }
    .nav-item:hover{
        background: rgba(255,255,255,.08);
    }
    .nav-item:nth-last-child(1){
        border-right: 1px solid rgba(255,255,255,.08);
    }
    .main{
        margin-top: -80px;
        padding: 80px 0 100px;
        box-sizing: border-box;
        min-height: 100%;
    }
    .footer{
        background-color: #F7FDFD;
        width: 100%;
        height: 100px;
        padding: 40px auto;
        margin-top: -100px;
        box-sizing: border-box;
    }
    .container {
        margin-right: auto;
        margin-left: auto;
        padding-left: 15px;
        padding-right: 15px;
    }
    @media (min-width: 768px) {
        .container {
            width: 750px;
        }
    }

    @media (min-width: 992px) {
        .container {
            width: 970px;
        }
    }

    @media (min-width: 1200px) {
        .container {
            width: 1200px;
        }
    }

</style>