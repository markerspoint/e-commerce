@extends('layouts.seller')

@section('title', 'Edit Product - Seller Dashboard')
@section('page-title', 'Edit Product')

@section('content')
    <div class="max-w-2xl">
        {{-- Header --}}
        <div class="mb-8">
            <a href="{{ route('seller.products') }}"
                class="inline-flex items-center gap-2 text-gray-500 hover:text-primary transition mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Products
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Edit Product</h2>
            <p class="text-gray-500 mt-1">Update product details</p>
        </div>

        {{-- Form --}}
        <form action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- Product Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Product Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition outline-none"
                    placeholder="e.g., Organic Bananas" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Category --}}
            <div>
                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                <div class="relative">
                    <select name="category_id" id="category_id" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition outline-none appearance-none bg-white">
                        <option value="" disabled>Select a category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Price --}}
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Price ($) *</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}"
                        step="0.01" min="0"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition outline-none"
                        placeholder="0.00" required>
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Original Price --}}
                <div>
                    <label for="original_price" class="block text-sm font-semibold text-gray-700 mb-2">Original Price
                        ($)</label>
                    <input type="number" name="original_price" id="original_price"
                        value="{{ old('original_price', $product->original_price) }}" step="0.01" min="0"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition outline-none"
                        placeholder="0.00">
                    <p class="text-gray-400 text-xs mt-1">Leave empty if not on sale</p>
                    @error('original_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Stock --}}
            <div>
                <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">Stock Quantity *</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                    min="0"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition outline-none"
                    placeholder="e.g., 100" required>
                @error('stock')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Product Description
                    *</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition outline-none"
                    placeholder="Describe your product..." required>{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div x-data="{ preview: '{{ $product->image_url }}' }">
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Product Image</label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl h-64 flex flex-col justify-center text-center hover:border-primary/50 transition cursor-pointer relative overflow-hidden group"
                    onclick="document.getElementById('image').click()">

                    <input type="file" name="image" id="image" class="hidden" accept="image/*"
                        @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : '{{ $product->image_url }}'">

                    {{-- Placeholder State --}}
                    <div x-show="!preview || preview === 'https://placehold.co/400x400'"
                        class="flex flex-col items-center justify-center">
                        <div class="w-12 h-12 mx-auto mb-3 text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                                stroke="currentColor" class="w-full h-full">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-sm">Click to upload or drag and drop</p>
                        <p class="text-gray-400 text-xs mt-1">PNG, JPG, WEBP up to 2MB</p>
                    </div>

                    {{-- Preview State --}}
                    <div x-show="preview && preview !== 'https://placehold.co/400x400'"
                        class="absolute inset-0 flex items-center justify-center bg-white" style="display: none;"
                        x-transition>
                        <img :src="preview" class="h-full w-full object-contain">
                        <div
                            class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                            <span class="text-white font-medium bg-black/50 px-4 py-2 rounded-lg backdrop-blur-sm">Change
                                Image</span>
                        </div>
                    </div>
                </div>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Flash Sale Toggle --}}
            <label
                class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl cursor-pointer hover:bg-gray-100 transition border border-transparent hover:border-gray-200">
                <input type="checkbox" name="is_flash_sale" id="is_flash_sale" value="1"
                    {{ old('is_flash_sale', $product->is_flash_sale) ? 'checked' : '' }}
                    class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                <div>
                    <span class="block text-sm font-semibold text-gray-700">Flash Sale Item</span>
                    <span class="block text-gray-400 text-xs">Mark this product as a flash sale item</span>
                </div>
            </label>

            {{-- Submit Button --}}
            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                    class="px-6 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition font-semibold shadow-lg shadow-primary/25">
                    Update Product
                </button>
                <a href="{{ route('seller.products') }}"
                    class="px-6 py-3 text-gray-600 hover:text-gray-800 transition font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
