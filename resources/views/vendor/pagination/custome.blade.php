
@if ($paginator->hasPages())
<div class="pagination-wrapper">
  <div class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <!-- <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li> -->
                   <span aria-hidden="true" class="prev page-numbers disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">&lsaquo;</span>
                
            @else
                <!-- <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li> -->
                
                <a class="prev page-numbers" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <!-- <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li> -->
                    <span class="disabled" aria-disabled="true">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <!-- <li class="active" aria-current="page"><span>{{ $page }}</span></li> -->
                            <span aria-current="page" class="page-numbers current active">{{ $page }}</span>
                        @else
                            <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                            <!-- <li><a href="{{ $url }}">{{ $page }}</a></li> -->
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <a class="next page-numbers" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>    
            <!-- <li>
                
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li> -->
            @else
            <span class="next page-numbers disabled" aria-hidden="true" aria-disabled="true" aria-label="@lang('pagination.next')">&rsaquo;</span>
                <!-- <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li> -->
            @endif
</div>
</div>
@endif