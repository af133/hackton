@extends('layouts.app')

@section('title', 'Detail Diskusi - SkillSwap')
@section('body_class', 'bg-background')

@section('content')
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-background">
    @include('components.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.header-mobile')

        <div class="relative flex-1 overflow-y-auto">
            <main class="relative z-10 p-6 md:p-8 max-w-4xl mx-auto">
                {{-- Navigasi Kembali --}}
                <a href="#" class="text-sm font-medium text-primary hover:underline flex items-center gap-1 mb-4">
                    <i class="ri-arrow-left-s-line"></i>
                    Kembali ke Digital Marketing Circle
                </a>

                {{-- Postingan Utama --}}
                <div class="bg-white p-6 rounded-2xl shadow-md">
                    <div class="flex items-start gap-4">
                        <img class="h-10 w-10 rounded-full object-cover" src="https://i.pravatar.cc/150?u=budi" alt="Budi's Avatar">
                        <div class="w-full">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="font-semibold text-gray-800">Budi Santoso</p>
                                    <p class="text-xs text-gray-400">2 jam yang lalu</p>
                                </div>
                                <button class="text-gray-400 hover:text-primary"><i class="ri-more-2-fill"></i></button>
                            </div>
                            <div class="prose prose-sm max-w-none mt-3">
                                <h2>Rekomendasi Tools SEO Gratis Terbaik?</h2>
                                <p>Teman-teman, ada yang punya rekomendasi tools SEO gratis yang powerfull untuk riset keyword? Selain Ubersuggest. Terutama untuk analisis kompetitor. Terima kasih!</p>
                            </div>
                            <div class="flex items-center gap-4 text-gray-500 mt-4 border-t pt-3">
                                <button class="flex items-center gap-1 hover:text-primary"><i class="ri-heart-3-line"></i> 12 Suka</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form Tulis Balasan --}}
                <div class="mt-6 flex items-start gap-4">
                    <img class="h-10 w-10 rounded-full object-cover" src="https://i.pravatar.cc/150?u=aisyahfarah" alt="User Avatar">
                    <div class="flex-1">
                        <textarea rows="3" class="w-full bg-white border-transparent rounded-lg shadow-sm focus:ring-primary focus:border-primary text-sm" placeholder="Tulis balasan Anda..."></textarea>
                        <div class="flex justify-end mt-2">
                            <button class="px-4 py-2 text-sm font-semibold text-white bg-primary rounded-lg shadow-sm hover:bg-primary-dark">Kirim Balasan</button>
                        </div>
                    </div>
                </div>

                {{-- Daftar Balasan/Komentar --}}
                <div class="mt-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">5 Balasan</h3>
                    <div class="space-y-6">
                        {{-- Contoh Balasan 1 --}}
                        <div class="flex items-start gap-4">
                             <img class="h-9 w-9 rounded-full object-cover" src="https://i.pravatar.cc/150?u=sinta" alt="Sinta's Avatar">
                             <div class="w-full">
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <div class="flex items-center justify-between">
                                        <p class="font-semibold text-sm text-gray-800">Sinta Aulia</p>
                                        <p class="text-xs text-gray-400">1 jam yang lalu</p>
                                    </div>
                                    <p class="text-sm text-gray-700 mt-2">Bisa coba Ahrefs Webmaster Tools, kak. Fitur audit dan keyword research-nya lumayan lengkap untuk versi gratis.</p>
                                </div>
                             </div>
                        </div>
                        {{-- Contoh Balasan 2 --}}
                        <div class="flex items-start gap-4">
                             <img class="h-9 w-9 rounded-full object-cover" src="https://i.pravatar.cc/150?u=andre" alt="Andre's Avatar">
                              <div class="w-full">
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <div class="flex items-center justify-between">
                                        <p class="font-semibold text-sm text-gray-800">Andre Firmansyah</p>
                                        <p class="text-xs text-gray-400">45 menit yang lalu</p>
                                    </div>
                                    <p class="text-sm text-gray-700 mt-2">Setuju sama kak Sinta. Selain itu, Google Keyword Planner juga masih sangat relevan kalau diintegrasikan dengan data dari Google Search Console.</p>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
</div>
@endsection
