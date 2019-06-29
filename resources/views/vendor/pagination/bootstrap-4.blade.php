@if ($paginator->hasPages())
    <ul class="flex items-center list-none -mt-px" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="-ml-px bg-gray-100 border border-gray-400 font-medium inline-block px-3 py-2 rounded-bl rounded-tl text-gray-800 text-xs" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="-ml-px bg-gray-100 border border-gray-400 font-medium inline-block px-3 py-2 rounded-bl rounded-tl text-gray-800 text-xs" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="text-xs text-gray-800 bg-gray-100 font-medium border border-gray-400 px-3 py-2 inline-block -ml-px">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li aria-current="page"><span class="text-xs text-gray-800 font-medium border border-gray-400 px-3 py-2 inline-block -ml-px bg-white">{{ $page }}</span></li>
                    @else
                        <li><a class="text-xs text-gray-800 bg-gray-100 font-medium border border-gray-400 px-3 py-2 inline-block -ml-px" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="text-xs text-gray-800 bg-gray-100 font-medium border border-gray-400 rounded-br rounded-tr px-3 py-2 inline-block -ml-px" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="text-xs text-gray-800 bg-gray-100 font-medium border border-gray-400 rounded-br rounded-tr px-3 py-2 inline-block -ml-px" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
