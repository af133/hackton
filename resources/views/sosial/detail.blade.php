@extends('layouts.app')

@section('title', 'Digital Marketing Circle - SkillSwap')
@section('body_class', 'bg-background')

@section('content')
<div x-data="{ sidebarOpen: false, showEventModal: false }" class="flex h-screen bg-background">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">

                {{-- ======================================================================
                1. BANNER & AKSI UTAMA CIRCLE
                ====================================================================== --}}
                <div class="bg-white p-6 rounded-2xl shadow-md mb-8">
                    <div class="flex flex-col sm:flex-row items-start justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">{{ $komunitas->name }}</h1>
                            <p class="text-gray-500 mt-1 max-w-2xl">{{ $komunitas->description }}</p>
                            <div class="flex items-center mt-3 -space-x-2">
                                @foreach ($member as $members )
                                    <img class="inline-block h-8 w-8 rounded-full ring-2 ring-white"
                                        src="{{ $members->user->profile_photo_url}}"
                                        alt="{{ $members->user->name }}">
                                @endforeach
                                <span class="flex items-center justify-center h-8 w-8 rounded-full bg-secondary text-primary text-xs font-bold ring-2 ring-white">{{
                                $member->count()
                                }}</span>
                            </div>
                        </div>
                        <div class="flex-shrink-0 flex items-center gap-x-2">
                            <button
                                @click="showEventModal = true"
                                class="px-4 py-2 text-sm font-semibold text-primary bg-secondary rounded-lg hover:bg-opacity-80">
                                <i class="ri-calendar-event-line mr-1"></i>Buat Event
                            </button>
                            @if(!$isMember)
                            <form action="{{ route('communities.join', $komunitas->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="px-4 py-2 text-sm font-semibold text-white bg-primary rounded-lg shadow-sm hover:bg-primary-dark">
                                    <i class="ri-add-line mr-1"></i> Join Circle
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ======================================================================
                2. LAYOUT DUA KOLOM
                ====================================================================== --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Kolom Kiri: Feed Diskusi --}}
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white p-4 rounded-2xl shadow-md">
                            <form action="{{ route('sosial.post.store', $komunitas->id) }}" method="POST">
                                @csrf
                                <div class="flex items-start gap-4">
                                    <img class="h-10 w-10 rounded-full object-cover"
                                        src="{{ $user->profile_photo_url }}"
                                        alt="User Avatar">
                                    <textarea name="content" rows="2" class="flex-1 px-4 py-2 bg-background border-transparent rounded-lg focus:ring-primary focus:border-primary text-sm" placeholder="Mulai diskusi baru..." required></textarea>
                                    <button type="submit" class="px-4 py-2 h-10 text-sm font-semibold text-white bg-primary rounded-lg shadow-sm hover:bg-primary-dark">Post</button>
                                </div>
                            </form>
                        </div>

                        @foreach ($posts as $post)
                            <div class="bg-white p-6 rounded-2xl shadow-md mb-4">
                                <div class="flex items-start gap-4">
                                    <img
                                        class="h-10 w-10 rounded-full object-cover"
                                        src="{{ $post->user->profile_photo_url }}"
                                        alt="{{ $post->user->name }}">

                                    <div class="w-full">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p class="font-semibold text-gray-800">{{ $post->user->name }}</p>
                                                <p class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                                            </div>
                                            <button class="text-gray-400 hover:text-primary"><i class="ri-more-2-fill"></i></button>
                                        </div>
                                        <div class="prose prose-sm max-w-none mt-3">
                                            <p>{{ $post->content }}</p>
                                        </div>
                                        <div class="flex items-center justify-between text-gray-500 mt-4 border-t pt-3">
                                            <div class="flex items-center gap-4">
                                                <button class="flex items-center gap-1 hover:text-primary">
                                                    <i class="ri-heart-3-line"></i> {{ $post->likes_count ?? 0 }}
                                                </button>
                                                <button class="flex items-center gap-1 hover:text-primary">
                                                    <i class="ri-chat-3-line"></i> {{ $post->comments_count ?? 0 }}
                                                </button>
                                            </div>
                                            <a href="{{ route('sosial.post.detail', $post->id) }}" class="text-sm font-semibold text-primary hover:underline">
                                                Lihat Diskusi
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                   <div class="lg:col-span-1 space-y-8">
    <div class="bg-white p-6 rounded-2xl shadow-md">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Event Mendatang</h3>

        @forelse ($liveCommunity as $live)
            @php
                $tanggal = \Carbon\Carbon::parse($live->tanggal);
            @endphp
            <div class="flex gap-4 mb-4">
                <div class="flex-shrink-0 text-center bg-secondary rounded-lg p-2 w-16">
                    <p class="font-bold text-primary text-lg">
                        {{ $tanggal->format('d') }}
                    </p>
                    <p class="text-xs text-primary font-semibold uppercase">
                        {{ $tanggal->format('M') }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-800">{{ $live->judul }}</p>
                    <p class="text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($live->waktu_mulai)->format('H:i') }} {{ $live->zona_waktu }}
                    </p>
                    <a href="{{ route('live.show',['jenisLive'=>$live->judul,'kelasId'=>$live->id,'room'=>'Komunitas']) }}" class="text-sm font-semibold text-primary hover:underline mt-1 inline-block">
                        Bergabung
                    </a>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-sm">Belum ada event terjadwal.</p>
        @endforelse
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-md">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-800">Anggota</h3>
        </div>
        <ul class="space-y-3">
            @foreach ($member as $members)
                <li class="flex items-center gap-3">
                    <img class="h-9 w-9 rounded-full"
                        src="{{ $members->user->profile_photo_url }}"
                        alt="{{ $members->user->name }}">
                    <span class="font-medium text-sm">{{ $members->user->name }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>

                </div>
            </main>
        </div>
    </div>

    {{-- ================================================================
    MODAL POPUP BUAT EVENT
    ================================================================ --}}
<div
    x-show="showEventModal"
    x-transition
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
    x-cloak
>
    <div class="bg-secondary/90 backdrop-blur-md w-full max-w-md rounded-2xl shadow-2xl p-6 relative border border-purple-200">
        <button
            @click="showEventModal = false"
            class="absolute top-3 right-3 text-gray-300 hover:text-purple-200 transition"
        >
            <i class="ri-close-line text-xl"></i>
        </button>

        <h2 class="text-xl font-bold text-white mb-4 text-center">Buat Event Baru</h2>

<form action="{{ route('events.store', $komunitas->id) }}" method="POST">
    @csrf
    <input type="hidden" name="komunitas_id" value="{{ $komunitas->id }}">

    <div class="space-y-4">
        <div>
            <label class="block text-sm font-semibold text-white mb-1">Judul Event</label>
            <input
                type="text"
                name="judul"
                class="w-full border px-4 py-2 border-purple-300 bg-white/60 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 p-2.5 placeholder-purple-300 text-gray-800"
                placeholder="Contoh: Live Class Desain UI"
                required
            >
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-white mb-1">Tanggal</label>
                <input
                    type="date"
                    name="tanggal"
                    class="w-full px-4 py-2 border border-purple-300 bg-white/60 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 p-2.5 text-gray-800"
                    required
                >
            </div>
            <div>
                <label class="block text-sm font-semibold text-white mb-1">Waktu</label>
                <input
                    type="time"
                    name="waktu_mulai"
                    class="w-full border px-4 py-2 border-purple-300 bg-white/60 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 p-2.5 text-gray-800"
                    required
                >
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-white mb-1">Zona Waktu</label>
            <select
                name="zona_waktu"
                class="w-full border border-purple-300 bg-white/60 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 p-2.5 text-gray-800"
                required
            >
                <option value="">Pilih Zona Waktu</option>
                <option value="WIB">WIB (Waktu Indonesia Barat)</option>
                <option value="WITA">WITA (Waktu Indonesia Tengah)</option>
                <option value="WIT">WIT (Waktu Indonesia Timur)</option>
            </select>
        </div>

        <div class="flex justify-end pt-3">
            <button
                type="button"
                @click="showEventModal = false"
                class="px-4 py-2 text-sm font-semibold text-gray-200 hover:text-white transition"
            >
                Batal
            </button>
            <button
                type="submit"
                class="ml-2 px-4 py-2 text-sm font-semibold text-white bg-purple-600 rounded-lg hover:bg-purple-700 shadow-md transition"
            >
                Simpan
            </button>
        </div>
    </div>
</form>

    </div>
</div>

</div>
@endsection
