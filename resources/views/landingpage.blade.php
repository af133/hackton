@extends('layouts.app')

@section('title', 'Tukar Skill, Buka Peluang Baru - SkillSwap')

@section('content')

{{-- TAMBAHKAN id="beranda" dan data-section agar bisa dideteksi oleh Intersection Observer --}}
<div id="beranda" data-section class="relative min-h-[600px] flex items-center justify-center overflow-hidden rounded-b-3xl bg-primary dark:bg-gray-900 shadow-lg">
    {{-- Background Image Overlay --}}
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/Hero.png') }}" alt="People learning and collaborating" class="w-full h-full object-cover opacity-80">
        <div class="absolute inset-0 bg-gradient-to-t from-primary-dark to-primary opacity-70"></div>
    </div>

    {{-- Navbar dengan Alpine.js untuk menjadi "Sticky" dan "Autohide" saat di-scroll --}}
    <nav x-data="{
            open: false,
            activeTab: 'beranda',
            hoveredTab: null,
            isScrolled: false,
            showNav: true, // State untuk menampilkan/menyembunyikan nav
            scrollTimeout: null, // State untuk timer

            updateHighlight(tabId) {
                const targetTab = tabId || this.activeTab;
                if (this.$refs[targetTab]) {
                    const tab = this.$refs[targetTab];
                    const highlight = this.$refs.highlight;
                    highlight.style.left = `${tab.offsetLeft}px`;
                    highlight.style.width = `${tab.offsetWidth}px`;
                    highlight.style.top = `${tab.offsetTop}px`;
                    highlight.style.height = `${tab.offsetHeight}px`;
                }
            },
            setActiveTab(tabId) {
                this.activeTab = tabId;
                this.updateHighlight(tabId);
                const element = document.getElementById(tabId);
                if (element) {
                    element.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            },
            updateActiveTabOnScroll(tabId) {
                if (this.activeTab !== tabId) {
                    this.activeTab = tabId;
                    if (this.hoveredTab === null) {
                        this.updateHighlight(tabId);
                    }
                }
            }
        }"
        x-init="() => {
            // Event listener untuk scroll
            window.addEventListener('scroll', () => {
                // Tentukan apakah kita sudah scroll melewati hero
                isScrolled = window.scrollY > 10;

                // Selalu tampilkan nav saat sedang scroll
                showNav = true;
                clearTimeout(scrollTimeout);

                // Jika kita berada di luar hero section, atur timer untuk menyembunyikan nav setelah berhenti scroll
                if (isScrolled) {
                    scrollTimeout = setTimeout(() => {
                        showNav = false;
                    }, 1000); // Sembunyikan setelah 1 detik tidak aktif
                }
            });

            // Inisialisasi highlight
            $nextTick(() => {
                updateHighlight();
            });

            // Intersection Observer untuk section
            const sections = document.querySelectorAll('[data-section]');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateActiveTabOnScroll(entry.target.id);
                    }
                });
            }, { threshold: 0.4 });
            sections.forEach(section => {
                observer.observe(section);
            });
        }"
        {{-- PERUBAHAN UTAMA: Class diubah menjadi dinamis berdasarkan state 'isScrolled' dan 'showNav' --}}
        :class="{
            'fixed bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm shadow-lg': isScrolled,
            'absolute': !isScrolled,
            'transform -translate-y-full': !showNav && isScrolled
        }"
        class="top-0 left-0 right-0 z-20 w-full px-6 md:px-8 py-4 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            {{-- Logo --}}
            <div class="flex-shrink-0">
                <a href="/" class="text-2xl font-bold transition-colors"
                :class="isScrolled ? 'text-gray-800 dark:text-white' : 'text-white'">
                SkillSwap
                </a>
            </div>

            {{-- Navigasi Tengah (Pill Menu dengan Animasi) --}}
            <div class="hidden md:flex relative items-center gap-x-2 bg-white p-2 rounded-full"
                @mouseleave="hoveredTab = null; updateHighlight(activeTab)">
                <span x-ref="highlight" class="absolute top-0 h-full bg-primary rounded-full transition-all duration-300 ease-in-out z-0"></span>
                <a href="#beranda" x-ref="beranda" @click.prevent="setActiveTab('beranda')" @mouseenter="hoveredTab = 'beranda'; updateHighlight('beranda')" :class="(hoveredTab === 'beranda' || (hoveredTab === null && activeTab === 'beranda')) ? 'text-white' : 'text-gray-900'" class="relative z-10 px-4 py-2 text-sm font-medium rounded-full transition-colors duration-300">Beranda</a>
                <a href="#fitur" x-ref="fitur" @click.prevent="setActiveTab('fitur')" @mouseenter="hoveredTab = 'fitur'; updateHighlight('fitur')" :class="(hoveredTab === 'fitur' || (hoveredTab === null && activeTab === 'fitur')) ? 'text-white' : 'text-gray-900'" class="relative z-10 px-4 py-2 text-sm font-medium rounded-full transition-colors duration-300">Fitur Kami</a>
                <a href="#cara-kerja" x-ref="cara-kerja" @click.prevent="setActiveTab('cara-kerja')" @mouseenter="hoveredTab = 'cara-kerja'; updateHighlight('cara-kerja')" :class="(hoveredTab === 'cara-kerja' || (hoveredTab === null && activeTab === 'cara-kerja')) ? 'text-white' : 'text-gray-900'" class="relative z-10 px-4 py-2 text-sm font-medium rounded-full transition-colors duration-300">Cara kerja</a>
            </div>

            @auth

            @endauth
            {{-- Tombol Login/Register (Desktop) --}}
            <div class="hidden md:flex items-center space-x-4">
                {{-- Tombol Log In berubah style saat di-scroll --}}
                <a href="{{ route('login') }}" class="px-5 py-2 rounded-lg text-sm font-semibold transition-colors"
                    :class="isScrolled ? 'text-primary hover:bg-primary/10' : 'bg-black/20 border border-white/20 text-white hover:bg-black/30'">
                    Log In
                </a>
                {{-- Tombol Register berubah style saat di-scroll --}}
                <a href="{{ route('register') }}" class="px-5 py-2 rounded-lg text-sm font-semibold transition-colors"
                    :class="isScrolled ? 'bg-primary text-white hover:bg-primary-dark' : 'bg-gray-900 text-white hover:bg-gray-800'">
                    Register
                </a>
            </div>

            {{-- Tombol Hamburger (Mobile) --}}
            <div class="md:hidden">
                <button @click="open = !open" class="focus-outline-none p-2 rounded-full transition-colors"
                        :class="isScrolled ? 'text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700' : 'text-white bg-black/20'">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path :class="{'hidden': open, 'inline-flex': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Menu Mobile Dropdown --}}
        <div x-show="open" @click.away="open = false" class="md:hidden mt-2 p-4 bg-white/95 dark:bg-gray-800/95 rounded-lg shadow-lg" x-transition>
            <a href="#beranda" @click="open = false; setActiveTab('beranda')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Beranda</a>
            <a href="#fitur" @click="open = false; setActiveTab('fitur')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Fitur Kami</a>
            <a href="#cara-kerja" @click="open = false; setActiveTab('cara-kerja')" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">Cara kerja</a>
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="{{ route('login') }}" class="block w-full text-center px-5 py-2 border border-primary text-primary rounded-lg text-sm font-semibold hover:bg-primary/10 dark:hover:bg-gray-700">Log In</a>
                <a href="{{ route('register') }}" class="block w-full text-center mt-2 px-5 py-2 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary-dark">Register</a>
            </div>
        </div>
    </nav>

    {{-- Hero Content --}}
    <header class="relative z-10 text-center max-w-4xl mx-auto px-6 md:px-8 py-20 md:py-32">
        <h1 class="text-4xl md:text-5xl font-bold leading-tight text-white" data-aos="fade-up">
            Tukar Skill, Buka Peluang Baru
        </h1>
        <p class="mt-4 text-lg md:text-xl text-white max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            Belajar apa saja, ajarkan apa yang kamu bisa. Tanpa uang, cukup dengan Skill Credit.
        </p>
        <div class="mt-8 flex justify-center flex-wrap gap-4" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('register') }}" class="px-8 py-3 bg-white text-primary font-semibold rounded-lg shadow-md hover:bg-gray-100 transition duration-300 flex items-center gap-2">
                Mulai Belajar <span class="text-xl">➔</span>
            </a>
            <a href="#" class="px-8 py-3 bg-white/20 border-2 border-white text-white font-semibold rounded-lg hover:bg-white/30 transition duration-300">
                Jadi Pengajar
            </a>
        </div>
    </header>
