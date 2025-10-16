@extends('layouts.app')

@section('title', 'Daftar Live Class - SkillSwap')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gradient-to-br from-purple-50 via-indigo-50 to-blue-50 dark:from-gray-900 dark:to-gray-950">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            {{-- Background gradien lembut --}}
            <div class="hidden md:block absolute top-0 left-0 w-full h-full bg-gradient-to-br from-purple-100 via-indigo-100 to-blue-100 opacity-40 dark:opacity-20 -z-0"></div>

            <main class="relative z-10 p-6 md:p-8">
                
                {{-- Tombol Kembali --}}
                <div class="mb-6">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center gap-2 text-indigo-600 dark:text-indigo-400 font-semibold hover:underline">
                        <i class="ri-arrow-left-line text-lg"></i>
                        <span>Kembali ke Halaman Utama</span>
                    </a>
                </div>

                {{-- Header --}}
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-3xl font-extrabold bg-gradient-to-r from-purple-600 to-indigo-600 bg-clip-text text-transparent">
                        Daftar Live Class
                    </h1>
                    <div class="text-gray-500 dark:text-gray-400 text-sm">
                        Total: {{ $liveClasses->count() }} sesi
                    </div>
                </div>

                {{-- Daftar Card --}}
                @if ($liveClasses->isEmpty())
                    <div class="bg-white/70 dark:bg-gray-800/50 p-8 rounded-2xl shadow text-center border border-purple-200 dark:border-gray-700">
                        <i class="ri-live-line text-4xl text-purple-400 mb-3"></i>
                        <p class="text-gray-600 dark:text-gray-300 text-lg font-medium">Belum ada Live Class tersedia saat ini.</p>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">Coba cek kembali nanti atau bergabung dengan komunitas untuk update terbaru.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach ($liveClasses as $liveClass)
                            @php
                                $tanggalLive = \Carbon\Carbon::parse($liveClass->tanggal);
                                $sudahLewat = $tanggalLive->endOfDay()->isPast();
                            @endphp

                            <div class="bg-white/80 dark:bg-gray-800/60 backdrop-blur-sm p-5 rounded-2xl shadow-lg border border-purple-100 dark:border-gray-700 transition-transform transform hover:-translate-y-1 hover:shadow-xl">
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0 w-14 h-14 flex items-center justify-center bg-gradient-to-br from-purple-600 to-indigo-500 text-white rounded-xl shadow-md">
                                        <i class="ri-video-on-line text-2xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">{{ $liveClass->judul }}</h3>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                                {{ $sudahLewat ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                                {{ $sudahLewat ? 'Selesai' : 'Akan Datang' }}
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $liveClass->kelas->nama ?? 'Kelas Tidak Diketahui' }}</p>
                                    </div>
                                </div>

                                <div class="mt-4 text-gray-600 dark:text-gray-300 space-y-1">
                                    <div class="flex items-center gap-2">
                                        <i class="ri-calendar-line text-purple-600 dark:text-purple-400"></i>
                                        <span>{{ $tanggalLive->translatedFormat('d F Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="ri-time-line text-indigo-600 dark:text-indigo-400"></i>
                                        <span>{{ $liveClass->waktu_mulai }} - {{ $liveClass->waktu_selesai }} ({{ strtoupper($liveClass->zona_waktu) }})</span>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    @if($sudahLewat)
                                        <button class="inline-flex items-center justify-center w-full px-4 py-2 bg-gray-400 text-white rounded-lg font-medium cursor-not-allowed" disabled>
                                            <i class="ri-lock-line mr-2"></i> Sesi Berakhir
                                        </button>
                                    @else
                                        <a href="{{ route('live.show', [
                                            'room' => rawurlencode($liveClass->judul),
                                            'kelasId' => $liveClass->kelas_id,
                                            'jenisLive' => 'Kelas'
                                        ]) }}"
                                           class="inline-flex items-center justify-center w-full px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg font-medium hover:from-purple-700 hover:to-indigo-700 transition-all">
                                            <i class="ri-play-circle-line mr-2"></i> Lihat Detail
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </main>
        </div>
    </div>

    @include('components.navbar-mobile')
</div>
@endsection
