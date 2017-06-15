<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .user{
            margin: 0;
            padding: 0;
        }
        .user li{
            display: block;
            text-align: center;
        }
        .user li img{
            height: 100px;
            width: 100px;
            border-radius: 50px;
        }
        .nav li {
            font-size: 14px;
        }
        .nav li a span{
            margin-left: 10px;
            margin-right: 20px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Help</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     Login out
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                        </li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-right">
                <input type="text" class="form-control" placeholder="Search...">
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar"> <!--sidebar-->
            <ul class="user">
                <li><img src="./head.jpg" alt=""></li>
                <li><p>admin</p></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li class="active"><a href="#"><span class="ion-ios-speedometer-outline"></span>面板</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-book"></span>文章管理</a></li>
                <li><a href="#"><span class="ion-chatbubble-working"></span>评论管理</a></li>
                <li><a href="#"><span class="ion-ios-folder"></span>文件管理</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href=""><span class="ion-pricetags"></span>标签管理</a></li>
                <li><a href=""><span class="ion-ios-list"></span>分类管理</a></li>
                <li><a href=""><span class="ion-link"></span>友链管理</a></li>
                <li><a href=""><span class="ion-social-freebsd-devil"></span>访问列表</a></li>
                <li><a href=""><span class="ion-settings"></span>系统配置</a></li>
            </ul>
        </div>
        @yield('content')
    </div>
</div>
<div id="app"></div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
