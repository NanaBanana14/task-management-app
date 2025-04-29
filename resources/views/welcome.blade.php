<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome - Task Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-gray-900 via-black to-gray-800 min-h-screen flex flex-col text-white">

    <nav class="flex justify-between items-center bg-gray-900/80 backdrop-blur-md p-4 shadow-lg">
        <div class="text-2xl font-bold text-white tracking-wide">
            <span class="text-yellow-500">Task</span> Management
        </div>
        <div>
            <a href="/admin/login" class="px-5 py-2 bg-yellow-600 text-white rounded-full hover:bg-blue-700 transition duration-300 shadow-md">
                Login
            </a>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center p-6">
        <div class="max-w-3xl bg-gray-800/90 p-10 rounded-2xl shadow-2xl backdrop-blur-sm animate-fade-in">
            <h1 class="text-5xl font-bold text-white text-center mb-6">
                Welcome to <span class="text-yellow-500">Task Management System</span>
            </h1>
            <p class="text-gray-300 text-center text-lg mb-8">
                Kelola proyek, tugas harian, dan kolaborasi tim Anda dengan lebih mudah dan efisien!
            </p>
            <div class="flex justify-center">
                <a href="/admin/login" class="px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition duration-300 shadow-md">
                    Get Started
                </a>
            </div>
        </div>
    </main>

    <footer class="text-center text-gray-400 text-sm py-4">
        © <script>document.write(new Date().getFullYear())</script> Task Management. All rights reserved.
    </footer>

    <script>
        document.querySelector('main div').classList.add('opacity-0');
        setTimeout(() => {
            document.querySelector('main div').classList.remove('opacity-0');
            document.querySelector('main div').classList.add('transition-opacity', 'duration-1000', 'opacity-100');
        }, 200);
    </script>
</body>
</html>
