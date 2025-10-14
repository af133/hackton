<header class="md:hidden sticky top-0 z-20 flex items-center justify-between h-20 px-6 bg-white/80 backdrop-blur-sm border-b border-gray-200">
    <button @click="sidebarOpen = true" class="text-gray-500 dark:text-gray-300">
        <i class="ri-menu-2-line text-2xl"></i>
    </button>
    <div class="flex items-center gap-x-3">
        <span class="font-semibold text-gray-700 dark:text-gray-200 text-sm">{{ auth()->user()->name }}</span>
        <img class="h-9 w-9 rounded-full object-cover" src="{{ auth()->user()->profile_photo_url }}" alt="User avatar">
    </div>
</header>
