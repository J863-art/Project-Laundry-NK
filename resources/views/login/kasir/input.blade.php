<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Tambah Pesanan</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"/>
  <style> body { font-family: "Poppins", sans-serif; } </style>
</head>
<body class="bg-[#f9f7f7] min-h-screen flex justify-center items-start p-4">

  <main class="bg-white w-full max-w-xs rounded-sm shadow-sm">
    <header class="bg-[#d8396a] px-6 py-4 flex justify-between items-center">
      <h1 class="text-white font-extrabold text-lg leading-none">Tambah Pesanan</h1>
      <button aria-label="Menu" class="text-white text-2xl focus:outline-none">
        <i class="fas fa-bars"></i>
      </button>
    </header>

    {{-- Form Start --}}
    <form class="p-6 space-y-5" method="POST" action="{{ route('pesanan.store') }}">
      @csrf

      {{-- Nama Pelanggan --}}
      <div>
        <label for="nama_pelanggan" class="block text-[#8a8a8a] text-sm mb-1">Nama Pelanggan</label>
        <input list="customers-list" id="nama_pelanggan" name="nama_pelanggan" type="text" required
          class="w-full rounded-xl border px-4 py-2 text-base text-[#4a4a4a] border-gray-400 focus:outline-none"/>
        <datalist id="customers-list">
          @foreach($customers as $cust)
            <option value="{{ $cust->full_name }}">{{ $cust->full_name }} - {{ $cust->phone_number }}</option>
          @endforeach
        </datalist>
      </div>

      {{-- No Telepon --}}
      <div>
        <label for="no_telepon" class="block text-[#8a8a8a] text-sm mb-1">No HP</label>
        <input id="no_telepon" name="no_telepon" type="text" required
          class="w-full rounded-xl border px-4 py-2 text-base text-[#4a4a4a] border-gray-400 focus:outline-none"/>
      </div>

      {{-- ================= INPUT LAYANAN ================== --}}
    <div id="layanan-container">
        <div class="layanan-group mb-4">
        {{-- Select layanan --}}
        <label>Pilih Layanan</label>
        <select name="layanan_id[]" class="layanan-select w-full border p-2 rounded">
            <option value="">-- Pilih Layanan --</option>
            @foreach ($layanans as $layanan)
                <option value="{{ $layanan->id }}"
                        data-jenis="{{ $layanan->jenis }}">
                    {{ $layanan->nama_layanan }} - ({{ $layanan->jenis }})
                </option>
            @endforeach
        </select>

        {{-- Input jumlah (otomatis sesuai jenis) --}}
        <div class="jumlah-wrapper mt-1 space-y-1">
            <input data-jenis="Laundry_Kiloan" type="number" name="berat[]"
                placeholder="Berat (kg)" class="jumlah-input w-full p-2 border rounded hidden">

            <input data-jenis="Laundry_sepatu" type="number" name="jumlah_sepatu[]"
                placeholder="Jumlah Sepatu" class="jumlah-input w-full p-2 border rounded hidden">

            <input data-jenis="Laundry_Satuan" type="number" name="jumlah_satuan[]"
                placeholder="Jumlah Satuan" class="jumlah-input w-full p-2 border rounded hidden">

            <input data-jenis="Laundry_Lainnya" type="number" name="jumlah_lainnya[]"
                placeholder="Jumlah Lainnya" class="jumlah-input w-full p-2 border rounded hidden">
        </div>

        </div>
    </div>

{{-- Tombol tambah layanan --}}
<button type="button" onclick="addLayananGroup()"
        class="mt-2 px-4 py-1 bg-blue-500 text-white rounded">+ Tambah Layanan</button>

{{-- ============ SCRIPT =========== --}}
<script>
function updateJumlahInputs(selectEl) {
    const group = selectEl.closest('.layanan-group');
    const jenis = selectEl.selectedOptions[0]?.dataset.jenis || null;

    group.querySelectorAll('.jumlah-input').forEach(input => {
        if (input.dataset.jenis === jenis) {
            input.classList.remove('hidden');
            input.value = '';            // kosong → user isi
        } else {
            input.classList.add('hidden');
            input.value = 0;             // tetap terkirim sbg nol
        }
    });
}

function addLayananGroup() {
    const container   = document.getElementById('layanan-container');
    const firstGroup  = container.children[0];
    const clone       = firstGroup.cloneNode(true);

    // reset clone
    clone.querySelectorAll('select, input').forEach(el => {
        if (el.tagName === 'SELECT') el.selectedIndex = 0;
        else                         el.value = 0;

        if (el.classList.contains('jumlah-input'))
            el.classList.add('hidden');
    });

    container.appendChild(clone);
}

