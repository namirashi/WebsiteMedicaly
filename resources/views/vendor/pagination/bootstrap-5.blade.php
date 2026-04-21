@if ($paginator->hasPages())
<nav>
    <ul class="pagination justify-content-center" style="gap:4px;">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link" style="border-radius:8px;border:none;background:#f0f0f0;color:#aaa;padding:0.45rem 0.9rem;">
                    <i class="bi bi-chevron-left"></i>
                </span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}"
                   style="border-radius:8px;border:2px solid #eef2f2;color:var(--teal);padding:0.45rem 0.9rem;font-weight:600;transition:all 0.2s;">
                    <i class="bi bi-chevron-left"></i>
                </a>
            </li>
        @endif

        {{-- Pages --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="page-item disabled">
                    <span class="page-link" style="border-radius:8px;border:none;background:transparent;color:#aaa;">{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <span class="page-link"
                                  style="border-radius:8px;border:none;background:var(--teal);color:white;padding:0.45rem 0.85rem;font-weight:700;">
                                {{ $page }}
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $url }}"
                               style="border-radius:8px;border:2px solid #eef2f2;color:#555;padding:0.45rem 0.85rem;font-weight:600;transition:all 0.2s;"
                               onmouseover="this.style.background='var(--teal-light)';this.style.color='var(--teal)';"
                               onmouseout="this.style.background='white';this.style.color='#555';">
                                {{ $page }}
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}"
                   style="border-radius:8px;border:2px solid #eef2f2;color:var(--teal);padding:0.45rem 0.9rem;font-weight:600;transition:all 0.2s;">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" style="border-radius:8px;border:none;background:#f0f0f0;color:#aaa;padding:0.45rem 0.9rem;">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </li>
        @endif

    </ul>
</nav>
@endif