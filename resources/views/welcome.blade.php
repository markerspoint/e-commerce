@use('Illuminate\Support\Str')
@extends('layouts.app')

@section('title', 'ShopLink')

@section('content')
    <!-- Hero Section -->
    <div class="container mx-auto px-4 mt-4">
        <div class="bg-primary relative overflow-hidden flex items-center"
            style="border-radius: 2rem 2rem 50% 50% / 2rem 2rem 4rem 4rem;">
            <div
                class="container mx-auto left-0 md:left-[7%] px-6 md:px-16 py-8 md:py-16 grid grid-cols-1 md:grid-cols-2 gap-8 items-center relative z-10">
                <div class="text-white">
                    <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-6">
                        We bring the store<br>to your door
                    </h1>
                    <p class="text-gray-200 text-lg mb-8 max-w-md font-medium">
                        Get organic produce and sustainably sourced groceries delivery at up to 4% off grocery.
                    </p>
                    <button
                        class="inline-block bg-accent text-primary text-lg font-bold px-6 py-3 md:px-10 md:py-4 rounded-xl hover:bg-accent-hover transition shadow-xl shadow-accent/20 cursor-pointer transform hover:scale-105 duration-200">
                        Shop now
                    </button>
                </div>
                <div class="relative flex justify-center md:justify-end mt-10 md:mt-0">
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
    <div class="container mx-auto px-4 mt-8 md:mt-16 relative z-20">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 md:gap-4">
            @forelse ($featuredCategories as $category)
                <a href="{{ route('category.show', $category->slug) }}"
                    class="bg-white p-3 md:p-5 rounded-3xl shadow-sm hover:shadow-md transition h-32 md:h-36 flex flex-col justify-between relative overflow-hidden group border border-gray-50 cursor-pointer"
                    style="background-image: radial-gradient(circle at 0% 0%, {{ $category->card_color }}15 0%, transparent 50%);">
                    <div class="z-10">
                        <h3 class="font-bold text-primary group-hover:text-primary-hover transition text-sm md:text-base">
                            {{ $category->name }}
                        </h3>
                        <p class="text-gray-400 text-xs mt-1">{{ $category->description ?? 'Fresh products' }}</p>
                    </div>
                    <div
                        class="absolute bottom-2 right-2 w-16 h-16 transition-transform group-hover:scale-110 duration-300">
                        <img src="{{ $category->icon_url }}" alt="{{ $category->name }}"
                            class="w-full h-full object-contain">
                    </div>
                </a>
            @empty
                {{-- No categories fallback --}}
                <div class="col-span-full text-center py-8 text-gray-400">
                    <p>No categories available yet.</p>
                </div>
            @endforelse

            <!-- See All Card -->
            <a href="{{ route('categories.index') }}"
                class="bg-accent p-5 rounded-3xl shadow-sm hover:shadow-md transition h-36 flex flex-col items-center justify-center gap-3 cursor-pointer group">
                <div
                    class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary group-hover:scale-110 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </div>
                <span class="font-bold text-primary text-sm">See all</span>
            </a>
        </div>
    </div>

    <!-- You Might Need (Products) -->
    <div class="container mx-auto px-4 mt-12 md:mt-20 mb-12 md:mb-20">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-extrabold text-primary">You might need</h2>
            <a href="{{ route('products.index') }}"
                class="text-red-500 font-bold hover:text-red-600 transition flex items-center gap-2">
                See more
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

        @if ($dailyDiscoverProducts->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-6">
                @foreach ($dailyDiscoverProducts as $product)
                    <div
                        class="bg-white rounded-3xl p-3 md:p-4 shadow-xl hover:shadow-md transition border border-transparent hover:border-gray-100 flex flex-col items-center text-center group h-full relative">
                        @if ($product->is_flash_sale)
                            <div
                                class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-3 py-1 rounded-full rotate-12 shadow-md z-10 border-2 border-white">
                                FLASH SALE
                            </div>
                        @endif
                        <div class="relative w-3/4 aspect-square mb-4">
                            <img src="{{ $product->image_url }}"
                                class="w-full h-full object-contain group-hover:scale-110 transition duration-300">
                        </div>
                        <h3
                            class="font-bold text-gray-800 text-sm md:text-base leading-tight mb-2 line-clamp-2 text-left w-full">
                            {{ $product->name }}
                        </h3>
                        {{-- Category pill and stock inline with outlined style --}}
                        <div class="flex items-center gap-1 w-full mb-3">
                            <span
                                class="inline-block px-1.5 py-0.5 text-[10px] font-medium rounded border border-gray-400 text-gray-600 uppercase truncate max-w-[50%]">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </span>
                            <span
                                class="inline-block px-1.5 py-0.5 text-[10px] font-medium rounded border border-gray-400 text-gray-600 uppercase truncate max-w-[50%]">
                                {{ $product->stock > 0 ? $product->stock . ' IN STOCK' : 'OUT OF STOCK' }}
                            </span>
                        </div>
                        {{-- Description --}}
                        @if ($product->description)
                            <p class="text-gray-500 text-xs mb-3 line-clamp-2 text-left w-full leading-relaxed">
                                {{ $product->description }}</p>
                        @endif

                        <div class="mt-auto w-full">
                            {{-- Price section --}}
                            <div class="text-left mb-3">
                                <span class="text-[10px] text-gray-400 uppercase tracking-wide block">Price</span>
                                <span
                                    class="text-xl font-bold text-gray-800">₱{{ number_format($product->price, 2) }}</span>
                            </div>

                            {{-- Hide add button for sellers --}}
                            @if (!auth()->check() || !auth()->user()->isSeller())
                                <!-- Buttons -->
                                @auth
                                    <div class="flex gap-2 w-full">
                                        <button onclick="addToCart({{ $product->id }}, true)"
                                            class="flex-1 bg-primary text-white text-xs md:text-sm font-bold py-2 rounded-xl hover:shadow-sm transition group-active:scale-95">
                                            Buy Now
                                        </button>
                                        <button onclick="addToCart({{ $product->id }})"
                                            class="px-2 md:px-3 bg-shop-bg text-primary rounded-xl hover:bg-primary hover:text-white transition shadow-sm group-active:scale-95 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-shopping-cart-icon lucide-shopping-cart">
                                                <circle cx="8" cy="21" r="1" />
                                                <circle cx="19" cy="21" r="1" />
                                                <path
                                                    d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                                            </svg>
                                        </button>
                                    </div>
                                @else
                                    <div class="flex gap-2 w-full">
                                        <a href="{{ route('login') }}"
                                            class="flex-1 bg-primary text-white text-xs md:text-sm font-bold py-2 rounded-xl hover:shadow-sm transition flex items-center justify-center">
                                            Buy Now
                                        </a>
                                        <a href="{{ route('login') }}"
                                            class="px-2 md:px-3 bg-shop-bg text-primary rounded-xl hover:bg-primary hover:text-white transition shadow-sm flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-shopping-cart-icon lucide-shopping-cart">
                                                <circle cx="8" cy="21" r="1" />
                                                <circle cx="19" cy="21" r="1" />
                                                <path
                                                    d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                                            </svg>
                                        </a>
                                    </div>
                                @endauth
                            @endif
                        </div>
                    </div>
                @endforeach
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
                <p class="text-gray-400 max-w-md mx-auto">Our shelves are being stocked with fresh products. Check back
                    soon for amazing deals!</p>
            </div>
        @endif
    </div>

    {{-- banner --}}
    <div class="container mx-auto px-4 mb-12 md:mb-20">
        <div class="relative overflow-hidden rounded-[4rem] md:rounded-[3rem] shadow-2xl"
            style="background: linear-gradient(135deg, #6B1B4E 0%, #8B2867 50%, #6B1B4E 100%);">

            <div class="absolute inset-0 opacity-10 pointer-events-none"
                style="background-image: radial-gradient(#ffffff 2px, transparent 2px); background-size: 24px 24px;">
            </div>

            <div class="absolute inset-0 opacity-10 pointer-events-none">
                <div class="absolute top-10 left-10 w-32 h-32 bg-white/20 rounded-full blur-2xl"></div>
                <div class="absolute bottom-10 right-10 w-40 h-40 bg-white/20 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-accent/30 rounded-full blur-2xl"></div>
            </div>

            <div class="relative grid grid-cols-1 md:grid-cols-2 gap-8 items-center px-6 md:px-16 pt-8 md:pt-16 pb-0">
                <div class="text-white z-10 pb-12 md:pb-16">
                    <h2 class="text-2xl md:text-5xl font-extrabold leading-tight mb-6">
                        Stay Home and Get All Your Essentials From Our Market!
                    </h2>
                    <p class="text-gray-100 text-lg md:text-xl font-medium max-w-lg opacity-90">
                        We deliver fresh, organic, and locally sourced products directly to your doorstep with care.
                    </p>
                </div>

                <div class="relative flex justify-center md:justify-end z-10 h-full items-end">
                    <div class="w-full max-w-md">
                        <img src="{{ asset('delivery_person_groceries.png') }}" alt="Delivery Person with Groceries"
                            class="w-full h-auto max-h-[400px] object-contain object-bottom drop-shadow-2xl">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative pt-12 md:pt-20 pb-0 overflow-hidden"
        style="background-color: #d1fa98; border-radius: 50% 50% 0 0 / 4rem 4rem 0 0;">
        <div class="absolute inset-0 pointer-events-none opacity-40">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <g fill="#ffffff">
                    <circle cx="5" cy="15" r="0.3" />
                    <circle cx="15" cy="85" r="0.4" />
                    <circle cx="25" cy="25" r="0.2" />
                    <circle cx="35" cy="65" r="0.3" />
                    <circle cx="45" cy="10" r="0.2" />
                    <circle cx="55" cy="80" r="0.4" />
                    <circle cx="65" cy="35" r="0.3" />
                    <circle cx="75" cy="15" r="0.2" />
                    <circle cx="85" cy="70" r="0.4" />
                    <circle cx="95" cy="45" r="0.3" />
                </g>
                <g stroke="#ffffff" stroke-width="0.4" stroke-linecap="round" opacity="0.8">
                    <path d="M10 20 L12 25" />
                    <path d="M85 10 L83 16" />
                    <path d="M20 60 L22 66" />
                    <path d="M70 75 L68 81" />
                    <path d="M40 30 L41 33" />
                    <path d="M90 35 L92 40" />
                    <path d="M30 90 L28 95" />
                    <path d="M60 15 L62 20" />
                </g>
            </svg>
        </div>

        <div class="container mx-auto px-4 text-center mb-16 relative z-10">
            <h2 class="text-3xl md:text-4xl lg:text-6xl font-extrabold text-[#03352c] mb-6 tracking-tight">
                We always provide<br>you the best in town
            </h2>
            <p class="text-[#03352c] text-lg font-medium max-w-2xl mx-auto opacity-75">
                Delivering tried-and-true quality with a commitment to service that never goes out of style.
            </p>
        </div>

        <!-- Marquee Section -->
        <div class="relative w-full overflow-hidden pb-0 leading-none">
            <div class="inline-flex gap-8 animate-marquee whitespace-nowrap pl-4">
                @foreach (range(1, 3) as $i)
                    <div class="bg-[#03352c] p-8 w-80 h-96 flex flex-col justify-between shrink-0 whitespace-normal text-white group hover:shadow-2xl transition duration-300 rounded-b-none"
                        style="border-radius: 50% 50% 0 0 / 2rem 2rem 0 0;">
                        <h3 class="font-bold text-2xl leading-tight">ShopLink<br>Rewards.</h3>
                        <div class="flex justify-center flex-1 items-end pb-4">
                            <div class="w-32 h-32 text-[#ccfd62]">
                                <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                                    <path d="M30 80 L30 100 M70 80 L70 100" stroke-opacity="0.5" />
                                    <rect x="30" y="80" width="40" height="20" rx="2" />
                                    <path d="M40 80 L40 60 L60 60 L60 80" />
                                    <rect x="55" y="25" width="30" height="40" transform="rotate(15 70 45)"
                                        fill="#03352c" fill-opacity="0.2" />
                                    <text x="60" y="50" font-size="10" transform="rotate(15 70 45)" fill="currentColor"
                                        stroke="none">50</text>
                                    <rect x="25" y="30" width="30" height="40" transform="rotate(-15 40 50)"
                                        fill="#03352c" fill-opacity="0.2" />
                                    <text x="30" y="55" font-size="10" transform="rotate(-15 40 50)" fill="currentColor"
                                        stroke="none">20</text>
                                    <path d="M40 65 Q50 65 60 70" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Gift Card -->
                    <div class="bg-[#03352c] p-8 w-80 h-96 flex flex-col justify-between shrink-0 whitespace-normal text-white group hover:shadow-2xl transition duration-300 rounded-b-none"
                        style="border-radius: 50% 50% 0 0 / 2rem 2rem 0 0;">
                        <h3 class="font-bold text-2xl leading-tight">Gift the<br>Freshness</h3>
                        <div class="flex justify-center flex-1 items-end pb-4">
                            <div class="w-32 h-32 text-[#ccfd62]">
                                <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                                    <rect x="20" y="20" width="60" height="70" rx="5" />
                                    <path d="M50 20 L50 30 M40 25 L60 25" />
                                    <circle cx="50" cy="27" r="3" />
                                    <rect x="30" y="50" width="40" height="30" rx="2" fill="#03352c"
                                        fill-opacity="0.2" />
                                    <line x1="30" y1="60" x2="70" y2="60"
                                        stroke-width="1" />
                                    <rect x="45" y="65" width="10" height="10" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Tabby Invoice -->
                    <div class="bg-[#03352c] p-8 w-80 h-96 flex flex-col justify-between shrink-0 whitespace-normal text-white group hover:shadow-2xl transition duration-300 rounded-b-none"
                        style="border-radius: 50% 50% 0 0 / 2rem 2rem 0 0;">
                        <h3 class="font-bold text-2xl leading-tight">Secure & Easy<br>Payments</h3>
                        <div class="flex justify-center flex-1 items-end pb-4">
                            <div class="w-32 h-32 text-[#ccfd62]">
                                <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                                    <rect x="55" y="60" width="35" height="25" rx="2"
                                        stroke-dasharray="2 2" />
                                    <rect x="60" y="75" width="10" height="6" />
                                    <path d="M20 100 L20 80 Q20 70 30 65 L40 60" />
                                    <rect x="35" y="30" width="30" height="50" rx="3" fill="#03352c"
                                        fill-opacity="0.2" />
                                    <circle cx="50" cy="75" r="2" />
                                    <path d="M50 65 L50 45 M45 50 L50 45 L55 50" />
                                    <path d="M30 65 L65 65" />
                                    <path d="M30 75 L65 75" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Order and Collect -->
                    <div class="bg-[#03352c] p-8 w-80 h-96 flex flex-col justify-between shrink-0 whitespace-normal text-white group hover:shadow-2xl transition duration-300 rounded-b-none"
                        style="border-radius: 50% 50% 0 0 / 2rem 2rem 0 0;">
                        <h3 class="font-bold text-2xl leading-tight">Click &<br>Collect</h3>
                        <div class="flex justify-center flex-1 items-end pb-4">
                            <div class="w-32 h-32 text-[#ccfd62]">
                                <svg viewBox="0 0 100 100" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="w-full h-full">
                                    <rect x="10" y="40" width="30" height="50" rx="3" />
                                    <circle cx="25" cy="85" r="2" />
                                    <path d="M55 50 L55 90 L90 90 L90 50 L72.5 60 L55 50 Z" />
                                    <path d="M60 50 L60 35 Q60 30 70 30 Q80 30 80 40 L85 50" />
                                    <rect x="75" y="20" width="10" height="30" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection


<style>
    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .animate-marquee {
        animation: marquee 40s linear infinite;
    }

    .animate-marquee:hover {
        animation-play-state: paused;
    }
</style>