document.addEventListener('change', e => {
    if (e.target.classList.contains('layanan-select'))
        updateJumlahInputs(e.target);
});

document.querySelectorAll('.layanan-select')
        .forEach(sel => updateJumlahInputs(sel));
</script>


    {{-- Pilih Parfum --}}
    <div>
    <label for="parfum_id" class="block text-[#8a8a8a] text-sm mb-1">Pilih Parfum</label>
    <select id="parfum_id" name="parfum_id"
        class="w-full rounded-xl border px-4 py-2 text-base text-[#4a4a4a] border-gray-400 focus:outline-none">
        <option value="">-- Tanpa Parfum --</option>
        @foreach($parfums as $parfum)
        <option value="{{ $parfum->id }}">{{ $parfum->nama_parfum }} - {{ $parfum->deskripsi }}</option>
        @endforeach
    </select>
    </div>


      {{-- <div>
        <label for="layanan_id" class="block text-[#8a8a8a] text-sm mb-1">Layanan Laundry Satuan</label>
        <select id="layanan_id" name="layanan_id"
          class="w-full rounded-xl border px-4 py-2 text-base text-[#4a4a4a] border-gray-400 focus:outline-none">
          @foreach($layanans as $layanan)
            <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="layanan_id" class="block text-[#8a8a8a] text-sm mb-1">Layanan Laundry Khusus</label>
        <select id="layanan_id" name="layanan_id"
          class="w-full rounded-xl border px-4 py-2 text-base text-[#4a4a4a] border-gray-400 focus:outline-none">
          @foreach($layanans as $layanan)
            <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
          @endforeach
        </select>
      </div>

      <div>
        <label for="layanan_id" class="block text-[#8a8a8a] text-sm mb-1">Layanan Laundry Sepatu</label>
        <select id="layanan_id" name="layanan_id"
          class="w-full rounded-xl border px-4 py-2 text-base text-[#4a4a4a] border-gray-400 focus:outline-none">
          @foreach($layanans as $layanan)
            <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
          @endforeach
        </select>
      </div> --}}

      {{-- Berat --}}
      {{-- <div>
        <label for="berat" class="block text-[#8a8a8a] text-sm mb-1">Berat/Jumlah (kg)</label>
        <input id="berat" name="berat" type="number" step="0.1" required
          class="w-full rounded-xl border px-4 py-2 text-base text-[#4a4a4a] border-gray-400 focus:outline-none"/>
      </div> --}}

      {{-- Status Pembayaran --}}
      <div>
        <label for="status_pembayaran" class="block text-[#8a8a8a] text-sm mb-1">Status Pembayaran</label>
        <select name="status_pembayaran" id="status_pembayaran" required
          class="w-full rounded-xl border px-4 py-2 text-base text-[#4a4a4a] border-gray-400 focus:outline-none">
          <option value="belum_lunas">Belum Lunas</option>
          <option value="lunas">Lunas</option>
        </select>
      </div>

      <div>
        <label for="metode_pembayaran" class="block text-[#8a8a8a] text-sm mb-1">Metode Pembayaran</label>
        <select name="metode_pembayaran" id="metode_pembayaran" required
  class="w-full rounded-xl border px-4 py-2 text-base text-[#4a4a4a] border-gray-400 focus:outline-none">
  <option value="Qris" {{ old('metode_pembayaran') == 'Qris' ? 'selected' : '' }}>Qris</option>
  <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>Cash</option>
</select>

      </div>

      {{-- Estimasi Selesai (editable) --}}
        <div>
        <label for="estimasi_selesai" class="block text-[#8a8a8a] text-sm mb-1">Estimasi Selesai</label>
        <input
            type="datetime-local"
            name="estimasi_selesai"
            id="estimasi_selesai"
            value="{{ old('estimasi_selesai', \Carbon\Carbon::now()->addDays(3)->format('Y-m-d\TH:i')) }}"
            class="w-full rounded-xl border px-4 py-2 text-base text-gray-700 border-gray-400 bg-white"
            required
        />
        </div>


      {{-- Status Pesanan --}}
      <div>
        <label for="status" class="block text-[#8a8a8a] text-sm mb-1">Status</label>
        <select name="status" id="status" required
          class="w-full rounded-xl border px-4 py-2 text-base text-[#4a4a4a] border-gray-400 focus:outline-none">
          <option value="belum_diproses">Belum Diproses</option>
          <option value="sedang_diproses">Sedang Diproses</option>
          <option value="selesai">Selesai</option>
        </select>
      </div>

      {{-- Submit --}}
      <button type="submit"
        class="w-full bg-[#d8396a] text-white font-extrabold text-base py-3 rounded-xl hover:bg-[#c22f5a] transition-colors">
        SIMPAN
      </button>
    </form>
  </main>
</body>
</html>
