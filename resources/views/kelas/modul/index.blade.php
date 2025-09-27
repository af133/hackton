@extends('layouts.app')

@section('title', 'Modul 1: Sejarah AI - SkillSwap')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
    {{-- Sidebar --}}
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        {{-- Mobile Header --}}
        @include('components.header-mobile')

        {{-- Area Konten Utama --}}
        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">

                {{--
                ======================================================================
                1. HEADER NAVIGASI & JUDUL
                ======================================================================
                --}}
                <div class="mb-6">
                    <a href="#" class="text-sm font-medium text-indigo-600 hover:underline flex items-center gap-2">
                        <i class="ri-arrow-left-s-line"></i>
                        Kembali ke Daftar Modul
                    </a>
                    <div class="md:flex md:items-center md:justify-between mt-4">
                        <div class="min-w-0 flex-1">
                            <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Sejarah Kecerdasan Buatan</h1>
                        </div>
                        <div class="mt-4 flex-shrink-0 flex md:mt-0 md:ml-4 gap-x-2">
                            <button class="px-4 py-2 text-sm font-semibold text-gray-700 bg-white border rounded-lg shadow-sm hover:bg-gray-50">
                                <i class="ri-arrow-left-line mr-2"></i>Sebelumnya
                            </button>
                            <button class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-700">
                                Berikutnya<i class="ri-arrow-right-line ml-2"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{--
                ======================================================================
                2. LAYOUT KONTEN (VIDEO & PLAYLIST)
                ======================================================================
                --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Kolom Kiri: Konten Utama (Video & Deskripsi) --}}
                    <div class="lg:col-span-2">
                        {{-- Video Player Responsif --}}
                                                {{-- Video Player Responsif --}}
                        <div class="relative w-full overflow-hidden rounded-2xl shadow-lg aspect-video bg-gray-900">
                            <iframe class="absolute inset-0 w-full h-full"
                                    src="https://www.youtube.com/embed/o_XVt5rdpFY"
                                    title="YouTube video player"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen>
                            </iframe>
                        </div>

                        {{-- Konten Tambahan dengan Tabs (Alpine.js) --}}
                        <div x-data="{ activeTab: 'deskripsi' }" class="mt-8 bg-white dark:bg-gray-800/50 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700">
                            <nav class="flex border-b border-gray-200 dark:border-gray-700">
                                <button @click="activeTab = 'deskripsi'" :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'deskripsi', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'deskripsi' }" class="py-4 px-6 font-medium border-b-2 transition-colors">Deskripsi</button>
                                <button @click="activeTab = 'sumber-daya'" :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'sumber-daya', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'sumber-daya' }" class="py-4 px-6 font-medium border-b-2 transition-colors">Sumber Daya</button>
                                <button @click="activeTab = 'diskusi'" :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'diskusi', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'diskusi' }" class="py-4 px-6 font-medium border-b-2 transition-colors">Diskusi</button>
                            </nav>
                            <div class="p-6">
                                <div x-show="activeTab === 'deskripsi'" class="prose dark:prose-invert max-w-none">
                                    <p>Selamat datang di pelajaran pertama! Dalam video ini, kita akan menjelajahi perjalanan menarik dari awal mula konsep kecerdasan buatan hingga perkembangannya yang pesat di era modern.</p>
                                    <h4>Poin Utama:</h4>
                                    <ul>
                                        <li>Konsep awal dari Alan Turing.</li>
                                        <li>Era keemasan dan "musim dingin" AI.</li>
                                        <li>Peran deep learning dalam kebangkitan AI saat ini.</li>
                                    </ul>
                                </div>
                                <div x-show="activeTab === 'sumber-daya'">
                                    <a href="#" class="flex items-center gap-3 p-3 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200">
                                        <i class="ri-file-pdf-line text-2xl text-red-500"></i>
                                        <span class="font-medium text-gray-800 dark:text-gray-200">Slide Presentasi Modul 1.pdf</span>
                                    </a>
                                </div>
                                <div x-show="activeTab === 'diskusi'">
                                    <p class="text-gray-600 dark:text-gray-400">Fitur diskusi akan segera hadir. Bertanyalah dan berdiskusilah dengan peserta lain di sini!</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Playlist Modul (Sticky) --}}
                    <div class="lg:col-span-1">
                        <div class="sticky top-8">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Daftar Materi</h3>
                            <div x-data="{ openModule: 1 }" class="space-y-3">
                                {{-- Modul 1 --}}
                                <div class="bg-white dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700">
                                    <button @click="openModule = (openModule === 1) ? null : 1" class="w-full flex justify-between items-center p-4 text-left">
                                        <span class="font-semibold text-gray-800 dark:text-white">Modul 1: Pengenalan AI</span>
                                        <i class="ri-arrow-down-s-line text-lg transition-transform" :class="{ 'rotate-180': openModule === 1 }"></i>
                                    </button>
                                    <div x-show="openModule === 1" class="px-4 pb-4 border-t border-gray-200 dark:border-gray-700">
                                        <ul class="space-y-1 mt-3">
                                            {{-- Pelajaran Aktif --}}
                                            <li class="flex items-center gap-3 p-2 rounded-lg bg-indigo-100 dark:bg-indigo-900/50 cursor-pointer">
                                                <i class="ri-play-circle-fill text-xl text-indigo-500"></i>
                                                <span class="text-sm font-semibold text-indigo-800 dark:text-indigo-200">Sejarah Kecerdasan Buatan</span>
                                            </li>
                                            <li class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
                                                <i class="ri-play-circle-line text-xl text-gray-500"></i>
                                                <span class="text-sm text-gray-700 dark:text-gray-300">Jenis-jenis AI</span>
                                            </li>
                                            <li class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer">
                                                <i class="ri-file-text-line text-xl text-gray-500"></i>
                                                <span class="text-sm text-gray-700 dark:text-gray-300">Studi Kasus: AI di Industri</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- Modul 2 --}}
                                <div class="bg-white dark:bg-gray-800/50 rounded-xl border border-gray-200 dark:border-gray-700">
                                    <button @click="openModule = (openModule === 2) ? null : 2" class="w-full flex justify-between items-center p-4 text-left">
                                        <span class="font-semibold text-gray-800 dark:text-white">Modul 2: Machine Learning</span>
                                        <i class="ri-arrow-down-s-line text-lg transition-transform" :class="{ 'rotate-180': openModule === 2 }"></i>
                                    </button>
                                    {{-- Konten Modul 2 disembunyikan --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    {{-- Navbar Mobile --}}
    @include('components.navbar-mobile')
</div>
@endsection
