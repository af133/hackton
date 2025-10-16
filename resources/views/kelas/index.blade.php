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
                <form method="GET" action="{{ route('kelas.saya') }}" class="mb-6 relative max-w-md">
                    <input
                        type="text"
                        name="search"
                        placeholder="Cari kelas berdasarkan judul..."
                        value="{{ request('search') }}"
                        class="pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-700 rounded-lg w-full
                            bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 placeholder-gray-400
                            focus:ring-2 focus:ring-indigo-500 outline-none transition"
                    >
                    <i class="ri-search-line absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </form>
                {{-- Kontainer Utama dengan Alpine.js untuk Tabs --}}
                <div x-data="{ activeTab: 'all' }">
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @elseif (session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                            {{ session('error') }}
                        </div>
                    @endif
                    {{-- Navigasi Tabs --}}
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button @click="activeTab = 'all'"
                                    :class="{ 'border-indigo-500 text-primary': activeTab === 'all', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'all' }"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Semua Kelas
                            </button>
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
                    <!-- Search Bar -->


                    {{-- Konten Tab --}}
                    <div class="mt-6">

                        {{-- 3. TAB: Semua Kelas --}}
                        <div x-show="activeTab === 'all'" x-transition>
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                                @forelse ($semuaKelas as $kelas)
                                    @include('components.kelas-card', ['kelas' => $kelas, 'tipe' => 'jelajah'])
                                @empty
                                    <p class="text-gray-600">Belum ada kelas tersedia.</p>
                                @endforelse
                            </div>
                        </div>
                        {{-- 1. TAB: Kelas yang Saya Ikuti --}}
                        <div x-show="activeTab === 'diikuti'" x-transition>
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                                @forelse ($kelasDiikuti as $kelas)
                                    @include('components.kelas-card', ['kelas' => $kelas, 'tipe' => 'diikuti'])
                                @empty
                                    <p class="text-gray-600">Anda belum mengikuti kelas apa pun.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- 2. TAB: Kelas yang Saya Miliki --}}
                        <div x-show="activeTab === 'dimiliki'" x-transition>
                            <div class="flex justify-end mb-4">
                                <a href="{{ route('kelas.create') }}" class="px-5 py-2 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-lg shadow-sm">
                                    <i class="ri-add-line mr-1"></i>Buat Kelas Baru
                                </a>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                                @forelse ($kelasSaya as $kelas)
                                    @include('components.kelas-card', ['kelas' => $kelas, 'tipe' => 'dimiliki'])
                                @empty
                                    <p class="text-gray-600">Anda belum membuat kelas apa pun.</p>
                                @endforelse
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
