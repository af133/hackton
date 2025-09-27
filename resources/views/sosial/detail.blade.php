@extends('layouts.app')

@section('title', 'Digital Marketing Circle - SkillSwap')
@section('body_class', 'bg-background')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-background">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">

                {{--
                ======================================================================
                1. BANNER & AKSI UTAMA CIRCLE
                ======================================================================
                --}}
                <div class="bg-white p-6 rounded-2xl shadow-md mb-8">
                    <div class="flex flex-col sm:flex-row items-start justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">Digital Marketing Circle</h1>
                            <p class="text-gray-500 mt-1 max-w-2xl">Grup untuk diskusi tren terbaru, strategi, dan studi kasus dalam dunia digital marketing.</p>
                            <div class="flex items-center mt-3 -space-x-2">
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://i.pravatar.cc/150?u=a" alt="">
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://i.pravatar.cc/150?u=b" alt="">
                                <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://i.pravatar.cc/150?u=c" alt="">
                                <span class="flex items-center justify-center h-8 w-8 rounded-full bg-secondary text-primary text-xs font-bold ring-2 ring-white">+25</span>
                            </div>
                        </div>
                        <div class="flex-shrink-0 flex items-center gap-x-2">
                            <button class="px-4 py-2 text-sm font-semibold text-primary bg-secondary rounded-lg hover:bg-opacity-80">
                                <i class="ri-calendar-event-line mr-1"></i>Buat Event
                            </button>
                            <button class="px-4 py-2 text-sm font-semibold text-white bg-primary rounded-lg shadow-sm hover:bg-primary-dark">
                                <i class="ri-add-line mr-1"></i>Join Circle
                            </button>
                        </div>
                    </div>
                </div>

                {{--
                ======================================================================
                2. LAYOUT DUA KOLOM (FEED DISKUSI & PANEL INFO)
                ======================================================================
                --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Kolom Kiri: Feed Diskusi --}}
                    <div class="lg:col-span-2 space-y-6">
                        {{-- Form Buat Postingan --}}
                        <div class="bg-white p-4 rounded-2xl shadow-md">
                            <div class="flex items-start gap-4">
                                <img class="h-10 w-10 rounded-full object-cover" src="https://i.pravatar.cc/150?u=aisyahfarah" alt="User Avatar">
                                <textarea rows="2" class="flex-1 bg-background border-transparent rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Mulai diskusi baru..."></textarea>
                                <button class="px-4 py-2 h-10 text-sm font-semibold text-white bg-primary rounded-lg shadow-sm hover:bg-primary-dark">Post</button>
                            </div>
                        </div>

                        {{-- Contoh Postingan Diskusi 1 --}}
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <div class="flex items-start gap-4">
                                <img class="h-10 w-10 rounded-full object-cover" src="https://i.pravatar.cc/150?u=budi" alt="Budi's Avatar">
                                <div class="w-full">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="font-semibold text-gray-800">Budi Santoso</p>
                                            <p class="text-xs text-gray-400">2 jam yang lalu</p>
                                        </div>
                                        <button class="text-gray-400 hover:text-primary"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                    <div class="prose prose-sm max-w-none mt-3">
                                        <p>Teman-teman, ada yang punya rekomendasi tools SEO gratis yang powerfull untuk riset keyword? Selain Ubersuggest.</p>
                                    </div>
                                    <div class="flex items-center justify-between text-gray-500 mt-4 border-t pt-3">
                                        <div class="flex items-center gap-4">
                                            <button class="flex items-center gap-1 hover:text-primary"><i class="ri-heart-3-line"></i> 12</button>
                                            <button class="flex items-center gap-1 hover:text-primary"><i class="ri-chat-3-line"></i> 5</button>
                                        </div>
                                        <a href="#" class="text-sm font-semibold text-primary hover:underline">Lihat Diskusi</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Contoh Postingan Diskusi 2 --}}
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                           {{-- ... (Struktur sama seperti postingan 1) ... --}}
                        </div>
                    </div>

                    {{-- Kolom Kanan: Panel Info --}}
                    <div class="lg:col-span-1 space-y-8">
                        {{-- Jadwal Event --}}
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Event Mendatang</h3>
                            <div class="space-y-4">
                                <div class="flex gap-4">
                                    <div class="flex-shrink-0 text-center bg-secondary rounded-lg p-2 w-16">
                                        <p class="font-bold text-primary text-lg">05</p>
                                        <p class="text-xs text-primary font-semibold">OKT</p>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">Belajar Bareng: SEO On-Page</p>
                                        <p class="text-sm text-gray-500">19:00 WIB · Online</p>
                                        <a href="#" class="text-sm font-semibold text-primary hover:underline mt-1 inline-block">Lihat Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Daftar Anggota --}}
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold text-gray-800">Anggota</h3>
                                <a href="#" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-center gap-3"><img class="h-9 w-9 rounded-full" src="https://i.pravatar.cc/150?u=aisyahfarah" alt=""><span class="font-medium text-sm">Aisyah Farah (Anda)</span></li>
                                <li class="flex items-center gap-3"><img class="h-9 w-9 rounded-full" src="https://i.pravatar.cc/150?u=budi" alt=""><span class="font-medium text-sm">Budi Santoso</span></li>
                                <li class="flex items-center gap-3"><img class="h-9 w-9 rounded-full" src="https://i.pravatar.cc/150?u=sinta" alt=""><span class="font-medium text-sm">Sinta Aulia</span></li>
                            </ul>
                        </div>

                         {{-- Cari Partner --}}
                        <div class="bg-white p-6 rounded-2xl shadow-md text-center">
                            <i class="ri-user-search-line text-4xl text-primary"></i>
                            <h3 class="text-lg font-bold text-gray-800 mt-2">Cari Partner Belajar</h3>
                            <p class="text-sm text-gray-500 mt-1 mb-3">Temukan anggota lain untuk berkolaborasi dalam proyek atau belajar bersama.</p>
                            <button class="w-full px-4 py-2 text-sm font-semibold text-primary bg-secondary rounded-lg hover:bg-opacity-80">
                                Cari Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
@endsection
