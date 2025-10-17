@extends('layouts.app')

@section('title', '403 - Akses Ditolak')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-background dark:bg-gray-900 px-6 py-24">
    <div class="text-center max-w-xl mx-auto">
        {{-- Ikon perisai digunakan untuk merepresentasikan "akses terlarang" --}}
        <div class="relative inline-block mb-8" data-aos="zoom-in">
            <div class="absolute -inset-4 bg-primary/10 rounded-2xl transform rotate-6"></div>
            <div class="absolute -inset-4 bg-secondary/10 rounded-2xl transform -rotate-6"></div>
            {{-- Angka diubah menjadi 403 --}}
            <h1 class="relative text-8xl md:text-9xl font-bold text-primary flex items-center gap-x-4">
                4<i class="ri-shield-forbidden-line text-7xl md:text-8xl"></i>3
            </h1>
        </div>

        {{-- Judul disesuaikan untuk error 403 --}}
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-gray-100 mt-4" data-aos="fade-up">
            Akses Ditolak
        </h2>

        {{-- Deskripsi diubah untuk menjelaskan bahwa pengguna tidak punya izin --}}
        <p class="mt-4 text-lg text-gray-500 dark:text-gray-400" data-aos="fade-up" data-aos-delay="100">
            Maaf, Anda tidak memiliki izin yang diperlukan untuk mengakses halaman ini. Sepertinya ini adalah area terlarang.
        </p>

        <div class="mt-10" data-aos="fade-up" data-aos-delay="200">
            {{-- Tombol aksi tetap sama, mengarahkan pengguna kembali --}}
            <a href="{{ url('/') }}"
               class="inline-flex items-center gap-3 px-8 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary-dark transition duration-300">
                <i class="ri-arrow-left-line text-xl"></i>
                <span>Kembali ke Halaman Sebelumnya</span>
            </a>
        </div>
    </div>
</div>
@endsection
