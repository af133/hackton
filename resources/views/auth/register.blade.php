@extends('layouts.app')

@section('title', 'Register - SkillSwap')

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-50 dark:bg-gray-900 transition-colors duration-300 p-4">
    <div class="absolute top-5 right-5">
        <x-theme-toggle/>
    </div>

    <div class="flex flex-col md:flex-row w-full max-w-5xl bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden" data-aos="fade-up" data-aos-duration="1000">
        <div class="hidden md:flex md:w-1/2 bg-gray-100 dark:bg-gray-700">
            <img src="{{ asset('Hero.png') }}" alt="Learning Illustration" class="object-cover w-full h-full">
        </div>

        <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-center text-gray-800 dark:text-gray-100 mb-6">Create Your Account</h2>
            <form method="POST" action="{{ route('auth.register') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="mt-1 block w-full px-4 py-2 border rounded-lg text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500">
                    @error('name')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           class="mt-1 block w-full px-4 py-2 border rounded-lg text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500">
                    @error('email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <input id="password" type="password" name="password" required
                           class="mt-1 block w-full px-4 py-2 border rounded-lg text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500">
                    @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           class="mt-1 block w-full px-4 py-2 border rounded-lg text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-900 border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">Register</button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-600 dark:text-gray-400">
                Already have an account?
                <a href="{{ route('auth.login') }}" class="text-blue-600 hover:underline">Login</a>
            </p>
        </div>
    </div>
</div>
@endsection
