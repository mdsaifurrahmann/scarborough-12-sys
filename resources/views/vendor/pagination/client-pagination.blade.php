@if ($paginator->hasPages())
    <nav class="">
        <div class="">
            <ul class="pagination-wrap mt-50">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="disabled" aria-disabled="true">
                        <a class="page-link"><i class="fa-regular fa-chevrons-left"></i></a>
                    </li>
                @else
                    <li class="">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa-regular
                        fa-chevrons-left"></i></a>
                    </li>
                @endif


                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="" aria-current="page"><a class="page-link active">{{ $page }}</a></li>
                            @else
                                <li class=""><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="">
                        <a class="" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa-regular fa-chevrons-right"></i></a>
                    </li>
                @else
                    <li class="disabled" aria-disabled="true">
                        <a class="page-link"><i class="fa-regular fa-chevrons-right"></i></a>
                    </li>
                @endif
            </ul>

            <p class="small text-secondary mt-3">
                {!! __('Showing') !!}
                <span class="fw-semibold">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="fw-semibold">{{ $paginator->lastItem() }}</span>
                {!! __('of') !!}
                <span class="fw-semibold">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>

        {{--        <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">--}}
        {{--            <div>--}}
        {{--                <p class="small text-secondary">--}}
        {{--                    {!! __('Showing') !!}--}}
        {{--                    <span class="fw-semibold">{{ $paginator->firstItem() }}</span>--}}
        {{--                    {!! __('to') !!}--}}
        {{--                    <span class="fw-semibold">{{ $paginator->lastItem() }}</span>--}}
        {{--                    {!! __('of') !!}--}}
        {{--                    <span class="fw-semibold">{{ $paginator->total() }}</span>--}}
        {{--                    {!! __('results') !!}--}}
        {{--                </p>--}}
        {{--            </div>--}}

        {{--            <div>--}}
        {{--                <ul class="pagination">--}}
        {{--                    --}}{{-- Previous Page Link --}}
        {{--                    @if ($paginator->onFirstPage())--}}
        {{--                        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
        {{--                            <span class="page-link" aria-hidden="true">&lsaquo;</span>--}}
        {{--                        </li>--}}
        {{--                    @else--}}
        {{--                        <li class="">--}}
        {{--                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"--}}
        {{--                               aria-label="@lang('pagination.previous')">&lsaquo;</a>--}}
        {{--                        </li>--}}
        {{--                    @endif--}}

        {{--                    --}}{{-- Pagination Elements --}}
        {{--                    @foreach ($elements as $element)--}}
        {{--                        --}}{{-- "Three Dots" Separator --}}
        {{--                        @if (is_string($element))--}}
        {{--                            <li class="disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>--}}
        {{--                        @endif--}}

        {{--                        --}}{{-- Array Of Links --}}
        {{--                        @if (is_array($element))--}}
        {{--                            @foreach ($element as $page => $url)--}}
        {{--                                @if ($page == $paginator->currentPage())--}}
        {{--                                    <li class="" aria-current="page"><span class="page-link active">{{ $page }}</span></li>--}}
        {{--                                @else--}}
        {{--                                    <li class=""><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>--}}
        {{--                                @endif--}}
        {{--                            @endforeach--}}
        {{--                        @endif--}}
        {{--                    @endforeach--}}

        {{--                    --}}{{-- Next Page Link --}}
        {{--                    @if ($paginator->hasMorePages())--}}
        {{--                        <li class="page-item">--}}
        {{--                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>--}}
        {{--                        </li>--}}
        {{--                    @else--}}
        {{--                        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
        {{--                            <span class="page-link" aria-hidden="true">&rsaquo;</span>--}}
        {{--                        </li>--}}
        {{--                    @endif--}}
        {{--                </ul>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </nav>
@endif
