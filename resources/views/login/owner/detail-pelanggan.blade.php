<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Pelanggan
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: "Inter", sans-serif;
    }
  </style>
 </head>
 <body class="bg-white text-black">
  <header class="bg-[#d6336c] flex justify-between items-center px-6 py-4">
   <h1 class="text-white font-extrabold text-xl select-none">
    Pelanggan
   </h1>
   <button aria-label="Menu" class="text-white text-3xl focus:outline-none">
    <i class="fas fa-bars">
    </i>
   </button>
  </header>
  <main class="p-6 space-y-6">
   <!-- Customer Card -->
   <section class="flex items-center gap-4 bg-white rounded-xl shadow-md px-6 py-4 max-w-md mx-auto">
    <img alt="Avatar" class="w-12 h-12 rounded-full flex-shrink-0" height="48" src="https://storage.googleapis.com/a1aa/image/0c40fe27-ed1f-4077-379b-e3ee1b8f9f88.jpg" width="48"/>
    <div class="flex-1">
     <p class="font-semibold text-sm leading-tight">
      {{ $customer->full_name }}
     </p>
     <p class="text-xs leading-tight">
      {{ $customer->phone_number }}
     </p>
    </div>
    <p class="text-xs text-right font-normal leading-tight max-w-[120px]">
     {{ $customer->address ?? '-' }}
    </p>
   </section>

   <!-- Data Transaksi -->
   <section class="max-w-md mx-auto space-y-2">
    <p class="text-base font-normal">
     Data Transaksi
    </p>
    <div class="flex justify-between border border-gray-300 rounded-xl p-4 shadow-sm">
     <div class="bg-white shadow-md rounded-md px-4 py-3 text-center w-32 select-none">
      <p class="text-xs text-gray-400 mb-1">
       Jumlah Transaksi
      </p>
      <p class="text-yellow-500 font-semibold text-lg leading-snug">
       {{ $jumlahTransaksi }}x
       <br/>
       <span class="font-extrabold">
        Transaksi
       </span>
      </p>
     </div>
     <div class="bg-white shadow-md rounded-md px-4 py-3 text-center w-32 select-none">
      <p class="text-xs text-gray-400 mb-1">
       Total Transaksi
      </p>
      <p class="text-green-600 font-semibold text-lg leading-snug">
       Rp{{ number_format($totalTransaksi, 0, ',', '.') }}
      </p>
     </div>
    </div>
   </section>

   <!-- Riwayat Transaksi -->
   <section class="max-w-md mx-auto space-y-4">
    <p class="text-base font-normal">
     Riwayat Transaksi
    </p>
    @foreach($customer->pesanan as $pesanan)
    <article class="border border-gray-300 rounded-xl p-4 space-y-3 select-none">
     <h2 class="font-extrabold text-lg leading-tight">
      Pesanan
      <span class="font-extrabold">
       #{{ $pesanan->kode_pesanan }}
      </span>
     </h2>
     <p class="text-sm font-normal leading-tight">
      Tanggal Masuk : {{ \Carbon\Carbon::parse($pesanan->tanggal_masuk)->translatedFormat('d F Y') }}
     </p>
     <div class="flex flex-col gap-2 text-gray-700 text-sm">
      <div class="flex items-center gap-2">
       <i class="fas fa-user-alt text-lg"></i>
       <div>
        <p>{{ $customer->full_name }}</p>
        <p class="text-xs">{{ $customer->phone_number }}</p>
       </div>
      </div>

       {{-- <div class="flex items-center gap-2">
    <i class="fas fa-washer text-lg"></i>
        <p>{{ $pesanan->detailPesanans->pluck('nama_layanan')->join(', ') ?: '-' }}</p>
    </div> --}}



    {{-- Daftar nama layanan + subtotal --}}
    @foreach ($pesanan->detailPesanans as $detail)
    <div class="flex items-center gap-2">
            <i class="fas fa-box"></i>
            <p class="m-0">Layanan:</p>
                {{ $detail->nama_layanan }} = Rp {{ number_format($detail->subtotal, 2) }} {{ $detail->jenis === 'kg' ? 'Kg' : '' }}
            </p>
        </div>
    @endforeach

    <div class="flex items-center gap-2">
        <i class="fas fa-money-bill-wave text-[#4a4a4a]"></i>
        Harga Total = Rp {{ $pesanan->detailPesanans->sum('subtotal') ?? 0}}
    </div>



    <div class="flex items-center gap-2">
        <i class="fas fa-weight-hanging text-lg"></i>
        Berat/Jumlah Total = {{ $pesanan->detailPesanans->sum('jumlah') ?? 0 }} Kg/pcs
    </div>


     </div>
     <div class="flex justify-end items-center gap-2 text-gray-700 text-sm font-normal">
      <i class="far fa-calendar-alt text-lg"></i>
      <div class="text-right">
       <p>Estimasi Selesai</p>
       <p class="text-xs">{{ \Carbon\Carbon::parse($pesanan->tanggal_selesai)->translatedFormat('d F Y H:i') }}</p>
      </div>
     </div>
     <div class="inline-block rounded-full bg-[#d9f0f0] text-[#e6b87a] text-xs font-semibold px-3 py-1 select-text">
      {{ ucfirst($pesanan->status) }}
     </div>
    </article>
    @endforeach
   </section>
  </main>
 </body>
</html>
