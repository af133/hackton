@extends('layouts.app')

@section('title', 'Edit Profil - SkillSwap')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Profil</h1>

                {{-- State Management Tabs dengan Alpine.js --}}
                <div x-data="{ activeTab: 'personal' }">
                    {{-- Navigasi Tabs --}}
                    <div class="border-b border-gray-200 mb-6">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <button @click="activeTab = 'personal'" :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'personal', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'personal' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Informasi Personal</button>
                            <button @click="activeTab = 'pengalaman'" :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'pengalaman', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'pengalaman' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Pengalaman & Keahlian</button>
                            <button @click="activeTab = 'portofolio'" :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'portofolio', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'portofolio' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Portofolio</button>
                        </nav>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- ... Konten Tab 1: Informasi Personal ... --}}
                        <div x-show="activeTab === 'personal'" class="space-y-8">
                            {{-- Foto & Nama --}}
                            {{-- Foto & Nama --}}
                        <div x-data="{ photoPreview: '{{ $user->profile_photo_url }}' }" class="bg-white p-6 rounded-2xl shadow-md">
                            <h2 class="text-xl font-bold text-gray-800 mb-5">Foto & Nama</h2>
                            <div class="flex items-center gap-6">
                                {{-- Gambar ini akan menampilkan preview --}}
                                <img class="h-24 w-24 rounded-full object-cover":src="photoPreview"alt="User Avatar">

                                <label for="photo" class="cursor-pointer px-4 py-2 text-sm font-semibold text-indigo-700 bg-indigo-100 rounded-lg hover:bg-indigo-200">Ganti Foto
                                    <input type="file" id="photo" name="profile_photo"class="hidden" @change="photoPreview = URL.createObjectURL($event.target.files[0])">
                                </label>
                            </div>
                            <div class="mt-6">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full px-4 py-3 rounded-lg border-gray-300 shadow-sm sm:text-sm">
                            </div>
                            <div class="mt-6">
                                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea id="description" name="description" rows="3" class="mt-1 block w-full px-4 py-3 rounded-lg border-gray-300 shadow-sm sm:text-sm">{{ old('description', $user->description) }}</textarea>
                            </div>
                        </div>

                            {{-- Detail Kontak --}}
                            <div class="bg-white p-6 rounded-2xl shadow-md">
                                <h2 class="text-xl font-bold text-gray-800 mb-5">Detail Kontak</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700">Telepon</label>
                                        <input type="text" id="phone" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" class="mt-1 px-4 py-3 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 px-4 py-3 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram URL</label>
                                        <input type="url" id="instagram" name="instagram_url" value="{{ old('instagram_url', $user->instagram_url) }}" class="mt-1 px-4 py-3 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="linkedin" class="block text-sm font-medium text-gray-700">LinkedIn URL</label>
                                        <input type="url" id="linkedin" name="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url) }}" class="mt-1 px-4 py-3 block w-full rounded-lg border-gray-300 shadow-sm sm:text-sm">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ... Konten Tab 2: Pengalaman & Keahlian ... --}}
                        <div x-show="activeTab === 'pengalaman'" class="space-y-8">
                            {{-- Pengalaman Kerja --}}
                            <div x-data='{ experiences: @json($user->experiences) }' class="bg-white p-6 rounded-2xl shadow-md">
                                <h2 class="text-xl font-bold text-gray-800 mb-5">Pengalaman Kerja</h2>
                                <div class="space-y-4">
                                    <template x-for="(exp, index) in experiences" :key="index">
                                        <div class="p-4 border rounded-lg flex items-start gap-4">
                                            <div class="flex-grow grid grid-cols-2 gap-4">
                                                <input type="text" :name="`experiences[${index}][title]`" x-model="exp.title" placeholder="Posisi" class="rounded-lg px-4 py-3 border-gray-300 text-sm">
                                                <input type="text" :name="`experiences[${index}][company]`" x-model="exp.company" placeholder="Nama Perusahaan" class="rounded-lg px-4 py-3 border-gray-300 text-sm">
                                                <input type="date" :name="`experiences[${index}][start_date]`" x-model="exp.start_date" class="rounded-lg px-4 py-3 border-gray-300 text-sm">
                                                <input type="date" :name="`experiences[${index}][end_date]`" x-model="exp.end_date" class="rounded-lg px-4 py-3 border-gray-300 text-sm">
                                            </div>
                                            <button @click="experiences.splice(index, 1)" type="button" class="text-gray-400 hover:text-red-500"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </template>
                                </div>
                                <button @click="experiences.push({ title: '', company: '', start_date: '', end_date: '' })" type="button" class="mt-4 text-sm font-semibold text-indigo-600 hover:underline">+ Tambah Pengalaman</button>
                            </div>

                            {{-- Keahlian --}}
                            <div x-data='{ skills: @json($user->skills) }' class="bg-white p-6 rounded-2xl shadow-md">
                                <h2 class="text-xl font-bold text-gray-800 mb-5">Keahlian</h2>
                                <div class="space-y-4">
                                    <template x-for="(skill, index) in skills" :key="index">
                                        <div class="p-4 border rounded-lg flex items-center gap-4">
                                            <input type="text" :name="`skills[${index}][name]`" x-model="skill.name" placeholder="Nama Keahlian" class="w-1/2 px-4 py-3 rounded-lg border-gray-300 text-sm">
                                            <select :name="`skills[${index}][level]`" x-model="skill.level" class="w-1/2 rounded-lg px-4 py-3 border-gray-300 text-sm">
                                                <option value="Beginner">Beginner</option>
                                                <option value="Intermediate">Intermediate</option>
                                                <option value="Advanced">Advanced</option>
                                            </select>
                                            <button @click="skills.splice(index, 1)" type="button" class="text-gray-400 hover:text-red-500"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </template>
                                </div>
                                <button @click="skills.push({ name: '', level: 'Beginner' })" type="button" class="mt-4 text-sm font-semibold text-indigo-600 hover:underline">+ Tambah Keahlian</button>
                            </div>
                        </div>

                        {{-- Konten Tab 3: Portofolio --}}
                        <div x-show="activeTab === 'portofolio'" class="space-y-8">
                            <div class="bg-white p-6 rounded-2xl shadow-md">
                                <h2 class="text-xl font-bold text-gray-800 mb-5">Portofolio & CV</h2>
                                <p class="text-sm text-gray-500 mb-4">
                                    Masukkan tautan (URL) ke CV dan portofolio Anda yang tersimpan di Google Drive, LinkedIn, atau situs web pribadi.
                                </p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    {{-- UBAH INPUT CV --}}
                                    <div>
                                        <label for="cv_path" class="block text-sm font-medium text-gray-700">Tautan CV</label>
                                        <input type="url" id="cv_path" name="cv_path" value="{{ old('cv_path', $user->cv_path) }}" placeholder="https://..." class="mt-1 block w-full px-4 py-3 rounded-lg border-gray-300 shadow-sm sm:text-sm">
                                    </div>

                                    {{-- UBAH INPUT PORTOFOLIO --}}
                                    <div>
                                        <label for="portfolio_path" class="block text-sm font-medium text-gray-700">Tautan Portofolio</label>
                                        <input type="url" id="portfolio_path" name="portfolio_path" value="{{ old('portfolio_path', $user->portfolio_path) }}" placeholder="https://..." class="mt-1 block w-full px-4 py-3 rounded-lg border-gray-300 shadow-sm sm:text-sm">
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex justify-end gap-x-4 pt-4">
                            <a href="{{ route('profile.show') }}" class="px-6 py-2.5 font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">Batal</a>
                            <button type="submit" class="px-6 py-2.5 font-semibold text-white bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-700">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    @include('components.navbar-mobile')
</div>
@endsection