</div>

<section class="py-16 md:py-24 bg-white dark:bg-gray-900">
    <div class="max-w-7xl mx-auto px-6 md:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 dark:text-gray-100 mb-16" data-aos="fade-up">
            Kenapa <span class="text-primary">SkillSwap?</span>
        </h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            {{-- Card 1: Belajar Skill Baru --}}
            <div class="p-8 bg-primary/5 dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-primary mb-6">
                    {{-- PERUBAHAN: Menggunakan Font Icon dari CDN --}}
                    <i class="ri-graduation-cap-line text-2xl text-white"></i>
                </div>
                <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-100">Belajar skill baru secara gratis.</h3>
            </div>

            {{-- Card 2: Barter Skill --}}
            <div class="p-8 bg-primary/5 dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-primary mb-6">
                    {{-- PERUBAHAN: Menggunakan Font Icon dari CDN --}}
                    <i class="ri-team-line text-2xl text-white"></i>
                </div>
                <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-100">Barter skill dengan orang lain.</h3>
            </div>

            {{-- Card 3: Bangun Portofolio --}}
            <div class="p-8 bg-primary/5 dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-primary mb-6">
                    {{-- PERUBAHAN: Menggunakan Font Icon dari CDN --}}
                    <i class="ri-award-line text-2xl text-white"></i>
                </div>
                <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-100">Bangun Portofolio dan Reputasi.</h3>
            </div>

            {{-- Card 4: Perluas Jaringan --}}
            <div class="p-8 bg-primary/5 dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300" data-aos="fade-up" data-aos-delay="400">
                <div class="flex items-center justify-center h-12 w-12 rounded-full bg-primary mb-6">
                    {{-- PERUBAHAN: Menggunakan Font Icon dari CDN --}}
                    <i class="ri-global-line text-2xl text-white"></i>
                </div>
                <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-100">Memperluas jaringan profesional.</h3>
            </div>

        </div>
    </div>
