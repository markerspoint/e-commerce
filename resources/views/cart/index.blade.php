@extends('layouts.app')

@section('title', 'Your Cart')

@section('content')
    <div class="container mx-auto px-4 py-8" x-data="{ deleteModalOpen: false }" @open-delete-cart-modal.window="deleteModalOpen = true"
        @close-delete-cart-modal.window="deleteModalOpen = false">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Your Shopping Cart</h1>
            <p class="text-gray-600">You have {{ $cart ? $cart->items->sum('quantity') : 0 }} items in your cart</p>
        </div>

        @if (!$cart || $cart->items->count() == 0)
            <div class="bg-white rounded-3xl p-12 text-center shadow-sm">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">Your cart is empty</h2>
                <p class="text-gray-500 mb-6">Looks like you haven't added anything to your cart yet.</p>
                <a href="{{ route('home') }}"
                    class="inline-block bg-primary text-white px-8 py-3 rounded-xl font-semibold hover:opacity-90 transition">
                    Start Shopping
                </a>
            </div>
        @else
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="lg:w-2/3 space-y-4">
                    @foreach ($cart->items as $item)
                        <div class="bg-white rounded-2xl p-4 shadow-sm flex gap-4 items-center"
                            id="cart-item-{{ $item->id }}">
                            <!-- Product Image -->
                            <div class="w-24 h-24 bg-gray-50 rounded-xl overflow-hidden flex-shrink-0">
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                    class="w-full h-full object-contain">
                            </div>

                            <!-- Product Details -->
                            <div class="flex-grow">
                                <div class="flex justify-between items-start mb-1">
                                    <h3 class="font-bold text-gray-800">{{ $item->product->name }}</h3>
                                    <button onclick="removeItem({{ $item->id }})"
                                        class="text-red-500 hover:bg-red-50 p-1.5 rounded-lg transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-sm text-gray-500 mb-3">
                                    {{ $item->product->category->name ?? 'Uncategorized' }}</p>

                                <div class="flex justify-between items-center">
                                    <div class="font-bold text-primary text-lg">₱{{ number_format($item->price, 2) }}</div>

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center gap-3 bg-gray-50 rounded-lg p-1">
                                        <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})"
                                            class="w-7 h-7 rounded-md bg-white shadow-sm flex items-center justify-center text-gray-600 hover:text-primary disabled:opacity-50"
                                            {{ $item->quantity <= 1 ? 'disabled' : '' }}>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                            </svg>
                                        </button>
                                        <span class="font-semibold text-gray-700 min-w-[1.5rem] text-center"
                                            id="qty-{{ $item->id }}">{{ $item->quantity }}</span>
                                        <button onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                            class="w-7 h-7 rounded-md bg-white shadow-sm flex items-center justify-center text-gray-600 hover:text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-3xl p-6 shadow-sm sticky top-24">
                        <h2 class="text-lg font-bold text-gray-800 mb-6">Order Summary</h2>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span class="font-semibold" id="cart-subtotal">₱{{ number_format($total, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span class="text-green-600 font-medium">Free</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Tax</span>
                                <span>₱0.00</span>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 pt-4 mb-8">
                            <div class="flex justify-between items-center">
                                <span class="font-bold text-gray-800">Total</span>
                                <span class="font-bold text-2xl text-primary"
                                    id="cart-total">₱{{ number_format($total, 2) }}</span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}"
                            class="block w-full bg-primary text-white text-center py-3.5 rounded-xl font-bold hover:opacity-90 transition shadow-lg shadow-primary/30">
                            Proceed to Checkout
                        </a>

                        <a href="{{ route('home') }}"
                            class="block w-full text-center py-3 text-gray-500 font-medium hover:text-gray-800 transition mt-2">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        @endif

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
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Remove Item</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Are you sure you want to remove this item from your
                                        cart?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse gap-2">
                        <button type="button" onclick="confirmRemoveItem()"
                            class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Remove
                        </button>
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
            const csrfToken = '{{ csrf_token() }}';

            function updateQuantity(itemId, newQuantity) {
                if (newQuantity < 1) return;

                fetch(`/cart/${itemId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({
                            quantity: newQuantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update UI
                            document.getElementById(`qty-${itemId}`).textContent = newQuantity;
                            document.getElementById('cart-subtotal').textContent = '₱' + data.cart_total.toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2
                                });
                            document.getElementById('cart-total').textContent = '₱' + data.cart_total.toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2
                                });

                            // Update cart count in header if it exists
                            const cartCountBadge = document.querySelector('.cart-count-badge');
                            if (cartCountBadge) {
                                cartCountBadge.textContent = data.cart_count;
                            }

                            // Disable minus button if quantity is 1
                            const minusBtn = document.querySelector(
                                `button[onclick="updateQuantity(${itemId}, ${newQuantity - 1})"]`);
                            if (minusBtn) {
                                if (newQuantity <= 1) minusBtn.disabled = true;
                                else minusBtn.disabled = false;
                            }

                            // Update the onclick for buttons
                            const itemContainer = document.getElementById(`cart-item-${itemId}`);
                            const buttons = itemContainer.querySelectorAll('button[onclick^="updateQuantity"]');
                            buttons[0].setAttribute('onclick', `updateQuantity(${itemId}, ${newQuantity - 1})`);
                            buttons[1].setAttribute('onclick', `updateQuantity(${itemId}, ${newQuantity + 1})`);
                        }
                    });
            }

            let itemToDeleteId = null;

            function removeItem(itemId) {
                itemToDeleteId = itemId;
                window.dispatchEvent(new CustomEvent('open-delete-cart-modal'));
            }

            function confirmRemoveItem() {
                if (!itemToDeleteId) return;
                const itemId = itemToDeleteId;

                fetch(`/cart/${itemId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Close modal
                            window.dispatchEvent(new CustomEvent('close-delete-cart-modal'));

                            // Remove item from DOM
                            const item = document.getElementById(`cart-item-${itemId}`);
                            if (item) item.remove();

                            // Update totals
                            document.getElementById('cart-subtotal').textContent = '₱' + data.cart_total.toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2
                                });
                            document.getElementById('cart-total').textContent = '₱' + data.cart_total.toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2
                                });

                            // Update cart count in header
                            const cartCountBadge = document.querySelector('.cart-count-badge');
                            if (cartCountBadge) {
                                cartCountBadge.textContent = data.cart_count;
                                if (data.cart_count === 0) {
                                    cartCountBadge.remove();
                                }
                            }

                            // Reload if cart is empty to show empty state
                            if (data.cart_total === 0) {
                                window.location.reload();
                            }
                        }
                    });
            }
        </script>
    @endpush
@endsection
