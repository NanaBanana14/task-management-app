<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Task Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black min-h-screen flex flex-col text-white">
    <!-- Navbar -->
    <nav class="flex justify-between items-center bg-gray-900 p-4 shadow">
        <div class="text-2xl font-bold text-white">
            Task Management
        </div>
        <div>
            <a href="/admin/login" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Login
            </a>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center p-6">
        <div class="max-w-3xl bg-gray-800 p-8 rounded-xl shadow-lg">
            <h1 class="text-4xl font-bold text-white text-center mb-6">Welcome to Task Management System</h1>
            <p class="text-gray-300 text-center text-lg mb-8">
                Kelola proyek, tugas harian, dan kolaborasi tim Anda dengan lebih mudah!
            </p>

        </div>
    </main>

    <!-- Footer -->
    <footer class="text-center text-gray-500 text-sm py-4">
        © {{ date('Y') }} Task Management. All rights reserved.
    </footer>
</body>
</html>
