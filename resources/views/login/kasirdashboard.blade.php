<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f9fafb;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center p-4">
    <div class="max-w-2xl w-full text-center">
        <h1 class="text-3xl font-bold text-pink-600 mb-4">Selamat Datang, Kasir!</h1>
        <p class="text-gray-700 text-lg mb-8">Ini adalah dashboard sementara untuk kasir.</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-3 rounded-lg text-lg">
                Logout
            </button>
        </form>
    </div>
</body>
</html>
