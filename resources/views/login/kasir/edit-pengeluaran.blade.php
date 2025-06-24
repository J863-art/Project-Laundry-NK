<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/><meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Edit Pengeluaran</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
</head>
<body class="bg-white min-h-screen flex justify-center items-start p-4">
  <div class="w-full max-w-xs bg-white shadow rounded-sm">
    <header class="bg-[#d8396e] px-5 py-4">
      <h1 class="text-white font-bold">Edit Pengeluaran</h1>
    </header>
    <form action="{{ route('pengeluaran.update', $pengeluaran->id) }}" method="POST" enctype="multipart/form-data" class="p-5 space-y-4">
      @csrf @method('PUT')
      <input type="datetime-local" name="tanggal"
             value="{{ old('tanggal', \Carbon\Carbon::parse($pengeluaran->tanggal)->format('Y-m-d\TH:i')) }}"
             class="border w-full px-3 py-2" required/>
      <input type="text" name="judul" value="{{ old('judul', $pengeluaran->judul) }}"
             placeholder="Judul Pengeluaran" class="border w-full px-3 py-2" required/>
      <input type="number" name="jumlah" value="{{ old('jumlah', $pengeluaran->jumlah) }}"
             placeholder="Jumlah Pengeluaran" class="border w-full px-3 py-2" required/>
      <input type="text" name="keterangan" value="{{ old('keterangan', $pengeluaran->keterangan) }}"
             placeholder="Keterangan (opsional)" class="border w-full px-3 py-2"/>
      @if($pengeluaran->bukti)
      @endif
      <input type="file" name="bukti" class="border w-full px-3 py-2"/>
      <button type="submit" class="bg-[#d8396e] text-white w-full py-3 rounded">SIMPAN</button>
    </form>
  </div>
</body>
</html>
