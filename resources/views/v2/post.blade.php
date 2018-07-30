@extends('v2.index')

@section('content')
  <div id="post" class="post" style="min-height: 600px; width: 100%;">
    <h2 class="post-title">{{$post['title']}}</h2>
    <div class="post-meta">
      <span class="author"></span>
      <time>{{$post['created_at']}}</time>
    </div>
    <div class="post-content markdown">
      {!! $post['content'] !!}
    </div>
    <div class="post-footer">
      <div class="post-tags">
        <span><i class="ion-folder"></i>分类</span>
        <span class="coral"><code>{{$post['category']['cat_name']}}</code></span>
        <span><i class="ion-pricetags"></i>标签</span>
        @foreach($post['tags'] as $tag)
          <span class="coral"><code>{{$tag['tag_name']}}</code></span>
        @endforeach
      </div>
    </div>
    <comment post-id="{{$post['id']}}"></comment>
  </div>
@endsection

@section('scripts')
  <script>
    hljs.initHighlightingOnLoad()
  </script>
@endsection

@section('styles')

@endsection