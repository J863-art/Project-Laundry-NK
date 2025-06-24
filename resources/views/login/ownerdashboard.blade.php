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
      <a href="{{ route('owner.pesanan') }}" class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <img src="https://storage.googleapis.com/a1aa/image/5d5f1cf3-6486-4549-df12-69178c2c5538.jpg" alt="Pesanan" class="rounded-full bg-[#D9E9F0] p-1" width="40" height="40" />
          <span class="text-black text-base">Pesanan</span>
        </div>
        <i class="fas fa-chevron-right text-black"></i>
      </a>
      <a href="{{ route('owner.layanann.index') }}" class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <img src="https://storage.googleapis.com/a1aa/image/30f3d2f6-9d78-4725-3136-8371b315219b.jpg" alt="Layanan" class="rounded-full bg-[#D9E9F0] p-1" width="40" height="40" />
          <span class="text-black text-base">Layanan</span>
        </div>
        <i class="fas fa-chevron-right text-black"></i>
      </a>
      <a href="{{ route('owner.pendapatan') }}" class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <img src="https://storage.googleapis.com/a1aa/image/de988f07-9b55-4a13-4863-a03d4c9c66ae.jpg" alt="Pendapatan" class="rounded-full bg-[#D9E9F0] p-1" width="40" height="40" />
          <span class="text-black text-base">Pendapatan</span>
        </div>
        <i class="fas fa-chevron-right text-black"></i>
      </a>
      <a href="{{ route('pengeluaran.index') }}" class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
          <img src="https://storage.googleapis.com/a1aa/image/db5a3a64-fe00-4cc1-78fa-0d8f987eca98.jpg" alt="Pengeluaran" class="rounded-full bg-[#D9E9F0] p-1" width="40" height="40" />
          <span class="text-black text-base">Pengeluaran</span>
        </div>
        <i class="fas fa-chevron-right text-black"></i>
      </a>
      <a href="{{ route('karyawan.index') }}" class="flex items-center justify-between px-0 py-2">
        <div class="flex items-center space-x-4">
          <img alt="Icon" class="w-10 h-10 rounded-full" src="https://storage.googleapis.com/a1aa/image/af0e3637-898d-4acf-9f9e-a68af8521353.jpg"/>
          <span class="text-black text-base font-medium">Karyawan</span>
        </div>
        <i class="fas fa-chevron-right text-black text-lg ml-auto"></i>
      </a>
      <a href="{{ route('pelangganowner.index') }}" class="flex items-center justify-between px-0 py-2">
        <div class="flex items-center space-x-4">
          <div class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center">
            <i class="fas fa-user text-black text-lg"></i>
          </div>
          <span class="text-black text-base font-medium">Pelanggan</span>
        </div>
        <i class="fas fa-chevron-right text-black text-lg ml-auto"></i>
      </a>
    </nav>
  </div>

  <!-- Konten utama -->
  <div class="relative z-10">
    <header class="bg-[#D6336C] flex justify-between items-center px-6 py-4">
      <div class="flex items-center space-x-3">
        <button onclick="toggleUserInfo()" class="text-white text-3xl focus:outline-none">
          <i class="fas fa-user-circle"></i>
        </button>
        <div>
          <h1 class="text-white font-extrabold text-lg leading-none">ENKA Laundry</h1>
          <p class="text-white text-sm font-normal leading-tight">Owner</p>
        </div>
      </div>
      <button aria-label="Menu" class="text-white text-3xl focus:outline-none" onclick="toggleDrawer()">
        <i class="fas fa-bars"></i>
      </button>
    </header>
    <main class="p-4">
      <p class="text-gray-700">Selamat datang di dashboard ENKA Laundry.</p>
    </main>
    <section class="grid grid-cols-2 gap-4 mt-4">
      <div class="bg-white rounded-xl p-4">
        <p class="text-sm font-normal mb-1">Pesanan Hari Ini</p>
        <p class="font-extrabold text-2xl leading-none mb-1">{{ $todayOrders }}</p>
        <p class="text-xs {{ $orderGrowthPct < 0 ? 'text-[#b33a2a]' : 'text-[#2a7b2a]' }} font-normal">
          {{ $orderGrowthPct !== null ? ($orderGrowthPct > 0 ? '+' : '') . number_format($orderGrowthPct, 1) . '%' : '-' }} dari kemarin
        </p>
      </div>
      <div class="bg-white rounded-xl p-4">
        <p class="text-sm font-normal mb-1">Pendapatan Hari Ini</p>
        <p class="font-extrabold text-2xl leading-none mb-1">Rp{{ number_format($todayRevenue, 0, ',', '.') }}</p>
        <p class="text-xs {{ $revenueGrowthPct < 0 ? 'text-[#b33a2a]' : 'text-[#2a7b2a]' }} font-normal">
          {{ $revenueGrowthPct !== null ? ($revenueGrowthPct > 0 ? '+' : '') . number_format($revenueGrowthPct, 1) . '%' : '-' }} dari kemarin
        </p>
      </div>
      <div class="bg-white rounded-xl p-4">
        <p class="text-sm font-normal mb-1">Pesanan Dalam Proses</p>
        <p class="font-extrabold text-2xl leading-none mb-1">{{ $ordersInProcess }}</p>
        <p class="text-xs text-[#d18f4a] font-normal">{{ $awaitingPickup }} menunggu diantar</p>
      </div>
      <div class="bg-white rounded-xl p-4">
        <p class="text-sm font-normal mb-1">Pelanggan Baru</p>
        <p class="font-extrabold text-2xl leading-none mb-1">{{ $newCustomers }}</p>
        <p class="text-xs text-[#2a7b2a] font-normal">+{{ $newCustomers }} bulan ini</p>
      </div>
    </section>
    <section class="bg-white rounded-xl p-6 mt-6">
      <h2 class="font-extrabold text-lg mb-4">Pesanan Terbaru</h2>
      @foreach ($latestOrders as $order)
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-2 sm:space-y-0">
          <div>
            <p class="font-extrabold text-base leading-none">{{ $order->nama_pelanggan }}</p>
            <p class="text-gray-600 text-sm">#{{ $order->kode_pesanan }}</p>
          </div>
          <span class="bg-[#e6f0ef] text-[#5a7a77] text-xs font-medium px-3 py-1 rounded-full whitespace-nowrap self-start sm:self-auto">{{ ucfirst($order->status) }}</span>
          <p class="font-extrabold text-base leading-none">Rp{{ number_format($order->harga_total, 0, ',', '.') }}</p>
        </div>
      @endforeach
    </section>
    <section class="bg-white rounded-xl p-6 mt-6">
      <h2 class="font-extrabold text-lg mb-6">Grafik Minggu Ini</h2>
      <div class="flex items-end justify-between space-x-3 mb-6">
        @foreach ($weekly as $day)
          <div class="flex flex-col items-center space-y-1">
            <div class="bg-[#5f7ed9] rounded-t-xl w-8" style="height: {{ $day['height'] }}px;"></div>
            <span class="text-gray-600 text-xs">{{ ucfirst($day['label']) }}</span>
          </div>
        @endforeach
      </div>
      <div class="flex justify-between items-center">
        <p class="font-normal text-base">Total Minggu Ini</p>
        <p class="font-extrabold text-lg">Rp{{ number_format($totalWeek, 0, ',', '.') }}</p>
        <p class="text-[#2a7b2a] font-semibold text-sm">{{ $weekGrowthPct !== null ? ($weekGrowthPct > 0 ? '+' : '') . number_format($weekGrowthPct, 1) . '%' : '-' }}</p>
      </div>
    </section>
  </div>

  <!-- Modal Informasi User -->
  <div id="userInfoModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96 shadow-lg relative">
      <button onclick="toggleUserInfo()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500">
        <i class="fas fa-times"></i>
      </button>
      <h2 class="text-lg font-bold mb-4">Informasi Pengguna</h2>
      @auth
        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Username:</strong> {{ Auth::user()->username }}</p>
        <p><strong>No Telp:</strong> {{ Auth::user()->no_telp }}</p>
        <p><strong>Password (hash):</strong> ********</p>
        <form method="GET" action="{{ route('logout') }}" class="mt-4">
          <button type="submit" class="w-full bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700">
            Logout
          </button>
        </form>
      @else
        <p>Silakan login terlebih dahulu.</p>
      @endauth
    </div>
  </div>
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
