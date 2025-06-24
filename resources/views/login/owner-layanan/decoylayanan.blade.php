<!-- resources/views/login/owner-layanan/layanan.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Layanan Laundry</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body class="bg-[#fff0f1] min-h-screen font-sans">
  <div class="max-w-md mx-auto p-4">
    <div class="bg-[#d9336e] p-4 rounded-t">
      <h1 class="text-white font-extrabold text-lg">Layanan</h1>
    </div>

    <div class="bg-white p-4 rounded-b space-y-3">
      <p class="text-[#3c3c3c] text-sm leading-relaxed">
        Kelola semua layanan laundry yang tersedia untuk pelanggan anda
      </p>

      <!-- Form Search -->
      <form method="GET" action="{{ route('owner.layanann.index') }}">
        <input
          type="text"
          name="search"
          placeholder="Cari layanan..."
          value="{{ request('search') }}"
          class="w-full border border-gray-300 rounded-md px-3 py-2 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-[#d9336e]"
        />
      </form>

      <!-- Tombol Kategori -->
      <button class="border border-gray-300 rounded-md px-3 py-1 text-xs text-[#3c3c3c] font-semibold">
        Semua Kategori <i class="fas fa-chevron-right ml-1"></i>
      </button>

      <!-- Daftar Layanan -->
      <div class="space-y-3">
        @foreach($layanans as $layanan)
        <div class="border border-gray-200 rounded-md p-3 flex justify-between items-center">
          <div>
            <h2 class="text-base font-semibold text-[#1a1a1a]">{{ $layanan->nama_layanan }}</h2>
            <p class="text-sm text-[#1a1a1a]">Rp {{ number_format($layanan->harga, 0, ',', '.') }}/Kg</p>
          </div>
          <div class="flex items-center space-x-3">
            @if($layanan->tipe == 'Regular')
              <span class="bg-[#d4e6e7] text-[#4a6e70] text-[10px] font-semibold rounded-full px-2 py-0.5">Regular</span>
            @else
              <span class="bg-[#b7c3f0] text-[#4a5bbd] text-[10px] font-semibold rounded-full px-2 py-0.5">Express</span>
            @endif

            <!-- Tombol Edit (membuka drawer) -->
            <button onclick="openDrawer({{ $layanan->id }}, '{{ $layanan->nama_layanan }}', {{ $layanan->harga }}, '{{ $layanan->tipe }}')" class="text-[#1a1a1a] text-sm">
              <i class="fas fa-pencil-alt"></i>
            </button>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Tombol Tambah -->
  <button
    aria-label="Add new service"
    class="fixed bottom-6 right-6 bg-[#d9336e] w-14 h-14 rounded-full flex items-center justify-center text-white text-3xl shadow-lg"
    onclick="document.querySelector('form[action*=store]').scrollIntoView({behavior:'smooth'});"
  >
    +
  </button>

  <!-- Drawer untuk Update Layanan -->
  <div id="drawer" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
    <div class="fixed top-0 right-0 w-1/3 h-full bg-white p-6">
      <h2 class="text-xl font-semibold text-[#d9336e] mb-4">Update Layanan</h2>
      <form method="POST" action="{{ route('owner.layanann.update', ['layanann' => $layanan->id]) }}" id="updateForm">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="updateId">
        <div class="mb-4">
            <label for="nama_layanan" class="block text-sm font-medium text-gray-700">Nama Layanan</label>
            <input type="text" name="nama_layanan" id="updateNamaLayanan" class="w-full border border-gray-300 rounded-md px-3 py-2 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-[#d9336e]" required />
        </div>
        <div class="mb-4">
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" name="harga" id="updateHarga" class="w-full border border-gray-300 rounded-md px-3 py-2 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-[#d9336e]" required />
        </div>
        <div class="mb-4">
            <label for="tipe" class="block text-sm font-medium text-gray-700">Tipe</label>
            <select name="tipe" id="updateTipe" class="w-full border border-gray-300 rounded-md px-3 py-2 text-xs placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-[#d9336e]" required>
                <option value="Regular">Regular</option>
                <option value="Express">Express</option>
            </select>
        </div>
        <button type="submit" class="w-full bg-[#d9336e] text-white py-2 rounded-md">Update</button>
    </form>

      <button onclick="closeDrawer()" class="absolute top-4 right-4 text-white text-2xl">&times;</button>
    </div>
  </div>

  <!-- Form Create (disembunyikan, bisa pakai modal jika ingin lebih baik) -->
  <form method="POST" action="{{ route('owner.layanann.store') }}" class="hidden mt-4">
    @csrf
    <input type="text" name="nama_layanan" placeholder="Nama Layanan" required />
    <input type="number" name="harga" placeholder="Harga" required />
    <select name="tipe" required>
      <option value="Regular">Regular</option>
      <option value="Express">Express</option>
    </select>
    <button type="submit">Tambah</button>
  </form>

  <script>
    // Fungsi untuk membuka drawer dan mengisi form dengan data yang sesuai
    // Fungsi untuk membuka drawer dan mengisi form dengan data yang sesuai
        function openDrawer(id, nama_layanan, harga, tipe) {
        document.getElementById('drawer').classList.remove('hidden');
        document.getElementById('updateId').value = id;
        document.getElementById('updateNamaLayanan').value = nama_layanan;
        document.getElementById('updateHarga').value = harga;
        document.getElementById('updateTipe').value = tipe;

        // Set form action to the correct route with the dynamic id
        document.getElementById('updateForm').action = '{{ url("owner/layanann") }}/' + id;
        }


    // Fungsi untuk menutup drawer
    function closeDrawer() {
      document.getElementById('drawer').classList.add('hidden');
    }
  </script>
</body>
</html>
