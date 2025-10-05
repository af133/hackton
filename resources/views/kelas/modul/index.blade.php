@extends('layouts.app')

@section('title', 'Detail Modul - SkillSwap')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-100">
    {{-- Sidebar --}}
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        {{-- Mobile Header --}}
        @include('components.header-mobile')

        {{-- Area Konten Utama --}}
        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8"
                  x-data="{
                      activeLesson: {
                          type: '{{ $lesson->type }}',
                          content: '{{ $lesson->type === 'video' ? youtubeEmbed($lesson->content) : Storage::url($lesson->content) }}',
                          title: '{{ $lesson->title }}'
                      }
                  }">

                {{-- HEADER --}}
                <div class="mb-6">
                    <a href="{{ route('kelas.detail', $kelas->id) }}" class="text-sm font-medium text-indigo-600 hover:underline flex items-center gap-2">
                        <i class="ri-arrow-left-s-line"></i>
                        Kembali ke Daftar Modul
                    </a>
                    <div class="md:flex md:items-center md:justify-between mt-4">
                        <div class="min-w-0 flex-1">
                            <h1 class="text-3xl font-bold text-gray-800 dark:text-white" x-text="activeLesson.title"></h1>
                        </div>
                        <div class="mt-4 flex-shrink-0 flex md:mt-0 md:ml-4 gap-x-2">
                            @if($prevLesson)
                                <a href="{{ route('lesson.show', ['kelas'=>$kelas->id,'modul'=>$modul->id,'lesson'=>$prevLesson->id]) }}"
                                   class="px-4 py-2 text-sm font-semibold text-gray-700 bg-white border rounded-lg shadow-sm hover:bg-gray-50">
                                    <i class="ri-arrow-left-line mr-2"></i>Sebelumnya
                                </a>
                            @endif
                            @if($nextLesson)
                                <a href="{{ route('lesson.show', ['kelas'=>$kelas->id,'modul'=>$modul->id,'lesson'=>$nextLesson->id]) }}"
                                   class="px-4 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-lg shadow-sm hover:bg-indigo-700">
                                    Berikutnya<i class="ri-arrow-right-line ml-2"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- LAYOUT KONTEN --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Kolom Kiri: Konten Utama --}}
                    <div class="lg:col-span-2">
                        {{-- Konten Dinamis (Video/PDF) --}}
                        <div class="relative w-full overflow-hidden rounded-2xl shadow-lg aspect-video bg-gray-900">
                            <template x-if="activeLesson.type === 'video'">
                                <iframe class="absolute inset-0 w-full h-full"
                                        :src="activeLesson.content"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </template>
                            <template x-if="activeLesson.type === 'pdf'">
                                <iframe class="absolute inset-0 w-full h-full"
                                        :src="activeLesson.content"
                                        type="application/pdf"></iframe>
                            </template>
                            <template x-if="activeLesson.type == 'text'">
                                <iframe class="absolute inset-0 w-full h-full"
                                        :src="activeLesson.content"
                                        style="border: none;">
                                </iframe>
                            </template>

                        </div>

                        {{-- Tabs Deskripsi / Sumber Daya / Diskusi --}}
                        <div x-data="{ activeTab: 'diskusi' }" class="mt-8 bg-white dark:bg-gray-800/50 rounded-2xl shadow-md border border-gray-200 dark:border-gray-700">
                            <nav class="flex border-b border-gray-200 dark:border-gray-700">
                                <button @click="activeTab = 'deskripsi'"
                                        :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'deskripsi' }"
                                        class="py-4 px-6 font-medium border-b-2 transition-colors">Deskripsi</button>
                                {{-- <button @click="activeTab = 'sumber-daya'"
                                        :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'sumber-daya' }"
                                        class="py-4 px-6 font-medium border-b-2 transition-colors">Sumber Daya</button> --}}
                                <button @click="activeTab = 'diskusi'"
                                        :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'diskusi' }"
                                        class="py-4 px-6 font-medium border-b-2 transition-colors">Diskusi</button>
                            </nav>
                            <div class="p-6">
                                {{-- Deskripsi --}}
                                <div x-show="activeTab === 'deskripsi'" class="prose dark:prose-invert max-w-none">
                                    {!! $modul->description ?? 'Belum ada deskripsi.' !!}
                                </div>

                                {{-- Sumber Daya --}}
                                <div x-show="activeTab === 'sumber-daya'">
                                    @if($lesson->type === 'pdf')
                                        <a href="   {{ Storage::url($lesson->content) }}" target="_blank"
                                           class="flex items-center gap-3 p-3 bg-gray-100 dark:bg-gray-700 rounded-lg hover:bg-gray-200">
                                            <i class="ri-file-pdf-line text-2xl text-red-500"></i>
                                            <span class="font-medium text-gray-800 dark:text-gray-200">Download {{ $lesson->title }}</span>
                                        </a>
                                    @else
                                        <p class="text-gray-500">Tidak ada sumber daya tambahan.</p>
                                    @endif
                                </div>

                                {{-- Diskusi --}}
                              <div x-show="activeTab === 'diskusi'">
                                <div id="discussion-list" class="space-y-3">
                                    @foreach($lesson->discussions as $d)
                                        <div class="p-3 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                            <p class="font-semibold text-gray-800 dark:text-gray-200">{{ $d->user->name }}</p>
                                            <p class="text-gray-600 dark:text-gray-300">{{ $d->content }}</p>
                                            <span class="text-xs text-gray-500">{{ $d->created_at->diffForHumans() }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <form action="{{ route('discussion.store', $lesson->id) }}" method="POST" class="mt-4 flex gap-2">
                                    @csrf
                                    <input type="text" name="content" placeholder="Tulis komentar..." 
                                        class="flex-1 p-2 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white" required>
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Kirim</button>
                                </form>
                            </div>


                            </div>
                        </div>
                    </div>
                    {{-- Kolom Kanan: Daftar Modul & Lesson --}}
                    <div class="lg:col-span-1">
                        <div class="sticky top-8 max-h-[calc(100vh-2rem)] overflow-y-auto pr-2">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Daftar Modul</h3>
                            <ul class="space-y-2">
                                @foreach($kelas->moduls as $m)
                                    {{-- Modul --}}
                                    <li x-data="{ open: {{ $modul->id === $m->id ? 'true' : 'false' }} }" 
                                        class="border-b border-gray-300 dark:border-gray-600 pb-2">
                                        <button @click="open = !open"
                                                class="flex justify-between items-center w-full px-3 py-2 text-left font-medium text-gray-900 dark:text-gray-200 
                                                    rounded-lg transition
                                                    {{ $modul->id === $m->id ? 'bg-gray-200 dark:bg-gray-700' : 'hover:bg-gray-300 dark:hover:bg-gray-600' }}">
                                            <span>{{ $m->title }}</span>
                                            <i :class="{'ri-arrow-up-s-line': open, 'ri-arrow-down-s-line': !open }" class="text-lg transition-transform"></i>
                                        </button>

                                        {{-- List Lesson --}}
                                        <ul x-show="open" x-collapse class="mt-2 ml-4 space-y-1">
                                            @foreach($m->lessons as $l)
                                                <li>
                                                    <a href="{{ route('lesson.show', ['kelas'=>$kelas->id,'modul'=>$m->id,'lesson'=>$l->id]) }}"
                                                    class="flex items-center gap-2 px-3 py-1 rounded-lg text-sm transition
                                                    {{ $lesson->id === $l->id 
                                                        ? 'bg-indigo-100 dark:bg-indigo-900/50 font-semibold' 
                                                        : 'hover:bg-indigo-200 dark:hover:bg-indigo-800/30' }}">
                                                        @if($l->type === 'video')
                                                            <i class="ri-play-circle-line text-indigo-600"></i>
                                                        @else
                                                            <i class="ri-file-text-line text-red-500"></i>
                                                        @endif
                                                        <span class="truncate">{{ $l->title }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    {{-- Navbar Mobile --}}
    @include('components.navbar-mobile')
</div>
@endsection

@php
function youtubeEmbed($url) {
    if (!$url) return '';
    $id = null;

    // ambil ID dari URL standar
    if (preg_match('/v=([^\&\?\/]+)/', $url, $matches)) {
        $id = $matches[1];
    }
    // ambil ID dari URL share
    elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $url, $matches)) {
        $id = $matches[1];
    }

    return $id ? "https://www.youtube.com/embed/$id" : '';
}
@endphp
