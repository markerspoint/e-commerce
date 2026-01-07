@extends('layouts.seller')

@section('title', 'Add Product - Seller Dashboard')
@section('page-title', 'Add Product')

@section('content')
    <div class="max-w-2xl mx-auto relative">
        {{-- Decorative Background Elements --}}
        <div class="absolute -top-10 -right-10 w-64 h-64 bg-primary/5 rounded-full blur-3xl -z-10 animate-pulse"></div>
        <div
            class="absolute -bottom-10 -left-10 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl -z-10 animate-pulse delay-700">
        </div>

        {{-- Header --}}
        <div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <a href="{{ route('seller.products') }}"
                    class="inline-flex items-center gap-2 text-gray-500 hover:text-primary transition mb-2 group font-medium text-sm">
                    <div
                        class="w-6 h-6 rounded-full bg-white shadow-sm border border-gray-100 flex items-center justify-center group-hover:border-primary/30 group-hover:text-primary transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-3 h-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </div>
                    Back to Products
                </a>
                <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Add New Product</h2>
                <p class="text-gray-500 text-sm">Detailed information about your product</p>
            </div>
            <div class="hidden md:block text-right">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 border border-gray-200 text-xs text-gray-600">
                    <span class="w-1.5 h-1.5 rounded-full bg-orange-400"></span>
                    Draft Mode
                </div>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 space-y-6 relative overflow-hidden"
            x-data="{
                categoryId: '{{ old('category_id') }}',
                categoryName: '{{ old('category_id') ? $categories->firstWhere('id', old('category_id'))?->name : 'Select a category' }}',
                categoryOpen: false
            }">

            {{-- Top Accent Line --}}
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary via-teal-400 to-primary"></div>

            @csrf

            {{-- Section: Basic Info --}}
            <div class="space-y-4">
                <h3 class="text-base font-bold text-gray-800 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    Basic Information
                </h3>

                {{-- Product Name --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Product Name <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 transition outline-none placeholder-gray-400 font-medium text-gray-800 bg-gray-50/50 focus:bg-white text-sm"
                        placeholder="e.g., Organic Bananas" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Category Custom Dropdown --}}
                <div class="relative">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Category <span
                            class="text-red-500">*</span></label>
                    <input type="hidden" name="category_id" :value="categoryId">

                    <button type="button" @click="categoryOpen = !categoryOpen" @click.away="categoryOpen = false"
                        :class="{
                            'border-primary ring-4 ring-primary/10 bg-white': categoryOpen,
                            'border-gray-200 bg-gray-50/50':
                                !categoryOpen
                        }"
                        class="w-full px-4 py-2.5 rounded-xl border flex items-center justify-between transition focus:outline-none group hover:border-primary/50 hover:bg-white text-sm">
                        <span class="font-medium" :class="categoryId ? 'text-gray-800' : 'text-gray-400'"
                            x-text="categoryName"></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor"
                            class="w-4 h-4 text-gray-400 group-hover:text-primary transition duration-200"
                            :class="{ 'rotate-180': categoryOpen }">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    {{-- Dropdown Menu --}}
                    <div x-show="categoryOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-1"
                        class="absolute z-20 w-full mt-2 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden max-h-52 overflow-y-auto no-scrollbar"
                        style="display: none;">

                        @foreach ($categories as $category)
                            <div @click="categoryId = '{{ $category->id }}'; categoryName = '{{ $category->name }}'; categoryOpen = false"
                                class="px-4 py-2.5 flex items-center gap-3 cursor-pointer hover:bg-green-50 transition group">
                                @if ($category->icon_url)
                                    <img src="{{ $category->icon_url }}"
                                        class="w-5 h-5 object-contain opacity-70 group-hover:opacity-100 transition">
                                @else
                                    <div class="w-5 h-5 rounded-full bg-gray-100 group-hover:bg-green-200 transition"></div>
                                @endif
                                <span
                                    class="text-sm font-medium text-gray-700 group-hover:text-primary transition">{{ $category->name }}</span>

                                <div class="ml-auto" x-show="categoryId == '{{ $category->id }}'">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="w-4 h-4 text-primary">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('category_id')
                        <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3 h-3">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">Product Description
                        <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <textarea name="description" id="description" rows="4"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 transition outline-none font-medium text-gray-800 resize-none bg-gray-50/50 focus:bg-white text-sm"
                            placeholder="Describe your product details, features, and specs..." required>{{ old('description') }}</textarea>
                    </div>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Section: Pricing & Inventory --}}
            <div class="space-y-4 pt-2">
                <h3 class="text-base font-bold text-gray-800 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Pricing & Inventory
                </h3>

                <div class="grid grid-cols-2 gap-4">
                    {{-- Price --}}
                    <div>
                        <label for="price" class="block text-sm font-semibold text-gray-700 mb-1.5">Price <span
                                class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-sm">₱</span>
                            <input type="number" name="price" id="price" value="{{ old('price') }}"
                                step="0.01" min="0"
                                class="w-full pl-7 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 transition outline-none font-bold text-gray-800 bg-gray-50/50 focus:bg-white text-sm"
                                placeholder="0.00" required>
                        </div>
                    </div>

                    {{-- Original Price --}}
                    <div>
                        <label for="original_price" class="block text-sm font-semibold text-gray-700 mb-1.5">Original
                            Price</label>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-medium text-sm">₱</span>
                            <input type="number" name="original_price" id="original_price"
                                value="{{ old('original_price') }}" step="0.01" min="0"
                                class="w-full pl-7 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 transition outline-none font-medium text-gray-800 bg-gray-50/50 focus:bg-white text-sm"
                                placeholder="0.00">
                        </div>
                    </div>
                </div>

                {{-- Stock --}}
                <div>
                    <label for="stock" class="block text-sm font-semibold text-gray-700 mb-1.5">Stock Quantity <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        <input type="number" name="stock" id="stock" value="{{ old('stock') }}" min="0"
                            class="w-full pl-4 pr-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 transition outline-none font-medium text-gray-800 bg-gray-50/50 focus:bg-white text-sm"
                            placeholder="e.g., 100" required>
                        <div
                            class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400 text-xs font-medium">
                            units</div>
                    </div>
                </div>
            </div>

            {{-- Section: Media --}}
            <div class="space-y-4 pt-2">
                <h3 class="text-base font-bold text-gray-800 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    Media
                </h3>

                <div x-data="{ preview: null }">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Product Image</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-2xl h-48 flex flex-col justify-center text-center hover:border-primary hover:bg-green-50/20 transition cursor-pointer relative overflow-hidden group bg-gray-50/30"
                        onclick="document.getElementById('image').click()">

                        <input type="file" name="image" id="image" class="hidden" accept="image/*"
                            @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">

                        {{-- Placeholder State --}}
                        <div x-show="!preview"
                            class="flex flex-col items-center justify-center p-4 transition duration-300 group-hover:-translate-y-1">
                            <div
                                class="w-12 h-12 rounded-full bg-white shadow-sm border border-gray-100 flex items-center justify-center mb-3 group-hover:scale-110 group-hover:border-primary/30 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 text-gray-400 group-hover:text-primary transition">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                </svg>
                            </div>
                            <p class="text-gray-700 font-semibold text-sm">Upload Product Image</p>
                            <p class="text-gray-400 text-xs mt-1">SVG, PNG, JPG or WEBP (max. 2MB)</p>
                        </div>

                        {{-- Preview State --}}
                        <div x-show="preview" class="absolute inset-0 flex items-center justify-center bg-white"
                            style="display: none;">
                            <img :src="preview" class="h-full w-full object-contain">
                            <div
                                class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity backdrop-blur-[2px]">
                                <span
                                    class="text-white font-medium bg-white/20 px-4 py-2 rounded-xl backdrop-blur-md border border-white/30 hover:bg-white/30 transition shadow-lg flex items-center gap-2 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>
                                    Change
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Flash Sale Toggle --}}
                <label
                    class="flex items-center gap-3 p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl cursor-pointer hover:shadow-md border border-gray-100 hover:border-primary/20 transition group relative overflow-hidden">
                    <div
                        class="absolute right-0 top-0 bottom-0 w-1 bg-gradient-to-b from-primary/0 via-primary/50 to-primary/0 opacity-0 group-hover:opacity-100 transition duration-500">
                    </div>

                    <div class="relative flex items-center">
                        <input type="checkbox" name="is_flash_sale" id="is_flash_sale" value="1"
                            {{ old('is_flash_sale') ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary transition cursor-pointer">
                    </div>
                    <div class="flex-1">
                        <span class="block text-sm font-bold text-gray-800 group-hover:text-primary transition">Flash Sale
                            Product</span>
                        <span class="block text-gray-500 text-xs">Highlight this product</span>
                    </div>
                    <div
                        class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center transform group-hover:rotate-12 transition duration-300 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                </label>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                <button type="submit"
                    class="px-6 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition font-bold shadow-lg shadow-primary/30 flex items-center gap-2 transform active:scale-95 duration-200 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Publish Product
                </button>
                <a href="{{ route('seller.products') }}"
                    class="px-6 py-3 text-gray-500 hover:text-gray-800 hover:bg-gray-50 rounded-xl transition font-semibold text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
