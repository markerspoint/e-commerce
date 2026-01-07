@extends('layouts.app')

@section('hide-footer', true)
@section('main-class', '')

@section('content')
    {{-- Full height container that fills remaining viewport --}}
    <div class="h-[calc(100vh-5rem)] flex flex-col overflow-hidden">

        {{-- Page Header (Fixed, doesn't scroll) --}}
        <div class="container mx-auto px-4 py-6 shrink-0">
            <h1 class="text-3xl md:text-4xl font-extrabold text-primary mb-1">@yield('product-title', 'ShopLink Products')</h1>
            <p class="text-gray-500">@yield('product-subtitle', 'Browse our collection')</p>
        </div>

        {{-- Main Content Area (Sidebar + Scrollable Grid) --}}
        <div class="container mx-auto px-4 pb-4 flex-1 flex flex-col lg:flex-row gap-6 overflow-hidden">

            {{-- SIDEBAR (Fixed, doesn't scroll with content) --}}
            <aside
                class="lg:w-64 shrink-0 overflow-y-auto no-scrollbar rounded-2xl shadow-sm border border-gray-100 bg-white mt-4">
                <div class="p-6">
                    <h3 class="font-bold text-lg text-primary mb-4">Categories</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('products.index') }}"
                                class="flex items-center justify-between p-3 rounded-xl transition {{ request()->routeIs('products.index') && !request('category') ? 'bg-primary text-white' : 'hover:bg-gray-50 text-gray-700' }}">
                                <span>All Products</span>
                                <span
                                    class="text-sm {{ request()->routeIs('products.index') && !request('category') ? 'text-white/70' : 'text-gray-400' }}">
                                    {{ $totalProductCount }}
                                </span>
                            </a>
                        </li>
                        @foreach ($sidebarCategories as $cat)
                            <li>
                                <a href="{{ route('category.show', $cat->slug) }}"
                                    class="flex items-center justify-between p-3 rounded-xl transition {{ request()->is('category/' . $cat->slug) ? 'bg-primary text-white' : 'hover:bg-gray-50 text-gray-700' }}">
                                    <span>{{ $cat->name }}</span>
                                    <span
                                        class="text-sm {{ request()->is('category/' . $cat->slug) ? 'text-white/70' : 'text-gray-400' }}">
                                        {{ $cat->products_count }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            {{-- SCROLLABLE PRODUCT GRID (Only this area scrolls) --}}
            <div class="flex-1 overflow-y-auto rounded-xl pr-2 pt-4 no-scrollbar">
                @yield('product-content')
            </div>

        </div>
    </div>
@endsection
