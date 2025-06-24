<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Pesanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"/>
  <style> body { font-family: "Poppins", sans-serif; } </style>
</head>
<body class="bg-[#f9f7f7] min-h-screen flex justify-center items-start p-4">

<main class="bg-white w-full max-w-xs rounded-sm shadow-sm">
  <header class="bg-[#d8396a] px-6 py-4 flex justify-between items-center">
    <h1 class="text-white font-extrabold text-lg leading-none">Edit Pesanan</h1>
    <button aria-label="Menu" class="text-white text-2xl focus:outline-none">
      <i class="fas fa-bars"></i>
    </button>
  </header>

  <form class="p-6 space-y-5" method="POST" action="{{ route('kasir.pesanan.update', $pesanan->id) }}">
    @csrf
    @method('PUT')

    {{-- Nama & Telepon (readonly) --}}
    <div>
      <label for="nama_pelanggan" class="block text-sm text-[#8a8a8a] mb-1">Nama Pelanggan</label>
      <input id="nama_pelanggan" name="nama_pelanggan" type="text"
             value="{{ old('nama_pelanggan', $pesanan->nama_pelanggan) }}" readonly
             class="w-full rounded-xl border px-4 py-2 text-sm text-gray-500 border-gray-400 bg-gray-100 cursor-default select-none"/>
    </div>

    <div>
      <label for="no_telepon" class="block text-sm text-[#8a8a8a] mb-1">No HP</label>
      <input id="no_telepon" name="no_telepon" type="text"
             value="{{ old('no_telepon', $pesanan->no_telepon) }}" readonly
             class="w-full rounded-xl border px-4 py-2 text-sm text-gray-500 border-gray-400 bg-gray-100 cursor-default select-none"/>
    </div>

    {{-- Layanan & Jumlah --}}
    @foreach($pesanan->detailPesanans as $index => $detail)
  <div class="border rounded-xl p-3 bg-gray-50 space-y-2">
    <label class="block text-sm text-[#8a8a8a]">Layanan</label>
    <select name="layanan_id[]" class="w-full rounded-xl border px-3 py-2 text-sm border-gray-400">
      @foreach($layanans as $layanan)
        <option value="{{ $layanan->id }}"
          {{ $layanan->id == $detail->layanann_id ? 'selected' : '' }}>
          {{ $layanan->nama_layanan }} - ({{ $layanan->jenis }})
        </option>
      @endforeach
    </select>

    <label class="block text-sm text-[#8a8a8a]">Jumlah/Berat</label>
    <input type="number" name="jumlah[]" step="0.1"
           value="{{ $detail->jumlah }}"
           class="w-full rounded-xl border px-3 py-2 text-sm border-gray-400" required/>
  </div>
@endforeach


    {{-- Estimasi Selesai --}}
    <div>
      <label for="estimasi_selesai" class="block text-sm text-[#8a8a8a] mb-1">Estimasi Selesai</label>
      <input type="datetime-local" name="estimasi_selesai" id="estimasi_selesai"
             value="{{ \Carbon\Carbon::parse($pesanan->estimasi_selesai)->format('Y-m-d\TH:i') }}"
             class="w-full rounded-xl border px-4 py-2 text-sm border-gray-400 bg-white" required />
    </div>

    {{-- Status Pembayaran --}}
    <div>
      <label for="status_pembayaran" class="block text-sm text-[#8a8a8a] mb-1">Status Pembayaran</label>
      <select name="status_pembayaran" id="status_pembayaran"
              class="w-full rounded-xl border px-4 py-2 text-sm border-gray-400">
        <option value="belum_lunas" {{ $pesanan->status_pembayaran === 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
        <option value="lunas" {{ $pesanan->status_pembayaran === 'lunas' ? 'selected' : '' }}>Lunas</option>
      </select>
    </div>

    {{-- Status Pesanan --}}
    <div>
      <label for="status" class="block text-sm text-[#8a8a8a] mb-1">Status</label>
      <select name="status" id="status"
              class="w-full rounded-xl border px-4 py-2 text-sm border-gray-400">
        <option value="belum_diproses" {{ $pesanan->status === 'belum_diproses' ? 'selected' : '' }}>Belum Diproses</option>
        <option value="sedang_diproses" {{ $pesanan->status === 'sedang_diproses' ? 'selected' : '' }}>Sedang Diproses</option>
        <option value="selesai" {{ $pesanan->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
      </select>
    </div>

    {{-- Submit --}}
    <button type="submit"
            class="w-full bg-[#d8396a] text-white font-extrabold text-base py-3 rounded-xl hover:bg-[#c22f5a] transition-colors">
      SIMPAN PERUBAHAN
    </button>
  </form>
</main>

</body>
</html>
