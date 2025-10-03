@extends('layouts.app')

@section('title', 'Login - SkillSwap')

@section('content')
<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    {{-- Kolom Kiri untuk Ilustrasi --}}
    <div class="hidden lg:flex flex-col items-center justify-center bg-primary p-12 text-white text-center" data-aos="fade-right">
        <div class="w-full max-w-md">
            <i class="ri-swap-box-line text-8xl opacity-80"></i>
            <h1 class="text-4xl font-bold mt-4">Tukar Skill, Buka Peluang Baru.</h1>
            <p class="mt-4 text-lg opacity-70">
                Gabung dengan komunitas kami untuk belajar, berbagi, dan tumbuh bersama tanpa biaya.
            </p>
        </div>
    </div>

    {{-- Kolom Kanan untuk Form --}}
    <div class="flex items-center justify-center bg-gray-50 dark:bg-gray-900 p-6 sm:p-12">
        <div class="max-w-md w-full space-y-8">

            {{-- Header Form --}}
            <div data-aos="fade-up">
                <a href="/" class="text-3xl font-bold text-primary">SkillSwap</a>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-white">
                    Login ke Akun Anda
                </h2>
                <p class="mt-2 text-base text-gray-600 dark:text-gray-400">
                    Selamat datang kembali!
                </p>
            </div>

            {{-- Form Login --}}
            <form class="space-y-6" action="{{ route('login') }}" method="POST" data-aos="fade-up" data-aos-delay="100">
                @csrf

                {{-- Input Email --}}
                <div>
                    <div class="relative">
                        <input id="email" name="email" type="email" required placeholder="Alamat Email" value="{{ old('email') }}"
                            class="peer w-full px-4 py-3 bg-transparent border-b-2 border-gray-300 dark:border-gray-600 text-base dark:text-white placeholder-transparent focus:outline-none focus:border-primary transition-colors @error('email') border-red-500 focus:border-red-500 @enderror">
                        <label for="email" class="absolute left-0 -top-5 text-gray-600 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 peer-focus:-top-5 peer-focus:text-primary peer-focus:text-sm">
                            Alamat Email
                        </label>
                    </div>
                    {{-- Pesan Error untuk Email --}}
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Input Password --}}
                <div>
                    <div class="relative">
                        <input id="password" name="password" type="password" required placeholder="Password"
                            class="peer w-full px-4 py-3 bg-transparent border-b-2 border-gray-300 dark:border-gray-600 text-base dark:text-white placeholder-transparent focus:outline-none focus:border-primary transition-colors @error('password') border-red-500 focus:border-red-500 @enderror">
                        <label for="password" class="absolute left-0 -top-5 text-gray-600 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 peer-focus:-top-5 peer-focus:text-primary peer-focus:text-sm">
                            Password
                        </label>
                    </div>
                    {{-- Pesan Error untuk Password --}}
                    @error('password')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    {{-- Lupa Password --}}
                    <a href="#" 
                    class="text-sm font-medium text-primary hover:underline">
                        Lupa password?
                    </a>
                </div>

               

               
                


                {{-- Tombol Login --}}
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 rounded-lg shadow-md text-base font-semibold text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300 transform hover:scale-105">
                        Log In
                    </button>
                </div>
                 {{-- Link ke Halaman Register --}}
                <p class="text-center text-sm text-gray-600 dark:text-gray-400" data-aos="fade-up" data-aos-delay="200">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-primary hover:underline">
                        Daftar di sini
                    </a>
                </p>
            </form>

            {{-- Link ke Halaman Register --}}
            <p class="text-center text-sm text-gray-600 dark:text-gray-400" data-aos="fade-up" data-aos-delay="200">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold text-primary hover:underline">
                    Daftar di sini
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
