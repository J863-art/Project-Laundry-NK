<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - ENKA Laundry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f4f8;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white shadow-lg rounded-xl p-8">
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/download.png') }}" alt="Logo NK Laundry" width="120" height="120" class="object-contain mb-2" />
            <h2 class="text-xl font-bold text-gray-700 text-center">Reset Password Pemilik</h2>
            <p class="text-sm text-gray-500 text-center">Masukkan password baru Anda untuk akun ini.</p>
        </div>

        <form method="POST" action="{{ route('owner.password.update') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ request()->get('email') }}">

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-pink-500 focus:border-pink-500 text-gray-800 bg-gray-100">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full px-4 py-2 rounded-md border border-gray-300 focus:ring-pink-500 focus:border-pink-500 text-gray-800 bg-gray-100">
            </div>

            <div class="text-center mt-6">
                <button type="submit"
                        class="bg-pink-600 hover:bg-pink-700 text-white font-semibold px-6 py-2 rounded-full transition-all duration-200">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</body>
</html>
