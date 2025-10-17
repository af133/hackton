@extends('layouts.app')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-background dark:bg-gray-900 px-6 py-24">
    <div class="text-center max-w-xl mx-auto">
        {{-- Elemen dekoratif yang terinspirasi dari desain Anda --}}
        <div class="relative inline-block mb-8">
            <div class="absolute -inset-4 bg-primary/10 rounded-2xl transform rotate-6"></div>
            <div class="absolute -inset-4 bg-secondary/10 rounded-2xl transform -rotate-6"></div>
            <h1 class="relative text-8xl md:text-9xl font-bold text-primary">
                404
            </h1>
        </div>

        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-gray-100 mt-4" data-aos="fade-up">
            Oops! Halaman Hilang.
        </h2>

        <p class="mt-4 text-lg text-gray-500 dark:text-gray-400" data-aos="fade-up" data-aos-delay="100">
            Maaf, kami tidak dapat menemukan halaman yang Anda cari. Mungkin halaman tersebut telah dipindahkan atau tidak pernah ada.
        </p>

        <div class="mt-10" data-aos="fade-up" data-aos-delay="200">
            {{-- Tombol ini menggunakan style yang sama dengan tombol CTA di landing page --}}
            <a href="{{ url('/') }}"
               class="inline-flex items-center gap-3 px-8 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary-dark transition duration-300">
                <i class="ri-arrow-left-line text-xl"></i>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>
</div>
@endsection
