<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah Layanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap');
  </style>
</head>
<body class="bg-white min-h-screen flex flex-col">
  <header class="bg-[#d9336a] flex items-center justify-between px-5 py-4">
    <h1 class="text-white font-poppins font-semibold text-lg leading-none">Tambah Layanan</h1>
    <button aria-label="Menu" class="text-white text-2xl focus:outline-none">
      <i class="fas fa-bars"></i>
    </button>
  </header>

  <main class="flex-grow px-5 pt-6 pb-10">
    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
      </div>
    @endif

    @if($errors->any())
      <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
        <ul>
          @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form class="space-y-6 max-w-md" method="POST" action="{{ route('layanan.store') }}">
      @csrf

    <div>
    <label for="jenis" class="block text-sm font-medium text-black mb-1">Jenis Laundry</label>
    <select
        id="jenis"
        name="jenis"
        class="w-full rounded-xl border border-gray-400 text-gray-700 text-sm py-3 px-4 appearance-none pr-10"
        required>
        <option value="Laundry_Satuan" {{ old('jenis') == 'Laundry_Satuan' ? 'selected' : '' }}>Laundry Satuan</option>
        <option value="Laundry_Kiloan" {{ old('jenis') == 'Laundry_Kiloan' ? 'selected' : '' }}>Laundry Kiloan</option>
        <option value="Laundry_Lainnya" {{ old('jenis') == 'Laundry_Lainnya' ? 'selected' : '' }}>Laundry BedCover/Selimut/Sprei/Handuk/Boneka</option>
        <option value="Laundry_sepatu" {{ old('jenis') == 'Laundry_sepatu' ? 'selected' : '' }}>Laundry Sepatu</option>
    </select>
    </div>



      <div>
        <label for="nama_layanan" class="block text-sm font-medium text-black mb-1">Nama Layanan</label>
        <input
          type="text"
          id="nama_layanan"
          name="nama_layanan"
          placeholder="Contoh: Cuci Kering"
          class="w-full rounded-xl border border-gray-400 text-gray-700 text-sm py-3 px-4"
          required
        />
      </div>

      <div>
        <label for="harga" class="block text-sm font-medium text-black mb-1">Harga</label>
        <input
          type="number"
          id="harga"
          name="harga"
          placeholder="Contoh: 20000"
          class="w-full rounded-xl border border-gray-400 text-gray-700 text-sm py-3 px-4"
          required
        />
      </div>

      <button
        type="submit"
        class="w-full bg-[#d9336a] text-white font-semibold rounded-full py-4 text-center text-base"
      >
        SIMPAN
      </button>
    </form>
  </main>
</body>
</html>
