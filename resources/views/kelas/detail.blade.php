@extends('layouts.app')

@section('title', 'Detail Kelas: Artificial Intelligence - SkillSwap')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
    {{-- Sidebar (diasumsikan dari layout utama atau di-include) --}}
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        {{-- Mobile Header (Sticky) --}}
        @include('components.header-mobile')

        {{-- Area Konten Utama dengan Scroll --}}
        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">

                {{--
                ======================================================================
                1. BANNER KELAS
                ======================================================================
                --}}
                <div class="relative w-full rounded-2xl shadow-lg overflow-hidden mb-8">
                    <img src="https://images.unsplash.com/photo-1597733336794-12d05021d510?q=80&w=1974" class="absolute inset-0 w-full h-full object-cover" alt="AI Banner">
                    <div class="absolute inset-0 bg-gradient-to-t from-purple-800 to-indigo-600 opacity-80"></div>
                    <div class="relative p-8">
                        <div class="mb-12">
                            <p class="text-indigo-200 font-semibold">Kelas Lanjutan</p>
                            <h1 class="text-4xl font-bold text-white tracking-tight mt-1">Artificial Intelligence</h1>
                            <p class="text-lg text-indigo-100 mt-2">Oleh Andre Firmansyah</p>
                        </div>
                        <button class="px-6 py-3 font-semibold text-indigo-700 bg-white hover:bg-gray-100 rounded-lg transition-colors">
                            Mulai Belajar
                        </button>
                    </div>
                </div>

                {{--
                ======================================================================
                2. LAYOUT DUA KOLOM (MODUL & JADWAL)
                ======================================================================
                --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Kolom Kiri: Daftar Modul --}}
                    <div class="lg:col-span-2">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-5">Materi Pelajaran</h2>

                        {{-- Accordion Interaktif dengan Alpine.js --}}
                        <div x-data="{ openModule: 1 }" class="space-y-4">

                            {{-- Modul 1 --}}
                            <div class="bg-white dark:bg-gray-800/50 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                                <button @click="openModule = (openModule === 1) ? null : 1" class="w-full flex justify-between items-center p-5 text-left">
                                    <span class="font-semibold text-gray-800 dark:text-white">Modul 1: Pengenalan AI</span>
                                    <i class="ri-arrow-down-s-line text-xl transition-transform" :class="{ 'rotate-180': openModule === 1 }"></i>
                                </button>
                                <div x-show="openModule === 1" x-transition class="p-5 border-t border-gray-200 dark:border-gray-700">
                                    <ul class="space-y-3">
                                        <li class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-900">
                                            <div class="flex items-center gap-4"><i class="ri-play-circle-line text-2xl text-indigo-500"></i><span>Sejarah Kecerdasan Buatan</span></div>
                                            <span class="text-sm text-gray-500">12:30</span>
                                        </li>
                                        <li class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-900">
                                            <div class="flex items-center gap-4"><i class="ri-play-circle-line text-2xl text-indigo-500"></i><span>Jenis-jenis AI</span></div>
                                            <span class="text-sm text-gray-500">15:00</span>
                                        </li>
                                        <li class="flex items-center justify-between p-3 rounded-lg bg-indigo-50 dark:bg-indigo-900/50">
                                            <div class="flex items-center gap-4"><i class="ri-file-text-line text-2xl text-indigo-500"></i><span>Studi Kasus: AI di Industri</span></div>
                                            <span class="text-sm text-gray-500">Bacaan</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{-- Modul 2 --}}
                            <div class="bg-white dark:bg-gray-800/50 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                                <button @click="openModule = (openModule === 2) ? null : 2" class="w-full flex justify-between items-center p-5 text-left">
                                    <span class="font-semibold text-gray-800 dark:text-white">Modul 2: Machine Learning</span>
                                    <i class="ri-arrow-down-s-line text-xl transition-transform" :class="{ 'rotate-180': openModule === 2 }"></i>
                                </button>
                                <div x-show="openModule === 2" x-transition class="p-5 border-t border-gray-200 dark:border-gray-700">
                                    <p class="text-gray-600 dark:text-gray-400">Materi untuk modul ini akan segera tersedia.</p>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Kolom Kanan: Jadwal Live Session --}}
                    <div class="lg:col-span-1">
                        <div class="sticky top-8">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-5">Jadwal Kelas Live</h2>
                            <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-md space-y-5">

                                {{-- Sesi 1 --}}
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 text-center bg-indigo-100 dark:bg-indigo-900/50 rounded-lg p-2 w-16">
                                        <p class="font-bold text-indigo-700 dark:text-indigo-300 text-lg">28</p>
                                        <p class="text-xs text-indigo-500 dark:text-indigo-400">SEP</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 dark:text-white">Live Q&A Modul 1</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">19:00 - 20:00 WIB</p>
                                        <button class="mt-2 text-sm font-semibold text-indigo-600 hover:underline">Gabung Sesi</button>
                                    </div>
                                </div>

                                {{-- Sesi 2 --}}
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 text-center bg-gray-200 dark:bg-gray-700 rounded-lg p-2 w-16">
                                        <p class="font-bold text-gray-700 dark:text-gray-300 text-lg">05</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">OKT</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-500 dark:text-gray-400">Live Q&A Modul 2</p>
                                        <p class="text-sm text-gray-400">19:00 - 20:00 WIB</p>
                                        <button class="mt-2 text-sm font-semibold text-gray-400 cursor-not-allowed">Belum Tersedia</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    {{-- Mobile Bottom Navbar --}}
    @include('components.navbar-mobile')
</div>
@endsection
