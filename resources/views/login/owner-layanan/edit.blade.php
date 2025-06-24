<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Layanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>
<body class="bg-white min-h-screen flex flex-col">
  <header class="bg-[#d6336c] flex items-center justify-between px-5 h-14">
    <h1 class="text-white font-extrabold text-lg">Edit Layanan</h1>
    <button aria-label="Menu" class="text-white text-2xl focus:outline-none">
      <i class="fas fa-bars"></i>
    </button>
  </header>

  <main class="flex-grow p-5">
    <form action="{{ route('layanan.update', $layanan->id) }}" method="POST" class="max-w-md space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="jenis" class="block text-black text-sm font-normal mb-1">Jenis Laundry</label>
            <select
            id="jenis"
            name="jenis"
            class="w-full rounded-tl-lg rounded-bl-lg rounded-tr-md rounded-br-md border border-gray-400 text-gray-600 text-sm px-4 py-2"
            >
            <option value="Laundry_Satuan" {{ $layanan->jenis == 'Laundry_Satuan' ? 'selected' : '' }}>Laundry Satuan</option>
            <option value="Laundry_Kiloan" {{ $layanan->jenis == 'Laundry_Kiloan' ? 'selected' : '' }}>Laundry Kiloan</option>
            <option value="Laundry_Lainnya" {{ $layanan->jenis == 'Laundry_Lainnya' ? 'selected' : '' }}>Laundry Lainnya</option>
            <option value="Laundry_Sepatu" {{ $layanan->jenis == 'Laundry_Sepatu' ? 'selected' : '' }}>Laundry Sepatu</option>
            </select>
        </div>

        <div>
            <label for="nama-layanan" class="block text-black text-sm font-normal mb-1">Nama Layanan</label>
            <input
            id="nama-layanan"
            name="nama_layanan"
            type="text"
            value="{{ $layanan->nama_layanan }}"
            class="w-full rounded-lg border border-gray-400 text-gray-600 text-sm px-4 py-2"
            />
        </div>

        <div>
            <label for="harga" class="block text-black text-sm font-normal mb-1">Harga</label>
            <input
            id="harga"
            name="harga"
            type="text"
            value="{{ $layanan->harga }}"
            class="w-full rounded-lg border border-gray-400 text-gray-600 text-sm px-4 py-2"
            />
        </div>

        <div class="flex justify-between mt-8 max-w-md">
            <button
            type="submit"
            class="bg-[#d6336c] text-white font-extrabold text-sm px-12 py-3 rounded-full"
            >
            SIMPAN
            </button>
            <a
            href="{{ route('layanan.index') }}"
            class="bg-gray-400 text-white font-extrabold text-sm px-12 py-3 rounded-full text-center"
            >
            BATAL
            </a>
        </div>
    </form>

  </main>
</body>
</html>
