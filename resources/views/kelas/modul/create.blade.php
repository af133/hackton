@extends('layouts.app')

@section('title', 'Tambah Modul Baru - SkillSwap')
@section('body_class', 'bg-background')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-background">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">
                <form action="#" method="POST">
                    @csrf
                    {{-- Header Halaman --}}
                    <div class="md:flex md:items-center md:justify-between mb-6">
                        <div class="min-w-0 flex-1">
                            <a href="#" class="text-sm font-medium text-primary hover:underline flex items-center gap-1 mb-2">
                                <i class="ri-arrow-left-s-line"></i>
                                Kembali ke Kelola Kelas
                            </a>
                            <h1 class="text-3xl font-bold text-gray-800">Tambah Modul Baru</h1>
                        </div>
                        <div class="mt-4 flex-shrink-0 flex md:mt-0 md:ml-4">
                            <button type="submit" class="w-full px-4 py-2 text-sm font-semibold text-white bg-primary rounded-lg shadow-sm hover:bg-primary-dark">
                                Simpan Modul
                            </button>
                        </div>
                    </div>

                    {{-- Konten Form --}}
                    <div class="bg-white p-6 rounded-2xl shadow-md">
                        <div class="space-y-6">
                            <div>
                                <label for="module-title" class="block text-sm font-medium text-gray-700 mb-1">Judul Modul</label>
                                <input type="text" id="module-title" name="module-title" placeholder="Contoh: Pengenalan AI" class="block w-full px-4 py-3 rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                            </div>
                            <div>
                                <label for="module-description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat Modul</label>
                                <textarea id="module-description" name="module-description" rows="3" placeholder="Jelaskan isi modul ini..." class="block w-full px-4 py-3 rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"></textarea>
                            </div>
                        </div>

                        <hr class="my-6">

                        {{-- Bagian Pelajaran Dinamis (Alpine.js) - STRUKTUR DIPERBAIKI --}}
                        <div x-data="{ lessons: [ { title: '', type: 'video', content: '' } ] }" class="pt-2">
                            <h2 class="text-xl font-bold text-gray-800 mb-4">Pelajaran</h2>
                            <div class="space-y-4">
                                <template x-for="(lesson, index) in lessons" :key="index">
                                    <div class="border rounded-lg p-4">
                                        <div class="flex items-start gap-4">
                                            {{-- Kolom Kiri: Nomor dan Input Judul --}}
                                            <div class="flex-grow space-y-3">
                                                <div class="flex items-center gap-4">
                                                    <span class="font-bold text-gray-400">#<span x-text="index + 1"></span></span>
                                                    <input type="text" x-model="lesson.title" placeholder="Judul Pelajaran" class="w-full px-4 py-3 rounded-lg border-gray-300 sm:text-sm focus:border-primary focus:ring-primary">
                                                </div>

                                                {{-- Kolom Kanan: Tipe dan Konten --}}
                                                <div class="flex items-center gap-4 pl-8">
                                                    <select x-model="lesson.type" class="rounded-lg px-4 py-3 border-gray-300 sm:text-sm focus:border-primary focus:ring-primary">
                                                        <option value="video">Video</option>
                                                        <option value="teks">Teks / Bacaan</option>
                                                    </select>
                                                    <input type="text" x-model="lesson.content" placeholder="Link Video YouTube / Artikel" class="w-full px-4 py-3 rounded-lg border-gray-300 sm:text-sm focus:border-primary focus:ring-primary">
                                                </div>
                                            </div>

                                            {{-- Tombol Hapus --}}
                                            <button @click="lessons.splice(index, 1)" type="button" class="text-gray-400 hover:text-red-500 pt-2">
                                                <i class="ri-delete-bin-line text-lg"></i>
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            <button @click="lessons.push({ title: '', type: 'video', content: '' })" type="button" class="mt-4 text-sm font-semibold text-primary hover:underline">
                                <i class="ri-add-line"></i> Tambah Pelajaran
                            </button>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>
@endsection
