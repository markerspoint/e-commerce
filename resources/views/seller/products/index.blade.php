@extends('layouts.seller')

@section('title', 'Products - Seller Dashboard')
@section('page-title', 'Products')

@section('content')
    <div class="space-y-6" x-data="{ deleteModalOpen: false, deleteUrl: '' }"
        @open-delete-product-modal.window="deleteModalOpen = true; deleteUrl = $event.detail">
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Manage Products</h2>
                <p class="text-gray-500 mt-1">Add, edit, and manage your product inventory</p>
            </div>
            <a href="{{ route('seller.products.create') }}"
                class="flex items-center gap-2 px-5 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition shadow-lg shadow-primary/25 font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Add Product
            </a>
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-300 p-4">
            <form id="searchForm" action="{{ route('seller.products') }}" method="GET"
                class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="w-5 h-5 text-gray-400 group-focus-within:text-primary transition">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition outline-none text-gray-700 placeholder-gray-400"
                            placeholder="Search by product name...">
                    </div>
                </div>
                <div class="w-full md:w-64 relative">
                    <input type="hidden" name="category" id="categoryInput" value="{{ request('category') }}">
                    <button type="button" id="categoryButton"
                        class="w-full px-4 py-3 text-left bg-white rounded-xl border border-gray-200 hover:border-primary focus:border-primary focus:ring-2 focus:ring-primary/20 transition outline-none flex items-center justify-between group">
                        <span class="text-gray-700 truncate" id="categoryLabel">
                            {{ $categories->firstWhere('id', request('category'))?->name ?? 'All Categories' }}
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5 text-gray-400 group-hover:text-primary transition transform duration-200"
                            id="categoryIcon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="categoryDropdown"
                        class="absolute z-10 w-full mt-2 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible transform -translate-y-2 transition-all duration-200 overflow-hidden">
                        <div class="max-h-60 overflow-y-auto p-1 no-scrollbar">
                            <div class="cursor-pointer px-4 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-green-50 hover:text-primary transition flex items-center gap-2 category-option {{ !request('category') ? 'bg-green-50 text-primary font-medium' : '' }}"
                                data-value="" data-label="All Categories">
                                <div class="w-2 h-2 rounded-full bg-current opacity-75"></div>
                                All Categories
                            </div>
                            @foreach ($categories as $category)
                                <div class="cursor-pointer px-4 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-green-50 hover:text-primary transition flex items-center gap-2 category-option {{ request('category') == $category->id ? 'bg-green-50 text-primary font-medium' : '' }}"
                                    data-value="{{ $category->id }}" data-label="{{ $category->name }}">
                                    @if ($category->icon_url)
                                        <img src="{{ $category->icon_url }}" class="w-5 h-5 object-contain opacity-75">
                                    @else
                                        <div class="w-2 h-2 rounded-full bg-current opacity-75"></div>
                                    @endif
                                    {{ $category->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Products Table Container --}}
        <div id="productsTableContainer">
            @include('seller.products.table')
        </div>

        {{-- Delete Confirmation Modal --}}
        <div x-show="deleteModalOpen" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title" role="dialog" aria-modal="true">

            {{-- Backdrop --}}
            <div x-show="deleteModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                {{-- Modal Panel --}}
                <div x-show="deleteModalOpen" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    @click.away="deleteModalOpen = false"
                    class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">

                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Delete Product
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Are you sure you want to delete this product? This
                                        action cannot be undone.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                        <form :action="deleteUrl" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Delete Product
                            </button>
                        </form>
                        <button type="button" @click="deleteModalOpen = false"
                            class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('searchInput');

                // Custom Dropdown Elements
                const categoryInput = document.getElementById('categoryInput');
                const categoryButton = document.getElementById('categoryButton');
                const categoryDropdown = document.getElementById('categoryDropdown');
                const categoryLabel = document.getElementById('categoryLabel');
                const categoryIcon = document.getElementById('categoryIcon');
                const options = document.querySelectorAll('.category-option');
                const productsTableContainer = document.getElementById('productsTableContainer');

                let timeout = null;
                let isDropdownOpen = false;

                // Toggle Dropdown
                categoryButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    isDropdownOpen = !isDropdownOpen;
                    toggleDropdown(isDropdownOpen);
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!categoryButton.contains(e.target) && !categoryDropdown.contains(e.target)) {
                        isDropdownOpen = false;
                        toggleDropdown(false);
                    }
                });

                function toggleDropdown(show) {
                    if (show) {
                        categoryDropdown.classList.remove('opacity-0', 'invisible', '-translate-y-2');
                        categoryDropdown.classList.add('opacity-100', 'visible', 'translate-y-0');
                        categoryIcon.classList.add('rotate-180');
                    } else {
                        categoryDropdown.classList.add('opacity-0', 'invisible', '-translate-y-2');
                        categoryDropdown.classList.remove('opacity-100', 'visible', 'translate-y-0');
                        categoryIcon.classList.remove('rotate-180');
                    }
                }

                // Handle Option Selection
                options.forEach(option => {
                    option.addEventListener('click', function() {
                        const value = this.dataset.value;
                        const label = this.dataset.label;

                        // Update UI
                        categoryLabel.textContent = label;
                        categoryInput.value = value;

                        // Update active state
                        options.forEach(opt => {
                            opt.classList.remove('bg-green-50', 'text-primary', 'font-medium');
                        });
                        this.classList.add('bg-green-50', 'text-primary', 'font-medium');

                        // Close dropdown
                        isDropdownOpen = false;
                        toggleDropdown(false);

                        // Trigger Search
                        fetchProducts();
                    });
                });

                function fetchProducts() {
                    const search = searchInput.value;
                    const category = categoryInput.value;
                    const url = new URL("{{ route('seller.products') }}");

                    if (search) url.searchParams.set('search', search);
                    if (category) url.searchParams.set('category', category);

                    // Update URL without reload
                    window.history.pushState({}, '', url);

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.text())
                        .then(html => {
                            if (productsTableContainer) {
                                productsTableContainer.innerHTML = html;
                            }
                        })
                        .catch(error => console.error('Error:', error));
                }

                searchInput.addEventListener('input', function() {
                    clearTimeout(timeout);
                    timeout = setTimeout(fetchProducts, 500); // 500ms debounce
                });
            });
        </script>
    @endpush
@endsection
