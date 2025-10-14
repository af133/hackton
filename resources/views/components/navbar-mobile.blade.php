<nav class="md:hidden fixed bottom-0 z-20 inset-x-0 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border-t border-gray-200 dark:border-gray-800 flex justify-around pb-1">

    <a href="{{ route('dashboard') }}"
       @class([
            'flex flex-col items-center justify-center p-3 w-full transition-colors',
            'text-indigo-600' => request()->routeIs('dashboard'),
            'text-gray-500 hover:text-indigo-500' => !request()->routeIs('dashboard')
       ])>
        <i class="ri-home-4-line text-2xl"></i>
        <span class="text-xs font-medium">Home</span>
    </a>

    {{-- Route: kelas.* --}}
    <a href="{{ route('kelas.show') }}"
       @class([
            'flex flex-col items-center justify-center p-3 w-full transition-colors',
            'text-indigo-600' => request()->routeIs('kelas.*'),
            'text-gray-500 hover:text-indigo-500' => !request()->routeIs('kelas.*')
       ])>
        <i class="ri-book-open-line text-2xl"></i>
        <span class="text-xs font-medium">Kelas</span>
    </a>

    {{-- Route: sosial* --}}
    <a href="{{ route('sosial') }}"
       @class([
            'flex flex-col items-center justify-center p-3 w-full transition-colors',
            'text-indigo-600' => request()->routeIs('sosial*'),
            'text-gray-500 hover:text-indigo-500' => !request()->routeIs('sosial*')
       ])>
        <i class="ri-group-line text-2xl"></i>
        <span class="text-xs font-medium">Sosial</span>
    </a>

    {{-- Route: skill-credit* (sesuaikan namanya) --}}
    <a href="{{ route('skill-credit') }}" {{-- Ganti href dengan route yang sesuai, misal: {{ route('skill-credit') }} --}}
       @class([
            'flex flex-col items-center justify-center p-3 w-full transition-colors',
            'text-indigo-600' => request()->routeIs('skill-credit*'),
            'text-gray-500 hover:text-indigo-500' => !request()->routeIs('skill-credit*')
       ])>
        <i class="ri-wallet-3-line text-2xl"></i>
        <span class="text-xs font-medium">Credit</span>
    </a>

</nav>
