@props(['liveClass'])

@php
    $tanggalLive = \Carbon\Carbon::parse($liveClass->tanggal);
    $sudahLewat = $tanggalLive->endOfDay()->isPast();
@endphp

<div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform transform hover:-translate-y-1">
    <div class="p-5">
        <div class="flex justify-between items-start mb-2">
            <h3 class="text-lg font-bold text-gray-800 leading-tight">
                <a href="#" class="hover:text-primary">{{ $liveClass->judul }}</a>
            </h3>
            <span class="flex-shrink-0 ml-4 px-3 py-1 text-xs font-semibold rounded-full
                {{ $sudahLewat ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                {{ $sudahLewat ? 'Selesai' : 'Akan Datang' }}
            </span>
        </div>
        {{-- Menggunakan relasi untuk mendapatkan nama kelas --}}
        <p class="text-sm text-gray-500 mb-3">Dari kelas: {{ $liveClass->kelas->judul_kelas ?? 'N/A' }}</p>

        <div class="text-sm text-gray-600 space-y-1">
            <div class="flex items-center gap-2">
                <i class="ri-calendar-line text-gray-500"></i>
                <span>{{ $tanggalLive->translatedFormat('d F Y') }}</span>
            </div>
            <div class="flex items-center gap-2">
                <i class="ri-time-line text-gray-500"></i>
                <span>{{ \Carbon\Carbon::parse($liveClass->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($liveClass->waktu_selesai)->format('H:i') }}</span>
            </div>
        </div>
    </div>

    <div class="px-5 pb-4">
        @if($sudahLewat)
            <button class="w-full px-4 py-2 bg-gray-300 text-gray-500 rounded-lg font-medium cursor-not-allowed" disabled>
                <i class="ri-lock-line mr-2"></i>Sesi Berakhir
            </button>
        @else
            {{-- Pastikan route 'live.class.show' sudah ada --}}
            <a href="{{ route('live.show', [
                'kelasId' => $liveClass->kelas_id,
                'room' => $liveClass->judul
            ]) }}"
               class="inline-block text-center w-full px-4 py-2 bg-primary text-white rounded-lg font-medium hover:bg-primary-dark transition-all">
                <i class="ri-play-circle-line mr-1"></i>Gabung Sesi
            </a>
        @endif
    </div>
</div>
