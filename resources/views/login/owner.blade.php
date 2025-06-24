<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>ENKA Laundry Owner Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f7eaea;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col items-center pt-12 px-6">
    <div class="flex flex-col items-center gap-1">
        <img src="{{ asset('images/download.png') }}" alt="Logo NK Laundry" width="120" height="120" class="object-contain"/>
      </div>

  <p class="text-center text-gray-700 text-lg mt-12 max-w-md leading-relaxed">
    Selamat Datang Owner ENKA Laundry
    <br/>
    Silahkan Masuk untuk melanjutkan
  </p>

  <!-- ✅ Form Login (Laravel Backend) -->
  <!-- ✅ Notifikasi Error -->
@if ($errors->any())
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mt-6 max-w-md w-full text-sm">
  @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
  @endforeach
</div>
@endif

<!-- ✅ Form Login (Laravel Backend) -->

  <form action="{{ route('login.owner.login') }}" method="POST" class="bg-white shadow-lg mt-12 p-8 rounded-md max-w-md w-full" autocomplete="off">
    @csrf
    <h2 class="font-extrabold text-xl mb-6 text-center">Masuk Sebagai Owner</h2>

    <!-- Username atau Email -->
    <div class="relative mb-5">
      <span class="absolute inset-y-0 left-4 flex items-center text-gray-500 text-lg">
        <i class="fas fa-user"></i>
      </span>
      <input class="w-full pl-12 pr-4 py-3 rounded-lg bg-gray-300 placeholder-gray-600 text-gray-800 focus:outline-none"
             name="username" type="text" placeholder="Username atau Email..." required />
    </div>

    <!-- Password -->
    <div class="relative mb-1">
      <span class="absolute inset-y-0 left-4 flex items-center text-gray-500 text-lg">
        <i class="fas fa-lock"></i>
      </span>
      <input class="w-full pl-12 pr-4 py-3 rounded-lg bg-gray-300 placeholder-gray-600 text-gray-800 focus:outline-none"
             name="password" type="password" placeholder="Password..." required />
    </div>

    <!-- Lupa Sandi -->
    <div class="text-right mb-6">
        <a class="text-blue-600 text-sm hover:underline" href="{{ route('owner.forgot.password') }}">
            Lupa Sandi?
          </a>
    </div>

    <!-- Tombol Submit -->
    <div class="text-center">
      <button type="submit"
              class="bg-[#d6336c] text-white font-semibold text-lg rounded-full px-8 py-2 hover:bg-[#b02a58] transition">
        Masuk
      </button>
    </div>
  </form>
</body>
</html>
