{{-- File: resources/views/credit.blade.php --}}

@extends('layouts.app')

@section('title', 'Skill Credit - SkillSwap')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100 dark:bg-gray-900">
    {{-- Menggunakan sidebar yang sudah ada --}}
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        {{-- Menggunakan mobile header yang sudah ada untuk konsistensi --}}
        <header class="md:hidden sticky top-0 z-20 flex items-center justify-between h-20 px-6 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border-b border-gray-200 dark:border-gray-700">
            <button @click="sidebarOpen = true" class="text-gray-500 dark:text-gray-300">
                <i class="ri-menu-2-line text-2xl"></i>
            </button>
            <div class="flex items-center gap-x-3">
                <span class="font-semibold text-gray-700 dark:text-gray-200 text-sm">{{ auth()->user()->name ?? 'Aisyah Farah' }}</span>
                <img class="h-9 w-9 rounded-full object-cover" src="{{ auth()->user()->avatar_url ?? 'https://i.pravatar.cc/150?u=aisyahfarah' }}" alt="User avatar">
            </div>
        </header>

        {{-- Konten Utama Halaman Kredit --}}
        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">

                {{-- JUDUL HALAMAN --}}
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">Skill Credit</h1>

                <div class="space-y-8">
                    {{-- ======================================= --}}
                    {{-- BAGIAN 1: SALDO KREDIT ANDA --}}
                    {{-- ======================================= --}}
                    <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 flex flex-col md:flex-row items-center justify-between">
                        <div>
                            <h2 class="text-lg font-medium text-gray-500 dark:text-gray-400">Saldo Kredit Anda</h2>
                            <div class="flex items-center space-x-3 mt-2">
                                <i class="ri-money-dollar-circle-fill text-5xl text-yellow-400"></i>
                                {{-- Menyesuaikan dengan variabel 'koin' dari layout Anda --}}
                                <span class="text-5xl font-bold text-gray-800 dark:text-white">{{ number_format(auth()->user()->koin, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <a href="{{ route('skill-credit.history') }}" class="text-sm font-medium text-primary hover:underline">Lihat Riwayat →</a>
                        </div>
                    </div>

                    {{-- ======================================= --}}
                    {{-- BAGIAN 2: PAKET TOP UP KREDIT --}}
                    {{-- ======================================= --}}
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-5">Pilih Paket Top Up</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                            <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 text-center flex flex-col transition-transform transform hover:-translate-y-1">
                                <div class="flex-grow">
                                    <i class="ri-copper-coin-line text-6xl text-yellow-500 mx-auto"></i>
                                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mt-4">100 Credit</h3>
                                    <p class="text-3xl font-bold text-primary mt-4">Rp 10.000</p>
                                </div>
                                <button class="w-full mt-6 bg-primary text-white font-semibold py-3 rounded-lg hover:bg-primary-dark transition-colors">
                                    Beli Sekarang
                                </button>
                            </div>

                            <div class="relative bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-lg border-2 border-primary text-center flex flex-col transition-transform transform hover:-translate-y-1">
                                <span class="absolute top-0 -translate-y-1/2 left-1/2 -translate-x-1/2 bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full">Populer</span>
                                <div class="flex-grow">
                                    <i class="ri-coin-line text-6xl text-yellow-500 mx-auto"></i>
                                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mt-4">200 Credit</h3>
                                    <p class="text-3xl font-bold text-primary mt-4">Rp 20.000</p>
                                </div>
                                <button class="w-full mt-6 bg-primary text-white font-semibold py-3 rounded-lg hover:bg-primary-dark transition-colors">
                                    Beli Sekarang
                                </button>
                            </div>

                            <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 text-center flex flex-col transition-transform transform hover:-translate-y-1">
                                <div class="flex-grow">
                                    <i class="ri-medal-line text-6xl text-yellow-500 mx-auto"></i>
                                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-white mt-4">500 Credit</h3>
                                    <p class="text-3xl font-bold text-primary mt-4">Rp 50.000</p>
                                    <p class="text-sm text-green-500 font-medium mt-1">Paling Hemat!</p>
                                </div>
                                <button class="w-full mt-6 bg-primary text-white font-semibold py-3 rounded-lg hover:bg-primary-dark transition-colors">
                                    Beli Sekarang
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- ======================================= --}}
                    {{-- BAGIAN 3: CAIRKAN KREDIT --}}
                    {{-- ======================================= --}}
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-5">Punya Banyak Kredit?</h2>
                        <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700 flex flex-col md:flex-row items-center justify-between">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Cairkan Saldo Anda</h3>
                                <p class="text-gray-500 dark:text-gray-400 mt-1">Tarik saldo kredit ke rekening bank atau e-wallet pilihan Anda.</p>
                            </div>
                            <div class="w-full md:w-auto mt-4 md:mt-0">
                                <button class="w-full md:w-auto bg-green-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-green-700 transition-colors flex items-center justify-center space-x-2">
                                    <i class="ri-wallet-3-line"></i>
                                    <span>Mulai Proses Pencairan</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    {{-- Memanggil navbar mobile jika ada dan diperlukan --}}
    @include('components.navbar-mobile')
</div>
@endsection
