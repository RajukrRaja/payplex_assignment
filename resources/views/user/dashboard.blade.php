<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
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

        // Toggle mobile menu
        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }

        // Listen for system theme changes
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (!localStorage.getItem('theme')) {
                document.documentElement.classList.toggle('dark', e.matches);
                updateThemeIcon(e.matches);
            }
        });
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen transition-colors duration-300 flex flex-col">
    @if (!Session::has('user'))
        <script>
            window.location.href = "{{ route('login') }}";
        </script>
    @endif
    <!-- Header -->
    <header class="bg-white dark:bg-gray-800 shadow-lg p-4 sticky top-0 z-20 w-full">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <button id="menuToggle" class="md:hidden text-blue-600 dark:text-blue-400 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
                <h1 class="text-3xl font-extrabold text-blue-600 dark:text-blue-400">User Dashboard</h1>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm font-medium text-gray-600 dark:text-gray-300">Welcome, {{ Session::get('user')->name }}</span>
                <button onclick="toggleDarkMode()" class="p-2 rounded-full bg-blue-100 dark:bg-blue-700 text-blue-600 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-blue-600 transition-colors">
                    <span id="themeIcon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </span>
                </button>
                <a href="{{ route('logout') }}" class="px-4 py-2 bg-blue-600 dark:bg-blue-700 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors text-sm font-semibold">Logout</a>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white dark:bg-gray-800 shadow mt-2 rounded-lg p-4 max-w-7xl mx-auto">
            <a href="{{ route('logout') }}" class="block px-3 py-2 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-700 rounded transition-colors">Logout</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="w-full px-4 sm:px-8 animate-fade-in flex-grow">
        <div class="mb-10">
            <h2 class="text-3xl font-bold text-blue-600 dark:text-blue-400 bg-gradient-to-r from-blue-100 to-transparent dark:from-blue-900 dark:to-transparent inline-block px-4 py-2 rounded-lg">Available Pages</h2>
        </div>
        @php
            $pages = App\Models\Page::where('status', true)->orderBy('id')->paginate(6);
        @endphp
        @if ($pages->isEmpty())
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-gray-600 dark:text-gray-300 text-center">
                No active pages available.
            </div>
        @else
            <div class="space-y-12">
                @foreach ($pages as $index => $page)
                    <section class="relative bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sm:p-8 hover:shadow-2xl transition-shadow duration-300 border-t-4 border-blue-500 dark:border-blue-400">
                        <!-- Logo in Top-Left Corner -->
                        @if ($page->logo)
                            <div class="absolute top-4 left-4 z-10">
                                <img src="{{ asset('storage/' . $page->logo) }}" alt="Logo" class="w-24 h-24 object-contain rounded-lg border-2 border-gray-200 dark:border-gray-700 shadow-sm">
                            </div>
                        @endif
                        <!-- Banner Image in Middle -->
                        <div class="w-full mt-16">
                            @if ($page->banner_image)
                                <img src="{{ asset('storage/' . $page->banner_image) }}" alt="{{ $page->header }}" class="w-full h-80 object-cover rounded-lg shadow-md">
                            @else
                                <div class="w-full h-80 bg-gray-200 dark:bg-gray-700 flex items-center justify-center rounded-lg shadow-md">
                                    <span class="text-gray-500 dark:text-gray-400 text-lg">No Banner</span>
                                </div>
                            @endif
                        </div>
                        <!-- Content Below Banner -->
                        <div class="mt-6 text-center">
                            <h3 class="text-2xl sm:text-3xl font-extrabold text-gray-900 dark:text-gray-100 bg-gradient-to-r from-blue-100 to-transparent dark:from-blue-900 dark:to-transparent inline-block px-4 py-2 rounded-lg mb-4">{{ $page->header }}</h3>
                            <p class="text-gray-600 dark:text-gray-300 text-base sm:text-lg leading-relaxed mb-6 max-w-3xl mx-auto">{{ $page->text }}</p>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm space-y-3 max-w-2xl mx-auto">
                                <p class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <strong class="mr-2">Email:</strong> 
                                    <a href="mailto:{{ $page->mail_id }}" class="text-blue-500 dark:text-blue-400 hover:underline">{{ $page->mail_id }}</a>
                                </p>
                                <p class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <strong class="mr-2">Contact:</strong> 
                                    <a href="tel:{{ $page->contact }}" class="text-blue-500 dark:text-blue-400 hover:underline">{{ $page->contact }}</a>
                                </p>
                                <p class="flex items-start justify-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <strong class="mr-2">Address:</strong>
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($page->address) }}" target="_blank" class="text-blue-500 dark:text-blue-400 hover:underline flex items-center">
                                        {{ $page->address }}
                                    </a>
                                </p>
                            </div>
                            <a href="{{ route('home' . ($index + 1)) }}" class="mt-6 inline-block px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-500 dark:from-blue-900 dark:to-blue-600 text-white rounded-lg hover:from-blue-700 hover:to-blue-600 dark:hover:from-blue-800 dark:hover:to-blue-700 transition-all duration-300 text-sm font-semibold shadow-md">
                                Visit Home{{ $index + 1 }}
                            </a>
                        </div>
                    </section>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="pagination mt-12">
                {{ $pages->links() }}
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 dark:bg-gray-950 text-gray-200 py-10 mt-auto w-full">
        <div class="px-4 sm:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-lg font-semibold text-blue-400 mb-4">About Us</h3>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Discover a world of curated content tailored to your needs. Explore our dynamic pages and connect with us for an exceptional experience.
                    </p>
                </div>
                <!-- Navigation -->
                <div>
                    <h3 class="text-lg font-semibold text-blue-400 mb-4">Quick Links</h3>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-blue-400 transition-colors">Home</a></li>
                        <li><a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-blue-400 transition-colors">Dashboard</a></li>
                        <li><a href="{{ route('logout') }}" class="text-gray-400 hover:text-blue-400 transition-colors">Logout</a></li>
                    </ul>
                </div>
                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold text-blue-400 mb-4">Contact Us</h3>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="mailto:support@example.com" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                support@example.com
                            </a>
                        </li>
                        <li>
                            <a href="tel:+1234567890" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 23" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                +1 (234) 567-890
                            </a>
                        </li>
                        <li>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode('123 Main St, City, Country') }}" target="_blank" class="text-gray-400 hover:text-blue-400 transition-colors flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                123 Main St, City, Country
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Newsletter -->
                <div>
                    <h3 class="text-lg font-semibold text-blue-400 mb-4">Stay Updated</h3>
                    <p class="text-sm text-gray-400 mb-4">Subscribe to our newsletter for the latest updates.</p>
                    <form action="#" method="POST" class="flex">
                        <input type="email" placeholder="Enter your email" class="flex-grow px-4 py-2 rounded-l-lg bg-gray-700 dark:bg-gray-800 text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <button type="submit" class="px-4 py-2 bg-blue-600 dark:bg-blue-700 text-white rounded-r-lg hover:bg-blue-700 dark:hover:bg-blue-800 transition-colors">Subscribe</button>
                    </form>
                    <div class="mt-4 flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.22-1.79L9 12l-4.78 2.79c-.14.58-.22 1.17-.22 1.79 0 4.08 3.05 7.44 7 7.93V19.93zm2-1.93V15h2v2.93c3.95-.49 7-3.85 7-7.93 0-.62-.08-1.21-.22-1.79L15 12l4.78-2.79c.14-.58.22-1.17.22-1.79 0-4.08-3.05-7.44-7-7.93V5h-2v2.07C7.05 5.56 4 8.92 4 13c0 .62.08 1.21.22 1.79L9 12l-4.78-2.79C4.08 8.63 4 8.04 4 7.42c0-4.08 3.05-7.44 7-7.93V2h2z"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15h-2v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.8c4.56-.93 8-4.96 8-9.8z"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-blue-400 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.99 4.74c-.88.39-1.83.65-2.82.77 1.01-.61 1.79-1.57 2.16-2.72-.95.56-2 .97-3.12 1.19-.9-.96-2.18-1.56-3.6-1.56-2.72 0-4.93 2.21-4.93 4.93 0 .39.04.77.13 1.13-4.1-.21-7.74-2.17-10.18-5.15-.43.74-.67 1.6-.67 2.52 0 1.74.88 3.27 2.22 4.17-.82-.03-1.59-.25-2.27-.62v.06c0 2.43 1.73 4.46 4.02 4.92-.42.11-.86.17-1.32.17-.32 0-.64-.03-.95-.09.64 2.01 2.5 3.47 4.71 3.51-1.73 1.36-3.9 2.17-6.27 2.17-.41 0-.81-.03-1.21-.09 2.24 1.44 4.9 2.28 7.76 2.28 9.3 0 14.38-7.7 14.38-14.38 0-.22 0-.44-.01-.66.99-.71 1.84-1.6 2.51-2.61l-.75.33z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-6 text-center text-sm text-gray-400">
                © {{ date('Y') }} Your Website. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Loading Spinner -->
    <div id="loadingSpinner" class="fixed inset-0 bg-gray-100 dark:bg-gray-900 bg-opacity-50 dark:bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="w-12 h-12 rounded-full border-4 border-blue-500 dark:border-blue-400 border-opacity-20 animate-pulse-custom"></div>
    </div>

    <!-- Scripts -->
    <script>
        // Show loading spinner with delay for navigation
        let spinnerTimeout;
        document.querySelectorAll('a[href]').forEach(element => {
            element.addEventListener('click', (e) => {
                if (!e.target.closest('#menuToggle') && !e.target.closest('#mobileMenu')) {
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

        // Toggle mobile menu
        const menuToggle = document.getElementById('menuToggle');
        menuToggle.addEventListener('click', toggleMobileMenu);
    </script>

    <!-- Tailwind Animation and Custom Styles -->
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes pulse-custom {
            0% { transform: scale(0.8); opacity: 0.7; }
            50% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(0.8); opacity: 0.7; }
        }
        .animate-pulse-custom {
            animation: pulse-custom 1s ease-in-out infinite;
        }

        /* Custom Tailwind pagination styles */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1.5rem;
        }
        .pagination a, .pagination span {
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            background: none;
            color: #344151;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }
        .pagination a:hover {
            background: #2563eb;
            color: #ffffff;
        }
        .pagination .active span {
            background: #2563eb;
            color: #ffffff;
        }
        .dark .pagination a, .dark .pagination span {
            color: #d1d5db;
        }
        .dark .pagination a:hover {
            background: #60a5fa;
            color: #1f2937;
        }
        .dark .pagination .active span {
            background: #60a5fa;
            color: #1f2937;
        }
    </style>
</body>
</html>