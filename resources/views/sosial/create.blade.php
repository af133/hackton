@extends('layouts.app')

@section('title', 'Buat Komunitas Baru - SkillSwap')
@section('body_class', 'bg-gray-50') {{-- Mengganti background agar lebih soft --}}

@section('content')
<div x-data="{ sidebarOpen: false, imagePreview: 'https://ui-avatars.com/api/?name=C&background=EBF4FF&color=76A9FA&size=128' }" class="flex h-screen bg-gray-50">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <main class="flex-1 overflow-x-hidden overflow-y-auto">
            <div class="container mx-auto px-6 py-8">

                {{-- Judul Halaman --}}
                <div class="mb-10 text-center">
                    <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight">Buat Komunitas Baru</h1>
                    <p class="text-gray-500 mt-2 text-lg">Wujudkan idemu dan bangun ruang untuk berbagi minat bersama.</p>
                </div>

                {{-- Flash Messages --}}
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                        <p class="font-bold">Berhasil!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                @if(session('error'))
                     <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                         class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg shadow-md" role="alert">
                        <p class="font-bold">Oops!</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                <form action="{{ route('communities.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                        {{-- Kolom Kiri: Form Utama --}}
                        <div class="lg:col-span-2">
                            <div class="bg-white p-8 rounded-2xl shadow-lg space-y-6">

                                {{-- 1. Bagian Avatar Komunitas --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Avatar Komunitas</label>
                                    <div class="flex items-center gap-6">
                                        <img :src="imagePreview" alt="Preview Avatar" class="w-24 h-24 rounded-full object-cover ring-4 ring-gray-200">
                                        <label for="avatar" class="cursor-pointer px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50">
                                            <span>Ganti Foto</span>
                                            <input type="file" id="avatar" name="avatar" class="sr-only"
                                                   @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                                        </label>
                                    </div>
                                    @error('avatar') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                                </div>

                                <hr class="border-gray-200">

                                {{-- 2. Nama Komunitas --}}
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Komunitas</label>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Pecinta Kopi Senja"
                                           class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 text-lg p-3">
                                    @error('name') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                                </div>

                                {{-- 3. Deskripsi Komunitas --}}
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                    <textarea id="description" name="description" rows="5" placeholder="Jelaskan tentang komunitasmu: apa tujuannya, siapa saja anggotanya, dan kegiatan apa yang biasa dilakukan."
                                              class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 p-3">{{ old('description') }}</textarea>
                                    <p class="text-xs text-gray-500 mt-1">Gunakan deskripsi yang jelas agar mudah ditemukan orang lain.</p>
                                    @error('description') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                                </div>

                                {{-- 4. Tombol Aksi --}}
                                <div class="pt-4 flex justify-end">
                                    <button type="submit" class="w-full lg:w-auto px-8 py-3 bg-primary text-white font-bold rounded-lg hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark transition-colors duration-300">
                                        Buat Komunitas
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Kanan: Kartu Tips --}}
                        <div class="lg:col-span-1">
                            <div class="bg-blue-50 border-l-4 border-blue-400 p-6 rounded-2xl shadow-lg space-y-4 h-full">
                                <div class="flex items-center gap-3">
                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <h3 class="text-lg font-bold text-gray-800">Tips Membuat Komunitas</h3>
                                </div>
                                <ul class="space-y-3 text-gray-600 text-sm list-disc list-inside">
                                    <li><strong>Nama yang Jelas:</strong> Gunakan nama yang singkat, mudah diingat, dan relevan dengan topik komunitasmu.</li>
                                    <li><strong>Deskripsi Menarik:</strong> Jelaskan tujuan komunitas dan keuntungan bergabung untuk menarik anggota baru.</li>
                                    <li><strong>Avatar Ikonik:</strong> Pilih gambar yang mewakili identitas komunitasmu agar mudah dikenali.</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </main>
    </div>
    @include('components.navbar-mobile')
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