</section>

{{-- TAMBAHKAN data-section agar bisa dideteksi --}}
<section id="fitur" data-section class="py-16 md:py-24 bg-white dark:bg-gray-900 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-8">
        {{-- Header Section --}}
        <div class="text-center max-w-2xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-gray-100 mb-4" data-aos="fade-up">
                Fitur Kami
            </h2>
            <p class="text-gray-500 dark:text-gray-400" data-aos="fade-up" data-aos-delay="100">
                Belajar & berbagi skill jadi lebih mudah dengan fitur-fitur yang bikin pengalamanmu seru, transparan, dan bermanfaat.
            </p>
        </div>

        {{-- Logika Alpine.js diperbarui untuk Intersection Observer --}}
        <div x-data="{
                    features: ['profile', 'matching', 'credit'],
                    activeFeature: 'profile',
                    interval: null,

                    nextFeature() {
                        const currentIndex = this.features.indexOf(this.activeFeature);
                        const nextIndex = (currentIndex + 1) % this.features.length;
                        this.activeFeature = this.features[nextIndex];
                    },

                    startSlider() {
                        // Mencegah duplikasi timer
                        if (this.interval) return;
                        this.interval = setInterval(() => {
                            this.nextFeature();
                        }, 3000);
                    },

                    stopSlider() {
                        clearInterval(this.interval);
                        this.interval = null;
                    },

                    selectFeature(feature) {
                        this.activeFeature = feature;
                        this.stopSlider();
                        this.startSlider();
                    }
                }"
                {{-- PERUBAHAN UTAMA: x-init sekarang menggunakan Intersection Observer --}}
                x-init="() => {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            // Jika elemen (slider) masuk ke viewport
                            if (entry.isIntersecting) {
                                startSlider();
                            }
                            // Jika elemen keluar dari viewport
                            else {
                                stopSlider();
                            }
                        });
                    }, { threshold: 0.1 }); // Memicu saat 10% elemen terlihat

                    observer.observe($el); // $el adalah elemen div ini sendiri
                }"
                @mouseenter="stopSlider()"
                @mouseleave="isIntersecting && startSlider()" {{-- Hanya mulai lagi jika masih terlihat --}}
                class="mt-16 relative min-h-[450px]">

            {{-- Konten Fitur 1: Profil Skill --}}
            <div x-show="activeFeature === 'profile'"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform translate-y-5"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-500 absolute w-full"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-5"
                    class="w-full">
                <div class="grid md:grid-cols-2 gap-16 items-center">
                    <div data-aos="fade-right">
                        <div class="inline-flex items-center gap-x-3 bg-primary/10 text-primary dark:bg-primary/20 px-4 py-2 rounded-full mb-6">
                            <h3 class="text-2xl font-bold">Profil Skill</h3>
                        </div>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-6">
                            Tunjukkan <strong class="text-primary">siapa kamu</strong> & apa yang kamu bisa.
                        </p>
                        <ul class="space-y-4 text-gray-600 dark:text-gray-400">
                            <li class="flex items-start gap-x-3">
                                <i class="ri-checkbox-circle-line text-primary mt-1"></i>
                                <span>Daftar skill yang bisa kamu ajarkan & skill yang ingin kamu pelajari.</span>
                            </li>
                            <li class="flex items-start gap-x-3">
                                <i class="ri-checkbox-circle-line text-primary mt-1"></i>
                                <span>Lengkapi dengan pengalaman, portofolio, rating, & review.</span>
                            </li>
                            <li class="flex items-start gap-x-3">
                                <i class="ri-search-eye-line text-primary mt-1"></i>
                                <span>Transparansi penuh: orang langsung tahu nilai unikmu.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="relative" data-aos="fade-left">
                        <div class="absolute -top-8 -left-8 w-48 h-48 bg-cyan-300/30 dark:bg-cyan-700/30 rounded-2xl transform rotate-12 z-0"></div>
                        <div class="absolute -bottom-8 -right-8 w-64 h-64 bg-primary/10 dark:bg-primary/20 rounded-2xl transform rotate-6 z-0"></div>
                        <div class="relative z-10">
                            <img src="{{ asset('images/feature-profile.png') }}" alt="Profil Skill" class="rounded-2xl shadow-2xl w-full">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Konten Fitur 2: Skill Matching (tersembunyi) --}}
            <div x-show="activeFeature === 'matching'"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform translate-y-5"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-500 absolute w-full"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-5"
                    style="display: none;" class="w-full">
                <div class="grid md:grid-cols-2 gap-16 items-center">
                    <div class="md:order-last" data-aos="fade-left">
                        <div class="inline-flex items-center gap-x-3 bg-primary/10 text-primary dark:bg-primary/20 px-4 py-2 rounded-full mb-6">
                            <h3 class="text-2xl font-bold">Skill Matching</h3>
                        </div>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-6">Temukan <strong class="text-primary">partner belajar</strong> yang paling cocok.</p>
                        <ul class="space-y-4 text-gray-600 dark:text-gray-400">
                            <li class="flex items-start gap-x-3">
                                <i class="ri-checkbox-circle-line text-primary mt-1"></i>
                                <span><b>Credit match:</b> gunakan kredit untuk belajar skill lain secara fleksibel.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="relative" data-aos="fade-right">
                        <div class="absolute -top-8 -left-8 w-48 h-48 bg-cyan-300/30 dark:bg-cyan-700/30 rounded-2xl transform rotate-12 z-0"></div>
                        <div class="absolute -bottom-8 -right-8 w-64 h-64 bg-primary/10 dark:bg-primary/20 rounded-2xl transform rotate-6 z-0"></div>
                        <div class="relative z-10"><img src="{{ asset('images/feature-profile.png') }}" alt="Skill Matching" class="rounded-2xl shadow-2xl w-full"></div>
                    </div>
                </div>
            </div>

            {{-- Konten Fitur 3: Skill Credit System (tersembunyi) --}}
            <div x-show="activeFeature === 'credit'"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform translate-y-5"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-500 absolute w-full"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-5"
                    style="display: none;" class="w-full">
                <div class="grid md:grid-cols-2 gap-16 items-center">
                    <div data-aos="fade-right">
                        <div class="inline-flex items-center gap-x-3 bg-primary/10 text-primary dark:bg-primary/20 px-4 py-2 rounded-full mb-6">
                            <h3 class="text-2xl font-bold">Skill Credit System</h3>
                        </div>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mb-6">Sistem barter yang <strong class="text-primary">adil dan fleksibel</strong> tanpa uang.</p>
                        <ul class="space-y-4 text-gray-600 dark:text-gray-400">
                            <li class="flex items-start gap-x-3">
                                <i class="ri-checkbox-circle-line text-primary mt-1"></i>
                                <span>Ajarkan orang lain untuk mendapatkan Skill Credit.</span>
                            </li>
                            <li class="flex items-start gap-x-3">
                                <i class="ri-checkbox-circle-line text-primary mt-1"></i>
                                <span>Gunakan kredit yang terkumpul untuk belajar skill baru dari siapapun.</span>
                            </li>
                        </ul>
                    </div>
                    <div class="relative" data-aos="fade-left">
                        <div class="absolute -top-8 -left-8 w-48 h-48 bg-cyan-300/30 dark:bg-cyan-700/30 rounded-2xl transform rotate-12 z-0"></div>
                        <div class="absolute -bottom-8 -right-8 w-64 h-64 bg-primary/10 dark:bg-primary/20 rounded-2xl transform rotate-6 z-0"></div>
                        <div class="relative z-10"><img src="{{ asset('images/feature-profile.png') }}" alt="Skill Credit System" class="rounded-2xl shadow-2xl w-full"></div>
                    </div>
                </div>
            </div>

            {{-- Navigasi Dots --}}
            <div class="flex justify-center items-center gap-x-3 mt-16" data-aos="fade-up">
                <button @click="selectFeature('profile')" :class="activeFeature === 'profile' ? 'bg-primary w-6' : 'bg-gray-300 dark:bg-gray-600 w-3'" class="h-3 rounded-full transition-all duration-300"></button>
                <button @click="selectFeature('matching')" :class="activeFeature === 'matching' ? 'bg-primary w-6' : 'bg-gray-300 dark:bg-gray-600 w-3'" class="h-3 rounded-full transition-all duration-300"></button>
                <button @click="selectFeature('credit')" :class="activeFeature === 'credit' ? 'bg-primary w-6' : 'bg-gray-300 dark:bg-gray-600 w-3'" class="h-3 rounded-full transition-all duration-300"></button>
            </div>
        </div>
    </div>
