@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')" >
                <a href=""><i class="fa fa-angle-left"></i>{{ __('frontend.lable.preview_page') }}</a>
            </li>
        @else
            <li rel="prev" aria-label="@lang('pagination.previous')" >
                <a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left"></i>{{ __('frontend.lable.preview_page') }}</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true">{{ $element }}</li>
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page">{{ $page }}</li>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li>
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    {{ __('frontend.lable.next_page') }}<i class="fa fa-angle-right"></i> </a>
            </li>
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    {{ __('frontend.lable.next_page') }}<i class="fa fa-angle-right"></i> </a>
            </li>
        @endif
    </ul>
@endif