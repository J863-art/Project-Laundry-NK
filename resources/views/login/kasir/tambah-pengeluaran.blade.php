<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/><meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Tambah Pengeluaran</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet"/>
  <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-white min-h-screen flex justify-center items-start p-4">
  <div class="w-full max-w-sm bg-white shadow rounded-md border border-gray-200">
    <header class="bg-[#d8396e] px-5 py-4 rounded-t-md">
      <h1 class="text-white font-bold text-lg">Tambah Pengeluaran</h1>
    </header>

    {{-- Notifikasi Sukses --}}
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 text-sm m-4 rounded">
        {{ session('success') }}
      </div>
    @endif

    {{-- Tampilkan Error --}}
    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 text-sm m-4 rounded">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('pengeluaran.store') }}" method="POST" enctype="multipart/form-data" class="p-5 space-y-4">
      @csrf

      <div>
        <label class="block text-sm mb-1 text-gray-700">Tanggal & Waktu</label>
        <input type="datetime-local" name="tanggal" class="border w-full px-3 py-2 rounded" required/>
      </div>

      <div>
        <label class="block text-sm mb-1 text-gray-700">Judul Pengeluaran</label>
        <input type="text" name="judul" placeholder="Contoh: Beli ATK" class="border w-full px-3 py-2 rounded" required/>
      </div>

      <div>
        <label class="block text-sm mb-1 text-gray-700">Jumlah Pengeluaran (Rp)</label>
        <input type="number" name="jumlah" placeholder="Contoh: 50000" class="border w-full px-3 py-2 rounded" required/>
      </div>

      <div>
        <label class="block text-sm mb-1 text-gray-700">Keterangan (opsional)</label>
        <input type="text" name="keterangan" placeholder="Contoh: Untuk keperluan kantor" class="border w-full px-3 py-2 rounded"/>
      </div>

      <div>
        <label class="block text-sm mb-1 text-gray-700">Upload Bukti (opsional)</label>
        <input type="file" name="bukti" class="border w-full px-3 py-2 rounded"/>
        <p class="text-xs text-gray-500 mt-1">Format gambar (JPG, PNG), maksimal 2MB.</p>
      </div>

      <button type="submit" class="bg-[#d8396e] text-white w-full py-3 rounded hover:bg-[#b12e5b] transition duration-200 font-semibold">
        <i class="fas fa-save mr-2"></i> SIMPAN
      </button>
    </form>
  </div>
</body>
</html>
