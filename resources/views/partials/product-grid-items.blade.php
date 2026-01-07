@if (isset($products) && $products->count() > 0)
    @foreach ($products as $product)
        <div
            class="bg-white rounded-3xl p-4 shadow-sm hover:shadow-md transition border border-transparent hover:border-gray-100 flex flex-col items-center text-center group h-full">
            <div class="relative w-3/4 aspect-square mb-4">
                <img src="{{ $product->image }}"
                    class="w-full h-full object-contain group-hover:scale-110 transition duration-300">
            </div>
            <h3 class="font-bold text-gray-800 text-base leading-tight mb-2 line-clamp-2 text-left w-full">
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
                    <span class="text-xl font-bold text-gray-800">₱{{ number_format($product->price, 2) }}</span>
                </div>

                {{-- Hide add button for sellers --}}
                @if (!auth()->check() || !auth()->user()->isSeller())
                    <!-- Buttons -->
                    @auth
                        <div class="flex gap-2 w-full">
                            <button onclick="addToCart({{ $product->id }}, true)"
                                class="flex-1 bg-primary text-white text-sm font-bold py-2 rounded-xl hover:shadow-sm transition group-active:scale-95">
                                Buy Now
                            </button>
                            <button onclick="addToCart({{ $product->id }})"
                                class="px-3 bg-shop-bg text-primary rounded-xl hover:bg-primary hover:text-white transition shadow-sm group-active:scale-95 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart">
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
                                class="flex-1 bg-primary text-white text-sm font-bold py-2 rounded-xl hover:shadow-sm transition flex items-center justify-center">
                                Buy Now
                            </a>
                            <a href="{{ route('login') }}"
                                class="px-3 bg-shop-bg text-primary rounded-xl hover:bg-primary hover:text-white transition shadow-sm flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-shopping-cart-icon lucide-shopping-cart">
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
@else
    <div class="col-span-full text-center py-20">
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
