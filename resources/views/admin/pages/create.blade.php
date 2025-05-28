<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin - Create Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            themeIcon.innerHTML = isDark ? 
                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z"></path></svg>' :
                '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>';
        }

        // Initialize theme on page load
        document.addEventListener('DOMContentLoaded', initializeTheme);

        // Toggle user dropdown
        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('hidden');
        }

        // Listen for system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!localStorage.getItem('theme')) {
                document.documentElement.classList.toggle('dark', e.matches);
                updateThemeIcon(e.matches);
            }
        });

        // File input preview
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview" class="h-16 w-16 object-cover rounded">`;
                };
                reader.readAsDataURL(file);
            } else {
                preview.innerHTML = '<span class="text-gray-600 dark:text-gray-200">No Image</span>';
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen flex transition-colors duration-300">
    @if (!Session::has('user'))
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @endif
    <!-- Sidebar -->
    <aside class="w-64 bg-teal-500 dark:bg-teal-900 shadow-lg h-screen fixed top-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out" id="sidebar">
        <div class="p-6">
            <h2 class="text-2xl font-bold text-white dark:text-teal-100">Admin Dashboard</h2>
            <p class="text-sm text-teal-100 dark:text-teal-200 mt-2">Welcome, {{ Session::get('user')->name }}</p>
        </div>
        <nav class="mt-6">
            <a href="{{ route('admin.pages.index') }}" class="block px-6 py-3 text-white dark:text-teal-200 hover:bg-teal-600 dark:hover:bg-teal-800 transition-colors duration-200 rounded-l-lg">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Manage Pages
                </span>
            </a>
            <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 text-white dark:text-teal-200 hover:bg-teal-600 dark:hover:bg-teal-800 transition-colors duration-200 rounded-l-lg">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3M6 21h12a1 1 0 001-1v-3"></path>
                    </svg>
                    Dashboard
                </span>
            </a>
            <a href="{{ route('logout') }}" class="block px-6 py-3 text-white dark:text-teal-200 hover:bg-teal-600 dark:hover:bg-teal-800 transition-colors duration-200 rounded-l-lg">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h3a3 3 0 013 3v1"></path>
                    </svg>
                    Logout
                </span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 ml-0 md:ml-64 transition-all duration-300">
        <!-- Header -->
        <header class="bg-white dark:bg-gray-800 shadow p-4 flex justify-between items-center">
            <div class="flex items-center">
                <button id="sidebarToggle" class="md:hidden text-teal-500 dark:text-teal-400 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <h1 class="text-2xl font-semibold ml-4 text-teal-500 dark:text-teal-400">Create Page</h1>
            </div>
            <div class="flex items-center space-x-4">
                <button class="p-2 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-500 dark:text-purple-400 hover:bg-purple-200 dark:hover:bg-purple-800 transition-colors relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 dark:bg-red-400 rounded-full"></span>
                </button>
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center space-x-2 text-teal-500 dark:text-teal-400 focus:outline-none">
                        <span>Welcome, {{ Session::get('user')->name }}</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="userDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 z-10">
                        <a href="#" class="block px-4 py-2 text-gray-600 dark:text-teal-200 hover:bg-teal-100 dark:hover:bg-teal-700 transition-colors">Profile</a>
                        <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-600 dark:text-teal-200 hover:bg-teal-100 dark:hover:bg-teal-700 transition-colors">Logout</a>
                    </div>
                </div>
                <button onclick="toggleDarkMode()" class="p-2 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-500 dark:text-purple-400 hover:bg-purple-200 dark:hover:bg-purple-800 transition-colors">
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
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-2xl mx-auto">
                <h2 class="text-xl font-semibold text-teal-500 dark:text-teal-400 mb-4">Create New Page</h2>
                @if ($errors->any())
                    <div class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-400 text-red-700 dark:text-red-300 p-4 mb-6 rounded">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Logo</label>
                        <input type="file" name="logo" accept="image/*" onchange="previewImage(this, 'logoPreview')" class="block w-full text-sm text-gray-900 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-400">
                        <div id="logoPreview" class="mt-2">
                            <span class="text-gray-600 dark:text-gray-200">No Image</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Mail ID</label>
                        <input type="email" name="mail_id" value="{{ old('mail_id') }}" required class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-400 @error('mail_id') border-red-500 dark:border-red-400 @enderror" placeholder="example@domain.com">
                        @error('mail_id')
                            <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Contact</label>
                        <input type="text" name="contact" value="{{ old('contact') }}" required class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-400 @error('contact') border-red-500 dark:border-red-400 @enderror" placeholder="Enter contact number">
                        @error('contact')
                            <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Banner Image</label>
                        <input type="file" name="banner_image" accept="image/*" onchange="previewImage(this, 'bannerPreview')" class="block w-full text-sm text-gray-900 dark:text-gray-200 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-400">
                        <div id="bannerPreview" class="mt-2">
                            <span class="text-gray-600 dark:text-gray-200">No Image</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Header</label>
                        <input type="text" name="header" value="{{ old('header') }}" required class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-400 @error('header') border-red-500 dark:border-red-400 @enderror" placeholder="Page header">
                        @error('header')
                            <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Text</label>
                        <textarea name="text" required class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-400 @error('text') border-red-500 dark:border-red-400 @enderror" rows="5" placeholder="Page content">{{ old('text') }}</textarea>
                        @error('text')
                            <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" required class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-teal-500 dark:focus:ring-teal-400 @error('address') border-red-500 dark:border-red-400 @enderror" placeholder="Enter address">
                        @error('address')
                            <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="px-4 py-2 bg-teal-500 dark:bg-teal-600 text-white rounded-lg hover:bg-teal-600 dark:hover:bg-teal-700 transition-colors">Save</button>
                        <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 bg-gray-500 dark:bg-gray-600 text-white rounded-lg hover:bg-gray-600 dark:hover:bg-gray-700 transition-colors">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Loading Spinner -->
    <div id="loadingSpinner" class="fixed inset-0 bg-gray-100 dark:bg-gray-900 bg-opacity-50 dark:bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="relative w-12 h-12">
            <div class="absolute inset-0 rounded-full border-4 border-transparent border-t-teal-500 dark:border-t-teal-400 border-r-teal-500 dark:border-r-teal-400 animate-spin-custom"></div>
            <div class="absolute inset-0 rounded-full border-4 border-transparent border-b-teal-500 dark:border-b-teal-400 border-l-teal-500 dark:border-l-teal-400 animate-spin-custom opacity-50" style="animation-delay: -0.15s;"></div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Show loading spinner with delay for navigation and form submissions
        let spinnerTimeout;
        document.querySelectorAll('a[href], button[type="submit"]').forEach(element => {
            element.addEventListener('click', (e) => {
                if (!e.target.closest('#userDropdown') && !e.target.closest('#sidebarToggle')) {
                    spinnerTimeout = setTimeout(() => {
                        document.getElementById('loadingSpinner').classList.remove('hidden');
                    }, 100);
                }
            });
        });

        // Hide spinner on page load or navigation completion
        window.addEventListener('load', () => {
            clearTimeout(spinnerTimeout);
            document.getElementById('loadingSpinner').classList.add('hidden');
        });
    </script>

    <!-- Tailwind Animation and Custom Spinner -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes spin-custom {
            0% { transform: rotate(0deg); opacity: 1; }
            50% { opacity: 0.5; }
            100% { transform: rotate(360deg); opacity: 1; }
        }
        .animate-spin-custom {
            animation: spin-custom 0.8s linear infinite;
        }
    </style>
</body>
</html>