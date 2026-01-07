@extends('layouts.seller')

@section('title', 'Products - Seller Dashboard')
@section('page-title', 'Products')

@section('content')
    <div class="space-y-6">
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
