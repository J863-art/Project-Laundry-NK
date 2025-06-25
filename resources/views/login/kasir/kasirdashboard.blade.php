<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ENKA Laundry Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-[#fcf6f6] min-h-screen relative overflow-x-hidden">

  <!-- Overlay -->
  <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" onclick="toggleDrawer()"></div>

  <!-- Drawer Menu Owner -->
  <div id="drawer" class="fixed top-0 right-0 h-full w-72 bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-50 p-6">
    <div class="flex justify-between items-center mb-6">
      <h2 class="font-bold text-xl">Menu</h2>
      <button onclick="toggleDrawer()" class="text-gray-700 text-2xl">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <nav class="space-y-5">
        <a href="{{ route('kasir.pesanan') }}" class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
              <img src="https://storage.googleapis.com/a1aa/image/5d5f1cf3-6486-4549-df12-69178c2c5538.jpg" alt="Pesanan" class="rounded-full bg-[#D9E9F0] p-1" width="40" height="40" />
              <span class="text-black text-base">Pesanan</span>
            </div>
            <i class="fas fa-chevron-right text-black"></i>
          </a>




      <a href="{{ route('kasir.pendapatan') }}" class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
              <img src="https://storage.googleapis.com/a1aa/image/5d5f1cf3-6486-4549-df12-69178c2c5538.jpg" alt="Pesanan" class="rounded-full bg-[#D9E9F0] p-1" width="40" height="40" />
              <span class="text-black text-base">Pendapatan</span>
            </div>
            <i class="fas fa-chevron-right text-black"></i>
          </a>
      {{-- <a href="{{ route('pengeluaran.index') }}" class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <img src="https://storage.googleapis.com/a1aa/image/db5a3a64-fe00-4cc1-78fa-0d8f987eca98.jpg" alt="Pengeluaran" class="rounded-full bg-[#D9E9F0] p-1" width="40" height="40" />
            <span class="text-black text-base">Pengeluaran</span>
        </div>
        <i class="fas fa-chevron-right text-black"></i>
        </a> --}}

      <a href="{{ route('pelanggan.index') }}" class="flex items-center justify-between px-0 py-2">
        <div class="flex items-center space-x-4">
            <!-- Lingkaran untuk icon -->
            <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
            <i class="fas fa-user text-black text-lg"></i>
            </div>
            <!-- Teks -->
            <span class="text-black text-base font-medium">Pelanggan</span>
        </div>
        <!-- Panah ke kanan -->
        <i class="fas fa-chevron-right text-black text-lg ml-auto"></i>
      </a>


    </nav>
  </div>

  <!-- Konten utama -->
  <div class="relative z-10">
    <!-- Header -->
    <header class="bg-[#D6336C] flex justify-between items-center px-6 py-4">
      <div class="flex items-center space-x-3">
        <button onclick="toggleUserInfo()" class="text-white text-3xl focus:outline-none">
          <i class="fas fa-user-circle"></i>
        </button>
        <div>
          <h1 class="text-white font-extrabold text-lg leading-none">ENKA Laundry</h1>
          <p class="text-white text-sm font-normal leading-tight">Kasir</p>
        </div>
      </div>
      <button aria-label="Menu" class="text-white text-3xl focus:outline-none" onclick="toggleDrawer()">
        <i class="fas fa-bars"></i>
      </button>
    </header>

    <!-- Konten dashboard -->
    <main class="p-4">
      <p class="text-gray-700">Selamat datang di dashboard ENKA Laundry.</p>
    </main>
    <!-- Cards grid -->
    <section class="grid grid-cols-2 gap-4 mt-4">
  {{-- Pesanan hari ini --}}
  <div class="bg-white rounded-xl p-4">
    <p class="text-sm mb-1">Pesanan Hari Ini</p>
    <p class="font-extrabold text-2xl mb-1">{{ $todayOrders }}</p>
    <p class="text-xs {{ $orderGrowthPct < 0 ? 'text-[#b33a2a]' : 'text-[#2a7b2a]' }}">
      {{ $orderGrowthPct !== null ? sprintf('%+.1f%%', $orderGrowthPct) : '—' }} dari kemarin
    </p>
  </div>

  {{-- Pendapatan hari ini --}}
  <div class="bg-white rounded-xl p-4">
    <p class="text-sm mb-1">Pendapatan Hari Ini</p>
    <p class="font-extrabold text-2xl mb-1">Rp{{ number_format($todayRevenue,0,',','.') }}</p>
    <p class="text-xs {{ $revenueGrowthPct < 0 ? 'text-[#b33a2a]' : 'text-[#2a7b2a]' }}">
      {{ $revenueGrowthPct !== null ? sprintf('%+.1f%%', $revenueGrowthPct) : '—' }} dari kemarin
    </p>
  </div>

  {{-- Dalam proses --}}
  <div class="bg-white rounded-xl p-4">
    <p class="text-sm mb-1">Pesanan Dalam Proses</p>
    <p class="font-extrabold text-2xl mb-1">{{ $ordersInProcess }}</p>
    <p class="text-xs text-[#d18f4a]">{{ $awaitingPickup }} menunggu diambil</p>
  </div>

  {{-- Pelanggan baru --}}
  <div class="bg-white rounded-xl p-4">
    <p class="text-sm mb-1">Pelanggan Baru (Bulan Ini)</p>
    <p class="font-extrabold text-2xl mb-1">{{ $newCustomers }}</p>
  </div>
</section>


      <!-- (Bagian atas tidak diubah) -->

    <!-- Pesanan Terbaru -->
    <section class="bg-white rounded-xl p-6 mt-6">
    <h2 class="font-extrabold text-lg mb-4">Pesanan Terbaru</h2>

    <form method="GET" class="mb-4">
  <input
    type="text"
    name="search"
    value="{{ request('search') }}"
    placeholder="Cari nama pelanggan atau kode pesanan"
    class="w-full sm:w-64 px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:ring-blue-200 text-sm"
  />
  <button type="submit" class="mt-2 sm:mt-0 bg-blue-500 text-white px-3 py-1 rounded text-sm ml-2">
    Cari
  </button>
</form>


    @forelse ($latestOrders as $o)
        <form method="POST" action="{{ route('kasir.pesanan.updateStatus', $o->id) }}" class="mb-3 last:mb-0">
  @csrf
  @method('PUT')
  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between sm:gap-x-6 space-y-2 sm:space-y-0">

    <!-- Info pelanggan -->
    <div class="flex-shrink-0">
      <p class="font-extrabold">{{ $o->nama_pelanggan }}</p>
      <p class="text-gray-600 text-sm">#{{ $o->kode_pesanan }}</p>
    </div>

    <!-- Dropdown status -->
    <div class="flex items-center space-x-2">
      <select name="status" class="text-xs px-2 py-1 rounded border">
        <option value="belum_diproses" {{ $o->status === 'belum_diproses' ? 'selected' : '' }}>Belum Diproses</option>
        <option value="sedang_diproses" {{ $o->status === 'sedang_diproses' ? 'selected' : '' }}>Sedang Diproses</option>
        <option value="selesai" {{ $o->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
      </select>

      <select name="status_pembayaran" class="text-xs px-2 py-1 rounded border">
        <option value="belum_lunas" {{ $o->status_pembayaran === 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
        <option value="lunas" {{ $o->status_pembayaran === 'lunas' ? 'selected' : '' }}>Lunas</option>
      </select>

      <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-1 rounded">
        Simpan
      </button>
    </div>

    <!-- Harga total -->
    <p class="font-extrabold whitespace-nowrap">Rp{{ number_format($o->harga_total, 0, ',', '.') }}</p>

    </div>
    </form>

    @empty
        <p class="text-sm text-gray-500">Belum ada pesanan.</p>
    @endforelse
    </section>




      <!-- Grafik Minggu Ini -->
      <section class="bg-white rounded-xl p-6 mt-6">
  <h2 class="font-extrabold text-lg mb-6">Grafik Minggu Ini</h2>

  <div class="flex items-end justify-between space-x-3 mb-6">
    @foreach ($weekly as $bar)
      <div class="flex flex-col items-center space-y-1">
        <div class="bg-[#5f7ed9] rounded-t-xl w-8" style="height: {{ $bar['height'] }}px"></div>
        <span class="text-gray-600 text-xs">{{ $bar['label'] }}</span>
      </div>
    @endforeach
  </div>

  <div class="flex justify-between items-center">
    <p>Total Minggu Ini</p>
    <p class="font-extrabold">Rp{{ number_format($totalWeek,0,',','.') }}</p>
    <p class="{{ $weekGrowthPct < 0 ? 'text-[#b33a2a]' : 'text-[#2a7b2a]' }} font-semibold text-sm">
      {{ $weekGrowthPct !== null ? sprintf('%+.1f%%', $weekGrowthPct) : '—' }}
    </p>
  </div>
</section>


  <!-- Modal Informasi User -->
<div id="userInfoModal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden items-center justify-center transition-opacity duration-300 p-4">
  <div class="bg-white p-6 rounded-xl max-w-md w-full shadow-xl relative animate-fadeIn border border-gray-100">
    <!-- Tombol Close -->
    <button onclick="toggleUserInfo()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors duration-200">
      <i class="fas fa-times text-xl"></i>
    </button>

    <!-- Header -->
    <div class="flex items-center mb-6">
      <div class="bg-gradient-to-r from-pink-500 to-purple-500 p-3 rounded-full shadow-md">
        <i class="fas fa-user-circle text-white text-2xl"></i>
      </div>
      <h2 class="text-xl font-bold text-gray-800 ml-3">Informasi Akun</h2>
    </div>

    <!-- Konten -->
    @auth
      <div class="space-y-4 text-gray-700">
        <div class="flex items-center">
          <div class="w-8 text-center">
            <i class="fas fa-user text-pink-500"></i>
          </div>
          <div class="border-b border-gray-100 pb-2 flex-1">
            <div class="text-xs text-gray-400">Nama Lengkap</div>
            <div class="font-medium">{{ Auth::user()->name }}</div>
          </div>
        </div>

        <div class="flex items-center">
          <div class="w-8 text-center">
            <i class="fas fa-envelope text-purple-500"></i>
          </div>
          <div class="border-b border-gray-100 pb-2 flex-1">
            <div class="text-xs text-gray-400">Email</div>
            <div class="font-medium">{{ Auth::user()->email }}</div>
          </div>
        </div>

        <div class="flex items-center">
          <div class="w-8 text-center">
            <i class="fas fa-at text-blue-500"></i>
          </div>
          <div class="border-b border-gray-100 pb-2 flex-1">
            <div class="text-xs text-gray-400">Username</div>
            <div class="font-medium">{{ Auth::user()->username }}</div>
          </div>
        </div>

        <div class="flex items-center">
          <div class="w-8 text-center">
            <i class="fas fa-phone text-green-500"></i>
          </div>
          <div class="border-b border-gray-100 pb-2 flex-1">
            <div class="text-xs text-gray-400">Nomor Telepon</div>
            <div class="font-medium">{{ Auth::user()->no_telp ?? '-' }}</div>
          </div>
        </div>

        <div class="flex items-center">
          <div class="w-8 text-center">
            <i class="fas fa-lock text-yellow-500"></i>
          </div>
          <div class="pb-2 flex-1">
            <div class="text-xs text-gray-400">Password</div>
            <div class="font-mono text-sm text-gray-400">••••••••••</div>
          </div>
        </div>
      </div>

      <!-- Logout -->
      <form method="GET" action="{{ route('logout') }}" class="mt-8">
        @csrf
        <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-pink-500 text-white py-3 px-4 rounded-lg hover:opacity-90 transition-opacity font-semibold text-sm shadow-md flex items-center justify-center">
          <i class="fas fa-sign-out-alt mr-2"></i> Keluar Akun
        </button>
      </form>
    @else
      <div class="text-center py-8">
        <i class="fas fa-user-lock text-4xl text-gray-300 mb-3"></i>
        <p class="text-gray-600">Silakan login untuk melihat informasi akun</p>
        <a href="{{ route('login') }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-6 rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium">
          Login Sekarang
        </a>
      </div>
    @endauth
  </div>
</div>

<!-- Animasi -->
<style>
  @keyframes fadeIn {
    0% { opacity: 0; transform: translateY(10px) scale(0.98); }
    100% { opacity: 1; transform: translateY(0) scale(1); }
  }
  .animate-fadeIn {
    animation: fadeIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
  }
</style>

  <!-- Script Toggle -->
  <script>
    function toggleDrawer() {
    const drawer = document.getElementById('drawer');
    const overlay = document.getElementById('overlay');
    const isHidden = drawer.classList.contains('translate-x-full');

    if (isHidden) {
        drawer.classList.remove('translate-x-full');
        overlay.classList.remove('hidden');
    } else {
        drawer.classList.add('translate-x-full');
        overlay.classList.add('hidden');
    }
    }


    function toggleUserInfo() {
      const modal = document.getElementById('userInfoModal');
      modal.classList.toggle('hidden');
      modal.classList.toggle('flex');
    }
  </script>

</body>
</html>
