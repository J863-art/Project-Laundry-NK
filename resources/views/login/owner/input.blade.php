<!-- resources/views/pesanan/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Pesanan</title>
</head>
<body>
    <h1>Form Input Pesanan</h1>

    <form action="{{ route('pesanan.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama_pelanggan">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" id="nama_pelanggan" required>
        </div>

        <div>
            <label for="no_telepon">No Telepon</label>
            <input type="text" name="no_telepon" id="no_telepon" required>
        </div>

        <div>
            <label for="layanan_id">Layanan</label>
            <select name="layanan_id" id="layanan_id" required>
                <!-- Ambil data layanan dari tabel layanan -->
                @foreach($layanans as $layanan)
                    <option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="berat">Berat</label>
            <input type="number" step="0.01" name="berat" id="berat" required>
        </div>

        <div>
            <button type="submit">Tambah Pesanan</button>
        </div>
    </form>


</body>
</html>
