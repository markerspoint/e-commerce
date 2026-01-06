@extends('layouts.app')

@section('title', $categoryName . ' - ShopLink')

@section('content')
    <!-- Header / Breadcrumb -->
    <!-- Modern Header / Breadcrumb -->
    <div class="container mx-auto px-4 mt-6">
        <div class="bg-primary relative overflow-hidden rounded-[3rem] pt-24 pb-20 shadow-xl">
            <!-- Texture Pattern -->
            <div class="absolute inset-0 opacity-10 pointer-events-none"
                style="background-image: radial-gradient(#ffffff 2px, transparent 2px); background-size: 32px 32px;">
            </div>

            <!-- Decorative Background Elements -->
            <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
                <div class="absolute -top-32 -left-32 w-96 h-96 bg-accent/20 rounded-full blur-3xl mix-blend-overlay"></div>
                <div class="absolute top-1/2 -right-32 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
                <div
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-32 bg-gradient-to-t from-primary/50 to-transparent">
                </div>
            </div>

            <div class="container mx-auto px-4 text-center relative z-10">
                <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6 tracking-tight drop-shadow-sm">
                    {{ $categoryName }}</h1>
                <p class="text-green-50 font-medium text-lg md:text-2xl max-w-2xl mx-auto opacity-95 leading-relaxed">
                    Premium {{ strtolower($categoryName) }} selected just for you.<br>Freshness guaranteed.
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="container mx-auto px-4 mt-8 relative z-20">
        <div x-data="{ current: '{{ Route::currentRouteName() }}' }" class="bg-white p-4 rounded-3xl shadow-lg border border-gray-100 max-w-4xl mx-auto">
            <div class="flex flex-wrap items-center justify-center gap-2">
                @foreach ([['label' => 'Vegetable', 'route' => 'category.vegetable'], ['label' => 'Fruits', 'route' => 'category.fruits'], ['label' => 'Meat & Fish', 'route' => 'category.meat-fish'], ['label' => 'Snacks', 'route' => 'category.snacks-breads'], ['label' => 'Dairy', 'route' => 'category.milk-dairy']] as $tab)
                    <a href="{{ route($tab['route']) }}"
                        class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all duration-200"
                        :class="current === '{{ $tab['route'] }}'
                            ?
                            'bg-primary text-white shadow-md' :
                            'text-gray-500 hover:bg-gray-50 hover:text-primary'">
                        {{ $tab['label'] }}
                    </a>
                @endforeach
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
                            <button x-show="count === 0" @click="count = 1"
                                class="w-full bg-shop-bg text-primary text-2xl font-light py-2 rounded-xl hover:bg-primary hover:text-white transition flex items-center justify-center shadow-sm">
                                +
                            </button>

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
