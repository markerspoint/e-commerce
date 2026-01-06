@extends('layouts.app')

@section('title', 'Login - ShopLink')

@section('content')
    <div class="container mx-auto px-4 py-16 flex justify-center items-center">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-shop-black">Welcome Back</h1>
                <p class="text-gray-500 mt-2">Please login to your account</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                        placeholder="Enter your email" required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                        placeholder="Enter your password" required>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-primary hover:text-accent font-medium">Forgot Password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-primary text-white font-bold py-4 rounded-xl hover:bg-accent transition transform active:scale-95">
                    Sign In
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-primary font-bold hover:text-accent">Create Account</a>
            </div>
        </div>
    </div>
@endsection
