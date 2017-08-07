@extends('layouts.app')

@section('content')
    <article id="{{$post['id']}}" class="post">
        <heder class="post-head">
            <h1 class="post-title coral">{{$post['title']}}</h1>
            <div class="post-meta">
                <span class="author"></span>
                <time class="post-date" datetime="{{$post['created_at']}}" title="{{$post['created_at']}}">{{$post['created_at']}}</time>
            </div>
        </heder>
        <div class="post-content">
            <div class="markdown">
                {!! $post['content'] !!}
            </div>
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
@endsection