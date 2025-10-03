<aside class="hidden md:flex w-64 flex-shrink-0 bg-white border-r border-gray-200 flex-col">
    {{-- Logo --}}
    <div class="h-20 flex items-center px-8">
        <h1 class="text-2xl font-bold text-primary">SkillSwap</h1>
    </div>

    {{-- Menu Navigasi --}}
    <nav class="flex-1 px-6 py-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-white bg-primary rounded-lg shadow-sm">
            <i class="ri-home-4-line mr-3 text-lg"></i>
            Home
        </a>
        <a href="{{ route('kelas.show') }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-500  hover:bg-gray-100  rounded-lg transition-colors">
            <i class="ri-book-open-line mr-3 text-lg"></i>
            Kelas
        </a>
        <a href="{{ route('sosial') }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-500  hover:bg-gray-100  rounded-lg transition-colors">
            <i class="ri-group-line mr-3 text-lg"></i>
            Sosial
        </a>
        <a href="#" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-500  hover:bg-gray-100  rounded-lg transition-colors">
            <i class="ri-wallet-3-line mr-3 text-lg"></i>
            Skill Credit
        </a>
    </nav>

    {{-- Upgrade Card --}}
    <div class="px-6 py-4">
        <div class="p-4 text-center bg-gray-100 dark:bg-gray-800 rounded-lg">
            <p class="text-sm text-gray-700 dark:text-gray-300">Upgrade ke Premium untuk fasilitas lebih lengkap</p>
            <button class="w-full mt-3 px-4 py-2 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-lg transition-colors">
                Upgrade
            </button>
        </div>
    </div>
</aside>

<div x-show="sidebarOpen" class="fixed inset-0 flex z-40 md:hidden" x-cloak>
    {{-- Backdrop/Overlay --}}
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-600 bg-opacity-75" @click="sidebarOpen = false"></div>

    {{-- Konten Sidebar Mobile --}}
    <aside x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative flex-1 flex flex-col max-w-xs w-full bg-white dark:bg-gray-900">
        <div class="absolute top-0 right-0 -mr-12 pt-2">
            <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sidebarOpen = false">
                <span class="sr-only">Tutup sidebar</span>
                <i class="ri-close-line text-white text-2xl"></i>
            </button>
        </div>
        <div class="h-20 flex-shrink-0 flex items-center px-6 border-b dark:border-gray-800">
            <h1 class="text-2xl font-bold text-primary">SkillSwap</h1>
        </div>
        <nav class="flex-1 px-4 py-4 space-y-1">
            {{-- Link yang kurang prioritas bisa ditaruh di sini --}}
            <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg"><i class="ri-settings-3-line mr-3 text-lg"></i> Pengaturan</a>
            <a href="#" class="flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg"><i class="ri-gem-line mr-3 text-lg"></i> Premium</a>
        </nav>
    </aside>
</div>