</section>

{{-- Mengganti Section "Cara Kerjanya Simpel" dengan desain baru yang lebih detail --}}
<section id="cara-kerja" data-section class="relative py-16 md:py-24 bg-white dark:bg-gray-900 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-8">

        {{-- Baris Kartu Fitur Tambahan (Feedback, Community) --}}
        {{-- DIUBAH: dari lg:grid-cols-3 menjadi lg:grid-cols-2 dan ditengahkan --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-24 lg:max-w-4xl lg:mx-auto">

            {{-- Card 1: Feedback dan Rating --}}
            <div class="relative bg-white dark:bg-gray-800 p-8 pt-16 rounded-2xl shadow-lg text-center" data-aos="fade-up">
                <div class="absolute -top-7 left-1/2 -translate-x-1/2 flex items-center justify-center h-14 w-14 rounded-xl bg-blue-500 shadow-lg">
                    {{-- PERUBAHAN: Menggunakan Font Icon dari CDN --}}
                    <i class="ri-feedback-line text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">Feedback dan Rating</h3>
                <ul class="space-y-3 text-gray-500 dark:text-gray-400 text-left">
                    {{-- PERUBAHAN: Emoji diganti dengan Font Icon --}}
                    <li class="flex items-start gap-x-3"><i class="ri-star-line text-amber-500 mt-1"></i><span>Review dari murid → reputasi kamu makin kuat.</span></li>
                    <li class="flex items-start gap-x-3"><i class="ri-thumb-up-line text-green-500 mt-1"></i><span>Feedback bantu sistem kasih rekomendasi terbaik.</span></li>
                </ul>
            </div>

            {{-- Card 3: Community / Circle --}}
            <div class="relative bg-white dark:bg-gray-800 p-8 pt-16 rounded-2xl shadow-lg text-center" data-aos="fade-up" data-aos-delay="150">
                <div class="absolute -top-7 left-1/2 -translate-x-1/2 flex items-center justify-center h-14 w-14 rounded-xl bg-cyan-500 shadow-lg">
                    {{-- PERUBAHAN: Menggunakan Font Icon dari CDN --}}
                    <i class="ri-team-line text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">Community / circle</h3>
                <ul class="space-y-3 text-gray-500 dark:text-gray-400 text-left">
                    <li class="flex items-start gap-x-3"><i class="ri-group-2-line text-cyan-500 mt-1"></i><span>Gabung circle sesuai minat.</span></li>
                    <li class="flex items-start gap-x-3"><i class="ri-mic-line text-purple-500 mt-1"></i><span>Ikut event, diskusi, & belajar bareng.</span></li>
                </ul>
            </div>
        </div>

        {{-- Judul dan Langkah-langkah Penggunaan --}}
        <div class="text-center max-w-4xl mx-auto">
            <h2 class="text-3xl md-text-4xl font-bold text-gray-800 dark:text-gray-100 mb-12" data-aos="fade-up">
                Bagaimana cara menggunakan <span class="text-primary">SkillSwap?</span>
            </h2>
            <div class="space-y-6 text-left max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="150">
                <div class="flex items-start gap-x-4">
                    <div class="flex items-center justify-center h-8 w-8 rounded-full bg-primary/10 text-primary font-bold flex-shrink-0">1</div>
                    <p class="text-gray-600 dark:text-gray-400"><strong class="text-gray-800 dark:text-gray-200">Buat Profil</strong> → Tulis skill yang bisa kamu ajarkan & yang ingin dipelajari.</p>
                </div>
                <div class="flex items-start gap-x-4">
                    <div class="flex items-center justify-center h-8 w-8 rounded-full bg-primary/10 text-primary font-bold flex-shrink-0">2</div>
                    <p class="text-gray-600 dark:text-gray-400"><strong class="text-gray-800 dark:text-gray-200">Tukar Skill</strong> → Barter langsung atau kumpulkan kredit.</p>
                </div>
                <div class="flex items-start gap-x-4">
                    <div class="flex items-center justify-center h-8 w-8 rounded-full bg-primary/10 text-primary font-bold flex-shrink-0">3</div>
                    <p class="text-gray-600 dark:text-gray-400"><strong class="text-gray-800 dark:text-gray-200">Belajar & Berkembang</strong> → Perluas relasi, dapat pengalaman, tambah ilmu.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Section Call to Action (CTA) --}}
