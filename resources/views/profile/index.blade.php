@extends('layouts.app')

@section('title', 'Profil Pengguna - SkillSwap')
@section('body_class', 'bg-background') {{-- Menggunakan warna background dari palet --}}

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-background">
    @include('components.sidebar') {{-- Anggap komponen sidebar ada --}}

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile') {{-- Anggap komponen header mobile ada --}}

        <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="container mx-auto px-6 py-8">

                {{--
                ======================================================================
                BAGIAN ATAS: PROFIL PENGGUNA & BADGE
                ======================================================================
                --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                    {{-- KARTU PROFIL UTAMA --}}
                    <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-md">
                        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                            <div class="flex-shrink-0">
                                <img class="h-32 w-32 rounded-full object-cover ring-4 ring-secondary" src="{{ $user->profile_photo_url }}" alt="User Avatar">
                            </div>
                            <div class="flex-grow w-full text-center sm:text-left">
                                <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
                                <p class="mt-2 text-gray-600 max-w-lg">
                                    {{$user->description}}
                                </p>
                                <div class="mt-4 flex flex-wrap justify-center sm:justify-start items-center gap-x-6 gap-y-3">
                                    <div class="flex items-center justify-start gap-2 bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-100 w-fit">
                                        <i class="ri-money-dollar-circle-fill text-yellow-500 text-2xl"></i>
                                        <span class="font-semibold text-gray-800 text-base">
                                            {{ $user->koin }} <span class="text-sm text-gray-500">coin</span>
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-x-3 text-2xl">
                                        <a href="mailto:{{ $user->email }}" class="text-gray-400 hover:text-primary transition-colors" title="Mail"><i class="ri-mail-line"></i></a>
                                        <a href="{{ $user->instagram_url }}" class="text-gray-400 hover:text-primary transition-colors" title="Instagram"><i class="ri-instagram-line"></i></a>
                                        <a href="{{ $user->linkedin_url }}" class="text-gray-400 hover:text-primary transition-colors" title="LinkedIn"><i class="ri-linkedin-box-fill"></i></a>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4">
                                    <p class="font-semibold text-gray-500 mb-2">Level Skill:</p>
                                    <div class="flex flex-wrap justify-center sm:justify-start gap-2">
                                        @foreach ($user->skills as $skill)
                                            <span class="px-3 py-1 text-sm bg-secondary text-primary rounded-full font-bold">{{ $skill->name }}: <span class="font-normal">{{ $skill->level }}</span></span>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-center sm:justify-start items-center gap-x-3">
                                    <a href="{{ route('profile.edit') }}" class="px-5 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-sm hover:bg-indigo-700 transition-colors">Edit Profil</a>
                                    <a href="{{ $user->cv_path }}" class="px-5 py-2 bg-primary text-white font-semibold rounded-lg shadow-sm hover:bg-primary/90 transition-colors">View CV</a>
                                    <a href="{{ $user->portfolio_path }}" class="px-5 py-2 bg-gray-100 text-gray-800 font-semibold rounded-lg shadow-sm hover:bg-gray-200 transition-colors">View Portofolio</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KARTU BADGE --}}
                    <div class="bg-white p-6 rounded-2xl shadow-md">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold text-gray-800">Badges</h2>
                            <a href="{{ route('profile.mission') }}" class="text-sm font-semibold text-primary hover:underline flex items-center gap-1">
                                Lihat Misi
                                <i class="ri-arrow-right-s-line"></i>
                            </a>
                        </div>
                        <div class="space-y-4">
                             <div>
                                <h3 class="font-semibold text-gray-600 text-sm mb-2">Individual Badge</h3>
                                <div class="rounded-xl overflow-hidden shadow-sm">
                                    <img src="{{ asset('images/Badge.png') }}" alt="Fast Learner Badge" class="w-full h-auto object-cover">
                                </div>
                            </div>
                             <div>
                                <h3 class="font-semibold text-gray-600 text-sm">General Badge</h3>
                                <div class="flex items-center gap-3 mt-2">
                                    <div class="w-20 h-20 flex-shrink-0 flex items-center justify-center bg-gray-100 rounded-lg">
                                        <img src="{{ asset('images/BadgeAchive.png') }}" alt="Top Mentor Badge" class="w-20 h-20">
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-bold text-gray-700 text-sm">Top Mentor</p>
                                        <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                            <div class="bg-primary h-1.5 rounded-full" style="width: 60%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{--
                ======================================================================
                BAGIAN BAWAH: DAFTAR KELAS
                ======================================================================
                --}}
                <div class="space-y-8">
                    {{-- KELAS YANG DIMILIKI (DIAJARKAN) --}}
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-bold text-gray-800">Materi yang diajarkan</h2>
                            <a href="#" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            {{-- Course Card 1 (Owned) --}}
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 transform hover:-translate-y-1 transition-all duration-300 hover:shadow-lg">
                                <div class="h-48 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1581291518857-4e27b48ff24e?q=80&w=2070')"></div>
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-gray-900">Apa itu UI dan UX?</h3>
                                    <p class="text-sm text-gray-500">Oleh Aisyah Farah H</p>
                                    <div class="flex items-center text-yellow-400 mt-1"><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-half-s-line"></i></div>
                                    <div class="flex items-center justify-between mt-4">
                                        <button class="px-6 py-2.5 font-semibold text-white bg-primary hover:bg-primary/90 rounded-lg transition-colors">Lihat Materi</button>
                                        <div class="flex items-center gap-x-2 text-gray-400">
                                            <button class="w-10 h-10 hover:text-pink-500 rounded-full hover:bg-gray-100 transition-colors"><i class="ri-heart-line"></i></button>
                                            <button class="w-10 h-10 hover:text-indigo-500 rounded-full hover:bg-gray-100 transition-colors"><i class="ri-share-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Course Card 2 (Owned) --}}
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 transform hover:-translate-y-1 transition-all duration-300 hover:shadow-lg">
                                <div class="h-48 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1555774698-0b77e0ab232f?q=80&w=2070')"></div>
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-gray-900">Dasar Prototyping</h3>
                                    <p class="text-sm text-gray-500">Oleh Aisyah Farah H</p>
                                    <div class="flex items-center text-yellow-400 mt-1"><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i></div>
                                    <div class="flex items-center justify-between mt-4">
                                        <button class="px-6 py-2.5 font-semibold text-white bg-primary hover:bg-primary/90 rounded-lg transition-colors">Lihat Materi</button>
                                        <div class="flex items-center gap-x-2 text-gray-400">
                                            <button class="w-10 h-10 hover:text-pink-500 rounded-full hover:bg-gray-100 transition-colors"><i class="ri-heart-line"></i></button>
                                            <button class="w-10 h-10 hover:text-indigo-500 rounded-full hover:bg-gray-100 transition-colors"><i class="ri-share-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             {{-- Course Card 3 (Owned) --}}
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 transform hover:-translate-y-1 transition-all duration-300 hover:shadow-lg">
                                <div class="h-48 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1522204523234-8729aa6e3d5f?q=80&w=2070')"></div>
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-gray-900">Design System Lanjutan</h3>
                                    <p class="text-sm text-gray-500">Oleh Aisyah Farah H</p>
                                    <div class="flex items-center text-yellow-400 mt-1"><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-line"></i></div>
                                    <div class="flex items-center justify-between mt-4">
                                        <button class="px-6 py-2.5 font-semibold text-white bg-primary hover:bg-primary/90 rounded-lg transition-colors">Lihat Materi</button>
                                        <div class="flex items-center gap-x-2 text-gray-400">
                                            <button class="w-10 h-10 hover:text-pink-500 rounded-full hover:bg-gray-100 transition-colors"><i class="ri-heart-line"></i></button>
                                            <button class="w-10 h-10 hover:text-indigo-500 rounded-full hover:bg-gray-100 transition-colors"><i class="ri-share-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KELAS YANG DIIKUTI --}}
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-bold text-gray-800">Materi yang diikuti</h2>
                            <a href="#" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                             {{-- Course Card 1 (Following) --}}
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 transform hover:-translate-y-1 transition-all duration-300 hover:shadow-lg">
                                <div class="h-48 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1557862921-37829c790f19?q=80&w=2071')"></div>
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-gray-900">Digital Marketing</h3>
                                    <p class="text-sm text-gray-500">Oleh Ahmad Sapta</p>
                                    <div class="flex items-center text-yellow-400 mt-1"><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-s-fill"></i><i class="ri-star-half-s-line"></i></div>
                                    <div class="flex items-center justify-between mt-4">
                                        <button class="px-6 py-2.5 font-semibold text-white bg-primary hover:bg-primary/90 rounded-lg transition-colors">Lanjutkan Sesi</button>
                                        <div class="flex items-center gap-x-2 text-gray-400">
                                            <button class="w-10 h-10 hover:text-pink-500 rounded-full hover:bg-gray-100 transition-colors"><i class="ri-heart-line"></i></button>
                                            <button class="w-10 h-10 hover:text-indigo-500 rounded-full hover:bg-gray-100 transition-colors"><i class="ri-share-line"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           {{-- Add more followed course cards here --}}
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
    @include('components.navbar-mobile') {{-- Anggap komponen navbar mobile ada --}}
</div>

{{-- Pastikan Anda telah menyertakan Remix Icon CDN di file layout utama (layouts.app) --}}
{{-- <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" /> --}}
@endsection


