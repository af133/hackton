@extends('layouts.app')

@section('title', 'Profil Pengguna - SkillSwap')
@section('body_class', 'bg-background')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-background">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="container mx-auto px-6 py-8">

                {{-- ====================================================================== --}}
                {{-- BAGIAN ATAS: PROFIL PENGGUNA & BADGE --}}
                {{-- ====================================================================== --}}
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
                                            {{ $user->koin ?? 0 }} <span class="text-sm text-gray-500">coin</span>
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
                                        @forelse ($user->skills as $skill)
                                            <span class="px-3 py-1 text-sm bg-secondary text-primary rounded-full font-bold">{{ $skill->name }}: <span class="font-normal">{{ $skill->level }}</span></span>
                                        @empty
                                            <span class="text-sm text-gray-500">Belum ada skill yang ditambahkan.</span>
                                        @endforelse
                                    </div>
                                </div>
                                <div class="mt-4 flex justify-center sm:justify-start items-center gap-x-3">
                                    <a href="{{ route('profile.edit') }}" class="px-5 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-sm hover:bg-indigo-700 transition-colors">Edit Profil</a>
                                    <a href="{{ $user->cv_url }}" class="px-5 py-2 bg-primary text-white font-semibold rounded-lg shadow-sm hover:bg-primary/90 transition-colors">View CV</a>
                                    <a href="{{ $user->portfolio_url }}" class="px-5 py-2 bg-gray-100 text-gray-800 font-semibold rounded-lg shadow-sm hover:bg-gray-200 transition-colors">View Portofolio</a>
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
                            @php
                                $individualBadge = $user->badges->where('type', 'individual')->whereNotNull('pivot.unlocked_at')->first();
                                $inProgressBadge = $user->badges->where('type', 'general')->whereNull('pivot.unlocked_at')->where('pivot.progress', '>', 0)->first();
                            @endphp

                            @if($individualBadge)
                                <div>
                                    <h3 class="font-semibold text-gray-600 text-sm mb-2">Individual Badge</h3>
                                    <div class="rounded-xl overflow-hidden shadow-sm">
                                        <img src="{{ asset($individualBadge->icon_path) }}" alt="{{ $individualBadge->name }} Badge" class="w-full h-auto object-cover">
                                    </div>
                                </div>
                            @endif

                            @if($inProgressBadge)
                                <div>
                                    <h3 class="font-semibold text-gray-600 text-sm">General Badge</h3>
                                    <div class="flex items-center gap-3 mt-2">
                                        <div class="w-20 h-20 flex-shrink-0 flex items-center justify-center bg-gray-100 rounded-lg">
                                            <img src="{{ asset($inProgressBadge->icon_path) }}" alt="{{ $inProgressBadge->name }} Badge" class="w-20 h-20">
                                        </div>
                                        <div class="flex-grow">
                                            <p class="font-bold text-gray-700 text-sm">{{ $inProgressBadge->name }}</p>
                                            <div class="w-full bg-gray-200 rounded-full h-1.5 mt-1">
                                                <div class="bg-primary h-1.5 rounded-full" style="width: {{ $inProgressBadge->pivot->progress }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                             @if(!$individualBadge && !$inProgressBadge)
                                <p class="text-sm text-gray-500">Selesaikan misi untuk mendapatkan badge pertamamu!</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ====================================================================== --}}
                {{-- BAGIAN BAWAH: DAFTAR KELAS --}}
                {{-- ====================================================================== --}}
                <div class="space-y-8">
                    {{-- KELAS YANG DIMILIKI (DIAJARKAN) --}}
                    <div>
                        <div class="flex justify-between items-center mb-4">
                             <h2 class="text-2xl font-bold text-gray-800">Materi yang diajarkan</h2>
                             <a href="#" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($user->kelas as $kelas)
                                <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 transform hover:-translate-y-1 transition-all duration-300 hover:shadow-lg">
                                    <img class="h-48 w-full object-cover" src="{{ $kelas->kelas_thumbnail_url }}" alt="Thumbnail {{ $kelas->judul_kelas }}">
                                    <div class="p-5">
                                        <h3 class="text-lg font-bold text-gray-900 truncate">{{ $kelas->judul_kelas }}</h3>
                                        <p class="text-sm text-gray-500">Oleh {{ $kelas->creator->name }}</p>
                                        <div class="flex items-center text-yellow-400 mt-1">
                                           {{-- Logic untuk bintang rating bisa ditambahkan di sini --}}
                                           <span class="text-gray-600 ml-2 text-sm">({{ $kelas->rating }})</span>
                                        </div>
                                        <div class="flex items-center justify-between mt-4">
                                            <a href="#" class="px-6 py-2.5 font-semibold text-white bg-primary hover:bg-primary/90 rounded-lg transition-colors">Lihat Materi</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 col-span-full">Anda belum membuat materi apapun.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- KELAS YANG DIIKUTI --}}
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-bold text-gray-800">Materi yang diikuti</h2>
                             <a href="#" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($user->kelasDiikuti as $kelas)
                               <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200 transform hover:-translate-y-1 transition-all duration-300 hover:shadow-lg">
                                    <img class="h-48 w-full object-cover" src="{{ $kelas->kelas_thumbnail_url }}" alt="Thumbnail {{ $kelas->judul_kelas }}">
                                    <div class="p-5">
                                        <h3 class="text-lg font-bold text-gray-900 truncate">{{ $kelas->judul_kelas }}</h3>
                                        <p class="text-sm text-gray-500">Oleh {{ $kelas->creator->name }}</p>
                                        <div class="flex items-center text-yellow-400 mt-1">
                                            <span class="text-gray-600 ml-2 text-sm">({{ $kelas->rating }})</span>
                                        </div>
                                        <div class="flex items-center justify-between mt-4">
                                            <a href="#" class="px-6 py-2.5 font-semibold text-white bg-primary hover:bg-primary/90 rounded-lg transition-colors">Lanjutkan Sesi</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 col-span-full">Anda belum mengikuti materi apapun.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
    @include('components.navbar-mobile')
</div>
@endsection
