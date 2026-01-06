@extends('layouts.app')

@section('title', 'Register - ShopLink')

@section('content')
    <div class="container mx-auto px-4 py-16 flex justify-center items-center">
        <div class="w-full max-w-md bg-white rounded-3xl shadow-lg p-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-shop-black">Create Account</h1>
                <p class="text-gray-500 mt-2">Join us to start shopping</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                        placeholder="Enter your full name" required>
                </div>

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
                        placeholder="Create a password" required>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary transition"
                        placeholder="Confirm your password" required>
                </div>

                <div class="text-sm">
                    <label class="flex items-start gap-2 cursor-pointer">
                        <input type="checkbox" class="mt-1 w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary"
                            required>
                        <span class="text-gray-600">I agree to the <a href="#"
                                class="text-primary hover:underline">Terms of Service</a> and <a href="#"
                                class="text-primary hover:underline">Privacy Policy</a></span>
                    </label>
                </div>

                <button type="submit"
                    class="w-full bg-primary text-white font-bold py-4 rounded-xl hover:bg-accent transition transform active:scale-95">
                    Register
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-primary font-bold hover:text-accent">Sign In</a>
            </div>
        </div>
    </div>
@endsection
