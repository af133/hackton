@extends('layouts.app')

@section('title', 'Beranda - SkillSwap')

@section('content')
    <nav class="flex items-center justify-between px-6 py-4 shadow-md bg-white dark:bg-gray-800 sticky top-0 z-50">
        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">SkillSwap</div>
        <div class="space-x-6 hidden md:flex">
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400">Home</a>
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400">Features</a>
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400">How It Works</a>
            <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400">Community</a>
        </div>
        <div class="flex items-center space-x-4">
            <x-theme-toggle/>
            @guest
                <a href={{ route('auth.view.login') }} class="px-4 py-2 border rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700">Login</a>
                <a href={{ route('auth.login') }} class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Register</a>
            @endguest
            @auth
                <a href={{ route('auth.view.login') }} class="px-4 py-2 border rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700">Login</a>
            @endauth

        </div>
    </nav>

    <section class="grid md:grid-cols-2 gap-8 px-6 md:px-20 py-16 items-center">
        <div data-aos="fade-right">
            <h1 class="text-4xl md:text-5xl font-bold leading-tight">Belajar Gratis dengan <span class="text-blue-600 dark:text-blue-400">Saling Mengajar</span></h1>
            <p class="mt-4 text-gray-600 dark:text-gray-300">SkillSwap adalah platform gotong royong digital untuk belajar dan mengajar skill baru tanpa biaya.</p>
            <div class="mt-6 space-x-4">
                <a href="#" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Mulai Sekarang</a>
                <a href="#" class="px-6 py-3 border rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">Pelajari Lebih Lanjut</a>
            </div>
        </div>
        <div data-aos="fade-left" class="flex justify-center">
            <img src={{ asset('Hero.png') }} alt="Learning" class="rounded-2xl shadow-lg">
        </div>
    </section>

    <!-- Features -->
    <section class="px-6 md:px-20 py-16 bg-gray-50 dark:bg-gray-800">
        <h2 class="text-3xl font-bold text-center mb-12">Fitur Utama</h2>
        <div class="grid md:grid-cols-4 gap-8">
            <div class="p-6 bg-white dark:bg-gray-700 rounded-xl shadow hover:shadow-lg transition" data-aos="zoom-in">
                <img src={{ asset('Hero.png') }} alt="Profile Skill" class="rounded-lg mb-4">
                <h3 class="font-semibold text-xl mb-2">Profil Skill</h3>
                <p class="text-gray-600 dark:text-gray-300">Isi skill yang bisa kamu ajarkan dan skill yang ingin dipelajari.</p>
            </div>
            <div class="p-6 bg-white dark:bg-gray-700 rounded-xl shadow hover:shadow-lg transition" data-aos="zoom-in" data-aos-delay="100">
                <img src={{ asset('Hero.png') }} alt="Skill Matching" class="rounded-lg mb-4">
                <h3 class="font-semibold text-xl mb-2">Skill Matching</h3>
                <p class="text-gray-600 dark:text-gray-300">Temukan partner belajar yang cocok sesuai kebutuhanmu.</p>
            </div>
            <div class="p-6 bg-white dark:bg-gray-700 rounded-xl shadow hover:shadow-lg transition" data-aos="zoom-in" data-aos-delay="200">
                <img src={{ asset('Hero.png') }} alt="Session Exchange" class="rounded-lg mb-4">
                <h3 class="font-semibold text-xl mb-2">Session Exchange</h3>
                <p class="text-gray-600 dark:text-gray-300">Belajar online/offline melalui sesi singkat 30–60 menit.</p>
            </div>
            <div class="p-6 bg-white dark:bg-gray-700 rounded-xl shadow hover:shadow-lg transition" data-aos="zoom-in" data-aos-delay="300">
                <img src={{ asset('Hero.png') }} alt="Feedback" class="rounded-lg mb-4">
                <h3 class="font-semibold text-xl mb-2">Reputasi & Feedback</h3>
                <p class="text-gray-600 dark:text-gray-300">Dapatkan rating & review setelah sesi belajar untuk tingkatkan kredibilitas.</p>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="px-6 md:px-20 py-16">
        <h2 class="text-3xl font-bold text-center mb-12">Bagaimana Cara Kerjanya?</h2>
        <div class="grid md:grid-cols-3 gap-10">
            <div class="text-center" data-aos="fade-up">
                <img src={{ asset('Hero.png') }} alt="Onboarding" class="mx-auto rounded-lg mb-4">
                <h3 class="font-semibold text-xl mb-2">Onboarding</h3>
                <p class="text-gray-600 dark:text-gray-300">Isi profil skill untuk mengajar & belajar.</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <img src={{ asset('Hero.png') }} alt="Matching" class="mx-auto rounded-lg mb-4">
                <h3 class="font-semibold text-xl mb-2">Matching</h3>
                <p class="text-gray-600 dark:text-gray-300">Sistem merekomendasikan partner belajar yang sesuai.</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <img src={{ asset('Hero.png') }} alt="Session" class="mx-auto rounded-lg mb-4">
                <h3 class="font-semibold text-xl mb-2">Session</h3>
                <p class="text-gray-600 dark:text-gray-300">Belajar mengajar melalui chat, video call, atau offline.</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="px-6 md:px-20 py-16 bg-blue-600 text-white text-center rounded-2xl mx-4 md:mx-20" data-aos="zoom-in">
        <h2 class="text-3xl font-bold mb-4">Siap Tukar Skillmu?</h2>
        <p class="mb-6">Gabung sekarang dan jadilah bagian dari ekosistem belajar kolaboratif.</p>
        <a href="#" class="px-6 py-3 bg-white text-blue-600 rounded-lg font-semibold hover:bg-gray-100">Daftar Gratis</a>
    </section>

    <footer class="px-6 md:px-20 py-10 text-center text-gray-500 dark:text-gray-400 mt-16">
        <p>© {{ date('Y') }} SkillSwap. All rights reserved.</p>
    </footer>
  =


@endsection
