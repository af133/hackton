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

                    <form action="#" method="POST">
                        @csrf
                        {{-- @method('PUT') --}}

                        {{-- Konten Tab 1: Informasi Personal --}}
                        <div x-show="activeTab === 'personal'" class="space-y-8">
                            <div class="bg-white p-6 rounded-2xl shadow-md">
                                <h2 class="text-xl font-bold text-gray-800 mb-5">Foto & Nama</h2>
                                <div class="flex items-center gap-6">
                                    <img class="h-24 w-24 rounded-full object-cover" src="https://i.pravatar.cc/300?u=aisyahfarah" alt="User Avatar">
                                    <label for="photo" class="cursor-pointer px-4 py-2 text-sm font-semibold text-indigo-700 bg-indigo-100 rounded-lg hover:bg-indigo-200">
                                        Ganti Foto
                                        <input type="file" id="photo" name="photo" class="hidden">
                                    </label>
                                </div>
                                <div class="mt-6">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" value="Aisyah Farah" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="bg-white p-6 rounded-2xl shadow-md">
                                <h2 class="text-xl font-bold text-gray-800 mb-5">Detail Kontak</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                        <input type="date" id="birth_date" name="birth_date" value="1999-04-08" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700">Telepon</label>
                                        <input type="text" id="phone" name="phone" value="(+62) 812 3456 7890" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" id="email" name="email" value="aisyah.farah@example.com" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Konten Tab 2: Pengalaman & Keahlian --}}
                        <div x-show="activeTab === 'pengalaman'" class="space-y-8">
                            {{-- Bagian Dinamis untuk Pengalaman Kerja --}}
                            <div x-data="{ experiences: [ { title: 'UI/UX Designer', company: 'Creative Agency', start: '2023-01', end: '' }, { title: 'Frontend Developer (Intern)', company: 'Tech Startup Inc.', start: '2022-07', end: '2022-12' } ] }" class="bg-white p-6 rounded-2xl shadow-md">
                                <h2 class="text-xl font-bold text-gray-800 mb-5">Pengalaman Kerja</h2>
                                <div class="space-y-4">
                                    <template x-for="(exp, index) in experiences" :key="index">
                                        <div class="p-4 border rounded-lg flex items-start gap-4">
                                            <div class="flex-grow grid grid-cols-2 gap-4">
                                                <input type="text" x-model="exp.title" placeholder="Posisi" class="rounded-lg border-gray-300 text-sm">
                                                <input type="text" x-model="exp.company" placeholder="Nama Perusahaan" class="rounded-lg border-gray-300 text-sm">
                                                <input type="month" x-model="exp.start" placeholder="Tanggal Mulai" class="rounded-lg border-gray-300 text-sm">
                                                <input type="month" x-model="exp.end" placeholder="Tanggal Selesai" class="rounded-lg border-gray-300 text-sm">
                                            </div>
                                            <button @click="experiences.splice(index, 1)" type="button" class="text-gray-400 hover:text-red-500"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </template>
                                </div>
                                <button @click="experiences.push({ title: '', company: '', start: '', end: '' })" type="button" class="mt-4 text-sm font-semibold text-indigo-600 hover:underline">+ Tambah Pengalaman</button>
                            </div>

                            {{-- Bagian Dinamis untuk Keahlian --}}
                             <div x-data="{ skills: ['UI/UX Design', 'Prototyping', 'HTML & CSS'], newSkill: '' }" class="bg-white p-6 rounded-2xl shadow-md">
                                <h2 class="text-xl font-bold text-gray-800 mb-5">Keahlian</h2>
                                <div class="flex flex-wrap items-center gap-2 mb-4">
                                    <template x-for="(skill, index) in skills" :key="index">
                                        <span class="inline-flex items-center gap-x-1.5 px-3 py-1 text-sm bg-indigo-100 text-indigo-800 rounded-full font-medium">
                                            <span x-text="skill"></span>
                                            <button @click="skills.splice(index, 1)" type="button" class="text-indigo-500 hover:text-indigo-800">&times;</button>
                                        </span>
                                    </template>
                                </div>
                                <div class="flex gap-2">
                                    <input type="text" x-model="newSkill" @keydown.enter.prevent="if (newSkill.trim()) skills.push(newSkill.trim()); newSkill = ''" placeholder="Tambah keahlian baru..." class="flex-grow rounded-lg border-gray-300 shadow-sm sm:text-sm">
                                    <button @click.prevent="if (newSkill.trim()) skills.push(newSkill.trim()); newSkill = ''" type="button" class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-700">Tambah</button>
                                </div>
                            </div>
                        </div>

                        {{-- Konten Tab 3: Portofolio --}}
                         <div x-show="activeTab === 'portofolio'" class="space-y-8">
                            <div class="bg-white p-6 rounded-2xl shadow-md">
                                <h2 class="text-xl font-bold text-gray-800 mb-5">Portofolio</h2>
                                <p class="text-sm text-gray-500 mb-4">Tambahkan proyek terbaik Anda untuk ditampilkan di profil publik.</p>
                                {{-- Placeholder for Portfolio Upload --}}
                                <div class="p-8 border-2 border-dashed border-gray-300 rounded-lg text-center">
                                    <i class="ri-upload-cloud-2-line text-4xl text-gray-400"></i>
                                    <p class="mt-2 text-gray-500">Fitur upload portofolio akan segera hadir.</p>
                                </div>
                            </div>
                         </div>

                        {{-- Tombol Aksi --}}
                        <div class="flex justify-end gap-x-4 pt-4">
                            <button type="button" class="px-6 py-2.5 font-semibold text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">Batal</button>
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
