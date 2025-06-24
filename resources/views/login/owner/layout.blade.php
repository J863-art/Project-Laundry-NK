<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Pesanan')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-white">

  {{-- Full-width wrapper --}}
  <div class="w-full min-h-screen px-4 sm:px-6 lg:px-12 xl:px-24">

    {{-- Header --}}
    <header class="bg-[#DD2E6E] flex justify-between items-center px-6 py-5 shadow-md">
      <h1 class="text-white font-extrabold text-xl lg:text-2xl leading-none">@yield('header', 'Pesanan')</h1>
      <button aria-label="Menu" class="text-white text-2xl focus:outline-none lg:hidden">
        <i class="fas fa-bars"></i>
      </button>
    </header>

    {{-- Filter Dropdown --}}
    <div class="p-4 border-b border-gray-300">
      <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        {{-- Dropdown --}}
        <select
          aria-label="Filter Semua Pesanan"
          class="w-full lg:w-1/3 border border-gray-300 rounded-md text-sm text-gray-700 py-2 px-3 focus:outline-none focus:ring-1 focus:ring-[#DD2E6E] focus:border-[#DD2E6E]"
          onchange="if (this.value) window.location.href = this.value;">
          <option value="{{ route('owner.pesanan') }}" {{ request()->routeIs('owner.pesanan') ? 'selected' : '' }}>Semua Pesanan</option>
          <option value="{{ route('owner.pesanan-belum') }}" {{ request()->routeIs('owner.pesanan-belum') ? 'selected' : '' }}>Belum Diproses</option>
          <option value="{{ route('owner.pesanan-diproses') }}" {{ request()->routeIs('owner.pesanan-diproses') ? 'selected' : '' }}>Sedang Diproses</option>
          <option value="{{ route('owner.pesanan-selesai') }}" {{ request()->routeIs('owner.pesanan-selesai') ? 'selected' : '' }}>Pesanan Selesai</option>
        </select>

        {{-- Filter tambahan --}}
        <div class="w-full lg:w-auto">
          @yield('filters')
        </div>
      </div>
    </div>

    {{-- Konten utama --}}
    <main class="p-4 space-y-4">
      @yield('content')
    </main>
  </div>
</body>
</html>
