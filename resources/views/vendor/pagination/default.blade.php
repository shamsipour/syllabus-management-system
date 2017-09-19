@if ($paginator->hasPages())
    <div class="btn-group btn-group-sm">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="btn btn-raised"><span>&laquo; قبلی </span></a>
        @else
            <a class="btn btn-raised" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; قبلی </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <a class="btn btn-raised disabled"><span>{{ $element }}</span></a>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="btn btn-raised btn-info"><span>{{ $page }}</span></a>
                    @else
                        <a class="btn btn-raised" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="btn btn-raised" href="{{ $paginator->nextPageUrl() }}" rel="next"> بعدی &raquo;</a>
        @else
            <button type="button" class="btn btn-raised"><span> بعدی &raquo;</span></button>
        @endif
    </div>
@endif
