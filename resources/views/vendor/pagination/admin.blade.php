@if ($paginator->hasPages())
<nav class="pagination" aria-label="Pagination">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span style="opacity:.4;cursor:default;padding:6px 10px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px;">‹</span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" style="padding:6px 10px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px;text-decoration:none;color:#374151;" rel="prev">‹</a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span style="padding:6px 10px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px;color:#9ca3af;">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span style="padding:6px 12px;border-radius:6px;font-size:13px;background:#FF6B35;color:#fff;border:1px solid #FF6B35;">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" style="padding:6px 12px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px;text-decoration:none;color:#374151;">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" style="padding:6px 10px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px;text-decoration:none;color:#374151;" rel="next">›</a>
    @else
        <span style="opacity:.4;cursor:default;padding:6px 10px;border:1px solid #e5e7eb;border-radius:6px;font-size:13px;">›</span>
    @endif

    <span style="font-size:12px;color:#9ca3af;margin-left:8px;">
        Cəmi {{ $paginator->total() }} | Səhifə {{ $paginator->currentPage() }}/{{ $paginator->lastPage() }}
    </span>
</nav>
@endif
