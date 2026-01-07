@extends('layouts.product')

@section('title', 'All Products - ShopLink')

@section('product-title', 'All Products')
@section('product-subtitle', 'Browse our complete collection of fresh groceries and essentials')

@section('product-content')
    <div x-data="infiniteScroll()">
        @if ($products->count() > 0)
            <div id="products-container" class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    @include('products.partials.card', ['product' => $product])
                @endforeach
            </div>

            {{-- Loading Indicator --}}
            <div x-show="loading" class="flex justify-center py-8">
                <div class="flex items-center gap-3 text-gray-500">
                    <svg class="animate-spin w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    <span>Loading more products...</span>
                </div>
            </div>

            {{-- End of Results --}}
            <div x-show="!hasMore && !loading" class="text-center py-8 text-gray-400">
                <p>You've seen all <span x-text="totalProducts"></span> products! 🎉</p>
            </div>

            {{-- Scroll Trigger --}}
            <div x-intersect="loadMore" class="h-4"></div>
        @else
            {{-- No Products Fallback --}}
            <div class="p-12 text-center">
                <div class="w-24 h-24 mx-auto mb-6 text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                        stroke="currentColor" class="w-full h-full">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-700 mb-2">No products available yet</h3>
                <p class="text-gray-400 max-w-md mx-auto">Our shelves are being stocked with fresh products. Check
                    back soon!</p>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        function infiniteScroll() {
            return {
                loading: false,
                hasMore: {{ $products->hasMorePages() ? 'true' : 'false' }},
                nextPage: {{ $products->hasMorePages() ? $products->currentPage() + 1 : 'null' }},
                totalProducts: {{ $products->total() }},

                async loadMore() {
                    if (this.loading || !this.hasMore) return;

                    this.loading = true;

                    try {
                        const response = await fetch(`{{ route('products.index') }}?page=${this.nextPage}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();

                        // Append new products
                        const container = document.getElementById('products-container');
                        container.insertAdjacentHTML('beforeend', data.html);

                        // Reinitialize Alpine.js on new elements
                        Alpine.initTree(container);

                        // Update state
                        this.nextPage = data.nextPage;
                        this.hasMore = data.nextPage !== null;
                        this.totalProducts = data.total;

                    } catch (error) {
                        console.error('Failed to load more products:', error);
                    }

                    this.loading = false;
                }
            }
        }
    </script>
@endpush
