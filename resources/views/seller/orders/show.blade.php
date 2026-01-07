@extends('layouts.seller')

@section('title', 'Order #' . $order->id . ' - ShopLink')
@section('page-title', 'Order Details')

@section('content')
    <div class="space-y-6">
        {{-- Back Button --}}
        <div>
            <a href="{{ route('seller.orders') }}"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-primary transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Back to Orders
            </a>
        </div>

        {{-- Order Header --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-300">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-shop-black">Order #{{ $order->id }}</h2>
                    <p class="text-gray-500 mt-1">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
                </div>
                <div>
                    <span
                        class="px-4 py-2 rounded-full text-sm font-semibold
                        @if ($order->status == 'completed') bg-green-100 text-green-800
                        @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Order Items --}}
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6 border border-gray-300">
                <h3 class="text-lg font-bold text-shop-black mb-4">Order Items</h3>
                <div class="space-y-4">
                    @foreach ($order->orderItems as $item)
                        <div
                            class="flex items-center gap-4 p-4 border border-gray-200 rounded-xl hover:bg-gray-50 transition">
                            @if ($item->product?->image_url)
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}"
                                    class="w-20 h-20 object-cover rounded-lg">
                            @else
                                <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1" stroke="currentColor" class="w-10 h-10 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">{{ $item->product_name }}</h4>
                                <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                <p class="text-sm text-gray-500">₱{{ number_format($item->price, 2) }} each</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-shop-black">₱{{ number_format($item->price * $item->quantity, 2) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Order Summary & Customer Info --}}
            <div class="space-y-6">
                {{-- Customer Information --}}
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-300">
                    <h3 class="text-lg font-bold text-shop-black mb-4">Customer Information</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Name</p>
                            <p class="font-medium text-gray-900">{{ $order->user->name ?? 'Guest' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium text-gray-900">{{ $order->user->email ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Shipping Information --}}
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-300">
                    <h3 class="text-lg font-bold text-shop-black mb-4">Shipping Information</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Full Name</p>
                            <p class="font-medium text-gray-900">{{ $order->shipping_name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Phone</p>
                            <p class="font-medium text-gray-900">{{ $order->shipping_phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Address</p>
                            <p class="font-medium text-gray-900">{{ $order->shipping_address }}</p>
                        </div>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-300">
                    <h3 class="text-lg font-bold text-shop-black mb-4">Order Summary</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span>₱{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping</span>
                            <span>₱0.00</span>
                        </div>
                        <div class="pt-2 border-t border-gray-200">
                            <div class="flex justify-between text-lg font-bold text-shop-black">
                                <span>Total</span>
                                <span>₱{{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="space-y-2">
                    @if ($order->status == 'pending')
                        <button
                            class="w-full px-4 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition font-medium">
                            Mark as Processing
                        </button>
                        <button
                            class="w-full px-4 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition font-medium">
                            Cancel Order
                        </button>
                    @elseif($order->status == 'processing')
                        <button
                            class="w-full px-4 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition font-medium">
                            Mark as Shipped
                        </button>
                    @elseif($order->status == 'shipped')
                        <button
                            class="w-full px-4 py-3 bg-primary text-white rounded-xl hover:bg-primary/90 transition font-medium">
                            Mark as Delivered
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
