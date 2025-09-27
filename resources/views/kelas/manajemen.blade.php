@extends('layouts.app')

@section('title', 'Kelola Kelas: Artificial Intelligence - SkillSwap')
@section('body_class', 'bg-background')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-background">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">

                {{-- Header Aksi Halaman --}}
                <div class="md:flex md:items-center md:justify-between mb-6">
                    <div class="min-w-0 flex-1">
                        <a href="{{ route('kelas.show') }}" class="text-sm font-medium text-primary hover:underline flex items-center gap-1 mb-2">
                            <i class="ri-arrow-left-s-line"></i>
                            Kembali ke Kelas Saya
                        </a>
                        <h1 class="text-3xl font-bold text-gray-800">Kelola Kelas: Artificial Intelligence</h1>
                    </div>
                    <div class="mt-4 flex-shrink-0 flex md:mt-0 md:ml-4 gap-x-2">
                        <a href="#" class="px-4 py-2 text-sm font-semibold text-gray-700 bg-white border rounded-lg shadow-sm hover:bg-gray-50">
                            <i class="ri-pencil-line mr-1"></i>Edit Informasi
                        </a>
                        <a href="#" class="px-4 py-2 text-sm font-semibold text-white bg-primary rounded-lg shadow-sm hover:bg-primary-dark">
                            <i class="ri-add-line mr-1"></i>Tambah Modul Baru
                        </a>
                    </div>
                </div>

                {{-- Layout Dua Kolom --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Kolom Kiri: Daftar Modul & Pelajaran --}}
                    <div class="lg:col-span-2 space-y-6">
                        <h2 class="text-2xl font-bold text-gray-800">Daftar Modul</h2>

                        {{-- Contoh Modul 1 --}}
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold text-gray-800">Modul 1: Pengenalan AI</h3>
                                <div class="flex items-center gap-x-2">
                                    <button class="text-gray-400 hover:text-primary"><i class="ri-pencil-line"></i></button>
                                    <button class="text-gray-400 hover:text-red-500"><i class="ri-delete-bin-line"></i></button>
                                </div>
                            </div>
                            <ul class="space-y-3">
                                <li class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                                    <div class="flex items-center gap-4"><i class="ri-play-circle-line text-2xl text-primary"></i><span>Sejarah Kecerdasan Buatan</span></div>
                                    <i class="ri-drag-move-2-line text-gray-400 cursor-grab"></i>
                                </li>
                                <li class="flex items-center justify-between p-3 rounded-lg bg-gray-50">
                                    <div class="flex items-center gap-4"><i class="ri-file-text-line text-2xl text-primary"></i><span>Studi Kasus: AI di Industri</span></div>
                                    <i class="ri-drag-move-2-line text-gray-400 cursor-grab"></i>
                                </li>
                            </ul>
                        </div>

                        {{-- Contoh Modul 2 --}}
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold text-gray-800">Modul 2: Machine Learning</h3>
                                <div class="flex items-center gap-x-2">
                                    <button class="text-gray-400 hover:text-primary"><i class="ri-pencil-line"></i></button>
                                    <button class="text-gray-400 hover:text-red-500"><i class="ri-delete-bin-line"></i></button>
                                </div>
                            </div>
                            <p class="text-gray-500 text-sm">Belum ada pelajaran di modul ini.</p>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Panel Statistik --}}
                    <div class="lg:col-span-1 space-y-8">
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Statistik Kelas</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center"><p class="text-gray-600">Jumlah Murid</p><p class="font-bold text-lg">250</p></div>
                                <div class="flex justify-between items-center"><p class="text-gray-600">Rating Rata-rata</p><p class="font-bold text-lg">4.8 / 5.0</p></div>
                                <div class="flex justify-between items-center"><p class="text-gray-600">Total Pendapatan</p><p class="font-bold text-lg text-green-600">Rp 12.500.000</p></div>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-md">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Murid Terbaru</h3>
                            <ul class="space-y-4">
                                <li class="flex items-center gap-3"><img class="h-9 w-9 rounded-full" src="https://i.pravatar.cc/150?u=budi" alt=""><span class="font-medium text-sm">Budi Santoso</span></li>
                                <li class="flex items-center gap-3"><img class="h-9 w-9 rounded-full" src="https://i.pravatar.cc/150?u=sinta" alt=""><span class="font-medium text-sm">Sinta Aulia</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
@endsection
