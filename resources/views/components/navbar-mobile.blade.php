{{--
======================================================================
MOBILE BOTTOM NAVIGATION BAR
- Tampil hanya di layar kecil (md:hidden)
======================================================================
--}}
<nav class="md:hidden fixed bottom-0 z-20 inset-x-0 bg-white/80 dark:bg-gray-900/80 backdrop-blur-sm border-t border-gray-200 dark:border-gray-800 flex justify-around pb-1">
    <a href="#" class="flex flex-col items-center justify-center p-3 text-indigo-600 w-full">
        <i class="ri-home-4-line text-2xl"></i>
        <span class="text-xs font-medium">Home</span>
    </a>
    <a href="#" class="flex flex-col items-center justify-center p-3 text-gray-500  w-full hover:text-indigo-500 transition-colors">
        <i class="ri-calendar-2-line text-2xl"></i>
        <span class="text-xs font-medium">Jadwal</span>
    </a>
    <a href="#" class="flex flex-col items-center justify-center p-3 text-gray-500  w-full hover:text-indigo-500 transition-colors">
        <i class="ri-book-open-line text-2xl"></i>
        <span class="text-xs font-medium">Materi</span>
    </a>
    <a href="#" class="flex flex-col items-center justify-center p-3 text-gray-500  w-full hover:text-indigo-500 transition-colors">
        <i class="ri-group-line text-2xl"></i>
        <span class="text-xs font-medium">Murid</span>
    </a>
</nav>
