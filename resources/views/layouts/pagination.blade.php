@if ($paginator->hasPages())
  <ul class="pagination d-inline-flex">
        @if ($paginator->onFirstPage())
                <li class="page-item disabled"> <span class="page-link" aria-label="Previous">❮ </span></li>
        @else
            <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">❮ </a></li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span  class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">❯</a></li>
        @else
            <li class="page-item disabled"><span aria-label="Next">&nbsp; ❯</span></li>
        @endif
    </ul>
@endif