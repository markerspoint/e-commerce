@extends('layouts.app')

@section('title', 'Order #' . $order->id)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <a href="{{ route('orders.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center mb-4 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 h-4 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Orders
            </a>
            <h1 class="text-3xl font-bold text-shop-black">Order #{{ $order->id }}</h1>
            <p class="text-gray-500 mt-2">Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Items -->
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b">
                        <h2 class="text-lg font-semibold text-gray-900">Items</h2>
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-gray-100">
                            @foreach ($order->items as $item)
                                <li class="flex py-4">
                                    <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                        <img src="{{ $item->product->image_url ?? 'https://placehold.co/400' }}"
                                            alt="{{ $item->product->name }}"
                                            class="h-full w-full object-cover object-center">
                                    </div>
                                    <div class="ml-4 flex flex-1 flex-col">
                                        <div>
                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                <h3>
                                                    <a href="#">{{ $item->product->name }}</a>
                                                </h3>
                                                <p class="ml-4">₱{{ number_format($item->price, 2) }}</p>
                                            </div>
                                        </div>
                                        <div class="flex flex-1 items-end justify-between text-sm">
                                            <p class="text-gray-500">Qty {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1 space-y-6">
                <!-- Order Summary -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h2>
                    <div class="flow-root">
                        <dl class="-my-4 divide-y divide-gray-100 text-sm">
                            <div class="flex items-center justify-between py-4">
                                <dt class="text-gray-600">Subtotal</dt>
                                <dd class="font-medium text-gray-900">₱{{ number_format($order->total_amount, 2) }}</dd>
                            </div>
                            <div class="flex items-center justify-between py-4">
                                <dt class="text-gray-600">Shipping</dt>
                                <dd class="font-medium text-gray-900">Free</dd>
                            </div>
                            <div class="flex items-center justify-between py-4 border-t border-gray-100 pt-4">
                                <dt class="text-base font-bold text-gray-900">Total</dt>
                                <dd class="text-base font-bold text-shop-primary">
                                    ₱{{ number_format($order->total_amount, 2) }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Shipping Details -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Shipping Details</h2>
                    <div class="text-sm text-gray-600 space-y-2">
                        <p><span class="font-medium text-gray-900">Name:</span> {{ $order->user->name }}</p>
                        <p><span class="font-medium text-gray-900">Phone:</span> {{ $order->phone_number }}</p>
                        <p><span class="font-medium text-gray-900">Address:</span> {{ $order->shipping_address }}</p>
                        <p><span class="font-medium text-gray-900">Payment:</span> {{ strtoupper($order->payment_method) }}
                        </p>
                    </div>
                </div>

                <!-- Order Status -->
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Status</h2>
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    @if ($order->status == 'completed') bg-green-100 text-green-800
                    @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                    @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection
