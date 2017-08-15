{{--@if ($paginator->hasPages())--}}
    {{--<ul class="pagination">--}}
         {{--Previous Page Link --}}
        {{--@if ($paginator->onFirstPage())--}}
              {{--上一页无内容 --}}
            {{--<li class="disabled"><span>&laquo;</span></li>--}}
        {{--@else--}}
             {{--上一页有内容 --}}
            {{--<li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>--}}
        {{--@endif--}}

         {{--Pagination Elements --}}
        {{--@foreach ($elements as $element)--}}
             {{--"Three Dots" Separator --}}
            {{--@if (is_string($element))--}}
                 {{--只有一页 --}}
                {{--<li class="disabled"><span>{{ $element }}</span></li>--}}
            {{--@endif--}}

             {{--Array Of Links --}}
            {{--@if (is_array($element))--}}
                {{--@foreach ($element as $page => $url)--}}
                    {{--@if ($page == $paginator->currentPage())--}}
                        {{--<li class="active"><span>{{ $page }}</span></li>--}}
                    {{--@else--}}
                        {{--<li><a href="{{ $url }}">{{ $page }}</a></li>--}}
                    {{--@endif--}}
                {{--@endforeach--}}
            {{--@endif--}}
        {{--@endforeach--}}

         {{--Next Page Link --}}
        {{--@if ($paginator->hasMorePages())--}}
            {{--<li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>--}}
        {{--@else--}}
            {{--<li class="disabled"><span>&raquo;</span></li>--}}
        {{--@endif--}}
    {{--</ul>--}}
{{--@endif--}}

@if($paginator->hasPages())
    <nav aria-label="page" style="padding: 0 35px;">
        <ul class="pager">
            @if (!$paginator->onFirstPage())
                {{-- 上一页有内容 --}}
                <li class="previous"><a href="{{ $paginator->previousPageUrl() }}"><span aria-hidden="true">&larr;</span> Older</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="next"><a href="{{ $paginator->nextPageUrl() }}">Newer <span aria-hidden="true">&rarr;</span></a></li>
            @endif
        </ul>
    </nav>
@endif
