<button id="darkModeToggle" type="button" class="relative flex items-center justify-center rounded-full w-14 h-8 transition-colors duration-300 ease-in-out bg-gray-200 dark:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
    <span class="sr-only">Toggle Dark Mode</span>
    <span class="absolute left-1 flex h-6 w-6 items-center justify-center rounded-full bg-white shadow-md transform transition-transform duration-300 ease-in-out dark:translate-x-full">
        <svg class="h-4 w-4 text-gray-700 dark:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 008.252-4.498z" />
        </svg>
        <svg class="hidden h-4 w-4 text-blue-600 dark:inline dark:relative dark:translate-x-px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.95-4.243l-1.59-1.59M3 12h2.25m.386-6.364l1.59 1.59M12 6a6 6 0 100 12 6 6 0 000-12z" />
        </svg>
    </span>
</button>
@once
    <script>
        const toggleBtn = document.getElementById('darkModeToggle');
        const html = document.documentElement;

        const applyTheme = (theme) => {
            if (theme === 'dark') {
                html.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                html.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }
        };

        toggleBtn.addEventListener('click', () => {
            const currentTheme = localStorage.getItem('color-theme') === 'dark' ? 'light' : 'dark';
            applyTheme(currentTheme);
        });

        const savedTheme = localStorage.getItem('color-theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        applyTheme(savedTheme);
    </script>
@endonce
