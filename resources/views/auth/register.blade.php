@extends('layouts.app')

@section('title', 'Register - SkillSwap')

@section('content')
<div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

    <div class="hidden lg:flex flex-col items-center justify-center bg-primary p-12 text-white text-center" data-aos="fade-right">
        <div class="w-full max-w-md">
            <i class="ri-user-add-line text-8xl opacity-80"></i>
            <h1 class="text-4xl font-bold mt-4">Bergabung dengan Komunitas Pembelajar.</h1>
            <p class="mt-4 text-lg opacity-70">
                Buat akunmu sekarang dan mulailah perjalanan baru dalam berbagi dan mendapatkan keahlian.
            </p>
        </div>
    </div>

    <div class="flex justify-center bg-gray-50 dark:bg-gray-900 p-6 sm:p-12 lg:py-24">
        {{-- PERUBAHAN 1: Mengurangi spasi antar blok --}}
        <div class="max-w-md w-full space-y-6">

            {{-- Header Form --}}
            <div data-aos="fade-up">
                <a href="/" class="text-3xl font-bold text-primary">SkillSwap</a>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900 dark:text-white">
                    Buat Akun Baru
                </h2>
                <p class="mt-2 text-base text-gray-600 dark:text-gray-400">
                    Hanya perlu beberapa langkah untuk memulai.
                </p>
            </div>

            {{-- PERUBAHAN 2: Mengurangi spasi di dalam form --}}
            <form class="space-y-5" action="{{ route('register') }}" method="POST" data-aos="fade-up" data-aos-delay="100">
                @csrf
                {{-- Input Nama --}}
                <div class="relative">
                    <input id="name" name="name" type="text" required placeholder="Nama Lengkap"
                        class="peer w-full px-4 py-3 bg-transparent border-b-2 border-gray-300 dark:border-gray-600 text-base dark:text-white placeholder-transparent focus:outline-none focus:border-primary transition-colors">
                    <label for="name" class="absolute left-0 -top-5 text-gray-600 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 peer-focus:-top-5 peer-focus:text-primary peer-focus:text-sm">
                        Nama Lengkap
                    </label>
                </div>

                {{-- Input Email --}}
                <div class="relative">
                    <input id="email" name="email" type="email" required placeholder="Alamat Email"
                        class="peer w-full px-4 py-3 bg-transparent border-b-2 border-gray-300 dark:border-gray-600 text-base dark:text-white placeholder-transparent focus:outline-none focus:border-primary transition-colors">
                    <label for="email" class="absolute left-0 -top-5 text-gray-600 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 peer-focus:-top-5 peer-focus:text-primary peer-focus:text-sm">
                        Alamat Email
                    </label>
                </div>

                {{-- Input Password --}}
                <div class="relative">
                    <input id="password" name="password" type="password" required placeholder="Buat Password"
                        class="peer w-full px-4 py-3 bg-transparent border-b-2 border-gray-300 dark:border-gray-600 text-base dark:text-white placeholder-transparent focus:outline-none focus:border-primary transition-colors">
                    <label for="password" class="absolute left-0 -top-5 text-gray-600 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 peer-focus:-top-5 peer-focus:text-primary peer-focus:text-sm">
                        Buat Password
                    </label>
                </div>

                {{-- Input Konfirmasi Password --}}
                <div class="relative">
                    <input id="password_confirmation" name="password_confirmation" type="password" required placeholder="Konfirmasi Password"
                        class="peer w-full px-4 py-3 bg-transparent border-b-2 border-gray-300 dark:border-gray-600 text-base dark:text-white placeholder-transparent focus:outline-none focus:border-primary transition-colors">
                    <label for="password_confirmation" class="absolute left-0 -top-5 text-gray-600 dark:text-gray-400 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-400 peer-placeholder-shown:top-3 peer-focus:-top-5 peer-focus:text-primary peer-focus:text-sm">
                        Konfirmasi Password
                    </label>
                </div>

                {{-- PERUBAHAN 3: Mengurangi spasi tombol --}}
                <div class="pt-2">
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 rounded-lg shadow-md text-base font-semibold text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300 transform hover:scale-105">
                        Buat Akun
                    </button>
                </div>
                
                {{-- Link ke Halaman Login --}}
                <p class="text-center text-sm text-gray-600 dark:text-gray-400" data-aos="fade-up" data-aos-delay="200">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold text-primary hover:underline">
                        Login di sini
                    </a>
                </p>
            </form> 
            <p class="text-center text-sm text-gray-600 dark:text-gray-400" data-aos="fade-up" data-aos-delay="200">
<<<<<<< HEAD
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-primary hover:underline">
                    Login di sini
=======
                Belum punya akun?
                <a href="{{ route('login') }}" class="font-semibold text-primary hover:underline">
                    Daftar di sini
>>>>>>> 2278567 (update)
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
