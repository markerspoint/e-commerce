@extends('layouts.app')

@section('title', $categoryName . ' - ShopLink')

@section('content')
    <div class="container mx-auto px-4 mt-4">
        <div class="relative py-12 rounded-3xl overflow-hidden shadow-xl isolate mb-8">
            <div class="absolute inset-0 bg-[#03352c] z-0">
                <div class="absolute inset-0 bg-gradient-to-br from-[#044a3d] to-[#01221c] opacity-90"></div>
            </div>
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-[#ccfd62]/10 rounded-full blur-[60px] animate-pulse"></div>
            <div class="absolute top-1/2 -left-24 w-48 h-48 bg-white/5 rounded-full blur-[50px]"></div>

            <div class="absolute inset-0 opacity-10 pointer-events-none"
                style="background-image: radial-gradient(circle, #ffffff 1.5px, transparent 1.5px); background-size: 30px 30px;">
            </div>

            <div class="relative z-10 px-4 text-center">
                <div class="w-20 h-20 mx-auto mb-6 relative group perspective-1000">
                    <div
                        class="absolute inset-0 bg-[#ccfd62]/20 rounded-2xl blur-lg group-hover:blur-xl transition duration-500 scale-110">
                    </div>
                    <div
                        class="relative w-full h-full bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl flex items-center justify-center p-4 shadow-[0_8px_32px_0_rgba(0,0,0,0.36)] ring-1 ring-white/30 transform group-hover:-translate-y-1 transition-all duration-500 group-hover:rotate-3">
                        <img src="{{ $category->icon_url }}"
                            class="w-full h-full object-contain brightness-0 invert drop-shadow-lg group-hover:scale-110 transition duration-500">
                    </div>
                </div>

                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3 tracking-tight drop-shadow-md">
                    {{ $categoryName }}
                </h1>

                <div class="inline-block relative group cursor-default">
                    <p
                        class="text-[#e0e7e6] font-medium text-lg md:text-xl max-w-2xl mx-auto leading-relaxed tracking-wide">
                        Premium <span class="text-[#ccfd62] font-bold">{{ strtolower($categoryName) }}</span> sourced with
                        care.
                    </p>
                    <div
                        class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-16 h-0.5 bg-[#ccfd62] rounded-full group-hover:w-32 transition-all duration-300">
                    </div>
                </div>
            </div>
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
