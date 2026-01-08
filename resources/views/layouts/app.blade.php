<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ShopLink')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f9f9f7;
        }
    </style>
</head>

<body class="antialiased text-shop-black bg-shop-bg">

    @include('partials.header')

    <!-- Toast Notification -->
    @include('partials.toast')

    <main class="@yield('main-class', 'min-h-screen')">
        @yield('content')
    </main>

    @unless (View::hasSection('hide-footer'))
        @include('partials.footer')
    @endunless

    <div id="addToCartModal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm"
            onclick="closeCartModal()"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-primary/10 sm:mx-0 sm:h-10 sm:w-10">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                <h3 class="text-xl font-bold leading-6 text-gray-900 mb-2" id="modal-title">Add to Cart
                                </h3>
                                <p class="text-sm text-gray-500 mb-6">How many items would you like to add?</p>

                                <div class="flex items-center justify-center sm:justify-start gap-4 mb-2">
                                    <button onclick="decrementModalQty()"
                                        class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100 transition text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                        </svg>
                                    </button>
                                    <input type="number" id="modalQuantity" value="1" min="1"
                                        class="w-20 text-center text-2xl font-bold border-none outline-none focus:ring-0 text-gray-800"
                                        readonly>
                                    <button onclick="incrementModalQty()"
                                        class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center hover:bg-gray-100 transition text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="button" onclick="confirmAddToCart()"
                            class="inline-flex w-full justify-center rounded-xl bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:opacity-90 sm:ml-3 sm:w-auto transition">Add
                            to Cart</button>
                        <button type="button" onclick="closeCartModal()"
                            class="mt-3 inline-flex w-full justify-center rounded-xl bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Guest Login Modal -->
    <div id="guestLoginModal" class="fixed inset-0 z-[100] hidden" aria-labelledby="guest-modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity backdrop-blur-sm"
            onclick="closeGuestModal()"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md">
                    <div class="bg-white px-6 pb-6 pt-8">
                        <div class="flex flex-col items-center text-center">
                            <!-- Icon -->
                            <div
                                class="mx-auto flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-primary/10 mb-5">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold leading-6 text-gray-900 mb-3" id="guest-modal-title">
                                Login Required
                            </h3>

                            <!-- Message -->
                            <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                                It seems you haven't logged in yet. Please login or create an account to continue
                                shopping and make a purchase.
                            </p>

                            <!-- Illustration/Icon -->
                            <div class="flex items-center justify-center gap-3 text-gray-400 mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>
                                <span class="text-2xl">→</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 flex flex-col gap-3">
                        <a href="{{ route('login') }}"
                            class="w-full flex justify-center items-center gap-2 rounded-xl bg-primary px-4 py-3 text-sm font-semibold text-white shadow-sm hover:opacity-90 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            Login to Continue
                        </a>
                        <a href="{{ route('register') }}"
                            class="w-full flex justify-center items-center gap-2 rounded-xl bg-white px-4 py-3 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                            </svg>
                            Create an Account
                        </a>
                        <button type="button" onclick="closeGuestModal()"
                            class="w-full flex justify-center items-center rounded-xl px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 transition">
                            Continue Browsing
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let selectedProductId = null;
        let isBuyNowAction = false;

        function addToCart(productId, isBuyNow = false) {

            selectedProductId = productId;
            isBuyNowAction = isBuyNow;
            document.getElementById('modalQuantity').value = 1;

            // Update modal title/text based on action? Optional.
            const title = document.getElementById('modal-title');
            if (isBuyNowAction) {
                title.innerText = "Buy Now";
            } else {
                title.innerText = "Add to Cart";
            }

            document.getElementById('addToCartModal').classList.remove('hidden');
        }

        function closeCartModal() {
            document.getElementById('addToCartModal').classList.add('hidden');
            selectedProductId = null;
            isBuyNowAction = false;
        }

        function incrementModalQty() {
            const input = document.getElementById('modalQuantity');
            input.value = parseInt(input.value) + 1;
        }

        function decrementModalQty() {
            const input = document.getElementById('modalQuantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        function confirmAddToCart() {
            if (!selectedProductId) return;

            const quantity = parseInt(document.getElementById('modalQuantity').value);
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch("{{ route('cart.add') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        product_id: selectedProductId,
                        quantity: quantity
                    })
                })
                .then(response => {
                    if (response.status === 401) {
                        window.location.href = "{{ route('login') }}";
                        return;
                    }
                    return response.json();
                })
                .then(data => {
                    if (data && data.success) {
                        if (isBuyNowAction) {
                            // Redirect to cart page
                            window.location.href = "{{ route('cart.index') }}";
                        } else {
                            // Update header badge and close modal
                            let badge = document.querySelector('.cart-count-badge');
                            if (badge) {
                                badge.innerText = data.cart_count;
                                badge.classList.add('scale-125');
                                setTimeout(() => badge.classList.remove('scale-125'), 200);
                            } else {
                                const cartIcon = document.querySelector('a[href="{{ route('cart.index') }}"]');
                                if (cartIcon) {
                                    badge = document.createElement('span');
                                    badge.className =
                                        'cart-count-badge absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold h-5 w-5 flex items-center justify-center rounded-full border-2 border-primary';
                                    badge.innerText = data.cart_count;
                                    cartIcon.appendChild(badge);
                                }
                            }

                            closeCartModal();
                            // Show success toast
                            window.dispatchEvent(new CustomEvent('notify', {
                                detail: {
                                    message: 'Product added to cart',
                                    type: 'success'
                                }
                            }));
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        // Guest Login Modal Functions
        function showGuestLoginModal() {
            document.getElementById('guestLoginModal').classList.remove('hidden');
        }

        function closeGuestModal() {
            document.getElementById('guestLoginModal').classList.add('hidden');
        }
    </script>
    @stack('scripts')
</body>

</html>
