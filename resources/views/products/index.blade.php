@use('Illuminate\Support\Str')
@extends('layouts.app')

@section('title', 'All Products - ShopLink')

@section('content')
    <div class="container mx-auto px-4 py-8">
        {{-- Page Header --}}
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-primary mb-2">All Products</h1>
            <p class="text-gray-500">Browse our complete collection of fresh groceries and essentials</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Sidebar - Categories Filter --}}
            <aside class="lg:w-64 shrink-0">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 sticky top-24">
                    <h3 class="font-bold text-lg text-primary mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('products.index') }}"
                                class="flex items-center justify-between p-3 rounded-xl transition {{ !request('category') ? 'bg-primary text-white' : 'hover:bg-gray-50 text-gray-700' }}">
                                <span>All Products</span>
                                <span
                                    class="text-sm {{ !request('category') ? 'text-white/70' : 'text-gray-400' }}">{{ $products->total() }}</span>
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('category.show', $category->slug) }}"
                                    class="flex items-center justify-between p-3 rounded-xl hover:bg-gray-50 text-gray-700 transition">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-sm text-gray-400">{{ $category->products_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            {{-- Products Grid --}}
            <div class="flex-1">
                @if ($products->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($products as $product)
                            <div
                                class="bg-white rounded-3xl p-4 shadow-sm hover:shadow-md transition border border-transparent hover:border-gray-100 flex flex-col items-center text-center group h-full">
                                <div class="relative w-3/4 aspect-square mb-4">
                                    <img src="{{ $product->image }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-contain group-hover:scale-110 transition duration-300">
                                </div>
                                <h3 class="font-bold text-primary text-base leading-tight mb-1 line-clamp-2 h-10">
                                    {{ $product->name }}
                                </h3>
                                <p class="text-gray-400 text-xs mb-3">{{ $product->category->name ?? 'Uncategorized' }}</p>

                                <div class="mt-auto w-full" x-data="{ count: 0 }">
                                    <div class="text-3xl font-extrabold text-primary mb-6">
                                        {{ number_format($product->price) }}<span
                                            class="text-base align-top text-gray-400 font-normal">$</span>
                                    </div>

                                    <!-- Add Button -->
                                    @auth
                                        <button x-show="count === 0" @click="count = 1"
                                            class="w-full bg-shop-bg text-primary text-2xl font-light py-2 rounded-xl hover:bg-primary hover:text-white transition flex items-center justify-center shadow-sm">
                                            +
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="w-full bg-shop-bg text-primary text-2xl font-light py-2 rounded-xl hover:bg-primary hover:text-white transition flex items-center justify-center shadow-sm">
                                            +
                                        </a>
                                    @endauth

                                    <!-- Quantity Counter -->
                                    <div x-show="count > 0" x-transition
                                        class="w-full bg-accent text-primary font-bold py-2 rounded-xl flex items-center justify-between px-4 shadow-sm">
                                        <button @click="count > 0 ? count-- : count = 0"
                                            class="w-8 h-8 rounded-full border border-primary flex items-center justify-center hover:bg-white/20 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                            </svg>
                                        </button>
                                        <span x-text="count" class="text-xl"></span>
                                        <button @click="count++"
                                            class="w-8 h-8 rounded-full border border-primary flex items-center justify-center hover:bg-white/20 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-10">
                        {{ $products->links() }}
                    </div>
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
        </div>
    </div>
@endsection
