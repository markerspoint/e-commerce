@extends('layouts.app')

@section('title', $categoryName . ' - ShopLink')

@section('content')
    <!-- Header / Breadcrumb -->
    <div class="bg-primary pt-24 pb-12 rounded-b-[4rem]">
        <div class="container mx-auto px-4 text-center text-white">
            <div
                class="w-24 h-24 bg-white/10 rounded-full flex items-center justify-center p-4 mx-auto mb-6 backdrop-blur-sm">
                <img src="{{ $category->icon_url }}" class="w-full h-full object-contain brightness-0 invert">
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">{{ $categoryName }}</h1>
            <p class="text-gray-300 font-medium text-lg">
                Fresh {{ strtolower($categoryName) }} sourced for you
            </p>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="container mx-auto px-4 py-16">
        @if (isset($products) && $products->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @foreach ($products as $product)
                    <div
                        class="bg-white rounded-3xl p-4 shadow-sm hover:shadow-md transition border border-transparent hover:border-gray-100 flex flex-col items-center text-center group h-full">
                        <div class="relative w-3/4 aspect-square mb-4">
                            <img src="{{ $product->image }}"
                                class="w-full h-full object-contain group-hover:scale-110 transition duration-300">
                        </div>
                        <h3 class="font-bold text-primary text-base leading-tight mb-1 line-clamp-2 h-10">
                            {{ $product->name }}</h3>
                        <p class="text-gray-400 text-xs mb-3">500 gm.</p>

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
                            <div x-show="count > 0"
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
        @else
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gray-100 rounded-full mb-6 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3.251h13.5m-3 0h3" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">No products found</h3>
                <p class="text-gray-500 mb-8">We couldn't find any products in this category.</p>
                <a href="/"
                    class="inline-block bg-primary text-white font-bold px-8 py-3 rounded-xl hover:bg-primary-hover transition">
                    Go Back Home
                </a>
            </div>
        @endif
    </div>
@endsection
