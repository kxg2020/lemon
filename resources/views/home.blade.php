@extends('layouts.app')

@section('content')
    @if($posts)
        @foreach($posts as $post)
            <article id="{{$post['id']}}" class="post">
                <div class="post-head">
                    <h1 class="post-title"><a class="coral" href="{{route('post', ['id' => $post['id']])}}">{{$post['title']}}</a></h1>
                    <div class="post-meta">
                        <span class="author"></span>
                        <time class="post-date" datetime="{{$post['created_at']}}" title="{{$post['created_at']}}">{{$post['created_at']}}</time>
                    </div>
                </div>
                <div class="post-content">
                    <p>{{mb_substr(strip_tags($post['content']), 0, 200, 'utf-8')}}</p>
                </div>
                <div class="post-permalink">
                    <a href="{{route('post', ['id' => $post['id']])}}" class="btn btn-default">阅读全文</a>
                </div>

                <footer class="post-footer clearfix">
                    <div class="pull-left tag-list">
                        <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                        <!--tags-->
                        <span>分类：<a class="coral" href="{{route('category', ['cat_id' => $post['cat_id']])}}">{{$post['category']['cat_name']}}</a></span>
                    </div>
                    <div class="pull-left tag-list">
                        <span class="glyphicon glyphicon-tags" aria-hidden="true"></span>
                        <!--tags-->
                        <span>标签：
                            @foreach($post['tags'] as $tag)
                                <a class="coral" href="{{route('tag', ['id' => $tag['id']])}}">{{$tag['tag_name']}}</a>
                            @endforeach
                        </span>
                    </div>
                    <div class="pull-right share">
                        <!--share-->
                    </div>
                </footer>
            </article>
        @endforeach
    @else
        <h1 >抱歉！！！没有内容</h1>
    @endif
@endsection