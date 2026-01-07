@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-shop-black">My Orders</h1>
            <p class="text-gray-500 mt-2">Track the progress of your orders.</p>
        </div>

        @if ($orders->isEmpty())
            <div class="bg-white rounded-2xl shadow-sm p-12 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-8 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">No orders yet</h3>
                <p class="text-gray-500 mt-1 mb-6">Looks like you haven't placed any orders yet.</p>
                <a href="{{ route('home') }}"
                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-xl shadow-sm text-white bg-primary hover:opacity-90 transition">
                    Start Shopping
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($orders as $order)
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Order #{{ $order->id }}</h3>
                                    <p class="text-sm text-gray-500">Placed on {{ $order->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                                <div class="mt-4 sm:mt-0 flex items-center space-x-4">
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if ($order->status == 'completed') bg-green-100 text-green-800
                                    @elseif($order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    <span class="text-lg font-bold text-gray-900">
                                        ₱{{ number_format($order->total_amount, 2) }}
                                    </span>
                                </div>
                            </div>

                            <div class="border-t pt-4">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-600">
                                        {{ $order->items->count() }} items
                                    </p>
                                    <a href="{{ route('orders.show', $order) }}"
                                        class="text-primary hover:text-opacity-80 font-medium text-sm flex items-center">
                                        View Details
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
