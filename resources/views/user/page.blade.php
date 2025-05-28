<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ $page->header }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-gray-100 min-h-screen transition-colors duration-300">
    <header class="bg-white dark:bg-gray-900 shadow p-4 sticky top-0 z-10">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-blue-500 dark:text-blue-400">{{ $page->header }}</h1>
            <a href="{{ route('user.dashboard') }}" class="px-3 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded-lg hover:bg-blue-600 dark:hover:bg-blue-700 transition-colors text-sm">Back to Dashboard</a>
        </div>
    </header>
    <main class="max-w-7xl mx-auto p-6">
        <div class="bg-white dark:bg-gray-900 rounded-lg shadow p-6">
            @if ($page->logo)
                <img src="{{ asset('storage/' . $page->logo) }}" alt="Logo" class="w-24 h-24 object-contain mb-4">
            @endif
            @if ($page->banner_image)
                <img src="{{ asset('storage/' . $page->banner_image) }}" alt="{{ $page->header }}" class="w-full h-64 object-cover rounded-lg mb-4">
            @endif
            <h2 class="text-xl font-semibold text-blue-500 dark:text-blue-400">{{ $page->header }}</h2>
            <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $page->text }}</p>
            <div class="mt-4 text-gray-600 dark:text-gray-300">
                <p><strong>Email:</strong> {{ $page->mail_id }}</p>
                <p><strong>Contact:</strong> {{ $page->contact }}</p>
                <p><strong>Address:</strong> {{ $page->address }}</p>
            </div>
        </div>
    </main>
</body>
</html>