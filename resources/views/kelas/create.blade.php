@extends('layouts.app')

@section('title', 'Buat Kelas Baru - SkillSwap')
@section('body_class', 'bg-background')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-background">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            {{-- Notifikasi Flash Message --}}
            <div class="p-4">
                @if(session('success'))
                    <div x-data="{ show: true }"
                        x-show="show"
                        x-init="setTimeout(() => show = false, 4000)"
                        class="bg-purple-600 text-white px-4 py-3 rounded-lg mb-4 shadow-md">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div x-data="{ show: true }"
                        x-show="show"
                        x-init="setTimeout(() => show = false, 4000)"
                        class="bg-red-500 text-white px-4 py-3 rounded-lg mb-4 shadow-md">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <main class="relative z-10 p-6 md:p-8">
                <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Tombol Draft & Publish di Atas --}}
                    <div class="mb-6 flex justify-end gap-x-2">
                        <button type="submit" name="action" value="draft"
                            class="px-4 py-2 text-sm font-semibold text-gray-700 bg-white border rounded-lg shadow-sm hover:bg-gray-50">
                            Simpan sebagai Draft
                        </button>
                        <button type="submit" name="action" value="publish"
                            class="px-4 py-2 text-sm font-semibold text-white bg-primary rounded-lg shadow-sm hover:bg-primary-dark">
                            Publikasikan Kelas
                        </button>
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
                                        <input type="text" id="title" name="title" placeholder="Contoh: Belajar UI/UX Design dari Dasar" class="mt-1 px-4 py-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                                        <textarea id="description" name="description" rows="4" placeholder="Jelaskan secara singkat tentang kelas ini..." class="mt-1 px-4 py-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm"></textarea>
                                    </div>
                                    <div>
                                        <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                                        <select id="category" name="category" class="mt-1 px-4 py-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
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

                        {{-- Kolom Kanan: Pengaturan & Tags --}}
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
                                    <input type="number" id="credit" name="credit" value="50" class="mt-1 px-4 py-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                                </div>
                            </div>

                            {{-- Tags --}}
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
                                <input type="text" x-model="newTag" @keydown.enter.prevent="if (newTag.trim()) tags.push(newTag.trim()); newTag = ''" placeholder="Tambah tag..." class="w-full rounded-lg px-4 py-2 border-gray-300 shadow-sm sm:text-sm focus:border-primary focus:ring-primary">
                                <input type="hidden" name="tags" :value="JSON.stringify(tags)">
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
