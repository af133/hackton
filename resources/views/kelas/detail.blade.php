@extends('layouts.app')

@section('title', 'Detail Kelas: Artificial Intelligence - SkillSwap')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
    {{-- Sidebar (diasumsikan dari layout utama atau di-include) --}}
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        {{-- Mobile Header (Sticky) --}}
        @include('components.header-mobile')

        {{-- Area Konten Utama dengan Scroll --}}
        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">
               @if ($kelas->dibuat_oleh == Auth::id())
                <div class="mb-4 flex justify-end">
                    <form action="{{ route('kelas.toggleStatus', $kelas->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-5 py-2 rounded-lg font-semibold transition-colors duration-300
                                {{ $kelas->is_draft ? 'bg-purple-600 text-white hover:bg-purple-700' : 'bg-purple-300 text-white hover:bg-purple-400' }}">
                            {{ $kelas->is_draft ? 'Set Publish' : 'Set Draft' }}
                        </button>
                    </form>
                </div>
                @endif


                {{--
                ======================================================================
                1. BANNER KELAS
                ======================================================================
                --}}
                <div class="relative w-full rounded-2xl shadow-lg overflow-hidden mb-8">
                    <img src="{{ $kelas->kelas_thumbnail_url }}" class="absolute inset-0 w-full h-full object-cover" alt="AI Banner">
                    <div class="absolute inset-0 bg-gradient-to-t from-purple-800 to-indigo-600 opacity-80"></div>
                    <div class="relative p-8">
                        <div class="mb-12">
                            <p class="text-indigo-200 font-semibold">{{ $kelas->level_kelas }}</p>
                            <h1 class="text-4xl font-bold text-white tracking-tight mt-1">{{ $kelas->judul_kelas }}</h1>
                            <p class="text-lg text-indigo-100 mt-2">Oleh {{ $pemilik?->name ?? 'Pengguna Tidak Ditemukan' }}</p>
                        </div>
                        @php
                            $firstModul = $moduls->first()?->id;
                            $firstLesson = $lessons->first()?->id;
                        @endphp
                        @if($firstModul && $firstLesson)
                            @if ( $sudahBeli == false )
                                <div x-data="{ openConfirm: false }">
                                        <button
                                            @click="openConfirm = true"
                                            class="px-6 py-3 font-semibold text-indigo-700 bg-white hover:bg-gray-100 rounded-lg">
                                            Mulai Belajar (Beli Kelas Dulu {{ $kelas->harga_koin }} Koin)
                                        </button>

                                        <!-- Modal Konfirmasi -->
                                        <div x-show="openConfirm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                            <div class="bg-white rounded-xl shadow-lg p-6 w-96">
                                                <h2 class="text-xl font-bold mb-4">Konfirmasi Pembelian</h2>
                                                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin membeli kelas <b>{{ $kelas->judul_kelas }}</b>?</p>
                                                <div class="flex justify-end gap-4">
                                                    <button @click="openConfirm = false" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">Batal</button>

                                                    <form method="POST" action="{{ route('kelas.beli', $kelas->id) }}">
                                                        @csrf
                                                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                                            Ya, Beli
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('lesson.show', [$kelas->id,$firstModul, $firstLesson]) }}"
                                class="px-6 py-3 font-semibold text-indigo-700 bg-white hover:bg-gray-100 rounded-lg">
                                    Mulai Belajar
                                </a>
                            @endif
                        @else
                            <button class="px-6 py-3 font-semibold text-gray-400 bg-gray-200 cursor-not-allowed rounded-lg">
                                Belum ada materi
                            </button>
                        @endif
                        @if ($sudahBeli && $kelas->dibuat_oleh != Auth::id())
                            {{-- Rating Bintang --}}
                           <form action="{{ route('kelas.beriRating', $kelas->id) }}" method="POST" class="flex items-center space-x-2 mt-6">
                            @csrf
                            @foreach([1,2,3,4,5] as $star)
                                <button
                                    type="submit"
                                    name="rating"
                                    value="{{ $star }}"
                                    class="text-4xl focus:outline-none transition-all duration-300
                                        {{ ($userRating ?? 0) >= $star ? 'text-yellow-400 scale-110 drop-shadow-md' : 'text-gray-300 hover:text-yellow-200 hover:scale-105' }}">
                                    ★
                                </button>
                            @endforeach
                        </form>


                        @endif
                    </div>
                </div>

                {{--
                ======================================================================
                2. LAYOUT DUA KOLOM (MODUL & JADWAL)
                ======================================================================
                --}}
                <div class="grid grid-cols-1  lg:grid-cols-3 gap-8">

                    {{-- Kolom Kiri: Daftar Modul --}}
                    <div class="lg:col-span-2">
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-5">Materi Pelajaran</h2>
                        @php
                            $urutan=0
                        @endphp
                        @foreach ($moduls as $modul )
                         {{-- Accordion Interaktif dengan Alpine.js --}}
                        <div x-data="{ openModule: 1 }" class="space-y-6">

                            <div class="bg-white dark:bg-gray-800/50 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 mt-5">
                                <button @click="openModule = (openModule === 1) ? null : 1" class="w-full flex justify-between items-center p-5 text-left">
                                    <span class="font-semibold text-gray-800 dark:text-white">Modul  <span>{{ ++$urutan }}:</span> {{ $modul->title}}</span>
                                    <i class="ri-arrow-down-s-line text-xl transition-transform" :class="{ 'rotate-180': openModule === 1 }"></i>
                                </button>
                                <div x-show="openModule === 1" x-transition class="p-5 border-t border-gray-200 dark:border-gray-700">
                                    <ul class="space-y-3 ">
                                        @foreach ($modul->lessons as $lesson)
                                        <a href="{{ $sudahBeli ? route('lesson.show', [$kelas->id, $modul->id, $lesson->id]) : '#' }}">
                                            @if ($lesson->type == 'video')
                                            <li class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-900">
                                                <div class="flex items-center gap-4"><i class="ri-play-circle-line text-2xl text-indigo-500"></i><span>{{ $lesson->title }}</span></div>
                                            </li>
                                            @else
                                            <li class="flex items-center justify-between p-3 rounded-lg bg-indigo-50 dark:bg-indigo-900/50">
                                                <div class="flex items-center gap-4"><i class="ri-file-text-line text-2xl text-indigo-500"></i><span>{{ $lesson->title }}</span></div>
                                                <span class="text-sm text-gray-500">Bacaan</span>
                                            </li>
                                            @endif
                                            </a>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        @endforeach




                    </div>

                    {{-- Kolom Kanan: Jadwal Live Session --}}
                    <div class="lg:col-span-1">
                        <div class="sticky top-8">
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-5">Jadwal Kelas Live</h2>
                            <div class="bg-white dark:bg-gray-800/50 p-6 rounded-2xl shadow-md space-y-5">
                               {{-- Jika user adalah pembuat kelas --}}
                            <div x-data="{ open: false }">
                                {{-- Tombol tambah live class (hanya untuk pemilik kelas) --}}
                                @if ($kelas->dibuat_oleh == Auth::id())
                                    <button
                                        @click="open = true"
                                        class="flex items-center gap-2 bg-indigo-600 text-white px-3 py-2 rounded-lg hover:bg-indigo-700 transition mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Tambah Live Class
                                    </button>
                                @endif
                                @if ($sesiLive->isEmpty())
                                    <p class="text-gray-500">Belum ada sesi live.</p>
                                @else
                                  @foreach ($sesiLive as $live)
                                    @php
                                        $tanggal = \Carbon\Carbon::parse($live->tanggal);
                                        $isPast = $tanggal->isBefore(\Carbon\Carbon::today());
                                    @endphp

                                    <div class="flex gap-4 my-3 {{ $isPast ? 'opacity-60 pointer-events-none' : '' }}">
                                        <div class="flex-shrink-0 text-center
                                                    {{ $isPast ? 'bg-gray-200' : 'bg-indigo-100 dark:bg-indigo-900/50' }}
                                                    rounded-lg p-2 w-16">
                                            <p class="font-bold
                                                    {{ $isPast ? 'text-gray-500' : 'text-indigo-700 dark:text-indigo-300' }}
                                                    text-lg">
                                                {{ \Carbon\Carbon::parse($live->tanggal)->format('d') }}
                                            </p>
                                            <p class="text-xs
                                                    {{ $isPast ? 'text-gray-400' : 'text-indigo-500 dark:text-indigo-400' }}">
                                                {{ \Carbon\Carbon::parse($live->tanggal)->format('M') }}
                                            </p>
                                        </div>

                                        <div>
                                            <p class="font-semibold
                                                    {{ $isPast ? 'text-gray-500' : 'text-gray-800 dark:text-white' }}">
                                                {{ $live->judul }}
                                            </p>
                                            <p class="text-sm
                                                    {{ $isPast ? 'text-gray-400' : 'text-gray-500 dark:text-gray-400' }}">
                                                {{ $live->waktu_mulai }} - {{ $live->waktu_selesai }}
                                            </p>

                                            <button

                                                class="mt-2 text-sm font-semibold rounded-lg px-3 py-1
                                                    {{ $isPast ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-indigo-600 text-white hover:bg-indigo-700' }}"
                                                {{ $isPast ? 'disabled' : '' }}>
                                                <a href="{{ route('live.show',['room'=>$live->judul,$kelas->id]) }}">
                                                    {{ $isPast ? 'Sesi Selesai' : 'Gabung Sesi' }}
                                                </a>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach

                                @endif
                                {{-- Popup Form --}}
                                <div
                                    x-show="open"
                                    x-transition
                                    @click.self="open = false"
                                    class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
                                    x-cloak
                                >
                                    <div class="bg-white/90 dark:bg-gray-800/90 rounded-2xl shadow-2xl w-96 p-6 relative border border-white/20">
                                        <button
                                            @click="open = false"
                                            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 dark:hover:text-white">
                                            ✖
                                        </button>

                                        <h2 class="text-lg font-bold text-indigo-600 mb-4">Tambah Live Class</h2>

                                        {{-- Form untuk simpan live class --}}
                                        <form method="POST" action="{{ route('kelas.live.store', $kelas->id) }}">
                                            @csrf
                                            <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">

                                            <div class="mb-3">
                                                <label class="block text-sm font-medium mb-1">Judul Sesi</label>
                                                <input type="text" name="judul" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white" required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="block text-sm font-medium mb-1">Tanggal</label>
                                                <input type="date" name="tanggal" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white" required>
                                            </div>

                                            <div class="grid grid-cols-2 gap-3">
                                                <div>
                                                    <label class="block text-sm font-medium mb-1">Waktu Mulai</label>
                                                    <input type="time" name="waktu_mulai" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white" required>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium mb-1">Waktu Selesai</label>
                                                    <input type="time" name="waktu_selesai" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white" required>
                                                </div>
                                            </div>

                                            <div class="mb-3 mt-3">
                                                <label class="block text-sm font-medium mb-1">Zona Waktu</label>
                                                <select name="zona_waktu" class="w-full rounded-lg border-gray-300 dark:bg-gray-700 dark:text-white">
                                                    <option value="WIB">WIB</option>
                                                    <option value="WITA">WITA</option>
                                                    <option value="WIT">WIT</option>
                                                </select>
                                            </div>


                                            <div class="flex justify-end mt-4">
                                                <button
                                                    type="button"
                                                    @click="open = false"
                                                    class="px-3 py-2 text-sm rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 dark:border-gray-600 dark:text-white dark:hover:bg-gray-700 mr-2">
                                                    Batal
                                                </button>
                                                <button
                                                    type="submit"
                                                    class="px-4 py-2 text-sm rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                                                    Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>





                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    {{-- Mobile Bottom Navbar --}}
    @include('components.navbar-mobile')
</div>
@endsection
