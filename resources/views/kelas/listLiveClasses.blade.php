@extends('layouts.app')

@section('title', 'Daftar Live Class - SkillSwap')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">
                {{-- Header Halaman --}}
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Live Class</h1>
                {{-- Daftar Card --}}
                @if ($liveClasses->isEmpty())
                    <p class="text-gray-600">
                        @if(request('search'))
                            Tidak ada live class yang cocok dengan pencarian "{{ request('search') }}".
                        @else
                            Belum ada Live Class yang dijadwalkan.
                        @endif
                    </p>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach ($liveClasses as $liveClass)
                            {{-- Menggunakan komponen card baru yang konsisten --}}
                            @include('components.live-class-card', ['liveClass' => $liveClass])
                        @endforeach
                    </div>
                @endif
            </main>
        </div>
    </div>

    @include('components.navbar-mobile')
</div>
@endsection
