@extends('layouts.app')

@section('title', 'Live Class - SkillSwap')
@section('body_class', 'bg-gray-100')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen overflow-hidden">

    {{-- Sidebar Aplikasi Utama (Tetap ada di kiri, tapi kita akan tambahkan sidebar alat kelas di dalam konten) --}}
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-hidden"> {{-- Hapus overflow-y-auto di sini --}}
            <main class="h-full w-full flex flex-col p-4 md:p-6 lg:p-8">

                {{-- Header Kelas Ringkas --}}
                <div class="mb-4 flex justify-between items-center pb-2 border-b">
                    <h1 class="text-xl font-bold text-gray-900">Live Class: Intro to AI - Diskusi Kelompok</h1>
                    <span class="px-3 py-1 text-sm font-semibold text-indigo-700 bg-indigo-100 rounded-full">
                        <i class="fas fa-users mr-1"></i> 6 Aktif
                    </span>
                </div>

                {{-- Konten Utama: Sidebar Alat + Grid Video --}}
                <div class="flex flex-1 overflow-hidden bg-white rounded-xl shadow-2xl">
                    
                    {{-- 1. Sidebar Alat Interaksi (Kiri, Mirip Zoom/WiziQ) --}}
                    <div class="w-16 bg-gray-900 flex flex-col items-center py-4 space-y-6 border-r border-gray-800">
                        {{-- Icon Placeholder --}}
                        <button class="text-white hover:text-indigo-400 p-2 rounded-lg bg-indigo-600">
                            <i class="fas fa-th text-xl"></i> {{-- Galeri --}}
                        </button>
                        <button class="text-gray-400 hover:text-indigo-400 p-2 rounded-lg">
                            <i class="fas fa-comment-alt text-xl"></i> {{-- Chat --}}
                        </button>
                        <button class="text-gray-400 hover:text-indigo-400 p-2 rounded-lg">
                            <i class="fas fa-users text-xl"></i> {{-- Peserta --}}
                        </button>
                        <button class="text-gray-400 hover:text-indigo-400 p-2 rounded-lg">
                            <i class="fas fa-file-alt text-xl"></i> {{-- File/Materi --}}
                        </button>
                        
                        <div class="mt-auto pt-6 border-t border-gray-700 w-full text-center">
                            <button class="text-gray-400 hover:text-red-500 p-2 rounded-lg">
                                <i class="fas fa-cog text-xl"></i> {{-- Setting --}}
                            </button>
                        </div>
                    </div>

                    {{-- 2. Area Video dan Kontrol --}}
                    <div class="flex-1 flex flex-col bg-gray-900">
                        
                        {{-- Kontrol Atas (Recording, Status) --}}
                        <div class="absolute top-4 right-4 z-10 flex space-x-3">
                            <span class="px-3 py-1 text-sm font-medium text-white bg-red-600 rounded-full flex items-center shadow-md">
                                <i class="fas fa-circle text-white text-xs mr-1 animate-pulse"></i> REC
                            </span>
                            <button class="p-2 bg-gray-700 text-white rounded-full hover:bg-gray-600">
                                <i class="fas fa-expand"></i> {{-- Fullscreen --}}
                            </button>
                        </div>

                        {{-- Grid Video (Konten Utama) --}}
                        <div class="flex-1 p-6 grid grid-cols-2 md:grid-cols-3 gap-4 overflow-y-auto">
                            
                            {{-- Video Item --}}
                            @php
                                $participants = [
                                    ['name' => 'Mentor Jane', 'status' => 'Muted', 'color' => 'red'], 
                                    ['name' => 'Alice', 'status' => 'Live', 'color' => 'green'], 
                                    ['name' => 'Bob', 'status' => 'Live', 'color' => 'green'],
                                    ['name' => 'Charlie', 'status' => 'Live', 'color' => 'green'],
                                    ['name' => 'David', 'status' => 'Live', 'color' => 'green'],
                                    ['name' => 'Eve', 'status' => 'Muted', 'color' => 'red'],
                                ];
                            @endphp

                            @foreach ($participants as $p)
                                <div class="relative w-full aspect-video bg-gray-800 rounded-lg overflow-hidden shadow-lg border-2 border-{{ $p['color'] }}-500">
                                    {{-- Video/Avatar Placeholder --}}
                                    <img src="https://via.placeholder.com/300x168?text={{ $p['name'] }}" class="w-full h-full object-cover opacity-70" alt="{{ $p['name'] }}">
                                    
                                    {{-- Nama dan Status --}}
                                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 p-2 flex justify-between items-center">
                                        <span class="text-sm font-semibold text-white truncate">{{ $p['name'] }}</span>
                                        <i class="fas fa-microphone{{ $p['status'] == 'Muted' ? '-slash text-red-500' : ' text-green-500' }} ml-2"></i>
                                    </div>
                                </div>
                            @endforeach
                            
                            {{-- Placeholder jika kurang dari 6 --}}
                            <div class="relative w-full aspect-video bg-gray-800 rounded-lg flex items-center justify-center border-dashed border-2 border-gray-600">
                                <span class="text-gray-500 font-medium">Menunggu Peserta...</span>
                            </div>
                        </div>

                        {{-- Control Bar Bawah (Action Buttons) --}}
                        <div class="p-4 bg-gray-800 flex justify-center space-x-8">
                            
                            {{-- Mute/Unmute --}}
                            <button class="p-3 rounded-full bg-red-600 text-white hover:bg-red-700 transition">
                                <i class="fas fa-microphone-slash text-xl"></i>
                            </button>
                            
                            {{-- Video On/Off --}}
                            <button class="p-3 rounded-full bg-indigo-600 text-white hover:bg-indigo-700 transition">
                                <i class="fas fa-video-slash text-xl"></i>
                            </button>

                            {{-- Share Screen --}}
                            <button class="p-3 rounded-full bg-green-600 text-white hover:bg-green-700 transition">
                                <i class="fas fa-desktop text-xl"></i>
                            </button>

                            {{-- Leave/End Class --}}
                            <button class="px-5 py-3 rounded-xl bg-red-500 text-white font-semibold hover:bg-red-600 transition">
                                <i class="fas fa-phone-slash mr-2"></i> End Session
                            </button>
                        </div>
                    </div>

                    {{-- 3. Area Tambahan (Chat/Q&A) - Sembunyikan/Buka jika tombol di Sidebar Kiri diklik --}}
                    {{-- Anda bisa menggunakan AlpineJS untuk menampilkan/menyembunyikan komponen ini --}}
                    {{-- Contoh: Chat Sidebar --}}
                    {{-- <div class="w-80 bg-white flex flex-col border-l border-gray-200">
                        <h3 class="p-4 text-lg font-bold">Live Chat</h3>
                        ... Isi Chat ...
                    </div> --}}

                </div>
            </main>
        </div>
    </div>
</div>
@endsection