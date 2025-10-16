<aside class="hidden md:flex w-64 flex-shrink-0 bg-white border-r border-gray-200 flex-col">
    {{-- Logo --}}
    <div class="h-20 flex items-center px-8">
        <h1 class="text-2xl font-bold text-primary">SkillSwap</h1>
    </div>

    {{-- Menu Navigasi --}}
    <nav class="flex-1 px-6 py-4 space-y-2">
        <a href="{{ route('dashboard') }}"
           @class([
               'flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors',
               'bg-primary text-white shadow-sm' => request()->routeIs('dashboard','profile.*'),
               'text-gray-500 hover:bg-gray-100' => !request()->routeIs('dashboard','profile.*'),
           ])>
            <i class="ri-home-4-line mr-3 text-lg"></i>
            Home
        </a>
        <a href="{{ route('kelas.show') }}"
           @class([
               'flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors',
               'bg-primary text-white shadow-sm' => request()->routeIs('kelas.*'),
               'text-gray-500 hover:bg-gray-100' => !request()->routeIs('kelas.*'),
           ])>
            <i class="ri-book-open-line mr-3 text-lg"></i>
            Kelas
        </a>
        <a href="{{ route('sosial') }}"
           @class([
               'flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors',
               'bg-primary text-white shadow-sm' => request()->routeIs('sosial*'),
               'text-gray-500 hover:bg-gray-100' => !request()->routeIs('sosial*'),
           ])>
            <i class="ri-group-line mr-3 text-lg"></i>
            Sosial
        </a>
        <a href="{{ route('skill-credit') }}"
           @class([
               'flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-colors',
               'bg-primary text-white shadow-sm' => request()->routeIs('skill-credit*'),
               'text-gray-500 hover:bg-gray-100' => !request()->routeIs('skill-credit*'),
           ])>
            <i class="ri-wallet-3-line mr-3 text-lg"></i>
            Skill Credit
        </a>
    </nav>

    <div class="px-6 py-4">
        <div class="p-4 text-center bg-gray-100 dark:bg-gray-800 rounded-lg">
            <p class="text-sm text-gray-700 dark:text-gray-300">Upgrade ke Premium untuk fasilitas lebih lengkap</p>
            <button class="w-full mt-3 px-4 py-2 text-sm font-semibold text-white bg-primary hover:bg-primary-dark rounded-lg transition-colors">
                Upgrade
            </button>
        </div>
    </div>
</aside>
