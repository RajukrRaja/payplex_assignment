<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        }
        .input-focus {
            transition: all 0.3s ease;
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }
        .btn-hover {
            transition: all 0.3s ease;
        }
        .btn-hover:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen px-4">
    <div class="container max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-2xl mt-12 transform transition-all duration-500">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Create Your Account</h1>
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg animate-pulse">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-2">Name</label>
                <input type="text" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50" value="{{ old('name') }}" required>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50" value="{{ old('email') }}" required>
            </div>
            <div class="relative">
                <label class="block text-gray-700 font-medium mb-2">Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50" required>
                <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-10 text-gray-500 hover:text-gray-700">
                    <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>
            <div class="relative">
                <label class="block text-gray-700 font-medium mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50" required>
                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-10 text-gray-500 hover:text-gray-700">
                    <svg id="eye-icon-confirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Role</label>
                <select name="role" class="w-full px-4 py-3 border border-gray-300 rounded-lg input-focus focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-gray-50" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="flex flex-col space-y-4">
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3 rounded-lg btn-hover hover:shadow-lg transition duration-300">Register</button>
                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-purple-600 hover:underline text-center font-medium">Already have an account? Login</a>
            </div>
        </form>
    </div>
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId === 'password' ? 'eye-icon' : 'eye-icon-confirm');
            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
            } else {
                input.type = 'password';
                icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }
    </script>
</body>
</html>