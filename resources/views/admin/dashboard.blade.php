<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        }
        .sidebar-link {
            transition: all 0.3s ease;
        }
        .sidebar-link:hover {
            transform: translateX(5px);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }
        .btn-hover {
            transition: all 0.3s ease;
        }
        .btn-hover:hover {
            transform: translateY(-2px);
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
    <script>
        // Initialize theme based on localStorage or system preference
        function initializeTheme() {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = savedTheme === 'dark' || (!savedTheme && prefersDark);
            document.documentElement.classList.toggle('dark', isDark);
            updateThemeIcon(isDark);
        }

        // Toggle dark mode
        function toggleDarkMode() {
            const isDark = !document.documentElement.classList.contains('dark');
            document.documentElement.classList.toggle('dark', isDark);
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateThemeIcon(isDark);
        }

        // Update theme icon (sun for light, moon for dark)
        function updateThemeIcon(isDark) {
            const themeIcon = document.getElementById('themeIcon');
            if (themeIcon) {
                themeIcon.innerHTML = isDark ? 
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"></path></svg>' :
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>';
            }
        }

        // Initialize theme on page load
        document.addEventListener('DOMContentLoaded', initializeTheme);

        // Toggle user dropdown
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        }

        // Listen for system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!localStorage.getItem('theme')) {
                document.documentElement.classList.toggle('dark', e.matches);
                updateThemeIcon(e.matches);
            }
        });

        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        if (sidebar && sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('-translate-x-full');
            });
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen flex transition-colors duration-300">
    @if (!Session::has('user'))
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @endif
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-indigo-600 to-purple-600 dark:from-indigo-900 dark:to-purple-900 shadow-2xl h-screen fixed top-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out" id="sidebar">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-white dark:text-indigo-100">Control Panel</h2>
            <p class="text-sm text-indigo-100 dark:text-indigo-200 mt-2">Hello, {{ Session::get('user')->name }}</p>
        </div>
        <nav class="mt-6">
            <a href="{{ route('admin.pages.index') }}" class="block px-6 py-3 text-white dark:text-indigo-200 hover:bg-indigo-700 dark:hover:bg-indigo-800 sidebar-link rounded-l-lg">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Pages
                </span>
            </a>
            <a href="{{ route('logout') }}" class="block px-6 py-3 text-white dark:text-indigo-200 hover:bg-indigo-700 dark:hover:bg-indigo-800 sidebar-link rounded-l-lg">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h3a3 3 0 013 3v1"></path>
                    </svg>
                    Sign Out
                </span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 ml-0 md:ml-64 transition-all duration-300">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-900 shadow-lg p-4 flex justify-between items-center">
            <div class="flex items-center">
                <button id="sidebarToggle" class="md:hidden text-indigo-600 dark:text-indigo-400 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <h1 class="text-2xl font-semibold ml-4 text-indigo-600 dark:text-indigo-400 bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Dashboard</h1>
            </div>
            <div class="flex items-center space-x-4">
                <button class="p-2 rounded-full bg-indigo-100 dark:bg-indigo-950 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-200 dark:hover:bg-indigo-900 btn-hover relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 dark:bg-red-400 rounded-full"></span>
                </button>
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center space-x-2 text-indigo-600 dark:text-indigo-400 focus:outline-none">
                        <span>Hello, {{ Session::get('user')->name }}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-900 rounded-lg shadow-lg py-2 z-10">
                        <a href="#" class="block px-4 py-2 text-gray-600 dark:text-indigo-200 hover:bg-indigo-100 dark:hover:bg-indigo-800 transition-colors">Profile</a>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-600 dark:text-indigo-200 hover:bg-indigo-100 dark:hover:bg-indigo-800 transition-colors">Sign Out</a>
                    </div>
                </div>
                <button onclick="toggleDarkMode()" class="p-2 rounded-full bg-indigo-100 dark:bg-indigo-950 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-200 dark:hover:bg-indigo-900 btn-hover">
                    <span id="themeIcon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </span>
                </button>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="p-6 animate-fade-in">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Overview Card -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg card-hover flex items-start">
                    <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3M6 21h12a1 1 0 001-1v-3"></path>
                    </svg>
                    <div>
                        <h2 class="text-xl font-semibold text-indigo-600 dark:text-indigo-400 mb-2">Overview</h2>
                        <p class="text-gray-600 dark:text-gray-200">Hello, {{ Session::get('user')->name }}. Manage your pages or explore settings.</p>
                    </div>
                </div>
                <!-- Stats Card -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg card-hover flex items-start">
                    <svg class="w-8 h-8 text-purple-600 dark:text-purple-400 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2V9"></path>
                    </svg>
                    <div>
                        <h2 class="text-xl font-semibold text-purple-600 dark:text-purple-400 mb-2">Statistics</h2>
                        <p class="text-gray-600 dark:text-gray-200">Pages: <span class="font-bold">42</span></p>
                        <p class="text-gray-600 dark:text-gray-200">Users: <span class="font-bold">128</span></p>
                        <p class="text-gray-600 dark:text-gray-200">Updated: <span class="font-bold">May 28, 2025</span></p>
                    </div>
                </div>
                <!-- Quick Actions Card -->
                <div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg card-hover flex items-start">
                    <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    <div>
                        <h2 class="text-xl font-semibold text-indigo-600 dark:text-indigo-400 mb-2">Actions</h2>
                        <a href="{{ route('admin.pages.index') }}" class="inline-block px-4 py-2 bg-indigo-600 dark:bg-indigo-700 text-white dark:text-white rounded-lg btn-hover hover:bg-indigo-700 dark:hover:bg-indigo-800">Pages</a>
                        <a href="#" class="inline-block px-4 py-2 bg-purple-600 dark:bg-purple-700 text-white dark:text-white rounded-lg btn-hover hover:bg-purple-700 dark:hover:bg-purple-800 mt-2">Reports</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>