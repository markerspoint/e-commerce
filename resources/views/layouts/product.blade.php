@extends('layouts.app')

@section('hide-footer', true)
@section('main-class', '')

@section('content')
    {{-- Full height container that fills remaining viewport --}}
    <div class="h-[calc(100vh-5rem)] flex flex-col overflow-hidden" x-data="productFilter()">

        {{-- Page Header (Fixed, doesn't scroll) --}}
        <div class="container mx-auto px-4 py-6 shrink-0">
            <h1 class="text-3xl md:text-4xl font-extrabold text-primary mb-1">@yield('product-title', 'ShopLink Products')</h1>
            <p class="text-gray-500">@yield('product-subtitle', 'Browse our collection')</p>
        </div>

        {{-- Main Content Area (Sidebar + Scrollable Grid) --}}
        <div class="container mx-auto px-4 pb-4 flex-1 flex flex-col lg:flex-row gap-6 overflow-hidden">

            {{-- SIDEBAR (Fixed, doesn't scroll with content) --}}
            <aside
                class="lg:w-64 shrink-0 overflow-y-auto no-scrollbar rounded-2xl shadow-xl border border-gray-100 bg-white mt-4">
                <div class="p-6">
                    <h3 class="font-bold text-lg text-primary mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li>
                            <button @click="filterByCategory(null)"
                                :class="selectedCategory === null ? 'bg-primary text-white' : 'hover:bg-gray-50 text-gray-700'"
                                class="w-full flex items-center justify-between p-3 rounded-xl transition">
                                <span>All Products</span>
                                <span :class="selectedCategory === null ? 'text-white/70' : 'text-gray-400'"
                                    class="text-sm">
                                    {{ $totalProductCount }}
                                </span>
                            </button>
                        </li>
                        @foreach ($sidebarCategories as $cat)
                            <li>
                                <button @click="filterByCategory('{{ $cat->slug }}')"
                                    :class="selectedCategory === '{{ $cat->slug }}' ? 'bg-primary text-white' :
                                        'hover:bg-gray-50 text-gray-700'"
                                    class="w-full flex items-center justify-between p-3 rounded-xl transition">
                                    <span>{{ $cat->name }}</span>
                                    <span
                                        :class="selectedCategory === '{{ $cat->slug }}' ? 'text-white/70' : 'text-gray-400'"
                                        class="text-sm">
                                        {{ $cat->products_count }}
                                    </span>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            {{-- SCROLLABLE PRODUCT GRID (Only this area scrolls) --}}
            <div class="flex-1 overflow-y-auto rounded-xl pr-2 pt-4 no-scrollbar" id="product-scroll-container">
                {{-- Loading overlay --}}
                <div x-show="loading" class="flex justify-center items-center py-12">
                    <div class="flex items-center gap-3 text-gray-500">
                        <svg class="animate-spin w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <span>Loading products...</span>
                    </div>
                </div>

                {{-- Product content --}}
                <div x-show="!loading">
                    @yield('product-content')
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function productFilter() {
            return {
                selectedCategory: @json(request('category')),
                loading: false,

                async filterByCategory(categorySlug) {
                    if (this.selectedCategory === categorySlug) return;

                    this.selectedCategory = categorySlug;
                    this.loading = true;

                    // Update URL without reloading
                    const url = new URL(window.location);
                    if (categorySlug) {
                        url.searchParams.set('category', categorySlug);
                    } else {
                        url.searchParams.delete('category');
                    }
                    window.history.pushState({}, '', url);

                    try {
                        const response = await fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        // Update the product container
                        const container = document.getElementById('products-container');
                        if (container) {
                            container.innerHTML = data.html;
                            Alpine.initTree(container);
                        }

                        // Scroll to top of product grid
                        document.getElementById('product-scroll-container').scrollTop = 0;

                    } catch (error) {
                        console.error('Failed to filter products:', error);
                    }

                    this.loading = false;
                }
            }
        }
    </script>
@endpush
