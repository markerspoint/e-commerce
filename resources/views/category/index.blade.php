@extends('layouts.app')

@section('title', 'All Categories - ShopLink')

@section('content')
    <div class="bg-primary pt-24 pb-12 rounded-b-[4rem]">
        <div class="container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4">All Categories</h1>
            <p class="text-gray-300 font-medium text-lg">
                Explore our wide range of products
            </p>
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
