@extends('layouts.app')

@section('title', 'All Categories - ShopLink')

@section('content')
    <!-- Modern Hero Header -->
    <div class="container mx-auto px-4 mt-4">
        <div class="relative py-12 rounded-3xl overflow-hidden shadow-xl isolate">
            <div class="absolute inset-0 bg-[#03352c] z-0">
                <div class="absolute inset-0 bg-gradient-to-br from-[#044a3d] to-[#01221c] opacity-90"></div>
            </div>
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-[#ccfd62]/10 rounded-full blur-[60px] animate-pulse"></div>
            <div class="absolute top-1/2 -left-24 w-48 h-48 bg-white/5 rounded-full blur-[50px]"></div>
            <div class="absolute inset-0 opacity-10 pointer-events-none"
                style="background-image: radial-gradient(circle, #ffffff 1.5px, transparent 1.5px); background-size: 30px 30px;">
            </div>

            <div class="container mx-auto px-4 text-center relative z-10">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-3 tracking-tight drop-shadow-md">
                    All Categories
                </h1>

                <div class="inline-block relative group cursor-default">
                    <p
                        class="text-[#e0e7e6] font-medium text-lg md:text-xl max-w-2xl mx-auto leading-relaxed tracking-wide">
                        Explore our wide range of <span class="text-[#ccfd62] font-bold">premium products</span>
                    </p>
                    <div
                        class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-16 h-0.5 bg-[#ccfd62] rounded-full group-hover:w-32 transition-all duration-300">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach ($categories as $cat)
                <a href="{{ route('category.show', $cat->slug ?? Str::slug($cat->name)) }}"
                    class="bg-white p-6 rounded-3xl shadow-sm hover:shadow-md transition flex flex-col items-center text-center group border border-gray-50 h-56 justify-center gap-4">
                    <div
                        class="w-24 h-24 rounded-full flex items-center justify-center p-4 group-hover:scale-110 transition duration-300">
                        <img src="{{ $cat->icon_url }}" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <h3 class="font-bold text-primary text-xl group-hover:text-primary-hover transition">
                            {{ $cat->name }}
                        </h3>
                        <p class="text-gray-400 text-sm mt-1">{{ $cat->products_count ?? 0 }} items</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
