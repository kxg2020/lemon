@extends('v2.index')

@section('content')
  <div class="posts" id="posts" style="min-height: 600px; width: 100%;">
    @if(count($posts) > 0)
      @foreach($posts as $post)
        <div class="post">
          <h2 class="post-title">{{$post['title']}}</h2>
          <div class="post-meta">
            <span class="author"></span>
            <time>{{$post['created_at']}}</time>
          </div>
          <div class="post-intro">{{$post['intro']}}</div>
          <div class="post-footer">
            <div class="post-tags">
              <span><i class="ion-folder"></i>分类</span>
              <span class="coral"><code>{{$post['category']['cat_name']}}</code></span>
              <span><i class="ion-pricetags"></i>标签</span>
              @foreach($post['tags'] as $tag)
                <span class="coral"><code>{{$tag['tag_name']}}</code></span>
              @endforeach
            </div>
            <button class="readall"><a href="{{route('post', ['slug' => $post['slug'], 'id' => $post['id']])}}">阅读全文</a></button>
          </div>
        </div>
    @endforeach
  @else
    @component('vendor.empty')
    @endcomponent
  @endif
  </div>
@endsection