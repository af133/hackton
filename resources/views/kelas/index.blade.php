@extends('layouts.app')

@section('title', 'Kelas Saya - SkillSwap')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Kelas Saya</h1>

                {{-- Kontainer Utama dengan Alpine.js untuk Tabs --}}
                <div x-data="{ activeTab: 'diikuti' }">

                    {{-- Navigasi Tabs --}}
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button @click="activeTab = 'diikuti'"
                                    :class="{ 'border-indigo-500 text-primary': activeTab === 'diikuti', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'diikuti' }"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Kelas yang Saya Ikuti
                            </button>
                            <button @click="activeTab = 'dimiliki'"
                                    :class="{ 'border-indigo-500 text-primary': activeTab === 'dimiliki', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'dimiliki' }"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Kelas yang Saya Miliki
                            </button>
                        </nav>
                    </div>

                    {{-- Konten Tab --}}
                    <div class="mt-6">
                        {{--
                        ======================================================================
                        1. KONTEN TAB: KELAS YANG SAYA IKUTI
                        ======================================================================
                        --}}
                        <div x-show="activeTab === 'diikuti'" x-transition>
                    
                        </div>

                        {{--
                        ======================================================================
                        2. KONTEN TAB: KELAS YANG SAYA MILIKI
                        ======================================================================
                        --}}
                        <div x-show="activeTab === 'dimiliki'" x-transition>
                            <div class="flex justify-end mb-4">
                                <button class="px-5 py-2 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-lg shadow-sm" route="{{ route('kelas.create') }}">
                                    <i class="ri-add-line mr-1"></i>
                                    <a href="{{ route('kelas.create') }}">Buat Kelas Baru</a>
                                </button>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">

                                {{-- Contoh Kartu Kelas yang Dimiliki --}}
                               @foreach ($kelasSaya as $kelas)
                               @php
                                   $gambarPath = $kelas->path_gambar ? asset('storage/kelas/' . $kelas->path_gambar) : asset('images/default-thumbnail.jpg');
                               @endphp
                           
                                <div class="bg-white rounded-2xl shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300">
                                   <div class="h-40 bg-cover bg-center" style="background-image: url('{{ asset($gambarPath) }}');"></div>

                                    <div class="p-5">
                                       <div class="mt-3 flex justify-between items-center">
                                            <h3 class="text-lg font-bold text-gray-900 truncate">
                                                {{ $kelas->judul_kelas }}
                                            </h3>
                                            <span class="text-sm font-semibold 
                                                        px-2 py-1 rounded 
                                                        {{ $kelas->is_draft ? 'bg-gray-200 text-gray-800' : 'bg-green-100 text-green-800' }}">
                                                {{ $kelas->is_draft ? 'Draft' : 'Publish' }}
                                            </span>
                                        </div>

                                        <div class="mt-3 flex justify-between text-sm text-gray-600 border-t pt-3">
                                            <div class="flex items-center gap-2">
                                                <i class="ri-group-line text-indigo-500"></i>
                                                <span>{{ $kelas->detailPembelians->count() }} Murid</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <i class="ri-star-s-fill text-yellow-400"></i>
                                                <span>{{ $kelas->rating }} ({{ $kelas->detailPembelians->count() }} review)</span>
                                            </div>
                                        </div>
                                        
                                        <button class="mt-4 w-full px-5 py-2.5 text-sm font-semibold text-primary-dark bg-indigo-100 hover:bg-indigo-200 rounded-lg transition-colors">
                                            <a href="{{ route('modul.create') }}">Kelola Kelas</a>
                                        </button>
                                    </div>
                                </div>
                                @endforeach

                                {{-- Akhir dari contoh kartu --}}
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
