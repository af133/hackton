@extends('layouts.app')

@section('title', 'Jelajahi Circle - SkillSwap')
@section('body_class', 'bg-background')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-background">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">
                {{-- Header Halaman & Filter --}}
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Jelajahi Circle Komunitas</h1>
                    <p class="text-gray-500 mt-1">Temukan grup, belajar bersama, dan perluas jaringanmu.</p>
                    <div class="mt-6 flex flex-col sm:flex-row items-center gap-4">
                        <div class="relative w-full sm:w-auto flex-grow">
                            <i class="ri-search-line absolute top-1/2 left-4 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Cari berdasarkan nama atau topik..." class="w-full pl-12 pr-4 py-3 text-sm bg-white border-transparent rounded-lg shadow-sm focus:ring-primary focus:border-primary">
                        </div>
                        <div class="flex-shrink-0 flex items-center gap-2">
                            <button class="px-4 py-2 text-sm font-semibold text-white bg-primary rounded-lg">Semua</button>
                            <button class="px-4 py-2 text-sm font-semibold text-gray-600 bg-white rounded-lg hover:bg-gray-100">Teknologi</button>
                            <button class="px-4 py-2 text-sm font-semibold text-gray-600 bg-white rounded-lg hover:bg-gray-100">Desain</button>
                        </div>
                    </div>
                </div>

                {{-- Grid Daftar Circle --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    {{-- Contoh Kartu Circle 1 --}}
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300 flex flex-col">
                        <img class="h-40 w-full object-cover" src="https://images.unsplash.com/photo-1597733336794-12d05021d510?q=80&w=600" alt="AI/ML Banner">
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-gray-900">AI/ML Community</h3>
                            <p class="text-sm text-gray-500 mt-1 flex-grow">Diskusi seputar Artificial Intelligence dan Machine Learning.</p>
                            <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center -space-x-2">
                                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://i.pravatar.cc/150?u=a" alt="">
                                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://i.pravatar.cc/150?u=b" alt="">
                                    <span class="flex items-center justify-center h-8 w-8 rounded-full bg-secondary text-primary text-xs font-bold ring-2 ring-white">+10</span>
                                </div>
                                <a href="#" class="px-4 py-2 text-sm font-semibold text-primary bg-secondary rounded-lg hover:bg-opacity-80">Lihat</a>
                            </div>
                        </div>
                    </div>

                    {{-- Contoh Kartu Circle 2 --}}
                    <div class="bg-white rounded-2xl shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300 flex flex-col">
                        <img class="h-40 w-full object-cover" src="https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?q=80&w=600" alt="UI/UX Banner">
                         <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-gray-900">UI/UX Enthusiast</h3>
                            <p class="text-sm text-gray-500 mt-1 flex-grow">Berbagi portfolio, feedback, dan lowongan kerja seputar UI/UX.</p>
                             <div class="flex items-center justify-between mt-4">
                                <div class="flex items-center -space-x-2">
                                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://i.pravatar.cc/150?u=d" alt="">
                                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white" src="https://i.pravatar.cc/150?u=e" alt="">
                                    <span class="flex items-center justify-center h-8 w-8 rounded-full bg-secondary text-primary text-xs font-bold ring-2 ring-white">+42</span>
                                </div>
                                <a href="#" class="px-4 py-2 text-sm font-semibold text-white bg-primary rounded-lg hover:bg-primary-dark">Join</a>
                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
</div>
@endsection
