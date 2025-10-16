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
                    {{-- 1. UNLOCKED BADGES --}}
                    @if($unlockedBadges->isNotEmpty())
                        <div class="mt-10">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">Your Badges</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($unlockedBadges as $badge)
                                    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
                                        <img src="{{ asset($badge->icon_path) }}" alt="{{ $badge->name }} Badge" class="w-full h-auto object-cover">
                                        <div class="p-5 bg-primary/5">
                                            <h3 class="text-lg font-bold text-primary">{{ $badge->name }}</h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ $badge->description }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- 2. IN-PROGRESS BADGES --}}
                    @if($inProgressBadges->isNotEmpty())
                        <div class="mt-10">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">In Progress</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($inProgressBadges as $badge)
                                    <div class="bg-white p-5 rounded-2xl shadow-md flex items-center gap-5">
                                        <div class="w-20 h-20 flex-shrink-0 flex items-center justify-center bg-gray-100 rounded-lg">
                                            <img src="{{ asset($badge->icon_path) }}" alt="{{ $badge->name }} Badge" class="w-20 h-20">
                                        </div>
                                        <div class="flex-grow">
                                            <p class="font-bold text-gray-800">{{ $badge->name }}</p>
                                            <p class="text-xs text-gray-500 mb-2">Reputasi {{ $badge->pivot->progress }}% tercapai</p>
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-primary h-2 rounded-full" style="width: {{ $badge->pivot->progress }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- 3. LOCKED BADGES --}}
                    @if($lockedBadges->isNotEmpty())
                        <div class="mt-10">
                            <h2 class="text-2xl font-bold text-gray-800 mb-4">Locked Badges</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($lockedBadges as $badge)
                                    <div class="bg-white p-5 rounded-2xl shadow-md opacity-60">
                                        <div class="flex items-center gap-5">
                                            <div class="w-20 h-20 flex-shrink-0 flex items-center justify-center bg-gray-200 rounded-lg filter grayscale">
                                                <img src="{{ asset($badge->icon_path) }}" alt="{{ $badge->name }} Badge" class="w-20 h-20">
                                            </div>
                                            <div class="flex-grow">
                                                <p class="font-bold text-gray-500">{{ $badge->name }}</p>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    <i class="ri-lock-fill align-bottom"></i>
                                                    <span class="font-semibold">Syarat:</span> {{ $badge->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
    @include('components.navbar-mobile')
</div>
@endsection
