@extends('layouts.seller')

@section('title', 'Create Category - Seller Dashboard')
@section('page-title', 'Create Category')

@section('content')
    <div class="max-w-2xl">
        {{-- Header --}}
        <div class="mb-8">
            <a href="{{ route('seller.categories') }}"
                class="inline-flex items-center gap-2 text-gray-500 hover:text-primary transition mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Categories
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Create New Category</h2>
            <p class="text-gray-500 mt-1">Add a new category to organize your products</p>
        </div>

        {{-- Form --}}
        <form action="{{ route('seller.categories.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-6">
            @csrf

            {{-- Category Name --}}
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Category Name *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition outline-none"
                    placeholder="e.g., Fresh Vegetables" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <input type="text" name="description" id="description" value="{{ old('description') }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition outline-none"
                    placeholder="e.g., Fresh & locally sourced">
                <p class="text-gray-400 text-xs mt-1">Short description shown on the homepage</p>
                @error('description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Icon --}}
            <div>
                <label for="icon" class="block text-sm font-semibold text-gray-700 mb-2">Icon Filename</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition outline-none"
                    placeholder="e.g., vegetable.svg">
                <p class="text-gray-400 text-xs mt-1">SVG icon file from /public/icons/ folder</p>
                @error('icon')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Image --}}
            <div>
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Category Image</label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-primary/50 transition cursor-pointer"
                    onclick="document.getElementById('image').click()">
                    <input type="file" name="image" id="image" class="hidden" accept="image/*">
                    <div class="w-12 h-12 mx-auto mb-3 text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 text-sm">Click to upload or drag and drop</p>
                    <p class="text-gray-400 text-xs mt-1">PNG, JPG, GIF up to 2MB</p>
                </div>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Featured Toggle --}}
            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }}
                    class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary">
                <div>
                    <label for="featured" class="text-sm font-semibold text-gray-700 cursor-pointer">Feature on
                        Homepage</label>
                    <p class="text-gray-400 text-xs">Featured categories appear on the homepage for quick access</p>
                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center gap-4 pt-4">
                <button type="submit"
                    class="px-6 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition font-semibold shadow-lg shadow-primary/25">
                    Create Category
                </button>
                <a href="{{ route('seller.categories') }}"
                    class="px-6 py-3 text-gray-600 hover:text-gray-800 transition font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
