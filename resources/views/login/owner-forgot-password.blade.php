<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>Forgot Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: "Poppins", sans-serif;
    }
  </style>
</head>
<body class="bg-[#faf5f5] min-h-screen flex flex-col">
  <main class="flex-grow flex justify-center items-start pt-6 px-6">
    <form method="POST" action="{{ route('owner.forgot.password.send') }}" class="bg-[#fcf4f4] w-full max-w-md rounded-md p-6 relative" style="min-height: 520px">
      @csrf

      <a href="{{ route('login.owner') }}" class="absolute top-6 left-6 text-2xl text-gray-600">
        <i class="fas fa-arrow-left"></i>
      </a>

      <div class="flex justify-center mb-6 mt-12">
        <img alt="Logo ENKA" class="w-[120px] h-[120px] object-contain" src="{{ asset('images/download.png') }}" />
      </div>

      <h2 class="text-center font-bold text-lg mb-3">Lupa Sandi?</h2>
      <p class="text-center text-gray-700 mb-8 px-4 leading-relaxed">
        Gunakan email Anda untuk verifikasi pengaturan ulang kata sandi.
      </p>

      @if(session('status'))
        <p class="text-green-600 text-sm text-center mb-4">{{ session('status') }}</p>
      @endif

      @error('email')
        <p class="text-red-600 text-sm text-center mb-4">{{ $message }}</p>
      @enderror

      <div class="mb-8">
        <label class="sr-only" for="email">Email</label>
        <div class="flex items-center bg-gray-300 rounded-lg px-4 py-3 text-gray-700 text-base">
          <i class="far fa-envelope mr-3 text-gray-500"></i>
          <input class="bg-transparent w-full outline-none placeholder-gray-700"
                 id="email" name="email" type="email" placeholder="Email" required />
        </div>
      </div>

      <button type="submit" class="w-full bg-[#d92f6a] text-white rounded-lg py-3 mb-4 text-base font-normal">
        Reset Sandi
      </button>

      <a href="{{ route('login.owner') }}" class="block w-full text-center bg-gray-400 text-white rounded-lg py-3 text-base font-normal">
        Batal
      </a>
    </form>
  </main>
</body>
</html>
