@extends('layouts.app')

@section('title', '500 - Kesalahan Server')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-background dark:bg-gray-900 px-6 py-24">
    <div class="text-center max-w-xl mx-auto">
        {{-- Elemen dekoratif yang sama, namun dengan ikon yang berbeda --}}
        <div class="relative inline-block mb-8">
            <div class="absolute -inset-4 bg-primary/10 rounded-2xl transform rotate-6"></div>
            <div class="absolute -inset-4 bg-secondary/10 rounded-2xl transform -rotate-6"></div>
            {{-- Angka diubah menjadi 500 --}}
            <h1 class="relative text-8xl md:text-9xl font-bold text-primary">
                500
            </h1>
        </div>

        {{-- Judul disesuaikan untuk error server --}}
        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-gray-100 mt-4" data-aos="fade-up">
            Oops! Terjadi Masalah.
        </h2>

        {{-- Deskripsi diubah untuk menjelaskan masalah di sisi server --}}
        <p class="mt-4 text-lg text-gray-500 dark:text-gray-400" data-aos="fade-up" data-aos-delay="100">
            Maaf, terjadi kesalahan tak terduga di server kami. Tim kami sudah diberitahu dan sedang bekerja keras untuk memperbaikinya. Silakan coba lagi nanti.
        </p>

        <div class="mt-10" data-aos="fade-up" data-aos-delay="200">
            {{-- Tombol aksi tetap sama, mengarahkan pengguna kembali ke halaman utama --}}
            <a href="{{ url('/') }}"
               class="inline-flex items-center gap-3 px-8 py-3 bg-primary text-white font-semibold rounded-lg shadow-md hover:bg-primary-dark transition duration-300">
                <i class="ri-home-4-line text-xl"></i>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>
</div>
@endsection
