<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pengeluaran</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet"/>
  <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-white min-h-screen flex justify-center items-start p-4">
  <div class="w-full max-w-md bg-white border border-transparent">
    <header class="bg-[#d72f6e] flex justify-between items-center px-5 py-4">
      <h1 class="text-white font-extrabold text-xl">Pengeluaran</h1>
      <button aria-label="Menu" class="text-white text-2xl focus:outline-none">
        <i class="fas fa-bars"></i>
      </button>
    </header>

    <main class="p-5 space-y-5 pb-24">
      {{-- Notifikasi sukses --}}
      @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
          {{ session('success') }}
        </div>
      @endif

      @forelse ($pengeluarans as $item)
        <section class="border border-gray-200 rounded-lg p-5">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-xs text-gray-600 mb-1">{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y H:i') }}</p>
              <h2 class="font-extrabold text-lg text-gray-900 leading-tight">{{ $item->judul }}</h2>
              <p class="text-xs text-gray-700 mt-1">{{ $item->keterangan ?? 'Tanpa Keterangan' }}</p>

              {{-- Tampilkan bukti jika ada --}}
              @if ($item->bukti)
                <div class="mt-2">
                  <p class="text-xs text-gray-500 mb-1">Bukti:</p>
                  <img src="data:image/png;base64,{{ base64_encode($item->bukti) }}" alt="Bukti Pengeluaran" class="w-24 h-24 object-cover border rounded">
                  {{-- Link download --}}
                    <a href="data:image/png;base64,{{ base64_encode($item->bukti) }}" download="bukti_pengeluaran_{{ $item->judul }}.png" class="text-sm text-blue-600 hover:underline">
                    Unduh Bukti
                    </a>
                </div>
              @endif
            </div>

            <div class="text-right flex flex-col justify-between items-end ml-4">
              <p class="text-[#d72f6e] font-extrabold text-sm mt-1">- Rp{{ number_format($item->jumlah,0,',','.') }}</p>
              <div class="flex space-x-4 mt-4">
                <a href="{{ route('pengeluaran.edit', $item->id) }}" aria-label="Edit {{ $item->judul }}" class="text-gray-600 hover:text-gray-800">
                  <i class="fas fa-pencil-alt text-lg"></i>
                </a>
                <form action="{{ route('pengeluaran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                  @csrf @method('DELETE')
                  <button type="submit" aria-label="Delete {{ $item->judul }}" class="text-[#d72f6e] hover:text-[#b0265a] focus:outline-none">
                    <i class="fas fa-trash-alt text-lg"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </section>
      @empty
        <p class="text-center text-gray-500">Belum ada pengeluaran.</p>
      @endforelse
    </main>

    <footer class="fixed bottom-4 w-full flex justify-center">
      <a href="{{ route('pengeluaran.create') }}">
        <button class="bg-[#d72f6e] text-white font-semibold italic text-sm rounded-md px-5 py-2 focus:outline-none hover:bg-[#b0265a]" type="button">
          Tambah Pengeluaran
        </button>
      </a>
    </footer>
  </div>
</body>
</html>
