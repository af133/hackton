@extends('layouts.app')

@section('title', 'Buat Kelas Baru - SkillSwap')
@section('body_class', 'bg-background') {{-- Menggunakan warna background baru --}}

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
                            <h1 class="text-3xl font-bold text-gray-800">Buat Kelas Baru</h1>
                        </div>
                        <div class="mt-4 flex-shrink-0 flex md:mt-0 md:ml-4 gap-x-2">
                            <button type="button" class="px-4 py-2 text-sm font-semibold text-gray-700 bg-white border rounded-lg shadow-sm hover:bg-gray-50">
                                Simpan sebagai Draft
                            </button>
                            <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-primary rounded-lg shadow-sm hover:bg-primary-dark">
                                Publikasikan Kelas
                            </button>
                        </div>
                    </div>

                    {{-- Layout Dua Kolom --}}
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                        {{-- Kolom Kiri: Informasi Utama --}}
                        <div class="lg:col-span-2 space-y-8">
                            {{-- Informasi Dasar --}}
                            <div class="bg-white p-6 rounded-2xl shadow-md">
                                <h2 class="text-xl font-bold text-gray-800 mb-5">Informasi Dasar</h2>
                                <div class="space-y-4">
                                    <div>
                                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Kelas</label>
                                        <input type="text" id="title" name="title" placeholder="Contoh: Belajar UI/UX Design dari Dasar" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                                        <textarea id="description" name="description" rows="4" placeholder="Jelaskan secara singkat tentang kelas ini..." class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"></textarea>
                                    </div>
                                    <div>
                                        <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                                        <select id="category" name="category" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                                            <option>Desain</option>
                                            <option>Teknologi</option>
                                            <option>Bisnis</option>
                                            <option>Pemasaran</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Upload Thumbnail Interaktif --}}
                            <div x-data="{ imagePreview: null }" class="bg-white p-6 rounded-2xl shadow-md">
                                <h2 class="text-xl font-bold text-gray-800 mb-5">Gambar Thumbnail</h2>
                                <div x-show="!imagePreview" class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                                    <i class="ri-upload-cloud-2-line text-4xl text-gray-400"></i>
                                    <label for="thumbnail" class="relative cursor-pointer mt-2 text-sm text-primary font-semibold focus-within:outline-none focus-within:ring-2 focus-within:ring-primary focus-within:ring-offset-2 hover:underline">
                                        <span>Upload sebuah file</span>
                                        <input id="thumbnail" name="thumbnail" type="file" class="sr-only" @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                                    </label>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF hingga 10MB</p>
                                </div>
                                <div x-show="imagePreview" class="mt-4 relative" x-cloak>
                                    <img :src="imagePreview" class="w-full h-auto rounded-lg">
                                    <button @click="imagePreview = null" class="absolute top-2 right-2 bg-white/50 p-1 rounded-full text-gray-800 hover:bg-white"><i class="ri-delete-bin-line"></i></button>
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Kanan: Pengaturan --}}
                        <div class="lg:col-span-1 space-y-8">
                            <div class="bg-white p-6 rounded-2xl shadow-md">
                                <h2 class="text-xl font-bold text-gray-800 mb-5">Pengaturan Kelas</h2>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Tingkat Kesulitan</label>
                                    <fieldset class="mt-2">
                                        <div class="space-y-2">
                                            <div class="flex items-center"><input id="level-beginner" name="level" type="radio" checked class="h-4 w-4 border-gray-300 text-primary focus:ring-primary"><label for="level-beginner" class="ml-3 block text-sm text-gray-800">Pemula</label></div>
                                            <div class="flex items-center"><input id="level-intermediate" name="level" type="radio" class="h-4 w-4 border-gray-300 text-primary focus:ring-primary"><label for="level-intermediate" class="ml-3 block text-sm text-gray-800">Menengah</label></div>
                                            <div class="flex items-center"><input id="level-advanced" name="level" type="radio" class="h-4 w-4 border-gray-300 text-primary focus:ring-primary"><label for="level-advanced" class="ml-3 block text-sm text-gray-800">Lanjutan</label></div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="mt-6">
                                    <label for="credit" class="block text-sm font-medium text-gray-700">Harga (Skill Kredit)</label>
                                    <input type="number" id="credit" name="credit" value="50" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                                </div>
                            </div>

                             <div x-data="{ tags: ['UI/UX', 'Desain Web'], newTag: '' }" class="bg-white p-6 rounded-2xl shadow-md">
                                <h2 class="text-xl font-bold text-gray-800 mb-5">Tags / Kata Kunci</h2>
                                <div class="flex flex-wrap items-center gap-2 mb-4">
                                    <template x-for="(tag, index) in tags" :key="index">
                                        <span class="inline-flex items-center gap-x-1.5 px-3 py-1 text-sm bg-secondary text-primary rounded-full font-bold">
                                            <span x-text="tag"></span>
                                            <button @click="tags.splice(index, 1)" type="button" class="text-primary hover:text-primary-dark">&times;</button>
                                        </span>
                                    </template>
                                </div>
                                <input type="text" x-model="newTag" @keydown.enter.prevent="if (newTag.trim()) tags.push(newTag.trim()); newTag = ''" placeholder="Tambah tag..." class="w-full rounded-lg border-gray-300 shadow-sm sm:text-sm focus:border-primary focus:ring-primary">
                            </div>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
    @include('components.navbar-mobile')
</div>
@endsection
