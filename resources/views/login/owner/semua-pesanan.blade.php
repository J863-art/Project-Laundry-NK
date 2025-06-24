@extends('login.owner.layout')

@section('title', 'Pesanan')
@section('header', 'Pesanan')

@section('filters')
  {{-- Form pencarian dan pengurutan --}}
  <form method="GET" action="{{ route('owner.pesanan') }}" class="space-y-2">
    {{-- Input Pencarian --}}
    <input
      type="search"
      name="search"
      value="{{ request('search') }}"
      aria-label="Cari Pesanan"
      placeholder="Cari Pesanan"
      class="w-full border border-gray-300 rounded-md text-sm text-gray-700 py-2 px-3 focus:outline-none focus:ring-1 focus:ring-[#DD2E6E] focus:border-[#DD2E6E]"
    />

    {{-- Select Pengurutan --}}
    <select
      name="sort"
      aria-label="Urutkan Berdasarkan"
      onchange="this.form.submit()" {{-- Submit otomatis --}}
      class="w-full border border-gray-300 rounded-md text-sm text-gray-700 py-2 px-3 focus:outline-none focus:ring-1 focus:ring-[#DD2E6E] focus:border-[#DD2E6E]"
    >
      <option value="">Urutkan Berdasarkan</option>
      <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>Nama Pemesan</option>
      <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Pesanan Terbaru</option>
      <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Pesanan Terlama</option>
      <option value="proses" {{ request('sort') == 'proses' ? 'selected' : '' }}>Proses Pesanan</option>
    </select>

  </form>
@endsection

@section('content')
  @forelse ($pesanans as $pesanan)
    <div class="bg-[#fff7f7] rounded-lg p-4 space-y-3 relative">
      {{-- <div class="absolute top-2 right-2 flex gap-2">
        <a href="{{ route('kasir.pesanan.edit', $pesanan->id) }}"
          class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold rounded-full px-4 py-1">Edit</a>
        <form action="{{ route('kasir.pesanan.destroy', $pesanan->id) }}" method="POST"
          onsubmit="return confirm('Apakah kamu yakin ingin menghapus pesanan ini?')">
          @csrf
          @method('DELETE')
          <button type="submit"
            class="bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-full px-4 py-1">Hapus</button>
        </form>
      </div> --}}

      <h2 class="font-bold text-[#4a4a4a] text-base">
        Pesanan <span class="font-normal">#{{ $pesanan->kode_pesanan }}</span>
      </h2>

      <p class="text-xs text-[#4a4a4a]">Tanggal Masuk: {{ \Carbon\Carbon::parse($pesanan->tanggal_masuk)->format('d F Y') }}</p>

      <div class="space-y-2">
        <div class="flex items-center gap-2 text-[#4a4a4a] text-sm">
          <i class="fas fa-user"></i>
          <div>
            <p class="font-normal">{{ $pesanan->customer->full_name ?? 'N/A' }}</p>
            <p class="text-xs font-normal">{{ $pesanan->customer->phone_number ?? '-' }}</p>
          </div>
        </div>

        {{-- Parfum --}}
        <div class="space-y-2">
        <div class="flex items-center gap-2 text-[#4a4a4a] text-sm">
            <i class="fas fa-spray-can"></i> {{-- ganti icon jika perlu --}}
            <div>
            <p class="font-normal">
                {{ $pesanan->parfum?->nama_parfum ?? 'Tanpa Parfum' }}
            </p>
            </div>
        </div>
        </div>

        {{-- Detail Layanan --}}
        <div class="text-sm text-[#4a4a4a] space-y-1">
        <div class="flex items-center gap-2 font-semibold">
            <i class="fas fa-box"></i>
            <p class="m-0">Detail Layanan:</p>
        </div>

        @forelse ($pesanan->detailPesanans as $detail)
            <div class="flex justify-between px-2">
            <span>{{ $detail->nama_layanan }} ({{ $detail->jenis }}) {{ $detail->jumlah }} Kg/Pcs = Rp {{ number_format($detail->subtotal, 0, ',', '.') }} </span>
            {{-- <span>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span> --}}
            </div>
        @empty
            <p class="text-xs text-gray-500 px-2">Tidak ada layanan.</p>
        @endforelse
        </div>


        {{-- <div class="flex items-center gap-2 text-[#4a4a4a] text-sm">
          <i class="fas fa-weight-hanging"></i>
          <p class="font-normal">{{ $pesanan->berat ?? '-' }} Kg</p>
        </div> --}}

        <div class="flex items-center gap-2 text-[#4a4a4a] text-sm">
          <i class="fas fa-money-bill-wave"></i>
          <p class="font-normal">Total = Rp {{ number_format($pesanan->harga_total ?? 0, 0, ',', '.') }}</p>
        </div>

        <div class="flex items-center gap-2 text-sm">
          <i class="fas fa-money-bill-wave text-[#4a4a4a]"></i>
          <p class="font-semibold {{ $pesanan->status_pembayaran === 'belum_lunas' ? 'text-red-600' : 'text-green-600' }}">
            {{ ucfirst(str_replace('_', ' ', $pesanan->status_pembayaran)) }}
          </p>
        </div>

        <div class="flex items-center gap-2 text-sm">
          <i class="fas fa-money-bill-wave text-[#4a4a4a]"></i>
           <p class="text-xs font-normal">Metode Pembayaran: {{ $pesanan->metode_pembayaran ?? '-' }}</p>
          </p>
        </div>

        <div class="flex items-center justify-end gap-2 text-[#4a4a4a] text-xs">
          <i class="fas fa-calendar-alt"></i>
          <p class="font-semibold">Estimasi Selesai: {{ \Carbon\Carbon::parse($pesanan->estimasi_selesai)->format('d F Y H:i') }}</p>
        </div>
      </div>

      <div class="flex justify-end mt-2">
        @php
          $warnaStatus = match($pesanan->status) {
              'belum_diproses' => 'bg-red-700',
              'sedang_diproses' => 'bg-pink-500',
              'selesai' => 'bg-green-600',
              default => 'bg-gray-400',
          };
        @endphp

        <button class="{{ $warnaStatus }} text-white text-xs font-semibold rounded-full px-6 py-1" type="button">
          {{ ucfirst(str_replace('_', ' ', $pesanan->status)) }}
        </button>
      </div>
    </div>
  @empty
    <p class="text-sm text-center text-gray-500">Tidak ada pesanan ditemukan.</p>
  @endforelse
@endsection
