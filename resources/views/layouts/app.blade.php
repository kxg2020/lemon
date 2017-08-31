<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="keywords" content="
        @if($tags)
            @foreach($tags as $tag)
                    {{$tag['tag_name']}},
            @endforeach
        @endif
            lemon
    ">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if(Route::currentRouteName() == 'home')
            首页
        @else
            @if(isset($tag_id))
                文章标签
            @elseif(isset($cat_id))
                文章分类
            @elseif(isset($post))
                {{$post['title']}}
            @endif
        @endif
         - {{ config('app.name', 'Laravel') }}
    </title>

    <!-- Styles -->
    <link href="{{ mix('home/css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
        <header>
            <div class="header-message" id="header-message">
                <div id="header-text" class="header-text"></div>
            </div>
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
                            <li @if(isset($cat_id) && $cat_id == $category['id']) class="active" @endif><a href="{{route('category', ['cat_id' => $category['id']])}}" @if(isset($cat_id) && $cat_id == $category['id'])class="active_content"@endif>{{$category['cat_name']}}</a></li>
                        @endforeach
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        


                    </ul>
                </div>
            </div>
        </nav>
        <div class="content-wrap">
            <div class="container">
                <div class="row">
                    <main class="col-md-8 main-content">
                        @yield('content')
                    </main>
                    <aside class="col-md-4 sidebar">
                        <div class="widget">
                            <h4 class="title">Lemon</h4>
                            <div class="content community">
                                <p></p>
                                <p><a href="javascript:void(0)" title="title" target="_blank" ><i class="fa fa-comments"></i> 玩王者吗 我露娜一打五 </a></p>
                                <p><a href="javascript:void(0)" title="title" target="_blank" ><i class="fa fa-weibo"></i> - </a></p>
                            </div>
                        </div>
                        <div class="widget">
                            <h4 class="title">标签云</h4>
                            <div class="content tag-cloud">
                                @if($tags)
                                    @foreach($tags as $tag)
                                        <a href="@if(isset($tag_id) && $tag_id == $tag['id']) javascript:void(0); @else {{route('tag', ['tag_id' => $tag['id']])}} @endif"
                                           class="@if(isset($tag_id) && $tag_id == $tag['id']) active active_content @endif"
                                        >
                                            <code>{{$tag['tag_name']}}</code>
                                        </a>
                                    @endforeach
                                @else
                                    <p>抱歉！！！没有内容</p>
                                @endif
                            </div>
                        </div>
                        <div class="widget">
                            <h4 class="title">最新文章</h4>
                            <div class="content recent-post">
                                @if($posts_hot)
                                    @foreach($posts_hot as $post_hot)
                                        <div class="recent-single-post">
                                            <a href="{{route('post', ['slug' => $post['slug']])}}" class="new-post-title">{{$post_hot['title']}}</a>
                                            <div class="date">{{$post_hot['created_at']}}</div>
                                        </div>
                                    @endforeach
                                @else
                                    <p>抱歉！！！没有内容</p>
                                @endif
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <p>
                © 2017-2017 Lemon
                |
                <a href="http://www.miitbeian.gov.cn/" target="_blank">蜀ICP备17009035号</a>
                |
                <a href="http://www.qiniu.com" target="_blank">七牛云</a>
            </p>
            </p>
        </footer>
    </div>
    <!-- Scripts -->
    <script>window.Home = {'apiUrl': '{{ e(route('home')) }}', 'csrfToken': '{{e(csrf_token())}}' }</script>
    <script src="{{ mix('home/js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
