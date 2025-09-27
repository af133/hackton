@extends('layouts.app')

@section('title', 'Profil Pengguna - SkillSwap')
@section('body_class', 'bg-background') {{-- Menggunakan warna background baru --}}

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-background">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">

                {{--
                ======================================================================
                1. KARTU PROFIL UTAMA (REDESAIN)
                ======================================================================
                --}}
                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-md mb-8">
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 md:gap-8">
                        <div class="flex-shrink-0">
                            <img class="h-32 w-32 rounded-full object-cover ring-4 ring-secondary" src="https://i.pravatar.cc/300?u=andre" alt="User Avatar">
                        </div>
                        <div class="flex-grow w-full">
                            <div class="flex items-start justify-between">
                                <h1 class="text-3xl font-bold text-gray-800">Aisyah Farah</h1>
                                <a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-primary p-2 rounded-full bg-gray-100 hover:bg-secondary transition-colors" title="Edit Profil">
                                    <i class="ri-edit-2-line text-xl"></i>
                                </a>
                            </div>
                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 text-gray-600">
                                <p><strong class="font-medium text-gray-500 w-32 inline-block">Registrasi</strong>: 24 Sep 2025</p>
                                <p><strong class="font-medium text-gray-500 w-32 inline-block">Tanggal Lahir</strong>: 08 Apr 1999</p>
                                <p><strong class="font-medium text-gray-500 w-32 inline-block">Lokasi</strong>: Jakarta, Indonesia</p>
                                <p><strong class="font-medium text-gray-500 w-32 inline-block">Telepon</strong>: (+62) 812 3456 7890</p>
                                <p class="md:col-span-2"><strong class="font-medium text-gray-500 w-32 inline-block">E-mail</strong>: aisyah.farah@example.com</p>
                            </div>
                            <div class="mt-5 flex items-center gap-x-3">
                                <a href="#" class="w-10 h-10 flex items-center justify-center text-gray-500 bg-gray-100 rounded-full hover:bg-primary hover:text-white transition-colors"><i class="ri-instagram-line text-xl"></i></a>
                                <a href="#" class="w-10 h-10 flex items-center justify-center text-gray-500 bg-gray-100 rounded-full hover:bg-primary hover:text-white transition-colors"><i class="ri-facebook-fill text-xl"></i></a>
                                <a href="#" class="w-10 h-10 flex items-center justify-center text-gray-500 bg-gray-100 rounded-full hover:bg-primary hover:text-white transition-colors"><i class="ri-linkedin-fill text-xl"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    {{-- Kolom Kiri --}}
                    <div class="lg:col-span-2 space-y-8">
                        {{-- PENGALAMAN KERJA --}}
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <h2 class="text-xl font-bold text-gray-800 mb-5">Pengalaman Kerja</h2>
                            <div class="space-y-6">
                                <div class="flex gap-x-4">
                                    <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center bg-background rounded-lg text-primary"><i class="ri-building-4-line text-2xl"></i></div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">UI/UX Designer</h3>
                                        <p class="text-sm text-primary">Creative Agency</p>
                                        <p class="text-xs text-gray-500 mt-1">Jan 2023 - Sekarang</p>
                                    </div>
                                </div>
                                <div class="flex gap-x-4">
                                    <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center bg-background rounded-lg text-primary"><i class="ri-computer-line text-2xl"></i></div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">Frontend Developer (Intern)</h3>
                                        <p class="text-sm text-primary">Tech Startup Inc.</p>
                                        <p class="text-xs text-gray-500 mt-1">Jul 2022 - Des 2022</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- PORTOFOLIO --}}
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <h2 class="text-xl font-bold text-gray-800 mb-5">Portofolio</h2>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <img src="https://images.unsplash.com/photo-1559028006-44a0a99490e1?q=80&w=1974" class="rounded-lg object-cover w-full h-48 hover:opacity-90 cursor-pointer transition-opacity" alt="Portfolio 1">
                                <img src="https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?q=80&w=2070" class="rounded-lg object-cover w-full h-48 hover:opacity-90 cursor-pointer transition-opacity" alt="Portfolio 2">
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="lg:col-span-1 space-y-8">
                        {{-- STATISTIK & KEAHLIAN --}}
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <h2 class="text-xl font-bold text-gray-800 mb-5">Statistik & Keahlian</h2>
                            <div class="grid grid-cols-2 gap-4 text-center mb-6">
                                <div><p class="text-2xl font-bold">12</p><p class="text-sm text-gray-500">Kursus</p></div>
                                <div><p class="text-2xl font-bold">150</p><p class="text-sm text-gray-500">Skill Kredit</p></div>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 text-sm bg-secondary text-primary rounded-full font-bold">UI/UX Design</span>
                                <span class="px-3 py-1 text-sm bg-secondary text-primary rounded-full font-bold">Prototyping</span>
                                <span class="px-3 py-1 text-sm bg-secondary text-primary rounded-full font-bold">HTML & CSS</span>
                            </div>
                        </div>

                        {{-- KURSUS SAYA (REDESAIN TOTAL) --}}
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <h2 class="text-xl font-bold text-gray-800 mb-5">Kursus Saya</h2>
                            <div class="relative space-y-6">
                                <!-- Garis Timeline -->
                                <div class="absolute left-5 top-2 bottom-2 w-1 bg-secondary rounded-full"></div>

                                <!-- Item Kursus 1 (Selesai) -->
                                <div class="flex items-center gap-x-4 relative">
                                    <div class="w-10 h-10 rounded-full bg-primary flex-shrink-0 flex items-center justify-center ring-4 ring-white z-10">
                                        <i class="ri-check-line text-white text-xl"></i>
                                    </div>
                                    <div class="flex-grow bg-background p-3 rounded-lg">
                                        <h3 class="font-semibold text-gray-800 text-sm">UX/UI Design - Website</h3>
                                        <p class="text-xs text-gray-500">68 Pelajaran</p>
                                    </div>
                                </div>
                                <!-- Item Kursus 2 (Mulai) -->
                                 <div class="flex items-center gap-x-4 relative">
                                    <div class="w-10 h-10 rounded-full bg-primary flex-shrink-0 flex items-center justify-center ring-4 ring-white z-10">
                                        <i class="ri-play-fill text-white text-xl"></i>
                                    </div>
                                    <div class="flex-grow bg-background p-3 rounded-lg">
                                        <h3 class="font-semibold text-gray-800 text-sm">UX/UI Design - Animasi</h3>
                                        <p class="text-xs text-gray-500">12 Pelajaran</p>
                                    </div>
                                </div>
                                <!-- Item Kursus 3 (Belum Mulai) -->
                                 <div class="flex items-center gap-x-4 relative">
                                    <div class="w-10 h-10 rounded-full bg-gray-300 flex-shrink-0 ring-4 ring-white z-10"></div>
                                    <div class="flex-grow bg-background p-3 rounded-lg">
                                        <h3 class="font-semibold text-gray-500 text-sm">UX/UI Design - Aplikasi</h3>
                                        <p class="text-xs text-gray-400">12 Pelajaran</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @include('components.navbar-mobile')
</div>
@endsection
