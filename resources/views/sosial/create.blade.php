@extends('layouts.app')

@section('title', 'Buat Komunitas Baru - SkillSwap')
@section('body_class', 'bg-background')

@section('content')
<div x-data="{ sidebarOpen: false, imagePreview: null }" class="flex h-screen bg-background">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            {{-- Flash Messages --}}
            <div class="p-4">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
                         class="bg-green-600 text-white px-4 py-3 rounded-lg mb-4 shadow-md">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" 
                         class="bg-red-500 text-white px-4 py-3 rounded-lg mb-4 shadow-md">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <main class="relative z-10 p-6 md:p-8">
                <div class="mb-8 text-center">
                    <h1 class="text-3xl font-bold text-gray-800">Mari buat komunitas yang menyenangkan</h1>
                    <p class="text-gray-500 mt-2">Bangun komunitasmu sendiri, berbagi minat, dan temukan teman baru!</p>
                </div>
                @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                    class="bg-green-600 text-white px-4 py-3 rounded-lg mb-4 shadow-md">
                    {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('communities.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Kolom Kiri: Form + Avatar --}}
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col gap-4">

                {{-- Kotak kecil untuk avatar --}}
                <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center mb-4">
                    <img :src="imagePreview ?? 'https://via.placeholder.com/80'" class="w-full h-full object-cover rounded-full">
                </div>

                {{-- Form input nama komunitas --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Komunitas</label>
                    <input type="text" id="name" name="name" placeholder="Contoh: AI Enthusiasts" 
                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                </div>

                {{-- Form input deskripsi komunitas --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mt-4">Deskripsi Komunitas</label>
                    <textarea id="description" name="description" rows="4" placeholder="Tuliskan deskripsi komunitasmu..." 
                              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"></textarea>
                    <p class="text-xs text-gray-500 mt-1">Deskripsi singkat mengenai komunitasmu.</p>
                </div>

                {{-- Form input avatar --}}
                <div>
                    <label for="avatar" class="block text-sm font-medium text-gray-700 mt-4">Upload Avatar</label>
                    <input type="file" id="avatar" name="avatar" class="mt-1 block w-full text-sm text-gray-500
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-lg file:border-0
                           file:text-sm file:font-semibold
                           file:bg-primary file:text-white
                           hover:file:bg-primary-dark"
                           @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF hingga 5MB</p>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Tombol Submit --}}
        <div class="space-y-8">
            <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col items-center justify-center h-full">
                <button type="submit" class="px-6 py-3 bg-primary text-white rounded-lg font-semibold hover:bg-primary-dark w-full">
                    Buat Komunitas
                </button>
            </div>
        </div>

    </div>
                </form>

            </main>
        </div>
    </div>
    @include('components.navbar-mobile')
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
