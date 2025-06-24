<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   ENKA Laundry Kasir Login
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
 </head>
 <body class="bg-[#f7eaea] min-h-screen flex flex-col items-center pt-12 px-6">
    <div class="flex flex-col items-center gap-1">
        <img src="{{ asset('images/download.png') }}" alt="Logo NK Laundry" width="120" height="120" class="object-contain"/>
      </div>

  <p class="text-center text-gray-700 text-lg mt-12 max-w-md leading-relaxed">
    Selamat Datang Di Sistem Kasir ENKA Laundry
    <br/>
    Silahkan Masuk untuk melanjutkan
  </p>

  {{-- Form login kasir --}}
  <form action="{{ route('login.kasir.login') }}" method="POST" autocomplete="off" class="bg-white shadow-lg mt-12 p-8 rounded-md max-w-md w-full">
    @csrf
    <h2 class="font-extrabold text-xl mb-6 text-center">
      Masuk Sebagai Kasir
    </h2>

    <div class="relative mb-5">
      <span class="absolute inset-y-0 left-4 flex items-center text-gray-500 text-lg">
        <i class="fas fa-user"></i>
      </span>
      <input name="username" type="text" required
        class="w-full pl-12 pr-4 py-3 rounded-lg bg-gray-300 placeholder-gray-600 text-gray-800 focus:outline-none"
        placeholder="Username atau Email"/>
    </div>

    <div class="relative mb-1">
      <span class="absolute inset-y-0 left-4 flex items-center text-gray-500 text-lg">
        <i class="fas fa-lock"></i>
      </span>
      <input name="password" type="password" required
        class="w-full pl-12 pr-4 py-3 rounded-lg bg-gray-300 placeholder-gray-600 text-gray-800 focus:outline-none"
        placeholder="Sandi"/>
    </div>

    <div class="text-right mb-6">
        <a class="text-blue-600 text-sm hover:underline" href="{{ route('kasir.forgot.password') }}">
            Lupa Sandi?
          </a>
    </div>

    <div class="text-center">
      <button type="submit"
        class="bg-[#0d6efd] text-white font-semibold text-lg rounded-full px-8 py-2 hover:bg-[#084298] transition">
        Masuk
      </button>
    </div>
  </form>
</body>
</html>
