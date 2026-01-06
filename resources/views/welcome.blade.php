@extends('layouts.app')

@section('title', 'ShopeeLite Philippines | Shopping Online')

@section('content')
    <!-- Hero Section -->
    <div class="container mx-auto px-4 mt-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-auto md:h-80">
            <!-- Main Slider (Placeholder) -->
            <div class="md:col-span-2 bg-gray-200 relative overflow-hidden group rounded-2xl shadow-sm">
                <!-- Emulating a slider with a single static image for now -->
                <img src="https://placehold.co/800x400/6366f1/ffffff?text=New+Collection+Arrivals" alt="Banner"
                    class="w-full h-full object-cover">

                <!-- Slider Controls -->
                <button
                    class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/30 backdrop-blur-sm text-white p-3 rounded-full hover:bg-white/50 opacity-0 group-hover:opacity-100 transition shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
                <button
                    class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/30 backdrop-blur-sm text-white p-3 rounded-full hover:bg-white/50 opacity-0 group-hover:opacity-100 transition shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>

                <!-- Indicators -->
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-2">
                    <div
                        class="w-2.5 h-2.5 rounded-full bg-white shadow-sm cursor-pointer transition transform hover:scale-125">
                    </div>
                    <div
                        class="w-2.5 h-2.5 rounded-full bg-white/50 shadow-sm cursor-pointer transition transform hover:scale-125">
                    </div>
                    <div
                        class="w-2.5 h-2.5 rounded-full bg-white/50 shadow-sm cursor-pointer transition transform hover:scale-125">
                    </div>
                </div>
            </div>

            <!-- Right Side Banners -->
            <div class="hidden md:flex flex-col gap-4 h-full">
                <div
                    class="bg-indigo-50 h-1/2 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition cursor-pointer relative group">
                    <img src="https://placehold.co/400x200/f43f5e/ffffff?text=Free+Shipping" alt="Banner"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                </div>
                <div
                    class="bg-indigo-50 h-1/2 rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition cursor-pointer relative group">
                    <img src="https://placehold.co/400x200/4f46e5/ffffff?text=Exclusive+Deals" alt="Banner"
                        class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                </div>
            </div>
        </div>

        <!-- Service Highlights (Icons) -->
        <div class="flex flex-wrap justify-between gap-4 mt-8 px-4">
            @foreach (['Top Up', 'ShopLink Mall', 'Fashion', 'S-Mart', 'Gadgets', 'Beauty', 'Home', 'Electro'] as $cat)
                <a href="#"
                    class="flex flex-col items-center gap-3 hover:transform hover:-translate-y-1 transition duration-300 group">
                    <div
                        class="w-14 h-14 bg-white rounded-2xl shadow-sm border border-gray-100 flex items-center justify-center group-hover:shadow-indigo-100 group-hover:border-indigo-100 transition">
                        <!-- Icon Placeholder -->
                        <span class="text-sm text-primary font-bold">{{ substr($cat, 0, 1) }}</span>
                    </div>
                    <span
                        class="text-xs font-medium text-gray-600 group-hover:text-primary transition">{{ $cat }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Categories Section -->
    <div class="container mx-auto px-4 mt-10">
        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            Categories
        </h2>
        <div class="bg-white rounded-2xl shadow-sm p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-6">
                @foreach ($categories as $category)
                    <a href="#" class="group flex flex-col items-center gap-3">
                        <div
                            class="w-20 h-20 rounded-full bg-gray-50 flex items-center justify-center group-hover:bg-indigo-50 transition duration-300 overflow-hidden shadow-sm border border-gray-100 group-hover:border-indigo-100">
                            <img src="{{ $category->image }}"
                                class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition">
                        </div>
                        <span
                            class="text-sm font-medium text-gray-600 group-hover:text-primary transition text-center leading-tight">{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Flash Deals -->
    <div class="container mx-auto px-4 mt-10">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <span class="text-secondary">Flash</span> Deals
                </h2>
                <div class="flex gap-1.5 items-center font-mono font-bold text-white text-xs">
                    <span class="bg-gray-800 p-1.5 rounded-md min-w-[24px] text-center">02</span>
                    <span class="text-gray-400">:</span>
                    <span class="bg-gray-800 p-1.5 rounded-md min-w-[24px] text-center">15</span>
                    <span class="text-gray-400">:</span>
                    <span class="bg-gray-800 p-1.5 rounded-md min-w-[24px] text-center">30</span>
                </div>
            </div>
            <a href="#" class="text-primary hover:text-primary-hover font-medium flex items-center gap-1 transition">
                View All
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($flashSaleProducts as $product)
                <div
                    class="bg-white rounded-2xl p-3 shadow-sm hover:shadow-lg transition duration-300 group cursor-pointer border border-transparent hover:border-indigo-50">
                    <div class="relative aspect-square rounded-xl overflow-hidden bg-gray-100 mb-3">
                        <img src="{{ $product->image }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <div
                            class="absolute top-2 right-2 bg-secondary text-white text-[10px] font-bold px-2 py-1 rounded-full shadow-sm">
                            @if ($product->original_price > $product->price)
                                -{{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}%
                            @else
                                Sale
                            @endif
                        </div>
                    </div>
                    <div>
                        <div class="text-lg font-bold text-secondary mb-1">
                            <span class="text-xs text-secondary/80 font-normal">₱</span>{{ number_format($product->price) }}
                        </div>
                        <div class="flex items-center justify-between text-xs text-gray-500 mb-2">
                            <span class="line-through">₱{{ number_format($product->original_price) }}</span>
                        </div>
                        <div class="relative w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="absolute left-0 top-0 h-full bg-gradient-to-r from-secondary to-pink-500"
                                style="width: {{ rand(20, 90) }}%"></div>
                        </div>
                        <div class="text-[10px] text-gray-400 mt-1.5 text-right font-medium">{{ $product->sold_count }}
                            Claimed</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Daily Discover (Main Product Grid) -->
    <div class="container mx-auto px-4 mt-12 mb-12">
        <div class="flex items-center justify-center mb-10">
            <h2
                class="text-2xl font-bold text-gray-800 relative after:content-[''] after:absolute after:-bottom-3 after:left-1/2 after:-translate-x-1/2 after:w-16 after:h-1 after:bg-primary after:rounded-full">
                Daily Discovery
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
            @foreach ($dailyDiscoverProducts as $product)
                <div
                    class="bg-white rounded-2xl border border-transparent hover:border-indigo-100 hover:shadow-xl transition-all duration-300 group flex flex-col h-full overflow-hidden relative">
                    <div class="relative aspect-[4/5] bg-gray-100 overflow-hidden">
                        <img src="{{ $product->image }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @if ($loop->index % 5 == 0)
                            <div
                                class="absolute top-3 left-3 bg-primary/90 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 rounded-md shadow-sm">
                                Best Seller
                            </div>
                        @endif
                        <!-- Hover Action: Add to Cart -->
                        <div
                            class="absolute bottom-4 right-4 translate-y-full group-hover:translate-y-0 transition duration-300">
                            <button
                                class="bg-white text-primary p-2 rounded-full shadow-lg hover:bg-primary hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-4 flex flex-col flex-grow">
                        <h3
                            class="text-sm font-medium text-gray-800 line-clamp-2 mb-2 group-hover:text-primary transition min-h-[40px]">
                            {{ $product->name }}
                        </h3>
                        <div class="mt-auto">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">₱{{ number_format($product->price) }}</span>
                                <span class="text-xs text-gray-400">{{ $product->sold_count }} sold</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-center mt-8">
            <a href="#"
                class="bg-white border px-10 py-2 text-gray-600 hover:bg-gray-50 text-sm font-medium rounded-sm shadow-sm transition">See
                More</a>
        </div>
    </div>
@endsection
