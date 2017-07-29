<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('home/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('home/css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header style="background-image: url('http://img.it9g.com/milky-way.jpg'); height: 200px">

        </header>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->

                </div>

                <div class="collapse navbar-collapse menu" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li @if(Route::currentRouteName() == 'home') class="active" @endif><a href="/">首页</a></li>
                        @foreach($categorys as $category)
                            <li @if(isset($cat_id) && $cat_id == $category['id']) class="active" @endif><a href="{{route('category', ['cat_id' => $category['id']])}}">{{$category['cat_name']}}</a></li>
                        @endforeach
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        


                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="content-wrap">
        <div class="container">
            <div class="row">
                <main class="col-md-8 main-content">
                    @yield('content')
                </main>
                <aside class="col-md-4 sidebar">
                    <div class="widget">
                        <h4 class="title">XX</h4>
                        <div class="content community">
                            <p>xxxxx</p>
                            <p><a href="/" title="title" target="_blank" ><i class="fa fa-comments"></i> XXXX</a></p>
                            <p><a href="" title="title" target="_blank" ><i class="fa fa-weibo"></i> XXXX</a></p>
                        </div>
                    </div>
                    <div class="widget">
                        <h4 class="title">标签云</h4>
                        <div class="content tag-cloud">
                            <a href="tag/jquery/index.html">jQuery</a>
                            <a href="tag/ghost-0-7-ban-ben/index.html">Ghost 0.7 版本</a>
                            <a href="tag/opensource/index.html">开源</a>
                            <a href="tag/zhu-shou-han-shu/index.html">助手函数</a>
                            <a href="tag/tag-cloud/index.html">标签云</a>
                            <a href="tag/navigation/index.html">导航</a>
                            <a href="tag-cloud/index.html">...</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ mix('home/js/app.js') }}"></script>
</body>
</html>
