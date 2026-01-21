@if ($paginator->hasPages())
    <div class="ul-pagination">
        <ul>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <a href="#" class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                        <i class="flaticon-back"></i>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <i class="flaticon-back"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            <li class="pages">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <a href="#" class="disabled" aria-disabled="true">{{ $element }}</a>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <a href="#" class="active" aria-current="page">{{ $page }}</a>
                            @else
                                <a href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </li>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <i class="flaticon-next"></i>
                    </a>
                </li>
            @else
                <li>
                    <a href="#" class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                        <i class="flaticon-next"></i>
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endif
