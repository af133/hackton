@extends('layouts.app')

@section('title', 'Daftar Misi - SkillSwap')
@section('body_class', 'bg-background')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-background">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="container mx-auto px-6 py-8">

                <div class="bg-white p-6 md:p-8 rounded-2xl shadow-md">
                    <h1 class="text-3xl font-bold text-gray-800">Daftar Misi & Badges</h1>
                    <p class="mt-2 text-gray-600">Selesaikan misi untuk mendapatkan badge dan tunjukkan keahlianmu!</p>
                </div>

                <div class="mt-8">
                    {{--
                    ======================================================================
                    1. INDIVIDUAL BADGES (YANG SUDAH DIMILIKI)
                    ======================================================================
                    --}}
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Individual Badges</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Individual Badge Card --}}
                            <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                                <img src="{{ asset('images/Badge.png') }}" alt="Fast Learner Badge" class="w-full h-auto object-cover">
                                <div class="p-5 bg-primary/5">
                                    <h3 class="text-lg font-bold text-primary">Fast Learner</h3>
                                    <p class="text-sm text-gray-600 mt-1">Badge ini diberikan kepada pengguna yang cepat dalam menyelesaikan kursus pertama mereka.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--
                    ======================================================================
                    2. GENERAL BADGES (YANG SUDAH DIMILIKI / DALAM PROGRES)
                    ======================================================================
                    --}}
                    <div class="mt-10">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">General Badges</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            {{-- General Badge Card 1 --}}
                            <div class="bg-white p-5 rounded-2xl shadow-md flex items-center gap-5">
                                <div class="w-20 h-20 flex-shrink-0 flex items-center justify-center bg-gray-100 rounded-lg">
                                    <img src="{{ asset('images/BadgeAchive.png') }}" alt="Top Mentor Badge" class="w-20 h-20">
                                </div>
                                <div class="flex-grow">
                                    <p class="font-bold text-gray-800">Top Mentor</p>
                                    <p class="text-xs text-gray-500 mb-2">Reputasi 60% tercapai</p>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-primary h-2 rounded-full" style="width: 60%"></div>
                                    </div>
                                </div>
                            </div>
                             {{-- Add more general badges here --}}
                        </div>
                    </div>

                    {{--
                    ======================================================================
                    3. LOCKED BADGES (YANG BELUM DIMILIKI)
                    ======================================================================
                    --}}
                    <div class="mt-10">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Locked Badges</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                           {{-- Locked Badge Card 1 --}}
                           <div class="bg-white p-5 rounded-2xl shadow-md opacity-60">
                                <div class="flex items-center gap-5">
                                    <div class="w-20 h-20 flex-shrink-0 flex items-center justify-center bg-gray-200 rounded-lg filter grayscale">
                                        <img src="{{ asset('images/Generous Sharer.png') }}" alt="Master Teacher Badge" class="w-20 h-20">
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-bold text-gray-500">Master Teacher</p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            <i class="ri-lock-fill align-bottom"></i>
                                            <span class="font-semibold">Syarat:</span> Selesaikan 5 kursus dengan rating di atas 4.5.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- Locked Badge Card 2 --}}
                           <div class="bg-white p-5 rounded-2xl shadow-md opacity-60">
                                <div class="flex items-center gap-5">
                                    <div class="w-20 h-20 flex-shrink-0 flex items-center justify-center bg-gray-200 rounded-lg filter grayscale">
                                        <i class="ri-question-mark text-4xl text-gray-400"></i>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="font-bold text-gray-500">Explorer</p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            <i class="ri-lock-fill align-bottom"></i>
                                            <span class="font-semibold">Syarat:</span> Ikuti kursus dari 3 kategori yang berbeda.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- Add more locked badges here --}}
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
    @include('components.navbar-mobile')
</div>
@endsection
