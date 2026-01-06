@extends('layouts.app')

@section('title', 'Gromuse - Grocery Delivery')

@section('content')
    <!-- Hero Section -->
    <div class="container mx-auto px-4 mt-4">
        <div class="bg-primary relative overflow-hidden flex items-center"
            style="border-radius: 2rem 2rem 50% 50% / 2rem 2rem 4rem 4rem;">
            <div
                class="container mx-auto left-[7%] px-6 md:px-16 py-12 md:py-16 grid grid-cols-1 md:grid-cols-2 gap-8 items-center relative z-10">
                <div class="text-white">
                    <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-6">
                        We bring the store<br>to your door
                    </h1>
                    <p class="text-gray-200 text-lg mb-8 max-w-md font-medium">
                        Get organic produce and sustainably sourced groceries delivery at up to 4% off grocery.
                    </p>
                    <button
                        class="inline-block bg-accent text-primary text-lg font-bold px-10 py-4 rounded-xl hover:bg-accent-hover transition shadow-xl shadow-accent/20 cursor-pointer transform hover:scale-105 duration-200">
                        Shop now
                    </button>
                </div>
                <div class="relative flex justify-center md:justify-end mt-10 md:mt-0">
                    <!-- Spacer for grid layout on desktop -->
                </div>
            </div>

            <!-- Hero Image (Grocery Bag) - Positioned Absolutely on Desktop -->
            <div class="hidden md:block absolute bottom-0 top-[10%] right-[10%] w-[35%] h-[115%] pointer-events-none z-0">
                <img src="{{ asset('hero_grocery_bag.png') }}" alt="Grocery Delivery"
                    class="w-full h-full object-contain object-bottom drop-shadow-2xl">
            </div>
            <!-- Decorative Elements -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-accent/20 rounded-full blur-3xl z-0"></div>
        </div>
    </div>

    <!-- Category Cards -->
    <div class="container mx-auto px-4 mt-16 relative z-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ([['name' => 'Vegetable', 'desc' => 'Local market', 'icon' => 'Vegetable'], ['name' => 'Snacks & Breads', 'desc' => 'In store delivery', 'icon' => 'Bread'], ['name' => 'Fruits', 'desc' => 'Chemical free', 'icon' => 'Orange'], ['name' => 'Chicken legs', 'desc' => 'Frozen Meal', 'icon' => 'Chicken']] as $cat)
                <div
                    class="bg-white p-6 rounded-3xl shadow-sm hover:shadow-md transition flex justify-between items-end border border-gray-50 h-32 md:h-40 cursor-pointer group">
                    <div class="flex flex-col h-full justify-between">
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg group-hover:text-primary transition">
                                {{ $cat['name'] }}</h3>
                            <p class="text-gray-400 text-xs">{{ $cat['desc'] }}</p>
                        </div>
                    </div>
                    <div
                        class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center text-xs text-gray-400 group-hover:bg-soft-accent transition">
                        {{ $cat['icon'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- You Might Need (Products) -->
    <div class="container mx-auto px-4 mt-20 mb-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-extrabold text-primary">You might need</h2>
            <a href="#" class="text-red-500 font-bold hover:text-red-600 transition flex items-center gap-2">
                See more
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach ($dailyDiscoverProducts as $product)
                <div
                    class="bg-white rounded-3xl p-4 shadow-sm hover:shadow-md transition border border-transparent hover:border-gray-100 flex flex-col items-center text-center group h-full">
                    <div class="relative w-3/4 aspect-square mb-4">
                        <img src="{{ $product->image }}"
                            class="w-full h-full object-contain group-hover:scale-110 transition duration-300">
                    </div>
                    <h3 class="font-bold text-primary text-base leading-tight mb-1 line-clamp-2 h-10">{{ $product->name }}
                    </h3>
                    <p class="text-gray-400 text-xs mb-3">500 gm.</p>

                    <div class="mt-auto w-full">
                        <div class="text-3xl font-extrabold text-primary mb-6">
                            {{ number_format($product->price) }}<span
                                class="text-base align-top text-gray-400 font-normal">$</span>
                        </div>

                        <button
                            class="w-full bg-shop-bg text-primary text-2xl font-light py-2 rounded-xl hover:bg-primary hover:text-white transition flex items-center justify-center shadow-sm">
                            +
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