<section class="py-16 md:py-24 bg-white dark:bg-gray-900">
    <div class="max-w-5xl mx-auto px-6 md:px-8">
        <div class="relative bg-primary dark:bg-primary-dark rounded-2xl shadow-2xl overflow-hidden" data-aos="fade-up">
            {{-- Elemen Dekoratif --}}
            <div class="absolute -bottom-16 -left-16 w-48 h-48 bg-white/10 rounded-full"></div>
            <div class="absolute -top-16 -right-16 w-64 h-64 bg-white/10 rounded-full"></div>

            <div class="relative text-center px-8 py-16 md:py-20">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Mulai Perjalanan Belajarmu Hari Ini!
                </h2>
                <p class="text-white/80 max-w-xl mx-auto mb-8">
                    Bergabunglah dengan ribuan anggota komunitas lainnya. Daftar sekarang, temukan partner belajar, dan mulailah bertukar skill. Gratis!
                </p>
                <a href="{{ route('register') }}" class="inline-block px-10 py-4 bg-white text-primary font-bold rounded-lg shadow-lg hover:bg-gray-100 transition-transform transform hover:scale-105 duration-300">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</section>


{{-- Footer Baru yang Lebih Lengkap dengan Ikon dari CDN --}}
<footer class="bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto py-16 px-6 md:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            {{-- Kolom 1: Logo dan Sosial Media --}}
            <div class="md:col-span-2 lg:col-span-1">
                <a href="/" class="text-2xl font-bold text-gray-800 dark:text-white">SkillSwap</a>
                <p class="mt-4 text-gray-500 dark:text-gray-400">
                    Platform untuk belajar dan berbagi keahlian tanpa batas, cukup dengan bertukar skill.
                </p>
                <div class="mt-6 flex space-x-4">
                    {{-- PERUBAHAN: Ikon SVG diganti dengan Font Icon --}}
                    <a href="#" class="text-gray-400 hover:text-primary dark:hover:text-white">
                        <span class="sr-only">Twitter</span>
                        <i class="ri-twitter-x-line text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary dark:hover:text-white">
                        <span class="sr-only">Instagram</span>
                        <i class="ri-instagram-line text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-primary dark:hover:text-white">
                        <span class="sr-only">LinkedIn</span>
                        <i class="ri-linkedin-box-line text-2xl"></i>
                    </a>
                </div>
            </div>

            {{-- Kolom 2: Link Produk --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 tracking-wider uppercase">Produk</h3>
                <ul class="mt-4 space-y-3">
                    <li><a href="#fitur" class="text-base text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-white">Fitur</a></li>
                    <li><a href="#cara-kerja" class="text-base text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-white">Cara Kerja</a></li>
                    <li><a href="#" class="text-base text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-white">Komunitas</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Link Perusahaan --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 tracking-wider uppercase">Perusahaan</h3>
                <ul class="mt-4 space-y-3">
                    <li><a href="#" class="text-base text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-white">Tentang Kami</a></li>
                    <li><a href="#" class="text-base text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-white">Karir</a></li>
                    <li><a href="#" class="text-base text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-white">Kontak</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Link Legal --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-200 tracking-wider uppercase">Legal</h3>
                <ul class="mt-4 space-y-3">
                    <li><a href="#" class="text-base text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-white">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-base text-gray-500 dark:text-gray-400 hover:text-primary dark:hover:text-white">Syarat & Ketentuan</a></li>
                </ul>
            </div>

        </div>

        <div class="mt-12 border-t border-gray-200 dark:border-gray-700 pt-8 text-center">
            <p class="text-base text-gray-400">&copy; {{ date('Y') }} SkillSwap. All rights reserved.</p>
        </div>
    </div>
</footer>



@endsection
