@extends('layouts.app')

@section('title', 'Beranda - SkillSwap')

@section('content')

<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
    @include('components.sidebar')
    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            {{-- Background Gradient (Hanya di Desktop) --}}
            <div class="hidden md:block absolute top-0 left-0 w-full h-full bg-gradient-to-br from-purple-200 via-purple-100 to-purple-50 opacity-40 -z-0"></div>

            <main class="relative z-10 p-6 md:p-8">
                {{-- Header Konten (Desktop & Tablet) --}}
                <div class="relative w-full rounded-2xl shadow-lg mb-8">
                    {{-- Gambar Latar & Overlay --}}
                    <img src="{{ asset('images/Hero.png') }}" class="absolute inset-0 w-full h-full object-cover rounded-2xl" alt="Workspace">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-dark to-primary opacity-70 rounded-2xl"></div>

                    {{-- Konten Teks & Profil --}}
                    <div class="relative flex items-start justify-between p-6 md:p-6">

                        {{-- Teks Sambutan --}}
                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold text-white tracking-tight">Selamat Datang Kembali, {{ auth()->user()->name }}!</h1>
                            <p class="text-lg text-indigo-100 mt-1">Siap untuk belajar atau berbagi skill hari ini?</p>
                        </div>

                        {{-- Komponen Profil Pengguna dengan Dropdown --}}
                        <div x-data="{ isDropdownOpen: false }" class="relative flex-shrink-0">
                            {{-- Trigger: Bagian yang di-hover (nama & avatar) --}}
                            <div @mouseenter="isDropdownOpen = true" @mouseleave="isDropdownOpen = false" class="sm:flex items-center gap-x-3 cursor-pointer">
                                <span class="font-semibold text-white text-sm hidden sm:block">{{ auth()->user()->name }}</span>
                                {{-- FIX: Menggunakan accessor untuk foto profil --}}
                                <img class="h-9 w-9 rounded-full object-cover ring-2 ring-white"
                                     src="{{ auth()->user()->profile_photo_url }}"
                                     alt="User avatar">
                            </div>

                            {{-- Dropdown Menu --}}
                            <div x-show="isDropdownOpen"
                                 @mouseenter="isDropdownOpen = true" @mouseleave="isDropdownOpen = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 ring-1 ring-black/5 z-50"
                                 style="display: none;" x-cloak>

                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil Saya</a>
                                <div class="border-t border-gray-100 my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="grid grid-cols-1 xl:grid-cols-12 gap-8">
                    {{-- Kolom Konten Utama (Kiri pada layar besar) --}}
                    <div class="col-span-12 xl:col-span-8">
                        {{-- Report Section --}}
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-5">Report</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                                {{-- Card Skill Kredit --}}
                                <a href="{{ route('skill-credit') }}">
                                <div class="bg-white dark:bg-gray-800/50 p-5 rounded-2xl shadow-md flex items-center gap-5 transition-transform transform hover:-translate-y-1">
                                    <div class="flex-shrink-0 w-16 h-16 flex items-center justify-center bg-primary text-white rounded-2xl">
                                        <i class="ri-graduation-cap-line text-3xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400 text-sm">Skill Kredit</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <i class="ri-money-dollar-circle-fill text-yellow-400 text-2xl"></i>
                                            <p class="text-2xl font-extrabold text-gray-800 dark:text-white">{{ auth()->user()->koin }}</p>
                                        </div>
                                    </div>
                                </div>
                                </a>
                                {{-- Card Rating Reputasi --}}
                                <div class="bg-white dark:bg-gray-800/50 p-5 rounded-2xl shadow-md flex items-center gap-5 transition-transform transform hover:-translate-y-1">
                                    <div class="flex-shrink-0 w-16 h-16 flex items-center justify-center bg-primary text-white rounded-2xl">
                                        <i class="ri-team-line text-3xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400 text-sm">Rating Reputasi</p>
                                       <div class="flex items-center gap-2 mt-1">
                                        {{-- Rating angka --}}
                                        <p class="text-2xl font-extrabold text-gray-800 dark:text-white">
                                            {{ $rating == 0 ? 0 : number_format($rating, 1) }}
                                        </p>

                                        {{-- Bintang --}}
                                        <div class="flex text-yellow-400">
                                            @php
                                                if($rating == 0){
                                                 $fullStars = 0;
                                                 $halfStar = 0;
                                                 $emptyStars = 5;
                                                }
                                                else{
                                                 $fullStars = floor($rating);
                                                 $halfStar = ($rating - $fullStars >= 0.5) ? 1 : 0;
                                                 $emptyStars = 5 - ($fullStars + $halfStar);
                                                }
                                            @endphp

                                            {{-- Bintang penuh --}}
                                            @for ($i = 0; $i < $fullStars; $i++)
                                                <i class="ri-star-s-fill"></i>
                                            @endfor

                                            {{-- Bintang setengah --}}
                                            @if ($halfStar)
                                                <i class="ri-star-half-s-line"></i>
                                            @endif

                                            {{-- Bintang kosong --}}
                                            @for ($i = 0; $i < $emptyStars; $i++)
                                                <i class="ri-star-line"></i>
                                            @endfor
                                        </div>
                                    </div>

                                    </div>
                                </div>

                                {{-- Card Live Class --}}
                                <div class="bg-white dark:bg-gray-800/50 p-5 rounded-2xl shadow-md flex items-center gap-5 transition-transform transform hover:-translate-y-1">
                                    <div class="flex-shrink-0 w-16 h-16 flex items-center justify-center bg-primary text-white rounded-2xl">
                                        <i class="ri-live-line text-3xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400 text-sm">Live Class</p>
                                        <a href="{{ route('liveclass.index') }}">
                                            <p class="text-2xl font-extrabold text-gray-800 dark:text-white mt-1">{{ $allLiveClasses->count()}}</p>
                                        </a>
                                    </div>
                                </div>


                                {{-- Card Materi --}}
                                <a href="{{ route('kelas.show') }}">
                                <div class="bg-white dark:bg-gray-800/50 p-5 rounded-2xl shadow-md flex items-center gap-5 transition-transform transform hover:-translate-y-1">
                                    <div class="flex-shrink-0 w-16 h-16 flex items-center justify-center bg-primary text-white rounded-2xl">
                                        <i class="ri-book-3-line text-3xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-gray-500 dark:text-gray-400 text-sm">Materi</p>
                                        <p class="text-2xl font-extrabold text-gray-800 dark:text-white mt-1">{{ $ikutKelas->count() }}</p>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>

                        {{-- Sesi Saya --}}
                        <div class="mt-8">
                            @if ($ikutKelas->isEmpty())
                                <div class="bg-white dark:bg-gray-800/50 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 text-center">
                                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">Sesi Saya</h3>
                                <p class="text-gray-500 dark:text-gray-400 mb-4">
                                    Anda belum mengikuti sesi apa pun. Mulailah dengan menjelajahi kelas yang tersedia!
                                </p>
                                <a href="{{ route('kelas.show') }}"
                                class="inline-block px-4 py-2 bg-primary text-white rounded-lg hover:bg-blue-primary 600">
                                Lihat Kelas
                                </a>
                                </div>

                            @else
                                <div class="flex items-center justify-between mb-4">
                                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Sesi Saya</h2>
                                    <a href="{{ route('kelas.show') }}" class="text-sm font-medium text-primary  hover:underline">Lihat Semua</a>
                                </div>
                                @foreach ($ikutKelas as $detail )
                                     @include('components.kelas-card', ['kelas' => $detail->kelas, 'tipe' => 'diikuti'])
                                @endforeach
                            @endif
                        </div>
                    </div>
                    {{-- Kolom Panel Info (Kanan pada layar besar) --}}
                    <div class="col-span-12 xl:col-span-4 space-y-8">
                        {{-- Komunitas --}}
                        <div class="bg-white dark:bg-gray-800/50 p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
                             <div class="flex items-center justify-between mb-4">
                                <h3 class="font-semibold text-gray-700 dark:text-gray-200">Komunitas</h3>
                                <a href="{{ route('sosial') }}" class="text-sm font-medium text-primary  hover:underline">Lihat Semua</a>
                            </div>
                            @if ($komunitass->isEmpty())
                                <p class="text-gray-500 dark:text-gray-400 text-center">
                                    Anda belum bergabung dengan komunitas apa pun. Jelajahi dan temukan komunitas yang sesuai dengan minat Anda!
                                </p>
                            @else
                            <ul class="space-y-2">
                                @foreach ($komunitass as $item)
                                    <a href="{{ route('sosial.show', ['id' => $item->id]) }}">
                                        @include('components.community-item', ['komunitas' => $item->community])
                                    </a>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
   @include('components.navbar-mobile')
</div>
@endsection
