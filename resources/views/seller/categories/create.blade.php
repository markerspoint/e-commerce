@extends('layouts.seller')

@section('title', 'Create Category - Seller Dashboard')
@section('page-title', 'Create Category')

@section('content')
    <div class="max-w-2xl mx-auto relative">
        {{-- Decorative Background Elements --}}
        <div class="absolute -top-10 -right-10 w-64 h-64 bg-primary/5 rounded-full blur-3xl -z-10 animate-pulse"></div>
        <div
            class="absolute -bottom-10 -left-10 w-64 h-64 bg-orange-500/5 rounded-full blur-3xl -z-10 animate-pulse delay-700">
        </div>

        {{-- Header --}}
        <div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <a href="{{ route('seller.categories') }}"
                    class="inline-flex items-center gap-2 text-gray-500 hover:text-primary transition mb-2 group font-medium text-sm">
                    <div
                        class="w-6 h-6 rounded-full bg-white shadow-sm border border-gray-100 flex items-center justify-center group-hover:border-primary/30 group-hover:text-primary transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-3 h-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                        </svg>
                    </div>
                    Back to Categories
                </a>
                <h2 class="text-2xl font-bold text-gray-800 tracking-tight">Create New Category</h2>
                <p class="text-gray-500 text-sm">Add a new category to organize your products</p>
            </div>
        </div>

        {{-- Form --}}
        <form action="{{ route('seller.categories.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 space-y-6 relative overflow-hidden">

            {{-- Top Accent Line --}}
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-primary via-orange-400 to-primary"></div>

            @csrf

            {{-- Section: Basic Info --}}
            <div class="space-y-4">
                <h3 class="text-base font-bold text-gray-800 flex items-center gap-2 pb-2 border-b border-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>
                    Category Information
                </h3>

                {{-- Category Name --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Category Name <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 transition outline-none placeholder-gray-400 font-medium text-gray-800 bg-gray-50/50 focus:bg-white text-sm"
                        placeholder="e.g., Fresh Vegetables" required>
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

                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">Description</label>
                    <input type="text" name="description" id="description" value="{{ old('description') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-primary focus:ring-4 focus:ring-primary/10 transition outline-none placeholder-gray-400 font-medium text-gray-800 bg-gray-50/50 focus:bg-white text-sm"
                        placeholder="e.g., Fresh & locally sourced">
                    <p class="text-gray-400 text-xs mt-1">Short description shown on the homepage</p>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
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
                    Visuals
                </h3>

                <div x-data="{ preview: null }">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Category Image</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-2xl h-48 flex flex-col justify-center text-center hover:border-primary hover:bg-green-50/20 transition cursor-pointer relative overflow-hidden group bg-gray-50/30"
                        onclick="document.getElementById('image').click()">

                        <input type="file" name="image" id="image" class="hidden" accept="image/*"
                            @change="preview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">

                        {{-- Placeholder --}}
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
                            <p class="text-gray-700 font-semibold text-sm">Upload Cover Image</p>
                            <p class="text-gray-400 text-xs mt-1">PNG, JPG, GIF (max. 2MB)</p>
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
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Featured Toggle --}}
                <label
                    class="flex items-center gap-3 p-4 bg-gradient-to-r from-gray-50 to-white rounded-xl cursor-pointer hover:shadow-md border border-gray-100 hover:border-primary/20 transition group relative overflow-hidden">
                    <div
                        class="absolute right-0 top-0 bottom-0 w-1 bg-gradient-to-b from-primary/0 via-primary/50 to-primary/0 opacity-0 group-hover:opacity-100 transition duration-500">
                    </div>

                    <input type="checkbox" name="featured" id="featured" value="1"
                        {{ old('featured') ? 'checked' : '' }}
                        class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary transition cursor-pointer">

                    <div class="flex-1">
                        <span class="block text-sm font-bold text-gray-800 group-hover:text-primary transition">Feature on
                            Homepage</span>
                        <span class="block text-gray-500 text-xs">Featured categories appear on the homepage for quick
                            access</span>
                    </div>

                    <div
                        class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center transform group-hover:scale-110 transition duration-300 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
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
                    Create Category
                </button>
                <a href="{{ route('seller.categories') }}"
                    class="px-6 py-3 text-gray-500 hover:text-gray-800 hover:bg-gray-50 rounded-xl transition font-semibold text-sm">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
