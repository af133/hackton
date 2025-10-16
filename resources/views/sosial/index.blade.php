@extends('layouts.app')

@section('title', 'Jelajahi Circle - SkillSwap')
@section('body_class', 'bg-background')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-background">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">

                {{-- Header Halaman & Filter --}}
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Jelajahi Circle Komunitas</h1>
                    <p class="text-gray-500 mt-1">Temukan grup, belajar bersama, dan perluas jaringanmu.</p>

                    <div class="flex justify-end mb-4">
                        <a href="{{ route('sosial.create') }}" class="px-5 py-2 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-lg shadow-sm">
                            <i class="ri-add-line mr-1"></i>Buat Komunitas Baru
                        </a>
                    </div>
                    <div class="mt-6 flex flex-col sm:flex-row items-center gap-4">
                        <div class="relative w-full sm:w-auto flex-grow">
                            <i class="ri-search-line absolute top-1/2 left-4 -translate-y-1/2 text-gray-400"></i>
                            <input type="text" placeholder="Cari berdasarkan nama atau topik..." class="w-full pl-12 pr-4 py-3 text-sm bg-white border-transparent rounded-lg shadow-sm focus:ring-primary focus:border-primary">
                        </div>

                    </div>
                </div>
                {{-- Grid Daftar Circle --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach ( $communities as $community )
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden transform hover:-translate-y-1 transition-transform duration-300 flex flex-col">
                            <img class="h-40 w-full object-cover" src="{{ asset($community->avatar) }}" alt="AI/ML Banner">
                            <div class="p-5 flex flex-col flex-grow">
                                <h3 class="text-lg font-bold text-gray-900">{{ $community->name}}</h3>
                                <p class="text-sm text-gray-500 mt-1 flex-grow">{{ $community->description }}</p>
                                <div class="flex items-center justify-between mt-4">
                                    @if ($community->users->contains(auth()->user()->id))
                                        <a href="{{ route('sosial.show', ['id' => $community->id]) }}" class="px-4 py-2 text-sm font-semibold text-primary bg-secondary rounded-lg hover:bg-opacity-80">Lihat</a>
                                    @else
                                        <a href="{{ route('sosial.show', ['id' => $community->id]) }}" class="px-4 py-2 text-sm font-semibold text-white bg-primary rounded-lg hover:bg-primary-dark">Join</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>
    @include('components.navbar-mobile')
</div>
@endsection
