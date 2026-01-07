@if ($paginator->hasPages())
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 w-full">
        {{-- Showing Results Text --}}
        <div class="text-sm text-gray-500 font-medium">
            Showing
            <span class="text-gray-900 font-bold">{{ $paginator->firstItem() }}</span>
            to
            <span class="text-gray-900 font-bold">{{ $paginator->lastItem() }}</span>
            of
            <span class="text-gray-900 font-bold">{{ $paginator->total() }}</span>
            results
        </div>

        <div class="flex items-center gap-2 bg-gray-50 p-1.5 rounded-xl shadow-sm border border-gray-100">
            @if ($paginator->onFirstPage())
                <span
                    class="px-3 py-2 text-gray-400 cursor-not-allowed bg-transparent rounded-lg flex items-center gap-1 text-sm font-medium">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Prev
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="px-3 py-2 text-gray-600 hover:text-primary hover:bg-white hover:shadow-sm rounded-lg transition flex items-center gap-1 text-sm font-medium group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    Prev
                </a>
            @endif

            <div class="h-6 w-px bg-gray-200 mx-1"></div>

            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-3 py-2 text-gray-400 text-sm font-medium">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span
                                class="w-8 h-8 flex items-center justify-center bg-primary text-white rounded-lg text-sm font-bold shadow-md shadow-primary/20">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}"
                                class="w-8 h-8 flex items-center justify-center text-gray-600 hover:bg-white hover:text-primary hover:shadow-sm rounded-lg text-sm font-medium transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            <div class="h-6 w-px bg-gray-200 mx-1"></div>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="px-3 py-2 text-gray-600 hover:text-primary hover:bg-white hover:shadow-sm rounded-lg transition flex items-center gap-1 text-sm font-medium group">
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4 group-hover:translate-x-0.5 transition-transform">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            @else
                <span
                    class="px-3 py-2 text-gray-400 cursor-not-allowed bg-transparent rounded-lg flex items-center gap-1 text-sm font-medium">
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </span>
            @endif
        </div>
    </div>
@endif
