@extends('layouts.app')

@section('title', $categoryName . ' - ShopLink')

@section('content')
    <!-- Partials Container -->
    <div id="dynamic-content">
        @include('category.partials.header')

        <!-- Category Navigation -->
        <div class="container mx-auto px-4 mb-12 relative group">
            <!-- Scroll Left Button -->
            <button id="scroll-left"
                class="absolute left-0 md:-left-4 top-1/2 -translate-y-1/2 z-20 bg-white shadow-lg border border-gray-100 rounded-full w-10 h-10 flex items-center justify-center text-gray-600 hover:text-primary hover:scale-110 transition opacity-0 group-hover:opacity-100 disabled:opacity-0 cursor-pointer hidden md:flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>

            <!-- Scroll Right Button -->
            <button id="scroll-right"
                class="absolute right-0 md:-right-4 top-1/2 -translate-y-1/2 z-20 bg-white shadow-lg border border-gray-100 rounded-full w-10 h-10 flex items-center justify-center text-gray-600 hover:text-primary hover:scale-110 transition opacity-0 group-hover:opacity-100 disabled:opacity-0 cursor-pointer hidden md:flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>

            <div id="category-nav-container"
                class="flex items-center gap-3 overflow-x-auto pb-4 no-scrollbar -mx-4 px-4 md:mx-0 md:px-0 scroll-smooth"
                style="-webkit-overflow-scrolling: touch;">
                <!-- 'All' Link -->
                <a href="{{ route('categories.index') }}"
                    class="flex-shrink-0 flex items-center gap-2 px-5 py-3 rounded-full bg-white border border-gray-100 shadow-sm hover:shadow-md hover:border-primary/20 transition group">
                    <div
                        class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-primary/10 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-3.5 h-3.5 text-gray-500 group-hover:text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                        </svg>
                    </div>
                    <span class="font-bold text-gray-600 text-sm whitespace-nowrap group-hover:text-primary">All
                        Categories</span>
                </a>

                <!-- Categories Loop -->
                @foreach ($categories as $cat)
                    @php $isActive = $cat->id === $category->id; @endphp
                    <a href="{{ route('category.show', $cat->slug) }}" data-id="{{ $cat->id }}"
                        class="category-link flex-shrink-0 flex items-center gap-2 px-5 py-3 rounded-full transition shadow-sm hover:shadow-md border
                          {{ $isActive
                              ? 'bg-primary text-white border-primary ring-2 ring-primary/20 ring-offset-2 active'
                              : 'bg-white text-gray-600 border-gray-100 hover:border-primary/20' }}">

                        <div class="w-6 h-6 rounded-full flex items-center justify-center overflow-hidden bg-white/10">
                            <img src="{{ $cat->icon_url }}"
                                class="w-full h-full object-contain {{ $isActive ? 'brightness-0 invert' : '' }}">
                        </div>

                        <span class="font-bold text-sm whitespace-nowrap {{ $isActive ? 'text-white' : 'text-gray-600' }}">
                            {{ $cat->name }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        @include('category.partials.grid')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.querySelector('#dynamic-content');
            const scrollContainer = document.getElementById('category-nav-container');
            const leftBtn = document.getElementById('scroll-left');
            const rightBtn = document.getElementById('scroll-right');

            // Scroll Logic
            if (scrollContainer && leftBtn && rightBtn) {
                leftBtn.addEventListener('click', () => {
                    scrollContainer.scrollBy({
                        left: -200,
                        behavior: 'smooth'
                    });
                });

                rightBtn.addEventListener('click', () => {
                    scrollContainer.scrollBy({
                        left: 200,
                        behavior: 'smooth'
                    });
                });
            }

            // Delegate event listener for category links
            container.addEventListener('click', (e) => {
                const link = e.target.closest('.category-link');
                if (!link) return;

                e.preventDefault();
                const url = link.href;
                const catId = link.getAttribute('data-id');

                // Visual feedback immediate
                updateNavStyles(catId);

                // Fetch new content
                fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update Header
                        const headerContainer = document.getElementById('category-header');
                        if (headerContainer) {
                            headerContainer.outerHTML = data.header;
                        }

                        // Update Grid
                        const productsGrid = document.getElementById('products-grid');
                        if (productsGrid) {
                            productsGrid.outerHTML = data.grid;
                        }

                        // Update URL and Title
                        window.history.pushState({
                            path: url
                        }, '', url);
                        document.title = data.title;
                    })
                    .catch(err => {
                        console.error('Navigation failed', err);
                        window.location.href = url; // Fallback
                    });
            });

            function updateNavStyles(activeId) {
                document.querySelectorAll('.category-link').forEach(el => {
                    const isActive = el.getAttribute('data-id') == activeId;
                    const img = el.querySelector('img');
                    const span = el.querySelector('span');

                    if (isActive) {
                        el.className =
                            'category-link flex-shrink-0 flex items-center gap-2 px-5 py-3 rounded-full transition shadow-sm hover:shadow-md border bg-primary text-white border-primary ring-2 ring-primary/20 ring-offset-2 active';
                        if (img) img.classList.add('brightness-0', 'invert');
                        if (span) {
                            span.classList.remove('text-gray-600');
                            span.classList.add('text-white');
                        }
                    } else {
                        el.className =
                            'category-link flex-shrink-0 flex items-center gap-2 px-5 py-3 rounded-full transition shadow-sm hover:shadow-md border bg-white text-gray-600 border-gray-100 hover:border-primary/20';
                        if (img) img.classList.remove('brightness-0', 'invert');
                        if (span) {
                            span.classList.add('text-gray-600');
                            span.classList.remove('text-white');
                        }
                    }
                });
            }

            // Handle Back Button
            window.addEventListener('popstate', () => {
                location.reload();
            });
        });
    </script>
@endsection
