<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pendapatan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
  />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-white min-h-screen flex justify-center items-start p-4">
  <div class="w-full max-w-xs">
    <header class="bg-[#db2f65] flex justify-between items-center px-5 py-4 rounded-t-md">
      <h1 class="text-white font-bold text-lg leading-none">Pendapatan</h1>
    </header>

    <main class="bg-white rounded-b-md border border-t-0 border-gray-200 p-4 space-y-4">
        {{-- Dropdown filter --}}
  <div class="flex justify-end mb-3">
    <form method="GET" action="{{ route('owner.pendapatan') }}">
      <label for="filter" class="mr-2 text-sm text-gray-700 font-medium">Tampilkan:</label>
      <select name="filter" id="filter" onchange="this.form.submit()"
        class="rounded-md border-gray-300 text-sm py-1 px-3 focus:ring-[#db2f65] focus:border-[#db2f65]">
        <option value="pemasukan" {{ request('filter') == 'pemasukan' ? 'selected' : '' }}>Pemasukan (Lunas)</option>
        <option value="omset" {{ request('filter') == 'omset' ? 'selected' : '' }}>Omset (Semua)</option>
      </select>
    </form>
  </div>

      @foreach ($pesanans as $pesanan)
      <article class="border border-gray-200 rounded-md p-4">
        <div class="flex justify-between text-xs text-gray-600 mb-1">
          <time datetime="{{ $pesanan->tanggal_masuk }}">
            {{ \Carbon\Carbon::parse($pesanan->tanggal_masuk)->format('d-m-Y H:i') }}
          </time>
        </div>
        <h2 class="font-bold text-sm mb-1">
          Pesanan <span class="font-extrabold">#{{ $pesanan->kode_pesanan }}</span>
        </h2>

        <div class="flex items-center gap-2 text-[#4a4a4a] text-sm">
          <i class="fas fa-user"></i>
          <div>
            <p class="font-normal">{{ $pesanan->customer->full_name ?? 'N/A' }}</p>
            <p class="text-xs font-normal">{{ $pesanan->customer->phone_number ?? '-' }}</p>
          </div>
        </div>

        <!-- Tambahan: Informasi Metode Pembayaran -->
        <div class="flex items-center gap-2 text-sm mt-1">
            <i class="fas fa-money-bill-wave text-[#4a4a4a]"></i>
            <p class="text-xs font-normal">Metode Pembayaran: {{ $pesanan->metode_pembayaran ?? '-' }}</p>
        </div>

         @foreach ($pesanan->detailPesanans as $detail)
        <div class="flex items-center gap-2">
                <i class="fas fa-box"></i>
                {{-- <p class="m-0"></p> --}}
                    {{ $detail->nama_layanan }} = Rp {{ number_format($detail->subtotal, 2) }} {{ $detail->jenis === 'kg' ? 'Kg' : '' }}
                </p>
            </div>
        @endforeach

        <div class="flex justify-between items-center">
          <span class="text-green-600 font-semibold text-sm">
            + Rp{{ number_format($pesanan->harga_total, 0, ',', '.') }}
          </span>
          {{-- Tombol edit & delete bisa diaktifkan jika perlu --}}
          {{--
          <div class="flex space-x-4 text-gray-600">
            <button aria-label="Edit" class="focus:outline-none">
              <i class="fas fa-pencil-alt"></i>
            </button>
            <button aria-label="Delete" class="text-[#db2f65] focus:outline-none">
              <i class="fas fa-trash"></i>
            </button>
          </div>
          --}}
        </div>
      </article>
      @endforeach

      @if ($pesanans->isEmpty())
      <p class="text-center text-gray-500 text-sm">Belum ada pendapatan dengan status lunas.</p>
      @else
      <div class="border-t border-gray-300 pt-4 text-sm font-semibold text-right text-gray-700">
        Total Pendapatan:
        <span class="text-green-600">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</span>
      </div>
      @endif

      {{-- Jika perlu tombol tambah pendapatan, aktifkan blok ini --}}
      {{--
      <div class="flex justify-center mt-4">
        <a
          href="{{ route('pesanan.create') }}"
          class="bg-[#db2f65] text-white text-xs font-semibold italic py-2 px-5 rounded-md focus:outline-none"
        >
          Tambah Pendapatan
        </a>
      </div>
      --}}
    </main>
  </div>
</body>
</html>
