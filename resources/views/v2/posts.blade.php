@extends('v2.index')

@section('content')
  @if(isset($tag_name) && !empty($tag_name))
    <div class="posts-search">
      <span>标签: {{$tag_name}}</span>
    </div>
  @endif
  @if(isset($cat_name) && !empty($cat_name))
    <div class="posts-search">
      <span>分类: {{$cat_name}}</span>
    </div>
  @endif
  <div class="posts" id="posts" style="min-height: 600px; width: 100%;">
    @if(count($posts) > 0)
      @foreach($posts as $post)
        <div class="post">
          <h2 class="post-title"><a href="{{route('post', ['slug' => $post['slug'], 'id' => $post['id']])}}">{{$post['title']}}</a></h2>
          <div class="post-meta">
            <span class="author"></span>
            <time>{{$post['created_at']}}</time>
          </div>
          <div class="post-intro">{{$post['intro']}}</div>
          <div class="post-footer">
            <div class="post-tags">
              <span><i class="ion-folder"></i>分类</span>
              <span class="coral"><a href="{{route('category', ['cat_name' => $post['category']['cat_name']])}}"><code>{{$post['category']['cat_name']}}</code></a></span>
              <span><i class="ion-pricetags"></i>标签</span>
              @foreach($post['tags'] as $tag)
                <span class="coral"><a href="{{route('tag', ['tag_name' => $tag['tag_name']])}}"><code>{{$tag['tag_name']}}</code></a></span>
              @endforeach
            </div>
            <button class="readall lemon-btn"><a href="{{route('post', ['slug' => $post['slug'], 'id' => $post['id']])}}">阅读全文</a></button>
          </div>
        </div>
    @endforeach
      {{ $posts->links() }}
  @else
    @component('vendor.empty')
    @endcomponent
  @endif
  </div>
@endsection