@extends('layouts.seller')

@section('title', 'Categories - Seller Dashboard')
@section('page-title', 'Categories')

@section('content')
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Manage Categories</h2>
                <p class="text-gray-500 mt-1">Create and manage product categories for your store</p>
            </div>
            <a href="{{ route('seller.categories.create') }}"
                class="flex items-center gap-2 px-5 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition shadow-lg shadow-primary/25 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add Category
            </a>
        </div>

        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        {{-- Categories Table --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            @if ($categories->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Category</th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Description</th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Products</th>
                                <th
                                    class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Featured</th>
                                <th
                                    class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($categories as $category)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center overflow-hidden">
                                                <img src="{{ $category->icon_url }}" alt="{{ $category->name }}"
                                                    class="w-8 h-8 object-contain">
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-800">{{ $category->name }}</p>
                                                <p class="text-xs text-gray-400">{{ $category->slug }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-gray-600 text-sm">{{ $category->description ?? '-' }}</p>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-700">
                                            {{ $category->products_count }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($category->featured)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                                Yes
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-sm">No</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('seller.categories.edit', $category) }}"
                                                class="p-2 text-gray-500 hover:text-primary hover:bg-gray-100 rounded-lg transition"
                                                title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('seller.categories.delete', $category) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this category?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                                    title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                {{-- Pagination --}}
                <div
                    class="px-6 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-sm text-gray-500">
                        Showing <span class="font-bold text-primary">{{ $categories->firstItem() ?? 0 }}</span> to <span
                            class="font-bold text-primary">{{ $categories->lastItem() ?? 0 }}</span> of <span
                            class="font-bold text-primary">{{ $categories->total() }}</span> results
                    </p>

                    @if ($categories->hasPages())
                        <div class="flex items-center gap-2">
                            {{-- Previous Page Link --}}
                            @if ($categories->onFirstPage())
                                <button disabled
                                    class="p-2 rounded-lg border border-gray-100 text-gray-300 bg-gray-50 cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 19.5L8.25 12l7.5-7.5" />
                                    </svg>
                                </button>
                            @else
                                <a href="{{ $categories->previousPageUrl() }}"
                                    class="p-2 rounded-lg border border-gray-200 text-gray-500 hover:border-primary hover:text-primary hover:bg-green-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 19.5L8.25 12l7.5-7.5" />
                                    </svg>
                                </a>
                            @endif

                            {{-- Page Links (Simple Window) --}}
                            <div class="hidden sm:flex items-center gap-1">
                                @foreach ($categories->getUrlRange(max(1, $categories->currentPage() - 2), min($categories->lastPage(), $categories->currentPage() + 2)) as $page => $url)
                                    @if ($page == $categories->currentPage())
                                        <span
                                            class="px-3.5 py-2 rounded-lg bg-primary text-white text-sm font-semibold shadow-sm">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}"
                                            class="px-3.5 py-2 rounded-lg border border-gray-100 text-gray-600 hover:bg-green-50 hover:text-primary hover:border-primary/30 transition text-sm font-medium">{{ $page }}</a>
                                    @endif
                                @endforeach
                            </div>

                            {{-- Next Page Link --}}
                            @if ($categories->hasMorePages())
                                <a href="{{ $categories->nextPageUrl() }}"
                                    class="p-2 rounded-lg border border-gray-200 text-gray-500 hover:border-primary hover:text-primary hover:bg-green-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </a>
                            @else
                                <button disabled
                                    class="p-2 rounded-lg border border-gray-100 text-gray-300 bg-gray-50 cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            @else
                <div class="p-12 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1"
                            stroke="currentColor" class="w-full h-full">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-1">No categories yet</h3>
                    <p class="text-gray-400 mb-6">Create your first category to start organizing products</p>
                    <a href="{{ route('seller.categories.create') }}"
                        class="inline-flex items-center gap-2 px-5 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Add Category
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
