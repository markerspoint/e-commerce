<div
    class="bg-white rounded-3xl p-4 shadow-sm hover:shadow-md transition border border-transparent hover:border-gray-100 flex flex-col items-center text-center group h-full relative">
    @if ($product->is_flash_sale)
        <div
            class="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-3 py-1 rounded-full rotate-12 shadow-md z-10 border-2 border-white">
            FLASH SALE
        </div>
    @endif
    <div class="relative w-3/4 aspect-square mb-4">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
            class="w-full h-full object-contain group-hover:scale-110 transition duration-300">
    </div>
    <h3 class="font-bold text-primary text-base leading-tight mb-1 line-clamp-2 h-10">
        {{ $product->name }}
    </h3>
    <p class="text-gray-400 text-xs mb-3">{{ $product->category->name ?? 'Uncategorized' }}</p>

    <div class="mt-auto w-full" x-data="{ count: 0 }">
        <div class="text-3xl font-extrabold text-primary mb-6">
            {{ number_format($product->price) }}<span class="text-base align-top text-gray-400 font-normal">$</span>
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                </svg>
            </button>
            <span x-text="count" class="text-xl"></span>
            <button @click="count++"
                class="w-8 h-8 rounded-full border border-primary flex items-center justify-center hover:bg-white/20 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                </svg>
            </button>
        </div>
    </div>
</div>
