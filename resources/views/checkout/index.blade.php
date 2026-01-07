@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Checkout</h1>

        <div class="flex flex-col lg:flex-row gap-12">
            <!-- Billing Details Form -->
            <div class="lg:w-2/3">
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        Shipping Information
                    </h2>

                    <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                                <input type="text" id="name" value="{{ $user->name }}" readonly
                                    class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 text-gray-500 cursor-not-allowed">
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Delivery
                                    Address</label>
                                <textarea name="address" id="address" rows="3" required placeholder="Enter your full street address"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition outline-none resize-none"></textarea>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone
                                    Number</label>
                                <input type="tel" name="phone" id="phone" required placeholder="e.g. 09123456789"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 transition outline-none">
                            </div>

                            <div class="pt-4">
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Payment Method</h3>
                                <div class="flex items-center gap-4">
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="radio" name="payment_method" value="cod" checked
                                            class="w-5 h-5 text-primary focus:ring-primary border-gray-300">
                                        <span class="text-gray-700 font-medium group-hover:text-primary transition">Cash on
                                            Delivery (COD)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Order Summary</h2>

                    <div class="space-y-4 mb-6 max-h-80 overflow-y-auto pr-2 custom-scrollbar">
                        @foreach ($cart->items as $item)
                            <div class="flex gap-4 items-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-lg flex-shrink-0 p-2">
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                        class="w-full h-full object-contain">
                                </div>
                                <div class="flex-grow">
                                    <h4 class="text-sm font-semibold text-gray-800 line-clamp-1">{{ $item->product->name }}
                                    </h4>
                                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                                        <span>Qty: {{ $item->quantity }}</span>
                                        <span>₱{{ number_format($item->price * $item->quantity, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-100 pt-4 space-y-2 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>₱{{ number_format($cart->items->sum(fn($i) => $i->quantity * $i->product->price), 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span class="text-green-600 font-medium">Free</span>
                        </div>
                        <div
                            class="flex justify-between items-center text-lg font-bold text-gray-900 pt-2 border-t border-gray-100 mt-2">
                            <span>Total</span>
                            <span
                                class="text-primary">₱{{ number_format($cart->items->sum(fn($i) => $i->quantity * $i->product->price), 2) }}</span>
                        </div>
                    </div>

                    <button form="checkout-form" type="submit"
                        class="w-full bg-primary text-white py-3.5 rounded-xl font-bold hover:shadow-lg hover:shadow-primary/30 transition transform active:scale-95">
                        Place Order
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
